<div class="modal fade" tabindex="-1" role="dialog" id="harianObjekRetribusi">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Laporan Harian Objek Retribusi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('report.harian_objek_retribusi') }}" method="POST">
					@csrf
					<div class="modal-body">
            <div class="form-group">
							<label>Tanggal Awal</label>
							<input
								type="date"
								data-date=""
								data-date-format="DD MMMM YYYY"
								value=""
                name="tanggal_awal"
                required
								class="form-control datePicker">
            </div>
            <div class="form-group">
							<label>Tanggal Akhir</label>
							<input
								type="date"
								data-date=""
								data-date-format="DD MMMM YYYY"
								value=""
                name="tanggal_akhir"
								class="form-control datePicker">
            </div>
            {{-- <div class="form-group">
            	<label>Jenis Pembayaran</label>
              <select name="jenis_pembayaran" class="form-control">
								<option value="" selected>Semua Jenis Pembayaran</option>
								@foreach ($jenisPembayaran as $item)
									<option value="{{ $item->kode_jurnal }}">{{ $item->kode_jurnal }}</option>
								@endforeach
              </select>
            </div> --}}
          </div>
          <div class="modal-footer bg-whitesmoke br">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Cetak</button>
          </div>
        </form>
      </div>
    </div>
  </div>