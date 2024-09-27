<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class PemindahanPemakaianRequest extends FormRequest
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
            'objek_retribusi_id' => 'required|max:255',
            'pemakai_lama_id' => 'required',
            'pemakai_baru' => 'required',
            'no_sk' => 'required',
            'tanggal_sk' => 'required',
            'klasifikasi_pemakaian_id' => 'required'
        ];
    }
}
