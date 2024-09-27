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
            REALISASI PEMBAYARAN PIUTANG <br/>
            PER {{ Str::upper($today) }}
        </p>
        <div class="clearfix"></div>

        <div class="col-print-12 content" style="font-size: 12px; margin: 0px 10px;">
            <table style="margin: 5px 0px 10px;">
                <tbody>
                    <tr>
                        <th class="text-center" rowspan="2" style="width: 1%">NO.</th>
                        <th class="text-center" rowspan="2" style="width: 20%">Jumlah Penerimaan <br/> Piutang Tahun {{ $selectedYear }} (Rp)</th>
                        <th class="text-center" colspan="5">Realisasi Pembayaran Tahun Piutang</th>
                        <th class="text-center" rowspan="2">Jumlah</th>
                    </tr>

                    <tr>
                        @foreach ($years as $year)
                            <th class="text-center">{{ $year }}</th>
                        @endforeach
                    </tr>

                    @php
                        $yearNominal = [];
                        foreach($years as $year)
                            $yearNominal[$year] = 0;
                        
                        $totalNominal = 0;
                    @endphp
                    
                    @foreach ($piutangs as $kecamatan => $years)
                        <tr>
                            <td class="borderLeft text-center">{{ $loop->iteration }}</td>
                            <td class="borderLeft text-left">{{ $kecamatan }}</td>
                            @php
                                $nominalKecamatan = 0;
                            @endphp
                            @foreach ($years as $year => $nominal)
                                <td class="borderLeft text-right">{{ format_idr($nominal) }}</td>
                                @php
                                    $yearNominal[$year] += $nominal;
                                    $nominalKecamatan += $nominal;
                                @endphp
                            @endforeach
                            <td class="borderLeft text-right">{{ format_idr($nominalKecamatan) }}</td>
                            @php
                                $totalNominal += $nominalKecamatan;
                            @endphp
                        </tr>
                    @endforeach

                    <tr>
                        <td class="borderLeft text-center"></td>
                        <td class="borderLeft text-center font-weight-bold">Jumlah</td>
                        @foreach ($yearNominal as $nominal)
                            <td class="borderLeft text-right font-weight-bold">{{ format_idr($nominal) }}</td>
                        @endforeach
                        <td class="borderLeft text-right font-weight-bold">{{ format_idr($totalNominal) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="clearfix"></div><br>
    </div>
</body>
</html>