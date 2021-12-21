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
            'company' => 'required',
            'name' => 'required|string',
            'phone' => 'required|integer|min:9',
            'email' => 'nullable|email',
            'web' => 'nullable|url',
            'politics' => 'accepted',

        ];
    }
}
