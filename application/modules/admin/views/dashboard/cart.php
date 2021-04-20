<div class="container">
  <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script type="text/javascript">
  var ctx = document.getElementById('myChart').getContext('2d');
  var chart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [
        <?php
        if (count($graph) > 0) {
          foreach ($graph as $data) {
            echo "'" . $data->provinsi . "',";
          }
        }
        ?>
      ],
      datasets: [{
        label: 'Jumlah Penduduk',
        backgroundColor: '#ADD8E6',
        borderColor: '#93C3D2',
        data: [
          <?php
          if (count($graph) > 0) {
            foreach ($graph as $data) {
              echo $data->jumlah . ", ";
            }
          }
          ?>
        ]
      }]
    },
  });
</script>