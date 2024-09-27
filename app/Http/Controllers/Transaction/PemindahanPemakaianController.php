<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\PemindahanPemakaianRequest;

use App\Repository\Master\ObjectRetribusiRepository;
use App\Repository\Transaction\PemindahanPemakaianRepository;
use App\Repository\User\PemakaiRepository;
use App\Repository\Master\KelurahanRepository;
use App\Repository\Master\KlasifikasiPemakaianRepository;

class PemindahanPemakaianController extends Controller
{
    /**
     * Pemindahan Pemakaian Repository
     * 
     * @var PemindahanPemakaianRepository
     */
    private $pemindahanPemakaian;

    /**
     * Object Retribusi Repository
     * 
     * @var ObjectRetribusiRepository
     */
    private $objectRetribusi;

    /**
     * Pemakai Repository
     * 
     * @var PemakaiRepository
     */
    private $pemakai;

    private $kelurahan;

    private $klasifikasiPemakaian;

    public function __construct(
        PemindahanPemakaianRepository $pemindahanPemakaianRepository,
        ObjectRetribusiRepository $objectRetribusiRepository,
        PemakaiRepository $pemakaiRepository,
        KelurahanRepository $kelurahanRepository,
        KlasifikasiPemakaianRepository $klasifikasiPemakaian
    )
    {
        $this->pemindahanPemakaian = $pemindahanPemakaianRepository;
        $this->objectRetribusi = $objectRetribusiRepository;
        $this->pemakai = $pemakaiRepository;
        $this->kelurahan = $kelurahanRepository;
        $this->klasifikasiPemakaian = $klasifikasiPemakaian;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pemindahan = $this->pemindahanPemakaian->allPaginate($request->all());
        
        return view('pemindahanpemakaian.index', [
            'pemindahan' => $pemindahan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $dataPemakaiBaru = $this->pemakai->all();
        $dataKelurahan = $this->kelurahan->all();
        $dataKlasifikasi = $this->klasifikasiPemakaian->all();
        
        $kodeObjek = $this->objectRetribusi->getGroupedByKode($request->kelurahan);
        
        if ($request->kelurahan || $request->kode) {
            $objekRetribusi = $this->objectRetribusi->all($request->kode, $request->kelurahan);
        } else {
            $objekRetribusi = [];
        }

        return view('pemindahanpemakaian.create', [
            'pemakaiBaru' => $dataPemakaiBaru,
            'kelurahan' => $dataKelurahan,
            'objekRetribusi' => $objekRetribusi,
            'kodeObjek' => $kodeObjek,
            'klasifikasi' => $dataKlasifikasi
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PemindahanPemakaianRequest $request)
    {
        try {
            $this->pemindahanPemakaian->create($request->only([
                'objek_retribusi_id',
                'pemakai_lama_id',
                'pemakai_baru',
                'no_sk',
                'tanggal_sk',
                'klasifikasi_pemakaian_id'
            ]));

            return redirect()->route('pemindahan_pemakaian.index')->with('success', 'Data berhasil ditambahkan');;
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->withInput()->with('message', 'Data gagal ditambahkan');
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $dataKelurahan = $this->kelurahan->all();
        $dataPemakaiBaru = $this->pemakai->all();
        $dataKlasifikasi = $this->klasifikasiPemakaian->all();
        $kodeObjek = $this->objectRetribusi->getGroupedByKode($request->kelurahan);
        $dataPemindahan = $this->pemindahanPemakaian->find($id);

        if ($request->kelurahan || $request->kode) {
            $objekRetribusi = $this->objectRetribusi->all($request->kode, $request->kelurahan);
        } else {
            $objekRetribusi = [];
        }

        return view('pemindahanpemakaian.edit', [
            'pemakaiBaru' => $dataPemakaiBaru,
            'kelurahan' => $dataKelurahan,
            'objekRetribusi' => $objekRetribusi,
            'kodeObjek' => $kodeObjek,
            'klasifikasi' => $dataKlasifikasi,
            'pemindahan' => $dataPemindahan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PemindahanPemakaianRequest $request, $id)
    {
        try {
            $this->pemindahanPemakaian->update($id, $request->only(
                'objek_retribusi_id',
                'pemakai_lama_id',
                'pemakai_baru',
                'no_sk',
                'tanggal_sk',
                'klasifikasi_pemakaian_id'
            ));

            return redirect()->route('pemindahan_pemakaian.index')->with('success', 'Update Pemindahan Pemakaian Berhasil');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->withInput()->with('message', 'Data gagal ditambahkan');
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
        $this->pemindahanPemakaian->delete($id);

        return redirect()->back()
            ->with('success', 'Data Pemindahan Pemakaian berhasil dihapus');
    }
}
