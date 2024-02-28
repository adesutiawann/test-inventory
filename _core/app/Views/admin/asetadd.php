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
                    <strong>Form Data :</strong>
                </div>
                <hr>
                <div class="col-md-8">
                    Manufacture
                    <div class="input-group">
                        <select name="manufacture" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                            <option selected="">Pilih Manufacture</option>
                            <?php foreach ($nama as $gr) : ?>
                                <option value="<?= $gr->nama ?>"><?= $gr->nama ?></option>
                            <?php endforeach ?>
                        </select>
                        <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-regular fa-square-plus text-white"></i></i></button>
                    </div>

                </div>
                <div class="col-md-4">
                    Status
                    <select name="status" class="form-select" required>
                        <option value="">Pilih Status</option>
                        <?php foreach ($status as $gr) : ?>
                            <option value="<?= $gr->nama ?>"><?= $gr->nama ?></option>
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

                <div class="col-md-2">
                    Prosesor
                    <select name="prosesor" class="form-select" required>
                        <option value="">Pilih Prosesor</option>
                        <?php foreach ($prosesor as $gr) : ?>
                            <option value="<?= $gr->nama ?>"><?= $gr->nama ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-2">
                    Generasi
                    <select name="generasi" class="form-select" required>
                        <option value="">Pilih Generasi</option>
                        <?php foreach ($generasi as $gr) : ?>
                            <option value="<?= $gr->nama ?>"><?= $gr->nama ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-2">
                    HDD/SSD
                    <select name="hdd" class="form-select" required>
                        <option value="">Pilih HDD/SSD</option>
                        <?php foreach ($hdd as $gr) : ?>
                            <option value="<?= $gr->nama ?>"><?= $gr->nama ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-1">
                    RAM
                    <select name="ram" class="form-select" required>
                        <option value="">Pilih RAM</option>
                        <?php foreach ($ram as $gr) : ?>
                            <option value="<?= $gr->nama ?>"><?= $gr->nama ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-1">
                    Rincian
                    <select name="rincian" class="form-select" required>
                        <option value="">Pilih Rincian</option>
                        <?php foreach ($rincian as $gr) : ?>
                            <option value="<?= $gr->nama ?>"><?= $gr->nama ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="col-md-2">
                    Stok
                    <select name="stock" class="form-select" required>
                        <option value="">Pilih Stock</option>
                        <?php foreach ($stock as $gr) : ?>
                            <option value="<?= $gr->nama ?>"><?= $gr->nama ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-2 mb-2">
                    Kondisi
                    <select name="kondisi" class="form-select" required>
                        <option value="">Pilih Kondisi</option>
                        <?php foreach ($kondisi as $gr) : ?>
                            <option value="<?= $gr->nama ?>"><?= $gr->nama ?></option>

                        <?php endforeach ?>
                    </select>
                </div>

                <div class="col-md-4">
                    Serial
                    <input type="text" name="serial" oninput="convertToUppercase(this)" class="form-control" required>

                </div>
                <div class="col-md-4">
                    Tanggal Masuk
                    <input type="date" name="masuk" class="form-control" required>
                </div>
                <div class="col-md-4">
                    Tanggal Keluar
                    <input type="date" name="keluar" class="form-control">

                </div>
                <div class="col-md-12 mb-5">
                    Deskripsi
                    <div class="form-floating">
                        <textarea name="ket" id="sentenceCaseInput" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                        <label for="floatingTextarea2">Comments</label>
                    </div>

                </div>




                <div class="col-md-12 text-right ">
                    <input type="submit" class="btn btn-primary text-white" value="Simpan">
                </div>
            </div>
        </form>


    </div>
</div>


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">New Manufacture</h1>
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
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?= $this->endSection() ?>