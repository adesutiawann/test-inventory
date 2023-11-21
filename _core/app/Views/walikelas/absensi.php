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
                <input type="text" hidden name="id_kls" value="<?=$_GET['id_kls'];?>" class="form-control" required>
             
                <input type="text" hidden name="id_mk" value="<?=$_GET['id_mk'];?>" class="form-control" required>
              <input type="date" name="tanggal" value="<?= date("Y-m-d") ?>" class="form-control" required>
                </div>
                
                <div class="col-md-3">
                    <select name="tahun_pelajaran" class="form-select">
                    <?php foreach ($tahun_pelajaran_aktif as $tpa) : ?>
                    <?php endforeach ?>    
                    <?php foreach ($tahun_pelajaran as $tp) : ?>
                            <option <?php if($tpa->semester=$tp->tahun){echo'selected';}else{} ?> value="<?= $tp->tahun ?>"><?= $tp->tahun ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="semester" class="form-select">
                    <?php foreach ($tahun_pelajaran_aktif as $tpa) : ?>
                     <?php endforeach ?>    
                        <option  <?php if($tpa->semester=1){echo'selected';}else{} ?> value="1">1 </option>
                        <option <?php if($tpa->semester=2){echo'selected';}else{} ?> value="2">2</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="submit" class="btn btn-primary text-white" value="Proses">
                </div>
            </div>
        </form>
        <hr>
        <?php if (isset($_GET['tanggal'])) : ?>
            <a href="<?=base_url('walikelas/absensi/delete/'.$_GET['tanggal'].'?id_mk='.$_GET['id_mk'].'&id_kls='.$_GET['id_kls'])?>" class="btn btn-danger" onclick="return confirm('Yakin?')">DELETE ABNSENSI HARI INI</a>
            <div class="alert alert-info mt-4">CATATAN: Absensi <b>ALPA</b> Akan menambahkan <b>2 POIN Pelanggaran</b>.</div>
            <table class="table">
               <?php
               // $pelajaran =$_GET['id_mk'];
               // $mkx         = $this->mk->where('id_mengajar', $pelajaran)
               ?>
                <tr>
                    <td width="150">Tanggal Absensi</td>
                    <td width="200">: <?= $_GET['tanggal']; ?></td>
                    <td width="150">Guru</td>
                    <td>: <?= $admin->nama; ?></td>
                    <td width="150">Mata Pelajaran</td>
                    <td>: <?= $mk[0]->mapel?></td>
                </tr>
                <tr>
                    <td>Tahun Pelajaran</td>
                    <td>: <?= $_GET['tahun_pelajaran']; ?></td>
                    <td>Kelas</td>
                    <td>: <?= $_GET['id_kls']; ?></td>
                    <td>Waktu</td>
                    <td>: <?= $mk[0]->hari; ?>, Jam :<?= $mk[0]->jam_mengajar; ?></td>
                </tr>
                <tr>
                    <td>Semester</td>
                    <td>: <?= $_GET['semester']; ?></td>
                    <td>Jumlah Siswa</td>
                    <td>: <?= $count_siswa; ?></td>
                    <td>Jamke</td>
                    <td>: <?= $mk[0]->jamke; ?></td>
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
                            <th width="70">KIRIM NOTIF</th>
                            <th width="70">STATUS NOTIF</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($absensi as $s) : ?>
                            <form id="form-absensi" method="POST">
                                <input type="hidden" id="siswa" name="siswa" value="<?= $s->siswa ?>">
                                <input type="hidden" id="tanggal" name="tanggal" value="<?= $_GET['tanggal'] ?>">
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $s->nama ?></td>
                                    <td align="center"><input type="radio" name="absensi<?= $s->id ?>" id="absensi_h" style="height:25px; width:25px;" value="h" data-siswa="<?= $s->siswa ?>" data-id="<?= $s->id ?>" <?= ($s->absensi == 'h') ? 'checked' : '' ?>></td>
                                    <td align="center"><input type="radio" name="absensi<?= $s->id ?>" id="absensi_s" style="height:25px; width:25px;" value="s" data-siswa="<?= $s->siswa ?>" data-id="<?= $s->id ?>" <?= ($s->absensi == 's') ? 'checked' : '' ?>></td>
                                    <td align="center"><input type="radio" name="absensi<?= $s->id ?>" id="absensi_i" style="height:25px; width:25px;" value="i" data-siswa="<?= $s->siswa ?>" data-id="<?= $s->id ?>" <?= ($s->absensi == 'i') ? 'checked' : '' ?>></td>
                                    <td align="center"><input type="radio" name="absensi<?= $s->id ?>" id="absensi_a" style="height:25px; width:25px;" value="a" data-siswa="<?= $s->siswa ?>" data-id="<?= $s->id ?>" <?= ($s->absensi == 'a') ? 'checked' : '' ?> onclick="return confirm('Siswa Tidak Masuk akan mendapatkan 2 POIN Pelanggaran. Lanjutkan?')"></td>
                                    <td align="center"><a href="<?= base_url('walikelas/absensi/notifikasi_siswa/' . $_GET['tanggal'] . '/' . $_GET['id_kls'] . '/' . $s->siswa .'/' .$_GET['id_mk'].'/'.$mk[0]->mapel.'/'.$mk[0]->hari.'/'.$mk[0]->jam_mengajar.'/'.$mk[0]->jamke) ?>" class="btn btn-sm btn-primary">Kirim</a></td>
                                    <td align="center"><?= ($s->notifikasi == 1) ? '<span class="badge bg-success">Sukses</span>' : '<span class="badge bg-danger">Belum</span>' ?></td>
                                </tr>
                            </form>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>

            <a class="btn btn-primary btn-lg" href="<?= base_url('walikelas/absensi/notifikasi/' . $_GET['tanggal'] . '/'. $_GET['tahun_pelajaran'] . '/'. $_GET['semester'] . '/' .$_GET['id_mk'].'/'. $_GET['id_kls'] . '/' .$mk[0]->mapel.'/'.$mk[0]->hari.'/'.$mk[0]->jam_mengajar.'/'.$mk[0]->jamke)?>">Kirim Notifikasi Kehadiran Siswa</a>
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
            var siswa = $(this).attr("data-siswa");
            var tanggal = $('#tanggal').val();
            var absensi = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('walikelas/absensi/update') ?>",
                data: {
                    id: id,
                    siswa: siswa,
                    tanggal: tanggal,
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