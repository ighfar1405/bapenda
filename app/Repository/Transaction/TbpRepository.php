<?php

namespace App\Repository\Transaction;

use Exception;
use Carbon\Carbon;
use App\Entity\Transaction\Tbp;
use App\Entity\Transaction\Skrd;
use Illuminate\Support\Facades\DB;
use App\Entity\Transaction\TbpDetail;
use App\Entity\Transaction\TbpInsidentil;
use App\Entity\Transaction\JenisPembayaran;

class TbpRepository
{
    /**
     * Get all Tbp.
     *
     * @return Collection
     */
    public function sumAll(array $attributes = [])
    {
        return Tbp::leftjoin('tbp_detail', 'tbp.id', 'tbp_detail.tbp_id')
            ->selectRaw('SUM(tbp_detail.nominal) as total,YEAR(tbp.tanggal) as tahun')
            ->where(function ($sql) use ($attributes) {
                if (!empty(request()->query('year'))) {
                    $sql->whereYear('tbp.tanggal', $attributes['year']);
                }

                if (!empty(request()->query('start'))) {
                    $sql->where('tanggal', '>=', $attributes['start']);
                }

                if (!empty(request()->query('end'))) {
                    $sql->where('tanggal', '<=', $attributes['end']);
                }
            })
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->get();
    }
    public function sumAllKecamatan()
    {
        return DB::table('tbp')->leftjoin('tbp_detail', 'tbp.id', 'tbp_detail.tbp_id')
            ->leftjoin('pemakai', 'tbp.pemakai_id', 'pemakai.id')
            ->leftjoin('kelurahan', 'kelurahan.id', 'pemakai.kelurahan_id')
            ->leftjoin('kecamatan', 'kecamatan.id', 'kelurahan.kecamatan_id')
            ->selectRaw('SUM(tbp_detail.nominal) as total,YEAR(tbp.tanggal) as tahun,kecamatan.nama')
            // ->whereRaw("YEAR(tbp.tanggal)=$attributes")
            ->groupBy('tahun', 'kecamatan.nama')
            ->get();
    }

    public function all(array $attributes = [])
    {
        $data = Tbp::with(['pemakai', 'tbpDetail', 'tbpDetail.skrd'])
            ->whereHas('pemakai', function ($query) use ($attributes) {
                if (isset($attributes['keyword']))
                    $query->where('nama', 'like', '%' . $attributes['keyword'] . '%');
            })
            ->when($attributes, function ($query) use ($attributes) {

                //if( isset($attributes['year'])) {
                if (!empty(request()->query('year'))) {
                    $date = Carbon::createFromDate($attributes['year'], 01, 01);
                    $startOfYear = $date->copy()->startOfYear();
                    $endOfYear = $date->copy()->endOfYear();

                    $query->whereBetween('tanggal', [$startOfYear, $endOfYear]);
                }

                if (!empty(request()->query('start'))) {
                    $query->where('tanggal', '>=', $attributes['start']);
                }

                if (!empty(request()->query('end'))) {
                    $query->where('tanggal', '<=', $attributes['end']);
                }
            })
            ->paginate(10);

        return $data;
    }
    /**
     * Get Tbp by id
     *
     * @param int|string $id
     * @return Tbp
     */
    public function find($id)
    {
        return Tbp::with([
            'pemakai',
            'tbpDetail.skrd',
            'tbpDetail.objectRetribusi.tarifRetribusi.klasifikasiPemakaian',
            'tbpDetail.jenisPembayaran',
        ])
            ->findOrFail($id);
    }

    /**
     * Create Tbp.
     *
     * @param array $attributes
     * @param string $jenis
     * @param int $nomor
     * @param bool $nomorOtomatis
     * @return Tbp
     */
    public function create(array $attributes, $jenis, $nomor, $nomorOtomatis)
    {
        try {
            DB::beginTransaction();

            $tbp = Tbp::create([
                'jenis' => $jenis,
                'nomor' => $nomor,
                'nomor_otomatis' => $nomorOtomatis,
                'tanggal' => $attributes['tanggal'],
                'rekening_bank_id' => $attributes['kas_bank'],
                'akun_id' => $attributes['bendahara'],
                'pemakai_id' => $attributes['pemakai'],
                'keterangan' => $attributes['keterangan']
            ]);

            // check jenis tbp
            if ($jenis === Tbp::JENIS_SKRD) {
                foreach ($attributes['skrd'] as $index => $item) {
                    $tbp->tbpDetail()->create([
                        'skrd_id' => $item,
                        'jenis_pembayaran_id' => $attributes['jenis_pembayaran'][$index],
                        'nominal' => $attributes['nominal_bayar'][$index]
                    ]);
                }
            } else {
                foreach ($attributes['object_retribusi'] as $index => $item) {
                    $tbp->tbpDetail()->create([
                        'objek_retribusi_id' => $item,
                        'jenis_pembayaran_id' => $attributes['jenis_pembayaran'][$index],
                        'nominal' => $attributes['nominal_bayar'][$index]
                    ]);
                }
            }

            DB::commit();
            return $tbp;
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Edit Tbp.
     *
     * @param string|int $tbpId
     * @param array $attributes
     * @param string $jenis
     * @return Tbp
     */
    public function edit($tbpId, array $attributes, $jenis)
    {
        try {
            DB::beginTransaction();

            $tbp = Tbp::findOrFail($tbpId);
            $tbp->update([
                'jenis' => $jenis,
                'tanggal' => $attributes['tanggal'],
                'rekening_bank_id' => $attributes['kas_bank'],
                'akun_id' => $attributes['bendahara'],
                'pemakai_id' => $attributes['pemakai'],
                'keterangan' => $attributes['keterangan']
            ]);

            // check jenis tbp
            if ($jenis === Tbp::JENIS_SKRD) {
                foreach ($attributes['skrd'] as $index => $item) {
                    $tbp->tbpDetail()->where('skrd_id', $item)->firstOrFail()
                        ->update([
                            'skrd_id' => $item,
                            'jenis_pembayaran_id' => $attributes['jenis_pembayaran'][$index],
                            'nominal' => $attributes['nominal_bayar'][$index]
                        ]);
                }
            } else {
                foreach ($attributes['object_retribusi'] as $index => $item) {
                    $tbp->tbpDetail()->where('objek_retribusi_id', $item)->firstOrFail()
                        ->update([
                            'objek_retribusi_id' => $item,
                            'jenis_pembayaran_id' => $attributes['jenis_pembayaran'][$index],
                            'nominal' => $attributes['nominal_bayar'][$index]
                        ]);
                }
            }

            DB::commit();
            return $tbp;
        } catch (Exception $e) {
            DB::rollback();
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
            DB::beginTransaction();

            $tbp = Tbp::findOrFail($id);
            $tbp->tbpDetail()->delete();
            $tbp->delete();

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Get last nomor in TBP
     *
     * @return void
     */
    public function getLastNomor()
    {
        $tbp = Tbp::where('nomor_otomatis', true)
            ->orderBy('id', 'desc')
            ->first();

        if ($tbp) {
            return $tbp->nomor + 1;
        }

        return 1;
    }

    public function getPaymentToday()
    {
        $startDate = Carbon::now()->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        /** TBP-OA */
        $tbpOA = TbpDetail::with('jenisPembayaran')
            ->whereHas('jenisPembayaran', function ($query) {
                $query->where('kode_jurnal', '=', JenisPembayaran::TBP_OA);
            })
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        /** TBP-PUTG */
        $tbpPUTG = TbpDetail::with('jenisPembayaran')
            ->whereHas('jenisPembayaran', function ($query) {
                $query->where('kode_jurnal', '=', JenisPembayaran::TBP_PUTG);
            })
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        /** TBP-SA */
        $tbpSA = TbpInsidentil::with('jenisPembayaran')
            ->whereHas('jenisPembayaran', function ($query) {
                $query->where('kode_jurnal', '=', JenisPembayaran::TBP_SA);
            })
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        $tbpSA->map(function ($item) {
            $item->total = $item->luas * $item->tinggi * $item->tarif;
        });

        $totalNominalTbp = $tbpOA->sum('nominal') + $tbpPUTG->sum('nominal') + $tbpSA->sum('total');

        return $totalNominalTbp;
    }

    public function All5Tahunan(int $year)
    {
        //$attributes['year'] = urldecode($attributes['year']);

        return Tbp::with(['pemakai', 'tbpDetail'])
            ->whereYear('tanggal', $year)
            ->orderBy('tanggal', 'ASC')
            ->paginate(10);
    }
}
