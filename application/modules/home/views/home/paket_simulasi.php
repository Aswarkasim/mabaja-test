<div class="jumbotron bg-white" style="margin-bottom: 0dpx;">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="text-center">

          <?php if (isset($mapel)) { ?>
            <h3><b>Ujian <?= $mapel->nama_mapel; ?></b></h3>
          <?php } ?>
        </div>
      </div>
    </div>
    <div class="row">

      <!-- <div class="col-md-4 mt-2">
        <div class="card">
          <div class="card-body">
            <img src="<?= base_url('assets/img/blank_image.jpg'); ?>" width="100%" alt="">

            <a href="<?= base_url('home/home/kecermatan'); ?>" class="btn btn-primary btn-block mt-1">Buka</a>
          </div>
        </div>
      </div> -->

      <?php
      $link = '';
      // if kecermatan

      foreach ($simulasi as $row) { ?>

        <?php
        if ($row->id_mapel == 'RPIuQJc5') {
          $link = 'home/kecermatan/petunjuk/';
        } else {
          $link = 'home/simulasi/petunjuk/';
        }

        $id_user = $this->session->userdata('id_user');

        $this->load->model('home/Soal_model', 'SM');


        ?>

        <div class="col-md-4 mt-2">
          <div class="card">
            <div class="card-body">
              <img src="<?= base_url('assets/img/blank_image.jpg'); ?>" width="100%" alt="">
              <h6 class="mt-2"><strong><?= $row->nama_simulasi; ?></strong></h6>

              <?php
              $status = 'Buka';
              $member = $this->SM->getMemberSimulasiUserPaket($id_user, $row->id_simulasi, $row->id_paket);
              ?>
              <a href="<?= base_url($link . $row->id_simulasi); ?>" class="btn  mt-1 btn-block btn-primary
              <?php if (isset($member)) {
                if ($member->is_done == 1) {
                  echo 'btn-success';
                  $status = 'Selesai';
                }
              }  ?> 
             ">
                <?php if (isset($member)) {
                  if ($member->is_done == 1) {
                    echo '<i class="fa fa-check"></i>';
                  }
                }  ?>


                <?= $status; ?>
              </a>


            </div>
          </div>
        </div>

      <?php } ?>


    </div>
  </div>
</div>