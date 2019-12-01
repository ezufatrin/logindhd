<?php

session_start();
error_reporting(0);
include('includes/config.php');
include('proses.php');
if(strlen($_SESSION['alogin'])==0)
	{
header('location:index.php');
}
else{

	$email = $_SESSION['alogin'];
	$sql = "SELECT * from users where email = (:email);";
	$query = $dbh -> prepare($sql);
	$query-> bindParam(':email', $email, PDO::PARAM_STR);
	$query->execute();
	$result=$query->fetch(PDO::FETCH_OBJ);
	$cnt=1;
	$idedit = $result->id;

	// $sql = "SELECT COUNT(id) FROM kolam WHERE status='Aktif' AND id_pemilik = ".$idedit." AND jenis = 'Plasma'";
	// $hasil = mysqli_query($db, $sql);

	// if (mysqli_num_rows($hasil) > 0)
	// {
	// 	while($row = mysqli_fetch_assoc($hasil))
	// 	{
	// 	   $jumlahKolamPlasma = $row['COUNT(id)'];
	// 	   $idKolamPlasma;
	// 	}
	// }
	// $sql = "SELECT COUNT(id) FROM kolam WHERE status='Aktif' AND id_pemilik = ".$idedit." AND jenis = 'Mandiri'";
	// $hasil = mysqli_query($db, $sql);

	// if (mysqli_num_rows($hasil) > 0)
	// {
	// 	while($row = mysqli_fetch_assoc($hasil))
	// 	{
	// 	   $jumlahKolamMandiri = $row['COUNT(id)'];
	// 	}
	// }

	// $arrayIdKolamPlasma = $idKolamPlasma;
	// $arrayIdKolamMandiri = $idKolamMandiri;

	//data kolam plasma
	$sql = "SELECT id FROM kolam WHERE status='Aktif' AND id_pemilik = ".$idedit." AND jenis = 'Plasma'";
	$hasil = mysqli_query($db, $sql);
	if (mysqli_num_rows($hasil) > 0){			
		$s=0;
		while($row = mysqli_fetch_assoc($hasil))
		{
			$idKolamPlasma[$s] =  $row['id'];
			$s++;			
		}
		$arrayIdKolamPlasma = $idKolamPlasma;
		$jumlahKolamPlasma = count($idKolamPlasma);	
	
	}
	
	//data kolam mandiri
	$sql = "SELECT id FROM kolam WHERE status='Aktif' AND id_pemilik = ".$idedit." AND jenis = 'Mandiri'";
	$hasil = mysqli_query($db, $sql);
	if (mysqli_num_rows($hasil) > 0)
	{
		$s=0;
		while($row = mysqli_fetch_assoc($hasil))
		{
			$idKolamMandiri[$s] =  $row['id'];
			// Fill an array with count() number of elements with value 'id_state=?'
			// $kalimat = array_fill(0, 1, '');
			$kalimat = implode(" OR id_kolam= ",$idKolamMandiri);
			
			$s++;			
		}
		$arrayIdKolamMandiri = $idKolamMandiri;
		$jumlahKolamMandiri = count($idKolamMandiri);
	}

if(isset($_POST['submitKolam']))
{
	$inputanKolamPlasma = $_POST['kolamplasma'];
	$inputanKolamMandiri = $_POST['kolammandiri'];
	

	$sql = "SELECT * from kolam WHERE id_pemilik= ".$idedit;
	$ada = mysqli_query($db, $sql);
	if (mysqli_num_rows($ada) > 0)
	{
		if($inputanKolamPlasma==0 || $inputanKolamPlasma ==NULL){

		}
		else if($inputanKolamPlasma > $jumlahKolamPlasma || $inputanKolamPlasma == $jumlahKolamPlasma)
		{
			$inputanKolamPlasma = $inputanKolamPlasma - $jumlahKolamPlasma;
			for ($i = 1; $i <= $inputanKolamPlasma; $i++)
			{
				$sql="INSERT INTO kolam (jenis, id_pemilik, status) VALUES ('Plasma', '".$idedit."', 'Aktif')";
				mysqli_query($db, $sql);
			}
		}
		else{
			echo '<script type="text/javascript">alert("tidak bisa dikurangi")</script>';
		}

		if($inputanKolamMandiri==0 || $inputanKolamMandiri ==NULL){

		}
		else if($inputanKolamMandiri > $jumlahKolamMandiri || $inputanKolamMandiri == $jumlahKolamMandiri )
		{
			$inputanKolamMandiri = $inputanKolamMandiri - $jumlahKolamMandiri;
			for ($j = 1; $j <= $inputanKolamMandiri; $j++)
			{
				$sql="INSERT INTO kolam (jenis, id_pemilik, status) VALUES ('Mandiri', '".$idedit."', 'Aktif')";
				mysqli_query($db, $sql);
			}
		}
		else{
			echo '<script type="text/javascript">alert("tidak bisa dikurangi")</script>';
		}
	} else
	{
		for ($i = 1; $i <= $inputanKolamPlasma; $i++)
		{
			$sql="INSERT INTO kolam (jenis, id_pemilik, status) VALUES ('Plasma', '".$idedit."', 'Aktif')";
			mysqli_query($db, $sql);
		}
		for ($j = 1; $j <= $inputanKolamMandiri; $j++)
		{
			$sql="INSERT INTO kolam (jenis, id_pemilik, status) VALUES ('Mandiri', '".$idedit."', 'Aktif')";
			mysqli_query($db, $sql);
		}
	}



if(isset($_POST['submit']))
  { 
	$email = $_SESSION['alogin'];
	$sql = "SELECT * from users where email = (:email);";
	$query = $dbh -> prepare($sql);
	$query-> bindParam(':email', $email, PDO::PARAM_STR);
	$query->execute();
	$result=$query->fetch(PDO::FETCH_OBJ);
	$cnt=1;
	$idedit = $result->id;
	$file = $_FILES['image']['name'];	
	$tipe_file = $_FILES['image']['type'];
	$filesize = $_FILES['image']['size'];
	$folder="images/";	
	$tmp_file = $_FILES['image']['tmp_name'];		

	if($file)
	{		
		
		if($tipe_file == "image/jpeg" || $tipe_file == "image/png")
		{				
			//size image yang diinginkan
			$width_size = 400;     

			// tentukan di mana image akan ditempatkan setelah diupload
			$filesave = $folder . $file;
			move_uploaded_file($_FILES['image']['tmp_name'], $filesave);

			// menentukan nama image setelah dibuat
			$namabaru = uniqid(rand()) .".jpg";
			$resize_image = $folder.$namabaru ;	

			// mendapatkan ukuran width dan height dari image
			list( $width, $height ) = getimagesize($filesave);
			 
			// mendapatkan nilai pembagi supaya ukuran skala image yang dihasilkan sesuai dengan aslinya
			$k = $width / $width_size;
			 
			// menentukan width yang baru
			$newwidth = $width / $k;
			 
			// menentukan height yang baru
			$newheight = $height / $k;
			 
			// fungsi untuk membuat image yang baru
			$thumb = imagecreatetruecolor($newwidth, $newheight);
			if($tipe_file == "image/jpeg"){
				$source = imagecreatefromjpeg($filesave);
			}else if($tipe_file == "image/png"){
				$source = imagecreatefrompng($filesave);
			}
			if(imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height))
			{		
				if($tipe_file == "image/jpeg"){
					imagejpeg($thumb, $resize_image);
				}else if($tipe_file == "image/png"){
					imagepng($thumb, $resize_image);
				}							
				imagedestroy($thumb);
				imagedestroy($source);				
				unlink($folder.$result->image);	//menghapus foto user lama
				unlink($filesave); //menghapus foto asli yg baru
			} else {
				die("file terlalu besar");
			}	
		} else {
			$message = "Hanya file Gambar yang diizinkan (jpeg/png)";
			echo "<script>alert('$message');</script>";
		}
	} else {
		$namabaru=$result->image; //nama file baru adalah nama file lama, karena tidak ada foto yg diupload
	} 

	$name=$_POST['name'];
	$cabang=$_POST['cabang'];
	$ktp= preg_replace("/[^a-zA-Z0-9]/", "", $_POST['ktp']);
	$alamat=$_POST['alamat'];
	$kota=$_POST['kota'];
	$kecamatan=$_POST['kecamatan'];
	$kelurahan=$_POST['kelurahan'];
	$ban=$_POST['ban'];
	$norek=$_POST['norek'];
	$anrek=$_POST['anrek'];
	$email=$_POST['email'];
	$mobileno = preg_replace("/[^a-zA-Z0-9]/", "", $_POST['mobile']);
	$designation=$_POST['designation'];
	$idedit=$_POST['editid'];
	$referensi = $_POST['referensi'];


	$sql="UPDATE users SET name=(:name), email=(:email), cabang=(:cabang), ktp=(:ktp),alamat=(:alamat),kota=(:kota),kecamatan=(:kecamatan),kelurahan=(:kelurahan),ban=(:ban),norek=(:norek),anrek=(:anrek),mobile=(:mobileno), designation=(:designation), referensi=(:referensi), image=(:namabaru) WHERE id=(:idedit)";
	$query = $dbh->prepare($sql);
	$query-> bindParam(':name', $name, PDO::PARAM_STR);
	$query-> bindParam(':cabang', $cabang, PDO::PARAM_STR);
	$query-> bindParam(':ktp', $ktp, PDO::PARAM_STR);
	$query-> bindParam(':alamat', $alamat, PDO::PARAM_STR);
	$query-> bindParam(':kota', $kota, PDO::PARAM_STR);
	$query-> bindParam(':kecamatan', $kecamatan, PDO::PARAM_STR);
	$query-> bindParam(':kelurahan', $kelurahan, PDO::PARAM_STR);
	$query-> bindParam(':ban', $ban, PDO::PARAM_STR);
	$query-> bindParam(':norek', $norek, PDO::PARAM_STR);
	$query-> bindParam(':anrek', $anrek, PDO::PARAM_STR);
	$query-> bindParam(':email', $email, PDO::PARAM_STR);
	$query-> bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
	$query-> bindParam(':designation', $designation, PDO::PARAM_STR);
	$query-> bindParam(':namabaru', $namabaru, PDO::PARAM_STR);
	$query-> bindParam(':idedit', $idedit, PDO::PARAM_STR);
	$query-> bindParam(':referensi', $referensi, PDO::PARAM_STR);	
	$msg="Information Updated Successfully";
	if($query->execute()){
		$pesan = 1;
	} else {$pesan = 2;}
	
}

if(isset($_POST['monitorharian']))
{	
	$monitorPHAir = $_POST['phair'];
	$monitorSuhuAir = $_POST['suhuair'];
	$monitorKematian = $_POST['kematian'];
	$monitorBeratPakan = $_POST['beratpakan'];
	$monitorKondisiAir = $_POST['kondisiair'];
	$monitorKondisiIkan = $_POST['kondisiikan'];
	$monitorTanggal = $_POST['tanggalpengukuran'];
	$monitorIdKolam = $_POST['idkolam1'];

	$sql = "INSERT INTO monitor (suhu_air, ph_air, kematian, berat_pakan, kondisi_air, kondisi_ikan, tanggal, id_kolam) VALUES("
	.$monitorSuhuAir.",".$monitorPHAir.",".$monitorKematian.",".$monitorBeratPakan.",'".$monitorKondisiAir."','".$monitorKondisiIkan."','".$monitorTanggal."',".$monitorIdKolam.")";
	// die($sql);
	if(mysqli_query($db, $sql)){
		$pesan = 1;
	} else {$pesan = 2;}

	
}

if(isset($_POST['pasangkolam']))
{		

	$tanggalPasang = $_POST['tanggalpemasangan'];
	$IdKolam = $_POST['idkolam'];
	// echo ($tanggalPasang);
	// echo ($IdKolam);

	$sql = "UPDATE kolam SET tanggal_pasang='".$tanggalPasang."' WHERE id=".$IdKolam;	
	if(mysqli_query($db, $sql)){
		$pesan = 1;
	} else {$pesan = 2;}	
}

if(isset($_POST['bibitmasuk']))
{		
	$populasiBibit = $_POST['populasibibit'];
	$ukuranBibit = $_POST ['ukuranbibit'];
	$beratTotalBibit = $_POST['beratbibit'];
	$tanggalBibitMasuk = $_POST['tanggalmasuk'];
	$IdKolam = $_POST['idkolam'];

	$sql = "INSERT INTO bibit (berat, ukuran, populasi, tanggal_masuk, id_kolam) VALUES("
	.$beratTotalBibit.",".$ukuranBibit.",".$populasiBibit.",'".$tanggalBibitMasuk."',".$IdKolam.")";
	 if(mysqli_query($db, $sql)){
		 $$pesan = 1;
	 } else {$pesan = 2;}

	
}

if(isset($_POST['pakanmasuk']))
{	
	$beratPakan = $_POST['beratpakan'];
	$jenisPakan = $_POST['jenispakan'];
	$tanggalPakanMasuk = $_POST['tanggalmasuk'];
	$IdKolam = $_POST['idkolam'];

	$sql = "INSERT INTO pakan (jenis, berat, tanggal_masuk, id_kolam) VALUES("
	.$jenisPakan.",".$beratPakan.",'".$tanggalPakanMasuk."',".$IdKolam.")";
	// die($sql);
	if(mysqli_query($db, $sql)){
		$pesan = 1;
	} else {$pesan = 2;}

	
}

if(isset($_POST['panen']))
{	

	$beratPanen = $_POST['berattotal'];
	$jumlahIkanPanen = $_POST['populasi'];
	$tanggalPanen = $_POST['tanggalpanen'];
	$IdKolam = $_POST['idkolam'];

	$sql = "INSERT INTO panen (berat, populasi, tanggal_panen, id_kolam) VALUES("
	.$beratPanen.",".$jumlahIkanPanen.",'".$tanggalPanen."',".$IdKolam.")";
	// die($sql);
	if(mysqli_query($db, $sql)){
		$pesan = 1;
	} else {$pesan = 2;}
	
}
}


?>

<!doctype html>
<html lang="en" class="no-js">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	<title>ADMIN</title>
	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="icon" type="image/png" href="login/images/icons/favicon-dhd.png" />
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Style -->
	<link rel="stylesheet" href="css/style.css">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Icon -->
	<link rel="icon" type="image/png" href="login/images/icons/favicon-dhd.png" />
	<!-- Font Awesome -->
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Tempusdominus Bbootstrap 4 -->
	<link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- JQVMap -->
	<link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/adminlte.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
	<!-- summernote -->
	<link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/adminlte.min.css">

	<script type= "text/javascript" src="../vendor/countries.js"></script>
	<style>
	.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
	background: #dd3d36;
	color:#fff;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
	background: #5cb85c;
	color:#fff;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}

.wadahgambar {
    width: 150px;
    height: 100px;
    background-image: url("http://i.stack.imgur.com/2OrtT.jpg");
    background-size: cover;
    background-repeat: no-repeat;
	background-position: 50% 50%;

}

		</style>
		
</head>

<body>



<?php

	// $email = $_SESSION['alogin'];
	// $sql = "SELECT * from users where email = (:email);";
	// $query = $dbh -> prepare($sql);
	// $query-> bindParam(':email', $email, PDO::PARAM_STR);
	// $query->execute();
	// $result=$query->fetch(PDO::FETCH_OBJ);
	// $cnt=1;
	// $idedit = $result->id;
	
	// //data kolam plasma
	// $sql = "SELECT id FROM kolam WHERE status='Aktif' AND id_pemilik = ".$idedit." AND jenis = 'Plasma'";
	// $hasil = mysqli_query($db, $sql);
	// if (mysqli_num_rows($hasil) > 0){			
	// 	$s=0;
	// 	while($row = mysqli_fetch_assoc($hasil))
	// 	{
	// 		$idKolamPlasma[$s] =  $row['id'];
	// 		$s++;			
	// 	}
	// }
	
	// //data kolam mandiri
	// $sql = "SELECT id FROM kolam WHERE status='Aktif' AND id_pemilik = ".$idedit." AND jenis = 'Mandiri'";
	// $hasil = mysqli_query($db, $sql);
	// if (mysqli_num_rows($hasil) > 0)
	// {
	// 	$s=0;
	// 	while($row = mysqli_fetch_assoc($hasil))
	// 	{
	// 		$idKolamMandiri[$s] =  $row['id'];
	// 		// Fill an array with count() number of elements with value 'id_state=?'
	// 		// $kalimat = array_fill(0, 1, '');
	// 		$kalimat = implode(" OR id_kolam= ",$idKolamMandiri);
			
	// 		$s++;			
	// 	}
	// }

	// $arrayIdKolamPlasma = $idKolamPlasma;
	// $arrayIdKolamMandiri = $idKolamMandiri;


?>


 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>ADMIN</h1>
          </div>		  
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
			
          </div>
		  
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-info card-outline" >
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="images/<?php echo htmlentities($result->image);?>"
                       alt="User profile picture" style="width:100px; height:100px; border-radius:50%; margin:10px;  object-fit: cover; ">
				</div>
                <h3 class="profile-username text-center"><?php echo htmlentities($result->name);?></h3>

                <p class="text-muted text-center"><?php echo "Mitra ".htmlentities($result->cabang);?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Kolam Plasma</b> <a class="float-right"><?php echo $jumlahKolamPlasma; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Kolam Mandiri</b> <a class="float-right"><?php echo $jumlahKolamMandiri; ?></a>
                  </li>

                </ul>

				<!-- <a href="ubahdata.php" class="btn btn-info btn-block"><b>Ubah data kolam</b></a> -->
				<a class="btn btn-info btn-block" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
				Ubah data kolam</a>
				<div class="collapse" id="collapseExample">
					<div class="card card-body">
						<form method="POST">
						<div class="text-center"> 
								<label class="mt-2">Jumlah Kolam Plasma</label>
								<input type="number" name="kolamplasma" class="form-control" min="1" max="100" oninvalid="this.setCustomValidity('Tidak Boleh lebih dari 100')">

								<label class="mt-2">Jumlah Kolam Mandiri</label>
								<input type="number" name="kolammandiri" class="form-control" min="1" max="100" oninvalid="this.setCustomValidity('Tidak Boleh lebih dari 100')">

								<input class="mt-3  pt-2 pb-2 btn btn-info" type="submit" name="submitKolam" value="Input Data Kolam">	
							</div>
							
						</form>
					</div>
				</div>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Biodata Mitra</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Nama</strong>
                <p class="text-muted"><?php echo htmlentities($result->name);?></p>

                <strong><i class="fas fa-id-card mr-1"></i> No KTP</strong>
				<p class="text-muted"><?php echo htmlentities($result->ktp);?></p>

				<strong><i class="fas fa-map-marked-alt mr-1"></i> Cabang Pelayanan</strong>
				<p class="text-muted"><?php echo htmlentities($result->cabang);?></p>

				<strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>
				<p class="text-muted"><?php echo htmlentities($result->alamat).", ".htmlentities($result->kelurahan).", ".htmlentities($result->kecamatan).", ".htmlentities($result->kota);?></p>

					<strong><i class="fas fa-envelope mr-1"></i> Email</strong>
				<p class="text-muted"><?php echo htmlentities($result->email);?></p>

				<strong><i class="fas fa-mobile-alt mr-1"></i> No Hp</strong>
				<p class="text-muted"><?php echo htmlentities($result->mobile);?></p>

				<strong><i class="fas fa-money-check-alt mr-1"></i> Data Rek Bank</strong>
                <p class="text-muted"><?php echo "Bank: ".htmlentities($result->ban)."<br>No Rek: ".htmlentities($result->norek)."<br>Atas Nama: ".htmlentities($result->anrek);?></p>
				</span>

			  </div class="width-10"><!-- /.card-body -->
				<!-- <button class="ml-3 mr-3 mb-1 btn bg-info" href="logout.php">Logout</button> -->
				<a href="logout.php" class="button ml-5 mr-5 mb-1 btn bg-info">Log Out</a>	
			</div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
					<li class="nav-item"><a class="nav-link active" href="#inputdata" data-toggle="tab">Input Data</a></li>			
						
					<li class="nav-item"><a class="nav-link" href="#ubahbiodata" data-toggle="tab">Ubah Biodata</a></li>
                </ul>
              </div><!-- /.card-header -->
              	<div class="card-body">
					<div class="tab-content mb-5">
<!-- INPUT DATA -->		
                        <div class="active tab-pane" id="inputdata">
							<!-- Input Data Harian -->
							<a class="btn btn-info btn-block mb-1" data-toggle="collapse" href="#collapseHarian" role="button" aria-expanded="false" aria-controls="collapseExample">
							Input Data Harian</a>
							<div class="collapse" id="collapseHarian">
								<div class="card card-body">
									<form method="POST">										
											<div class="wrap-input100"  >
												<label class="mt-2">Kode Kolam</label>
												<select class="form-control" value="" name="idkolam">												
													<?php for($i=0; $i<$jumlahKolamMandiri; $i++){ ?>												
															<option name="idkolam1" value ="<?php echo $arrayIdKolamMandiri[$i]; ?>" id=""><?php echo "Kode Kolam Mandiri: ".$arrayIdKolamMandiri[$i]; ?></option>
													<?php } ?>	
												</select>									
											</div>

											<label class="mt-2">PH Air</label>
											<input type="number" name="phair" class="form-control" min="0" max="14" Placeholder = "Nilai Angka 0-14" required >

											<label class="mt-2">Suhu Air</label>
											<input type="number" name="suhuair" class="form-control" min="1" max="100"  Placeholder = "Nilai Angka 0-100" required >
											
											<label class="mt-2">Kematian</label>
											<input type="number" name="kematian" class="form-control" min="0"  Placeholder = "Nilai Minimum 0" required >

											<label class="mt-2">Berat Pakan</label>
											<input type="number" name="beratpakan" class="form-control" Placeholder = "Berat pakan dalam gram" required >
											
											<label class="mt-2">Kondisi Air</label>
											<input type="text" name="kondisiair" class="form-control" Placeholder = "Deskripsikan keadaan air saat ini" required >

											<label class="mt-2">Kondisi Ikan</label>
											<input type="text" name="kondisiikan" class="form-control"  Placeholder = "Deskripsikan keadaan ikan saat ini" required >
											
											<label class="mt-2">Tanggal Pengukuran</label>
											<input type="date" name="tanggalpengukuran" class="form-control"required >

											<input class="mt-3  pt-2 pb-2 btn btn-info" type="submit" name="monitorharian" value="Input Data">	
									</form>
								</div>		
							</div>

							<!-- Input Data Pemasangan Kolam -->
							<a class="btn btn-info btn-block mb-1" data-toggle="collapse" href="#collapsePasangKolam" role="button" aria-expanded="false" aria-controls="collapseExample">
							Input Data Pemasangan Kolam</a>
							<div class="collapse" id="collapsePasangKolam">
								<div class="card card-body">
										<form method="POST">										
										<div class="wrap-input100"  >
												<label class="mt-2">Kode Kolam</label>
												<select class="form-control" value="" name="idkolam">												
													<?php for($i=0; $i<$jumlahKolamMandiri; $i++){ ?>												
															<option name="idkolam1" value ="<?php echo $arrayIdKolamMandiri[$i]; ?>" id=""><?php echo "Kode Kolam Mandiri: ".$arrayIdKolamMandiri[$i]; ?></option>
													<?php } ?>	
												</select>									
											</div>

												<label class="mt-2">Tanggal Pemasangan</label>
												<input type="date" name="tanggalpemasangan" class="form-control" >

												<input class="mt-3  pt-2 pb-2 btn btn-info" type="submit" name="pasangkolam">	
										</form>
									</div>
							</div>

							<!-- Input Data Masuk Bibit-->
							<a class="btn btn-info btn-block mb-1" data-toggle="collapse" href="#collapseBibitMasuk" role="button" aria-expanded="false" aria-controls="collapseExample">
							Input Data Bibit Masuk</a>
							<div class="collapse" id="collapseBibitMasuk">
								<div class="card card-body">
								
										<form method="POST">										
												<div class="wrap-input100"  >
													<label class="mt-2">Kode Kolam</label>
													<select class="form-control" value="" name="idkolam">												
														<?php for($i=0; $i<$jumlahKolamMandiri; $i++){ ?>												
																<option name="idkolam1" value ="<?php echo $arrayIdKolamMandiri[$i]; ?>" id=""><?php echo "Kode Kolam Mandiri: ".$arrayIdKolamMandiri[$i]; ?></option>
														<?php } ?>	
													</select>									
												</div>

												<label class="mt-2">Populasi</label>
												<input type="number" name="populasibibit" class="form-control" Placeholder = "Jumlah bibit" required >
												
												<label class="mt-2">Ukuran Bibit</label>
												<input type="number" name="ukuranbibit" class="form-control" placeholder = "Ukuran bibit (cm)" required >
											
												<label class="mt-2">Berat Total Bibit</label>
												<input type="number" name="beratbibit" class="form-control" Placeholder = "Berat total bibit (kg)" required >
											
												<label class="mt-2">Tanggal Masuk</label>
												<input type="date" name="tanggalmasuk" class="form-control" required >

												<input class="mt-3  pt-2 pb-2 btn btn-info" type="submit" name="bibitmasuk" value="Input Data">	
										</form>
									</div>
							</div>

							<!-- Input Data Masuk Pakan-->
							<a class="btn btn-info btn-block mb-1" data-toggle="collapse" href="#collapsePakanMasuk" role="button" aria-expanded="false" aria-controls="collapseExample">
							Input Data Pakan Masuk</a>
							<div class="collapse" id="collapsePakanMasuk">
								<div class="card card-body">
										<form method="POST">										
										<div class="wrap-input100"  >
												<label class="mt-2">Kode Kolam</label>
													<select class="form-control" value="" name="idkolam">												
														<?php for($i=0; $i<$jumlahKolamMandiri; $i++){ ?>												
																<option name="idkolam1" value ="<?php echo $arrayIdKolamMandiri[$i]; ?>" id=""><?php echo "Kode Kolam Mandiri: ".$arrayIdKolamMandiri[$i]; ?></option>
														<?php } ?>	
													</select>									
												</div>

												<label class="mt-2">Jenis Pakan</label>
												<input type="number" name="jenispakan" class="form-control" Placeholder = "Jenis pakan" required >
												
												<label class="mt-2">Jumlah Pakan Masuk</label>
												<input type="number" name="beratpakan" class="form-control" Placeholder = "Berat Pakan (kg)" required >
											
												<label class="mt-2">Tanggal Masuk</label>
												<input type="date" name="tanggalmasuk" class="form-control" required >

												<input class="mt-3  pt-2 pb-2 btn btn-info" type="submit" name="pakanmasuk" value="Input Data">	
										</form>
									</div>
							</div>


							<!-- Input Data Panen-->
							<a class="btn btn-info btn-block mb-1" data-toggle="collapse" href="#collapsePanen" role="button" aria-expanded="false" aria-controls="collapseExample">
							Input Data Panen</a>
							<div class="collapse" id="collapsePanen">
								<div class="card card-body">
										<form method="POST">										
											<div class="wrap-input100"  >
												<label class="mt-2">Kode Kolam</label>
												<select class="form-control" value="" name="idkolam">												
													<?php for($i=0; $i<$jumlahKolamMandiri; $i++){ ?>												
															<option name="idkolam1" value ="<?php echo $arrayIdKolamMandiri[$i]; ?>" id=""><?php echo "Kode Kolam Mandiri: ".$arrayIdKolamMandiri[$i]; ?></option>
													<?php } ?>	
												</select>									
											</div>

												<label class="mt-2">Berat Total</label>
												<input type="number" name="berattotal" class="form-control" Placeholder = "Berat total panen (kg)" required >
												
												<label class="mt-2">Jumlah Ikan</label>
												<input type="number" name="populasi" class="form-control" Placeholder = "Jumlah ikan" required >
											
												<label class="mt-2">Tanggal Panen</label>
												<input type="date" name="tanggalpanen" class="form-control" required >

												<input class="mt-3  pt-2 pb-2 btn btn-info" type="submit" name="panen" value="Input Data">	
										</form>
									</div>
							</div> 

						</div> <!-- PENUTUP INPUT DATA-->
				
<!-- UBAH BIODATA -->
						<div class="tab-pane" id="ubahbiodata">

							<form method="post" class="form-horizontal" enctype="multipart/form-data">
							<div class="col-sm-4 text-center">
									<img src="images/<?php echo htmlentities($result->image);?>" style="width:200px; height:200px; border-radius:50%; margin:10px; object-fit: cover; ">
								<input type="file" name="image" class="form-control">
								<input type="hidden" name="image" class="form-control" value="<?php echo htmlentities($result->image);?>">
							</div>

							<label class="col-sm-2 control-label">Cabang<span style="color:red">*</span></label>
							<div class="wrap-input100 validate-input col-sm-4"  >
								<select name="cabang"  class="form-control" required>                                                    
									<option selected="selected" style="display:none; color:red" value="<?php echo htmlentities($result->cabang);?>"><?php echo htmlentities($result->cabang);?></option>
									<option value="Palembang">Palembang</option>
									<option value="Jambi">Jambi</option>
									<option value="Prabumulih">Prabumulih</option>
									<option value="Pali">Pali</option>
									<option value="Keluang">Keluang</option>
									<option value="Sungai Lilin">Sungai Lilin</option>
									<option value="Prajen">Prajen</option>
									<option value="Muaratara/Linggau">Muaratara/Linggau</option>
									<option value="Banyuasin/Pangkalan Balai">Banyuasin/Pangkalan Balai</option>
									<option value="Baturaja">Baturaja</option>
									<option value="Pagar Alam">Pagar Alam</option>
									<option value="Muara Enim">Muara Enim</option>
								</select>
								<!-- <input type="text" name="cabang" class="form-control" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" value="<?php echo htmlentities($result->cabang);?>"> -->
							</div>

							<label class="col-sm-2 control-label">Nama<span style="color:red">*</span></label>
							<div class="wrap-input100 validate-input col-sm-4"  >
							<input type="text" name="name" class="form-control" required Placeholder = "Nama lengkap" value="<?php echo htmlentities($result->name);?>">
							</div>

							<label class="col-sm-2 control-label">No KTP<span style="color:red">*</span></label>
							<div class="wrap-input100 validate-input col-sm-4"  >
							<input type="text" name="ktp" id="ktp" class="form-control" placeholder="0000-0000-0000-0000" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" value="<?php echo htmlentities($result->ktp);?>">
							</div>

							<label class="col-sm-2 control-label">Alamat<span style="color:red">*</span></label>
							<div class="wrap-input100 validate-input col-sm-4"  >
							<input type="text" name="alamat" class="form-control" required Placeholder = "Alamat tanpa nama kelurahan dan kota"   value="<?php echo htmlentities($result->alamat);?>">
							</div>

							<label class="col-sm-2 control-label">Kota<span style="color:red">*</span></label>
							<div class="wrap-input100 validate-input col-sm-4"  >
							<input type="text" name="kota" class="form-control" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" value="<?php echo htmlentities($result->kota);?>">
							</div>

							<label class="col-sm-2 control-label">Kecamatan<span style="color:red">*</span></label>
							<div class="wrap-input100 validate-input col-sm-4"  >
							<input type="text" name="kecamatan" class="form-control" Placeholder = "Masukan Kecamatan" required value="<?php echo htmlentities($result->kecamatan);?>">
							</div>

							<label class="col-sm-2 control-label">Kelurahan<span style="color:red">*</span></label>
							<div class="wrap-input100 validate-input col-sm-4"  >
							<input type="text" name="kelurahan" class="form-control" required Placeholder = "Masukan Kelurahan" value="<?php echo htmlentities($result->kelurahan);?>">
							</div>

							<label class="col-sm-2 control-label">Email<span style="color:red">*</span></label>
							<div class="wrap-input100 validate-input col-sm-4"  data-validate="Tidak Boleh Kosong">
							<input type="email" name="email" class="form-control" readonly required  value="<?php echo htmlentities($result->email);?>">
							</div>

							<label class="col-sm-2 control-label">No Hp<span style="color:red">*</span></label>
							<div class="wrap-input100 validate-input col-sm-4"  >
							<input type="text" name="mobile" class="form-control" id="mobile" required  value="<?php echo htmlentities($result->mobile);?>">
							</div>

							<label class="col-sm-2 control-label">Nama Panggilan<span style="color:red">*</span></label>
							<div class="wrap-input100 validate-input col-sm-4"  >
							<input type="text" name="designation" class="form-control" required value="<?php echo htmlentities($result->designation);?>">
							</div>

								<label class="col-sm-2 control-label">Bank<span style="color:red">*</span></label>
								<div class="wrap-input100 validate-input col-sm-4"  >
							<input type="text" name="ban" class="form-control" required  value="<?php echo htmlentities($result->ban);?>">
							</div>

							<label class="col-sm-2 control-label">No Rekening<span style="color:red">*</span></label>
							<div class="wrap-input100 validate-input col-sm-4"  >
							<input type="text" name="norek" class="form-control" required  value="<?php echo htmlentities($result->norek);?>">
							</div>

							<label class="col-sm-4 control-label">Nama Pemilik Rekening<span style="color:red">*</span></label>
							<div class="col-sm-4">
							<input type="text" name="anrek" class="form-control" required value="<?php echo htmlentities($result->anrek);?>">
							</div>

							<label class="col-sm-2 control-label">Tau DHD Dari<span style="color:red">*</span></label>
							<div class="wrap-input100 validate-input col-sm-4"  >
								<select name="referensi"  class="form-control" required> 
									<option value="Facebook">Facebook</option>
									<option value="Youtube">Youtube</option>
									<option value="Instagram">Instagram</option>
									<option value="Teman/Keluarga">Teman/Keluarga</option>
									<option value="Lainnya">Lainnya</option>
								</select>
								<!-- <input type="text" name="cabang" class="form-control" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" value="<?php echo htmlentities($result->cabang);?>"> -->
							</div>

							<input type="hidden" name="editid" class="form-control" required value="<?php echo htmlentities($result->id);?>">

							<div class="form-group mt-2">
							<div class="col-sm-8 col-sm-offset-2">
								<button class="btn btn-info" name="submit" type="submit">Simpan Perubahan</button>
							</div>
							</div>
							</form>
						</div> <!-- PENUTUP UBAH BIODATA-->

						</div>
						<!-- /.tab-content -->
					</div><!-- /.card-body -->				
				</div>
				<!-- /.nav-tabs-custom -->
			</div>
			<!-- /.col -->
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
		</section>
					<!-- /.content -->

					
	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/jquery.mask.min.js"></script>
	<script src="js/jqu.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
		setTimeout(function() {
			$('.succWrap').slideUp("slow");
		}, 3000);
		});
	</script>
	<script src="js/jquery-1.9.0.min.js"></script>
	<!--<script src="js/jquery.maskedinput.js"></script>-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js" integrity="sha256-fvFKHgcKai7J/0TM9ekjyypGDFhho9uKmuHiFVfScCA=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js" integrity="sha256-+4KHeBj6I8jAKAU8xXRMXXlH+sqCvVCoK5GAFkmb+2I=" crossorigin="anonymous"></script>
	
	
	<script type="text/javascript">
		$(function() {
			$("#mobile").mask("0899-9999-99999",{autoclear:false});
			$("#ktp").mask("9999-9999-9999-9999",{autoclear:false});
			
		});

	
		$("form input[type=text]").on("change invalid", function() {
			var textfield = $(this).get(0);
			
			// hapus dulu pesan yang sudah ada
			textfield.setCustomValidity("");
			
			if (!textfield.validity.valid) {
			textfield.setCustomValidity("Tidak boleh kosong!");  
			}
		});


		
	</script>



	
<div class="footer bg-warning pt-1  pl-1 pr-1">
  <p>Aplikasi ini Masih Dalam Tahapan Pengembangan<br>Masih masa uji coba</p>
</div>



</body>
</html>
<?php } ?>


<style>
.footer {
font-size: 16px;
font-weight: bold;
   position: fixed;
   left: 0;
   height : 60px;
   bottom: 0;
   width: 100%;  
   text-align: center;   
}
</style>