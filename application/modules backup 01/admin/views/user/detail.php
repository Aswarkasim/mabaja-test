<!-- <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg') ?>"></div> -->
<div class="box">
  <div class="box-header">
    <h3 class="box-title"><strong> <?= $user->namalengkap; ?></strong></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">

    <div class="row">
      <div class="col-md-6">


        <table class="table">
          <tr>
            <td>Nama</td>
            <td>: <?= $user->namalengkap; ?></td>
          </tr>

          <tr>
            <td>Email</td>
            <td>: <?= $user->email; ?></td>
          </tr>

          <tr>
            <td>Tanggal lahir</td>
            <td>: <?= $user->tanggal_lahir; ?></td>
          </tr>

          <tr>
            <td>Gender</td>
            <td>: <?= $user->gender; ?></td>
          </tr>

          <tr>
            <td>No. Hp</td>
            <td>: <?= $user->nohp; ?></td>
          </tr>

          <tr>
            <td>Instagram</td>
            <td>: <?= $user->instagram; ?></td>
          </tr>

          <tr>
            <td>Facebook</td>
            <td>: <?= $user->facebook; ?></td>
          </tr>
          <tr>
            <td colspan="2">
              <img src="<?= $user->foto != '' ? base_url($user->foto) : base_url('assets/img/blank_image.jpg'); ?>" width="50%">
            </td>
          </tr>


        </table>

      </div>
      <div class="col-md-6">
        <h4><strong>Paket</strong></h4>
        <table class="table">
          <?php foreach ($member as $row) { ?>
            <tr>
              <td><?= $row->nama_paket; ?></td>
              <td><?= format_indo($row->aktif_sampai); ?></td>
            </tr>
          <?php } ?>
        </table>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>