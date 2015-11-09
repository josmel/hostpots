<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\Home\RegisterDriverRequest;
use App\Models\Drivers;
use Hash;
use App\Library\CaptchaTrait;

class RegisterDriverController extends Controller {

    use CaptchaTrait;
    /*
      |--------------------------------------------------------------------------
      | Welcome Controller
      |--------------------------------------------------------------------------
      |
      | This controller renders the "marketing page" for the application and
      | is configured to only allow guests. Like most of the other sample
      | controllers, you are free to modify or remove it as you desire.
      |
     */

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function getIndex() {
        return view('home.unete.index');
    }

    public function postIndex(RegisterDriverRequest $request) {
        if (!empty($request)) {
            $data = $request->all();
            if ($this->captchaCheck() == false) {
                return $this->returnEstructura(0, 'Error Captcha Equivocado', array(
                            'captcha' => 'Error Captcha Equivocado',
                ));
            }
            $data['flagactive'] = $request->get('flagactive', 1);
            $data['password'] = Hash::make($request->get('password'));
            $obj = Drivers::create($data);
            return $this->returnEstructura(1, 'Driver registrada, ahora puede iniciar sesion', array());
        }
        return $this->returnEstructura(0, 'Error al guardar las caracteristicas', array(
                    'email' => 'Error al guardar las caracteristicas',
        ));
    }

    public function returnEstructura($state, $msg, $data_error) {
        return array(
            'state' => $state,
            'msg' => $msg,
            'data' => array(
                'redirect' => '/',
            ),
            'data_error' => $data_error,
        );
    }

}
