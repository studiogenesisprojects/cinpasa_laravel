<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplication extends FormRequest
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
            "applications" => "required|array",
            "applications.slug" => "required|unique:aplicationlangs",
            "applications.name" => "required|string"
        ];
    }

    public function messages(){
        return [
            "applications.slug.required" => "El Slug es un campo obligatorio",
            "applications.name.required" => "El título del producto es obligatorio",
        ];
    }
}
