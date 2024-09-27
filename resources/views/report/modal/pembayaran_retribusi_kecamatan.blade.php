<div class="modal fade" tabindex="-1" role="dialog" id="pembayaranRetribusi">
<div class="modal-dialog" role="document">
		<div class="modal-content">
		<div class="modal-header">
				<h5 class="modal-title">Laporan Pembayaran Retribusi Per Kecamatan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
		</div>
		<form action="{{ route('report.pembayaran_retribusi_kecamatan') }}" method="POST">
			@csrf
			<div class="modal-body">
				<div class="form-group">
					<label>Pilih Tahun</label>
					<select name="tahun" class="form-control" required>
						@foreach ($tahun as $item)
							<option value="{{ $item->tahun }}">{{ $item->tahun }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="modal-footer bg-whitesmoke br">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
				<button type="submit" class="btn btn-primary">Cetak</button>
			</div>
		</form>
		</div>
</div>
</div>