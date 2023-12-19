<?= $this->extend('admin/template') ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="app-page-title"><?= $title ?></h1>



<div class="row-xs-12">
    <div class="col-md-4 col-sm-6 col-xs-6 mb-3  ">
        <div class="app-card app-card-settings shadow-sm p-4">
            <form method="POST" action="<?= base_url('admin/user/save') ?>" class="settings-form card-body">
                <div class="mb-3 row">
                    <label for="setting-input-2 " class="form-label col">Username</label>
                    <input type="text" name="username" class="form-control col" value="" required>
                </div>
                <div class="mb-3 row">
                    <label for="setting-input-2" class="form-label col">Nama</label>
                    <input type="text" name="nama" class="form-control col" value="" required>
                </div>
                <div class="mb-3 row">
                    <label for="setting-input-2" class="form-label col-10">Nomor Whatsapp</label>
                    <input type="text" name="whatsapp" class="form-control col-10" value="" required>
                </div>
                <div class="mb-3 row">
                    <label for="setting-input-2" class="form-label col-10">Akses Login</label>
                    <select name="level" class="form-select col-10">
                        <option value="1">Administrator</option>
                        <option value="2">Staff</option>
                        <option value="3">Guest</option>
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
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?= $this->endSection() ?>