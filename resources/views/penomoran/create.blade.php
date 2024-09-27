@extends('layouts.dashboard')

@section('title', 'Buat Penomoran')

@section('content')
<div class="row">
    <div class="col">
        <a href="{{ route('penomoran.index') }}" class="btn btn-sm btn-neutral mb-3">
            <i class="fa fa-chevron-left"></i> Daftar Penomoran
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
                <h3 class="mb-0">Buat Penomoran</h3>
            </div>

            <form action="{{ route('penomoran.store') }}" method="POST">
                @csrf

                <div class="pl-lg-4 pr-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Formulir</label>
                        <select name="formulir" class="form-control">
                            <option value="">Pilih Formulir</option>
                            @foreach ($formulir as $item)
                                <option value="{{ $item }}">{{ ucfirst($item) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="pl-lg-4 pr-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Format Penomoran</label>
                        <input type="text" class="form-control" name="format_penomoran"
                            value="{{ old('format_penomoran') }}">
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
