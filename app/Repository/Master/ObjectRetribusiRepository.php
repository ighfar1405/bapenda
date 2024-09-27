<?php

namespace App\Repository\Master;

use App\Entity\Master\ObjekRetribusi;
use Illuminate\Support\Facades\DB;

class ObjectRetribusiRepository
{
    /**
     * Get all object retribusi.
     *
     * @return Collection
     */
    public function all($kode = null, $kelurahan = null)
    {
        return ObjekRetribusi::orderBy('id', 'desc')
            ->with('kelurahan', 'tarifRetribusi.klasifikasiPemakaian', 'pemakai')
            ->when($kode, function ($query) use ($kode) {
                $query->where('kode', $kode);
            })
            ->when($kelurahan, function ($query) use ($kelurahan) {
                $query->where('kelurahan_id', $kelurahan);
            })
            ->get();
    }

    /**
     * Get all object retribusi with pagination.
     *
     * @return Collection
     */
    public function allPaginate(array $attributes)
    {
        return ObjekRetribusi::groupBy('objek_retribusi.kode')->orderBy('created_at', 'desc')
            ->with('kelurahan', 'tarifRetribusi.klasifikasiPemakaian', 'pemakai')
            ->whereHas('pemakai', function ($query) use ($attributes) {
                if($attributes['keyword']) $query->where('nama', 'like', '%' . $attributes['keyword'] . '%');
                if ($attributes['lokasi']) $query->where('lokasi', 'like', '%' . $attributes['lokasi'] . '%');
            })
            ->paginate(10);
    }

    /**
     * Create opd.
     *
     * @param array $attributes
     * @return Opd
     */
    public function create(array $attributes)
    {
        return ObjekRetribusi::create([
            'kode' => $attributes['kode'],
            'pemakai_id' => $attributes['pemakai'], 
            'lokasi' => $attributes['lokasi'], 
            'luas' => $attributes['luas'], 
            'tarif_retribusi_id' => $attributes['tarif_retribusi'],
            'kelurahan_id' => $attributes['kelurahan']
        ]);
    }

    /**
     * Get kecamatan by did
     *
     * @param [int] $id
     * @return Kecamatan
     */
    public function find($id)
    {
        return ObjekRetribusi::where('id', $id)->with(['tarifRetribusi.klasifikasiPemakaian'])->first();
    }

    /**
     * Edit kecamatan.
     *
     * @param int|string $id
     * @param array $attributes
     * @return Kecamatan
     */
    public function update($id, array $attributes)
    {
        return ObjekRetribusi::findOrFail($id)->update([
            'kode' => $attributes['kode'],
            'pemakai_id' => $attributes['pemakai'],
            'lokasi' => $attributes['lokasi'],
            'luas' => $attributes['luas'],
            'tarif_retribusi_id' => $attributes['tarif_retribusi'],
            'kelurahan_id' => $attributes['kelurahan']
        ]);
    }

    /**
     * Delete Kecamatan.
     *
     * @param int|string $id
     * @return Kecamatan
     */
    public function delete($id)
    {
        return ObjekRetribusi::findOrFail($id)->delete();
    }

    /**
     * Get object retribusi by pemakai
     *
     * @param [type] $pemakaiId
     * @return void
     */
    public function getObjectRetribusiByPemakai($pemakaiId)
    {
        return ObjekRetribusi::where('pemakai_id', $pemakaiId)->get();
    }

    /**
     * Update tarif from request
     *
     * @param [array] $request
     * @param [int|string] $id
     * @return void
     */
    public function updateTarif($request, $id)
    {
        $object = ObjekRetribusi::findOrFail($id)->update([
            'tarif_retribusi_id' => $request->tarif
        ]);

        return ObjekRetribusi::find($id);
        
    }

    /**
     * Data Objek Retribusi Piutang
     *
     * @return void
     */
    public function getPiutang()
    {
        return ObjekRetribusi::with('skrd.tbpDetail', 'pemakai')->whereHas('skrd')->get();
    }

    /**
     * Data objek retribusi yang dikelompokkan berdasarkan kode
     * 
     * @return void
     */
    public function getGroupedByKode($keluarahanId)
    {
        DB::statement("SET SQL_MODE=''");   //  set mode sql supaya bisa pake groupping tanpa id
        $data = ObjekRetribusi::
            with('kelurahan')
            ->when($keluarahanId, function ($q) use ($keluarahanId) {
                $q->whereHas('kelurahan', function ($query) use ($keluarahanId) {
                    $query->where('id', $keluarahanId);
                });
            })
            ->groupBy('kode')->orderBy('kode', 'ASC')->get();
        
        return $data;
    }
}
