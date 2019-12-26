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

	$email = $_SESSION['alogin'];
	$sql = "SELECT DISTINCT * from users where email = (:email);";
	$query = $dbh -> prepare($sql);
	$query-> bindParam(':email', $email, PDO::PARAM_STR);
	$query->execute();
	$result=$query->fetch(PDO::FETCH_OBJ);
	$cnt=1;
	$idedit = $result->id;

//data kolam plasma
$sql = "SELECT  id FROM kolam WHERE id_pemilik = ".$idedit." AND jenis = 'Plasma'";
$hasil = mysqli_query($db, $sql);
if (mysqli_num_rows($hasil) > 0)
{			
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
$sql = "SELECT  id,tanggal_pasang FROM kolam WHERE id_pemilik = ".$idedit." AND jenis = 'Mandiri'";
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

if(isset($_POST['submit']))
{ 
	$email = $_SESSION['alogin'];
	$sql = "SELECT  * from users where email = (:email);";
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
	$periode = $_POST['periode'];
	

	$sql = "INSERT INTO monitor (suhu_air, ph_air, kematian, berat_pakan, kondisi_air, kondisi_ikan, tanggal, id_kolam, periode) VALUES("
	.$monitorSuhuAir.",".$monitorPHAir.",".$monitorKematian.",".$monitorBeratPakan.",'".$monitorKondisiAir."','".$monitorKondisiIkan."','".$monitorTanggal."',".$monitorIdKolam.",".$periode.")";

	if(mysqli_query($db, $sql)){
		$pesan = 1;		
	} else {$pesan = 2;}	
	
}

if(isset($_POST['tambahKolam']))
{
    $jumlahKolamPlasma = jumlahKolambyIdJenis($idedit, 'Plasma');
    $jumlahKolamMandiri = jumlahKolambyIdJenis($idedit, 'Mandiri');
    
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
            $inputanKolamPlasma1 = $inputanKolamPlasma - $jumlahKolamPlasma;
            if($inputanKolamPlasma1>0)
            {
                for ($i = 1; $i <= $inputanKolamPlasma1; $i++)
                {
                    $sql="INSERT INTO kolam (jenis, id_pemilik, status) VALUES ('Plasma', ".$idedit.",'Pending')";
                    if(mysqli_query($db, $sql)){
                        $pesan = 1;
                    } else {$pesan = 2;}
                }
            }			
		}
		else{
			echo '<script type="text/javascript">alert("tidak bisa dikurangi")</script>';
		}

		if($inputanKolamMandiri==0 || $inputanKolamMandiri ==NULL){

		}
		else if($inputanKolamMandiri > $jumlahKolamMandiri || $inputanKolamMandiri == $jumlahKolamMandiri )
		{
			$inputanKolamMandiri1 = $inputanKolamMandiri - $jumlahKolamMandiri;
            if($inputanKolamMandiri1>0)
            {
                for ($j = 1; $j <= $inputanKolamMandiri1; $j++)
                {
                    $sql="INSERT INTO kolam (jenis, id_pemilik,status) VALUES ('Mandiri', ".$idedit.",'Pending')";
                    if(mysqli_query($db, $sql)){
                        $pesan = 1;
                    } else {$pesan = 2;}
                }
            }            
		}
		else{
			echo '<script type="text/javascript">alert("tidak bisa dikurangi")</script>';
		}
	} else
	{
		for ($i = 1; $i <= $inputanKolamPlasma; $i++)
		{
			$sql="INSERT INTO kolam (jenis, id_pemilik,status) VALUES ('Plasma', ".$idedit.",'Pending')";
			if(mysqli_query($db, $sql)){
				$pesan = 1;
			} else {$pesan = 2;}
		}
		for ($j = 1; $j <= $inputanKolamMandiri; $j++)
		{
			$sql="INSERT INTO kolam (jenis, id_pemilik,status) VALUES ('Mandiri', ".$idedit.",'Pending')";
			if(mysqli_query($db, $sql)){
				$pesan = 1;
			} else {$pesan = 2;}
		}
	}
}

if(isset($_POST['pasangkolam']))
{
	$tanggalBooking = $_POST['tanggalbooking'];
	$tanggalPasang = $_POST['tanggalpemasangan'];
	$tanggalPenyelesaian = $_POST['tanggalpenyelesaian'];
	$IdKolam = $_POST['idkolam'];
	
	if (!$tanggalBooking==""){
		$sql = "UPDATE kolam SET tanggal_booking='".$tanggalBooking."', status='Booking' WHERE id=".$IdKolam;	
		if(mysqli_query($db, $sql)){
			$pesan = 1;
		} else {$pesan = 2;}	
	}
	if (!$tanggalPasang==""){
		$sql = "UPDATE kolam SET tanggal_pasang='".$tanggalPasang."', status='Pemasangan' WHERE id=".$IdKolam;
		if(mysqli_query($db, $sql)){
			$pesan = 1;
		} else {$pesan = 2;}		
	}
	if (!$tanggalPenyelesaian==""){
		$sql = "UPDATE kolam SET tanggal_penyelesaian='".$tanggalPenyelesaian."',status='Terpasang' WHERE id=".$IdKolam;
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
	$periode = $_POST ['periode'];
	$IdKolam = $_POST['idkolam'];

	$sql = "INSERT INTO bibit (berat, ukuran, populasi, tanggal_masuk, periode, id_kolam) VALUES("
	.$beratTotalBibit.",'".$ukuranBibit."',".$populasiBibit.",'".$tanggalBibitMasuk."',".$periode.",".$IdKolam.")";
	 if(mysqli_query($db, $sql)){
		 $pesan = 1;
		//  header('location:admin.php');
	 } else {$pesan = 2;}

	 
}

if(isset($_POST['pakanmasuk']))
{	
	$beratPakan = $_POST['beratpakan'];
	$jenisPakan = $_POST['jenispakan'];
	$tanggalPakanMasuk = $_POST['tanggalmasuk'];
	$periode = $_POST['periode'];
	$periodePakan = $_POST['periodepakan'];
	$IdKolam = $_POST['idkolam'];

	$sql = "INSERT INTO pakan (jenis, berat, tanggal_masuk, id_kolam, periode_pakan, periode) VALUES("
	.$jenisPakan.",".$beratPakan.",'".$tanggalPakanMasuk."',".$IdKolam.",".$periodePakan.",".$periode.")";
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
	$periode = $_POST['periode'];

	$sql = "SELECT * FROM panen WHERE id_Kolam=".$IdKolam." AND tanggal_panen= '".$tanggalPanen."' AND periode= ".$periode;
	$hasil = mysqli_query($db, $sql);
	if(mysqli_num_rows($hasil)>0)
	{
		header('location:admin.php');

	} else {
		$sql = "INSERT INTO panen (berat, populasi, tanggal_panen, id_kolam, periode) VALUES("
		.$beratPanen.",".$jumlahIkanPanen.",'".$tanggalPanen."',".$IdKolam.",".$periode.")";
		// die($sql);
		if(mysqli_query($db, $sql)){
			$pesan = 1;
		} else {$pesan = 2;}
	}

	
	
}

if(isset($_POST['sampling']))
{

	$file = $_FILES['image']['name'];	
	$tipe_file = $_FILES['image']['type'];
	$filesize = $_FILES['image']['size'];
	$folder="images/";	
	$tmp_file = $_FILES['image']['tmp_name'];
	
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
				unlink($filesave); //menghapus foto asli yg baru
			} else {
				die("file terlalu besar");
			}	
		} else {
			$message = "Hanya file Gambar yang diizinkan (jpeg/png)";
			echo "<script>alert('$message');</script>";
		}


	$populasiSampling = $_POST['populasisampling'];
	$ukuranSampling = $_POST['ukuransampling'];
	$beratSampling = $_POST['beratsampling'];
	$periodeSampling = $_POST['periodesampling'];
	$tanggalSampling = $_POST['tanggalsampling'];
	$periode = $_POST['periodesampling'];
	$IdKolam = $_POST['idkolam'];
	$sql = "INSERT INTO sampling (populasi, ukuran, berat, tanggal_sampling, id_kolam, periode, periode_sampling, image) VALUES("
	.$populasiSampling.",".$ukuranSampling.",".$beratSampling.",'".$tanggalSampling."',".$IdKolam.",".$periode.",".$periodeSampling.",'".$namabaru."')";
	if(mysqli_query($db, $sql)){
		$pesan = 1;
	} else {$pesan = 2;}

    

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
	<title>PROFILE MITRA</title>
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
	<!-- DataTables -->
	<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
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
$sql = "SELECT DISTINCT id FROM kolam WHERE id_pemilik = ".$idedit." AND jenis = 'Plasma'";
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
$sql = "SELECT DISTINCT id,tanggal_pasang FROM kolam WHERE id_pemilik = ".$idedit." AND jenis = 'Mandiri'";
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

$dataKolam=array(); 

while ($data=mysqli_fetch_assoc($hasil)) {
 $x['id']=$data['id'];
 $x['jenis']=$data['jenis']; 
 $x['id_pemilik']=$data['id_pemilik'];
 $x['tanggal_booking']=$data['tanggal_booking'];
 $x['tanggal_pasang']=$data['tanggal_pasang'];
 $x['tanggal_penyelesaian']=$data['tanggal_penyelesaian'];
 $x['bibit']=array();
          $sqlBibit = "SELECT DISTINCT * FROM bibit WHERE id_kolam=".$data['id'];
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
          $sqlSampling = "SELECT DISTINCT * FROM sampling WHERE id_kolam=".$data['id'];
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
          $sqlMonitor = "SELECT DISTINCT * FROM monitor WHERE id_kolam=".$data['id']." ORDER BY `id` DESC";
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
          $sqlPanen = "SELECT DISTINCT * FROM panen WHERE id_kolam=".$data['id'];
          $hasilPanen = mysqli_query($db, $sqlPanen);

          while ($dataPanen=mysqli_fetch_assoc($hasilPanen)) {   
            $y['id']=$dataPanen['id'];
            $y['berat']=$dataPanen['suhu_air'];
            $y['populasi']=$dataPanen['ph_air'];
            $y['tanggal_panen']=$dataPanen['kematian'];
            $y['id_kolam']=$dataPanen['id_kolam'];
            array_push($x['panen'], $y);}
            
 // untuk menambah array setelah array yang terakhir
 array_push($dataKolam, $x);
}
//  echo '<pre>' . var_export($DataKolam, true) . '</pre>';


  if($pesan==1){
		echo "<div class='alert alert-success text-white' role='alert'>Data Berhasil Ditambahkan</div>";
	} else if($pesan==2){
		echo "<div class='alert alert-danger text-white' role='alert'>Data Gagal Ditambahkan</div>";
	} 
	
	$jumlahPlasmaPending = jumlahKolamByJensidanStatus("Plasma","Pending");
	$jumlahPlasmaBooking = jumlahKolamByJensidanStatus("Plasma","Booking");
	$jumlahPlasmaPemasangan = jumlahKolamByJensidanStatus("Plasma","Pemasangan");
	$jumlahPlasmaTerpasang = jumlahKolamByJensidanStatus("Plasma","Terpasang");
	$jumlahPlasmaTotal = $jumlahPlasmaPending+$jumlahPlasmaBooking+$jumlahPlasmaPemasangan+$jumlahPlasmaTerpasang;
	
	$jumlahMandiriPending = jumlahKolamByJensidanStatus("Mandiri","Pending");
	$jumlahMandiriBooking = jumlahKolamByJensidanStatus("Mandiri","Booking");
	$jumlahMandiriPemasangan = jumlahKolamByJensidanStatus("Mandiri","Pemasangan");
	$jumlahMandiriTerpasang = jumlahKolamByJensidanStatus("Mandiri","Terpasang");
	$jumlahMandiriTotal = $jumlahMandiriPending+$jumlahMandiriBooking+$jumlahMandiriPemasangan+$jumlahMandiriTerpasang;
	
	$jumlahKolam = $jumlahPlasmaTotal+$jumlahMandiriTotal; 
	
	$aktif       = $_GET["aktif"]==2 ? 2 : 1;
	
	$halamanPlasma    = 10;
	$pagesPlasma      = ceil($jumlahKolamPlasma/$halamanPlasma);
	$pagePlasma       = isset($_GET["halamanPlasma"]) ? (int)$_GET["halamanPlasma"] : 1;
	$mulaiPlasma      = ($pagePlasma>1) ? ($pagePlasma * $halamanPlasma) - $halamanPlasma : 0;
	
	 
	$halamanMandiri    = 10;
	$pagesMandiri      = ceil($jumlahKolamMandiri/$halamanMandiri);
	$pageMandiri       = isset($_GET["halamanMandiri"]) ? (int)$_GET["halamanMandiri"] : 1;
	$mulaiMandiri      = ($pageMandiri>1) ? ($pageMandiri * $halamanMandiri) - $halamanMandiri : 0;
	
	$dataKolam = dataKolam($idedit);


?>

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper mt-0">
 <!-- <div class="card pr-5 pl-1"> -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>PROFILE MITRA</h1>
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
        <div class="row">
          <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-info card-outline" >
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="images/<?php echo $result->image;;?>"
                       alt="User profile picture" style="width:100px; height:100px; border-radius:50%; margin:10px;  object-fit: cover; ">
				</div>
                <h3 class="profile-username text-center"><?php echo $result->name;;?></h3>

                <p class="text-muted text-center"><?php echo "Mitra ".$result->cabang;;?></p>

                <ul class="list-group list-group-unbordered mb-3">

  
                <li class="list-group-item">
                    <b>Kolam Plasma</b> <a class="float-right"><?php 
                    echo jumlahKolamByJenisMitra("Plasma", $idedit); ?></a>                    
                </li>
                <li class="list-group-item">
                    <b>Kolam Mandiri</b> <a class="float-right"><?php
                    echo jumlahKolamByJenisMitra("Mandiri", $idedit); ?></a>
                </li>



                </ul>
				<a href="logout.php" class="btn btn-info btn-block" role="button" aria-expanded="false" aria-controls="collapseExample">
				Logout</a>
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
                <strong><i class="fas fa-id-badge mr-1"></i>ID</strong>
                <p class="text-muted"><?php echo $idedit;?></p>

                <strong><i class="fas fa-user mr-1"></i></i>Nama</strong>
                <p class="text-muted"><?php echo $result->name;?></p>

                <strong><i class="fas fa-id-card mr-1"></i> No KTP</strong>
                <p class="text-muted"><?php echo $result->ktp;?></p>

                <strong><i class="fas fa-map-marked-alt mr-1"></i> Cabang Pelayanan</strong>
                <p class="text-muted"><?php echo $result->cabang;?></p>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>
                <p class="text-muted"><?php echo $result->alamat;?></p>

                <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
                <p class="text-muted"><?php echo $result->email;?></p>

                <strong><i class="fas fa-mobile-alt mr-1"></i> No Hp</strong>
                <p class="text-muted"><?php echo $result->mobile;?></p>

                <strong><i class="fas fa-money-check-alt mr-1"></i> Data Rek Bank</strong>
                <p class="text-muted"><?php echo "Bank: ".$result->ban."<br>No Rek: ".$result->norek."<br>Atas Nama: ".$result->anrek;?></p>
                </span>

                <a class="btn btn-info" href="https://api.whatsapp.com/send?phone=08123456789&text=Assalamualaikum <?php echo $Gender;?>">Hubungi Admin<i class="fab fa-whatsapp ml-2"></i></a>

                </div class="width-10">   
            </div>            
        </div> <!-- PENUTUP About Me Box -->
               <!-- /.col -->
         <div class="col-md-9">
		
            <div class="card"> <!-- buka card -->
                <div class="card-header p-2"> <!-- buka header -->
                    <ul class="nav nav-pills"> 
						<?php if($jumlahKolamPlasma==0){
							$tabMandiri =  "active";
							$hidePlasma = "d-none";
							$hideMandiri = "active";
						 } else if($jumlahKolamMandiri==0){
							$tabPlasma =  "active";
							$hideMandiri = "d-none";
							$hidePlasma = "active";
						  } else{
							$tabMandiri =  "active";
							$hideMandiri = "active";
							$hidePlasma = ""; 
						  }?>  
						<li class="nav-item"><a class="nav-link <?= $hideMandiri;?>" href="#dataMandiri" data-toggle="tab">Data Mandiri</a></li>
						<li class="nav-item"><a class="nav-link <?= $hidePlasma;?>" href="#dataPlasma" data-toggle="tab">Data Plasma</a></li>            
					</ul>
                </div> <!-- tutup header -->     
              	<div class="card-body mb-5"> <!-- buka card-body -->	
					<div class="tab-content mb-5">
<!-- PLASMA-->		

            <div class="<?php echo $tabPlasma;?> tab-pane" id="dataPlasma">
            <?php for ($i=1; $i <= $pagesPlasma; $i++) { ?>    
                                <a class="btn btn-info mb-2 ml-2" href="profile.php?halamanPlasma=<?php echo $i; ?>&aktif=1" style="text-decoration:none"><u><?php echo $i; ?></u></a>
                            <?php } ?>		
                <div class="container-fluid"> 
                    <div class="row"> 
                        <?php
                        include('mitra/dashboard_plasma_mitra.php');
                        ?>
                    </div>
                </div>
            </div>

<!-- MANDIRI -->		
            <div class="<?php echo $tabMandiri;?> tab-pane" id="dataMandiri">
            <?php for ($i=1; $i <= $pagesMandiri; $i++) { ?>    
                                <a class="btn btn-success mb-2 ml-2" href="profile.php?halamanMandiri=<?php echo $i; ?>&aktif=2" style="text-decoration:none"><u><?php echo $i; ?></u></a>
                            <?php } ?>		
                <div class="container-fluid"> 
                    <div class="row"> 
<?php
      
                        include('mitra/dashboard_mandiri_mitra.php');
?>
                    </div>
                </div>
            </div>

					</div> <!-- tutup tab-content -->						
				</div><!-- tutup card-body -->				
			</div> <!-- tutup card -->				
		</div>
    </div>
</div>  <!--tutup row-->
</section> <!-- tutup section -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="plugins/inputmask/jquery.inputmask.bundle.js"></script>
<script src="plugins/moment/moment.min.js"></script>
<!-- date-range-picker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
	<!-- Loading Scripts -->
	<!-- <script src="js/jquery.min.js"></script> -->
	<!-- <script src="js/bootstrap-select.min.js"></script> -->
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<!-- <script src="js/jquery.mask.min.js"></script> -->
	<script src="js/jqu.js"></script> -->
	<!-- <script type="text/javascript">
		$(document).ready(function () {
		setTimeout(function() {
			$('.succWrap').slideUp("slow");
		}, 3000);
		});
	</script>
	<script src="js/jquery-1.9.0.min.js"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js" integrity="sha256-fvFKHgcKai7J/0TM9ekjyypGDFhho9uKmuHiFVfScCA=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js" integrity="sha256-+4KHeBj6I8jAKAU8xXRMXXlH+sqCvVCoK5GAFkmb+2I=" crossorigin="anonymous"></script>
	
	
<script>
    
		// $(function() 
        // {
		// 	$("#mobile").mask("0899-9999-99999",{autoclear:false});
		// 	$("#ktp").mask("9999-9999-9999-9999",{autoclear:false});
			
		// });

	
		// $("form input[type=text]").on("change invalid", function() {
		// 	var textfield = $(this).get(0);
			
		// 	// hapus dulu pesan yang sudah ada
		// 	textfield.setCustomValidity("");
			
		// 	if (!textfield.validity.valid) {
		// 	textfield.setCustomValidity("Tidak boleh kosong!");  
		// 	}
		// });

		// function ajaxSubmit() {	
		// 		var valid = true;
		// 		valid = checkEmpty($("#title"));
		// 		if(valid) {
		// 			var title = $("#title").val();
		// 			var description = $("#description").val();
		// 			$.ajax({
		// 				url: "process-ajax.php",
		// 				data:'title='+title+'&description='+description,
		// 				type: "POST",
		// 				beforeSend: function(){
		// 					$('#submit-control').html("<img src='LoaderIcon.gif' /> Ajax Request is Processing!");
		// 				},
		// 				success: function(data){
		// 					setInterval(function(){ $('#submit-control').html("Form submited Successfully!") },1000);
		// 				}
		// 			});
		// 		}

        $(function () 
        {

            $("#example1").DataTable();
            $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            });
            //Initialize Select2 Elements
            $('.select2').select2({
            theme: 'bootstrap4'
            })

            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
            //Datemask2 mm/dd/yyyy
            $('#datemask2').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
            //Money Euro
            $('[data-mask]').inputmask()

         
            //Date range as a button
            $('#daterange-btn').daterangepicker(
            {
                ranges   : {
                'Hari Ini'  : [moment(), moment()],
                'Kemarin'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Satu Pekan Terakhir' : [moment().subtract(6, 'days'), moment()],
                '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
                'Sebulan Terakhir'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                'Bulan Ini'  : [moment().startOf('month'), moment().endOf('month')],
                'Setahun Lalu'   : [moment().subtract(1, 'years')],
                'Tahun ini':[moment().startOf('year')]
                
                },
                startDate: moment().subtract(29, 'days'),
                endDate  : moment()
            },
            function (start, end) {
                $('#reportrange span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'))
            }
            )

            //Timepicker
            $('#timepicker').datetimepicker({
            format: 'LT'
            })
            
            //Bootstrap Duallistbox
            $('.duallistbox').bootstrapDualListbox()

            //Colorpicker
            $('.my-colorpicker1').colorpicker()
            //color picker with addon
            $('.my-colorpicker2').colorpicker()

            $('.my-colorpicker2').on('colorpickerChange', function(event) {
            $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
            });
        })
		
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


 