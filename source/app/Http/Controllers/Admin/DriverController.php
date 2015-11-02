<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Delivery;
use App\Models\DriverState;
use App\Models\Vehicletype;
use Illuminate\Http\Request;
use Datatables;
use DB;
use Validator;
use Hash;

class DriverController extends Controller {

    const NAMEC = 'driver';

    public function __construct() {
        $this->middleware('authadmin');
    }

    public function getIndex() {
        return viewc('admin.' . self::NAMEC . '.index');
    }

    public function getForm($id = null) {
        $typeDriverState = DriverState::where('flagactive', '=', '1')->lists('name', 'id');
        $typeDriverState = [null => 'Please select one option'] + $typeDriverState;
        $Vehicletype = Vehicletype::where('flagactive', '=', '1')->lists('name', 'id');
        $Vehicletype = [null => 'Please select one option'] + $Vehicletype;
        $msgform = 'Contraseña';
        if (!empty($id)) {
            $data = Driver::find($id);
            $msgform = 'Contraseña(dejar en blanco si no ha de cambiar)';
            $data->picture = !empty($data->picture) ? "{$data->picture}" : null;
        }
        if (!isset($data)) {
            $data = new Driver();
        }

        return viewc('admin.' . self::NAMEC . '.form', compact('data', 'msgform'), ['Vehicletype' => $Vehicletype, 'typeDriverState' => $typeDriverState]);
    }

    public function postForm(Request $request) {
        $id = $request->input('id');
        $password = $request->get('password', null);
        $pathImage = $request->get('picture', null);
        if ($request->hasfile('picture')) {
            $validator = Validator::make($request->all(), [
                        'picture' => ['mimes:jpg,png,jpeg'],
            ]);
            if ($validator->fails()) {
                return redirect(action('Admin\DriverController@postForm'))->withErrors($validator)
                                ->withInput();
            }
            $file = $request->file('picture');
            $nameimage = date('YmdHis') . rand(1, 1000) . "." . $file->getClientOriginalExtension();
            $file->move(public_path() . "/dinamic/driver/", $nameimage);
            $pathImage = "/dinamic/driver/" . $nameimage;
        }
        if (isset($id) && $id != '') {
            $data = $request->except(array('email', 'password'));
            $runtime = Driver::find($id);
            $runtime->fill($data);
            $runtime->picture = $pathImage;
            $runtime->password = $runtime->password;
            if (!empty($password)) {
                $runtime->password = Hash::make($password);
            }
            $runtime->save();
            $msg = 'Usuario Editado!';
        } else {
            $data = $request->all();
            $validator = Validator::make($data, [
                        'email' => ['unique:drivers,email,NULL,id,flagactive,1', 'email'],
            ]);
            if ($validator->fails()) {
                return redirect(action('Admin\DriverController@postForm'))->withErrors($validator)
                                ->withInput();
            }
            $data['picture'] = $pathImage;
            $data['password'] = Hash::make($password);
            $id = Driver::create($data)->id;
            $msg = 'Usuario Guardado!';
        }

        return redirect(action('Admin\DriverController@getIndex'))->with('messageSuccess', $msg);
    }

    public function getList(Request $request) {
        $table = DB::table('drivers')
                ->join('vehicletypes', 'drivers.vehicletype_id', '=', 'vehicletypes.id')
                ->join('driver_states', 'drivers.driver_state_id', '=', 'driver_states.id')
                ->select('drivers.id', DB::raw("(if(drivers.flagactive='1','Activo',(if(drivers.flagactive='0','Inactivo','-')))) as flagactive"), 
                        DB::raw("(if(drivers.flagactive='1','Inactivar',(if(drivers.flagactive='0','Activar','-')))) as estado"),
                        'drivers.placa_vehicle as placa_vehicle', 'drivers.picture','drivers.dni', 
                        'drivers.namedriver', 'drivers.lastname as lastname', 'vehicletypes.name as vehicletype', 
                        'driver_states.name as driver_state')
                ->whereNull('drivers.datedelete')
//                ->where('drivers.flagactive', '=', 1)
                ->orderBy('drivers.datecreate', 'desc');
        $datatable = Datatables::of($table)
                ->addColumn('picture', '<img src="{{Request::root()}}{{$picture}}" class = "image-datatable"  width="70" height="70">')
                ->addColumn('action', function($table) {
            return '<a href="/admpanel/' . self::NAMEC . '/form/' . $table->id . '" class="btn btn-warning">Editar</a>
                                <a href="#" data-url="/admpanel/' . self::NAMEC . '/invalidar/' . $table->id . '" class="btn btn-danger action_delete" data-status="' . $table->estado . '" data-id="' . $table->id . '" >' . $table->estado . '</a>';

//<a href="#" data-url="/admpanel/' . self::NAMEC . '/delete/' . $table->id . '" class="btn btn-danger action_delete"  data-id="' . $table->id . '" >Eliminar</a>';
        });
        if ($keyword = $request->get('search')['value']) {
            
            $datatable->filterColumn('picture', 'whereRaw', "drivers.picture like ?", ["%{$keyword}%"]);
            $datatable->filterColumn('namedriver', 'whereRaw', "drivers.namedriver like ?", ["%{$keyword}%"]);
             $datatable->filterColumn('dni', 'whereRaw', "drivers.dni like ?", ["%{$keyword}%"]);
            $datatable->filterColumn('vehicletype', 'whereRaw', "vehicletypes.name like ?", ["%{$keyword}%"]);
            $datatable->filterColumn('driver_state', 'whereRaw', "driver_states.name like ?", ["%{$keyword}%"]);
            $datatable->filterColumn('estado', 'whereRaw', "drivers.flagactive like ?", ["%{$keyword}%"]);
             $datatable->filterColumn('flagactive', 'whereRaw', "drivers.flagactive like ?", ["%{$keyword}%"]);
        }
        return $datatable->make(true);
    }

    public function getInvalidar($id) {
        $table = null;
        if (!empty($id)) {
            $table = Driver::whereId($id);
            $user = DB::table('drivers')->where('id', $id)->first();
            if ($user->flagactive == '0') {
                $data = array('id' => $id, 'flagactive' => '1');
            } else {
                $data = array('id' => $id, 'flagactive' => '0');
            }
            $table->update($data);
        }
        return response()->json('true');
    }

//    public function getDelete($id) {
//        $table = null;
//        if (!empty($id)) {
//            $table = Driver::find($id);
//            $table->delete();
//        }
//        return response()->json('true');
//    }
    public function getDelete($id) {
        if (!empty($id)) {
            Delivery::where('driver_id', $id)->forceDelete();
            DB::table('drivers')->where('id', '=', $id)->delete();
        }
        return response()->json('true');
    }

}
