<?php namespace App\Http\Requests\Client;

use App\Http\Requests\RequestWservice;

class ActivosRequest extends RequestWservice {

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
                    'year' => 'required',
                    'month' => 'required',
                    'day' => 'required',
                    'status_id' => 'in:0,1',
                    'complet' => 'in:0,1',
                    'customer_id' => 'numeric',
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
