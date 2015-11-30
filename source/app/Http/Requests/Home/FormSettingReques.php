<?php

namespace App\Http\Requests\Home;

use App\Http\Requests\Request;

class FormSettingReques extends Request {

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
            'mac' => 'required|min:5',
            'uamport' => 'required|',
            'uamip' => 'required|email',
        ];
    }

    public function messages() {
        return [
            'required' => 'El campo :attribute es requerido.',
            'min' => 'El :attribute debe ser de al menos 2 caracteres.',
            'integer' => 'El :attribute debe ser un entero',
            'email' => 'El :attribute no es valido',
            'unique' => 'El :attribute existe en nuestros sistemas', ''
        ];
    }

}
