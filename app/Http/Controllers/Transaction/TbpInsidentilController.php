<?php

namespace App\Http\Controllers\Transaction;

use Exception;
use Illuminate\Http\Request;
use App\Entity\Transaction\Tbp;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\TbpInsidentilRequest;
use App\Http\Requests\Transaction\TbpRequest;
use App\Repository\Transaction\TbpRepository;
use App\Repository\Statis\RekeningBankRepository;
use App\Repository\Transaction\TbpInsidentilRepository;
use App\Repository\Transaction\JenisPembayaranRepository;

class TbpInsidentilController extends Controller
{
    /**
     * Tbp insidentil repository
     *
     * @var TbpInsidentilRepository
     */
    private $tbpInsidentilRepository;

    /**
     * Tbp Insidentil Repository
     * 
     * @param TbpInsidentilRepository $tbpInsidentilRepository
     */
    public function __construct(TbpInsidentilRepository $tbpInsidentilRepository)
    {
        $this->tbpInsidentilRepository = $tbpInsidentilRepository;
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
        return view('tbp.create_insidentil', [
            'rekeningBank' => $rekeningBank,
            'jenisPembayaran' => $jenisPembayaran
        ]);
    }

    /**
     * Create action.
     * 
     * @param TbpInsidentilRequest $request
     * @return void
     */
    public function store(TbpInsidentilRequest $request)
    {
        try {
            $this->tbpInsidentilRepository->create($request->all());
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
        $tbp = $this->tbpInsidentilRepository->find($id);
        $rekeningBank = $rekeningBankRepository->all();
        $jenisPembayaran = $jenisPembayaranRepository->all();

        return view('tbp.edit_insidentil', [
            'tbp' => $tbp,
            'rekeningBank' => $rekeningBank,
            'jenisPembayaran' => $jenisPembayaran
        ]);
    }

    /**
     * Edit action.
     * 
     * @param TbpInsidentilRequest $request
     * @param string|int $id
     * @return void
     */
    public function update(TbpInsidentilRequest $request, $id)
    {
        try {
            $this->tbpInsidentilRepository->edit(
                $id,
                $request->all()
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
        $this->tbpInsidentilRepository->delete($id);
        return redirect()->route('tbp.index')
                    ->with('success', 'TBP berhasil dihapus');
    }

    /**
     * Cetak TBP Insidentil
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
        $tbpInsidentil = $this->tbpInsidentilRepository->find($id);
        $totalBayar = $tbpInsidentil->totalBayar();
        
        return $pdf::loadview('layouts.report.cetak_tbp_insidentil', compact('tbpInsidentil', 'totalBayar'))
        ->stream('cetak_tbp_insidentil.pdf', ['Attachment' => false]);
    }
}
