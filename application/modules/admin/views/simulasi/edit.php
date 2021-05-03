<!-- Button trigger modal -->
<a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#EditSimulasi">
    <i class="fa fa-edit"></i>
</a>

<!-- Modal -->
<div class="modal fade" id="EditSimulasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Simulasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart(base_url('admin/simulasi/edit/' . $simulasi->id_simulasi)) ?>
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
                            <label for="" class="pull-right">Jumlah Soal</label>
                        </div>
                        <div class="col-md-6">
                            <input type="number" name="jumlah_soal" required placeholder="Jumlah Soal" value="<?= $simulasi->jumlah_soal ?>" class="form-control">
                        </div>
                    </div>
                </div>

                <?php if ($simulasi->id_mapel == 'mrHXIR2D') { ?>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="" class="pull-right">Type Option</label>
                            </div>
                            <div class="col-md-6">
                                <select name="type_option" class="form-control" id="">
                                    <option value="">-- Type Option --</option>
                                    <option value="B" <?= $simulasi->type_option == 'B' ? 'selected' : ''; ?>>A-B</option>
                                    <option value="D" <?= $simulasi->type_option == 'C' ? 'selected' : ''; ?>>A-D</option>
                                    <option value="E" <?= $simulasi->type_option == 'E' ? 'selected' : ''; ?>>A-E</option>
                                </select>
                            </div>
                        </div>
                    </div>

                <?php } ?>

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


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
            <?php form_close() ?>
        </div>
    </div>
</div>