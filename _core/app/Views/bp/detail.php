<?= $this->extend('walikelas/template') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>

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


        <h5>NAMA <?= $siswa->nama ?></h5>
        <h5>KELAS <?= $siswa->kelas ?></h5>
        <hr>
        <table id="table" class="table table-striped table-bordered table-sm">
            <thead>
                <tr>
                    <th width="50">NO.</th>
                    <th>TANGGAL</th>
                    <th>NAMA PELANGGARAN</th>
                    <th width="100">POIN</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0; ?>
                <?php $no = 1; ?>
                <?php foreach ($pelanggaran as $p) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $p->tanggal ?></td>
                        <td><?= $p->pelanggaran ?></td>
                        <td><?= $p->poin ?></td>
                    </tr>
                    <?php $total += $p->poin ?>
                <?php endforeach ?>

            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" align="right"><b>TOTAL</b></td>
                    <td><b><?= $total ?></b></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<?= $this->endSection() ?>