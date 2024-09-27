<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class PertanianRequest extends FormRequest
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
            'nama_penyewa' => 'required',
            'nik' => 'required|max:16',
            'no_telp' => 'required|max:20',
            'alamat' => 'required|max:50',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'lokasi' => 'required',
            'tanggal_sewa' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_sewa',
            'status' => 'required|in:paid,unpaid',
            'jenis_tanaman' => 'required',
            'luas' => 'required|numeric|min:0',
            'nominal' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ];
    }
}
