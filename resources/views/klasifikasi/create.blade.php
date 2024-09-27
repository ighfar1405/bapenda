@extends('layouts.dashboard')

@section('title', 'Tambah Klasifikasi Pemakaian')

@section('content')
<div class="row">
    <div class="col">
        <a href="{{ route('klasifikasi.index') }}" class="btn btn-sm btn-neutral mb-3">
            <i class="fa fa-chevron-left"></i> Daftar Klasifikasi Pemakaian
        </a>
        
        @include('shared.alert')

        <div class="card pb-4">
            <!-- Card header -->
            <div class="card-header border-0">
                <h3 class="mb-0">Tambah Klasifikasi Pemakaian</h3>
            </div>

            <form action="{{ route('klasifikasi.store') }}" method="POST">
                @csrf

                <div class="pl-lg-4 pr-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Jenis Klasifikasi</label>
                        <input type="text" class="form-control" name="jenis_klasifikasi" autocomplete="off"/>
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
