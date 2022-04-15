<div class="jumbotron">
  <div class="container">
    <div class="row">
      <div class="offset-3 col-md-6">
        <div class="card">
          <div class="card-body">

<?php 
$this->load->model('home/Home_model', 'HM');
 ?>

            <center>
              <h4><b>Hasil Simulasi</b></h4>
            </center>

            <!-- Cek mapel kepribadian -->
            <?php if ($simulasi->id_mapel = "mrHXIR2D") { ?>
              <table class="table">


                <tr>
                  <td>Skor </td>
                  <td>: <?= $poin ?></td>
                </tr>

              </table>

            <?php } else { ?>
              <table class="table">


                <tr>
                  <td>Jumlah Soal </td>
                  <td>: <?= $simulasi->jumlah_soal; ?></td>
                </tr>

                <tr>
                  <td>Jawaban Benar </td>
                  <td>: <?= $benar; ?></td>
                </tr>

                <tr>
                  <td>Jawaban Salah </td>
                  <td>: <?= $simulasi->jumlah_soal - $benar; ?></td>
                </tr>

                <!-- <tr>
                <td>Nilai </td>
                <td>: 83</td>
              </tr> -->

              </table>
            <?php } ?>

            <a href="<?= base_url('home/paket/' . $simulasi->id_paket); ?>" class="btn btn-primary btn-block">Selesai <i class="fa fa-check"></i></a>


          </div>
        </div>
      </div>
    </div>
  </div>
</div>