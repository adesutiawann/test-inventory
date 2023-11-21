<?= $this->extend('admin/template') ?>

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

        <form action="<?= base_url('admin/pembina/save') ?>" method="POST">
            <div class="row">
                <div class="col-md-3">
                    <strong>Tambahkan data Pembina:</strong>
                </div>
                <div class="col-md-4">
                    <select name="guru" class="form-select">
                        <?php foreach ($guru as $gr) : ?>
                            <option value="<?= $gr->id ?>"><?= $gr->nama ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="extra[]" multiple class="form-select select">
                        <option value="OSIS">OSIS</option>
                        <option value="DEWAN PENEGAK">DEWAN PENEGAK</option>
                        <option value="IPNU/IPPNU">IPNU/IPPNU</option>
                        <option value="JURNALISTIK">JURNALISTIK</option>
                        <option value="PASKIBRAKA">PASKIBRAKA</option>
                        <option value="TEATER">TEATER</option>
                        <option value="KEPRAMUKAAN">KEPRAMUKAAN</option>
                        <option value="FUTSAL PUTRA">FUTSAL PUTRA</option>
                        <option value="FUTSAL PUTRI">FUTSAL PUTRI</option>
                        <option value="BOLA VOLI PUTRA">BOLA VOLI PUTRA</option>
                        <option value="BOLA VOLI PUTRI">BOLA VOLI PUTRI</option>
                        <option value="SENI BAND">SENI BAND</option>
                        <option value="SENI BANJARI">SENI BANJARI</option>
                        <option value="SENI BATIK">SENI BATIK</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="submit" class="btn btn-primary text-white" value="Tambah">
                </div>
            </div>
        </form>
    </div>
</div>

<div class="app-card app-card-accordion shadow-sm mb-4">
    <div class="app-card-body p-4">
        <div class="table-responsive">
            <table id="table" class="table table-striped">
                <thead>
                    <tr>
                        <th>NO.</th>
                        <th>NAMA</th>
                        <th>PEMBINA</th>
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
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '<?= base_url('admin/pembina/data') ?>',
            order: [],
            columns: [{
                    data: 'no',
                    orderable: false
                },
                {
                    data: 'nama'
                },
                {
                    data: 'extra'
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