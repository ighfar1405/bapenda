<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\KlasifikasiPemakaianRequest;
use App\Repository\Master\KlasifikasiPemakaianRepository;
use Illuminate\Http\Request;

class KlasifikasiPemakaianController extends Controller
{
    /**
     * Klasifikasi pemakaian repository
     *
     * @var KlasifikasiPemakaianRepository
     */
    private $klasifikasiRepository;
    
    /**
     * Constructor
     */
    public function __construct(
        KlasifikasiPemakaianRepository $klasifikasiRepository
    )
    {
        $this->klasifikasiRepository = $klasifikasiRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $klasifikasi = $this->klasifikasiRepository->all($request->all());

        return view('klasifikasi.index', compact('klasifikasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('klasifikasi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KlasifikasiPemakaianRequest $request)
    {
        $name = $request->input('jenis_klasifikasi');
        $isExist = $this->klasifikasiRepository->findByName($name);

        if($isExist) {
            return redirect()->route('klasifikasi.create')
                ->withErrors([
                    'msg' => "Jenis klasifikasi <strong>{$name}</strong> sudah ada."
                ]);
        }

        $klasifikasi = $this->klasifikasiRepository->create(
            $request->only(['jenis_klasifikasi'])
        );

        return redirect()->route('klasifikasi.index')
            ->with('success', "Jenis klasifikasi {$klasifikasi->jenis_klasifikasi} berhasil disimpan.");
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
        $klasifikasi = $this->klasifikasiRepository->findById($id);
        if(!$klasifikasi) {
            return redirect()->route('klasifikasi.index')
                ->withErrors([
                    'msg' => "Data klasifikasi tidak ditemukan."
                ]);
        }

        return view('klasifikasi.edit', compact('klasifikasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KlasifikasiPemakaianRequest $request, $id)
    {
        $findId = $this->klasifikasiRepository->findById($id);
        if(!$findId) {
            return redirect()->route('klasifikasi.index')
                ->withErrors([
                    'msg' => "Data klasifikasi tidak ditemukan."
                ]);
        }

        $name = $request->input('jenis_klasifikasi');
        $findName = $this->klasifikasiRepository->findByName($name);
        if($findName) {
            return redirect()->route('klasifikasi.edit', $id)
                ->withErrors([
                    'msg' => "Jenis klasifikasi {$name} sudah ada."
                ]);
        }

        $this->klasifikasiRepository->update(
            $id, $request->only(['jenis_klasifikasi'])
        );

        return redirect()->route('klasifikasi.index')
            ->with('success', "Jenis klasifikasi berhasil diperbaharui.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->klasifikasiRepository->delete($id);

        return redirect()->route('klasifikasi.index')
            ->with('success', 'Jenis klasifikasi berhasil dihapus');
    }
}
