<?php

namespace App\Http\Controllers\Transaction;

use App\Entity\Master\ObjekRetribusi;
use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\SkrdRequest;
use App\Repository\Master\ObjectRetribusiRepository;
use App\Repository\Master\TarifRetribusiRepository;
use App\Repository\Statis\AkunRepository;
use App\Repository\Statis\TahunRepository;
use App\Repository\Transaction\SkrdRepository;
use App\Repository\User\OpdRepository;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class SkrdController extends Controller
{
    /**
     * Skrd repository
     *
     * @var SkrdRepository
     */
    private $skrdRepository;



    public function __construct(SkrdRepository $skrdRepository)
    {
        $this->skrdRepository = $skrdRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(
        Request $request,
        OpdRepository $opdRepository,
        AkunRepository $akunRepository,
        TahunRepository $tahunRepository
    ) {
        $yearActive = $request->year ? $request->year : date('Y');
        $opd = $opdRepository->getOpdDefault();
        $akunBendahara = $akunRepository->getAkunBendahara('4.1.2.02.01');
        $skrds = $this->skrdRepository->allPaginate($request);
        $totalSkrd = $this->skrdRepository->countSkrd($yearActive);
        $totalPemakai = $this->skrdRepository->countPemakai();
        $totalNominal = $this->skrdRepository->sumNominal();
        $tahun = $tahunRepository->all();
        $totalNominalByYear = $this->skrdRepository->sumNominalByYear($request->get('year') ?? null);

        $skrds->appends($request->query());

        $kecs  = \App\Entity\Master\Kecamatan::all();

        return view('skrd.index', compact(
            'skrds',
            'opd',
            'akunBendahara',
            'totalSkrd',
            'totalPemakai',
            'totalNominal',
            'tahun',
            'yearActive',
            'totalNominalByYear',
            'kecs'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(TarifRetribusiRepository $tarifRetribusiRepository)
    {
        $tarifRetribusi = $tarifRetribusiRepository->all();

        $objectRetribusi = ObjekRetribusi::all();

        // print('<pre>');
        // print_r($objectRetribusi->toArray());die;
        return view('skrd.create', compact('tarifRetribusi', 'objectRetribusi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SkrdRequest $request)
    {
        try {
            if ($request->nomor_auto) {
                $nomor = $this->skrdRepository->getLastNomor();
                $nomorOtomatis = true;
            } else {
                $nomor = $request->nomor;
                $nomorOtomatis = false;
            }

            $skrd = $this->skrdRepository->create(
                $request->only([
                    'tanggal_penetapan', 'tanggal_jatuhtempo', 'pemakai', 'keterangan', 'nominal', 'object_retribusi'
                ]),
                $nomor,
                $nomorOtomatis
            );

            if (!$skrd) {
                throw new \Exception('Gagal simpan skrd');
            }

            event(new \App\Events\SkrdCreated($skrd));

            return redirect()->route('skrd.index')
                ->with('success', "Skrd berhasil disimpan");
        } catch (\Exception $e) {
            return redirect()->route('skrd.index')
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(
        $id,
        ObjectRetribusiRepository $objectRetribusiRepository,
        TarifRetribusiRepository $tarifRetribusiRepository
    ) {
        $tarifRetribusi = $tarifRetribusiRepository->all();
        $skrd = $this->skrdRepository->find($id);
        $objectRetribusi = $objectRetribusiRepository->getObjectRetribusiByPemakai($skrd->pemakai->id);
        return view('skrd.edit', compact('skrd', 'objectRetribusi', 'tarifRetribusi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $skrd = $this->skrdRepository->update(
                $request->only([
                    'tanggal_penetapan', 'tanggal_jatuhtempo', 'pemakai', 'keterangan', 'nominal', 'object_retribusi'
                ]),
                $id
            );

            if (!$skrd) {
                throw new \Exception('Gagal simpan skrd');
            }

            return redirect()->route('skrd.index')
                ->with('success', "Skrd berhasil disunting");
        } catch (\Exception $e) {
            return redirect()->route('skrd.index')
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->skrdRepository->delete($id);

        return redirect()->route('skrd.index')
            ->with('success', 'Skrd berhasil dihapus');
    }

    /**
     * Cetak SKRD
     *
     * @param [type] $id
     * @return PDF
     */
    public function print(
        PDF $pdf,
        $id
    ) {
        $skrd = $this->skrdRepository->find($id);

        return $pdf::loadview('layouts.report.cetak_skrd', compact('skrd'))
            ->stream('cetak_skrd.pdf', ['Attachment' => false]);
    }
}
