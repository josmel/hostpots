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


    public function getConfiguracion($idEquipment = null) {
        $typeCampania = Campania::where('flagactive', '=', '1')
                        ->whereCustomerId(Auth::customer()->user()->id)->lists('name', 'id');
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
            $data['geocode'] = Auth::customer()->user()->id;
            if ($request->id) {
                $obj = Hostpots::find($request->id);
                $obj->update($data);
            }
            return array('msg' => 'ok', 'state' => 1, 'data' => null);
        }
        return array('msg' => 'Error al guardar el modelo', 'state' => 0, 'data' => null);
    }

    public function getList() {
//        $idGroup = $request->input('idGroup', 0);
//        $table = Hostpots::select(['id', 'name', 'mac', 'owner','email_owner'])
            $table = Hostpots::select(['id', DB::raw("(if(manager='1','Activo',(if(manager='0','Inactivo','-')))) as manager"),'email_owner','name'])
                ->whereGeocode(Auth::customer()->user()->id);
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
        }
        return response()->json(array('msg' => 'ok', 'state' => 1, 'data' => null));
    }

}
