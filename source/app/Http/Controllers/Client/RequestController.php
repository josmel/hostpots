<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Contact;
use App\Models\Driver;
use App\Models\DeliveryType;
use App\Models\Category;
use App\Models\Vehicletype;
use App\Models\Paymenttype;
use App\Models\Delivery;
use App\Models\DeliveryState;
use App\Models\DeliveryHistory;
use App\Models\Route;
use App\Models\Notification;
use App\Models\Platform;
use App\Library\CouchDb;
use App\Http\Requests\Client\FormRequestRequest;
use App\Http\Requests\Client\TarifaRequest;
use App\Http\Requests\Client\ActivosRequest;
use App\Http\Requests\Client\DetalleRequest;
use Carbon\Carbon;
use Auth;
use DB;
use Config;

class RequestController extends Controller {

    const NAMEC = 'solicitar';
    const REDIRECT_LOGIN = 'login';

    public function getIndex() {
        if (Auth::customer()->check()) {
            $id = Auth::customer()->user()->id;
            $table = new Customer();
            if (!empty($id)) {
                $table = Customer::find($id);
            }
            $contacts = Contact::whereCustomerId($id)->get();
            $deliveryType = DeliveryType::all();
            $category = Category::all();
            $vehicletype = Vehicletype::all();
            $paymenttype = Paymenttype::all();
            return view('client.' . self::NAMEC . '.index', compact('table', 'contacts', 'deliveryType', 'category', 'vehicletype', 'paymenttype'));
        }
        return redirect(self::REDIRECT_LOGIN)->with('messageError', 'Inicie sesion');
    }

    public function postIndex(FormRequestRequest $request) {
        if (Auth::customer()->check()) {
            $return = DB::transaction(function() use ($request) {
                try {
                    $objDelivery = $this->saveDelivery($request);
                    DB::commit();
                    $driver = Driver::whereFlagactive(1)->get();
                    $deliveryTypeId = str_replace('"', '', $request->get('delivery_type_id'));
                    if ($deliveryTypeId == 1 && count($objDelivery) > 0) {
                        if (!empty($driver)) {
                            foreach ($driver as $value) {
                                Notification::create(array(
                                    'type_id' => Notification::PUSH,
                                    'platform_id' => Platform::ANDROID,
                                    'user_id' => $value->id,
                                    'app_id' => Config::get('app.APP_ID'),
                                    'token' => \md5(\uniqid(\time())),
                                    'description' => "{\"delivery_id\":\"{$objDelivery[0]}\",\"description\":\"Nuevo delivery\"}",
                                    'appname' => Config::get('app.APP_NAME'),
                                    'dbconfig' => Config::get('app.DB_CONFIG'),
                                    'params' => "{\"delivery_id\":\"{$objDelivery[0]}\",\"description\":\"Nuevo delivery\"}",
                                    'tosend' => $value->uuid,
                                    'to' => 'Test',
                                    'from' => 'Cligo',
                                    'flagsend' => 0,
                                    'flagactive' => 1,
                                ));
                            }
                        }
                    }
                    return array('state' => 1, 'msg' => 'ok', 'data' => array('code' => $objDelivery));
                } catch (\Exception $exc) {
                    DB::rollback();
                    return array('state' => 0, 'msg' => $exc->getMessage(), 'data' => null);
                }
            });
            return $return;
        }
        return array('state' => 0, 'msg' => 'no login', 'data' => null);
    }

    public function postTarifa(TarifaRequest $request) {
        $data = array(
            'lat_1' => $request->get('lat_1'), 'lon_1' => $request->get('lon_1'), 'lat_2' => $request->get('lat_2'),
            'lon_2' => $request->get('lon_2'), 'zone' => $request->get('zone', 'Lima'), 'calculate' => $request->get('calculate', 1),
        );

        return (array) json_decode($this->tarifa($data));
    }

    public function getExcel(ActivosRequest $request) {
        $data = (array) $request->all();
        $data['status_id'] = $request->get('status_id', 0);
        $data['complet'] = $request->get('complet', 0);
        $data['customer_id'] = Auth::customer()->user()->id;
        $url = action('Wservice\\ServiceController@listServices', $data);
        $response = \Laracurl::get($url);
        $tabla = json_decode($response->body);
        $table = (object) $tabla->data;
        return view('client.activos.excel', compact('table'));
    }

    public function getCompletados() {
        return view('client.completados.index');
    }

    public function getDetalleActivos($id) {
        if (Auth::customer()->check()) {
            $delivery = Delivery::whereId((int) $id)->whereNotIn('delivery_state_id', array(
                        DeliveryState::FINISHED, DeliveryState::RETURNED, DeliveryState::CANCELED
                    ))->first();
            if (empty($delivery))
                return redirect('admclient')->with('messageError', 'Delivery no existe');
            if (!empty($delivery->driver_id)) {
                $driver = Driver::where('drivers.id', '=', $delivery->driver_id)
                                ->join('vehicletypes', 'drivers.vehicletype_id', '=', 'vehicletypes.id')
                                ->select(array('drivers.*', DB::raw("vehicletypes.name as name_vehicle")))->first();
                if (empty($driver))
                    return redirect('admclient')->with('messageError', 'El conductor no existe');
            }
            $deliveryHistory = DeliveryHistory::whereDeliveryId($delivery->id)->get();
            $route = Route::select(DB::raw("x(coordenate) as latitude"), DB::raw("y(coordenate) as longitude"), 'flag_destino')->whereDeliveryId($delivery->id)->get();
            return view('client.activos.detalle', compact('delivery', 'driver', 'deliveryHistory', 'route'));
        }
        return redirect(self::REDIRECT_LOGIN)->with('messageError', 'Inicie sesion');
    }

    public function getActivos() {
        return view('client.activos.index');
    }

    public function postActivos(ActivosRequest $request) {
        $data = (array) $request->all();
        $data['year']=$data['year']!='0000'?$data['year']: date('Y');
        $data['month']=$data['month']!='00'?$data['month']: date('m');
        $data['status_id'] = $request->get('status_id', 0);
        $data['complet'] = $request->get('complet', 0);
        $data['customer_id'] = Auth::customer()->user()->id;
        return (array) json_decode($this->deliveries($data));
    }

    public function getTracking($id) {
        $clientCouch = CouchDb::init();
        $rev = $clientCouch->getAllRevisions($id, true);
        $doc = array();
        if (isset($rev->body['_revs_info']) && count($rev->body['_revs_info']) > 0) {
            foreach ($rev->body['_revs_info'] as $value) {
                $dataRev = $clientCouch->getDocRevisions($id, $value['rev']);
                if (isset($dataRev->body['_id'])) {
                    $doc[] = array($dataRev->body['latitude'], $dataRev->body['longitude']);
                }
            }
        }
        return array('state' => 1, 'msg' => 'ok', 'data' => $doc);
    }

    public function getTrackingLast($id) {
        $clientCouch = CouchDb::init();
        $doc = $clientCouch->findDocument($id, true);
        $docu = null;
        if (isset($doc->body['_id'])) {
            unset($doc->body['_id']);
            unset($doc->body['_rev']);
            $docu = $doc->body;
        }
        return array('state' => 1, 'msg' => 'ok', 'data' => $docu);
    }

    private function tarifa($request) {
        $url = action('Wservice\\ServiceController@deliveryPrice', array(
            'lat_1' => $request['lat_1'], 'lon_1' => $request['lon_1'], 'lat_2' => $request['lat_2'],
            'lon_2' => $request['lon_2'], 'zone' => $request['zone'], 'calculate' => $request['calculate'],
        ));
        $response = \Laracurl::get($url);
        return $response->body;
    }

    private function deliveries($request) {
        $url = action('Wservice\\ServiceController@listServices', $request);
        $response = \Laracurl::get($url);
        return $response->body;
    }

    private function days($dateFrom, $dateTo, array $days = array(2, 4)) {
        $daysWeek = array(
            Carbon::SUNDAY => 'Sunday',
            Carbon::MONDAY => 'Monday',
            Carbon::TUESDAY => 'Tuesday',
            Carbon::WEDNESDAY => 'Wednesday',
            Carbon::THURSDAY => 'Thursday',
            Carbon::FRIDAY => 'Friday',
            Carbon::SATURDAY => 'Saturday',
        );
        $returnDays = array();
        $now = Carbon::now();
        $dateFrom = Carbon::createFromTimestamp($dateFrom);
        $dateTo = Carbon::createFromTimestamp($dateTo);
        if ($dateFrom->timestamp > $dateTo->timestamp)
            throw new \Exception('Fecha final incorrecta');
        foreach ($days as $value) {
            $value = (int) $value;
            $dayWeek = "is{$daysWeek[$value]}";
            if ($now->format('Y-m-d') == $dateFrom->format('Y-m-d') &&
                    $now->timestamp <= $dateFrom->timestamp && $dateFrom->$dayWeek()) {
                $returnDays[] = $dateFrom->format('Y-m-d H:i:s');
            }
            $df = clone $dateFrom;
            $next = $df->next($value);
            while ($next->timestamp <= $dateTo->timestamp) {
                $returnDays[] = "{$next->format('Y-m-d')} {$dateFrom->format('H:i:s')}";
                $next = $df->next($value);
            }
        }
        return $returnDays;
    }

    private function saveDelivery($request) {
        $contact = Contact::find($request->get('contact_id'));
        if (empty($contact))
            throw new \Exception('Contacto invalido');
        $dataTarifa = array(
            'lat_1' => $request->get('latitude'), 'lon_1' => $request->get('longitude'), 'lat_2' => $request->get('dest_latitude'),
            'lon_2' => $request->get('dest_longitude'), 'zone' => $request->get('zone', 'Lima'), 'calculate' => $request->get('calculate', 1),
        );
        $price = json_decode($this->tarifa($dataTarifa));
        if (!isset($price->data->price))
            throw new \Exception('Precio invalido');

        $deliveryTypeId = str_replace('"', '', $request->get('delivery_type_id'));

        $datedays = array(date('Y-m-d H:i:s'));
        if ($request->get('flagservice') == 1 && $deliveryTypeId == 2) {
            $dateFrom = strtotime("{$request->get('datefrom')} {$request->get('time')}");
            $dateTo = strtotime($request->get('dateto'));
            $days = $request->get('day');
            if (count($days) == 0)
                throw new \Exception('Dias invalidos');
            $datedays = $this->days($dateFrom, $dateTo, $days);
        }
        $idDeliveries = array();
        foreach ($datedays as $val) {
            $deliveryData = array(
                'flagservice' => $request->get('flagservice'),
                'delivery_type_id' => $deliveryTypeId,
                'flagactive' => 1,
                'delivery_state_id' => Delivery::WAITING,
                'category_id' => $request->get('category_id'),
                'paymenttype_id' => $request->get('paymenttype_id'),
                'vehicletype_id' => $request->get('vehicletype_id'),
                'numberhour' => $request->get('numberhour',null),
                'flagreturn' => str_replace('"', '', $request->get('flagreturn')),
                'description' => $request->get('deli_description'),
                'customer_id' => Auth::customer()->user()->id,
                'datestart' => $val,
                'price' => $price->data->price,
                'code' => \strtoupper(\substr(\md5(\rand(11, 999)), 0, 5)),
                'pay' => $request->get('pay', null),
                'category_other' => $request->get('category_other', null),
            );
            $objDelivery = Delivery::create($deliveryData);
            $routeOriginData = array(
                'contact_id' => str_replace('"', '', $request->get('contact_id')),
                'order_route' => 1,
                'description' => $request->get('description'),
                'address' => $request->get('address'),
                'coordenate' => DB::raw("Point({$request->get('latitude')},{$request->get('longitude')})"),
                'flag_destino' => 0,
                'flagactive' => 1,
                'contact_name' => $contact->name,
                'contact_phone' => $contact->phone,
                'contact_cellphone' => $contact->cellphone,
                'contact_email' => $contact->email,
                'delivery_id' => $objDelivery->id,
            );
            Route::create($routeOriginData);
            $routeDestData = array(
                'contact_id' => null,
                'order_route' => 2,
                'description' => $request->get('dest_description'),
                'address' => $request->get('dest_address'),
                'coordenate' => DB::raw("Point({$request->get('dest_latitude')},{$request->get('dest_longitude')})"),
                'flag_destino' => 1,
                'flagactive' => 1,
                'contact_name' => $request->get('contact_name'),
                'contact_phone' => $request->get('contact_phone', ''),
                'contact_cellphone' => $request->get('contact_cellphone', ''),
                'contact_email' => str_replace('"', '', $request->get('contact_email')),
                'delivery_id' => $objDelivery->id,
            );
            Route::create($routeDestData);
            $idDeliveries[] = isset($objDelivery->id) ? $objDelivery->id : 0;
//                    $idDeliveries[] = isset($objDelivery->code)?$objDelivery->code:'XXX';
        }
//                $idDeliveriesString = implode('::', $idDeliveries);
        return $idDeliveries;
    }

}
