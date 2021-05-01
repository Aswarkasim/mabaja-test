<?php
$this->load->model('admin/Soal_model', 'SM');
?>

<div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg') ?>"></div>

<div class="row">
    <div class="col-md-12">
        <div class="box">

            <div class="row">
                <div class="col-md-6">



                    <!-- /.box-header -->
                    <div class="box-body">
                        <a href="<?= base_url('admin/kolom/index/' . $kolom->id_simulasi); ?>" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
                        <a href="<?= base_url('admin/kecermatan/is_doneKolomKecermatan/1/' . $kolom->id_kolom) ?>" class="btn btn-success"><i class="fa fa-save"></i> Selesai & Simpan</a>

                        <a href="<?= base_url('admin/kecermatan/is_doneKolomKecermatan/0/' . $kolom->id_kolom) ?>" class="btn btn-warning"><i class="fa fa-spinner"></i> Simpan sebagai draft</a>
                        <?php
                        echo validation_errors('<div class="alert alert-warning"><i class="fa fa-warning"></i> ', '</div>');
                        ?>


                        <?= form_open_multipart('admin/kecermatan/add') ?>
                        <form action="" method="POST">
                            <input type="hidden" name="id_kolom" value="<?= $this->uri->segment(4); ?>">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <label for="">Nomor Soal</label>
                                            <select name="no_soal" class="select2 form-control" required id="">
                                                <?php for ($i = 1; $i <= $kolom->jumlah_soal; $i++) {
                                                    $cek = $this->SM->cekNoSoalKolom($kolom->id_kolom, $i);
                                                    if ($cek->no_soal != $i) {
                                                        echo '<option value = "' . $i . '">' . $i . '</option>';
                                                    }
                                                } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Soal</label><br>
                                            <small>Kosongkan jika menggunakan text</small>
                                            <input type="file" name="gambar" id=""><br>
                                            <small>Jika Text</small>
                                            <input type="text" name="butir_soal" class="form-control" id="">
                                        </div>

                                        <div class="form-group">
                                            <label for="">Jawaban Benar</label>
                                            <select name="jawaban_kecermatan" class="form-control" width="200px" required id="">
                                                <option value="">-- Pilihan --</option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                                <option value="E">E</option>
                                            </select>
                                        </div>

                                        <div class="pull-right">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-indent"></i> Buat</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?= form_close(); ?>



                    </div>
                    <!-- /.box-body -->
                </div>

                <div class="col-md-6">
                    <div class="box-body">
                        <h4><strong>List Soal</strong></h4>
                        <div style="height: 400px; overflow: auto;">
                            <table class="table">
                                <?php foreach ($soal as $row) { ?>
                                    <tr>
                                        <td width=""><?= $row->no_soal . '. ' . $row->butir_soal; ?></td>
                                        <td>
                                            <?php
                                            if ($row->butir_soal == null && $row->gambar != null) { ?>
                                                <img src="<?= base_url($row->gambar); ?>" width="100px" alt="">
                                            <?php
                                            } else {
                                                $row->butir_soal;
                                            }
                                            ?>
                                        </td>
                                        <td><?= $row->jawaban_kecermatan; ?></td>
                                        <td><?= $row->poin != null ?  $row->poin : "" ?></td>
                                        <td width="40px"><a href="<?= base_url('admin/kecermatan/delete/' . $row->id_soal) ?>"><i class="fa fa-times"></i></a></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                        <hr>



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