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
        foreach ($riwayat as $row) { ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= $row->nama_mapel; ?></td>
            <td><?= $row->nama_simulasi; ?></td>
            <td><?= $row->nilai_akhir; ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<?php $this->load->view('user/nav_bottom'); ?>