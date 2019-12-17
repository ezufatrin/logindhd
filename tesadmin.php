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
	$sql = "SELECT * FROM users Where status= 1 ORDER BY name ASC";
	$hasil = mysqli_query($db, $sql);
	while($row = mysqli_fetch_assoc($hasil))
	{
		$arrayIdUser[] = $row['id'];
		$arrayNamaUser[] = $row['name'];		
    }

    $sql = "SELECT * FROM users Where email='admin@admin.com'";	
    $hasil = mysqli_query($db, $sql);
    while($row = mysqli_fetch_assoc($hasil))
    {
        $idAdmin =$row['id'];
        $namaAdmin = $row['name'];
        $cabangAdmin = $row['cabang'];
        $cabangAdmin = $row['cabang'];
        $image = $row['image'];        
        $alamatAdmin = $row['alamat']." Kel. ".$row['kelurahan'].
        " Kec. ".$row['kecamatan']." Kota/kab. ".$row['kota'];
        $NoTelponAdmin =  $row['mobile'];
        $Gender = $row['gender'];
        if($Gender=="Male") {$Gender=Pak;}
        else if($Gender=="Female") {$Gender=Bu;}
        else {$Gender="";}
        $statusAdmin = $row['status'];             
    }    
    

 $sql = "SELECT * FROM users Where email='admin@admin.com'";	
$hasil = mysqli_query($db, $sql);
while($row = mysqli_fetch_assoc($hasil))
 {
   $idMitra = $row['id'] ;                 
 }  

  
$sql = "SELECT * FROM users Where id=".$idMitra;	
$hasil = mysqli_query($db, $sql);
while($row = mysqli_fetch_assoc($hasil))
{
    $_SESSION['id'] = $row['id'];
    $_SESSION['name'] = $row['name'];
    $_SESSION['cabang'] = $row['cabang'];
    $_SESSION['ktp'] = $row['ktp'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['image'] = $row['image'];
    $_SESSION['alamat'] = $row['alamat'];
    $_SESSION['panggilan'] = $row['designation'];
    $_SESSION['referensi'] = $row['referensi'];
    $_SESSION['bank'] = $row['ban'];
    $_SESSION['norek'] = $row['norek'];
    $_SESSION['anrek'] = $row['anrek'];
    $_SESSION['kelurahan'] = $row['kelurahan'];
    $_SESSION['kecamatan'] = $row['kecamatan'];
    $_SESSION['kota'] = $row['kota'];
    $_SESSION['mobile'] = $row['mobile'];
    $_SESSION['gender'] = $row['gender'];
    $_SESSION['status'] = $row['status'];      
}  


if(isset ($_POST['pilihmitra']))
{	    
    if($_POST['idMitra']=='Pilih Mitra')
    {
        $sql = "SELECT * FROM users Where email='admin@admin.com'";	
        $hasil = mysqli_query($db, $sql);
        while($row = mysqli_fetch_assoc($hasil))
        {
            $idMitra = $row['id'] ; 
            unset($_SESSION['id'] );
            unset($_SESSION['name'] );
            unset($_SESSION['cabang']);
            unset($_SESSION['ktp'] );
            unset($_SESSION['email'] );
            unset($_SESSION['image'] );
            unset($_SESSION['alamat']);
            unset($_SESSION['panggilan']);
            unset($_SESSION['referensi']);
            unset($_SESSION['bank'] );
            unset($_SESSION['norek'] );
            unset($_SESSION['anrek'] );
            unset($_SESSION['kelurahan'] );
            unset($_SESSION['kecamatan']);
            unset($_SESSION['kota'] );
            unset($_SESSION['mobile'] );
            unset($_SESSION['gender'] );
            unset($_SESSION['status']);                  
        }        
    } 
    else 
    {  
        $idMitra = $_POST['idMitra'];
    }
        
    $sql = "SELECT * FROM users Where id=".$idMitra;	
    $hasil = mysqli_query($db, $sql);
    while($row = mysqli_fetch_assoc($hasil))
    {
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['cabang'] = $row['cabang'];
        $_SESSION['ktp'] = $row['ktp'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['image'] = $row['image'];
        $_SESSION['alamat'] = $row['alamat'];
        $_SESSION['panggilan'] = $row['designation'];
        $_SESSION['referensi'] = $row['referensi'];
        $_SESSION['bank'] = $row['ban'];
        $_SESSION['norek'] = $row['norek'];
        $_SESSION['anrek'] = $row['anrek'];
        $_SESSION['kelurahan'] = $row['kelurahan'];
        $_SESSION['kecamatan'] = $row['kecamatan'];
        $_SESSION['kota'] = $row['kota'];
        $_SESSION['mobile'] = $row['mobile'];
        $_SESSION['gender'] = $row['gender'];
        $_SESSION['status'] = $row['status'];      
    }  
}

$idedit = $_SESSION['id'];
$NamaUser = $_SESSION['name'];
$cabangUser = $_SESSION['cabang'];
$image = $_SESSION['image'];
$alamatUser = $_SESSION['alamat']." Kel. ".$_SESSION['kelurahan']." Kec. ".$_SESSION['kecamatan']." Kota/kab. ".$_SESSION['kota'];
$NoTelponUser =  $_SESSION['mobile'];
$Gender = $_SESSION['gender'];
if($Gender=="Male") {$Gender=Pak;}
else if($Gender=="Female") {$Gender=Bu;}
else {$Gender="";}
$statusUser = $_SESSION['status'] ;
$noRek = $_SESSION['norek']; 
$anRek = $_SESSION['anrek'];  
$bank = $_SESSION['bank']; 
$referensi =  $_SESSION['referensi'];  
$panggilan =  $_SESSION['panggilan'];
$noKtp =  $_SESSION['ktp'];
$email = $_SESSION['email'];

//data kolam plasma
$sql = "SELECT  id FROM kolam WHERE id_pemilik = ".$idedit." AND jenis = 'Plasma'";
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

	$sql = "INSERT INTO monitor (suhu_air, ph_air, kematian, berat_pakan, kondisi_air, kondisi_ikan, tanggal, id_kolam) VALUES("
	.$monitorSuhuAir.",".$monitorPHAir.",".$monitorKematian.",".$monitorBeratPakan.",'".$monitorKondisiAir."','".$monitorKondisiIkan."','".$monitorTanggal."',".$monitorIdKolam.")";
	// die($sql);
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
	<title>Admin DHD</title>
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
    <!-- daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
      <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

	<script type= "text/javascript" src="../vendor/countries.js"></script>
</head>
<body>
<?php


//data sampling mandiri
for ($q=0; $q < $jumlahKolamMandiri; $q++) 
{ 
    $kumpulan_id_kolam .= "id_kolam= " .$idKolamMandiri[$q] . ' OR  ';
}
$sql = "SELECT  * FROM sampling Where ". substr($kumpulan_id_kolam, 0, -5);

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

    $sql = "SELECT  * FROM sampling Where ". substr($kumpulan_id_kolam, 0, -5);

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



// $jumlahKolamPlasma=0;
// for ($i=0; $i < count($dataKolam); $i++) 
// { 
//     if($dataKolam[$i]['jenis']=="Plasma")
//     { 
//         $jumlahKolamPlasma++;        
//     }         
// }

// $jumlahKolamMandiri=0;
// for ($i=0; $i < count($dataKolam); $i++) 
// {
//     if($dataKolam[$i]['jenis']=="Mandiri")
//     { 
//         $jumlahKolamMandiri++;
//     }
// }


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

$halaman = 10;
$pages = ceil($jumlahKolamPlasma/$halaman);
$page    =isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
$mulai    =($page>1) ? ($page * $halaman) - $halaman : 0;

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
            <h1>TES KYO</h1>
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
                       src="images/<?php echo $image;?>"
                       alt="User profile picture" style="width:100px; height:100px; border-radius:50%; margin:10px;  object-fit: cover; ">
				</div>
                <h3 class="profile-username text-center"><?php echo $NamaUser;?></h3>

                <p class="text-muted text-center"><?php echo "Mitra ".$cabangUser;?></p>

                <ul class="list-group list-group-unbordered mb-3">

    <?php if(!($idedit==123)){ ?>
                <li class="list-group-item">
                    <b>Kolam Plasma</b> <a class="float-right"><?php 
                    echo jumlahKolamByJenisMitra("Plasma", $idedit); ?></a>                    
                </li>
                <li class="list-group-item">
                    <b>Kolam Mandiri</b> <a class="float-right"><?php
                    echo jumlahKolamByJenisMitra("Mandiri", $idedit); ?></a>
                </li>
    <?php } ?>


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
                <p class="text-muted"><?php echo $NamaUser;?></p>

                <strong><i class="fas fa-id-card mr-1"></i> No KTP</strong>
                <p class="text-muted"><?php echo $noKtp;?></p>

                <strong><i class="fas fa-map-marked-alt mr-1"></i> Cabang Pelayanan</strong>
                <p class="text-muted"><?php echo $cabangUser;?></p>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>
                <p class="text-muted"><?php echo $alamatUser;?></p>

                <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
                <p class="text-muted"><?php echo $email;?></p>

                <strong><i class="fas fa-mobile-alt mr-1"></i> No Hp</strong>
                <p class="text-muted"><?php echo $NoTelponUser;?></p>

                <strong><i class="fas fa-money-check-alt mr-1"></i> Data Rek Bank</strong>
                <p class="text-muted"><?php echo "Bank: ".$bank."<br>No Rek: ".$noRek."<br>Atas Nama: ".$anRek;?></p>
                </span>

                </div class="width-10">   
            </div>            
        </div> <!-- PENUTUP About Me Box -->
               <!-- /.col -->
         <div class="col-md-9">
		    <label class="mt-2">Pilih Mitra</label>				
			<form method = "POST">	
				<select class="form-control" value="" name="idMitra">	
					<option selected="selected" style="display:none; color:red" >Pilih Mitra</option>											
					<?php for($i=0; $i<count($arrayNamaUser); $i++){ ?>	
							<option name="idMitra1" value ="<?php echo $arrayIdUser[$i]; ?>" id=""><?php echo ucwords(strtolower(($arrayNamaUser[$i]))); ?></option>
					<?php } ?>	
				</select>
				<input class="mt-3  pt-2 pb-2 btn btn-info" type="submit" name="pilihmitra" value="Pilih Mitra">	
			</form>	

				<?php 
				
				if(!($NamaUser=='Admin')){ 
                    $hideAdmin="";
                    $hideMitra = "d-none";
                    } else{$hideAdmin="d-none"; $hideMitra = "";} ?>	                   
                   <h4 class="<?php echo $hideAdmin?>">Data : <?php echo $Gender." ".ucwords($NamaUser); ?></h4>
            <div class="card"> <!-- buka card -->
                <div class="card-header p-2"> <!-- buka header -->
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#dashboard" data-toggle="tab">Dashboard</a></li>
                        <li class="nav-item <?php echo $hideAdmin?> "><a class="nav-link" href="#inputdata" data-toggle="tab">Input Data</a></li>	
                    </ul>
                </div> <!-- tutup header -->     
              	<div class="card-body mb-5"> <!-- buka card-body -->	
					<div class="tab-content mb-5">
<!-- DASHBOARD -->
                    <div class="active tab-pane" id="dashboard">
                        <div class="container-fluid">   
                            <?php for ($i=1; $i <= $pages; $i++) { ?>    
                                <a class="btn btn-info mb-2" href="admin.php?halaman=<?php echo $i; ?>" style="text-decoration:none"><u><?php echo $i; ?></u></a>
                            <?php } ?>										
                            <div class="row"> 
                            <?php 

                            // 11/08/2019 - 12/07/2019
                            if(isset($_POST ['filter'])){
                                $tahunMulai = substr(($_POST['filtertanggal']),6,4);
                                $tanggalMulai = substr(($_POST['filtertanggal']),3,2);
                                $bulanMulai = substr(($_POST['filtertanggal']),0,2);

                                $tahunAkhir = substr(($_POST['filtertanggal']),-4,4);
                                $tanggalAkhir = substr(($_POST['filtertanggal']),-7,2);
                                $bulanAkhir = substr(($_POST['filtertanggal']),-10,2);                                  
                                                             
                                $tanggalMulai = $tahunMulai."-".$bulanMulai."-".$tanggalMulai;
                                $tanggalAkhir = $tahunAkhir."-".$bulanAkhir."-".$tanggalAkhir;                                

                               $jumlahPlasmaPending = jumlahKolamTanggal('Plasma','Pending', $tanggalMulai, $tanggalAkhir);
                               $jumlahPlasmaBooking =jumlahKolamTanggal('Plasma','Booking', $tanggalMulai, $tanggalAkhir);
                               $jumlahPlasmaPemasangan = jumlahKolamTanggal('Plasma','Pemasangan', $tanggalMulai, $tanggalAkhir);
                               $jumlahPlasmaTerpasang = jumlahKolamTanggal('Plasma','Terpasang', $tanggalMulai, $tanggalAkhir);
                               $jumlahPlasmaTotal =  $jumlahPlasmaPending + $jumlahPlasmaBooking + $jumlahPlasmaTerpasang;

                               $jumlahMandiriPending = jumlahKolamTanggal('Mandiri','Pending', $tanggalMulai, $tanggalAkhir);
                               $jumlahMandiriPending = jumlahKolamTanggal('Mandiri','Pending', $tanggalMulai, $tanggalAkhir);
                               $jumlahMandiriBooking = jumlahKolamTanggal('Mandiri','Booking', $tanggalMulai, $tanggalAkhir);
                               $jumlahMandiriPemasangan = jumlahKolamTanggal('Mandiri','Pemasangan', $tanggalMulai, $tanggalAkhir);
                               $jumlahMandiriTerpasang = jumlahKolamTanggal('Mandiri','Terpasang', $tanggalMulai, $tanggalAkhir);
                               $jumlahMandiriTotal =  $jumlahMandiriPending + $jumlahMandiriBooking + $jumlahMandiriTerpasang;
                               echo "<h4>Filter dari:<br> ". tgl_indo($tanggalMulai). " - ".tgl_indo($tanggalAkhir)."</h4>";  
                            }                           
                            ?>      
                             <div class="input-group <?php echo $hideMitra?>">
                             <div class="input-group mb-3">
                                    <form action="" Method="POST">                                        
                                        <input type="text"  id="daterange-btn" name="filtertanggal">                                        
                                        <input type="submit" name="filter" class="btn btn-info  ml-1" value="Filter">
                                        <a href="admin.php" class="btn btn-info  ml-1">Reset</a>	
                                    </form>	
                                       
                                    </div>
                                </div>                       



                                <?php 

                                if($statusUser==2){  
                                    
                                    ?>                              
                                    

                                                 <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-warning">
                                                    <div class="inner">
                                                        <h3><?php echo jumlahMitra(); ?></h3>

                                                        <h5>Jumlah Mitra</h5>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="fas fa-user-plus"></i>
                                                    </div>
                                                    <a href="#" class="small-box-footer">
                                                        Selengkapnya <i class="fas fa-arrow-circle-right"></i>
                                                    </a>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-warning">
                                                    <div class="inner">
                                                        <h3><?php echo  $jumlahKolam; ?></h3>

                                                        <h5>Jumlah Kolam</h5>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="fas fa-user-plus"></i>
                                                    </div>
                                                    <a href="#" class="small-box-footer">
                                                        Selengkapnya <i class="fas fa-arrow-circle-right"></i>
                                                    </a>
                                                    </div>
                                                </div>


                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-info">
                                                    <div class="inner">
                                                        <h3><?php echo $jumlahPlasmaTotal; ?></h3>

                                                        <h5>Jumlah Kolam Plasma</h5>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="fas fa-shopping-cart"></i>
                                                    </div>
                                                    <a href="#" class="small-box-footer">
                                                        Selengkapnya <i class="fas fa-arrow-circle-right"></i>
                                                    </a>
                                                    </div>
                                                </div>


                                                <!-- ./col -->
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-success">
                                                    <div class="inner">
                                                        <h3><?php echo $jumlahMandiriTotal; ?></h3>
                                                        <h5>Jumlah Kolam mandiri</h5>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="ion ion-stats-bars"></i>
                                                    </div>
                                                    <a href="#" class="small-box-footer">
                                                        Selengkapnya <i class="fas fa-arrow-circle-right"></i>
                                                    </a>
                                                    </div>
                                                </div>
                                                <!-- ./col -->

                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-info">
                                                    <div class="inner">
                                                        <h3><?php echo $jumlahPlasmaTerpasang; ?></h3>

                                                        <h5>Kolam Plasma Terpasang</h5>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="fas fa-shopping-cart"></i>
                                                    </div>
                                                    <a href="#" class="small-box-footer">
                                                        Selengkapnya <i class="fas fa-arrow-circle-right"></i>
                                                    </a>
                                                    </div>
                                                </div>


                                                <!-- ./col -->
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-success">
                                                    <div class="inner">
                                                        <h3><?php echo $jumlahMandiriTerpasang; ?></h3>
                                                        <h5>Kolam Mandiri Terpasang</h5>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="ion ion-stats-bars"></i>
                                                    </div>
                                                    <a href="#" class="small-box-footer">
                                                        Selengkapnya <i class="fas fa-arrow-circle-right"></i>
                                                    </a>
                                                    </div>
                                                </div>
                                                <!-- ./col -->


                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-info">
                                                    <div class="inner">
                                                        <h3><?php echo $jumlahPlasmaPemasangan; ?></h3>

                                                        <h5>Kolam Plasma Masa Pemasangan</h5>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="fas fa-shopping-cart"></i>
                                                    </div>
                                                    <a href="#" class="small-box-footer">
                                                        Selengkapnya <i class="fas fa-arrow-circle-right"></i>
                                                    </a>
                                                    </div>
                                                </div>


                                                <!-- ./col -->
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-success">
                                                    <div class="inner">
                                                        <h3><?php echo $jumlahMandiriPemasangan; ?></h3>
                                                        <h5>Kolam Mandiri Masa Pemasangan</h5>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="ion ion-stats-bars"></i>
                                                    </div>
                                                    <a href="#" class="small-box-footer">
                                                        Selengkapnya <i class="fas fa-arrow-circle-right"></i>
                                                    </a>
                                                    </div>
                                                </div>
                                                <!-- ./col -->

                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-info">
                                                    <div class="inner">
                                                        <h3><?php echo $jumlahPlasmaBooking; ?></h3>

                                                        <h5>Kolam Plasma Booking</h5>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="fas fa-shopping-cart"></i>
                                                    </div>
                                                    <a href="#" class="small-box-footer">
                                                        Selengkapnya <i class="fas fa-arrow-circle-right"></i>
                                                    </a>
                                                    </div>
                                                </div>


                                                <!-- ./col -->
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-success">
                                                    <div class="inner">
                                                        <h3><?php echo $jumlahMandiriBooking; ?></h3>
                                                        <h5>Kolam mandiri Booking</h5>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="ion ion-stats-bars"></i>
                                                    </div>
                                                    <a href="#" class="small-box-footer">
                                                        Selengkapnya <i class="fas fa-arrow-circle-right"></i>
                                                    </a>
                                                    </div>
                                                </div>
                                                <!-- ./col -->


                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-info">
                                                    <div class="inner">
                                                        <h3><?php echo $jumlahPlasmaPending; ?></h3>

                                                        <h5>Kolam Plasma Pending</h5>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="fas fa-shopping-cart"></i>
                                                    </div>
                                                    <a href="#" class="small-box-footer">
                                                        Selengkapnya <i class="fas fa-arrow-circle-right"></i>
                                                    </a>
                                                    </div>
                                                </div>


                                                <!-- ./col -->
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-success">
                                                    <div class="inner">
                                                        <h3><?php echo $jumlahMandiriPending; ?></h3>
                                                        <h5>Kolam Mandiri Pending</h5>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="ion ion-stats-bars"></i>
                                                    </div>
                                                    <a href="#" class="small-box-footer">
                                                        Selengkapnya <i class="fas fa-arrow-circle-right"></i>
                                                    </a>
                                                    </div>
                                                </div>
                                                <!-- ./col -->




                                            
                             <?php        
                                }

                            $NoMandiri=0; $NoPlasma=0;
                        
                            $dataKolam = dataKolamLimit($idedit,"Plasma", $mulai, $halaman);
                            $NoPlasma = $mulai;

                            
                            //Tampilan Dashboard Kolam Plasma
                            for ($i=0; $i < count($dataKolam); $i++) 
                            { 
                                if($dataKolam[$i]['jenis']=="Plasma")
                                { $NoPlasma++;?>				
                                    <div class="col-lg-6 col-12 h-75">	
                                        <div class="small-box bg-info "> <!-- small box -->
                                            <div class="inner">	                                            								
                                                <h3>Nomor Kolam : <?php echo $NoPlasma; ?></h3>
                                                <h5>Id Kolam: <?php echo $dataKolam[$i]['id'] ?></h5>
                                                <h5>Jenis Kolam: <?php echo $dataKolam[$i]['jenis'] ?></h5>
                                                <?php  if(!($dataKolam[$i]['tanggal_penyelesaian'] == "0000-00-00")){}	
                                                    else if( !($dataKolam[$i]['tanggal_pasang']=="0000-00-00")){                                                
                                                        echo" <h5 ><span class='bg-primary pl-1 pr-1'>Status: Masa pemasangan </span><a class='text-light' data-toggle='collapse' href='#collapsePasangKolam".$i."' aria-controls='collapseExample'> --> ubah status</a><h5>";
                                                    }
                                                    else if( !($dataKolam[$i]['tanggal_booking']=="0000-00-00")){											
                                                        echo" <h5><span class='bg-light pl-1 pr-1'>Status: Booking </span><a class='text-light' data-toggle='collapse' href='#collapsePasangKolam".$i."' aria-controls='collapseExample'> --> ubah status</a> <h5>";
                                                    }else {
                                                        echo" <h5><span class='bg-warning pl-1 pr-1'>Status: Pending </span><a class='text-light' data-toggle='collapse' href='#collapsePasangKolam".$i."' aria-controls='collapseExample'> --> ubah status</a> <h5>";
                                                    }?>
                                                <div class="collapse" id="collapsePasangKolam<?php echo $i ?>">
                                                    <form method="POST">
                                                        <input type="hidden" name="idkolam" value ="<?php echo $dataKolam[$i]['id']; ?>"><?php 
                                                        if( !($dataKolam[$i]['tanggal_pasang']=="0000-00-00")){?>	
                                                        <label class="mt-2">Tanggal Penyelesaian</label>
                                                        <input type="date" name="tanggalpenyelesaian" class="form-control" > <?php } 
                                                        else if( !($dataKolam[$i]['tanggal_booking']=="0000-00-00")){?>	
                                                        <label class="mt-2">Tanggal Pemasangan</label>
                                                        <input type="date" name="tanggalpemasangan" class="form-control">
                                                        <label class="mt-2">Tanggal Penyelesaian</label>
                                                        <input type="date" name="tanggalpenyelesaian" class="form-control" ><?php } 
                                                        else {?>
                                                        <label class="mt-2">Tanggal Booking</label>
                                                        <input type="date" name="tanggalbooking" class="form-control">                                                
                                                        <label class="mt-2">Tanggal Pemasangan</label>
                                                        <input type="date" name="tanggalpemasangan" class="form-control">    
                                                        <label class="mt-2">Tanggal Penyelesaian</label>
                                                        <input type="date" name="tanggalpenyelesaian" class="form-control" ><?php } ?>                                                
                                                        <input class="mt-3  pt-2 pb-2 btn bg-black" type="submit" value="Simpan" name="pasangkolam">
                                                    </form>									
                                                </div>				
                                            </div><?php 

                                            if(!($dataKolam[$i]['tanggal_penyelesaian'] == "0000-00-00"))
                                            { ?>
                                            <a href="#collapseExamplem<?php echo $i; ?>" data-toggle="collapse" class="small-box-footer">Selengkapnya<i class="fas fa-arrow-circle-right"></i></a><?php 
                                            } ?>
                                            
                                        <div class="collapse" id="collapseExamplem<?php echo $i; ?>">	

                                        
                                        <?php include('input.php');?>
                                                        
                                                                       
                                                <div class="p-3 text-left bg-info"><?php 
                                                    for ($g=0; $g < count($dataKolam[$i]['monitor']); $g++) 
                                                    { 
                                                        $tanggal = $dataKolam[$i]['monitor'][$g]['tanggal'];                                 
                                                        $kematian = $dataKolam[$i]['monitor'][$g]['kematian'];
                                                        $totalKematian = $totalKematian+$dataKolam[$i]['monitor'][$g]['kematian'];
                                                        $jumlahIkan =  $dataKolam[$i]['bibit'][0]['populasi']-$totalKematian;   
                                                        $phAir = $dataKolam[$i]['monitor'][$g]['ph_air'];
                                                        $suhuAir = $dataKolam[$i]['monitor'][$g]['suhu_air'];
                                                        $kondisiAir = $dataKolam[$i]['monitor'][$g]['kondisi_air'] ;
                                                        $kondisiIkan = $dataKolam[$i]['monitor'][$g]['kondisi_ikan'] 
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
                                                        </table><?php  
                                                    } $totalKematian=0; ?>
                                                </div>                                                    
                                            </div>                                                        
                                        </div>				
                                    </div>                                    
                                    <?php                                             
                                }
                            }?>
                            </div>

                            <div class="card <?php echo $hideAdmin?>">   
                                <div class="card-body table-responsive pt-2">
                                <!-- <table class="table table-hover"> -->
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Permintaan</th>
                                        <th>Periode Pakan</th>
                                        <th>Periode Pemeliharaan</th>
                                        <th>Kolam Ke</th>
                                        <th>Ukuran Ikan</th>
                                        <th>Populasi Awal Masuk (Ekor)</th>
                                        <th>Jumlah Kematian (Ekor)</th>
                                        <th>Populasi Ikan Hidup(Ekor)</th>
                                        <th>Populasi Sampling</th>
                                        <th>Berat Sampling</th>
                                        <th>Berat Rata-rata</th>
                                        <th>Berat Total</th>
                                        <th>FR (%)</th>
                                        <th>Pakan Per Hari (gr)</th>
                                        <th>Total Pakan</th>
                                        <th>Ukuran Pakan</th>
                                        <th>Tanggal Penerimaan Pakan</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        
                                <?php            $list=0;                   
                                for ($z=0; $z < count($dataKolam); $z++) {  $list++;?>
                                    <tr>
                                        <td> <?= $list; ?> </td>
                                        <td>175</td>
                                        <td>175</td>
                                        <td>175</td>
                                        <td>175</td>
                                        <td>175</td>
                                        <td>175</td>
                                        <td>175</td>
                                        <td>175</td>
                                        <td>175</td>
                                        <td>175</td>
                                        <td>175</td>
                                        <td>175</td>
                                        <td>175</td>
                                        <td>175</td>
                                        <td>175</td>
                                        <td>175</td>
                                        <td>175</td> 
                                    </tr>     
                                <?php } ?>                               
                                    </tbody>
                                </table>
                                </div>
                            </div> 
	                                
                            <div class="row"> <?php 
                            //Tampilan Dashboard Kolam Mandiri
                            for ($i=0; $i < count($dataKolam); $i++) 
                            { 
                                if($dataKolam[$i]['jenis']=="Mandiri")
                                { $NoMandiri++;?>				
                                    <div class="col-lg-6 col-12 h-75">	
                                        <div class="small-box bg-success "> <!-- small box -->
                                            <div class="inner">										
                                                <h3>Nomor Kolam : <?php echo $NoMandiri; ?></h3>
                                                <h5>Jenis Kolam: <?php echo $dataKolam[$i]['jenis'] ?></h5>
                                                <?php  if(!($dataKolam[$i]['tanggal_penyelesaian'] == "0000-00-00")){}	
                                                    else if( !($dataKolam[$i]['tanggal_pasang']=="0000-00-00")){                                                
                                                        echo" <h5><span class='bg-primary pl-1 pr-1'>Status: Masa pemasangan </span><a class='text-light' data-toggle='collapse' href='#collapsePasangKolam".$i."' aria-controls='collapseExample'> --> ubah status</a><h5>";
                                                    }
                                                    else if( !($dataKolam[$i]['tanggal_booking']=="0000-00-00")){											
                                                        echo" <h5><span class='bg-light pl-1 pr-1'>Status: Booking </span><a class='text-light' data-toggle='collapse' href='#collapsePasangKolam".$i."' aria-controls='collapseExample'> --> ubah status</a> <h5>";
                                                    }else {
                                                        echo" <h5><span class='bg-warning pl-1 pr-1'>Status: Pending </span><a class='text-light' data-toggle='collapse' href='#collapsePasangKolam".$i."' aria-controls='collapseExample'> --> ubah status</a> <h5>";
                                                    }?>
                                                <div class="collapse" id="collapsePasangKolam<?php echo $i ?>">
                                                    <form method="POST">
                                                        <input type="hidden" name="idkolam" value ="<?php echo $dataKolam[$i]['id']; ?>"><?php 
                                                        if( !($dataKolam[$i]['tanggal_pasang']=="0000-00-00")){?>	
                                                        <label class="mt-2">Tanggal Penyelesaian</label>
                                                        <input type="date" name="tanggalpenyelesaian" class="form-control" > <?php } 
                                                        else if( !($dataKolam[$i]['tanggal_booking']=="0000-00-00")){?>	
                                                        <label class="mt-2">Tanggal Pemasangan</label>
                                                        <input type="date" name="tanggalpemasangan" class="form-control">
                                                        <label class="mt-2">Tanggal Penyelesaian</label>
                                                        <input type="date" name="tanggalpenyelesaian" class="form-control" ><?php } 
                                                        else {?>
                                                        <label class="mt-2">Tanggal Booking</label>
                                                        <input type="date" name="tanggalbooking" class="form-control">                                                
                                                        <label class="mt-2">Tanggal Pemasangan</label>
                                                        <input type="date" name="tanggalpemasangan" class="form-control">    
                                                        <label class="mt-2">Tanggal Penyelesaian</label>
                                                        <input type="date" name="tanggalpenyelesaian" class="form-control" ><?php } ?>                                                
                                                        <input class="mt-3  pt-2 pb-2 btn bg-black" type="submit" value="Simpan" name="pasangkolam">
                                                    </form>									
                                                </div>				
                                            </div><?php 

                                            if(!($dataKolam[$i]['tanggal_penyelesaian'] == "0000-00-00"))
                                            { ?>
                                            <a href="#collapseExamplem<?php echo $i; ?>" data-toggle="collapse" class="small-box-footer">Selengkapnya<i class="fas fa-arrow-circle-right"></i></a><?php 
                                            } ?>
                                            
                                        <div class="collapse" id="collapseExamplem<?php echo $i; ?>">


                                                    
                                        <!-- Input Data Pemasangan Kolam -->
                                        <a class="ezufont btn btn-info btn-block mb-1" data-toggle="collapse" href="#collapsePasangKolam" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        Input Data Pemasangan Kolam</a>
                                        <div class="collapse" id="collapsePasangKolam">
                                            <div class="card card-body">
                                            <form method="POST">								
                                                <label class="mt-2">No Kolam</label>                                        
                                                <select class="form-control" value="" name="idkolam">
                                                    <?php  
                                                    $NoKolamPlasma=0; $NoKolamMandiri=0;                                          
                                                    for($j=0; $j<count($dataKolam); $j++)
                                                    {                                                 
                                                        if($dataKolam[$j]['jenis']=="Plasma")
                                                        { $NoKolamPlasma++; ?>
                                                            <option class="text-info" name="idkolam1" value ="<?php echo $dataKolam[$j]['id']; ?>" id=""><?php echo "No Kolam ".$dataKolam[$j]['jenis'].": ".$NoKolamPlasma; ?></option>
                                                        <?php } 
                                                    }  
                                                    
                                                    for($k=0; $k<count($dataKolam); $k++)
                                                    {                                                 
                                                        if($dataKolam[$k]['jenis']=="Mandiri")
                                                        { $NoKolamMandiri++;  ?>
                                                            <option class="text-success" name="idkolam1" value ="<?php echo $dataKolam[$k]['id']; ?>" id=""><?php echo "No Kolam ".$dataKolam[$k]['jenis'].": ".$NoKolamMandiri; ?></option>
                                                        <?php } 
                                                    } ?>	
                                                </select>									
                                            
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
                                                        <label class="mt-2">No Kolam</label>                                        
                                                        <select class="form-control" value="" name="idkolam">
                                                            <?php  
                                                            $NoKolamPlasma=0; $NoKolamMandiri=0;                                          
                                                            for($j=0; $j<count($dataKolam); $j++)
                                                            {                                                 
                                                                if($dataKolam[$j]['jenis']=="Plasma")
                                                                { $NoKolamPlasma++; ?>
                                                                    <option class="text-info" name="idkolam1" value ="<?php echo $dataKolam[$j]['id']; ?>" id=""><?php echo "No Kolam ".$dataKolam[$j]['jenis'].": ".$NoKolamPlasma; ?></option>
                                                                <?php } 
                                                            }  
                                                            
                                                            for($k=0; $k<count($dataKolam); $k++)
                                                            {                                                 
                                                                if($dataKolam[$k]['jenis']=="Mandiri")
                                                                { $NoKolamMandiri++;  ?>
                                                                    <option class="text-success" name="idkolam1" value ="<?php echo $dataKolam[$k]['id']; ?>" id=""><?php echo "No Kolam ".$dataKolam[$k]['jenis'].": ".$NoKolamMandiri; ?></option>
                                                            <?php } 
                                                            } ?>	
                                                        </select>

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
                                                        <label class="mt-2">No Kolam</label>                                        
                                                        <select class="form-control" value="" name="idkolam">
                                                            <?php  
                                                            $NoKolamPlasma=0; $NoKolamMandiri=0;                                          
                                                            for($j=0; $j<count($dataKolam); $j++)
                                                            {                                                 
                                                                if($dataKolam[$j]['jenis']=="Plasma")
                                                                { $NoKolamPlasma++; ?>
                                                                    <option class="text-info" name="idkolam1" value ="<?php echo $dataKolam[$j]['id']; ?>" id=""><?php echo "No Kolam ".$dataKolam[$j]['jenis'].": ".$NoKolamPlasma; ?></option>
                                                                <?php } 
                                                            }  
                                                            
                                                            for($k=0; $k<count($dataKolam); $k++)
                                                            {                                                 
                                                                if($dataKolam[$k]['jenis']=="Mandiri")
                                                                { $NoKolamMandiri++;  ?>
                                                                    <option class="text-success" name="idkolam1" value ="<?php echo $dataKolam[$k]['id']; ?>" id=""><?php echo "No Kolam ".$dataKolam[$k]['jenis'].": ".$NoKolamMandiri; ?></option>
                                                            <?php } 
                                                            } ?>	
                                                        </select>
                                                        
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
                                                        <label class="mt-2">No Kolam</label>                                        
                                                        <select class="form-control" value="" name="idkolam">
                                                            <?php  
                                                            $NoKolamPlasma=0; $NoKolamMandiri=0;                                          
                                                            for($j=0; $j<count($dataKolam); $j++)
                                                            {                                                 
                                                                if($dataKolam[$j]['jenis']=="Plasma")
                                                                { $NoKolamPlasma++; ?>
                                                                    <option class="text-info" name="idkolam1" value ="<?php echo $dataKolam[$j]['id']; ?>" id=""><?php echo "No Kolam ".$dataKolam[$j]['jenis'].": ".$NoKolamPlasma; ?></option>
                                                                <?php } 
                                                            }  
                                                            
                                                            for($k=0; $k<count($dataKolam); $k++)
                                                            {                                                 
                                                                if($dataKolam[$k]['jenis']=="Mandiri")
                                                                { $NoKolamMandiri++;  ?>
                                                                    <option class="text-success" name="idkolam1" value ="<?php echo $dataKolam[$k]['id']; ?>" id=""><?php echo "No Kolam ".$dataKolam[$k]['jenis'].": ".$NoKolamMandiri; ?></option>
                                                            <?php } 
                                                            } ?>	
                                                        </select>

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
                                                        <label class="mt-2">No Kolam</label>                                        
                                                        <select class="form-control" value="" name="idkolam">
                                                            <?php  
                                                            $NoKolamPlasma=0; $NoKolamMandiri=0;                                          
                                                            for($j=0; $j<count($dataKolam); $j++)
                                                            {                                                 
                                                                if($dataKolam[$j]['jenis']=="Plasma")
                                                                { $NoKolamPlasma++; ?>
                                                                    <option class="text-info" name="idkolam1" value ="<?php echo $dataKolam[$j]['id']; ?>" id=""><?php echo "No Kolam ".$dataKolam[$j]['jenis'].": ".$NoKolamPlasma; ?></option>
                                                                <?php } 
                                                            }  
                                                            
                                                            for($k=0; $k<count($dataKolam); $k++)
                                                            {                                                 
                                                                if($dataKolam[$k]['jenis']=="Mandiri")
                                                                { $NoKolamMandiri++;  ?>
                                                                    <option class="text-success" name="idkolam1" value ="<?php echo $dataKolam[$k]['id']; ?>" id=""><?php echo "No Kolam ".$dataKolam[$k]['jenis'].": ".$NoKolamMandiri; ?></option>
                                                            <?php } 
                                                            } ?>	
                                                        </select>

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
                                                        
                                        <!-- Input Data Harian -->
                                        <a class="btn btn-info btn-block text-center mt-3" data-toggle="collapse" href="#collapseHarian<?php echo $i; ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        Input Data Harian</a> 
                                        <div class="collapse" id="collapseHarian<?php echo $i; ?>">
                                            <div class="card card-body bg-success"> 
                                                <form method="POST">	
                                                    <input  type="hidden" name="idkolam"  value ="<?php echo $dataKolam[$i]['id']; ?>">
                                                    
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


                                                <div class="p-3 text-left bg-success"><?php 
                                                    for ($g=0; $g < count($dataKolam[$i]['monitor']); $g++) 
                                                    { 
                                                        $tanggal = $dataKolam[$i]['monitor'][$g]['tanggal'];                                 
                                                        $kematian = $dataKolam[$i]['monitor'][$g]['kematian'];
                                                        $totalKematian = $totalKematian+$dataKolam[$i]['monitor'][$g]['kematian'];
                                                        $jumlahIkan =  $dataKolam[$i]['bibit'][0]['populasi']-$totalKematian;   
                                                        $phAir = $dataKolam[$i]['monitor'][$g]['ph_air'];
                                                        $suhuAir = $dataKolam[$i]['monitor'][$g]['suhu_air'];
                                                        $kondisiAir = $dataKolam[$i]['monitor'][$g]['kondisi_air'] ;
                                                        $kondisiIkan = $dataKolam[$i]['monitor'][$g]['kondisi_ikan'] 
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
                                                        </table><?php  
                                                    } $totalKematian=0; ?>
                                                </div>                                                    
                                            </div>                                                        
                                        </div>				
                                    </div><?php                                             
                                }
                            }

        
                            ?>
                                </div><!-- /.row -->
                            </div><!-- /.container-fluid -->
                        </div> <!-- tutup dashboard -->	
<!-- INPUT DATA -->							
                        <div class="tab-pane" id="inputdata">

                            <!-- Input jumlah kolam -->				
								<div class="card card-body">
									<form method="POST">
									<div class="text-center"> 
											<label class="mt-2">Jumlah Kolam Plasma</label>
											<input type="number" name="kolamplasma" class="form-control" min="1" max="100" placeholder=<?php echo '"'.$jumlahKolamPlasma.'"'?> >

											<label class="mt-2">Jumlah Kolam Mandiri</label>
											<input type="number" name="kolammandiri" class="form-control" min="1" max="100" placeholder=<?php echo '"'.$jumlahKolamMandiri.'"'?> >

											<input class="mt-3  pt-2 pb-2 btn btn-info" type="submit" name="tambahKolam" value="Input Data Kolam">	
										</div>
										
									</form>
								</div>
						
                            

                        </div> <!-- tutup input -->	
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
	<!-- <script src="js/jquery-1.9.0.min.js"></script> -->
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


 