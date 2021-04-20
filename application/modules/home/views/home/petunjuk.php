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

        <a href="<?= base_url('home/simulasi/start/' . $this->uri->segment('4')); ?>" class="btn btn-primary btn-block mb-3">Mulai <i class="fa fa-arrow-right"></i></a>
      </div>
    </div>

  </div>
</div>