<?= $this->extend('walikelas/template') ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="app-page-title"><?= $title ?></h1>

<div class="app-card app-card-accordion shadow-sm mb-4">
    <div class="app-card-body p-4">
        <form action="<?= base_url('bp/laporan_bp') ?>" method="GET">
            <!-- <label for="">Silahkan pilih tanggal dan kelas: </label> -->
            <div class="row">
                <div class="col-md-3">
                    <label for="">Pilih bulan:</label>
                    <input type="month" name="bulan" class="form-control my-2" required>
                </div>
                <div class="col-md-2">
                    <label for="">Pilih kelas:</label>
                    <select name="kelas" class="form-select my-2">
                        <?php foreach ($kelas as $kls) : ?>
                            <option value="<?= $kls->kelas ?>"><?= $kls->kelas ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="">Pilih Tahun Pelajaran:</label>
                    <select name="tahun_pelajaran" class="form-select my-2">
                        <?php foreach ($tahun_pelajaran as $tp) : ?>
                            <option value="<?= $tp->tahun ?>"><?= $tp->tahun ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="">Pilih Semester:</label>
                    <select name="semester" class="form-select my-2">
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <br>
                    <input type="submit" class="btn btn-primary text-white my-2" value="Proses">
                </div>
            </div>
        </form>
    </div>
</div>


<?php if (isset($_GET['bulan'])) : ?>
    <div class="app-card app-card-accordion shadow-sm mb-4">
        <div class="app-card-body p-4">
            <h6>Tanggal: <?= $_GET['bulan'] ?></h6>
            <h6>Kelas: <?= $_GET['kelas'] ?></h6>
            <h6>Wali Kelas: <?= $wali->walikelas ?></h6>
            <h6>Tahun Pelajaran: <?= $_GET['tahun_pelajaran'] ?></h6>
            <h6>Semester: <?= $_GET['semester'] ?></h6>
            <div class="table-responsive">
                <table>
                    <tr>
                        <td style="padding-right: 20px;">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th width="50" rowspan="2" style="white-space: nowrap;">NO.</th>
                                        <th width="300" rowspan="2" style="white-space: nowrap;">NAMA</th>
                                        <th width="100" colspan="4" style="white-space: nowrap;">REKAP ABSENSI</th>
                                        <th width="50" rowspan="2" style="white-space: nowrap;">%<br>Kehadiran</th>
                                    </tr>
                                    <tr>
                                        <th width="40">H</th>
                                        <th width="40">S</th>
                                        <th width="40">I</th>
                                        <th width="40">A</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($siswa)) : ?>
                                        <?php $no = 1; ?>
                                        <?php $bln = explode('-', $_GET['bulan']); ?>
                                        <?php foreach ($siswa as $siswa) : ?>
                                            <?php
                                            $th = $absensi->where(['MONTH(tanggal)' => $bln[1], 'YEAR(tanggal)' => $bln[0], 'siswa' => $siswa->id, 'absensi' => 'h', 'tahun_pelajaran' => $_GET['tahun_pelajaran'], 'semester' => $_GET['semester'], 'kelas' => $_GET['kelas']])->countAllResults();
                                            $ts = $absensi->where(['MONTH(tanggal)' => $bln[1], 'YEAR(tanggal)' => $bln[0], 'siswa' => $siswa->id, 'absensi' => 's', 'tahun_pelajaran' => $_GET['tahun_pelajaran'], 'semester' => $_GET['semester'], 'kelas' => $_GET['kelas']])->countAllResults();
                                            $ti = $absensi->where(['MONTH(tanggal)' => $bln[1], 'YEAR(tanggal)' => $bln[0], 'siswa' => $siswa->id, 'absensi' => 'i', 'tahun_pelajaran' => $_GET['tahun_pelajaran'], 'semester' => $_GET['semester'], 'kelas' => $_GET['kelas']])->countAllResults();
                                            $ta = $absensi->where(['MONTH(tanggal)' => $bln[1], 'YEAR(tanggal)' => $bln[0], 'siswa' => $siswa->id, 'absensi' => 'a', 'tahun_pelajaran' => $_GET['tahun_pelajaran'], 'semester' => $_GET['semester'], 'kelas' => $_GET['kelas']])->countAllResults();
                                            $tb = $absensi->where(['MONTH(tanggal)' => $bln[1], 'YEAR(tanggal)' => $bln[0], 'tahun_pelajaran' => $_GET['tahun_pelajaran'], 'semester' => $_GET['semester'], 'kelas' => $_GET['kelas']])->groupBy('tanggal')->countAllResults();

                                            ?>
                                            <tr>
                                                <td style="white-space: nowrap;"><?= $no++ ?></td>
                                                <td style="white-space: nowrap;"><?= $siswa->nama ?></td>
                                                <td align="center" style="white-space: nowrap;"><?= $th ?></td>
                                                <td align="center" style="white-space: nowrap;"><?= $ts ?></td>
                                                <td align="center" style="white-space: nowrap;"><?= $ti ?></td>
                                                <td align="center" style="white-space: nowrap;"><?= $ta ?></td>
                                                <td align="center" style="white-space: nowrap;"><?= ($tb != 0) ? floor(($th / $tb) * 100) : '0' ?>%</td>
                                            </tr>
                                        <?php endforeach ?>
                                        <tr>
                                            <td colspan="7" align="right">Prosentase Kehadiran Setiap Hari :</td>
                                        </tr>
                                        <tr>
                                            <td colspan="7" align="right">Prosentase Ketidakhadiran Setiap Hari :</td>
                                        </tr>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        </td>
                        <td>
                            <table class="table table-sm table-bordered">
                                <tr>
                                    <th colspan="31">TANGGAL</th>
                                </tr>
                                <tr>
                                    <?php for ($t = 1; $t <= 31; $t++) : ?>
                                        <th><?= $t ?></th>
                                    <?php endfor ?>
                                </tr>
                                <tr>
                                    <?php for ($a = 1; $a <= 31; $a++) : ?>
                                        <td style="padding:0">
                                            <table class="table table-sm" style="margin: 0;">
                                                <?php
                                                $tgl = $_GET['bulan'] . '-0' . $a;
                                                $q = $absensi->where(['tanggal' => $tgl, 'kelas' => $_GET['kelas'], 'tahun_pelajaran' => $_GET['tahun_pelajaran'], 'semester' => $_GET['semester']])->findAll();
                                                if (!empty($q)) {
                                                    $no = 1;
                                                    $abs = '';
                                                    $h = 0;
                                                    $t = 0;
                                                    foreach ($q as $q) {
                                                        if (!empty($q->absensi)) {
                                                            $abs = $q->absensi;
                                                        } else {
                                                            $abs = '&nbsp;';
                                                        }

                                                        if ($q->absensi == 'h') {
                                                            $bg = 'bg-primary text-white';
                                                            $h++;
                                                        } else if ($q->absensi == 's') {
                                                            $bg = 'bg-info text-white';
                                                            $t++;
                                                        } else if ($q->absensi == 'i') {
                                                            $bg = 'bg-warning text-white';
                                                            $t++;
                                                        } else if ($q->absensi == 'a') {
                                                            $bg = 'bg-danger text-white';
                                                            $t++;
                                                        } else {
                                                            $bg = 'bg-secondary';
                                                            $t++;
                                                        }
                                                        echo '
                                                    <tr>
                                                        <td class="' . $bg . '" align="center"><b>' . $abs . '</b></td>
                                                    </tr>
                                                    ';
                                                    }
                                                    echo '
                                                <tr>
                                                    <td>' . floor(($h / $siswa_count) * 100) . '%</td>
                                                </tr>
                                                <tr>
                                                    <td>' . floor(($t / $siswa_count) * 100) . '%</td>
                                                </tr>
                                                ';
                                                } else {
                                                    for ($c = 1; $c <= $siswa_count; $c++) {
                                                        echo '
                                                    <tr>
                                                        <td class="bg-secondary">&nbsp;</td>
                                                    </tr>
                                                    ';
                                                    }
                                                    echo '
                                                <tr>
                                                    <td class="bg-warning">0%</td>
                                                </tr>
                                                <tr>
                                                    <td class="bg-warning">0%</td>
                                                </tr>
                                                ';
                                                }
                                                ?>
                                            </table>
                                        </td>
                                    <?php endfor ?>
                                </tr>

                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
<?php endif ?>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?= $this->endSection() ?>