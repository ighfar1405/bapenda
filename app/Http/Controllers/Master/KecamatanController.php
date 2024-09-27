<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\KecamatanRequest;
use App\Repository\Master\KecamatanRepository;
use App\Repository\Master\KelurahanRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KecamatanController extends Controller
{

    /**
     * Kecamatan repository.
     *
     * @var KecamatanRepository
     */
    private $kecamatanRepository;

    private $kelurahanRepository;

    public function __construct(
        KecamatanRepository $kecamatanRepository,
        KelurahanRepository $kelurahanRepository
    )
    {
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
        $kecamatans = $this->kecamatanRepository->all($request->all());
        return view('kecamatan.index', compact('kecamatans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kecamatan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KecamatanRequest $request)
    {
        $kecamatan = $this->kecamatanRepository->create(
            $request->only(['nama_kecamatan', 'kode_administratif'])
        );

        return redirect()->route('kecamatan.index')
            ->with('success', "{$kecamatan->nama} berhasil disimpan");
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
        $kecamatan = $this->kecamatanRepository->find($id);
        return view('kecamatan.edit', [
            'kecamatan' => $kecamatan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KecamatanRequest $request, $id)
    {
        $kecamatan = $this->kecamatanRepository->update(
            $id, $request->only(['nama_kecamatan', 'kode_administratif'])
        );

        return redirect()->route('kecamatan.index')
            ->with('success', "Kecamatan berhasil diperbaharui");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $this->kelurahanRepository->deleteKelurahanByKecamatanId($id);
            $this->kecamatanRepository->delete($id);

            DB::commit();
            return redirect()->route('kecamatan.index')
                ->with('success', 'Kecamatan berhasil dihapus');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('kecamatan.index')
                ->with('error', $th->getMessage());
        }
        
    }
}
