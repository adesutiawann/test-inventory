<?= $this->extend('walikelas/template') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="app-page-title"><?= $title ?></h1>

<div class="app-card app-card-settings shadow-sm mb-4">
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

        <div class="row">
            <div class="col-md-5">
                <form method="POST" action="<?= base_url('pembina/laporan_kegiatan/save') ?>" class="settings-form" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="setting-input-2" class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <select name="extra" class="form-select">
                            <?php foreach (unserialize(base64_decode($pembina->extra)) as $extra) : ?>
                                <option value="<?= $extra ?>"><?= $extra ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="setting-input-2" class="form-label">Foto Absensi</label>
                        <input type="file" name="foto_absensi" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="setting-input-2" class="form-label">Foto Kegiatan 1</label>
                        <input type="file" name="foto_kegiatan1" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="setting-input-2" class="form-label">Foto Kegiatan 2</label>
                        <input type="file" name="foto_kegiatan2" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary" value="Simpan">
                    </div>
                </form>
            </div>

            <div class="col-md-7">
                <h4>History</h4>
                <div class="table-responsive">

                    <table id="table" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>Foto Absensi</th>
                                <th>Foto Kegiatan 1</th>
                                <th>Foto Kegiatan 1</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
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
    });
    $(document).ready(function() {
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '<?= base_url('pembina/laporan_kegiatan/data') ?>',
            order: [],
            columns: [{
                    data: 'no',
                    orderable: false
                },
                {
                    data: 'tanggal'
                },
                {
                    data: 'foto_absensi'
                },
                {
                    data: 'foto_kegiatan1'
                },
                {
                    data: 'foto_kegiatan2'
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