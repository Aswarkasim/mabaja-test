<div class="modal fade" id="ModalEdit<?= $row->id_kolom ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Kolom</h4>
            </div>
            <?= form_open_multipart(base_url($tombol['edit'] . '/' . $row->id_kolom)) ?>
            <div class="modal-body">
                <div class="form-group">

                    <div class="row">
                        <div class="col-md-3">
                            <label for="" class="pull-right">Jumlah Soal</label>
                        </div>
                        <div class="col-md-4">
                            <input type="number" required class="form-control" value="<?= $row->jumlah_soal; ?>" name="jumlah_soal" id="">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="" class="pull-right">Gambar Petunjuk</label>
                        </div>
                        <div class="col-md-4">
                            <input type="file" name="petunjuk" id="">
                        </div>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

            </div>
            <?= form_close() ?>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->