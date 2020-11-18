<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required',
            'image' => 'max:2000'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Porfavor indique un nombre porque es un campo requerido.',
            'description.required' => 'Porfavor indique una description porque es un campo requerido.',
            'image.max' => 'Porfavor las imagenes no pueden pesar más de 2MB.',
        ];
    }
}