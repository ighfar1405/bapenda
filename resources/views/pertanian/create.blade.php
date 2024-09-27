@extends('layouts.dashboard')

@section('title', 'Tambah Sewa Properti')

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
                    <h3 class="mb-0">Tambah Sewa Properti</h3>
                </div>

                <form action="{{ route('pertanian.store') }}" method="POST">
                    @csrf

                    <div class="row pl-lg-4 pr-lg-4">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label">Nama Penyewa</label>
                                <input type="text" class="form-control" name="nama_penyewa"
                                    value="{{ old('nama_penyewa') }}" autocomplete="off" required />
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="form-control-label">NIK</label>
                                <input type="text" class="form-control" name="nik" maxlength="16" autocomplete="off"
                                    required />
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="form-control-label">No Telp</label>
                                <input type="text" class="form-control" name="no_telp" maxlength="20" autocomplete="off"
                                    value="{{ old('no_telp') }}" required />
                            </div>
                        </div>
                    </div>

                    <div class="row pl-lg-4 pr-lg-4">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label">Alamat Penyewa</label>
                                <input type="text" class="form-control" name="alamat" maxlength="50" autocomplete="off"
                                    value="{{ old('alamat') }}" required />
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="form-control-label">Kecamatan</label>
                                <select class="form-control" id="kecamatan" name="kecamatan">
                                    @foreach ($dt_kec as $row)
                                        <option value="{{ $row->id }}">{{ $row->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="form-control-label">Kelurahan</label>
                                <select class="form-control" id="kelurahan" name="kelurahan">
                                    @foreach ($dt_kel as $row)
                                        <option value="{{ $row->id }}">{{ $row->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row pl-lg-4 pr-lg-4">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label">Jenis Sewa</label>
                                <select class="form-control" id="jenis_tanaman" name="jenis_tanaman">
                                    @foreach ($tanaman as $row)
                                        <option value="{{ $row->id }}">{{ $row->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row pl-lg-4 pr-lg-4">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label">Lokasi Sewa</label>
                                <input type="text" class="form-control" name="lokasi" value="{{ old('lokasi') }}"
                                    autocomplete="off" />
                            </div>
                        </div>
                    </div>

                    <div class="row pl-lg-4 pr-lg-4">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label">Tanggal Sewa</label>
                                <input type="date" class="form-control" name="tanggal_sewa"
                                    value="{{ old('tanggal_sewa') }}" autocomplete="off" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label">Tanggal Selesai</label>
                                <input type="date" class="form-control" name="tanggal_selesai" autocomplete="off"
                                    required />
                            </div>
                        </div>
                    </div>

                    <div class="pl-lg-4 pr-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="paid">paid</option>
                                <option value="unpaid">unpaid</option>
                            </select>
                        </div>
                    </div>

                 

                    <div class="pl-lg-4 pr-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Luas / Hari / Bulan</label>
                            <input type="number" id="luas" name="luas" value="1" min="0"
                                step="0.01" class="form-control" />
                        </div>
                    </div>

                    <div class="pl-lg-4 pr-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Nominal Tarif</label>
                            <input type="number" id="nominal" class="form-control" name="nominal"
                                autocomplete="off" />
                        </div>
                    </div>

                    <div class="pl-lg-4 pr-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Keterangan</label>
                            <textarea name="keterangan" rows="5" maxlength="250" class="form-control" style="resize: none;">{{ old('keterangan') }}</textarea>
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
    <script type="text/javascript">
        $('#nominal').prop('readonly', true);
        const harga = {!! json_encode($tanaman) !!};

        function defHargaSewa() {
            let res = 0;
            let jns = $('#jenis_tanaman').val();

            harga.forEach(function(i) {
                if (i['id'] == jns) {
                    res = Number(i.tarif) * Number($('#luas').val());
                }
            });

            $('#nominal').val(res);
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
