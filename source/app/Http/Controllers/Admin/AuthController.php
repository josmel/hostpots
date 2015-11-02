<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
//use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller {

    use AuthenticatesAndRegistersUsers;

    protected $loginPath = '/admpanel/auth/login';
    protected $redirectPath = '/admpanel';
    protected $redirectTo = '/';

    public function __construct() {
        $this->auth = Auth::admin();
    }

    public function getLogin() {
        return view('admin.auth.login');
//                return $this->renderView('admin.auth.login');
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

    public function getLogout() {
        $this->auth->logout();
        return redirect('/admpanel');
    }

    protected function getFailedLoginMessage() {
        return 'Estas credenciales no coinciden con nuestros registros.';
    }

}
