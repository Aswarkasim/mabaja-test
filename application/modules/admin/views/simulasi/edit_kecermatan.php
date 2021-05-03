<!-- Button trigger modal -->
<a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#EditSimulasiKecermatan">
    <i class="fa fa-edit"></i>
</a>

<!-- Modal -->
<div class="modal fade" id="EditSimulasiKecermatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Simulasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart(base_url('admin/kecermatan/editSimulasiKecermatan/' . $simulasi->id_simulasi)) ?>
            <form action="" method="POST">

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="" class="pull-right">Nama Simulasi</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="nama_simulasi" required placeholder="Nama Simulasi" value="<?= $simulasi->nama_simulasi ?>" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="" class="pull-right">Waktu</label>
                        </div>
                        <div class="col-md-6">
                            <input type="number" name="waktu" placeholder="Dalam Menit" required value="<?= $simulasi->waktu ?>" class="form-control">
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="" class="pull-right">Jumlah Kolom</label>
                        </div>
                        <div class="col-md-6">
                            <input type="number" name="jumlah_kolom" required placeholder="Jumlah Kolom" value="<?= $simulasi->jumlah_kolom ?>" class="form-control">
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
            <?php form_close() ?>
        </div>
    </div>
</div>