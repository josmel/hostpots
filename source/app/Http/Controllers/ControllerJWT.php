<?php namespace App\Http\Controllers;

use JWTAuth;
use Illuminate\Http\Response;

abstract class ControllerJWT extends ControllerWS
{
    protected $_identity = array();

    public function __construct()
    {
        try{
            parent::__construct();
            $token = JWTAuth::getToken();
            $this->_identity = JWTAuth::toUser($token);
        } catch (\Exception $exc) {
            $this->_responseWS->setDataResponse(
                Response::HTTP_INTERNAL_SERVER_ERROR, array(), array(),
                $exc->getMessage());
            $this->_responseWS->response();
        }
    }
}
