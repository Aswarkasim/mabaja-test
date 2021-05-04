<div class="jumbotron">
  <div class="container">
    <div class="row">
      <div class="offset-2 col-md-8">
        <div class="card">
          <div class="card-body">

            <div class="container">
              <canvas id="myChart"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
$id_user = $this->session->userdata('id_user');
$this->load->model('home/Soal_model', 'SM');
$rekap_member = $this->SM->getSimulasiUser($id_user, $id_simulasi);

?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script type="text/javascript">
  var ctx = document.getElementById('myChart').getContext('2d');
  var chart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [
        <?php
        if (count($rekap_member) > 0) {
          foreach ($rekap_member as $rm) {
            echo "'" . "Kolom " . $rm->urutan_kecermatan . "',";
          }
        }
        ?>
      ],
      datasets: [{
        label: 'Skor',
        backgroundColor: '#ADD8E6',
        borderColor: '#93C3D2',
        data: [
          <?php
          if (count($rekap_member) > 0) {
            foreach ($rekap_member as $rm) {
              echo $rm->nilai_akhir . ", ";
            }
          }
          ?>
        ]
      }]
    },
  });
</script>