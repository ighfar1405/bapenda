<div class="modal fade" tabindex="-1" role="dialog" id="lahanpertanian" data-backdrop="static">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Laporan Lahan pertanian</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form>
        @csrf
        <div class="modal-body">
            <div class="form-group">
                <label>Filter tahun sewa</label>
                <select class="form-control" id="tahun_sewa-s">
                    <option value="all">--- all ---</option>
                    @foreach($p_th as $row)
                        <option>{{ $row->tahun }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Kecamatan</label>
                <select class="form-control" id="kecamatan-s" name="kecamatan-s">
                <option value="all">------------ all ------------</option>
                @foreach($kecamatan as $row)
                    <option value="{{ $row->id }}">{{ $row->nama }}</option>
                @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Kelurahan</label>
                <select class="form-control" id="kelurahan-s" name="kelurahan-s"></select>
            </div>
            <div class="form-group">
                <label>Format laporan</label>
                <select class="form-control" id="format-s">
                    <option value="pdf">PDF</option>
                    <option value="xls">EXCEL</option>
                </select>
            </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary" onClick="cetakLahanPertanian()">Cetak</button>
        </div>
        </form>
    </div>
</div>
</div>
