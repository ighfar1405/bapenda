<?php

namespace App\Repository\Statis;

use App\Entity\Statis\Tahun;

class TahunRepository
{
    /**
     * Get all akun.
     *
     * @return Collection
     */
    public function all(array $attributes = [])
    {
        #   set the default value of the array key
        $params = ['sort_tahun'];

        foreach ($params as $value) {
            if (!array_key_exists($value, $attributes)) {
                $attributes[$value] = null;
            }
        }

        $data = Tahun::when($attributes['sort_tahun'] == 'asc', function ($q) {
                $q->orderBy('tahun', 'asc');
            })
            ->orderBy('id', 'desc')
            ->get();

        return $data;
    }

    /**
     * Get tahun by id
     *
     * @param [int] $id
     * @return Tahun
     */
    public function findById($id)
    {
        return Tahun::find($id);
    }

    /**
     * Create tahun.
     *
     * @param array $attributes
     * @return JenisPembayaran
     */
    public function create(array $attributes)
    {
        return Tahun::create([
            'tahun' => $attributes['tahun'],
        ]);
    }

    /**
     * Edit tahun.
     *
     * @param int|string $id
     * @param array $attributes
     * @return JenisPembayaran
     */
    public function update($id, array $attributes)
    {
        return Tahun::findOrFail($id)->update([
            'tahun' => $attributes['tahun'],
        ]);
    }
}