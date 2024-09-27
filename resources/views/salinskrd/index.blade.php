@extends('layouts.dashboard')

@section('title', 'Salin SKRD')

@section('content')
<div class="row">
    <div class="col">
        {{-- <a href="{{ route('skrd.create') }}" class="btn btn-sm btn-neutral mb-3">
            <i class="fa fa-plus"></i> Salin SKRD
        </a> --}}

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
                <div class="row align-items-center">
                  <div class="col">
                    <h3 class="mb-0">Data SKRD</h3>
                  </div>
                  <div class="col text-right">
                    <button data-toggle="modal" data-target="#salinSkrdModal" class="btn btn-success">Salin SKRD</button>
                  </div>
                </div>
              </div>
            <div class="container mb-3">
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

                    <div class="form-group mb-2 mx-2">
                        <input type="text" class="form-control date" name="keyword" value="{{ request()->query('keyword') }}"
                            placeholder="Nama Pemakai" autocomplete="off">
                    </div>
                    <button type="submit" class="btn btn-outline-primary mb-2 mx-2"><i class="fa fa-search"></i> Temukan</button>
                    <a href="{{ route('salinskrd.index') }}" class="btn btn-outline-danger mb-2"><i class="fa fa-reset"></i> Reset</a>
                </form>
            </div>
            <!-- Light table -->
            <form action="{{ route('salinskrd.store') }}" method="POST">
                @csrf
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th></th>
                                <th>Nomor</th>
                                <th>Pemakai</th>
                                <th>Kecamatan</th>
                                <th>Tanggal</th>
                                <th>Kode akun</th>
                                <th>Nama Opd</th>
                                <th>Nominal</th>
                                <th>Kode objek</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($skrds as $item)
                                <tr>
                                    <td><input type='checkbox' name='selected_skrd[]' value='{{ $item->id }}'></td>
                                    <td>{{ $item->format_nomor }}</td>
                                    <td>{{ $item->pemakai->nama }}</td>
                                    <td>{{ $item->objectRetribusi->kelurahan->kecamatan->nama }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>4.1.2.02.01</td>
                                    <td>Badan Keuangan dan Aset Daerah</td>
                                    <td>{{ $item->nominal_idr }}</td>
                                    <td>{{ $item->objectRetribusi->kode }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">Data tahun {{ $yearActive }} tidak ada.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="btn btn-success mt-4 ml-3">Salin SKRD Terpilih</button>
            </form>
            <div class="mt-3 mb-2 mx-2 d-flex justify-content-center">
                {{ $skrds->links('pagination::bootstrap-4') }}
            </div>
            <div class="card-footer py-4">
            </div>
        </div>
    </div>
</div>
@include('salinskrd.modal.salin')
@endsection
