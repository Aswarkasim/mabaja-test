<?php $this->load->view('user/nav_top'); ?>

<div class="row">
  <div class="col-md-12">
    <table class="table">
      <thead>
        <th width="20px">No</th>
        <th>Mapel</th>
        <th>Simulasi</th>
        <th>Nilai</th>
      </thead>
      <tbody>
        <?php $no = 1;
        // print_r($riwayat);
        foreach ($riwayat as $row) {

          $this->load->model('user/User_model', 'UM');

          $skor = $this->UM->listSkorKecermatan($row->id_user, $row->id_simulasi);
          if ($row->id_kolom != "") {
            $kolom = $this->Crud_model->listingOne('tbl_kolom', 'id_kolom', $row->id_kolom);
          }
        ?>

          <tr>
            <td><?= $no++; ?></td>
            <td><?= $row->nama_mapel ?></td>
            <td><?php echo $row->nama_simulasi;
                if (isset($kolom)) {
                  echo  '<br> Kolom ' . $kolom->urutan;
                } ?></td>

            <?php
            // IF Kecermatan
            if ($row->id_mapel === 'RPIuQJc5') { ?>
              <td>
                <?= $skor->total; ?>
                <a href="<?= base_url('home/kecermatan/result/' . $row->id_simulasi); ?>" class="btn btn-primary btn-sm">Lihat Detail</a>
              </td>
            <?php } else { ?>
              <td><?= $row->nilai_akhir; ?></td>
          </tr>
      <?php  }
          } ?>
      </tbody>
    </table>
  </div>
</div>

<?php $this->load->view('user/nav_bottom'); ?>