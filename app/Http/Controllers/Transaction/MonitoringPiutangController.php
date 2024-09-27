<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Repository\Master\KecamatanRepository;
use App\Repository\Master\ObjectRetribusiRepository;
use App\Repository\Statis\TahunRepository;
use App\Repository\Transaction\MonitoringPiutangRepository;
use App\Repository\Transaction\SkrdRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MonitoringPiutangController extends Controller
{
    /**
     * SKRD Repository
     *
     * @var SKRDRepository
     */
    private $monitoringPiutangRepository;

    /**
     * SKRD
     *
     * @var SKRDRepository
     */
    private $skrdRepository;

    /**
     * Constructor
     */
    public function __construct(
        MonitoringPiutangRepository $monitoringPiutangRepository,
        SkrdRepository $skrdRepository)
    {
        $this->monitoringPiutangRepository = $monitoringPiutangRepository;  
        $this->skrdRepository = $skrdRepository;  
    }

    /**
     * Resources all monitoring piutang
     *
     * @return void
     */
    public function index(
        Request $request,
        TahunRepository $tahunRepository,
        KecamatanRepository $kecamatanRepository
    )
    {
        $piutang = $this->monitoringPiutangRepository->getPiutangPaginate($request->only(['keyword', 'year', 'kecamatan']));
        // $startYear = Carbon::now()->subYears(5)->format('Y');
        $yearActive = $request->year ? $request->year : date('Y');
        $kecamatanActive = $request->kecamatan ? $request->kecamatan : NULL;
        $tahun = $tahunRepository->all();
        $kecamatan = $kecamatanRepository->all();
        $piutang->appends($request->query());

        return view('monitoringpiutang.index', compact('piutang', 'yearActive', 'kecamatanActive', 'tahun', 'kecamatan'));
    }

    /**
     * Send whatsapp on monitor piutang
     *
     * @param int id id monitor piutang
     * @return void
     */
    public function sendNotification(Request $request)
    {
        $skrd = $this->skrdRepository->find($request->get('id'));

        event(new \App\Events\PiutangEvent($skrd));

        return redirect()->back();
    }
}
