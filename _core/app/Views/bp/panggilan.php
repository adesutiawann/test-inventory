<?= $this->extend('walikelas/template') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="app-page-title"><?= $title ?></h1>

<div class="app-card app-card-accordion shadow-sm mb-4">
    <div class="app-card-header p-3 border-0">
        <h4 class="app-card-title">Kirim Surat Panggilan</h4>
    </div>
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
                <form action="<?= base_url('bp/panggilan/panggilan') ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label for="">Siswa</label>
                        <select name="siswa" class="form-select select">
                            <?php foreach ($siswa as $s) : ?>
                                <option value="<?= $s->id ?>"><?= $s->nama ?> &bull; <?= $s->kelas ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">File Surat PDF</label>
                        <input type="file" name="file" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary text-white my-2" value="Proses">
                    </div>
                </form>
            </div>
            <div class="col-md-7">
                <div class="table-responsive">
                    <table id="table" class="table table-striped" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Siswa</th>
                                <th>File Surat</th>
                                <th>TP/SMS</th>
                                <th>Jenis</th>
                                <!-- <th>Aksi</th> -->
                            </tr>
                        </thead>
                        <tbody></tbody>
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
            ajax: '<?= base_url('bp/panggilan/data') ?>',
            order: [],
            columns: [{
                    data: 'no',
                    orderable: false
                },
                {
                    data: 'nama'
                },
                {
                    data: 'file'
                },
                {
                    data: 'tp'
                },
                {
                    data: 'jenis'
                },
                // {
                //     data: 'action',
                //     orderable: false
                // },
            ]
        });
    });
</script>
<?= $this->endSection() ?>