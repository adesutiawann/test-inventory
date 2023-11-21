<?= $this->extend('admin/template') ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="app-page-title"><?= $title ?></h1>

<div class="app-card app-card-settings shadow-sm mb-4">
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
                <form method="POST" action="<?= base_url('admin/user/save') ?>" class="settings-form">
                    <div class="mb-3">
                        <label for="setting-input-2" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" value="" required>
                    </div>
                    <div class="mb-3">
                        <label for="setting-input-2" class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" value="" required>
                    </div>
                    <div class="mb-3">
                        <label for="setting-input-2" class="form-label">Nomor Whatsapp</label>
                        <input type="text" name="whatsapp" class="form-control" value="" required>
                    </div>
                    <div class="mb-3">
                        <label for="setting-input-2" class="form-label">Akses Login</label>
                        <select name="level" class="form-select">
                            <option value="1">Administrator</option>
                            <option value="2">Guru</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary" value="Simpan">
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?= $this->endSection() ?>