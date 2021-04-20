<style>
  html,
  body {
    height: 100%;
  }


  .form-signin {
    width: 100%;
    max-width: 400px;
    padding: 15px;
    margin: 0 auto;
  }
</style>

<div class="row">
  <div class="col-md-12">
    <div class="text-center">
      <img src="<?= base_url('assets/img/logo_mabaja_susun.png'); ?>" width="250px" alt="">
    </div>
  </div>
</div>
<form action="<?= base_url('home/auth'); ?>" method="POST" class="form-signin" style="margin-bottom: 200px;">
  <div class="card p-4">
    <?php echo validation_errors('<div class="alert alert-warning"><i class="fa fa-warning"></i> ', '</div>');
    if (isset($error)) {
      echo '<div class="alert alert-warning"><i class="fa fa-warning"></i> ';
      echo $error;
      echo '</div>';
    }
    ?>

    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <button class="btn btn-outline-secondary" type="button"><i class="fa fa-user"></i></button>
      </div>
      <input type="text" class="form-control" name="id_user" placeholder="Nomor Anggota">

    </div>

    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <button class="btn btn-outline-secondary" type="button"><i class="fa fa-envelope"></i></button>
      </div>
      <input type="email" class="form-control" name="email" placeholder="Email">
    </div>

    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <button class="btn btn-outline-secondary" type="button"><i class="fa fa-lock"></i></button>
      </div>
      <input type="password" class="form-control" name="password" placeholder="Password">
    </div>


    <button type="submit" class="btn btn-primary btn-block">Login</button>
    <br>
    <p>Belum punya akun? <a href="<?= base_url('home/auth/register'); ?>">Register di sini</a></p>


  </div>
</form>