<style>
    .is_read {
        color: #f0f0f0;
    }

    .not-read {
        color: #f39c12;
    }
</style>

<div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg') ?>"></div>

<table class="table DataTable">
    <thead>
        <tr>
            <th width="40px">No</th>
            <th>Nama</th>
            <th width="">Aktifkan</th>
        </tr>
    </thead>
    <tbody id="targetData">
        <?php $no = 1;
        foreach ($userLimit as $row) { ?>
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


            </tr>
        <?php $no++;
        } ?>
    </tbody>
</table>