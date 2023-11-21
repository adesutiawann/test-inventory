<?= $this->extend('walikelas/template') ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="app-page-title"><?= $title ?></h1>

<div class="app-card app-card-accordion shadow-sm mb-4">
    <div class="app-card-body p-4">
        <form action="<?= base_url('walikelas/laporan') ?>" method="GET">
            <!-- <label for="">Silahkan pilih tanggal dan kelas: </label> -->
            <div class="row">
                <div class="col-md-3">
                    <label for="">Pilih bulan:</label>
                    <input type="month" name="bulan" class="form-control my-2" required>
                </div>
                <div class="col-md-2">
                    <label for="">Pilih kelas:</label>
                    <input type="text" name="kelas" class="form-control my-2" value="<?= $walikelas->kelas ?>" required readonly>
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
            <h6>Kelas: <?= $walikelas->kelas ?></h6>
            <h6>Wali Kelas: <?= $admin->nama ?></h6>
            <h6>Tahun Pelajaran: <?= $_GET['tahun_pelajaran'] ?></h6>
            <h6>Semester: <?= $_GET['semester'] ?></h6>
            <div class="table-responsive  ">
              
                            <table class="table  table-bordered">
                                <thead>
                                    <tr>
                                        <th width="50" class="text-center" rowspan="2" style="white-space: nowrap;">NO.</th>
                                        <th width="300" rowspan="2" style="white-space: nowrap;">NAMA</th>
                                        <th width="100"  class="text-center" colspan="4" style="white-space: nowrap;">REKAP ABSENSI</th>
                                        <th width="50" class="text-center" rowspan="2" style="white-space: nowrap;">%<br>Kehadiran</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center" width="40">H</th>
                                        <th class="text-center" width="40">S</th>
                                        <th class="text-center" width="40">I</th>
                                        <th class="text-center" width="40">A</th>
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
                                           // $tb = $absensi->where(['MONTH(tanggal)' => $bln[1], 'YEAR(tanggal)' => $bln[0], 'tahun_pelajaran' => $_GET['tahun_pelajaran'], 'semester' => $_GET['semester'], 'kelas' => $_GET['kelas']])->groupBy('tanggal')->countAllResults();
                                            $tb = $absensi->where(['MONTH(tanggal)' => $bln[1], 'YEAR(tanggal)' => $bln[0], 'siswa' => $siswa->id,  'tahun_pelajaran' => $_GET['tahun_pelajaran'], 'semester' => $_GET['semester'], 'kelas' => $_GET['kelas']])->countAllResults();
                                            //$presentasi = ($th / ($ts + $ti + $ta +$th)) * 100;
                                            //$presentasi = ($th++ / $tb) * 100;
                                            ?>
                                            <tr>
                                                <td class="text-center" style="white-space: nowrap;"><?= $no++ ?></td>
                                                <td style="white-space: nowrap;"><?= $siswa->nama ?></td>
                                                <td align="center" style="white-space: nowrap;"><?= $th ?></td>
                                                <td align="center" style="white-space: nowrap;"><?= $ts ?></td>
                                                <td align="center" style="white-space: nowrap;"><?= $ti ?></td>
                                                <td align="center" style="white-space: nowrap;"><?= $ta ?></td>
                                                <td align="center" style="white-space: nowrap;"><?= ($tb != 0) ? floor($jm=($th / $tb) * 100) : '0' ?>%</td>
                                            </tr>
                                        <?php endforeach 
                                        
                                        ?>
                                        <tr>
                                            <td colspan="6" align="right">Prosentase Kehadiran Setiap Hari :</td>
                                            <td align="center" style="white-space: nowrap;"><?php
                                             $h= $absensi->where(['MONTH(tanggal)' => $bln[1], 'YEAR(tanggal)' => $bln[0],  'absensi' => 'h', 'tahun_pelajaran' => $_GET['tahun_pelajaran'], 'semester' => $_GET['semester'], 'kelas' => $_GET['kelas']])->countAllResults();
                                             $jms = $absensi->where(['MONTH(tanggal)' => $bln[1], 'YEAR(tanggal)' => $bln[0],   'tahun_pelajaran' => $_GET['tahun_pelajaran'], 'semester' => $_GET['semester'], 'kelas' => $_GET['kelas']])->countAllResults();
                                           echo $hdr=$h/$jms*100;
                                             ?>%</td>
                                          
                                        </tr>
                                        <tr>
                                            <td colspan="6" align="right">Prosentase Ketidakhadiran Setiap Hari :</td>
                                            <td align="center" style="white-space: nowrap;"><?=  100-$hdr;?>%</td>
                                          
                                        </tr>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        
                       
                           
            </div>
        </div>
    </div>
<?php endif ?>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?= $this->endSection() ?>