@extends('layouts.dashboard')

@section('title', 'Perbaharui Sewa Properti')

@section('content')
    <div class="row">
        <div class="col">
            <a href="{{ route('pertanian.index') }}" class="btn btn-sm btn-neutral mb-3">
                <i class="fa fa-chevron-left"></i> Daftar Sewa Properti
            </a>

            @include('shared.alert')

            <div class="card pb-4">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0">Perbaharui Sewa Properti</h3>
                </div>

                <form action="{{ route('pertanian.update', ['id' => $pertanian->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row pl-lg-4 pr-lg-4">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label">Nama Penyewa</label>
                                <input type="text" class="form-control" name="nama_penyewa"
                                    value="{{ $pertanian->nama_penyewa }}" autocomplete="off" />
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="form-control-label">NIK</label>
                                <input type="text" class="form-control" value="{{ $pertanian->nik }}" name="nik"
                                    maxlength="16" autocomplete="off" required />
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="form-control-label">No telp</label>
                                <input type="text" class="form-control" name="no_telp" maxlength="20" autocomplete="off"
                                    value="{{ $pertanian->no_telp }}" required />
                            </div>
                        </div>
                    </div>

                    <div class="row pl-lg-4 pr-lg-4">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label">Alamat Sewa</label>
                                <input type="text" class="form-control" name="alamat"
                                    value="{{ $pertanian->alamat_penyewa }}" maxlength="50" autocomplete="off" required />
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="form-control-label">Kecamatan</label>
                                <select class="form-control" id="kecamatan" name="kecamatan">
                                    @foreach ($dt_kec as $row)
                                        <option value="{{ $row->id }}"
                                            {{ $row->id == $pertanian->kecamatan_id ? 'selected' : '' }}>{{ $row->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="form-control-label">Kelurahan</label>
                                <select class="form-control" id="kelurahan" name="kelurahan">
                                    @foreach ($dt_kel as $row)
                                        <option value="{{ $row->id }}"
                                            {{ $row->id == $pertanian->kelurahan_id ? 'selected' : '' }}>{{ $row->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row pl-lg-4 pr-lg-4">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label">Lokasi Sewa</label>
                                <input type="text" class="form-control" name="lokasi" value="{{ $pertanian->lokasi }}"
                                    autocomplete="off" />
                            </div>
                        </div>
                    </div>

                    <div class="row pl-lg-4 pr-lg-4">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label">Tanggal Sewa</label>
                                <input type="date" class="form-control" name="tanggal_sewa"
                                    value="{{ $pertanian->tanggal_sewa }}" autocomplete="off" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label">Tanggal Selesai</label>
                                <input type="date" class="form-control" value="{{ $pertanian->tgl_selesai }}"
                                    name="tanggal_selesai" required />
                            </div>
                        </div>
                    </div>

                    <div class="pl-lg-4 pr-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Status Pembayaran</label>
                            <select name="status" class="form-control">
                                <option value="" selected>Pilih salah satu</option>
                                <option value="paid"
                                    {{ $pertanian->getRawOriginal('status') == 'paid' ? 'selected' : null }}>Sudah Bayar
                                </option>
                                <option value="unpaid"
                                    {{ $pertanian->getRawOriginal('status') == 'unpaid' ? 'selected="true"' : null }}>Belum
                                    Bayar</option>
                            </select>
                        </div>
                    </div>

                    <div class="pl-lg-4 pr-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Jenis tanaman</label>
                            <select name="jenis_tanaman" id="jenis_tanaman" class="form-control">
                                @foreach ($tanaman as $row)
                                    <option value="{{ $row->id }}"
                                        {{ $row->id == $pertanian->jenis_tanaman_id ? 'selected' : '' }}>{{ $row->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="pl-lg-4 pr-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Luas tanah</label>
                            <input type="number" name="luas" id="luas" value="{{ $pertanian->luas }}"
                                class="form-control" min="0" step="0.01" />
                        </div>
                    </div>

                    <div class="pl-lg-4 pr-lg-4">
                        <div class="form-group">
                            {{-- TODO: input number only --}}
                            <label class="form-control-label">Nominal Tarif</label>
                            <input type="text" class="form-control numeric" id="nominal" name="nominal"
                                value="{{ $pertanian->nominal }}" autocomplete="off" />
                        </div>
                    </div>

                    <div class="pl-lg-4 pr-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Keterangan</label>
                            <textarea name="keterangan" rows="5" class="form-control" style="resize: none;">{{ $pertanian->keterangan }}</textarea>
                        </div>
                    </div>

                    <div class="text-right pr-lg-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#nominal').prop('readonly', true);
        const harga = {!! json_encode($tanaman) !!};

        function defHargaSewa() {
            let tanam = $('#jenis_tanaman').val();

            if ({{ $pertanian->jenis_tanaman_id }} == 4) {
                $('#nominal').prop('readonly', false);
            } else {
                $('#nominal').prop('readonly', true);
            }

            $('#nominal').val({{ $pertanian->nominal }});
        }

        function refHargaSewa(_target) {
            let _r = 0;

            if (_target == 4) {
                $('#nominal').prop('readonly', false);
            } else {
                $('#nominal').prop('readonly', true);
                harga.forEach(function(i) {
                    if (i['id'] == _target) {
                        _r = parseInt(i.tarif);
                    }
                });
            }
            return _r;
        }

        $('#jenis_tanaman').on('change', function(e1) {

            let luas = parseFloat($('#luas').val());
            let harga = refHargaSewa(e1.target.value);

            if (harga) {
                let res = luas * parseInt(harga);

                $('#nominal').val(res);
            }
        });
        $('#luas').on('change', function(e2) {
            let luas = parseFloat(e2.target.value);
            let harga = refHargaSewa($('#jenis_tanaman').val());

            if (harga) {
                let res = luas * parseInt(harga);

                $('#nominal').val(res);
            }

        });
        $('#kecamatan').on('change', function(evt) {
            $.ajax({

                url: "{{ url('ajax/kelurahan') }}/" + evt.target.value

            }).done(function(res) {

                $('#kelurahan').empty();

                res.forEach(function(i) {
                    $('#kelurahan').append('<option value="' + i.id + '">' + i.nama + '</option>');
                });

            });
        });
        defHargaSewa();
    </script>
@endsection
