@extends('layouts.dashboard')

@section('title', 'Monitoring Piutang')
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="row">
    <div class="col">

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
                <h3 class="mb-0">Data Monitoring Piutang</h3>
            </div>
            <div class="container mb-3">
                <form class="form-inline">
                    <div class="form-group mb-2 mx-2">
                        <select name="year" class="form-control">
                            @foreach ($tahun as $item)
                                <option value="{{ $item->tahun }}"
                                {{ $item->tahun == $yearActive ? "selected=true" : '' }}>
                                    Tahun {{ $item->tahun }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-2 mx-2">
                        <select name="kecamatan" class="form-control">
                            <option value="" selected>-- Semua Kecamatan --</option>
                            @foreach ($kecamatan as $item)
                                <option value="{{ $item->id }}"
                                {{ $item->id == $kecamatanActive ? "selected=true" : '' }}>
                                    {{ $item->nama }} ({{ $item->kode_administratif }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-2 mx-2">
                      <input type="text" class="form-control date" name="keyword" placeholder="Nama Pemakai" autocomplete="off" value="{{ request()->query('keyword') }}">
                    </div>
                    <button type="submit" class="btn btn-outline-primary mb-2 mx-2"><i class="fa fa-search"></i> Temukan</button>
                    <a href="{{ route('monitoringpiutang.index') }}" class="btn btn-outline-danger mb-2"><i class="fa fa-reset"></i> Reset</a>
                </form>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th>Kode Objek</th>
                            <th>Pemakai</th>
                            <th>Kecamatan</th>
                            <th>Total SKRD</th>
                            <th>Total TBP</th>
                            <th>Lokasi Objek</th>
                            <th>Nominal Piutang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalPiutang = 0;
                        @endphp
                        @forelse ($piutang as $item)
                        <tr>
                            <td>{{ $item->objectRetribusi->kode }}</td>
                            <td>{{ $item->objectRetribusi->pemakai->nama }}</td>
                            <td>{{ $item->objectRetribusi->kelurahan->kecamatan->nama }}</td>
                            <td>{{ $item->nominal_idr }}</td>
                            <td>{{ $item->tbpDetail ? $item->tbpDetail->nominal_idr : '0.00'  }}</td>
                            <td>{{ $item->objectRetribusi->lokasi }}</td>
                            <td>{{ $item->tbpDetail ? format_idr($item->nominal-$item->tbpDetail->nominal) : $item->nominal_idr }}</td>
                            @php
                                $totalPiutang += $item->tbpDetail ? $item->nominal-$item->tbpDetail->nominal : $item->nominal
                            @endphp
                            <td>
                                <a href="{{ route('monitoringpiutang.notif', ['id' => $item->id] )}}" class="btn btn-sm btn-success {{ ( (!$item->objectRetribusi->pemakai->no_telp) ||(null != $item->monitor_piutang)) ? 'disabled' : '' }}" title="Kirim ke Whatsapp">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="7">Data tidak ditemukan.</td>
                        </tr>
                        @endforelse

                        <tr>
                            <td colspan="6"></td>
                            <td><strong>{{ format_idr($piutang->total_nominal) }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-3 mb-2 mx-2 d-flex justify-content-center">
                {{ $piutang->links('pagination::bootstrap-4') }}
            </div>

            <div class="card-footer py-4">
            </div>
        </div>
    </div>
</div>
@include('shared.delete_confirmation.modal')
@endsection
@section('js')
@include('shared.delete_confirmation.script', ['routeName' => 'objectretribusi.destroy'])
{{-- <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
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
</script> --}}
@endsection