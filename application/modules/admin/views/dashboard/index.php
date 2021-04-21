<?php

// $this->load->model('admin/Admin_model', 'AM');

// for ($bulan = 1; $bulan < 13; $bulan++) {
//     $query = $this->AM->sumPayment($bulan, $tahun);
//     $jumlah_payment[] = count($query);
// }
?>

<script src=" https://cdn.jsdelivr.net/npm/chart.js@2.8.0"> </script>

<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?= $mapelDetail->nama_mapel; ?></h3>

                <p>Mapel Aktif</p>
            </div>
            <div class="icon">
                <i class="fa fa-graduation-cap"></i>
            </div>
            <a href="<?= base_url('admin/alumni') ?>" class="small-box-footer">Lihat Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?= count($simulasi) ?></h3>

                <p>Simulasi</p>
            </div>
            <div class="icon">
                <i class="fa fa-cubes"></i>
            </div>
            <a href="<?= base_url('admin/lowongan') ?>" class="small-box-footer">Lihat Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><?= count($user) ?></h3>

                <p>Peserta Keseluruhan</p>
            </div>
            <div class="icon">
                <i class="fa fa-newspaper-o"></i>
            </div>
            <a href="<?= base_url('admin/berita') ?>" class="small-box-footer">Lihat Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3><?= count($listAdmin) ?></h3>

                <p>Admin</p>
            </div>
            <div class="icon">
                <i class="fa fa-envelope"></i>
            </div>
            <a href="<?= base_url('admin/saran') ?>" class="small-box-footer">Lihat Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->



</div>
<!-- /.container-fluid -->


<div class="row">
    <div class="col-md-7">
        <div class="box">
            <div class="box-header">
                <div class="box-title">Mapel</div>
            </div>
            <div class="box-body">
                <?php include('mapel.php') ?>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Aktif</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <?php include('simulasi.php') ?>

            </div>
        </div>
    </div>

</div>