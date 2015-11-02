<?php namespace App\Http\Controllers;

use App\Services\ResponseWService;

abstract class ControllerWS extends Controller {
    
        const MSG_CUSTOM_USER_PASS_FAIL = 'Usuario o Contraseña incorrecta';

        protected $_responseWS;
        
        public function __construct() 
        {
            $this->middleware('guest');
            $this->_responseWS = new ResponseWService();
        }
        
        public function __call($name, $arguments)
        {
            $this->_responseWS->setDataResponse(ResponseWService::HEADER_HTTP_RESPONSE_METODO_NO_PERMITIDO);
            $this->_responseWS->response();
        }
}
