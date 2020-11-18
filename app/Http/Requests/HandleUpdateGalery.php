<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HandleUpdateGalery extends FormRequest
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
        $rules = [
            'titulo' => 'required|max:255',
            'fecha' => 'required',
            'imagenes.*' => 'file|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        return $rules;
    }
}