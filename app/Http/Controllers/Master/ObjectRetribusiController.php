<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\ObjectRetribusiRequest;
use App\Repository\Master\KecamatanRepository;
use App\Repository\Master\KelurahanRepository;
use App\Repository\Master\KlasifikasiPemakaianRepository;
use App\Repository\Master\ObjectRetribusiRepository;
use App\Repository\Master\TarifRetribusiRepository;
use App\Repository\User\PemakaiRepository;
use Illuminate\Http\Request;

class ObjectRetribusiController extends Controller
{
    /**
     * Pemakai repository
     *
     * @var PemakaiRepository
     */
    private $pemakaiRepository;

    /**
     * Klasifikasi penggunaan repository
     *
     * @var KlasifikasiPenggunaanRepository
     */
    private $klasifikasiPemakaianRepository;

    /**
     * Object retribusi repository
     *
     * @var ObjectRetribusiRepository
     */
    private $objectRetribusiRepository;

    /**
     * Tarif retribusi repository
     *
     * @var TarifRetribusiRepository
     */
    private $tarifRetribusiRepository;

    /**
     * Kecamatan repository
     *
     * @var [type]
     */
    private $kecamatanRepository;

    /**
     * Kelurahan repository
     *
     * @var KelurahanRepository
     */
    private $kelurahanRepository;


    public function __construct(
        PemakaiRepository $pemakaiRepository,
        KlasifikasiPemakaianRepository $klasifikasiPemakaianRepository,
        ObjectRetribusiRepository $objectRetribusiRepository,
        TarifRetribusiRepository $tarifRetribusiRepository,
        KecamatanRepository $kecamatanRepository,
        KelurahanRepository $kelurahanRepository
    )
    {
        $this->pemakaiRepository = $pemakaiRepository;
        $this->klasifikasiPemakaianRepository = $klasifikasiPemakaianRepository;
        $this->objectRetribusiRepository = $objectRetribusiRepository;
        $this->tarifRetribusiRepository = $tarifRetribusiRepository;
        $this->kecamatanRepository = $kecamatanRepository;
        $this->kelurahanRepository = $kelurahanRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $objectRetribusies = $this->objectRetribusiRepository->allPaginate([
            'keyword' => $request->keyword,
            'lokasi' => $request->lokasi,
        ]);

        $objectRetribusies->appends($request->query());

        return view('objectretribusi.index', compact('objectRetribusies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kecamatan = $this->kecamatanRepository->all();
        $pemakai = $this->pemakaiRepository->all();
        $tarifRetribusi = $this->tarifRetribusiRepository->all();
        $klasifikasiPemakaian = $this->klasifikasiPemakaianRepository->all();
        return view('objectretribusi.create', compact(
            'klasifikasiPemakaian', 'pemakai', 'tarifRetribusi', 'kecamatan'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ObjectRetribusiRequest $request)
    {
        $objectRetribusi = $this->objectRetribusiRepository->create(
            $request->only(['kode', 'pemakai', 'lokasi', 'luas', 'tarif_retribusi', 'kelurahan'])
        );

        return redirect()->route('objectretribusi.index')
            ->with('success', "{$objectRetribusi->kode} berhasil disimpan");
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
    public function edit($id)
    {
        $pemakai = $this->pemakaiRepository->all();
        $tarifRetribusi = $this->tarifRetribusiRepository->all();
        $objectRetribusi = $this->objectRetribusiRepository->find($id);
        $klasifikasiPemakaian = $this->klasifikasiPemakaianRepository->all();
        $kecamatan = $this->kecamatanRepository->all();
        $kelurahan = $this->kelurahanRepository->all();
        return view('objectretribusi.edit', compact(
            'klasifikasiPemakaian', 'pemakai', 'tarifRetribusi', 'objectRetribusi', 'kecamatan', 'kelurahan'
        ));
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
        $objectRetribusi = $this->objectRetribusiRepository->update(
            $id,
            $request->only(['kode', 'pemakai', 'lokasi', 'luas', 'tarif_retribusi', 'kelurahan'])
        );

        return redirect()->route('objectretribusi.index')
            ->with('success', "Objek retribusi berhasil disimpan");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->objectRetribusiRepository->delete($id);

        return redirect()->route('objectretribusi.index')
            ->with('success', 'Objek retribusi berhasil dihapus');
    }
}
