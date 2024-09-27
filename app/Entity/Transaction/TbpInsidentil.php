<?php

namespace App\Entity\Transaction;

use App\Entity\Statis\Akun;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Entity\Statis\RekeningBank;
use Illuminate\Database\Eloquent\Model;

class TbpInsidentil extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'no_surat_izin', 'tanggal_izin', 'pemakai', 'nama_objek',
        'alamat_objek', 'tarif', 'tinggi', 'luas', 'jenis_pembayaran_id',
        'rekening_bank_id', 'akun_id',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['total_bayar_idr'];

    /**
     * Set tarif value.
     *
     * @param  string  $value
     * @return void
     */
    public function setTarifAttribute($value)
    {
        $value = Str::of($value)->replace('.', '');
        $this->attributes['tarif'] = Str::of($value)->replace(',', '.');
    }

    /**
     * Ambil tahun di Tanggal TBP
     *
     * @return void
     */
    public function getPrettyDate()
    {
        Carbon::setLocale('id');
        return Carbon::parse($this->attributes['tanggal_izin'])->translatedFormat('d F Y');
    }

    /**
     * Relation to jenis pembayaran
     *
     * @return void
     */
    public function jenisPembayaran()
    {
        return $this->belongsTo(JenisPembayaran::class, 'jenis_pembayaran_id');
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
     * Rumus untuk Total bayar
     *
     * @return float
     */
    public function totalBayar() : float
    {
        return $this->luas * $this->tinggi * $this->tarif;
    }

    /**
     * Ambil tahun di Tanggal Izin TBP Insidentil
     *
     * @return void
     */
    public function getYear()
    {
        return Carbon::createFromFormat('Y-m-d', $this->tanggal_izin)->year;

    }

    /**
     * Get value idr of Total Bayar
     *
     * @return void
     */
    public function getTotalBayarIdrAttribute()
    {
        return format_idr($this->totalBayar());
    }

    /**
     * Custom Format created_at
     *
     * @return void
     */
    public function getDateFormatted()
    {
        Carbon::setLocale('id');
        return Carbon::parse($this->attributes['created_at'])->translatedFormat('Y-m-d');
    }
}
