<div class="wrapper">
    <aside id="sidebar">
        <div class="d-flex pt-3">
            <button class="toggle-btn" type="button">
                <i class="bi-grid"></i>
            </button>
            <div class="sidebar-logo">
                <a href="<?= urlpath('dashboard') ?>">JemberFnBLoker</a>
            </div>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="<?= urlpath('dashboard') ?>" class="sidebar-link">
                    <i class="bi-speedometer"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <?php
            if ($user['role_id'] == 1) {
                $url = urlpath("dashboard/pengguna");
                echo '            
            <li class="sidebar-item active">
                <a href="' . $url . '" class="sidebar-link">
                    <i class="bi-people"></i>
                    <span>Pengguna</span>
                </a>
            </li>';
            } 
            ?>
            <li class="sidebar-item">
                <a href="<?= urlpath('dashboard/daftarloker') ?>" class="sidebar-link">
                    <i class="bi-toggles"></i>
                    <span>Daftar Loker</span>
                </a>
            </li>
        </ul>
        <div class="sidebar-footer">
            <a href="<?= urlpath('logout') ?>" class="sidebar-link">
                <i class="bi-box-arrow-left"></i>
                <span>Logout</span>
            </a>
        </div>
    </aside>
    <div class="main">
        <nav class="navbar navbar-expand bg-body-tertiary fixed-top px-4 py-3" style="z-index: 1;">
            <div class="navbar-collapse collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                            <i class="bi bi-gear" style="font-size: 1.5rem;"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end rounded">
                            <ul class="list-unstyled mb-0">
                                <li>
                                    <a href="<?=urlpath('profile')?>" class="dropdown-item">Profile</a>
                                    <hr>
                                    <a href="#" class="dropdown-item" id="themeDropdown">Theme</a>
                                    <div class="theme-item p-2">
                                        <a href="#" class="dropdown-item text-muted" data-bs-theme-value="light"><i
                                                class="bi-sun"></i> Light</a>
                                        <a href="#" class="dropdown-item text-muted" data-bs-theme-value="dark"><i
                                                class="bi-moon"></i> Dark</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <main class="content px-3 py-5 mt-5">
            <?php displayFlashMessages('success'); ?>
            <?php displayFlashMessages('danger'); ?>
            <div class="container-fluid">
                <div class="mb-3">
                    <h3 class="fw-bold fs-4 mb-3">Pilih Pengguna</h3>
                    <small class="text-muted mb-3">Silahkan pilih jenis pengguna yang ingin Anda lihat!</small>
                </div>
                <div class="row gap-2 justify-content-center">
                    <div class="col-md-5">
                        <a href="<?= urlpath('dashboard/pengguna/jobcreator') ?>" class="text-decoration-none">
                            <div class="card border-success text-center">
                                <img class="card-img-top mx-auto d-block w-25 h-25 mt-3" src="<?= urlpath('assets/img/register_as/jobcreator.png') ?>" alt="">
                                <div class="card-body">
                                    <h5 class="card-title">Job Creator</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-5">
                        <a href="<?= urlpath('dashboard/pengguna/jobseeker') ?>" class="text-decoration-none">
                            <div class="card border-info text-center">
                                <img class="card-img-top mx-auto d-block w-25 h-25 mt-3" src="<?= urlpath('assets/img/register_as/jobseeker.png') ?>" alt="">
                                <div class="card-body">
                                    <h5 class="card-title">Job Seeker</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="chart-container mt-5 d-flex flex-column align-items-center">
                    <p>Sebaran pengguna JemberFnBLoker</p>
                    <div class="pie-chart w-25 h-25">
                        <canvas id="piechart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
        </main>
        <footer class="footer">
            <div class="container-fluid">
                <div class="row text-body-secondary">
                    <div class="col-6 text-start ">
                    </div>
                    <div class="col-6 text-end text-body-secondary d-none d-md-block">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                                <a class="text-body-secondary" href="#">JemberFnBLoker By Valentino Hariyanto</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>