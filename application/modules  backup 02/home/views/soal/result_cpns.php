<div class="jumbotron">
  <div class="container">
    <div class="row">
      <div class="offset-3 col-md-6">
        <div class="card">
          <div class="card-body">



            <center>
              <h4><b>Hasil Simulasi</b></h4>
            </center>

            <!-- Cek mapel kepribadian -->
            <?php if ($simulasi->id_mapel = "mrHXIR2D") { ?>
              <table class="table">


                <tr>
                  <td><span class="<?= $poin['twk'] < 65 ? 'text-danger' : 'text-success' ?>"><b>TWK</b></span> </td>
                  <td>
                    : <span class="<?= $poin['twk'] < 65 ? 'text-danger' : 'text-success' ?>"><b><?= $poin['twk'] ?></b></span>
                  </td>
                </tr>

                <tr>
                  <td><span class="<?= $poin['tiu'] < 80 ? 'text-danger' : 'text-success' ?>"><b>TIU</b></span> </td>
                  <td>
                    : <span class="<?= $poin['tiu'] < 80 ? 'text-danger' : 'text-success' ?>"><b><?= $poin['tiu'] ?></b></span>
                  </td>
                </tr>

                <tr>
                  <td><span class="<?= $poin['tkp'] < 165 ? 'text-danger' : 'text-success' ?>"><b>TKP</b></span> </td>
                  <td>
                    : <span class="<?= $poin['tkp'] < 166 ? 'text-danger' : 'text-success' ?>"><b><?= $poin['tkp'] ?></b></span>
                  </td>
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

            <a href="<?= base_url('home'); ?>" class="btn btn-primary btn-block">Selesai <i class="fa fa-check"></i></a>


          </div>
        </div>
      </div>
    </div>
  </div>
</div>