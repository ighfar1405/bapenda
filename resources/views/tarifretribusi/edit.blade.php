@extends('layouts.dashboard')

@section('title', 'Sunting Tarif Retribusi')

@section('content')
<div class="row">
    <div class="col">
        <a href="{{ route('tarifretribusi.index') }}" class="btn btn-sm btn-neutral mb-3">
            <i class="fa fa-chevron-left"></i> Sunting tarif retribusi
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
                <h3 class="mb-0">Sunting tarif retribusi</h3>
            </div>

            <form action="{{ route('tarifretribusi.update', $tarifRetribusi->id) }}" method="POST">
                @method('PUT')
                @csrf

                <div class="pl-lg-4 pr-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Kelas</label>
                        <input type="text" class="form-control" name="kelas" value="{{ $tarifRetribusi->kelas }}">
                    </div>
                </div>

                 <div class="pl-lg-4 pr-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Golongan</label>
                        <input type="text" class="form-control" name="golongan" value="{{ $tarifRetribusi->golongan }}">
                    </div>
                </div>

                 <div class="pl-lg-4 pr-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Range NJOP</label>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" name="range_njop" value="{{ $tarifRetribusi->range_njop }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pl-lg-4 pr-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Kode tarif</label>
                        <input type="text" class="form-control" name="kode_tarif" value="{{ $tarifRetribusi->kode_tarif }}">
                    </div>
                </div>

                <div class="pl-lg-4 pr-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Klasifikasi pemakaian</label>
                        <select name="klasifikasi_pemakaian" class="form-control">
                            @foreach ($klasifikasiPemakaian as $item)
                                <option value="{{ $item->id }}"
                                    {{ $item->id == $tarifRetribusi->klasifikasi_pemakaian_id ? 'selected' : '' }}
                                    >{{ $item->jenis_klasifikasi }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="pl-lg-4 pr-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Tarif M2</label>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" id="tarifm" name="tarif_meter" value="{{ $tarifRetribusi->tarif_meter }}">
                            </div>
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
@section('js')
    @include('shared.currency')
    <script>
        formatCurrency('tarifm')
    </script>
@endsection