<div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg') ?>"></div>


<div class="row">
    <div class="col-md-4">
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





                <table class="table">
                    <thead>
                        <tr>
                            <th width="40px">No</th>
                            <th>Nama Simulasi</th>
                            <!-- <th width="200px">Tindakan</th> -->
                        </tr>
                    </thead>
                    <tbody id="targetData">
                        <?php $no = 1;
                        foreach ($simulasi as $row) {
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td>
                                    <a href="<?= base_url('admin/simulasi/detail/' . $row->id_simulasi) ?>"><strong><?= $row->nama_simulasi ?></strong>
                                    </a>
                                    <p>Waktu : <?= $row->waktu; ?></p>
                                    <p>Jumlah Soal : <?= $row->jumlah_soal; ?></p>
                                </td>

                            </tr>
                        <?php $no++;
                        } ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <!-- /.box-body -->

    <div class="col-md-8">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Peserta</h3>
            </div>

            <div class="box-body">
                <table class="table DataTable">
                    <thead>
                        <tr>
                            <th width=50px>No</th>
                            <th>Nama</th>
                            <th>Skor</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($peserta as $row) {
                        ?>

                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row->namalengkap; ?></td>
                                <td><?= $row->skor_akhir; ?></td>
                                <td>
                                    <?php if ($row->skor_akhir >= 61) { ?>
                                        <div class="text-success"><i class="fa fa-check"></i> Memenuhi syarat</div>
                                    <?php } else { ?>
                                        <div class="text-danger"><i class="fa fa-times"></i> Tidak memenuhi syarat</div>
                                    <?php } ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/paket/deleteUserPaket/' . $row->id_m_paket); ?>" class=" btn btn-warning btn-sm tombol-reset"><i class="fa fa-refresh"></i> Ulangi ujian</a>
                                </td>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>