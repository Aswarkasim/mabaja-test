<span id="countdown" class="timer"></span>
<br>
<form action="<?= base_url('home/timer/submit'); ?>" method="post">
  <input type="text" name="number" id="number">
  <button type="submit">Submit</button>
</form>

<?= 89.8333 * 60 ?>

<script>
  var dataMinute = 90;
  var upgradeTime = dataMinute * 60;
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
    document.getElementById('countdown').innerHTML = pad(hours) + ":" + pad(minutes) + ":" + pad(remainingSeconds);
    if (seconds == 0) {
      clearInterval(countdownTimer);
      document.getElementById('countdown').innerHTML = "Completed";
    } else {
      seconds--;
    }
  }
  var countdownTimer = setInterval('timer()', 1000);


  var timeleft = upgradeTime;
  var downloadTimer = setInterval(function() {
    document.getElementById("number").value = timeleft
    timeleft -= 1;
  }, 1000);
</script>