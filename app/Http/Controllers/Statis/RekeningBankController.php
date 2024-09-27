<?php

namespace App\Http\Controllers\Statis;

use App\Http\Controllers\Controller;
use App\Http\Requests\Statis\RekeningBankRequest;
use App\Repository\Statis\AkunRepository;
use App\Repository\Statis\RekeningBankRepository;
use Illuminate\Http\Request;

class RekeningBankController extends Controller
{
    /**
     * Rekening bank repository
     *
     * @var RekeningBankRepository
     */
    private $rekeningRepository;

    /**
     * Akun repository
     *
     * @var AkunRepository
     */
    private $akunRepository;
    
    /**
     * Constructor
     */
    public function __construct(
        RekeningBankRepository $rekeningRepository,
        AkunRepository $akunRepository
    )
    {
        $this->rekeningRepository = $rekeningRepository;
        $this->akunRepository = $akunRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bank = $this->rekeningRepository->all($request->all());
        
        return view('rekeningbank.index', compact('bank'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $akun = $this->akunRepository->all();

        return view('rekeningbank.create', compact('akun'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RekeningBankRequest $request)
    {
        $this->rekeningRepository->create($request->all());

        return redirect()->route('rekening.index')
            ->with('success', 'Berhasil menambah data rekening bank.');
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
        $rekeningBank = $this->rekeningRepository->findById($id);
        if(!$rekeningBank)
            abort(404);

        $akun = $this->akunRepository->all();
        return view('rekeningbank.edit', compact('rekeningBank', 'akun'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RekeningBankRequest $request, $id)
    {
        $this->rekeningRepository->update($id, $request->all());

        return redirect()->route('rekening.index')
            ->with('success', 'Berhasil mengubah data rekening bank.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->rekeningRepository->delete($id);
        
        return redirect()->route('rekening.index')
            ->with('success', 'Berhasil menghapus data rekening bank.');
    }
}
