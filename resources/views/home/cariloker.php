<div class="mt-custom position-relative">
    <div class="position-absolute top-0 start-50 translate-middle-x">
        <?php displayFlashMessages('success'); ?>
        <?php displayFlashMessages('danger'); ?>
    </div>
</div>
<section id="main" class="main">
    <div class="container pt-5">
        <h2 class="text-center">Cari Lowongan Kerja</h2>
        <div class="row pt-5">
            <div class="row content mb-3">
                <div class="col-md-6 mb-3">
                    <div class="d-flex flex-column">
                        <label for="searchInput" class="form-label">Cari berdasarkan judul atau perusahaan:</label>
                        <div class="d-flex">
                            <input type="text" id="searchInput" class="form-control"></input>
                            <button onclick="search()" type="button" class="searchBtn border-0 bg-transparent"><i class="bi-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="categoryFilter" class="form-label">Filter berdasarkan posisi:</label>
                    <select id="categoryFilter" class="form-select">
                        <option value="">Semua Posisi</option>
                        <option value="barista">Barista</option>
                        <option value="cook helper">Cook Helper</option>
                        <option value="juru masak">Juru Masak</option>
                        <option value="kasir">Kasir</option>
                        <option value="waiter">Waiter</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>
            </div>
            <hr>
            <div class="col-md-12">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3" id="loker-cards-container">
                </div>
            </div>
        </div>
    </div>
</section>