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

        <form action="<?= base_url('admin/monitor/save') ?>" method="POST">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <strong>Form Data monitor:</strong>
                </div>
                <hr>
                <div class="col-md-4">
                    Manufacture
                    <select name="manufacture" class="form-select">
                        <?php foreach ($nama as $gr) : ?>
                            <option value="<?= $gr->id ?>"><?= $gr->nama ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-4">
                    Type
                    <select name="type" class="form-select">
                        <?php foreach ($type as $gr) : ?>
                            <option value="<?= $gr->id ?>"><?= $gr->nama ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-4">
                    Port Cable
                    <select name="port" class="form-select">
                        <?php foreach ($port as $gr) : ?>
                            <option value="<?= $gr->id ?>"><?= $gr->port ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="col-md-4">
                    Status
                    <select name="status" class="form-select">
                        <?php foreach ($status as $gr) : ?>
                            <option value="<?= $gr->id ?>"><?= $gr->nama ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-4">
                    Stok
                    <select name="stock" class="form-select">
                        <?php foreach ($stock as $gr) : ?>
                            <option value="<?= $gr->id ?>"><?= $gr->nama ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-4 mb-4">
                    Kondisi
                    <select name="kondisi" class="form-select">
                        <?php foreach ($kondisi as $gr) : ?>
                            <option value="<?= $gr->id ?>"><?= $gr->nama ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <hr>
                <div class="col-md-4">
                    Serial
                    <input type="text" name="serial" class="form-control" required>

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
                    Keterangan
                    <div class="form-floating">
                        <textarea name="ket" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
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

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?= $this->endSection() ?>