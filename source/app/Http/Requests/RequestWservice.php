<?php namespace App\Http\Requests;

use App\Services\ResponseWService,
    App\Http\Requests\Request,
    Illuminate\Validation\Validator;

abstract class RequestWservice extends Request {

	//

        protected function formatErrors(Validator $validator)
        {
            $errors = $this->parseErrorRest($validator->errors()->getMessages());
            $response = new ResponseWService();
            $response->setDataResponse(
                    ResponseWService::HEADER_HTTP_RESPONSE_SOLICITUD_INCORRECTA, array(), 
                    $errors, 'Datos Invalidos del formulario');
            $response->response();
//            return $validator->errors()->all();
        }
        
        private function parseErrorRest($errors)
        {
            $resultError = array();
            foreach ($errors as $key => $value) {
                $resultError[] = array('element' => $key, 'msg' => array_values($value));
            }
            return $resultError;
        }
}
