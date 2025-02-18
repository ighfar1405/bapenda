@extends('layouts.dashboard')

@section('title', 'Buat objek retribusi')

@section('content')
<div class="row">
    <div class="col">
        <a href="{{ route('objectretribusi.index') }}" class="btn btn-sm btn-neutral mb-3">
            <i class="fa fa-chevron-left"></i> Buat objek retribusi
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
                <h3 class="mb-0">Buat object retribusi</h3>
            </div>

            <form action="{{ route('objectretribusi.store') }}" method="POST">
                @csrf

                <div class="pl-lg-4 pr-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Kode Objek</label>
                        <input type="text" class="form-control" name="kode">
                    </div>
                </div>

                <div id="app">
                    <wilayah-component :kecamatan="{{ $kecamatan }}"></wilayah-component>
                    
                    <div class="pl-lg-4 pr-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Lokasi</label>
                            <input type="text" class="form-control" name="lokasi">
                        </div>
                    </div>

                    <tarifretribusi-component :tarifretribusi="{{ $tarifRetribusi }}"></tarifretribusi-component>
                </div>


                <div class="pl-lg-4 pr-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Pemakai</label>
                        <select name="pemakai" class="form-control">
                            @foreach ($pemakai as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
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
    <script src="{{ mix('js/app.js') }}"></script>
@endsection