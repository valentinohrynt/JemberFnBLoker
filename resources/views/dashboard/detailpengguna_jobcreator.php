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
                    <h3 class="fw-bold fs-4 mb-3">Detail Pengguna</h3>
                    <h3 class="fs-6 mb-3 text-muted">Berikut adalah detail pengguna</h3>
                    <a href="<?= urlpath('dashboard/pengguna/jobcreator') ?>"><i class="fa fa-arrow-left"></i>
                        Kembali</a>
                    <div class="row justify-content-center pt-3">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-container d-flex flex-column py-3 px-3">
                                    <div class="card-body d-flex justify-content-center">
                                        <div class="img-container-square gap-0 position-relative">
                                            <?php if (!$data['profile_image']) : ?>
                                            <img src="<?= urlpath('uploads/photo_profile/blank-profile.svg') ?>" alt="" class="w-100">
                                                <?php else : ?>
                                                <img src="<?= urlpath('uploads/photo_profile/'.$data['profile_image']) ?>" alt="" class="w-100 h-100">
                                                <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="card-body mb-3">
                                        <h5 class="card-title text-center mt-2 mb-3"><?= $data['name'] ?></h5>
                                        <p class="card-text mb-0"><i class="fa fa-envelope"></i> : <?= $dataUser['email'] ?></p>
                                        <p class="card-text mb-0"><i class="fa fa-phone"></i> : <?= $data['phone'] ?></p>
                                        <p class="card-text mb-0"><i class="fa fa-map-marker"></i> : <?= $data['street'] ?>, <?=$district['name']?></p>
                                    </div>
                                    <div id="map"></div>
                                    <hr>
                                </div>
                                <div class="card-footer d-flex flex-column align-items-center gap-2">
                                    <?php 
                                    if ($dataUser['status'] === 'active'){
                                        echo '<p>Registrasi pada: <i class="fa fa-clock"></i> ' . $dataUser['created_at'] . '</p>' ;
                                    } elseif ($dataUser['status'] === 'accepted'){
                                        echo '<p>Disetujui pada: <i class="fa fa-clock"></i> ' . $dataUser['updated_at'] . '</p>' ;
                                    } ?>
                                    <div class="button-group">
                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmationModal">Nonaktifkan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="confirmationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="confirmationModalLabel">Konfirmasi Penonaktifan</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah anda yakin ingin menonaktifkan akun ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <form action="<?= urlpath('dashboard/pengguna/jobcreator/detailjobcreator/nonaktifkan_jobcreator') ?>" method="POST">
                                    <input type="hidden" name="a" value="<?= $dataUser['id'] ?>">
                                    <input type="hidden" name="b" value="<?= $data['id'] ?>">
                                    <button type="submit" class="btn btn-danger" id="confirmationButton">Nonaktifkan</button>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer class="footer">
            <div class="container-fluid">
                <div class="row text-body-secondary">
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