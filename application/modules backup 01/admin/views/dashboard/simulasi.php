<table class="table DataTable">
    <thead>
        <tr>
            <th width="40px">No</th>
            <th>Nama Simulasi</th>
            <th>Jumlah Soal</th>
            <th>Waktu</th>
        </tr>
    </thead>
    <tbody id="targetData">
        <?php $no = 1;
        foreach ($simulasi as $row) { ?>
            <tr>
                <td><?= $no ?></td>
                <td>
                    <a href="<?= base_url('admin/simulasi/detail/' . $row->id_simulasi) ?>"><strong><?= $row->nama_simulasi ?></strong></a>
                </td>
                <td><?= $row->jumlah_soal ?></td>
                <td><?= $row->waktu ?></td>

            </tr>
        <?php $no++;
        } ?>
    </tbody>
</table>