<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\TarifRetribusiRequest;
use App\Repository\Master\KlasifikasiPemakaianRepository;
use App\Repository\Master\TarifRetribusiRepository;
use Illuminate\Http\Request;

class TarifRetribusiController extends Controller
{
    /**
     * Tarif retribusi repository
     *
     * @var TarifRetribusiRepository
     */
    private $tarifRetribusiRepository;

    /**
     * Klasifikasi pemakaian repository
     *
     * @var KlasifikasiPemakaianRepository
     */
    private $klasifikasiPemakaianRepository;

    public function __construct(
        TarifRetribusiRepository $tarifRetribusiRepository,
        KlasifikasiPemakaianRepository $klasifikasiPemakaianRepository
    )
    {
        $this->tarifRetribusiRepository = $tarifRetribusiRepository;
        $this->klasifikasiPemakaianRepository = $klasifikasiPemakaianRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tarifRetribusi = $this->tarifRetribusiRepository->all($request->all());
        return view('tarifretribusi.index', compact('tarifRetribusi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $klasifikasiPemakaian = $this->klasifikasiPemakaianRepository->all();
        return view('tarifretribusi.create', compact('klasifikasiPemakaian'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TarifRetribusiRequest $request)
    {
        $tarifRetribusi = $this->tarifRetribusiRepository->create(
            $request->only(['kelas', 'golongan', 'range_njop', 'kode_tarif', 'klasifikasi_pemakaian', 'tarif_meter'])
        );

        return redirect()->route('tarifretribusi.index')
            ->with('success', "{$tarifRetribusi->kelas} berhasil disimpan");
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
        $tarifRetribusi = $this->tarifRetribusiRepository->find($id);
        $klasifikasiPemakaian = $this->klasifikasiPemakaianRepository->all();
        return view('tarifretribusi.edit', compact('tarifRetribusi', 'klasifikasiPemakaian'));
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
        $tarifRetribusi = $this->tarifRetribusiRepository->update(
            $id,
            $request->only(['kelas', 'golongan', 'range_njop', 'kode_tarif', 'klasifikasi_pemakaian', 'tarif_meter'])
        );

        return redirect()->route('tarifretribusi.index')
            ->with('success', "Tarif retribusi berhasil diperbaharui");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->tarifRetribusiRepository->delete($id);

        return redirect()->route('tarifretribusi.index')
            ->with('success', 'Tarif retribusi berhasil dihapus');
    }
}
