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
<h1 class="app-page-title"><?= $title ?></h1>



<div class="app-card app-card-accordion shadow-sm mb-4">
    <div class="app-card-body p-4">
        <?php if (session()->getFlashData('error')) : ?>
            <div class="alert alert-danger">
                <?= session()->getFlashData('error') ?>
            </div>
        <?php endif ?>
        <?php if (session()->getFlashData('success')) : ?>
            <div class="alert alert-success">
                <?= session()->getFlashData('success') ?>
            </div>
        <?php endif ?>

        <form action="<?= base_url('admin/aset/save') ?>" method="POST">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <strong>Form Data Edit:</strong>
                </div>
                <hr>
                <div class="col-md-8">
                    Manufacture
                    <input type="text" name="id" hidden class="form-control" value="<?= $aset->id ?>" required>

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
                        <textarea name="ket" id="sentenceCaseInput" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"><?= $aset->ket ?></textarea>
                        <label for="floatingTextarea2">Comments</label>
                    </div>

                </div>
                <div>
                    <strong>Keterangan Update:</strong>
                </div>
                <hr>

                <main class="app-card app-card-settings shadow-sm p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="<?= base_url() ?>/assets/images/aset/noimage.png" class="d-block w-100 rounded-1 " alt="Laptop 1">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="<?= base_url() ?>/assets/images/aset/leptop1.jpeg" class="d-block w-100" alt="Laptop 2">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="<?= base_url() ?>/assets/images/aset/leptop2.jpeg" class="d-block w-100 rounded-2" alt="Laptop 3">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="<?= base_url() ?>/assets/images/aset/leptop.jpeg" class="d-block w-100" alt="Laptop 4">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="<?= base_url() ?>/assets/images/aset/leptop2.jpeg" class="d-block w-100" alt="Laptop 5">
                                    </div>
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

                        </div>

                        <div class="col-md-6">
                            <h2>XPS 13 Plus Laptop</h2>
                            <p class="lead"><b>Spesifikasi :</b> Prosesor Intel i5, RAM 8GB, SSD 256GB</p>

                            <hr>


                            <div class="col-md-12">
                                User
                                <input type="text" name="user" oninput="convertToUppercase(this)" value="<?= $aset->user ?>" class="form-control" required>

                            </div>
                            <div class="col-md-12">
                                Lokasi
                                <input type="text" name="lokasi" class="form-control" value="<?= $aset->lokasi ?>" required>
                            </div>
                            <div class="col-md-12">
                                images

                                <div class="row">
                                    <input type="file" name="image[]" multiple class="form-control">
                                    <input type="submit" class="btn btn-primary text-white" value="upload">
                                </div>
                            </div>
                            <div class="col-md-12 mb-5">
                                Keterangan Update
                                <div class="form-floating">
                                    <textarea name="ketupdate" id="sentenceCaseInput" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
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



        <form action="<?= base_url('admin/aset/process') ?>" method="POST">
            <input type="file" name="image[]" multiple class="form-control">
            <input type="submit" class="btn btn-primary text-white" value="upload">
        </form>

    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?= $this->endSection() ?>