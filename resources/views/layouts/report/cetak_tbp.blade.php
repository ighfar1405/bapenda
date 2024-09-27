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
		/* .content table, td, th { border: 1px solid black; } */
		/* .content th { background: grey; } */
		.content table { border-collapse: collapse; width: 100%; }
        th { padding: 8px; font-size: 14px; }
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
    <div class="container" style="border: 1px solid #000000;">
        <div class="col-print-2 text-center">
            <!--img style="width:70px; margin-top: 15px;" src="{{ public_path('img/logo.png') }}" alt=""-->
            <img style="width:70px; margin-top: 15px;" src="{{ asset('img/logo.png') }}" alt="">
        </div>

        <div class="col-print-8">
            <p class="text-center font-weight-bold">
                Tanda Bukti Pembayaran <br/>
                {{ $tbp->getYear() }} <br/>
                BKAD KOTA AMBON
            </p>
            <p class="text-center font-weight-bold" style="font-size: 14px;">
                Nomor SSRD: {{ $tbp->format_nomor }} <br/>
            </p>
        </div>

        <div class="clearfix"></div>

        <div class="col-print-12" style="border-top: 1px solid #000; padding-top: 5px;">
            <table>
                <tbody>
                    <tr>
                        <td class="borderNone" style="width: 20%;">AC Rek</td>
                        <td class="borderNone" style="width: 1%;" class="text-right">:</td>
                        <td class="borderNone" style="width: 60%;">{{ $tbp->rekeningBank->no_rekening }}/{{ $tbp->rekeningBank->nama_bank }}</td>
                    </tr>

                    <tr>
                        <td class="borderNone" style="width: 20%;">Nama</td>
                        <td class="borderNone" style="width: 1%;" class="text-right">:</td>
                        <td class="borderNone" style="width: 60%;">{{ $tbp->pemakai->nama }}</td>
                    </tr>

                    <tr>
                        <td class="borderNone" style="width: 20%;">Keterangan</td>
                        <td class="borderNone" style="width: 1%;" class="text-right">:</td>
                        <td class="borderNone" style="width: 60%;">{{ $tbp->keterangan }}</td>
                    </tr>

                    <tr>
                        <td class="borderNone" style="width: 20%;">Tanggal Pembayaran</td>
                        <td class="borderNone" style="width: 1%;" class="text-right">:</td>
                        <td class="borderNone" style="width: 60%;">{{ $tbp->getPrettyDate() }}</td>
                    </tr>
                    <tr>
                        <td class="borderNone" style="width: 20%;">Rincian SKRD</td>
                        <td class="borderNone" style="width: 1%;" class="text-right">:</td>
                        <td class="borderNone" style="width: 60%;">
                        <table border="1px" style="border-collapse:collapse">
                            <tr>
                                <td>NO SKRD</td>
                                <td>TANGGAL SKRD</td>
                                <td>NOMINAL SKRD</td>
                            </tr>
                        @foreach($tbp->tbpDetail as $td)
                            <tr>
                                <td>{{ $td->skrd->nomor }}</td>
                                <td>{{ date('d/m/Y', strtotime($td->skrd->tanggal)) }}</td>
                                <td>{{ format_idr($td->skrd->nominal) }}</td>
                            </tr>
                        @endforeach
                        </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="clearfix"></div>

        <div class="col-print-12 content" style="font-size: 12px; margin: 0px 10px;">
            <table style="margin: 5px 0px 10px;margin-left:-10px">
                <tbody>
                    <tr>
                        <td width="15%"></td>
                        <td>UPT Penerimaan BPKAD</td>
                        <td></td>
                    </tr>

                    <tr>
                        <td width="15%"></td>
                        <td>Ret Th {{ $tbp->getYear() }}</td>
                        <td class="text-right font-weight-bold" style="padding-right:40px;">{{ format_idr($totalBayar) }}</td>
                    </tr>

                    <tr>
                        <td colspan="2"></td>
                        <td class="text-right" style="padding-right: 10px;">({{ penyebut($totalBayar) }})</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="clearfix"></div><br>
    </div>
</body>
</html>
