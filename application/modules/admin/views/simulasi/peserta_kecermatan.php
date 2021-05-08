 <div class="active tab-pane" id="peserta">
   <p>
   <div class="btn-group">
     <button type="button" class="btn btn-danger"><i class="fa fa-warning"></i> Reset Perkelas</button>
     <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
       <span class="caret"></span>
       <span class="sr-only">Toggle Dropdown</span>
     </button>

     <ul class="dropdown-menu" role="menu">
       <?php foreach ($kelas as $k) { ?>
         <li><a href="<?= base_url('admin/simulasi/resetKelas/' . $simulasi->id_simulasi . '/' . $k->id_kelas) ?>" class="tombol-reset"> <?= $k->nama_kelas; ?></a></li>
       <?php } ?>
     </ul>
   </div>
   </p>

   <table class="table DataTable">
     <thead>
       <tr>
         <th width="40px">No</th>
         <th>Nama Simulasi</th>
         <th>Skor</th>
         <th>Status</th>
         <th>Tindakan</th>
       </tr>
     </thead>
     <tbody>
       <?php
        $this->load->model('admin/Soal_model', 'SM');
        $no = 1;
        foreach ($member as $row) {
          if ($row->urutan_kecermatan == 1) { ?>
           <tr>
             <td><?= $no++; ?></td>
             <td>
               <!-- Button trigger modal -->
               <a href="" data-toggle="modal" data-target="#RekapJawabanPesertaKecermatan<?= $row->id_member; ?>">
                 <b> <?= $row->namalengkap ?> </b>
               </a>

             </td>
             <td>
               <?php
                $task = $this->SM->detailHasilMemberKecermatan($row->id_user, $row->id_simulasi);
                foreach ($task as $t) {
                  echo $t->nilai_akhir . ', ';
                } ?>
             </td>
             <td>
               <?php if ($row->is_done == 1) { ?>
                 <span class="label label-success"><i class="fa fa-check"></i> Selesai</span>
               <?php } else { ?>
                 <span class="label label-warning"><i class="fa fa-spinner"></i> Proses</span>
               <?php } ?>
             </td>
             <td><a href="<?= base_url('admin/kecermatan/deleteMember/' . $row->id_member); ?>" class="btn btn-warning btn-sm tombol-reset"><i class="fa fa-refresh"></i> Ulangi ujian</a></td>
           </tr>
           <?php include('rekap_jawaban_kecermatan.php')
            ?>
       <?php }
        } ?>
     </tbody>
   </table>
 </div>