<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repository\User\OpdRepository;
use App\Http\Requests\User\PetugasRequest;
use App\Repository\User\PetugasRepository;

class PetugasController extends Controller
{
    /**
     * Petugas repository.
     *
     * @var PetugasRepository
     */
    private $petugasRepository;

    /**
     * Constructor.
     *
     * @param PetugasRepository $petugasRepository
     */
    public function __construct(PetugasRepository $petugasRepository)
    {
        $this->petugasRepository = $petugasRepository;
    }

    /**
     * Lists.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $petugas = $this->petugasRepository->all();
        return view('petugas.index', [
            'petugas' => $petugas
        ]);
    }

    /**
     * Form create.
     *
     * @param OpdRepository $opdRepository
     * @return Illuminate\View\View
     */
    public function create(OpdRepository $opdRepository)
    {
        $opds = $opdRepository->all();
        return view('petugas.create', [
            'opds' => $opds
        ]);
    }

    /**
     * Create action.
     *
     * @param PetugasRequest $request
     * @return Response
     */
    public function store(PetugasRequest $request)
    {
        $petugas = $this->petugasRepository->create(
            $request->only(['kode_opd', 'nama_pejabat', 'jabatan', 'pangkat', 'aktif'])
        );

        return redirect()->route('petugas.index')
                ->with('success', "{$petugas->nama} berhasil disimpan");
    }

    /**
     * Form edit.
     *
     * @param OpdRepository $opdRepository
     * @param string $id
     * @return Illuminate\View\View
     */
    public function edit(OpdRepository $opdRepository, $id)
    {
        $opds = $opdRepository->all();
        $petugas = $this->petugasRepository->find($id);
        return view('petugas.edit', [
            'opds' => $opds,
            'petugas' => $petugas
        ]);
    }

    /**
     * Edit action.
     *
     * @param PetugasRequest $request
     * @param string $id
     * @return Response
     */
    public function update(PetugasRequest $request, $id)
    {
        $this->petugasRepository->update(
            $id,
            $request->only(['kode_opd', 'nama_pejabat', 'nip', 'jabatan', 'pangkat', 'aktif'])
        );

        return redirect()->route('petugas.index')
                ->with('success', 'Petugas berhasil disimpan');
    }

    /**
     * Delete action.
     *
     * @param string $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->petugasRepository->delete($id);

        return redirect()->route('petugas.index')
                ->with('success', 'Petugas berhasil dihapus');
    }
}
