<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Out TBP - {{ $tbp->nomor }}</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-size: 0.85rem;
        }

        .text-sm {
            font-size: 0.85rem;
        }

        .text-md {
            font-size: 1.25rem;
        }

        .bold {
            font-weight: bold;
        }

        @media print {
            body {
                transform: scale(0.9);
            }
        }

        main {
            margin-right: auto;
            margin-left: auto;
            border: 1px solid #000;
        }

        header {
            display: flex;
            flex-direction: row;
        }

        table {
            border: 1px solid #000;
            width: 100%;
        }

        th, td {
            border: 1px solid #000;
            padding: 5px;
        }

        table, th, td {
            border-collapse: collapse;
        }

        .header__report {
            padding: 10px 15px;
            /* border: 1px solid #000; */
            border-bottom: 1px solid #000;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .header__report:nth-child(2) {
            border-right: 0.5px solid #000;
            border-left: 0.5px solid #000;
        }

        .header__report:first-child {
            flex: 1.3;
        }

        .header__report:nth-child(2) {
            flex: 2
        }

        .header__report:last-child {
            flex: 1;
        }

        .header__detail {
            display: flex;
            flex-direction: column;
            gap: 5px;
            text-align: left;
            margin-top: 8px;
        }

        .header__detail > div {
            display: flex;
            flex-direction: row;
        }

        .header__detail > div > p:nth-child(n) {
            flex: 0.5;
        }

        .header__detail > div > p:nth-child(2n) {
            flex: 1;
        }

        .identity {
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 8px;
            margin: 0 auto;
            padding: 10px 20px;
        }

        .identity__container {
            display: flex;
            flex-direction: row;
        }

        .identity__container > p:nth-child(n) {
            flex: 0.5;
        }

        .identity__container > p:nth-child(2n) {
            flex: 2;
        }

        .detail {
            padding: 10px 15px;
        }

        .detail__nominal {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .detail__nominal > div {
            display: flex;
            flex-direction: row;
            gap: 5px;
        }

        .detail__table {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-top: 10px;
        }

        .assignment {
            display: flex;
            flex-direction: row-reverse;
            padding: 10px 15px;
        }

        .assignment > div {
            text-align: center;
        }

        .nip {
            padding-top: 8px;
            border-top: 1px solid #000;
        }

        .footer {
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            border-top: 1px solid #000;
        }

        .footer > div {
            padding: 10px;
            flex: 1;
            text-align: center;
        }

        .footer > div:nth-child(2) {
            flex: 2;
            border-right: 1px solid #000;
            border-left: 1px solid #000;
        }

        .footer__detail {
            display: flex;
            flex-direction: column;
            gap: 8px;
            text-align: left;
        }

        .footer__detail > div {
            display: flex;
            flex-direction: row;
            gap: 5px;
        }

        .footer__detail > div > p {
            /* flex: 0.5; */
        }

        .detail__field {
            flex: 0.35;
        }
    </style>
</head>
<body>
    <main>
        <header>
            <div class="header__report">
                <h5>
                    PEMERINTAHAN KOTA AMBON 
                    <br><br>
                    BADAN KEUANGAN ASET AMBON
                </h5>
            </div>
            <div class="header__report">
                <h5>
                    SKRD 
                    <br>
                    (SURAT SETORAN RETRIBUSI DAERAH)
                </h5>
                <div class="header__detail text-sm">
                    <div>
                        <p>Masa Retribusi</p>
                        <p>: </p>
                    </div>
                    <div>
                        <p>Tahun</p>
                        <p>: {{ $tbp->getYear() }}</p>
                    </div>
                </div>
            </div>
            <div class="header__report">
                <h5>
                    NO. URUT
                </h5>
                <br>
                <h3 class="text-md">{{ $tbp->nomor }}</h3>
            </div>
        </header>
        <div class="identity">
            <div class="identity__container text-sm">
                <p>Nama</p>
                <p>: {{ $tbp->pemakai->nama }}</p>
            </div>
            <div class="identity__container text-sm">
                <p>Alamat</p>
                <p>: {{ $tbp->pemakai->alamat }}</p>
            </div>
            <div class="identity__container text-sm">
                <p>NPWRD</p>
                <p>: - </p>
            </div>
        </div>
        <div class="detail">
            <div class="detail__nominal">
                <div>
                    <p>Harap diterima uang sebesar</p>
                    <p class="bold">: Rp {{ format_idr($totalBayar) }}</p>
                </div>
                <div>
                    <p>(dengan huruf)</p>
                    <p>: {{ penyebut($totalBayar) }}</p>
                </div>
            </div>
            <div class="detail__table">
                <p>Dengan rincian penerimaan sebagai berikut:</p>
                <table>
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Kode Rekening</th>
                            <th>Jenis Retribusi Daerah</th>
                            <th>Jumlah (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tbp->tbpDetail as $item)
                            <tr>
                                <td>{{ $item->skrd->nomor }} </td>
                                <td>4.1.2.02.01</td>
                                <td>Retribusi Pemanfaatan Kekayaan Daerah</td>
                                <td>Rp {{ format_idr($item->skrd->nominal) }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3">Jumlah</th>
                            <td>Rp {{ format_idr($totalBayar) }}</td>
                        </tr>
                    </tfoot>
                </table>
                <p>Uang tersebut diterima pada tanggal </p>
            </div>
        </div>
        <div class="assignment">
            <div>
                <p>Ambon, {{ date('d/M/Y', strtotime($tbp->tanggal)) }}</p>
                <p>Kepala Dinas/Kantor UPTD</p>
                <p>...</p>
                <br>
                <br>
                <br>
                <p class="nip">NIP. </p>
            </div>
        </div>
        <div class="footer">
            <div>
                <p>Ruang untuk teraan kas Register/tanda tangan</p>
                <br>
                <br>
                <br>
                <br>
                <br>
            </div>
            <div>
                <p>Diterima Oleh</p>
                <br>
                <div class="footer__detail">
                    <div>
                        <p>Petugas Tempat Pembayaran</p>
                    </div>
                    <div>
                        <p class="detail__field">Tanggal</p>
                        <p>: {{ date('d/M/Y', strtotime($tbp->tanggal)) }}</p>
                    </div>
                    <br>
                    <div>
                        <p class="detail__field">Tanda Tangan</p>
                        <p>: ______________</p>
                    </div>
                    <div>
                        <p class="detail__field">Nama Terang</p>
                        <p>: Fety Maisaroh</p>
                    </div>
                </div>
            </div>
            <div>
                <p>Penyetor</p>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <p>{{ $tbp->pemakai->nama }}</p>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            window.print();
        });
    </script>
</body>
</html>