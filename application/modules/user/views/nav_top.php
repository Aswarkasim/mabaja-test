<?php

$id_user = $this->session->userdata('id_user');
$user = $this->Crud_model->listingOne('tbl_user', 'id_user', $id_user);

?>

<div class="jumbotron">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="card">
          <div class="card-body">
            <img src="<?= base_url($user->foto); ?>" width="100%" class="" alt="">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-block mt-2" data-toggle="modal" data-target="#exampleModal">
              <i class="fa fa-edit"></i> Ubah foto
            </button>

            <h5 class="text-center mt-2"><b><?= $user->namalengkap; ?></b></h5>
            <p class="text-center">No. Peserta : <?= $this->session->userdata('id_user'); ?></p>
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



            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Foto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <?= form_open_multipart('user/profil/ubahGambar') ?>
                  <form action="" method="POST">
                    <div class="modal-body">
                      <input type="file" name="foto" class="form-control">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </form>
                  <? form_close() ?>
                </div>
              </div>
            </div>