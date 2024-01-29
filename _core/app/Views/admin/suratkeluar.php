<?= $this->extend('admin/template') ?>



<?= $this->section('content') ?>
<?php

use PhpParser\Node\Expr\Print_;

$menu = $aktiv;

$con = new mysqli("localhost", "root", "", "db_inventory") or die(mysqli_error($con));
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


<div class="app-card app-card-accordion shadow-sm mb-3" <?= ($admin->level == '3') ? 'hidden' : '' ?>>
    <div class="app-card-body p-3">

        <div class="row ">

            <div class="col-md-8 col-sm-8 col-xs-6  <?= ($admin->level == '3') ? 'hidden' : '' ?> ">
                <a href="<?= base_url('admin/suratkeluar/add') ?>" class="btn app-btn-primary text-white ml-5 ">
                    <i class="fas fa-plus"></i> Surat Baru
                </a>

            </div>


            <div class="col-md-4 col-sm-4 col-xs-6 text-end ">

                <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#pdf">
                    <i class="fa-solid fa-file-pdf"></i>
                </button>

                <button type="button" class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#excel">
                    <i class="fa-solid fa-file-excel"></i>
                </button>


            </div>
        </div>
    </div>
</div>


<nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-1" role="tablist">

    <a class="flex-sm-fill text-sm-center nav-link <?= ($menu == 'ALL') ? 'active' : '' ?>" href="<?= base_url('admin/suratkeluar') ?>" aria-controls="orders-all" aria-selected="false"><?= $suratkeluarttl ?> All</a>
    <a class="flex-sm-fill text-sm-center nav-link <?= ($menu == 'Terdistribusi') ? 'active' : '' ?>" href="<?= base_url('admin/suratkeluar/search/Terdistribusi') ?>" aria-controls="orders-paid" aria-selected="false"><?= $suratkeluardis ?> Terdistribusi</a>
    <a class="flex-sm-fill text-sm-center nav-link <?= ($menu == 'Backup') ? 'active' : '' ?>" href="<?= base_url('admin/suratkeluar/search/Backup') ?>" role="tab" aria-controls="orders-pending" aria-selected="true"><?= $suratkeluarbac ?> Backup</a>
</nav>

<div class="app-card app-card-accordion shadow-sm mb-4">

    <div class="app-card-body p-4">

        <div class="table-responsive">
            <?php // print_r($suratkeluar)
            ?>
            <table id="tabel1" class="table table-striped">
                <thead>
                    <tr>
                        <th>NO.</th>
                        <th>NOMOR</th>
                        <th>Barang</th>
                        <th>Penerima</th>
                        <th>Keterangan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $no = 1;
                    foreach ($suratkeluar as $key => $value) :

                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><b><?= $id = $value->nomor ?></b><br>
                                Tanggal : <span class="text-danger">
                                    <?= $value->tgl ?>
                            </td>
                            <td>
                                <?php $non = 1; ?>
                                <?php foreach ($value->aset as $g) : ?>
                                    <?= esc($non++) . '. ' . esc($g->type) . '-<b>' . esc($g->serial) . '</b><br>'; ?>
                                <?php endforeach; ?>
                            </td>

                            <td>
                                NIK : <?= $value->nik ?> <br>
                                Penerima : <?= $value->penerima ?> <br>
                                Telpon : <?= $value->telpon ?><br>
                                Lokasi : <?= $value->lokasi ?>

                            </td>
                            <td>

                                Status : <b>
                                    <?= $value->status ?>
                                </b><br>
                                Ket : <?= $value->ket ?>

                                </span>
                            </td>



                            <td width="15%">
                                <a href="<?= base_url('admin/suratkeluar/print?id=' . urlencode($value->id) . '&nomor=' . urlencode($value->nomor)) ?>" target="_blank" class="btn btn-sm btn-primary text-white mr-2">
                                    <i class="fa-solid fa-print"></i>
                                </a>


                                <a href="<?= base_url('admin/suratkeluar/sk_edit/' . $value->id) ?>" class="btn btn-sm btn-info text-white  mr-2">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="<?= base_url('admin/suratkeluar/delete_sk/' . $value->id) ?>" class="btn btn-sm btn-danger text-white" onclick="return confirm('Yakin ingin menghapus?')">
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

<!-- Modal cetak pdf -->
<div class="modal fade" id="pdf" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content mt-15">
            <div class="modal-header bg-danger ">
                <h1 class="modal-title fs-5 text-white" id="exampleModalLabel"><i class="fa-solid fa-arrow-down-short-wide"></i> Filter Data Pdf</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row" action="<?= base_url('admin/suratkeluar/cetaksuratkeluar') ?>" target="_blank" method="post" enctype="multipart/form-data">

                    <div class="col-md-12 col-sm-12 col-xs-10 mb-2">
                        Filter
                        <input type="text" class="form-control" name="cari" placeholder="Serial or Manufacture" id="textInput1">

                    </div>

                    <div class="col-md-12 col-sm-12 mb-2 ">
                        Dari Tanggal
                        <input type="date" class="form-control" name="tglin" id="dateInput1">
                    </div>
                    <div class="col-md-12 col-sm-12 mb-2 ">
                        Sampai Tanggal
                        <input type="date" class="form-control" name="tglout" id="dateInput1">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="refreshInput1()"><i class="fa-solid fa-arrows-rotate"></i></button>
                <button type="submit" target="_blank" class="btn btn-primary text-white"><i class="fa-solid fa-print"></i> Print</button>

            </div>
            </form>
        </div>
    </div>
</div>
<!-- your_view.php -->

<!-- Tambahkan jQuery jika belum ada -->

<!-- Tambahkan elemen anchor (link) -->


<!-- Tambahkan skrip JavaScript -->


<?= $this->endSection() ?>