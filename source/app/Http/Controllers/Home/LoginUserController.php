<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\Home\RegisterRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Contact;
use Hash;

class LoginUserController extends Controller {

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
     *
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
    public function loginUser(Request $request) { 
             $data = $request->all();
             if(!empty($data['mac'])){
               dd($data);  
             }
              return viewc('home.login-user.login'); 
        
    }
    

    public function postIndex(Request $request) { 
        if (!empty($request)) {
            $data = $request->all();
            if ($this->captchaCheck() == false) {
                return $this->returnEstructura(0, 'Error Captcha Equivocado', array(
                            'captcha' => 'Error Captcha Equivocado',
                ));
            }
            $data['flagactive'] = $request->get('flagactive', 1);
            $data['company_id'] = 1;
            $data['password'] = Hash::make($request->get('password'));
            $obj = Customer::create($data);
            Contact::create(array(
                'customer_id' => $obj->id,
                'name' => $request->get('name_contact', ''),
                'phone' => $request->get('phone_contact', ''),
                'cellphone' => $request->get('cellphone_contact', ''),
                'email' => $request->get('email_contact', ''),
                'flagactive' => 1,
            ));
            return $this->returnEstructura(1, 'Empresa registrada, ahora puede iniciar sesion', array());
        }
        return $this->returnEstructura(0, 'Error al guardar las caracteristicas', array(
                    'email' => 'Error al guardar las caracteristicas',
        ));
    }

   

}
