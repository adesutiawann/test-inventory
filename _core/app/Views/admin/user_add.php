<?= $this->extend('admin/template') ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title"><?= $title ?></h1>
        <hr class="mb-4">
        <div class="row g-4 settings-section">

            <div class="col-12 col-md-8">
                <div class="app-card app-card-settings shadow-sm p-4">

                    <div class="app-card-body">
                        <form method="POST" action="<?= base_url('admin/user/save') ?>" class="settings-form card-body">

                            <div class="col-md-3 mb-1">
                                <strong>Add Account</strong>
                            </div>
                            <hr>
                            <div class="mb-3 row">
                                <div class="col-2 col-md-2">
                                    <label for="setting-input-1" class="form-label">NIK</label>
                                </div>
                                <div class="col-10 col-md-10">
                                    <input name="nik" type="text" class="form-control" placeholder="JN123" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-2 col-md-2">
                                    <label for="setting-input-1" class="form-label">Nama</label>
                                </div>
                                <div class="col-10 col-md-10">
                                    <input name="nama" type="text" class="form-control" placeholder="Andika" required="">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-2 col-md-2">
                                    <label for="setting-input-1" class="form-label">Telpon</label>
                                </div>
                                <div class="col-10 col-md-10">
                                    <input name="whatsapp" type="text" class="form-control" placeholder="+62" required="">
                                </div>
                            </div>
                            <hr>
                            <div class="mb-3 row">
                                <div class="col-2 col-md-2">
                                    <label for="setting-input-1" class="form-label">Username</label>
                                </div>
                                <div class="col-10 col-md-10">
                                    <input name="username" type="text" class="form-control" placeholder="Andika" required="">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-2 col-md-2">
                                    <label for="setting-input-1" class="form-label">Password</label>
                                </div>
                                <div class="col-10 col-md-10">
                                    <input name="password" type="text" class="form-control" placeholder="******" required="">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-2 col-md-2">
                                    <label for="setting-input-1" class="form-label">Level</label>
                                </div>
                                <div class="col-10 col-md-10">
                                    <select name="level" class="form-select col-10" required>
                                        <option class="text-danger" value="">Pilih Level </option>
                                        <option value="1">Administrator</option>
                                        <option value="2">Staff</option>
                                        <option value="3">Guest</option>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="text-end">

                                <button type="submit" class="btn app-btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div><!--//app-card-body-->

                </div><!--//app-card-->
            </div>
            <div class="col-12 col-md-4">
                <h3 class="section-title">Registrasi</h3>
                <div class="section-intro">
                    Langkah-langkah registrasi ini diperlukan agar pengguna dapat mengakses layanan atau fitur yang disediakan oleh platform tersebut. Tujuan dari registrasi akun adalah untuk mengidentifikasi pengguna secara unik dan memberikan akses yang terbatas sesuai dengan hak akses yang diberikan kepada akun tersebut.</div>
            </div>
        </div><!--//row-->

        <hr class="my-4">
    </div><!--//container-fluid-->
</div>

</div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?= $this->endSection() ?>