@extends('layouts.dashboard')

@section('title', 'Pemakai')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="row">
    <div class="col">
        @can('pemakai-create')
            <a href="{{ route('pemakai.create') }}" class="btn btn-sm btn-neutral mb-3">
                <i class="fa fa-plus"></i> Tambah Pemakai WR
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
                <h3 class="mb-0">Data Pemakai WR</h3>
            </div>
            <div class="container mb-3">
                <form class="form-inline">
                    <div class="form-group mb-2 mx-2">
                        <input type="text" class="form-control date" name="keyword" value="{{ request()->query('keyword') }}" placeholder="Nama Pemakai" autocomplete="off">
                    </div>
                    <button type="submit" class="btn btn-outline-primary mb-2 mx-2"><i class="fa fa-search"></i> Temukan</button>
                    <a href="{{ route('pemakai.index') }}" class="btn btn-outline-danger mb-2"><i class="fa fa-reset"></i> Reset</a>
                </form>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th>No. Urut</th>
                            <th>Nama</th>
                            <th>Kecamatan</th>
                            <th>No SK</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>Kode Arsip</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pemakai as $item)
                            <tr>
                                <td>{{ $item->no_urut }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->kelurahan->kecamatan->nama }}</td>
                                <td>{{ $item->nik }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>{{ $item->no_telp }}</td>
                                <td>{{ $item->kode_arsip }}</td>
                                <td>
                                    @can('pemakai-update')
                                        <a href="{{ route('pemakai.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endcan

                                    @can('pemakai-delete')
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

            <div class="mt-3 mb-2 mx-2 d-flex justify-content-center">
                {!! $pemakai->links() !!}
            </div>

            <div class="card-footer py-4">
            </div>
        </div>
    </div>
</div>

@include('shared.delete_confirmation.modal')
@endsection

@section('js')
@include('shared.delete_confirmation.script', ['routeName' => 'pemakai.destroy'])
{{-- <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script>
    
    $('.table').dataTable({
        language: {
            paginate: {
                next: '<i class="fa fa-arrow-right">',
                previous: '<i class="fa fa-arrow-left">'  
            }
        },
        processing: true,
        serverSide: true,
        ajax: "{{ route('ajax.pemakai.data') }}",
        columns: [
            { data: 'no_urut', name: 'no_urut' },
            { data: 'kelurahan', name: 'kelurahan' },
            { data: 'nama', name: 'nama' },
            { data: 'nik', name: 'nik' },
            { data: 'alamat', name: 'alamat' },
            { data: 'no_telp', name: 'no_telp' },
            { data: 'action', name: 'action' }
        ]
    });
</script> --}}
@endsection

