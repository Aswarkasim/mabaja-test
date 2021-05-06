 <table class="table DataTable">
   <thead>
     <tr>
       <th width="40px">No</th>
       <th>Nama Kelas</th>
       <th>Mapel</th>
       <th>Aktifkan</th>
     </tr>
   </thead>
   <tbody id="targetData">
     <?php $no = 1;

      foreach ($kelas as $row) {
      ?>
       <tr>
         <td><?= $no ?></td>
         <td><a href="<?= base_url('admin/user/index/' . $row->id_kelas); ?>"><b><?= $row->nama_kelas ?></b></a></td>
         <td>
           <div class="btn-group">
             <button type="button" class="btn btn-success"><i class="fa fa-check"></i> <?= $row->nama_mapel; ?></button>
             <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
               <span class="caret"></span>
               <span class="sr-only">Toggle Dropdown</span>
             </button>

             <ul class="dropdown-menu" role="menu">
               <li><a href="<?= base_url('admin/kelas/cheangeMapel/'  . $row->id_kelas) ?>"><i class="fa fa-check"></i> Kosongkan</a></li>
               <?php foreach ($mapel as $m) { ?>
                 <li><a href="<?= base_url('admin/kelas/cheangeMapel/' . $row->id_kelas . '/' . $m->id_mapel) ?>"> <?= $m->nama_mapel; ?></a></li>
               <?php } ?>
             </ul>
           </div>
         </td>
         <td>
           <div class="btn-group">
             <?php if ($row->is_active == 1) { ?>
               <button type="button" class="btn btn-success"><i class="fa fa-check"></i> Tes Hari Ini</button>
             <?php } else { ?>
               <button type="button" class="btn btn-danger"><i class="fa fa-times"></i> Kelas Tidak Aktif</button>
             <?php } ?>
             <button type="button" class="btn <?php if ($row->is_active == 1) {
                                                echo 'btn-success';
                                              } else {
                                                echo "btn-danger";
                                              } ?> dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
               <span class="caret"></span>
               <span class="sr-only">Toggle Dropdown</span>
             </button>


             <ul class="dropdown-menu" role="menu">
               <?php if ($row->is_active == 0) { ?>
                 <li><a href="<?= base_url('admin/kelas/is_active/1/' . $row->id_kelas) ?>"><i class="fa fa-check"></i> Aktif</a></li>
               <?php } else { ?>
                 <li><a href="<?= base_url('admin/kelas/is_active/0/' . $row->id_kelas) ?>"><i class="fa fa-times"></i> Tidak Aktif</a></li>
               <?php } ?>
             </ul>
           </div>

         </td>

       </tr>
     <?php $no++;
      } ?>
   </tbody>
 </table>