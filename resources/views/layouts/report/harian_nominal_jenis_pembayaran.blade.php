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
		.borderBottom { border-bottom: 1px solid #000; }
        .header { border-bottom: 1px solid #000; }
    </style>
</head>
<body>
    <div class="container">
        <p class="text-center font-weight-bold">
            LAPORAN NOMINAL BERDASARKAN JENIS PEMBAYARAN <br/><br/>
            @if (!$tanggalAkhir)
            TANGGAL {{ \Carbon\Carbon::parse($tanggalAwal)->format('d/m/Y') }} 
            @else
            TANGGAL {{ \Carbon\Carbon::parse($tanggalAwal)->format('d/m/Y') }} s/d {{ \Carbon\Carbon::parse($tanggalAkhir)->format('d/m/Y') }}
            @endif
        </p>
        <div class="clearfix"></div>
        
        <div class="col-print-12 content" style="font-size: 12px; margin: 0px 10px;">
            <table style="margin: 5px 0px 10px;">
                <tbody>
                    <tr>
                        <th class="text-center" style="width: 1%">NO</th>
                        <th class="text-center" style="width: 20%">TIPE</th>
                        <th class="text-center" style="width: 20%">NOMINAL</th>
                    </tr>
                    
                    <tr>
                        <td class="borderLeft text-center">1</td>
                        <td class="borderLeft text-left">TBP-OA</td>
                        <td class="borderLeft text-right">{{ format_idr($nominalTbp['TBP_OA']) }}</td>
                    </tr>

                    <tr>
                        <td class="borderLeft text-center">2</td>
                        <td class="borderLeft text-left">TBP-PUTG</td>
                        <td class="borderLeft text-right">{{ format_idr($nominalTbp['TBP_PUTG']) }}</td>
                    </tr>

                    <tr>
                        <td class="borderLeft text-center">3</td>
                        <td class="borderLeft text-left">TBP-SA</td>
                        <td class="borderLeft text-right">{{ format_idr($nominalTbp['TBP_SA']) }}</td>
                    </tr>

                    <tr>
                        <td class="borderLeft borderBottom">&nbsp;</td>
                        <td class="borderLeft borderBottom">&nbsp;</td>
                        <td class="borderLeft borderBottom">&nbsp;</td>
                    </tr>

                    <tr>
                        <td class="borderLeft text-center"></td>
                        <td class="borderLeft font-weight-bold text-center">JUMLAH</td>
                        <td class="borderLeft font-weight-bold text-right">
                            {{ format_idr($totalNominalTbp) }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="clearfix"></div><br>
    </div>
</body>
</html>