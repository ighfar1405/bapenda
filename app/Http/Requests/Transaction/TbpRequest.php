<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class TbpRequest extends FormRequest
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
            'nomor' => 'nullable',
            'nomor_auto' => 'nullable',
            'tanggal' => 'required|date',
            'skrd_radio' => 'required',
            'pemakai' => 'required',
            'kas_bank' => 'required',
            'bendahara' => 'required',
            'keterangan' => 'required',
        ];
    }
}
