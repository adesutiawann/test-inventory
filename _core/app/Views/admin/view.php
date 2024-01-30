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


                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php if ($images == null) : ?>
                            <div class="carousel-item active">
                                <img src="<?= base_url() ?>/uploads/noimage.png" class="d-block w-100 rounded-1 fixed-size-image" alt="No Image">
                            </div>
                        <?php else : ?>
                            <?php foreach ($images as $key => $value) : ?>
                                <div class="carousel-item<?= $key == 0 ? ' active' : '' ?>">
                                    <img src="<?= base_url() ?>/uploads/kegiatan/<?= $value->image ?>" class="d-block w-100 rounded-1 fixed-size-image1" alt="Image <?= $key + 1 ?>">
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>


                <div class="row mt-4">
                    <?php if ($images != null) : ?>
                        <?php foreach ($images as $key => $value) : ?>
                            <div class="col">
                                <img src="<?= base_url() ?>/uploads/kegiatan/<?= $value->image ?>" class="d-block w-50 rounded-1 fixed-size-image" alt="Image <?= $key + 1 ?>" onclick="showImage('<?= base_url() ?>/uploads/kegiatan/<?= $value->image ?>')">
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <script>
                function showImage(imageUrl) {
                    $('#carouselExampleIndicators .carousel-inner').html(`<div class="carousel-item active"><img src="${imageUrl}" class="d-block w-100 rounded-1 fixed-size-image" alt="Clicked Image"></div>`);
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

    <div class="container-xl mt-3">
        <h1 class="app-page-title">Riwayat</h1>
    </div><!--//container-fluid-->

    <main class="app-card app-card-settings shadow-sm p-4">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Riwayat Update</th>
                    <th scope="col">User</th>
                    <th scope="col">Lokasi</th>
                    <th scope="col">Teknisi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($riwayat as $key => $value) : ?>
                    <tr>
                        <th scope="row"><?= $key + 1 ?></th>
                        <td><?= $value->tgl ?> </td>
                        <td><?= $value->ket ?> </td>
                        <td><?= $value->user ?> </td>
                        <td><?= $value->lokasi ?> </td>
                        <td><?= $value->teknisi ?> </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </main>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- Additional JavaScript code goes here -->
<?= $this->endSection() ?>