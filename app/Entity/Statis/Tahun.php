<?php

namespace App\Entity\Statis;

use Illuminate\Database\Eloquent\Model;

class Tahun extends Model
{
    /**
     * Definde table name
     */
    protected $table = 'tahun';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tahun'
    ];
}
