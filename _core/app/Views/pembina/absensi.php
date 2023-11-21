<?= $this->extend('walikelas/template') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

<style>
    #absensi_h:checked:after {
        width: 25px;
        height: 25px;
        border-radius: 15px;
        top: -2px;
        left: -1px;
        position: relative;
        background-color: forestgreen;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 2px solid white;
    }

    #absensi_s:checked:after {
        width: 25px;
        height: 25px;
        border-radius: 15px;
        top: -2px;
        left: -1px;
        position: relative;
        background-color: blueviolet;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 2px solid white;
    }

    #absensi_i:checked:after {
        width: 25px;
        height: 25px;
        border-radius: 15px;
        top: -2px;
        left: -1px;
        position: relative;
        background-color: darkorange;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 2px solid white;
    }

    #absensi_a:checked:after {
        width: 25px;
        height: 25px;
        border-radius: 15px;
        top: -2px;
        left: -1px;
        position: relative;
        background-color: crimson;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 2px solid white;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="app-page-title"><?= $title ?></h1>

<div class="app-card app-card-accordion shadow-sm mb-4">
    <div class="app-card-body p-4">
        <?php if (session()->getFlashData('error')) : ?>
            <div class="alert alert-danger">
                <?= session()->getFlashData('error') ?>
            </div>
        <?php endif ?>

        <form action="" method="GET">
            <div class="row">
                <div class="col-md-3">
                    <input type="date" name="tanggal" class="form-control" value="<?= date("Y-m-d") ?>" required>
                </div>
                <div class="col-md-3">
                    <select name="extra" class="form-select">
                        <?php foreach (unserialize(base64_decode($pembina->extra)) as $extra) : ?>
                            <option value="<?= $extra ?>"><?= $extra ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="tahun_pelajaran" class="form-select">
                        <?php foreach ($tahun_pelajaran as $tp) : ?>
                            <option value="<?= $tp->tahun ?>"><?= $tp->tahun ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="semester" class="form-select">
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="submit" class="btn btn-primary text-white" value="Proses">
                </div>
            </div>
        </form>
        <hr>
        <?php if (isset($_GET['tanggal'])) : ?>
            <a href="<?=base_url('pembina/absensi_ekstra/delete/' . $_GET['tanggal'] . '/' . $_GET['tahun_pelajaran'] . '/' . $_GET['semester']. '/' . $_GET['extra'])?>" class="btn btn-danger" onclick="return confirm('Yakin?')">DELETE ABNSENSI HARI INI</a>
          
            <table class="table">
                <tr>
                    <td width="150">Tanggal Absensi</td>
                    <td width="200">: <?= $_GET['tanggal']; ?></td>
                    <td width="150">Pembina</td>
                    <td>: <?= $pembina->nama; ?></td>
                </tr>
            </table>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th width="40">NO.</th>
                            <th>NAMA</th>
                            <th width="70">HADIR</th>
                            <th width="70">SAKIT</th>
                            <th width="70">IZIN</th>
                            <th width="70">ALPA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($absensi_kegiatan as $s) : ?>
                            <form id="form-absensi" method="POST">
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $s->nama ?></td>
                                    <td align="center"><input type="radio" name="absensi<?= $s->id ?>" id="absensi_h" style="height:25px; width:25px;" value="h" data-id="<?= $s->id ?>" <?= ($s->absensi == 'h') ? 'checked' : '' ?>></td>
                                    <td align="center"><input type="radio" name="absensi<?= $s->id ?>" id="absensi_s" style="height:25px; width:25px;" value="s" data-id="<?= $s->id ?>" <?= ($s->absensi == 's') ? 'checked' : '' ?>></td>
                                    <td align="center"><input type="radio" name="absensi<?= $s->id ?>" id="absensi_i" style="height:25px; width:25px;" value="i" data-id="<?= $s->id ?>" <?= ($s->absensi == 'i') ? 'checked' : '' ?>></td>
                                    <td align="center"><input type="radio" name="absensi<?= $s->id ?>" id="absensi_a" style="height:25px; width:25px;" value="a" data-id="<?= $s->id ?>" <?= ($s->absensi == 'a') ? 'checked' : '' ?>></td>
                                </tr>
                            </form>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>

            <a class="btn btn-primary btn-lg" href="<?= base_url('pembina/absensi_ekstra/notifikasi/' . $_GET['tanggal'] . '/' . $_GET['tahun_pelajaran'] . '/' . $_GET['semester']. '/' . $_GET['extra']) ?>">Kirim Notifikasi Kehadiran Siswa</a>
        <?php else : ?>
            <div class="alert alert-warning">Silahkan pilih tanggal, tahun pelajaran dan semester</div>
        <?php endif ?>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(function() {

        $('input[type=radio]').change(function() {
            $('input[type=radio]').attr("disabled", true);

            var id = $(this).attr("data-id");
            var absensi = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('pembina/absensi_ekstra/update') ?>",
                data: {
                    id: id,
                    absensi: absensi
                },
                success: function(res) {
                    $('input[type=radio]').attr("disabled", false);
                    // console.log(res);
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>