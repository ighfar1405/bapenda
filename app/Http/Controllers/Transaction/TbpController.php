<?php

namespace App\Http\Controllers\Transaction;

use Exception;
use Illuminate\Http\Request;
use App\Entity\Transaction\Tbp;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\TbpRequest;
use App\Repository\Transaction\TbpRepository;
use App\Repository\Statis\RekeningBankRepository;
use App\Repository\Statis\TahunRepository;
use App\Repository\Transaction\TbpInsidentilRepository;
use App\Repository\Transaction\JenisPembayaranRepository;

class TbpController extends Controller
{
    /**
     * Tbp repository
     *
     * @var TbpRepository
     */
    private $tbpRepository;

    /**
     * Tbp insidentil repository
     *
     * @var TbpInsidentilRepository
     */
    private $tbpInsidentilRepository;

    /**
     * Tahun repository
     *
     * @var TahunRepository
     */
    private $tahunRepository;

    /**
     * Tbp Repository
     *
     * @param TbpRepository $tbpRepository
     */
    public function __construct(
        TbpRepository $tbpRepository,
        TbpInsidentilRepository $tbpInsidentilRepository,
        TahunRepository $tahunRepository
    )
    {
        $this->tbpRepository = $tbpRepository;
        $this->tbpInsidentilRepository = $tbpInsidentilRepository;
        $this->tahunRepository = $tahunRepository;
    }

    /**
     * Index.
     *
     * @return void
     */
    public function index(Request $request)
    {

        $yearActive = $request->year ? $request->year : date('Y');
        $attributes = array_merge(['year' => $yearActive], $request->all());
        $tahun   = $this->tahunRepository->all();
        $tbpSkrd = $this->tbpRepository->all($attributes);
        $tbpInsidentil = $this->tbpInsidentilRepository->all();

        $tbpSkrd->appends($request->query());
        $tbpInsidentil->appends($request->query());
        $totTbp = collect($this->tbpRepository->sumAll($attributes))->sum('total');

        // return $tbpSkrd;
        return view('tbp.index', [
            'tbpSkrd' => $tbpSkrd,
            'tbpInsidentil' => $tbpInsidentil,
            'tahun' => $tahun,
            'yearActive' => $yearActive,
            'totalTBP' => $totTbp
        ]);
    }

    /**
     * Form create
     *
     * @param RekeningBankRepository $rekeningBankRepository
     * @param JenisPembayaranRepository $jenisPembayaranRepository
     * @return void
     */
    public function create(
        RekeningBankRepository $rekeningBankRepository,
        JenisPembayaranRepository $jenisPembayaranRepository
    ) {
        $rekeningBank = $rekeningBankRepository->all();
        $jenisPembayaran = $jenisPembayaranRepository->all();
        return view('tbp.create', [
            'rekeningBank' => $rekeningBank,
            'jenisPembayaran' => $jenisPembayaran
        ]);
    }

    /**
     * Create action.
     *
     * @param TbpRequest $request
     * @return void
     */
    public function store(TbpRequest $request)
    {
        try {
            if ($request->nomor_auto) {
                $nomor = $this->tbpRepository->getLastNomor();
                $nomorOtomatis = true;
            } else {
                $nomor = $request->nomor;
                $nomorOtomatis = false;
            }

            $jenis = Tbp::JENIS_SKRD;
            if ($request->skrd_radio == 'no_skrd') {
                $jenis = Tbp::JENIS_OBJECT_RETRIBUSI;
            }
            $data = $request->all();

            $_token = $request->_token;
            $nomor1 = $request->nomor;
            $nomor_auto1 = $request->nomor_auto;
            $tanggal = $request->tanggal;
            $skrd_radio = $request->skrd_radio;
            $pemakai = $request->pemakai;
            $kas_bank = $request->kas_bank;
            $bendahara = $request->bendahara;
            $keterangan = $request->keterangan;

            $skrd = $request->skrd;
            $nominal_bayar = $request->nominal_bayar;
            $jenis_pembayaran = $request->jenis_pembayaran;
            // $data = json_encode(array_merge(json_decode($skrd, true),json_decode($nominal_bayar, true)));
            $a=0;
            $array = array();

            $skrd1=array();
            $nominal_bayar1=array();
            $jenis_pembayaran1=array();

            foreach ($nominal_bayar as $key => $value) {

                    if ($value>0) {
                        array_push($skrd1, $skrd[$a]);
                        array_push($nominal_bayar1, $value);
                        array_push($jenis_pembayaran1, $jenis_pembayaran[$a]);
                        // $b.=$skrd[$a];
                        // $b.=",";
                    }
                    $a++;

            }
            // $c=[$b];
            // return $data;
            $array = array(
                "_token" => $_token,
                "nomor" => $nomor1,
                "nomor_auto" => $nomor_auto1,
                "tanggal" => $tanggal,
                "skrd_radio" => $skrd_radio,
                "pemakai" => $pemakai,
                "kas_bank" => $kas_bank,
                "bendahara" => $bendahara,
                "keterangan" => $keterangan,
                "skrd" => $skrd1,
                "nominal_bayar" => $nominal_bayar1,
                "jenis_pembayaran" => $jenis_pembayaran1);
            // $a1= $array;
            // array_push($array, $data);
            // return $data;
            $this->tbpRepository->create(
                $array,
                $jenis,
                $nomor,
                $nomorOtomatis
            );

            return redirect()->route('tbp.index')
                        ->with('success', 'TBP berhasil disimpan');
        } catch (Exception $e) {
            return redirect()->back()
                        ->with('error', 'Terjadi kesalahan saat menyimpan TBP');
        }
    }

    /**
     * Form edit
     *
     * @param RekeningBankRepository $rekeningBankRepository
     * @param JenisPembayaranRepository $jenisPembayaranRepository
     * @param string|int $id
     * @return void
     */
    public function edit(
        RekeningBankRepository $rekeningBankRepository,
        JenisPembayaranRepository $jenisPembayaranRepository,
        $id
    ) {
        $tbp = $this->tbpRepository->find($id);
        $rekeningBank = $rekeningBankRepository->all();
        $jenisPembayaran = $jenisPembayaranRepository->all();
        return view('tbp.edit', [
            'tbp' => $tbp,
            'rekeningBank' => $rekeningBank,
            'jenisPembayaran' => $jenisPembayaran
        ]);
    }

    /**
     * Edit action.
     *
     * @param TbpRequest $request
     * @param string|int $id
     * @return void
     */
    public function update(TbpRequest $request, $id)
    {
        try {
            $jenis = Tbp::JENIS_SKRD;
            if ($request->skrd_radio == 'no_skrd') {
                $jenis = Tbp::JENIS_OBJECT_RETRIBUSI;
            }

            $this->tbpRepository->edit(
                $id,
                $request->all(),
                $jenis
            );

            return redirect()->route('tbp.index')
                        ->with('success', 'TBP berhasil disimpan');
        } catch (Exception $e) {
            return redirect()->back()
                        ->with('error', 'Terjadi kesalahan saat menyimpan TBP');
        }
    }

    /**
     * Delete action.
     *
     * @param string|int $id
     * @return void
     */
    public function destroy($id)
    {
        $this->tbpRepository->delete($id);
        return redirect()->route('tbp.index')
                    ->with('success', 'TBP berhasil dihapus');
    }

    /**
     * Cetak TBP
     *
     * @param [type] $id
     * @return PDF
     */
    public function print(
        PDF $pdf,
        RekeningBankRepository $rekeningBankRepository,
        JenisPembayaranRepository $jenisPembayaranRepository,
        $id
    )
    {
        $tbp = $this->tbpRepository->find($id);
        $totalBayar = $tbp->tbpDetail()->sum('nominal');
        
        //return view('layouts.report.cetak_tbp', compact('tbp', 'totalBayar'));
        return view('layouts.report.cetak_tbp_baru', compact('tbp', 'totalBayar'));
        // return $pdf::loadview('layouts.report.cetak_tbp_baru', compact('tbp', 'totalBayar'))
        // ->stream('cetak_tbp.pdf', ['Attachment' => false]);
    }
}
