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
        th { padding: 8px; font-size: 14px; }
		td { padding: 5px; margin-left: 7px; font-size: 12px; }
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
    <div class="container" style="border: 1px solid #000000;">
        <div class="col-print-2 text-center">
            <img style="width:70px; margin-top: 15px;" src="{{ public_path('img/logo.png') }}" alt="">
        </div>
        
        <div class="col-print-8">
            <p class="text-center font-weight-bold">
                SURAT KETETAPAN RETRIBUSI DAERAH <br/>
                {{ $skrd->getYear() }} <br/>
                BKAD KOTA AMBON
            </p>
            <p class="text-center font-weight-bold" style="font-size: 14px;">
                Nomor SKRD: {{ $skrd->format_nomor }} <br/>
                Kec. {{ $skrd->pemakai->kelurahan->kecamatan->nama }}
            </p>
        </div>
        
        <div class="clearfix"></div>

        <div class="col-print-12" style="border-top: 1px solid #000; padding-top: 5px;">
            <table>
                <tbody>
                    <tr>
                        <td class="borderNone" style="width: 20%;">Nama WR</td>
                        <td class="borderNone" style="width: 1%;" class="text-right">:</td>
                        <td class="borderNone" style="width: 60%;">{{ $skrd->pemakai->nama }}</td>
                    </tr>

                    <tr>
                        <td class="borderNone" style="width: 20%;">Alamat WR</td>
                        <td class="borderNone" style="width: 1%;" class="text-right">:</td>
                        <td class="borderNone" style="width: 60%;">{{ $skrd->pemakai->alamat }}</td>
                    </tr>

                    <tr>
                        <td class="borderNone" style="width: 20%;">No SK</td>
                        <td class="borderNone" style="width: 1%;" class="text-right">:</td>
                        <td class="borderNone" style="width: 60%;">{{ $skrd->pemakai->nik ?? '-'}}</td>
                    </tr>

                    <tr>
                        <td class="borderNone" style="width: 20%;">Keterangan</td>
                        <td class="borderNone" style="width: 1%;" class="text-right">:</td>
                        <td class="borderNone" style="width: 60%;">{{ $skrd->keterangan }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="clearfix"></div>

        <div class="col-print-12 content" style="font-size: 12px; margin: 0px 10px;">
            Retribusi Tanah Tahun {{ $skrd->getYear() }} di:
            <table style="margin: 5px 0px 10px;">
                <tbody>
                    <tr>
                        <th class="text-center" style="width: 40%">Alamat</th>
                        <th class="text-center" style="width: 20%">Fungsi</th>
                        <th class="text-center" style="width: 30%">Luas</th>
                        <th class="text-center" style="width: 25%">Jumlah (Rp)</th>
                    </tr>

                    @php
                        $totalRetribusi = $skrd->objectRetribusi->luas * $skrd->objectRetribusi->tarifRetribusi->tarif_meter_float;
                    @endphp
                    <tr>
                        <td class="borderLeft">{{ $skrd->objectRetribusi->lokasi }}</td>
                        <td class="borderLeft">{{ $skrd->objectRetribusi->tarifRetribusi->klasifikasiPemakaian->jenis_klasifikasi }}</td>
                        <td class="borderLeft">{{ $skrd->objectRetribusi->luas }} m<sup>2</sup> x {{ format_idr($skrd->objectRetribusi->tarifRetribusi->tarif_meter_float, true) }}</td>
                        <td class="borderLeft text-right">{{ format_idr($totalRetribusi) }}</td>
                    </tr>
                    
                    @php
                        $tax = 0.02 * $totalRetribusi;
                        $totalTagihan = $totalRetribusi + $tax;
                    @endphp

                    <tr>
                        <td colspan="3" class="text-right">Denda 2% per bulan (PERDA No. 02 Tahun 2011)</td>
                        <td class="text-right">{{ format_idr($tax) }}</td>
                    </tr>

                    <tr>
                        <td colspan="3" class="text-right font-weight-bold">Jumlah</td>
                        <td class="text-right font-weight-bold">{{ format_idr($totalTagihan) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="clearfix"></div><br>

        <div class="col-print-6"></div>

        <div class="col-print-6 text-center" style="font-size: 12px;">
            <br/>
            <div class="font-weight-bold">
                {{ $skrd->getYear() }} <br/>
                An. Ka. UPT Pengawasan dan Pengendalian Ijin<br/>
                Pemakaian Kekayaan Daerah
            </div>
            <br><br><br><br>
            <u>MISBAHUL ANAM, SH</u><br>
            NIP. 19630403 198503 1 015
        </div>

        <div class="clearfix"></div><br>
    </div>
</body>
</html>