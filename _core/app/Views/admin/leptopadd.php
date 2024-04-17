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
            <form action="<?= base_url('admin/leptop/save') ?>" method="POST" enctype="multipart/form-data">
                <div class="row">

                    <div class="col-md-12 mb-1">
                        <div class="row-md-6 mb-2">
                            <h2>Add Leptop</h2>
                            <p class="lead">Masukan data sesuai dengan sepesifikasi leptop</p>
                        </div>
                    </div>

                    <hr>
                    <div class="col-md-8">

                        Manufacture

                        <div class="input-group">
                            <select name="manufacture" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                                <option value="">Pilih Manufacture</option>

                                <?php foreach ($nama as $gr) : ?>
                                    <option value="<?= $gr->nama ?>"><?= $gr->nama ?></option>
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

                                <?php foreach ($prosesor as $gr) : ?>
                                    <option value="<?= $gr->nama ?>"><?= $gr->nama ?></option>
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

                                <?php foreach ($generasi as $gr) : ?>
                                    <option value="<?= $gr->nama ?>"><?= $gr->nama ?></option>
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

                                <?php foreach ($hdd as $gr) : ?>
                                    <option value="<?= $gr->nama ?>"><?= $gr->nama ?></option>
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

                                <?php foreach ($ram as $gr) : ?>
                                    <option value="<?= $gr->nama ?>"><?= $gr->nama ?></option>
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

                                <?php foreach ($rincian as $gr) : ?>
                                    <option value="<?= $gr->nama ?>"></option>
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

                                <?php foreach ($status as $gr) : ?>
                                    <option value="<?= $gr->nama ?>"><?= $gr->nama ?></option>
                                <?php endforeach ?>

                            </select>
                            <button data-bs-toggle="modal" data-bs-target="#exampleModalstatus" class="btn btn-primary" type="button"><i class="fa-solid fa-plus text-white"></i></button>
                        </div>

                    </div>
                    <div class="col-md-4">
                        Stok
                        <select name="stock" class="form-select" required>
                            <option value="">Pilih Stock</option>

                            <option value="Tersedia">Tersedia</option>
                            <option value="Terdistribusi">Terdistribusi</option>
                            <option value="Dipinjam">Dipinjam</option>
                            <option value="Backup">Backup</option>
                            <option value="None">None</option>

                        </select>
                    </div>
                    <div class="col-md-4 mb-4">
                        Kondisi
                        <select name="kondisi" class="form-select" required>
                            <option value="">Pilih Stock</option>
                            <option value="OK">OK</option>
                            <option value="RUSAK">RUSAK</option>
                            <option value="BLANKS">BLANKS</option>
                            <option value="None">None</option>


                        </select>
                    </div>
                    <hr>
                    <div class="col-md-4">
                        Serial
                        <input type="text" name="serial" oninput="convertToUppercase(this)" class="form-control" required>

                    </div>
                    <div class="col-md-4">
                        Tanggal Masuk
                        <input type="date" id="tglMasuk" name="masuk" class="form-control" required>

                    </div>
                    <div class="col-md-4">
                        Tanggal Keluar
                        <input type="date" name="keluar" class="form-control">

                    </div>
                    <div class="col-md-12 mb-3">
                        Keterangan
                        <div class="form-floating">
                            <textarea name="ket" id="sentenceCaseInput" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 200px"></textarea>
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