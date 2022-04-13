<script type="text/javascript" src="<?= base_url('assets/js/timer/'); ?>jquery.min.js"></script>
<script type="text/javascript" src="<?= base_url('assets/js/timer/'); ?>jquery.timer.js"></script>

<script type="text/javascript">
  var seconds = <?php echo 11600; ?>;


  var timer = $.timer(
    function() {
      seconds--;


      var hr = Math.floor(seconds / (60 * 60));
      var min = Math.floor((seconds / 60) % 60);
      var sec = seconds % 60;

      <?php

      // $_session['hr'] = hr;
      // $_session['min'] = min;
      // $_session['sec'] = sec;

      ?>
      $('.count').html(hr + " : " + min + ":" + sec);



    },
    1000,
    true
  )


  if (timer < 0) {
    document.getElementById("waktu").innerHTML = "Waktu Habis!!";
    window.location = "<?= base_url('home/soal/resultTask/' . $task->id_task . '/' . $task->id_simulasi . '/' . $task->id_member) ?>";
  }
</script>

<div class="count">

</div>