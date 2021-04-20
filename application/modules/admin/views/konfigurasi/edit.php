<div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg') ?>"></div>

<div class="row">
    <div class="col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-cogs"></i> <?= $title ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <?php
                echo validation_errors('<div class="alert alert-warning"><i class="fa fa-warning"></i> ', '</div>');
                ?>

                <form action="<?= base_url('admin/konfigurasi') ?>" method="post">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="" class="pull-right">Nama Aplikasi</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" value="<?= $konfigurasi->nama_aplikasi ?>" name="nama_aplikasi" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="" class="pull-right">Instagram</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" value="<?= $konfigurasi->instagram ?>" name="instagram" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="" class="pull-right">Facebook</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" value="<?= $konfigurasi->facebook ?>" name="facebook" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="" class="pull-right">Twitter</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" value="<?= $konfigurasi->twitter ?>" name="twitter" class="form-control">
                            </div>
                        </div>
                    </div>



                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">

                            </div>
                            <div class="col-md-9">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                            </div>
                        </div>
                    </div>

                </form>



            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>