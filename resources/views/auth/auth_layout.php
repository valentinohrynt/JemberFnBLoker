<?php $title = 'JemberFnBLoker - Auth'; ?>

<?php ob_start(); ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
<?php $apiscriptlink = ob_get_clean(); ?>


<?php ob_start(); ?>
<?php include 'assets/css/style.css'; ?>
#map { 
    height: 400px; 
    width: 100%;
}
.leaflet-control-geocoder-form{
    background-color: black
}
<?php $style = ob_get_clean();?>

<?php ob_start() ?>
<?php
if (isset($_GET['auth'])) {
    echo "<script>alert('Silahkan login terlebih dahulu');</script>";
}
if (isset($_GET['failed'])) {
    echo "<script>alert('" . ucfirst($url) . " gagal');</script>";
}
if (isset($url)) {
    include_once $url . '.php';
}
?>
<?php $body = ob_get_clean() ?>

<?php ob_start() ?>
<script>
    var map = L.map('map').setView([51.505, -0.09], 13);
    var jemberBounds = L.latLngBounds(
        L.latLng(-8.5, 113.2), // lower left
        L.latLng(-7.9, 114.1) // upper right
    );
    map.fitBounds(jemberBounds);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    }).addTo(map);
    var geocoder = L.Control.geocoder().addTo(map);
    var marker;

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
    function sendDataToBackend() {
        showOverlay();
        var form = document.getElementById('registerForm');
        var formData = new FormData(form);
        formData.append('lat', (marker.getLatLng().lat).toFixed(8));
        formData.append('lng', (marker.getLatLng().lng).toFixed(8));

        $.ajax({
            type: 'POST',
            url: '<?= urlpath('register') ?>',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                hideOverlay();
                alert('Anda sudah berhasil mendaftar');
                window.location.href = '<?= urlpath('login') ?>';
            },
            error: function(xhr, status, error) {
                hideOverlay();
                var response = JSON.parse(xhr.responseText);
                alert(response.message);
                console.error('Terjadi kesalahan, mohon coba lagi');
            }
        });
    }
</script>
<?php $mapscript = ob_get_clean() ?>

<?php ob_start() ?>
<script>
    $(document).ready(function() {
        $.validator.addMethod("phoneMinLength", function(value, element) {
            return value.replace(/\D/g, '').length >= 10;
        }, "Nomor telepon minimal 10 digit");
        $('#registerForm').validate({
            rules: {
                name: {
                    required: true
                },
                phone: {
                    required: true,
                    digits: true,
                    phoneMinLength: true
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
                    required: "Bagian ini harus diisi"
                },
                phone: {
                    required: "Bagian ini harus diisi",
                    digits: "Silahkan masukkan nomor telepon yang valid"
                },
                email: {
                    required: "Bagian ini harus diisi",
                    email: "Silahkan masukkan Email yang valid"
                },
                street: {
                    required: "Bagian ini harus diisi"
                },
                district_id: {
                    required: "Bagian ini harus diisi"
                },
                username: {
                    required: "Bagian ini harus diisi"
                },
                password: {
                    required: "Bagian ini harus diisi"
                }
            },
            errorElement: "div",
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-outline').append(error);
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
</script>
<?php $customscript = ob_get_clean() ?>


<?php include 'resources/views/master-layout/master.php'; ?>