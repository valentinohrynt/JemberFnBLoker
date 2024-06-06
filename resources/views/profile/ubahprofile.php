<div class="mt-custom position-relative">
    <div class="position-absolute top-0 start-50 translate-middle-x">
        <?php displayFlashMessages('success'); ?>
        <?php displayFlashMessages('danger'); ?>
    </div>
</div>
<section id="main" class="main">
    <?php if ($user['role_id'] == 2) : ?>
    <a href="<?=urlpath('profile')?>" class="text-decoration-none p-3 mt-5"><i class="bi bi-arrow-left"></i>
        Kembali</a>
    <?php else: ?>
    <a href="<?=urlpath('profile')?>" class="text-decoration-none p-3 mt-5"><i class="bi bi-arrow-left"></i>
        Kembali</a>
    <?php endif; ?>
    <div class="container pt-5 pb-5">
        <h2 class="text-center text-break text-wrap">Ubah Profile</h2>
        <form id="editProfileForm">
        <div class="card pt-5 mt-5 mx-auto" style="max-width: 540px;">
            <div class="card-content px-5 pb-5">
                <div class="card-body d-flex justify-content-center">
                    <div class="img-container gap-0 position-relative border border-3 border-secondary rounded-circle"
                        data-bs-toggle="modal" data-bs-target="#imageUploadModal">
                        <div class="image-container overflow-hidden position-relative">
                            <?php if (!$profile['profile_image']) : ?>
                            <img src="<?= urlpath('uploads/photo_profile/blank-profile.svg') ?>" alt="" class="w-100">
                            <?php else : ?>
                            <img src="<?= urlpath('uploads/photo_profile/' . $profile['profile_image']) ?>" alt="" class="w-100 h-100">
                            <?php endif; ?>
                            <div class="overlay position-absolute top-0 start-0 w-100 h-100 bg-white"></div>
                            <i class="bi bi-camera position-absolute top-50 start-50 translate-middle fa-3x"></i>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="card-body">
                    <h5>Name</h5>
                    <input type="text" name="name" placeholder="Name" class="form-control" value="<?=$profile['name'] ?>">
                </div>
                <?php if ($user['role_id'] == 2) : ?>
                <div class="card-body">
                    <h5>Gender</h5>
                    <select name="gender" id="gender" class="form-select">
                        <option value="">Pilih Gender</option>
                        <option value="L" <?php echo ($profile['gender'] == 'L') ? 'selected' : '' ?>>Laki-laki</option>
                        <option value="P" <?php echo ($profile['gender'] == 'P') ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                </div>
                <div class="card-body">
                    <h5>Age</h5>
                    <input type="number" name="age" placeholder="Masukkan umur Anda" class="form-control" value="<?=$profile['age'] ?>" >
                </div>
                <?php endif; ?>
                <div class="card-body">
                    <h5>Phone</h5>
                    <input type="tel" name="phone" placeholder="Phone" class="form-control" value="<?=$profile['phone'] ?>">
                </div>
                <div class="card-body">
                    <h5>Street</h5>
                    <input type="text" name="street" placeholder="Street" class="form-control" value="<?=$profile['street'] ?>">
                </div>
                <div class="card-body">
                    <h5>District</h5>
                    <select name="district_id" id="district" class="form-select">
                        <?php foreach ($districts as $district) : ?>
                        <option value="<?php echo $district['id'] ?>"
                            <?php echo ($profile['district']['id'] == $district['id']) ? 'selected' : '' ?>>
                            <?php echo $district['name'] ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="card-body">
                    <h5>Location</h5>
                    <div class="map" id="map"></div>
                </div>
                <hr>
                <div class="card-body">
                    <h5>Username</h5>
                    <input type="text" name="username" placeholder="Username" class="form-control" value="<?=$user['username'] ?>">
                </div>
                <div class="card-body">
                    <h5>Email</h5>
                    <input type="email" name="email" placeholder="Email" class="form-control" value="<?=$user['email'] ?>">
                </div>
                <small class="pt-2 form-text text-muted opacity-50">Keterangan: Jika Anda mengubah username, maka Anda akan otomatis log out</small>
                <hr>
                <div class="card-body">
                    <h5>Password</h5>
                    <input type="password" name="password" placeholder="Masukkan password Anda untuk mengubah profile" class="form-control">
                </div>
            </div>
            <?php if ($user['role_id'] == 2) : ?>
            <div class="card-footer">
                <button type="button" class="btn btn-success" id="save-btn-js">Save Changes <i class="fa-solid fa-cloud-arrow-up"></i></button>
            </div>
            <?php endif; ?>
            <?php if ($user['role_id'] == 3) : ?>
            <div class="card-footer">
                <button type="button" class="btn btn-primary" id="save-btn-jc">Save Changes <i class="fa-solid fa-cloud-arrow-up"></i></button>
            </div>
            <?php endif; ?>
        </form>
        </div>
        <div class="modal fade" id="imageUploadModal" tabindex="-1" aria-labelledby="imageUploadModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageUploadModalLabel">Change Profile Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="file" name="image" id="imageInput" accept="image/*">
                        <div id="imagePreview" class="mt-2"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveImage">Save
                            Changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>