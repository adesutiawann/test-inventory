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
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-exclamation"></i>
                <strong>Gagal !</strong>
                <?= session()->getFlashData('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif ?>
        <?php if (session()->getFlashData('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-check"></i>
                <strong>Berhasil !</strong>
                <?= session()->getFlashData('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif ?>
        <?php if (session()->getFlashData('warning')) : ?>

            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-triangle-exclamation mr-3"></i>
                <strong>Perhatian !</strong>
                <?= session()->getFlashData('warning') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif ?>

        <div class="table-responsive">
            <table id="tablex" class="table table-striped">
                <thead>
                    <tr>
                        <th>NO.</th>
                        <th>NIK</th>
                        <th>Username</th>
                        <th>Data</th>

                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $no = 1;
                    foreach ($user as $key => $value) :

                    ?>
                        <tr class="table-<?= ($value->level == '1') ? 'success ' : (($value->level == '2') ? 'warning' : 'danger') ?>">

                            <td><?= $no++ ?></td>
                            <td><b><?= $value->nik ?></b></td>

                            <td>
                                Username : <?= $value->username ?></b><br>
                                Password : <?= $value->password ?><br>
                                Level :

                                <?php
                                if ($value->level == 1) {
                                    echo $l = '<span class="badge bg-primary">Administrator</span>';
                                } else if ($value->level == 2) {
                                    echo $l = '<span class="badge bg-warning">Teknisi</span>';
                                } else {
                                    echo  $l = '<span class="badge bg-danger">Tamu</span>';
                                }
                                ?>
                            </td>

                            <td>
                                Nama : <b><?= $value->nama ?></b><br>
                                Telpon : <?= $value->whatsapp ?><br>

                                Created :

                                <span class="text-primary">
                                    <?= $value->tgl ?><br>
                                </span>
                            </td>



                            <td>
                                <a href="<?= base_url('admin/user/edit/' . $value->id) ?>" class="btn btn-sm btn-info text-white ">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="<?= base_url("admin/user/delete/{$value->id}") ?>" class="btn btn-sm btn-danger text-white" onclick="return confirm('Warning','Yakin ingin menghapus?')">
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