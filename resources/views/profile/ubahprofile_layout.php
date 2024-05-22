<?php
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}
?>
<?php $title = 'Jember FnB Loker - Ubah Profile'; ?>

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
.leaflet-control-geocoder-form{
    background-color: orange;
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
    var jemberBounds = L.latLngBounds(
        L.latLng(-8.5, 113.2), // lower left
        L.latLng(-7.9, 114.1) // upper right
    );
    map.fitBounds(jemberBounds);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker = L.marker([latitude, longitude]).addTo(map)
        .bindPopup('Alamat Anda')
        .openPopup();

    var geocoder = L.Control.geocoder().addTo(map);

    map.on('click', function(e) {
        var latlng = e.latlng;
        if (!jemberBounds.contains(latlng)) {
            alert("You can't click outside of Jember!");
            return;
        }
        if (marker) {
            map.removeLayer(marker);
        }
        marker = L.marker(latlng).addTo(map);
        console.log(latlng);
    });

    geocoder.on('markgeocode', function(e) {
        var latlng = e.geocode.center;
        if (!jemberBounds.contains(latlng)) {
            alert("You can't search outside of Jember!");
            return;
        }
        if (marker) {
            map.removeLayer(marker);
        }
        marker = L.marker(latlng).addTo(map);
        console.log(latlng);
    });
</script>
<?php $mapscript = ob_get_clean(); ?>

<?php ob_start(); ?>
<script>
    document.getElementById('imageInput').addEventListener('change', function () {
        var file = this.files[0];
        var reader = new FileReader();
        reader.onload = function (e) {
            var imagePreview = document.getElementById('imagePreview');
            imagePreview.innerHTML = '<img src="' + e.target.result + '" class="w-100 h-100">';
        };
        reader.readAsDataURL(file);
    });

    document.getElementById('saveImage').addEventListener('click', function () {
        const fileInput = document.getElementById('imageInput');
        const file = fileInput.files[0];
        var imagePreview = document.getElementById('imagePreview');
        var mainImageContainer = document.querySelector('.image-container');
        mainImageContainer.innerHTML = imagePreview.innerHTML;
        // Here, you can save the image data or perform other actions
    });
</script>
<?php $customscript = ob_get_clean(); ?>

<?php if ($user['role_id'] === '2') : ?>
<?php ob_start(); ?>
<script>
    $(document).ready(function() {
        $('#editProfileForm').validate({
            rules: {
                name: {
                    required: true
                },
                gender: {
                    required: true
                },
                age: {
                    required: true,
                    digits: true,
                    min: 1
                },
                phone: {
                    required: true,
                    digits: true,
                    minlength: 10
                },
                email: {
                    required: true,
                    email: true
                },
                street: {
                    required: true
                },
                district_id: {
                    required: true
                },
                username: {
                    required: true
                },
                password: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Silakan masukkan nama Anda"
                },
                gender: {
                    required: "Silakan pilih jenis kelamin Anda"
                },
                age: {
                    required: "Silakan masukkan usia Anda",
                    digits: "Masukkan usia yang valid (hanya angka)",
                    min: "Usia harus berupa angka positif"
                },
                phone: {
                    required: "Silakan masukkan nomor telepon Anda",
                    digits: "Silakan masukkan nomor telepon yang valid",
                    minlength: "Nomor telepon harus memiliki setidaknya 10 digit"
                },
                email: {
                    required: "Silakan masukkan Email Anda",
                    email: "Silakan masukkan Email yang valid"
                },
                street: {
                    required: "Silakan masukkan alamat jalan Anda"
                },
                district_id: {
                    required: "Silakan pilih distrik Anda"
                },
                username: {
                    required: "Silakan masukkan nama pengguna Anda"
                },
                password: {
                    required: "Silakan masukkan kata sandi Anda"
                }
            },
            errorElement: "div",
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.card-body').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid').addClass('is-valid');
            },
            submitHandler: function(form) {
                event.preventDefault();
                var formData = new FormData(form);
                if ($('#imageInput')[0].files.length > 0) {
                    formData.append('image', $('#imageInput')[0].files[0]);
                }
                formData.append('lat', (marker.getLatLng().lat).toFixed(8));
                formData.append('lng', (marker.getLatLng().lng).toFixed(8));
                sendFormData(formData);
            }
        });

        function sendFormData(formData) {
            if ($('#editProfileForm').valid()) {
                showOverlay()
                try {
                    $.ajax({
                        type: 'POST',
                        url: '<?= urlpath('profile/ubahprofile') ?>',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            hideOverlay()
                            var data = JSON.parse(response);
                            if (data.status === 'success') {
                                alert(data.message);
                                window.location.href = '<?= urlpath('profile') ?>';
                            } else if (data.status === 'error') {
                                alert(data.message);
                            } else if (data.status === 'view') {
                                alert(data.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            hideOverlay()
                            console.error("Error: " + error);
                            console.error("Status: " + status);
                            console.error("Response: " + xhr.responseText);
                            alert('Terjadi kesalahan saat mengubah profil. Silakan coba lagi.');
                        }
                    });
                } catch (e) {
                    hideOverlay()
                    console.error("Exception: " + e.message);
                    alert('Terjadi kesalahan tak terduga. Silakan coba lagi.');
                }
            }
        }
    });
</script>
<?php $ajaxpostscript = ob_get_clean(); ?>
<?php endif; ?>

<?php if ($user['role_id'] === '3') : ?>
<?php ob_start(); ?>
<script>
    $(document).ready(function() {
        $('#editProfileForm').validate({
            rules: {
                name: {
                    required: true
                },
                gender: {
                    required: true
                },
                age: {
                    required: true,
                    digits: true,
                    min: 1
                },
                phone: {
                    required: true,
                    digits: true,
                    minlength: 10
                },
                email: {
                    required: true,
                    email: true
                },
                street: {
                    required: true
                },
                district_id: {
                    required: true
                },
                username: {
                    required: true
                },
                password: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Silakan masukkan nama Anda"
                },
                gender: {
                    required: "Silakan pilih jenis kelamin Anda"
                },
                age: {
                    required: "Silakan masukkan usia Anda",
                    digits: "Masukkan usia yang valid (hanya angka)",
                    min: "Usia harus berupa angka positif"
                },
                phone: {
                    required: "Silakan masukkan nomor telepon Anda",
                    digits: "Silakan masukkan nomor telepon yang valid",
                    minlength: "Nomor telepon harus memiliki setidaknya 10 digit"
                },
                email: {
                    required: "Silakan masukkan Email Anda",
                    email: "Silakan masukkan Email yang valid"
                },
                street: {
                    required: "Silakan masukkan alamat jalan Anda"
                },
                district_id: {
                    required: "Silakan pilih distrik Anda"
                },
                username: {
                    required: "Silakan masukkan nama pengguna Anda"
                },
                password: {
                    required: "Silakan masukkan kata sandi Anda"
                }
            },
            errorElement: "div",
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.card-body').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid').addClass('is-valid');
            },
            submitHandler: function(form) {
                event.preventDefault();
                var formData = new FormData(form);
                if ($('#imageInput')[0].files.length > 0) {
                    formData.append('image', $('#imageInput')[0].files[0]);
                }
                formData.append('lat', (marker.getLatLng().lat).toFixed(8));
                formData.append('lng', (marker.getLatLng().lng).toFixed(8));
                sendFormData(formData);
            }
        });

        function sendFormData(formData) {
            if ($('#editProfileForm').valid()) {
                showOverlay()
                try {
                    $.ajax({
                        type: 'POST',
                        url: '<?= urlpath('profile/ubahprofile') ?>',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            hideOverlay()
                            var data = JSON.parse(response);
                            if (data.status === 'success') {
                                alert(data.message);
                                window.location.href = '<?= urlpath('profile') ?>';
                            } else if (data.status === 'error') {
                                alert(data.message);
                            } else if (data.status === 'view') {
                                alert(data.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            hideOverlay()
                            console.error("Error: " + error);
                            console.error("Status: " + status);
                            console.error("Response: " + xhr.responseText);
                            alert('Terjadi kesalahan saat mengubah profil. Silakan coba lagi.');
                        }
                    });
                } catch (e) {
                    hideOverlay()
                    console.error("Exception: " + e.message);
                    alert('Terjadi kesalahan tak terduga. Silakan coba lagi.');
                }
            }
        }
    });
</script>
<?php $ajaxpostscript = ob_get_clean(); ?>
<?php endif; ?>

<?php include 'resources/views/master-layout/master.php'; ?>