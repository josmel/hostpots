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

class ProfileAdminController extends Controller {

    const NAMEC = 'profile-admin';

    public function getIndex() {
        $id = Auth::customer()->user()->id;
        $admin = Customer::find($id);
        return viewc('client.'.self::NAMEC.'.index', array('admin' => $admin,'messageSuccess'=>null));
    }

    public function postIndex(FormCustomerRequest $request) {
        if (!empty($request)) {
              $data = $request->all();
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

}
