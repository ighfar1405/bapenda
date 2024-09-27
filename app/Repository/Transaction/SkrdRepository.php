<?php

namespace App\Repository\Transaction;

use App\Entity\Transaction\Skrd;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use App\Entity\Transaction\Tbp;

// use DB;
class SkrdRepository
{
    /**
     * Get all Skrd with pagination.
     *
     * @return Collection
     */
    public function sumAll(array $attributes = []){

       return DB::table('skrd')->selectRaw('SUM(nominal) as total,YEAR(tanggal) as tahun,(SELECT SUM(tbp_detail.nominal) as total_tbp FROM tbp LEFT JOIN tbp_detail ON tbp.id = tbp_detail.tbp_id
        WHERE YEAR(tbp.tanggal) = tahun) as ttl')
        ->groupBy('tahun')
        ->orderBy('tahun')
        ->get();

    }
    public function allPaginate($attributes)
    {
        $keyword = null;
        $year = date('Y');

        if($attributes->keyword)
            $keyword = $attributes->keyword;

        if($attributes->year)
            $year = $attributes->year;

        return Skrd::orderBy('created_at', 'desc')
            ->with('pemakai', 'objectRetribusi', 'tbpDetail')
            ->whereHas('pemakai', function ($query) use ($keyword) {
                if($keyword)
                    $query->where('nama', 'like', '%'. $keyword . '%');
            })
            ->whereHas('objectRetribusi',function($sql){

                if (!empty(request()->query('loc')) && request()->query('loc') != '.') {
                    $sql->where('lokasi', 'like', '%'.request()->query('loc').'%');
                }

                if (!empty(request()->query('kec')) && request()->query('kec') != '.') {
                    $sql->whereHas('kelurahan', function($sql){
                        $sql->where('kecamatan_id', request()->query('kec'));
                    });
                }
            })
            ->when($year, function ($query) use ($year) {
                if($year){
                    $date = Carbon::createFromDate($year, 01, 01);
                    $startOfYear = $date->copy()->startOfYear();
                    $endOfYear = $date->copy()->endOfYear();

                    $query->whereBetween('tanggal', [$startOfYear, $endOfYear]);
                }
            })
            ->paginate(10);
    }

    /**
     * Get all skrd.
     *
     * @return void
     */
    public function all()
    {
        return Skrd::orderBy('id', 'asc')
            ->with('pemakai', 'objectRetribusi')
            ->get();
    }

    /**
     * Count all SKRD
     *
     * @return integer
     */
    public function countSkrd($year) : int
    {
        return Skrd::when($year, function($query) use($year) {
                if( isset($year))
                {
                    $date = Carbon::createFromDate($year, 01, 01);
                    $startOfYear = $date->copy()->startOfYear();
                    $endOfYear = $date->copy()->endOfYear();

                    $query->whereBetween('tanggal', [$startOfYear, $endOfYear]);
                }
            })
            ->get()
            ->count();
    }

    /**
     * Count all Pemakai (Unique)
     *
     * @return integer
     */
    public function countPemakai() : int
    {
        return Skrd::select('pemakai_id')
            ->groupBy('pemakai_id')
            ->get()
            ->count();
    }

    /**
     * Count all Pemakai (Unique)
     *
     * @return integer
     */
    public function sumNominal()
    {
        return DB::table('skrd')->sum('nominal');
    }

    /**
     * Get Skrd by id
     *
     * @param [int] $id
     * @return Skrd
     */
    public function find($id)
    {
        return Skrd::where('id', $id)->with('pemakai', 'objectRetribusi.tarifRetribusi.klasifikasiPemakaian')->first();
    }

    /**
     * Create Skrd.
     *
     * @param array $attributes
     * @return Skrd
     */
    public function create(array $attributes, $nomor, $nomorOtomatis)
    {
        return Skrd::create([
            'nomor' => $nomor,
            'nomor_otomatis' => $nomorOtomatis,
            'tanggal' => $attributes['tanggal_penetapan'],
            'due_date' => $attributes['tanggal_jatuhtempo'],
            'pemakai_id' => $attributes['pemakai'],
            'nominal' => $attributes['nominal'],
            'keterangan' => $attributes['keterangan'],
            'object_retribusi_id' => $attributes['object_retribusi']
        ]);
    }

    /**
     * Edit Skrd.
     *
     * @param int|string $id
     * @param array $attributes
     * @return Skrd
     */
    public function update(array $attributes, $id)
    {
        return Skrd::findOrFail($id)->update([
            'tanggal' => $attributes['tanggal_penetapan'],
            'due_date' => $attributes['tanggal_jatuhtempo'],
            'pemakai_id' => $attributes['pemakai'],
            'nominal' => $attributes['nominal'],
            'keterangan' => $attributes['keterangan'],
            'object_retribusi_id' => $attributes['object_retribusi']
        ]);
    }

    /**
     * Delete Skrd.
     *
     * @param int|string $id
     * @return Skrd
     */
    public function delete($id)
    {
        return Skrd::findOrFail($id)->delete();
    }

    /**
     * Get last number skrd with automatic number
     *
     * @return void
     */
    public function getLastNomor()
    {
        $skrd = Skrd::where('nomor_otomatis', true)
            ->orderBy('id', 'desc')
            ->first();

        if ($skrd){
            return $skrd->nomor+1;
        }
        return 1;
    }

    /**
     * Get all SKRD based on kecamatan and year.
     *
     * @param array $attributes
     * @return void
     */
    public function getSkrdKecamatan(array $attributes)
    {
        $tahun = null;
        $kecamatanId = null;
        $status = null;

        if($attributes['kecamatan'])
            $kecamatanId = $attributes['kecamatan'];
        if($attributes['tahun'])
            $tahun = $attributes['tahun'];
        if(isset($attributes['status']))
            $status = $attributes['status'];

        $skrd = Skrd::with('tbpDetail', 'pemakai', 'objectRetribusi.kelurahan.kecamatan',
                'objectRetribusi.tarifRetribusi.klasifikasiPemakaian')
            ->whereHas('objectRetribusi.kelurahan.kecamatan', function ($query) use ($kecamatanId) {
                if($kecamatanId)
                    $query->where('id', $kecamatanId);
            })
            ->when($tahun, function ($query) use ($tahun) {
                if($tahun)
                {
                    $date = Carbon::createFromDate($tahun, 01, 01);
                    $startOfYear = $date->copy()->startOfYear();
                    $endOfYear = $date->copy()->endOfYear();

                    $query->whereBetween('tanggal', [$startOfYear, $endOfYear]);
                }
            })
            ->where(function($query) use ($status) {
                switch($status)
                {
                    case '1': $query->has('tbpDetail'); break;
                    case '2': $query->doesntHave('tbpDetail'); break;
                }
            })
            ->get();

        return $skrd;
    }
    public function sumAllKcmtn()
    {
        return DB::select(DB::raw("SELECT SUM(nominal) AS total,YEAR(tanggal) AS tahun,
        kecamatan.nama AS nama_kecamatan
	,(SELECT SUM(tbp_detail.nominal) AS total_tbp FROM tbp LEFT JOIN tbp_detail ON tbp.id = tbp_detail.tbp_id
        LEFT JOIN pemakai ON pemakai.id = tbp.pemakai_id
        LEFT JOIN kelurahan ON kelurahan.id = pemakai.kelurahan_id
        LEFT JOIN kecamatan ON kecamatan.id = kelurahan.kecamatan_id
	 WHERE YEAR(tbp.tanggal) = tahun AND kecamatan.nama = nama_kecamatan) AS ttl

         FROM skrd LEFT JOIN pemakai ON pemakai.id = skrd.pemakai_id LEFT JOIN kelurahan ON kelurahan.id = pemakai.kelurahan_id LEFT JOIN kecamatan ON kecamatan.id = kelurahan.kecamatan_id GROUP BY `tahun`,kecamatan.nama ORDER BY `tahun` ASC"));
    }

    public function sumNominalByYear($year=null)
    {
        if(null == $year) {
            $year = now();
        }

        return Skrd::whereYear('tanggal', $year)->sum('nominal');
    }
}
