<div class="modal fade" id="salinSkrdModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Salin SKRD</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('salinskrd.store') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <h4>Tahun</h4>
                    <select name="tahun" class="form-control" required>
                        <option value="" selected>Pilih tahun</option>
                        @foreach ($tahun as $item)
                            <option value="{{ $item->tahun }}">{{ $item->tahun }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <h4>Nama Kecamatan</h4>
                    <select name="kecamatan" class="form-control" required>
                        <option value="" selected>Pilih kecamatan</option>
                        @foreach ($kecamatan as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Salin Sekarang</button>
            </div>
        </form>
        </div>
    </div>
</div>