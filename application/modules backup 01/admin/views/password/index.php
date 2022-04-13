 <div class="row">
   <div class="col-md-6">
     <div class="box">
       <div class="box-header">
         <h3 class="box-title">Ubah Password</h3>
       </div>
       <!-- /.box-header -->
       <div class="box-body">

         <form action="<?= base_url('admin/konfigurasi/password'); ?>" method="post">
           <div class="row">
             <div class="col-md-12">
               <div class="form-group">
                 <div class="row">
                   <div class="col-md-3">
                   </div>
                   <div class="col-md-7">
                     <?php echo validation_errors('<p class="alert alert-danger">', '</p>');
                      if (isset($error)) {
                        echo '<div class="alert alert-warning"><i class="fa fa-warning"></i> ';
                        echo $error;
                        echo '</div>';
                      } ?>
                   </div>
                 </div>
               </div>
               <div class="form-group">
                 <div class="row">
                   <div class="col-md-3">
                     <label for="" class="pull-right">Password Lama</label>
                   </div>
                   <div class="col-md-7">
                     <input type="password" class="form-control" name="password_lama" placeholder="Password">
                   </div>
                 </div>
               </div>

               <div class="form-group">
                 <div class="row">
                   <div class="col-md-3">
                     <label for="" class="pull-right">Password</label>
                   </div>
                   <div class="col-md-7">
                     <input type="password" class="form-control" name="password" placeholder="Password">
                   </div>
                 </div>
               </div>

               <div class="form-group">
                 <div class="row">
                   <div class="col-md-3">
                     <label for="" class="pull-right">Retype Password</label>
                   </div>
                   <div class="col-md-7">
                     <input type="password" class="form-control" name="re_password" placeholder="Ketik ulang password">
                   </div>
                 </div>
               </div>

               <div class="form-group">
                 <div class="row">
                   <div class="col-md-3">

                   </div>
                   <div class="col-md-7">
                     <button type="submit" class="btn btn-md btn-primary">Simpan</button>
                   </div>
                 </div>
               </div>

             </div>

           </div>
         </form>

       </div>
     </div>
   </div>
 </div>