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
    </div>
</div>

<div class="app-card app-card-accordion shadow-sm mb-4">

    <div class="app-card-body p-4">
<a href="<?= base_url('admin/aset/index') ?>" class="btn btn-primary mb-3 text-white"><i class="fas fa-plus"></i> Tambah Siswa</a>

        <div class="table-responsive">
            <table id="table" class="table table-striped dataTable" style="width: 100%;" aria-describedby="example_info">
                <thead>
                    <tr>
                        <th>NO.</th>
                        <th >Serial</th>
                        <th >Manufacture</th>
                        <th >Spesifikasi</th>
                        
                        <th>Status</th>
                        <th>Tanggal</th>
                                             
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
                   data: 'serial'
                    
                }, 
                {
                    data: null,
                    render: function (data, type, row) {
                        // Assuming 'tgl_masuk' and 'tgl_keluar' are Date objects or date strings
                        return '<b>'+ row.manufacture 
                        + '</b> <br> type  :' + row.type;}
                },{
                    data: null,
                    render: function (data, type, row) {
                        // Assuming 'tgl_masuk' and 'tgl_keluar' are Date objects or date strings
                        return 'Prosesor  :' + row.prosesor
                        + ' <br> Generasi  :' + row.generasi
                        + ' <br> Hdd/SSD  :' + row.hdd
                        + ' <br> Ram  :' + row.ram
                        + ' <br> Rincian  :' + row.prosesor;
                    }
                }, {
                    data: null,
                    render: function (data, type, row) {
                        var bgClass = row.stok === 'Tersedia' ? 'success' : 'danger';

                        // Assuming 'tgl_masuk' and 'tgl_keluar' are Date objects or date strings
                        return 'Status  :' + row.status
                        + ' <br> Stok  : <span class="badge bg-' + bgClass + '">' + row.stok+'</span>';
                    }
                }, 
                {
                    data: null,
                    render: function (data, type, row) {
                        // Assuming 'tgl_masuk' and 'tgl_keluar' are Date objects or date strings
                        return 'In :'+ row.tgl_masuk + ' <br>Out  :' + row.tgl_keluar;
                    }
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