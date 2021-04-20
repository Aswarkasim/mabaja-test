<div class="jumbotron">
  <div class="container">


    <div class="card">
      <div class="card-body">
        <div class="card-header">
          <h4>Sesi 1</h4>
        </div>
        <div class="row">
          <div class="col-md-12">
            <table class="table">
              <tr>
                <th>Soal</th>
                <th>Option</th>
              </tr>
              <?php $no = 1;
              for ($i = 0; $i < 6; $i++) {  ?>
                <tr>
                  <td><?= $no . '. WTQE'; ?></td>
                  <td>

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


                  </td>
                </tr>
              <?php $no++;
              } ?>
            </table>


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