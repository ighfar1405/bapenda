<html>
<head>
    <title>Wajib Retribusi Per Kecamatan</title>
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
        <p class="text-center font-weight-bold">
            DOKUMEN WAJIB RETRIBUSI ASSET TANAH DAN BANGUNAN <br/>
            YANG DIKUASAI OLEH PEMERINTAHAN KOTA AMBON <br/>
            DI KECAMATAN {{ strtoupper($kecamatan->nama) }}
        </p>
        <p class="text-center font-weight-bold">
            Kode: {{ $kecamatan->kode_administratif }}
        </p>
        <div class="clearfix"></div>

        <!-- Rincian Penerimaan -->
        <div class="col-print-12 content" style="font-size: 12px; margin: 0px">
            <table style="margin: 5px 0px 10px;">
                <tbody>
                    <tr>
                        <th class="text-center" style="width: 1%">
                            NO. <br/> 
                            URUT
                        </th>
                        <th class="text-center" style="width: 20%">NAMA WAJIB RETRIBUSI</th>
                        <th class="text-center" style="width: 15%">ALAMAT WAJIB RETRIBUSI</th>
                        <th class="text-center" style="width: 10%">LOKASI OBYEK RETRIBUSI</th>
                        <th class="text-center" style="width: 1%">
                            LUAS <br/>
                            (M<sup>2</sup>)
                        </th>
                        <th class="text-center">KLASIFIKASI</th>
                        <th class="text-center">
                            TARIF <br/>
                            RETRIBUSI <br/>
                            (Rp.)
                        </th>
                        <th class="text-center">
                            JUMLAH <br/>
                            RETRIBUSI <br/>
                            (Rp.)
                        </th>
                        <th class="text-center">Lunas {{ $tahun }}</th>
                        <th class="text-center">Status</th>
                    </tr>
                    @if($skrds->isNotEmpty())
                    @foreach ($skrds as $skrd)
                    <tr>
                        <td class="borderLeft text-center">{{ $loop->iteration }}</td>
                        <td class="borderLeft">{{ $skrd->pemakai->nama }}</td>
                        <td class="borderLeft">{{ $skrd->pemakai->alamat }}</td>
                        <td class="borderLeft">{{ $skrd->objectRetribusi->lokasi }}</td>
                        <td class="borderLeft text-right">{{ $skrd->objectRetribusi->luas }}</td>
                        <td class="borderLeft text-center">{{ $skrd->objectRetribusi->tarifRetribusi->klasifikasiPemakaian->jenis_klasifikasi }}</td>
                        <td class="borderLeft text-right">{{ $skrd->objectRetribusi->tarifRetribusi->tarif_meter }}</td>
                        <td class="borderLeft text-right">{{ $skrd->nominal_idr }}</td>
                        <td class="borderLeft text-right">{{ $skrd->tbpDetail ? $skrd->tbpDetail->nominal_idr : '0,00' }}</td>
                        @if ($skrd->tbpDetail)
                        @php
                            $balance = $skrd->nominal - $skrd->tbpDetail->nominal; 
                        @endphp
                            <td class="borderLeft">{{ $balance == 0 ? 'Sudah Lunas' : 'Belum Lunas' }}</td>
                        @else
                            <td class="borderLeft">Belum Lunas</td>
                        @endif
                    </tr>
                    @endforeach
                    @else
                    <tr >
                        <td class="borderLeft text-center" colspan="10">Data tidak ditemukan.</td>
                    </tr>
                    @endif
                    <tr class="font-weight-bold">
                        <td class="borderLeft text-center"></td>
                        <td class="borderLeft text-left" colspan="6">TOTAL</td>
                        <td class="borderLeft text-right" >Rp {{ format_idr($skrds->sum('nominal')) }}</td>
                        <td class="borderLeft" ></td>
                        <td class="borderLeft" ></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="clearfix"></div><br>
    </div>
</body>
</html>