@extends('layouts.dashboard')

@section('title', 'Edit Pemidahan Pemakaian')

@section('content')
<div class="row">
    <div class="col">
        <a href="{{ route('pemindahan_pemakaian.index') }}" class="btn btn-sm btn-neutral mb-3">
            <i class="fa fa-chevron-left"></i> Daftar Pemindahan Pemakaian
        </a>

        {{-- flash message --}}
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissable fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </div>
        @endif

        <div class="card pb-4">
            <!-- Card header -->
            <div class="card-header border-0">
                <h3 class="mb-0">Edit Penomoran</h3>
            </div>

            <div class="card-body">
                <form action="" method="get">
                    <div class="d-flex flex-lg-row">
                        <div class="form-group col-6 pl-lg-0 mb-0">
                            <label for="kelurahan">Kelurahan</label>
                            <select class="form-control select2" name="kelurahan" id="kelurahan"
                                onchange="this.form.submit()">
                                <option value="">Pilih Kelurahan</option>
                                @foreach ($kelurahan as $item)
                                <option value="{{ $item->id }}" {{ $item->id == request()->kelurahan ? 'selected' : ''
                                    }}>
                                    {{ $item->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6 pr-lg-0 mb-0">
                            <label for="kode">Kode Objek Retribusi</label>
                            <select class="form-control select2" name="kode" id="kode" onchange="this.form.submit()">
                                <option value="">Pilih Kode Objek Retribusi</option>
                                @foreach ($kodeObjek as $item)
                                <option value="{{ $item->kode }}" {{ $item->kode == request()->kode ? 'selected' : ''
                                    }}>
                                    {{ $item->kode }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>

                <hr>

                <form action="{{ route('pemindahan_pemakaian.update', [$pemindahan->id]) }}" method="post" autocomplete="off">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="objekRetribusi">Objek Retribusi</label>
                        <input type="text" class="form-control bg-white" name="objek_retribusi" id="objek-retribusi"
                            placeholder="Objek Retribusi" value="{{ old('objek_retribusi') ?? $pemindahan->objekRetribusi->kode }}" readonly>
                        <input type="hidden" name="objek_retribusi_id" id="id_objek"
                            value="{{ old('objek_retribusi_id') ?? $pemindahan->objek_retribusi_id }}">
                    </div>
                    <hr>
                    <div class="d-flex flex-lg-row">
                        <div class="form-group col-4 pl-lg-0">
                            <label for="lokasi">Lokasi</label>
                            <input type="text" class="form-control" name="lokasi" id="lokasi"
                                value="{{ old('lokasi') ?? $pemindahan->objekRetribusi->lokasi }}" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label for="lokasi">Kelurahan</label>
                            <input type="text" class="form-control" name="kelurahan-info" id="kelurahan-info"
                                value="{{ old('kelurahan-info') ?? $pemindahan->objekRetribusi->kelurahan->nama }}" readonly>
                        </div>
                        <div class="form-group col-4 pr-lg-0">
                            <label for="lokasi">Total Tarif</label>
                            <input type="text" class="form-control" name="total_tarif" id="total"
                                value="{{ old('total_tarif') ?? format_idr($pemindahan->objekRetribusi->luas * $pemindahan->objekRetribusi->tarifRetribusi->tarif_meter_float) }}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pemakai_lama">Pemakai Lama</label>
                        <input type="text" class="form-control" name="pemakai_lama" id="pemakai_lama"
                            value="{{ old('pemakai_lama') ?? $pemindahan->pemakaiLama->nama }}" readonly>
                        <input type="hidden" name="pemakai_lama_id" id="pemakai_lama_id"
                            value="{{ old('pemakai_lama_id') ?? $pemindahan->pemakai_lama }}">
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="pemakai_baru">Pemakai Baru</label>
                        <select class="form-control select2" name="pemakai_baru" id="pemakai_baru">
                            <option>Pilih Pemakai Baru</option>
                            @foreach ($pemakaiBaru as $item)
                            <option value="{{ $item->id }}" {{ $item->id == $pemindahan->pemakai_baru ? 'selected' : '' }}>
                                {{ $item->nama }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="klasifikasi_pemakaian_id">Klasifikasi Pemakaian</label>
                        <select class="form-control" name="klasifikasi_pemakaian_id" id="klasifikasi_pemakaian_id">
                            <option value="">Pilih Klasifikasi Pemakaian</option>
                            @foreach ($klasifikasi as $item)
                            <option value="{{ $item->id }}" {{ $item->id == $pemindahan->klasifikasi_pemakaian_id ? 'selected'
                                : '' }}>
                                {{ $item->jenis_klasifikasi }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="noSk">No. SK</label>
                        <input type="text" class="form-control" name="no_sk" id="noSk" placeholder="No. SK"
                            value="{{ old('no_sk') ?? $pemindahan->no_sk }}">
                    </div>
                    <div class="form-group">
                        <label for="tanggalSK">Tanggal SK</label>
                        <input type="date" class="form-control" name="tanggal_sk" id="tanggalSK"
                            placeholder="Tanggal SK" value="{{ old('tanggal_sk') ?? $pemindahan->tanggal_sk}}">
                    </div>

                    <div class="text-right pr-lg-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                    </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="modal-objek" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Daftar Objek Retribusi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body table-responsive">
                <table class="table responsive">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode</th>
                            <th>Pemakai</th>
                            <th>Lokasi</th>
                            <th>Luas (<sup>2</sup>) </th>
                            <th>Tarif</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1
                        @endphp
                        @foreach ($objekRetribusi as $item)
                        <tr>
                            <td>{{ $i++ }}.</td>
                            <td>{{ $item->kode }}</td>
                            <td>{{ $item->pemakai->nama }}</td>
                            <td>{{ $item->lokasi }}</td>
                            <td>{{ number_format($item->luas, 0, ',', '.') }}</td>
                            <td>{{ format_idr($item->tarifRetribusi->tarif_meter_float) }}</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm"
                                    onclick="setData('{{ $item->id }}', '{{ $item->kode }}', '{{ $item->pemakai->nama }}', '{{ $item->pemakai->id }}', '{{ $item->lokasi }}', '{{ $item->kelurahan->nama }}', '{{ $item->luas * $item->tarifRetribusi->tarif_meter_float }}')">
                                    Pilih
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $('.select2').select2();

    document.querySelector('#objek-retribusi').addEventListener('click', () => {
        $('#modal-objek').modal('show');
    });

    const setData = (id, kode, pemakai, pemakaiId, lokasi, kelurahan, tarif) => {
        document.querySelector('#objek-retribusi').value = kode;
        document.querySelector('#id_objek').value = id;
        document.querySelector('#lokasi').value = lokasi;
        document.querySelector('#kelurahan-info').value = kelurahan;
        document.querySelector('#total').value = tarif;
        document.querySelector('#pemakai_lama').value = pemakai;
        document.querySelector('#pemakai_lama_id').value = pemakaiId;

        $('#modal-objek').modal('hide');
    }
</script>
@endsection