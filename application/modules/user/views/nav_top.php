<div class="jumbotron">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="card">
          <div class="card-body">
            <img src="<?= base_url('assets/img/blank_image.jpg'); ?>" width="100%" class="" alt="">
            <h5 class="text-center mt-2"><b>Aswar Kasim</b></h5>
            <p class="text-center">No. Peserta : M0000</p>
          </div>
        </div>
      </div>
      <div class="col-md-9">
        <div class="card">
          <div class="card-body">

            <div class="container">

              <div class="row">

              </div>

              <div class="row">

                <div class="col-md-12">

                  <div class="buttons-tabs-centered">

                    <ul class="nav nav-tabs">

                      <li class="nav-link <?php if ($this->uri->segment('2') == 'riwayat') {
                                            echo 'active';
                                          } ?>">
                        <a href="<?= base_url('user/riwayat'); ?>" role="tab" class="control-item"><strong> Riwayat Simulasi</strong></a>
                      </li>


                      <li class="nav-link <?php if ($this->uri->segment('2') == 'profil') {
                                            echo 'active';
                                          } ?>">
                        <a href="<?= base_url('user/profil'); ?>" role="tab" class="control-item"><strong> Profil</strong></a>
                      </li>


                      <li class="nav-link <?php if ($this->uri->segment('2') == 'password') {
                                            echo 'active';
                                          } ?>">
                        <a href="<?= base_url('user/password') ?>" role="tab" class="control-item"><strong>Ubah Password</strong></a>
                      </li>

                    </ul>

                  </div>

                </div>

              </div>
            </div>