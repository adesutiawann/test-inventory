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
                <form method="POST" action="<?= base_url('admin/siswa/save') ?>" class="settings-form">
                <div class="row">
                    <div class="mb-3">
                        <label for="setting-input-2" class="form-label">Nama Siswa</label>
                        <input type="text" name="nama" class="form-control"  required>
                    </div>
                    <div class="mb-3">
                        <label for="setting-input-2" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" >
                    </div>
                    <div class="mb-3">
                        <label for="setting-input-2" class="form-label">Nomor Whatsapp</label>
                        <input type="number" name="whatsapp_siswa" class="form-control" >
                        <small class="text-muted">Gunakan format 62857xxxxxx</small>
                    </div>
                    <div class="mb-3">
                        <label for="setting-input-2" class="form-label">Nomor Whatsapp Wali</label>
                        <input type="number" name="whatsapp_wali" class="form-control" >
                        <small class="text-muted">Gunakan format 62857xxxxxx</small>
                    </div>
                    <div class="mb-3">
                    <select name="kelas" class="form-select">
                        <?php foreach ($kelas as $kls) : ?>
                            <option value="<?= $kls->kelas ?>"><?= $kls->kelas ?></option>
                        <?php endforeach ?>
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