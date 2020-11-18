<?php

namespace App\Http\Requests;

use App\Models\Language;
use Illuminate\Foundation\Http\FormRequest;

class HandleUpdateNoticiaCategoria extends FormRequest
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
            'categorias.' . config('app.lang_default') . '.nombre' => 'required|max:255',
            'categorias.' . config('app.lang_default') . '.slug' => array('required', 'max:255', 'regex:/^[_a-zA-Z0-9-\pL]*$/'),
        ];

        foreach (Language::where('id', '<>', config('app.lang_default'))->get() as $key => $idioma) {
            $rules['categorias.' . $idioma->id . '.nombre'] = 'required_with:categorias.' . $idioma->id . '.slug|max:255';
            $rules['categorias.' . $idioma->id . '.slug'] = array('required_with:categorias.' . $idioma->id . '.nombre', 'max:255', 'regex:/^[_a-zA-Z0-9-\pL]*$/');
        }

        return $rules;
    }
}