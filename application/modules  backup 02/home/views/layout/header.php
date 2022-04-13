    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-white bg-white" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="<?= base_url('home'); ?>">
          <img src="<?= base_url('assets/img/logo_mabaja_cat.png'); ?>" width="350px" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link nav-header js-scroll-trigger" href="<?= base_url('home'); ?>">Simulasi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-header js-scroll-trigger" href="<?= base_url('user/profil'); ?>">Profil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-header js-scroll-trigger" href="<?= base_url('home/auth/logout'); ?>">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>