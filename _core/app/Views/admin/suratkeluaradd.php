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
                                    <th class="cell">Total</th>
                                    <th class="cell"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="cell">#15346</td>
                                    <td class="cell"><span class="truncate">Lorem ipsum dolor sit amet eget volutpat erat</span></td>
                                    <td class="cell">John Sanders</td>
                                    <td class="cell"><span>17 Oct</span><span class="note">2:16 PM</span></td>
                                    <td class="cell"><span class="badge bg-success">Paid</span></td>
                                    <td class="cell">$259.35</td>
                                    <td class="cell"><a class="btn-sm app-btn-secondary" href="#">View</a></td>
                                </tr>
                                <tr>
                                    <td class="cell">#15345</td>
                                    <td class="cell"><span class="truncate">Consectetur adipiscing elit</span></td>
                                    <td class="cell">Dylan Ambrose</td>
                                    <td class="cell"><span class="cell-data">16 Oct</span><span class="note">03:16 AM</span></td>
                                    <td class="cell"><span class="badge bg-warning">Pending</span></td>
                                    <td class="cell">$96.20</td>
                                    <td class="cell"><a class="btn-sm app-btn-secondary" href="#">View</a></td>
                                </tr>
                                <tr>
                                    <td class="cell">#15344</td>
                                    <td class="cell"><span class="truncate">Pellentesque diam imperdiet</span></td>
                                    <td class="cell">Teresa Holland</td>
                                    <td class="cell"><span class="cell-data">16 Oct</span><span class="note">01:16 AM</span></td>
                                    <td class="cell"><span class="badge bg-success">Paid</span></td>
                                    <td class="cell">$123.00</td>
                                    <td class="cell"><a class="btn-sm app-btn-secondary" href="#">View</a></td>
                                </tr>

                                <tr>
                                    <td class="cell">#15343</td>
                                    <td class="cell"><span class="truncate">Vestibulum a accumsan lectus sed mollis ipsum</span></td>
                                    <td class="cell">Jayden Massey</td>
                                    <td class="cell"><span class="cell-data">15 Oct</span><span class="note">8:07 PM</span></td>
                                    <td class="cell"><span class="badge bg-success">Paid</span></td>
                                    <td class="cell">$199.00</td>
                                    <td class="cell"><a class="btn-sm app-btn-secondary" href="#">View</a></td>
                                </tr>



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