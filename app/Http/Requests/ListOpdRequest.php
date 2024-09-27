<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListOpdRequest extends FormRequest
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
            'nama_opd' => 'required|string|max:255',
            'jenis_retribusi' => 'required|string|max:255',
            'objek_retribusi' => 'required|string',
            'rincian_objek' => 'nullable|string|max:255',
            'sub_rincian_objek' => 'nullable|string|max:255',
            'sub_sub_rincian_objek' => 'nullable|string|max:255',
            'detail_rincian' => 'nullable|string',
            'tarif' => 'nullable|numeric|min:0',
            'satuan' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'link' => 'nullable|url|max:255',
        ];
    }
}
