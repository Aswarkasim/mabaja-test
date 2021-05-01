<div class="jumbotron">
  <div class="container">
    <div class="row">
      <div class="offset-3 col-md-6">
        <div class="card">
          <div class="card-body">

            <center>
              <h4><b>Hasil Simulasi</b></h4>
            </center>


            <table class="table">

              <?php
              $id_user = $this->session->userdata('id_user');
              $this->load->model('home/Soal_model', 'SM');
              $rekap_member = $this->SM->getSimulasiUser($id_user, $id_simulasi);
              print_r($id_user);
              foreach ($rekap_member as $rm) { ?>
                <tr>
                  <td>Skor Kolom <?= $rm->urutan_kecermatan; ?> </td>
                  <td>: <?= $rm->nilai_akhir; ?></td>
                </tr>

              <?php } ?>

            </table>
            <?php if (count($kolom) < $urutan_kolom) { ?>
              <a href="<?= base_url('home') ?>" class="btn btn-primary btn-block">Selesai <i class="fa fa-check"></i></a>
            <?php } else { ?>
              <a href="<?= base_url('home/kecermatan/start/' . $id_simulasi . '/' . $urutan_kolom); ?>" class="btn btn-primary btn-block">Lanjutkan kolom <?= $urutan_kolom; ?> <i class="fa fa-arrow-right"></i></a>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>