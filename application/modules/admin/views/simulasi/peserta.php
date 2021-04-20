 <div class="tab-pane" id="peserta">
   <table class="table DataTable">
     <thead>
       <tr>
         <th width="40px">No</th>
         <th>Nama Simulasi</th>
         <th>Status</th>
       </tr>
     </thead>
     <tbody>
       <?php $no = 1;
        foreach ($member as $row) { ?>
         <tr>
           <td><?= $no++; ?></td>
           <td>
             <!-- Button trigger modal -->
             <a href="" data-toggle="modal" data-target="#RekapJawabanPeserta<?= $row->id_member; ?>">
               <b> <?= $row->namalengkap ?> </b>
             </a>

           </td>
           <td>
             <?php if ($row->is_done == 1) { ?>
               <span class="label label-success"><i class="fa fa-check"></i> Selesai</span>
             <?php } else { ?>
               <span class="label label-warning"><i class="fa fa-spinner"></i> Draft</span>
             <?php } ?>
           </td>
         </tr>
         <?php include('rekap_jawaban.php') ?>
       <?php } ?>
     </tbody>
   </table>
 </div>