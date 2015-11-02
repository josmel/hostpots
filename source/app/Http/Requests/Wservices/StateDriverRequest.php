<?php namespace App\Http\Requests\Wservices;

use App\Http\Requests\RequestWservice;

class StateDriverRequest extends RequestWservice {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
                    'state' => 'required|integer',
                    'id' => 'required|integer'                    
		];
	}
        
        public function messages()
        {
            return [
                'required' => 'El campo :attribute es requerido.',
                'integer' => 'El campo :attribute debe ser entero.'   
            ];
        }
}
