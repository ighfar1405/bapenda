<?php

namespace App\Repository\Transaction;

use App\Entity\Transaction\JenisPembayaran;

class JenisPembayaranRepository
{
    /**
     * Get all jenis pembayaran.
     *
     * @return Collection
     */
    public function all()
    {
        return JenisPembayaran::orderBy('kode_jurnal', 'asc')->get();
    }

    /**
     * Get jenis pembayaran by id
     *
     * @param [int] $id
     * @return JenisPembayaran
     */
    public function findById($id)
    {
        return JenisPembayaran::find($id);
    }

    /**
     * Get jenis pembayaran by Name.
     *
     * @return Boolean
     */
    public function findByName($name)
    {
        return JenisPembayaran::where('kode_jurnal', $name)->exists();
    }

    /**
     * Create jenis pembayaran.
     *
     * @param array $attributes
     * @return JenisPembayaran
     */
    public function create(array $attributes)
    {
        return JenisPembayaran::create([
            'kode_jurnal' => $attributes['kode_jurnal'],
            'formulir' => $attributes['formulir'],
            'deskripsi' => $attributes['deskripsi'],
        ]);
    }

    /**
     * Edit jenis pembayaran.
     *
     * @param int|string $id
     * @param array $attributes
     * @return JenisPembayaran
     */
    public function update($id, array $attributes)
    {
        return JenisPembayaran::findOrFail($id)->update([
            'kode_jurnal' => $attributes['kode_jurnal'],
            'formulir' => $attributes['formulir'],
            'deskripsi' => $attributes['deskripsi'],
        ]);
    }

    /**
     * Delete jenis pembayaran.
     *
     * @param int|string $id
     * @return JenisPembayaran
     */
    public function delete($id)
    {
        return JenisPembayaran::findOrFail($id)->delete();
    }
}
