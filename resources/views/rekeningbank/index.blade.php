@extends('layouts.dashboard')

@section('title', 'Rekening Bank')

@section('content')
<div class="row">
    <div class="col">
        @can('rekening_bank-create')
            <a href="{{ route('rekening.create') }}" class="btn btn-sm btn-neutral mb-3">
                <i class="fa fa-plus"></i> Tambah Data
            </a>
        @endcan

        @include('shared.alert')

        <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
                <div class="d-flex flex-row">
                    <h3 class="mb-0 flex-grow-1">Data Rekening Kas</h3>
                    <button class="btn btn-info btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample"
                        aria-expanded="false" aria-controls="collapseExample">
                        Pengurutan Data
                    </button>
                </div>
                <div class="collapse mt-3" id="collapseExample">
                    <form action="" method="GET">
                        <div class="form-group">
                            <label for="sort-pejabat">Nama Bank</label>
                            <select class="form-control form-control-sm" name="sort_bank" onchange="this.form.submit()">
                                <option value="">Pengurutan Bank</option>
                                <option value="asc" {{ request()->sort_bank == 'asc' ? 'selected' : '' }}>Ascending </option>
                                <option value="desc" {{ request()->sort_bank == 'desc' ? 'selected' : ''}}>Descending</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sort-pejabat">No. Rekening</label>
                            <select class="form-control form-control-sm" name="sort_rekening" onchange="this.form.submit()">
                                <option value="">Pengurutan Rekening</option>
                                <option value="asc" {{ request()->sort_rekening == 'asc' ? 'selected' : '' }}>Ascending </option>
                                <option value="desc" {{ request()->sort_rekening == 'desc' ? 'selected' : ''}}>Descending</option>
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
                            <th>Nama Bank</th>
                            <th>No Rekening</th>
                            <th>Rekening Bendahara</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bank as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_bank }}</td>
                                <td>{{ $item->no_rekening }}</td>
                                <td>
                                    {{ $item->akunBendahara->kode }} {{ $item->akunBendahara->nama }}
                                </td>
                                <td>
                                    @can('rekening_bank-update')
                                        <a href="{{ route('rekening.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endcan

                                    @can('rekening_bank-delete')
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
@include('shared.delete_confirmation.script', ['routeName' => 'rekening.destroy'])
@endsection
