<?= $this->extend('admin/template') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
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

        <form action="<?= base_url('admin/prosesor/save') ?>" method="POST">

            <div class="row">
                <div class="col-md-3">
                    <strong>Edit Nama :</strong>
                </div>
                <div class="col-md-4">
                         <input type="" hidden name="id" value="<?=$prosesor->id ?>">
                         <input type="text" value="<?=$prosesor->nama?>" name="nama" class="form-control"  required>
                </div>
              
                <div class="col-md-2 ">
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
                        <th>TANGGAL</th>
                        <th>ACTION</th>
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

<script>
    $(document).ready(function() {
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '<?= base_url('admin/prosesor/data') ?>',
            order: [],
            columns: [{
                    data: 'no',
                    orderable: false
                },
                {
                    data: 'nama'
                },
                {
                    data: 'tgl'
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