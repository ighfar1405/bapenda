<?php

namespace App\Http\Controllers\Statis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Statis\AkunRequest;
use App\Repository\Statis\AkunRepository;

class AkunController extends Controller
{
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
        AkunRepository $akunRepository
    )
    {
        $this->akunRepository = $akunRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $akun = $this->akunRepository->all($request->all());
        return view('akun.index', compact('akun'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('akun.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AkunRequest $request)
    {
        $this->akunRepository->create($request->all());

        return redirect()->route('akun.index')
            ->with('success', 'Berhasil menambah data akun');
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
        $akun = $this->akunRepository->findById($id);
        if(!$akun)
            abort(404);

        return view('akun.edit', compact('akun'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AkunRequest $request, $id)
    {
        $this->akunRepository->update($id, $request->all());

        return redirect()->route('akun.index')
            ->with('success', 'Berhasil mengubah data akun');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->akunRepository->delete($id);

        return redirect()->route('akun.index')
            ->with('success', 'Berhasil menghapus data akun');
    }
}
