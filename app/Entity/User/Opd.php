<?php

namespace App\Entity\User;

use Illuminate\Database\Eloquent\Model;

class Opd extends Model
{
    /**
     * Definde table name
     */
    protected $table = 'opd';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
