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

        </table>

    </div>
    <!-- /.box-body -->
</div>