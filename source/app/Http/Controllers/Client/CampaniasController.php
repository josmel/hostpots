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
use App\Http\Requests\Client\FormCampaniaRequest;
use App\Models\Campania;
use DB;

class CampaniasController extends Controller {

    const NAMEC = 'campanias';

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
        $table = new Campania();
        if (!empty($id)) {
            $table = Campania::find($id);
        }

        return viewc('client.' . self::NAMEC . '.form', compact('table'));
    }

    public function postForm(FormCampaniaRequest $request) {

        if (!empty($request)) {
            $data = $request->all();
            $data['flagactive'] = $request->get('flagactive', 1);
            if ($request->id) {
                $obj = Campania::find($request->id);
                $obj->update($data);
            } else {
                $data['customer_id']=Auth::customer()->user()->id;
                $obj = Campania::create($data);
            }
            return redirect('admclient/' . self::NAMEC)->with('messageSuccess', 'Caracteristicas Guardado');
        }
        return redirect('admclient')->with('messageError', 'Error al guardar la region');
    }

    public function getList() {
        $table = Campania::select(['id', 'name', 'description',
                    DB::raw("(if(flagactive='1','Activo',(if(flagactive='0','Inactivo','-')))) as flagactive")])
               ->whereCustomerId(Auth::customer()->user()->id);
        ;

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
            $table = Campania::whereId($id)->whereCustomerId(Auth::customer()->user()->id);
            $table->delete();
        }
        return response()->json(array('msg' => 'ok', 'state' => 1, 'data' => null));
    }

}
