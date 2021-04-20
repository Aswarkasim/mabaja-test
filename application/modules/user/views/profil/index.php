<?php $this->load->view('user/nav_top'); ?>
<div class="">

  <div class="container">
    <style>
      td {
        padding-bottom: 10px;
        padding-top: 10px;
      }
    </style>
    <strong>
      <table>
        <tr>
          <td width="150px" align="left">Nama</td>
          <td>: <?= $profil->namalengkap; ?></td>
        </tr>

        <tr>
          <td align="left">Jenis Kelamin</td>
          <td>: <?= $profil->gender; ?></td>
        </tr>

        <tr>
          <td align="left">Tanggal Lahir</td>
          <td>: <?= $profil->tanggal_lahir; ?></td>
        </tr>

        <tr>
          <td align="left">Handphone</td>
          <td>: <?= $profil->nohp; ?></td>
        </tr>


      </table>
      <a href="<?= base_url('user/pribadi/edit'); ?>" class="btn btn-md btn-primary"><i class="fa fa-edit"></i> Edit</a>
    </strong>

  </div>
</div>

<?php $this->load->view('user/nav_bottom'); ?>