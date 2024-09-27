<?php

namespace App\Http\Controllers\Admin\JasaUmum;

use App\Http\Controllers\Controller;
use App\Entity\Transaction\JasaUmum;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\JasaUmum\StoreJasaUmumRequest; 
use App\Http\Requests\Admin\JasaUmum\UpdateJasaUmumRequest; 

class JasaUmumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        //

        $keyword = $request->has('keyword') ? $request->keyword : null;

        $jasa_umums = JasaUmum::orderBy('created_at', 'desc')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('nama_penyetor', 'like', '%' . $keyword . '%');
            })->paginate(10);
        return view('admin.jasa_umum.index', compact('jasa_umums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.jasa_umum.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJasaUmumRequest $request)
    {
        //
        try {
            $data = $request->validated();

            JasaUmum::create([
                'nama_penyetor' => $data['nama_penyetor'],
                'no_ktp' => $data['no_ktp'],
                'objek_setoran' => $data['objek_setoran'],
                'lokasi_objek' => $data['lokasi_objek'],
                'jumlah_setoran' => $data['jumlah_setoran'],
            ]);

            return redirect()->route('jasa_umum.index')
                ->with('success', 'Jasa Umum berhasil disimpan');

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
    public function edit(JasaUmum $jasa_umum)
    {
        //
        return view('admin.jasa_umum.edit', compact('jasa_umum'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJasaUmumRequest $request, JasaUmum $jasa_umum)
    {
        try {
            $data = $request->validated();

            $jasa_umum->update([
                'nama_penyetor' => $data['nama_penyetor'],
                'no_ktp' => $data['no_ktp'],
                'objek_setoran' => $data['objek_setoran'],
                'lokasi_objek' => $data['lokasi_objek'],
                'jumlah_setoran' => $data['jumlah_setoran'],
            ]);

            return redirect()->route('jasa_umum.index')
                ->with('success', 'Jasa Umum berhasil diupdate');

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
    public function destroy(JasaUmum $jasa_umum)
    {
        //
        $jasa_umum->delete();

        return redirect()->route('jasa_umum.index')
            ->with('success', 'Data Jasa Umum berhasil dihapus');
    }
}
