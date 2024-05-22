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
            <li class="sidebar-item ">
                <a href="<?= urlpath('dashboard') ?>" class="sidebar-link">
                    <i class="bi-speedometer"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="<?= urlpath('dashboard/buatinformasiloker') ?>" class="sidebar-link">
                    <i class="bi-newspaper"></i>
                    <span>Buat Informasi Loker</span>
                </a>
            </li>
            <li class="sidebar-item  active">
                <a href="<?= urlpath('dashboard/lamaran') ?>" class="sidebar-link">
                    <i class="bi-file-earmark-person"></i>
                    <span>Lamaran</span>
                </a>
            </li>
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
                    <h3 class="fw-bold fs-4 mb-3">Detail Lamaran</h3>
                    <h3 class="fs-6 mb-3 text-muted">Berikut adalah data pelamar dan lowongan yang dilamar</h3>
                    <a href="<?= urlpath('dashboard/lamaran/daftarlamaran?id=' . $loker['id'] . '') ?>"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <div class="row gap-2 justify-content-center pt-3">
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-container d-flex flex-column py-3 px-3">
                                    <div class="card-body d-flex justify-content-center">
                                        <div class="img-container-square gap-0 position-relative">
                                            <img src="<?= urlpath('uploads/photo_jobvacancy/' . $loker['photo']) ?>"
                                                alt="" srcset="">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="card-body">
                                        <h5 class="card-title text-center mb-3">Lowongan</h5>
                                        <div class="text-group d-flex flex-column">
                                            <p><?= $loker['title'] ?></p>
                                        </div>
                                        <p class="card-text mb-3"><i class="fa fa-briefcase"></i> :
                                            <?= $posisi['name'] ?></p>
                                        <p class="card-text mb-3"><i class="fa fa-clock"></i> :
                                            <?= $loker['job_time'] ?></p>
                                        <p class="card-text mb-3">
                                            <?php if($loker['workplace'] === 'WFO'): ?>
                                            <i class="bi-shop"></i> 
                                            <?php elseif($loker['workplace'] === 'WFH'): ?>
                                            <i class="bi-laptop"></i> 
                                            <?php elseif($loker['workplace'] === 'Hybrid'): ?>
                                            <i class="fa-solid fa-house-laptop"></i> 
                                            <?php endif; ?>
                                            : <?= $loker['workplace'] ?></p>
                                        <p class="card-text mb-0">Syarat dan Deskripsi :
                                            <br><?php echo nl2br(htmlspecialchars($loker['requirement'])); ?></p>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <p class="card-text text-end text-muted"><i class="fa fa-clock"></i>
                                        <?= $loker['created_at'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-container d-flex flex-column py-3 px-3">
                                    <div class="card-body d-flex justify-content-center">
                                        <div class="img-container gap-0 position-relative border border-2 border-secondary rounded-circle">
                                            <div class="image-container overflow-hidden position-relative">
                                                <?php if (!$jobSeeker['profile_image']) : ?>
                                                <img src="<?= urlpath('uploads/photo_profile/blank-profile.svg') ?>"
                                                    alt="" class="w-100">
                                                <?php else : ?>
                                                <img src="<?= urlpath('uploads/photo_profile/' . $jobSeeker['profile_image']) ?>"
                                                    alt="" class="w-100 h-100">
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title text-center mt-2 mb-3"><?= $jobSeeker['name'] ?></h5>
                                        <p class="card-text  mb-0"><i class="fa fa-venus-mars"></i> :
                                            <?= $jobSeeker['gender'] == 'L' ? 'Laki-laki' : ($jobSeeker['gender'] == 'P' ? 'Perempuan' : 'Tidak diketahui'); ?>
                                        </p>
                                        <p class="card-text  mb-0"><i class="fa fa-child"></i> :
                                            <?= $jobSeeker['age'] == '' ? 'Tidak diketahui' : $jobSeeker['age']?></p>
                                        <p class="card-text  mb-0"><i class="fa fa-envelope"></i> :
                                            <?= $jobSeekerUser['email'] ?></p>
                                        <p class="card-text  mb-0"><i class="fa fa-phone"></i> :
                                            <?= $jobSeeker['phone'] ?></p>
                                        <p class="card-text  mb-0"><i class="fa fa-map-marker"></i> :
                                            <?= $jobSeeker['street'] ?>,
                                            <?=$district['name']?></p>
                                        <div id="map"></div>
                                    </div>
                                    <hr>
                                    <div class="card-body mb-3">
                                        <h5 class="card-title text-center mb-3">Dokumen</h5>
                                        <?php foreach ($dokumen as $d) : ?>
                                        <p class="card-text text-center">
                                            <a href="<?= urlpath($d['file']) ?>"
                                                class="btn btn-primary text-truncate w-50" download>
                                                <i class="fa fa-cloud-arrow-down"></i> <?= basename($d['file']) ?>
                                            </a>
                                        </p>
                                        <?php endforeach; ?>
                                    </div>
                                    <p class="card-text text-end text-muted"><i class="fa fa-clock"></i>
                                        <?= $lamaran['created_at']?></p>
                                </div>
                                <div class="card-footer d-flex justify-content-center gap-2">
                                    <?php 
                                    if ($lamaran['status'] === 'process'){
                                        echo '<button type="button" id="reject-button" class="reject-button btn btn-danger w-50">Tolak</button>' ;
                                        echo '<button type="button" id="accept-button" class="accept-button btn btn-success w-50">Terima</button>';
                                    } elseif ($lamaran['status'] === 'rejected'){
                                        echo '<p>Ditolak pada: <i class="fa fa-clock"></i> ' . $lamaran['confirmed_at'] . '</p>' ;
                                    } elseif ($lamaran['status'] === 'accepted'){
                                        echo '<p>Disetujui pada: <i class="fa fa-clock"></i> ' . $lamaran['confirmed_at'] . '</p>' ;
                                    } ?>
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