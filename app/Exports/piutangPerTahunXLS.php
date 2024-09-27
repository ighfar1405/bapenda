<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Contracts\View\View;

class piutangPerTahunXLS implements FromView, WithHeadings, WithEvents
{
    private $data;

    public function __construct($a1, $a2)
    {
        $this->skrdTahun = $a1;
        $this->tbpTahun  = $a2;
    }

    public function headings() : array {
        return [
            'NO',
            'URAIAN',
            'NOMINAL',
            'JUMLAH BAYAR',
            'Piutang sesudah koreksi',
            'Pelunasan atas saldo Piutang',
            'Sisa Piutang Tahun',
            'Penambahan Piutang Tahun',
            'Saldo Piutang'
       ];
    }
    public function registerEvents() :array {
        return [
            AfterSheet::class => function(AfterSheet $evt){

                $evt->sheet->getDelegate()->getColumnDimension('B')->setWidth(20);
                $evt->sheet->getDelegate()->getColumnDimension('C')->setWidth(20);
                $evt->sheet->getDelegate()->getColumnDimension('D')->setWidth(22);
                $evt->sheet->getDelegate()->getColumnDimension('E')->setWidth(20);
                $evt->sheet->getDelegate()->getColumnDimension('F')->setWidth(20);
                $evt->sheet->getDelegate()->getColumnDimension('G')->setWidth(20);
                $evt->sheet->getDelegate()->getColumnDimension('H')->setWidth(24);
                $evt->sheet->getDelegate()->getColumnDimension('I')->setWidth(24);

                $evt->sheet->getDelegate()->getRowDimension('1')->setRowHeight(50);
            }
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
    }

    public function view() : View
    {
        return view('report.xls.piutang_pertahun',[
            'skrdTahun' => $this->skrdTahun,
            'tbpTahun'  => $this->tbpTahun
        ]);
    }
}
