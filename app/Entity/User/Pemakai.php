<?php

namespace App\Entity\User;

use App\Entity\Master\Kelurahan;
use App\Entity\Master\ObjekRetribusi;
use App\Entity\Transaction\Skrd;
use Illuminate\Database\Eloquent\Model;

class Pemakai extends Model
{
    /**
     * Definde table name
     */
    protected $table = 'pemakai';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Relation to kelurahan.
     *
     */
    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class);
    }

    /**
     * Relation to skrd.
     *
     */
    public function skrd()
    {
        return $this->hasMany(Skrd::class);
    }

    /**
     * Relation to objek retribusi
     *
     * @return void
     */
    public function objectRetribusi()
    {
        return $this->hasMany(ObjekRetribusi::class);
    }
}
