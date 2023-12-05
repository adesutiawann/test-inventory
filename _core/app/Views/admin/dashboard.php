<?= $this->extend('admin/template') ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="app-page-title">Dashboard</h1>

<div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
    <div class="inner">
        <div class="app-card-body p-3 p-lg-4">
            <h3 class="mb-3">Welcome, <?= $admin->nama ?>!</h3>
            <div class="row gx-5 gy-3">
                <div class="col-12">

                    <div>Selamat datang di aplikasi aset inventory, anda bisa mengelola data aset komputer dan lain sebagainya.</div>
                </div>
            </div>
            <!--//row-->
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <!--//app-card-body-->

    </div>
    <!--//inner-->
</div>
<!--//app-card-->

<h1 class="app-page-title">Statistik Aset</h1>
<div class="row g-4 mb-4">
    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Total Aset Destop</h4>
                <div class="stats-figure"><?= $total_d ?></div>
            </div>
            <!--//app-card-body-->
            <a class="app-card-link-mask" href="#"></a>
        </div>
        <!--//app-card-->
    </div>
    <!--//col-->

    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Total Aset Nootbooks</h4>
                <div class="stats-figure"><?= $total_n ?></div>
            </div>
            <!--//app-card-body-->
            <a class="app-card-link-mask" href="#"></a>
        </div>
        <!--//app-card-->
    </div>
    <!--//col-->
    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Total Aset Printer</h4>
                <div class="stats-figure"><?= $total_p ?></div>
            </div>
            <!--//app-card-body-->
            <a class="app-card-link-mask" href="#"></a>
        </div>
        <!--//app-card-->
    </div>
    <!--//col-->
    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Total Aset Server</h4>
                <div class="stats-figure"><?= $total_s ?></div>
            </div>
            <!--//app-card-body-->
            <a class="app-card-link-mask" href="#"></a>
        </div>
        <!--//app-card-->
    </div>
    <!--//col-->
</div>
<!--//row-->

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?= $this->endSection() ?>