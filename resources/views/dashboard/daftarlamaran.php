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
            <div class="container-fluid">
                <div class="mb-3">
                    <a href="<?= urlpath('dashboard/lamaran') ?>"><i class="fas fa-arrow-left"></i> Kembali</a>
                    <h3 class="fw-bold fs-4 mb-3 mt-2">Daftar Lamaran</h3>
                    <div class="row mb-5">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <small class="text-muted pb-2">Berikut adalah daftar lamaran untuk lowongan kerja</small>
                                </div>
                            </div>
                            <table id="activeTable" class="table table-striped">
                                <thead>
                                    <tr class="highlight">
                                        <th scope="col">ID</th>
                                        <th scope="col">Nama Pelamar Kerja</th>
                                        <th scope="col">Telepon</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Tanggal Pelamaran</th>
                                        <th scope="col">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($lamaran as $l): ?>
                                    <tr class="text-truncate">
                                        <td class="text-truncate" style="max-width: 5rem;"><?= $l['id'] ?></td>
                                        <td class="text-truncate" style="max-width: 5rem;"><?= $l['job_seeker']['name'] ?></td>
                                        <td class="text-truncate" style="max-width: 5rem;"><?= $l['job_seeker']['phone'] ?></td>
                                        <td class="text-truncate" style="max-width: 5rem;"><?= $l['job_seeker']['street'] ?>, <?= $l['job_seeker']['district']['name'] ?></td>
                                        <td class="text-truncate" style="max-width: 5rem;"><?= $l['created_at']?></td>
                                        <td>
                                            <a href="<?= urlpath('dashboard/lamaran/daftarlamaran/detaillamaran?id='. $l['id']) ?>"
                                                class="btn btn-info text-white"><i class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="mb-3">
                    <h3 class="fw-bold fs-4 mb-3 mt-2">Lamaran yang sudah dikonfirmasi</h3>
                    <div class="row mb-5">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <small class="text-muted pb-2">Berikut adalah daftar lamaran untuk lowongan kerja yang sudah dikonfirmasi</small>
                                </div>
                            </div>
                            <table id="activeTable" class="table table-striped">
                                <thead>
                                    <tr class="highlight">
                                        <th scope="col">ID</th>
                                        <th scope="col">Nama Pelamar Kerja</th>
                                        <th scope="col">Telepon</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Tanggal Pelamaran</th>
                                        <th scope="col">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($lamaranConfirmed as $l): ?>
                                    <tr  class="text-truncate">
                                        <td class="text-truncate" style="max-width: 5rem;"><?= $l['id'] ?></td>
                                        <td class="text-truncate" style="max-width: 5rem;"><?= $l['job_seeker']['name'] ?></td>
                                        <td class="text-truncate" style="max-width: 5rem;"><?= $l['job_seeker']['phone'] ?></td>
                                        <td class="text-truncate" style="max-width: 5rem;"><?= $l['job_seeker']['street'] ?>, <?= $l['job_seeker']['district']['name'] ?></td>
                                        <td class="text-truncate" style="max-width: 5rem;"><?= $l['created_at']?></td>
                                        <td>
                                            <a href="<?= urlpath('dashboard/lamaran/daftarlamaran/detaillamaran?id='. $l['id']) ?>"
                                                class="btn btn-info text-white"><i class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
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