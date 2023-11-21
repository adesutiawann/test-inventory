<?= $this->extend('admin/template') ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php 
$con = new mysqli ("localhost","root","","absensi_walikelas") or die(mysqli_error($con));
$taAktif = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM tahun_pelajaran WHERE aktif=1 "));
$guru1 = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM admin WHERE id=$jadwal->id_guru "));
$mapel1 = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM tb_mapel WHERE id=$jadwal->id_mapel "));
//$kelas1 = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM siswa WHERE kelas=$jadwal->kelas "));

 ?>
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
            <div class="col-md-12">
                <form method="POST" action="<?= base_url('admin/jadwal/save') ?>" class="settings-form">
				<input type="hidden" name="id" class="form-control" value="<?= $jadwal->id_mengajar ?>">

									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="kode">Kode Pelajaran <?= $jadwal->id_mengajar ?></label>
												<input name="kode" type="text" class="form-control" id="kode" value="<?= $jadwal->kode_pelajaran ?>" readonly>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Tahun Pelajaran</label>
												<input type="hidden" name="ta" value="<?=$taAktif['id']?>">
												<input type="hidden" name="semester" value="<?=$taAktif['semester'] ?>">
												<input type="text" class="form-control" placeholder="<?=$taAktif['tahun'] ?>" readonly>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="kode">Semester</label>
												<input type="text" class="form-control" placeholder="<?=$taAktif['semester'] ?>" readonly>
											</div>
										</div>
									</div>
                                    
									<div class="row mt-4">
									<div class="col-md-6">
										<div class="form-group">
											<label>Guru Mata Pelajaran</label>
											<select name="guru" class="form-control" required>
												<option value="<?= $guru1['id'] ?>"><?= $guru1['nama'] ?></option>
												<?php 
												$guru = mysqli_query($con,"SELECT * FROM admin where level=2  ORDER BY id ASC");
												foreach ($guru as $g) {
													echo "<option value='$g[id]'>$g[nama]</option>";
												}
												 ?>
												
											</select>
										</div>
									</div>
								
									<div class="col-md-6">
										<div class="form-group">
											<label>Mata Pelajaran</label>
											<select name="mapel" class="form-control" required>
												
												<option value="<?=$mapel1['id']?>"><?=$mapel1['mapel']?></option>
												<?php 
												$mapel = mysqli_query($con,"SELECT * FROM tb_mapel ORDER BY id ASC");
												foreach ($mapel as $g) {
													echo "<option value='$g[id]'>$g[mapel]</option>";
												}
												 ?>
												
											</select>
										</div>
									</div>
								</div>


									<div class="row mt-3">
									<div class="col-md-6 mt-3">											
											<div class="form-check">
												<label>Hari : </label>
												<label class="form-radio-label">
													<input <?php if($jadwal->hari=="Senin"){echo 'checked';}?> class="form-radio-input" type="radio" name="hari" value="Senin">
													<span class="form-radio-sign">Senin</span>
												</label>
												<label class="form-radio-label">
													<input  <?php if($jadwal->hari=="Selasa"){echo 'checked';}?> class="form-radio-input" type="radio" name="hari" value="Selasa">
													<span class="form-radio-sign">Selasa</span>
												</label>
												<label class="form-radio-label">
													<input  <?php if($jadwal->hari=="Rabu"){echo 'checked';}?> class="form-radio-input" type="radio" name="hari" value="Rabu">
													<span class="form-radio-sign">Rabu</span>
												</label>
												<label class="form-radio-label">
													<input  <?php if($jadwal->hari=="Kamis"){echo 'checked';}?> class="form-radio-input" type="radio" name="hari" value="Kamis">
													<span class="form-radio-sign">Kamis</span>
												</label>
												<label class="form-radio-label">
													<input  <?php if($jadwal->hari=="Jum'at"){echo 'checked';}?> class="form-radio-input" type="radio" name="hari" value="Jum'at">
													<span class="form-radio-sign">Jum'at</span>
												</label>
												<label class="form-radio-label">
													<input  <?php if($jadwal->hari=="Sabtu"){echo 'checked';}?> class="form-radio-input" type="radio" name="hari" value="Sabtu">
													<span class="form-radio-sign">Sabtu</span>
												</label>

											</div>
										</div>
										<div class="col-md-6 mt-3">	
												<label>Kelas</label>
											<select name="kelas" class="form-control" required>
												<option value="<?= $jadwal->kelas ?>"><?= $jadwal->kelas ?></option>
												<?php 
                                                
												$kelas = mysqli_query($con,"SELECT DISTINCT kelas FROM siswa ORDER BY id ASC");
												foreach ($kelas as $s) {
													
                                                    echo "<option value='$s[kelas]'>$s[kelas]</option>";
												}
												 ?>
												
											</select>


										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="waktu">Waktu</label>
												<input name="waktu" value="<?= $jadwal->jam_mengajar ?>" required type="text" class="form-control" id="waktu" placeholder="00.00 - 00.00">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="jamke">Jam Ke</label>
												<input name="jamke" value="<?= $jadwal->jamke ?>" required type="text" class="form-control" id="jamke" placeholder="1 - 10">
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<div class="col-md-12">
											<div class="form-group">
												<button type="submit" name="save" class="btn btn-secondary">
													<i class="far fa-save"></i> Simpan
												</button>
												<a href="javascript:history.back()" class="btn btn-danger">
													<i class="fas fa-angle-double-left"></i> Kembali
												</a>
											</div>
										</div>
									</div>
									</form>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?= $this->endSection() ?>