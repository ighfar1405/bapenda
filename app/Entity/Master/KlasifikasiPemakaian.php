<?php

namespace App\Entity\Master;

use Illuminate\Database\Eloquent\Model;

class KlasifikasiPemakaian extends Model
{
    /**
     * Definde table name
     */
    protected $table = 'klasifikasi_pemakaian';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'jenis_klasifikasi'
    ];

    public function totalKlasifikasi()
    {
        return $this->hasManyThrough(ObjekRetribusi::class, TarifRetribusi::class, 'klasifikasi_pemakaian_id', 'tarif_retribusi_id', 'id');
    }
}
