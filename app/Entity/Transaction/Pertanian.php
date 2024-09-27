<?php

namespace App\Entity\Transaction;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Pertanian extends Model
{
    /**
     * Define table name
     */
    protected $table = 'pertanian';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_penyewa',
        'lokasi',
        'jenis_tanaman_id',
        'nominal',
        'nominal_bayar',
        'sisa_bayar',
        'tanggal_sewa',
        'status',
        'keterangan',
        'luas',
        'kecamatan_id',
        'kelurahan_id',
        'nik',
        'tgl_selesai',
        'alamat_penyewa',
        'no_telp',
        'tanggal_bayar',
        'no_bukti_bayar',
        'jenis_bayar'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['nominal_idr'];

    /**
     * Status Pembayaran: Sudah Bayar
     *
     * @var string
     */
    public const PAID = 'paid';

    /**
     * Status Pembayaran: Belum Bayar
     *
     * @var string
     */
    public const UNPAID = 'unpaid';

    /**
     * Get formatted nominal in IDR.
     *
     * @return string
     */
    public function getNominalIdrAttribute()
    {
        return format_idr($this->attributes['nominal']);
    }

    /**
     * Get pretty date formatted.
     *
     * @return string
     */
    public function getPrettyDate()
    {
        Carbon::setLocale('id');
        return Carbon::parse($this->attributes['tanggal_sewa'])->translatedFormat('d F Y');
    }

    /**
     * Get formatted status.
     *
     * @return string
     */
    public function getStatusAttribute()
    {
        switch ($this->attributes['status']) {
            case self::PAID:
                return 'Sudah Bayar';
            case self::UNPAID:
                return 'Belum Bayar';
            default:
                return 'Status Tidak Diketahui';
        }
    }

    /**
     * Relation to Kecamatan.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getKecamatan()
    {
        return $this->belongsTo('App\Entity\Master\Kecamatan', 'kecamatan_id');
    }

    /**
     * Relation to Kelurahan.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getKelurahan()
    {
        return $this->belongsTo('App\Entity\Master\Kelurahan', 'kelurahan_id');
    }

    /**
     * Relation to Jenis Tanaman.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getTanaman()
    {
        return $this->belongsTo('App\Entity\Master\JenisTanaman', 'jenis_tanaman_id');
    }
}
