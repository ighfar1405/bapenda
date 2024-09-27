<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Repository\Master\ObjectRetribusiRepository;
use Illuminate\Http\Request;

class ObjectRetribusiController extends Controller
{
    /**
     * Kecamatan repository
     *
     * @var ObjectRetribusiRepository
     */
    private $objectRetribusiRepository;
    
    /**
     * Constructor
     */
    public function __construct(
        ObjectRetribusiRepository $objectRetribusiRepository
    )
    {
        $this->objectRetribusiRepository = $objectRetribusiRepository;
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

    public function getAll(Request $request)
    {
        if ($request->kode != null) {
            $objekRetribusi = $this->objectRetribusiRepository->all($request->kode);
        } else {
            $objekRetribusi = [];
        }

        return response()->json($objekRetribusi, 200);
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
    public function update(Request $request, $id)
    {
        $objectRetribusi = $this->objectRetribusiRepository->updateTarif($request, $id);

        return response()->json($objectRetribusi, 200);
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
