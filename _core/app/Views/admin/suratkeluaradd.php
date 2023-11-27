<?= $this->extend('admin/template') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
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

        <form action="<?= base_url('admin/suratkeluar/save') ?>" method="POST">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="row g-3">

                        <div class="col-sm-2 text-right">
                            <p class="text-end fw-bold"> Nomor :</p>

                        </div>
                        <div class="col-lg-8">

                            <input type="text" name="id_sk" class="form-control text-center" required value="001/PRY-MSI/KITECH/XI/2023">
                        </div>
                        <div class="col-sm-2">
                            Tanggal :<br>
                            <strong class="text-right"><?= date('d M Y') ?></strong>
                        </div>
                    </div>
                </div>


                <hr>
                <div class="col-md-12 mb-3">
                    <div class="row g-3">
                        <div class="col-sm">
                            <p class="text-end fw-bold"> Add Serial :</p>


                        </div>
                        <div class="col-sm-7">
                            <input type="text" name="id_aset" class="form-control text-center" placeholder="Serial" aria-label="Serial">
                        </div>
                        <div class="col-sm">
                            <button class="btn btn-primary text-white" type="submit"><i class="fa-solid fa-plus"></i> Add</button>
                        </div>
                    </div>
                </div>
        </form>
        <hr>
        <div class="col-md-12 mb-3">

            <div class="app-card app-card-accordion shadow-sm mb-4 pl-3">
                <div class="app-card-body pl-3 ml-3">
                    <div class="table-responsive">
                        <table class="table app-table-hover mb-0 text-left">
                            <thead>
                                <tr>
                                    <th class="cell">Serial</th>
                                    <th class="cell">Product</th>
                                    <th class="cell">Customer</th>
                                    <th class="cell">Date</th>
                                    <th class="cell">Status</th>
                                    <th class="cell">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $koneksi = new mysqli("localhost", "root", "", "absensi_walikelas");

                                $id = '001/PRY-MSI/KITECH/XI/2023';
                                $sql1 = $koneksi->query("select *
                                from tb_asetk 
                             
                                where id_sk='" . $id . "'");


                                //$sql1 = $koneksi->query("SELECT * FROM tb_bkeluar ");
                                //  $jumlah = mysqli_num_rows($sql1);

                                //if ($jumlah > 0) {

                                while ($data = $sql1->fetch_assoc()) {
                                    $sql_cek = "SELECT
                                    tb_aset.id,
                                    tb_aset.serial,
                                    tb_manufacture.nama AS manufacture
                                FROM
                                    tb_aset
                                JOIN
                                    tb_manufacture ON tb_manufacture.id = tb_aset.manufacture
                                
                                WHERE
                                    tb_aset.serial = '" . $data['id_aset'] . "'";

                                    // Menggunakan parameterized query untuk mencegah SQL injection
                                    //$hasil = mysqli_query($koneksi, $query);
                                    //$datar = mysqli_fetch_array($hasil);
                                    $query_cek = mysqli_query($koneksi, $sql_cek);
                                    $dataxr = mysqli_fetch_array($query_cek, MYSQLI_BOTH);

                                    // $jm = $datar['manufacture'];


                                ?>
                                    <tr>
                                        <td class="cell">#<?= $data['id_aset']; ?></td>
                                        <td class="cell"><span class="truncate">Lorem ipsum dolor sit amet eget volutpat erat</span></td>
                                        <td class="cell">yark</td>
                                        <td class="cell"><span><?= $data['manufacture']; ?></span></td>
                                        <td class="cell"><span class="badge bg-success">Paid</span></td>

                                        <td class="cell text-center">
                                            <a class="" href="<?= base_url('admin/suratkeluar/delete/' . $data['id']) ?>"><i class="fa-solid fa-trash-can text-danger"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>


                            </tbody>
                        </table>
                    </div><!--//table-responsive-->

                </div>
            </div>

        </div>
        <hr>
        <form action="<?= base_url('admin/aset/save') ?>" method="POST">
            <div class="row">
                <div class="col-6">
                    Kepada :
                    <input type="text" name="serial" class="form-control" required placeholder=" Tujuan ">

                </div>
                <div class="col-6">
                    Dari :
                    <input type="text" name="serial" class="form-control" required placeholder=" Dari">

                </div>
                <div class="col-6">
                    Prihal :
                    <input type="text" name="serial" class="form-control" required placeholder=" Perihal ">

                </div>
                <div class="col-6 mb-4">
                    Status
                    <select name="kondisi" class="form-select">
                        <?php foreach ($stock as $gr) : ?>
                            <option value="<?= $gr->id ?>"><?= $gr->nama ?></option>
                        <?php endforeach ?>
                    </select>
                </div>


                <div class="col-12 text-end">
                    <button class="btn btn-primary text-white" type="submit">
                        <i class="fa-solid fa-download"></i> Simpan </button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?= $this->endSection() ?>