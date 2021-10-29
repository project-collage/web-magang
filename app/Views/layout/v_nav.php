<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-primary elevation-4" style="background-color: #394263;">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <span class="brand-text font-weight-light" style="color:white;">BIMBEL 21</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url() ?>/template/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block" style="color: white;"><?php echo session()->get('namauser') ?></a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <?php if (session()->get('status') == 'admin') { ?>
                    <li class="nav-item">
                        <a href="<?= base_url('home') ?>" class="nav-link">
                            <i class="fas fa-stopwatch" style="padding-right: 5px; color: #9197aa"></i>
                            <p style="color: white;">
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-tools" style="padding-right: 5px; color: #9197aa"></i>
                            <p style="color: white;">
                                Konfigurasi
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('mapel') ?>" class="nav-link">

                                    <p style="color: white;">Mapel</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('tahunajaran') ?>" class="nav-link">

                                    <p style="color: white;">Tahun Ajaran</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('gurupelajaran') ?>" class="nav-link">

                                    <p style="color: white;">Guru Pelajaran</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('groupsoal') ?>" class="nav-link">
                            <i class="fas fa-scroll" style="padding-right: 5px; color: #9197aa"></i>
                            <p style="color: white;">
                                Group Soal
                            </p>
                        </a>
                    </li>
                <?php } ?>
                <?php if (session()->get('status') == 'guru') { ?>
                    <li class="nav-item">
                        <a href="<?= base_url('home') ?>" class="nav-link">
                            <i class="fas fa-stopwatch" style="padding-right: 5px; color: #9197aa"></i>
                            <p style="color: white;">
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('home') ?>" class="nav-link">
                            <i class="fas fa-sticky-note" style="padding-right: 5px; color: #9197aa"></i>
                            <p style="color: white;">
                                Soal
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/widgets.html" class="nav-link">
                            <i class="fas fa-cog" style="padding-right: 5px; color: #9197aa"></i>
                            <p style="color: white;">
                                Set Ujian
                            </p>
                        </a>
                    </li>
                <?php } ?>

                <li class="nav-item">
                    <a href="pages/widgets.html" class="nav-link">
                        <i class="fas fa-trophy" style="padding-right: 5px; color: #9197aa"></i>
                        <p style="color: white;">
                            Nilai
                        </p>
                    </a>
                </li>
                <?php if (session()->get('status') == 'admin') { ?>
                    <li class="nav-item">
                        <a href="<?= base_url('user') ?>" class="nav-link">
                            <i class="fas fa-user" style="padding-right: 5px; color: #9197aa"></i>
                            <p style="color: white;">
                                User
                            </p>
                        </a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a href="<?= base_url('auth/logout') ?>" class="nav-link">
                        <i class="fas fa-arrow-left" style="padding-right: 5px; color: #9197aa"></i>
                        <p style="color: white;">
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">