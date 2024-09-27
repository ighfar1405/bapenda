@extends('layouts.dashboard')

@section('title', 'Jenis Pembayaran')

@section('content')
<div class="row">
    <div class="col">
        {{-- @can('jenis_pembayaran-create')
            <a href="{{ route('jenispembayaran.create') }}" class="btn btn-sm btn-neutral mb-3">
                <i class="fa fa-plus"></i> Tambah Data
            </a>
        @endcan --}}

        @include('shared.alert')

        <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
                <h3 class="mb-0">Data Jenis Pembayaran</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Kode Jurnal</th>
                            <th>Formulir</th>
                            <th>Keterangan</th>
                            {{-- <th>Opsi</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jenisPembayaran as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->kode_jurnal }}</td>
                                <td>{{ $item->formulir }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                {{-- <td>
                                    @can('jenis_pembayaran-update')
                                        <a href="{{ route('jenispembayaran.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endcan

                                    @can('jenis_pembayaran-delete')
                                        <a href="javascript:;" class="btn btn-sm btn-danger"
                                            data-toggle="modal" onclick="deleteData({{ $item->id }})" 
                                            data-target="#DeleteModal">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    @endcan
                                </td> --}}
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
@include('shared.delete_confirmation.script', ['routeName' => 'jenispembayaran.destroy'])
@endsection
