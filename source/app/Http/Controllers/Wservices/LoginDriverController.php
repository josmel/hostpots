<?php namespace App\Http\Controllers\Wservice;

use App\Http\Controllers\ControllerWS;
use App\Models\Driver;
use App\Http\Requests\Wservices\LoginDriverRequest;
use Illuminate\Http\Response;
use JWTAuth;
use DB;
class LoginDriverController extends ControllerWS {

	public function index(LoginDriverRequest $request)
	{
            try {
                $credentials['password'] = $request->input('password');
                $credentials['email'] = $request->input('email');
                $Driver = DB::table('drivers')->where('email', $credentials['email'])->first();
                  if ($Driver != null) {
                        if ($Driver->flagactive == 0) {
                           $this->_responseWS->setDataResponse(Response::HTTP_UNAUTHORIZED, [], 
                            array(), 'Usuario inactivo');  
                        }
                  }
                if (!$token = JWTAuth::attempt($credentials)) {
                    $this->_responseWS->setDataResponse(Response::HTTP_UNAUTHORIZED, [], 
                            array(), ControllerWS::MSG_CUSTOM_USER_PASS_FAIL);
                } else {
                    
                    $login = JWTAuth::toUser($token);
                    $driver = Driver::find($login->id);
                    $driver->uuid = $request->input('uuid',null);
                    $driver->save();
                    
                    $this->_responseWS->setDataResponse(Response::HTTP_OK, $driver->toArray(), 
                            array(), '');
                    $this->_responseWS->setHeader('_token', $token);
                }
            } catch (\Exception $exc) {
                $this->_responseWS->setDataResponse(
                    Response::HTTP_INTERNAL_SERVER_ERROR, array(), array(),
                    $exc->getMessage());
            }
            $this->_responseWS->response();
	}

}
