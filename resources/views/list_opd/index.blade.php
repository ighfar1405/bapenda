@extends('layouts.dashboard')

@section('title', 'Data Jasa Umum')

@section('content')
    <div class="row">
        <div class="col">
            <a href="{{ route('list_opd.create') }}" class="btn btn-sm btn-neutral mb-3">
                <i class="fa fa-plus"></i> Tambah Data
            </a>

            @include('shared.alert')

            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0">Data Jasa Umum</h3>
                </div>
                <div class="container mb-3">
                    <form class="form-inline">
                        <div class="form-group mb-2 mx-2">
                            <input type="text" class="form-control" name="keyword"
                                value="{{ request()->query('keyword') }}" placeholder="Cari..." autocomplete="off">
                        </div>
                        <button type="submit" class="btn btn-outline-primary mb-2 mx-2">
                            <i class="fa fa-search"></i> Cari
                        </button>
                        <a href="{{ route('list_opd.index') }}" class="btn btn-outline-danger mb-2">
                            <i class="fa fa-reset"></i> Reset
                        </a>
                    </form>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jenis Retribusi</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($list_opd as $key => $item)
                                <tr>
                                    <td>{{ $list_opd->firstItem() + $key }}</td>
                                    <td>{{ $item->nama_opd }}</td>
                                    <td>{{ $item->link ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('list_opd.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="javascript:;" class="btn btn-sm btn-danger" data-toggle="modal"
                                            onclick="deleteData({{ $item->id }})" data-target="#DeleteModal">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Data tidak ada.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3 mb-2 mx-2 d-flex justify-content-center">
                    {{ $list_opd->links('pagination::bootstrap-4') }}
                </div>
                <div class="card-footer py-4">
                </div>
            </div>
        </div>
    </div>

    @include('shared.delete_confirmation.modal')
@endsection

@section('js')
    @include('shared.delete_confirmation.script', ['routeName' => 'list_opd.destroy'])
@endsection
