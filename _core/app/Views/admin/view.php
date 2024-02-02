<?= $this->extend('admin/template') ?>

<?= $this->section('css') ?>
<!-- Additional CSS styles go here -->
<style>
    .fixed-size-image {
        width: 200px;
        /* or any specific width */
        height: 150px;
        /* or any specific height */
        object-fit: contain;
        /* This will prevent stretching */
    }

    .fixed-size-image1 {
        width: 500px;
        /* or any specific width */
        height: 350px;
        /* or any specific height */
        object-fit: contain;
        /* This will prevent stretching */
    }


    .thumbnail-image {
        width: 150px;
        /* Example width */
        height: 100px;
        /* Example height */
        object-fit: cover;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<h2 class="app-page-title text-secondary fw-semibold"><?= $title ?></h2>
<hr>

<div class="app-content pt-3 p-md-3 p-lg-0">
    <div class="container-xl">

    </div><!--//container-fluid-->

    <main class="app-card app-card-settings shadow-sm p-4">
        <div class="row">
            <div class="col-md-6">
                <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php if ($images == null) : ?>
                            <div class="carousel-item active center">
                                <div class="imgBox">
                                    <img class="qrImage" alt="QR Code">
                                    <div class="text"><?= $aset->serial ?></div>
                                </div>
                            </div>
                        <?php else : ?>
                            <?php foreach ($images as $key => $value) : ?>
                                <div class="carousel-item<?= $key == 0 ? ' active' : '' ?>" data-bs-toggle="modal" data-bs-target="#imageModal">
                                    <img src="<?= base_url() ?>/uploads/kegiatan/<?= $value->image ?>" class="d-block w-100 rounded-1" alt="Image <?= $key + 1 ?>">
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="imageModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="imageModalLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body container">
                                <div id="modalCarousel" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <?php if ($images == null) : ?>
                                            <div class="carousel-item active center">
                                                <div class="imgBox text-center">
                                                    <img class="qrImage img-fluid" alt="QR Code">
                                                    <div class="text"><?= $aset->serial ?></div>
                                                </div>
                                            </div>
                                        <?php else : ?>
                                            <?php foreach ($images as $key => $value) : ?>
                                                <div class="carousel-item<?= $key == 0 ? ' active' : '' ?>">
                                                    <img src="<?= base_url() ?>/uploads/kegiatan/<?= $value->image ?>" class="d-block w-100 rounded-1 img-fluid" alt="Image <?= $key + 1 ?>">
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="btn-group">
                                        <button class="carousel-control-prev" type="button" data-bs-target="#modalCarousel" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#modalCarousel" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <?php if ($images != null) : ?>
                                        <?php foreach ($images as $key => $value) : ?>
                                            <div class="col-6 col-md-4 col-lg-3 mb-3">
                                                <img src="<?= base_url() ?>/uploads/kegiatan/<?= $value->image ?>" class="d-block w-100 rounded-1 img-fluid" alt="Image <?= $key + 1 ?>" onclick="showImage('<?= base_url() ?>/uploads/kegiatan/<?= $value->image ?>')">
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Understood</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- TUTUP Modal -->
            </div>

            <script>
                function showImage(imageUrl) {
                    $('#modalCarousel .carousel-inner').html(`<div class="carousel-item active"><img src="${imageUrl}" class="d-block w-100 rounded-1 img-fluid" alt="Clicked Image"></div>`);
                }
            </script>

            <div class="col-md-6 mt-5">

                <h2><?= $aset->manufacture ?></h2>
                <h5>SN : <?= $aset->serial ?></h5>
                <p class="lead"><b>Spesifikasi :</b> Prosesor <?= $aset->prosesor ?>, RAM <?= $aset->ram ?>GB, <?= $aset->hdd ?></p>

                <hr>

                <h5>Deskripsi</h5>
                <p><?= $aset->ket ?></p>

                <hr>

                <h6>Tersedia: <?= $jumlahmanufaktur ?> Unit</h6>

                <hr>
                <a href="<?= base_url('admin/suratkeluar/keranjang/' . $aset->serial) ?>" <?= ($admin->level == '3') ? 'hidden' : '' ?> class="btn btn-sm btn-success text-white mr-2">
                    <i class="fa-solid fa-right-from-bracket"></i> Distribusikan
                </a>
                <a href="<?= base_url('admin/suratkeluar/keranjang/' . $aset->serial) ?>" <?= ($admin->level == '3') ? 'hidden' : '' ?> class="btn btn-sm btn-primary text-white mr-2">
                    <i class="fa-solid fa-chalkboard-user"></i> Dipinjam
                </a>

                <a href="<?= base_url('admin/aset/edit/' . $aset->serial) ?>" class="btn btn-sm btn-info text-white ">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>

            </div>
        </div>
    </main>



    <main class="app-card app-card-settings shadow-sm p-4 mt-3">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">
                        <h4>#</h4>
                    </th>
                    <th scope="col">
                        <div class="d-flex justify-content-between align-items-center mb-8">
                            <div>
                                <!-- heading -->
                                <h4>History</h4>
                            </div>

                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($riwayat as $key => $value) : ?>
                    <tr>
                        <th scope="row"><?= $key + 1 ?></th>


                        <td>
                            <div class="d-flex pb-6 mb-6">
                                <!-- img -->
                                <!-- img -->
                                <div class="col ms-5">
                                    <h6 class="mb-1"><?= $value->user ?></h6>
                                    <!-- select option -->
                                    <!-- content -->
                                    <p class="small">
                                        <span class="text-muted"><?= $value->tgl ?></span>
                                        <span class="text-primary ms-3 fw-bold">Verified</span>
                                    </p>
                                    <!-- rating -->
                                    <div class="mb-2">
                                        <i class="fa-solid fa-screwdriver-wrench text-warning"></i>
                                        <i class="fa-solid fa-screwdriver-wrench text-warning"></i>
                                        <i class="fa-solid fa-screwdriver-wrench text-warning"></i>

                                        <i class="fa-solid fa-screwdriver-wrench text-warning"></i>
                                        <span class="ms-3 text-dark fw-bold"><?= $value->teknisi ?></span>
                                    </div>
                                    <!-- text-->
                                    <p>
                                        <?= $value->ket ?> </p>
                                    <!-- icon -->
                                    <div class="d-flex justify-content-end mt-4">
                                        <a href="#" class="text-muted">
                                            <i class="fa-solid fa-location-dot text-danger"></i>
                                            <?= $value->lokasi ?>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                <?php endforeach ?>
            </tbody>
        </table>
    </main>
</div>
<script>
    window.onload = function() {
        // Select the first .text element and corresponding .imgBox and .qrImage
        let qrTextElement = document.querySelector(".text");
        let imgBox = qrTextElement.closest('.imgBox');
        let qrImage = imgBox.querySelector(".qrImage");

        generateQR(qrTextElement.textContent, imgBox, qrImage);
    };

    function generateQR(text, imgBox, qrImage) {
        let baseUrl = '<?= base_url() ?>'; // PHP variable passed to JavaScript
        let qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=350x350&data=" + baseUrl + "/admin/aset/view/" + text;
        qrImage.src = qrCodeUrl;
        imgBox.classList.add("show-img");
    }
</script>


<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- Additional JavaScript code goes here -->
<?= $this->endSection() ?>