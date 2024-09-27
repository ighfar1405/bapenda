<?php

namespace App\Entity\Transaction;

use App\Entity\Master\KlasifikasiPemakaian;
use App\Entity\Master\ObjekRetribusi;
use App\Entity\User\Pemakai;
use Illuminate\Database\Eloquent\Model;

class PemindahanPemakaian extends Model
{
    /**
     * Definde table name
     */
    protected $table = 'pemindahan_pemakaian';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'objek_retribusi_id', 'pemakai_lama', 'pemakai_baru', 'no_sk', 'tanggal_sk', 'klasifikasi_pemakaian_id'
    ];

    /**
     * relation to objek retribusi
     */
    public function objekRetribusi()
    {
        return $this->belongsTo(ObjekRetribusi::class);
    }

    /**
     * relation to pemakai
     */
    public function pemakaiLama()
    {
        return $this->belongsTo(Pemakai::class, 'pemakai_lama', 'id');
    }

    /**
     * relation to pemakai
     */
    public function pemakaiBaru()
    {
        return $this->belongsTo(Pemakai::class, 'pemakai_baru', 'id');
    }

    /**
     * relation to klasifikasi pemakaian
     */
    public function klasifikasiPemakaian()
    {
        return $this->belongsTo(KlasifikasiPemakaian::class);
    }
}
