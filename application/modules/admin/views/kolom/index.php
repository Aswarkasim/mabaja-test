<div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg') ?>"></div>



<div class="row">
    <div class="col-md-9">


        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Manajemen Kolom</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <p>

                    <a href="<?= base_url('admin/simulasi/detail/' . $simulasi->id_simulasi); ?>" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <?php include('add.php') ?>
                </p>

                <table class="table DataTable">
                    <thead>
                        <tr>
                            <th width="40px">No</th>
                            <th>Kolom</th>
                            <th>Petunjuk</th>
                            <th>Jumlah Soal</th>
                            <th>Aktifkan</th>
                            <th width="100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="targetData">
                        <?php $no = 1;
                        foreach ($kolom as $row) { ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><a href="<?= base_url('admin/kolom/detail/' . $row->id_kolom); ?>"><b><?= 'Kolom ' . $row->urutan ?></b></a></td>
                                <td><img src="<?= base_url($row->petunjuk); ?>" width="100px" alt=""></td>
                                <td><?= $row->jumlah_soal; ?></td>
                                <td><?php if ($row->is_active == 1) {
                                        echo '<div class="label label-success">Aktif</div>';
                                    } else {
                                        echo '<div class="label label-danger">draft</div>';
                                    } ?></td>
                                <td>
                                    <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#ModalEdit<?= $row->id_kolom ?>">
                                        <i class="fa fa-edit"></i>Edit
                                    </button>

                                    <!-- <a href="<?= base_url($tombol['edit']) ?>" class="btn btn-success btn-xs"><i class="fa fa-edit"></i> Edit</a> -->
                                    <a href="<?= base_url($tombol['delete'] . $row->id_kolom) ?>" class="btn btn-danger btn-xs tombol-hapus"><i class="fa fa-trash"></i> Hapus</a>
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