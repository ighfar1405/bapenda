@extends('layouts.dashboard')

@section('title', 'Petugas')

@section('content')
<div class="row">
    <div class="col">
        <a href="{{ route('opd.index') }}" class="btn btn-sm btn-neutral mb-3">
            <i class="fa fa-arrow-left"></i> Daftar OPD 
        </a>
        <a href="{{ route('petugas.create') }}" class="btn btn-sm btn-neutral mb-3">
            <i class="fa fa-plus"></i> Tambah Petugas
        </a>

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
                <h3 class="mb-0">Data Petugas</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th>Kode OPD</th>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Jabatan</th>
                            <th>Pangkat</th>
                            <th>Aktif</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($petugas as $item)
                            <tr>
                                <td>{{ $item->opd->kode }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->nip }}</td>
                                <td>{{ $item->jabatan }}</td>
                                <td>{{ $item->pangkat }}</td>
                                <td>
                                    <input type="checkbox" disabled
                                        {{ $item->is_active ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <a href="{{ route('petugas.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="javascript:;" class="btn btn-sm btn-danger"
                                        data-toggle="modal" onclick="deleteData({{ $item->id }})" 
                                        data-target="#DeleteModal">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer py-4">
            </div>
        </div>
    </div>
</div>

@include('shared.delete_confirmation.modal')
@endsection

@section('js')
@include('shared.delete_confirmation.script', ['routeName' => 'petugas.destroy'])
@endsection
