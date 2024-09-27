<?php

namespace App\Entity\Transaction;

use Illuminate\Database\Eloquent\Model;

class Tanaman extends Model
{
    public $table = "jenis_tanaman";
    //
    protected $fillable = ['nama', 'tarif'];
}
