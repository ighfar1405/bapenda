@extends('layouts.dashboard')

@section('title', 'Buat objek retribusi')

@section('content')
<div class="row">
    <div class="col">
        <a href="{{ route('objectretribusi.index') }}" class="btn btn-sm btn-neutral mb-3">
            <i class="fa fa-chevron-left"></i> Sunting objek retribusi
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
                <h3 class="mb-0">Sunting object retribusi</h3>
            </div>

            <form action="{{ route('objectretribusi.update', $objectRetribusi->id) }}" method="POST">
                @method('PUT')
                @csrf

                <div class="pl-lg-4 pr-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Kode Objek</label>
                        <input type="text" class="form-control" name="kode" value="{{ $objectRetribusi->kode }}">
                    </div>
                </div>

                <div id="app">
                    <wilayah-component action="edit" :kecamatan="{{ $kecamatan }}" :list_kelurahan="{{ $kelurahan }}"
                        :kecamatan_id="{{ $objectRetribusi->kelurahan->kecamatan->id }}" :kelurahan_id="{{ $objectRetribusi->kelurahan_id }}">
                    </wilayah-component>

                    <div class="pl-lg-4 pr-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Lokasi</label>
                            <input type="text" class="form-control" name="lokasi" value="{{ $objectRetribusi->lokasi }}">
                        </div>
                    </div>

                    <tarifretribusi-component :tarifretribusi="{{ $tarifRetribusi }}" action="edit" :klasifikasi_pemakaian="{{ $klasifikasiPemakaian }}"
                        :tarif_retribusi_id="{{ $objectRetribusi->tarif_retribusi_id }}" :detail_tarif_retribusi="{{ $objectRetribusi->tarifRetribusi }}"
                        :object_retribusi="{{ $objectRetribusi }}"></tarifretribusi-component>
                </div>

                <div class="pl-lg-4 pr-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Pemakai</label>
                        <select name="pemakai" class="form-control">
                            @foreach ($pemakai as $item)
                                <option value="{{ $item->id }}"
                                    {{ $item->id == $objectRetribusi->pemakai->id ? 'selected' : '' }}
                                    >{{ $item->nama }}</option>
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
    @include('shared.currency')
    <script src="{{ mix('js/app.js') }}"></script>
     <script>
        formatCurrency('tarif')
    </script>
@endsection