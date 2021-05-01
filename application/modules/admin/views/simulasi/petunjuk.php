 <div class="tab-pane" id="petunjuk">
   <?php include('edit_petunjuk.php') ?>

   <?php
    $link_active = '';
    if ($simulasi->id_mapel == 'RPIuQJc5') {
      $link_active = 'admin/kecermatan/is_active_kecermatan/';
    } else {
      $link_active = 'admin/simulasi/is_active/';
    }
    ?>


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
         <li><a href="<?= base_url($link_active . $simulasi->id_simulasi . '/1') ?>"><i class="fa fa-check"></i> Aktif</a></li>
       <?php } else { ?>
         <li><a href="<?= base_url($link_active . $simulasi->id_simulasi . '/0') ?>"><i class="fa fa-times"></i> Tidak Aktif</a></li>
       <?php } ?>
     </ul>
   </div>

   <h4><strong>Petunjuk Pengerjaan</strong></h4>
   <?= $simulasi->petunjuk; ?>
 </div>