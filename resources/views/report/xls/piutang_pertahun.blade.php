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
		.borderBottom { border-bottom: 1px solid #000; }
		.borderNone { border: 0; }
        .header { border-bottom: 1px solid #000; }
    </style>
</head>
<body>
    <table>
        <tr>
            <th colspan="9" style="text-align:center;font-size:18px">
                    UPDATE PIUTANG RETRIBUSI SEWA TANAH PEMAKAIAN KEKAYAAN DAERAH<br>
                    PER 31 DESEMBER {{ request()->query('tahun') }}
            </th>
        </tr>
        <tbody>
            <tr>
                <th style="text-align:center">NO.</th>
                <th style="text-align:center">Uraian</th>
                <th style="text-align:center">Nominal</th>
                <th style="text-align:center">Jumlah Bayar</th>
                <th style="text-align:center">Piutang<br/> sesudah koreksi</th>
                <th style="text-align:center">Pelunasan atas saldo <br/> Piutang</th>
                <th style="text-align:center">Sisa Piutang <br/> Tahun</th>
                <th style="text-align:center">Penambahan Piutang <br/> Tahun</th>
                <th style="text-align:center">Saldo Piutang</th>
            </tr>

            <tr>
                <th style="text-align:center">1</th>
                <th style="text-align:center">2</th>
                <th style="text-align:center">3</th>
                <th style="text-align:center">4</th>
                <th style="text-align:center">5=3+4</th>
                <th style="text-align:center">6</th>
                <th style="text-align:center">
                    {{-- 7=5-6 --}}
                    7=year(9)-1
                </th>
                <th style="text-align:center">8=3-4</th>
                <th style="text-align:center">
                    {{-- 9=7+8 --}}
                    9=8 + 7
                </th>
            </tr>
        <?php
        $tot_1  = 0;
        $tot_2  = 0;
        $tot_3  = 0;
        $colum3 = 0;
        $colum4 = 0;
        $colum7 = [];
        $colum8 = 0;
        $colum9 = [];
        $tmpSKRD = [];

            /*for($i = 2024; $i <= request()->query('tahun'); $i++)*/
            /*foreach(range$skrdTahun as $no=>$st)*/
        ?>

    @foreach($skrdTahun as $st)

        <?php
        $tmpSKRD[$st->tahun] = $st->nominal;
        $colum3 = $st->nominal;
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

        @if($st->tahun >= 2024)
            <tr>
                <td></td>
                <td style="text-align:center">
                    {{ $st->tahun }}
                    {{-- ambil dari master tahun --}}
                </td>
                <td class="borderLeft text-right">
                    {{ format_idr($colum3) }}
                    {{--3 angka total SKRD per Tahun Tsb--}}
                    <?php $tot_1 += $colum3; ?>
                </td>
                <td class="borderLeft text-right">
                    {{ format_idr($colum4) }}
                    {{--4 angka total TBP per Tahun Tsb --}}
                    <?php $tot_2 += $colum4; ?>
                </td>
                <td class="borderLeft text-right">
                    {{--5 --}}
                </td>
                <td class="borderLeft text-right">
                    {{--6 --}}
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

                    {{ format_idr($colum9[$st->tahun]) }}
                    {{--9. col8 + col7 --}}
                    <?php $tot_3 += $colum9[$st->tahun]; ?>
                </td>
            </tr>
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
</body>
</html>
