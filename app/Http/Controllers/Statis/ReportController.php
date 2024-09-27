<?php

namespace App\Http\Controllers\Statis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repository\Master\KecamatanRepository;
use App\Repository\Master\ObjectRetribusiRepository;
use App\Repository\Statis\ReportRepository;
use App\Repository\Statis\TahunRepository;
use App\Repository\Transaction\JenisPembayaranRepository;
use App\Repository\Transaction\SkrdRepository;
use Barryvdh\DomPDF\Facade as PDF;

class ReportController extends Controller
{

    /**
     * ReportRepository
     *
     * @var Object
     */
    private $reportRepository;

    public function __construct(ReportRepository $reportRepository)
    {
        $this->reportRepository = $reportRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kecamatanRepository = app(KecamatanRepository::class);
        $jenisPembayaranRepository = app(JenisPembayaranRepository::class);
        $tahunRepository = app(TahunRepository::class);

        $kecamatan = $kecamatanRepository->all();
        $jenisPembayaran = $jenisPembayaranRepository->all();
        $tahun = $tahunRepository->all();

        $p_th = \App\Entity\Transaction\Pertanian::select(DB::raw('YEAR(tanggal_sewa) as tahun'))
              ->groupBy('tahun')->get();

        $perTahun = \App\Entity\Statis\Tahun::select('tahun')->get();
        //$thnMin   = $perTahun->min('tahun');
        //$thnMax   = $perTahun->max('tahun');
        return view('report.index', compact('kecamatan', 'jenisPembayaran', 'tahun','p_th','perTahun'));
    }

    /**
     * Data Wajib Retribusi Per-Kecamatan
     *
     * @return void
     */
    public function wr_kecamatan(
        Request $request,
        PDF $pdf
    )
    {
        $kecamatanRepository = app(KecamatanRepository::class);
        $skrdRepository = app(SkrdRepository::class);

        $kecamatan = $kecamatanRepository->find($request->kecamatan);
        $tahun = $request->tahun;
        $skrds = $skrdRepository->getSkrdKecamatan($request->only('kecamatan', 'tahun', 'status'));
        return $pdf::loadview('layouts.report.wr_per_kecamatan', compact('tahun', 'kecamatan', 'skrds'))
            ->setPaper('a4', 'landscape')
            ->stream('wr_perkecamatan.pdf', ['Attachment' => false]);
    }

    /**
     * Data Wajib Retribusi Jenis Insidentil (Reklame)
     *
     * @return void
     */
    public function wr_insidentil(PDF $pdf)
    {
        return $pdf::loadview('layouts.report.wr_insidentil')
            ->setPaper('a4', 'landscape')
            ->stream('wr_insidentil.pdf', ['Attachment' => false]);
    }

    /**
     * Laporan Pembayaran Retribusi Per Kecamatan
     *
     * @return void
     */
    public function pembayaran_retribusi_kecamatan(PDF $pdf)
    {
        return $pdf::loadview('layouts.report.pembayaran_retribusi_kecamatan')
            ->stream('pembayaran_retribusi_kecamatan.pdf', ['Attachment' => false]);
    }

    /**
     * Laporan Piutang Pertahun
     *
     * @return void
     */
    public function piutang_pertahun_data()
    {
        //$skrdTahun = \App\Entity\Transaction\Skrd::select('nominal', DB::raw('SUM(nominal)'))
        //$skrdTahun = \App\Entity\Transaction\Skrd::select('tanggal','nomor','nomor_otomatis',
        // $skrdTahun = \App\Entity\Transaction\Skrd::select('tanggal',
            // DB::raw('year(skrd.tanggal) as tahun'),
            // DB::raw('sum(skrd.nominal) as nominal'),
        // )->where(function($sql){
            // if (request()->query('tahun')) {
                // $sql->whereRaw('YEAR(skrd.tanggal) between 2013 AND '.request()->query('tahun'));
            // }
        // })->groupByRaw('YEAR(tanggal)')
        // ->get();
        $perTahun  = \App\Entity\Statis\Tahun::select('tahun')->get();
        $skrdTahun = DB::table('skrd')->select(
            DB::raw('year(skrd.tanggal) as tahun'),
            DB::raw('sum(skrd.nominal) as nominal')
        )->where(function($sql) use($perTahun){

            if (request()->query('tahun')) {

                $sql->whereRaw('YEAR(skrd.tanggal) between '.$perTahun->min('tahun').' AND '.request()->query('tahun'));
            }
        })->groupByRaw('YEAR(tanggal)')->get();

        $tbpTahun_tmp = DB::table('tbp_detail')->select(
                        DB::raw('YEAR(tbp.tanggal) as Tahun'),
                        DB::raw('SUM(tbp_detail.nominal) as nominal')
                    )
                    ->join('tbp','tbp_detail.tbp_id','=', 'tbp.id')
                    ->where(function($sql) use ($perTahun){

                        if (request()->query('tahun')) {

                            $sql->whereRaw('YEAR(tbp.tanggal) between '.$perTahun->min('tahun').' AND '.request()->query('tahun'));
                        }
                    })
                    ->groupByRaw('YEAR(tbp.tanggal)')->get();

        // $tbpTahun_tmp = \App\Entity\Transaction\Tbp::select('id','nomor_otomatis',DB::raw('YEAR(tanggal) as tahun_case'),'nomor')
        // ->where(function($sql){
            // if (request()->query('tahun')) {
                // $sql->whereRaw('YEAR(tanggal) between 2013 AND '.request()->query('tahun'));
            // }
        // })->get();

        $tbpTahun = [];

        foreach($skrdTahun as $_a) {
            $tbpTahun[trim($_a->tahun)] = 0;
        }

        foreach($tbpTahun_tmp as $r) {
            //$tbpTahun[$r->Tahun] += $r->tbpDetail->sum('nominal'));
            $tbpTahun[$r->Tahun] += $r->nominal;
        }

        return ['skrdTahun' => $skrdTahun, 'tbpTahun' => $tbpTahun];
    }

    public function piutang_pertahun_pdf(PDF $pdf)
    {
        $data = $this->piutang_pertahun_data();

        $skrdTahun = $data['skrdTahun'];
        $tbpTahun  = $data['tbpTahun'];
        $rincianTbp = $this->reportRepository->getRincianTbpPerTahun();

        //return view('layouts.report.piutang_pertahun',compact('perTahun','skrdTahun','tbpTahun'));
        return $pdf::loadview('layouts.report.piutang_pertahun', compact('skrdTahun','tbpTahun', 'rincianTbp'))
           ->setPaper('a4', 'landscape')
           ->stream('piutang_pertahun.pdf', ['Attachment' => false]);
    }

    public function piutang_pertahun_xls()
    {
        $data = $this->piutang_pertahun_data();

        $skrdTahun = $data['skrdTahun'];
        $tbpTahun  = $data['tbpTahun'];

        //return view('report.xls.piutang_pertahun',compact('skrdTahun','tbpTahun'));

        $excel = \Maatwebsite\Excel\Facades\Excel::class;
        return $excel::download(
            new \App\Exports\piutangPerTahunXLS($skrdTahun, $tbpTahun) , 'laporan-piutang-pertahun.xlsx'
        );
    }

    /**
     * Laporan Realisasi Pembayaran Piutang Per Jenis
     *
     * @return void
     */
    public function realisasi_pembayaran(PDF $pdf)
    {
        return $pdf::loadview('layouts.report.realisasi_pembayaran')
            ->stream('realisasi_pembayaran.pdf', ['Attachment' => false]);
    }

    /**
     * Laporan Harian Objek Retribusi
     *
     * @return void
     */
    public function harian_objek_retribusi(
        PDF $pdf,
        Request $request
    )
    {
        $objectRetribusi = $this->reportRepository->objekRetribusiPay(
            $request->only(['tanggal_awal', 'tanggal_akhir'])
        );

        $tanggalAwal = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;

        $totalTarif = collect($objectRetribusi)->sum('total_tarif');
        $totalBayar = collect($objectRetribusi)->sum('total_bayar');

        return $pdf::loadview('layouts.report.harian_objek_retribusi', compact('objectRetribusi', 'tanggalAwal', 'tanggalAkhir', 'totalTarif', 'totalBayar'))
            ->setPaper('a4', 'landscape')
            ->stream('harian_objek_retribusi.pdf', ['Attachment' => false]);
    }

    /**
     * Laporan Harian Nominal Berdasarkan Jenis Pembayaran
     *
     * @return void
     */
    public function harian_nominal_jenis_pembayaran(
        PDF $pdf,
        Request $request
    )
    {
        $nominalTbp = $this->reportRepository->totalNominalTbp(
            $request->only(['tanggal_awal', 'tanggal_akhir'])
        );
        $tanggalAwal = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;
        $totalNominalTbp = $nominalTbp['TBP_OA'] + $nominalTbp['TBP_PUTG'] + $nominalTbp['TBP_SA'];
        return $pdf::loadview('layouts.report.harian_nominal_jenis_pembayaran', compact('nominalTbp', 'totalNominalTbp', 'tanggalAwal', 'tanggalAkhir'))
            ->stream('harian_nominal_jenis_pembayaran.pdf', ['Attachment' => false]);
    }

    /**
     * Laporan Piutang Per Objek Kelurahan
     *
     * @return void
     */
    public function piutang_perkelurahan(PDF $pdf)
    {
        return $pdf::loadview('layouts.report.piutang_perkelurahan')
            ->setPaper('a4', 'landscape')
            ->stream('piutang_perkelurahan.pdf', ['Attachment' => false]);
    }

    /**
     * Laporan Piutang Ijin Pemanfaatan Per Objek Retribusi Per Kelurahan
     *
     * @return void
     */
    public function piutang_perobjek_perkelurahan(PDF $pdf)
    {
        return $pdf::loadview('layouts.report.piutang_perobjek_perkelurahan')
            ->setPaper('a4', 'landscape')
            ->stream('piutang_perobjek_perkelurahan.pdf', ['Attachment' => false]);
    }

    /**
     * Laporan Piutang Ijin Pemanfaatan Per WR Per Kelurahan
     *
     * @return void
     */
    public function piutang_perwr_perkelurahan(PDF $pdf)
    {
        return $pdf::loadview('layouts.report.piutang_perwr_perkelurahan')
            ->setPaper('a4', 'landscape')
            ->stream('piutang_perwr_perkelurahan.pdf', ['Attachment' => false]);
    }
}
