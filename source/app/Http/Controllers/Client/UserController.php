<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Datatables;
use App\Http\Requests\Client\FormCustomerRequest;
use App\Http\Requests\Client\FormEquipmenteAdminRequest;
use App\Http\Requests\Client\FormGroupsRequest;
use App\Http\Requests\Client\FormCampaniaRequest;
use App\Models\Customer;
use App\Models\Campania;
use App\Models\Hostpots;
use App\Models\Groups;
use Config;
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

    public function getEquipmentList() {
        return viewc('client.' . self::NAMEC . '.equipment-list');
    }

    public function getGroupsList() {
        return viewc('client.' . self::NAMEC . '.groups-list');
    }

    public function getCampaniaList() {
        return viewc('client.' . self::NAMEC . '.campania-list');
    }

    public function getForm($id = null) {
        $table = new Customer();
        if (!empty($id)) {
            $table = Customer::find($id);
        }
        return viewc('client.' . self::NAMEC . '.form', compact('table', 'id'));
    }

    public function getEquipment($idUser = null) {
        $table = new Customer();
        if (!empty($table)) {
            $table = Customer::find($table);
        }
        return viewc('client.' . self::NAMEC . '.equipment', compact('table', 'idUser'));
    }

    public function getCampania($idUser = null) {
        $table = new Customer();
        if (!empty($table)) {
            $table = Customer::find($table);
        }
        return viewc('client.' . self::NAMEC . '.campania', compact('table', 'idUser'));
    }

    public function getFormcampania($id = null) {
        $value = explode("-", $id);
        $Customer_id = $value[0];
        $table = new Campania();
        if (!empty($value[1])) {
            $table = Campania::find($value[1]);
            $table->imagen = !empty($table->imagen) ? "{$table->imagen}" : null;
        }

        return viewc('client.' . self::NAMEC . '.formcampania', compact('table', 'Customer_id'));
    }

    public function postFormcampania(FormCampaniaRequest $request) {
        if (!empty($request)) {
            $data = $request->all();
            if ($request->hasfile('imagen')) {
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
                if (empty($data['customer_id'])) {
                    $data['customer_id'] = null;
                }
                $obj = Campania::create($data);
            }
            if (empty($data['customer_id'])) {
                return redirect('admclient/' . self::NAMEC . '/campania-list')->with('messageSuccess', 'Caracteristicas Guardado');
            }
            return redirect('admclient/' . self::NAMEC . '/campania/' . $data['customer_id'])->with('messageSuccess', 'Caracteristicas Guardado');
        }
        return redirect('admclient')->with('messageError', 'Error al guardar la region');
    }

    public function getGroups($id = null) {
        $table = new Groups();
        if (!empty($id)) {
            $table = Groups::whereCustomerId($id);
        }
        return viewc('client.' . self::NAMEC . '.groups', compact('table', 'id'));
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

    public function postGroups(FormGroupsRequest $request) {
        if (!empty($request)) {
            $data = $request->all();
            $data['customer_id'] = $request->get('customer_id', 1);
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

    public function getListEquipment(Request $request) {
        $idGroup = $request->input('idGroup', 0);

        $table = Hostpots::select(['id', 'name', 'mac', 'owner'])
                ->whereGeocode($idGroup);
        $datatable = Datatables::of($table)
                ->addColumn('action', function($table) {
            return '<a href="' . $table->id . '" class="btn btn-warning">Editar</a>
                    
                        <a href="#" data-url="/admclient/' . self::NAMEC . '/delete/' . $table->id . '" class="btn btn-danger action_delete" data-id="' . $table->id . '" >Eliminar</a>';
        })
        ;
        return $datatable->make(true);
    }

    public function getList() {
        $table = Customer::select(['id', 'name_customer', 'email'])->where('type', '=', '2');
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

    public function getDeleteGroup($id) {
        $table = null;
        if (!empty($id)) {
            $table = Groups::whereId($id);
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
