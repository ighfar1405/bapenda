<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\OpdRequest;
use App\Repository\User\OpdRepository;

class OpdController extends Controller
{
    /**
     * Opd repository.
     *
     * @var OpdRepository
     */
    private $opdRepository;

    /**
     * Constructor.
     *
     * @param OpdRepository $opdRepository
     */
    public function __construct(OpdRepository $opdRepository)
    {
        $this->opdRepository = $opdRepository;
    }

    /**
     * Lists.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $opds = $this->opdRepository->all($request->all());
        return view('opd.index', [
            'opds' => $opds
        ]);
    }

    /**
     * Form create.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        return view('opd.create');
    }

    /**
     * Create action.
     *
     * @param OpdRequest $request
     * @return Response
     */
    public function store(OpdRequest $request)
    {
        $opd = $this->opdRepository->create(
            $request->only(['kode_opd', 'nama_opd'])
        );

        return redirect()->route('opd.index')
                ->with('success', "{$opd->nama} berhasil disimpan");
    }

    /**
     * Form edit.
     *
     * @param string $id
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $opd = $this->opdRepository->find($id);
        return view('opd.edit', [
            'opd' => $opd
        ]);
    }

    /**
     * Update action.
     *
     * @param OpdRequest $request
     * @param string $id
     * @return Response
     */
    public function update(OpdRequest $request, $id)
    {
        $this->opdRepository->update($id, $request->only(['kode_opd', 'nama_opd']));
        return redirect()->route('opd.index')
                ->with('success', 'OPD berhasil diperbarui');
    }

    /**
     * Delete action.
     *
     * @param string $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->opdRepository->delete($id);
        return redirect()->route('opd.index')
                ->with('success', 'OPD berhasil dihapus');
    }
}
