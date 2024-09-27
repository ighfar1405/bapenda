<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class TbpInsidentilRequest extends FormRequest
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
            'nomor_izin' => 'required',
            'tanggal_izin' => 'required|date',
            'pemakai' => 'required|string',
            'nama_objek' => 'required|string',
            'alamat_objek' => 'required|string',
            'tarif' => 'required',
            'tinggi' => 'required|numeric',
            'luas' => 'required|numeric',
            'kas_bank' => 'required',
            'bendahara' => 'required',
            'jenis_pembayaran' => 'required',
        ];
    }
}
