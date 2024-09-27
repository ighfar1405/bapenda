<?php

namespace App\Http\Requests\Statis;

use Illuminate\Foundation\Http\FormRequest;

class PenomoranRequest extends FormRequest
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
            'formulir' => 'required|string|max:255',
            'format_penomoran' => 'required|string|max:255'
        ];
    }
}
