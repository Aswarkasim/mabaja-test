<div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg') ?>"></div>



<div class="row">
    <div class="col-md-7">


        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Manajemen Mapel</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <p>
                    <?php include('add.php') ?>
                </p>

                <table class="table DataTable">
                    <thead>
                        <tr>
                            <th width="40px">No</th>
                            <th>Nama</th>
                            <th>Aktifkan</th>
                            <th width="100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="targetData">
                        <?php $no = 1;
                        foreach ($mapel as $row) { ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><a href="<?= base_url('admin/simulasi/index/' . $row->id_mapel); ?>"><b><?= $row->nama_mapel ?></b></a></td>
                                <td>
                                    <div class="btn-group">
                                        <?php if ($row->is_active == 1) { ?>
                                            <button type="button" class="btn btn-success"><i class="fa fa-check"></i> Tes Hari Ini</button>
                                        <?php } else { ?>
                                            <button type="button" class="btn btn-danger"><i class="fa fa-times"></i> Mapel Tidak Aktif</button>
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
                                                <li><a href="<?= base_url('admin/mapel/is_active/' . $row->id_mapel) ?>"><i class="fa fa-check"></i> Aktif</a></li>
                                            <?php } else { ?>
                                                <li><a href="<?= base_url('admin/mapel/is_active/' . $row->id_mapel) ?>"><i class="fa fa-times"></i> Tidak Aktif</a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>

                                </td>
                                <td>
                                    <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#ModalEdit<?= $row->id_mapel ?>">
                                        <i class="fa fa-edit"></i>Edit
                                    </button>

                                    <!-- <a href="<?= base_url($tombol['edit']) ?>" class="btn btn-success btn-xs"><i class="fa fa-edit"></i> Edit</a> -->
                                    <a href="<?= base_url($tombol['delete'] . $row->id_mapel) ?>" class="btn btn-danger btn-xs tombol-hapus"><i class="fa fa-trash"></i> Hapus</a>
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