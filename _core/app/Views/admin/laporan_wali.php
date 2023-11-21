<?= $this->extend('admin/template') ?>

<?= $this->section('css') ?>
<style>
    .btn-label {
        position: relative;
        left: -12px;
        display: inline-block;
        padding: 6px 12px;
        background: rgba(0, 0, 0, 0.15);
        border-radius: 3px 0 0 3px;
    }

    .btn-labeled {
        padding-top: 0;
        padding-bottom: 0;
    }

    .btn {
        margin-bottom: 10px;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="app-page-title"><?= $title ?></h1>

<div class="app-card app-card-accordion shadow-sm mb-4">
    <div class="app-card-body p-4">
        <form action="<?= base_url('admin/laporan_wali') ?>" method="GET">
            <!-- <label for="">Silahkan pilih tanggal dan kelas: </label> -->
            <div class="row">
                <div class="col-md-3">
                    <label for="">Pilih Tanggal:</label>
                    <input type="date" name="tanggal" class="form-control my-2" required>
                </div>
                <div class="col-md-3">
                    <br>
                    <input type="submit" class="btn btn-primary text-white my-2" value="Proses">
                </div>
            </div>
        </form>
    </div>
</div>


<?php if (isset($_GET['tanggal'])) : ?>
    <div class="app-card app-card-accordion shadow-sm mb-4">
        <div class="app-card-body p-4">
            <?php if (session()->getFlashData('success')) : ?>
                <div class="alert alert-success">
                    <?= session()->getFlashData('success') ?>
                </div>
            <?php endif ?>
            <?php if (session()->getFlashData('error')) : ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashData('error') ?>
                </div>
            <?php endif ?>

            <h6>Tanggal: <?= $_GET['tanggal'] ?></h6>
            <hr>
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="50" style="white-space: nowrap; text-align:center;">NO.</th>
                            <th width="300" style="white-space: nowrap; text-align:center;">NAMA</th>
                            <th width="100" style="white-space: nowrap; text-align:center;">KELAS</th>
                            <th width="100" style="white-space: nowrap; text-align:center;">REKAP</th>
                            <th width="100" style="white-space: nowrap; text-align:center;">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($walikelas as $kls) : ?>
                            <?php
                            if ($absensi->where(['walikelas'=> $kls->guru, 'tanggal' => $_GET['tanggal']])->countAllResults() == 0) {
                                $abs = '<span class="badge bg-warning">belum</span>';
                            } else {
                                $abs = '<span class="badge bg-success">sudah</span>';
                            }
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $kls->nama ?></td>
                                <td><?= $kls->kelas ?></td>
                                <td><?= $abs ?></td>
                                <td><a href="<?= base_url('admin/laporan_wali/notif/' . $kls->id) ?>" class="btn btn-primary">Kirim WA</a></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif ?>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?= $this->endSection() ?>