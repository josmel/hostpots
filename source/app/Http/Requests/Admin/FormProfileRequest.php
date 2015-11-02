<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class FormProfileRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
		];
	}

	public function messages() {
		return [
                    'required' => 'El campo :attribute es requerido.',
                    'min' => 'El :attribute debe ser de al menos 5 caracteres.',
                    'mimes' => 'El :attribute es incorrecto.',
		];
	}

}
