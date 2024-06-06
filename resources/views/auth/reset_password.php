<section class="background-radial-gradient overflow-auto">
    <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
        <div class="row gx-lg-5 align-items-center mb-5">
            <?php displayFlashMessages('success'); ?>
            <?php displayFlashMessages('danger'); ?>
            <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                <h1 class="mt-5 mb-3 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                    Reset <br />
                    <span style="color: hsl(208, 81%, 75%)">Password</span>
                </h1>
            </div>
            <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>
                <div id="radius-shape-3" class="position-absolute shadow-5-strong"></div>
                <div class="card">
                    <div class="card-body px-4 py-5 px-md-5">
                        <h2 class="fw-bold mb-2 text-uppercase">Masukkan Password Baru</h2>
                        <form id="resetPasswordForm" action="<?= urlpath('resetpassword') ?>" method="POST">
                            <input type="hidden" name="email" value="<?= $_GET['email'] ?>">
                            <div class="form-outline mt-5 mb-3 text-start">
                                <label class="" for="password">Password</label>
                                <input name="password" type="password" id="password" class="form-control" required />
                            </div>
                            <div class="form-outline mb-5 text-start">
                                <label class="" for="confirm_password">Konfirmasi Ulang Password</label>
                                <input name="confirm_password" type="password" id="confirm_password"
                                    class="form-control" required />
                            </div>
                            <button type="submit" class="btn btn-primary btn-block mb-4 form-control">Ubah Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>