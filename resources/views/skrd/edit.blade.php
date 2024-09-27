@extends('layouts.dashboard')

@section('title', 'Sunting SKRD')

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
                <h3 class="mb-0">Sunting SKRD</h3>
            </div>

            <form action="{{ route('skrd.update', $skrd->id) }}" method="POST">
                @method('PUT')
                @csrf

                <div id="app">
                    <skrd-edit :list_object_retribusi="{{ $objectRetribusi }}"
                    :skrd="{{ $skrd }}" :list_tarif_retribusi="{{ $tarifRetribusi }}"></skrd-edit>
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

