<?php

namespace App\Entity\Transaction;

use App\Entity\Master\ObjekRetribusi;
use App\Entity\Statis\Penomoran;
use App\Entity\User\Pemakai;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Skrd extends Model
{
    /**
     * Definde table name
     */
    protected $table = 'skrd';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nomor', 
        'nomor_otomatis', 
        'tanggal', 
        'pemakai_id', 
        'nominal', 
        'keterangan', 
        'object_retribusi_id',
        'skrd_wa',
        'monitor_piutang'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['nominal_idr', 'format_nomor', 'tahun', 'tanggal_ori', 'nominal_float'];

    /**
     * Get value idr
     *
     * @return void
     */
    public function getNominalIdrAttribute()
    {
        return format_idr($this->attributes['nominal']);
    }

    public function getNominalFloatAttribute()
    {
        return $this->attributes['nominal'];
    }

    public function getTanggalOriAttribute()
    {
        return $this->attributes['tanggal'];
    }

    public function getTanggalAttribute()
    {
        return Carbon::parse($this->attributes['tanggal'])->format('d M Y');
    }

    public function getTahunAttribute()
    {
        return Carbon::parse($this->attributes['tanggal'])->format('Y');
    }

    /**
     * Get value idr
     *
     * @return void
     */
    public function setNominalAttribute($value)
    {
        $value = Str::of($value)->replace('.', '');
        $this->attributes['nominal'] = Str::of($value)->replace(',', '.');
    }

    /**
     * relation to pemakai
     *
     * @return void
     */
    public function pemakai()
    {
        return $this->belongsTo(Pemakai::class);
    }

    /**
     * Relation to object retribusi
     *
     * @return void
     */
    public function objectRetribusi()
    {
        return $this->belongsTo(ObjekRetribusi::class, 'object_retribusi_id', 'id');
    }

    /**
     * Relation to tbp detail
     *
     * @return void
     */
    public function tbpDetail()
    {
        return $this->hasOne(TbpDetail::class);
    }

    /**
     * Get value idr
     *
     * @return void
     */
    public function getFormatNomorAttribute()
    {
        $penomoran = Penomoran::where('formulir', 'skrd')->first();
        if ($this->attributes['nomor_otomatis']){
            $tanggal = Carbon::parse($this->attributes['tanggal'])->format('Y');
            return nomor_fix($penomoran->format_penomoran, $this->attributes['nomor'], $tanggal);
        }
        return $this->attributes['nomor'];
    }

    /*
     * Ambil tahun di Tanggal SKRD
     *
     * @return void
     */
    public function getYear()
    {
        return Carbon::parse($this->attributes['tanggal'])->format('Y');
    }

    /**
     * Ambil data SKRD ditahun sebelumnya
     *
     * @return void
     */
    public function getPreviousYear()
    {
        $previousYear = $this->getYear() - 1;
        $date = Carbon::createFromDate($previousYear, 01, 01);
        $startOfYear = $date->copy()->startOfYear();
        $endOfYear = $date->copy()->endOfYear();

        $skrd = Skrd::with('tbpDetail')
            ->where('object_retribusi_id', $this->attributes['object_retribusi_id'])
            ->when($previousYear, function ($query) use ($previousYear, $startOfYear, $endOfYear) {
                if($previousYear)
                {
                    $date = Carbon::createFromDate($previousYear, 01, 01);
                    $startOfYear = $date->copy()->startOfYear();
                    $endOfYear = $date->copy()->endOfYear();

                    $query->whereBetween('tanggal', [$startOfYear, $endOfYear]);
                }
            })
            ->first();
        
        return $skrd;
    }

}
