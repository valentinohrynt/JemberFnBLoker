<?php if ( $role_id == 2 ) : ?>
<section class='background-radial-gradient overflow-auto'>
    <div class='container px-4 py-5 px-md-5 text-center text-lg-start my-5'>
        <div class='row gx-lg-5 align-items-center mb-5'>
            <?php displayFlashMessages( 'success' );?>
            <?php displayFlashMessages( 'danger' );?>
            <div class='col-lg-6 mb-5 mb-lg-0' style='z-index: 10'>
                <h1 class='mt-5 mb-3 display-5 fw-bold ls-tight' style='color: hsl(218, 81%, 95%)'>
                    Selamat datang di <br />
                    <span style='color: hsl(208, 81%, 75%)'>Jember FnB Loker</span>
                </h1>
            </div>
            <div class='col-lg-6 mb-5 mb-lg-0 position-relative'>
                <div id='radius-shape-1' class='position-absolute rounded-circle shadow-5-strong'></div>
                <div id='radius-shape-2' class='position-absolute shadow-5-strong'></div>
                <div id='radius-shape-3' class='position-absolute shadow-5-strong'></div>
                <div class='card'>
                    <div class='card-body px-4 py-5 px-md-5'>
                        <div class='text-center'>
                            <h2 class='fw-bold mb-2 text-uppercase'>Register Job Seeker</h2>
                        </div>
                        <hr>
                        <form id='registerForm' action="<?= urlpath('register') ?>" method='post'>
                            <div class='text-center'>
                                <h5>Identitas Diri</h5>
                            </div>
                            <div class='form-outline mt-2 mb-3 d-flex flex-column align-items-start'>
                                <label class='' for='name'>Nama Lengkap</label>
                                <input type='text' id='name' name='name' class='form-control' required />
                            </div>
                            <div class='form-outline mb-3 d-flex flex-column align-items-start'>
                                <label class='' for='phone'>Nomor Telepon</label>
                                <input type='tel' id='phone' class='form-control' name='phone' required />
                            </div>
                            <div class='form-outline mb-3 d-flex flex-column align-items-start'>
                                <label class='' for='email'>Email</label>
                                <input type='email' id='email' class='form-control' name='email' required />
                            </div>
                            <hr>
                            <div class='text-center mb-2'>
                                <h5>Alamat Tempat Tinggal</h5>
                            </div>
                            <div class='form-outline mb-3 d-flex flex-column align-items-start'>
                                <label class='' for='street'>Alamat</label>
                                <input type='text' id='street' class='form-control' name='street' required />
                            </div>
                            <div class='form-outline mb-3 d-flex flex-column align-items-start'>
                                <label class='' for='district_id'>Kecamatan</label>
                                <select name='district_id' id='district' class='form-select'>
                                    <option value=''>Pilih Kecamatan</option>
                                    <?php foreach ( $districts as $district ) : ?>
                                    <option value="<?php echo $district['id'] ?>"><?php echo $district[ 'name' ] ?>
                                    </option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div id='map'></div>
                            <hr>
                            <div class='text-center mb-2'>
                                <h5>Kredensial Login</h5>
                            </div>
                            <div class='form-outline mb-3 d-flex flex-column align-items-start'>
                                <label class='' for='username'>Username</label>
                                <input type='text' id='username' class='form-control' name='username' required />
                            </div>
                            <div class='form-outline mb-3 d-flex flex-column align-items-start'>
                                <label class='' for='password'>Password</label>
                                <input type='password' id='password' class='form-control' name='password' required />
                            </div>
                            <input type='hidden' name='role_id' value="<?php echo $role_id ?>">
                            <button type='button' onclick='sendDataToBackend()'
                                class='btn btn-primary btn-block mb-4 form-control'>Register</button>
                        </form>
                        <p class='text-center mt-3 text-secondary'>
                            If you have account, Please <a href="<?= urlpath('login') ?>">Login Now</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif;?>
<?php if ( $role_id == 3 ) : ?>
<section class='background-radial-gradient overflow-auto'>
    <div class='container px-4 py-5 px-md-5 text-center text-lg-start my-5'>
        <div class='row gx-lg-5 align-items-center mb-5'>
            <?php displayFlashMessages( 'success' );?>
            <?php displayFlashMessages( 'danger' );?>
            <div class='col-lg-6 mb-5 mb-lg-0' style='z-index: 10'>
                <h1 class='mt-5 mb-3 display-5 fw-bold ls-tight' style='color: hsl(218, 81%, 95%)'>
                    Selamat datang di <br />
                    <span style='color: hsl(208, 81%, 75%)'>Jember FnB Loker</span>
                </h1>
            </div>
            <div class='col-lg-6 mb-5 mb-lg-0 position-relative'>
                <div id='radius-shape-1' class='position-absolute rounded-circle shadow-5-strong'></div>
                <div id='radius-shape-2' class='position-absolute shadow-5-strong'></div>
                <div id='radius-shape-3' class='position-absolute shadow-5-strong'></div>
                <div class='card'>
                    <div class='card-body px-4 py-5 px-md-5'>
                        <div class='text-center'>
                            <h2 class='fw-bold mb-2 text-uppercase'>Register Job Creator</h2>
                        </div>
                        <hr>
                        <form id='registerForm' method='post'>
                            <div class='text-center'>
                                <h5>Identitas Usaha</h5>
                            </div>
                            <div class='form-outline mt-2 mb-3 d-flex flex-column align-items-start'>
                                <label class='' for='name'>Nama Usaha</label>
                                <input type='text' id='name' name='name' class='form-control' required />
                            </div>
                            <div class='form-outline mb-3 d-flex flex-column align-items-start'>
                                <label class='' for='phone'>Nomor Telepon</label>
                                <input type='tel' id='phone' class='form-control' name='phone' required />
                            </div>
                            <div class='form-outline mb-3 d-flex flex-column align-items-start'>
                                <label class='' for='email'>Email</label>
                                <input type='email' id='email' class='form-control' name='email' required />
                            </div>
                            <hr>
                            <div class='text-center mb-2'>
                                <h5>Alamat Usaha</h5>
                            </div>
                            <div class='form-outline mb-3 d-flex flex-column align-items-start'>
                                <label class='' for='street'>Alamat</label>
                                <input type='text' id='street' class='form-control' name='street' required />
                            </div>
                            <div class='form-outline mb-3 d-flex flex-column align-items-start'>
                                <label class='' for='district_id'>Kecamatan</label>
                                <select name='district_id' id='district' class='form-select'>
                                    <option value=''>Pilih Kecamatan</option>
                                    <?php foreach ( $districts as $district ) : ?>
                                    <option value="<?php echo $district['id'] ?>"><?php echo $district[ 'name' ] ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div id='map'></div>
                            <hr>
                            <div class='text-center mb-2'>
                                <h5>Kredensial Login</h5>
                            </div>
                            <div class='form-outline mb-3 d-flex flex-column align-items-start'>
                                <label class='' for='username'>Username</label>
                                <input type='text' id='username' class='form-control' name='username' required />
                            </div>
                            <div class='form-outline mb-3 d-flex flex-column align-items-start'>
                                <label class='' for='password'>Password</label>
                                <input type='password' id='password' class='form-control' name='password' required />
                            </div>
                            <input type='hidden' name='role_id' value="<?php echo $role_id ?>">
                            <button type='button' onclick='sendDataToBackend()'
                                class='btn btn-primary btn-block mb-4 form-control'>Register</button>
                        </form>
                        <p class='text-center mt-3 text-secondary'>
                            If you have account, Please <a href="<?= urlpath('login') ?>">Login Now</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif;?>