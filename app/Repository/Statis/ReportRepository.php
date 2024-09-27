<?php

namespace App\Repository\Statis;

use App\Entity\Transaction\JenisPembayaran;
use App\Entity\Transaction\Tbp;
use App\Entity\Transaction\TbpDetail;
use App\Entity\Transaction\TbpInsidentil;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportRepository
{
    /**
     * Data Objek Retribusi yang sudah dibayar.
     *
     * @param Request $request
     * @return void
     */
    public function objekRetribusiPay(array $request)
    {
        $startDate = Carbon::parse($request['tanggal_awal'])->startOfDay();
        $endDate = Carbon::parse($request['tanggal_akhir'])->endOfDay();

        $data = [];

        /** TBP-OA */
        $tbpOA = TbpDetail::with('jenisPembayaran', 'skrd.pemakai', 'skrd.objectRetribusi', 'skrd.objectRetribusi.tarifRetribusi', 'tbp')
            ->whereHas('jenisPembayaran', function($query) {
                $query->where('kode_jurnal', '=', JenisPembayaran::TBP_OA);
            })
            ->whereHas('tbp', function($query) use($startDate, $endDate, $request) {
                $query->where('tanggal', '>=', $startDate);
                
                if($request['tanggal_akhir'])
                    $query->where('tanggal', '<=', $endDate); 
            })
            // ->whereHas('skrd', function ($query) use ($endDate) {
            //     $query->whereYear('tanggal', date('Y', strtotime($endDate)));
            // })
            ->get();

        foreach($tbpOA as $item)
        {
            $data[] = [
                'tanggal' => $item->getDateFormatted(),
                'nama_wr' => $item->skrd->pemakai->nama,
                'lokasi_objek' => $item->skrd->objectRetribusi->lokasi,
                'luas' => $item->skrd->objectRetribusi->luas,
                'tarif' => $item->skrd->objectRetribusi->tarifRetribusi->tarif_meter,
                'total_tarif' => $item->skrd->nominal_float,
                'total_bayar' => $item->nominal,
                'tipe' => JenisPembayaran::TBP_OA,
                'created_at' => $item->created_at,
            ];
        }
        
        /** TBP-PUTG */
        $tbpPUTG = TbpDetail::with('jenisPembayaran', 'skrd', 'tbp')
            ->whereHas('jenisPembayaran', function($query) {
                $query->where('kode_jurnal', '=', JenisPembayaran::TBP_PUTG);
            })
            ->whereHas('tbp', function($query) use($startDate, $endDate, $request) {
                $query->where('tanggal', '>=', $startDate);
                
                if($request['tanggal_akhir'])
                    $query->where('tanggal', '<=', $endDate); 
            })
            // ->whereHas('skrd', function ($query) use ($endDate) {
            //     $query->whereYear('tanggal', date('Y', strtotime($endDate)));
            // })
            ->get();
        
        foreach($tbpPUTG as $item)
        {
            $data[] = [
                'tanggal' => $item->getDateFormatted(),
                'nama_wr' => $item->skrd->pemakai->nama,
                'lokasi_objek' => $item->skrd->objectRetribusi->lokasi,
                'luas' => $item->skrd->objectRetribusi->luas,
                'tarif' => $item->skrd->objectRetribusi->tarifRetribusi->tarif_meter,
                'total_tarif' => $item->skrd->nominal_float,
                'total_bayar' => $item->nominal,
                'tipe' => JenisPembayaran::TBP_PUTG,
                'created_at' => $item->created_at,
            ];
        }
        
        
        /** TBP-SA */
        $tbpSA = TbpInsidentil::with('jenisPembayaran', 'skrd')
            ->whereHas('jenisPembayaran', function($query) {
                $query->where('kode_jurnal', '=', JenisPembayaran::TBP_SA);
            })
            ->when($request, function($query) use($startDate, $endDate, $request) {
                $query->where('created_at', '>=', $startDate);
                
                if($request['tanggal_akhir'])
                    $query->where('created_at', '<=', $endDate); 
            })
            ->get();

        foreach($tbpSA as $item)
        {
            $data[] = [
                'tanggal' => $item->getDateFormatted(),
                'nama_wr' => $item->pemakai,
                'lokasi_objek' => $item->alamat_objek,
                'luas' => '-',
                'tarif' => '-',
                'total_tarif' => $item->totalBayar(),
                'total_bayar' => $item->totalBayar(),
                'tipe' => JenisPembayaran::TBP_SA,
                'created_at' => $item->created_at,
            ];
        }

        /** Sorted Data */
        $sorted = collect($data)
            ->sortBy('created_at')
            ->values()
            ->all();

        return $sorted;
    }

    /**
     * Total Nominal TBP berdasarkan Jenis Pembayaran
     * 
     * @return Array
     */
    public function totalNominalTbp(array $request)
    {
        $startDate = Carbon::parse($request['tanggal_awal'])->startOfDay();
        $endDate = Carbon::parse($request['tanggal_akhir'])->endOfDay();

        /** TBP-OA */
        $tbpOA = TbpDetail::with('jenisPembayaran', 'skrd')
            ->whereHas('jenisPembayaran', function($query) {
                $query->where('kode_jurnal', '=', JenisPembayaran::TBP_OA);
            })
            ->where(function($query) use($startDate, $endDate, $request) {
                $query->where('created_at', '>=', $startDate);
                
                if($request['tanggal_akhir'])
                    $query->where('created_at', '<=', $endDate); 
            })
            ->whereHas('skrd', function ($query) use ($endDate) {
                $query->whereYear('tanggal', date('Y', strtotime($endDate)));
            })
            ->get();

        /** TBP-PUTG */
        $tbpPUTG = TbpDetail::with('jenisPembayaran', 'skrd')
            ->whereHas('jenisPembayaran', function($query) {
                $query->where('kode_jurnal', '=', JenisPembayaran::TBP_PUTG);
            })
            ->where(function($query) use($startDate, $endDate, $request) {
                $query->where('created_at', '>=', $startDate);
                
                if($request['tanggal_akhir'])
                    $query->where('created_at', '<=', $endDate); 
            })
            ->whereHas('skrd', function ($query) use ($endDate) {
                $query->whereYear('tanggal', date('Y', strtotime($endDate)));
            })
            ->get();

        /** TBP-SA */
        $tbpSA = TbpInsidentil::with('jenisPembayaran')
            ->whereHas('jenisPembayaran', function($query) {
                $query->where('kode_jurnal', '=', JenisPembayaran::TBP_SA);
            })
            ->where(function($query) use($startDate, $endDate, $request) {
                $query->where('created_at', '>=', $startDate);
                
                if($request['tanggal_akhir'])
                    $query->where('created_at', '<=', $endDate); 
            })
            ->get();

        $tbpSA->map(function($item) {
            $item->total = $item->luas * $item->tinggi * $item->tarif;
        });

        return collect([
            'TBP_OA' => $tbpOA->sum('nominal'), 
            'TBP_PUTG' => $tbpPUTG->sum('nominal'), 
            'TBP_SA' => $tbpSA->sum('total'),
        ]);
    }

    /**
     * Get sum nominal tbp based on year and kecamatan.
     *
     * @param [type] $year
     * @param [type] $kecamatanId
     * @return void
     */
    public function sumNominalTbp($year, $kecamatanId)
    {
        // TBP DETAIL > SKRD > OBJEK RETRIBUSI > KELURAHAN > KECAMATAN
        $tbps = TbpDetail::with('skrd.objectRetribusi.kelurahan.kecamatan')
            ->whereHas('skrd.objectRetribusi.kelurahan.kecamatan', function ($query) use ($kecamatanId) {
                $query->where('id', $kecamatanId);
            })
            ->whereHas('skrd', function ($query) use ($year) {
                $date = Carbon::createFromDate($year, 01, 01);
                $startOfYear = $date->copy()->startOfYear();
                $endOfYear = $date->copy()->endOfYear();

                $query->whereBetween('tanggal', [$startOfYear, $endOfYear]);
            })
            ->get();
        
        $collection = collect($tbps);
        return $collection->sum('nominal');
    }

    /**
     * Get sum of the TBP each year
     * 
     * @return Array
     */
    public function getRincianTbpPerTahun()
    {
        $data = DB::table('tbp_detail')
        ->select(
            DB::raw('YEAR(tbp.tanggal) as tahun_tbp'),
            DB::raw('YEAR(skrd.tanggal) as tahun_skrd'),
            DB::raw('SUM(tbp_detail.nominal) as total_tbp'),
        )
        ->join('tbp', 'tbp.id', 'tbp_detail.tbp_id')
        ->join('skrd', 'skrd.id', 'tbp_detail.skrd_id')
        ->groupBy('tahun_tbp', 'tahun_skrd')
        ->orderBy('tahun_tbp', 'ASC')
        ->get();

        return $data;
    }
}