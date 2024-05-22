<html lang="en" data-bs-theme="dark"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css">
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <link rel="icon" type="image/x-icon" href="https://222410101023.pbw.ilkom.unej.ac.id/uas/assets/img/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Jember FnB Loker - Home</title>
    <style>
        * {
  font-family: Poppins;
}
.main {
  height: auto;
}

.hero {
  position: relative; 
  color: whitesmoke;
  font-size: 3rem;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 1000px;
  background-image: url(assets/img/hero/hero-banner.webp);
  background-size: cover; 
  background-position: center;
}

.hero::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5); 
  z-index: 0;
}

.content {
  position: relative;
  z-index: 2;
}
.mt-custom {
  margin-top: 4rem;
}

footer {
  text-align: center;
  padding: 1rem 0 3rem;
  margin-top: 3rem;
}

footer .socials {
  padding: 1rem 0;
}

footer .socials a {
  color: var(--text-color);
  margin: 1rem;
}

footer .socials a:hover,
footer .links a:hover {
  color: var(--bg);
}

footer .links {
  margin-bottom: 1.4rem;
}

footer .links a {
  color: var(--text-color);
  padding: 0.7rem 1rem;
}

a {
  text-decoration: none;
  color: var(--text-color);
}

footer .credit {
  font-size: 0.8rem;
}

footer .credit a {
  color: var(--bg);
  font-weight: 700;
}

.searchBtn {
  font-size: 1.2rem;
}

.searchBtn:hover {
  color: rgb(128, 128, 128);
}

.card {
  border: none;
  border-radius: 15px;
  overflow: hidden;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s, box-shadow 0.3s;
}

.card:hover {
  transform: translateY(-10px);
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

[data-bs-theme="dark"] .card {
  box-shadow: 0 4px 8px rgba(255, 255, 255, 0.1);
}

[data-bs-theme="dark"] .card:hover {
  box-shadow: 0 8px 16px rgba(255, 255, 255, 0.2);
}
.card-img-top {
  border-top-left-radius: 15px;
  border-top-right-radius: 15px;
}

.card-body {
  padding: 20px;
}

.card-title {
  font-size: 1.25rem;
  font-weight: 600;
  margin-bottom: 10px;
}

.card-text {
  font-size: 1rem;
}

.card-footer {
  border-top: none;
  padding: 15px;
  text-align: right;
}

.card-footer a {
  text-decoration: none;
  font-weight: 600;
}

.card-footer a:hover {
  text-decoration: underline;
}

/* Style for custom file input container */
.container {
  max-width: 800px;
  margin: 50px auto;
}

.custom-file-container {
  border: 1px dashed #ccc;
  border-radius: 5px;
  padding: 20px;
  text-align: center;
  cursor: pointer;
  transition: border-color 0.3s;
  position: relative;
}

.custom-file-container.dragover,
.custom-file-container:hover,
.custom-file-container.active {
  border-color: #007bff;
}

.cloud-icon {
  font-size: 3rem;
  color: rgb(0, 145, 255);
}

.dropbox-default-label {
  margin-top: 10px;
  color: rgba(0, 145, 255, 0.753) !important;
}

.file-list {
  margin-top: 20px;
}

.file-item {
  display: flex;
  align-items: center;
  margin-bottom: 5px;
  margin-right: 1rem;
}

.file-icon {
  margin-right: 10px;
  font-size: 1.5rem;
}

.clear-button {
  position: absolute;
  top: 5px;
  right: 5px;
  background: none;
  border: none;
  cursor: pointer;
}

.custom-close-button {
  position: absolute;
  top: 0.25rem;
  right: 0.5rem;
  font-size: 0.5rem !important;
  opacity: 0.8;
}

.custom-close-button:hover {
  opacity: 1;
}

.alert-dismissible .btn-close {
  padding: 0.5rem;
}

.list-card {
  display: flex;
  flex-direction: row; /* Arrange children horizontally */
  border: none;
  border-radius: 15px;
  overflow: hidden;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s, box-shadow 0.3s;
}

.list-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

[data-bs-theme="dark"] .list-card {
  box-shadow: 0 4px 8px rgba(255, 255, 255, 0.1);
}

[data-bs-theme="dark"] .list-card:hover {
  box-shadow: 0 8px 16px rgba(255, 255, 255, 0.2);
}

.list-card-img-container {
  flex: 0 0 30%;
  border-top-left-radius: 15px;
  border-bottom-left-radius: 15px;
  max-width: 30%;
  object-fit: cover;
}

.list-card-img-top {
  max-height: auto;
  object-fit: cover;
}

.list-card-title {
  font-size: 1.25rem;
  font-weight: 600;
  margin-bottom: 10px;
}

.list-card-body {
  flex: 1;
  padding: 20px;
}

.list-card-footer {
  border-top: none;
  padding: 15px;
  text-align: right;
}

.list-card-footer a {
  text-decoration: none;
  font-weight: 600;
}

.list-card-footer a:hover {
  text-decoration: underline;
}

.image-container {
  border-radius: 50%;
  width: 250px;
  height: 250px;
}

.overlay {
  z-index: 5;
  background-color: white;
  position: absolute;
  opacity: 0;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  transition: opacity 0.3s; /* Add a transition for smoother appearance */
}

.image-container:hover .overlay {
  opacity: 0.5; /* Show the overlay on hover */
}

.btn {
  z-index: 1;
}

/* Ensure the image inside the container maintains aspect ratio and fits within the container */
.img-container .image-container img {
  max-width: 100%; /* Limit the width to fit within the container */
  max-height: 100%; /* Limit the height to fit within the container */
  object-fit: contain; /* Maintain aspect ratio and fit the entire image within the container */
}

/* Center the camera icon inside the image container */
.img-container .image-container .bi-camera {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

/* Overlay styling */
#overlay {
  position: fixed;
  z-index: 9999;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black overlay */
  display: none; /* Initially hidden */
}

/* Spinner styling */
#loading-spinner {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
#map { 
    height: 15rem; 
    width: 100%;
}
    </style>
</head>

<body>
    <div id="overlay" style="display: none;">
        <div id="loading-spinner">
            <img src="https://222410101023.pbw.ilkom.unej.ac.id/uas/assets/img/preloaders/306.png" alt="Loading...">
        </div>
    </div>
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
    <div class="container-fluid d-flex">
        <a class="navbar-brand" href="#">JemberFnBLoker</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="https://222410101023.pbw.ilkom.unej.ac.id/uas/home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="https://222410101023.pbw.ilkom.unej.ac.id/uas/home/cariloker">Cari Loker</a>
                </li>
                                    <li class="nav-item">
                        <a class="nav-link active" href="https://222410101023.pbw.ilkom.unej.ac.id/uas/home/riwayatlamaran">Riwayat Lamaran</a>
                    </li>
                                                    <li class="nav-item">
                        <a class="nav-link" href="https://222410101023.pbw.ilkom.unej.ac.id/uas/profile">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://222410101023.pbw.ilkom.unej.ac.id/uas/logout">Logout</a>
                    </li>
                                <li class="nav-item dropdown">
                    <button id="themeDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi-palette-fill"></i> Theme
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="themeDropdown">
                        <li><a class="dropdown-item" href="#" data-bs-theme-value="light"><i class="bi-sun"></i> Light Mode</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-theme-value="dark"><i class="bi-moon"></i> Dark Mode</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="mt-custom position-relative">
    <div class="position-absolute top-0 start-50 translate-middle-x">
                    </div>
</div>
<section id="main" class="main">
    <div class="container pt-5">
        <h2 class="text-center">Riwayat Lamaran</h2>
        <div class="row pt-5">
            <div class="row content mb-3">
                <div class="col-md-6 mb-3">
                    <div class="d-flex flex-column">
                        <label for="searchInput" class="form-label">Cari berdasarkan judul:</label>
                        <div class="d-flex">
                            <input type="text" id="searchInput" class="form-control">
                            <button type="button" class="searchBtn border-0 bg-transparent"><i class="bi-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="statusFilter" class="form-label">Filter berdasarkan status:</label>
                    <select id="statusFilter" class="form-select">
                        <option value="">Semua</option>
                        <option value="process">Sedang diproses</option>
                        <option value="accepted">Disetujui</option>
                        <option value="rejected">Ditolak</option>
                    </select>
                </div>
            </div>
            <hr>
            <div class="col-md-12">
                <div class="d-flex flex-column gap-3 col-md-12" id="loker-list-cards-container">
                <div class="col">
                    <a href="https://222410101023.pbw.ilkom.unej.ac.id/uas/home/riwayatlamaran/detailriwayatlamaran?id=1">
                        <div class="list-card">
                            <div class="list-card-img-container d-flex">
                                <img src="https://222410101023.pbw.ilkom.unej.ac.id/uas/uploads/photo_jobvacancy/photo_jobvacancy_1.webp" class="list-card-img-top img-fluid" alt="Dcost Jember lagi cari kasir nih!">
                            </div>
                            <div class="d-flex flex-column w-100">
                                <div class="list-card-body">
                                    <h5 class="list-card-title text-truncate">Dcost Jember lagi cari kasir nih!</h5>
                                    <p class="list-card-text text-truncate">Lippo Mall</p>
                                    <p class="list-card-text text-truncate"><i class="bi-briefcase-fill"></i> Kasir</p>
                                    <p class="list-card-text text-truncate" "=""><i class="bi-geo-alt-fill"></i> KALIWATES, JEMBER</p>
                                    <div class="d-flex justify-content-between">
                                        <p class="list-card-text text-truncate"><i class="bi-"></i> Full Time</p>
                                        <p class="list-card-text text-truncate" value="rejected"><i class="bi-x-circle text-danger"></i> Ditolak</p>
                                    </div>
                                </div>
                                <div class="list-card-footer d-flex justify-content-between">
                                    <small class="text-muted"><i class="bi-clock"></i> Full Time</small>
                                    <small class="text-muted"><i class="bi-shop"></i> WFO</small>
                                    <small class="text-muted">Terkirim: 2024-05-21 20:55:34</small>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col">
                    <a href="https://222410101023.pbw.ilkom.unej.ac.id/uas/home/riwayatlamaran/detailriwayatlamaran?id=2">
                        <div class="list-card">
                            <div class="list-card-img-container d-flex">
                                <img src="https://222410101023.pbw.ilkom.unej.ac.id/uas/uploads/photo_jobvacancy/photo_jobvacancy_2.webp" class="list-card-img-top img-fluid" alt="KFC Lippo Jember mencari kasir">
                            </div>
                            <div class="d-flex flex-column w-100">
                                <div class="list-card-body">
                                    <h5 class="list-card-title text-truncate">KFC Lippo Jember mencari kasir</h5>
                                    <p class="list-card-text text-truncate">Lippo Mall</p>
                                    <p class="list-card-text text-truncate"><i class="bi-briefcase-fill"></i> Kasir</p>
                                    <p class="list-card-text text-truncate" "=""><i class="bi-geo-alt-fill"></i> KALIWATES, JEMBER</p>
                                    <div class="d-flex justify-content-between">
                                        <p class="list-card-text text-truncate"><i class="bi-"></i> Full Time</p>
                                        <p class="list-card-text text-truncate" value="process"><i class="bi-hourglass-split text-warning"></i> Sedang diproses</p>
                                    </div>
                                </div>
                                <div class="list-card-footer d-flex justify-content-between">
                                    <small class="text-muted"><i class="bi-clock"></i> Full Time</small>
                                    <small class="text-muted"><i class="bi-shop"></i> WFO</small>
                                    <small class="text-muted">Terkirim: 2024-05-21 19:27:30</small>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                </div>
            </div>
        </div>
    </div>
</section><hr>
<footer>
    <div class="container mb-0">
        <div class="socials">
            <a href="#"><i class="bi-instagram"></i></a>
            <a href="#"><i class="bi-whatsapp"></i></a>
            <a href="#"><i class="bi-tiktok"></i></a>
        </div>
        <div class="credit ">
            <p>Created By <a class="text-decoration-none" href="https://www.instagram.com/varuenta/">Valentino
                    Hariyanto</a> © 2024.</p>
        </div>
    </div>
</footer>
    <script>
    var latitude = ;
    var longitude = ;
    var map = L.map('map').setView([latitude, longitude], 16);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker = L.marker([latitude, longitude]).addTo(map)
        .bindPopup('Lokasi Perusahaan')
        .openPopup();
</script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://222410101023.pbw.ilkom.unej.ac.id/uas/assets/js/dropbox-pdf.js"></script>
            <script src="https://222410101023.pbw.ilkom.unej.ac.id/uas/assets/js/theme.js"></script>
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
                    acceptpdf: true // Using the custom rule for accepting only PDF files
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
                    url: 'https://222410101023.pbw.ilkom.unej.ac.id/uas/home/cariloker/detailloker/lamarkerja',
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
                    url: 'https://222410101023.pbw.ilkom.unej.ac.id/uas/home/cariloker',
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
                    filteredLoker = filteredLoker.filter(loker => loker.title.toLowerCase().includes(searchTerm));
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
                    url: 'https://222410101023.pbw.ilkom.unej.ac.id/uas/home/riwayatlamaran',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        hideOverlay()
                        const { loker: fetchedLoker, posisi_lowongan: posisiLowongan, lamaran: lamaran, dokumen_lamaran: dokumen_lamaran } = data;
                        Loker = fetchedLoker;
                        Lamaran = lamaran;
                        displayLoker(Loker, posisiLowongan, Lamaran, dokumen_lamaran);
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
                if ($(this).val() === '') {
                    search();
                }
            });
            $('#statusFilter').on('change', function() {
                search();
            });
            function search() {
                const searchTerm = $('#searchInput').val().toLowerCase();
                const statusFilter = $('#statusFilter').val();
                let filteredLoker = Loker;
                let filteredLamaran = Lamaran;

                if (searchTerm !== '') {
                    filteredLoker = filteredLoker.filter(Loker => Loker.title.toLowerCase().includes(searchTerm));
                }

                if (statusFilter !== '') {
                    console.log('Before filtering:', filteredLamaran); // Log before filtering
                    filteredLamaran = filteredLamaran.filter(lamaran => {
                        console.log('Current lamaran:', lamaran); // Log current lamaran
                        return lamaran?.status?.toLowerCase() === statusFilter.toLowerCase();
                    });
                    console.log('After filtering:', filteredLamaran); // Log after filtering
                }


                if (statusFilter !== '' && filteredLamaran.length === 0) {
                    console.log('No status matches the filter');
                }

                displayLoker(filteredLoker, [], filteredLamaran, []);
            }
        }
    });
    function displayLoker(lokerData, posisiLowongan, lamaran, dokumen_lamaran) {
        if(isCurrentPage('cariloker')){
            const lokerContainer = $('#loker-cards-container');
            lokerContainer.empty();
            lokerData.forEach(loker => {
                const imgPath = `https://222410101023.pbw.ilkom.unej.ac.id/uas/uploads/photo_jobvacancy/${loker.photo}`;
                const wfo_icon = '<i class="bi-shop"></i>';
                const wfh_icon = '<i class="bi-laptop"></i>';
                const hybrid_icon = '<i class="fa-solid fa-house-laptop"></i>';
                const wfoOrWfhIcon = loker.workplace === 'WFO' ? wfo_icon : loker.workplace === 'WFH' ? wfh_icon : hybrid_icon;
                    const card = `
                        <div class="col">
                            <a href="https://222410101023.pbw.ilkom.unej.ac.id/uas/home/cariloker/detailloker?id=${loker.id}">
                                <div class="card h-100">
                                    <div class="img-container d-flex justify-content-center w-100 h-50">
                                        <img src="${imgPath}" class="card-img-top img-fluid" style="object-fit: cover;" alt="${loker.title}" />
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
        if(isCurrentPage('riwayatlamaran')){
            const lokerContainer = $('#loker-list-cards-container');
            lokerContainer.empty();
            lokerData.forEach(loker => {
                const lamaranForLoker = lamaran.find(l => l.job_vacancy_id === loker.id);
                const imgPath = `https://222410101023.pbw.ilkom.unej.ac.id/uas/uploads/photo_jobvacancy/${loker.photo}`;
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
                    <a href="https://222410101023.pbw.ilkom.unej.ac.id/uas/home/riwayatlamaran/detailriwayatlamaran?id=${loker.id}">
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
        <script>
        function showOverlay() {
            $('#overlay').fadeIn();
        }

        function hideOverlay() {
            $('#overlay').fadeOut();
        }
    </script>


</body></html>