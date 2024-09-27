@extends('layouts.dashboard')

@section('title', 'Sewa Properti')

@section('content')
    <div class="row">
        <div class="col">
            @can('lahan_pertanian-show')
                <a href="{{ route('pertanian.create') }}" class="btn btn-sm btn-neutral mb-3">
                    <i class="fa fa-plus"></i> Tambah Data
                </a>
            @endcan

            @include('shared.alert')

            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0">Data Sewa Properti</h3>
                </div>
                <div class="container mb-3">
                    <form class="form-inline">
                        <div class="form-group mb-2 mx-2">
                            <input type="text" class="form-control date" name="keyword"
                                value="{{ request()->query('keyword') }}" placeholder="Nama Pemakai" autocomplete="off">
                        </div>
                        <button type="submit" class="btn btn-outline-primary mb-2 mx-2"><i class="fa fa-search"></i>
                            Temukan</button>
                        <a href="{{ route('pertanian.index') }}" class="btn btn-outline-danger mb-2"><i
                                class="fa fa-reset"></i> Reset</a>
                    </form>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th>No Urut</th>
                                <th>Nama Penyewa</th>
                                <th>Jenis Sewa</th>
                                <th>Lokasi</th>
                                <th>Nominal Tarif</th>
                                <th>Nominal Bayar</th>
                                <th>Tanggal Sewa</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pertanian as $key => $item)
                                <tr>
                                    <td>{{ $pertanian->firstItem() + $key }}</td>
                                    <td>{{ $item->nama_penyewa }}</td>
                                    <td>{{ $item->jenis_tanaman_id }}</td>
                                    <td>{{ $item->lokasi }}</td>
                                    <td>{{ $item->nominal_idr }}</td>
                                    <td>{{ number_format($item->nominal_bayar, 2, ',', '.') }}</td>
                                    <td>{{ $item->getPrettyDate() }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ substr($item->keterangan, 0, 5) }}</td>
                                    <td>
                                        <a href="{{ route('pertanian.bayar', $item->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-money-bill-alt"></i>
                                        </a>
                                        @can('lahan_pertanian-update')
                                            <a href="{{ route('pertanian.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        @endcan
                                 

                                        <a href="{{ route('pertanian.print', $item->id) }}" class="btn btn-sm btn-success">
                                                <i class="fa fa-print"></i>
                                            </a>


                                        @can('lahan_pertanian-delete')
                                            <a href="javascript:;" class="btn btn-sm btn-danger" data-toggle="modal"
                                                onclick="deleteData({{ $item->id }})" data-target="#DeleteModal">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        @endcan

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">Data tidak ada.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3 mb-2 mx-2 d-flex justify-content-center">
                    {{ $pertanian->links('pagination::bootstrap-4') }}
                </div>

                <div class="card-footer py-4">
                </div>
            </div>
        </div>
    </div>

    @include('shared.delete_confirmation.modal')
@endsection

@section('js')
    @include('shared.delete_confirmation.script', ['routeName' => 'pertanian.destroy'])
@endsection
