@extends('layouts.dashboard')

@section('title', 'Tambah Tanaman')

@section('content')
<div class="row">
    <div class="col">
        <a href="{{ route('tanaman.index') }}" class="btn btn-sm btn-neutral mb-3">
            <i class="fa fa-chevron-left"></i> Daftar Tanaman
        </a>

        @include('shared.alert')

        <div class="card pb-4">
            <!-- Card header -->
            <div class="card-header border-0">
                <h3 class="mb-0">Tambah Tanaman

                </h3>
            </div>

            <form action="{{ route('tanaman.store') }}" method="POST">
                @csrf

                <div class="row pl-lg-4 pr-lg-4">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label">Nama Tanaman</label>
                            <input type="text" class="form-control" name="nama"
                                value="{{ old('nama') }}" autocomplete="off" required />
                        </div>
                    </div>
               
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-control-label">Tarif</label>
                            <input type="text" class="form-control" name="tarif" maxlength="20"
                                autocomplete="off" value="{{ old('tarif') }}" required />
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

@section('scripts')
<script type="text/javascript">

</script>
@endsection