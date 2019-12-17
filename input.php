<?php 

if($dataKolam[$i]['jenis']=="Mandiri")
{
    $warnaJenis = "btn-info";
} else  {  $warnaJenis = "btn-success";}

?>
<!-- Input Data Masuk Bibit-->

<?php if($masaPemeliharaan == 0){ ?>

<a class="ezufont btn  <?php echo $warnaJenis?> btn-block mb-1" data-toggle="collapse" href="#collapseBibitMasuk<?php echo $i ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
Input Data Bibit Masuk</a>
<div class="collapse" id="collapseBibitMasuk<?php echo $i ?>">
    <div class="card card-body">                                
            <form method="POST">										
                <input  type="hidden" name="idkolam"  value ="<?php echo $dataKolam[$i]['id']; ?>"> 

                <label class="mt-2 text-info">Populasi</label>
                <input type="number" name="populasibibit" class="form-control" Placeholder = "Jumlah bibit" required >
                
                <label class="mt-2 text-info">Ukuran Bibit</label>
                <input type="number" name="ukuranbibit" class="form-control" placeholder = "Ukuran bibit (cm)" required >
            
                <label class="mt-2 text-info">Berat Total Bibit</label>
                <input type="number" name="beratbibit" class="form-control" Placeholder = "Berat total bibit (kg)" required >

                <label class="mt-2 text-info">Periode Pemeliharaan</label>
                <input type="number" name="periode" class="form-control" Placeholder = "Periode pelihara" required >                
            
                <label class="mt-2 text-info">Tanggal Masuk</label>
                <input type="date" name="tanggalmasuk" class="form-control" required >

                <input class="mt-3  pt-2 pb-2 btn  <?php echo $warnaJenis?>" type="submit" name="bibitmasuk" value="Input Data">	
            </form>
        </div>
</div>

<?php } else { ?>

<!-- Input Data Sampling-->
<a class="ezufont btn  <?php echo $warnaJenis?> btn-block mb-1" data-toggle="collapse" href="#collapseSampling<?php echo $i ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
Input Data Sampling</a>
<div class="collapse" id="collapseSampling<?php echo $i ?>">
    <div class="card card-body">
            <form method="POST">										
                <input  type="hidden" name="idkolam"  value ="<?php echo $dataKolam[$i]['id']; ?>"> 
                
                <label class="mt-2 text-info">Populasi</label>
                <input type="number" name="populasisampling" class="form-control" Placeholder = "Jumlah ikan" required >
                
                <label class="mt-2 text-info">Ukuran Ikan</label>
                <input type="number" name="ukuransampling" class="form-control" placeholder = "Ukuran ikan (cm)" required >
                
                <label class="mt-2 text-info">Berat Total Sampling</label>
                <input type="number" name="beratsampling" class="form-control" placeholder = "berat total sampling (gram)" required >
                
                <label class="mt-2 text-info">Periode Pakan</label>
                <input type="number" name="periode" class="form-control" placeholder = "lebih dari 0" required >

                <label class="mt-2 text-info">Tanggal Sampling</label>
                <input type="date" name="tanggalsampling" class="form-control">
                
                <input class="mt-3  pt-2 pb-2 btn  <?php echo $warnaJenis?>" type="submit" name="sampling" value="Input Data">	
            </form>
        </div>
</div>

<!-- Input Data Masuk Pakan-->
<a class="ezufont btn  <?php echo $warnaJenis?> btn-block mb-1" data-toggle="collapse" href="#collapsePakanMasuk<?php echo $i ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
Input Data Pakan Masuk</a>
<div class="collapse" id="collapsePakanMasuk<?php echo $i ?>">
    <div class="card card-body">
            <form method="POST">										
            
                <input  type="hidden" name="idkolam"  value ="<?php echo $dataKolam[$i]['id']; ?>">

                <label class="mt-2 text-info">Jenis Pakan</label>
                <input type="number" name="jenispakan" class="form-control" Placeholder = "Jenis pakan" required >
                
                <label class="mt-2 text-info">Jumlah Pakan Masuk</label>
                <input type="number" name="beratpakan" class="form-control" Placeholder = "Berat Pakan (kg)" required >
            
                <label class="mt-2 text-info">Tanggal Masuk</label>
                <input type="date" name="tanggalmasuk" class="form-control" required >

                <input class="mt-3  pt-2 pb-2 btn  <?php echo $warnaJenis?>" type="submit" name="pakanmasuk" value="Input Data">	
            </form>
        </div>
</div>


<!-- Input Data Panen-->
<a class="ezufont btn  <?php echo $warnaJenis?> btn-block mb-1" data-toggle="collapse" href="#collapsePanen<?php echo $i ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
Input Data Panen</a>
<div class="collapse" id="collapsePanen<?php echo $i ?>">
    <div class="card card-body">
            <form method="POST">										
                <input  type="hidden" name="idkolam"  value ="<?php echo $dataKolam[$i]['id']; ?>">

                <label class="mt-2 text-info">Berat Total</label>
                <input type="number" name="berattotal" class="form-control" Placeholder = "Berat total panen (kg)" required >
                
                <label class="mt-2 text-info">Jumlah Ikan</label>
                <input type="number" name="populasi" class="form-control" Placeholder = "Jumlah ikan" required >
            
                <label class="mt-2 text-info">Tanggal Panen</label>
                <input type="date" name="tanggalpanen" class="form-control" required >

                <input class="mt-3  pt-2 pb-2 btn  <?php echo $warnaJenis?>" type="submit" name="panen" value="Input Data">	
            </form>
        </div>
</div> 	


<!-- Input Data Harian -->
 <a class="ezufont btn <?php echo $warnaJenis?> btn-block mb-1" data-toggle="collapse" href="#collapseHarian<?php echo $i; ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
Input Data Harian</a> 
<div class="collapse" id="collapseHarian<?php echo $i; ?>">
    <div class="card card-body"> 
        <form method="POST">	
            <input  type="hidden" name="idkolam"  value ="<?php echo $dataKolam[$i]['id']; ?>">
            
            <label class="mt-2 text-info">PH Air</label>
            <input type="number" name="phair" class="form-control" min="0" max="14" Placeholder = "Nilai Angka 0-14" required >

            <label class="mt-2 text-info">Suhu Air</label>
            <input type="number" name="suhuair" class="form-control" min="1" max="100"  Placeholder = "Nilai Angka 0-100" required >
            
            <label class="mt-2 text-info">Kematian</label>
            <input type="number" name="kematian" class="form-control" min="0"  Placeholder = "Nilai Minimum 0" required >

            <label class="mt-2 text-info">Berat Pakan</label>
            <input type="number" name="beratpakan" class="form-control" Placeholder = "Berat pakan dalam gram" required >
            
            <label class="mt-2 text-info">Kondisi Air</label>
            <input type="text" name="kondisiair" class="form-control" Placeholder = "Deskripsikan keadaan air saat ini" required >

            <label class="mt-2 text-info">Kondisi Ikan</label>
            <input type="text" name="kondisiikan" class="form-control"  Placeholder = "Deskripsikan keadaan ikan saat ini" required >
            
            <label class="mt-2 text-info">Tanggal Pengukuran</label>
            <input type="date" name="tanggalpengukuran" class="form-control"required >

            <input class="mt-3  pt-2 pb-2 btn <?php echo $warnaJenis?>" type="submit" name="monitorharian" value="Input Data" onClick="ajaxSubmit();">	
        </form>
    </div>		
</div>


<?php }?>
