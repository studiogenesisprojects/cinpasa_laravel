<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkWithUsRequest extends FormRequest
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
            // 'g-recaptcha-response' => 'required|recaptcha',
            // 'g-recaptcha-response' => app()->env == 'local' ? '' : 'required|recaptcha',
            'politics' => 'accepted',
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required|email',
            'tel' => 'required|integer|min:9',
            'file' => 'required|max:50000|mimes:pdf'
        ];
    }

    public function messages()
    {
        return [
            'g-recaptcha-response.recaptcha' => 'No has pasado el test de capcha',
            'g-recaptcha-response.required' => 'No has pasado el test de capcha',
            'name.required' => 'Introduzca su nombre',
            'surname.required' => 'Introduzca sus apellidos',
            'email.required' => 'El campo Email es obligatorio',
            'email.email' => 'Email no válido',
            'tel.required' => 'El campo Teléfono de contacto es obligatorio',
            'tel.integer' => 'Teléfono de contacto no válido',
            'tel.required' => 'Mínimo 9 números',
            'politics.accepted' => 'Es necesario acceptar las politicas de privacidad',
            'file.required' => 'No te olvides de adjuntar tu CV',
            'file.max' => 'el documento no puede pesar más de 5mb',
            'file.mimes' => 'Formato no válido',
        ];
    }
}
