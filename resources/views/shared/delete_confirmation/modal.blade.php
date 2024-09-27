{{-- delete modal --}}
<div id="DeleteModal" class="modal fade text-danger" role="dialog">
    <div class="modal-dialog ">
      <!-- Modal content-->
      <form action="" id="deleteForm" method="post">
          <div class="modal-content">
              <div class="modal-header bg-secondary">
                  <h4 class="modal-title text-dark text-center">Yakin akan menghapus data?</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                  @csrf
                  @method('DELETE')
                  <h3>PERINGATAN! Data yang berhubungan akan terhapus, setelah data dihapus, maka data tidak akan bisa dikembalikan. Apakah anda yakin?</h3>
              </div>
              <div class="modal-footer">
                  <center>
                      <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-sm btn-danger" data-dismiss="modal" onclick="formSubmit()">Ya, Hapus</button>
                  </center>
              </div>
          </div>
      </form>
    </div>
</div>