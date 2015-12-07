<?php namespace App\Http\Requests\Admin;

use App\Http\Requests\RequestWservice;

class RequestDelete extends RequestWservice
{


    public function authorize()
    {

        return true;
    }

    public function rules()
    {
        $rules = ['id' => 'required'];
        return $rules;
    }

    public function messages()
    {
        return [
            'required' => 'El campo :attribute es requerido.',
            'min' => 'El :attribute debe ser de al menos 2 caracteres.',
        ];
    }
}