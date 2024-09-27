<?php

namespace App\Entity\User;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    /**
     * Definde table name
     */
    protected $table = 'petugas';
    
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Relation to opd
     */
    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }
}
