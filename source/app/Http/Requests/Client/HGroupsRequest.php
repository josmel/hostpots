<?php namespace App\Http\Requests\Client;

use App\Http\Requests\Request;
use Auth;


class HGroupsRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = ['groups_id' => 'required',
                  'hotspots_id' => 'required'];
        return $rules;
    }

    public function messages()
    {
        return [
            'required' => 'El campo :attribute es requerido.',
        ];
    }
}