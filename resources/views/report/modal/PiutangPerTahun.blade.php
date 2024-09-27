<div class="modal fade" tabindex="-1" role="dialog" id="piutangPerTahun">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Laporan Piutang Per Tahun</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Filter Tahun</label>
                <select class="form-control" id="pertahun-tahun">
                @foreach($perTahun as $th)
                    <option value="{{ $th->tahun }}">{{ $th->tahun }}</option>
                @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Format Laporan</label>
                <select class="form-control" id="pertahun-format">
                    <option value="pdf">PDF</option>
                    <option value="xls">EXCEL</option>
                </select>
            </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary" id="cetak-laporanPertahun">Cetak</button>
        </div>
      </div>
    </div>
  </div>
