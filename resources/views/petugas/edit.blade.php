@extends('layouts.dashboard')

@section('title', 'Sunting Petugas')

@section('content')
<div class="row">
    <div class="col">
        <a href="{{ route('petugas.index') }}" class="btn btn-sm btn-neutral mb-3">
            <i class="fa fa-chevron-left"></i> Daftar Petugas
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
                <h3 class="mb-0">Sunting Petugas</h3>
            </div>

            <form action="{{ route('petugas.update', $petugas->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="pl-lg-4 pr-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Kode OPD</label>
                        <select name="kode_opd" class="form-control">
                            <option value="">-- Pilih Kode OPD --</option>
                            @foreach ($opds as $opd)
                                <option value="{{ $opd->id }}" {{ $petugas->opd->id == $opd->id ? 'selected' : '' }}>
                                    {{ $opd->kode }} - {{ $opd->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="pl-lg-4 pr-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Nama Pejabat</label>
                        <input type="text" class="form-control" name="nama_pejabat"
                            value="{{ old('nama_pejabat') ?? $petugas->nama }}">
                    </div>
                </div>
                <div class="pl-lg-4 pr-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">NIP Pejabat</label>
                        <input type="text" class="form-control" name="nip"
                            value="{{ old('nip') ?? $petugas->nip }}">
                    </div>
                </div>
                <div class="pl-lg-4 pr-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Jabatan</label>
                        <input type="text" class="form-control" name="jabatan"
                            value="{{ old('jabatan') ?? $petugas->jabatan }}">
                    </div>
                </div>
                <div class="pl-lg-4 pr-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Pangkat</label>
                        <input type="text" class="form-control" name="pangkat"
                            value="{{ old('pangkat') ?? $petugas->pangkat }}">
                    </div>
                </div>
                <div class="pl-lg-4 pr-lg-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="aktif" id="activeCheck"
                            {{ $petugas->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="activeCheck">
                          Aktif
                        </label>
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
