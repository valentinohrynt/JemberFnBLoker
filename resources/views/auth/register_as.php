<section class="background-radial-gradient overflow-auto">
    <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
        <div class="row gx-lg-5 align-items-center mb-5">
            <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                <h1 class="mt-5 mb-3 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                    Selamat datang di <br />
                    <span style="color: hsl(208, 81%, 75%)">Jember FnB Loker</span>
                </h1>
            </div>
            <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>
                <div id="radius-shape-3" class="position-absolute shadow-5-strong"></div>
                <div class="card">
                    <div class="card-body px-4 py-5 px-md-5">
                        <h2 class="fw-bold mb-5 text-uppercase">Register Sebagai?</h2>
                        <div class="row gap-3 d-flex justify-content-center">
                            <a href="<?= urlpath('register/JobCreator') ?>" class="card col-md-5 text-decoration-none">
                                <div class="m-3 d-flex flex-column justify-content-center align-items-center">
                                    <img src="assets/img/register_as/jobcreator.png" alt="JobCreator" class="w-50 mb-2">
                                    <p>Job Creator</p>
                                </div>
                            </a>
                            <a href="<?= urlpath('register/JobSeeker') ?>" class="card col-md-5 text-decoration-none">
                                <div class="m-3 d-flex flex-column justify-content-center align-items-center">
                                    <img src="assets/img/register_as/jobseeker.png" alt="" class="w-50 mb-2">
                                    <p>Job Seeker</p>
                                </div>
                            </a>
                        </div>
                        <p class="text-center mt-3 text-secondary">
                            If you have account, Please <a href="<?= urlpath('login') ?>">Login Now</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>