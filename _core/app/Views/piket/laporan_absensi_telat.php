<?= $this->extend('walikelas/template') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="app-page-title"><?= $title ?></h1>

<div class="app-card app-card-settings shadow-sm mb-4">
    <div class="app-card-body p-4">
        <form action="" method="GET">
            <div class="row">
                <div class="col-md-3">
                    <input type="date" name="tanggal" class="form-control" value="<?= date("Y-m-d") ?>" required>
                </div>
                <div class="col-md-3">
                    <input type="submit" class="btn btn-primary text-white" value="Proses">
                </div>
            </div>
        </form>
    </div>
</div>

<?php if (isset($_GET['tanggal'])) : ?>
    <div class="app-card app-card-settings shadow-sm mb-4">
        <div class="app-card-body p-4">

            <h4>Laporan Tanggal: <?= $_GET['tanggal'] ?></h4>
            <table class="table table-bordered table-striped" id="tblData">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($laporan as $lap) : ?>

                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $lap->nama ?></td>
                            <td><?= $lap->kelas ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <button class="btn btn-primary" onclick="exportTableToExcel('tblData')">Export Table Data To Excel File</button>
        </div>
    </div>
<?php endif ?>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    function exportTableToExcel(tableID, filename = '') {
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = document.getElementById(tableID);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

        // Specify file name
        filename = filename ? filename + '.xls' : 'excel_data.xls';

        // Create download link element
        downloadLink = document.createElement("a");

        document.body.appendChild(downloadLink);

        if (navigator.msSaveOrOpenBlob) {
            var blob = new Blob(['\ufeff', tableHTML], {
                type: dataType
            });
            navigator.msSaveOrOpenBlob(blob, filename);
        } else {
            // Create a link to the file
            downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

            // Setting the file name
            downloadLink.download = filename;

            //triggering the function
            downloadLink.click();
        }
    }

    $(document).ready(function() {
        $('.select').select2();
    });
</script>
<?= $this->endSection() ?>