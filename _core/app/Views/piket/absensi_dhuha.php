<?= $this->extend('walikelas/template') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="app-page-title"><?= $title ?></h1>

<div class="app-card app-card-accordion shadow-sm mb-4">
    <div class="app-card-body p-4">
        <?php if (session()->getFlashData('error_add')) : ?>
            <div class="alert alert-danger">
                <?= session()->getFlashData('error_add') ?>
            </div>
        <?php endif ?>
        <?php if (session()->getFlashData('success_add')) : ?>
            <div class="alert alert-success">
                <?= session()->getFlashData('success_add') ?>
            </div>
        <?php endif ?>

        <form action="<?= base_url('piket/absensi_dhuha/save') ?>" method="POST">
            <div class="row">
                <div class="col-md-3">
                    <strong>Pilih siswa:</strong>
                </div>
                <div class="col-md-4">
                    <select name="siswa" class="form-select select" style="width:100%" required>
                        <option value="">Pilih Siswa</option>
                        <?php foreach ($siswa as $s) : ?>
                            <option value="<?= $s->id ?>"><?= $s->nama ?> &bull; <?= $s->kelas ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-1">
                    <input type="submit" class="btn btn-primary text-white" value="Tambah">
                </div>
            </div>
        </form>
    </div>
</div>

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

        <div class="table-responsive">
            <table id="table" class="table table-striped">
                <thead>
                    <tr>
                        <th>NO.</th>
                        <th>TANGGAL</th>
                        <th>PETUGAS</th>
                        <th>NAMA SISWA</th>
                        <th>KELAS</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select').select2();
        $('.selectPoin').select2();
    });
    $(document).ready(function() {
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '<?= base_url('piket/absensi_dhuha/data') ?>',
            order: [],
            columns: [{
                    data: 'no',
                    orderable: false
                },
                {
                    data: 'tanggal'
                },
                {
                    data: 'guru'
                },
                {
                    data: 'nama'
                },
                {
                    data: 'kelas'
                },
                {
                    data: 'action',
                    orderable: false
                },
            ]
        });
    });
</script>
<?= $this->endSection() ?>