<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Requests\Home\FormLoginRequest;
use Illuminate\Http\Request;
use Validator;
use Auth;
use DB;

class AuthController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Registration & Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users, as well as the
      | authentication of existing users. By default, this controller uses
      | a simple trait to add these behaviors. Why don't you explore it?
      |
     */

use AuthenticatesAndRegistersUsers;

    protected $loginPath = '/login';
    protected $redirectPath = '/admclient';
    protected $redirectPathTwo = '/admclient/perfil';
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard  $auth
     * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
     * @return void
     */
    public function __construct() {
        $this->auth = Auth::customer();
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function getLogin() {
         
        return redirect('/');
    }

    public function postLogin(FormLoginRequest $request) {
        $credentials = $request->only('email', 'password');
        if ($this->auth->attempt($credentials, $request->has('remember'))) {
             if(Auth::customer()->user()->type=='2'){
              return redirect()->intended($this->redirectPathTwo());    
             }
            return redirect()->intended($this->redirectPath());
        } else {
            return redirect(action('Home\WelcomeController@index'))
                            ->withInput($request->only('email', 'remember'))
                            ->withErrors([
                                'email' => $this->getFailedLoginMessage(),
            ]);
        }
    }

    public function getLogout() {
        $this->auth->logout();
        return redirect('/');
    }

    protected function getFailedLoginMessage() {
        return 'Estas credenciales no coinciden con nuestros registros.';
    }

}
