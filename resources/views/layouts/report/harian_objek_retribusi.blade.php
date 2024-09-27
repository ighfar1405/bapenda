<html>
<head>
    <title>Laporan Harian Objek Retribusi</title>
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
        .borderTop { border-top: 1px solid #000; }
        .header { border-bottom: 1px solid #000; }
    </style>
</head>
<body>
    <div class="container">
        <p class="text-center font-weight-bold">
            LAPORAN HARIAN OBJEK RETRIBUSI <br/><br/>
            @if (!$tanggalAkhir)
            TANGGAL {{ \Carbon\Carbon::parse($tanggalAwal)->format('d/m/Y') }} 
            @else
            TANGGAL {{ \Carbon\Carbon::parse($tanggalAwal)->format('d/m/Y') }} s/d {{ \Carbon\Carbon::parse($tanggalAkhir)->format('d/m/Y') }}
            @endif
        </p>
        <div class="clearfix"></div>
        
        <div class="col-print-12 content" style="font-size: 12px; margin: 0px">
            <table style="margin: 5px 0px 10px;">
                <tbody>
                    <tr>
                        <th class="text-center" style="width: 1%">NO</th>
                        <th class="text-center" style="width: 5%">TANGGAL</th>
                        <th class="text-center" style="width: 20%">NAMA WR</th>
                        <th class="text-center" style="width: 20%">LOKASI OBYEK RETRIBUSI</th>
                        <th class="text-center" style="width: 1%">
                            LUAS <br/>
                            (M<sup>2</sup>)
                        </th>
                        <th class="text-center">TARIF</th>
                        <th class="text-center">TOTAL TARIF</th>
                        <th class="text-center">TOTAL BAYAR</th>
                        <th class="text-center">TIPE</th>
                    </tr>
                    
                    @foreach ($objectRetribusi as $item)
                    <tr>
                        <td class="borderLeft text-center"><?= $loop->iteration ?></td>
                        <td class="borderLeft">{{ $item['tanggal'] }}</td>
                        <td class="borderLeft">{{ $item['nama_wr'] }}</td>
                        <td class="borderLeft">{{ $item['lokasi_objek'] }}</td>
                        <td class="borderLeft">{{ $item['luas'] }}</td>
                        <td class="borderLeft text-right">{{ $item['tarif'] }}</td>
                        <td class="borderLeft text-right">{{ format_idr($item['total_tarif']) }}</td>
                        <td class="borderLeft text-right">{{ format_idr($item['total_bayar']) }}</td>
                        <td class="borderLeft text-left">{{ $item['tipe'] }}</td>
                    </tr>
                    @endforeach

                    <tr>
                        <td class="borderLeft borderTop text-center"></td>
                        <td class="borderLeft borderTop font-weight-bold text-center" colspan="5">JUMLAH</td>
                        <td class="borderLeft borderTop font-weight-bold text-right">
                            {{ format_idr($totalBayar) }}
                        </td>
                        <td class="borderLeft borderTop font-weight-bold text-right">
                            {{ format_idr($totalBayar) }}
                        </td>
                        <td class="borderLeft borderTop text-center"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="clearfix"></div><br>
    </div>
</body>
</html>