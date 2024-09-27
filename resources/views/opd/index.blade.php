@extends('layouts.dashboard')

@section('title', 'OPD / SKPD')

@section('content')
<div class="row">
    <div class="col">
        @can('opd-create')
        <a href="{{ route('opd.create') }}" class="btn btn-sm btn-neutral mb-3">
            <i class="fa fa-plus"></i> Tambah OPD / SKPD
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
                <div class="d-flex flex-row">
                    <h3 class="mb-0 flex-grow-1">Data OPD / SKPD</h3>
                    <button class="btn btn-info btn-sm" type="button" data-toggle="collapse"
                        data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Pengurutan Data
                    </button>
                </div>
                <div class="collapse mt-3" id="collapseExample">
                    <form action="" method="GET">
                        <div class="form-group">
                            <label for="sort-pejabat">Pejabat</label>
                            <select class="form-control form-control-sm" name="sort_pejabat" id="sort_pejabat"
                                onchange="this.form.submit()">
                                <option value="">Pengurutan Pejabat</option>
                                <option value="asc" {{ request()->sort_pejabat == 'asc' ? 'selected' : '' }}>Ascending
                                </option>
                                <option value="desc" {{ request()->sort_pejabat == 'desc' ? 'selected' : ''
                                    }}>Descending</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sort-kode">Kode OPD / SKPD</label>
                            <select class="form-control form-control-sm" name="sort_kode" id="sort_kode"
                                onchange="this.form.submit()">
                                <option value="">Pengurutan Kode OPD / SKPD</option>
                                <option value="asc" {{ request()->sort_kode ? 'selected' : '' }}>Ascending</option>
                                <option value="desc" {{ request()->sort_kode ? 'selected' : '' }}>Descending</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th>Kode OPD / SKPD</th>
                            <th>Nama Pejabat</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($opds as $opd)
                        <tr>
                            <td>{{ $opd->kode }}</td>
                            <td>{{ $opd->nama }}</td>
                            <td>
                                @can('opd-update')
                                <a href="{{ route('opd.edit', $opd->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fa fa-edit"></i>
                                </a>
                                @endcan

                                @can('opd-delete')
                                <a href="javascript:;" class="btn btn-sm btn-danger" data-toggle="modal"
                                    onclick="deleteData({{ $opd->id }})" data-target="#DeleteModal">
                                    <i class="fa fa-trash"></i>
                                </a>
                                @endcan

                                <a href="{{ route('petugas.index') }}" title="Data Petugas OPD"
                                    class="btn btn-sm btn-info">
                                    <i class="fa fa-users"></i>
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
@include('shared.delete_confirmation.script', ['routeName' => 'opd.destroy'])
@endsection