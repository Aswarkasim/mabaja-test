<?php

$this->load->model('admin/Admin_model', 'AM');

for ($bulan = 1; $bulan < 13; $bulan++) {
    $query = $this->AM->sumPayment($bulan, $tahun);
    $jumlah_payment[] = count($query);
}
?>

<script src=" https://cdn.jsdelivr.net/npm/chart.js@2.8.0"> </script>

<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?= 'Rp. ' . nominal($penghasilanTahunan); ?></h3>

                <p>Penghasilan</p>
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
                <h3><?= nominal($penjualanTahunan); ?></h3>

                <p>Penjualan</p>
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
                <h3><?= 'Rp. ' . nominal($persenan); ?></h3>

                <p>Rekap 10%</p>
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
                <h3>23</h3>

                <p>Saran</p>
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
    <div class="col-md-8">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Grafik</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <div style="width: 100%;">
                    <canvas id="myChart"></canvas>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Rekap Bulanan</h3>
            </div>
            <div class="box-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Bulan</th>
                            <th>Penghasilan</th>
                            <th>10%</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($label as $key => $value) {
                            $penghasilan = $this->AM->sumPenghasilanBulanan($key + 1, $tahun);
                            $persenan = $penghasilan->totalPenghasilan * 10 / 100;
                        ?>
                            <tr>
                                <td><?= $value; ?></td>
                                <td><?= 'Rp. ' . nominal($penghasilan->totalPenghasilan) ?></td>
                                <td><?= 'Rp. ' . nominal($persenan); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($label); ?>,
            datasets: [{
                label: 'Grafik Penjualan',
                backgroundColor: '#ADD8E6',
                borderColor: '#93C3D2',
                data: <?php echo json_encode($jumlah_payment); ?>,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>