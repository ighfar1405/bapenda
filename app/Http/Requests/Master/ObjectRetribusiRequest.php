<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;

class ObjectRetribusiRequest extends FormRequest
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
            'kode' => 'nullable|string|max:255', 
            'pemakai' => 'required|exists:pemakai,id', 
            'lokasi' => 'required|string|max:255', 
            'luas' => 'required', 
            'tarif_retribusi' => 'required|exists:tarif_retribusi,id',
            'tarif' => 'required|between:0,99.99',
            'kelurahan' => 'required|exists:kelurahan,id'
        ];
    }
}
