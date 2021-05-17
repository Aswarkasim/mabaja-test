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
                  <?php //if ($member->is_done == 0) {
                  ?>
                  <p id="waktu"></p>
                  <?php //} else {
                  //echo 'Waktu Habis!!';
                  // }
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

    <?php

    ?>

    <?php if ($task != null) { ?>
      <form action="<?= base_url('home/soal/submit/' . $task->id_task); ?>" class="swa-confirm" data-flag="0" method="POST">
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
                  if ($member->is_done == 0) {

                  ?>
                    <div class="btn-group" role="group" aria-label="Basic example">
                      <input type="submit" name="ragu" class="btn btn-warning" value="Ragu-ragu">
                      <input type="submit" name="selesai" class="btn btn-primary" value="Selesai dan lanjutkan ">
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
    <!-- <button id="prty_form_save" type="button" onclick="return testalert();">SAVE</button> -->
    <style>
      .nomor-soal {
        width: 50px;
        height: 50px;
        margin: 4px;
        color: white;
        /* background-color: #007bff; */
      }
    </style>

    <div class="col-md-4 p-4" style="height: 400px; overflow: auto;">
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




<?php //if ($member->is_done == 0) {
?>
<script>
  // var dataMinute = ;
  var upgradeTime = <?= $member->waktu - 1; ?>;
  var seconds = upgradeTime;

  function timer() {
    var days = Math.floor(seconds / 24 / 60 / 60);
    var hoursLeft = Math.floor((seconds) - (days * 86400));
    var hours = Math.floor(hoursLeft / 3600);
    var minutesLeft = Math.floor((hoursLeft) - (hours * 3600));
    var minutes = Math.floor(minutesLeft / 60);
    var remainingSeconds = seconds % 60;

    function pad(n) {
      return (n < 10 ? "0" + n : n);
    }
    document.getElementById('waktu').innerHTML = pad(hours) + ":" + pad(minutes) + ":" + pad(remainingSeconds);
    if (seconds <= 0) {
      clearInterval(countdownTimer);
      document.getElementById('waktu').innerHTML = 'Waktu Habis!!'
      window.location = "<?= base_url('home/soal/resultTask/' . $task->id_task . '/' . $task->id_simulasi . '/' . $task->id_member) ?>";
    } else {
      seconds--;
    }
  }
  var countdownTimer = setInterval('timer()', 1000);

  var id_member = '<?= $member->id_member; ?>'
  var timeleft = upgradeTime;
  var downloadTimer = setInterval(function() {
    // document.getElementById("number").value = timeleft
    saveTime(id_member, timeleft)
    timeleft -= 1;
  }, 1000);



  function saveTime(id_member, timeleft) {
    var id = id_member
    $.ajax({
      type: 'POST',
      data: 'id_member=' + id + '&waktu=' + timeleft,
      url: '<?= base_url('home/kecermatan/saveTimer'); ?>',
      dataType: 'json'
    })
  }
</script>
<?php // }
?>