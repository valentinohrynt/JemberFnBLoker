<div class="mt-custom position-relative">
    <div class="position-absolute top-0 start-50 translate-middle-x">
        <?php displayFlashMessages('success'); ?>
        <?php displayFlashMessages('danger'); ?>
    </div>
</div>
<section id="main" class="main">
    <a href="<?=urlpath('home/cariloker/detailloker?id='.$loker['id'])?>" class="text-decoration-none p-3 mt-5"><i class="bi bi-arrow-left"></i>
        Kembali</a>
    <div class="container pt-5 pb-5">
        <h2 class="text-center text-break text-wrap">Lamar Kerja</h2>
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
                    <p class="card-text text-truncate">
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
                <form id="lamaranKerjaForm" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="id" value="<?=$loker['id']?>">
                    <div class="card-body">
                        <h5>Dokumen</h5>
                        <p class="card-text">
                            <div class="container" id="container">
                                <div id="dropbox" class="custom-file-container" ondragenter="handleDragEnter(event)"
                                    ondragover="handleDragOver(event)" ondragleave="handleDragLeave(event)"
                                    ondrop="handleDrop(event)">
                                    <i class="bi bi-cloud-upload cloud-icon"></i>
                                    <p class="text-muted dropbox-default-label">Drop document(s) here, or click to selectdocument(s)</p>
                                    <input id="file" type="file" name="file[]" accept="application/pdf" multiple class="d-none">
                                    <div id="file-list" class="file-list"></div>
                                    <button type="button" id="clear-button" class="btn clear-button d-none" onclick="handleClearButtonClick(event)">
                                        <i class="bi-x-lg"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="text-muted">
                                Silahkan unggah dokumen - dokumen yang dibutuhkan.
                            </div>
                        </p>
                    </div>
                    <hr>
                    <div class="card-footer">
                        <p class="card-text">
                            <button type="button" id="send-button" class="btn btn-success form-control">Kirim Lamaran</button>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>