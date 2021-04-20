<?php

$this->load->model('admin/Soal_model', 'SM');

?>

<script src="http://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>


<style>
    #hidden_div {
        display: none;
    }

    /* .hidden-select-saintek {
        display: none;
    } */
</style>

<div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg') ?>"></div>

<div class="row">
    <div class="col-md-9">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $title ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <?php
                echo validation_errors('<div class="alert alert-warning"><i class="fa fa-warning"></i> ', '</div>');
                ?>

                <form action="<?= base_url($add) ?>" method="post">

                    <div class="form-group">
                        <div class="row">

                            <div class="col-md-3">
                                <label for="" class="pull-right">Nomor Soal</label>
                            </div>

                            <div class="col-md-2">
                                <!-- <input type="number" placeholder="No. Soal" name="no_soal" class="form-control" id=""> -->

                                <select name="no_soal" class="select2 form-control" required id="">
                                    <option value="">-- No. Soal --</option>
                                    <?php for ($i = 1; $i <= $simulasi->jumlah_soal; $i++) {
                                        $cek = $this->SM->cekNoSoal($simulasi->id_simulasi, $i);
                                        if ($cek->no_soal != $i) {
                                            echo '<option value = "' . $i . '">' . $i . '</option>';
                                        }
                                    } ?>
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="" class="pull-right">Butir Soal</label>
                            </div>
                            <div class="col-md-9">
                                <textarea name="butir_soal" id="editor1" placeholder="Butir Soal" required class="form-control"><?= set_value('butir_soal') ?></textarea>
                            </div>
                        </div>
                    </div>



                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">

                            </div>
                            <div class="col-md-9">
                                <a href="<?= base_url($back) ?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-indent"></i> Buat</button>
                            </div>
                        </div>
                    </div>

                </form>






            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>





<!-- <script>
    $(function() {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1')
    })
</script>  -->

<!-- <script src="<?= base_url('assets/js/'); ?>ckeditor/ckeditor.js"></script> -->


<script>
    CKEDITOR.replace('editor1', {
        height: 300,
        filebrowserUploadUrl: "<?= base_url('admin/soal/upload'); ?>"
    });
</script>