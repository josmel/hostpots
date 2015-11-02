<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Datatables;
use App\Http\Requests\Client\FormCustomerRequest;
use App\Http\Requests\Client\FormContactRequest;
use App\Models\Customer;
use App\Models\Contact;
use Auth;
use Hash;

class ClientController extends Controller {
        
    const NAMEC = 'client';

    public function getIndex() {
        if(Auth::customer()->check()){
            $id = Auth::customer()->user()->id;
            $table = new Customer();
            if (!empty($id)) {
                $table = Customer::find($id);
            }
            return viewc('client.'.self::NAMEC.'.index', compact('table'));
        }
        return redirect('login')->with('messageError', 'Inicie sesion');
    }

    
    public function postIndex(FormCustomerRequest $request) {
        if (!empty($request)) {
            $data = $request->except('credit');
//            $data['flagactive'] = $request->get('flagactive', 1);
            $id = Auth::customer()->user()->id;
            unset($data['password']);
            $password = $request->get('password',null);
            if(!empty($password)){
                $data['password'] = Hash::make($request->get('password'));
            }
            if ($id) {
                $obj = Customer::find($id);
                $obj->update($data);
            }
            return redirect('admclient/'.self::NAMEC)->with('messageSuccess', 'Perfil Guardado');
        }
        return redirect('admclient')->with('messageError', 'Error al guardar el perfil');
    }
    
    public function postContact(FormContactRequest $request)
    {
        if (!empty($request)) {
            $data = $request->all();
            $data['customer_id'] = Auth::customer()->user()->id;
            $data['flagactive'] = $request->get('flagactive', 1);
            if ($request->id) {
                    $obj = Contact::find($request->id);
                    $obj->update($data);
            } else {
                    $obj = Contact::create($data);
            }
            return array('msg'=>'ok','state'=>1,'data'=>null);
        }
        return array('msg'=>'Error al guardar el modelo','state'=>0,'data'=>null);
    }

    public function getList() {
        $table = Contact::select(['id','name','phone','cellphone','email'])
                ->whereCustomerId(Auth::customer()->user()->id);
        $datatable = Datatables::of($table)
            ->addColumn('action', function($table){
                return '<a href="'.$table->id.'" class="btn btn-warning">Editar</a>
                        <a href="#" data-url="/admclient/'.self::NAMEC.'/delete/'.$table->id.'" class="btn btn-danger action_delete" data-id="' .$table->id.  '" >Eliminar</a>';})
            ;
        return $datatable->make(true);
    }

    
    
    public function getDelete($id) {
        $table = null;
        if (!empty($id)) {
                $table = Contact::whereId($id)->whereCustomerId(Auth::customer()->user()->id);
                $table->delete();
        }
        return response()->json(array('msg'=>'ok','state'=>1,'data'=>null));
    }
}
