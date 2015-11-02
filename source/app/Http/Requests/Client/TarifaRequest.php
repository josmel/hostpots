<?php namespace App\Http\Requests\Client;

use App\Http\Requests\RequestWservice;

class TarifaRequest extends RequestWservice {

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
                    'lat_1' => 'required',
                    'lon_1' => 'required',
                    'lat_2' => 'required',
                    'lon_2' => 'required',
//                    'zone' => 'required',
//                    'calculate' => 'required',
		];
	}
        
        public function messages()
        {
            return [
                'required' => 'El campo :attribute es requerido.',
                'min' => 'El :attribute debe ser de al menos 2 caracteres.',
                'integer' => 'El :attribute debe ser un entero',
                'email' => 'El :attribute no es valido',
                'unique' => 'El :attribute existe en nuestros sistemas',''
            ];
        }
}
