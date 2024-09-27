<?php

namespace App\Http\Requests\Statis;

use Illuminate\Foundation\Http\FormRequest;

class RekeningBankRequest extends FormRequest
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
            'nama_bank' => 'required',
            'no_rekening' => 'required',
            'akun_bendahara_id' => 'required',
        ];
    }
}
