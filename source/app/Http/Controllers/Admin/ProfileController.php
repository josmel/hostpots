<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Admin\FormProfileRequest;
use Config;
use Auth;
use Hash;

class ProfileController extends Controller {

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
       const NAMEC = 'profile';
	public function getIndex() {
		$id = Auth::admin()->user()->id;
		$admin = User::find($id);
                $admin->nameimage = $admin->image;
		return viewc('admin.'.self::NAMEC.'.index', array('admin' => $admin,'messageSuccess'=>null));
	}
	public function postIndex(FormProfileRequest $request) {
		$dataImage = array();
		$dataProfile = array(
                    'name' => $request->get('name', null),
                     'lastname' => $request->get('lastname', null),
		);
                $password = $request->get('password', null);
                if(!empty($password)){
                    $dataProfile['password'] = Hash::make($password);
                }
                $data = array_merge($dataProfile);
		$id = Auth::admin()->user()->id;
		$obj = User::find($id);
		$obj->update($data);
                return viewc('admin.'.self::NAMEC.'.index', array('admin' => $obj,'messageSuccess'=>'Perfil Guardado'));
//		return redirect('admpanel')->with('messageSuccess', 'Perfil Guardado');
	}

}
