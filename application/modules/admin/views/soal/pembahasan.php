    <div class="form-group">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#UploadPembahasan">
        Pembahasan
      </button>

    </div>


    <!-- Modal -->
    <div class="modal fade" id="UploadPembahasan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <?= form_open_multipart('admin/soal/pembahasan/' . $soal->id_soal) ?>
          <form method="post">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Pembahasan</h5>
            </div>
            <div class="modal-body">
              <input class="form-control" type="file" name="pembahasan" id="">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Upload</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
          <?= form_close() ?>
        </div>
      </div>
    </div>