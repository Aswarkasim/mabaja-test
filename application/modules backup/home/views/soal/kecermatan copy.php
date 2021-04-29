<div class="jumbotron">
  <div class="container">


    <div class="card">
      <div class="card-body">
        <div class="card-header">
          <h4>Sesi 1</h4>
        </div>
        <div class="row">
          <div class="col-md-8">
            <object data="<?= base_url('assets/uploads/dokumen/panduan_user_(2)9.pdf'); ?>" width="100%" height="500"></object>
          </div>
          <div class="col-md-4">
            <div style="height: 500px; overflow: auto;">
              <?php for ($i = 0; $i < 40; $i++) {  ?>


                <label for="optionA">A</label>
                <input type="radio" name="option" id="optionA">

                <label for="optionB">B</label>
                <input type="radio" name="option" id="optionB">

                <label for="optionC">C</label>
                <input type="radio" name="option" id="optionC">

                <label for="optionD">D</label>
                <input type="radio" name="option" id="optionD">

                <label for="optionE">E</label>
                <input type="radio" name="option" id="optionE">

                <br>
              <?php } ?>
            </div>


            <div class="float-right">
              <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-primary">Selesai dan lanjutkan <i class="fa fa-angle-right"></i></button>
              </div>
            </div>


          </div>

        </div>
      </div>
    </div>

  </div>
</div>