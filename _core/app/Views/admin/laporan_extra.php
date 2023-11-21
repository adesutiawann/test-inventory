<?= $this->extend('admin/template') ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="app-page-title"><?= $title ?></h1>

<div class="app-card app-card-accordion shadow-sm mb-4">
    <div class="app-card-body p-4">
        <form action="<?= base_url('admin/laporan_extra') ?>" method="GET">
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
            <h6>Tanggal: <?= $_GET['tanggal'] ?></h6>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Guru/Pembina</th>
                            <th>Extra</th>
                            <th>Foto Absensi</th>
                            <th>Foto Kegiatan 1</th>
                            <th>Foto Kegiatan 2</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        <?php foreach ($laporan as $lap) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $lap->tanggal ?></td>
                                <td><?= $lap->guru ?></td>
                                <td><?= $lap->extra ?></td>
                                <td><a href="<?= base_url('uploads/kegiatan/' . $lap->foto_absensi) ?>" target="_blank" class="btn btn-info btn-sm"><i class="bi bi-image"></i> Lihat Foto Absensi</a></td>
                                <td><a href="<?= base_url('uploads/kegiatan/' . $lap->foto_kegiatan1) ?>" target="_blank" class="btn btn-warning btn-sm"><i class="bi bi-image"></i> Lihat Foto Kegiatan 1</a></td>
                                <td><a href="<?= base_url('uploads/kegiatan/' . $lap->foto_kegiatan2) ?>" target="_blank" class="btn btn-danger btn-sm"><i class="bi bi-image"></i> Lihat Foto Kegiatan 2</a></td>
                                <td><a href="<?= base_url('admin/laporan_extra/cetak/' . $lap->id) ?>" class="btn btn-primary btn-sm text-white" target="_blank"><i class="bi bi-printer"></i> Cetak</a></td>
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