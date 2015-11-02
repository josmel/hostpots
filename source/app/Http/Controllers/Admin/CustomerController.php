<?php //

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Contact;
use Illuminate\Http\Request;
use Datatables;
use DB;
use Validator;
use Hash;
//use Captcha;

class CustomerController extends Controller {

    const NAMEC = 'customer';

    public function __construct() {
        $this->middleware('authadmin');
    }

    public function getIndex() {
      
        return viewc('admin.' . self::NAMEC . '.index');
    }

    public function getForm($id = null) {
        $msgform = 'Contraseña';
        if (!empty($id)) {
            $msgform = 'Contraseña(dejar en blanco si no ha de cambiar)';
        }
        $data = Customer::find($id);
        if (!isset($data)) {
            $data = new Customer();
        }
        return viewc('admin.' . self::NAMEC . '.form', compact('data', 'msgform'));
    }

    public function postForm(Request $request) {
        $id = $request->input('id');
        $password = $request->get('password', null);
        if (isset($id) && $id != '') {
            $data = $request->except(array('email', 'password'));
            $runtime = Customer::find($id);
            $runtime->fill($data);
            $runtime->password = $runtime->password;
            if (!empty($password)) {
                $runtime->password = Hash::make($password);
            }
            $runtime->save();
            $msg = 'Usuario Editado!';
        } else {
            $data = $request->all();
            $data['company_id'] = 1;
//            $data['latitude']=1;
//            $data['longitude']=1;
//            $data['address']=null;
            $validator = Validator::make($data, [
                        'email' => ['unique:customers,email,NULL,id,flagactive,1', 'email'],
            ]);

            if ($validator->fails()) {
                return redirect(action('Admin\CustomerController@postForm'))->withErrors($validator)
                                ->withInput();
            }
            $data['password'] = Hash::make($password);
            $id = Customer::create($data)->id;
            $msg = 'Usuario Guardado!';
        }

        return redirect(action('Admin\CustomerController@getIndex'))->with('messageSuccess', $msg);
    }

    public function getList(Request $request) {
        $table = Customer::select('email', 'id', 'name_customer', 'ruc', 'phone', 'credit', DB::raw("(if(flagactive='1','Activo',(if(flagactive='0','Inactivo','-')))) as flagactive"), DB::raw("(if(flagactive='1','Inactivar',(if(flagactive='0','Activar','-')))) as estado")
        );
        $datatable = Datatables::of($table)
                ->addColumn('action', function($table) {
            return '<a href="/admpanel/' . self::NAMEC . '/form/' . $table->id . '" class="btn btn-warning">Editar</a>
                
        <a href="#" data-url="/admpanel/' . self::NAMEC . '/invalidar/' . $table->id . '" class="btn btn-danger action_delete" data-status="' . $table->estado . '" data-id="' . $table->id . '" >' . $table->estado . '</a>

                            <a href="#" data-url="/admpanel/' . self::NAMEC . '/delete/' . $table->id . '" class="btn btn-danger action_delete"  data-id="' . $table->id . '" >Eliminar</a>';
        })
        ;
        return $datatable->make(true);
    }

    public function getInvalidar($id) {
        $table = null;
        if (!empty($id)) {
            $table = Customer::whereId($id);
            $user = DB::table('customers')->where('id', $id)->first();
            if ($user->flagactive == '0') {
                $data = array('id' => $id, 'flagactive' => '1');
            } else {
                $data = array('id' => $id, 'flagactive' => '0');
            }
            $table->update($data);
        }
        return response()->json('true');
    }

    public function getDelete($id) {
        if (!empty($id)) {
            Contact::where('customer_id', $id)->forceDelete();
            DB::table('customers')->where('id', '=', $id)->delete();
        }
        return response()->json('true');
    }

}
