<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\KelurahanRequest;
use App\Repository\Master\KecamatanRepository;
use App\Repository\Master\KelurahanRepository;
use Illuminate\Http\Request;

class KelurahanController extends Controller
{
    /**
     * Kelurahan repository
     *
     * @var KelurahanRepository
     */
    private $kelurahanRepository;

    /**
     * Kecamatan repository
     *
     * @var KecamatanRepository
     */
    private $kecamatanRepository;
    
    /**
     * Constructor
     */
    public function __construct(
        KelurahanRepository $kelurahanRepository, 
        KecamatanRepository $kecamatanRepository
    )
    {
        $this->kelurahanRepository = $kelurahanRepository;
        $this->kecamatanRepository = $kecamatanRepository;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($kecamatanId)
    {
        $kecamatan = $this->kecamatanRepository->find($kecamatanId);
        return view('kelurahan.create', compact('kecamatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KelurahanRequest $request)
    {
        $kelurahan = $this->kelurahanRepository->create(
            $request->only(['kode_administratif', 'nama_kelurahan', 'kecamatan_id'])
        );

        return redirect()->route('kelurahan.show', $kelurahan->kecamatan_id)
            ->with('success', "{$kelurahan->nama} berhasil disimpan");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $kecamatanId)
    {
        $kecamatan = $this->kecamatanRepository->find($kecamatanId);
        $kelurahans = $this->kelurahanRepository->allKelurahanByKecamatan($kecamatanId, $request->all());
        return view('kelurahan.show', compact('kelurahans', 'kecamatan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kelurahan = $this->kelurahanRepository->find($id);
        return view('kelurahan.edit', compact('kelurahan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KelurahanRequest $request, $id)
    {
        $kelurahan = $this->kelurahanRepository->update(
            $id, $request->only(['nama_kelurahan', 'kode_administratif'])
        );

        return redirect()->route('kelurahan.show', $request->kecamatan_id)
            ->with('success', "Kelurahan berhasil diperbaharui");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->kelurahanRepository->delete($id);

        return redirect()->route('kecamatan.index')
            ->with('success', 'Kecamatan berhasil dihapus');
    }
}
