<html>
<head>
	<style>
		body { font-family: "Times New Roman", Times, serif; }
		.col-print-1 {width:8%;  float:left;}
		.col-print-2 {width:16%; float:left;}
		.col-print-3 {width:25%; float:left;}
		.col-print-4 {width:33%; float:left;}
		.col-print-5 {width:42%; float:left;}
		.col-print-6 {width:50%; float:left;}
		.col-print-7 {width:58%; float:left;}
		.col-print-8 {width:66%; float:left;}
		.col-print-9 {width:75%; float:left;}
		.col-print-10{width:83%; float:left;}
		.col-print-11{width:92%; float:left;}
		.col-print-12{width:100%; float:left;}
		.clearfix{clear: both}
		table { width: 100%; }
		.content table, td, th { border: 1px solid black; }
		/* .content th { background: grey; } */
		.content table { border-collapse: collapse; width: 100%; }
        th { padding: 8px; font-size: 11px; }
		td { padding: 5px; margin-left: 7px; font-size: 12px; vertical-align: top; }
		.text-left{ text-align: left !important; }
		.text-center{ text-align: center !important; }
		.text-right{ text-align: right !important; }
		.font-weight-bold { font-weight: 700 !important; }
		.page-break { page-break-before: always; }
		.borderLeft { border: 0; border-left: 1px solid #000; }
		.borderNone { border: 0; }
        .header { border-bottom: 1px solid #000; }
    </style>
</head>
<body>
    <div class="container">
        <p class="text-center font-weight-bold" style="font-size: 16px;">
            PEMERINTAH KOTA AMBON <br/>
            BADAN KEUANGAN DAN ASET DAERAH
        </p>
        <p class="text-center font-weight-bold" style="font-size: 14px;">
            PENDAPATAN DITERIMA DIMUKA <br/>
            (PENDAPATAN DITERIMA DI MUKA LAINNYA) <br/>
            PER 31 DESEMBER 2019
        </p>
        <div class="clearfix"></div>

        <div class="col-print-12 content" style="font-size: 12px; margin: 0px 10px;">
            <table style="margin: 5px 0px 10px;">
                <tbody>
                    <tr>
                        <th class="text-center" style="width: 1%">NO.</th>
                        <th class="text-center">
                            No. <br/>
                            SKRD
                        </th>
                        <th class="text-center" style="width: 10%">Nama Wajib Retribusi</th>    
                        <th class="text-center" style="width: 15%">Tema / Alamat</th>
                        <th class="text-center">Tgl. Awal</th>
                        <th class="text-center">Tgl. Jatuh <br/> Tempo</th>
                        <th class="text-center">Tgl. <br/> Pelaporan</th>
                        <th class="text-center" style="width: 1%">Jumlah <br/> Periode <br/> (bulan)</th>
                        <th class="text-center" style="width: 5%;">Nominal</th>
                        <th class="text-center">Pendapatan <br/> Jasa Per <br/> Periode</th>
                        <th class="text-center">Periode <br/> Sampai <br/> bulan ini</th>
                        <th class="text-center">Pendapatan <br/> Jasa pada <br/> tahun ini <br/> (s.d)</th>
                        <th class="text-center">Pendapatan <br/> Diterima <br/> dimuka</th>
                        <th class="text-center">Kode <br/> Rekening</th>
                    </tr>
                    
                    @for($i = 1; $i <= 10; $i++)
                    <tr>
                        <td class="borderLeft text-center"><?= $i ?></td>
                        <td class="borderLeft">0007904</td>
                        <td class="borderLeft">Anna Rokhatus Djoenadi</td>
                        <td class="borderLeft">INDOMART, Jl. Mulyorejo RT.05 RW.03 Kav. A</td>
                        <td class="borderLeft text-center">01/11/2019</td>
                        <td class="borderLeft text-center">01/11/2020</td>
                        <td class="borderLeft text-center">31/12/2019</td>
                        <td class="borderLeft text-center">12</td>
                        <td class="borderLeft text-right">900.000,00</td>
                        <td class="borderLeft text-right">75.000,00</td>
                        <td class="borderLeft text-right">2</td>
                        <td class="borderLeft text-right">150.000,00</td>
                        <td class="borderLeft text-right">750.000,00</td>
                        <td class="borderLeft">4.1.2.02.01</td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>

        <div class="clearfix"></div><br>
    </div>
</body>
</html>