<?php

namespace App\Http\Requests;

use App\Models\Language;
use Illuminate\Foundation\Http\FormRequest;

class HandleUpdateNoticiaEtiqueta extends FormRequest
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
            'etiquetas.' . config('app.lang_default') . '.nombre' => 'required|max:255',
            'etiquetas.' . config('app.lang_default') . '.slug' => array('required', 'max:255', 'regex:/^[_a-zA-Z0-9-\pL]*$/'),
        ];

        foreach (Language::where('id', '<>', config('app.lang_default'))->get() as $key => $idioma) {
            $rules['etiquetas.' . $idioma->id . '.nombre'] = 'required_with:etiquetas.' . $idioma->id . '.slug|max:255';
            $rules['etiquetas.' . $idioma->id . '.slug'] = array('required_with:etiquetas.' . $idioma->id . '.nombre', 'max:255', 'regex:/^[_a-zA-Z0-9-\pL]*$/');
        }

        return $rules;
    }
}