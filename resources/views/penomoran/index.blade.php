@extends('layouts.dashboard')

@section('title', 'Penomoran')

@section('content')
<div class="row">
    <div class="col">
        @can('penomoran-create')
            <a href="{{ route('penomoran.create') }}" class="btn btn-sm btn-neutral mb-3">
                <i class="fa fa-plus"></i> Tambah Penomoran
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
                    <h3 class="mb-0 flex-grow-1">Data Penomoran</h3>
                    <button class="btn btn-info btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample"
                        aria-expanded="false" aria-controls="collapseExample">
                        Pengurutan Data
                    </button>
                </div>
                <div class="collapse mt-3" id="collapseExample">
                    <form action="" method="GET">
                        <div class="form-group">
                            <label for="sort-pejabat">Formulir</label>
                            <select class="form-control form-control-sm" name="sort_formulir" onchange="this.form.submit()">
                                <option value="">Pengurutan Formulir</option>
                                <option value="asc" {{ request()->sort_formulir == 'asc' ? 'selected' : '' }}>Ascending </option>
                                <option value="desc" {{ request()->sort_formulir == 'desc' ? 'selected' : ''}}>Descending</option>
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
                            <th>No.</th>
                            <th>Formulir</th>
                            <th>Format Penomoran</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1
                        @endphp
                        @foreach ($penomorans as $item)
                            <tr>
                                <td>{{ $i++ }}.</td>
                                <td>{{ $item->formulir }}</td>
                                <td>{{ $item->format_penomoran }}</td>
                               
                                <td>
                                    @can('penomoran-update')
                                        <a href="{{ route('penomoran.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endcan

                                    @can('penomoran-delete')
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
@include('shared.delete_confirmation.script', ['routeName' => 'penomoran.destroy'])
@endsection
