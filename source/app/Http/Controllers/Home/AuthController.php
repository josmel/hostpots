<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
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
        //return view('home.login.index');
        return redirect('/');
    }

    public function postLogin(Request $request) {
        $this->validate($request, [
            'email' => 'required|email', 'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if ($this->auth->attempt($credentials, $request->has('remember'))) {
            return redirect()->intended($this->redirectPath());
        }
        return redirect($this->loginPath())
                        ->withInput($request->only('email', 'remember'))
                        ->withErrors([
                            'email' => $this->getFailedLoginMessage(),
        ]);
    }

    public function postLogin2(Request $request) {
        $this->validate($request, [
            'email' => 'required|email', 'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');

        $Customers = DB::table('customers')->where('email', $credentials['email'])->first();
        if ($Customers != null) {
            if ($Customers->flagactive == 0) {
                return array(
                    'state' => 0,
                    'msg' => 'no login',
                    'data' => array(
                        'redirect' => '',
                    ),
                    'data_error' => array(
                        'email' => 'Usuario Inactivo',
                    ),
                );
            }
        }
        if ($this->auth->attempt($credentials, $request->has('remember'))) {
            return array(
                'state' => 1,
                'msg' => 'ok',
                'data' => array(
                    'redirect' => $this->redirectPath()
                ),
                'data_error' => array(),
            );
        }
        return array(
            'state' => 0,
            'msg' => 'no login',
            'data' => array(
                'redirect' => $this->loginPath(),
            ),
            'data_error' => array(
                'email' => $this->getFailedLoginMessage(),
            ),
        );
    }

    public function getLogout() {
        $this->auth->logout();
        return redirect('/');
    }

    protected function getFailedLoginMessage() {
        return 'Estas credenciales no coinciden con nuestros registros.';
    }

}
