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

                     <div class="form-group">
                         <div class="row">
                             <div class="col-md-3">
                                 <label for="" class="pull-right">Nama Simulasi</label>
                             </div>
                             <div class="col-md-9">
                                 <input type="text" name="nama_simulasi" placeholder="Nama Simulasi" value="<?= set_value('nama_simulasi') ?>" class="form-control">
                             </div>
                         </div>
                     </div>


                     <div class="form-group">
                         <div class="row">
                             <div class="col-md-3">
                                 <label for="" class="pull-right">Mapel</label>
                             </div>
                             <div class="col-md-9">
                                 <select name="id_mapel" required class="form-control select2" id="">
                                     <option value="">-- Mapel --</option>
                                     <?php foreach ($mapel as $row) { ?>
                                         <option value="<?= $row->id_mapel; ?>"><?= $row->nama_mapel; ?></option>
                                     <?php } ?>
                                 </select>
                             </div>
                         </div>
                     </div>


                     <div class="form-group">
                         <div class="row">
                             <div class="col-md-3">
                                 <label for="" class="pull-right">Jumlah Soal</label>
                             </div>
                             <div class="col-md-6">
                                 <input type="number" name="jumlah_soal" placeholder="Jumlah Soal" value="<?= set_value('jumlah_soal') ?>" class="form-control">
                             </div>
                         </div>
                     </div>

                     <div class="form-group">
                         <div class="row">
                             <div class="col-md-3">
                                 <label for="" class="pull-right">Waktu</label>
                             </div>
                             <div class="col-md-6">
                                 <input type="number" name="waktu" placeholder="Dalam Menit" value="<?= set_value('waktu') ?>" class="form-control">
                             </div>
                         </div>
                     </div>


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
                                 <a href="<?= base_url($back) ?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
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