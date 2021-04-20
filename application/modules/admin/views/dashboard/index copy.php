<?php

$this->load->model('admin/Admin_model', 'AM');

$label = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

for ($bulan = 1; $bulan < 13; $bulan++) {
    $query = $this->AM->penjualan($bulan);
    $jumlah_produk[] = $query->jumlah;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Membuat Grafik Menggunakan Chart JS</title>
    <script src=" https://cdn.jsdelivr.net/npm/chart.js@2.8.0"> </script>
    <script type=" text/javascript" src="Chart.js">
    </script>
</head>

<body>
    <div style="width: 800px;height: 800px">
        <canvas id="myChart"></canvas>
    </div>


    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($label); ?>,
                datasets: [{
                    label: 'Grafik Penjualan',
                    data: <?php echo json_encode($jumlah_produk); ?>,
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
</body>

</html>