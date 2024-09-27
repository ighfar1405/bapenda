
<table width="100%" border="1" cellpadding="3px">
    <thead>
        <tr>
            <th style="font-size:14px;text-align:center" colspan="13">PENDAPATAN LAIN - LAIN PEMERINTAH KOTA AMBON ATAS KERJASAMA</th>
        </tr>
        <tr>
            <th style="font-size:14px;text-align:center" colspan="13">ASET MILIK DAERAH</th>
        </tr>
        <tr>
            <th style="font-size:14px;text-align:center" colspan="13">TAHUN {{ date('Y',strtotime('now')) }}</th>
        </tr>
        <tr>
            <th align="center" style="font-size:12px">NO</th>
            <th align="center" style="font-size:12px">NAMA PENYEWA</th>
            <th align="center" style="font-size:12px">NO TELP</th>
            <th align="center" style="font-size:12px">ALAMAT</th>
            <th align="center" style="font-size:12px">LETAK TANAH</th>
            <th align="center" style="font-size:12px">LUAS</th>
            <th align="center" style="font-size:12px">JENIS TANAMAN</th>
            <th align="center" style="font-size:12px">SEWA HEKTAR</th>
            <th align="center" style="font-size:12px">NOMOR SERTIFIKAT</th>
            <th align="center" style="font-size:12px">JUMLAH</th>
            <th align="center" style="font-size:12px">BUKTI SETORAN</th>
            <th align="center" style="font-size:12px">JANGKA<br>WAKTU</th>
            <th align="center" style="font-size:12px">TANGGAL<br>SETORAN</th>
            <th align="center" style="font-size:12px">TANGGAL<br>BERAKHIR</th>
        </tr>
    </thead>
    <tbody>
<?php
$no = 0;
$tot_luas = 0;
$tot_jml  = 0;
$tot_lunas= 0;
$tot_hutang= 0;
?>
@foreach($dt as $row)
     <?php
        $_jml = ($row->luas * $row->nominal) / 10000;
        $tot_luas += $row->luas;
        $tot_jml  += $_jml;
        $tot_lunas  += $row->nominal_bayar;
        $tot_hutang += $row->sisa_bayar;
        ++$no;
    ?>
    <tr>
        <td align="center">{{ $no }}</td>
        <td>{{ $row->nama_penyewa }}</td>
        <td>{{ $row->no_telp }}</td>
        <td>{{ $row->alamat_penyewa }}</td>
        <td>{{ $row->lokasi }}</td>
        <td>{{ $row->luas }}</td>
        <td>{{ $row->getTanaman->nama }}</td>
        <td>Rp {{ number_format($row->nominal,0, '.', ',') }}</td>
        <td>{{ $row->nomor_sertifikat }}</td>
        <td>Rp {{ number_format($_jml, 0,'.',',') }}</td>
        <td>{{ $row->no_bukti_bayar }}</td>
        <td style="text-align:center">{{
                \Carbon\Carbon::parse($row->tanggal_sewa)
                ->diffInYears(\Carbon\Carbon::parse($row->tgl_selesai))
            }} TH
        </td>
        <td style="text-align:center">{{ date('d/m/Y', strtotime($row->tanggal_bayar)) }}</td>
        <td style="text-align:center">{{ date('d/m/Y', strtotime($row->tgl_selesai)) }}</td>
    </tr>
@endforeach
    <tr>
        <td colspan="5" style="text-align:center">JUMLAH</td>
        <td>{{ number_format($tot_luas, 2,'.',',') }}</td>
        <td colspan="3"></td>
        <td>{{ number_format($tot_jml, 0,'.',',') }}</td>
        <td colspan="4"></td>
    </tr>
    <tr>
        <td colspan="9" style="text-align:right">Total pembayaran</td>
        <td colspan="5">Rp {{ number_format($tot_lunas, 0,'.',',') }}</td>
    </tr>
    <tr>
        <td colspan="9" style="text-align:right">Belum terbayar</td>
        <td colspan="5">Rp {{ number_format($tot_hutang, 0,'.',',') }}</td>
    </tr>
    </tbody>
</table>
