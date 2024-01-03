<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $title ?></title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Aplikasi Inventory">
    <meta name="author" content="DukunWeb">
    <link rel="shortcut icon" href="<?= base_url() ?>/logoks.png">

    <!-- FontAwesome JS-->
    <script defer src="<?= base_url() ?>/assets/plugins/fontawesome/js/all.min.js"></script>


    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="<?= base_url() ?>/assets/css/portal.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <?= $this->renderSection('css') ?>
    <!-- App DATA TABEL -->
    <style>
        /* Menambahkan warna hitam pada border tabel */
        .table-bordered thead,
        .table-bordered td,
        .table-bordered tr,
        .table-bordered th {
            border-color: #000;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
</head>

<body class="app p-2">
    <script>
        // Mengeksekusi fungsi pencetakan otomatis setelah halaman dimuat
        window.onload = function() {
            // Mengeksekusi fungsi pencetakan
            printDocument();
        };

        // Fungsi pencetakan
        function printDocument() {
            // Membuka jendela pencetakan
            window.print();
        }
    </script>

    <?php

    use App\Controllers\Admin\Manufacture;
    use PhpParser\Node\Expr\Print_;



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
    <h1 class="app-page-title"></h1>

    <div class="app-card app-card-accordion s mb-4 rounded-5  " onclick="print()">
        <div class="app-card-body p-3">

            <div class="row ">
                <div class="col-12 ml-4 text-center">
                    <img class="logo-icon me-2" width="50%" src="<?= base_url() ?>/assets/images/logofull.png" alt="logo">

                </div>
                <div class="col-12 ml-4 text-center mb-3 mt-3">
                    <h5 class="mt-3">MEMO DINAS</h5>
                    <h5 class="">Nomor : 001/PRX-MSI/KITEC/XI/2024 </h5>
                </div>
                <div class="col-12 ml-4  MT-3 mb-4">


                    <h6> Kepada : Pos Keamanan PT. Krakatu IT <br>
                        Dari : Leader Workshop <br>
                        Perihal : Ijin Keluar/Masuk Barang<br>
                        Tanggal : <?= date("d F Y") ?></h6>

                </div>


                <div class="col-12 ml-4  MT-3">
                    <h6>Mohon bantuan ijin keluar barang berupa :</h6>

                    <table class="table table-bordered  ">

                        <thead>
                            <tr>
                                <td scope="col "><strong>No </strong></td>
                                <td scope="col "><strong>Nama Barang</strong></td>
                                <td scope="col "><strong>Jumlah</strong></td>
                                <td scope="col "><strong>Satuan</strong></td>
                                <td scope="col "><b>Keterangan</b></td>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $no = 1;
                            foreach ($aset as $key => $value) :

                            ?>
                                <tr>
                                    <th scope="row"><?= $no++ ?></th>
                                    <td><?= $value->type . ' ' . $value->manufacture . ' ' . $value->generasi . ' SN : <b>' . $value->serial ?></b></td>
                                    <td>Satuan </td>
                                    <td>Untit</td>
                                    <td><?= $value->ket ?></td>
                                </tr>
                            <?php
                            endforeach ?>
                        </tbody>

                    </table>
                </div>

                <div class="col-12 ml-4  MT-3">
                    <table class="table table-bordered">

                        <thead>
                            <tr>
                                <td scope="col"><b>No</b></td>
                                <td scope="col"><b>Nama Penerima</b></td>
                                <td scope="col"><b>NIK</b></td>
                                <td scope="col"><b>Unit Kerja/ Lokasi </b></td>
                                <td scope="col"><b>Telpon</b></td>
                                <td scope="col"><b>Tanda tangan</b> </td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($suratkeluar as $key => $value) :

                            ?>
                                <tr>
                                    <th scope="row">1</th>
                                    <td> <?= $value->penerima ?></td>
                                    <td> <?= $value->nik ?></td>
                                    <td> <?= $value->lokasi ?></td>
                                    <td> <?= $value->telpon ?></td>
                                    <td></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>

                    </table>
                    <h6>Demikian yang dapat disampaikan terima kasih.</h6>

                </div>

                <div class="col-12 ml-4 text-end mt-4 mb-4">
                    <h6 class="mb-3"> Manage Service 1 </h6>
                    <br>

                    <h6 class="mt-3"> Harris Permana </h6>
                    <h6> Leader Workshop</h6>
                </div>
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



    <!-- Javascript -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/popper.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            {
                $('#tabel1').DataTable()
            }

        })
    </script>

    <script>
        function convertToUppercase(input) {
            input.value = input.value.toUpperCase();
        }
    </script>
    <script>
        document.getElementById('capitalizeInput').addEventListener('input', function() {
            this.value = this.value.replace(/\b\w/g, function(match) {
                return match.toUpperCase();
            });
        });
    </script>
    <script>
        document.getElementById('sentenceCaseInput').addEventListener('input', function() {
            this.value = this.value.replace(/(^|\.\s+|\!\s+|\?\s+)([a-z])/g, function(match) {
                return match.toUpperCase();
            });
        });
    </script>


    <!-- Charts JS -->
    <!-- <script src="<?= base_url() ?>/assets/plugins/chart.js/chart.min.js"></script> -->
    <!-- <script src="<?= base_url() ?>/assets/js/index-charts.js"></script> -->

    <!-- Page Specific JS -->
    <script src="<?= base_url() ?>/assets/js/app.js"></script>

    <?= $this->renderSection('js') ?>

</body>

</html>