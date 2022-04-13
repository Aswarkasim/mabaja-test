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
                        <a href="<?= base_url('admin/soal/is_doneSoalKecermatan/1/' . $soal->id_soal) ?>" class="btn btn-success"><i class="fa fa-save"></i> Selesai & Simpan</a>

                        <a href="<?= base_url('admin/soal/is_doneSoalKecermatan/0/' . $soal->id_soal) ?>" class="btn btn-warning"><i class="fa fa-spinner"></i> Simpan sebagai draft</a>
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

                        <form action="<?= base_url('admin/soal/makeChoiceKecermatan'); ?>" method="POST">
                            <input type="hidden" name="id_soal" value="<?= $soal->id_soal; ?>">
                            <div class="form-group">
                                <label for="">Pilihan</label>
                                <object data="<?= base_url($soal->soal_kecermatan); ?>" width="600" height="400"></object>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Soal Ke</label>
                                        <select name="no_soal" required class="form-control select2" id="">
                                            <!-- <option value="">-- Soal Ke --</option> -->
                                            <?php foreach ($jawaban_kecermatan as $row) {
                                                if ($row->jawaban == '') { ?>
                                                    <option value="<?= $row->no_soal_kecermatan; ?>"><?= $row->no_soal_kecermatan; ?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Anotasi</label>
                                        <select name="jawaban" required class="form-control" id="">
                                            <option value="">-- Anotasi --</option>
                                            <?php for ($i = 'A'; $i <= 'E'; $i++) { ?>
                                                <option value="<?= $i; ?>"><?= $i; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>




                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">

                                        <button type="submit" class="btn btn-primary"><i class="fa fa-indent"></i> Buat</button>

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
                        <div style="height: 600px; overflow: auto;">
                            <table class="table">
                                <?php foreach ($jawaban_kecermatan as $row) {
                                    if ($row->jawaban != '') { ?>
                                        <tr>
                                            <td width="20px"><?= $row->no_soal_kecermatan; ?></td>
                                            <td><?= $row->jawaban; ?></td>
                                            <td width="40px"><a href="<?= base_url('admin/soal/deleteChoiceKecermatan/' . $row->id_soal . '/' . $row->id_jawaban_kecermatan) ?>"><i class="fa fa-times"></i></a></td>
                                        </tr>
                                <?php }
                                } ?>
                            </table>

                        </div>
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