<?= $this->extend('admin/template') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="app-page-title"><?= $title ?></h1>

<div class="app-card app-card-accordion shadow-sm mb-4">
    <div class="app-card-header p-3 border-0">
        <h4 class="app-card-title">Tahun Pelajaran</h4>
    </div>
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
        <div class="row">
            <div class="col-md-5">
                <form action="<?= base_url('admin/setting/save_tp') ?>" method="POST">
                    <div class="form-group">
                        <label for="">Tahun Pelajaran</label>
                        <input type="text" name="tahun" class="form-control my-2" placeholder="2023/2024" required>
                    </div>
                    <div class="form-group">
                        <label for="">Semester</label>
                        <select name="semester" class="form-select">
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary text-white my-2" value="Proses">
                    </div>
                </form>
            </div>
            <div class="col-md-7">
                <div class="table-responsive">
                    <table id="table" class="table table-striped" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tahun Pelajaran</th>
                                <th>Semester</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="app-card app-card-accordion shadow-sm mb-4">
    <div class="app-card-header p-3 border-0">
        <h4 class="app-card-title">Whatsapp API</h4>
    </div>
    <div class="app-card-body p-4">
        <?php if (session()->getFlashData('error_wa')) : ?>
            <div class="alert alert-danger">
                <?= session()->getFlashData('error_wa') ?>
            </div>
        <?php endif ?>
        <?php if (session()->getFlashData('success_wa')) : ?>
            <div class="alert alert-success">
                <?= session()->getFlashData('success_wa') ?>
            </div>
        <?php endif ?>

        <form action="<?= base_url('admin/setting/save_wa') ?>" method="POST">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for=""><a href="https://wa511.api-wa.my.id" target="_blank"> Whatsapp API URL:</a></label>
                        <input type="text" name="wa_api_url" class="form-control my-2" value="<?= $setting->wa_api_url ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="">Whatsapp API KEY:</label>
                        <input type="text" name="wa_api_key" class="form-control my-2" value="<?= $setting->wa_api_key ?>" required>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="form-group">
                       
                    <label for="">Pesan Teks :</label>
                <div class="card mb-7">
                    <!-- Header -->
                    
                    <div class="card-header">
                    <!-- Nav -->
                    <ul class="nav nav-segment" id="navTab4" role="tablist">
                        <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="nav-resultTab4" data-bs-toggle="pill" href="#nav-result4" role="tab" aria-controls="nav-result4" aria-selected="true">Absensi</a>
                        </li>
                        <li class="nav-item" role="presentation">
                        <a class="nav-link" id="nav-htmlTab4" data-bs-toggle="pill" href="#nav-html4" role="tab" aria-controls="nav-html4" aria-selected="false" tabindex="-1">Extrakulikuler</a>
                        </li>
                        <li class="nav-item" role="presentation">
                        <a class="nav-link" id="nav-htmlTab5" data-bs-toggle="pill" href="#nav-html5" role="tab" aria-controls="nav-html4" aria-selected="false" tabindex="-1">Pangggilan</a>
                        </li>

                        <li class="nav-item" role="presentation">
                        <a class="nav-link" id="nav-htmlTab5" data-bs-toggle="pill" href="#nav-html6" role="tab" aria-controls="nav-html4" aria-selected="false" tabindex="-1">Terlambat</a>
                        </li>
                    </ul>
                    <!-- End Nav -->
                    </div>
                    <!-- End Header -->

                    <!-- Tab Content -->
                    <div class="tab-content" id="navTabContent4">
                    <div class="tab-pane fade p-4 active show" id="nav-result4" role="tabpanel" aria-labelledby="nav-resultTab4">
                        <!-- Input Group -->
                        <div class="form-group">
                        <label for="">Pesan Teks Absensi:</label>
                        <textarea name="text_message1" id="" cols="30" rows="10" class="form-control my-2" style="height: 200px;"><?= $setting->text_message1 ?></textarea>
                    </div>
                        <!-- End Input Group -->
                    </div>

                    
                    <div class="tab-pane fade p-4 " id="nav-html4" role="tabpanel" aria-labelledby="nav-resultTab4">
                     <div class="form-group">
                        <label for="">Pesan Teks Extrakulikuler:</label>
                        <textarea name="text_message2" id="" cols="30" rows="10" class="form-control my-2" style="height: 200px;"><?= $setting->text_message2 ?></textarea>
                    </div>
                    </div>

                    <div class="tab-pane fade p-4 " id="nav-html5" role="tabpanel" aria-labelledby="nav-resultTab4">
                   <div class="form-group">
                        <label for="">Pesan Teks Pangggilan:</label>
                        <textarea name="text_message3" id="" cols="30" rows="10" class="form-control my-2" style="height: 200px;"><?= $setting->text_message3 ?></textarea>
                    </div>
                    </div>

                    <div class="tab-pane fade p-4 " id="nav-html6" role="tabpanel" aria-labelledby="nav-resultTab4">
                   <div class="form-group">
                        <label for="">Pesan Teks Terlambat:</label>
                        <textarea name="text_message4" id="" cols="30" rows="10" class="form-control my-2" style="height: 200px;"><?= $setting->text_message4 ?></textarea>
                    </div>
                    </div>
                    <!-- End Tab Content -->
                </div>
            </div>
            </div>
                </div>
                <div class="text-right">
            <input type="submit" class="btn btn-primary  left w-25" value="Simpan">
                </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select').select2();
    });
    $(document).ready(function() {
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '<?= base_url('admin/setting/data_tp') ?>',
            order: [],
            columns: [{
                    data: 'no',
                    orderable: false
                },
                {
                    data: 'tahun'
                },
                {
                    data: 'semester'
                },
                {
                    data: 'aktif'
                },
                {
                    data: 'action',
                    orderable: false
                },
            ]
        });
    });
</script>
<?= $this->endSection() ?>