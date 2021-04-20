<section class="content">

  <div class="row">
    <div class="col-md-3">

      <!-- Profile Image -->
      <div class="box box-primary">
        <div class="box-body box-profile">
          <img class="" width="100%" src="<?= base_url($simulasi->cover) ?>" alt="User profile picture">

          <br><br>
          <?php include('ubah_thumbnail.php') ?>

          <ul class="list-group list-group-unbordered">
            <?php include('edit.php') ?>
            <h4>
              <strong><?= $simulasi->nama_simulasi; ?></strong>
            </h4>
            <li class="list-group-item">
              <b>Jumlah Soal</b> <a class="pull-right"><?= $simulasi->jumlah_soal ?></a>
            </li>
            <li class="list-group-item">
              <b>Waktu Pengerjaan</b> <a class="pull-right"><?= $simulasi->waktu . ' Menit' ?></a>
            </li>


          </ul>

          <a href="<?= base_url('admin/soal') ?>" class="btn btn-primary btn-block"><i class="fa fa-list"></i> Manajemen Soal</a>


        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#petunjuk" data-toggle="tab">Petunjuk</a></li>
          <li><a href="#peserta" data-toggle="tab">Peserta</a></li>
        </ul>
        <div class="tab-content">
          <?php
          include('petunjuk.php');
          include('peserta.php');
          ?>
          <!-- /.tab-pane -->

          <!-- /.tab-pane -->


          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

</section>