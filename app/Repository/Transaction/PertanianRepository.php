<?php

namespace App\Repository\Transaction;

use App\Entity\Transaction\Pertanian;

class PertanianRepository
{
    /**
     * Return all pertanian
     *
     * @return Collection
     */
    public function all()
    {
        return Pertanian::orderBy('id', 'desc')->get();
    }

    /**
     * Get all pertanian with pagination.
     *
     * @return Collection
     */
    public function allPaginate(array $attributes)
    {
        $keyword = null;

        if (isset($attributes['keyword']))
            $keyword = $attributes['keyword'];

        return Pertanian::orderBy('created_at', 'desc')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('nama_penyewa', 'like', '%' . $keyword . '%');
            })
            ->paginate(10);
    }

    /**
     * Get Pertanian by id
     *
     * @param int|string $id
     * @return Pertanian
     */
    public function find($id)
    {
        return Pertanian::findOrFail($id);
    }

    /**
     * Create Pertanian.
     *
     * @param array $attributes
     * @return Pertanian
     */
    public function create(array $attributes)
    {
        return Pertanian::create([
            'nama_penyewa'       => $attributes['nama_penyewa'],
            'lokasi'             => $attributes['lokasi'],
            'nominal'            => $attributes['nominal'],
            'nominal_bayar'      => 0,
            'sisa_bayar'         => $attributes['nominal'],
            'tanggal_sewa'       => $attributes['tanggal_sewa'],
            'status'             => 'unpaid',
            'keterangan'         => $attributes['keterangan'],
            'luas'               => (float)$attributes['luas'],
            'nik'                => $attributes['nik'],
            'kecamatan_id'       => $attributes['kecamatan'],
            'kelurahan_id'       => $attributes['kelurahan'],
            'tgl_selesai'        => $attributes['tanggal_selesai'],
            'jenis_tanaman_id'   => $attributes['jenis_tanaman'],
            'alamat_penyewa'     => $attributes['alamat'],
            'no_telp'            => $attributes['no_telp'],
            'tanggal_bayar'      => $attributes['tanggal_bayar'] ?? null,
            'no_bukti_bayar'     => $attributes['no_bukti_bayar'] ?? null,
            'jenis_bayar'        => $attributes['jenis_bayar'] ?? null,
        ]);
    }

    /**
     * Edit Pertanian.
     *
     * @param int|string $id
     * @param array $attributes
     * @return Pertanian
     */
    public function update(array $attributes, $id)
    {
        $pertanian = Pertanian::findOrFail($id);

        $pertanian->update([
            'nama_penyewa'       => $attributes['nama_penyewa'],
            'lokasi'             => $attributes['lokasi'],
            'nominal'            => $attributes['nominal'],
            'tanggal_sewa'       => $attributes['tanggal_sewa'],
            'status'             => $attributes['status'],
            'keterangan'         => $attributes['keterangan'],
            'luas'               => (float)$attributes['luas'],
            'nik'                => $attributes['nik'],
            'kecamatan_id'       => $attributes['kecamatan'],
            'kelurahan_id'       => $attributes['kelurahan'],
            'tgl_selesai'        => $attributes['tanggal_selesai'],
            'jenis_tanaman_id'   => $attributes['jenis_tanaman'],
            'alamat_penyewa'     => $attributes['alamat'],
            'no_telp'            => $attributes['no_telp'],
            'tanggal_bayar'      => $attributes['tanggal_bayar'] ?? $pertanian->tanggal_bayar,
            'no_bukti_bayar'     => $attributes['no_bukti_bayar'] ?? $pertanian->no_bukti_bayar,
            'jenis_bayar'        => $attributes['jenis_bayar'] ?? $pertanian->jenis_bayar,
        ]);

        return $pertanian;
    }

    /**
     * Delete Pertanian.
     *
     * @param int|string $id
     * @return bool|null
     */
    public function delete($id)
    {
        return Pertanian::findOrFail($id)->delete();
    }
}
