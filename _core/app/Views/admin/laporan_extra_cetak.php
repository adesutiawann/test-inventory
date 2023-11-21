<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Kegiatan Extra</title>
    <link id="theme-style" rel="stylesheet" href="<?= base_url() ?>/assets/css/portal.css">
    <style>
        .cetak {
            width: 20cm;
            height: 31cm;
            margin: 0 auto;
            border: 1px solid #eee;
        }
    </style>
</head>

<body onload="window.print()">

    <div class="cetak">
        <center>
            <h1>Laporan Kegiatan Extra</h1>
            <h3>SMK YP FATAHILLAH 2 CILEGON</h3>
        </center>
        <hr>
        <table>
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td><?= $laporan->tanggal ?></td>
            </tr>
            <tr>
                <td>Kegiatan Extra</td>
                <td>:</td>
                <td><?= $laporan->extra ?></td>
            </tr>
            <tr>
                <td>Nama Pembina</td>
                <td>:</td>
                <td><?= $laporan->nama ?></td>
            </tr>
        </table>
        <hr>
        <h3>Foto Absensi</h3>
        <img src="<?= base_url('uploads/kegiatan/' . $laporan->foto_absensi) ?>" alt="" height="300">
        <hr>
        <table width="100%">
            <tr valign="top">
                <td width="50%">
                    <h3>Foto Kegiatan 1</h3>
                    <img src="<?= base_url('uploads/kegiatan/' . $laporan->foto_kegiatan1) ?>" alt="" class="img-fluid">
                </td>
                <td width="50%">
                    <h3>Foto Kegiatan 2</h3>
                    <img src="<?= base_url('uploads/kegiatan/' . $laporan->foto_kegiatan2) ?>" alt="" class="img-fluid">
                </td>
            </tr>
        </table>


    </div>

</body>

</html>