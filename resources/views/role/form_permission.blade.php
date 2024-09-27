@extends('layouts.dashboard')

@section('title', 'Hak Akses')

@section('content')
<div class="row">

    <div class="col">

        <a href="{{ route('role.index') }}" class="btn btn-sm btn-neutral mb-3">
            <i class="fa fa-chevron-left"></i> Kembali
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

        @if ($message = session('success'))
            <div class="alert alert-success alert-dismissable fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                {{ $message }}
            </div>
        @endif

        <div class="card pb-4">
            <!-- Card header -->
            <div class="card-header border-0">
                <h3 class="mb-0">Pengaturan Hak Akses</h3>
            </div>

            <form action="{{ route('role.sync_permission', $role->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="pl-lg-4 pr-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Nama Role</label>
                        <input type="text" class="form-control" name="nama"
                            value="{{ $role->name }}" readonly>
                    </div>
                </div>

                <div class="pl-lg-4 pr-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Permissions</label>
                        @foreach ($permissions->chunk(4) as $value)
                            @foreach ($value as $permission)
                                <div class="form-check ml-4">
                                    <input class="form-check-input" type="checkbox"
                                        name="permissions[]"
                                        id="permission-{{ $permission->id }}}}"
                                        value="{{ $permission->name }}"
                                        {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="{{ $permission->id }}}}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach
                            <br>
                        @endforeach
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
