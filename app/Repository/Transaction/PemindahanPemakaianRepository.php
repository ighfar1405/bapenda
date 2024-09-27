<?php

namespace App\Repository\Transaction;

use App\Entity\Master\ObjekRetribusi;
use App\Entity\Transaction\PemindahanPemakaian;
use Illuminate\Support\Facades\DB;

class PemindahanPemakaianRepository
{
    /**
     * Get all pemindahan pemakaian data
     * 
     * @return Collection
     */
    public function all()
    {
        $data = PemindahanPemakaian::with('objekRetribusi', 'pemakaiLama', 'pemakaiBaru', 'klasifikasiPemakaian', 'objekRetribusi.kelurahan.kecamatan')
            ->orderBy('id', 'DESC')
            ->get();

        return $data;
    }

    /**
     * Get all pemindahan pemakaian data paginated
     * 
     * @return Collection
     */
    public function allPaginate(array $attributes = [])
    {
        #   set the default value of the array key
        $params = [
            'sort_lama',
            'sort_baru',
            'sort_kecamatan',
            'sort_kode',
            'sort_luas'
        ];

        foreach ($params as $value) {
            if (!array_key_exists($value, $attributes)) {
                $attributes[$value] = null;
            }
        }

        $data = PemindahanPemakaian::with('objekRetribusi', 'pemakaiLama', 'pemakaiBaru', 'klasifikasiPemakaian', 'objekRetribusi.kelurahan.kecamatan')
            ->whereHas('pemakaiLama', function ($q) use ($attributes) {
                $q->when($attributes['sort_lama'] == 'desc', function ($i) {
                    $i->orderBy('nama', 'desc');
                });
            })
            ->whereHas('pemakaiBaru', function ($q) use ($attributes) {
                $q->when($attributes['sort_lama'] == 'desc', function ($i) {
                    $i->orderBy('nama', 'desc');
                });
            })
            ->whereHas('objekRetribusi.kelurahan.kecamatan', function ($q) use ($attributes) {
                $q->when($attributes['sort_kecamatan'] == 'desc', function ($i) {
                    $i->orderBy('nama', 'desc');
                });
            })
            ->whereHas('objekRetribusi', function ($q) use ($attributes) {
                $q->when($attributes['sort_luas'] == 'desc', function ($i) {
                    $i->orderBy('luas', 'desc');
                });
            })
            ->whereHas('objekRetribusi', function ($q) use ($attributes) {
                $q->when($attributes['sort_kode'] == 'desc', function ($i) {
                    $i->orderBy('kode', 'desc');
                });
            })
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return $data;
    }

    /**
     * Insert to pemindahan pemakaian
     * 
     * @param array $attributes
     * @return PemindahanPemakaian
     */
    public function create(array $attributes)
    {
        DB::transaction(function () use ($attributes) {
            $updateObjekRetribusi = ObjekRetribusi::findOrFail($attributes['objek_retribusi_id'])->update([
                'pemakai_id' => $attributes['pemakai_baru']
            ]);

            $createPemindahan = PemindahanPemakaian::create([
                'objek_retribusi_id' => $attributes['objek_retribusi_id'],
                'pemakai_lama' => $attributes['pemakai_lama_id'],
                'pemakai_baru' => $attributes['pemakai_baru'],
                'no_sk' => $attributes['no_sk'],
                'tanggal_sk' => $attributes['tanggal_sk'],
                'klasifikasi_pemakaian_id' => $attributes['klasifikasi_pemakaian_id']
            ]);

            return $createPemindahan;
        });
    }

    /**
     * find item by Id
     * 
     * @return Collection
     */
    public function find($id)
    {
        $data = PemindahanPemakaian::with('pemakaiLama', 'pemakaiBaru', 'klasifikasiPemakaian', 'objekRetribusi')
            ->where('id', $id)
            ->first();

        return $data;
    }

    /**
     * Update item by ID
     * 
     * @param int $id
     * @param array $attributes
     * @return Collection
     */
    public function update($id, $attributes)
    {
        DB::transaction(function () use ($id, $attributes) {
            $updateObjekRetribusi = ObjekRetribusi::findOrFail($attributes['objek_retribusi_id'])->update([
                'pemakai_id' => $attributes['pemakai_baru']
            ]);

            $updatePemindahan = PemindahanPemakaian::findOrFail($id)->update([
                'objek_retribusi_id' => $attributes['objek_retribusi_id'],
                'pemakai_lama' => $attributes['pemakai_lama_id'],
                'pemakai_baru' => $attributes['pemakai_baru'],
                'no_sk' => $attributes['no_sk'],
                'tanggal_sk' => $attributes['tanggal_sk'],
                'klasifikasi_pemakaian_id' => $attributes['klasifikasi_pemakaian_id']
            ]);

            return $updatePemindahan;
        });
    }

    /**
     * delete item by ID
     * 
     * @param int $id
     * @return Collection
     */
    public function delete($id)
    {
        DB::transaction(function () use ($id){
            $data = PemindahanPemakaian::find($id)->first();
            
            $updateOps = ObjekRetribusi::findOrFail($data->objek_retribusi_id)->update([
                'pemakai_id' => $data->pemakai_lama
            ]);

            $deleteOps = PemindahanPemakaian::findOrFail($id)->delete(); 
            
            return $deleteOps;
        });
    }
}
