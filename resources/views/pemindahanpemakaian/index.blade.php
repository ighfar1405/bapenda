@extends('layouts.dashboard')

@section('title', 'Pemindahan Pemakaian')

@section('content')
<div class="row">
    <div class="col">
        @can('pemindahan_pemakaian-create')
            <a href="{{ route('pemindahan_pemakaian.create') }}" class="btn btn-sm btn-neutral mb-3">
                <i class="fa fa-plus"></i> Tambah Pemindahan Pemakaian
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
                    <h3 class="mb-0 flex-grow-1">Data Pemindahan Pemakaian</h3>
                    <button class="btn btn-info btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample"
                        aria-expanded="false" aria-controls="collapseExample">
                        Pengurutan Data
                    </button>
                </div>
                <div class="collapse mt-3" id="collapseExample">
                    <form action="" method="GET">
                        <div class="form-group">
                            <label for="sort-pejabat">Kode Objek</label>
                            <select class="form-control form-control-sm" name="sort_kode" onchange="this.form.submit()">
                                <option value="">Pengurutan Kode</option>
                                <option value="asc" {{ request()->sort_kode == 'asc' ? 'selected' : '' }}>Ascending </option>
                                <option value="desc" {{ request()->sort_kode == 'desc' ? 'selected' : ''}}>Descending</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sort-pejabat">Pemakai Lama</label>
                            <select class="form-control form-control-sm" name="sort_lama" onchange="this.form.submit()">
                                <option value="">Pengurutan Pemakai Lama</option>
                                <option value="asc" {{ request()->sort_lama == 'asc' ? 'selected' : '' }}>Ascending </option>
                                <option value="desc" {{ request()->sort_lama == 'desc' ? 'selected' : ''}}>Descending</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sort-pejabat">Pemakai Beru</label>
                            <select class="form-control form-control-sm" name="sort_baru" onchange="this.form.submit()">
                                <option value="">Pengurutan Pemakai Baru</option>
                                <option value="asc" {{ request()->sort_baru == 'asc' ? 'selected' : '' }}>Ascending </option>
                                <option value="desc" {{ request()->sort_baru == 'desc' ? 'selected' : ''}}>Descending</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sort-pejabat">Kecamatan</label>
                            <select class="form-control form-control-sm" name="sort_kecamatan" onchange="this.form.submit()">
                                <option value="">Pengurutan Kecamatan</option>
                                <option value="asc" {{ request()->sort_kecamatan == 'asc' ? 'selected' : '' }}>Ascending </option>
                                <option value="desc" {{ request()->sort_kecamatan == 'desc' ? 'selected' : ''}}>Descending</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sort-pejabat">Luas <sup>2</sup> </label>
                            <select class="form-control form-control-sm" name="sort_luas" onchange="this.form.submit()">
                                <option value="">Pengurutan Luas</option>
                                <option value="asc" {{ request()->sort_luas == 'asc' ? 'selected' : '' }}>Ascending </option>
                                <option value="desc" {{ request()->sort_luas == 'desc' ? 'selected' : ''}}>Descending</option>
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
                            <th>Kode Objek</th>
                            <th>Pemakai Lama</th>
                            <th>Pemakai Baru</th>
                            <th>No. SK</th>
                            <th>Kecamatan</th>
                            <th>Lokasi</th>
                            <th>Luas</th>
                            <th>Kode Tarif</th>
                            <th>Klasifikasi Penggunaan</th>
                            <th>Tarif / m<sup>2</sup></th>
                            <th>Total Tarif</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1
                        @endphp
                        @foreach ($pemindahan as $item)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $item->objekRetribusi->kode }}</td>
                                <td>{{ $item->pemakaiLama->nama }}</td>
                                <td>{{ $item->pemakaiBaru->nama }}</td>
                                <td>{{ $item->no_sk }}</td>
                                <td>{{ $item->objekRetribusi->kelurahan->kecamatan->nama }}</td>
                                <td>{{ $item->objekRetribusi->lokasi }}</td>
                                <td>{{ $item->objekRetribusi->luas }}</td>
                                <td>{{ $item->objekRetribusi->tarifRetribusi->kode_tarif }}</td>
                                <td>{{ $item->klasifikasiPemakaian->jenis_klasifikasi }}</td>
                                <td>Rp {{ $item->objekRetribusi->tarifRetribusi->tarif_meter }}</td>
                                <td>Rp {{ format_idr($item->objekRetribusi->luas * $item->objekRetribusi->tarifRetribusi->tarif_meter_float) }}</td>
                                <td>
                                    @can('pemindahan_pemakaian-update')
                                        <a class="btn btn-warning btn-sm" href="{{ route('pemindahan_pemakaian.edit', [$item->id]) }}">
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                        </a>
                                    @endcan

                                    @can('pemindahan_pemakaian-delete')
                                        <button type="button" class="btn btn-danger btn-sm" data-target="#DeleteModal" data-toggle="modal" onclick="deleteData({{ $item->id }})">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
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
@include('shared.delete_confirmation.script', ['routeName' => 'pemindahan_pemakaian.destroy'])
@endsection
