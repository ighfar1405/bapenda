@extends('layouts.dashboard')

@section('title', 'Sunting Pemakai WR')

@section('content')
<div class="row">
    <div class="col">
        <a href="{{ route('pemakai.index') }}" class="btn btn-sm btn-neutral mb-3">
            <i class="fa fa-chevron-left"></i> Daftar Pemakai
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
                <h3 class="mb-0">Sunting Pemakai WR</h3>
            </div>

            <form action="{{ route('pemakai.update', $pemakai->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="pl-lg-4 pr-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Nama</label>
                        <input type="text" class="form-control" name="nama"
                            value="{{ old('nama') ?? $pemakai->nama }}">
                    </div>
                </div>

                <div class="pl-lg-4 pr-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">NIK</label>
                        <input type="text" class="form-control" name="nik"
                            value="{{ old('nik') ?? $pemakai->nik }}">
                    </div>
                </div>
                <div id="app">
                    <wilayah-component
                        action="edit"
                        :kecamatan="{{ $kecamatan }}"
                        :list_kelurahan="{{ $kelurahan }}"
                        :kecamatan_id="{{ $pemakai->kelurahan->kecamatan->id }}"
                        :kelurahan_id="{{ $pemakai->kelurahan_id }}">
                    </wilayah-component>
                </div>
                <div class="pl-lg-4 pr-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Alamat</label>
                        <textarea name="alamat" class="form-control" cols="30" rows="4">{{ old('alamat') ?? $pemakai->alamat }}</textarea>
                    </div>
                </div>
                <div class="pl-lg-4 pr-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Telepon</label>
                        <input type="text" class="form-control" name="telepon"
                            value="{{ old('telepon') ?? $pemakai->no_telp }}">
                    </div>
                </div>
                <div class="pl-lg-4 pr-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Kode Arsip</label>
                        <input type="text" class="form-control" maxlength="9" name="kode_arsip"
                            value="{{ old('kode_arsip') ?? $pemakai->kode_arsip }}">
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

@section('js')
    <script src="{{ mix('js/app.js') }}"></script>
@endsection