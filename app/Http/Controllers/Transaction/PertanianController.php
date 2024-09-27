<?php

namespace App\Http\Controllers\Transaction;

use App\Entity\Transaction\Pertanian;
use App\Entity\Master\Kecamatan;
use App\Entity\Master\Kelurahan;
use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\PertanianRequest;
use App\Repository\Transaction\PertanianRepository;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Exception;

class PertanianController extends Controller
{
    /**
     * Pertanian Repository
     *
     * @var PertanianRepository
     */
    private $pertanianRepository;

    public function __construct(PertanianRepository $pertanianRepository)
    {
        $this->pertanianRepository = $pertanianRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pertanian = $this->pertanianRepository->allPaginate([
            'keyword' => $request->keyword
        ]);

        $pertanian->appends($request->query());

        return view('pertanian.index', compact('pertanian'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pertanian.create', [
            'tanaman' => DB::table('jenis_tanaman')->get(),
            'dt_kec' => Kecamatan::all(),
            'dt_kel' => Kelurahan::where('kecamatan_id', Kecamatan::first()->id)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Transaction\PertanianRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PertanianRequest $request)
    {
        try {
            $this->pertanianRepository->create($request->all());

            return redirect()->route('pertanian.index')
                ->with('success', 'Lahan Pertanian berhasil disimpan');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan Lahan Pertanian');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entity\Transaction\Pertanian  $pertanian
     * @return \Illuminate\Http\Response
     */
    public function show(Pertanian $pertanian)
    {
        // Implement this method as needed
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $d = Pertanian::find($id);

        return view('pertanian.edit', [
            'pertanian' => $d,
            'tanaman' => DB::table('jenis_tanaman')->get(),
            'dt_kec' => Kecamatan::all(),
            'dt_kel' => Kelurahan::where('kecamatan_id', $d->kecamatan_id)->get()
        ]);
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
        $db = Pertanian::find($id);

        if ($db) {
            $nominal = $request->input('nominal');
            $sisa_bayar = $this->calculateSisaBayar($db, $nominal);

            $db->update([
                'nama_penyewa' => $request->input('nama_penyewa'),
                'lokasi' => $request->input('lokasi'),
                'nominal' => $nominal,
                'tanggal_sewa' => $request->input('tanggal_sewa'),
                'status' => $request->input('status'),
                'keterangan' => $request->input('keterangan'),
                'luas' => (float)$request->input('luas'),
                'nik' => $request->input('nik'),
                'kecamatan_id' => $request->input('kecamatan'),
                'kelurahan_id' => $request->input('kelurahan'),
                'tgl_selesai' => $request->input('tanggal_selesai'),
                'jenis_tanaman_id' => $request->input('jenis_tanaman'),
                'sisa_bayar' => $sisa_bayar,
                'no_telp' => $request->input('no_telp'),
                'alamat_penyewa' => $request->input('alamat'),
            ]);
        }

        return redirect()->route('pertanian.index')
            ->with('success', 'Data Lahan Pertanian berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->pertanianRepository->delete($id);

        return redirect()->route('pertanian.index')
            ->with('success', 'Data Lahan Pertanian berhasil dihapus');
    }

    /**
     * Show the payment form.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pay($id)
    {
        return view('pertanian.pay', [
            'dt' => Pertanian::find($id)
        ]);
    }

    /**
     * Process the payment.
     *
     * @param  \Illuminate\Http\Request  $req
     * @return \Illuminate\Http\Response
     */
    public function payAction(Request $req)
    {
        $db = Pertanian::find($req->input('itemPay'));

        $db->no_bukti_bayar = $req->input('no_bukti');
        $db->jenis_bayar = $req->input('jenis_bayar');
        $db->nominal_bayar += $req->input('bayar');
        $db->sisa_bayar -= $req->input('bayar');
        $db->tanggal_bayar = $req->input('tgl_bayar');

        $db->save();

        if ($db->sisa_bayar == 0) {
            $db->status = Pertanian::PAID;
            $db->save();
        }

        return redirect()->route('pertanian.index')
            ->with('success', 'Pembayaran berhasil');
    }

    /**
     * Calculate the remaining payment amount.
     *
     * @param  \App\Entity\Transaction\Pertanian  $db
     * @param  int  $nominal
     * @return int
     */
    private function calculateSisaBayar($db, $nominal)
    {
        if ($db->nominal == $nominal) {
            return $db->sisa_bayar;
        } elseif ($db->nominal < $nominal) {
            return $db->nominal + ($nominal - $db->nominal) - $db->nominal_bayar;
        } else {
            $res = $db->nominal - ($db->nominal - $nominal) - $db->nominal_bayar;
            return $res <= 0 ? 0 : $res;
        }
    }

    public function print($id)
    {
        $data =  $this->pertanianRepository->find($id);

        // return view('pertanian.print', compact('data'));

        $pdf = Pdf::loadView('pertanian.print', compact('data'));

        return $pdf->download('kwitansi-pembayaran-properti-pertanian-'.date('ymd').'.pdf');

    }
}