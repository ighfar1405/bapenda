<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Master\KlasifikasiPemakaianRepository;
use App\Repository\Master\ObjectRetribusiRepository;
use App\Repository\Statis\TahunRepository;
use App\Repository\Transaction\MonitoringPiutangRepository;
use App\Repository\Transaction\TbpRepository;
use App\Repository\Transaction\SkrdRepository;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        SkrdRepository $skrdRepository,
        TbpRepository $tbpRepository
    )
    {
        $this->tbpRepository = $tbpRepository;
        $this->skrdRepository = $skrdRepository;
        // $this->middleware('auth');
    }

    /**
     * Show the application landing page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(
        Request $request,
        KlasifikasiPemakaianRepository $klasifikasiRepository,
        ObjectRetribusiRepository $objectRetribusiRepository,
        TbpRepository $tbpRepository,
        SkrdRepository $skrdRepository,
        TahunRepository $tahunRepository,
        MonitoringPiutangRepository $monitoringPiutangRepository
    )
    {
        $yearActive = $request->year ? $request->year : date('Y');
        $tahun = $tahunRepository->all();
        $attributes = ['year' => $yearActive];
        $totalKlasifikasi = $klasifikasiRepository->countObject();
        $piutang = $monitoringPiutangRepository->getPiutang($attributes);
        $nominalPiutang = 0;
        foreach($piutang as $item) {
            $nominalPiutang += $item->tbpDetail ? $item->nominal-$item->tbpDetail->nominal : $item->nominal;
        }
        $totalNominalTbp = $tbpRepository->getPaymentToday();

        //data penerimaan poer tahun
        $data1 = '';
        $tbpSkrd1 = $this->tbpRepository->sumAll();
        // return $tbpSkrd1;
        foreach ($tbpSkrd1 as $value) {
            $data1 .= "{ year:'".$value["tahun"]."',

                value:".$value["total"]." },";
            # code...
        }
        // return $data1;
        //data piutang poer tahun
        $data2 = '';
        $gpiutang = $this->skrdRepository->sumAll();
        // return $gpiutang;
        foreach ($gpiutang as $value) {
            $total = $value->total;
            $ttl = $value->ttl;
            $piutang = $total-$ttl;
            $data2 .= "{ year:'".$value->tahun."',

                value:".$piutang." },";
            # code...
        }

        // penerimaan per kecamatan
        $penerimaanPerKecamatan = '';

        $allPenerimaan = $this->tbpRepository->sumAllKecamatan();
        // return $allPenerimaan;
        foreach ($allPenerimaan as $key => $value) {
            if ($key == 0) {
                $penerimaanPerKecamatan .= "{'year':'$value->tahun'";
            }
            if ($key >= 1) {
                if ($value->tahun == $allPenerimaan[$key - 1]->tahun) {
                    $penerimaanPerKecamatan .= ",'$value->nama' :$value->total";
                }
                else{
                    // $penerimaanPerKecamatan .= "}";
                    $penerimaanPerKecamatan .= "},{'year':'$value->tahun'";
                    if ($key <= count($allPenerimaan) - 2) {
                        if ($value->tahun != $allPenerimaan[$key + 1]->tahun) {
                            $penerimaanPerKecamatan .= ",'$value->nama' :$value->total";
                            // $penerimaanPerKecamatan .= "},";
                        }
                        else{
                            $penerimaanPerKecamatan .= ",'$value->nama' :$value->total";
                            // $penerimaanPerKecamatan .= "},";
                        }
                    }
                }
            }

            if ($key == count($allPenerimaan) - 1) {
                $penerimaanPerKecamatan .= "}";
            }
        }

        // piutang per kecamatan
        $piutangPerKecamatan = '';

        $allPenerimaan = $this->skrdRepository->sumAllKcmtn();
        // return $allPenerimaan;
        foreach ($allPenerimaan as $key => $value) {
            $total = $value->total - $value->ttl;
            if ($key == 0) {
                $piutangPerKecamatan .= "{year:'$value->tahun','$value->nama_kecamatan' :$total";
            }
            if ($key >= 1) {
                if ($value->tahun == $allPenerimaan[$key - 1]->tahun) {
                    $piutangPerKecamatan .= ",'$value->nama_kecamatan' :$total";
                }
                else{
                    // $piutangPerKecamatan .= "}";
                    $piutangPerKecamatan .= "},{year:'$value->tahun'";
                    if ($key <= count($allPenerimaan) - 2) {
                        if ($value->tahun != $allPenerimaan[$key + 1]->tahun) {
                            $piutangPerKecamatan .= ",'$value->nama_kecamatan' :$total";
                            // $piutangPerKecamatan .= "},";
                        }
                        else{
                            $piutangPerKecamatan .= ",'$value->nama_kecamatan' :$total";
                            // $piutangPerKecamatan .= "},";
                        }
                    }
                }
            }


            if ($key == count($allPenerimaan) - 1) {
                $piutangPerKecamatan .= "}";
            }
        }
// return $piutangPerKecamatan;
        return view('dashboard', compact('totalKlasifikasi', 'nominalPiutang', 'totalNominalTbp', 'tahun', 'yearActive','data1','data2', 'penerimaanPerKecamatan','piutangPerKecamatan'));
    }
    public function grafik_piutang(SkrdRepository $skrdRepository){
        $data1 = '';
        $tbpSkrd1 = $this->tbpRepository->sumAllKecamatan(2020);
        return $tbpSkrd1;
        foreach ($tbpSkrd1 as $value) {
            $data1 .= "{ year:'".$value["tahun"]."',

                value:".$value["total"]." },";
            # code...
        }
        return $data1;

    }

    // public function testTbp()
    // {
    //     /*
    //     { year: '2008', value: 1500 ,a: 2000, b: 1000, c: 500 },
    //     { year: '2009', value: 1000, a: 2000, b: 1500, c: 1500},
    //     { year: '2010', value: 2000, a: 1500, b: 1000, c: 2500 },
    //     { year: '2011', value: 1500, a: 2500, b: 1500, c: 1500 },
    //     { year: '2012', value: 2000, a: 1000, b: 2000, c: 500 },
    //     { year: '2013', value: 2500, a: 1500, b: 500, c: 1500 },
    //     { year: '2014', value: 1000, a: 2000, b: 2500, c: 1500 },
    //     { year: '2015', value: 0, a: 2500, b: 1000 },
    //     { year: '2016', value: 1000, a: 2000, b: 1500 }
    //     */
    //     $penerimaanPerKecamatan = '';

    //     $allPenerimaan = $this->tbpRepository->sumAllKecamatan(2020);
    //     // return $allPenerimaan;
    //     foreach ($allPenerimaan as $key => $value) {
    //         if ($key == 0) {
    //             $penerimaanPerKecamatan .= "{year:'$value->tahun'";
    //         }
    //         if ($key >= 1) {
    //             if ($value->tahun == $allPenerimaan[$key - 1]->tahun) {
    //                 $penerimaanPerKecamatan .= ",'$value->nama' :$value->total";
    //             }
    //             else{
    //                 // $penerimaanPerKecamatan .= "}";
    //                 $penerimaanPerKecamatan .= "},{year:'$value->tahun'";
    //                 if ($key <= count($allPenerimaan) - 2) {
    //                     if ($value->tahun != $allPenerimaan[$key + 1]->tahun) {
    //                         $penerimaanPerKecamatan .= ",'$value->nama' :$value->total";
    //                         // $penerimaanPerKecamatan .= "},";
    //                     }
    //                     else{
    //                         $penerimaanPerKecamatan .= ",'$value->nama' :$value->total";
    //                         // $penerimaanPerKecamatan .= "},";
    //                     }
    //                 }
    //             }
    //         }


    //         if ($key == count($allPenerimaan) - 1) {
    //             $penerimaanPerKecamatan .= "}";
    //         }
    //     }
    //     return $penerimaanPerKecamatan;
    // }

    // public function testSkrd()
    // {
    //     // return $this->skrdRepository->sumAllKcmtn();

    //     $piutangPerKecamatan = '';

    //     $allPenerimaan = $this->skrdRepository->sumAllKcmtn();
    //     // return $allPenerimaan;
    //     foreach ($allPenerimaan as $key => $value) {
    //         $total = $value->ttl - $value->total;
    //         if ($key == 0) {
    //             $piutangPerKecamatan .= "{year:'$value->tahun'";
    //         }
    //         if ($key >= 1) {
    //             if ($value->tahun == $allPenerimaan[$key - 1]->tahun) {
    //                 $piutangPerKecamatan .= ",'$value->nama' :$total";
    //             }
    //             else{
    //                 // $piutangPerKecamatan .= "}";
    //                 $piutangPerKecamatan .= "},{year:'$value->tahun'";
    //                 if ($key <= count($allPenerimaan) - 2) {
    //                     if ($value->tahun != $allPenerimaan[$key + 1]->tahun) {
    //                         $piutangPerKecamatan .= ",'$value->nama' :$total";
    //                         // $piutangPerKecamatan .= "},";
    //                     }
    //                     else{
    //                         $piutangPerKecamatan .= ",'$value->nama' :$total";
    //                         // $piutangPerKecamatan .= "},";
    //                     }
    //                 }
    //             }
    //         }


    //         if ($key == count($allPenerimaan) - 1) {
    //             $piutangPerKecamatan .= "}";
    //         }
    //     }
    //     return $piutangPerKecamatan;
    // }
}
