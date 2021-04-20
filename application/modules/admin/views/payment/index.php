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
    <label for="">
      <h3 class="box-title"><?= $title; ?></h3>
    </label>
  </div>
  <!-- /.box-header -->
  <div class="box-body">

    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title"></h3>

        <div class="box-tools pull-right">
          <div class="has-feedback">
            <input type="text" class="form-control input-sm" placeholder="Search Mail">
            <span class="glyphicon glyphicon-search form-control-feedback"></span>
          </div>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body no-padding">
        <!-- <div class="mailbox-controls">
          <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-check-square-o"></i>
          </button>
          <div class="btn-group">
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
          </div>
          <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
          <div class="pull-right">
            1-50/200
            <div class="btn-group">
              <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
              <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
            </div>
          </div>
        </div> -->
        <div class="table-responsive mailbox-messages">
          <table class="table table-hover table-striped">
            <tbody>

              <?php foreach ($payment as $row) { ?>
                <tr>
                  <td class="mailbox-star"><a href="#"><i class="fa fa-envelope <?= $row->is_read == 1 ? 'is-read' : 'not-read'; ?>"></i></a></td>
                  <td class="mailbox-name"><a href="<?= base_url('admin/payment/detail/' . $row->id_payment) ?>"><strong><?= $row->namalengkap; ?></strong></a></td>
                  <td class="mailbox-subject"><b><?= $row->nama_paket; ?></b>
                  </td>
                  <td class="mailbox-attachment"></td>
                  <td class="mailbox-date"><?= time_elapsed($row->date_created)  ?></td>
                  <td class="mailbox-date"><?= $row->date_created ?></td>
                  <td class="mailbox-date"><?= date('Y-m-d H:i:s') ?></td>
                </tr>
              <?php } ?>

            </tbody>
          </table>
          <!-- /.table -->
        </div>
        <!-- /.mail-box-messages -->
      </div>
      <!-- /.box-body -->
      <div class="box-footer no-padding">
        <div class="mailbox-controls">
          <!-- <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
          </button>
          <div class="btn-group">
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
          </div>
          <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button> -->
          <div class="pull-right">
            <?= $pagination; ?>
          </div>
          <!-- /.pull-right -->
        </div>
      </div>
    </div>


  </div>
  <!-- /.box-body -->
</div>


<style>
  table tbody tr:hover {
    background-color: #000;
    box-shadow: 0px 0px 0px #000;
    -webkit-box-shadow: 0px 0px 10px #000;
    -moz-box-shadow: 0px 0px 10px #000;
  }
</style>