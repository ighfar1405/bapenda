<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\ListOpdRequest;
use App\Repository\ListOpdRepository;

class ListOpdController extends Controller
{
    /**
     * ListOpd repository.
     *
     * @var ListOpdRepository
     */
    private $listOpdRepository;

    /**
     * Constructor.
     *
     * @param ListOpdRepository $listOpdRepository
     */
    public function __construct(ListOpdRepository $listOpdRepository)
    {
        $this->listOpdRepository = $listOpdRepository;
    }

    /**
     * Lists.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        try {
            $list_opd = $this->listOpdRepository->allPaginate([
                'keyword' => $request->query('keyword')
            ]);

            $list_opd->appends($request->query());

            return view('list_opd.index', compact('list_opd'));
        } catch (\Exception $e) {
            \Log::error('Error fetching List OPD: ' . $e->getMessage());
            return redirect()->route('list_opd.index')
                ->with('error', 'Terjadi kesalahan saat memuat data. Silakan coba lagi.');
        }
    }

    /**
     * Form create.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('list_opd.create');
    }

    /**
     * Create action.
     *
     * @param ListOpdRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ListOpdRequest $request)
    {
        $list_opd = $this->listOpdRepository->create(
            $request->only([
                'nama_opd',
                'jenis_retribusi',
                'objek_retribusi',
                'rincian_objek',
                'sub_rincian_objek',
                'sub_sub_rincian_objek',
                'detail_rincian',
                'tarif',
                'satuan',
                'status',
                'link'
            ])
        );

        return redirect()->route('list_opd.index')
            ->with('success', 'Data Retribusi berhasil disimpan');
    }

    /**
     * Form edit.
     *
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $list_opd = $this->listOpdRepository->find($id);
        return view('list_opd.edit', compact('list_opd'));
    }

    /**
     * Edit action.
     *
     * @param ListOpdRequest $request
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function update(ListOpdRequest $request, $id)
    {
        $this->listOpdRepository->update(
            $id,
            $request->only([
                'nama_opd',
                'jenis_retribusi',
                'objek_retribusi',
                'rincian_objek',
                'sub_rincian_objek',
                'sub_sub_rincian_objek',
                'detail_rincian',
                'tarif',
                'satuan',
                'status',
                'link'
            ])
        );

        return redirect()->route('list_opd.index')
            ->with('success', 'Data Retribusi berhasil diupdate');
    }

    /**
     * Delete action.
     *
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = $this->listOpdRepository->delete($id);

        if (!$delete) {
            return redirect()->route('list_opd.index')
                ->with('error', 'Data Retribusi tidak dapat dihapus karena masih digunakan.');
        }

        return redirect()->route('list_opd.index')
            ->with('success', 'Data Retribusi berhasil dihapus');
    }
}
