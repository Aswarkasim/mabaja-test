<div class="content-wrapper bg-white" style="margin-bottom: 0dpx;">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="text-center">
          <h3><b>Petunjuk</b></h3>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <p>
          <?= $simulasi->petunjuk; ?>
        </p>
        <!-- Sekarang buat functionnya -->
        <?php if ($simulasi->id_mapel == 'RPIuQJc5') { ?>
          <a href="<?= base_url('home/kecermatan/index/' . $this->uri->segment('4')); ?>" class="btn btn-primary btn-block mb-3">Mulai <i class="fa fa-arrow-right"></i></a>
        <?php } else { ?>
          <a href="<?= base_url('home/simulasi/start/' . $this->uri->segment('4')); ?>" class="btn btn-primary btn-block mb-3">Mulai <i class="fa fa-arrow-right"></i></a>
        <?php } ?>
      </div>
    </div>

  </div>
</div>