<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller,
    Datatables,
    App\Http\Requests\Client\FormContactRequest,
    App\Models\Day,
    Illuminate\Http\Request,
    App\Models\Hostpots,
    App\Models\Campania,
    App\Models\SettingHotspots,
    App\Models\GroupsCampania,
    App\Models\HotspotsCampania,
    DB,
    Auth;

class EquipmentController extends Controller {

    const NAMEC = 'equipment';

    public function getIndex($idGroup = null) {
        return viewc('client.' . self::NAMEC . '.index', compact('table', 'idGroup'));
    }

    public function getUno() {
        return viewc('client.' . self::NAMEC . '.uno');
    }

    public function getDos() {
        return viewc('client.' . self::NAMEC . '.dos');
    }

    public function getCampaniasForUser($idCustomer = null) {
        try {
            if ($idCustomer == null) {
                $idCustomer = Auth::customer()->user()->id;
            }
            $dataCampania = Campania::whereCustomerId($idCustomer)->get()->toArray();
            $return = array('state' => 1, 'msg' => 'ok', 'data' => $dataCampania);
        } catch (Exception $exc) {
            $return = array('state' => 0, 'msg' => $exc->getMessage());
        }
        return response()->json($return);
    }

    public function getConfiguracion($idEquipment = null, $idCustomer = null) {
        $dataHotspots = Hostpots::find($idEquipment);
        if ($idCustomer == null) {
            $idCustomer = Auth::customer()->user()->id;
        }
        $dataCampania = Campania::whereCustomerId($idCustomer)->get()->toArray();
        if ($dataHotspots->geocode == 0) {
            $typeCampania = Campania::where('flagactive', '=', '1')
                            ->whereCustomerId(null)->lists('name', 'id');
        } else {
            if ($idCustomer == null) {
                $idCustomer = Auth::customer()->user()->id;
            }
            $typeCampania = Campania::where('flagactive', '=', '1')
                            ->whereCustomerId($idCustomer)->lists('name', 'id');
        }
        $datos = HotspotsCampania::join('campania as c', 'c.id', '=', 'hotspots_campania.campania_id')->
                        select('hotspots_campania.day_id')->
                        where('hotspots_campania.hotspots_id', '=', $idEquipment)->get()->toArray();
        foreach ($datos as $value) {
            $dd[] = $value['day_id'];
        }
        $day = Day::all();
        foreach ($day as $d) {
            $checked = in_array($d->id, $dd);
            if ($checked) {
                $datos = HotspotsCampania::join('campania as c', 'c.id', '=', 'hotspots_campania.campania_id')->
                                select('c.*', 'hotspots_campania.*')->
                                where('hotspots_campania.hotspots_id', '=', $idEquipment)->
                                where('hotspots_campania.day_id', '=', $d->id)->first();
                $d->campania_id = $datos->campania_id;
                $d->campania_name = $datos->name;
                $d->campania_imagen = $datos->imagen;
            }
        }
        return viewc('client.' . self::NAMEC . '.configuracion', compact('idEquipment', ['datos', 'dataCampania', 'day', 'idCustomer']), ['typeCampania' => $typeCampania]);
    }

    public function postConfiguracion(Request $request) {
        $data = $request->all();
        HotspotsCampania::whereHotspotsId($data['hotspots_id'])->forceDelete();
        $obj = HotspotsCampania::create($data);
        SettingHotspots::whereHotspotsCampaniaId($obj->id)->forceDelete();
        if (isset($data['day_id'])) {
            foreach ($data['day_id'] as $value) {
                SettingHotspots::create(array(
                    'hotspots_campania_id' => $obj->id,
                    'day_id' => $value,
                    'flagactive' => 1,
                ));
            }
        }

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
