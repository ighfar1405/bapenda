@extends('layouts.dashboard')

@section('title', 'Sunting TBP')

@section('content')
<div id="app" class="row">
    <div class="col">
        <a href="{{ route('tbp.index') }}" class="btn btn-sm btn-neutral mb-3">
            <i class="fa fa-chevron-left"></i> Daftar TBP
        </a>

        @include('shared.alert')

        <div class="card pb-4">
            <!-- Card header -->
            <div class="card-header border-0">
                <h3 class="mb-0">Sunting TBP</h3>
            </div>

            <form action="{{ route('tbp.update', $tbp->id) }}" method="POST">
                @csrf
                @method('PUT')

                <tbp-edit
                    :tbp="{{ $tbp }}"
                    :rekeningbank="{{ $rekeningBank }}"
                    :jenispembayaran="{{ $jenisPembayaran }}">
                </tbp-edit>

                <div class="text-right pr-lg-4 mt-4">
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