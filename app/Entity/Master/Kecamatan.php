<?php

namespace App\Entity\Master;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    /**
     * Definde table name
     */
    protected $table = 'kecamatan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode_administratif', 'nama'
    ];
}
