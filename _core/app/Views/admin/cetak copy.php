<?php
session_start();
if (isset($_SESSION['ses_nama']) == "") {
    header("location: login.php");
} else {
    $data_id = $_SESSION["ses_id"];
    $data_nama = $_SESSION["ses_nama"];
    $data_level = $_SESSION["ses_level"];
    
};                                       
include "../../inc/koneksi.php";


function rupiah($angka)
{

    $hasil_rupiah = "" . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}
function rprupiah($angka)
{

    $hasil_rupiah = " <small>Rp.</small>" . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}
                                 
                                         ?>

<?php
 //$set=$_GET['set'];
 //$pb=$_GET['pb'];
$date=$_GET['daterange'];  
   // $koneksi = new mysqli ("localhost","root","","db_sinarjaya");
                           
                                         ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="icon" type="image/png" sizes="16x16" href="../../images/favicon.png">
<title>Laporan </title>
<style type="text/css">

#judula {
 width:100%;
 margin-bottom:20px;
 text-align:center;
}
#judull a{
 width:100%;
 margin-bottom:20px;
 text-align:right;
 margin-top: auto;
}

</style>

<link href="../../vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="../../vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
<link rel="stylesheet" href="Style.css" type="text/css" />
<link rel="canonical" href="https://fontawesome.com" />

    <link href="../../css/style.css" rel="stylesheet">
</head>

<body>
 
<div id='contentwrapper' class='contentwrapper mt-4'>
  




<div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header ">

                            <div class="d-flex align-items-center mb-3 mr-3">
                            
                            <img src="../../images/logo.png" class="text-right " width="15%" alt=""  /> 
											<div class="mr-auto ml-4">
												<h2 class="fs-20 text-black font-w600 mt-2">
                                                <?PHP
                                                if ($_GET['data']==0) {
                                                    echo'LAPORAN DATA BUKU';
                                                }elseif ($_GET['data']==1) {
                                                    echo'LAPORAN DATA PENGUNJUNG';
                                                }
                                                elseif ($_GET['data']==2) {
                                                    echo'LAPORAN DATA PEMINJAMAN';
                                                }
                                                elseif ($_GET['data']==3) {
                                                    echo'LAPORAN DATA PENGEMBALIAN';
                                                }
                                                elseif ($_GET['data']==4) {
                                                    echo'LAPORAN DATA ANGGOTA';
                                                }else{
                                                    echo'LAPORAN DATA PERPUSTAKAAN';
                                                }
                                                ?>
 </h2>
												
                                                <H2 class="fs-bold">SDIT AL-HANIF<H2></div>
										</div>
                               
                               
                            </div>


<div class="card-body">
	<!-- pengunjung-->
<?PHP
if ($_GET['data']==1) {
?>
<table class="table header-border" onclick="print()">
                                        <thead>
                                            <tr  class="thead-primary">
                                            <th>No</th>
											<th>NISN</th>
											<th>Siswa</th>
											<th>Date/Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$no = 1;
										$sql = $koneksi->query("select * from tb_pengunjung where tgl_in BETWEEN $date ORDER BY id DESC ");
										while ($data = $sql->fetch_assoc()) {
										?>
											<tr>
												<td>
													<?php echo $no++; ?>
												</td>
												<td>
											
													<b><?php echo $data['nisn']; ?></b>

												</td>
												<td class="sorting_1">
												<?php
										$no = 1;
										//$sql1_cek="select * from tb_siswa where nisn='".$data['nisn']."'";
                                        $sql_cek = "SELECT * FROM tb_siswa WHERE nisn='".$data['nisn']."'";
                                        //$data1 = mysqli_fetch_array($sql1,MYSQLI_BOTH);
										$query_cek = mysqli_query($koneksi, $sql_cek);
                                        $data_cekk = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
										?>
													<?php echo $data_cekk['nama']; ?><br>
													<?php echo $data_cekk['jk']; ?> / KLS:<?php echo $data_cekk['kelas']; ?><br>
													TL :<?php echo $data_cekk['tgl_lahir']; ?>
                                       
												</td>
												<td>
													<?php echo  $data['tgl_in']; ?>
												</td>
												
												

											</tr>

										<?php
										}
										?>

									</tbody>
                                    </table>


<!-- buku-->		<?PHP
}elseif ($_GET['data']==0) {
?>

									<table class="table header-border" onclick="print()">
                                        <thead>
                                            <tr  class="thead-primary">
											<th>No</th>
                                            <th>Judul </th>
                                            <th>Pengarang </th>
                                            <th>Penerbit</th>
                                            <th>Jumlah Buku</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
                                        $no = 1;
                                        $sql = $koneksi->query("select * from tb_buku");
                                        while ($data = $sql->fetch_assoc()) {
                                        ?>
                                            <tr>
                                                <td>
                                                  <?php echo $no++; ?>
                                                </td>
                                                
                                                <td>
                                                    <?php echo $data['judul']; ?><br>
                                                         <?php
                                                          $sql_cek = "SELECT * FROM tb_kategori WHERE id='" . $data['id_kategori'] . "'";
                                                            $query_cek = mysqli_query($koneksi, $sql_cek);
                                                            $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
                                                        echo $data_cek['kategori']; 
                                                        ?><br>
                                                             
                                                                   <?php echo $data['tahun']; ?><br>
                                              </td>
                                              
                                                <td>
                                                <?php echo $data['pengarang']; ?><br>
                                                </td>

                                                <td>
                                              
                                              <?php echo $data['penerbit']; ?><br>
                                                </td>

                                                <td>
                                                    Rak : <?php echo $data['rak']; ?><br>
                                                Jumlah : <?php echo $data['jumlah']; ?><br>
                                                </td>

                                                        
                                                
                                            </tr>

                                        <?php
                                        }
                                        ?>
									</tbody>
                                    </table>

<!-- pinjam -->	<?PHP
}elseif ($_GET['data']==2) {
?>

									<table class="table header-border" onclick="print()">
                                        <thead>
                                            <tr  class="thead-primary">
											<th>No</th>
                                            <th>No.Pinjam</th>
                                            <th>Judul </th>
                                            <th>Nama Siswa</th>
                                            <th>Waktu</th>
                                            <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
                                        $no = 1;
                                        $sql = $koneksi->query("select * from tb_pinjam where setatus=0 && tgl_pinjam BETWEEN $date");
                                        while ($data = $sql->fetch_assoc()) {
                                        ?>
                                            <tr>
                                                <td>
                                                  <?php echo $no++; ?>
                                                </td>
                                                
                                                <td>
                                                    <?php echo $data['id']; ?><br>
                                                        
                                              </td>
                                              
                                                <td>
                                                <?php
                                                          $sql_cek = "SELECT * FROM tb_buku WHERE id='" . $data['id_buku'] . "'";
                                                            $query_cek = mysqli_query($koneksi, $sql_cek);
                                                            $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
                                                        echo $data_cek['judul'].'<br>Pengarang :'. 
                                                        $data_cek['pengarang'].'<br>Penerbit : '. 
                                                        $data_cek['penerbit']; 
                                                        ?><br>
                                                </td>

                                                <td>
                                                <?php
                                                          $sql_cek1 = "SELECT * FROM tb_siswa WHERE nisn='" . $data['id_siswa'] . "'";
                                                            $query_cek1 = mysqli_query($koneksi, $sql_cek1);
                                                            $data_cek1 = mysqli_fetch_array($query_cek1, MYSQLI_BOTH);
                                                        echo $data_cek1 ['nama']; 
                                                        ?>
                                                </td>

                                                <td>
                                                Tgl.Pinjam  : <?php echo $data['tgl_pinjam']; ?>  s/d <?php echo $data['tgl_kembali']; ?><br>
                                               
                                                </td>

                                                      <td>
                                                      <span class="badge light badge-warning ml-3">
														<i class="fa fa-circle text-warning mr-1"></i>
														di Pinjam
													</span>
                                                      
                                                      </td>  
                                                
                                            </tr>

                                        <?php
                                        }
                                        ?>

									</tbody>
                                    </table>
	<!-- pengembalian-->			<?PHP
}elseif ($_GET['data']==3) {
?>

									<table class="table header-border" onclick="print()">
                                        <thead>
                                            <tr  class="thead-primary">
											<th>No</th>
                                            <th>No.Pinjam</th>
                                            <th>Judul </th>
                                            <th>Nama Siswa</th>
                                            <th>Waktu</th>
                                            <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
                                        $no = 1;
                                        $sql = $koneksi->query("select * from tb_pinjam where setatus=1 && tgl_dikembalikan BETWEEN $date");
                                        while ($data = $sql->fetch_assoc()) {
                                        ?>
                                            <tr>
                                                <td>
                                                  <?php echo $no++; ?>
                                                </td>
                                                
                                                <td>
                                                    <?php echo $data['id']; ?><br>
                                                        
                                              </td>
                                              
                                                <td>
                                                <?php
                                                          $sql_cek = "SELECT * FROM tb_buku WHERE id='" . $data['id_buku'] . "'";
                                                            $query_cek = mysqli_query($koneksi, $sql_cek);
                                                            $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
                                                            echo $data_cek['judul'].'<br>Pengarang :'. 
                                                            $data_cek['pengarang'].'<br>Penerbit : '. 
                                                            $data_cek['penerbit']; 
                                                        ?><br>
                                                </td>

                                                <td>
                                                <?php
                                                          $sql_cek1 = "SELECT * FROM tb_siswa WHERE nisn='" . $data['id_siswa'] . "'";
                                                            $query_cek1 = mysqli_query($koneksi, $sql_cek1);
                                                            $data_cek1 = mysqli_fetch_array($query_cek1, MYSQLI_BOTH);
                                                        echo $data_cek1 ['nama']; 
                                                        ?>
                                                </td>

                                                <td>
                                                Tgl.Pinjam  : <?php echo $data['tgl_pinjam']; ?>  s/d <?php echo $data['tgl_kembali']; ?><br>
                                                Tgl.Dikembalikan : <?php echo $data['tgl_dikembalikan']; ?><br>
                                                <?php 
                                                $tgl1 = new DateTime($data['tgl_kembali']);
                                                $tgl2 = new DateTime($data['tgl_dikembalikan']);

                                                //$tgl1 = new DateTime("2020-01-01");
                                                //$tgl2 = new DateTime("2020-01-05");

                                                if($tgl1>$tgl2){
                                                            
                                                }else{
                                                    $jarak = $tgl2->diff($tgl1);
                                                   
                                                    echo "  Total Denda ".$jarak->d." Hari :".rprupiah($jarak->d*1000);
                                                   
                                                }
                                               ?>
                                                </td>

                                                      <td>
                                                      <span class="badge light badge-success ml-3">
														<i class="fa fa-circle text-success mr-1"></i>
														di Kembalikan
													</span>
                                                      </td>   
                                                
                                            </tr>

                                        <?php
                                        }
                                        ?>

									</tbody>
                                    </table>
	<!-- sisswa-->								<?PHP
}else  {
?>
<table class="table header-border" onclick="print()">
                                        <thead>
                                            <tr  class="thead-primary">
											<th>No</th>
											<th>NISN</th>
											<th>Nama</th>
                                            <th>No.Whatsapp</th>
											<th>Tgl.Lahir</th>
											<th>Kelas</th>
											<th>Alamat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$no = 1;
										$sql = $koneksi->query("select * from tb_siswa ");
										while ($data = $sql->fetch_assoc()) {
										?>
											<tr>
												<td>
													<?php echo $no++; ?>
												</td>
												<td>
											
													<?php echo $data['nisn']; ?>

												</td>
												<td class="sorting_1">
												
													<?php echo $data['nama']; ?><br>
													<?php echo $data['jk']; ?>
													

												</td>
												<td>
													<?php echo $data['nowa']; ?>
												</td>
                                                <td>
													<?php echo $data['tgl_lahir']; ?>
												</td>
												<td>
													<?php echo $data['kelas']; ?>
												</td>
												<td>
												<?php echo $data['alamat']; ?>
												</td>
												

											</tr>

										<?php
										}
										?>
									</tbody>
                                    </table>


		<?PHP
}
?>

  <div>
  
	  <?php
    $tgl = date("d/M/Y");
?>
<hr color="#eee" /> 
</div>
    <div id="judull" class ="text-right mt-4 mb-4">

   
<text class="mr-4">Serang, <?=$tgl;?></text><br />
<text class="mr-4">Set.<?php if($data_level=="1"){echo 'Administrator'; }else{ echo 'Petugas'; } ?></text><br/><br/><br/>
<text class="mr-2">____________________ </text><br />
<text class="mr-5"><?=$data_nama;?> </text><br />
</div>
</div>
 
 </div>

 

	  
<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>

</body>

</html>

