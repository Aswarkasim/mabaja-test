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
         <th>Total Skor</th>
         <th>Tindakan</th>
       </tr>
     </thead>
     <tbody>
       <?php
        //  TODO INI LAGI
        // ekstrak disini dari tabel tbl_resume_kecermatan
        //fungsi tambahkan dua angka di belakang
        $this->load->model('admin/Soal_model', 'SM');
        $this->load->model('admin/Kecermatan_model', 'KM');
        $no = 1;

        $memberKecermatan = $this->KM->listMember($simulasi->id_simulasi);
        foreach ($memberKecermatan as $row) {
          $skor = $this->KM->listSkorKecermatan($row->id_user, $row->id_simulasi);
        ?>

         <tr>
           <td><?= $no++; ?></td>
           <td>
             <!-- Button trigger modal -->
             <a href="" data-toggle="modal" data-target="#RekapJawabanPesertaKecermatan<?= $row->id_member; ?>">
               <b> <?= $row->namalengkap ?> </b>
             </a>
             <?php include('rekap_jawaban_kecermatan.php')    ?>

           </td>
           <td><?= $skor->total; ?></td>
           <td><a href="<?= base_url('admin/kecermatan/deleteMember/' . $row->id_member); ?>" class="btn btn-warning btn-sm tombol-reset"><i class="fa fa-refresh"></i> Ulangi ujian</a></td>


         </tr>
       <?php
        } ?>
     </tbody>
   </table>
 </div>