<button type="button" class="btn btn-success btn-sx" data-toggle="modal" data-target="#modal-default">
    <i class="fa fa-plus"></i>Tambah
</button>

<?= form_open_multipart(base_url('admin/banner/index')) ?>
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Banner</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="" class="pull-right">Topik</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="topik" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="" class="pull-right">Deskripsi</label>
                        </div>
                        <div class="col-md-9">
                            <textarea name="deskripsi" class="form-control" id="" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                </div>
                <!-- <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="" class="pull-right">Link</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="link" class="form-control">
                        </div>
                    </div>
                </div> -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="" class="pull-right">Urutan</label>
                        </div>
                        <div class="col-md-9">
                            <input type="number" required class="form-control" name="urutan">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="" class="pull-right">Warna Text</label>
                        </div>
                        <div class="col-md-9">
                            <select name="warna_text" class="form-control" id="">
                                <option value="text-white">Putih</option>
                                <option value="text-primary">Hitam</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="" class="pull-right">Gambar</label>
                        </div>
                        <div class="col-md-9">
                            <input type="hidden" name="bantuan" value="aa">
                            <input type="file" class="form-control" name="gambar" required>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?= form_close() ?>
<!-- /.modal -->