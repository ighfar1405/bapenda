<?php

namespace App\Entity\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TarifRetribusi extends Model
{
    /**
     * Definde table name
     */
    protected $table = 'tarif_retribusi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kelas', 'golongan', 'range_njop', 'kode_tarif', 'klasifikasi_pemakaian_id', 'tarif_meter'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['tarif_meter_float'];

    /**
     * relation to klasifikasi pemakaian
     */
    public function klasifikasiPemakaian()
    {
        return $this->belongsTo(KlasifikasiPemakaian::class);
    }

    /**
     * Set value njop_max
     *
     * @param  string  $value
     * @return void
     */
    public function getTarifMeterAttribute($value)
    {
        return format_idr($value);
    }

    /**
     * Set value tarif_meter
     *
     * @param  string  $value
     * @return void
     */
    public function setTarifMeterAttribute($value)
    {
        $value = Str::of($value)->replace('.', '');
        $this->attributes['tarif_meter'] = Str::of($value)->replace(',', '.');
    }

    /**
     * Set value njop_max
     *
     * @param  string  $value
     * @return void
     */
    public function getTarifMeterFloatAttribute()
    {
        return $this->attributes['tarif_meter'];
    }
}
