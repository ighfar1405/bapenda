<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class OpdRequest extends FormRequest
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
        $ignoreId = request()->id ?? null;
        return [
            'kode_opd' => 'required|max:100|unique:opd,kode,'.$ignoreId,
            'nama_opd' => 'required|string|max:255'
        ];
    }
}
