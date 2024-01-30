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



<div class="app-card app-card-accordion shadow-sm mb-4">
    <div class="app-card-body p-4">
        <form action="<?= base_url('admin/aset/save') ?>" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <strong>Form Data Edit:</strong>
                </div>
                <hr>
                <div class="col-md-8">
                    Manufacture
                    <input type="text" name="id" hidden class="form-control" value="<?= $aset->id  ?>" required>

                    <select name="manufacture" class="form-select" required>
                        <option value="">Pilih Manufacture</option>
                        <?php foreach ($nama as $gr) : ?>
                            <option value="<?= $gr->nama ?>" <?= ($gr->nama == $aset->manufacture) ? 'selected' : '' ?>><?= $gr->nama ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-4" hidden>
                    Type
                    <select name="type" class="form-select">
                        <?php foreach ($type as $gr) : ?>
                            <option value="<?= $gr->nama ?>"><?= $gr->nama ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-4">
                    Prosesor
                    <select name="prosesor" class="form-select" required>
                        <option value="">Pilih Prosesor</option>
                        <?php foreach ($prosesor as $gr) : ?>
                            <option value="<?= $gr->nama ?>" <?= ($gr->nama == $aset->prosesor) ? 'selected' : '' ?>><?= $gr->nama ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-4">
                    Generasi
                    <select name="generasi" class="form-select" required>
                        <option value="">Pilih Generasi</option>
                        <?php foreach ($generasi as $gr) : ?>
                            <option value="<?= $gr->nama ?>" <?= ($gr->nama == $aset->generasi) ? 'selected' : '' ?>><?= $gr->nama ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-4">
                    HDD/SSD
                    <select name="hdd" class="form-select" required>
                        <option value="">Pilih HDD/SSD</option>
                        <?php foreach ($hdd as $gr) : ?>
                            <option value="<?= $gr->nama ?>" <?= ($gr->nama == $aset->hdd) ? 'selected' : '' ?>><?= $gr->nama ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-2">
                    RAM
                    <select name="ram" class="form-select" required>
                        <option value="">Pilih RAM</option>
                        <?php foreach ($ram as $gr) : ?>
                            <option value="<?= $gr->nama ?>" <?= ($gr->nama == $aset->ram) ? 'selected' : '' ?>><?= $gr->nama ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-2">
                    Rincian
                    <select name="rincian" class="form-select" required>
                        <option value="">Pilih Rincian</option>
                        <?php foreach ($rincian as $gr) : ?>
                            <option value="<?= $gr->nama ?>" <?= ($gr->nama == $aset->rincian) ? 'selected' : '' ?>><?= $gr->nama ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-4">
                    Status
                    <select name="status" class="form-select" required>
                        <option value="">Pilih Setatus</option>
                        <?php foreach ($status as $gr) : ?>
                            <option value="<?= $gr->nama ?>" <?= ($gr->nama == $aset->status) ? 'selected' : '' ?>><?= $gr->nama ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-4">
                    Stok
                    <select name="stock" class="form-select" required>
                        <option value="">Pilih Stock</option>
                        <?php foreach ($stock as $gr) : ?>
                            <option value="<?= $gr->nama ?>" <?= ($gr->nama == $aset->stock) ? 'selected' : '' ?>><?= $gr->nama ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-4 mb-4">
                    Kondisi
                    <select name="kondisi" class="form-select" required>
                        <option value="">Pilih Stock</option>
                        <?php foreach ($kondisi as $gr) : ?>
                            <option value="<?= $gr->nama ?>" <?= ($gr->nama == $aset->kondisi) ? 'selected' : '' ?>><?= $gr->nama ?></option>

                        <?php endforeach ?>
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
                                            <img src="<?= base_url() ?>/uploads/noimage.png" class="d-block w-100 rounded-1" alt="No Image">
                                        </div>
                                    <?php else : ?>
                                        <?php foreach ($images as $key => $value) : ?>
                                            <div class="carousel-item<?= $key == 0 ? ' active' : '' ?>">
                                                <img src="<?= base_url() ?>/uploads/kegiatan/<?= $value->image ?>" class="d-block w-100 rounded-1" alt="Image <?= $key + 1 ?>">
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
                                <?php if ($images == null) : ?>
                                    <div class="col">
                                    </div>
                                <?php else : ?>
                                    <?php foreach ($images as $key => $value) : ?>
                                        <div class="col">
                                            <img src="<?= base_url() ?>/uploads/kegiatan/<?= $value->image ?>" class="d-block w-100 rounded-1" alt="Image <?= $key + 1 ?>" onclick="showImage('<?= base_url() ?>/uploads/kegiatan/<?= $value->image ?>')">
                                            <a href="<?= base_url("admin/aset/deleteimages/{$value->id}/{$value->serial}") ?>" onclick="return confirm('Yakin ingin menghapus?')">
                                                <i class="fa-solid fa-xmark text-danger"></i>
                                            </a>
                                        </div>

                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <script>
                            function showImage(imageUrl) {
                                // Mengganti gambar di carousel dengan gambar yang diklik
                                $('#carouselExampleIndicators .carousel-inner').html(`<div class="carousel-item active"><img src="${imageUrl}" class="d-block w-100 rounded-1" alt="Clicked Image"></div>`);
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
                <th scope="col"><i class="fa-solid fa-trash "></i></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($riwayat as $key => $value) :

            ?>
                <tr>
                    <th scope="row"><?= $no++ ?></th>
                    <td><?= $value->tgl ?> </td>
                    <td><?= $value->ket ?> </td>
                    <td><?= $value->user ?> </td>
                    <td><?= $value->lokasi ?> </td>
                    <td><?= $value->teknisi ?> </td>
                    <td width="" <?= ($admin->level == '3') ? 'hidden' : '' ?>>


                        <a href="<?= base_url("admin/aset/deleteriwayat/{$value->id}/{$value->serial}") ?>" class="" onclick="return confirm('Yakin ingin menghapus?')">
                            <i class="fa-solid fa-xmark text-danger"></i>

                        </a>


                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</main>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?= $this->endSection() ?>