<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('dashboard/img/brand/favicon.png') }}" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    </style>
</head>

<body>
    <div>
        <div class="row mb-4">
            <div class="col-md-12">
                <table style="width:100%;font-weight:bold;">
                    <tr>
                        <td style="text-align:center;">KWITANSI PEMBAYARAN PROPERTI PERTANIAN<br>BAPENDA PROVINSI MALUKU
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-md-12">
                <table>
                    <tr>
                        <td><strong>Nama Penyewa</strong></td>
                        <td width="10">:</td><td>{{ $data->nama_penyewa }}</td>
                    </tr>
                    <tr>
                        <td><strong>Jenis Sewa</strong></td>
                        <td width="10">:</td><td> {{ $data->jenis_tanaman_id }}</td>
                    </tr>
                    <tr>
                        <td><strong>Lokasi</strong></td>
                        <td width="10">:</td><td> {{ $data->lokasi }}</td>
                    </tr>
                    <tr>
                        <td><strong>Nomninal Tarif</strong></td>
                        <td width="10">:</td><td> {{ $data->nominal_idr }}</td>
                    </tr>
                    <tr>
                        <td><strong>Nominal Baya</strong></td>
                        <td width="10">:</td><td> {{ number_format($data->nominal_bayar, 2, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal Sewa</strong></td>
                        <td width="10">:</td><td> {{ $data->getPrettyDate() }}</td>
                    </tr>
                    <tr>
                        <td><strong>Status</td>
                        </strong>
                        <td width="10">:</td><td>{{ $data->status }}</td>
                    </tr>
                    <tr>
                        <td><strong>Nama Penyewa</strong></td>
                        <td width="10">:</td><td> {{ $data->keterangan }}</td>
                    </tr>
                </table>
            </div>
        </div>
        @php
            \Carbon\Carbon::setLocale('id');
            $tanggal = \Carbon\Carbon::parse(date('Y-m-d'))->translatedFormat('l, d F Y');
        @endphp
        <div class="row">
            <table style="width:100%;font-weight:bold;">
                <tr>
                    <td width="70%"></td>
                    <td>{{ $tanggal }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Gubernur Maluku</td>
                </tr>
            </table>

        </div>
    </div>
    </div>
    <script src="{{ asset('dashboard/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
</body>
</htnl>