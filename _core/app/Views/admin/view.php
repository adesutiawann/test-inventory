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
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Details</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Riwayat</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link " id="update-tab" data-bs-toggle="tab" data-bs-target="#update-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="false"><i class="fa-solid fa-pen-to-square"></i> Update</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link " id="enduser-tab" data-bs-toggle="tab" data-bs-target="#enduser-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="false">Images</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link " id="images-tab" data-bs-toggle="tab" data-bs-target="#images-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="false">End User</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Barcode</button>
            </li>

        </ul>
        <div class="tab-content" id="myTabContent">
            <!-- detaisls -->
            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                <div class=" p-lg-5 p-sm-1 pt-1">
                    <div class="row">
                        <div class="col-md-6  col-lg-4">
                            <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <?php if ($images == null) : ?>
                                        <div class=" center">
                                            <img src="<?= base_url() ?>/uploads/noimage.jpg ?>" class="d-block w-100 rounded-4 img-fluid" alt="Image ">

                                        </div>
                                    <?php else : ?>
                                        <?php foreach ($images as $key => $value) : ?>
                                            <div class="carousel-item<?= $key == 0 ? ' active' : '' ?>" data-bs-toggle="modal" data-bs-target="#imageModal">
                                                <img src="<?= base_url() ?>/uploads/kegiatan/<?= $value->image ?>" class="d-block w-100 rounded-4" alt="Image <?= $key + 1 ?>">
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
                                                            <img src="<?= base_url() ?>/uploads/noimage.jpg ?>" class="d-block w-100 rounded-1 img-fluid" alt="Image ">

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
                                            <button type="button" class="btn btn-danger text-white" data-bs-dismiss="modal">Close</button>
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

                        <div class="col-md-6 col-lg-8 mt-3 ">

                            <h2><?= $aset->manufacture ?></h2>
                            <p class="lead"><b> <?= $aset->serial ?></b> </p>

                            <hr>
                            <div class="table-responsive">
                                <table style="width:100%; " class="easy-table easy-table-minimal specification_table">
                                    <tbody>
                                        <tr>
                                            <td style="width:30%;text-align:left">Product name:</td>
                                            <td style="width:60%;text-align:left"><?= $aset->manufacture ?></td>
                                            <td></td>
                                        </tr>

                                        <tr>
                                            <td style="text-align:left">Status:</td>
                                            <td style="text-align:left"><?= $aset->kondisi . ' <i class="fa-solid fa-arrow-right"></i> ' . $aset->stock . ' <i class="fa-solid fa-arrow-right"></i> ' . $aset->user . ' ' . $aset->lokasi ?></td>
                                            <td></td>
                                        </tr>

                                        <tr>
                                            <td style="text-align:left">Processor:</td>
                                            <td style="text-align:left"><?= $aset->prosesor ?></td>
                                            <td></td>
                                        </tr>

                                        <tr>
                                            <td style="text-align:left">RAM:</td>
                                            <td style="text-align:left"><?= $aset->ram ?></td>
                                            <td></td>
                                        </tr>

                                        <tr>
                                            <td style="text-align:left">Storage:</td>
                                            <td style="text-align:left"><?= $aset->hdd ?></td>
                                            <td></td>
                                        </tr>


                                    </tbody>
                                </table>
                            </div>

                            <hr>
                            <div class="table-responsive">
                                <table style="width:100%; " class="easy-table easy-table-minimal specification_table">
                                    <tbody>
                                        <tr>
                                            <td style="width:30%;text-align:left">Keterangan:</td>
                                            <td style="width:60%;text-align:left"><?= $aset->ket ?></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <hr>
                            <div class="table-responsive">
                                <table style="width:100%; " class="easy-table easy-table-minimal specification_table">
                                    <tbody>
                                        <tr>
                                            <td style="width:30%;text-align:left">Tersedia:</td>
                                            <td style="width:60%;text-align:left"><?= $jumlahmanufaktur ?> Unit</td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <hr>
                            <a href="<?= base_url('admin/suratkeluar/keranjang/' . $aset->serial) ?>" <?= ($admin->level == '3') ? 'hidden' : '' ?> class="btn btn-sm btn-success text-white mr-2">
                                <i class="fa-solid fa-upload"></i> Distribusikan
                            </a>
                            <a href="<?= base_url('admin/suratpinjam/keranjang/' . $aset->serial) ?>" <?= ($admin->level == '3') ? 'hidden' : '' ?> class="btn btn-sm btn-primary text-white mr-2">
                                <i class="fa-solid fa-file-import"> </i> Borrowed
                            </a>


                        </div>
                    </div>
                </div>
            </div>
            <!-- riwayat -->

            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                <main class="app-card app-card-settings shadow-sm p-4 mt-3">
                    <div class="row-md-6 mb-2">
                        <h2><?= $aset->manufacture ?></h2>
                        <p class="lead"><b>Spesifikasi :</b> Prosesor <?= $aset->prosesor ?>, RAM <?= $aset->ram ?>, <?= $aset->hdd ?>, SN <?= $aset->serial ?></p>
                    </div>
                    <table id="tabel1" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Waktu</th>
                                <th>Teknisi</th>
                                <th>End User</th>
                                <th>Lokasi</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $no = 1;
                            foreach ($riwayat as $key => $value) :

                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>

                                        <small class="text-danger"> <i class="fa-solid fa-clock"></i> <?= $value->tgl ?></small>

                                    </td>
                                    <td> <i class="fa-solid fa-user-gear"></i> <?= $value->teknisi ?><br>
                                    </td>
                                    <td>
                                        <i class="fa-solid fa-user"></i> <?= $value->user ?>
                                    </td>

                                    <td>
                                        <small class="text-success"> <i class="fa-solid fa-location-dot"></i></small><small class="text-success"> <?= $value->lokasi ?></small>
                                    </td>
                                    <td>
                                        <?= $value->ket ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url("admin/leptop/deleteriwayat/{$value->id}/{$aset->serial}") ?>" class="btn btn-sm btn-danger text-white hapusDataBtn" data-id="SN-HILANG 108">

                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>

                </main>
            </div>
            <!-- barcode -->
            <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                <div class=" p-5 text-center ">
                    <div class="imgBox">
                        <img class="qrImage" alt="QR Code">
                        <div class="text"> <?= $aset->serial ?></div>
                    </div>
                </div>
            </div>

            <!-- upate -->
            <div class="tab-pane fade" id="update-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                <div class=" p-1 ">
                    <div class="app-card app-card-accordion shadow-sm mb-4">
                        <div class="app-card-body p-4">
                            <form action="<?= base_url('admin/leptop/saveupdate') ?>" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <input type="text" name="id" hidden class="form-control" value="<?= $aset->id ?>" required>

                                    <div class="col-md-12 mb-1">
                                        <div class="row-md-6 mb-2">
                                            <h2><?= $aset->manufacture ?></h2>
                                            <p class="lead"><b>Spesifikasi :</b> Prosesor <?= $aset->prosesor ?>, RAM <?= $aset->ram ?>, <?= $aset->hdd ?>, SN <?= $aset->serial ?></p>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="col-md-8">

                                        Manufacture

                                        <div class="input-group">
                                            <select name="manufacture" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                                                <option value="">Pilih Manufacture</option>
                                                <?php foreach ($nama2 as $gr) : ?>
                                                    <option value="<?= $gr->manufacture ?>" <?= ($gr->manufacture == $aset->manufacture) ? 'selected' : '' ?>><?= $gr->manufacture ?></option>
                                                <?php endforeach ?>
                                                <?php foreach ($nama as $gr) : ?>
                                                    <option value="<?= $gr->nama ?>" <?= ($gr->nama == $aset->manufacture) ? 'selected' : '' ?>><?= $gr->nama ?></option>
                                                <?php endforeach ?>
                                            </select>
                                            <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary" type="button"><i class="fa-solid fa-plus text-white"></i></button>

                                        </div>


                                    </div>

                                    <div class="col-md-4">
                                        Prosesor
                                        <div class="input-group">
                                            <select name="prosesor" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                                                <option value="">Pilih Prosesor</option>
                                                <?php foreach ($prosesor2 as $gr) : ?>
                                                    <option value="<?= $gr->prosesor ?>" <?= ($gr->prosesor == $aset->prosesor) ? 'selected' : '' ?>><?= $gr->prosesor ?></option>
                                                <?php endforeach ?>
                                                <?php foreach ($prosesor as $gr) : ?>
                                                    <option value="<?= $gr->nama ?>" <?= ($gr->nama == $aset->prosesor) ? 'selected' : '' ?>><?= $gr->nama ?></option>
                                                <?php endforeach ?>

                                            </select>
                                            <button data-bs-toggle="modal" data-bs-target="#exampleModalprosessor" class="btn btn-primary" type="button"><i class="fa-solid fa-plus text-white"></i></button>
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        Generasi
                                        <div class="input-group">
                                            <select name="generasi" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                                                <option value="">Pilih Generasi</option>
                                                <?php foreach ($generasi2 as $gr) : ?>
                                                    <option value="<?= $gr->generasi ?>" <?= ($gr->generasi == $aset->generasi) ? 'selected' : '' ?>><?= $gr->generasi ?></option>
                                                <?php endforeach ?>
                                                <?php foreach ($generasi as $gr) : ?>
                                                    <option value="<?= $gr->nama ?>" <?= ($gr->nama == $aset->generasi) ? 'selected' : '' ?>><?= $gr->nama ?></option>
                                                <?php endforeach ?>

                                            </select>
                                            <button data-bs-toggle="modal" data-bs-target="#exampleModalgenerasi" class="btn btn-primary" type="button"><i class="fa-solid fa-plus text-white"></i></button>
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        Penyimpanan
                                        <div class="input-group">
                                            <select name="hdd" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                                                <option class="" value="">Pilih Penyimpanan</option>
                                                <?php foreach ($hdd2 as $gr) : ?>
                                                    <option value="<?= $gr->hdd ?>" <?= ($gr->hdd == $aset->hdd) ? 'selected' : '' ?>><?= $gr->hdd ?></option>
                                                <?php endforeach ?>
                                                <?php foreach ($hdd as $gr) : ?>
                                                    <option value="<?= $gr->nama ?>" <?= ($gr->nama == $aset->hdd) ? 'selected' : '' ?>><?= $gr->nama ?></option>
                                                <?php endforeach ?>

                                            </select>
                                            <button data-bs-toggle="modal" data-bs-target="#exampleModalpenyimpanan" class="btn btn-primary" type="button"><i class="fa-solid fa-plus text-white"></i></button>
                                        </div>

                                    </div>
                                    <div class="col-md-2">
                                        RAM
                                        <div class="input-group">
                                            <select name="ram" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                                                <option class="" value="">Pilih RAM</option>
                                                <?php foreach ($ram2 as $gr) : ?>
                                                    <option value="<?= $gr->ram ?>" <?= ($gr->ram == $aset->ram) ? 'selected' : '' ?>><?= $gr->ram ?></option>
                                                <?php endforeach ?>
                                                <?php foreach ($ram as $gr) : ?>
                                                    <option value="<?= $gr->nama ?>" <?= ($gr->nama == $aset->ram) ? 'selected' : '' ?>><?= $gr->nama ?></option>
                                                <?php endforeach ?>
                                            </select>
                                            <button data-bs-toggle="modal" data-bs-target="#exampleModalram" class="btn btn-primary" type="button"><i class="fa-solid fa-plus text-white"></i></button>
                                        </div>


                                    </div>
                                    <div class="col-md-2">
                                        Rincian
                                        <div class="input-group">
                                            <select name="rincian" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                                                <option class="" value="">Pilih RAM</option>
                                                <?php foreach ($rincian2 as $gr) : ?>
                                                    <option value="<?= $gr->rincian ?>" <?= ($gr->rincian == $aset->rincian) ? 'selected' : '' ?>><?= $gr->rincian ?></option>
                                                <?php endforeach ?>
                                                <?php foreach ($rincian as $gr) : ?>
                                                    <option value="<?= $gr->nama ?>" <?= ($gr->nama == $aset->rincian) ? 'selected' : '' ?>><?= $gr->nama ?></option>
                                                <?php endforeach ?>

                                            </select>
                                            <button data-bs-toggle="modal" data-bs-target="#exampleModalrincian" class="btn btn-primary" type="button"><i class="fa-solid fa-plus text-white"></i></button>
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        Status
                                        <div class="input-group">
                                            <select name="status" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                                                <option class="" value="">Pilih RAM</option>
                                                <?php foreach ($status2 as $gr) : ?>
                                                    <option value="<?= $gr->status ?>" <?= ($gr->status == $aset->status) ? 'selected' : '' ?>><?= $gr->status ?></option>
                                                <?php endforeach ?>
                                                <?php foreach ($status as $gr) : ?>
                                                    <option value="<?= $gr->nama ?>" <?= ($gr->nama == $aset->status) ? 'selected' : '' ?>><?= $gr->nama ?></option>
                                                <?php endforeach ?>

                                            </select>
                                            <button data-bs-toggle="modal" data-bs-target="#exampleModalstatus" class="btn btn-primary" type="button"><i class="fa-solid fa-plus text-white"></i></button>
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        Stok
                                        <select name="stock" class="form-select" required>
                                            <option value="">Pilih Stock</option>

                                            <option value="Tersedia" <?= ("Tersedia" == $aset->stock) ? 'selected' : '' ?>>Tersedia</option>
                                            <option value="Terdistribusi" <?= ("Terdistribusi" == $aset->stock) ? 'selected' : '' ?>>Terdistribusi</option>
                                            <option value="Dipinjam" <?= ("Dipinjam" == $aset->stock) ? 'selected' : '' ?>>Dipinjam</option>
                                            <option value="Backup" <?= ("Backup" == $aset->stock) ? 'selected' : '' ?>>Backup</option>
                                            <option value="None" <?= ("None" == $aset->stock) ? 'selected' : '' ?>>None</option>

                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        Kondisi
                                        <select name="kondisi" class="form-select" required>
                                            <option value="">Pilih Stock</option>
                                            <option value="OK" <?= ("OK" == $aset->kondisi) ? 'selected' : '' ?>>OK</option>
                                            <option value="RUSAK" <?= ("RUSAK" == $aset->kondisi) ? 'selected' : '' ?>>RUSAK</option>
                                            <option value="BLANKS" <?= ("BLANKS" == $aset->kondisi) ? 'selected' : '' ?>>BLANKS</option>
                                            <option value="None" <?= ("None" == $aset->kondisi) ? 'selected' : '' ?>>None</option>


                                        </select>
                                    </div>
                                    <hr>
                                    <div class="col-md-4">
                                        Serial
                                        <input type="text" name="serial" oninput="convertToUppercase(this)" class="form-control" value="<?= $aset->serial ?>" required>

                                    </div>
                                    <div class="col-md-4">
                                        Tanggal Masuk
                                        <input type="date" id="tglMasuk" name="masuk" class="form-control" value="<?= htmlspecialchars($aset->tgl_masuk) ?>" required>

                                    </div>
                                    <div class="col-md-4">
                                        Tanggal Keluar
                                        <input type="date" name="keluar" class="form-control">

                                    </div>
                                    <div class="col-md-12 mb-3">
                                        Keterangan
                                        <div class="form-floating">
                                            <textarea name="ket" id="sentenceCaseInput" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 200px"><?= $aset->ket ?></textarea>
                                            <label for="floatingTextarea2">Comments</label>
                                        </div>

                                    </div>
                                    <div class="col-md-12 text-right mb-4">
                                        <input type="submit" class="btn btn-primary text-white" value="Simpan">
                                    </div>
                                    <hr>


                                </div>
                            </form>




                        </div>
                    </div>
                </div>
            </div>

            <!-- images user -->
            <div class="tab-pane fade" id="enduser-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                <div class=" p-5  ">
                    <form action="<?= base_url('admin/leptop/images') ?>" method="POST" enctype="multipart/form-data">
                        <input type="text" hidden name="serial" oninput="convertToUppercase(this)" value="<?= $aset->serial ?>" class="form-control" required>

                        <main class="app-card app-card-settings shadow-sm p-4">
                            <div class="row">


                                <script>
                                    function showImage(imageUrl) {
                                        $('#carouselExampleIndicators .carousel-inner').html(`<div class="carousel-item active"><img src="${imageUrl}" class="d-block w-100 rounded-1 " alt="Clicked Image"></div>`);
                                    }
                                </script>


                                <div class="col-md-6">
                                    <h2><?= $aset->manufacture ?></h2>
                                    <p class="lead"><b>Spesifikasi :</b> Prosesor <?= $aset->prosesor ?>, RAM <?= $aset->ram ?>, <?= $aset->hdd ?></p>
                                    <hr>
                                    <div class="col-md-12 mb-2">
                                        <div class="col-md-12">
                                            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                                <div class="carousel-inner">
                                                    <?php if ($images == null) : ?>
                                                        <div class="carousel-item active">
                                                            <img src="<?= base_url() ?>/uploads/noimage.jpg" class="d-block w-100 rounded-1" alt="No Image">
                                                        </div>
                                                    <?php else : ?>
                                                        <?php foreach ($images as $key => $value) : ?>
                                                            <div class="carousel-item<?= $key == 0 ? ' active' : '' ?>">
                                                                <img src="<?= base_url() ?>/uploads/kegiatan/<?= $value->image ?>" data-bs-toggle="modal" data-bs-target="#imageModal3" class="d-block w-100 rounded-1" alt="Image <?= $key + 1 ?>">
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

                                            <!-- Modal -->
                                            <div class="modal fade" id="imageModal3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
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
                                                                            <a href="<?= base_url("admin/aset/deleteimages/{$value->id}/{$value->serial}") ?>" class="ms-4  text-white btn-sm hapusDataBtn">
                                                                                <i class="fa-regular fa-trash-can text-danger"></i>
                                                                            </a>
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
                                    </div>
                                    <div class="col-md-12 ">
                                        <div class="input-group">
                                            <input type="file" name="foto[]" multiple="multiple" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                            <button class="btn btn-primary" type="submit" id="inputGroupFileAddon04"><i class="fa-solid text-white fa-cloud-arrow-up"></i></button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </main>
                    </form>
                </div>
            </div>
            <!-- end user -->
            <div class="tab-pane fade" id="images-tab-pane" role="tabpanel" aria-labelledby="images-tab" tabindex="0">
                <div class=" p-5  ">
                    <form action="<?= base_url('admin/leptop/saveenduser') ?>" method="POST" enctype="multipart/form-data">

                        <main class="app-card app-card-settings shadow-sm p-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <h2><?= $aset->manufacture ?> </h2>
                                    <p class="lead"><b>Spesifikasi :</b> Prosesor <?= $aset->prosesor ?>, RAM <?= $aset->ram ?>, <?= $aset->hdd ?></p>

                                    <hr>

                                    <div class="col-md-12">
                                        User
                                        <input type="text" hidden name="serial" oninput="convertToUppercase(this)" value="<?= $aset->serial ?>" class="form-control" required>

                                        <input type="text" name="user" oninput="convertToUppercase(this)" value="<?= $aset->user ?>" class="form-control" required>

                                    </div>
                                    <div class="col-md-12">
                                        Lokasi
                                        <input type="text" name="lokasi" class="form-control" value="<?= $aset->lokasi ?>" required>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        Keterangan
                                        <div class="form-floating">
                                            <textarea name="ketupdate" id="sentenceCaseInput" class="form-control" required placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                            <label for="floatingTextarea2">Comments</label>
                                        </div>

                                    </div>

                                    <div class="col-md-12 text-right ">
                                        <input type="submit" class="btn btn-primary text-white w-100" value="Simpan">
                                    </div>



                                </div>
                            </div>
                        </main>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">...</div>
        </div>
</div>

</main>




</div>

<!-- Modal add manufacture-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Manufacture</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/manufacture/save') ?>" method="POST">

                <div class="modal-body">
                    <input type="text" name="nama" class="form-control" required placeholder="Dell Inspiration">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- tutup Modal -->

<!-- Modal add prosessor-->
<div class="modal fade" id="exampleModalprosessor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Prosesor</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/prosesor/save') ?>" method="POST">

                <div class="modal-body">
                    <input type="text" name="nama" class="form-control" required placeholder="Dell Inspiration">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- tutup Modal -->

<!-- Modal add generasi-->
<div class="modal fade" id="exampleModalgenerasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Generasi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/generasi/save') ?>" method="POST">

                <div class="modal-body">
                    <input type="text" name="nama" class="form-control" required placeholder="Dell Inspiration">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- tutup Modal -->

<!-- Modal add penyimpanan-->
<div class="modal fade" id="exampleModalpenyimpanan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Penyimpanan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/hdd/save') ?>" method="POST">

                <div class="modal-body">
                    <input type="text" name="nama" class="form-control" required placeholder="Dell Inspiration">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- tutup Modal -->

<!-- Modal add Ram-->
<div class="modal fade" id="exampleModalram" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Ram</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/ram/save') ?>" method="POST">

                <div class="modal-body">
                    <input type="text" name="nama" class="form-control" required placeholder="Dell Inspiration">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- tutup Modal -->

<!-- Modal add Rincian-->
<div class="modal fade" id="exampleModalrincian" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Rincian</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/rincian/save') ?>" method="POST">

                <div class="modal-body">
                    <input type="text" name="nama" class="form-control" required placeholder="Dell Inspiration">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- tutup Modal -->
<!-- Modal add setatus-->
<div class="modal fade" id="exampleModalstatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Setatus</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/setatus/save') ?>" method="POST">

                <div class="modal-body">
                    <input type="text" name="nama" class="form-control" required placeholder="Dell Inspiration">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- tutup Modal -->

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
        let qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=" + baseUrl + "/admin/aset/view/" + text;
        qrImage.src = qrCodeUrl;
        imgBox.classList.add("show-img");
    }
</script>

<script>
    function showImage(imageUrl) {
        $('#imageModal .carousel-inner').html(`<div class="carousel-item active"><img src="${imageUrl}" class="d-block w-100 rounded-1 img-fluid" alt="Clicked Image"></div>`);
    }
</script>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- Additional JavaScript code goes here -->
<?= $this->endSection() ?>