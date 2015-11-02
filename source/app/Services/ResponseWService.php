<?php namespace App\Services;

class ResponseWService {

	const HEADER_HTTP_RESPONSE_OK = 200;
        const HEADER_HTTP_RESPONSE_CREATED = 201;
	const HEADER_HTTP_RESPONSE_SIN_CONTENIDO = 204;
	const HEADER_HTTP_RESPONSE_SOLICITUD_INCORRECTA = 400;
        const HEADER_HTTP_RESPONSE_NO_AUTORIZADO = 401;
        const HEADER_HTTP_RESPONSE_NO_ENCONTRADO = 404;
	const HEADER_HTTP_RESPONSE_METODO_NO_PERMITIDO = 405;
	const HEADER_HTTP_RESPONSE_ERROR_INTERNO = 500;
	
	protected $_msgError;
	protected $_dataResponse = array();
	protected $_headerCode;
        protected $_header = array();

	public function __construct() {
            $this->_msgError = array(
                self::HEADER_HTTP_RESPONSE_OK => 'ok',
                self::HEADER_HTTP_RESPONSE_CREATED => 'Recurso creado',
                self::HEADER_HTTP_RESPONSE_SIN_CONTENIDO => 'No se encontro contenido para este proceso',
                self::HEADER_HTTP_RESPONSE_SOLICITUD_INCORRECTA => 'La solicitud contiene sintaxis errónea y no debería repetirse',
                self::HEADER_HTTP_RESPONSE_NO_AUTORIZADO => 'El recurso no esta autorizado',
                self::HEADER_HTTP_RESPONSE_NO_ENCONTRADO => 'El recurso no ha sido encontrado o no existe',
                self::HEADER_HTTP_RESPONSE_METODO_NO_PERMITIDO => 'Una petición fue hecha a una URI utilizando un método de solicitud no soportado',
                self::HEADER_HTTP_RESPONSE_ERROR_INTERNO => 'Error Interno',
            );
	}
        
	protected function getMessageError($codeError) {
            return isset($this->_msgError[$codeError]) ? $this->_msgError[$codeError] : '';
	}
        
	/**
	 * Ouput Header and content JSOn
	 */
	public function response() {
		if ($this->_headerCode == '') {
			$this->_headerCode == self::HEADER_HTTP_RESPONSE_METODO_NO_PERMITIDO;
		}
                if(count($this->_header)>0){
                    foreach ($this->_header as  $value) {
                        header($value);
                    }
                }
                header('Content-Type: application/json;charset=UTF-8');
                http_response_code($this->_headerCode);
                echo json_encode($this->_dataResponse);
                exit;
	}

	public function setDataResponse($headerCode,array $data = array(), array $dataError = array(), $msgCustomer = '') {
                $headerOk = array(
                    self::HEADER_HTTP_RESPONSE_OK, self::HEADER_HTTP_RESPONSE_CREATED
                );
		$this->_dataResponse = array(
		'status' => $headerCode == in_array($headerCode, $headerOk) ? 1 : 0,
		'msg' => $msgCustomer != '' ? $msgCustomer : $this->getMessageError($headerCode),
		'data' => $data,
		'data_error' => $dataError,
		);
		$this->_headerCode = $headerCode;
	}
        
        public function setHeader($head, $value)
        {
            $this->_header[] = "$head: $value";
        }
}
