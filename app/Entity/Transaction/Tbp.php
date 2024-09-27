<?php

namespace App\Entity\Transaction;

use App\Entity\Statis\Akun;
use App\Entity\Statis\Penomoran;
use App\Entity\Statis\RekeningBank;
use App\Entity\User\Pemakai;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Tbp extends Model
{
    /**
     * Definde table name
     */
    protected $table = 'tbp';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nomor', 'nomor_otomatis', 'tanggal', 'rekening_bank_id', 'akun_id', 
        'pemakai_id', 'keterangan', 'jenis'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['format_nomor'];

    /**
     * Jenis SKRD.
     * 
     * @var string
     */
    public const JENIS_SKRD = 'skrd';

    /**
     * Jenis Object Retribusi.
     * 
     * @var string
     */
    public const JENIS_OBJECT_RETRIBUSI = 'object_retribusi';

    /**
     * Relation to pemakai
     *
     * @return void
     */
    public function pemakai()
    {
        return $this->belongsTo(Pemakai::class);
    }

    /**
     * Relation to rekening bank
     *
     * @return void
     */
    public function rekeningBank()
    {
        return $this->belongsTo(RekeningBank::class);
    }

    /**
     * Relation to akun bendahara
     *
     * @return void
     */
    public function akunBendahara()
    {
        return $this->belongsTo(Akun::class);
    }

    /**
     * Relation to Tbp.
     *
     */
    public function tbpDetail()
    {
        return $this->hasMany(TbpDetail::class, 'tbp_id');
    }

    /**
     * Ambil tahun di Tanggal TBP
     *
     * @return void
     */
    public function getYear()
    {
        return Carbon::createFromFormat('Y-m-d', $this->tanggal)->year;
    }

    /**
     * Ambil tahun di Tanggal TBP
     *
     * @return void
     */
    public function getPrettyDate()
    {
        Carbon::setLocale('id');
        return Carbon::parse($this->attributes['tanggal'])->translatedFormat('d F Y');
    }

    /**
     * Get format nomor
     *
     * @return void
     */
    public function getFormatNomorAttribute()
    {
        $penomoran = Penomoran::where('formulir', 'tbp')->first();
        if ($this->attributes['nomor_otomatis']){
            $tanggal = Carbon::parse($this->attributes['tanggal'])->format('Y');
            return nomor_fix($penomoran->format_penomoran, $this->attributes['nomor'], $tanggal);
        }
        return $this->attributes['nomor'];
    }
}
