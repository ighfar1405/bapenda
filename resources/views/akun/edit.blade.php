@extends('layouts.dashboard')

@section('title', 'Ubah Akun')

@section('content')
<div class="row">
    <div class="col">
        <a href="{{ route('akun.index') }}" class="btn btn-sm btn-neutral mb-3">
            <i class="fa fa-chevron-left"></i> Ubah Akun
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
                <h3 class="mb-0">Ubah Akun</h3>
            </div>

            <form action="{{ route('akun.update', ['id' => $akun->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="pl-lg-4 pr-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Kode Akun</label>
                        <input type="text" class="form-control" name="kode" value="{{ $akun->kode }}" autocomplete="off">
                    </div>
                </div>

                <div class="pl-lg-4 pr-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Nama Akun</label>
                        <input type="text" class="form-control" name="nama" value="{{ $akun->nama }}" autocomplete="off">
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