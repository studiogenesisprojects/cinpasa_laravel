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
            'g-recaptcha-response' => app()->env == 'local' ? '' : 'required|recaptcha',
            'politics' => 'accepted',
            'nom_surname' => 'required|string',
            'company' => 'required|string',
            'email' => 'required|email',
            'tel' => 'required|integer|min:9',
            'country' => 'required|string',
            'comment' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'g-recaptcha-response.recaptcha' => 'No has pasado el test de capcha',
            'g-recaptcha-response.required' => 'No has pasado el test de capcha',
            'politics.accepted' => 'Es necesario acceptar las politicas de privacidad',
            'nom_surname.required' => 'El campo nombre es requerido',
            'company.required' => 'El campo Nombre de empresa es obligatorio',
            'email.required' => 'El campo Email es obligatorio',
            'email.email' => 'Email no válido',
            'comment.required' => 'El campo Comentario es obligatorio',
            'tel.required' => 'El campo Teléfono de contacto es obligatorio',
            'tel.integer' => 'Teléfono de contacto no válido',
            'tel.required' => 'Mínimo 9 números',
        ];
    }
}
