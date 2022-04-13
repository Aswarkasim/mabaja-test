<div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg') ?>"></div>



<div class="box">
    <div class="box-header">
        <h3 class="box-title">Manajemen Paket</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

        <a href="<?= base_url('admin/paket'); ?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
        <!-- <p>
            <a href="<?= base_url($add . $this->uri->segment(4)) ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah</a>
        </p> -->

        <!-- Is Pembahasan -->
        <div class="btn-group">
            <?php if ($paket->is_active == 1) { ?>
                <button type="button" class="btn btn-success"><i class="fa fa-check"></i> Paket Aktif</button>
            <?php } else { ?>
                <button type="button" class="btn btn-danger"><i class="fa fa-times"></i> Paket Tidak Aktif</button>
            <?php } ?>
            <button type="button" class="btn <?php if ($paket->is_active == 1) {
                                                    echo 'btn-success';
                                                } else {
                                                    echo "btn-danger";
                                                } ?> dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>


            <ul class="dropdown-menu" role="menu">
                <?php if ($paket->is_active == 0) { ?>
                    <li><a href="<?= base_url('admin/paket/is_active/' . $paket->id_paket . '/1') ?>"><i class="fa fa-check"></i> Aktif</a></li>
                <?php } else { ?>
                    <li><a href="<?= base_url('admin/paket/is_active/' . $paket->id_paket . '/0') ?>"><i class="fa fa-times"></i> Tidak Aktif</a></li>
                <?php } ?>
            </ul>
        </div>
        <br><br>
        <table class="table DataTable">
            <thead>
                <tr>
                    <th width="40px">No</th>
                    <th>Nama Simulasi</th>
                    <th>Jumlah Soal</th>
                    <th>Waktu</th>
                    <!-- <th width="200px">Tindakan</th> -->
                </tr>
            </thead>
            <tbody id="targetData">
                <?php $no = 1;
                foreach ($simulasi as $row) {
                    //     $url = '';
                    //     if ($row->id_mapel == 'RPIuQJc5') {
                    //         $url = 'admin/kolom/index/';
                    //     } else {
                    //         $url = 'admin/simulasi/detail/';
                    //     }
                ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td>
                            <a href="<?= base_url('admin/simulasi/detail/' . $row->id_simulasi) ?>"><strong><?= $row->nama_simulasi ?></strong></a>
                        </td>
                        <td><?= $row->jumlah_soal ?></td>
                        <td><?= $row->waktu ?></td>
                        <!-- <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-info"><i class="fa fa-cogs"></i></button>
                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a class="tombol-hapus" href="<?= base_url($delete . $row->id_simulasi)  ?>"><i class="fa fa-trash"></i> Hapus</a></li>
                                </ul>
                            </div>


                        </td> -->
                    </tr>
                <?php $no++;
                } ?>
            </tbody>
        </table>

    </div>
    <!-- /.box-body -->
</div>