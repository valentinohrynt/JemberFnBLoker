<div class="mt-custom position-relative">
    <div class="position-absolute top-0 start-50 translate-middle-x z-3">
        <?php displayFlashMessages('success'); ?>
        <?php displayFlashMessages('danger'); ?>
    </div>
</div>
<section class="hero px-5">
    <main class="content">
        Cari kerja bidang FnB di Jember? Kesini aja!
    </main>
</section>
<section id="about" class="about">
    <div class="container pt-5">
        <h2 class="text-center"><span>Tentang </span>Kami</h2>
        <div class="row pt-5">
            <div class="col-md-6 pb-5">
                <div id="carouselAutoSlide" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?=urlpath('assets/img/carousel/img1.webp')?>" class="d-block w-100" style="height: 25rem;" alt="Slide 1">
                        </div>
                        <div class="carousel-item">
                            <img src="<?=urlpath('assets/img/carousel/img2.webp')?>" class="d-block w-100" style="height: 25rem;" alt="Slide 2">
                        </div>
                        <div class="carousel-item">
                            <img src="<?=urlpath('assets/img/carousel/img3.webp')?>" class="d-block w-100" style="height: 25rem;" alt="Slide 3">
                        </div>
                        <div class="carousel-item">
                            <img src="<?=urlpath('assets/img/carousel/img4.webp')?>" class="d-block w-100" style="height: 25rem;" alt="Slide 4">
                        </div>
                        <div class="carousel-item">
                            <img src="<?=urlpath('assets/img/carousel/img5.webp')?>" class="d-block w-100" style="height: 25rem;" alt="Slide 5">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselAutoSlide" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselAutoSlide" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-md-6 content">
                <h3>JemberFnBLoker</h3>
                <p>
                    JemberFnBLoker adalah platform yang berisi berbagai informasi mengenai lowongan kerja di bidang usaha Food & Baverages, seperti Cafe, Depot, Angkringan, dan sebagainya di Kabupaten Jember.
                </p>
            </div>
        </div>
    </div>
</section>

<section id="about" class="about">
    <div class="container pt-5">
        <h2 class="text-center"><span>Layanan </span>Kami</h2>
        <div class="row pt-5">
            <div class="col-md-12 content">
                <h3>Apa sih yang disediakan oleh website ini?</h3>
                <p>
                    Kami menyediakan berbagai informasi lowongan kerja di bidang Food & Beverages khususnya di wilayah Jember
                </p>
            </div>
            <div class="col-md-12">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col">
                        <div class="card h-100">
                            <img src="assets/img/card/img1.webp" class="card-img-top" />
                            <div class="card-body">
                                <h5 class="card-title">Barista</h5>
                                <p class="card-text">
                                    Pembuat kopi berpengalaman
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <img src="assets/img/card/img2.webp" class="card-img-top" />
                            <div class="card-body">
                                <h5 class="card-title">Waiter</h5>
                                <p class="card-text">Pelayan ramah</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <img src="assets/img/card/img3.webp" class="card-img-top" />
                            <div class="card-body">
                                <h5 class="card-title">Kasir</h5>
                                <p class="card-text">Pengelola transaksi</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <img src="assets/img/card/img4.webp" class="card-img-top" alt="Skyscrapers" />
                            <div class="card-body">
                                <h5 class="card-title">Juru Masak</h5>
                                <p class="card-text">
                                    Ahli masak
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <img src="assets/img/card/img5.webp" class="card-img-top" alt="Skyscrapers" />
                            <div class="card-body">
                                <h5 class="card-title">Cook Helper</h5>
                                <p class="card-text">
                                    Asisten juru masak
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <img src="assets/img/card/img6.webp" class="card-img-top" alt="Skyscrapers" />
                            <div class="card-body">
                                <h5 class="card-title">Dan lainnya</h5>
                                <p class="card-text">
                                    Masih banyak job - job lain yang dapat kamu temukan disini!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>