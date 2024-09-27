<?php

namespace App\Entity\Transaction;

use Illuminate\Support\Str;
use App\Entity\Master\ObjekRetribusi;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TbpDetail extends Model
{
    /**
     * Definde table name
     */
    protected $table = 'tbp_detail';

    /**
     * The attributes that are mass assignable.
     *tbp_detail
     * @var array
     */
    protected $fillable = [
        'tbp_id', 'skrd_id', 'objek_retribusi_id', 'nominal', 'jenis_pembayaran_id',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['nominal_idr'];

    /**
     * Set value nominal
     *
     * @param  string  $value
     * @return void
     */
    public function setNominalAttribute($value)
    {
        $value = Str::of($value)->replace('.', '');
        $this->attributes['nominal'] = Str::of($value)->replace(',', '.');
    }

    /**
     * Get value idr
     *
     * @return void
     */
    public function getNominalIdrAttribute()
    {
        return format_idr($this->attributes['nominal']);
    }

    /**
     * Relation to skrd
     *
     * @return void
     */
    public function skrd()
    {
        return $this->belongsTo(Skrd::class);
    }

    /**
     * Relation to objectRetribusi
     *
     * @return void
     */
    public function objectRetribusi()
    {
        return $this->belongsTo(ObjekRetribusi::class, 'objek_retribusi_id');
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
     * Relation to tbp
     *
     * @return void
     */
    public function tbp()
    {
        return $this->belongsTo(Tbp::class);
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
