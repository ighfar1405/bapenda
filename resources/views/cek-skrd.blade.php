@extends('layouts.landing')
@section('title', 'Sistem Retribusi Pendapatan Daerah - Cek SKRD')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
                <h3 class="mb-0">Cek Data SKRD</h3>
            </div>
            <div class="container mb-3">
                <form class="form-inline" autocomplete="off">
                    <div class="form-group">
                        <input type="text" class="form-control" name="loc" value="{{ request()->query('loc') }}"
                            placeholder="Cari Lokasi">
                    </div>
                    <div class="form-group mb-2 mx-2">
                        <input type="text" class="form-control date" name="keyword"
                            value="{{ request()->query('keyword') }}" placeholder="Nama Pemakai">
                    </div>
                    <button type="submit" class="btn btn-outline-primary mb-2 mx-2">
                        <i class="fa fa-search"></i>
                        Temukan
                    </button>
                    <a href="{{ route('cek-skrd') }}" class="btn btn-outline-danger mb-2">
                        <i class="fa fa-reset"></i> Reset
                    </a>
                </form>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th>No Urut</th>
                            <th>No. SKRD</th>
                            <th>Nama Penyewa</th>
                            <th>Lokasi</th>
                            <th>Tanggal Sewa</th>
                            <th>Kode Akun</th>
                            <th>Nama OPD</th>
                            <th>Nominal Tarif</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($skrd as $key => $item)
                        <tr>
                            <td>{{ $skrd->firstItem() + $key }}</td>
                            <td>{{ $item->format_nomor }}</td>
                            <td>{{ $item->pemakai->nama }}</td>
                            <td>{{ $item->objectRetribusi->lokasi }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $akunBendahara->kode }}</td>
                            <td>{{ $akunBendahara->nama }}</td>
                            <td>Rp {{ $item->nominal_idr }}</td>
                            <td>{{ $item->tbpDetail != null ? 'Telah Terbayar' : 'Belum Terbayar' }}</td>
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
                @if (!empty($skrd))
                    {{ $skrd->links('pagination::bootstrap-4') }}
                @endif
            </div>

            <div class="card-footer py-4">
            </div>
        </div>
    </div>
</div>
@endsection