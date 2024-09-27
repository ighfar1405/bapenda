<?php

namespace App\Entity\Transaction;

use Illuminate\Database\Eloquent\Model;

class JenisPembayaran extends Model
{
    /**
     * Kode Jurnal TBP-OA
     * 
     * @return String
     */
    const TBP_OA = 'TBP-OA';
    
    /**
     * Kode Jurnal TBP-PUTG
     * 
     * @return String
     */
    const TBP_PUTG = 'TBP-PUTG';
    
    /**
     * Kode Jurnal TBP-SA
     * 
     * @return String
     */
    const TBP_SA = 'TBP-SA';

    /**
     * Definde table name
     */
    protected $table = 'jenis_pembayaran';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode_jurnal', 'formulir', 'deskripsi'
    ];
}
