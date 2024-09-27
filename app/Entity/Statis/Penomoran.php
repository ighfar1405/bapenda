<?php

namespace App\Entity\Statis;

use Illuminate\Database\Eloquent\Model;

class Penomoran extends Model
{
    const FORMULIR = ['skrd', 'tbp'];
    /**
     * Definde table name
     */
    protected $table = 'penomoran';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'formulir', 'format_penomoran'
    ];

    public function getAttributeFormulir($key)
    {
        return ucfirst($key);
    }
}
