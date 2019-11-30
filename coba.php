<?php 

// include('proses.php');

// $ArrayIdKolamPlasma =idKolam($idUser, "Plasma", "aktif");
// $ArrayIdKolamMandiri = idKolam($idUser, "Mandiri", "aktif");

// foreach ($ArrayIdKolamPlasma as $arr){
//     echo $arr."<br>";
// }

// echo "plasma".count($ArrayIdKolamPlasma)."<br>";
// foreach ($ArrayIdKolamMandiri as $arr){
//     echo $arr."<br>";
// }
// echo "mandiri".count($ArrayIdKolamMandiri)."<br>";.
?>

 <div class="container">
 <div class="panel-group" id="accordion">
   <div class="panel panel-default">
     <div class="panel-heading">
       <h4 class="panel-title">
         <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">judul 1</a>
       </h4>
     </div>
     <div id="collapse1" class="panel-collapse collapse in">
       <div class="panel-body">isi 1</div>
     </div>
   </div>
   <div class="panel panel-default">
     <div class="panel-heading">
       <h4 class="panel-title">
         <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">judul 2</a>
       </h4>
     </div>
     <div id="collapse2" class="panel-collapse collapse">
       <div class="panel-body">isi 2</div>
     </div>
   </div>
   <div class="panel panel-default">
     <div class="panel-heading">
       <h4 class="panel-title">
         <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">judul 3</a>
       </h4>
     </div>
     <div id="collapse3" class="panel-collapse collapse">
       <div class="panel-body">isi 3</div>
     </div>
   </div>
 </div> 
</div>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

  <a class="btn btn-success btn-sm" href="#" role="button" data-toggle="modal" data-target="#contohModal">klik modal</a>
<div class="modal fade" id="contohModal" tabindex="-1" role="dialog" aria-labelledby="contohModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="titleModal">Contoh Modal</h4>
      </div>
      <div class="modal-body">
        ini contoh modal bootstrap
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>



<div class="alert alert-success" role="alert">Success</div>
<div class="alert alert-info" role="alert">Info</div>
<div class="alert alert-warning" role="alert">Warning</div>
<div class="alert alert-danger" role="alert">Danger</div>