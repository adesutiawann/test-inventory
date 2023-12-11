<?= $this->extend('admin/template') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php

use PhpParser\Node\Expr\Print_;

$menu = $aktiv;
// $submenu = $segment[2];
?>
<style>
    /* Contoh CSS untuk menentukan lebar dan tinggi textarea */
    textarea {
        width: 300px;
        /* Lebar textarea */
        height: 100px;
        /* Tinggi textarea */
    }
</style>
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

        <div class="row ">
            <div class="col-6 ml-4">
                <a href="<?= base_url('admin/mouse/add') ?>" class="btn app-btn-primary mb-3 text-white"><i class="fas fa-plus"></i> Tambah Asets</a>

            </div>
            <div class="col-3">
                <form class="row g-3 ">

                    <div class="col">
                        <input type="file" class="form-control" id="inputPassword2" placeholder="Password">
                    </div>
                    <div class="col "> <button type="submit" class="btn app-btn-secondary"><i class="fa-solid fa-arrow-up-from-bracket"></i> Upload</button>
                    </div>
                </form>
            </div>


            <div class="col-3">
                <a class="btn app-btn-secondary" href="#">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"></path>
                        <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"></path>
                    </svg>
                    Download CSV
                </a>
            </div>
        </div>
    </div>
</div>



<nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-1" role="tablist">

    <a class="flex-sm-fill text-sm-center nav-link <?= ($menu == 'ALL') ? 'active' : '' ?>" href="<?= base_url('admin/aset') ?>" aria-controls="orders-all" aria-selected="false">All</a>
    <a class="flex-sm-fill text-sm-center nav-link <?= ($menu == 'OK') ? 'active' : '' ?>" href="<?= base_url('admin/aset/ok/OK') ?>" aria-controls="orders-paid" aria-selected="false">Oke</a>
    <a class="flex-sm-fill text-sm-center nav-link <?= ($menu == 'RUSAK') ? 'active' : '' ?>" href="<?= base_url('admin/aset/ok/RUSAK') ?>" role="tab" aria-controls="orders-pending" aria-selected="true">Rusak</a>
    <a class="flex-sm-fill text-sm-center nav-link <?= ($menu == 'BLANKS') ? 'active' : '' ?>" href="<?= base_url('admin/aset/ok/BLANKS') ?>" role="tab" aria-controls="orders-cancelled" aria-selected="true" tabindex="-1">Blank</a>
</nav>

<div class="app-card app-card-accordion shadow-sm mb-4">

    <div class="app-card-body p-4">

        <div class="table-responsive">
            <? //= print_r($aset)
            ?>
            <table id="tabel1" class="table table-striped">
                <thead>
                    <tr>
                        <th>NO.</th>
                        <th>Serial</th>
                        <th>Manufacture</th>

                        <th>Status</th>
                        <th>Tanggal</th>

                        <th>Keterangan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $no = 1;
                    foreach ($aset as $key => $value) :

                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><b><?= $value->serial ?></b></td>
                            <td>
                                <b> <?= $value->manufacture ?></b><br>
                                Type : <?= $value->type ?>
                            </td>

                            <td>
                                Status :<?= $value->status ?><br>
                                Stock :<?= $value->stok ?><br>
                                Kondisi:
                                <span class="badge bg-<?= ($value->kondisi == 'OK') ? 'success' : (($value->kondisi == 'RUSAK') ? 'warning' : 'danger') ?>">
                                    <?= $value->kondisi ?>
                                </span>
                            </td>

                            <td>
                                In :
                                <span class="text-success">
                                    <?= $value->tgl_masuk ?><br>
                                </span>Out :
                                <span class="text-danger">
                                    <?= $value->tgl_keluar ?><br>
                                </span>
                            </td>
                            <td>
                                <span class="">
                                    <?= $value->ket ?><br>
                                </span>
                            </td>
                            <td>
                                <a href="<?= base_url('admin/mouse/edit/' . $value->id) ?>" class="btn btn-sm btn-info text-white mt-2 mr-2">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="<?= base_url("admin/mouse/delete/{$value->id}") ?>" class="btn btn-sm btn-danger text-white" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>


                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
<!-- your_view.php -->

<!-- Tambahkan jQuery jika belum ada -->

<!-- Tambahkan elemen anchor (link) -->


<!-- Tambahkan skrip JavaScript -->


<?= $this->endSection() ?>




<?= $this->section('js') ?>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<script>
    //$(document).ready(function() {

    $(document).ready(function() {
        try {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '<?= base_url('admin/aset/data') ?>',
                order: [],
                columns: [{
                        data: 'no',
                        orderable: false
                    },
                    {
                        data: 'serial'

                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            // Assuming 'tgl_masuk' and 'tgl_keluar' are Date objects or date strings
                            return '<b>' + row.manufacture +
                                '</b> <br> type  :' + row.type;
                        }
                    }, {
                        data: null,
                        render: function(data, type, row) {
                            // Assuming 'tgl_masuk' and 'tgl_keluar' are Date objects or date strings
                            return 'Prosesor  :' + row.prosesor +
                                ' <br> Generasi  :' + row.generasi +
                                ' <br> Hdd/SSD   :' + row.hdd +
                                ' <br> Ram       :' + row.ram +
                                ' GB<br> Rincian    :' + row.prosesor;
                        }
                    }, {
                        data: null,
                        render: function(data, type, row) {
                            var bgClass = row.kondisi === 'OK' ? 'success' :
                                row.kondisi === 'RUSAK' ? 'danger' :
                                row.kondisi === 'BLANKS' ? 'warning' : '';

                            // Assuming 'tgl_masuk' and 'tgl_keluar' are Date objects or date strings
                            return 'Status  :' + row.status + '<br> Stock  :' + row.stok +
                                ' <br> Stok  : <span class="badge bg-' + bgClass + '">' + row.kondisi + '</span>';
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            // Assuming 'tgl_masuk' and 'tgl_keluar' are Date objects or date strings
                            return 'In :' + row.tgl_masuk + ' <br>Out  :' + row.tgl_keluar;
                        }
                    },
                    {
                        data: 'ket'

                    },
                    {
                        data: 'action',
                        orderable: false
                    },
                ]
            });

        } catch (error) {
            console.error('DataTables initialization error:', error);
        }
    });
</script>
<?= $this->endSection() ?>