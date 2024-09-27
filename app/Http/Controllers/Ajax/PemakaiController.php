<?php

namespace App\Http\Controllers\Ajax;

use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\User\PemakaiRepository;

class PemakaiController extends Controller
{
    /**
     * Pemakai repository
     *
     * @var PemakaiRepository
     */
    private $pemakaiRepository;

    /**
     * Constructor
     * 
     * @param PemakaiRepository $pemakaiRepository
     */
    public function __construct(PemakaiRepository $pemakaiRepository)
    {
        $this->pemakaiRepository = $pemakaiRepository;
    }

    /**
     * Get pemakai.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->query('name') ?? '';
        $tanggal = $request->query('tanggal') ?? '';
        $pemakai = $this->pemakaiRepository->getPemakaiByName($keyword, $tanggal);
        return response()->json($pemakai);
    }
    public function index1(Request $request)
    {
        $keyword = $request->query('name') ?? '';
        $tanggal = $request->query('tanggal') ?? '';
        $pemakai = $this->pemakaiRepository->getPemakaiByNameTbp($keyword, $tanggal);
        return response()->json($pemakai);
    }

    /**
     * Show pemakai with skrd
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return response()->json($this->pemakaiRepository->all());
    }

    public function getData()
    {
        $pemakai = $this->pemakaiRepository->all();
        return Datatables::of($pemakai)
            ->addIndexColumn()
            ->addColumn('kelurahan', function ($row){
                return $row->kelurahan->nama;
            })
            ->addColumn('action', function ($row) {
                $btn = '<a href="'.route('pemakai.edit', $row->id).'" class="btn btn-sm btn-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="javascript:;" class="btn btn-sm btn-danger"
                                        data-toggle="modal" onclick="deleteData('.$row->id.')" 
                                        data-target="#DeleteModal">
                                        <i class="fa fa-trash"></i>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
