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

          <div class="text-center">
            <h4><b>Resume Hasil Pengerjaan</b></h4>

            <table class="table">
              <tr>
                <td>Kolom</td>
                <td>Total</td>
                <td>Kesalahan</td>
                <td>Jawaban Benar</td>
                <td>Xn-X(n-1)</td>
                <td>Skor Kestabilan</td>
              </tr>

              <?php $resume = $this->KM->listResumeKecermatan($row->id_user, $row->id_simulasi);
              $total_jawaban_all = 0;
              $total_salah_all = 0;
              $total_benar_all = 0;
              $total_xn_all = 0;
              $total_kestabilan_all = 0;
              foreach ($resume as $r) { ?>

                <tr>
                  <td><?= $r->urutan_kolom; ?></td>
                  <td><?= $r->total_jawab; ?></td>
                  <td><?= $r->kesalahan; ?></td>
                  <td><?= $r->benar; ?></td>
                  <td><?= $r->xn_selisih; ?></td>
                  <td><?= $r->skor_kestabilan; ?></td>
                </tr>

              <?php
                $total_jawaban_all = $total_jawaban_all + $r->total_jawab;
                $total_salah_all = $total_salah_all + $r->kesalahan;
                $total_benar_all = $total_benar_all + $r->benar;
                $total_xn_all = $total_xn_all + $r->xn_selisih;
                $total_kestabilan_all = $total_kestabilan_all + $r->skor_kestabilan;
              } ?>

              <tr>
                <td>Total</td>
                <td><?= $total_jawaban_all; ?></td>
                <td><?= $total_salah_all; ?></td>
                <td><?= $total_benar_all; ?></td>
                <td><?= $total_xn_all; ?></td>
                <td><?= $total_kestabilan_all; ?></td>
              </tr>

            </table>

            <br>
            <hr>
            <b> Faktor Penilaian</b>
            <?php $skor = $this->KM->listSkorKecermatan($row->id_user, $row->id_simulasi);

            ?>
            <table class="table">
              <tr>
                <td>Kecepatan</td>
                <td><?= $skor->kecepatan; ?></td>
                <td>0.40</td>
                <td><?= $proporsi_kecepatan = $skor->kecepatan * 0.4; ?></td>
              </tr>

              <tr>
                <td>Ketelitian</td>
                <td><?= $skor->ketelitian; ?></td>
                <td>0.20</td>
                <td><?= $proporsi_ketelitian =  $skor->ketelitian * 0.20; ?></td>
              </tr>

              <tr>
                <td>Kestabilan</td>
                <td><?= $skor->kestabilan; ?></td>
                <td>0.30</td>
                <td><?= $proporsi_kestabilan = $skor->kestabilan * 0.30; ?></td>
              </tr>

              <tr>
                <td>Ketahanan</td>
                <td><?= $skor->ketahanan; ?></td>
                <td>0.30</td>
                <td><?= $proporsi_ketahanan = $skor->ketahanan * 0.10; ?></td>
              </tr>

              <tr>
                <td><b></b> Total</td>
                <td><?= $skor->kecepatan + $skor->ketelitian + $skor->kestabilan + $skor->ketahanan; ?></td>
                <td>1.00</td>
                <td><?= $proporsi_kecepatan + $proporsi_ketelitian + $proporsi_kestabilan + $proporsi_ketahanan; ?></td>
              </tr>

            </table>

            <hr>
            <br>
          </div>


        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>

    </div>
  </div>
</div>