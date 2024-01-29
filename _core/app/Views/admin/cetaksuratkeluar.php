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



    //$con = new mysqli("localhost", "root", "", "db_inventory") or die(mysqli_error($con));
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
                    <h3 class="mt-3"><?= $title ?></h3>
                </div>
                <div class="col-12 ml-4  MT-3 mb-4">



                </div>


                <div class="col-12 ml-4  MT-3">

                    <table id="tabel" class="table table-striped">
                        <thead>
                            <tr>
                                <th>NO.</th>
                                <th>NOMOR</th>
                                <th>Barang</th>
                                <th>Penerima</th>
                                <th>Keterangan</th>
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

                <div class="col-12 ml-4  MT-3">

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