<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Contracts\View\View;

class lahanPertanianXLS implements FromView, WithHeadings, WithEvents
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function headings() : array {
        return [
            'NO',
            'NAMA PENYEWA',
            'NO TELP',
            'ALAMAT',
            'LETAK TANAH',
            'LUAS',
            'JENIS TANAMAN',
            'SEWA HEKTAR',
            'NOMOR SERTIFIKAT',
            'JUMLAH',
            'BUKTI SETORAN',
            'JANGKA WAKTU',
            'TANGGAL SETORAN',
            'TANGGAL BERAKHIR'
       ];
    }
    public function registerEvents() :array {
        return [
            AfterSheet::class => function(AfterSheet $evt){

                $evt->sheet->getDelegate()->getColumnDimension('B')->setWidth(20);
                $evt->sheet->getDelegate()->getColumnDimension('C')->setWidth(18);
                $evt->sheet->getDelegate()->getColumnDimension('D')->setWidth(24);
                $evt->sheet->getDelegate()->getColumnDimension('E')->setWidth(24);
                $evt->sheet->getDelegate()->getColumnDimension('F')->setWidth(14);
                $evt->sheet->getDelegate()->getColumnDimension('G')->setWidth(20);
                $evt->sheet->getDelegate()->getColumnDimension('H')->setWidth(26);
                $evt->sheet->getDelegate()->getColumnDimension('I')->setWidth(22);
                $evt->sheet->getDelegate()->getColumnDimension('J')->setWidth(26);
                $evt->sheet->getDelegate()->getColumnDimension('K')->setWidth(26);
                $evt->sheet->getDelegate()->getColumnDimension('L')->setWidth(13);
                $evt->sheet->getDelegate()->getColumnDimension('M')->setWidth(14);
                $evt->sheet->getDelegate()->getColumnDimension('N')->setWidth(14);
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
        return view('report.xls.lahan_pertanian', $this->data);
    }
}
