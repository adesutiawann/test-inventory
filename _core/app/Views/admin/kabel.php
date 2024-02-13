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
                <i class="fa-solid fa-circle-check"></i>
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
                <a href="<?= base_url('admin/printer/add') ?>" class="btn app-btn-primary text-white w-50">
                    <i class="fas fa-plus"></i> Tambah Asets
                </a>
            </div>

            <div class="col-md-6 col-sm-2 col-xs-2 ">
                <form class="row" action="<?= base_url('admin/printer/import') ?>" method="post" enctype="multipart/form-data">
                    <div class="col-md-3 col-sm-3 text-end mb-2 ">
                        <a href="<?= base_url('admin/printer/downloadExcel') ?>" class="text-info">
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
                <a class="btn app-btn- bg-success text-white w-100" href="<?= base_url('admin/printer/export') ?>">
                    <i class="fa-solid fa-file-excel"></i>
                    Export Excel
                </a>
            </div>
        </div>
    </div>
</div>



<nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm d-flex mb-1" role="tablist">
    <a class="flex-fill text-center nav-link <?= ($menu == 'ALL') ? 'active' : '' ?>" href="<?= base_url('admin/printer') ?>" aria-controls="orders-all" aria-selected="false">All <?= $total_mo ?></a>
    <a class="flex-fill text-center nav-link <?= ($menu == 'OK') ? 'active' : '' ?>" href="<?= base_url('admin/printer/search/OK') ?>" aria-controls="orders-paid" aria-selected="false">Oke <?= $total_mo_ok ?></a>
    <a class="flex-fill text-center nav-link <?= ($menu == 'RUSAK') ? 'active' : '' ?>" href="<?= base_url('admin/printer/search/RUSAK') ?>" role="tab" aria-controls="orders-pending" aria-selected="true">Rusak <?= $total_mo_rusak ?></a>
    <a class="flex-fill text-center nav-link <?= ($menu == 'BLANKS') ? 'active' : '' ?>" href="<?= base_url('admin/printer/search/BLANKS') ?>" role="tab" aria-controls="orders-cancelled" aria-selected="true">Blank <?= $total_mo_blanks ?></a>
</nav>



<div class="app-card app-card-accordion shadow-sm mb-4">

    <div class="app-card-body p-4">

        <div class="table-responsive">
            <? //= print_r($aset) 
            ?>
            <table id="tabel1" class="table responsive-table">
                <thead>
                    <tr>
                        <th>NO.</th>
                        <th>Type</th>

                        <th>Jumlah</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $no = 1;
                    foreach ($kabel as $key => $value) :

                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value->type ?></td>
                            <td>
                                <a href="<?= base_url('admin/kabel/minus/' . $value->id) ?>">
                                    <i class="fa-solid fa-circle-minus text-danger"></i>
                                </a>
                                <?= $value->jumlah ?>
                                <a href="<?= base_url('admin/kabel/plus/' . $value->id) ?>">
                                    <i class="fa-solid fa-circle-plus text-success"></i>
                                </a>

                            </td>



                            <td>
                                <button type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#staticBackdrop"">
                                    <i class=" fa-solid fa-pen-to-square"></i>
                                </button>
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
            </table>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
<!-- your_view.php -->
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text bg-danger" onclick="decrementValue()">
                        <i class="fas fa-minus text-white"></i>
                    </span>
                    <input id="quantity" type="text" class="form-control text-center" value="145" aria-label="Amount (to the nearest dollar)">
                    <span class="input-group-text bg-success" onclick="incrementValue()">
                        <i class="fas fa-plus text-white"></i>
                    </span>
                </div>

                <script>
                    function incrementValue() {
                        var input = document.getElementById('quantity');
                        var value = parseInt(input.value, 10);
                        value = isNaN(value) ? 0 : value;
                        value++;
                        input.value = value;
                    }

                    function decrementValue() {
                        var input = document.getElementById('quantity');
                        var value = parseInt(input.value, 10);
                        value = isNaN(value) ? 0 : value;
                        value--;
                        if (value < 0) {
                            value = 0; // Ensure the value doesn't go below zero
                        }
                        input.value = value;
                    }
                </script>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Tambahkan jQuery jika belum ada -->

<!-- Tambahkan elemen anchor (link) -->


<!-- Tambahkan skrip JavaScript -->


<?= $this->endSection() ?>




<?= $this->section('js') ?>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<?= $this->endSection() ?>