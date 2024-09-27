@extends('layouts.dashboard')

@section('title', 'SKRD')

@section('content')
<div class="row">
    <div class="col">

        @can('skrd-create')
            <a href="{{ route('skrd.create') }}" class="btn btn-sm btn-neutral mb-3">
                <i class="fa fa-plus"></i> Tambah SKRD
            </a>
        @endcan

        <div class="row">
            <div class="col-md-4">
                <div class="card card-stats">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total SKRD Tahun {{ $yearActive }}</h5>
                                <span class="h2 font-weight-bold mb-0">{{ $totalSkrd }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                    <i class="ni ni-single-copy-04"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-stats">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Pemakai</h5>
                                <span class="h2 font-weight-bold mb-0">{{ $totalPemakai }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                    <i class="ni ni-single-02"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card card-stats">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Nominal Skrd</h5>
                                <span class="h2 font-weight-bold mb-0">{{ format_idr($totalNominal) }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                    <i class="ni ni-money-coins"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($message = session('success'))
            <div class="alert alert-success alert-dismissable fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                {{ $message }}
            </div>
        @endif

        @if ($message = session('error'))
            <div class="alert alert-danger alert-dismissable fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                {{ $message }}
            </div>
        @endif

        <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
                <h3 class="mb-0">Data SKRD</h3>
            </div>

            <div class="container row mb-3">
                <div class="col-sm-7 p-0">
                    <form class="form-inline">
                        <div class="form-group mb-2 ml-1">
                            <select name="year" id="year" class="form-control">
                                @foreach ($tahun as $item)
                                    <option value="{{ $item->tahun }}"
                                    {{ $item->tahun == $yearActive ? "selected=true" : '' }}>
                                        Tahun {{ $item->tahun }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-2 mx-1">
                            <input type="text" class="form-control date" id="keyword" name="keyword" value="{{ request()->query('keyword') }}" placeholder="Nama Pemakai" autocomplete="off">
                        </div>
                        <button type="submit" class="btn btn-outline-primary mb-2"><i class="fa fa-search"></i> Temukan</button>
                        <a href="{{ route('skrd.index') }}" class="btn btn-outline-danger mb-2"><i class="fa fa-reset"></i> Reset</a>
                    </form>
                </div>
                <div class="col-sm-5 p-0">
                    <div class="form-inline">
                        <div class="form-group mb-2">
                            <select class="form-control" id="kecamatan-find" name="kecamatan-find">
                                <option value="."> ---- kecamatan ---- </option>
                                @foreach($kecs as $kec)
                                    <option value="{{ $kec->id }}" {{ $kec->id == request()->query('kec')? 'selected' : '' }}>{{ $kec->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <input size="13" type="text" placeholder="Lokasi" value="{{ request()->query('loc') }}" class="form-control" id="lokasi-find" name="lokasi-find">
                        </div>
                        <button type="button" id="btn-kl-find" class="btn btn-outline-primary mb-2 ml-2">
                            Cari
                        </button>
                    </div>
                </div>
            </div>

            <!-- Light table -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th>No Urut</th>
                            <th>Nomor</th>
                            <th>Pemakai</th>
                            <th>Kecamatan</th>
                            <th>Tanggal</th>
                            <th>Kode akun</th>
                            <th>Nama Opd</th>
                            <th>Nominal</th>
                            <th>Kode objek</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($skrds as $key => $item)
                            <tr>
                                <td>{{ $skrds->firstItem() + $key }}</td>
                                <td>{{ $item->format_nomor }}</td>
                                <td>{{ $item->pemakai->nama }}</td>
                                <td>{{ $item->objectRetribusi->kelurahan->kecamatan->nama }}</td>
                                <td>{{ $item->tanggal }}</td>
                                <td>{{ $akunBendahara->kode }}</td>
                                <td>{{ $akunBendahara->nama }}</td>
                                <td>{{ $item->nominal_idr }}</td>
                                <td>{{ $item->objectRetribusi->kode }}</td>
                                <td>
                                    @can('skrd-update')
                                        <a href="{{ route('skrd.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endcan

                                    @can('skrd-delete')
                                        <a href="javascript:;" class="btn btn-sm btn-danger"
                                            data-toggle="modal" onclick="deleteData({{ $item->id }})"
                                            data-target="#DeleteModal">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    @endcan

                                    <a href="{{ route('skrd.print', $item->id )}}" class="btn btn-sm btn-info" title="Cetak SKRD" target="_blank">
                                        <i class="fa fa-print"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="10">Data tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot class="thead-light">
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th class="text-dark" style="text-align: right;">Total: </th>
                            <th class="text-dark">{{ format_idr($totalNominalByYear, true) }}</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="mt-3 mb-2 mx-2 d-flex justify-content-center">
                {{ $skrds->links('pagination::bootstrap-4') }}
            </div>

            <div class="card-footer py-4">
            </div>
        </div>
    </div>
</div>

@include('shared.delete_confirmation.modal')
@endsection

@section('js')
@include('shared.delete_confirmation.script', ['routeName' => 'skrd.destroy'])
<script>
$('#btn-kl-find').click(function(){
    let th  = $('#year').val();
    let key = $('#keyword').val();
    let kec = $('#kecamatan-find').val();
    let loc = $('#lokasi-find').val();

    window.location = "{{ route('skrd.index') }}/?"+`year=${th}&keyword=${key}&kec=${kec}&loc=${loc}`;
})
</script>
@endsection
