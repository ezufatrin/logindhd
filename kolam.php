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

$noKolam = $_GET['halaman'];
$dataKolam = dataKolam($idedit)[$noKolam];
// echo '<pre>' . var_export($dataKolam, true) . '</pre>';

?>

<pre>
NO KOLAM  : <?= ($noKolam+1)?> 
ID KOLAM  : <?= $dataKolam['id']?> 
JENIS     : <?= $dataKolam['jenis']?> 
STATUS    : <?= $dataKolam['status']?> 
<a href="admin.php"><-- Kembali ke Admin</a>
</pre>

<?php

$sql = "SELECT * FROM panen WHERE id_kolam=".$dataKolam['id'];
$hasil = mysqli_query($db, $sql);
while($row = mysqli_fetch_assoc($hasil))
{
    $berat[] = $row['berat'];
    $populasi[] = $row['populasi'];
    $tanggalPanen[] = $row['tanggal_panen'];
    $periode[] = $row['periode'];    	
}
?>


<!-- DATA BIBIT -->
<?php 
$sql = "SELECT * FROM bibit WHERE id_kolam=".$dataKolam['id'];
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
$sql = "SELECT * FROM sampling WHERE id_kolam=".$dataKolam['id'];
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
        <td><img style=" height:100;" src="images/<?php echo $imageSampling[$z];?>"></img></td>
      </tr>
      <?php }?>
      </tfoot>
    </table>
  </div>
</div>

<!-- DATA PAKAN -->
<?php 
$sql = "SELECT * FROM pakan WHERE id_kolam=".$dataKolam['id'];

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