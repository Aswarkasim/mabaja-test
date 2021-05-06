<div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg') ?>"></div>



<div class="row">
    <div class="col-md-8">


        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Manajemen Kelas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <p>
                    <?php include('add.php')
                    ?>
                </p>

                <table class="table DataTable">
                    <thead>
                        <tr>
                            <th width="40px">No</th>
                            <th>Nama Kelas</th>
                            <th>Mapel</th>
                            <th>Aktifkan</th>
                            <th width="100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="targetData">
                        <?php $no = 1;

                        foreach ($kelas as $row) {
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><a href="<?= base_url('admin/user/index/' . $row->id_kelas); ?>"><b><?= $row->nama_kelas ?></b></a></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success"><i class="fa fa-check"></i> <?= $row->nama_mapel; ?></button>
                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>

                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="<?= base_url('admin/kelas/cheangeMapel/'  . $row->id_kelas) ?>"><i class="fa fa-check"></i> Kosongkan</a></li>
                                            <?php foreach ($mapel as $m) { ?>
                                                <li><a href="<?= base_url('admin/kelas/cheangeMapel/' . $row->id_kelas . '/' . $m->id_mapel) ?>"> <?= $m->nama_mapel; ?></a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <?php if ($row->is_active == 1) { ?>
                                            <button type="button" class="btn btn-success"><i class="fa fa-check"></i> Tes Hari Ini</button>
                                        <?php } else { ?>
                                            <button type="button" class="btn btn-danger"><i class="fa fa-times"></i> Kelas Tidak Aktif</button>
                                        <?php } ?>
                                        <button type="button" class="btn <?php if ($row->is_active == 1) {
                                                                                echo 'btn-success';
                                                                            } else {
                                                                                echo "btn-danger";
                                                                            } ?> dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>


                                        <ul class="dropdown-menu" role="menu">
                                            <?php if ($row->is_active == 0) { ?>
                                                <li><a href="<?= base_url('admin/kelas/is_active/1/' . $row->id_kelas) ?>"><i class="fa fa-check"></i> Aktif</a></li>
                                            <?php } else { ?>
                                                <li><a href="<?= base_url('admin/kelas/is_active/0/' . $row->id_kelas) ?>"><i class="fa fa-times"></i> Tidak Aktif</a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>

                                </td>
                                <td>
                                    <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#ModalEdit<?= $row->id_kelas ?>">
                                        <i class="fa fa-edit"></i>Edit
                                    </button>

                                    <!-- <a href="<?= base_url($tombol['edit']) ?>" class="btn btn-success btn-xs"><i class="fa fa-edit"></i> Edit</a> -->
                                    <a href="<?= base_url($tombol['delete'] . $row->id_kelas) ?>" class="btn btn-danger btn-xs tombol-hapus"><i class="fa fa-trash"></i> Hapus</a>
                                </td>
                                <?php include('edit.php')
                                ?>
                            </tr>
                        <?php $no++;
                        } ?>
                    </tbody>
                </table>

            </div>
            <!-- /.box-body -->
        </div>

    </div>
</div>