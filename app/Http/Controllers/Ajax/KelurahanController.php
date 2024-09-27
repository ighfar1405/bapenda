<?php

namespace App\Http\Controllers\Ajax;

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
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KelurahanRequest $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($kecamatanId)
    {
        $kelurahans = $this->kelurahanRepository->allKelurahanByKecamatan($kecamatanId);
        return response()->json($kelurahans, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
