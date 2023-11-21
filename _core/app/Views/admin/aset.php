<?= $this->extend('admin/template') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<style>
        /* Contoh CSS untuk menentukan lebar dan tinggi textarea */
        textarea {
            width: 300px; /* Lebar textarea */
            height: 100px; /* Tinggi textarea */
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

        <form action="<?= base_url('admin/aset/save') ?>" method="POST">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <strong>Form Data Aset:</strong>
                </div>
                <hr>
                <div class="col-md-4">
                    Manufacture
                    <select name="manufacture" class="form-select">
                        <?php foreach ($nama as $gr) : ?>
                            <option value="<?= $gr->nama ?>"><?= $gr->nama ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-4">
                    Type
                    <select name="type" class="form-select">
                        <?php foreach ($type as $gr) : ?>
                            <option value="<?= $gr->nama ?>"><?= $gr->nama ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-4">
                    Prosesor
                    <select name="prosesor" class="form-select">
                        <?php foreach ($prosesor as $gr) : ?>
                            <option value="<?= $gr->nama ?>"><?= $gr->nama ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-4">
                    Generasi
                    <select name="generasi" class="form-select">
                        <?php foreach ($generasi as $gr) : ?>
                            <option value="<?= $gr->nama ?>"><?= $gr->nama ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-4">
                    HDD/SSD
                    <select name="hdd" class="form-select">
                        <?php foreach ($hdd as $gr) : ?>
                            <option value="<?= $gr->nama ?>"><?= $gr->nama ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-4">
                    RAM GB
                    <select name="ram" class="form-select">
                        <?php foreach ($ram as $gr) : ?>
                            <option value="<?= $gr->nama ?>"><?= $gr->nama ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-4">
                    Rincian
                    <select name="rincian" class="form-select">
                        <?php foreach ($rincian as $gr) : ?>
                            <option value="<?= $gr->nama ?>"><?= $gr->nama ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-4">
                    Status
                    <select name="status" class="form-select">
                        <?php foreach ($status as $gr) : ?>
                            <option value="<?= $gr->nama ?>"><?= $gr->nama ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-4">
                    Stok
                    <select name="stock" class="form-select">
                        <?php foreach ($stock as $gr) : ?>
                            <option value="<?= $gr->nama ?>"><?= $gr->nama ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-4 mb-4">
                    Kondisi
                    <select name="kondisi" class="form-select">
                        <?php foreach ($kondisi as $gr) : ?>
                            <option value="<?= $gr->nama ?>"><?= $gr->nama ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <hr>
                <div class="col-md-4">
                Serial
                        <input type="text"  name="serial" class="form-control"  required>
                      
                    </div>
                    <div class="col-md-4">
                Tanggal Masuk
                        <input type="date"  name="masuk" class="form-control"  required>
                                         </div>
                    <div class="col-md-4">
                Tanggal Keluar
                        <input type="date"  name="keluar" class="form-control"  >
                      
                    </div>
                    <div class="col-md-12 mb-5">
                Keterangan
                <div class="form-floating">
                <textarea name="ket" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                <label for="floatingTextarea2">Comments</label>
                </div>

                      </div>
              
              
                <div class="col-md-12 text-right ">
                    <input type="submit" class="btn btn-primary text-white" value="Simpan">
                </div>
            </div>
        </form>
    </div>
</div>

<div class="app-card app-card-accordion shadow-sm mb-4">

    <div class="app-card-body p-4">
        
<a href="<?= base_url('admin/siswa/add') ?>" class="btn btn-primary mb-3 text-white"><i class="fas fa-plus"></i> Tambah Siswa</a>
      
        <div class="table-responsive">
            <table id="table" class="table table-striped">
                <thead>
                    <tr>
                        <th>NO.</th>
                        <th>Tgl Masuk</th>
                        <th>Tgl Keluar</th>
                        <th>Manufaktur</th>
                        <th>Type</th>
                        <th>Prosesor</th>
                        <th>Generasi</th>
                        <th>Serial</th>
                        <th>HDD/SSD</th>
                        <th>RAM</th>
                        <th>Rinci</th>
                        <th>Status</th>
                        <th>Stock</th>
                        <th>Kondisi</th>                        
                        <th>Keterangan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '<?= base_url('admin/aset/data') ?>',
            order: [],
            columns: [{
                    data: 'no',
                    orderable: false
                },
                {
                    data: 'tgl_masuk'
                    
                }, 
                {
                    data: 'tgl_keluar'
                },
                {
                    data: 'manufacture'
                },
                {
                    data: 'type'
                    
                },
                {
                    data: 'prosesor'
                },
                {
                    data: 'generasi'
                }, 
                {
                    data: 'serial'
                },
                {
                    data: 'hdd'
                },
                {
                    data: 'ram'
                    
                },
                {
                    data: 'rincian'
                },
                {
                    data: 'status'
                },
                {
                    data: 'stock'
                    
                },
                {
                    data: 'kondisi'
                },
                {
                    data: 'ket'
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