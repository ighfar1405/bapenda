<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;

class TarifRetribusiRequest extends FormRequest
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
            'kode_tarif' => 'nullable|string|max:255',
            'kelas' => 'nullable|string|max:255',
            'golongan' => 'nullable|between:0,99.99',
            'range_njop' => 'required|between:0,99.99',
            'tarif_meter' => 'required|between:0,99.99',
            'klasifikasi_pemakaian' => 'required|exists:klasifikasi_pemakaian,id'
        ];
    }
}
