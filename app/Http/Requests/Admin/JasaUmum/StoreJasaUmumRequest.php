<?php

namespace App\Http\Requests\Admin\JasaUmum;

use Illuminate\Foundation\Http\FormRequest;

class StoreJasaUmumRequest extends FormRequest
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
            'nama_penyetor' => 'required',
            'no_ktp' => 'required|max:16',
            'objek_setoran' => 'required',
            'lokasi_objek' => 'required',
            'jumlah_setoran' => 'required|numeric',
        ];
    }
}
