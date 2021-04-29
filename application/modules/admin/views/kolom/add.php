<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-default">
    <i class="fa fa-plus"></i>Tambah
</button>
<?= form_open(base_url($tombol['add'])) ?>
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Kolom</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">

                    <div class="row">
                        <div class="col-md-3">
                            <label for="" class="pull-right">Urutan Kolom</label>
                        </div>
                        <div class="col-md-9">
                            <select name="urutan" class="select2 form-control" required id="">
                                <option value="">-- No. Soal --</option>
                                <?php

                                $this->load->model('admin/Soal_model', 'SM');

                                for ($i = 1; $i <= $simulasi->jumlah_kolom; $i++) {
                                    $cek = $this->SM->cekNoKolom($simulasi->id_simulasi, $i);
                                    if ($cek->urutan != $i) {
                                        echo '<option value = "' . $i . '">' . $i . '</option>';
                                    }
                                } ?>
                            </select>
                            <!-- <input type="text" class="form-control" name="nama_kolom" required> -->
                            <input type="hidden" name="id_simulasi" value="<?= $this->uri->segment(4); ?>">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="" class="pull-right">Jumlah Soal</label>
                        </div>
                        <div class="col-md-4">
                            <input type="number" class="form-control" name="jumlah_soal" id="">
                        </div>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

            </div>
        </div>

    </div>
    <!-- /.modal-content -->
</div>
<?= form_close() ?>
<!-- /.modal -->