<?php

$NoPlasma = $mulaiPlasma;
$dataKolam = dataKolamLimit($idedit,"Plasma", $mulaiPlasma, $halamanPlasma);   

for ($i=0; $i < count($dataKolam); $i++) 
{ 
    $NoPlasma=$NoPlasma+1;
    ?>				
        <div class="col-lg-6 col-12 h-75">	
            <div class="small-box bg-info "> <!-- small box -->
                <div class="inner">	                                            								
                    <h3>Nomor Kolam : <?php echo $NoPlasma; ?></h3>
                    <h5>Id Kolam: <?php echo $dataKolam[$i]['id'] ?></h5>
                    <h5>Jenis Kolam: <?php echo $dataKolam[$i]['jenis'] ?></h5>
                    <?php  if(!($dataKolam[$i]['tanggal_penyelesaian'] == "0000-00-00")){}	
                        else if( !($dataKolam[$i]['tanggal_pasang']=="0000-00-00")){                                                
                            echo" <h5 ><span class='bg-primary pl-1 pr-1'>Status: Masa pemasangan </span><a class='text-light' data-toggle='collapse' href='#collapsePasangKolamPlasma".$i."' aria-controls='collapseExample'> --> ubah status</a><h5>";
                        }
                        else if( !($dataKolam[$i]['tanggal_booking']=="0000-00-00")){											
                            echo" <h5><span class='bg-light pl-1 pr-1'>Status: Booking </span><a class='text-light' data-toggle='collapse' href='#collapsePasangKolamPlasma".$i."' aria-controls='collapseExample'> --> ubah status</a> <h5>";
                        }else {
                            echo" <h5><span class='bg-warning pl-1 pr-1'>Status: Pending </span><a class='text-light' data-toggle='collapse' href='#collapsePasangKolamPlasma".$i."' aria-controls='collapseExample'> --> ubah status</a> <h5>";
                        }?>
                    <div class="collapse" id="collapsePasangKolamPlasma<?php echo $i ?>">
               
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
                            <input class="mt-3  pt-2 pb-2 btn bg-success" type="submit" value="Simpan" name="pasangkolam">
                        </form>									
                    </div>				
                </div>
                
                <?php 

                if(!($dataKolam[$i]['tanggal_penyelesaian'] == "0000-00-00"))
                { ?>
                <a href="#collapseExamplemPlasma<?php echo $i; ?>" data-toggle="collapse" class="small-box-footer">Selengkapnya<i class="fas fa-arrow-circle-right"></i></a>
                
                <?php 
                } ?>
                
            <div class="collapse" id="collapseExamplemPlasma<?php echo $i; ?>">	
            <h4 class="ml-2" ><a href="kolam-mitra.php?halaman=<?php echo $i; ?>" class="text-white underline">Detail Kolam<i class="ml-2 fas fa-angle-double-right"></i></a></h4>
            <?php 
                    $sql = "SELECT periode FROM panen WHERE id_Kolam =". $dataKolam[$i]['id']." ORDER BY id DESC LIMIT 1"; 
                    $hasilpanen = mysqli_query($db, $sql);   
                    $periodePanen =mysqli_fetch_assoc($hasilpanen)['periode'];
                    
                    $sql = "SELECT * FROM bibit WHERE id_Kolam =". $dataKolam[$i]['id']." ORDER BY id DESC LIMIT 1";  
                    $hasilbibit = mysqli_query($db, $sql); 
                    $rowBibit = mysqli_fetch_assoc($hasilbibit);
                    $periode = $rowBibit['periode'];
                    $periode = $periode==NULL? 0 : $periode;

                    $sql = "SELECT SUM(kematian) as jumlahKematian FROM monitor WHERE id_Kolam =". $dataKolam[$i]['id']." AND periode = ".$periode."";  
                    $hasil = mysqli_query($db, $sql);    
                    $jumlahKematian =mysqli_fetch_assoc($hasil)['jumlahKematian'];
                    $jumlahKematian = $jumlahKematian==NULL? 0 : $jumlahKematian;
                              
                    if($periode==0 || $periode==NULL){
                        $masaPemeliharaan = 0;
                        echo " <p class='mt-3 mb-3 bg-danger'>";
                        echo " **BIBIT BELUM DIMASUKKAN KE DALAM KOLAM";
                        echo "</p>";
                    }
                    else if($periodePanen==$periode){
                        $masaPemeliharaan = 0;
                        echo " <p class='mt-3 mb-3 bg-danger'>";
                        echo "**SUDAH PANEN PERIODE ".$periodePanen.", NUNGGU MASUK BIBIT PERIODE ".($periode+1);
                        echo "</p>";                           

                    } else if($periodePanen<$periode){ 
                        $masaPemeliharaan = 1;
                    ?>    
                        
<pre style="font-size: 18px; color:white">
Periode Pemeliharaan :<?=  $periode;?> 
Jumlah Bibit         :<?=  $populasi= $rowBibit['populasi']; ?> ekor 
Ukuran Bibit         :<?=  $rowBibit['ukuran']; ?> cm
Berat Bibit          :<?= $rowBibit['berat']/1000; ?> kg
Tanggal Masuk Bibit  :<?=  $tanggalMasukBibit=tgl_indo($rowBibit['tanggal_masuk']); ?> 
Jumlah Kematian      :<?= $jumlahKematian; ?> ekor
Jumlah Ikan Hidup    :<?=  $populasi - $jumlahKematian; ?> ekor
</pre>
<?php     

                         $diff  = date_diff($tanggalMasuk, date_create());
                        if($diff->d >20){
                            $periodeSampling = 3;
                        } else if($diff->d =10){
                            $periodeSampling = 2;
                        } else {  $periodeSampling = 0; }                        

                    }    ?>
                                            
                    <div class="p-3 text-left bg-info"><?php 
                    $dataMonitor = count($dataKolam[$i]['monitor']);
                    if($dataMonitor>=10)
                    {
                        $batas =10;
                    } else if($dataMonitor==10)
                    {
                        $batas = 0;              
                    } else{
                        $batas = $dataMonitor;
                    }

                    $sqlMonitor = "SELECT * FROM monitor WHERE id_kolam=".$dataKolam[$i]['id']." AND periode = ".$periode." ORDER BY `id` DESC";
                    $hasil = mysqli_query($db, $sqlMonitor);

                    while ($row=mysqli_fetch_assoc($hasil)) { 
                        $tanggal = $row['tanggal'];
                        $kematian  = $row['kematian'];
                        $phAir  = $row['ph_air'];
                        $suhuAir  =$row['suhu_air'];
                        $kondisiAir  = $row['kondisi_air'];
                        $kondisiIkan  = $row['kondisi_ikan'];
                        $totalKematian = $totalKematian+ $kematian;
                        $jumlahIkan =  $dataKolam[$i]['bibit'][0]['populasi']-$totalKematian;  

                        if ( $masaPemeliharaan==1)    {
                            ?>    
<h5 class="ml-2"><?php echo tgl_indo($tanggal) ; ?></h5>                              
<pre style="font-size: 18px; color:white">
Kematian     :   <?php echo  $kematian;?> 
PH Air       :   <?php echo  $phAir;?> 
Suhu Air     :   <?php echo  $suhuAir;?> 
Kondisi Air  :   <?php echo  $kondisiAir;?> 
Kondisi Ikan :   <?php echo  $kondisiIkan;?> 
---------------------------------
</pre>
                           <?php  
                        } $totalKematian=0; 
                    }?>
                    </div> 
                                                                       
                </div>                                                        
            </div>				
        </div>                                    
        <?php 
}

