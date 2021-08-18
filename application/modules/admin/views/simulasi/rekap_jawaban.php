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

        <!-- cek apakah mapel === cpns -->
        <?php if ($simulasi->id_mapel === 'c67PIBg8') { ?>

          <p>Skor TWK : <?= $row->nilai_twk; ?></p>
          <p>Skor TIU : <?= $row->nilai_tiu; ?></p>
          <p>Skor TKP : <?= $row->nilai_tkp; ?></p>
        <?php } ?>

        <p><b>Rincian</b></p>
        <div class="row">
          <?php

          $this->load->model('admin/Soal_model', 'SM');
          $task = $this->SM->pilihanTask($row->id_member);
          foreach ($task as $t) {
          ?>
            <!-- Mapel TKP -->
            <?php if ($simulasi->id_mapel == '45hTKPfdm') { ?>

              <div class="col-md-1">
                <div class="form-group">
                  <label for=""><i class="fa fa-check text-success"></i><?= $t->no_soal . ' ' . $t->anotasi; ?></label>
                </div>
              </div>
              <?php } else {
              if ($t->klasifikasi === 'TKP') {
              ?>
                <div class="col-md-1">
                  <div class="form-group">
                    <label for="">
                      <?= $t->no_soal  . $t->anotasi . ' = ' . $t->poin; ?></label>
                  </div>
                </div>
              <?php } else { ?>
                <div class="col-md-1">
                  <div class="form-group">
                    <label for=""><i class="<?= $t->jawaban_benar == $t->id_pilihan ? 'fa fa-check text-success' : 'fa fa-times text-danger'; ?>"></i><?= $t->no_soal . ' ' . $t->anotasi; ?></label>
                  </div>
                </div>


          <?php
              }
            }
          } ?>

        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>

    </div>
  </div>
</div>