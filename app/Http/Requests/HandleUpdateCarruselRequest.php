<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HandleUpdatecarouselRequest extends FormRequest
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
            'name.*' => 'required',
            'description.*' => 'required',
            'alt_img.*' => 'required',
            'url.*' => 'required',
            'title_url.*' => 'required',
            'title.*' => 'required',
            'text.*' => 'required',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre del slide es requerido.',
            'description.required' => 'La descripción del slide es requerido.',
            'alt_img.required' => 'El alt de la imagen es requerido.',
            'url.required' => 'LA url del de la imagen es requerido.',
            'title_url.required' => 'El título de la imagen es requerido.',
            'title.required' => 'El título de la imagen es requerido.',
            'text.required' => 'El texto de la imagen es requerido.'
        ];
    }
}
