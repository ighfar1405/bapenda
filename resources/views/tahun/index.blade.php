@extends('layouts.dashboard')

@section('title', 'Tahun')

@section('content')
<div class="row">
    <div class="col">
        @can('tahun-create')
            <a href="{{ route('tahun.create') }}" class="btn btn-sm btn-neutral mb-3">
                <i class="fa fa-plus"></i> Tambah Data
            </a>
        @endcan

        @include('shared.alert')

        <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
                <div class="d-flex flex-row">
                    <h3 class="mb-0 flex-grow-1">Data Tahun</h3>
                    <button class="btn btn-info btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample"
                        aria-expanded="false" aria-controls="collapseExample">
                        Pengurutan Data
                    </button>
                </div>
                <div class="collapse mt-3" id="collapseExample">
                    <form action="" method="GET">
                        <div class="form-group">
                            <label for="sort-pejabat">Tahun</label>
                            <select class="form-control form-control-sm" name="sort_tahun" onchange="this.form.submit()">
                                <option value="">Pengurutan Tahun</option>
                                <option value="asc" {{ request()->sort_tahun == 'asc' ? 'selected' : '' }}>Ascending </option>
                                <option value="desc" {{ request()->sort_tahun == 'desc' ? 'selected' : ''}}>Descending</option>
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
                            <th>Tahun</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tahun as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->tahun }}</td>
                                <td>
                                    @can('tahun-update')
                                        <a href="{{ route('tahun.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endcan

                                    {{-- @can('tahun-delete')
                                        <a href="javascript:;" class="btn btn-sm btn-danger"
                                            data-toggle="modal" onclick="deleteData({{ $item->id }})" 
                                            data-target="#DeleteModal">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    @endcan --}}
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

{{-- @include('shared.delete_confirmation.modal') --}}
@endsection

@section('js')
{{-- @include('shared.delete_confirmation.script', ['routeName' => 'tahun.destroy']) --}}
@endsection
