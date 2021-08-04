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

<?php $member = $this->Crud_model->listingOne('tbl_member', 'id_member', $id_member) ?>
<script>
  var upgradeTime = <?= $member->waktu - 1; ?>;
  var seconds = upgradeTime;



  var id_member = '<?= $id_member; ?>'
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