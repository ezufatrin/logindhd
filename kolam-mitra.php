<?php

error_reporting(0);
include('includes/config.php');
include('proses.php');
if(strlen($_SESSION['alogin'])==0)
	{
header('location:login.php');
}
else{    
    include('awal.php');

//KONDISI KOLAM
$idUser = $_GET['idu'];
$noKolam = $_GET['no'];
$idKolam = $_GET['idk'];


$sql = "SELECT * FROM kolam WHERE id=".$idKolam;
$hasil = mysqli_query($db, $sql);
while($row = mysqli_fetch_assoc($hasil))
{
  $jenisKolam  = $row['jenis'];
  $statusKolam = $row['status'];
}

?>

<pre>
NO KOLAM  : <?= ($noKolam+1)?> 
ID KOLAM  : <?= $idKolam?> 
JENIS     : <?= $jenisKolam?> 
STATUS    : <?= $statusKolam?> 
<a href="profile.php"><-- Kembali ke Profile</a>
</pre>



<!-- DATA BIBIT -->
<?php 
$sql = "SELECT * FROM bibit WHERE id_kolam=".$idKolam." ORDER BY id DESC";
$hasil = mysqli_query($db, $sql);
while($row = mysqli_fetch_assoc($hasil))
{
    $beratBibit[] = $row['berat'];
    $ukuranBibit[] = $row['ukuran'];
    $populasiBibit[] = $row['populasi'];
    $tanggalMasukBibit[] = $row['tanggal_masuk'];
    $periodeBibit[] = $row['periode'];    	
}?>

<div class="card mt-3">
  <div class="card-header bg-info">
    <h1 class="card-title">DATA BIBIT</h1>
  </div>
  <div class="card-body">
    <table id="bibit" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>NO</th>
        <th>POPULASI</th>
        <th>UKURAN</th>
        <th>BERAT</th>
        <th>TANGGAL MASUK</th>
        <th>PERIODE</th>
      </tr>
      </thead>
      <tbody>
  <?php $list=0;                   
      for ($z=0; $z < count($beratBibit); $z++) {  $list++;?>
        <tr>
        <td><?php echo $y=$z+1;?></td>
        <td><?php echo $populasiBibit[$z];?></td>
        <td><?php echo $ukuranBibit[$z];?></td>
        <td><?php echo $beratBibit[$z];?></td>
        <td><?php echo tgl_indo($tanggalMasukBibit[$z]);?></td>
        <td><?php echo $periodeBibit[$z];?></td>
      </tr>
      <?php }?>
      </tfoot>
    </table>
  </div>
</div>



<!-- DATA SAMPLING -->
<?php 
$sql = "SELECT * FROM sampling WHERE id_kolam=".$idKolam." ORDER BY id DESC";
$hasil = mysqli_query($db, $sql);
while($row = mysqli_fetch_assoc($hasil))
{
    $populasiSampling[] = $row['populasi'];
    $ukuranSampling[] = $row['ukuran'];
    $beratSampling[] = $row['berat'];
    $tanggalSampling[] = $row['tanggal_sampling'];
    $periodePemeliharaan[] = $row['periode']; 
    $periodeSampling[] = $row['periode_sampling'];  
    $imageSampling[] = $row['image'];     	
}?>

<div class="card mt-3">
  <div class="card-header bg-info">
    <h1 class="card-title">DATA SAMPLING</h1>
  </div>
  <div class="card-body">
    <table id="sampling" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>NO</th>
        <th>POPULASI</th>
        <th>UKURAN</th>
        <th>BERAT</th>
        <th>TANGGAL SAMPLING</th>
        <th>PERIODE</th>
        <th>PERIODE SAMPLING</th>
        <th>GAMBAR</th>
      </tr>
      </thead>
      <tbody>
  <?php $list=0;                   
      for ($z=0; $z < count($populasiSampling); $z++) {  $list++;?>
        <tr>
        <td><?php echo $y=$z+1;?></td>
        <td><?php echo $populasiSampling[$z];?></td>
        <td><?php echo $ukuranSampling[$z];?></td>
        <td><?php echo $beratSampling[$z];?></td>
        <td><?php echo tgl_indo($tanggalSampling[$z]);?></td>
        <td><?php echo $periodePemeliharaan[$z];?></td>
        <td><?php echo $periodeSampling[$z];?></td>
        <td><img id="myImg" alt="Snow" style=" height:100;" src="images/<?php echo $imageSampling[$z];?>"></img></td>
      </tr>
      <?php }?>
      </tfoot>
    </table>
  </div>
</div>

<!-- DATA PAKAN -->
<?php 
$sql = "SELECT * FROM pakan WHERE id_kolam=".$idKolam." ORDER BY id DESC";
$hasil = mysqli_query($db, $sql);

  while($row = mysqli_fetch_assoc($hasil))
  {
    
      $jenisPakan[] = $row['jenis'];
      $beratPakan[] = $row['berat'];
      $tanggalMasukPakan[] = $row['tanggal_masuk'];
      $periodePakan[] = $row['periode'];  
  }

?>

<div class="card mt-3">
  <div class="card-header bg-info">
    <h1 class="card-title">DATA PAKAN</h1>
  </div>
  <div class="card-body">
    <table id="pakan" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>NO</th>
        <th>JENIS</th>
        <th>BERAT</th>
        <th>TANGGAL MASUK</th>
        <th>PERIODE</th>
      </tr>
      </thead>
      <tbody>
  <?php $list=0;                   
      for ($z=0; $z < count($jenisPakan); $z++) {  $list++;?>
        <tr>
        <td><?php echo $y=$z+1;?></td>
        <td><?php echo $jenisPakan[$z];?></td>
        <td><?php echo $beratPakan[$z];?></td>
        <td><?php echo tgl_indo($tanggalMasukPakan[$z]);?></td>
        <td><?php echo $periodePakan[$z];?></td>
      </tr>
      <?php }?>
      </tfoot>
    </table>
  </div>
</div>

<!-- DATA PANEN -->

<?php

$sql = "SELECT * FROM panen WHERE id_kolam=".$idKolam." ORDER BY id DESC";
$hasil = mysqli_query($db, $sql);
while($row = mysqli_fetch_assoc($hasil))
{
    $berat[] = $row['berat'];
    $populasi[] = $row['populasi'];
    $tanggalPanen[] = $row['tanggal_panen'];
    $periode[] = $row['periode']; 
}



$kountPer =count($periode)+1;
for ($z=1; $z < $kountPer; $z++) {
$sql = "SELECT sum(berat_pakan) as beratPakan FROM monitor WHERE id_kolam=".$idKolam." AND periode= ".$z;

$hasil = mysqli_query($db, $sql);
$beratPakan = mysqli_fetch_assoc($hasil)['beratPakan'];

$sql = "SELECT sum(berat) as beratBibit FROM bibit WHERE id_kolam=".$idKolam." AND periode= ".$z;

$hasil = mysqli_query($db, $sql);   
$beratBibit = mysqli_fetch_assoc($hasil)['beratBibit'];
$s= $z-1;
$delta = $berat[$s]-$beratBibit;
 
 $fcr[] = (int)$beratPakan/$delta;

}

?>

<div class="card mt-3">
  <div class="card-header bg-info">
    <h1 class="card-title">DATA PANEN</h1>
  </div>
  <div class="card-body">
    <table id="panen" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>NO</th>
        <th>PANEN KE</th>
        <th>TANGGAL PANEN</th>
        <th>POPULASI</th>
        <th>BERAT</th>
        <th>FCR</th>
      </tr>
      </thead>
      <tbody>
  <?php $list=0;                   
      for ($z=0; $z < count($berat); $z++) {  $list++;?>
        <tr>
        <td><?php echo $y=$z+1;?></td>
        <td><?php echo $periode[$z];?></td>
        <td><?php echo tgl_indo($tanggalPanen[$z]);?></td>
        <td><?php echo $populasi[$z];?></td>
        <td><?php echo $berat[$z];?></td>
        <td><?php echo round($fcr[$z]*100);?></td>
      </tr>
      <?php }?>
      </tfoot>
    </table>
  </div>
</div>
<?php
}

?>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#panen").DataTable();
    $("#bibit").DataTable();
    $("#sampling").DataTable();
    $("#pakan").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });


</script>
<!-- 
<script>
		window.print();
	</script> -->

  <style>


#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation */
.modal-content, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
  }

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
  
  </style>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
</script>