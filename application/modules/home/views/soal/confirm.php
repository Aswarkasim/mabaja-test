<div class="jumbotron">
  <div class="container">
    <div class="row">
      <div class="offset-3 col-md-6">
        <div class="card">
          <div class="card-body">

            <center>
              <h3><b>Selesaikan?</b></h3>
              <p>Konfirmasi jawaban anda. Setelah tombol selesai diklik, anda tidak dapat mengulangi ujian</p>
            </center>

            <a href="<?= base_url('home/soal/resultTask/' . $id_task . '/' . $id_simulasi . '/' . $id_member); ?>" class="btn btn-primary btn-block yakin-selesaikan">Selesaikan <i class="fa fa-check"></i></a>
            <a href="<?= base_url('home/soal/butir/1'); ?>" class="btn btn-warning btn-block text-white"><i class="fa fa-arrow-left"></i> Kembali ke soal </a>


          </div>
        </div>
      </div>
    </div>
  </div>
</div>