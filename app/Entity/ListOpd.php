<?php

namespace App\Entity;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ListOpd extends Model
{
    /**
     * Define table name
     */
    protected $table = 'list_opd';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_opd',
        'jenis_retribusi',
        'objek_retribusi',
        'rincian_objek',
        'sub_rincian_objek',
        'sub_sub_rincian_objek',
        'detail_rincian',
        'tarif',
        'satuan',
        'status',
        'link',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['tarif_idr'];

    /**
     * Status: Active
     *
     * @var string
     */
    public const ACTIVE = 'active';

    /**
     * Status: Inactive
     *
     * @var string
     */
    public const INACTIVE = 'inactive';

    /**
     * Get formatted tarif in IDR
     *
     * @return string
     */
    public function getTarifIdrAttribute()
    {
        return format_idr($this->attributes['tarif']);
    }

    /**
     * Get pretty date formatted
     *
     * @return string
     */
    public function getPrettyCreatedAtAttribute()
    {
        Carbon::setLocale('id');
        return Carbon::parse($this->attributes['created_at'])->translatedFormat('d F Y');
    }

    /**
     * Formatted status
     *
     * @return string
     */
    public function getStatusAttribute()
    {
        switch ($this->attributes['status']) {
            case self::ACTIVE:
                return 'Aktif';
            case self::INACTIVE:
                return 'Tidak Aktif';
            default:
                return 'Tidak Diketahui';
        }
    }
}
