@extends('layouts.dashboard')

@section('title', 'Kelurahan dari kecamatan '.$kecamatan->nama )
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="row">
    <div class="col">
        <a href="{{ route('kecamatan.index') }}" class="btn btn-sm btn-neutral mb-3">
            <i class="fa fa-arrow-left"></i> Kembali ke Kecamatan 
        </a>
        <a href="{{ route('kelurahan.create', $kecamatan->id) }}" class="btn btn-sm btn-neutral mb-3">
            <i class="fa fa-plus"></i> Tambah Kelurahan 
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
                <div class="d-flex flex-row">
                    <h3 class="mb-0 flex-grow-1">Data kelurahan dari kecamatan {{ $kecamatan->nama }}</h3>
                    <button class="btn btn-info btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample"
                        aria-expanded="false" aria-controls="collapseExample">
                        Pengurutan Data
                    </button>
                </div>
                <div class="collapse mt-3" id="collapseExample">
                    <form action="" method="GET">
                        <div class="form-group">
                            <label for="sort-pejabat">Kode Adminstratif</label>
                            <select class="form-control form-control-sm" name="sort_kode" onchange="this.form.submit()">
                                <option value="">Pengurutan Kode</option>
                                <option value="asc" {{ request()->sort_kode == 'asc' ? 'selected' : '' }}>Ascending </option>
                                <option value="desc" {{ request()->sort_kode == 'desc' ? 'selected' : ''}}>Descending</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sort-pejabat">Nama Kelurahan</label>
                            <select class="form-control form-control-sm" name="sort_kelurahan" onchange="this.form.submit()">
                                <option value="">Pengurutan Kelurahan</option>
                                <option value="asc" {{ request()->sort_kelurahan == 'asc' ? 'selected' : '' }}>Ascending </option>
                                <option value="desc" {{ request()->sort_kelurahan == 'desc' ? 'selected' : ''}}>Descending</option>
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
                            <th>Kode administratif</th>
                            <th>Nama kelurahan</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kelurahans as $kelurahan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kelurahan->kode_administratif }}</td>
                                <td>{{ $kelurahan->nama }}</td>
                                <td>
                                    <a href="{{ route('kelurahan.edit', $kelurahan->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="javascript:;" class="btn btn-sm btn-danger"
                                        data-toggle="modal" onclick="deleteData({{ $kelurahan->id }})" 
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
    @include('shared.delete_confirmation.script', ['routeName' => 'kelurahan.destroy'])

    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $('.table').dataTable({
            language: {
                paginate: {
                    next: '<i class="fa fa-arrow-right">',
                    previous: '<i class="fa fa-arrow-left">'  
                }
            }
        });
    </script>
@endsection