<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Repository\Master\TarifRetribusiRepository;
use Symfony\Component\HttpFoundation\Request;

class TarifRetribusiController extends Controller
{
    /**
     * Kelurahan repository
     *
     * @var KelurahanRepository
     */
    private $tarifRetribusiRepository;

    
    /**
     * Constructor
     */
    public function __construct(
        TarifRetribusiRepository $tarifRetribusiRepository
    )
    {
        $this->tarifRetribusiRepository = $tarifRetribusiRepository;
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
    public function show($id)
    {
        $tarifRetribusi = $this->tarifRetribusiRepository->find($id);
        return response()->json($tarifRetribusi, 200);
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
        $tarifRetribusi = $this->tarifRetribusiRepository->updateTarif($id, $request->only(['kelas', 'golongan']));

        return response()->json($tarifRetribusi, 200);
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
