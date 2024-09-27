<?php

namespace App\Entity\Statis;

use Illuminate\Database\Eloquent\Model;

class RekeningBank extends Model
{
    /**
     * Definde table name
     */
    protected $table = 'rekening_bank';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_bank', 'no_rekening', 'akun_bendahara_id'
    ];

    /**
     * relation to akun
     */
    public function akunBendahara()
    {
        return $this->belongsTo(Akun::class, 'akun_bendahara_id');
    }
}
