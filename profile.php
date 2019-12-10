<?php

session_start();
error_reporting(0);
include('includes/config.php');
include('proses.php');
if(strlen($_SESSION['alogin'])==0)
	{
header('location:login.php');
}
else{

if(isset($_POST['submitJumlahKolamMitra']))
{
	
	$email = $_SESSION['alogin'];
	$sql = "SELECT DISTINCT * from users where email = (:email);";
	$query = $dbh -> prepare($sql);
	$query-> bindParam(':email', $email, PDO::PARAM_STR);
	$query->execute();
	$result=$query->fetch(PDO::FETCH_OBJ);
	$cnt=1;
	$idedit = $result->id;
	
	//data kolam plasma
	$sql = "SELECT DISTINCT id FROM kolam WHERE status='Terpasang' AND id_pemilik = ".$idedit." AND jenis = 'Plasma'";
	$hasil = mysqli_query($db, $sql);
	if (mysqli_num_rows($hasil) > 0){			
		$s=0;
		while($row = mysqli_fetch_assoc($hasil))
		{
			$idKolamPlasma[$s] =  $row['id'];
			$NomorKolamPlasma[$s] =  $s+1;
			$s++;			
		}
		$arrayNomorKolamPlasma =  $NomorKolamPlasma;
		$arrayIdKolamPlasma = $idKolamPlasma;
		$jumlahKolamPlasma = count($idKolamPlasma);
	}
	
	//data kolam mandiri
	$sql = "SELECT DISTINCT id FROM kolam WHERE status='Terpasang' AND id_pemilik = ".$idedit." AND jenis = 'Mandiri'";
	$hasil = mysqli_query($db, $sql);
	if (mysqli_num_rows($hasil) > 0)
	{
		$s=0;
		while($row = mysqli_fetch_assoc($hasil))
		{
			$idKolamMandiri[$s] =  $row['id'];
			$NomorKolamMandiri[$s] =  $s+1;
			$s++;		
			// Fill an array with count() number of elements with value 'id_state=?'
			// $kalimat = array_fill(0, 1, '');
			// $kalimat = implode(" OR id_kolam= ",$idKolamMandiri);
			
				
		}
		$arrayNomorKolamMandiri =  $NomorKolamMandiri;
		$arrayIdKolamMandiri = $idKolamMandiri;
		$jumlahKolamMandiri = count($idKolamMandiri);
	}
	$sql = "SELECT DISTINCT jumlah_kolam_plasma, jumlah_kolam_mandiri FROM users Where id = ".$idedit."";
	$hasil = mysqli_query($db, $sql);
	if (mysqli_num_rows($hasil) > 0)
	{
		while($row = mysqli_fetch_assoc($hasil))
		{
			$jumlahKolamPlasmaInputanMitra = $row['jumlah_kolam_plasma'];
			$jumlahKolamMandiriInputanMitra = $row['jumlah_kolam_mandiri'];
		}
		
	}


	$inputanKolamPlasma = $_POST['kolamplasma'];
	$inputanKolamMandiri = $_POST['kolammandiri'];	
	if($inputanKolamPlasma=="" || $inputanKolamPlasma==0){
		$inputanKolamPlasma = $jumlahKolamPlasmaInputanMitra;
	}
	if($inputanKolamMandiri=="" || $inputanKolamMandiri==0){
		$inputanKolamMandiri = $jumlahKolamMandiriInputanMitra;
	}

	$sql="UPDATE users set jumlah_kolam_plasma=".$inputanKolamPlasma.", jumlah_kolam_mandiri=".$inputanKolamMandiri." WHERE id= ".$idedit;
	mysqli_query($db, $sql);
	
	$sql = "SELECT DISTINCT jumlah_kolam_plasma, jumlah_kolam_mandiri FROM users Where id = ".$idedit."";
	$hasil = mysqli_query($db, $sql);
	if (mysqli_num_rows($hasil) > 0)
	{
		while($row = mysqli_fetch_assoc($hasil))
		{
			$jumlahKolamPlasmaInputanMitra = $row['jumlah_kolam_plasma'];
			$jumlahKolamMandiriInputanMitra = $row['jumlah_kolam_mandiri'];
		}
		
	}

	
}


if(isset($_POST['submit']))
{ 
	$email = $_SESSION['alogin'];
	$sql = "SELECT DISTINCT * from users where email = (:email);";
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

	// var_dump($_POST); die();
	$monitorPHAir = $_POST['phair'];
	$monitorSuhuAir = $_POST['suhuair'];
	$monitorKematian = $_POST['kematian'];
	$monitorBeratPakan = $_POST['beratpakan'];
	$monitorKondisiAir = $_POST['kondisiair'];
	$monitorKondisiIkan = $_POST['kondisiikan'];
	$monitorTanggal = $_POST['tanggalpengukuran'];
	$monitorIdKolam = $_POST['idkolam'];

	$sql = "INSERT INTO monitor (suhu_air, ph_air, kematian, berat_pakan, kondisi_air, kondisi_ikan, tanggal, id_kolam) VALUES("
	.$monitorSuhuAir.",".$monitorPHAir.",".$monitorKematian.",".$monitorBeratPakan.",'".$monitorKondisiAir."','".$monitorKondisiIkan."','".$monitorTanggal."',".$monitorIdKolam.")";
	// die($sql);
	if(mysqli_query($db, $sql)){
		$pesan = 1;		
	} else {$pesan = 2;}	
	
}

if(isset($_POST['pasangkolam']))
{	


	$tanggalBooking = $_POST['tanggalbooking'];
	$tanggalPasang = $_POST['tanggalpemasangan'];
	$tanggalPenyelesaian = $_POST['tanggalpenyelesaian'];
	$IdKolam = $_POST['idkolam'];

	
	if (!$tanggalBooking==""){
		$sql = "UPDATE kolam SET tanggal_booking='".$tanggalBooking."' WHERE id=".$IdKolam;	
		if(mysqli_query($db, $sql)){
			$pesan = 1;
		} else {$pesan = 2;}	
	}
	if (!$tanggalPasang==""){
		$sql = "UPDATE kolam SET tanggal_pasang='".$tanggalPasang."' WHERE id=".$IdKolam;
		if(mysqli_query($db, $sql)){
			$pesan = 1;
		} else {$pesan = 2;}		
	}
	if (!$tanggalPenyelesaian==""){
		$sql = "UPDATE kolam SET tanggal_penyelesaian='".$tanggalPenyelesaian."' WHERE id=".$IdKolam;
		if(mysqli_query($db, $sql)){
			$pesan = 1;
		} else {$pesan = 2;}		
	}

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
if(isset($_POST['sampling']))
{
	
	$populasiSampling = $_POST['populasisampling'];
	$ukuranSampling = $_POST['ukuransampling'];
	$beratSampling = $_POST['beratsampling'];
	
	$tanggalSampling = $_POST['tanggalsampling'];
	$IdKolam = $_POST['idkolam'];

	$sql = "INSERT INTO sampling (populasi, ukuran, berat, tanggal_sampling, id_kolam) VALUES("
	.$populasiSampling.",".$ukuranSampling.",".$beratSampling.",'".$tanggalSampling."',".$IdKolam.")";
	// die($sql);
	if(mysqli_query($db, $sql)){
		$pesan = 1;
	} else {$pesan = 2;}
	unset($_POST);
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
	<title>Edit Profile</title>
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

		
</head>

<body>
<?php


$email = $_SESSION['alogin'];
$sql = "SELECT DISTINCT * from users where email = (:email);";
$query = $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query->execute();
$result=$query->fetch(PDO::FETCH_OBJ);
$cnt=1;
$idedit = $result->id;

//data kolam plasma
$sql = "SELECT DISTINCT id FROM kolam WHERE status='Terpasang' AND id_pemilik = ".$idedit." AND jenis = 'Plasma'";
$hasil = mysqli_query($db, $sql);
if (mysqli_num_rows($hasil) > 0){			
	$s=0;
	while($row = mysqli_fetch_assoc($hasil))
	{
		$idKolamPlasma[$s] =  $row['id'];
		$NomorKolamPlasma[$s] =  $s+1;
		$s++;			
	}
	$arrayNomorKolamPlasma =  $NomorKolamPlasma;
	$arrayIdKolamPlasma = $idKolamPlasma;
	$jumlahKolamPlasma = count($idKolamPlasma);
}

//data kolam mandiri
$sql = "SELECT DISTINCT id,tanggal_pasang FROM kolam WHERE status='Terpasang' AND id_pemilik = ".$idedit." AND jenis = 'Mandiri'";
$hasil = mysqli_query($db, $sql);
if (mysqli_num_rows($hasil) > 0)
{
	$s=0;
	while($row = mysqli_fetch_assoc($hasil))
	{
		$idKolamMandiri[$s] =  $row['id'];
		$cekTanggalPasang[$s] = $row['tanggal_pasang'];
		$NomorKolamMandiri[$s] =  $s+1;
		$s++;		

	}

	$arrayNomorKolamMandiri =  $NomorKolamMandiri;
	$arrayIdKolamMandiri = $idKolamMandiri;
	$jumlahKolamMandiri = count($idKolamMandiri);
}

//data kolam inputan Mitra
$sql = "SELECT DISTINCT jumlah_kolam_plasma, jumlah_kolam_mandiri FROM users Where id = ".$idedit."";
$hasil = mysqli_query($db, $sql);
if (mysqli_num_rows($hasil) > 0)
{
	while($row = mysqli_fetch_assoc($hasil))
	{
		$jumlahKolamPlasmaInputanMitra = $row['jumlah_kolam_plasma'];
		$jumlahKolamMandiriInputanMitra = $row['jumlah_kolam_mandiri'];
	}
	
}


//ID Mitra
$idedit;

//ambil ID tiap kolam
$idKolamMandiri;
$idKolamPlasma;

//data sampling mandiri
          for ($q=0; $q < $jumlahKolamMandiri; $q++) 
          { 
            $kumpulan_id_kolam .= "id_kolam= " .$idKolamMandiri[$q] . ' OR  ';
          }

          $sql = "SELECT DISTINCT * FROM sampling Where ". substr($kumpulan_id_kolam, 0, -5);

          $hasil = mysqli_query($db, $sql);
          if (mysqli_num_rows($hasil) > 0)
          {
            $q=0;
            while($row = mysqli_fetch_assoc($hasil))
            {
              $dataSampling[$q] = array( 
                'populasi' => $row['populasi'], 
                'ukuran' => $row['ukuran'], 
                'berat' => $row['berat'], 
                'id_kolam' => $row['populasi'], 
                'tanggal_sampling' => $row['tanggal_sampling'], 
              );
            $q++;	
            }	
          }
          $dataSamplingMandiri = $dataSampling;

//data sampling plasma
          for ($q=0; $q < $jumlahKolamPlasma; $q++) 
          { 
            $kumpulan_id_kolam .= "id_kolam= " .$idKolamPlasma[$q] . ' OR  ';
          }

          $sql = "SELECT DISTINCT * FROM sampling Where ". substr($kumpulan_id_kolam, 0, -5);

          $hasil = mysqli_query($db, $sql);
          if (mysqli_num_rows($hasil) > 0)
          {
            $q=0;
            while($row = mysqli_fetch_assoc($hasil))
            {
              $dataSampling[$q] = array( 
                'populasi' => $row['populasi'], 
                'ukuran' => $row['ukuran'], 
                'berat' => $row['berat'], 
                'id_kolam' => $row['populasi'], 
                'tanggal_sampling' => $row['tanggal_sampling'], 
              );
            $q++;	
            }	
          }
          $dataSamplingPlasma = $dataSampling;

//data pemasangan kolam
$sql = "SELECT DISTINCT * kolam WHERE  id_pemilik = ".$idedit;
$hasil = mysqli_query($db, $sql);
while($row = mysqli_fetch_assoc($hasil)){
  $idKolam = $row['id'];
  $jenisKolam = $row['jenis'];
  $jenisKolam = $row['tanggal_booking'];
  $jenisKolam = $row['tanggal_pasang'];
  $jenisKolam = $row['tanggal_penyelesaian'];
  $idPemilik = $row['id_pemilik'];
}

//data panen
$sql = "SELECT DISTINCT * panen WHERE  id_pemilik = ".$idedit;
$hasil = mysqli_query($db, $sql);
while($row = mysqli_fetch_assoc($hasil)){
  $idKolam = $row['id'];
  $jenisKolam = $row['jenis'];
  $jenisKolam = $row['tanggal_booking'];
  $jenisKolam = $row['tanggal_pasang'];
  $jenisKolam = $row['tanggal_penyelesaian'];
  $idPemilik = $row['id_pemilik'];
}




$sql = "SELECT DISTINCT * FROM kolam WHERE  id_pemilik = ".$idedit;
$hasil = mysqli_query($db, $sql);

$DataKolam=array(); 

while ($dataKolam=mysqli_fetch_assoc($hasil)) {
 $x['id']=$dataKolam['id'];
 $x['jenis']=$dataKolam['jenis']; 
 $x['id_pemilik']=$dataKolam['id_pemilik'];
 $x['tanggal_booking']=$dataKolam['tanggal_booking'];
 $x['tanggal_pasang']=$dataKolam['tanggal_pasang'];
 $x['tanggal_penyelesaian']=$dataKolam['tanggal_penyelesaian'];
 $x['bibit']=array();
          $sqlBibit = "SELECT DISTINCT * FROM bibit WHERE id_kolam=".$dataKolam['id'];
          $hasilBibit = mysqli_query($db, $sqlBibit);

          while ($dataBibit=mysqli_fetch_assoc($hasilBibit)) {   
            $y['id']=$dataBibit['id'];
            $y['berat']=$dataBibit['berat'];
            $y['ukuran']=$dataBibit['ukuran'];
            $y['populasi']=$dataBibit['populasi'];
            $y['tanggal_masuk']=$dataBibit['tanggal_masuk'];
            $y['id_kolam']=$dataBibit['id_kolam'];
            array_push($x['bibit'], $y);}
            
  $x['sampling']=array();
          $sqlSampling = "SELECT DISTINCT * FROM sampling WHERE id_kolam=".$dataKolam['id'];
          $hasilSampling = mysqli_query($db, $sqlSampling);

          while ($dataSampling=mysqli_fetch_assoc($hasilSampling)) {   
            $y['id']=$dataSampling['id'];
            $y['populasi']=$dataSampling['populasi'];
            $y['ukuran']=$dataSampling['ukuran'];
            $y['berat']=$dataSampling['berat'];
            $y['tanggal_sampling']=$dataSampling['tanggal_sampling'];
            $y['id_kolam']=$dataSampling['id_kolam'];
            array_push($x['sampling'], $y);}
            
  $x['monitor']=array();
          $sqlMonitor = "SELECT DISTINCT * FROM monitor WHERE id_kolam=".$dataKolam['id']." ORDER BY `id` DESC";
          $hasilMonitor = mysqli_query($db, $sqlMonitor);

          while ($dataMonitor=mysqli_fetch_assoc($hasilMonitor)) {   
            $y['id']=$dataMonitor['id'];
            $y['suhu_air']=$dataMonitor['suhu_air'];
            $y['ph_air']=$dataMonitor['ph_air'];
            $y['kematian']=$dataMonitor['kematian'];
            $y['berat_pakan']=$dataMonitor['berat_pakan'];
            $y['kondisi_air']=$dataMonitor['kondisi_air'];
            $y['kondisi_ikan']=$dataMonitor['kondisi_ikan'];
            $y['tanggal']=$dataMonitor['tanggal'];
            $y['id_kolam']=$dataMonitor['id_kolam'];
            array_push($x['monitor'], $y);}
            
  $x['panen']=array();
          $sqlPanen = "SELECT DISTINCT * FROM panen WHERE id_kolam=".$dataKolam['id'];
          $hasilPanen = mysqli_query($db, $sqlPanen);

          while ($dataPanen=mysqli_fetch_assoc($hasilPanen)) {   
            $y['id']=$dataPanen['id'];
            $y['berat']=$dataPanen['suhu_air'];
            $y['populasi']=$dataPanen['ph_air'];
            $y['tanggal_panen']=$dataPanen['kematian'];
            $y['id_kolam']=$dataPanen['id_kolam'];
            array_push($x['panen'], $y);}
            
 // untuk menambah array setelah array yang terakhir
 array_push($DataKolam, $x);
}

echo '<pre>' . var_export($DataKolam, true) . '</pre>';

// $NoK=0; $No=0;
// 	for ($i=0; $i < COUNT($DataKolam); $i++) { 
// 		if($DataKolam[$i]['jenis']=="Plasma"){
// 			$No++;
// 			echo "mandiri: ".$No;
// 		}
// 		else if($DataKolam[$i]['jenis']=="Mandiri"){
// 			$NoK++;
// 			echo "plasma: ".$NoK;
// 		}
		
// 	}








// var_dump($dataSampling[0]);

// $jadijson=json_encode(array('foo'=>$dataSampling));
//  $jadiinjsonkearray2=json_decode($jadijson,TRUE);
//  foreach ($jadiinjsonkearray2['foo'] as $key => $value) {
//   echo $key .' '.$value['populasi'] .' '. $value['ukuran'] .'  '. $value['berat']. '  '. $value['tanggal_Sampling']. ''. $value['id_kolam'] .' <br>';
//  }
  if($pesan==1){
		echo "<div class='alert alert-success text-white' role='alert'>Data Berhasil Ditambahkan</div>";
	} else if($pesan==2){
		echo "<div class='alert alert-danger text-white' role='alert'>Data Gagal Ditambahkan</div>";
	} 						
	?>	
 <!-- Content Wrapper. Contains page content -->
 <!-- <div class="content-wrapper"> -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile Mitra</h1>
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
					<b>Kolam Plasma</b> <a class="float-right"> <?php if($jumlahKolamPlasmaInputanMitra==0){
						 echo $jumlahKolamPlasma; } else {echo $jumlahKolamPlasmaInputanMitra;} ?>
					</a>
                  </li>
                  <li class="list-group-item">
					<b>Kolam Mandiri</b> <a class="float-right"> <?php if($jumlahKolamMandiriInputanMitra==0){
						 echo $jumlahKolamMandiri; } else {echo $jumlahKolamMandiriInputanMitra;} ?>
					</a>
                  </li>
                </ul>

				<!-- <a href="ubahdata.php" class="btn btn-info btn-block"><b>Ubah data kolam</b></a> -->
				<a class="btn btn-info btn-block" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
				Ubah jumlah kolam</a>
				<div class="collapse" id="collapseExample">
					<div class="card card-body">
						<form method="POST">
						<div class="text-center"> 
								<label class="mt-2">Jumlah Kolam Plasma</label>
								<input type="number" name="kolamplasma" class="form-control" min="1" max="100" >

								<label class="mt-2">Jumlah Kolam Mandiri</label>
								<input type="number" name="kolammandiri" class="form-control" min="1" max="100" >

								<input class="mt-3  pt-2 pb-2 btn btn-info" type="submit" name="submitJumlahKolamMitra" value="Update jumlah Kolam">	
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
					<li class="nav-item"><a class="nav-link active" href="#dashboard" data-toggle="tab">Dashboard</a></li>
					<?php if($jumlahKolamMandiri>0){ ?>
					<li class="nav-item"><a class="nav-link" href="#inputdata" data-toggle="tab">Input Data</a></li>
					<?php } ?>
					<li class="nav-item"><a class="nav-link" href="#ubahbiodata" data-toggle="tab">Ubah Biodata</a></li>
                </ul>
              </div><!-- /.card-header -->
              	<div class="card-body mb-5">
					<div class="tab-content mb-5">
<!-- DASHBOARD -->
						<div class="active tab-pane" id="dashboard">
							<div class="container-fluid">
												
								<div class="row">
						
									<?php 		
									//TAMPILAN DASHBOARD
// tampilan mandiri							
									$NoMandiri=0; $NoPlasma=0;
									for ($i=0; $i < COUNT($DataKolam); $i++) 
									{ 
									if($DataKolam[$i]['jenis']=="Mandiri")
									{$NoMandiri++;?>				
									<div class="col-lg-6 col-12 h-75">									
										<!-- small box -->
										<div class="small-box bg-success ">
										<div class="inner">										
										<h3>Nomor Kolam : <?php echo $NoMandiri; ?></h3>
										<h5>Jenis Kolam: <?php echo $DataKolam[$i]['jenis'] ?></h5>
										<?php  if(!($DataKolam[$i]['tanggal_penyelesaian'] == "0000-00-00")){																							
											}	
											else if( !($DataKolam[$i]['tanggal_pasang']=="0000-00-00")){
											
												echo" <h5 class='text-warning'>Status: Masa pemasangan <a class='text-light' data-toggle='collapse' href='#collapsePasangKolam".$i."' aria-controls='collapseExample'> --> ubah status</a><h5>";
											}
											else if( !($DataKolam[$i]['tanggal_booking']=="0000-00-00")){											
												echo" <h5 class='text-warning'>Status: Booking <a class='text-light' data-toggle='collapse' href='#collapsePasangKolam".$i."' aria-controls='collapseExample'> --> ubah status</a> <h5>";
											}else {
												echo" <h5 class='text-warning'>Status: Belum Booking <a class='text-light' data-toggle='collapse' href='#collapsePasangKolam".$i."' aria-controls='collapseExample'> --> ubah status</a> <h5>";
											}?>
										<div class="collapse" id="collapsePasangKolam<?php echo $i ?>">
											<form method="POST">
												<input type="hidden" name="idkolam" value ="<?php echo $DataKolam[$i]['id']; ?>">
											<?php 
											if( !($DataKolam[$i]['tanggal_pasang']=="0000-00-00")){?>											
												
												<label class="mt-2">Tanggal Penyelesaian</label>
												<input type="date" name="tanggalpenyelesaian" class="form-control" >

											<?php } 
											else if( !($DataKolam[$i]['tanggal_booking']=="0000-00-00")){?>										
											
												<label class="mt-2">Tanggal Pemasangan</label>
												<input type="date" name="tanggalpemasangan" class="form-control">

												<label class="mt-2">Tanggal Penyelesaian</label>
												<input type="date" name="tanggalpenyelesaian" class="form-control" >

											<?php } 
											else {?>
												
												<label class="mt-2">Tanggal Booking</label>
												<input type="date" name="tanggalbooking" class="form-control">
											
												<label class="mt-2">Tanggal Pemasangan</label>
												<input type="date" name="tanggalpemasangan" class="form-control">

												<label class="mt-2">Tanggal Penyelesaian</label>
												<input type="date" name="tanggalpenyelesaian" class="form-control" >

											<?php } ?>
											
												<input class="mt-3  pt-2 pb-2 btn bg-black" type="submit" value="Simpan" name="pasangkolam">
											</form>									
										</div>				
									</div>
									
									<?php 
									 if(!($DataKolam[$i]['tanggal_penyelesaian'] == "0000-00-00")){	?>
											<a href="#collapseExamplem<?php echo $i; ?>" data-toggle="collapse" class="small-box-footer">Selengkapnya<i class="fas fa-arrow-circle-right"></i></a>
									
											<?php } ?>


									
									
									<div class="collapse" id="collapseExamplem<?php echo $i; ?>">	
												
										<!-- Input Data Harian -->
											<a class="btn btn-info btn-block text-center mt-3" data-toggle="collapse" href="#collapseHarian<?php echo $i; ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
								Input Data Harian</a> 
					
								<div class="collapse" id="collapseHarian<?php echo $i; ?>">
								
										<div class="card card-body bg-success"> 
									
										<form method="POST">							
											
											<input  type="hidden" name="idkolam"  value ="<?php echo $DataKolam[$i]['id']; ?>">
											
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

											<input class="mt-3  pt-2 pb-2 btn btn-dark" type="submit" name="monitorharian" value="Input Data" onClick="ajaxSubmit();">	
									</form>
								</div>		
							</div>
							
									<div class="p-3 text-left bg-success">
																	
                          
                          <?php for ($g=0; $g < count($DataKolam[$i]['monitor']); $g++) 
                          { 
                            $tanggal = $DataKolam[$i]['monitor'][$g]['tanggal'];                                 
                            $kematian = $DataKolam[$i]['monitor'][$g]['kematian'];
                            $totalKematian = $totalKematian+$DataKolam[$i]['monitor'][$g]['kematian'];
                            $jumlahIkan =  $DataKolam[$i]['bibit'][0]['populasi']-$totalKematian;   
                            $phAir = $DataKolam[$i]['monitor'][$g]['ph_air'];
                            $suhuAir = $DataKolam[$i]['monitor'][$g]['suhu_air'];
                            $kondisiAir = $DataKolam[$i]['monitor'][$g]['kondisi_air'] ;
                            $kondisiIkan = $DataKolam[$i]['monitor'][$g]['kondisi_ikan'] 
                                   ?>

							<div class="border-bottom border-white text-center mt-2 mb-2">
								<h4 class="text-light font-weight-bold"><?php echo tgl_indo($tanggal) ; ?></h4>	
							</div>
							<table class="h5" style="width:100%">
								<tr class="mb-1">
									<th>Parameter</th>
									<th>Keterangan</th>
								</tr>
								<tr>
									<td>Jumlah Ikan</td>	
									<td><?php echo  $jumlahIkan;?> </td>
								</tr>
								<tr>
									<td>Kebutuhan Pakan</td>	
									<td>1 kg</td>
								</tr>
								<tr>
									<td>Kematian</td>	
									<td><?php echo  $kematian;?> </td>
								</tr>
								<tr>
									<td>PH Air</td>	
									<td><?php echo  $phAir;?> </td>

								</tr>
								<tr>
									<td>Suhu Air</td>	
									<td><?php echo  $suhuAir;?> </td>
								</tr>
								<tr>
									<td>Kondisi Air</td>	
									<td><?php echo  $kondisiAir;?> </td>
								</tr>
								<tr>
									<td>Kondisi Ikan</td>	
									<td><?php echo  $kondisiIkan;?> </td>
								</tr>
                            </table>
                            
                 <?php  } $totalKematian=0; ?>
													</div>
												
												</div>
													
												</div>				
											</div>			
											<?php 
										
										}
									}
//tampilan palsma
									for ($i=0; $i < COUNT($DataKolam); $i++) 
									{ 
										if($DataKolam[$i]['jenis']=="Plasma")
										{
											$NoPlasma++;
												?>				
											<div class="col-lg-6 col-12 h-75">									
												<!-- small box -->
												<div class="small-box bg-info ">
												<div class="inner">										
												<h3>Nomor Kolam : <?php echo $NoPlasma; ?></h3>
												<h5>Jenis Kolam: Plasma</h5>
												<?php  if(!($DataKolam[$i]['tanggal_penyelesaian'] == "0000-00-00")){													
													}	
												else if( !($DataKolam[$i]['tanggal_pasang']=="0000-00-00")){
													echo" <h5 class='text-warning'>Status: Masa pemasangan<h5>";
												}
												else if( !($DataKolam[$i]['tanggal_booking']=="0000-00-00")){
													echo" <h5 class='text-warning'>Status: Booking<h5>";
												}?>	

												</div>										
												<a href="#collapseExamplem<?php echo $i; ?>" data-toggle="collapse" class="small-box-footer">Selengkapnya<i class="fas fa-arrow-circle-right"></i></a>
												<div class="collapse" id="collapseExamplem<?php echo $i; ?>">	
												
												<!-- Input Data Harian -->
											<!-- <a class="btn btn-success btn-block mt-3" data-toggle="collapse" href="#collapseHarian<?php echo $i; ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
										Input Data Harian</a>  -->
												
										<div class="collapse" id="collapseHarian<?php echo $i; ?>">

										<div class="card card-body bg-info"> 

										<form method="POST">							
											
											<input  type="hidden" name="idkolam"  value ="<?php echo $DataKolam[$i]['id']; ?>">
											
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

											<input class="mt-3  pt-2 pb-2 btn btn-dark" type="submit" name="monitorharian" value="Input Data" onClick="ajaxSubmit();">	
										</form>
										</div>		
										</div>

										<div class="p-3 text-left bg-info">
																	

										<?php for ($g=0; $g < count($DataKolam[$i]['monitor']); $g++) 
										{ 
										$tanggal = $DataKolam[$i]['monitor'][$g]['tanggal'];                                 
										$kematian = $DataKolam[$i]['monitor'][$g]['kematian'];
										$totalKematian = $totalKematian+$DataKolam[$i]['monitor'][$g]['kematian'];
										$jumlahIkan =  $DataKolam[$i]['bibit'][0]['populasi']-$totalKematian;   
										$phAir = $DataKolam[$i]['monitor'][$g]['ph_air'];
										$suhuAir = $DataKolam[$i]['monitor'][$g]['suhu_air'];
										$kondisiAir = $DataKolam[$i]['monitor'][$g]['kondisi_air'] ;
										$kondisiIkan = $DataKolam[$i]['monitor'][$g]['kondisi_ikan'] 
										?>

										<div class="border-bottom border-white text-center mt-2 mb-2">
										<h4 class="text-light font-weight-bold"><?php echo tgl_indo($tanggal) ; ?></h4>	
										</div>
										<table class="h5" style="width:100%">
										<tr class="mb-1">
										<th>Parameter</th>
										<th>Keterangan</th>
										</tr>
										<tr>
										<td>Jumlah Ikan</td>	
										<td><?php echo  $jumlahIkan;?> </td>
										</tr>
										<tr>
										<td>Kebutuhan Pakan</td>	
										<td>1 kg</td>
										</tr>
										<tr>
										<td>Kematian</td>	
										<td><?php echo  $kematian;?> </td>
										</tr>
										<tr>
										<td>PH Air</td>	
										<td><?php echo  $phAir;?> </td>

										</tr>
										<tr>
										<td>Suhu Air</td>	
										<td><?php echo  $suhuAir;?> </td>
										</tr>
										<tr>
										<td>Kondisi Air</td>	
										<td><?php echo  $kondisiAir;?> </td>
										</tr>
										<tr>
										<td>Kondisi Ikan</td>	
										<td><?php echo  $kondisiIkan;?> </td>
										</tr>
										</table>

										<?php  } $totalKematian=0;
										?>
													</div>
												
												</div>
													
												</div>				
											</div>			
											<?php 
										
										}
									}
							
									
									
								 ?>	

								</div><!-- /.row -->
							</div><!-- /.container-fluid -->
						</div> 
<!-- INPUT DATA -->		
						<?php if($jumlahKolamMandiri>0){ ?>
						<div class="tab-pane" id="inputdata">						

							<!-- Input Data Pemasangan Kolam -->
							<a class="ezufont btn btn-info btn-block mb-1" data-toggle="collapse" href="#collapsePasangKolam" role="button" aria-expanded="false" aria-controls="collapseExample">
							Input Data Pemasangan Kolam</a>
							<div class="collapse" id="collapsePasangKolam">
								<div class="card card-body">
								<form method="POST">										
									<div class="wrap-input100"  >
										<label class="mt-2">No Kolam</label>
										<select class="form-control" value="" name="idkolam">												
											<?php for($i=0; $i<$jumlahKolamMandiri; $i++){ ?>												
													<option name="idkolam1" value ="<?php echo $arrayIdKolamMandiri[$i]; ?>" id=""><?php echo "No Kolam Mandiri: ".$arrayNomorKolamMandiri[$i]; ?></option>
											<?php } ?>	
										</select>									
									</div>
										<label class="mt-2">Tanggal Booking</label>
										<input type="date" name="tanggalbooking" class="form-control" >

										<label class="mt-2">Tanggal Pemasangan</label>
										<input type="date" name="tanggalpemasangan" class="form-control" >

										<label class="mt-2">Tanggal Penyelesaian</label>
										<input type="date" name="tanggalpenyelesaian" class="form-control" >

										<input class="mt-3  pt-2 pb-2 btn btn-info" type="submit" name="pasangkolam" value="Input Data">	
								</form>
								</div>
							</div>

							<!-- Input Data Masuk Bibit-->
							<a class="ezufont btn btn-info btn-block mb-1" data-toggle="collapse" href="#collapseBibitMasuk" role="button" aria-expanded="false" aria-controls="collapseExample">
							Input Data Bibit Masuk</a>
							<div class="collapse" id="collapseBibitMasuk">
								<div class="card card-body">
								
										<form method="POST">										
												<div class="wrap-input100"  >
													<label class="mt-2">Nomor Kolam</label>
													<select class="form-control" value="" name="idkolam">												
														<?php for($i=0; $i<$jumlahKolamMandiri; $i++){ ?>												
																<option name="idkolam1" value ="<?php echo $arrayIdKolamMandiri[$i]; ?>" id=""><?php echo "No Kolam Mandiri: ".$NomorKolamMandiri[$i]; ?></option>
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

							<!-- Input Data Sampling-->
							<a class="ezufont btn btn-info btn-block mb-1" data-toggle="collapse" href="#collapseSampling" role="button" aria-expanded="false" aria-controls="collapseExample">
							Input Data Sampling</a>
							<div class="collapse" id="collapseSampling">
								<div class="card card-body">
										<form method="POST">										
										<div class="wrap-input100"  >
												<label class="mt-2">Nomor Kolam</label>
												<select class="form-control" value="" name="idkolam">												
													<?php for($i=0; $i<$jumlahKolamMandiri; $i++){ ?>												
															<option name="idkolam1" value ="<?php echo $arrayIdKolamMandiri[$i]; ?>" id=""><?php echo "No Kolam Mandiri: ".$NomorKolamMandiri[$i]; ?></option>
													<?php } ?>	
												</select>									
											</div>
												
												<label class="mt-2">Populasi</label>
												<input type="number" name="populasisampling" class="form-control" Placeholder = "Jumlah ikan" required >
												
												<label class="mt-2">Ukuran Ikan</label>
												<input type="number" name="ukuransampling" class="form-control" placeholder = "Ukuran ikan (cm)" required >
												
												<label class="mt-2">Berat Total Sampling</label>
												<input type="number" name="beratsampling" class="form-control" placeholder = "berat total sampling (gram)" required >

												<label class="mt-2">Tanggal Sampling</label>
												<input type="date" name="tanggalsampling" class="form-control">
												
												<input class="mt-3  pt-2 pb-2 btn btn-info" type="submit" name="sampling" value="Input Data">	
										</form>
									</div>
							</div>

							<!-- Input Data Masuk Pakan-->
							<a class="ezufont btn btn-info btn-block mb-1" data-toggle="collapse" href="#collapsePakanMasuk" role="button" aria-expanded="false" aria-controls="collapseExample">
							Input Data Pakan Masuk</a>
							<div class="collapse" id="collapsePakanMasuk">
								<div class="card card-body">
										<form method="POST">										
										<div class="wrap-input100"  >
												<label class="mt-2">No Kolam</label>
													<select class="form-control" value="" name="idkolam">												
														<?php for($i=0; $i<$jumlahKolamMandiri; $i++){ ?>												
																<option name="idkolam1" value ="<?php echo $arrayIdKolamMandiri[$i]; ?>" id=""><?php echo "No Kolam Mandiri: ".$NomorKolamMandiri[$i]; ?></option>
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
							<a class="ezufont btn btn-info btn-block mb-1" data-toggle="collapse" href="#collapsePanen" role="button" aria-expanded="false" aria-controls="collapseExample">
							Input Data Panen</a>
							<div class="collapse" id="collapsePanen">
								<div class="card card-body">
										<form method="POST">										
											<div class="wrap-input100"  >
												<label class="mt-2">No Kolam</label>
												<select class="form-control" value="" name="idkolam">												
													<?php for($i=0; $i<$jumlahKolamMandiri; $i++){ ?>												
															<option name="idkolam1" value ="<?php echo $arrayIdKolamMandiri[$i]; ?>" id=""><?php echo "No Kolam Mandiri: ".$NomorKolamMandiri[$i]; ?></option>
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
						<?php } else if (true){}?>
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
							<input type="text" name="ktp" id="ktp" class="form-control" placeholder="0000-0000-0000-0000" required  value="<?php echo htmlentities($result->ktp);?>">
							</div>

							<label class="col-sm-2 control-label">Alamat<span style="color:red">*</span></label>
							<div class="wrap-input100 validate-input col-sm-4"  >
							<input type="text" name="alamat" class="form-control" required Placeholder = "Alamat tanpa nama kelurahan dan kota"   value="<?php echo htmlentities($result->alamat);?>">
							</div>

							<label class="col-sm-2 control-label">Kota<span style="color:red">*</span></label>
							<div class="wrap-input100 validate-input col-sm-4"  >
							<input type="text" name="kota" class="form-control" required value="<?php echo htmlentities($result->kota);?>">
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

		function ajaxSubmit() {	
				var valid = true;
				valid = checkEmpty($("#title"));
				if(valid) {
					var title = $("#title").val();
					var description = $("#description").val();
					$.ajax({
						url: "process-ajax.php",
						data:'title='+title+'&description='+description,
						type: "POST",
						beforeSend: function(){
							$('#submit-control').html("<img src='LoaderIcon.gif' /> Ajax Request is Processing!");
						},
						success: function(data){
							setInterval(function(){ $('#submit-control').html("Form submited Successfully!") },1000);
						}
					});
				}

		
	</script>



	
<div class="footer bg-warning pt-1  pl-1 pr-1">
  <p>Aplikasi ini Dalam Tahapan Pengembangan<br>Masih masa uji coba</p>
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

.ezufont{
	font-size : 22px;
}

</style>

<?php 
function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun
 
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
 