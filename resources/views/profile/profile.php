<div class="mt-custom position-relative">
    <div class="position-absolute top-0 start-50 translate-middle-x">
        <?php displayFlashMessages('success'); ?>
        <?php displayFlashMessages('danger'); ?>
    </div>
</div>
<section id="main" class="main">
    <?php if ($user['role_id'] == 2) : ?>
        <a href="<?=urlpath('home')?>" class="text-decoration-none p-3 mt-5"><i class="bi bi-arrow-left"></i> Kembali</a>
    <?php else: ?>
        <a href="<?=urlpath('dashboard')?>" class="text-decoration-none p-3 mt-5"><i class="bi bi-arrow-left"></i> Kembali</a>
    <?php endif; ?>
    <div class="container pt-5 pb-5">
        <h2 class="text-center text-break text-wrap">Profile</h2>
        <div class="card pt-5 mt-5 mx-auto" style="max-width: 540px;">
            <div class="card-content px-5 pb-5">
                <div class="card-body d-flex justify-content-center">
                    <div class="img-container gap-0 position-relative border border-2 border-secondary rounded-circle">
                        <div class="image-container overflow-hidden position-relative">
                            <?php if (!$profile['profile_image']) : ?>
                            <img src="<?= urlpath('uploads/photo_profile/blank-profile.svg') ?>" alt="" class="w-100">
                            <?php else : ?>
                            <img src="<?= urlpath('uploads/photo_profile/' . $profile['profile_image']) ?>" alt=""
                                class="w-100 h-100">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="card-body">
                    <h5>Name</h5>
                    <input type="text" placeholder="Name" class="form-control" value="<?=$profile['name'] ?>" readonly>
                </div>
                <?php if ($user['role_id'] == 2) : ?>
                <div class="card-body">
                    <h5>Gender</h5>
                    <?php
                    if ($profile['gender'] == 'L') {
                        echo '<input type="text" placeholder="Gender" class="form-control" value="Laki-laki" 
                            readonly>';
                    } elseif($profile['gender'] == 'P') {
                        echo '<input type="text" placeholder="Gender" class="form-control" value="Perempuan"
                            readonly>';
                    } else {
                        echo '<input type="text" placeholder="Gender" class="form-control text-muted" value="Not set"
                            readonly>';
                    }
                    ?>
                </div>
                <div class="card-body">
                    <h5>Age</h5>
                    <?php
                    if ($profile['age']) {
                        echo '<input type="text" placeholder="Age" class="form-control" value="'.$profile['age'].'" readonly>';
                    } else {
                        echo '<input type="text" placeholder="Age" class="form-control text-muted" value="Not set" readonly>';
                    }
                    ?>
                </div>
                <?php endif; ?>
                <div class="card-body">
                    <h5>Phone</h5>
                    <input type="text" placeholder="Phone" class="form-control" value="<?=$profile['phone'] ?>"
                        readonly>
                </div>
                <div class="card-body">
                    <h5>Alamat</h5>
                    <input type="text" placeholder="Street" class="form-control"
                        value="<?=$profile['street'] ?>, <?=$profile['district']['name'] ?>" readonly>
                </div>
                <div class="card-body">
                    <h5>Location</h5>
                    <div class="map" id="map"></div>
                </div>
                <hr>
                <div class="card-body">
                    <h5>Username</h5>
                    <input type="text" placeholder="Username" class="form-control" value="<?=$user['username'] ?>"
                        readonly>
                </div>
                <div class="card-body">
                    <h5>Email</h5>
                    <input type="text" placeholder="Email" class="form-control" value="<?=$user['email'] ?>" readonly>
                </div>
            </div>
            <div class="card-footer">
                <a href="<?=urlpath('profile/ubahprofile')?>" class="btn btn-primary text-decoration-none">Edit Profile
                    <i class="fa-solid fa-user-pen"></i></a>
            </div>
        </div>
    </div>
</section>