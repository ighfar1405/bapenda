<?php

namespace App\Entity\Statis;

use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    /**
     * Definde table name
     */
    protected $table = 'akun';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode', 'nama'
    ];
}
