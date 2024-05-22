<div class="mt-custom position-relative">
    <div class="position-absolute top-0 start-50 translate-middle-x">
        <?php displayFlashMessages('success'); ?>
        <?php displayFlashMessages('danger'); ?>
    </div>
</div>
<section id="main" class="main">
    <a href="<?=urlpath('home/riwayatlamaran')?>" class="text-decoration-none p-3 mt-5"><i class="bi bi-arrow-left"></i>
        Kembali</a>
    <div class="container pt-5 pb-5">
        <h2 class="text-center text-break text-wrap">Detail Lamaran</h2>
        <div class="card pt-5 mt-5 mx-auto" style="max-width: 540px;">
            <div class="card-content px-5 pb-5">
                <div class="card-body">
                    <div class="img-container d-flex justify-content-center">
                        <img src="<?=urlpath('uploads/photo_jobvacancy/'. $loker['photo'])?>" alt="photo_jobvacancy"
                            class="w-100">
                    </div>
                </div>
                <div class="card-body text-center">
                    <h5>Deskripsi Lowongan</h5>
                </div>
                <hr>
                <div class="card-body">
                    <h5>Nama Perusahaan</h5>
                    <p class="card-text">
                        <?=$loker_creator['name']?>
                    </p>
                    <div class="mb-2" id="map"></div>
                    <hr>
                    <p class="card-text">
                        <?=$loker['title']?>
                    </p>
                    <div class="d-flex flex-column">
                        <small class="text-muted"><i class="bi-clock"></i> <?= $loker['job_time']?></small>
                        <small class="text-muted"><i class="bi-briefcase-fill"></i>
                            <?= $loker_category['name'] ?></small>
                        <?php if ($loker['workplace']=='WFO'){
                            $workplace = $loker['workplace'];
                            echo "<small class='text-muted'><i class='bi-shop'></i> $workplace</small>";
                        } elseif ($loker['workplace']=='WFH'){
                            $workplace = $loker['workplace'];
                            echo "<small class='text-muted'><i class='bi-laptop'></i> $workplace</small>";
                        } else {
                            $workplace = $loker['workplace'];
                            echo "<small class='text-muted'><i class='fa-solid fa-house-laptop'></i> $workplace</small>";
                        }
                        ?>
                        <small class="text-muted"><i class="bi-geo-alt-fill"></i> <?= $district['name'] ?>,
                            JEMBER</small>
                    </div>
                </div>
                <hr>
                <div class="card-body">
                    <h5 class="mb-3">Syarat dan deskripsi</h5>
                    <p class="card-text">
                        <?php echo nl2br(htmlspecialchars($loker['requirement'])); ?>
                    </p>
                </div>
                <hr>
                <div class="card-body">
                    <h5 class="mb-3">Dokumen</h5>
                    <?php foreach ($dokumen_lamaran as $dokumen) : ?>
                    <p class="card-text">
                        <a href="<?= urlpath($dokumen['file']) ?>" class="btn btn-primary text-truncate w-75" download>
                            <i class="fa-regular fa-file-pdf"></i> <?= basename($dokumen['file']) ?>
                        </a>
                    </p>
                    <?php endforeach; ?>
                </div>
                <hr>
                <div class="card-footer text-start">
                    <p class="card-text">
                        Terkirim pada: <br>
                        <i class="bi bi-clock"></i> <?= $lamaran['created_at'] ?>
                    </p>
                    <p class="card-text">
                        Dikonfirmasi pada: <br>
                        <i class="bi bi-clock"></i> <?= $lamaran['confirmed_at'] ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>