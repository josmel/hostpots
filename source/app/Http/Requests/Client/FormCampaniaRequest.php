<?php namespace App\Http\Requests\Client;

use App\Http\Requests\Request;
use Auth;

class FormCampaniaRequest extends Request {

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
                    'name' => 'required',
//                                        'imagen' => ['mimes:jpg,png,jpeg','required_without:fullimage'],
//                    'imagen' => 'required',
		];
	}
        
        public function messages()
        {
            return [
                'required' => 'El campo :attribute es requerido.',
                'min' => 'El :attribute debe ser de al menos 2 caracteres.',
                'integer' => 'El :attribute debe ser un entero',
                'unique' => 'El :attribute existe en nuestros sistemas',''
            ];
        }
}
