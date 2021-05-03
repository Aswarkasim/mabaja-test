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
              // print_r($id_user);
              foreach ($rekap_member as $rm) { ?>
                <tr>
                  <td>Skor Kolom <?= $rm->urutan_kecermatan; ?> </td>
                  <td>: <?= $rm->nilai_akhir; ?></td>
                </tr>

              <?php } ?>

            </table>
            <a href="<?= base_url('home') ?>" class="btn btn-primary btn-block">Selesai <i class="fa fa-check"></i></a>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>