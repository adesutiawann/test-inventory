<?= $this->extend('walikelas/template') ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="app-page-title"><?= $title ?></h1>

<div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
    <div class="inner">
        <div class="app-card-body p-3 p-lg-4">
            <h3 class="mb-3">Welcome, <?= $admin->nama ?>!</h3>
            <div class="row gx-5 gy-3">
                <div class="col-12">

                    <div>
                        Selamat datang di aplikasi laporan Absensi untuk wali kelas. Anda bisa melakukan rekap absensi dihalaman ini.<br>
                        <?php if ($walikelas) : ?>
                            Anda ditugaskan untuk menjadi wali kelas di kelas <strong><?= $walikelas->kelas ?></strong>
                        <?php else : ?>
                            <div class="alert alert-danger">Anda belum mendapatkan tugas sebagai wali kelas.</div>
                        <?php endif ?>
                    </div>

                </div>
                <!-- <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img src="https://via.placeholder.com/150x90" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Piket</h5>
                            <p class="card-text">Hore! kamu di tunjuk sebagai guru piket. jangan lupa absensi ya....</p>
                            <a href="#" class="btn btn-primary">Goo..!!</a>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
        <!--//app-card-body-->

    </div>
    <!--//inner-->
</div>
<!--//app-card-->

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?= $this->endSection() ?>