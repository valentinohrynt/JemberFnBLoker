<?php
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}
?>
<?php $title = 'Jember FnB Loker - Profile'; ?>

<?php ob_start(); ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
<?php $apiscriptlink = ob_get_clean(); ?>

<?php ob_start(); ?>
<?php include 'assets/css/home-style.css' ?>
#map { 
    height: 15rem; 
    width: 100%;
}
<?php $style = ob_get_clean();?>

<?php ob_start(); ?>
<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
    <div class="container-fluid d-flex">
        <a class="navbar-brand" href="#">JemberFnBLoker</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                <?php if ((isset($user)) && $user['role_id'] === '2') : ?>
                    <a class="nav-link <?= isCurrentPage('home') ?>" href="<?= urlpath('home') ?>">Home</a>
                <?php else : ?>
                    <a class="nav-link" href="<?= urlpath('dashboard') ?>">Dashboard</a>
                <?php endif; ?>
                </li>
                <li class="nav-item">
                <?php if ((isset($user)) && $user['role_id'] === '2') : ?>
                    <a class="nav-link <?= isCurrentPage('cariloker') ?>" href="<?= urlpath('home/cariloker') ?>">Cari Loker</a>
                <?php elseif ((isset($user)) && $user['role_id'] === '1') : ?>
                    <a class="nav-link" href="<?= urlpath('dashboard/pengguna') ?>">Pengguna</a>
                <?php elseif((isset($user)) && $user['role_id'] === '3'): ?>
                    <a class="nav-link" href="<?= urlpath('dashboard/buatinformasiloker') ?>">Buat Informasi Loker</a>
                <?php endif; ?>
                </li>
                <li class="nav-item">
                <?php if (isset($user) && $user['role_id'] === '2') : ?>
                    <a class="nav-link <?= isCurrentPage('riwayatlamaran') ?>" href="<?= urlpath('home/riwayatlamaran') ?>">Riwayat Lamaran</a>
                <?php elseif ((isset($user)) && $user['role_id'] === '1') : ?>
                    <a class="nav-link" href="<?= urlpath('dashboard/daftarloker') ?>">Daftar Loker</a>
                <?php elseif((isset($user)) && $user['role_id'] === '3'): ?>
                    <a class="nav-link" href="<?= urlpath('dashboard/daftarloker') ?>">Daftar Loker</a>
                <?php else : ?>
                    <a class="nav-link <?= isCurrentPage('hubungikami') ?>" href="#">Hubungi Kami</a>
                <?php endif; ?>
                </li>
                <?php if (isset($user)) : ?>
                    <li class="nav-item">
                        <a class="nav-link <?= isCurrentPage('profil') ?>" href="<?= urlpath('logout') ?>">Profil</a>
                    </li>
                <?php endif; ?>
                <?php if (isset($user)) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= urlpath('logout') ?>">Logout</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= urlpath('login') ?>">Login</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item dropdown">
                    <button id="themeDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi-palette-fill"></i> Theme
                    </button>
                    <ul class="dropdown-menu" aria-labelledBy="themeDropdown">
                        <li><a class="dropdown-item" href="#" data-bs-theme-value="light"><i class="bi-sun"></i> Light Mode</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-theme-value="dark"><i class="bi-moon"></i> Dark Mode</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<?php
if (isset($url)) {
    include $url . '.php';
}
?>
<hr>
<footer>
    <div class="container mb-0">
        <div class="socials">
            <a href="#"><i class="bi-instagram"></i></a>
            <a href="#"><i class="bi-whatsapp"></i></a>
            <a href="#"><i class="bi-tiktok"></i></a>
        </div>
        <div class="credit ">
            <p>Created By <a class="text-decoration-none" href="https://www.instagram.com/varuenta/">Valentino
                    Hariyanto</a> &copy; 2024.</p>
        </div>
    </div>
</footer>
<?php $body = ob_get_clean(); ?>

<?php ob_start(); ?>
<script>
    var latitude = <?php echo $profile['lat']; ?>;
    var longitude = <?php echo $profile['lng']; ?>;
    var map = L.map('map').setView([latitude, longitude], 16);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker = L.marker([latitude, longitude]).addTo(map)
        .bindPopup('Alamat Anda')
        .openPopup();
</script>
<?php $mapscript = ob_get_clean(); ?>

<?php include 'resources/views/master-layout/master.php'; ?>