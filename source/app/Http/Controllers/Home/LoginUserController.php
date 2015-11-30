<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\Home\RegisterRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Radcheck;
use App\Models\Equipment;
use App\Models\Hostpots;
use App\Models\EquipmentCampania;
use App\Models\HotspotsCampania;
use App\Models\GroupsCampania;
use App\Http\Requests\Home\FormSettingReques;
use Hash;
use Validator;

class LoginUserController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    public function loginUser(Request $request) {
        $data = $request->all();
        $validator = Validator::make($data, [
                    'mac' => 'required|min:17|max:17',
                    'uamport' => 'required',
                    'uamip' => 'required'
        ]);
        if ($validator->fails()) {
            $error = (array) json_decode($validator->errors());
            dd($error);
        }
        $dateHostPots = Hostpots::whereName($data['uamport'])->get();
        if (!empty($dateHostPots)) {
            $uamip = explode(':', $data['uamip']);
            $obj = Hostpots::find($dateHostPots[0]->id);
            $obj->update(array('owner' => $uamip[0]));
            $ip = $uamip[0];
            if (!empty($dateHostPots->toArray())) {
                $table = HotspotsCampania::whereHotspotsId($dateHostPots[0]->id)->get();
                if ($table->toArray()) {
                    $idCampania = $table->toArray()[0]['campania_id'];
                } else {
                    $datos = GroupsCampania::whereGroupsId($dateHostPots[0]->geocode)->get();
                    $idCampania = $datos[0]->campania_id;
                }
                $datosCampania = \App\Models\Campania::whereId($idCampania)->get();
                $imagen=$datosCampania[0]->imagen;
            }
        }
        $User = $this->getUser($data['mac']);
        
        $href='http://'.$ip.'?login?user='.$User['username'].'&password='.$User['value'].'&dst='.$datosCampania[0]->url;
        
        return viewc('home.login-user.login',compact('ip','href','imagen'));
    }

    public function getUser($mac) {
        $table = Radcheck::whereUsername($mac)->get();
        if (count($table) == 1) {
            $user = $table[0]->toArray();
        } else {
            $attributes['username'] = $mac;
            $attributes['value'] = $mac;
            $attributes['attribute'] = 'Cleartext-Password';
            $dataUser = Radcheck::create($attributes);
            $obj = Radcheck::find($dataUser->id);
            $user = $obj->toArray();
        }
        return $user;
    }

}
