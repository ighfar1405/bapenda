<?php

namespace App\Http\Controllers\Admin\Tanaman;

use App\Http\Controllers\Controller;
use App\Entity\Transaction\Tanaman;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Tanaman\StoreTanamanRequest; 
use App\Http\Requests\Admin\Tanaman\UpdateTanamanRequest; 

class TanamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        //

        $keyword = $request->has('keyword') ? $request->keyword : null;

        $jenis_tanaman = Tanaman::orderBy('created_at', 'desc')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', '%' . $keyword . '%');
            })->paginate(10);
        return view('admin.tanaman.index', compact('jenis_tanaman'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.tanaman.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTanamanRequest $request)
    {
        //
        try {
            $data = $request->validated();

            Tanaman::create([
                'nama' => $data['nama'],
                'tarif' => $data['tarif'],
       
            ]);

            return redirect()->route('tanaman.index')
                ->with('success', 'Tanaman berhasil disimpan');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan Jasa Umum');

        }
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
    public function edit(Tanaman $tanaman)
    {
        //
        return view('admin.tanaman.edit', compact('tanaman'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTanamanRequest $request, Tanaman $tanaman)
    {
        try {
            $data = $request->validated();

            $tanaman->update([
                'nama' => $data['nama'],
                'tarif' => $data['tarif'],
             
            ]);

            return redirect()->route('tanaman.index')
                ->with('success', 'Tanaman berhasil diupdate');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan Jasa Umum');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tanaman $tanaman)
    {
        //
        $tanaman->delete();

        return redirect()->route('tanaman.index')
            ->with('success', 'Data Tanaman berhasil dihapus');
    }
}
