<?php

namespace App\Entity\Master;

use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    /**
     * Definde table name
     */
    protected $table = 'kelurahan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode_administratif', 'kecamatan_id', 'nama'
    ];

    /**
     * relation to kecamatan
     */
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }
}
