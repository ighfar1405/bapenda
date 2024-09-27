<?php

namespace App\Repository\User;

use App\Entity\User\Petugas;

class PetugasRepository
{
    /**
     * Get all petugas.
     *
     * @return Collection
     */
    public function all()
    {
        return Petugas::with('opd')->orderBy('id', 'desc')->get();
    }

    /**
     * Find petugas by id.
     *
     * @param int|string
     * @return Petugas
     */
    public function find($id)
    {
        return Petugas::with('opd')->findOrFail($id);
    }

    /**
     * Create petugas.
     *
     * @param array $attributes
     * @return Petugas
     */
    public function create(array $attributes)
    {
        // check checkbox input
        if (! isset($attributes['aktif']))
            $attributes['aktif'] = false;
        else
            $attributes['aktif'] = true;

        return Petugas::create([
            'opd_id' => $attributes['kode_opd'],
            'nama' => $attributes['nama_pejabat'],
            'jabatan' => $attributes['jabatan'],
            'pangkat' => $attributes['pangkat'],
            'is_active' => $attributes['aktif'],
        ]);
    }

    /**
     * Edit petugas.
     *
     * @param int|string $id
     * @param array $attributes
     * @return Petugas
     */
    public function update($id, array $attributes)
    {
        // check checkbox input
        if (! isset($attributes['aktif']))
            $attributes['aktif'] = false;
        else
            $attributes['aktif'] = true;

        return Petugas::findOrFail($id)->update([
            'opd_id' => $attributes['kode_opd'],
            'nama' => $attributes['nama_pejabat'],
            'nip' => $attributes['nip'],
            'jabatan' => $attributes['jabatan'],
            'pangkat' => $attributes['pangkat'],
            'is_active' => $attributes['aktif'],
        ]);
    }

    /**
     * Delete petugas.
     *
     * @param int|string $id
     * @return Petugas
     */
    public function delete($id)
    {
        return Petugas::findOrFail($id)->delete();
    }
}