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
                                <label for="" class="pull-right">Nama</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="nama_testimony" placeholder="Nama" value="<?= set_value('nama_testimony') ?>" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="" class="pull-right">Pekerjaan</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="pekerjaan" placeholder="Pekerjaan" value="<?= set_value('pekerjaan') ?>" class="form-control">
                            </div>
                        </div>
                    </div>




                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="" class="pull-right">Gambar</label>
                            </div>
                            <div class="col-md-9">
                                <input type="file" name="gambar" required value="<?= set_value('gambar') ?>" class="form-control">
                                <small class="text-danger">* Masukkan gambar simetris</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="" class="pull-right">Deskripsi</label>
                            </div>
                            <div class="col-md-9">
                                <textarea name="deskripsi" class="form-control" placeholder="Deksripsi" id="" cols="30" rows="10"></textarea>
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


<!-- <select id="test" name="form_select" onchange="showDiv(this)">
    <option value="0">No</option>
    <option value="1">Yes</option>
</select>
<div id="hidden_div" style="display:none;">Hello hidden content</div> -->

<script type="text/javascript">
    function showDiv(select) {
        if (select.value == 1) {
            document.getElementById('hidden_div').style.display = "block";
        } else {
            document.getElementById('hidden_div').style.display = "none";
        }
    }

    function showSelect(select) {
        if (select.value == 'UTBK') {
            document.getElementById('klasifikasi').style.display = "block"
        } else {
            document.getElementById('klasifikasi').style.display = "none"
        }
    }
</script>