<?php

namespace App\Http\Requests;

use App\Models\Language;
use Illuminate\Foundation\Http\FormRequest;

class HandleUpdateNoticia extends FormRequest
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
            'noticias.' . config('app.lang_default') . '.titulo' => 'max:255',
            'noticias.' . config('app.lang_default') . '.slug' => array('max:255', 'regex:/^[_a-zA-Z0-9-\pL]*$/'),
            'foto_noticia' => 'file|image|mimes:jpeg,png,jpg,gif|max:2048',
            'redactor_id' => 'required',
        ];

        return $rules;
    }
}
