<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecapchaValidateRequest extends FormRequest
{
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
            'politics' => 'accepted',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|integer|min:9',
            'comentaris' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'politics.accepted' => 'Es necesario acceptar las politicas de privacidad',
            'name.required' => 'El campo nombre es requerido',
            'email.required' => 'El campo Email es obligatorio',
            'email.email' => 'Email no válido',
            'comentaris.required' => 'El campo Comentario es obligatorio',
            'phone.required' => 'El campo Teléfono de contacto es obligatorio',
            'phone.integer' => 'Teléfono de contacto no válido',
            'phone.required' => 'Mínimo 9 números',
        ];
    }
}
