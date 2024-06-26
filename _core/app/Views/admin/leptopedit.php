<?= $this->extend('admin/template') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<style>
    /* Contoh CSS untuk menentukan lebar dan tinggi textarea */
    textarea {
        width: 300px;
        /* Lebar textarea */
        height: 100px;
        /* Tinggi textarea */
    }
</style>
<h2 class="app-page-title text-scondary fw-semibold"><?= $title ?></h2>

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

<!-- upate  form hideen -->
<div class="app-card app-card-accordion shadow-sm mb-4" hidden>
    <div class="app-card-body p-4">
        <form action="<?= base_url('admin/leptop/save') ?>" method="POST" enctype="multipart/form-data">
            <div class="row">
                <input type="text" name="id" hidden class="form-control" value="<?= $aset->id ?>" required>

                <div class="col-md-12 mb-4">
                    <h2><?= $aset->manufacture ?></h2>
                    <p class="lead"><b>Spesifikasi :</b> Prosesor <?= $aset->prosesor ?>, RAM <?= $aset->ram ?>, <?= $aset->hdd ?>,SN <?= $aset->serial ?></p>

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
                        <button class="btn btn-primary" type="button"><i class="fa-solid fa-plus text-white"></i></button>
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
                        <button class="btn btn-primary" type="button"><i class="fa-solid fa-plus text-white"></i></button>
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
                        <button class="btn btn-primary" type="button"><i class="fa-solid fa-plus text-white"></i></button>
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
                        <button class="btn btn-primary" type="button"><i class="fa-solid fa-plus text-white"></i></button>
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
                        <button class="btn btn-primary" type="button"><i class="fa-solid fa-plus text-white"></i></button>
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
                        <button class="btn btn-primary" type="button"><i class="fa-solid fa-plus text-white"></i></button>
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

                <hr>

                <main class="app-card app-card-settings shadow-sm p-4">
                    <div class="row">
                        <div class="col-md-6">
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

                        <script>
                            function showImage(imageUrl) {
                                $('#carouselExampleIndicators .carousel-inner').html(`<div class="carousel-item active"><img src="${imageUrl}" class="d-block w-100 rounded-1 " alt="Clicked Image"></div>`);
                            }
                        </script>


                        <div class="col-md-6">
                            <h2><?= $aset->manufacture ?></h2>
                            <p class="lead"><b>Spesifikasi :</b> Prosesor <?= $aset->prosesor ?>, RAM <?= $aset->ram ?>, <?= $aset->hdd ?></p>

                            <hr>
                            <div class="col-md-12">
                                images
                                <div class="input-group">
                                    <input type="file" name="foto[]" multiple="multiple" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">

                                </div>
                            </div>

                            <div class="col-md-12">
                                User
                                <input type="text" name="user" oninput="convertToUppercase(this)" value="<?= $aset->user ?>" class="form-control" required>

                            </div>
                            <div class="col-md-12">
                                Lokasi
                                <input type="text" name="lokasi" class="form-control" value="<?= $aset->lokasi ?>" required>
                            </div>

                            <div class="col-md-12 mb-5">
                                Keterangan
                                <div class="form-floating">
                                    <textarea name="ketupdate" id="sentenceCaseInput" class="form-control" required placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                    <label for="floatingTextarea2">Comments</label>
                                </div>

                            </div>

                            <div class="col-md-12 text-right ">
                                <input type="submit" class="btn btn-primary text-white" value="Simpan">
                            </div>
                            <hr>


                        </div>
                    </div>
                </main>
            </div>
        </form>




    </div>
</div>
<!-- upate history hidden -->
<main class="app-card app-card-settings shadow-sm p-4 mt-3" hidden>

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

                                <div class="d-flex justify-content-end ">
                                    <a href="#" class="ms-4">
                                        <i class="fa-solid fa-location-dot text-danger"></i>
                                        <?= $value->lokasi ?>
                                    </a>

                                    <a href="<?= base_url("admin/aset/deleteriwayat/{$value->id}/{$value->serial}") ?>" class="ms-4  text-white btn-sm ">
                                        <i class="fa-regular fa-trash-can text-danger"></i>
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
    // Menangani klik pada setiap tautan hapus data
    document.querySelectorAll('.hapusDataBtn').forEach(function(element) {
        element.addEventListener('click', function(event) {
            event.preventDefault(); // Menghentikan peristiwa default pengklikan tautan

            var dataId = element.getAttribute('data-id');
            var href = element.getAttribute('href');

            // Tampilkan SweetAlert konfirmasi
            Swal.fire({
                title: 'Anda yakin?',
                text: 'Data akan dihapus permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna menekan tombol konfirmasi, navigasikan ke tautan penghapusan data
                    window.location.href = href;
                }
            });
        });
    });

    function refreshInput() {
        document.getElementById('textInput').value = '';

        document.getElementById('dateInput').value = '';
        document.getElementById('dateInput').value = '';
        textInput.focus();
    }

    function refreshInput1() {
        document.getElementById('textInput1').value = '';

        document.getElementById('dateInput1').value = '';
        document.getElementById('dateInput1').value = '';
        textInput1.focus();
    }

    function refreshInput2() {
        document.getElementById('textInput2').value = '';

        document.getElementById('dateInput2').value = '';
        document.getElementById('dateInput2').value = '';
        textInput2.focus();
    }
</script>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-file-import"></i> Add Manufacture </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row" action="<?= base_url('admin/leptop/saveeditmodalmanufacture') ?>" method="POST">

                    <div class="col-md-11 col-sm-6 col-xs-10 mb-2">
                        <input type="text" hidden name="id" class="form-control" value="<?= $aset->serial ?>" required>

                        <input type="input" class="form-control" name="nama" required placeholder="Manufacture">

                    </div>
                    <div class="col-md-1 col-sm-3 text-end mb-2 ">
                        <a href="<?= base_url('admin/manufacture') ?>" class="text-info">
                            <i class="fa-solid fa-file-circle-question"></i>
                        </a>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary text-white"> <i class="fa-solid fa-file-import"></i> Save</button>

            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal add manufacture-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Manufacture</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/leptop/saveeditmodalmanufactureview') ?>" method="POST">

                    <div class="col-md-11 col-sm-6 col-xs-10 mb-2">
                        <input type="text" name="id" value="<?= $aset->serial ?>" class="form-control" required placeholder="Manufacture">
                        <input type="text" name="nama" class="form-control" required placeholder="Manufacture">
                    </div>
                    <div class="col-md-1 col-sm-3 text-end mb-2 ">
                        <a href="<?= base_url('admin/manufacture') ?>" class="text-info">
                            <i class="fa-solid fa-file-circle-question"></i>
                        </a>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
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
            <div class="modal-body">
                <form action="<?= base_url('admin/prosesor/save') ?>" method="POST">

                    <div class="col-md-11 col-lg-11 col-sm-6 col-xs-10 mb-2">
                        <input type="text" name="nama" class="form-control" required placeholder="Prosessor">
                    </div>
                    <div class="col-md-1 col-lg-1 col-sm-3 text-end mb-2 ">
                        <a href="<?= base_url('admin/manufacture') ?>" class="text-info">
                            <i class="fa-solid fa-file-circle-question"></i>
                        </a>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
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
                    <input type="text" name="nama" class="form-control" required placeholder="Generasi">
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
                    <input type="text" name="nama" class="form-control" required placeholder="Penyimpanan">
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
                    <input type="text" name="nama" class="form-control" required placeholder="Ram">
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
                    <input type="text" name="nama" class="form-control" required placeholder="Rincian">
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Status</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/setatus/save') ?>" method="POST">

                <div class="modal-body">
                    <input type="text" name="nama" class="form-control" required placeholder="Status">
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

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?= $this->endSection() ?>