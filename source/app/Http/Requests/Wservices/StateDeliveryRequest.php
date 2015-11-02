<?php namespace App\Http\Requests\Wservices;

use App\Http\Requests\RequestWservice;

class StateDeliveryRequest extends RequestWservice {

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
                    'event' => 'required',
                    'id' => 'required'                    
		];
	}
        
        public function messages()
        {
            return [
                'required' => 'El campo :attribute es requerido.'         
            ];
        }
}
