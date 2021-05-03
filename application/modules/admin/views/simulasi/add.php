 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 <script src="http://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>


 <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg') ?>"></div>

 <div class="row">
     <div class="col-md-6">
         <div class="box">
             <div class="box-header">
                 <h3 class="box-title"><?= $title ?></h3>
             </div>
             <!-- /.box-header -->
             <div class="box-body">

                 <?php
                    echo validation_errors('<div class="alert alert-warning"><i class="fa fa-warning"></i> ', '</div>');
                    if (isset($error)) {
                        echo '<div class="alert alert-warning"><i class="fa fa-warning"></i> ' . $error . '</div>';
                    }

                    echo form_open_multipart($add);
                    ?>



                 <form action="" method="post">

                     <input type="hidden" name="id_mapel" value="<?= $this->uri->segment(4) ?>">

                     <div class="form-group">
                         <div class="row">
                             <div class="col-md-3">
                                 <label for="" class="pull-right">Nama Simulasi</label>
                             </div>
                             <div class="col-md-9">
                                 <input type="text" name="nama_simulasi" required placeholder="Nama Simulasi" value="<?= set_value('nama_simulasi') ?>" class="form-control">
                             </div>
                         </div>
                     </div>

                     <div class="form-group">
                         <div class="row">
                             <div class="col-md-3">
                                 <label for="" class="pull-right">Waktu</label>
                             </div>
                             <div class="col-md-6">
                                 <input type="number" name="waktu" required placeholder="Dalam Menit" value="<?= set_value('waktu') ?>" class="form-control">
                             </div>
                         </div>
                     </div>


                     <!-- Cek apakah id_mapel == kecermatan -->
                     <?php $id_mapel = $this->uri->segment(4);
                        if ($id_mapel == 'RPIuQJc5') { ?>
                         <div class="form-group">
                             <div class="row">
                                 <div class="col-md-3">
                                     <label for="" class="pull-right">Jumlah Kolom</label>
                                 </div>
                                 <div class="col-md-6">
                                     <input type="number" name="jumlah_kolom" required placeholder="Jumlah Sesi" value="<?= set_value('jumlah_kolom') ?>" class="form-control">
                                 </div>
                             </div>
                         </div>

                         <?php } else {
                            if ($id_mapel == 'mrHXIR2D') {
                            ?>
                             <div class="form-group">
                                 <div class="row">
                                     <div class="col-md-3">
                                         <label for="" class="pull-right">Type Option</label>
                                     </div>
                                     <div class="col-md-6">
                                         <select name="type_option" required class="form-control" id="">
                                             <option value="">-- Type Option --</option>
                                             <option value="B">A-B</option>
                                             <option value="D">A-D</option>
                                             <option value="E">A-E</option>
                                         </select>
                                     </div>
                                 </div>
                             </div>

                         <?php } ?>

                         <div class="form-group">
                             <div class="row">
                                 <div class="col-md-3">
                                     <label for="" class="pull-right">Jumlah Soal</label>
                                 </div>
                                 <div class="col-md-6">
                                     <input type="number" name="jumlah_soal" required placeholder="Jumlah Soal" value="<?= set_value('jumlah_soal') ?>" class="form-control">
                                 </div>
                             </div>
                         </div>




                     <?php } ?>


                     <div class="form-group">
                         <div class="row">
                             <div class="col-md-3">
                                 <label for="" class="pull-right">Cover</label>
                             </div>
                             <div class="col-md-9">
                                 <input type="file" name="cover" placeholder="Harga" value="<?= set_value('cover') ?>" class="form-control">
                             </div>
                         </div>
                     </div>



                     <div class="form-group">
                         <div class="row">
                             <div class="col-md-3">

                             </div>
                             <div class="col-md-9">
                                 <a href="<?= base_url('admin/simulasi/index/' . $this->uri->segment(4)) ?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
                                 <button type="submit" class="btn btn-primary">Tambah</button>
                             </div>
                         </div>
                     </div>

                 </form>
                 <?= form_close() ?>



             </div>
             <!-- /.box-body -->
         </div>
     </div>
 </div>