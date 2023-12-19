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
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-exclamation"></i>
                <?= session()->getFlashData('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif ?>
        <?php if (session()->getFlashData('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-check mr-5"></i>
                <?= session()->getFlashData('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif ?>
        <?php if (session()->getFlashData('warning')) : ?>

            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-triangle-exclamation mr-3"></i>
                <?= session()->getFlashData('warning') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif ?>

        <div class="row ">

            <div class="col-md-4 col-sm-6 col-xs-12 mb-3 ">
                <a href="<?= base_url('admin/laptop/add') ?>" class="btn app-btn-primary text-white w-50">
                    <i class="fas fa-plus"></i> Tambah laptops
                </a>
            </div>

            <div class="col-md-6 col-sm-2 col-xs-2 ">
                <form class="row" action="<?= base_url('admin/laptop/import') ?>" method="post" enctype="multipart/form-data">
                    <div class="col-md-3 col-sm-3 text-end mb-2 ">
                        <a href="<?= base_url('admin/laptop/downloadExcel') ?>" class="text-info">
                            <i class="fa-solid fa-file-circle-question"></i>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-10 mb-2">
                        <input type="file" class="form-control" name="file_excel" required>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-2 mb-3">
                        <button type="submit" class="btn app-btn-secondary ">
                            <i class="fa-solid fa-file-import"></i> Import</button>
                    </div>
                </form>
            </div>
            <div class="col-md-2 col-sm-6 col-xs-1 ">
                <a class="btn app-btn- bg-success text-white w-100" href="<?= base_url('admin/laptop/export') ?>">
                    <i class="fa-solid fa-file-excel"></i>
                    Export Excel
                </a>
            </div>
        </div>
    </div>
</div>



<nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm d-flex mb-1" role="tablist">
    <a class="flex-fill text-center nav-link <?= ($menu == 'ALL') ? 'active' : '' ?>" href="<?= base_url('admin/laptop') ?>" aria-controls="orders-all" aria-selected="false">All <?= $total_laptop ?></a>
    <a class="flex-fill text-center nav-link <?= ($menu == 'OK') ? 'active' : '' ?>" href="<?= base_url('admin/laptop/search/OK') ?>" aria-controls="orders-paid" aria-selected="false">Oke <?= $total_laptop_ok ?></a>
    <a class="flex-fill text-center nav-link <?= ($menu == 'RUSAK') ? 'active' : '' ?>" href="<?= base_url('admin/laptop/search/RUSAK') ?>" role="tab" aria-controls="orders-pending" aria-selected="true">Rusak <?= $total_laptop_rusak ?></a>
    <a class="flex-fill text-center nav-link <?= ($menu == 'BLANKS') ? 'active' : '' ?>" href="<?= base_url('admin/laptop/search/BLANKS') ?>" role="tab" aria-controls="orders-cancelled" aria-selected="true">Blank <?= $total_laptop_blanks ?></a>
</nav>



<div class="app-card app-card-accordion shadow-sm mb-4">

    <div class="app-card-body p-4">

        <div class="table-responsive">
            <? //= print_r($laptop) 
            ?>
            <table id="tabel1" class="table responsive-table">
                <thead>
                    <tr>
                        <th>NO.</th>
                        <th>Serial</th>
                        <th>Manufacture</th>
                        <th>Spesifikasi</th>

                        <th>Status</th>
                        <th>Tanggal</th>

                        <th>Keterangan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $no = 1;
                    foreach ($laptop as $key => $value) :

                    ?>
                        <tr class="table-<?= ($value->kondisi == 'OK') ? 'success ' : (($value->kondisi == 'RUSAK') ? 'warning' : 'danger') ?>">
                            <td><?= $no++ ?></td>
                            <td><b><?= $value->serial ?></b></td>
                            <td>
                                <b> <?= $value->manufacture ?></b><br>
                                Type : <?= $value->type ?>
                            </td>
                            <td>
                                Prosesor : <?= $value->prosesor ?> <br>
                                Generasi : <?= $value->generasi ?> <br>
                                Hdd/SSD : <?= $value->hdd ?><br>
                                Ram :<?= $value->ram ?>/<?= $value->rincian ?><br>
                            </td>
                            <td>
                                Status :<?= $value->status ?><br>
                                Stock :<?= $value->stock ?><br>
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
                                <a href="<?= base_url('admin/laptop/edit/' . $value->id) ?>" class="btn btn-sm btn-info text-white ">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="<?= base_url("admin/laptop/delete/{$value->id}") ?>" class="btn btn-sm btn-danger text-white" onclick="return confirm('Yakin ingin menghapus?')">
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
                ajax: '<?= base_url('admin/laptop/data') ?>',
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