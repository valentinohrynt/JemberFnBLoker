<div class="mt-custom position-relative">
    <div class="position-absolute top-0 start-50 translate-middle-x">
        <?php displayFlashMessages('success'); ?>
        <?php displayFlashMessages('danger'); ?>
    </div>
</div>
<section id="main" class="main">
    <a href="<?=urlpath('home/cariloker')?>" class="text-decoration-none p-3 mt-5"><i class="bi bi-arrow-left"></i> Kembali</a>
    <div class="container pt-5 pb-5">
        <h2 class="text-center text-break text-wrap"><?=$loker['title']?></h2>
        <div class="card pt-5 mt-5 mx-auto" style="max-width: 540px;">
            <div class="card-content px-5 pb-5">
                <div class="card-body">
                    <div class="img-container d-flex justify-content-center">
                        <img src="<?=urlpath('uploads/photo_jobvacancy/'. $loker['photo'])?>" alt="photo_jobvacancy" class="w-100">
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
                    <div id="map" class="mb-2"></div>
                    <div class="d-flex flex-column">
                        <small class="text-muted"><i class="bi-clock"></i> <?= $loker['job_time']?></small>
                        <small class="text-muted"><i class="bi-briefcase-fill"></i> <?= $loker_category['name'] ?></small>
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
                        <small class="text-muted"><i class="bi-geo-alt-fill"></i> <?= $district['name'] ?>, JEMBER</small>
                    </div>
                </div>
                <hr>
                <div class="card-body">
                    <h5>Syarat dan deskripsi</h5>
                    <p class="card-text">
                    <?php echo nl2br(htmlspecialchars($loker['requirement'])); ?>
                    </p>
                </div>
                <hr>
                <div class="card-footer">
                    <p class="card-text">
                        <a href="<?=urlpath('home/cariloker/detailloker/lamarkerja?id=') . $loker['id']?>" class="btn btn-primary form-control text-decoration-none text-center">Lamar Kerja</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
