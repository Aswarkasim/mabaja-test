<?php

$no_soal = $this->uri->segment('4');
$no_next = $no_soal + 1;

$link = 'home/kecermatan/submit/' . $soal->id_task . '/' . $no_next


//TO DO redirect kolom sebelah
?>
<div class="jumbotron">
  <div class="container">


    <div class="card">
      <div class="card-body">
        <center>
          <b>
            <?php if ($member->is_done == 0) { ?>
              <h3 id="waktu"></h3>
            <?php } ?>
          </b>
          <h4>KOLOM <?= $kolom->urutan; ?></h4>
          <h4>Soal nomor <?= $soal->no_soal; ?></h4>
          <br>
          <img src="<?= base_url($kolom->petunjuk); ?>" width="200px" alt="">
          <hr>
          <br>

          <?php if (($soal->gambar != '') && $soal->butir_soal == '') { ?>
            <img src="<?= base_url($soal->gambar); ?>" width="200px" alt="">
          <?php } else { ?>
            <h2><strong><?= $soal->butir_soal; ?></strong></h2>
          <?php } ?>

          <hr>
          <?php if ($member->is_done == 0) { ?>
            <a href="<?= base_url($link . '/A'); ?>" class="btn btn-outline-primary mr-2 ml-2">A</a>
            <a href="<?= base_url($link . '/B'); ?>" class="btn btn-outline-primary mr-2 ml-2">B</a>
            <a href="<?= base_url($link . '/C'); ?>" class="btn btn-outline-primary mr-2 ml-2">C</a>
            <a href="<?= base_url($link . '/D'); ?>" class="btn btn-outline-primary mr-2 ml-2">D</a>
            <a href="<?= base_url($link . '/E'); ?>" class="btn btn-outline-primary mr-2 ml-2">E</a>
          <?php } else { ?>
            <a href="<?= base_url('home/kecermatan/result/' . $member->id_member . '/' . $member->id_simulasi); ?>" class="btn btn-outline-primary">Lihat Hasil</a>
          <?php } ?>
        </center>
      </div>
    </div>

  </div>
</div>
<?php $urutan = $kolom->urutan + 1 ?>

<?php if ($member->is_done == 0) { ?>
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
      document.getElementById('waktu').innerHTML = pad(minutes) + ":" + pad(remainingSeconds);
      if (seconds <= 0) {
        clearInterval(countdownTimer);
        window.location = "<?= base_url('home/kecermatan/start/' . $kolom->id_simulasi . '/' . $urutan); ?>";
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
<?php } ?>