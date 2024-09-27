<html>
    <head>
    <style>
    *{font-family:'helvetica'}
    table{
        font-size:12px;
        border-collapse:collapse
    }
    .judul{
        text-align:center;line-height:6px
    }
    </style>
    </head>
    <body>
        <p class="judul">PENDAPATAN LAIN - LAIN PEMERINTAH KOTA AMBON ATAS KERJASAMA</p>
        <p class="judul">ASET MILIK DAERAH</p>
        <p class="judul">TAHUN {{ date('Y',strtotime('now')) }}</p>
        <table width="100%" border="1" cellpadding="3px">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NAMA<br>PENYEWA</th>
                    <th>NO TELP</th>
                    <th>ALAMAT</th>
                    <th>LETAK TANAH</th>
                    <th>LUAS</th>
                    <th>JENIS TANAMAN</th>
                    <th>SEWA<br>HEKTAR</th>
                    <th>NOMOR<br>SERTIFIKAT</th>
                    <th>JUMLAH</th>
                    <th>BUKTI<br>SETORAN</th>
                    <th>JANGKA<br>WAKTU</th>
                    <th>TANGGAL<br>SETORAN</th>
                    <th>TANGGAL<br>BERAKHIR</th>
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
                ///$tot_luas += (int)str_replace('.','', $row->luas);
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
                <td align="center">
                    {{
                        \Carbon\Carbon::parse($row->tanggal_sewa)
                        ->diffInYears(\Carbon\Carbon::parse($row->tgl_selesai))
                    }} TH
                </td>
                <td align="center">{{ date('d/m/Y', strtotime($row->tanggal_bayar)) }}</td>
                <td align="center">{{ date('d/m/Y', strtotime($row->tgl_selesai)) }}</td>
            </tr>
       @endforeach
            <tr>
                <td colspan="5" align="center">JUMLAH</td>
                <td>{{ number_format($tot_luas, 2,'.',',') }}</td>
                <td colspan="3"></td>
                <td>{{ number_format($tot_jml, 0,'.',',') }}</td>
                <td colspan="4"></td>
            </tr>
            <tr>
                <td colspan="9" align="right">Total pembayaran</td>
                <td colspan="5">Rp {{ number_format($tot_lunas, 0,'.',',') }}</td>
            </tr>
            <tr>
                <td colspan="9" align="right">Belum terbayar</td>
                <td colspan="5">Rp {{ number_format($tot_hutang, 0,'.',',') }}</td>
            </tr>
            </tbody>
        </table>
    </body>
<html>
