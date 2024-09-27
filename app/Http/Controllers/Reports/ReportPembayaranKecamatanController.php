<?php 

namespace App\Http\Controllers\Reports;

use App\Repository\Master\KecamatanRepository;
use App\Repository\Statis\ReportRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportPembayaranKecamatanController extends BaseReportController {
    
    protected $layout;
    protected $title;
    protected $orientation;

    public function setData($request)
    {
        $selectedYear = $request->tahun;
        $kecamatanRepository = app(KecamatanRepository::class);
        $reportRepository = app(ReportRepository::class);

        $kecamatan = $kecamatanRepository->all();
        $piutangs = [];
        $years = [];

        for($year = $selectedYear; $year > ($selectedYear - 5); $year--)
        {
            $years[] = $year;
            foreach($kecamatan as $item)
            {
                $nominal = $reportRepository->sumNominalTbp($year, $item->id);
                $piutangs[$item->nama][$year] = $nominal;
            }
        }

        $today = Carbon::now()->translatedFormat('d F Y'); 
        
        return compact('selectedYear', 'years', 'piutangs', 'today');
    }

    public function print(Request $request)
    { 
        $this->layout = 'pembayaran_retribusi_kecamatan';
        $this->title = 'Laporan Pembayaran Retribusi Per Kecamatan Tahun '. $request->tahun;
        $this->orientation = 'landscape';
        return $this->printPdf($request);
    }

}