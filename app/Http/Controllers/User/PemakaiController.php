<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PemakaiRequest;
use App\Repository\User\PemakaiRepository;
use App\Repository\Master\KecamatanRepository;
use App\Repository\Master\KelurahanRepository;
use Illuminate\Http\Request;

class PemakaiController extends Controller
{
    /**
     * Pemakai repository.
     *
     * @var PemakaiRepository
     */
    private $pemakaiRepository;

    /**
     * Constructor.
     *
     * @param PemakaiRepository $pemakaiRepository
     */
    public function __construct(PemakaiRepository $pemakaiRepository)
    {
        $this->pemakaiRepository = $pemakaiRepository;
    }

    /**
     * Lists.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $pemakai = $this->pemakaiRepository->allPaginate([
            'keyword' => $request->keyword
        ]);

        $pemakai->appends($request->query());

        return view('pemakai.index', compact('pemakai'));
    }

    /**
     * Form create.
     *
     * @param KecamatanRepository $kecamatanRepository
     * @return Illuminate\View\View
     */
    public function create(KecamatanRepository $kecamatanRepository)
    {
        $kecamatan = $kecamatanRepository->all();
        return view('pemakai.create', [
            'kecamatan' => $kecamatan
        ]);
    }

    /**
     * Create action.
     *
     * @param PemakaiRequest $request
     * @return Response
     */
    public function store(PemakaiRequest $request)
    {
        $pemakai = $this->pemakaiRepository->create(
            $request->only(['kelurahan', 'nama', 'nik', 'alamat', 'telepon', 'kode_arsip'])
        );

        return redirect()->route('pemakai.index')
                ->with('success', "{$pemakai->nama} berhasil disimpan");
    }

    /**
     * Form edit.
     * 
     * @param KecamatanRepository $kecamatanRepository
     * @param KelurahanRepository $kelurahanRepository
     * @param string $id
     * @return Illuminate\View\View
     */
    public function edit(
        KecamatanRepository $kecamatanRepository,
        KelurahanRepository $kelurahanRepository,
        $id
    ) {
        $kecamatan = $kecamatanRepository->all();
        $kelurahan = $kelurahanRepository->all();
        $pemakai = $this->pemakaiRepository->find($id);
        return view('pemakai.edit', [
            'pemakai' => $pemakai,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan
        ]);
    }

    /**
     * Edit action.
     *
     * @param PemakaiRequest $request
     * @param string $id
     * @return Response
     */
    public function update(PemakaiRequest $request, $id)
    {
        $this->pemakaiRepository->update(
            $id,
            $request->only(['kelurahan', 'nama', 'nik', 'alamat', 'telepon', 'kode_arsip'])
        );

        return redirect()->route('pemakai.index')
                ->with('success', 'Pemakai berhasil disimpan');
    }

    /**
     * Delete action.
     *
     * @param string $id
     * @return Response
     */
    public function destroy($id)
    {

        $delete = $this->pemakaiRepository->delete($id);

        if (! $delete){
            return redirect()->route('pemakai.index')
                    ->with('error', 'Wajib retribusi tidak dapat dihapus. Karena masih mempunyai objek retribusi.');
        }

        return redirect()->route('pemakai.index')
                ->with('success', 'Wajib retribusi  berhasil dihapus');
    }
}
