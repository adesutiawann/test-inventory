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
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-exclamation"></i>
                <strong>Error ! </strong>
                <?= session()->getFlashData('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif ?>
        <?php if (session()->getFlashData('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-check"></i>
                <strong>Success ! </strong>
                <?= session()->getFlashData('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif ?>
        <?php if (session()->getFlashData('warning')) : ?>

            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-triangle-exclamation mr-3"></i>
                <strong>Peringatan ! </strong>
                <?= session()->getFlashData('warning') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif ?>

        <form action="<?= base_url('admin/suratkeluar/save') ?>" method="POST">
            <div class="row">

                <div class="col-md-12 mb-3">
                    <div class="row g-3 shadow-lg pb-3">
                        <div class="col-sm">
                            <p class="text-end fw-bold"> Add Serial :</p>


                        </div>
                        <div class="col-sm-7">
                            <input type="text" name="serial" class="form-control text-center" placeholder="Serial">
                        </div>
                        <div class="col-sm">
                            <button class="btn btn-primary text-white" type="submit"><i class="fa-solid fa-plus"></i> Add</button>
                        </div>
                    </div>
                </div>
        </form>
        <hr>
        <div class="col-md-12 mb-3">

            <div class="app-card app-card-accordion  mb-4 pl-3">
                <div class="app-card-body pl-3 ml-3">
                    <div class="table-responsive">
                        <? //php  print_r($asetk)
                        ?>
                        <table class=" table app-table-hover mb-0 text-left">
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
                                            Stock :<?= $value->stock ?><br>
                                            Kondisi:
                                            <span class="badge bg-<?= ($value->kondisi == 'OK') ? 'success' : (($value->kondisi == 'RUSAK') ? 'warning' : 'danger') ?>">
                                                <?= $value->kondisi  ?>
                                            </span>
                                        </td>


                                        <td class="cell text-center ">
                                            <a class="" href="<?= base_url('admin/suratkeluar/delete_asetk/' . $value->id) ?>">
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

        <form action="<?= base_url('admin/suratkeluar/savesuratkeluar') ?>" method="POST">

            <div class="col-md-12 mb-1  ">

                <div class="row g-3 shadow-lg pb-3">

                    <div class="col-sm-2 text-right">
                        <p class="text-end fw-bold"> Nomor :</p>

                    </div>
                    <div class="col-lg-8">

                        <input type="text" name="nomor" class="form-control text-center" placeholder="001/PRY-MSI/KITECH/XI/2023" required>
                    </div>
                    <div class="col-sm-2">
                        Tanggal :<br>
                        <strong class="text-right"><?= date('d M Y') ?></strong>
                    </div>
                </div>

            </div>


            <hr>
            <div class="container ">
                <div class="row gx-2">
                    <div class="col-md-12 col-lg-6">
                        <div class="p-3 border bg-light">
                            <h6>Barang</h6>
                            <hr>

                            <div class="row">

                                <div class="col-2">
                                    Jumlah :
                                    <input type="text" name="jumlah" class="form-control" required placeholder="000">

                                </div>
                                <div class="col-5">
                                    Satuan :
                                    <input type="text" name="satuan" class="form-control" required placeholder="Unit">

                                </div>

                                <div class="col-5 mb-4">
                                    Status
                                    <select name="status" class="form-select">
                                        <?php foreach ($stock as $gr) : ?>
                                            <option value="<?= $gr->nama ?>"><?= $gr->nama ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-5">
                                    Keterangan
                                    <div class="form-floating">
                                        <textarea name="ket" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                        <label for="floatingTextarea2">Keterangan</label>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="p-3 border bg-light">
                            <h6>Penerima</h6>
                            <hr>
                            <div class="row ">
                                <div class="col-2">
                                    NIK :
                                    <input type="text" name="nik" class="form-control UPPERCASE" required placeholder="NIK">

                                </div>
                                <div class="col-5">
                                    Penerima :
                                    <input type="text" name="penerima" class="form-control" required placeholder="Nama Penerima">

                                </div>
                                <div class="col-5">
                                    Telpon :
                                    <input type="text" name="telpon" class="form-control" required placeholder="Telpon ">

                                </div>
                                <div class="col-md-12 mb-5 mt-3">
                                    Lokasi
                                    <div class="form-floating">
                                        <textarea name="lokasi" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                        <label for="floatingTextarea2">Lokasi</label>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 text-end mt-3">
                <button class="btn btn-primary text-white" type="submit">
                    <i class="fa-solid fa-download"></i> Simpan </button>
            </div>


    </div>


</div>


</div>
</div>
</form>
</div>
</div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?= $this->endSection() ?>