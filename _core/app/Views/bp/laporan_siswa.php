<?= $this->extend('walikelas/template') ?>

<?= $this->section('css') ?>
<style>
    .btn-label {
        position: relative;
        left: -12px;
        display: inline-block;
        padding: 6px 12px;
        background: rgba(0, 0, 0, 0.15);
        border-radius: 3px 0 0 3px;
    }

    .btn-labeled {
        padding-top: 0;
        padding-bottom: 0;
    }

    .btn {
        margin-bottom: 10px;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="app-page-title"><?= $title ?></h1>

<div class="app-card app-card-accordion shadow-sm mb-4">
    <div class="app-card-body p-4">
        <form action="<?= base_url('bp/laporan_siswa_bp') ?>" method="GET">
            <!-- <label for="">Silahkan pilih tanggal dan kelas: </label> -->
            <div class="row">
                <div class="col-md-3">
                    <label for="">Pilih bulan:</label>
                    <input type="month" name="bulan" class="form-control my-2" required>
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
                <div class="col-md-2">
                    <label for="">Minimal Presentasi:</label>
                    <input type="number" name="persen" value="60" class="form-control my-2" required>
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
            <?php if (session()->getFlashData('success')) : ?>
                <div class="alert alert-success">
                    <?= session()->getFlashData('success') ?>
                </div>
            <?php endif ?>
            <?php if (session()->getFlashData('error')) : ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashData('error') ?>
                </div>
            <?php endif ?>

            <?php $bln = explode('-', $_GET['bulan']); ?>
            <h6>Tanggal: <?= $_GET['bulan'] ?></h6>
            <h6>Tahun Pelajaran: <?= $_GET['tahun_pelajaran'] ?></h6>
            <h6>Semester: <?= $_GET['semester'] ?></h6>
            <h6>Prosentase Kehadiran: -<?= $_GET['persen'] ?>%</h6>
            <hr>
            <h5>Kelas: X</h5>
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="50" rowspan="2" style="white-space: nowrap; text-align:center;">NO.</th>
                            <th width="300" rowspan="2" style="white-space: nowrap; text-align:center;">NAMA</th>
                            <th width="100" rowspan="2" style="white-space: nowrap; text-align:center;">KELAS</th>
                            <th width="100" colspan="4" style="white-space: nowrap; text-align:center;">REKAP ABSENSI</th>
                            <th width="50" rowspan="2" style="white-space: nowrap; text-align:center;">%<br>Kehadiran</th>
                            <th width="300" rowspan="2" style="white-space: nowrap; text-align:center;">&nbsp;</th>
                        </tr>
                        <tr>
                            <th width="40" style="white-space: nowrap; text-align:center;">H</th>
                            <th width="40" style="white-space: nowrap; text-align:center;">S</th>
                            <th width="40" style="white-space: nowrap; text-align:center;">I</th>
                            <th width="40" style="white-space: nowrap; text-align:center;">A</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cek_all = $absensi->select('absensi.*, siswa.nama, siswa.whatsapp_wali')->where(['MONTH(tanggal)' => $bln[1], 'YEAR(tanggal)' => $bln[0], 'absensi.tahun_pelajaran' => $_GET['tahun_pelajaran'], 'absensi.semester' => $_GET['semester']])->join('siswa', 'siswa.id=absensi.siswa')->groupBy('absensi.siswa')->orderBy('absensi.kelas', 'asc')->findAll();
                        $count_all = $absensi->where(['MONTH(tanggal)' => $bln[1], 'YEAR(tanggal)' => $bln[0], 'tahun_pelajaran' => $_GET['tahun_pelajaran'], 'semester' => $_GET['semester']])->countAllResults();
                        $no = 1;
                        foreach ($cek_all as $all) {
                            $cek_h = $absensi->where(['MONTH(tanggal)' => $bln[1], 'YEAR(tanggal)' => $bln[0], 'tahun_pelajaran' => $_GET['tahun_pelajaran'], 'semester' => $_GET['semester'], 'siswa' => $all->siswa, 'absensi' => 'h'])->countAllResults();
                            $cek_s = $absensi->where(['MONTH(tanggal)' => $bln[1], 'YEAR(tanggal)' => $bln[0], 'tahun_pelajaran' => $_GET['tahun_pelajaran'], 'semester' => $_GET['semester'], 'siswa' => $all->siswa, 'absensi' => 's'])->countAllResults();
                            $cek_i = $absensi->where(['MONTH(tanggal)' => $bln[1], 'YEAR(tanggal)' => $bln[0], 'tahun_pelajaran' => $_GET['tahun_pelajaran'], 'semester' => $_GET['semester'], 'siswa' => $all->siswa, 'absensi' => 'i'])->countAllResults();
                            $cek_a = $absensi->where(['MONTH(tanggal)' => $bln[1], 'YEAR(tanggal)' => $bln[0], 'tahun_pelajaran' => $_GET['tahun_pelajaran'], 'semester' => $_GET['semester'], 'siswa' => $all->siswa, 'absensi' => 'a'])->countAllResults();
                            $presentasi = ($cek_h / ($cek_s + $cek_i + $cek_a + $cek_h)) * 100;
                            if ($presentasi <= $_GET['persen']) {
                                $kelas = explode(' ', $all->kelas);
                                if ($kelas[0] == 'X') {
                                    echo '
                                    <tr>
                                        <td align="center" valign="middle">' . $no++ . '</td>
                                        <td valign="middle">' . $all->nama . '</td>
                                        <td align="center" valign="middle">' . $all->kelas . '</td>
                                        <td align="center" valign="middle">' . $cek_h . '</td>
                                        <td align="center" valign="middle">' . $cek_s . '</td>
                                        <td align="center" valign="middle">' . $cek_i . '</td>
                                        <td align="center" valign="middle">' . $cek_a . '</td>
                                        <td align="center" valign="middle">' . floor($presentasi) . ' %</td>
                                        <td align="center" width="100">
											<form method="post" action="' . base_url('bp/laporan_siswa_bp/panggilan') . '" enctype="multipart/form-data">
												<input type="hidden" name="bulan" value="' . $_GET['bulan'] . '">
												<input type="hidden" name="tahun_pelajaran" value="' . $_GET['tahun_pelajaran'] . '">
												<input type="hidden" name="semester" value="' . $_GET['semester'] . '">
												<input type="hidden" name="persen" value="' . $_GET['persen'] . '">
												<input type="hidden" name="nama" value="' . $all->nama . '">
                                                <input type="hidden" name="siswa" value="' . $all->siswa . '">
												<input type="hidden" name="nomor" value="' . $all->whatsapp_wali . '">
												
												<input type="file" name="file" class="form-control" required>
												<input type="submit" class="btn btn-primary btn-block" value="Kirim Panggilan">
											</form>
                                      </td>
                                    </tr>
                                    ';
                                }
                            }
                        }
                        ?>

                    </tbody>
                </table>
            </div>



            <hr>
            <h5>Kelas: XI</h5>
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="50" rowspan="2" style="white-space: nowrap; text-align:center;">NO.</th>
                            <th width="300" rowspan="2" style="white-space: nowrap; text-align:center;">NAMA</th>
                            <th width="100" rowspan="2" style="white-space: nowrap; text-align:center;">KELAS</th>
                            <th width="100" colspan="4" style="white-space: nowrap; text-align:center;">REKAP ABSENSI</th>
                            <th width="50" rowspan="2" style="white-space: nowrap; text-align:center;">%<br>Kehadiran</th>
                            <th width="300" rowspan="2" style="white-space: nowrap; text-align:center;">&nbsp;</th>
                        </tr>
                        <tr>
                            <th width="40" style="white-space: nowrap; text-align:center;">H</th>
                            <th width="40" style="white-space: nowrap; text-align:center;">S</th>
                            <th width="40" style="white-space: nowrap; text-align:center;">I</th>
                            <th width="40" style="white-space: nowrap; text-align:center;">A</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cek_all = $absensi->select('absensi.*, siswa.nama, siswa.whatsapp_wali')->where(['MONTH(tanggal)' => $bln[1], 'YEAR(tanggal)' => $bln[0], 'absensi.tahun_pelajaran' => $_GET['tahun_pelajaran'], 'absensi.semester' => $_GET['semester']])->join('siswa', 'siswa.id=absensi.siswa')->groupBy('absensi.siswa')->orderBy('absensi.kelas', 'asc')->findAll();
                        $count_all = $absensi->where(['MONTH(tanggal)' => $bln[1], 'YEAR(tanggal)' => $bln[0], 'tahun_pelajaran' => $_GET['tahun_pelajaran'], 'semester' => $_GET['semester']])->countAllResults();
                        $no = 1;
                        foreach ($cek_all as $all) {
                            $cek_h = $absensi->where(['MONTH(tanggal)' => $bln[1], 'YEAR(tanggal)' => $bln[0], 'tahun_pelajaran' => $_GET['tahun_pelajaran'], 'semester' => $_GET['semester'], 'siswa' => $all->siswa, 'absensi' => 'h'])->countAllResults();
                            $cek_s = $absensi->where(['MONTH(tanggal)' => $bln[1], 'YEAR(tanggal)' => $bln[0], 'tahun_pelajaran' => $_GET['tahun_pelajaran'], 'semester' => $_GET['semester'], 'siswa' => $all->siswa, 'absensi' => 's'])->countAllResults();
                            $cek_i = $absensi->where(['MONTH(tanggal)' => $bln[1], 'YEAR(tanggal)' => $bln[0], 'tahun_pelajaran' => $_GET['tahun_pelajaran'], 'semester' => $_GET['semester'], 'siswa' => $all->siswa, 'absensi' => 'i'])->countAllResults();
                            $cek_a = $absensi->where(['MONTH(tanggal)' => $bln[1], 'YEAR(tanggal)' => $bln[0], 'tahun_pelajaran' => $_GET['tahun_pelajaran'], 'semester' => $_GET['semester'], 'siswa' => $all->siswa, 'absensi' => 'a'])->countAllResults();
                            $presentasi = ($cek_h / ($cek_s + $cek_i + $cek_a + $cek_h)) * 100;
                            if ($presentasi <= $_GET['persen']) {
                                $kelas = explode(' ', $all->kelas);
                                if ($kelas[0] == 'XI') {
                                    echo '
                                    <tr>
                                        <td align="center" valign="middle">' . $no++ . '</td>
                                        <td valign="middle">' . $all->nama . '</td>
                                        <td align="center" valign="middle">' . $all->kelas . '</td>
                                        <td align="center" valign="middle">' . $cek_h . '</td>
                                        <td align="center" valign="middle">' . $cek_s . '</td>
                                        <td align="center" valign="middle">' . $cek_i . '</td>
                                        <td align="center" valign="middle">' . $cek_a . '</td>
                                        <td align="center" valign="middle">' . floor($presentasi) . ' %</td>
                                        <td align="center">
                                            <form method="post" action="' . base_url('bp/laporan_siswa_bp/panggilan') . '" enctype="multipart/form-data">
												<input type="hidden" name="bulan" value="' . $_GET['bulan'] . '">
												<input type="hidden" name="tahun_pelajaran" value="' . $_GET['tahun_pelajaran'] . '">
												<input type="hidden" name="semester" value="' . $_GET['semester'] . '">
												<input type="hidden" name="persen" value="' . $_GET['persen'] . '">
												<input type="hidden" name="nama" value="' . $all->nama . '">
                                                <input type="hidden" name="siswa" value="' . $all->siswa . '">
												<input type="hidden" name="nomor" value="' . $all->whatsapp_wali . '">
												
												<input type="file" name="file" class="form-control" required>
												<input type="submit" class="btn btn-primary btn-block" value="Kirim Panggilan">
											</form>
                                      </td>
                                    </tr>
                                    ';
                                }
                            }
                        }
                        ?>

                    </tbody>
                </table>
            </div>

            <hr>
            <h5>Kelas: XII</h5>
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="50" rowspan="2" style="white-space: nowrap; text-align:center;">NO.</th>
                            <th width="300" rowspan="2" style="white-space: nowrap; text-align:center;">NAMA</th>
                            <th width="100" rowspan="2" style="white-space: nowrap; text-align:center;">KELAS</th>
                            <th width="100" colspan="4" style="white-space: nowrap; text-align:center;">REKAP ABSENSI</th>
                            <th width="50" rowspan="2" style="white-space: nowrap; text-align:center;">%<br>Kehadiran</th>
                            <th width="300" rowspan="2" style="white-space: nowrap; text-align:center;">&nbsp;</th>
                        </tr>
                        <tr>
                            <th width="40" style="white-space: nowrap; text-align:center;">H</th>
                            <th width="40" style="white-space: nowrap; text-align:center;">S</th>
                            <th width="40" style="white-space: nowrap; text-align:center;">I</th>
                            <th width="40" style="white-space: nowrap; text-align:center;">A</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cek_all = $absensi->select('absensi.*, siswa.nama, siswa.whatsapp_wali')->where(['MONTH(tanggal)' => $bln[1], 'YEAR(tanggal)' => $bln[0], 'absensi.tahun_pelajaran' => $_GET['tahun_pelajaran'], 'absensi.semester' => $_GET['semester']])->join('siswa', 'siswa.id=absensi.siswa')->groupBy('absensi.siswa')->orderBy('absensi.kelas', 'asc')->findAll();
                        $count_all = $absensi->where(['MONTH(tanggal)' => $bln[1], 'YEAR(tanggal)' => $bln[0], 'tahun_pelajaran' => $_GET['tahun_pelajaran'], 'semester' => $_GET['semester']])->countAllResults();
                        $no = 1;
                        foreach ($cek_all as $all) {
                            $cek_h = $absensi->where(['MONTH(tanggal)' => $bln[1], 'YEAR(tanggal)' => $bln[0], 'tahun_pelajaran' => $_GET['tahun_pelajaran'], 'semester' => $_GET['semester'], 'siswa' => $all->siswa, 'absensi' => 'h'])->countAllResults();
                            $cek_s = $absensi->where(['MONTH(tanggal)' => $bln[1], 'YEAR(tanggal)' => $bln[0], 'tahun_pelajaran' => $_GET['tahun_pelajaran'], 'semester' => $_GET['semester'], 'siswa' => $all->siswa, 'absensi' => 's'])->countAllResults();
                            $cek_i = $absensi->where(['MONTH(tanggal)' => $bln[1], 'YEAR(tanggal)' => $bln[0], 'tahun_pelajaran' => $_GET['tahun_pelajaran'], 'semester' => $_GET['semester'], 'siswa' => $all->siswa, 'absensi' => 'i'])->countAllResults();
                            $cek_a = $absensi->where(['MONTH(tanggal)' => $bln[1], 'YEAR(tanggal)' => $bln[0], 'tahun_pelajaran' => $_GET['tahun_pelajaran'], 'semester' => $_GET['semester'], 'siswa' => $all->siswa, 'absensi' => 'a'])->countAllResults();
                            $presentasi = ($cek_h / ($cek_s + $cek_i + $cek_a + $cek_h)) * 100;
                            if ($presentasi <= $_GET['persen']) {
                                $kelas = explode(' ', $all->kelas);
                                if ($kelas[0] == 'XII') {
                                    echo '
                                    <tr>
                                        <td align="center" valign="middle">' . $no++ . '</td>
                                        <td valign="middle">' . $all->nama . '</td>
                                        <td align="center" valign="middle">' . $all->kelas . '</td>
                                        <td align="center" valign="middle">' . $cek_h . '</td>
                                        <td align="center" valign="middle">' . $cek_s . '</td>
                                        <td align="center" valign="middle">' . $cek_i . '</td>
                                        <td align="center" valign="middle">' . $cek_a . '</td>
                                        <td align="center" valign="middle">' . floor($presentasi) . ' %</td>
                                        <td align="center">
                                            <form method="post" action="' . base_url('bp/laporan_siswa_bp/panggilan') . '" enctype="multipart/form-data">
												<input type="hidden" name="bulan" value="' . $_GET['bulan'] . '">
												<input type="hidden" name="tahun_pelajaran" value="' . $_GET['tahun_pelajaran'] . '">
												<input type="hidden" name="semester" value="' . $_GET['semester'] . '">
												<input type="hidden" name="persen" value="' . $_GET['persen'] . '">
												<input type="hidden" name="nama" value="' . $all->nama . '">
												<input type="hidden" name="siswa" value="' . $all->siswa . '">
												<input type="hidden" name="nomor" value="' . $all->whatsapp_wali . '">
												
												<input type="file" name="file" class="form-control" required>
												<input type="submit" class="btn btn-primary btn-block" value="Kirim Panggilan">
											</form>
                                      </td>
                                    </tr>
                                    ';
                                }
                            }
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif ?>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?= $this->endSection() ?>