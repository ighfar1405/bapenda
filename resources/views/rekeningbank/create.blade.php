@extends('layouts.dashboard')

@section('title', 'Tambah Rekening Bank')

@section('content')
<div class="row">
    <div class="col">
        <a href="{{ route('rekening.index') }}" class="btn btn-sm btn-neutral mb-3">
            <i class="fa fa-chevron-left"></i> Tambah Rekening Bank
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
                <h3 class="mb-0">Tambah Rekening Bank</h3>
            </div>

            <form action="{{ route('rekening.store') }}" method="POST">
                @csrf

                <div class="pl-lg-4 pr-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Nama Bank</label>
                        <input type="text" class="form-control" name="nama_bank" value="{{ old('nama_bank') }}" autocomplete="off">
                    </div>
                </div>

                <div class="pl-lg-4 pr-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">No Rekening</label>
                        <input type="text" class="form-control" name="no_rekening" value="{{ old('no_rekening') }}" autocomplete="off">
                    </div>
                </div>

                <div class="pl-lg-4 pr-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Rekening Bendahara</label>
                        <select name="akun_bendahara_id" class="form-control">
                            <option value="">Pilih Rekening Bendahara</option>
                            @foreach ($akun as $item)
                                <option value="{{ $item->id }}" @if (old('akun_bendahara_id') == $item->id)
                                    selected
                                @endif>{{ $item->kode }} {{ $item->nama }}</option>
                            @endforeach
                        </select>
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
@endsection