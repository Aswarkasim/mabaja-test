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
        foreach ($riwayat as $row) {
          if ($row->id_kolom != "") {
            $kolom = $this->Crud_model->listingOne('tbl_kolom', 'id_kolom', $row->id_kolom);
          }
        ?>

          <tr>
            <td><?= $no++; ?></td>
            <td><?= $row->nama_mapel ?></td>
            <td><?php echo $row->nama_simulasi;
                if ($kolom != null) {
                  echo  '<br> Kolom ' . $kolom->urutan;
                } ?></td>
            <td><?= $row->nilai_akhir; ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<?php $this->load->view('user/nav_bottom'); ?>