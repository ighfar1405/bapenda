<?php

namespace App\Repository\Statis;

use App\Entity\Statis\Akun;

class AkunRepository
{
    /**
     * Get all akun.
     *
     * @return Collection
     */
    public function all(array $attributes = [])
    {
        #   set the default value of the array key
        $params = [
            'sort_kode',
            'sort_nama'
        ];

        foreach ($params as $value) {
            if (!array_key_exists($value, $attributes)) {
                $attributes[$value] = null;
            }
        }

        $data = Akun::when($attributes['sort_kode'] == 'desc', function ($q) {
                $q->orderBy('kode', 'desc');
            })
            ->when($attributes['sort_nama'] == 'desc', function ($q) {
                $q->orderBy('nama', 'desc');
            })
            ->get();

        return $data;
    }

    /**
     * Get akun by id
     *
     * @param [int] $id
     * @return Akun
     */
    public function findById($id)
    {
        return Akun::find($id);
    }

    /**
     * Create akun.
     *
     * @param array $attributes
     * @return Akun
     */
    public function create(array $attributes)
    {
        return Akun::create([
            'kode' => $attributes['kode'],
            'nama' => $attributes['nama'],
        ]);
    }

    /**
     * Edit akun.
     *
     * @param int|string $id
     * @param array $attributes
     * @return Akun
     */
    public function update($id, array $attributes)
    {
        return Akun::findOrFail($id)->update([
            'kode' => $attributes['kode'],
            'nama' => $attributes['nama'],
        ]);
    }

    /**
     * Delete akun.
     *
     * @param int|string $id
     * @return Akun
     */
    public function delete($id)
    {
        return Akun::findOrFail($id)->delete();
    }

    /**
     * Get akun bendahara
     *
     * @return void
     */
    public function getAkunBendahara(string $kodeAkun = '1.1.1.03.60')
    {
        return Akun::where('kode', $kodeAkun)->first();
    }
}
