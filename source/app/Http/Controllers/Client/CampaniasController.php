<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller,
 Datatables,
 App\Models\Customer,
  Illuminate\Http\Request,
 Config,
 Auth,
 App\Http\Requests\Client\FormCampaniaRequest,
 App\Models\Campania,
 DB;

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
            $table->imagen = !empty($table->imagen) ? "{$table->imagen}" : null;
            
        }

        return viewc('client.' . self::NAMEC . '.form', compact('table'));
    }

    public function postForm(FormCampaniaRequest $request) {

        if (!empty($request)) {
            $data = $request->all();
            if ($request->file('imagen')) {          
                $imageFile = $request->file('imagen');
                $destinationPath = Config::get('app.DINAMIC_PATH') . '/campania';
                $fileName = date('Ymdhis') . rand(1, 1000) . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move($destinationPath, $fileName);
                $data['imagen'] = '/dinamic/campania/' . $fileName;
            }
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

     public function getCampaniasFree() {
        try {
           $dataCampania= Campania::whereNull('customer_id')->lists('name', 'id');
            $return = array('state' => 1, 'msg' => 'ok', 'data' => $dataCampania);
        } catch (Exception $exc) {
            $return = array('state' => 0, 'msg' => $exc->getMessage());
        }
        return response()->json($return);
    }
       public function getInsertFree(Request $request) {
        $customer_id = $request->input('customer_id');
        $campania_id = json_decode($request->input('campania_id'), true);
        try {
            $data['customer_id'] = $customer_id;
            foreach ($campania_id as $id) {
               $objCampania = Campania::find($id);
                $objCampania->update($data);
            }
            $return = array('state' => 1, 'msg' => 'ok', 'data' => array());
        } catch (Exception $exc) {
            $return = array('state' => 0, 'msg' => $exc->getMessage());
        }
        return response()->json($return);
    }
    public function getLidddst(Request $request) {
        $table = Promotion::select('image', 'title', 'description', 'begin_date', 'end_date', 'id');
        $datatable = Datatables::of($table)
                ->editColumn('image', '<img src="{{$image}}" heigth=64" width="64" />')
                ->editColumn('begin_date', '{{ date("d/m/Y H:i:s", strtotime($begin_date)) }}')
                ->editColumn('end_date', '{{ date("d/m/Y H:i:s", strtotime($end_date)) }}')
                ->addColumn('action', function($table) {
            return '<a href="/admpanel/' . self::NAMEC . '/form/' . $table->id . '" class="btn btn-warning">Editar</a>
                            <a href="#" data-url="/admpanel/' . self::NAMEC . '/delete/' . $table->id . '" class="btn btn-danger action_delete"  data-id="' . $table->id . '" >Eliminar</a>';
        })
        ;

        return $datatable->make(true);
    }
    
   public function getList(Request $request) {
       $idCustomer = $request->input('idCustomer', Auth::customer()->user()->id);
        $table = Campania::leftJoin('customers', 'campania.customer_id', '=', 'customers.id')
                ->select(['campania.id', 'customers.name_customer as cliente', 'campania.name', 'campania.url', 'campania.expiracion', 'campania.megas', 'campania.imagen',
                    DB::raw("(if(campania.flagactive='1','Activo',(if(campania.flagactive='0','Inactivo','-')))) as flagactive")]);
        if ($idCustomer!=0) {
               $table = $table->whereCustomerId($idCustomer);
        }
           $table->orderBy('campania.id', 'desc');
        $datatable = Datatables::of($table)
                ->editColumn('imagen', '<a target="_blank" href="{{$imagen}}"><img src="{{$imagen}}" heigth=64" width="64" /></a>')
                ->addColumn('action', function($table) {
            return '<a href="' . $table->id . '" class="btn btn-warning">Editar</a>
                        <a href="#" data-url="/admclient/' . self::NAMEC . '/delete/' . $table->id . '" class="btn btn-danger action_delete" data-id="' . $table->id . '" >Eliminar</a>';
        })
        ;
        return $datatable->make(true);
    }

    public function getDelete($id,$CustomerId=null) {
        if($CustomerId==null){
            $CustomerId=Auth::customer()->user()->id;
        }
        $table = null;
        if (!empty($id)) {
            $table = Campania::whereId($id)->whereCustomerId($CustomerId);
            $table->delete();
        }
        return response()->json(array('msg' => 'ok', 'state' => 1, 'data' => null));
    }

}
