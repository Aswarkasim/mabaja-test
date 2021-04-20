<div class="active tab-pane" id="deskripsi">

  <div class="post">

    <!-- Is Pembahasan -->
    <div class="btn-group">
      <?php if ($simulasi->is_active == 1) { ?>
        <button type="button" class="btn btn-success"><i class="fa fa-check"></i> Simulasi Aktif</button>
      <?php } else { ?>
        <button type="button" class="btn btn-danger"><i class="fa fa-times"></i> Simulasi Tidak Aktif</button>
      <?php } ?>
      <button type="button" class="btn <?php if ($simulasi->is_active == 1) {
                                          echo 'btn-success';
                                        } else {
                                          echo "btn-danger";
                                        } ?> dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
      </button>


      <ul class="dropdown-menu" role="menu">
        <?php if ($simulasi->is_active == 0) { ?>
          <li><a href="<?= base_url('admin/simulasi/is_active/' . $simulasi->id_simulasi . '/1') ?>"><i class="fa fa-check"></i> Aktif</a></li>
        <?php } else { ?>
          <li><a href="<?= base_url('admin/simulasi/is_active/' . $simulasi->id_simulasi . '/0') ?>"><i class="fa fa-times"></i> Tidak Aktif</a></li>
        <?php } ?>
      </ul>
    </div>





    <h4><strong><?= $simulasi->nama_simulasi; ?></strong></h4>
    <?= $simulasi->deskripsi; ?>
    <hr>

  </div>

</div>