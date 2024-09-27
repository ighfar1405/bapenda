<?php

namespace App\Repository\Transaction;

use Exception;
use App\Entity\Transaction\TbpInsidentil;

class TbpInsidentilRepository
{
    /**
     * Get all Tbp.
     *
     * @return Collection
     */
    public function all()
    {
        return TbpInsidentil::with(['jenisPembayaran', 'rekeningBank', 'akunBendahara'])->paginate();
    }

    /**
     * Get Tbp by id
     *
     * @param int|string $id
     * @return Tbp
     */
    public function find($id)
    {
        return TbpInsidentil::with(['jenisPembayaran', 'rekeningBank', 'akunBendahara'])
                ->findOrFail($id);
    }

    /**
     * Create Tbp.
     *
     * @param array $attributes
     * @return TbpInsidentils
     */
    public function create(array $attributes)
    {
        try {
            $tbp = TbpInsidentil::create([
                'no_surat_izin' => $attributes['nomor_izin'],
                'tanggal_izin' => $attributes['tanggal_izin'],
                'pemakai' => $attributes['pemakai'],
                'nama_objek' => $attributes['nama_objek'],
                'alamat_objek' => $attributes['alamat_objek'],
                'tarif' => $attributes['tarif'],
                'tinggi' => $attributes['tinggi'],
                'luas' => $attributes['luas'],
                'jenis_pembayaran_id' => $attributes['jenis_pembayaran'],
                'rekening_bank_id' => $attributes['kas_bank'],
                'akun_id' => $attributes['bendahara'],
            ]);

            return $tbp;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Edit Tbp.
     *
     * @param string|int $tbpId
     * @param array $attributes
     * @return Tbp
     */
    public function edit($tbpId, array $attributes)
    {
        try {
            $tbp = TbpInsidentil::findOrFail($tbpId);
            $tbp->update([
                'no_surat_izin' => $attributes['nomor_izin'],
                'tanggal_izin' => $attributes['tanggal_izin'],
                'pemakai' => $attributes['pemakai'],
                'nama_objek' => $attributes['nama_objek'],
                'alamat_objek' => $attributes['alamat_objek'],
                'tarif' => $attributes['tarif'],
                'tinggi' => $attributes['tinggi'],
                'luas' => $attributes['luas'],
                'jenis_pembayaran_id' => $attributes['jenis_pembayaran'],
                'rekening_bank_id' => $attributes['kas_bank'],
                'akun_id' => $attributes['bendahara'],
            ]);

            return $tbp;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Delete Tbp.
     *
     * @param int|string $id
     * @return Tbp
     */
    public function delete($id)
    {
        try {
            $tbp = TbpInsidentil::findOrFail($id);
            $tbp->delete();
            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
