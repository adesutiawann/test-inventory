<?= $this->extend('admin/template') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="app-page-title"><?= $title ?></h1>

<div class="app-card app-card-accordion shadow-sm mb-4">
    <div class="app-card-body p-4">
        <a href="<?= base_url('admin/user/add') ?>" class="btn btn-primary mb-3 text-white">
            <i class="fas fa-plus"></i> Tambah Baru</a>

        <?php if (session()->getFlashData('error')) : ?>
            <div class="alert alert-danger bd-callout bd-callout-info">
                <?= session()->getFlashData('error') ?>
            </div>
        <?php endif ?>
        <?php if (session()->getFlashData('success')) : ?>
            <div class="alert alert-success bd-callout bd-callout-info">
                <?= session()->getFlashData('success') ?>
            </div>
        <?php endif ?>

        <div class="table-responsive">
            <table id="tablex" class="table table-striped">
                <thead>
                    <tr>
                        <th>NO.</th>
                        <th>NIK</th>
                        <th>USERS</th>
                        <th>NO. WHATSAPP</th>
                        <th>nama</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $no = 1;
                    foreach ($user as $key => $value) :

                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><b><?= $value->nik ?></b></td>
                            <td>
                                Username :<?= $value->username ?></b><br>
                                Password :<?= $value->password ?>

                            </td>

                            <td>
                                Status :<?= $value->nama ?><br>
                                Stock :<?= $value->whatsapp ?><br>
                                nama:
                                <span class="badge bg-<?= ($value->nama == '1') ? 'success' : (($value->nama == '2') ? 'warning' : 'danger') ?>">
                                    <?= $value->nama ?>
                                </span>
                            </td>

                            <td>
                                In :
                                <span class="text-success">
                                    <?= $value->nama ?><br>
                                </span>Out :
                                <span class="text-danger">
                                    <?= $value->nama ?><br>
                                </span>
                            </td>

                            <td>
                                <a href="<?= base_url('admin/printer/edit/' . $value->id) ?>" class="btn btn-sm btn-info text-white ">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="<?= base_url("admin/printer/delete/{$value->id}") ?>" class="btn btn-sm btn-danger text-white" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>


                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
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
            ajax: '<?= base_url('admin/user/data') ?>',
            order: [],
            columns: [{
                    data: 'no',
                    orderable: false
                },
                {
                    data: 'username'
                },
                {
                    data: 'nama'
                },
                {
                    data: 'whatsapp'
                },
                {
                    data: 'nama'
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