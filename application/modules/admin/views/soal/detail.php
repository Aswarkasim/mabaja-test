<?php
$this->load->model('admin/Soal_model', 'SM');
?>

<div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg') ?>"></div>

<div class="row">
    <div class="col-md-12">
        <div class="box">

            <div class="row">
                <div class="col-md-6">


                    <div class="box-header">
                        <a href="<?= base_url($back) ?>" class="btn btn-info"><i class="fa fa-arrow-left"></i> Kembali</a>
                        <a href="<?= base_url('admin/soal/is_doneSoal/1/' . $soal->id_soal) ?>" class="btn btn-success"><i class="fa fa-save"></i> Selesai & Simpan</a>

                        <a href="<?= base_url('admin/soal/is_doneSoal/0/' . $soal->id_soal) ?>" class="btn btn-warning"><i class="fa fa-spinner"></i> Simpan sebagai draft</a>
                        <br><br>
                        <h3 class="box-title"><?= $title ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <?php
                        echo validation_errors('<div class="alert alert-warning"><i class="fa fa-warning"></i> ', '</div>');
                        ?>

                        <p><strong>
                                <?= $soal->butir_soal; ?>
                            </strong></p>

                        <form action="<?= base_url('admin/soal/makeChoice'); ?>" method="POST">
                            <input type="hidden" name="id_soal" value="<?= $soal->id_soal; ?>">
                            <div class="form-group">
                                <label for="">Pilihan</label>
                                <textarea name="butir_pilihan" id="editor1" required class="form-control" id="" cols="20" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Anotasi</label>
                                <select name="id_pilihan" required class="form-control" id="">
                                    <option value="">-- Anotasi --</option>
                                    <?php foreach ($pilihan as $row) {
                                        if ($row->butir_pilihan == '') { ?>
                                            <option value="<?= $row->id_pilihan; ?>"><?= $row->anotasi; ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>

                            <?php if ($simulasi->id_mapel == "mrHXIR2D") { ?>
                                <div class="form-group">
                                    <label for="">Poin</label>
                                    <select name="poin" required class="form-control" id="">
                                        <option value="">-- Poin --</option>
                                        <?php
                                        for ($i = 1; $i <= 5; $i++) {
                                            $cek = $this->SM->cekPoin($soal->id_soal, $i);
                                            if ($cek->poin != $i) {
                                                echo '<option value="' . $i . '">' . $i . '</option>';
                                            }
                                        } ?>
                                    </select>
                                </div>
                            <?php } ?>


                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pull-right">

                                            <button type="submit" class="btn btn-primary"><i class="fa fa-indent"></i> Buat</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>



                    </div>
                    <!-- /.box-body -->
                </div>

                <div class="col-md-6">
                    <div class="box-body">
                        <h4><strong>Pilihan Jawaban</strong></h4>

                        <table class="table">
                            <?php foreach ($pilihan as $row) {
                                if ($row->butir_pilihan != '') { ?>
                                    <tr>
                                        <td width="20px"><?= $row->anotasi; ?></td>
                                        <td><?= $row->butir_pilihan; ?></td>
                                        <td><?= $row->poin != null ?  $row->poin : "" ?></td>
                                        <td width="40px"><a href="<?= base_url('admin/soal/deleteChoice/' . $row->id_soal . '/' . $row->id_pilihan) ?>"><i class="fa fa-times"></i></a></td>
                                    </tr>
                            <?php }
                            } ?>
                        </table>
                        <hr>

                        <form action="<?= base_url('admin/soal/is_trueChoice') ?>" method="POST">
                            <div class="form-group">
                                <input type="hidden" name="id_soal" value="<?= $soal->id_soal ?>">
                                <label for="">Jawaban Benar</label>
                                <select name="id_pilihan" required class="form-control" id="">
                                    <option value="">-- Anotasi --</option>
                                    <?php foreach ($pilihan as $row) { ?>
                                        <option <?php if ($row->id_pilihan == $soal->id_pilihan) {
                                                    echo "selected";
                                                } ?> value="<?= $row->id_pilihan; ?>"><?= $row->anotasi . ' - ' . character_limiter($row->butir_pilihan, '50'); ?></option>
                                    <?php } ?>
                                </select>
                            </div>




                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Pilih</button>
                            </div>
                        </form>


                        <?php include('pembahasan.php') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="http://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor1', {
        height: 300,
        filebrowserUploadUrl: "<?= base_url('admin/soal/upload'); ?>"
    });
</script>