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
                <div class="col-12 ml-4 text-center mb-3 mt-3">
                    <h5 class="mt-3">Printer QRcode</h5>
                </div>
                <div class="row">
                    <?php
                    $no = 1;
                    foreach ($aset as $key => $value) :

                    ?>
                        <div class="col-4">
                            <div class="col-12 ml-4  MT-3">
                                <div class="card mb-3" style="max-width: 540px;">
                                    <div class="row g-0 m-3">

                                        <div class="col-md-4 mt-3">
                                            <div class="imgBox">
                                                <img src="" width="100%" class="qrImage  img-fluid rounded-start">

                                            </div>

                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">Krakatau-IT</h5>
                                                <p class="card-text">
                                                    <?= $value->manufacture ?><br>
                                                    <b> SN : <?= $value->serial ?> </b><br>
                                                    <small class="text-body-secondary">Tgl Masuk <?= $value->tgl_masuk ?></small>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>

                    <script>
                        // Move script outside of the loop
                        let imgBoxes = document.querySelectorAll(".imgBox");
                        let qrImages = document.querySelectorAll(".qrImage");

                        let serials = <?php echo json_encode(array_column($aset, 'serial')); ?>;

                        function generateQR(text, imgBox, qrImage) {
                            if (text.length > 0) {
                                // Generate QR code for each row
                                let qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?= base_url() ?>/admin/aset/view/" + text;
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


    <!-- Charts JS -->
    <!-- <script src="<?= base_url() ?>/assets/plugins/chart.js/chart.min.js"></script> -->
    <!-- <script src="<?= base_url() ?>/assets/js/index-charts.js"></script> -->

    <!-- Page Specific JS -->
    <script src="<?= base_url() ?>/assets/js/app.js"></script>

    <?= $this->renderSection('js') ?>

</body>

</html>