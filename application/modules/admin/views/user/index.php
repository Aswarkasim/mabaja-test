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

                        </td>

                        <td>

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