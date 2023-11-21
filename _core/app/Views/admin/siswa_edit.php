<?= $this->extend('admin/template') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
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
              
                <input type="hidden" name="id" class="form-control" value="<?= $siswa->id ?>">
 
                <div class="mb-3">
                        <label for="setting-input-2" class="form-label">Nama Siswa</label>
                        <input type="text" name="nama" class="form-control" value="<?= $siswa->nama ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="setting-input-2" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= $siswa->email ?>">
                    </div>
                    <div class="mb-3">
                        <label for="setting-input-2" class="form-label">Nomor Whatsapp</label>
                        <input type="number" name="whatsapp_siswa" class="form-control" value="<?= $siswa->whatsapp_siswa ?>">
                        <small class="text-muted">Gunakan format 62857xxxxxx</small>
                    </div>
                    <div class="mb-3">
                        <label for="setting-input-2" class="form-label">Nomor Whatsapp Wali</label>
                        <input type="number" name="whatsapp_wali" class="form-control" value="<?= $siswa->whatsapp_wali ?>">
                        <small class="text-muted">Gunakan format 62857xxxxxx</small>
                    </div>
                    <div class="mb-3">
                        <label for="setting-input-2" class="form-label">Kelas</label>
                        <select name="kelas" class="form-select" required>
                            <?php foreach ($kelas as $kls) : ?>
                                <option value="<?= $kls->kelas ?>" <?= ($kls->kelas == $siswa->kelas) ? 'selected' : '' ?>><?= $kls->kelas ?></option>
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