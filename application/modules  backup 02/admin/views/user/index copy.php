<style>
    .is_read {
        color: #f0f0f0;
    }

    .not-read {
        color: #f39c12;
    }
</style>

<div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg') ?>"></div>

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Manajemen User <?= $title; ?></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">



        <table class="table DataTable">
            <thead>
                <tr>
                    <th width="40px">No</th>
                    <th>Nama</th>
                    <th width="">Aktifkan</th>
                    <th>Ubah Kelas</th>
                    <th width="200px">Tindakan</th>
                </tr>
            </thead>
            <tbody id="">
                <?php $no = 1;
                foreach ($user as $row) { ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td>
                            <i class="fa fa-user <?= $row->is_read == 1 ? 'is-read' : 'not-read'; ?>"></i> <strong><?= $row->namalengkap ?></strong><br>
                            <p><?= $row->email ?></p>
                        </td>

                        <td>
                            <div class="btn-group">
                                <?php if ($row->is_active == 1) { ?>
                                    <button type="button" class="btn btn-success"><i class="fa fa-check"></i> Aktif</button>
                                <?php } else { ?>
                                    <button type="button" class="btn btn-danger"><i class="fa fa-times"></i> Tidak Aktif</button>
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
                                        <li><a href="<?= base_url('admin/user/is_active/1/' . $row->id_user) ?>"><i class="fa fa-check"></i> Aktif</a></li>
                                    <?php } else { ?>
                                        <li><a href="<?= base_url('admin/user/is_active/0/' . $row->id_user) ?>"><i class="fa fa-times"></i> Tidak Aktif</a></li>
                                    <?php } ?>
                                </ul>
                            </div>

                        </td>

                        <td>
                            <?php if ($row->is_active == 1) { ?>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>

                                    <ul class="dropdown-menu" role="menu">
                                        <?php $uri_4 = $this->uri->segment(4);
                                        if ($uri_4 != null) { ?>
                                            <li><a href="<?= base_url('admin/user/cheangeKelas/' . $row->id_user) ?>"><i class="fa fa-times"></i> Keluarkan</a></li>
                                        <?php } ?>
                                        <?php foreach ($kelas as $k) {
                                            if ($uri_4 != $k->id_kelas) {
                                        ?>
                                                <li><a href="<?= base_url('admin/user/cheangeKelas/' . $row->id_user . '/' . $k->id_kelas) ?>"> <?= $k->nama_kelas; ?></a></li>
                                        <?php }
                                        } ?>
                                    </ul>
                                </div>
                            <?php } ?>
                        </td>

                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-info"><i class="fa fa-cogs"></i></button>
                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a class="tombol-hapus" href="<?= base_url($delete . $row->id_user)  ?>"><i class="fa fa-trash"></i> Hapus</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php $no++;
                } ?>
            </tbody>
        </table>

    </div>
    <!-- /.box-body -->
</div>