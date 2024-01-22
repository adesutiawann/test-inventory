<?= $this->extend('admin/template') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="<?= base_url() ?>/assets/css/dataTables.bootstrap5.min.css">
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
<h2 class="app-page-title text-scondary fw-semibold"><?= $title ?></h2>
<hr>


<div class="app-card app-card-accordion shadow-sm mb-3" <?= ($admin->level == '3') ? 'hidden' : '' ?>>
    <div class="app-card-body p-3">

        <div class="row ">

            <div class="col-md-8 col-sm-8 col-xs-6  ">
                <a href="<?= base_url('admin/aset/add') ?>" class="btn app-btn-primary text-white ml-5 ">
                    <i class="fas fa-plus"></i> Tambah Asets
                </a>
                <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fa-solid fa-file-import"></i> Import
                </button>
            </div>


            <div class="col-md-4 col-sm-4 col-xs-6 text-end ">

                <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#qrcode">
                    <i class="fa-solid fa-qrcode"></i>
                </button>
                <a class="btn app-btn- bg-warning text-white xs-1" target="_blank" href="<?= base_url('admin/aset/cetakqrcode') ?>">
                    <i class="fa-solid fa-qrcode"></i>
                </a>

                <a class="btn app-btn- bg-danger text-white" target="_blank" href="<?= base_url('admin/aset/cetakpdf') ?>">
                    <i class="fa-solid fa-file-pdf"></i>

                </a>
                <a class="btn app-btn- bg-success text-white" href="<?= base_url('admin/aset/export') ?>">
                    <i class="fa-solid fa-file-excel"></i>
                </a>
            </div>
        </div>
    </div>
</div>



<nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm d-flex mb-1" role="tablist">
    <a class="flex-fill text-center nav-link <?= ($menu == 'ALL') ? 'active' : '' ?>" href="<?= base_url('admin/aset') ?>" aria-controls="orders-all" aria-selected="false">All <?= $total_pc ?></a>
    <a class="flex-fill text-center nav-link <?= ($menu == 'OK') ? 'active' : '' ?>" href="<?= base_url('admin/aset/search/OK') ?>" aria-controls="orders-paid" aria-selected="false">Oke <?= $total_pc_ok ?></a>
    <a class="flex-fill text-center nav-link <?= ($menu == 'RUSAK') ? 'active' : '' ?>" href="<?= base_url('admin/aset/search/RUSAK') ?>" role="tab" aria-controls="orders-pending" aria-selected="true">Rusak <?= $total_pc_rusak ?></a>
    <a class="flex-fill text-center nav-link <?= ($menu == 'BLANKS') ? 'active' : '' ?>" href="<?= base_url('admin/aset/search/BLANKS') ?>" role="tab" aria-controls="orders-cancelled" aria-selected="true">Blank <?= $total_pc_blanks ?></a>
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
                        <th>QRCODE</th>
                        <th>Serial</th>
                        <th>Manufacture</th>
                        <th>Spesifikasi</th>
                        <th>Status</th>
                        <th>Pengguna</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $no = 1;
                    foreach ($aset as $key => $value) :

                    ?>
                        <tr class="table-<?= ($value->kondisi == 'OK') ? 'success ' : (($value->kondisi == 'RUSAK') ? 'warning' : 'danger') ?>">
                            <td><?= $no++ ?></td>
                            <td>
                                <div class="imgBox">
                                    <img src="" width="40%" class="qrImage">
                                </div>
                                <div class="qrText">

                                </div>
                            </td>
                            <td><b><?= $value->serial ?></b><br>
                                In :
                                <span class="text-success">
                                    <?= $value->tgl_masuk ?><br>
                                </span>Out :
                                <span class="text-danger">
                                    <?= $value->tgl_keluar ?><br>
                                </span>
                            </td>

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
                                User :
                                <span>
                                    <?= $value->user ?> <br>
                                </span>Lokasi :
                                <span>
                                    <?= $value->lokasi ?><br>
                                </span>
                            </td>

                            <td>

                                <a href="<?= base_url('admin/aset/view/' . $value->id) ?>" <?= ($admin->level == '3') ? 'hidden' : '' ?> class="btn btn-sm btn-primary text-white mr-2">
                                    <i class="fa-solid fa-circle-info"></i>
                                </a>

                                <a href="<?= base_url('admin/aset/edit/' . $value->id) ?>" class="btn btn-sm btn-info text-white ">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                <a href="<?= base_url("admin/aset/delete/{$value->id}") ?>" class="btn btn-sm btn-danger text-white hapusDataBtn" data-id="<?php echo $value->serial; ?>">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>

                            </td>
                        </tr>

                    <?php endforeach ?>
                </tbody>
            </table>
            <script>
                // Move script outside of the loop
                let imgBoxes = document.querySelectorAll(".imgBox");
                let qrImages = document.querySelectorAll(".qrImage");

                let serials = <?php echo json_encode(array_column($aset, 'id')); ?>;

                function generateQR(text, imgBox, qrImage) {
                    if (text.length > 0) {
                        // Generate QR code for each row
                        let qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=https://inventiry.com/admin/aset/view/144/" + text;
                        qrImage.src = qrCodeUrl;
                        imgBox.classList.add("show-img");
                    } else {
                        // Handle error condition
                    }
                }

                // Loop through each row and generate QR codes
                for (let i = 0; i < serials.length; i++) {
                    generateQR(serials[i], imgBoxes[i], qrImages[i]);
                }
            </script>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-file-import"></i> Import </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row" action="<?= base_url('admin/aset/import') ?>" method="post" enctype="multipart/form-data">

                    <div class="col-md-11 col-sm-6 col-xs-10 mb-2">
                        <input type="file" class="form-control" name="file_excel" required>

                    </div>
                    <div class="col-md-1 col-sm-3 text-end mb-2 ">
                        <a href="<?= base_url('admin/aset/downloadExcel') ?>" class="text-info">
                            <i class="fa-solid fa-file-circle-question"></i>
                        </a>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary text-white"> <i class="fa-solid fa-file-import"></i> Import</button>

            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal cetak -->
<div class="modal fade" id="qrcode" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-magnifying-glass"></i> Search data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row" action="<?= base_url('admin/aset/cetakqrcode') ?>" method="post" enctype="multipart/form-data">

                    <div class="col-md-11 col-sm-6 col-xs-10 mb-2">
                        <input type="text" class="form-control" name="cari" required>

                    </div>
                    <div class="col-md-1 col-sm-3 text-end mb-2 ">

                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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




<?= $this->section('js') ?>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<script>
    // Menangani klik pada setiap tautan hapus data
    document.querySelectorAll('.hapusDataBtn').forEach(function(element) {
        element.addEventListener('click', function(event) {
            event.preventDefault(); // Menghentikan peristiwa default pengklikan tautan

            var dataId = element.getAttribute('data-id');
            var href = element.getAttribute('href');

            // Tampilkan SweetAlert konfirmasi
            Swal.fire({
                title: 'Anda yakin?',
                text: 'Data serial ' + dataId + ' akan dihapus permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna menekan tombol konfirmasi, navigasikan ke tautan penghapusan data
                    window.location.href = href;
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>