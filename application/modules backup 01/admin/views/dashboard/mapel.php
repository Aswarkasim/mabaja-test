<table class="table DataTable">
    <thead>
        <tr>
            <th width="40px">No</th>
            <th>Nama</th>
            <th>Aktifkan</th>
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
            </tr>
        <?php $no++;
        } ?>
    </tbody>
</table>