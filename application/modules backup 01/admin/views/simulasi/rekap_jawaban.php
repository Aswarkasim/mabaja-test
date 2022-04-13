<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="RekapJawabanPeserta<?= $row->id_member; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><?= $row->namalengkap; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div class="modal-body">
        <div class="row">
          <?php

          $this->load->model('admin/Soal_model', 'SM');
          $task = $this->SM->pilihanTask($row->id_member);
          foreach ($task as $t) { ?>

            <div class="col-md-1">
              <div class="form-group">
                <label for=""><i class="<?= $t->jawaban_benar == $t->id_pilihan ? 'fa fa-check text-success' : 'fa fa-times text-danger'; ?>"></i><?= $t->no_soal . ' ' . $t->anotasi; ?></label>
              </div>
            </div>


          <?php
          } ?>

        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>

    </div>
  </div>
</div>