<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\SalinSkrdRequest;
use App\Repository\Master\KecamatanRepository;
use App\Repository\Master\ObjectRetribusiRepository;
use App\Repository\Statis\TahunRepository;
use App\Repository\Transaction\SalinSkrdRepository;
use App\Repository\Transaction\SkrdRepository;
use Illuminate\Http\Request;

class SalinSkrdController extends Controller
{
    /**
     * Skrd repository
     *
     * @var SalinSkrdRepository
     */
    private $salinSkrdRepository;

    public function __construct(SalinSkrdRepository $salinSkrdRepository)
    {
        $this->salinSkrdRepository = $salinSkrdRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $skrdRepository = app(SkrdRepository::class);
        $kecamatanRepository = app(KecamatanRepository::class);
        $tahunRepository = app(TahunRepository::class);
        
        $skrds = $skrdRepository->allPaginate($request);
        $kecamatan = $kecamatanRepository->all();
        $tahun = $tahunRepository->all();
        $yearActive = $request->year ? $request->year : date('Y');

        $skrds->appends($request->query());

        return view('salinskrd.index', compact('skrds', 'kecamatan', 'tahun', 'yearActive'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SalinSkrdRequest $request)
    {
        $skrdRepository = app(SkrdRepository::class);
        $selectedSkrd = [];
        
        if($request->tahun && $request->kecamatan)
        {
            $skrd = $skrdRepository->getSkrdKecamatan($request->only(['kecamatan', 'tahun']));
            foreach($skrd as $item)
                $selectedSkrd[] = $item->id;
        }

        if($request->selected_skrd)
            $selectedSkrd = $request->selected_skrd;

        $this->salinSkrdRepository->copySkrds($selectedSkrd);
        return redirect()->route('salinskrd.index')
            ->with('success', "SKRD berhasil disalin");
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
    public function edit($id, ObjectRetribusiRepository $objectRetribusiRepository)
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
