<?php $this->load->view('user/nav'); ?>


<div class="">

  <div class="container">
    <div class="form-group">
      <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-6">
          <?= validation_errors('<div class="alert alert-danger"><i class="fa fa-warning"></i>', '</div>'); ?>
        </div>
      </div>
    </div>

    <form action="<?= base_url('user/pribadi/edit') ?>" method="POST">
      <div class="form-group">
        <div class="row">
          <div class="col-md-2">
            <label for="" class="pull-right">Nama</label>
          </div>
          <div class="col-md-6">
            <input type="text" class="form-control" value="<?= $alumni->namalengkap; ?>" name="namalengkap" id="">
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <div class="col-md-2">
            <label for="" class="pull-right">Gender</label>
          </div>
          <div class="col-md-6">
            <select name="gender" class="form-control" id="">
              <option value="">--Gender--</option>
              <option value="Laki-laki" <?php if ($alumni->gender == "Laki-laki") {
                                          echo 'selected';
                                        } ?>>Laki-laki</option>
              <option value="Perempuan" <?php if ($alumni->gender == "Perempuan") {
                                          echo 'selected';
                                        } ?>>Perempuan</option>
            </select>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <div class="col-md-2">
            <label for="" class="pull-right">Tempat Lahir</label>
          </div>
          <div class="col-md-6">
            <input type="text" class="form-control" name="tempat_lahir" value="<?= $alumni->tempat_lahir; ?>" id="">
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <div class="col-md-2">
            <label for="" class="pull-right">Tanggal Lahir</label>
          </div>
          <div class="col-md-6">
            <input type="date" class="form-control" name="tanggal_lahir" value="<?= $alumni->tanggal_lahir; ?>" id="">
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <div class="col-md-2">
            <label for="" class="pull-right">Handphone</label>
          </div>
          <div class="col-md-6">
            <input type="number" class="form-control" value="<?= $alumni->nohp; ?>" name="nohp" id="">
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <div class="col-md-2">
            <label for="" class="pull-right">Email</label>
          </div>
          <div class="col-md-6">
            <input type="text" class="form-control" value="<?= $alumni->email; ?>" name="email" id="">
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <div class="col-md-2">
            <label for="" class="pull-right">Profesional</label>
          </div>
          <div class="col-md-6">
            <input type="text" class="form-control" name="pekerjaan" value="<?= $alumni->pekerjaan; ?>" id="">
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <div class="col-md-2">
            <label for="" class="pull-right">Kategori Pekerjaan</label>
          </div>
          <div class="col-md-6">
            <select name="id_kategori_pekerjaan" class="form-control" id="">
              <option value="">-- Kategori Pekerjaan --</option>
              <?php foreach ($kategori_pekerjaan as $row) { ?>
                <option value="<?= $row->id_kategori_pekerjaan; ?>" <?= $row->id_kategori_pekerjaan == $alumni->id_kategori_pekerjaan ? 'selected' : '' ?>><?= $row->nama_kategori_pekerjaan; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
      </div>


      <div class="form-group">
        <div class="row">
          <div class="col-md-2">
            <label for="" class="pull-right">Penghasilan Awal</label>
          </div>
          <div class="col-md-6">
            <input type="text" class="form-control" name="penghasilan" value="<?= $alumni->penghasilan; ?>" id="">
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <div class="col-md-2">
            <label for="" class="pull-right">Penghasilan Sekarang</label>
          </div>
          <div class="col-md-6">
            <input type="text" class="form-control" name="penghasilan_sekarang" value="<?= $alumni->penghasilan_sekarang; ?>" id="">
          </div>
        </div>
      </div>


      <div class="form-group">
        <div class="row">
          <div class="col-md-2">
          </div>
          <div class="col-md-6">
            <a href="<?= base_url('user/pribadi'); ?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </div>
    </form>

  </div>
</div>