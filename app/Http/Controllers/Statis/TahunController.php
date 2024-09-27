<?php

namespace App\Http\Controllers\Statis;

use App\Http\Controllers\Controller;
use App\Http\Requests\Statis\TahunRequest;
use App\Repository\Statis\TahunRepository;
use Illuminate\Http\Request;

class TahunController extends Controller
{

    /**
     * Tahun Repository
     *
     * @var Object
     */
    private $tahunRepository;

    public function __construct(TahunRepository $tahunRepository)
    {
        $this->tahunRepository = $tahunRepository;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tahun = $this->tahunRepository->all($request->all());
        return view('tahun.index', compact('tahun'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tahun.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TahunRequest $request)
    {
        $this->tahunRepository->create($request->all());

        return redirect()->route('tahun.index')
                ->with('success', "Data tahun berhasil disimpan.");
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
        $tahun = $this->tahunRepository->findById($id);
        if(!$tahun)
            abort(404);

        return view('tahun.edit', compact('tahun'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TahunRequest $request, $id)
    {
        $this->tahunRepository->update($id, $request->all());
        
        return redirect()->route('tahun.index')
                ->with('success', "Data tahun berhasil diubah.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
