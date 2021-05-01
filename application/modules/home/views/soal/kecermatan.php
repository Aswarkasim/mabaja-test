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
            <h3 id="waktu"></h3>
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
      window.location = "<?= base_url('home/kecermatan/result/' . $member->id_member . '/' . $member->id_simulasi); ?>";
    }
  }, 1000);
</script>