@extends('layouts.dashboard')

@section('title', 'Akun')

@section('content')
<div class="row">
    <div class="col">

        @can ('akun-create')
            <a href="{{ route('akun.create') }}" class="btn btn-sm btn-neutral mb-3">
                <i class="fa fa-plus"></i> Tambah Data
            </a>
        @endcan

        @include('shared.alert')

        <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
                <div class="d-flex flex-row">
                    <h3 class="mb-0 flex-grow-1">Data Akun</h3>
                    <button class="btn btn-info btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample"
                        aria-expanded="false" aria-controls="collapseExample">
                        Pengurutan Data
                    </button>
                </div>
                <div class="collapse mt-3" id="collapseExample">
                    <form action="" method="GET">
                        <div class="form-group">
                            <label for="sort-pejabat">Kode Akun</label>
                            <select class="form-control form-control-sm" name="sort_kode" onchange="this.form.submit()">
                                <option value="">Pengurutan Kode</option>
                                <option value="asc" {{ request()->sort_kode == 'asc' ? 'selected' : '' }}>Ascending </option>
                                <option value="desc" {{ request()->sort_kode == 'desc' ? 'selected' : ''}}>Descending</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sort-pejabat">Nama Akun</label>
                            <select class="form-control form-control-sm" name="sort_nama" onchange="this.form.submit()">
                                <option value="">Pengurutan Kode</option>
                                <option value="asc" {{ request()->sort_nama == 'asc' ? 'selected' : '' }}>Ascending </option>
                                <option value="desc" {{ request()->sort_nama == 'desc' ? 'selected' : ''}}>Descending</option>
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
                            <th>No</th>
                            <th>Kode Akun</th>
                            <th>Nama</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($akun as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->kode }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>
                                    @can('akun-update')
                                        <a href="{{ route('akun.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endcan

                                    @can('akun-delete')
                                        <a href="javascript:;" class="btn btn-sm btn-danger"
                                            data-toggle="modal" onclick="deleteData({{ $item->id }})" 
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
            <div class="card-footer py-4">
            </div>
        </div>
    </div>
</div>

@include('shared.delete_confirmation.modal')
@endsection

@section('js')
@include('shared.delete_confirmation.script', ['routeName' => 'akun.destroy'])
@endsection
