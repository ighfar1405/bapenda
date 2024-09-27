@extends('layouts.dashboard')

@section('title', 'Objek Retribusi')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="row">
    <div class="col">

        @can('object_retribusi-create')
            <a href="{{ route('objectretribusi.create') }}" class="btn btn-sm btn-neutral mb-3">
                <i class="fa fa-plus"></i> Tambah Objek Retribusi
            </a>
        @endcan

        @if ($message = session('success'))
            <div class="alert alert-success alert-dismissable fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                {{ $message }}
            </div>
        @endif

        <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
                <h3 class="mb-0">Data Objek Retribusi</h3>
            </div>
            <div class="container mb-3">
                <div class="row">
                    <div class="col-md">
                        <form class="form-inline">
                            <div class="form-group mb-2 mx-2">
                                <input type="text" class="form-control date" name="keyword" value="{{ request()->query('keyword') }}" placeholder="Nama Pemakai" autocomplete="off">
                            </div>
                            <div class="form-group mb-2 mx-2">
                                <input type="text" name="lokasi" class="form-control" value="{{ request()->query('lokasi') }}" placeholder="Cari Lokasi">
                            </div>
                            <button type="submit" class="btn btn-outline-primary mb-2 mx-2"><i class="fa fa-search"></i> Temukan</button>
                            <a href="{{ route('objectretribusi.index') }}" class="btn btn-outline-danger mb-2"><i class="fa fa-reset"></i> Reset</a>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th>Kode Objek</th>
                            {{-- <th>ID Salin Objek</th> --}}
                            {{-- <th>Kelurahan</th> --}}
                            <th>SKRD Terpakai</th>
                            <th>Pemakai</th>
                            <th>Kecamatan</th>
                            <th>Lokasi</th>
                            <th>Luas</th>
                            <th>Kode tarif</th>
                            <th>Klasifikasi Penggunaan</th>
                            <th>Tarif / M2</th>
                            <th>Total tarif</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($objectRetribusies as $key => $objectRetribusi)
                            <tr>
                                <td>{{ $objectRetribusies->firstItem() + $key }}</td>
                                {{-- <td>{{ $objectRetribusi->kode }}</td> --}}
                                <td class="text-center">
                                    {!!
                                        empty($objectRetribusi->skrd)?
                                        '' : '<i class="text-success fa fa-check-circle"></i>'
                                    !!}
                                </td>
                                {{-- <td>{{ $objectRetribusi->kelurahan ? $objectRetribusi->kelurahan->nama : '' }}</td> --}}
                                <td>{{ $objectRetribusi->pemakai->nama }}</td>
                                <td>{{ $objectRetribusi->kelurahan ? $objectRetribusi->kelurahan->kecamatan->nama : '' }}</td>
                                <td>{{ $objectRetribusi->lokasi }}</td>
                                <td>{{ $objectRetribusi->luas }}</td>
                                <td>{{ $objectRetribusi->tarifRetribusi->kode_tarif }}</td>
                                <td>{{ $objectRetribusi->tarifRetribusi->klasifikasiPemakaian->jenis_klasifikasi }}</td>
                                <td>{{ $objectRetribusi->tarifRetribusi->tarif_meter }}</td>
                                <td>{{ format_idr($objectRetribusi->luas * $objectRetribusi->tarifRetribusi->tarif_meter_float) }}</td>
                                <td>
                                    @can('object_retribusi-update')
                                        <a href="{{ route('objectretribusi.edit', $objectRetribusi->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endcan

                                    @can('object_retribusi-delete')
                                        <a href="javascript:;" class="btn btn-sm btn-danger"
                                            data-toggle="modal" onclick="deleteData({{ $objectRetribusi->id }})"
                                            data-target="#DeleteModal">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3 mb-2 mx-2 d-flex justify-content-center">
                {!! $objectRetribusies->links() !!}
            </div>

            <div class="card-footer py-4"></div>
        </div>
    </div>
</div>
@include('shared.delete_confirmation.modal')
@endsection
@section('js')
    @include('shared.delete_confirmation.script', ['routeName' => 'objectretribusi.destroy'])
@endsection
