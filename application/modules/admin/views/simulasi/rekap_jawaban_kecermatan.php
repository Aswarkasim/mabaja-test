<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="RekapJawabanPesertaKecermatan<?= $row->id_member; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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

          $task = $this->SM->detailHasilMemberKecermatan($row->id_user, $row->id_simulasi);

          foreach ($task as $t) { ?>

            <p style="margin-left: 20px;"><?= 'Kolom ' . $t->urutan_kecermatan . ' : ' . $t->nilai_akhir; ?></p>

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