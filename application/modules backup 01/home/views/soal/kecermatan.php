<div class="jumbotron">
  <div class="container">


    <div class="card">
      <div class="card-body">
        <center>
          <b>
            <h3 id="waktu"></h3>
          </b>
          <h4>KOLOM 1</h4>
          <br>
          <img src="<?= base_url('assets/img/simbolpetunjuk.jpg'); ?>" width="200px" alt="">
          <hr>
          <br>
          <img src="<?= base_url('assets/img/simbolsoal.jpg'); ?>" width="200px" alt="">
          <hr>
          <a href="" class="btn btn-primary mr-2 ml-2">A</a>
          <a href="" class="btn btn-primary mr-2 ml-2">B</a>
          <a href="" class="btn btn-primary mr-2 ml-2">C</a>
          <a href="" class="btn btn-primary mr-2 ml-2">D</a>
          <a href="" class="btn btn-primary mr-2 ml-2">E</a>
        </center>
      </div>
    </div>

  </div>
</div>


<script>
  // Set the date we're counting down to
  var countDownDate = new Date("2021-04-28 13:43:47").getTime();
  // var countDownDate = new Date("2020-12-19 13:50:00").getTime();

  // Update the count down every 1 second
  var x = setInterval(function() {

    // Get today's date and time
    var now = new Date().getTime();

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
      window.location = "";
    }
  }, 1000);
</script>