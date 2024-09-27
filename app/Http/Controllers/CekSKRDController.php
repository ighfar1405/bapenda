<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Transaction\SkrdRepository;
use App\Repository\Statis\AkunRepository;

class CekSKRDController extends Controller
{
    private $skrdRepository;
    private $akunRepository;

    public function __construct(
        SkrdRepository $skrdRepository,
        AkunRepository $akunRepository
    )
    {
        $this->skrdRepository = $skrdRepository;
        $this->akunRepository = $akunRepository;
    }

    public function index(Request $request)
    {
        if (!empty($request->query())) {
            $skrd = $this->skrdRepository->allPaginate($request);
            $akunBendahara = $this->akunRepository->getAkunBendahara('4.1.2.02.01');

            $skrd->appends($request->query());            
        } else {
            $skrd = [];
            $akunBendahara = [];
        }

        return view('cek-skrd', compact('skrd', 'akunBendahara'));
    }
}
