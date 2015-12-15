<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller,
    Datatables,
    App\Http\Requests\Client\FormContactRequest,
    App\Http\Requests\Client\FormSettingRequest,
    App\Models\Day,
    Illuminate\Http\Request,
    App\Models\Hostpots,
    App\Models\Setting,
    App\Models\EquipmentCampania,
    App\Models\Campania,
    App\Models\GroupsCampania,
    App\Models\HotspotsCampania,
    DB,
    Auth;

class EquipmentController extends Controller {

    const NAMEC = 'equipment';

    public function getIndex($idGroup = null) {
        return viewc('client.' . self::NAMEC . '.index', compact('table', 'idGroup'));
    }

    public function getConfiguracion($idEquipment = null, $idCustomer = null) {
        
       $dataHotspots= Hostpots::find($idEquipment);
        if ($dataHotspots->customer_id == 0) {
            $typeCampania = Campania::where('flagactive', '=', '1')
                            ->whereCustomerId(null)->lists('name', 'id');
        } else{
          if ($idCustomer == null) {
            $idCustomer = Auth::customer()->user()->id;
        }
        $typeCampania = Campania::where('flagactive', '=', '1')
                        ->whereCustomerId($idCustomer)->lists('name', 'id');  
        }
        
//        $typeCampania = [null => 'Por favor seleccione una opción'] + $typeCampania;
        $table = new GroupsCampania();
        $datos = HotspotsCampania::whereHotspotsId($idEquipment)->get();
        if (!empty($datos)) {
            if (!empty($datos->toArray())) {
                $table = HotspotsCampania::find($datos[0]->id);
            }
        }
        return viewc('client.' . self::NAMEC . '.configuracion', compact('idEquipment', ['table']), ['typeCampania' => $typeCampania]);
    }

    public function postConfiguracion(Request $request) {
        $data = $request->all();
        HotspotsCampania::whereHotspotsId($data['hotspots_id'])->forceDelete();
        HotspotsCampania::create($data);
        echo nl2br("\r\n\r\n\r\n\r\nCONFIGURACION GUARDADA CORRECTAMENTE", false);
        exit;
    }

    public function getEquipmentsFree(Request $request) {
        $groups_id = $request->input('groups_id');
        if (isset($groups_id) && !empty($groups_id)) {
            $dataGroup = \App\Models\Groups::find($groups_id);
            if ($dataGroup->customer_id != 0) {
                $newHostPots = new Hostpots();
                $data = $newHostPots->listHotspots($dataGroup->customer_id, 'name');
                foreach ($data as $value => $e) {
                    $dataInt[] = $value;
                }
            }
        }
        $HotsPotsGroups = DB::select("select DISTINCT H.id from hotspots as H "
                        . "inner join hotspots_groups as HG ON H.id=HG.hotspots_id ");
        if (isset($dataInt) && count($dataInt) > 0) {
            if ($HotsPotsGroups) {
                foreach ($HotsPotsGroups as $value) {
                    $idHotspots[] = $value->id;
                }
                $Hostpots = Hostpots::whereNotIn('id', $idHotspots)->
                                whereIn('id', $dataInt)
                                ->orWhere('geocode', 0)->lists('mac', 'id');
            } else {
                $Hostpots = Hostpots::whereIn('id', $dataInt)->whereIn('id', $dataInt)
                                ->orWhere('geocode', 0)->lists('mac', 'id');
            }
        } else {
            if ($HotsPotsGroups) {
                foreach ($HotsPotsGroups as $value) {
                    $idHotspots[] = $value->id;
                }
                $Hostpots = Hostpots::whereNotIn('id', $idHotspots)->whereGeocode(0)->lists('mac', 'id');
            } else {
                $Hostpots = Hostpots::whereGeocode(0)->lists('mac', 'id');
            }
        }
        return response()->json(array('state' => 1, 'msg' => 'ok', 'data' => $Hostpots));
    }

    public function getInsertFree(Request $request) {
        $customer_id = $request->input('customer_id');
        $hotspots_id = json_decode($request->input('hotspots_id'), true);
        try {
            $data['geocode'] = $customer_id;
            foreach ($hotspots_id as $id) {
                $objGroup = Hostpots::find($id);
                $objGroup->update($data);
            }
            $return = array('state' => 1, 'msg' => 'ok', 'data' => array());
        } catch (Exception $exc) {
            $return = array('state' => 0, 'msg' => $exc->getMessage());
        }
        return response()->json($return);
    }

    public function getForm($id) {
        $idProceso = explode('-', $id);
        $equipment_id = $idProceso[0];
        $typeCampania = Campania::where('flagactive', '=', '1')
                        ->whereCustomerId(Auth::customer()->user()->id)->lists('name', 'id');
        $typeCampania = [null => 'Por favor seleccione una opción'] + $typeCampania;
        $table = new EquipmentCampania();
        if (isset($idProceso[1])) {
            $table = EquipmentCampania::find($idProceso[1]);
            $Setting = Setting::whereEquipmentCampaniaId($idProceso[1])->lists('day_id');
            $table->day_id = $Setting;
        }
        $day = Day::all();
        return viewc('client.' . self::NAMEC . '.form', compact('equipment_id', ['table', 'day']), ['typeCampania' => $typeCampania]);
    }

    public function postForm(FormSettingRequest $request) {
        if (!empty($request)) {
            $data = $request->all();
            if ($request->id) {
                $obj = EquipmentCampania::find($request->id);
                $obj->update($data);
                Setting::whereEquipmentCampaniaId($obj->id)->forceDelete();
                $idEquipmentCampania = $request->id;
            } else {
                $obj = EquipmentCampania::create($data);
                $idEquipmentCampania = $obj->id;
            }
            foreach ($data['day_id'] as $value) {
                Setting::create(array(
                    'equipment_campania_id' => $idEquipmentCampania,
                    'day_id' => $value,
                    'flagactive' => 1,
                ));
            }
            return redirect('admclient/' . self::NAMEC . '/detalle-campania/' . $data['equipment_id'])->with('messageSuccess', 'Campaña configurada correctamente');
        }
        return redirect('admclient/' . self::NAMEC . '/form/' . $data['equipment_id'])->with('messageError', 'Error al configurar campaña');
    }

    public function getDetalleCampania($equipment_id = null) {
        return viewc('client.' . self::NAMEC . '.detalle-campania', ['equipment_id' => $equipment_id]);
    }

    public function postContact(FormContactRequest $request) {
        if (!empty($request)) {
            $data = $request->all();
            if (empty($data['customer_id'])) {
                $data['geocode'] = '0';
            } else {
                $data['geocode'] = $request->input('customer_id');
            }
            if ($request->id) {
                $obj = Hostpots::find($request->id);
                $obj->update($data);
            } else {
//                if ($request->input('customer_id')) {
                if (Auth::customer()->user()->type != 2) {
                    $data['manager'] = "1";
                    $obj = Hostpots::create($data);
                } else {
                    return array('msg' => 'Error al guardar el modelo', 'state' => 0, 'data' => null);
                }
            }
            return array('msg' => 'ok', 'state' => 1, 'data' => null);
        }
        return array('msg' => 'Error al guardar el modelo', 'state' => 0, 'data' => null);
    }

    public function getList(Request $request) {

        $idUser = $request->input('user', Auth::customer()->user()->id);

        $table = Hostpots::leftJoin('customers', 'hotspots.geocode', '=', 'customers.id')
                ->select(['hotspots.id', 'hotspots.geocode', 'hotspots.mac', 'customers.name_customer as cliente', 'hotspots.owner', DB::raw("(if(hotspots.manager='1','Activo',(if(hotspots.manager='0','Inactivo','-')))) as manager"), 'hotspots.email_owner', 'hotspots.name']);
        if ($idUser != 0) {
            $table = $table->whereGeocode($idUser);
        }
        $table->orderBy('hotspots.id', 'desc');
        $datatable = Datatables::of($table)
                ->addColumn('action', function($table) {
            return '<a href="' . $table->id . '" class="btn btn-warning">Editar</a>
                    
                        <a href="#" data-url="/admclient/' . self::NAMEC . '/delete/' . $table->id . '" class="btn btn-danger action_delete" data-id="' . $table->id . '" >Eliminar</a>';
        })
        ;
        return $datatable->make(true);
    }

    public function getDelete($id) {
        $table = null;
        if (!empty($id)) {
            $table = Hostpots::whereId($id);
            $table->delete();
            \App\Models\HotspotsGroups::whereHotspotsId($id)->delete();
        }
        return response()->json(array('msg' => 'ok', 'state' => 1, 'data' => null));
    }

}
