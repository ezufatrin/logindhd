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
    include('awal.php');
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
            <h1>ADMIN DHD FARM</h1>
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

                <a class="btn btn-info" href="https://api.whatsapp.com/send?phone=<?php echo "+62".ltrim($NoTelponUser,'0');?>&text=Assalamualaikum <?php echo $Gender;?>">Hubungi Mitra<i class="fab fa-whatsapp ml-2"></i></a>

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
                   <h4 class="<?php echo $hideAdmin?>">Data : <?php echo $Gender." ".ucwords($NamaUser); ?> <a class="btn btn-info mb-1 ml-1" href="hapus.php?user=<?php echo $idedit; ?>" onclick="return  confirm('Anda yakin menghapus user Y/N')"> Hapus User </a>
</h4>
            <div class="card"> <!-- buka card -->
                <div class="card-header p-2"> <!-- buka header -->
                    <ul class="nav nav-pills">
                    <?php  if($statusUser==2){ ?>
                        <li class="nav-item"><a class="nav-link active" href="#dashboard" data-toggle="tab">Dashboard</a></li>
                    <?php } else {                        
                        if($jumlahPlasmaTotal >0 && $aktif==1){$tabMandiri=""; $tabPlasma="active";?>
                        <li class="nav-item"><a class="nav-link active" href="#dataPlasma" data-toggle="tab">Data Plasma</a></li>
                        <li class="nav-item"><a class="nav-link" href="#dataMandiri" data-toggle="tab">Data Mandiri</a></li>
                    <?php } else if($jumlahMandiriTotal >0 && $aktif==2){  $tabMandiri="active"; $tabPlasma="";?>
                        <li class="nav-item"><a class="nav-link" href="#dataPlasma" data-toggle="tab">Data Plasma</a></li>
                        <li class="nav-item"><a class="nav-link active" href="#dataMandiri" data-toggle="tab">Data Mandiri</a></li>
                    <?php }else{ $tabMandiri=""; $tabPlasma="active";?>
                        <li class="nav-item"><a class="nav-link active" href="#dataPlasma" data-toggle="tab">Data Plasma</a></li>
                        <li class="nav-item"><a class="nav-link" href="#dataMandiri" data-toggle="tab">Data Mandiri</a></li>
                    <?php  }?>  
                        <li class="nav-item <?php echo $hideAdmin?> "><a class="nav-link" href="#inputdata" data-toggle="tab">Ubah Jumlah Kolam</a></li>	
                        <?php }?>
                    </ul>
                </div> <!-- tutup header -->     
              	<div class="card-body mb-5"> <!-- buka card-body -->	
					<div class="tab-content mb-5">
<!-- DASHBOARD -->
<?php  if($statusUser==2)
    { ?>
                    <div class="active tab-pane" id="dashboard">
                        <div class="container-fluid">                           								
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
                            </div>

                         
	                                
                            <div class="row"> 
                           
        
                                </div><!-- /.row -->
                            </div><!-- /.container-fluid -->
                        </div> <!-- tutup dashboard -->	
<?php }?>

<!-- PLASMA-->		

            <div class="<?php echo $tabPlasma;?> tab-pane" id="dataPlasma">
            <?php  if( $pagesPlasma>1){?>
                <nav aria-label="Page navigation example">
                    <ul class="pagination ml-2">
                        
                        <?php for ($i=1; $i <= $pagesPlasma; $i++) { ?>    
                            <li class="page-item mr-1"><a class="page-link" href="admin.php?halamanPlasma=<?php echo $i; ?>&aktif=1"><?php echo $i; ?></a></li>
                        <?php } ?>	
                        
                    </ul>
				</nav>
                <?php }?>
                <div class="container-fluid"> 
                    <div class="row"> 
                        <?php
                          
                        include('admin/dashboard_plasma.php');
                        ?>
                    </div>
                </div>
            </div>

<!-- MANDIRI -->		
            <div class="<?php echo $tabMandiri;?> tab-pane" id="dataMandiri">
            <?php  if( $pagesMandiri>1){?>
                <nav aria-label="Page navigation example">
					<ul class="pagination ml-2">
					
						<?php for ($i=1; $i <= $pagesMandiri; $i++) { ?>    
							<li class="page-item mr-1"><a class="page-link" href="admin.php?halamanMandiri=<?php echo $i; ?>&aktif=2"><?php echo $i; ?></a></li>
						<?php } ?>	
						
					</ul>
				</nav>
            <?php }?>
           
                <div class="container-fluid"> 
                    <div class="row"> 
<?php
      
                        include('admin/dashboard_mandiri.php');
?>
                    </div>
                </div>
            </div>



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


 