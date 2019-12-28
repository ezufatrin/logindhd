<?php
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
	
    if($_SESSION ['awal']==1){
        $idMitra =$idAdmin;
    }
   unset($_SESSION ['awal']);
   	
    $namaAdmin = $row['name'];
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
		header('location:admin.php');     
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

if(isset($_GET['user'])){

	if($_GET['user']==123)
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
		
		header('location:admin.php');
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
	$periode = $_POST['periode'];
	$IdKolam = $_POST['idkolam'];
	$sql = "INSERT INTO sampling (populasi, ukuran, berat, tanggal_sampling, id_kolam, periode, periode_sampling, image) VALUES("
	.$populasiSampling.",".$ukuranSampling.",".$beratSampling.",'".$tanggalSampling."',".$IdKolam.",".$periode.",".$periodeSampling.",'".$namabaru."')";
	if(mysqli_query($db, $sql)){
		$pesan = 1;
	} else {$pesan = 2;}

    

}

