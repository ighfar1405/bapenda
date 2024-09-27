<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class SkrdRequest extends FormRequest
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
            'tanggal_penetapan' => 'required|date',
            'tanggal_jatuhtempo' => 'nullable|date',
            'pemakai' => 'required|exists:pemakai,id',
            'keterangan' => 'required|string|max:255',
            'object_retribusi' => 'required|exists:objek_retribusi,id',
            'nominal' => 'required'
        ];
    }
}
