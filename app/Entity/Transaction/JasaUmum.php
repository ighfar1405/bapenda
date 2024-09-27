<?php

namespace App\Entity\Transaction;

use Illuminate\Database\Eloquent\Model;

class JasaUmum extends Model
{
    //
    protected $fillable = ['nama_penyetor', 'no_ktp', 'objek_setoran', 'lokasi_objek', 'jumlah_setoran'];
}
