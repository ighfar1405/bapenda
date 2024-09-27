<html>

<head>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
        }

        .col-print-1 {
            width: 8%;
            float: left;
        }

        .col-print-2 {
            width: 16%;
            float: left;
        }

        .col-print-3 {
            width: 25%;
            float: left;
        }

        .col-print-4 {
            width: 33%;
            float: left;
        }

        .col-print-5 {
            width: 42%;
            float: left;
        }

        .col-print-6 {
            width: 50%;
            float: left;
        }

        .col-print-7 {
            width: 58%;
            float: left;
        }

        .col-print-8 {
            width: 66%;
            float: left;
        }

        .col-print-9 {
            width: 75%;
            float: left;
        }

        .col-print-10 {
            width: 83%;
            float: left;
        }

        .col-print-11 {
            width: 92%;
            float: left;
        }

        .col-print-12 {
            width: 100%;
            float: left;
        }

        .clearfix {
            clear: both
        }

        table {
            width: 100%;
        }

        .content table,
        td,
        th {
            border: 1px solid black;
        }

        /* .content th { background: grey; } */
        .content table {
            border-collapse: collapse;
            width: 100%;
        }

        th {
            padding: 8px;
            font-size: 11px;
        }

        td {
            padding: 5px;
            margin-left: 7px;
            font-size: 12px;
            vertical-align: top;
        }

        .text-left {
            text-align: left !important;
        }

        .text-center {
            text-align: center !important;
        }

        .text-right {
            text-align: right !important;
        }

        .font-weight-bold {
            font-weight: 700 !important;
        }

        .page-break {
            page-break-before: always;
        }

        .borderLeft {
            border: 0;
            border-left: 1px solid #000;
        }

        .borderRight {
            border: 0;
            border-right: 1px solid #000;
        }

        .borderBottom {
            border-bottom: 1px solid #000;
        }

        .borderNone {
            border: 0;
        }

        .header {
            border-bottom: 1px solid #000;
        }
    </style>
</head>

<body>
    <div class="container">
        <p class="text-center font-weight-bold" style="font-size: 16px;">
            UPDATE PIUTANG RETRIBUSI SEWA TANAH PEMAKAIAN KEKAYAAN DAERAH<br />
            PER 31 DESEMBER {{ request()->query('tahun') }}
        </p>
        <div class="clearfix"></div>

        <div class="col-print-12 content" style="font-size: 12px; margin: 0px 10px;">
            <table style="margin: 5px 0px 10px;">
                <tbody>
                    <tr>
                        <th class="text-center" style="width: 1%">NO.</th>
                        <th class="text-center">Uraian</th>
                        <th class="text-center">Nominal</th>
                        <th class="text-center">Jumlah Bayar</th>
                        <th class="text-center">Pelunasan Tahun Ini</th>
                        <th class="text-center">Pelunasan atas saldo <br /> Piutang</th>
                        <th class="text-center">Sisa Piutang <br /> Tahun</th>
                        <th class="text-center">Penambahan Piutang <br /> Tahun</th>
                        <th class="text-center">Saldo Piutang</th>
                    </tr>

                    <tr>
                        <td class="borderLeft borderBottom text-center">1</td>
                        <td class="borderLeft borderBottom text-center">2</td>
                        <td class="borderLeft borderBottom text-center">3</td>
                        <td class="borderLeft borderBottom text-center">4=5+6</td>
                        <td class="borderLeft borderBottom text-center">5</td>
                        <td class="borderLeft borderBottom text-center">6</td>
                        <td class="borderLeft borderBottom text-center">
                            {{-- 7=5-6 --}}
                            7=year(9)-1
                        </td>
                        <td class="borderLeft borderBottom text-center">8=3-4</td>
                        <td class="borderLeft borderBottom text-center">
                            {{-- 9=7+8 --}}
                            9=8 + 7
                        </td>
                    </tr>
                    <?php
                        $tot_1  = 0;
                        $tot_2  = 0;
                        $tot_3  = 0;
                        $colum3 = 0;
                        $colum4 = 0;
                        $colum5 = 0;
                        $colum6 = 0;
                        $colum7 = [];
                        $colum8 = 0;
                        $colum9 = [];
                        $tmpSKRD = [];
                            /*for($i = 2013; $i <= request()->query('tahun'); $i++)*/
                            /*foreach(range$skrdTahun as $no=>$st)*/
                        ?>

                    @foreach($skrdTahun as $st)

                    <?php
                        $tmpSKRD[$st->tahun] = $st->nominal;
                        $currentRincian = $rincianTbp->where('tahun_tbp', $st->tahun);

                        $colum3 = $st->nominal;
                        $colum5 = $currentRincian->where('tahun_skrd', $st->tahun)->sum('total_tbp');
                        $colum6 = $currentRincian->where('tahun_skrd', '!=', $st->tahun)->sum('total_tbp');
                        $colum4 = $tbpTahun[$st->tahun];
                        $colum8 = ($colum3 - $colum4);

                        $colum7[$st->tahun][1] = $st->nominal - $tbpTahun[$st->tahun];

                        if (isset($tbpTahun[$st->tahun - 1])) {
                            $colum9[$st->tahun] = $colum8 + $colum7[$st->tahun][1];
                        } else {
                            $colum9[$st->tahun] = $colum8;
                        }
                        
                        if (isset($tbpTahun[$st->tahun - 1])) {
                            //colum7[$st->tahun][0] = $st->nominal - $tbpTahun[$st->tahun - 1];
                            $colum7[$st->tahun][0] = $colum9[$st->tahun - 1];
                        }
                    ?>

                    @if($st->tahun >= 2013)
                        <tr>
                            <td class="borderLeft text-center"></td>
                            <td class="borderLeft">
                                {{ $st->tahun }}
                                {{-- ambil dari master tahun --}}
                            </td>
                            <td class="borderLeft text-right">
                                {{ format_idr($colum3) }}
                                {{--3 angka total SKRD per Tahun Tsb--}}
                                <?php $tot_1 += $colum3; ?>
                            </td>
                            <td class="borderLeft text-right font-weight-bold">
                                {{ format_idr($colum4) }}
                                {{--4 angka total TBP per Tahun Tsb --}}
                                <?php $tot_2 += $colum4; ?>
                            </td>
                            <td class="borderLeft text-right font-weight-bold">
                                {{--5 --}}
                                {{ format_idr($colum5) }}
                            </td>
                            <td class="borderLeft text-right">
                                {{--6 --}}
                                {{ format_idr($colum6) }}
                            </td>
                            <td class="borderLeft text-right">
                                @if($st->tahun == 2013)
                                {{ format_idr(0) }}
                                @else
                                @if(isset($tbpTahun[$st->tahun - 1]))
                                {{ format_idr($colum7[$st->tahun][0]) }}
                                @else
                                {{ format_idr($colum7[$st->tahun][1]) }}
                                @endif
                                @endif
                                {{--7. col9 pada tahun-1 --}}
                            </td>
                            <td class="borderLeft text-right">
                                {{ format_idr($colum8) }}
                                {{--8. col3 - col4 --}}
                            </td>
                            <td class="borderLeft text-right">
                                {{-- st->tahun != 2013? format_idr($colum9[$st->tahun]) : format_idr(0) --}}
                                {{ format_idr($colum9[$st->tahun])}}
                                {{--9. col8 + col7 --}}
                                {{-- <?php $tot_3 += $colum9[$st->tahun]; ?> --}}
                                @php
                                    $tot_3 = end($colum9)
                                @endphp
                            </td>
                        </tr>
                        @foreach ($rincianTbp as $rincian)
                            @if ($rincian->tahun_tbp == $st->tahun)
                                <tr>
                                    <td colspan="3"></td>
                                    <td class="text-right">Tahun {{ $rincian->tahun_skrd }}</td>
                                    <td class="text-right">{{ format_idr($rincian->total_tbp) }}</td>
                                    <td colspan="4"></td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                    @endforeach

                    <!-- Blank Row -->
                    <tr>
                        @for ($i = 0; $i < 9; $i++) 
                        <td class="borderLeft borderBottom"></td>
                        @endfor
                    </tr>

                    <tr>
                        <td class="borderLeft text-center"></td>
                        <td class="borderLeft">Jumlah</td>
                        <td class="borderLeft font-weight-bold text-right">{{ format_idr($tot_1) }}</td>
                        <td class="borderLeft font-weight-bold text-right">{{ format_idr($tot_2) }}</td>
                        <td class="borderLeft font-weight-bold text-right"></td>
                        <td class="borderLeft font-weight-bold text-right"></td>
                        <td class="borderLeft font-weight-bold text-right"></td>
                        <td class="borderLeft font-weight-bold text-right"></td>
                        <td class="borderLeft font-weight-bold text-right">{{ format_idr($tot_3) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="clearfix"></div><br>
    </div>
</body>

</html>