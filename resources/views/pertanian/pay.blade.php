@extends('layouts.dashboard')

@section('title', 'Perbaharui Sewa Properti')

@section('content')
<div class="row">
    <div class="col">
        <a href="{{ route('pertanian.index') }}" class="btn btn-sm btn-neutral mb-3">
            <i class="fa fa-chevron-left"></i> Daftar Sewa Properti
        </a>

        @include('shared.alert')

        <div class="card pb-4">
            <!-- Card header -->
            <div class="card-header border-0">
                <h3 class="mb-0">Pembayaran Sewa Properti</h3>
            </div>

            <form action="{{ route('pertanian.bayar.act') }}" method="POST">
                @csrf
                <input type="hidden" name="itemPay" value="{{ $dt->id }}" />
                <div class="pl-lg-4 pr-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Nama Penyewa</label>
                        <input type="text" class="form-control" value="{{ $dt->nama_penyewa }}" readonly />
                    </div>
                </div>

                <div class="pl-lg-4 pr-lg-4">
                    <div class="form-group">
                        <label>Nomor bukti bayar</label>
                        <input type="text" class="form-control" name="no_bukti" placeholder="kombinasi huruf / angka"
                        value="{{ $dt->no_bukti_bayar }}" maxlength="20" required />
                    </div>
                </div>

                <div class="row pl-lg-4 pr-lg-4">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label">Nominal Bayar</label>
                            <input type="number" class="form-control numeric" id="bayar" name="bayar" min="0" max="{{ $dt->sisa_bayar }}" placeholder="Sisa harus dibayar {{ number_format($dt->sisa_bayar,0,'.', ',') }}" required />
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label">Tarif</label>
                            <input type="hidden" value="{{ $dt->nominal }}" />
                            <input type="text" class="form-control text-left" value="
                            {{ number_format($dt->nominal,0,'.', ',') }}" name="tarif" readonly />
                        </div>
                    </div>
                </div>

                <div class="pl-lg-4 pr-lg-4">
                    <div class="form-group">
                        <label>Tanggal bayar</label>
                        <input type="date" class="form-control" value="{{ date('Y-m-d',strtotime('now')) }}" name="tgl_bayar" required />
                    </div>
                </div>

                <div class="pl-lg-4 pr-lg-4">
                    <div class="form-group">
                        <label>Metode pembayaran</label>
                        <select class="form-control" name="jenis_bayar" required >
                            <option>TUNAI</option>
                            <option>TRANSFER</option>
                        </select>
                    </div>
                </div>
                <div class="pl-lg-4 pr-lg-4">
                    <div class="form-group">
                        <label>Sisa pembayaran</label>
                        <input type="text" id="sisa" class="form-control" readonly />
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
<script>
const sisa = {{ $dt->sisa_bayar }};

$('#sisa').val(sisa.toLocaleString());

$('#bayar').on('change',function(e){

    let _fill = Number(sisa) - Number(e.target.value)

    $('#sisa').val(_fill.toLocaleString());
});
</script>
@endsection

