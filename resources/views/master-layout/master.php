<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?= $apiscriptlink ?? ''; ?>
    <link rel="icon" type="image/x-icon" href="<?= urlpath('assets/img/favicon.ico') ?>">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title><?= $title ?? ''; ?></title>
    <style>
        <?=$style ?? '';
        ?>
    </style>
</head>

<body>
    <div id="overlay">
        <div id="loading-spinner">
            <img src="<?= urlpath('assets/img/preloaders/306.png') ?>" alt="Loading...">
        </div>
    </div>
    <?= $body ?? ''; ?>
    <?= $mapscript ?? ''; ?>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <?= $searchscript ?? ''; ?>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <?= $dropboxpdfscript ?? ''; ?>
    <?= $dropboximgscript ?? ''; ?>
    <?= $dashboardscript ?? ''; ?>
    <script src="<?= urlpath('assets/js/theme.js') ?>"></script>
    <?= $customscript ?? ''; ?>
    <?= $ajaxgetscript ?? ''; ?>
    <?= $ajaxpostscript1 ?? ''; ?>
    <?= $ajaxpostscript2 ?? ''; ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?= $chartscript ?? ''; ?>
    <script>
        function showOverlay() {
            $('#overlay').fadeIn();
        }

        function hideOverlay() {
            $('#overlay').fadeOut();
        }
    </script>
</body>

</html>