<?php namespace App\Http\Controllers\Wservice;

use App\Http\Controllers\ControllerWS;
use App\Models\User;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\Response;

class UserController extends ControllerWS {
    
        public function store(RegisterUserRequest $request)
        {
            try {
                $obj = User::create($request->all());
                $this->_responseWS->setDataResponse(Response::HTTP_CREATED,
                    User::find($obj->id)->toArray(),array(), 'Recurso creado');
                $this->_responseWS->setHeader('Location',route('wservice.user.show',array('user'=>$obj->id)));
            } catch (\Exception $exc) {
                $this->_responseWS->setDataResponse(
                    Response::HTTP_INTERNAL_SERVER_ERROR, array(), array(),
                    $exc->getMessage());
            }
            $this->_responseWS->response();
        }
        
}
