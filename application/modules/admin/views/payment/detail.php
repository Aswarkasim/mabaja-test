<div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg') ?>"></div>

<div class="row">
    <div class="col-md-12">
        <div class="box">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Read Mail</h3>

                    <div class="box-tools pull-right">
                        <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Previous"><i class="fa fa-chevron-left"></i></a>
                        <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Next"><i class="fa fa-chevron-right"></i></a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="mailbox-read-info">
                        <h3><?= $payment->namalengkap; ?></h3>
                        <h5>Email: <?= $payment->email; ?>
                            <span class="mailbox-read-time pull-right"><?= $payment->date_created; ?></span></h5>
                    </div>
                    <!-- /.mailbox-read-info -->
                    <div class="mailbox-controls with-border">


                        <div class="btn-group">
                            <?php if ($payment->is_valid == 1) { ?>
                                <button type="button" class="btn btn-success"><i class="fa fa-check"></i> Valid</button>
                            <?php } else { ?>
                                <button type="button" class="btn btn-danger"><i class="fa fa-times"></i> TIdak Valid</button>
                            <?php } ?>
                            <button type="button" class="btn <?php if ($payment->is_valid == 1) {
                                                                    echo 'btn-success';
                                                                } else {
                                                                    echo "btn-danger";
                                                                } ?> dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <?php if ($payment->is_valid == 0) { ?>
                                    <li><a href="<?= base_url('admin/payment/is_valid/' . $payment->id_payment) ?>"><i class="fa fa-check"></i> Valid</a></li>
                                <?php } else { ?>
                                    <li><a href="<?= base_url('admin/payment/not_valid/' . $payment->id_payment) ?>"><i class="fa fa-times"></i> Tidak Valid</a></li>
                                <?php } ?>
                            </ul>
                        </div>

                    </div>
                    <!-- /.mailbox-controls -->
                    <div class="mailbox-read-message">
                        <table class="table">
                            <tr>
                                <td width="200px">Nama Paket</td>
                                <td>: CPNS</td>
                            </tr>


                            <tr>
                                <td>Harga</td>
                                <td>: <?= 'Rp. ' . nominal($payment->harga); ?></td>
                            </tr>

                            <tr>
                                <td>Kupon</td>
                                <td>: <?= $payment->kupon; ?></td>
                            </tr>

                            <tr>
                                <td>Kode Bayar</td>
                                <td>: <?= $payment->kode; ?></td>
                            </tr>

                            <tr>
                                <td>Total Bayar</td>
                                <td>: <?= 'Rp. ' . nominal($payment->jumlah_bayar); ?></td>
                            </tr>

                            <tr>
                                <td>Tanggal Transaksi</td>
                                <td>: <?= $payment->date_created; ?></td>
                            </tr>


                        </table>
                    </div>
                    <!-- /.mailbox-read-message -->
                </div>
                <!-- /.box-footer -->
                <div class="box-footer">
                    <div class="pull-right">
                        <button type="button" class="btn btn-default"><i class="fa fa-reply"></i> Reply</button>
                        <button type="button" class="btn btn-default"><i class="fa fa-share"></i> Forward</button>
                    </div>
                    <button type="button" class="btn btn-default"><i class="fa fa-trash-o"></i> Delete</button>
                    <button type="button" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
                </div>
                <!-- /.box-footer -->
            </div>
        </div>
    </div>
</div>