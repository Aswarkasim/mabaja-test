<?php $this->load->view('user/nav_top'); ?>


<form action="<?= base_url('user/profil/edit'); ?>" method="post">
  <div class="row pt-5">
    <div class="col-md-12">
      <div class="form-group">
        <div class="row">
          <div class="col-md-3">
          </div>
          <div class="col-md-4">
            <?php echo validation_errors('<p class="alert alert-danger">', '</p>');
            if (isset($error)) {
              echo '<div class="alert alert-warning"><i class="fa fa-warning"></i> ';
              echo $error;
              echo '</div>';
            } ?>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-md-3">
            <label for="" class="pull-right">Nama</label>
          </div>
          <div class="col-md-4">
            <input type="text" class="form-control" name="namalengkap" required value="<?= $user->namalengkap; ?>" placeholder="Nama Lengkap">
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <div class="col-md-3">
            <label for="" class="pull-right">Gender</label>
          </div>
          <div class="col-md-4">
            <select name="gender" required class="form-control" id="">
              <option value="">--Gender--</option>
              <option value="Laki-laki" <?= $user->gender == 'Laki-laki' ? 'selected' : ''; ?>>Laki-laki</option>
              <option value="Perempuan" <?= $user->gender == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
            </select>
          </div>
        </div>
      </div>


      <div class="form-group">
        <div class="row">
          <div class="col-md-3">
            <label for="" class="pull-right">Tanggal Lahir</label>
          </div>
          <div class="col-md-4">
            <input type="date" class="form-control" required value="<?= $user->tanggal_lahir; ?>" name="tanggal_lahir">
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <div class="col-md-3">
            <label for="" class="pull-right">Handphone</label>
          </div>
          <div class="col-md-4">
            <input type="text" class="form-control" required value="<?= $user->nohp; ?>" name="nohp" placeholder="No. Hp.">
          </div>
        </div>
      </div>



      <div class="form-group">
        <div class="row">
          <div class="col-md-3">

          </div>
          <div class="col-md-4">
            <button type="submit" class="btn btn-md btn-primary">Simpan</button>
          </div>
        </div>
      </div>

    </div>

  </div>
</form>

<?php $this->load->view('user/nav_bottom'); ?>