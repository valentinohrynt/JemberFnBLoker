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
            <li class="sidebar-item active">
                <a href="<?= urlpath('dashboard/buatinformasiloker') ?>" class="sidebar-link">
                    <i class="bi-newspaper"></i>
                    <span>Buat Informasi Loker</span>
                </a>
            </li>        
            <li class="sidebar-item">
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
                    <h3 class="fw-bold fs-4 mb-3">Buat Informasi Loker Baru</h3>
                    <form id="buatlokerForm" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="d" class="form-label">Judul Loker</label>
                                    <input type="text" class="form-control" id="d" name="d">
                                </div>
                                <div class="mb-3">
                                    <label for="e" class="form-label">Posisi Lowongan Pekerjaan</label>
                                    <select name="e" id="e" class="form-select">
                                        <option value="">Pilih Posisi Loker</option>
                                        <?php foreach ($posisi_lowongan as $pl) : ?>
                                        <option value="<?= $pl['id'] ?>"><?= $pl['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="h" class="form-label">Jam Kerja</label>
                                    <select name="h" id="h" class="form-select">
                                        <option value="">Pilih Jam Kerja</option>
                                        <option value="Full Time">Full Time</option>
                                        <option value="Part Time">Part Time</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="i" class="form-label">Workplace</label>
                                    <select name="i" id="i" class="form-select">
                                        <option value="">Pilih Workplace</option>
                                        <option value="WFO">Work From Office (WFO)</option>
                                        <option value="WFH">Work From Home (WFH)</option>
                                        <option value="Hybrid">Hybrid</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="f" class="form-label">Syarat</label>
                                    <textarea class="form-control" id="f" name="f" rows="20" cols="50"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="g" class="form-label">Foto / Poster</label>
                                    <div id="dropbox" class="custom-file-container"
                                        onclick="document.getElementById('image-upload').click()"
                                        ondragenter="handleDragEnter(event)" ondragover="handleDragOver(event)"
                                        ondragleave="handleDragLeave(event)" ondrop="handleDrop(event)">
                                        <i class="bi bi-cloud-upload cloud-icon"></i>
                                        <p class="text-muted dropbox-default-label">Drag & Drop Foto / Poster disini,
                                            atau klik untuk memilih file</p>
                                        <input name="g" id="image-upload" type="file" accept="image/*" class="d-none"
                                            onchange="handleFileSelect(event)">
                                        <div class="file-name"></div>
                                        <img id="image-preview" class="image-preview d-none">
                                        <button type="button" id="clear-button" class="btn clear-button d-none"
                                            onclick="handleClearButtonClick(event)"><i class="bi-x"></i></button>
                                    </div>
                                </div>
                                <button type="button" id="add-button" class="add-button btn btn-primary"><i class="bi-plus"></i> Tambah</button>
                            </div>
                        </div>
                    </form>
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