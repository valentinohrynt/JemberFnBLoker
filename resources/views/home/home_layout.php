<?php
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}
?>
<?php $title = 'Jember FnB Loker - Home'; ?>

<?php ob_start(); ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
<?php $apiscriptlink = ob_get_clean(); ?>

<?php ob_start(); ?>
<?php include 'assets/css/home-style.css'; ?>
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
                    <a class="nav-link <?= isCurrentPage('home') ?>" href="<?= urlpath('home') ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= isCurrentPage('cariloker') ?>" href="<?= urlpath('home/cariloker') ?>">Cari Loker</a>
                </li>
                <?php if (isset($user) && $user['role_id'] === '2') : ?>
                    <li class="nav-item">
                        <a class="nav-link <?= isCurrentPage('riwayatlamaran') ?>" href="<?= urlpath('home/riwayatlamaran') ?>">Riwayat Lamaran</a>
                    </li>
                <?php endif; ?>
                <?php if (isset($user) && $user['role_id'] === '1' || isset($user) && $user['role_id'] === '3') : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= urlpath('dashboard') ?>">Dashboard</a>
                    </li>
                <?php endif; ?>
                <?php if (isset($user) && $user['role_id'] !== '1') : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= urlpath('profile') ?>">Profil</a>
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
    var latitude = <?php echo $loker_creator['lat']; ?>;
    var longitude = <?php echo $loker_creator['lng']; ?>;
    var map = L.map('map').setView([latitude, longitude], 16);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker = L.marker([latitude, longitude]).addTo(map)
        .bindPopup('Lokasi Perusahaan')
        .openPopup();
</script>
<?php $mapscript = ob_get_clean(); ?>

<?php ob_start(); ?>
<script>
    jQuery.validator.setDefaults({
        ignore: []
    });
    $.validator.addClassRules("d-none", {
        required: false
    });
    $(document).ready(function() {
        $.validator.addMethod("maxfilecount", function(value, element, param) {
            return this.optional(element) || (element.files.length <= param);
        }, $.validator.format("Maksimal {0} dokumen"));
        $.validator.addMethod("minfilecount", function(value, element, param) {
            return this.optional(element) || (element.files.length >= param);
        }, $.validator.format("Minimal {0} dokumen"));
        
        $.validator.addMethod("acceptpdf", function(value, element) {
            return this.optional(element) || /\.(pdf)$/i.test(value);
        }, "Hanya dapat menerima file PDF");
        $('#lamaranKerjaForm').validate({
            rules: {
                'file[]': {
                    required: true,
                    maxfilecount: 3,
                    minfilecount: 3,
                    acceptpdf: true
                }
            },
            messages: {
                'file[]': {
                    required: 'Dokumen - dokumen harus diisi',
                    maxfilecount: 'Maksimal 3 dokumen',
                    minfilecount: 'Minimal 3 dokumen',
                    acceptpdf: 'Hanya dapat menerima file PDF'
                }
            },
            errorElement: 'div',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                if (element.attr('id') == 'file') {
                    error.insertAfter('#dropbox');
                } else {
                    element.closest('.container').append(error);
                }
            },
        });
        $('#send-button').off('click').on('click', function() {
            if ($('#lamaranKerjaForm').valid()) {
                showOverlay()
                var formData = new FormData($('#lamaranKerjaForm')[0]);
                var files = $('#file')[0].files;
                for (var i = 0; i < files.length; i++) {
                    formData.append('file[]', files[i]);
                }
                $.ajax({
                    url: '<?= urlpath('home/cariloker/detailloker/lamarkerja') ?>',
                    method: 'post',
                    data: formData,
                    dataType: 'json',
                    async: true,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            hideOverlay()
                            alert('Lamaran Anda berhasil dikirim!');
                            handleClearButtonClick();
                            resetForm();
                        } else {
                            hideOverlay()
                            alert('Terjadi kesalahan: ' + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Pastikan semua kolom sudah terisi!');
                    }
                });
            }
        });
        function resetForm() {
            var form = $('#lamaranKerjaForm');
            form.validate().resetForm();
            form.find('.is-invalid').removeClass('is-invalid');
            form.find('.is-valid').removeClass('is-valid');
            form[0].reset();
        }
    });
</script>
<?php $customscript = ob_get_clean(); ?>

<?php ob_start(); ?>
<script src="<?= urlpath('assets/js/dropbox-pdf.js') ?>"></script>
<?php $dropboxpdfscript = ob_get_clean(); ?>

<?php ob_start(); ?>
<script>
    let Loker = [];
    let Lamaran = [];
    function isCurrentPage(pageName) {
        const path = window.location.pathname;
        const currentPage = path.substring(path.lastIndexOf('/') + 1);
        return currentPage === pageName;
    }
    $(document).ready(function() {
        if (isCurrentPage('cariloker')) {
            const lokerContainer = $('#loker-cards-container');
            function fetchLokerData() {
                showOverlay()
                $.ajax({
                    url: '<?= urlpath('home/cariloker') ?>',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        hideOverlay()
                        const { active_loker: fetchedLoker, posisi_lowongan: posisiLowongan } = data;
                        Loker = fetchedLoker;
                        displayLoker(Loker);
                    },
                    error: function(error) {
                        hideOverlay()
                        console.error('Error fetching data:', error);
                    }
                });
            }
            fetchLokerData();
            $('#searchInput').keypress(function(event) {
                if (event.keyCode === 13) {
                    search();
                }
            });
            $('#searchInput').on('input', function() {
                if ($(this).val().trim() === '') {
                    search();
                }
            });
            $('#categoryFilter').on('change', function() {
                search();
            });
            function search() {
                const searchTerm = $('#searchInput').val().toLowerCase();
                const categoryFilter = $('#categoryFilter').val(); 
                let filteredLoker = Loker;
        
                if (searchTerm !== '') {
                    filteredLoker = filteredLoker.filter(loker => loker.title.toLowerCase().includes(searchTerm) || loker.jc_name.toLowerCase().includes(searchTerm));
                }
        
                if (categoryFilter !== '') {
                    filteredLoker = filteredLoker.filter(loker => loker.jcat_name.toLowerCase() === categoryFilter.toLowerCase());
                }
                displayLoker(filteredLoker);
            }      
        }
        if (isCurrentPage('riwayatlamaran')) {
            const lokerContainer = $('#loker-list-cards-container');
            function fetchLokerData() {
                showOverlay()
                $.ajax({
                    url: '<?= urlpath('home/riwayatlamaran') ?>',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        hideOverlay()
                        const { loker: fetchedLoker, posisi_lowongan: posisiLowongan, lamaran: lamaran, dokumen_lamaran: dokumen_lamaran } = data;
                        Loker = fetchedLoker;
                        Lamaran = lamaran;
                        displayLoker(Loker, Lamaran);
                    },
                    error: function(error) {
                        hideOverlay()
                        console.error('Error fetching data:', error);
                    }
                });
            }
            fetchLokerData();
            $('#searchInput').keypress(function(event) {
                if (event.keyCode === 13) {
                    searchRiwayat();
                }
            });
            $('#searchInput').on('input', function() {
                if ($(this).val().trim() === '') {
                    searchRiwayat();
                }
            });
            $('#statusFilter').on('change', function() {
                searchRiwayat();
            });
            function searchRiwayat() {
                const searchTerm = $('#searchInput').val().toLowerCase();
                const statusFilter = $('#statusFilter').val().toLowerCase();

                const loker = Loker || [];
                const lamaran = Lamaran || [];

                let filteredLoker = [];

                loker.forEach(lokerItem => {
                    const lamaranForLoker = lamaran.find(l => l.job_vacancy_id === lokerItem.id);
                    const statusMatches = !statusFilter || (lamaranForLoker && lamaranForLoker.status.toLowerCase() === statusFilter);

                    if (statusMatches && (lokerItem.title.toLowerCase().includes(searchTerm) || lokerItem.jc_name.toLowerCase().includes(searchTerm))) {
                        filteredLoker.push(lokerItem);
                    }
                });

                displayLoker(filteredLoker, lamaran);
            }
        }
    });
    if (isCurrentPage('cariloker')) {
        function displayLoker(lokerData) {
                const lokerContainer = $('#loker-cards-container');
                lokerContainer.empty();
                lokerData.forEach(loker => {
                const imgPath = `<?= urlpath('uploads/photo_jobvacancy/') ?>${loker.photo}`;
                const wfo_icon = '<i class="bi-shop"></i>';
                const wfh_icon = '<i class="bi-laptop"></i>';
                const hybrid_icon = '<i class="fa-solid fa-house-laptop"></i>';
                const wfoOrWfhIcon = loker.workplace === 'WFO' ? wfo_icon : loker.workplace === 'WFH' ? wfh_icon : hybrid_icon;
                const card = `
                <div class="col">
                    <a href="<?= urlpath('home/cariloker/detailloker?id=') ?>${loker.id}">
                        <div class="card h-100">
                            <div class="img-container d-flex justify-content-center w-100 h-50">
                                <img src="${imgPath}" class="card-img-top img-fluid" style="object-fit: cover;"
                                    alt="${loker.title}" />
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-truncate">${loker.title}</h5>
                                <p class="card-text text-truncate">${loker.jc_name}</p>
                                <p class="card-text text-truncate"><i class="bi-briefcase-fill"></i> ${loker.jcat_name}</p>
                                <p class="card-text text-truncate"><i class="bi-geo-alt-fill"></i> ${loker.district}, JEMBER</p>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <small class="text-muted"><i class="bi-clock"></i> ${loker.job_time}</small>
                                <small class="text-muted">${wfoOrWfhIcon} ${loker.workplace}</small>
                            </div>
                        </div>
                    </a>
                </div>
                `;
                lokerContainer.append(card);
            });
        }
    }
    if (isCurrentPage('riwayatlamaran')) {
        function displayLoker(lokerData, lamaran) {
            const lokerContainer = $('#loker-list-cards-container');
            lokerContainer.empty();
            lokerData.forEach(loker => {
                const lamaranForLoker = lamaran.find(l => l.job_vacancy_id === loker.id);
                const imgPath = `<?= urlpath('uploads/photo_jobvacancy/') ?>${loker.photo}`;
                const wfo_icon = '<i class="bi-shop"></i>';
                const wfh_icon = '<i class="bi-laptop"></i>';
                const hybrid_icon = '<i class="fa-solid fa-house-laptop"></i>';
                const wfoOrWfhIcon = loker.workplace === 'WFO' ? wfo_icon : loker.workplace === 'WFH' ? wfh_icon : hybrid_icon;
                const process_icon = '<i class="bi-hourglass-split text-warning"></i> Sedang diproses';
                const accepted_icon = '<i class="bi-check-circle text-success"></i> Diterima';
                const rejected_icon = '<i class="bi-x-circle text-danger"></i> Ditolak';
                const statusIcon = lamaranForLoker && lamaranForLoker.status ? 
                    (lamaranForLoker.status === 'process' ? process_icon : 
                    (lamaranForLoker.status === 'accepted' ? accepted_icon : 
                    (lamaranForLoker.status === 'rejected' ? rejected_icon : ''))) : '';
                    const listcard = `
                    <div class="col">
                        <a href="<?= urlpath('home/riwayatlamaran/detailriwayatlamaran?id=') ?>${loker.id}">
                            <div class="list-card">
                                <div class="list-card-img-container d-flex">
                                    <img src="${imgPath}" class="list-card-img-top img-fluid" alt="${loker.title}" />
                                </div>
                                <div class="d-flex flex-column w-100">
                                    <div class="list-card-body">
                                        <h5 class="list-card-title text-truncate">${loker.title}</h5>
                                        <p class="list-card-text text-truncate" >${loker.jc_name}</p>
                                        <p class="list-card-text text-truncate" ><i class="bi-briefcase-fill"></i> ${loker.jcat_name}</p>
                                        <p class="list-card-text text-truncate" "><i class="bi-geo-alt-fill"></i> ${loker.district}, JEMBER</p>
                                        <div class="d-flex justify-content-between">
                                            <p class="list-card-text text-truncate"><i class="bi-"></i> ${loker.job_time}</p>
                                            <p class="list-card-text text-truncate" value="${lamaranForLoker.status}">${statusIcon}</p>
                                        </div>
                                    </div>
                                    <div class="list-card-footer d-flex justify-content-between">
                                        <small class="text-muted"><i class="bi-clock"></i> ${loker.job_time}</small>
                                        <small class="text-muted">${wfoOrWfhIcon} ${loker.workplace}</small>
                                        <small class="text-muted">Terkirim: ${lamaranForLoker ? lamaranForLoker.created_at : 'Unknown'}</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    `;
                lokerContainer.append(listcard);
            });
        }
    }
</script>
<?php $ajaxgetscript = ob_get_clean(); ?>

<?php include 'resources/views/master-layout/master.php'; ?>