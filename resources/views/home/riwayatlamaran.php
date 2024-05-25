<div class="mt-custom position-relative">
    <div class="position-absolute top-0 start-50 translate-middle-x">
        <?php displayFlashMessages('success'); ?>
        <?php displayFlashMessages('danger'); ?>
    </div>
</div>
<section id="main" class="main">
    <div class="container pt-5">
        <h2 class="text-center">Riwayat Lamaran</h2>
        <div class="row pt-5">
            <div class="row content mb-3">
                <div class="col-md-6 mb-3">
                    <div class="d-flex flex-column">
                        <label for="searchInput" class="form-label">Cari berdasarkan judul:</label>
                        <div class="d-flex">
                            <input type="text" id="searchInput" class="form-control"></input>
                            <button type="button" class="searchBtn border-0 bg-transparent"><i class="bi-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="statusFilter" class="form-label">Filter berdasarkan status:</label>
                    <select id="statusFilter" class="form-select">
                        <option value="">Semua</option>
                        <option value="process">Sedang diproses</option>
                        <option value="accepted">Disetujui</option>
                        <option value="rejected">Ditolak</option>
                    </select>
                </div>
            </div>
            <hr>
            <div class="col-md-12">
                <div class="d-flex flex-column gap-3 col-md-12" id="loker-list-cards-container">
                    
                </div>
            </div>
        </div>
    </div>
</section>