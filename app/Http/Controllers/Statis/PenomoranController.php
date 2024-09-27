<?php

namespace App\Http\Controllers\Statis;

use App\Entity\Statis\Penomoran;
use App\Http\Controllers\Controller;
use App\Repository\Statis\PenomoranRepository;
use Illuminate\Http\Request;

class PenomoranController extends Controller
{

    /**
     * Penomoran repository
     *
     * @var PenomoranRepository
     */
    private $penomoranRepository;

    public function __construct(PenomoranRepository $penomoranRepository)
    {
        $this->penomoranRepository = $penomoranRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $penomorans = $this->penomoranRepository->all($request->all());
        return view('penomoran.index', compact('penomorans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $formulir = Penomoran::FORMULIR;
        return view('penomoran.create', compact('formulir'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $petugas = $this->penomoranRepository->create(
            $request->only(['formulir', 'format_penomoran'])
        );

        return redirect()->route('penomoran.index')
            ->with('success', "{$petugas->formulir} berhasil disimpan");
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
    public function edit($id)
    {
        $formulir = Penomoran::FORMULIR;
        $penomoran = $this->penomoranRepository->find($id);
        return view('penomoran.edit', compact('penomoran', 'formulir'));
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
        $petugas = $this->penomoranRepository->update(
            $id,
            $request->only(['formulir', 'format_penomoran'])
        );

        return redirect()->route('penomoran.index')
            ->with('success', "Data berhasil disimpan");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->penomoranRepository->delete($id);
        return redirect()->route('penomoran.index')
            ->with('success', 'Penomoran berhasil dihapus');
    }
}
