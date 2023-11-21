<?= $this->extend('admin/template') ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="app-page-title"><?= $title ?></h1>

<div class="app-card app-card-accordion shadow-sm mb-4">
    <div class="app-card-body p-4">
        <form action="<?= base_url('admin/laporan_all') ?>" method="GET">
            <div class="row">
                <div class="col-md-3">
                    <label for="">Pilih tanggal:</label>
                    <input type="date" name="tanggal" class="form-control my-2" required>
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

<?php if (isset($_GET['tanggal'])) : ?>
    <div class="app-card app-card-accordion shadow-sm mb-4">
        <div class="app-card-body p-4">
            <h6>Tanggal: <?= $_GET['tanggal'] ?></h6>
            <h6>Tahun Pelajaran: <?= $_GET['tahun_pelajaran'] ?></h6>
            <h6>Semester: <?= $_GET['semester'] ?></h6>

            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="30" rowspan="2" style="white-space: nowrap; text-align: center"">NO.</th>
                            <th width=" 100" rowspan="2" style="white-space: nowrap; text-align: center"">KELAS</th>
                            <th width=" 300" rowspan="2" style="white-space: nowrap; text-align: center"">WALI KELAS</th>
                            <th width=" 70" rowspan="2" style="white-space: nowrap; text-align: center"">JUMLAH SISWA</th>
                            <th width=" 50" colspan="4" style="white-space: nowrap; text-align: center"">REKAPITULASI</th>
                            <th width=" 50" rowspan="2" style="white-space: nowrap; text-align: center">% KEHADIRAN</th>
                        </tr>
                        <tr>
                            <th width="40" style="white-space: nowrap; text-align: center">H</th>
                            <th width="40" style="white-space: nowrap; text-align: center">S</th>
                            <th width="40" style="white-space: nowrap; text-align: center">I</th>
                            <th width="40" style="white-space: nowrap; text-align: center">A</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $kls = $walikelas->where('tahun_pelajaran', $_GET['tahun_pelajaran'])->join('admin', 'admin.id=walikelas.guru')->orderBy('kelas', 'asc')->findAll(); ?>
                        <?php $no = 1; ?>
                        <?php foreach ($kls as $kelas) : ?>
                            <?php $count_siswa = $siswa->where(['kelas' => $kelas->kelas, 'tahun_pelajaran' => $_GET['tahun_pelajaran']])->countAllResults() ?>
                            <?php $count_h = $absensi->where(['kelas' => $kelas->kelas, 'tanggal' => $_GET['tanggal'], 'absensi' => 'h', 'tahun_pelajaran' => $_GET['tahun_pelajaran'], 'semester' => $_GET['semester']])->countAllResults() ?>
                            <?php $count_s = $absensi->where(['kelas' => $kelas->kelas, 'tanggal' => $_GET['tanggal'], 'absensi' => 's', 'tahun_pelajaran' => $_GET['tahun_pelajaran'], 'semester' => $_GET['semester']])->countAllResults() ?>
                            <?php $count_i = $absensi->where(['kelas' => $kelas->kelas, 'tanggal' => $_GET['tanggal'], 'absensi' => 'i', 'tahun_pelajaran' => $_GET['tahun_pelajaran'], 'semester' => $_GET['semester']])->countAllResults() ?>
                            <?php $count_a = $absensi->where(['kelas' => $kelas->kelas, 'tanggal' => $_GET['tanggal'], 'absensi' => 'a', 'tahun_pelajaran' => $_GET['tahun_pelajaran'], 'semester' => $_GET['semester']])->countAllResults() ?>
                            <?php $persen_kehadiran = floor(($count_h / $count_siswa) * 100) ?>
                            <tr>
                                <td align="center"><?= $no++ ?></td>
                                <td align="center"><?= $kelas->kelas ?></td>
                                <td><?= $kelas->nama ?></td>
                                <td align="center"><?= $count_siswa ?></td>
                                <td align="center"><?= $count_h ?></td>
                                <td align="center"><?= $count_s ?></td>
                                <td align="center"><?= $count_i ?></td>
                                <td align="center"><?= $count_a ?></td>
                                <td align="center"><?= $persen_kehadiran ?> %</td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif ?>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?= $this->endSection() ?>