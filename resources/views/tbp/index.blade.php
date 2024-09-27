@extends('layouts.dashboard')

@section('title', 'TBP')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="row">
    <div class="col">
        @can('tbp-create')
            <a href="{{ route('tbp.create') }}" class="btn btn-sm btn-neutral mb-3">
                <i class="fa fa-plus"></i> Tambah TBP SKRD
            </a>
            <a href="{{ route('tbp.create_insidentil') }}" class="btn btn-sm btn-neutral mb-3">
                <i class="fa fa-plus"></i> Tambah TBP Non SKRD
            </a>
        @endcan

        @include('shared.alert')

        <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
                <h3 class="mb-0">Data TBP SKRD</h3>
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
                        <input type="text" class="form-control date" name="keyword" value="{{ request()->query('keyword') }}" placeholder="Nama Pemakai" autocomplete="off">
                    </div>

                    <div class="form-group mb-2 mx-2">
                      <input type="date" class="form-control" name="start" id="start" value="{{ request()->query('start') }}">
                    </div>

                    <div class="form-group mb-2 mx-2">
                      <label for="end"></label>
                      <input type="date" class="form-control" name="end" id="end" value="{{ request()->query('end') }}">
                    </div>

                    <button type="submit" class="btn btn-outline-primary mb-2 mx-2"><i class="fa fa-search"></i> Temukan</button>
                    <a href="{{ route('tbp.index') }}" class="btn btn-outline-danger mb-2"><i class="fa fa-reset"></i> Reset</a>
                </form>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th>Nomor Urut</th>
                            <th>Total SKRD</th>
                            <th>Nomor</th>
                            <th>Tanggal Bayar</th>
                            <th>Pemakai</th>
                            <th>Nominal Pembayaran</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $tot = 0; ?>
                        @forelse ($tbpSkrd as $key => $item)
                        @php
                            $nominalPembayaran = 0;
                            foreach($item->tbpDetail as $detail)
                                $nominalPembayaran += $detail->nominal;
                        @endphp
                            <tr>
                                <td>{{ $tbpSkrd->firstItem() + $key }}</td>
                                <td>{{ $item->tbpDetail()->count() }}</td>
                                <td>{{ $item->format_nomor }}</td>
                                <td>{{ $item->getPrettyDate() }}</td>
                                <td>{{ $item->pemakai->nama }}</td>
                                <td>{{ format_idr($nominalPembayaran) }}</td>
                                <td>
                                    @can('tbp-update')
                                        <a href="{{ route('tbp.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endcan

                                    @can('tbp-delete')
                                        <a href="javascript:;" class="btn btn-sm btn-danger"
                                            data-toggle="modal" onclick="deleteData({{ $item->id }})"
                                            data-target="#DeleteModal">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    @endcan

                                    <a href="{{ route('tbp.print', $item->id )}}" class="btn btn-sm btn-info" title="Cetak TBP" target="_blank">
                                        <i class="fa fa-print"></i>
                                    </a>
                                    <!-- TODO tambah list objek nya. -->
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="8">Data tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td align="right" colspan="5">TOTAL</td>
                            <td colspan="2">{{ format_idr($totalTBP) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="mt-3 mb-2 mx-2 d-flex justify-content-center">
                {{ $tbpSkrd->links('pagination::bootstrap-4') }}
            </div>

            <div class="card-footer py-4"></div>
        </div>

        <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
                <h3 class="mb-0">Data TBP Non SKRD</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th>No Urut</th>
                            <th>Nomor Ijin</th>
                            <th>Tanggal Bayar</th>
                            <th>Pemakai</th>
                            <th>Nama Obyek</th>
                            <th>Lokasi Obyek</th>
                            <th>Nominal Pembayaran</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tbpInsidentil as $key => $item)
                            <tr>
                                <td>{{ $tbpInsidentil->firstItem() + $key }}</td>
                                <td>{{ $item->no_surat_izin }}</td>
                                <td>{{ $item->getPrettyDate() }}</td>
                                <td>{{ $item->pemakai }}</td>
                                <td>{{ $item->nama_objek }}</td>
                                <td>{{ $item->alamat_objek }}</td>
                                <td>{{ format_idr($item->tarif * $item->luas * $item->tinggi) }}</td>
                                <td>
                                    @can('tbp-update')
                                        <a href="{{ route('tbp.edit_insidentil', $item->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endcan

                                    @can('tbp-delete')
                                        <a href="javascript:;" class="btn btn-sm btn-danger"
                                            data-toggle="modal" onclick="deleteDataInsidentil({{ $item->id }})"
                                            data-target="#DeleteModalInsidentil">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    @endcan

                                    <a href="{{ route('tbp.print_insidentil', $item->id )}}" class="btn btn-sm btn-info" title="Cetak TBP Insidentil" target="_blank">
                                        <i class="fa fa-print"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="8">Data tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3 mb-2 mx-2 d-flex justify-content-center">
                {{ $tbpInsidentil->links('pagination::bootstrap-4') }}
            </div>

            <div class="card-footer py-4"></div>
        </div>
    </div>
</div>

@include('shared.delete_confirmation.modal')

{{-- delete modal insidentik --}}
<div id="DeleteModalInsidentil" class="modal fade text-danger" role="dialog">
    <div class="modal-dialog ">
      <!-- Modal content-->
      <form action="" id="deleteFormInsidentil" method="post">
          <div class="modal-content">
              <div class="modal-header bg-secondary">
                  <h4 class="modal-title text-dark text-center">Yakin akan menghapus data?</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                  @csrf
                  @method('DELETE')
                  <h3>PERINGATAN! Setelah data dihapus, maka data tidak akan bisa dikembalikan.</h3>
              </div>
              <div class="modal-footer">
                  <center>
                      <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-sm btn-danger" data-dismiss="modal" onclick="formSubmitInsidentil()">Ya, Hapus</button>
                  </center>
              </div>
          </div>
      </form>
    </div>
</div>
@endsection

@section('js')
@include('shared.delete_confirmation.script', ['routeName' => 'tbp.destroy'])
<script>
    function deleteDataInsidentil(id) {
         var id = id;
         var url = '{{ route("tbp.destroy_insidentil", ":id") }}';
         url = url.replace(':id', id);
         console.log('url', url)
         $("#deleteFormInsidentil").attr('action', url);
     }

     function formSubmitInsidentil() {
         $("#deleteFormInsidentil").submit();
     }
</script>
@endsection

