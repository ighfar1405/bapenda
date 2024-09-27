@extends('layouts.dashboard')

@section('title', 'Tarif retribusi')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="row">
    <div class="col">
        @can('tarif_retribusi-create')
            <a href="{{ route('tarifretribusi.create') }}" class="btn btn-sm btn-neutral mb-3">
                <i class="fa fa-plus"></i> Tambah tarif retribusi 
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
                    <h3 class="mb-0 flex-grow-1">Data Tarif Retribusi</h3>
                    <button class="btn btn-info btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample"
                        aria-expanded="false" aria-controls="collapseExample">
                        Pengurutan Data
                    </button>
                </div>
                <div class="collapse mt-3" id="collapseExample">
                    <form action="" method="GET">
                        <div class="form-group">
                            <label for="sort-pejabat">Range NJOP</label>
                            <select class="form-control form-control-sm" name="sort_range" onchange="this.form.submit()">
                                <option value="">Pengurutan Range</option>
                                <option value="asc" {{ request()->sort_range == 'asc' ? 'selected' : '' }}>Ascending </option>
                                <option value="desc" {{ request()->sort_range == 'desc' ? 'selected' : ''}}>Descending</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sort-pejabat">Klasifikasi Pemakaian</label>
                            <select class="form-control form-control-sm" name="sort_klasifikasi" onchange="this.form.submit()">
                                <option value="">Pengurutan Klasikasi</option>
                                <option value="asc" {{ request()->sort_klasifikasi == 'asc' ? 'selected' : '' }}>Ascending </option>
                                <option value="desc" {{ request()->sort_klasifikasi == 'desc' ? 'selected' : ''}}>Descending</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sort-pejabat">Tarif</label>
                            <select class="form-control form-control-sm" name="sort_tarif" onchange="this.form.submit()">
                                <option value="">Pengurutan Tarif</option>
                                <option value="asc" {{ request()->sort_tarif == 'asc' ? 'selected' : '' }}>Ascending </option>
                                <option value="desc" {{ request()->sort_tarif == 'desc' ? 'selected' : ''}}>Descending</option>
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
                            <th>No Urut</th>
                            {{-- <th>Kelas</th>
                            <th>Golongan</th> --}}
                            <th>Range NJOP</th>
                            {{-- <th>Kode tarif</th> --}}
                            <th>Tarif M/2</th>
                            <th>Klasifikasi pemakaian</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tarifRetribusi as $tarif)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                {{-- <td>{{ $tarif->kelas }}</td>
                                <td>{{ $tarif->golongan }}</td> --}}
                                <td>{{ $tarif->range_njop }}</td>
                                {{-- <td>{{ $tarif->kode_tarif }}</td> --}}
                                <td>{{ $tarif->tarif_meter }}</td>
                                <td>{{ $tarif->klasifikasiPemakaian->jenis_klasifikasi }}</td>
                                <td>
                                    @can('tarif_retribusi-update')
                                        <a href="{{ route('tarifretribusi.edit', $tarif->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endcan

                                    @can('tarif_retribusi-delete')
                                        <a href="javascript:;" class="btn btn-sm btn-danger"
                                            data-toggle="modal" onclick="deleteData({{ $tarif->id }})" 
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
    @include('shared.delete_confirmation.script', ['routeName' => 'tarifretribusi.destroy'])

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