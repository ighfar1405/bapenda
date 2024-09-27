@extends('layouts.dashboard')

@section('title', 'Tambah Jasa Umum')

@section('content')
<div class="row">
    <div class="col">
        <a href="{{ route('jasa_umum.index') }}" class="btn btn-sm btn-neutral mb-3">
            <i class="fa fa-chevron-left"></i> Daftar Jasa Umum
        </a>

        @include('shared.alert')

        <div class="card pb-4">
            <!-- Card header -->
            <div class="card-header border-0">
                <h3 class="mb-0">Tambah Jasa Umum</h3>
            </div>

            <form action="{{ route('jasa_umum.store') }}" method="POST">
                @csrf

                <div class="row pl-lg-4 pr-lg-4">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label">Nama Penyetor</label>
                            <input type="text" class="form-control" name="nama_penyetor"
                                value="{{ old('nama_penyetor') }}" autocomplete="off" required />
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label">No KTP</label>
                            <input type="text" class="form-control" name="no_ktp" maxlength="16" autocomplete="off"
                                required />
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-control-label">Objek setoran</label>
                            <input type="text" class="form-control" name="objek_setoran" maxlength="20"
                                autocomplete="off" value="{{ old('objek_setoran') }}" required />
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-control-label">Lokasi Objek</label>
                            <input type="text" class="form-control" name="lokasi_objek" maxlength="50"
                                autocomplete="off" value="{{ old('lokasi_objek') }}" required />
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-control-label">Jumlah Setoran</label>
                            <input type="number" id="jumlah_setoran" class="form-control" name="jumlah_setoran"
                                autocomplete="off" required />
                        </div>
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

</script>
@endsection