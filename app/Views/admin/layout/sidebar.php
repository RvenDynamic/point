<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="#" class="logo flex items-center space-x-2">
                <img src="<?= base_url("assets/img/Lambang_Polda_Jateng.png") ?>"
                    alt="navbar brand"
                    class="navbar-brand"
                    width="40"
                    height="40" />
                <span class="logo-text text-white font-semibold text-xl">Polsek Kajen</span>
            </a>

            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>

            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>

        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item">
                    <a href="<?= base_url('/admin') ?>" class="collapsed">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Data Master</h4>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/kategori-pelanggaran') ?>">
                        <i class="fas fa-layer-group"></i>
                        <p>Kategori Pelanggaran</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/admin/jenis-pelanggaran') ?>">
                        <i class="fas fa-th-list"></i>
                        <p>Jenis Pelanggaran</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/admin/data-pengendara') ?>">
                        <i class="fas fa-user"></i>
                        <p>Data Pengendara</p>
                    </a>
                </li>
                <hr class="divider">
                <li class="nav-item">
                    <a href="<?= base_url('/admin/laporan') ?>">
                        <i class="fas fa-book"></i>
                        <p>Laporan</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->