@extends('layouts.dashboard')

@section('title', 'Buat SKRD')

@section('content')
<div class="row">
    <div class="col">
        <a href="{{ route('skrd.index') }}" class="btn btn-sm btn-neutral mb-3">
            <i class="fa fa-chevron-left"></i> Daftar SKRD
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
                <h3 class="mb-0">Buat SKRD</h3>
            </div>

            <form action="{{ route('skrd.store') }}" method="POST">
                @csrf

                <div id="app">
                    <skrd-create :list_tarif_retribusi="{{ $tarifRetribusi }}" :list_objek_retribusi="{{ $objectRetribusi }}"></skrd-create>
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

