<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Datatables;
use App\Http\Requests\Client\FormCustomerRequest;
use App\Http\Requests\Client\FormContactRequest;
use App\Models\Customer;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Auth;
use Hash;

class UserController extends Controller {

    const NAMEC = 'user';

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

    public function getForm($id = null) {
        $table = new Customer();
        if (!empty($id)) {
            $table = Customer::find($id);
        }
        return viewc('client.' . self::NAMEC . '.form', compact('table', 'id'));
    }

    public function getInsert($id = null) {
        $table = new Customer();
        if (!empty($id)) {
            $table = Customer::find($id);
        }
        return viewc('client.' . self::NAMEC . '.insert', compact('table', 'id'));
    }

    public function postInsert(FormCustomerRequest $request) {
        if (!empty($request)) {
            $data = $request->all();
            $data['company_id'] = 1;
             $data['type'] = 2;
            $data['flagactive'] = $request->get('flagactive', 1);
            unset($data['password']);
            $password = $request->get('password', null);
            if (!empty($password)) {
                $data['password'] = Hash::make($request->get('password'));
            }
            Customer::create($data);
            return redirect('admclient/' . self::NAMEC)->with('messageSuccess', 'Perfil Guardado');
        }
        return redirect('admclient')->with('messageError', 'Error al guardar el perfil');
    }

    public function postForm(FormCustomerRequest $request) {
        if (!empty($request)) {
            $data = $request->all();
//            $data['flagactive'] = $request->get('flagactive', 1);
            $id = $data['id'];
            unset($data['password']);
            $password = $request->get('password', null);
            if (!empty($password)) {
                $data['password'] = Hash::make($request->get('password'));
            }
            if ($id) {
                $obj = Customer::find($id);
                $obj->update($data);
            }
            return redirect('admclient/' . self::NAMEC . '/form/' . $id)->with('messageSuccess', 'Perfil Guardado');
        }
        return redirect('admclient')->with('messageError', 'Error al guardar el perfil');
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
            $data['customer_id'] = $request->get('customer_id', 1);
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

    public function getListEquipment(Request $request) {
        $idCustomer = $request->input('idCustomer', null);
        $table = Equipment::select(['id', 'name', 'phone', 'cellphone'])
                ->whereCustomerId($idCustomer);
        $datatable = Datatables::of($table)
                ->addColumn('action', function($table) {
            return '<a href="' . $table->id . '" class="btn btn-warning">Editar</a>
                    
                        <a href="#" data-url="/admclient/' . self::NAMEC . '/delete/' . $table->id . '" class="btn btn-danger action_delete" data-id="' . $table->id . '" >Eliminar</a>';
        })
        ;
        return $datatable->make(true);
    }

    public function getList() {
        $table = Customer::select(['id', 'name_customer', 'email'])->where('type','=','2');
        $datatable = Datatables::of($table)
                ->addColumn('action', function($table) {
            return '<a href="' . $table->id . '" class="btn btn-warning">Editar</a>
                        <a href="#" data-url="/admclient/' . self::NAMEC . '/delete/' . $table->id . '" class="btn btn-danger action_delete" data-id="' . $table->id . '" >Eliminar</a>';
        })
        ;
        return $datatable->make(true);
    }

    public function getDeleteEquipment($id) {
        $table = null;
        if (!empty($id)) {
            $table = Equipment::whereId($id);
            $table->delete();
        }
        return response()->json(array('msg' => 'ok', 'state' => 1, 'data' => null));
    }

    public function getDelete($id) {
        $table = null;
        if (!empty($id)) {
            $table = Customer::whereId($id);
            $table->delete();
        }
        return response()->json(array('msg' => 'ok', 'state' => 1, 'data' => null));
    }

}
