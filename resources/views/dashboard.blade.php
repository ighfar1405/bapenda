
@extends('layouts.dashboard')

@section('title', 'Sistem Retribusi Badan Pendapatan Daerah Provinsi Maluku')

@section('content')
<div class="alert alert-primary" role="alert">
    <strong class="display-4">E-RTB, {{ config('app.name') }}.</strong><br/>
    <p class="display-5">Aplikasi dapat diakses melalui PC(Personal Computer), Laptop, Tablet, HP/Smartphone.</p>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form class="form-inline">
                    <div class="form-group mb-2 mx-2">
                        <select name="year" class="form-control">
                            @foreach ($tahun as $item)
                                <option value="{{ $item->tahun }}"
                                {{ $item->tahun == $yearActive ? "selected=true" : '' }}>
                                    Tahun {{ $item->tahun }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-outline-primary mb-2 mx-2"><i class="fa fa-search"></i> Temukan</button>
                    <a href="{{ route('admin.dashboard.index') }}" class="btn btn-outline-danger mb-2"><i class="fa fa-reset"></i> Reset</a>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Total piutang</h5>
                        <span class="h2 font-weight-bold mb-0">{{ format_idr($nominalPiutang, true) }}</span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                            <i class="ni ni-money-coins"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Total penerimaan (hari ini)</h5>
                        <span class="h2 font-weight-bold mb-0">{{ format_idr($totalNominalTbp, true) }}</span>
                    </div>
                <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                        <i class="ni ni-money-coins"></i>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@php
    // echo $data2;
@endphp
<div class="row">
    @foreach ($totalKlasifikasi as $item)
    <div class="col-md-4">
        <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ $item->jenis_klasifikasi }}</h5>
                        <span class="h2 font-weight-bold mb-0">
                        @if(strtoupper($item->jenis_klasifikasi) == 'TEMPAT TINGGAL')
                            0
                        @else
                            {{ $item->total_klasifikasi_count }}
                        @endif
                        </span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                            <i class="ni ni-chart-bar-32"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4>Grafik Total Penerimaan</h4>

            </div>
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div id="grafik_penerimaan" style="height: 230px;"></div>
                    </div>
                {{-- <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                        <i class="ni ni-money-coins"></i>
                    </div>
                </div> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4>Grafik Total Piutang Retribusi</h4>

            </div>
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div id="grafik_piutang" style="height: 230px;"></div>
                    </div>
                {{-- <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                        <i class="ni ni-money-coins"></i>
                    </div>
                </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Grafik Total Penerimaan Per Kecamatan</h4>

            </div>
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div id="grafik_penerimaan_perkecamatan" style="height: 200px;"></div>
                    </div>
                {{-- <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                        <i class="ni ni-money-coins"></i>
                    </div>
                </div> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Grafik Total Piutang Per Kecamatan</h4>

            </div>
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div id="grafik_piutang_perkecamatan" style="height: 200px;"></div>
                    </div>
                {{-- <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                        <i class="ni ni-money-coins"></i>
                    </div>
                </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>

            Morris.Bar({
                element: 'grafik_penerimaan_perkecamatan',
                data: [

                    <?=$penerimaanPerKecamatan?>
                ], //supply the response data (which is now a JS variable) directly, no extra brackets
                xkey: 'year',
                ykeys: ['Nusaniwe','Sirimau','Baguala','Teluk_Ambon','Leitimur'],
                //   ymax: 'auto[30]',
                //   ymin: 'auto',
                //   xLabels: 'year',
                labels: ['Nusaniwe','Sirimau','Baguala','Teluk_Ambon','Leitimur'],
                hideHover: 'auto',
                // axes: true;
                //   grid :  false,
                redraw: true,
                resize: true,
                pointStrokeColors: ['black'],
                pointFillColors:['#ffffff'],
                fillOpacity: 0.6,
                barWidth: '10px',
                // stacked:true,
                parseTime: true,
                behaveLikeLine : true,
                //   fillOpacity : '0.5',
                lineColors: ['Blue', 'Red', 'Gray'],
            });
            Morris.Line({
                element: 'grafik_piutang_perkecamatan',
                data: [
                    <?=$piutangPerKecamatan?>
                ], //supply the response data (which is now a JS variable) directly, no extra brackets
                xkey: 'year',
                ykeys: ['Nusaniwe','Sirimau','Baguala','Teluk_Ambon','Leitimur'],
                //   ymax: 'auto[30]',
                //   ymin: 'auto',
                //   xLabels: 'year',
                labels: ['Nusaniwe','Sirimau','Baguala','Teluk_Ambon','Leitimur'],
                hideHover: 'auto',
                // axes: true;
                //   grid :  false,
                redraw: true,
                resize: true,
                pointStrokeColors: ['black'],
                pointFillColors:['#ffffff'],
                // fillOpacity: 0.6,
                // barWidth: '10px',
                // stacked:true,
                parseTime: true,
                behaveLikeLine : true,
                //   fillOpacity : '0.5',
                lineColors: ['Blue', 'Red', 'Gray'],
            });
            Morris.Area({
                    element: 'grafik_piutang',
                    data: [
                        <?=$data2;?>
                    ], //supply the response data (which is now a JS variable) directly, no extra brackets
                    xkey: 'year',
                    ykeys: ['value'],
                    labels: ['Nominal Piutang'],
                    hideHover: 'auto',
                // axes: true;
                //   grid :  false,
                    resize: true,
                    pointStrokeColors: ['black'],
                    pointFillColors:['#ffffff'],
                    fillOpacity: 0.6,
                    lineWidth: '6px',
                    stacked:true,
                    parseTime: true,
                    behaveLikeLine : true,
                    lineColors: ['Blue', 'Pink'],
                });
            Morris.Area({
                element: 'grafik_penerimaan',
                data: [
                    <?= $data1;?>
                ], //supply the response data (which is now a JS variable) directly, no extra brackets
                xkey: 'year',
                ykeys: ['value'],
                //   ymax: 'auto[30]',
                //   ymin: 'auto',
                //   xLabels: 'year',
                labels: ['Nominal penjualan'],

                hideHover: 'auto',
                // axes: true;
                //   grid :  false,
                resize: true,
                pointStrokeColors: ['black'],
                pointFillColors:['#ffffff'],
                fillOpacity: 0.6,
                lineWidth: '6px',
                stacked:true,
                parseTime: true,
                behaveLikeLine : true,

                //   fillOpacity : '0.5',
                lineColors: ['Red', 'Pink'],
            });

            //

</script>
@endsection