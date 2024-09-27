<div class="modal fade" tabindex="-1" role="dialog" id="wajibRetribusi">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Laporan Wajib Retribusi Per Kecamatan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('report.wr_kecamatan') }}" method="POST">
					@csrf
					<div class="modal-body">
            <div class="form-group">
              <label>Kecamatan</label>
              <select name="kecamatan" class="form-control" required>
									<option value="" selected readonly>--Pilih Kecamatan--</option>
									@foreach ($kecamatan as $item)
										<option value="{{ $item->id }}">
											{{ $item->nama }} ({{ $item->kode_administratif }})
										</option>
									@endforeach
              </select>
            </div>
            <div class="form-group">
            	<label>Pilih Tahun</label>
              <select name="tahun" class="form-control" required>
								@foreach ($tahun as $item)
                  <option value="{{ $item->tahun }}">{{ $item->tahun }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
            	<label>Status Bayar</label>
              <select name="status" class="form-control">
                <option value="">Sudah/Belum Bayar</option>
                <option value="1">Sudah Bayar</option>
                <option value="2">Belum Bayar</option>
              </select>
            </div>
          </div>
          <div class="modal-footer bg-whitesmoke br">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" formtarget="_blank" class="btn btn-primary">Cetak</button>
          </div>
        </form>
      </div>
    </div>
  </div>
