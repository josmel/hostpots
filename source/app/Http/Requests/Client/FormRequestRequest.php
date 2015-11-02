<?php namespace App\Http\Requests\Client;

use App\Http\Requests\Request;
use Auth;

class FormRequestRequest extends Request {

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
                    'description' => 'required',
                    'contact_id' => 'required',
                    'datefrom' => 'date',
                    'dateto' => 'date',
//                    'email' => 'required|email|unique:customers,email,'.Auth::customer()->user()->id,
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
