<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Datatables;
use App\Http\Requests\Client\FormCustomerRequest;
use App\Http\Requests\Client\FormContactRequest;
use App\Http\Requests\Client\FormSettingRequest;
use App\Models\Customer;
use App\Models\Day;
use Illuminate\Http\Request;
use App\Models\Equipment;
use App\Models\Setting;
use App\Models\EquipmentCampania;
use App\Models\Campania;
use Auth;
use Hash;

class EquipmentController extends Controller {

    const NAMEC = 'equipment';

    public function getIndex() {
        if (Auth::customer()->check()) {
            $id = Auth::customer()->user()->id;
            $table = new Customer();
            if (!empty($id)) {
                $table = Customer::find($id);
            }
            return viewc('client.' . self::NAMEC . '.index', compact('table'));
        }
        return redirect('login')->with('messageError', 'Inicie sesion');
    }

    public function getForm($equipment_id, $id = null) {
        $typeCampania = Campania::where('flagactive', '=', '1')
                        ->whereCustomerId(Auth::customer()->user()->id)->lists('name', 'id');
        $typeCampania = [null => 'Por favor seleccione una opción'] + $typeCampania;
        $table = new EquipmentCampania();
       
        if (!empty($id)) {
             $table = EquipmentCampania::find($id);
            $Setting = Setting::whereEquipmentCampaniaId($id)->lists('day_id');
            $table->day_id = $Setting;
        }
        $day = Day::all();
        return viewc('client.' . self::NAMEC . '.form', compact('table', 'day', 'equipment_id'), ['typeCampania' => $typeCampania]);
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

    public function postIndex(FormCustomerRequest $request) {
        if (!empty($request)) {
            $data = $request->except('credit');
//            $data['flagactive'] = $request->get('flagactive', 1);
            $id = Auth::customer()->user()->id;
            unset($data['password']);
            $password = $request->get('password', null);
            if (!empty($password)) {
                $data['password'] = Hash::make($request->get('password'));
            }
            if ($id) {
                $obj = Customer::find($id);
                $obj->update($data);
            }
            return redirect('admclient/' . self::NAMEC)->with('messageSuccess', 'Perfil Guardado');
        }
        return redirect('admclient')->with('messageError', 'Error al guardar el perfil');
    }

    public function postContact(FormContactRequest $request) {
        if (!empty($request)) {
            $data = $request->all();
//            dd($data);exit;
            $data['customer_id'] = Auth::customer()->user()->id;
            $data['flagactive'] = $request->get('flagactive', 1);
            if ($request->id) {
                $obj = Equipment::find($request->id);
                $obj->update($data);
            } else {
                $obj = Equipment::create($data);
            }
            return array('msg' => 'ok', 'state' => 1, 'data' => null);
        }
        return array('msg' => 'Error al guardar el modelo', 'state' => 0, 'data' => null);
    }

    public function getListDetalleCampania(Request $request) {
        $idEquipments = $request->input('equipment_id', null);
        $table = EquipmentCampania::
                join('equipments', 'equipment_campania.equipment_id', '=', 'equipments.id')
                ->join('campania', 'equipment_campania.campania_id', '=', 'campania.id')
                ->select('equipment_campania.id', 'campania.name as nameCampania', 'equipments.name as nameEquipment')
                ->Where('equipments.customer_id', '=', Auth::customer()->user()->id)
                ->Where('equipments.id', '=', $idEquipments)
        ;
        $datatable = Datatables::of($table);
        return $datatable->make(true);
    }

    public function getList() {
        $table = Equipment::select(['id', 'name', 'phone', 'cellphone'])
                ->whereCustomerId(Auth::customer()->user()->id);
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
            $table = Equipment::whereId($id)->whereCustomerId(Auth::customer()->user()->id);
            $table->delete();
        }
        return response()->json(array('msg' => 'ok', 'state' => 1, 'data' => null));
    }

}
