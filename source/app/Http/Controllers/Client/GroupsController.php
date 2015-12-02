<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Datatables;
use App\Http\Requests\Client\FormCustomerRequest;
use App\Http\Requests\Client\FormEquipmenteAdminRequest;
use App\Http\Requests\Client\FormGroupsRequest;
use App\Models\Customer;
use App\Models\Equipment;
use App\Models\Campania;
use App\Models\Groups;
use Illuminate\Http\Request;
use App\Models\GroupsCampania;
use App\Models\Radgroupreply;
use App\Models\Hostpots;
use Auth;
use DB;
use Hash;

class GroupsController extends Controller {

    const NAMEC = 'groups';

    public function getConfiguracion($idGroups = null) {
        $typeCampania = Campania::where('flagactive', '=', '1')
                        ->whereCustomerId(Auth::customer()->user()->id)->lists('name', 'id');
//        $typeCampania = [null => 'Por favor seleccione una opción'] + $typeCampania;
        $table = new GroupsCampania();
        $datos = GroupsCampania::whereGroupsId($idGroups)->get();
        if (!empty($datos)) {
            if (!empty($datos->toArray())) {
                $table = GroupsCampania::find($datos[0]->id);
            }
        }
        return viewc('client.' . self::NAMEC . '.configuracion', compact('idGroups', ['table']), ['typeCampania' => $typeCampania]);
    }

    public function postConfiguracion(Request $request) {
        $data = $request->all();
        GroupsCampania::whereGroupsId($data['groups_id'])->forceDelete();
        GroupsCampania::create($data);
        $dataEquipos = Hostpots::whereGeocode($data['groups_id'])->get();
        $datosCampania = Campania::whereId($data['campania_id'])->get();
        $datosCampaniaFinal = $datosCampania->toArray();
        $datosGrupo = Groups::find($data['groups_id'])->lists('name');
        Radgroupreply::whereGroupname($datosGrupo[0])->forceDelete();
        foreach ($dataEquipos->toArray() as $v) {
/*

            $valor1 = array('groupname' => $datosGrupo[0], 'attribute' => $v['name'] . '-Advertise-URL', 'op' => '==', 'value' => $datosCampaniaFinal[0]['url']);
            Radgroupreply::create($valor1);
            $valor2 = array('groupname' => $datosGrupo[0], 'attribute' => $v['name'] . '-Advertise-Interval', 'op' => '==', 'value' => $datosCampaniaFinal[0]['expiracion']);
            Radgroupreply::create($valor2);
            $valor3 = array('groupname' => $datosGrupo[0], 'attribute' => $v['name'] . '-Rate-Limit', 'op' => '==', 'value' => $datosCampaniaFinal[0]['megas']);
            Radgroupreply::create($valor3);
        }
        echo nl2br("\r\n\r\n\r\n\r\nCONFIGURACION GUARDADA CORRECTAMENTE", false);exit;
//        return redirect('/admclient/groups');
    }  */


            $valor1 = array('groupname' => $datosGrupo[0], 'MikroTik-Advertise-URL', 'op' => '==', 'value' => $datosCampaniaFinal[0]['url']);
            Radgroupreply::create($valor1);
            $valor2 = array('groupname' => $datosGrupo[0], 'MikroTik-Advertise-Interval', 'op' => '==', 'value' => $datosCampaniaFinal[0]['expiracion']);
            Radgroupreply::create($valor2);
            $valor3 = array('groupname' => $datosGrupo[0], 'MikroTik-Rate-Limit', 'op' => '==', 'value' => $datosCampaniaFinal[0]['megas']);
            Radgroupreply::create($valor3);
        }
        echo nl2br("\r\n\r\n\r\n\r\nCONFIGURACION GUARDADA CORRECTAMENTE", false);exit;
//        return redirect('/admclient/groups');
    }





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

    public function getEquipment($idGroup = null) {
        $table = new Groups();
        if (!empty($idGroup)) {
            $table = Groups::find($idGroup);
        }
        return viewc('client.' . self::NAMEC . '.equipment', compact('table', 'idGroup'));
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

    public function postEquipmnt(FormEquipmenteAdminRequest $request) {
        if (!empty($request)) {
            $data = $request->all();
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


  
    public function postGroups(FormGroupsRequest $request) {
        if (!empty($request)) {
            $data = $request->all();
            $data['customer_id'] = Auth::customer()->user()->id;
            $data['flagactive'] = $request->get('flagactive', 1);
            if ($request->id) { 
                $obj = Groups::find($request->id);
                $obj->update($data);
            } else {
                $obj = Groups::create($data);
            }
            return array('msg' => 'ok', 'state' => 1, 'data' => null);
        }
        return array('msg' => 'Error al guardar el modelo', 'state' => 0, 'data' => null);
    }

    public function getListGroups(Request $request) {
        $idCustomer = $request->input('idCustomer', null);
        $table = Groups::select(['id', 'name', 'datecreate',
                    DB::raw("(if(flagactive='1','Activo',(if(flagactive='0','Inactivo','-')))) as flagactive")])
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
        $table = Groups::select(['id', 'name', DB::raw("(if(flagactive='1','Activo',(if(flagactive='0','Inactivo','-')))) as flagactive")])
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
            $table = Groups::whereId($id);
            $table->delete();
        }
        return response()->json(array('msg' => 'ok', 'state' => 1, 'data' => null));
    }

}
