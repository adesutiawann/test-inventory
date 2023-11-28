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
                            <input type="text" name="id_aset" class="form-control text-center" placeholder="Serial">
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
                        <?php //print_r($asetk) 
                        ?>
                        <table class="table app-table-hover mb-0 text-left">
                            <thead>
                                <tr>
                                    <th class="cell">No</th>
                                    <th class="cell">Serial</th>
                                    <th class="cell">Product</th>
                                    <th class="cell">Status</th>
                                    <th class="cell text-center">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($asetk as $key => $value) :

                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>


                                        <td class="cell"><b><?= $value->serial ?></b></td>
                                        <td class="cell">
                                            <span class="truncate"><?= $value->manufacture ?></span><br>
                                            <span class="truncate">Type :<?= $value->type ?></span>
                                        </td>
                                        <td class="cell">
                                            Status :<?= $value->status ?><br>
                                            Stock :<?= $value->stok ?><br>
                                            Kondisi:
                                            <span class="badge bg-<?= ($value->kondisi == 'OK') ? 'success' : (($value->kondisi == 'RUSAK') ? 'warning' : 'danger') ?>">
                                                <?= $value->kondisi  ?>
                                            </span>
                                        </td>


                                        <td class="cell text-center ">
                                            <a class="" href="<?= base_url('admin/suratkeluar/delete_asetk/' . $value->id_asetk) ?>">
                                                <i class="fa-solid fa-trash-can text-danger"></i> </a>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>


                            </tbody>
                        </table>
                    </div><!--//table-responsive-->

                </div>
            </div>

        </div>
        <hr>
        <form action="<?= base_url('admin/suratkeluar/save_sk') ?>" method="POST">
            <div class="row">
                <div class="col-6">
                    Kepada :
                    <input type="text" name="kepada" class="form-control" required placeholder=" Tujuan ">

                </div>
                <div class="col-6">
                    Dari :
                    <input type="text" name="dari" class="form-control" required placeholder=" Dari">

                </div>
                <div class="col-6">
                    Prihal :
                    <input type="text" name="prihal" class="form-control" required placeholder=" Perihal ">

                </div>
                <div class="col-6 mb-4">
                    Status
                    <select name="status" class="form-select">
                        <?php foreach ($stock as $gr) : ?>
                            <option value="<?= $gr->nama ?>"><?= $gr->nama ?></option>
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