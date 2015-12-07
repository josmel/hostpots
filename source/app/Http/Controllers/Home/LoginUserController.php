<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Radcheck;
use App\Models\Radusergroup;
use App\Models\Hostpots;
use App\Models\HotspotsCampania;
use App\Models\GroupsCampania;
use Validator;

class LoginUserController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
//        $this->middleware('guest');
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
        if (!empty($dateHostPots->toArray())) {
            $uamip = explode(':', $data['uamip']);
            $obj = Hostpots::find($dateHostPots[0]->id);
            $obj->update(array('owner' => $uamip[0]));
            $ip = $uamip[0];
            $table = HotspotsCampania::whereHotspotsId($dateHostPots[0]->id)->get();
            if ($table->toArray()) {
                $idCampania = $table->toArray()[0]['campania_id'];
            } else {
                $datos = GroupsCampania::whereGroupsId($dateHostPots[0]->geocode)->get();
                $idCampania = $datos[0]->campania_id;
            }
            $datosCampania = \App\Models\Campania::whereId($idCampania)->get();
            $imagen = $datosCampania[0]->imagen;
        } else {
            $msg = array('msg' => 'no existe equipo asociado');
            dd($msg);
        }

        $User = $this->getUser($data['mac']);

// Usergroup

        $Usergroup = $this->getUsergroup($data['mac'], $data['uamport']);

        //$href = 'http://' . $ip . '?login?user=' . $User['username'] . '&password=' . $User['value'] . '&dst=' . $datosCampania[0]->url;

        $href = 'http://' . $ip . '/login?user=' . $User['username'] . '&password=' . $User['value'] . '&dst=' . $datosCampania[0]->url;

        return viewc('home.login-user.login', compact('ip', 'href', 'imagen'));
    }

    public function getUser($mac) {
        $table = Radcheck::whereUsername($mac)->get();
        if (count($table) == 1) {
            $user = $table[0]->toArray();
        } else {
            $attributes['username'] = $mac;
            $attributes['value'] = $mac;
            $attributes['op'] = ':=';
            $attributes['attribute'] = 'Cleartext-Password';
            $dataUser = Radcheck::create($attributes);
            $obj = Radcheck::find($dataUser->id);
            $user = $obj->toArray();
        }
        return $user;
    }

// Funcion agregada para radusergroup
    public function getUsergroup($mac, $uamport) {
        $table = Radusergroup::whereUsername($mac)->get();
        if (count($table) == 1) {
            $user = $table[0]->toArray();
        } else {
            $attributes['username'] = $mac;
            $attributes['groupname'] = $uamport;
            $dataUser = Radusergroup::create($attributes);
            $obj = Radusergroup::find($dataUser->username);
            $user = $obj->toArray();
        }
        return $user;
    }

}
