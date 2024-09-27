<?php

namespace App\Entity\Master;

use App\Entity\Transaction\Skrd;
use App\Entity\Transaction\TbpDetail;
use App\Entity\User\Pemakai;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ObjekRetribusi extends Model
{
    /**
     * Definde table name
     */
    protected $table = 'objek_retribusi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode', 'pemakai_id', 'lokasi', 'luas', 'tarif_retribusi_id', 'kelurahan_id'
    ];

    /**
     * relation to tarif retribusi
     */
    public function tarifRetribusi()
    {
        return $this->belongsTo(TarifRetribusi::class);
    }
    
    /**
     * Relation to pemakai
     *
     */
    public function pemakai()
    {
        return $this->belongsTo(Pemakai::class);
    }

    /**
     * relation to skrd
     *
     * @return void
     */
    public function skrd()
    {
        return $this->hasOne(Skrd::class, 'object_retribusi_id', 'id');
    }

    /**
     * Relation to kelurahan.
     *
     */
    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class);
    }

}
