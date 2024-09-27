<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;

class KelurahanRequest extends FormRequest
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
            'kode_administratif' => 'required|string|max:255',
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'nama_kelurahan' => 'required|string|max:255'
        ];
    }
}
