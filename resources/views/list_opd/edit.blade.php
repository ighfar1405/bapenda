@extends('layouts.dashboard')

@section('title', 'Edit Data Jasa Umum')

@section('content')
    <div class="row">
        <div class="col">
            <a href="{{ route('list_opd.index') }}" class="btn btn-sm btn-neutral mb-3">
                <i class="fa fa-chevron-left"></i> Daftar Jasa Umum
            </a>

            @include('shared.alert')

            <div class="card pb-4">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0">Edit Data Jasa Umum</h3>
                </div>

                <form action="{{ route('list_opd.update', $list_opd->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="pl-lg-4 pr-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Nama Penyetor</label>
                            <input type="text" class="form-control" name="nama_opd"
                                value="{{ old('nama_opd', $list_opd->nama_opd) }}" autocomplete="off" required />
                        </div>
                    </div>

                    <div class="pl-lg-4 pr-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Jenis Retribusi</label>
                            <input type="text" class="form-control" name="jenis_retribusi"
                                value="{{ old('jenis_retribusi', $list_opd->jenis_retribusi) }}" autocomplete="off"
                                required />
                        </div>
                    </div>

                    <div class="pl-lg-4 pr-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Objek Retribusi</label>
                            <textarea class="form-control" name="objek_retribusi" rows="3" autocomplete="off" required>{{ old('objek_retribusi', $list_opd->objek_retribusi) }}</textarea>
                        </div>
                    </div>

                    <div class="pl-lg-4 pr-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Rincian Objek</label>
                            <input type="text" class="form-control" name="rincian_objek"
                                value="{{ old('rincian_objek', $list_opd->rincian_objek) }}" autocomplete="off" />
                        </div>
                    </div>

                    <div class="pl-lg-4 pr-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Sub Rincian Objek</label>
                            <input type="text" class="form-control" name="sub_rincian_objek"
                                value="{{ old('sub_rincian_objek', $list_opd->sub_rincian_objek) }}" autocomplete="off" />
                        </div>
                    </div>

                    <div class="pl-lg-4 pr-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Sub Sub Rincian Objek</label>
                            <input type="text" class="form-control" name="sub_sub_rincian_objek"
                                value="{{ old('sub_sub_rincian_objek', $list_opd->sub_sub_rincian_objek) }}"
                                autocomplete="off" />
                        </div>
                    </div>

                    <div class="pl-lg-4 pr-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Detail Rincian</label>
                            <textarea class="form-control" name="detail_rincian" rows="3" autocomplete="off">{{ old('detail_rincian', $list_opd->detail_rincian) }}</textarea>
                        </div>
                    </div>

                    <div class="pl-lg-4 pr-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Tarif</label>
                            <input type="number" step="0.01" class="form-control" name="tarif"
                                value="{{ old('tarif', $list_opd->tarif) }}" autocomplete="off" />
                        </div>
                    </div>

                    <div class="pl-lg-4 pr-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Satuan</label>
                            <input type="text" class="form-control" name="satuan"
                                value="{{ old('satuan', $list_opd->satuan) }}" autocomplete="off" required />
                        </div>
                    </div>

                    <div class="pl-lg-4 pr-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Status</label>
                            <input type="text" class="form-control" name="status"
                                value="{{ old('status', $list_opd->status) }}" autocomplete="off" required />
                        </div>
                    </div>

                    <div class="pl-lg-4 pr-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Link</label>
                            <input type="text" class="form-control" name="link"
                                value="{{ old('link', $list_opd->link) }}" autocomplete="off" />
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
