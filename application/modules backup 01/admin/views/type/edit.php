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
                ?>

                <form action="<?= base_url($edit . $type->id_type) ?>" method="post">

                    <div class="row">
                        <div class="col-md-3">
                            <label for="" class="pull-right">Nama Type</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="nama_type" placeholder="Nama Type" value="<?= $type->nama_type ?>" class="form-control">
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-9">
                            <a href="<?= base_url($back) ?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>

                </form>



            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>