<div class="jumbotron bg-white" style="margin-bottom: 0dpx;">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="text-center">
          <h3><b>Ujian <?= $mapel->nama_mapel; ?></b></h3>
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
      if ($mapel->id_mapel == 'RPIuQJc5') {
        $link = 'home/kecermatan/petunjuk/';
      } else {
        $link = 'home/simulasi/petunjuk/';
      }
      foreach ($simulasi as $row) { ?>

        <div class="col-md-4 mt-2">
          <div class="card">
            <div class="card-body">
              <img src="<?= base_url('assets/img/blank_image.jpg'); ?>" width="100%" alt="">
              <h6 class="mt-2"><strong><?= $row->nama_simulasi; ?></strong></h6>

              <a href="<?= base_url($link . $row->id_simulasi); ?>" class="btn btn-primary btn-block mt-1">Buka</a>
            </div>
          </div>
        </div>

      <?php } ?>


    </div>
  </div>
</div>