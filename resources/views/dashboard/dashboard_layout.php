<?php
$user = $_SESSION['user'];
?>

<?php $title = 'JemberFnBLoker - Dashboard'; ?>

<?php ob_start(); ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
<?php $apiscriptlink = ob_get_clean(); ?>

<?php ob_start(); ?>
<?php include 'assets/css/dashboard-style.css' ?>
#map { 
    height: 15rem; 
    width: 100%;
}
<?php $style = ob_get_clean();?>

<?php ob_start(); ?>
<?php
if (isset($url)) {
    include $url . '.php';
}
?>
<?php $body = ob_get_clean(); ?>

<?php if (isCurrentPage('detaillamaran')): ?>
<?php ob_start(); ?>
<script>
    var latitude = <?php echo $jobSeeker['lat']; ?>;
    var longitude = <?php echo $jobSeeker['lng']; ?>;
    var map = L.map('map').setView([latitude, longitude], 16);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker = L.marker([latitude, longitude]).addTo(map)
        .bindPopup('Alamat Pelamar Kerja')
        .openPopup();
</script>
<?php $mapscript = ob_get_clean(); ?>
<?php endif; ?>

<?php if (isCurrentPage('detailjobcreator')): ?>
<?php ob_start(); ?>
<script>
    var latitude = <?php echo $data['lat']; ?>;
    var longitude = <?php echo $data['lng']; ?>;
    var map = L.map('map').setView([latitude, longitude], 16);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker = L.marker([latitude, longitude]).addTo(map)
        .bindPopup('Alamat Job Creator')
        .openPopup();
</script>
<?php $mapscript = ob_get_clean(); ?>
<?php endif; ?>

<?php if (isCurrentPage('detailjobseeker')): ?>
<?php ob_start(); ?>
<script>
    var latitude = <?php echo $data['lat']; ?>;
    var longitude = <?php echo $data['lng']; ?>;
    var map = L.map('map').setView([latitude, longitude], 16);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker = L.marker([latitude, longitude]).addTo(map)
        .bindPopup('Alamat Job Seeker')
        .openPopup();
</script>
<?php $mapscript = ob_get_clean(); ?>
<?php endif; ?>

<?php ob_start(); ?>
<script>
    $(document).ready(function() {
        $('#buatlokerForm').validate({
            rules: {
                d: 'required',
                f: 'required',
                e: {
                    required: true,
                    min: 1
                },
                g: 'required',
                h: 'required',
                i: 'required'
            },
            messages: {
                d: 'Judul loker harus diisi',
                f: 'Syarat harus diisi',
                e: {
                    required: 'Pilih posisi lowongan kerja',
                    min: 'Pilih posisi lowongan kerja'
                },
                g: 'Foto / Poster harus diisi',
                h: 'Jam kerja harus diisi',
                i: 'Workplace harus diisi'
            },
            errorElement: 'div',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.mb-3').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid').addClass('is-valid');
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
    $(document).ready(function() {
        $('#editlokerForm').validate({
            rules: {
                d: 'required',
                f: 'required',
                e: {
                    required: true,
                    min: 1
                },
                g: 'required',
                h: 'required',
                i: 'required'
            },
            messages: {
                d: 'Judul loker harus diisi',
                f: 'Syarat harus diisi',
                e: {
                    required: 'Pilih posisi lowongan kerja',
                    min: 'Pilih posisi lowongan kerja'
                },
                g: 'Foto / Poster harus diisi',
                h: 'Jam kerja harus diisi',
                i: 'Workplace harus diisi'
            },
            errorElement: 'div',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.mb-3').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid').addClass('is-valid');
            },
            
        });
    });
</script>
<?php $customscript = ob_get_clean(); ?>

<?php ob_start(); ?>
<script>
    $(document).ready(function() {
        function filterRows(searchText) {
            $('#activeTable tbody tr').each(function() {
                var judulLoker = $(this).find('td:eq(1)').text().toLowerCase();
                var namaJobCreator = $(this).find('td:eq(2)').text().toLowerCase();
                if (searchText === '' || judulLoker.includes(searchText) || namaJobCreator.includes(searchText)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }
        $('#searchButton').on('click', function() {
            var searchText = $('#searchInput').val().toLowerCase();
            filterRows(searchText);
        });
        $('#searchInput').on('keydown', function(event) {
            if (event.key === "Enter") {
                var searchText = $(this).val().toLowerCase();
                filterRows(searchText);
            }
        });
        $('#searchInput').on('input', function() {
            var searchText = $(this).val().toLowerCase();
            if (searchText === '') {
                $('#activeTable tbody tr').show();
            }
        });
    });
</script>
<?php $searchscript = ob_get_clean(); ?>

<?php ob_start(); ?>
<script src="<?= urlpath('assets/js/dropbox-image.js') ?>"></script>
<?php $dropboximgscript = ob_get_clean(); ?>

<?php ob_start(); ?>
<script src="<?= urlpath('assets/js/dashboard-script.js') ?>"></script>
<?php $dashboardscript = ob_get_clean(); ?>

<?php ob_start(); ?>
<script>
    $(document).ready(function() {
        function refreshTable() {
            // Fetch $totalVisitors
            $.ajax({
                
                url: "<?= urlpath('dashboard') ?>",
                method: 'get',
                dataType: 'json',
                success: function(data) {
                    $('#totalVisitors').text(data.total_visitors);
                    console.log(data.total_visitors);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX request failed:', error);
                }
            });

            // Fetch $totalLoker
            $.ajax({
                url: "<?= urlpath('dashboard') ?>",
                method: 'get',
                dataType: 'json',
                success: function(data) {
                    $('#totalLoker').text(data.total_loker);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX request failed:', error);
                }
            });

            // Fetch $loker
            $.ajax({
                url: "<?= urlpath('dashboard') ?>",
                method: 'get',
                dataType: 'json',
                success: function(data) {
                    $('#dashboardTableBody').empty();
                    $.each(data.loker, function(index, item) {
                        var newRow = $('<tr>');
                        if (data.user.role_id == 1) {
                            var columnsToShow = ['id', 'title', 'jc_name', 'created_at'];
                        } else if (data.user.role_id == 3) {
                            var columnsToShow = ['id', 'title', 'created_at'];
                        }
                        $.each(columnsToShow, function(_, column) {
                            var newCell = $('<td>').text(item[column]);
                            newRow.append(newCell);
                        });
                        $('#dashboardTableBody').append(newRow);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('AJAX request failed:', error);
                }
            });

            // Fetch $inactive_loker
            $.ajax({
                url: "<?= urlpath('dashboard/daftarloker') ?>",
                method: 'get',
                dataType: 'json',
                success: function(data) {
                    $('#dashboardinactiveTableBody').empty();
                    $.each(data.inactive_loker, function(index, item) {
                        var newRow = $('<tr>');
                        if (data.user.role_id == 1) {
                            var columnsToShow = ['id', 'title', 'jc_name', 'created_at'];
                            $.each(columnsToShow, function(_, column) {
                                var newCell = $('<td>').text(item[column]);
                                newRow.append(newCell);
                            })
                        } else if (data.user.role_id == 3) {
                            var columnsToShow = ['id', 'title', 'created_at'];
                            $.each(columnsToShow, function(_, column) {
                                var newCell = $('<td>').text(item[column]);
                                newRow.append(newCell);
                            });
                        }
                        $('#dashboardinactiveTableBody').append(newRow);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('AJAX request failed:', error);
                }
            });

            //Fetch $active_loker
            $.ajax({
                url: "<?= urlpath('dashboard/daftarloker') ?>",
                method: 'get',
                dataType: 'json',
                success: function(data) {
                    $('#dashboardactiveTableBody').empty();
                    $.each(data.active_loker, function(index, item) {
                        var newRow = $('<tr>');
                        if (data.user.role_id == 1) {
                            var columnsToShow = ['id', 'title', 'jc_name', 'created_at'];
                            $.each(columnsToShow, function(_, column) {
                                var newCell = $('<td>').text(item[column]);
                                newRow.append(newCell);
                            });

                        } else if (data.user.role_id == 3) {
                            var columnsToShow = ['id', 'title', 'created_at'];
                            $.each(columnsToShow, function(_, column) {
                                var newCell = $('<td>').text(item[column]);
                                newRow.append(newCell);
                            });
                            var editButton = $('<button>').addClass('btn btn-primary btn-sm edit-button').text('Edit');
                            editButton.on('click', function() {
                                var row = $(this).closest('tr');
                                var jobId = row.find('td:first').text();
                                var jobDetails = data.active_loker.find(function(item) {
                                    return item.id == jobId;
                                });
                                var photoName = jobDetails.photo;
                                var imageUrl = '<?= urlpath('uploads/photo_jobvacancy/') ?>' + photoName;

                                $('#editModal').find('#d').val(jobDetails.title);
                                $('#editModal').find('#f').val(jobDetails.requirement);
                                $('#e').empty();
                                $.each(data.posisi_lowongan, function(index, item) {
                                    var option = $('<option>').val(item.id).text(item.name);
                                    if (item.id == jobDetails.job_category_id) {
                                        option.prop('selected', true);
                                        option.text(item.name);
                                    }
                                    $('#e').append(option);
                                });
                                $('#editModal').find('#h').val(jobDetails.job_time);
                                $('#editModal').find('#i').val(jobDetails.workplace);

                                $('#image-preview').attr('src', imageUrl).removeClass('d-none');
                                $('#editModal').modal('show');
                                $('#editModal .save-button').data('jobId', jobId);
                            });
                            var editCell = $('<td>').append(editButton);
                            newRow.append(editCell);
                            $('#editModal .save-button').off('click').on('click', function() {
                                showOverlay();
                                if ($('#editlokerForm').valid()) {
                                    var formData = new FormData();
                                    formData.append('d', $('#d').val());
                                    formData.append('e', $('#e').val());
                                    formData.append('f', $('#f').val());
                                    formData.append('h', $('#h').val());
                                    formData.append('i', $('#i').val());
                                    var fileInput = $('#image-upload')[0];
                                    formData.append('g', fileInput.files[0]);
                                    var jobId = $(this).data('jobId');
                                    formData.append('id', jobId);
                                    jobId = $(this).data('jobId');
                                    $.ajax({
                                        url: '<?= urlpath('dashboard/daftarloker') ?>',
                                        method: 'post',
                                        data: formData,
                                        dataType: 'json',
                                        async: true,
                                        processData: false,
                                        contentType: false,
                                        success: function(response) {
                                            hideOverlay();
                                            alert('Loker berhasil diedit!');
                                            refreshTable();
                                            $('#editModal').modal('hide');
                                        },
                                        error: function(xhr, status, error) {
                                            hideOverlay();
                                            console.error('AJAX request failed:', error);
                                        }
                                    });
                                }
                            });
                            function resetForm() {
                                var form = $('#editlokerForm');
                                form.validate().resetForm();
                                form.find('.is-invalid').removeClass('is-invalid');
                                form.find('.is-valid').removeClass('is-valid');
                                form[0].reset();
                            }
                            $('#editModal').on('hidden.bs.modal', function() {
                                resetForm();
                                handleClearButtonClick();
                            });
                        }
                        var nonaktifkanButton = $('<button>').addClass('btn btn-danger btn-sm nonaktifkan-button').text('Nonaktifkan');
                        nonaktifkanButton.on('click', function() {
                            showOverlay()
                            var row = $(this).closest('tr');
                            var jobId = row.find('td:first').text();
                            $.ajax({
                                url: '<?= urlpath('dashboard/daftarloker/nonaktifkan') ?>',
                                method: 'post',
                                data: {
                                    id: jobId,
                                    status: 'inactive'
                                },
                                success: function(response) {
                                    hideOverlay();
                                    alert('Loker berhasil dinonaktifkan!');
                                    refreshTable();
                                },
                                error: function(xhr, status, error) {
                                    hideOverlay();
                                    console.error('AJAX request failed:', error);
                                }
                            });
                        });
                        var nonaktifkanCell = $('<td>').append(nonaktifkanButton);
                        newRow.append(nonaktifkanCell);


                        $('#dashboardactiveTableBody').append(newRow);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('AJAX request failed:', error);
                }
            });
        }

        $('#refreshButton').click(function() {
            refreshTable();
        });

        refreshTable();
    });
</script>
<?php $ajaxgetscript = ob_get_clean(); ?>

<?php ob_start(); ?>
<script>
    $('.accept-button').off('click').on('click', function() {
        showOverlay();
        $.ajax({
            url: '<?= urlpath('dashboard/lamaran/daftarlamaran/detaillamaran') ?>',
            method: 'post',
            data: {
                id: <?= $lamaran['id'] ?>,
                status: 'accepted'
            },
            dataType : 'json',
            async : true,
            success: function(response) {
                hideOverlay();
                alert('Lamaran berhasil diterima!');
                refreshTable();
            },
            error: function(xhr, status, error) {
                hideOverlay();
                console.error('AJAX request failed:', error);
            }
        })
    });
    $('.reject-button').off('click').on('click', function() {
        showOverlay();
        $.ajax({
            url: '<?= urlpath('dashboard/lamaran/daftarlamaran/detaillamaran') ?>',
            method: 'post',
            data: {
                id: <?= $lamaran['id'] ?>,
                status: 'rejected'
            },
            dataType : 'json',
            async : true,
            success: function(response) {
                hideOverlay();
                alert('Lamaran ditolak!');
                refreshTable();
            },
            error: function(xhr, status, error) {
                hideOverlay();
                console.error('AJAX request failed:', error);
            }
        })
    });
    function resetForm() {
        var form = $('#buatlokerForm');
        form.validate().resetForm();
        form.find('.is-invalid').removeClass('is-invalid');
        form.find('.is-valid').removeClass('is-valid');
        form[0].reset();
    }
</script>
<?php $ajaxpostscript1 = ob_get_clean(); ?>

<?php ob_start(); ?>
<script>
        $('.add-button').off('click').on('click', function() {
        if ($('#buatlokerForm').valid()) {
            showOverlay();
            var formData = new FormData($('#buatlokerForm')[0]);
            $.ajax({
                url: '<?= urlpath('dashboard/buatinformasiloker') ?>',
                method: 'post',
                data: formData,
                dataType: 'json',
                async: true,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        hideOverlay();
                        handleClearButtonClick();
                        resetForm();
                        alert('Loker baru berhasil ditambahkan!');
                    } else {
                        hideOverlay();
                        alert('Terjadi kesalahan: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX request failed:', error);
                    alert('Pastikan semua kolom sudah terisi!');
                }
            });
        }
    });
    function resetForm() {
        var form = $('#buatlokerForm');
        form.validate().resetForm();
        form.find('.is-invalid').removeClass('is-invalid');
        form.find('.is-valid').removeClass('is-valid');
        form[0].reset();
    }
</script>
<?php $ajaxpostscript2 = ob_get_clean(); ?>

<?php ob_start(); ?>
<script>
    var ctx = document.getElementById('piechart').getContext('2d');
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                data: <?php echo json_encode($data); ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)', // Color for job seekers
                    'rgba(54, 162, 235, 0.2)' // Color for job creators
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });
</script>
<?php $chartscript = ob_get_clean(); ?>

<?php ob_start(); ?>
<script>
    $(document).ready(function() {
        var chart; // Variabel untuk menyimpan instance grafik
        
        // Mendefinisikan fungsi untuk mengambil data dan merender grafik
        function fetchDataAndRenderChart() {
            $.ajax({
                url: '<?= urlpath('dashboard/getvisitorsdata') ?>',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    renderChart(data);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        // Fungsi untuk merender atau memperbarui grafik
        function renderChart(data) {
            if (!chart) {
                // Jika grafik tidak ada, buat yang baru
                var ctx = document.getElementById('visitorsChart').getContext('2d');
                chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: [],
                        datasets: [{
                            label: 'Pengunjung',
                            data: [],
                            borderColor: 'blue',
                            backgroundColor: 'transparent',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                    }
                });
            }

            // Perbarui data grafik dengan data baru
            var dates = [];
            var visitors = [];
            data.forEach(function(item) {
                dates.push(item.date);
                visitors.push(item.total_visitors);
            });

            chart.data.labels = dates;
            chart.data.datasets[0].data = visitors;
            chart.update(); // Perbarui grafik
        }

        // Panggil fungsi pada awalnya
        fetchDataAndRenderChart();

        // Set interval untuk memanggil fungsi setiap 10 detik
        setInterval(fetchDataAndRenderChart, 10000);
    });
</script>
<?php $chartscript2 = ob_get_clean(); ?>



<?php include 'resources/views/master-layout/master.php'; ?>