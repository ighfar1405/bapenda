<?php 

namespace App\Http\Controllers\Reports;

use App\Repository\Master\KecamatanRepository;
use App\Repository\Statis\ReportRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportHarianObjekRetribusiController extends BaseReportController {
    
    protected $layout;
    protected $title;
    protected $orientation;

    public function setData($request)
    {
        $reportRepository = app(ReportRepository::class);
        $params = $request->only(['tanggal_awal', 'tanggal_akhir']);
        $objectRetribusi = $reportRepository->objekRetribusiPay($params);

        $tanggalAwal = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;

        $totalTarif = collect($objectRetribusi)->sum('total_tarif');
        $totalBayar = collect($objectRetribusi)->sum('total_bayar');
        
        return compact('objectRetribusi', 'tanggalAwal', 'tanggalAkhir', 'totalTarif', 'totalBayar');
    }

    public function print(Request $request)
    { 
        $this->layout = 'harian_objek_retribusi';
        $this->title = 'Laporan Objek Retribusi';
        $this->orientation = 'landscape';
        return $this->printHtml($request);
    }

}