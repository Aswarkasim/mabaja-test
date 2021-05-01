<div class="jumbotron">
  <div class="container-fluid">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-3 text-center">
                  <p>Waktu</p>
                  <?php if ($member->is_done == 0) {
                  ?>
                    <p id="waktu"></p>
                  <?php } else {
                    echo 'Waktu Habis!!';
                  }
                  ?>
                </div>

                <div class="col-md-3 text-center">
                  <p>Jumlah Soal</p>
                  <p><?= count($listSoal); ?></p>
                </div>

                <div class="col-md-3 text-center">
                  <p>Sudah dijawab</p>
                  <p><?= count($listSoal) - count($soalTerjawab); ?></p>
                </div>

                <div class="col-md-3 text-center">
                  <p>Belum dijawab</p>
                  <p><?= count($soalTerjawab); ?></p>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php if ($task != null) { ?>
      <form action="<?= base_url('home/soal/submit/' . $task->id_task); ?>" method="POST">
        <div class="row">
          <div class="col-md-8 p-4">
            <div class="card">
              <div class="card-body">
                <p><b>Soal Nomor <?= $soal->no_soal; ?></b></p>
                <p><?= $soal->butir_soal; ?></p>
                <?php
                $pilihan = $this->HM->listPilihan($task->id_soal);
                foreach ($pilihan as $row) {
                  $butir_pilihan = str_replace('<p>', '', $row->butir_pilihan);
                  $butir_fix = str_replace('</p>', '', $butir_pilihan);
                ?>
                  <div class="pl-4">

                    <input class="form-check-input" type="radio" id="pilihan<?= $row->id_pilihan; ?>" <?= $member->is_done == 1 ? 'disabled' : ''; ?> value="<?= $row->id_pilihan; ?>" <?= $row->id_pilihan == $task->id_pilihan ? 'checked' : '' ?> name="id_pilihan">
                    <label for="pilihan<?= $row->id_pilihan; ?>"><?= $row->anotasi . '. ' . $butir_fix ?></label>
                  </div>
                <?php
                } ?>

                <div class="float-right">

                  <?php
                  $next = $soal->no_soal + 1;
                  if ($member->is_done == 0) { ?>
                    <div class="btn-group" role="group" aria-label="Basic example">
                      <input type="submit" name="ragu" class="btn btn-warning" value="Ragu-ragu">
                      <input type="submit" name="selesai" class="btn btn-primary <?= $this->uri->segment(4) == $simulasi->jumlah_soal ? 'yakin-selesaikan' : ''; ?>" value="Selesai dan lanjutkan ">
                    </div>
                  <?php } else { ?>
                    <a href="<?= base_url('home/soal/butir/' . $next) ?>" class="btn btn-primary">Selanjutnya</a>
                  <?php } ?>

                </div>
              </div>
            </div>
          </div>

      </form>
    <?php } ?>

    <style>
      .nomor-soal {
        width: 50px;
        height: 50px;
        margin: 4px;
        color: white;
        /* background-color: #007bff; */
      }
    </style>

    <div class="col-md-4 p-4">
      <div class="card">
        <div class="card-body">
          <?php $no = 1;
          foreach ($listSoal as $row) { ?>
            <a href="<?= base_url('home/soal/butir/' . $row->no_soal) ?>" class="btn <?php if ($row->is_done == 'selesai') {
                                                                                        echo 'btn-primary';
                                                                                      } else if ($row->is_done == 'ragu') {
                                                                                        echo 'btn-warning';
                                                                                      } else {
                                                                                        echo 'btn-outline-primary text-dark';
                                                                                      } ?> nomor-soal"><?= $row->no_soal; ?></a>
          <?php $no++;
          } ?>
        </div>
      </div>
    </div>
  </div>
</div>
</div>







<?php if ($member->is_done == 0) {
?>
  <script>
    // Set the date we're counting down to
    var countDownDate = new Date("<?= $member->time_end; ?>").getTime();
    // var countDownDate = new Date("2020-12-19 13:50:00").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

      // Get today's date and time
      var asiaTime = new Date().toLocaleString("en-US", {
        timeZone: "Asia/Makassar"
      });
      var now = new Date(asiaTime).getTime();

      // Find the distance between now and the count down date
      var distance = countDownDate - now;
      //  var distance = now - countDownDate;

      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);


      // Display the result in the element with id="waktu"
      document.getElementById("waktu").innerHTML = hours + ":" + minutes + ":" + seconds;

      // If the count down is finished, write some text
      if (distance < 0) {
        clearInterval(x);
        document.getElementById("waktu").innerHTML = "Waktu Habis!!";
        window.location = "<?= base_url('home/soal/resultTask/' . $task->id_task . '/' . $task->id_simulasi . '/' . $task->id_member) ?>";
      }
    }, 1000);
  </script>
<?php }
?>