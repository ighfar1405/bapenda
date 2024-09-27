<?php

namespace App\Http\Controllers\Ajax;

use DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\SkrdRequest;
use App\Repository\Master\ObjectRetribusiRepository;
use App\Repository\Statis\AkunRepository;
use App\Repository\Transaction\SkrdRepository;
use App\Repository\User\OpdRepository;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class SkrdController extends Controller
{
    /**
     * Skrd repository
     *
     * @var SkrdRepository
     */
    private $skrdRepository;



    public function __construct(SkrdRepository $skrdRepository)
    {
        $this->skrdRepository = $skrdRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OpdRepository $opdRepository, AkunRepository $akunRepository)
    {
        $opd = $opdRepository->getOpdDefault();
        $akunBendahara = $akunRepository->getAkunBendahara('4.1.2.02.01');
        $skrds = $this->skrdRepository->all();
        return Datatables::of($skrds)
            ->addIndexColumn()
            ->addColumn('select_skrd', function ($row) {
                $checkBox = "<input type='checkbox' name='selected_skrd[]' value='".$row->id."'>";
                return $checkBox;
            })
            ->addColumn('nama_opd', function ($row){
                return "Badan Keuangan dan Aset Daerah";
            })
            ->addColumn('kode_akun', function ($row){
                return "4.1.2.02.01";
            })
            ->addCOlumn('nama_pemakai', function ($row) {
                return $row->pemakai->nama;
            })
            ->addCOlumn('kode_object', function ($row) {
                return $row->objectRetribusi->kode;
            })
            ->rawColumns(['select_skrd'])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('skrd.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SkrdRequest $request)
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
