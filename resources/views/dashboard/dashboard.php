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
            <li class="sidebar-item active">
                <a href="<?= urlpath('dashboard') ?>" class="sidebar-link">
                    <i class="bi-speedometer"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <?php
            if ($user['role_id'] == 1) {
                $url = urlpath("dashboard/pengguna");
                echo '            
            <li class="sidebar-item">
                <a href="' . $url . '" class="sidebar-link">
                    <i class="bi-people"></i>
                    <span>Pengguna</span>
                </a>
            </li>';
            } elseif ($user['role_id'] == 3) {
                $url1 = urlpath("dashboard/buatinformasiloker");
                $url2 = urlpath("dashboard/lamaran");
                echo '            
            <li class="sidebar-item">
                <a href="' . $url1 . '" class="sidebar-link">
                    <i class="bi-newspaper"></i>
                    <span>Buat Informasi Loker</span>
                </a>
            </li>';
                echo '            
            <li class="sidebar-item">
                <a href="' . $url2 . '" class="sidebar-link">
                    <i class="bi-file-earmark-person"></i>
                    <span>Lamaran</span>
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
                                        <a href="#" class="dropdown-item text-muted" data-bs-theme-value="light"><i class="bi-sun"></i> Light</a>
                                        <a href="#" class="dropdown-item text-muted" data-bs-theme-value="dark"><i class="bi-moon"></i> Dark</a>
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
                    <?php
                    if ($user['role_id'] == 1) {
                        echo '<h3 class="fw-bold fs-4 mb-3">Admin Dashboard</h3>';
                    } elseif ($user['role_id'] == 3) {
                        echo '<h3 class="fw-bold fs-4 mb-3">Job Creator Dashboard</h3>';
                    }
                    ?>
                    <div class="row">
                        <?php
                        if ($user['role_id'] == 1) {
                            echo '                        
                        <div class="col-12 col-md-4 ">
                            <div class=" border-0">
                                <div class="-body py-4">
                                    <h5 class="mb-2 fw-bold">
                                        Pengunjung website
                                    </h5>
                                    <div class="d-flex flex-row gap-1">
                                        <p id="totalVisitors" class="mb-2 fw-bold"></p>
                                        <i class="bi-person-fill"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 ">
                            <div class="">
                                <div class="-body py-4">
                                    <h5 class="mb-2 fw-bold">
                                        Total Loker
                                    </h5>
                                    <div class="d-flex flex-row gap-1">
                                        <p id="totalLoker" class="mb-2 fw-bold"></p>
                                        <i class="bi-newspaper"></i>
                                    </div>
                                </div>
                            </div>
                        </div>';
                        }
                        ?>
                    </div>
                    <div>
                    <?php
                        if ($user['role_id'] == 1) {
                            echo '<canvas id="visitorsChart" width="400" height="400"></canvas>';
                        }
                    ?>
                    </div>
                    <?php
                    if ($user['role_id'] == 1) {
                        echo '<h3 class="fw-bold fs-4 my-3">Loker baru hari ini</h3>';
                    } elseif ($user['role_id'] == 3) {
                        echo '<h3 class="fw-bold fs-4 my-3">Loker yang Anda tambahkan</h3>';
                    }
                    ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-end align-items-end pb-2">
                                <button id="refreshButton" class="btn btn-primary"><i class="bi-arrow-clockwise"></i></button>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr class="highlight">
                                        <th scope="col">ID</th>
                                        <th scope="col">Judul Loker</th>
                                        <?php
                                        if ($user['role_id'] == 1) {
                                            echo '<th scope="col">Nama Job Creator</th>';
                                        }
                                        ?>
                                        <th scope="col">Ditambahkan pada</th>
                                    </tr>
                                </thead>
                                <tbody id="dashboardTableBody">
                                </tbody>
                            </table>
                        </div>
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