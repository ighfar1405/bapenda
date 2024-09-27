<?php

namespace App\Repository\Master;

use App\Entity\Master\Kelurahan;

class KelurahanRepository
{
    /**
     * Get all kelurahan.
     *
     * @return Collection
     */
    public function all()
    {
        return Kelurahan::orderBy('id', 'desc')->get();
    }

    /**
     * Create kelurahan.
     *
     * @param array $attributes
     * @return Opd
     */
    public function create(array $attributes = [])
    {
        return Kelurahan::create([
            'kecamatan_id' => $attributes['kecamatan_id'],
            'kode_administratif' => $attributes['kode_administratif'],
            'nama' => $attributes['nama_kelurahan']
        ]);
    }

    /**
     * Get kelurahan by did
     *
     * @param [int] $id
     * @return Kelurahan
     */
    public function find($id)
    {
        return Kelurahan::find($id);
    }

    /**
     * Get all kelurahan by kecamatan id
     *
     * @param  string | integer $kecamatanId
     * @return Collection
     */
    public function allKelurahanByKecamatan($kecamatanId, $attributes = [])
    {
        #   set the default value of the array key
        $params = [
            'sort_kode',
            'sort_kelurahan'
        ];

        foreach ($params as $value) {
            if (!array_key_exists($value, $attributes)) {
                $attributes[$value] = null;
            }
        }

        $data = Kelurahan::where('kecamatan_id', $kecamatanId)
            ->when($attributes['sort_kelurahan'] == 'desc', function ($q) {
                $q->orderBy('nama', 'desc');
            })
            ->when($attributes['sort_kode'] == 'desc', function ($q) {
                $q->orderBy('kode_administratif', 'desc');
            })
            #->orderBy('id', 'desc')
            ->get(); 

        return $data;
    }

    /**
     * Delete all kelurahan by kecamatan
     *
     * @param String | Integer $kecamatanId
     * @return Kelurahan
     */
    public function deleteKelurahanByKecamatanId($kecamatanId)
    {
        return Kelurahan::where('kecamatan_id', $kecamatanId)->delete();
    }

    /**
     * Edit Kelurahan.
     *
     * @param int|string $id
     * @param array $attributes
     * @return Kelurahan
     */
    public function update($id, array $attributes)
    {
        return Kelurahan::findOrFail($id)->update([
            'nama' => $attributes['nama_kelurahan'],
            'kode_administratif' => $attributes['kode_administratif'],
        ]);
    }

    /**
     * Delete Kelurahan.
     *
     * @param int|string $id
     * @return Kelurahan
     */
    public function delete($id)
    {
        return Kelurahan::findOrFail($id)->delete();
    }
}
