<div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg') ?>"></div>
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Manajemen Soal</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">

    <p>
      <a href="<?= base_url($add) ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah</a>
    </p>
    <?php echo 'ID PAKET' . $this->session->userdata('id_paket'); ?>
    <div class="table-responsive">
      <table class="table DataTable">
        <thead>
          <tr>
            <th width="40px">No Soal</th>
            <!-- <th width="100%">Butir</th> -->
            <th>Status</th>
            <th width="60px">Tindakan</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($soal as $row) { ?>
            <tr>
              <td> <a href="<?= base_url('admin/soal/detail/' . $row->id_soal); ?>" class="btn btn-primary"> <?= $row->no_soal; ?></a></td>
              <!-- <td><a href="<?= base_url('admin/soal/detail/' . $row->id_soal); ?>"><strong><?= character_limiter($row->butir_soal, '50') ?></strong></a></td> -->
              <td>
                <?php if ($row->is_done == 1) { ?>
                  <span class="label label-success"><i class="fa fa-check"></i> Selesai</span>
                <?php } else { ?>
                  <span class="label label-warning"><i class="fa fa-spinner"></i> Draft</span>
                <?php } ?>
              </td>
              <td><a href="<?= base_url('admin/soal/deleteSoal/' . $row->id_soal); ?>" class="btn btn-danger btn-xs tombol-hapus"><i class="fa fa-times"></i></a></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>

    </div>
  </div>
  <!-- /.box-body -->
</div>