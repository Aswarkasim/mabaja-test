<?php

$id_admin = $this->session->userdata('id_admin');
$role = $this->session->userdata('role');

?>

<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">HEADER</li>

            <li class="<?php if ($this->uri->segment(2) == "dashboard") {
                            echo "active";
                        }
                        ?>"><a href="<?php echo base_url('admin/dashboard')
                                        ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

            <!-- <li class="<?php if ($this->uri->segment(2) == "type") {
                                echo "active";
                            }
                            ?>"><a href="<?php echo base_url('admin/type')
                                            ?>"><i class="fa fa-tags"></i> <span>Type</span></a></li> -->

            <li class="<?php if ($this->uri->segment(2) == "mapel") {
                            echo "active";
                        }
                        ?>"><a href="<?php echo base_url('admin/mapel')
                                        ?>"><i class="fa fa-calendar"></i> <span>Mapel</span></a></li>


            <!-- <li class="<?php if ($this->uri->segment(2) == "simulasi") {
                                echo "active";
                            }
                            ?>"><a href="<?php echo base_url('admin/simulasi')
                                            ?>"><i class="fa fa-folder"></i> <span>Simulasi</span></a></li> -->




            <li class="<?php if ($this->uri->segment(2) == "user") {
                            echo "active";
                        }
                        ?>"><a href="<?php echo base_url('admin/user')
                                        ?>"><i class="fa fa-users"></i> <span>User</span></a></li>


            <?php if ($this->session->userdata('role') == 'superadmin') { ?>


                <li class="treeview <?php if ($this->uri->segment(2) == "admin") {
                                        echo "active";
                                    } ?>">
                    <a href="#"><i class="fa fa-user-secret"></i> <span>Manajemen Admin</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?php if ($this->uri->segment(2) == "admin") {
                                        echo "active";
                                    } ?>"><a href="<?= base_url('admin/admin') ?>">List Admin</a></li>
                    </ul>
                </li>

            <?php } ?>



            <li class="treeview <?php if ($this->uri->segment(2) == "konfigurasi") {
                                    echo "active";
                                } ?>">
                <a href="#"><i class="fa fa-cogs"></i> <span>Konfigurasi</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if ($this->uri->segment(3) == "index") {
                                    echo "active";
                                } ?>"><a href="<?= base_url('admin/konfigurasi/index') ?>">General</a></li>
                    <li class="<?php if ($this->uri->segment(3) == "banner") {
                                    echo "active";
                                } ?>"><a href="<?= base_url('admin/banner') ?>">Banner</a></li>
                    <li class="<?php if ($this->uri->segment(3) == "logo") {
                                    echo "active";
                                } ?>"><a href="<?= base_url('admin/konfigurasi/logo') ?>">Logo</a></li>

                    <li class="<?php if ($this->uri->segment(3) == "password") {
                                    echo "active";
                                } ?>"><a href="<?= base_url('admin/konfigurasi/password') ?>">Ubah Password</a></li>
                </ul>
            </li>



        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content container-fluid">