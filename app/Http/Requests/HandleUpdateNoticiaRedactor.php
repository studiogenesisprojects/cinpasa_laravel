<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HandleUpdateNoticiaRedactor extends FormRequest
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
            'nombre' => 'required|max:255',
            'email' => 'email',
            'slug' => array('required', 'max:255', 'regex:/^[_a-zA-Z0-9-\pL]*$/'),
            'foto_redactor' => 'file|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}