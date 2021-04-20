<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#EditPetunjuk">
  <i class="fa fa-edit"></i> Edit Petunjuk
</button>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="EditPetunjuk" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Petunjuk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <?= form_open(base_url('admin/paket/editPetunjuk')) ?>
      <form action="" method="POST">

        <div class="modal-body">
          <div class="form-group">
            <label for="">Edit Petunjuk</label>
            <textarea name="petunjuk" class="form-control" id="editor1" cols="30" rows="10"><?= $paket->petunjuk; ?></textarea>
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
<script>
  $(function() {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
  })
</script>
<script src="<?= base_url('assets/js/'); ?>ckeditor/ckeditor.js"></script>