<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#UbahThumnail">
  <i class="fa fa-camera"></i> Ubah Cover
</button>

<!-- Modal -->
<div class="modal fade" id="UbahThumnail" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Log</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <?= form_open_multipart(base_url('user/profil/ubahInstansi')) ?>
      <form action="" method="POST">

        <div class="modal-body">
          <div class="form-group">
            <label for="">Ubah Gambar</label>
            <input type="file" class="form-control" name="gambar">
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
      <?php form_close() ?>
    </div>
  </div>
</div>