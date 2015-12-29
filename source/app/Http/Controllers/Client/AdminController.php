<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Datatables;
use App\Http\Requests\Client\FormCustomerRequest;
use App\Models\Customer;
use Auth;
use Hash;

class AdminController extends Controller {

    const NAMEC = 'admin';

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
        $admin = new Customer();
        if (!empty($id)) {
            $admin = Customer::find($id);
        }
        return viewc('client.' . self::NAMEC . '.form', compact('admin', 'id'));
    }
    
      public function postForm(FormCustomerRequest $request) {
        if (!empty($request)) {
            $data = $request->all();
            $data['company_id'] = 1;
            $data['type'] = 3;
            $data['flagactive'] = $request->get('flagactive', 1);
            unset($data['password']);
            $password = $request->get('password', null);
            if (!empty($password)) {
                $data['password'] = Hash::make($request->get('password'));
            }
             if ($request->id) { 
                $obj = Customer::find($request->id);
                $obj->update($data);
            } else {
                $obj = Customer::create($data);
            }
            return redirect('admclient/' . self::NAMEC)->with('messageSuccess', 'Perfil Guardado');
        }
        return redirect('admclient')->with('messageError', 'Error al guardar el perfil');
    }
   

  
     public function getList() {
        $table = Customer::select(['id', 'name_customer', 'email'])->where('type', '=', '3');
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
            $table = Customer::whereId($id);
            $table->delete();
        }
        return response()->json(array('msg' => 'ok', 'state' => 1, 'data' => null));
    }

}
