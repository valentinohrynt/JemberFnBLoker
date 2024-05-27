<?php

// auth
Router::url('login', 'get', 'AuthController::login');
Router::url('login', 'post', 'AuthController::sessionLogin');
Router::url('register', 'get', 'AuthController::register');
Router::url('register/JobSeeker', 'get', 'AuthController::registerJobSeekers');
Router::url('register/JobCreator', 'get', 'AuthController::registerJobCreators');
Router::url('register', 'post', 'AuthController::newRegister');
Router::url('logout', 'get', 'AuthController::logout');

// home
Router::url('home', 'get', 'HomeController::index');
Router::url('home/cariloker', 'get', 'HomeController::cariloker');
Router::url('home/cariloker/detailloker', 'get', 'HomeController::detailloker');
Router::url('home/cariloker/detailloker/lamarkerja', 'get', 'HomeController::lamarkerja');
Router::url('home/cariloker/detailloker/lamarkerja', 'post', 'HomeController::createJobApplication');
Router::url('home/riwayatlamaran', 'get', 'HomeController::riwayatlamaran');
Router::url('home/riwayatlamaran/detailriwayatlamaran', 'get', 'HomeController::detailriwayatlamaran');

// dashboard
Router::url('dashboard', 'get', 'DashboardController::index');
Router::url('dashboard/getvisitorsdata', 'get', 'DashboardController::getTotalVisitorsperDay');
Router::url('dashboard/buatinformasiloker', 'get', 'DashboardController::buatloker');
Router::url('dashboard/buatinformasiloker', 'post', 'DashboardController::createJobVacancy');
Router::url('dashboard/daftarloker', 'get', 'DashboardController::daftarLoker');
Router::url('dashboard/pengguna', 'get', 'DashboardController::pengguna');
Router::url('dashboard/pengguna/jobcreator', 'get', 'DashboardController::pengguna_jobcreator');
Router::url('dashboard/pengguna/jobseeker', 'get', 'DashboardController::pengguna_jobseeker');
Router::url('dashboard/pengguna/jobcreator/detailjobcreator', 'get', 'DashboardController::detailpengguna_jobcreator');
Router::url('dashboard/pengguna/jobseeker/detailjobseeker', 'get', 'DashboardController::detailpengguna_jobseeker');
Router::url('dashboard/pengguna/jobcreator/detailjobcreator/nonaktifkan_jobcreator', 'post', 'DashboardController::nonaktifkan_jobcreator');
Router::url('dashboard/pengguna/jobseeker/detailjobseeker/nonaktifkan_jobseeker', 'post', 'DashboardController::nonaktifkan_jobseeker');
Router::url('dashboard/daftarloker', 'post', 'DashboardController::updateJobVacancy');
Router::url('dashboard/daftarloker/nonaktifkan', 'post', 'DashboardController::updateStatus');
Router::url('dashboard/lamaran', 'get', 'DashboardController::lamaran');
Router::url('dashboard/lamaran/daftarlamaran', 'get', 'DashboardController::daftarlamaran');
Router::url('dashboard/lamaran/daftarlamaran/detaillamaran', 'get', 'DashboardController::detaillamaran');
Router::url('dashboard/lamaran/daftarlamaran/detaillamaran', 'post', 'DashboardController::konfirmasilamaran');

// profile
Router::url('profile', 'get', 'ProfileController::index');
Router::url('profile/ubahprofile', 'get', 'ProfileController::ubahprofil');
Router::url('profile/ubahprofile', 'post', 'ProfileController::simpanubahprofil');
Router::url('profile/change-password', 'get', 'ProfileController::changePassword');
Router::url('profile/change-password', 'post', 'ProfileController::updatePassword');
Router::url('profile/change-password/confirm', 'get', 'ProfileController::confirmChangePassword');

Router::url('/', 'get', function () {
    echo "<script>window.location.href='" . urlpath('home') . "'</script>";
    exit();
});
