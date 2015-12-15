<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Datatables;
use App\Http\Requests\Client\FormCustomerRequest;
use App\Http\Requests\Client\FormEquipmenteAdminRequest;
use App\Http\Requests\Client\RequestDelete;
use App\Http\Requests\Client\HGroupsRequest;
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

    public function getConfiguracion($idGroups = null, $idCustomer = null) {

        $dataGroups = Groups::find($idGroups);
        if ($dataGroups->customer_id == 0) {
            $typeCampania = Campania::where('flagactive', '=', '1')
                            ->whereCustomerId(null)->lists('name', 'id');
        } else {
            if ($idCustomer == null) {
                $idCustomer = Auth::customer()->user()->id;
            }
            $typeCampania = Campania::where('flagactive', '=', '1')
                            ->whereCustomerId($idCustomer)->lists('name', 'id');
//        $typeCampania = [null => 'Por favor seleccione una opción'] + $typeCampania;   
        }

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
//        $dataEquipos = Hostpots::whereGeocode($data['groups_id'])->get();
        $dataEquipos = DB::select("select  H.* from hotspots as H "
                        . "inner join hotspots_groups as HG ON H.id=HG.hotspots_id where HG.groups_id=".$data['groups_id']);
        $datosCampania = Campania::find($data['campania_id']);
        $datosGrupo = Groups::find($data['groups_id']);
        //esta por verse///
        Radgroupreply::whereGroupname($datosGrupo->name)->forceDelete();
        foreach ($dataEquipos as $v) {
            $valor1 = array('groupname' => $datosGrupo->name, 'attribute' => $v->name . '-Advertise-URL', 'op' => '==', 'value' => $datosCampania->url);
            Radgroupreply::create($valor1);
            $valor2 = array('groupname' => $datosGrupo->name, 'attribute' => $v->name . '-Advertise-Interval', 'op' => '==', 'value' => $datosCampania->expiracion);
            Radgroupreply::create($valor2);
            $valor3 = array('groupname' => $datosGrupo->name, 'attribute' => $v->name . '-Rate-Limit', 'op' => '==', 'value' => $datosCampania->megas);
            Radgroupreply::create($valor3);
        }
        echo nl2br("\r\n\r\n\r\n\r\nCONFIGURACION GUARDADA CORRECTAMENTE", false);
        exit;
    }

    public function postConfiguracion2(Request $request) {
        $data = $request->all();
        GroupsCampania::whereGroupsId($data['groups_id'])->forceDelete();
        GroupsCampania::create($data);
        $dataEquipos = Hostpots::whereGeocode($data['groups_id'])->get();
        $datosCampania = Campania::whereId($data['campania_id'])->get();
        $datosCampaniaFinal = $datosCampania->toArray();
        $datosGrupo = Groups::find($data['groups_id'])->lists('name');
        Radgroupreply::whereGroupname($datosGrupo[0])->forceDelete();
        foreach ($dataEquipos->toArray() as $v) {
            $valor1 = array('groupname' => $datosGrupo[0], 'MikroTik-Advertise-URL', 'op' => '==', 'value' => $datosCampaniaFinal[0]['url']);
            Radgroupreply::create($valor1);
            $valor2 = array('groupname' => $datosGrupo[0], 'MikroTik-Advertise-Interval', 'op' => '==', 'value' => $datosCampaniaFinal[0]['expiracion']);
            Radgroupreply::create($valor2);
            $valor3 = array('groupname' => $datosGrupo[0], 'MikroTik-Rate-Limit', 'op' => '==', 'value' => $datosCampaniaFinal[0]['megas']);
            Radgroupreply::create($valor3);
        }
        echo nl2br("\r\n\r\n\r\n\r\nCONFIGURACION GUARDADA CORRECTAMENTE", false);
        exit;
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

    public function hotspotsGroups(HGroupsRequest $request) {
        $groupsId = $request->input('groups_id');
        $hotspots_ids = json_decode($request->input('hotspots_id'), true);
        try {
            $data['groups_id'] = $groupsId;
            foreach ($hotspots_ids as $id) {
                $data['hotspots_id'] = $id;
                \App\Models\HotspotsGroups::updateOrCreate($data, ['flagactive' => 1]);
            }
            $return = array('state' => 1, 'msg' => 'ok', 'data' => array());
        } catch (Exception $exc) {
            $return = array('state' => 0, 'msg' => $exc->getMessage());
        }
        return response()->json($return);
    }

    public function getGroupsFree() {
        try {
            $dataCampania = Groups::whereCustomerId(0)->lists('name', 'id');
            $return = array('state' => 1, 'msg' => 'ok', 'data' => $dataCampania);
        } catch (Exception $exc) {
            $return = array('state' => 0, 'msg' => $exc->getMessage());
        }
        return response()->json($return);
    }

    public function getInsertFree(Request $request) {

        $customer_id = $request->input('customer_id');
        $group_id = json_decode($request->input('group_id'), true);
        try {
            $data['customer_id'] = $customer_id;
            foreach ($group_id as $id) {
                $dataHG = \App\Models\HotspotsGroups::whereGroupsId($id)->get();
                if ($dataHG->toArray()) {
                    foreach ($dataHG->toArray() as $value) {
                        $objH = Hostpots::find($value['hotspots_id']);
                        $objH->update(array('geocode' => $data['customer_id']));
                    }
                }
                $objGroup = Groups::find($id);
                $objGroup->update($data);
            }
            $return = array('state' => 1, 'msg' => 'ok', 'data' => array());
        } catch (Exception $exc) {
            $return = array('state' => 0, 'msg' => $exc->getMessage());
        }
        return response()->json($return);
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

    public function deleteGroupsHotspots(Request $request) {
        try {
            $table = \App\Models\HotspotsGroups::whereGroupsId($request->get('groups', null))
                            ->whereHotspotsId($request->get('hotspots', null))->forceDelete();
//            $data = array('hotspots_id' => $request->get('hotspots', null), 'flagactive' => '0',
//                'groups_id' => $request->get('groups', null));
//            $table->update($data);
//            $table->delete();
//            $table->forceDelete();
            $return = array('state' => 1, 'msg' => 'ok');
        } catch (Exception $exc) {
            echo '';
            exit;
            $return = array('state' => 0, 'msg' => $exc->getMessage());
        }
        return response()->json($return);
    }

    public function listHotspots(Request $request) {
        try {
            $idGroup = $request->input('groups_id');
            $dataGroup = Groups::find($idGroup);
            $exercise = new Hostpots();
            if ($dataGroup->customer_id == Auth::customer()->user()->id) {
                $data = $exercise->listHotspots($dataGroup->customer_id, 'email_owner');
            } else {
                $data = $exercise->listHotspots($dataGroup->customer_id, 'mac');
            }
            $return = array('state' => 1, 'msg' => 'ok', 'data' => $data);
        } catch (Exception $exc) {
            $return = array('state' => 0, 'msg' => $exc->getMessage());
        }
        return response()->json($return);
    }

    public function groupsDataTable(Request $request) {
        $idCustomer = $request->input('idCustomer', Auth::customer()->user()->id);
        if ($idCustomer == Auth::customer()->user()->id) {
            $name = 'email_owner';
        } else {
            $name = 'mac';
        }
        $Groups = new Groups();
        $groups = $Groups->getGroupsDataTable($idCustomer);
        foreach ($groups as $value) {
            $dd = DB::select("select group_concat(H.$name, concat('*',H.id)) as hotspots from hotspots_groups as HG "
                            . "inner join hotspots as H ON H.id=HG.hotspots_id inner join groups as G ON G.id=HG.groups_id "
                            . "where  HG.flagactive=1 and G.flagactive=1 and HG.groups_id=G.id and HG.groups_id=$value->id "
                            . "group by G.id ");
            if (isset($dd[0]->hotspots)) {
                $value->hotspots = $dd[0]->hotspots;
            } else {
                $value->hotspots = null;
            }
        }
        return Datatables::of($groups)
                        ->editColumn('hotspots', function ($groups) {
                            $str = "";
                            if ($groups->hotspots == null) {
                                $cad = "No asignado";
                            } else {
                                $data = explode(",", $groups->hotspots);
                                $cad = "";
                                foreach ($data as $row) {
                                    $row = explode('*', $row);
                                    $cad = $cad . '<span class="tag-exercise" data-id=' . $row[1] . '>' . $row[0] . '<i class="icon icon-remove"></i></span>';
                                    $str = $str . $row[1] . ",";
                                }
                                $str = substr($str, 0, strlen($str) - 1);
                            }
                            return $cad . "<span class='more-exercise' data-id='" . $groups->id . "' data-exercises ='" . $str . ",0'> + </span>";
                        })
//                        ->addColumn('action', '<a href="/admpanel/routine/{{$id}}" class="btn btn-raised btn-info" data-id="1">Editar</a>   <a href="#" class="js-delete btn btn-raised btn-danger" data-id="{{$id}}" >Eliminar</a>')
                        ->make(true);
    }

    public function getListGroups(Request $request) {
        $Groups = new Groups();
        $groups = $Groups->getGroupsDataTableAll();
        foreach ($groups as $value) {
            $dd = DB::select("select group_concat(H.mac, concat('*',H.id)) as hotspots from hotspots_groups as HG "
                            . " left join hotspots as H ON H.id=HG.hotspots_id left join groups as G ON G.id=HG.groups_id "
                            . "where  HG.flagactive=1 and G.flagactive=1 and HG.groups_id=G.id and HG.groups_id=$value->id "
                            . "group by G.id ");
            if (isset($dd[0]->hotspots)) {
                $value->hotspots = $dd[0]->hotspots;
            } else {
                $value->hotspots = null;
            }
        }
        return Datatables::of($groups)
                        ->editColumn('hotspots', function ($groups) {
                            $str = "";
                            if ($groups->hotspots == null) {
                                $cad = "No asignado";
                            } else {
                                $data = explode(",", $groups->hotspots);
                                $cad = "";
                                foreach ($data as $row) {
                                    $row = explode('*', $row);
                                    $cad = $cad . '<span class="tag-exercise" data-id=' . $row[1] . '>' . $row[0] . '<i class="icon icon-remove"></i></span>';
                                    $str = $str . $row[1] . ",";
                                }
                                $str = substr($str, 0, strlen($str) - 1);
                            }
                            return $cad . "<span class='more-exercise' data-id='" . $groups->id . "' data-exercises ='" . $str . ",0'> + </span>";
                        })
//                        ->addColumn('action', '<a href="/admpanel/routine/{{$id}}" class="btn btn-raised btn-info" data-id="1">Editar</a>   <a href="#" class="js-delete btn btn-raised btn-danger" data-id="{{$id}}" >Eliminar</a>')
                        ->make(true);
    }

    public function getListGroupsTwo(Request $request) {

        $idCustomer = $request->input('idCustomer', null);
        $table = Groups::leftJoin('customers', 'groups.customer_id', '=', 'customers.id')
                ->select(['groups.id', 'groups.customer_id', 'groups.name', 'groups.datecreate', 'customers.name_customer as cliente', DB::raw("(if(groups.flagactive='1','Activo',(if(groups.flagactive='0','Inactivo','-')))) as flagactive")]);
        if ($idCustomer != null) {
            $table = $table->whereCustomerId($idCustomer);
        }
        $table->orderBy('groups.id', 'desc');
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
