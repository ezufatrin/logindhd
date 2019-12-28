<?php
$NoMandiri = $mulaiMandiri;
$dataKolam = dataKolamLimit($idedit,"Mandiri", $mulaiMandiri, $halamanMandiri); 

//Tampilan Dashboard Kolam Mandiri
for ($i=0; $i < count($dataKolam); $i++) 
{ 
        
    $NoMandiri++; ?>				
    <div class="col-lg-6 col-12 h-75">	
        <div class="small-box bg-success "> <!-- small box -->
            <div class="inner">										
                <h3>Nomor Kolam : <?php echo $NoMandiri; ?></h3>
                <h5>Id Kolam: <?php echo $dataKolam[$i]['id'] ?></h5>
                <h5>Jenis Kolam: <?php echo $dataKolam[$i]['jenis'] ?></h5>
                <?php  if(!($dataKolam[$i]['tanggal_penyelesaian'] == "0000-00-00")){}	
                    else if( !($dataKolam[$i]['tanggal_pasang']=="0000-00-00")){                                                
                        echo" <h5><span class='bg-primary pl-1 pr-1'>Status: Masa pemasangan </span><a class='text-light' data-toggle='collapse' href='#collapsePasangKolamMandiri".$i."' aria-controls='collapseExample'> --> ubah status</a><h5>";
                    }
                    else if( !($dataKolam[$i]['tanggal_booking']=="0000-00-00")){											
                        echo" <h5><span class='bg-light pl-1 pr-1'>Status: Booking </span><a class='text-light' data-toggle='collapse' href='#collapsePasangKolamMandiri".$i."' aria-controls='collapseExample'> --> ubah status</a> <h5>";
                    }else {
                        echo" <h5><span class='bg-warning pl-1 pr-1'>Status: Pending </span><a class='text-light' data-toggle='collapse' href='#collapsePasangKolamMandiri".$i."' aria-controls='collapseExample'> --> ubah status</a> <h5>";
                    }?>
                <div class="collapse" id="collapsePasangKolamMandiri<?php echo $i ?>">
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
                        <input class="mt-3  pt-2 pb-2 btn bg-info" type="submit" value="Simpan" name="pasangkolam">
                    </form>									
                </div>				
            </div>
       
            <?php 

            if(!($dataKolam[$i]['tanggal_penyelesaian'] == "0000-00-00"))
            { ?>
            <a href="#collapseExamplem<?php echo $i; ?>" data-toggle="collapse" class="small-box-footer">Selengkapnya<i class="fas fa-arrow-circle-right"></i></a><?php 
            } ?>
            
        <div class="collapse" id="collapseExamplem<?php echo $i; ?>">
        <h4 class="ml-2" ><a href="kolam-mitra.php?no=<?php echo $i; ?>&idk=<?php echo $dataKolam[$i]['id']; ?>&idu=<?php echo $idedit; ?>" class="text-white underline">Detail Kolam<i class="ml-2 fas fa-angle-double-right"></i></a></h4>
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

                 } else if($periodePanen<$periode)
                 { 
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

                    $tanggalMasuk =$rowBibit['tanggal_masuk'];
                    $diff  = date_diff(date_create($tanggalMasuk), date_create());                                                
                    if($diff->d > 15){
                    $periodeSampling = 3;
                    } else if($diff->d > 5){
                    $periodeSampling = 2;
                    } else {  $periodeSampling = 1; }    

                }

                    include('input.php');                                        
                    
                    $sqlMonitor = "SELECT * FROM monitor WHERE id_kolam=".$dataKolam[$i]['id']." AND periode = ".$periode." ORDER BY `id` DESC";
                    $hasil = mysqli_query($db, $sqlMonitor);

                    while ($row=mysqli_fetch_assoc($hasil)) { 
                        $tanggal[] = $row['tanggal'];
                        $kematian[]  = $row['kematian'];
                        $phAir[]  = $row['ph_air'];
                        $suhuAir[]  =$row['suhu_air'];
                        $kondisiAir[]  = $row['kondisi_air'];
                        $kondisiIkan[]  = $row['kondisi_ikan'];
                    } ?>

                    <div class="p-3 text-left bg-success">               
                    
                    <?php 
                  
                  $dataMonitor = count($tanggal);
                  if($dataMonitor>=10)
                  {
                      $batas =10;
                  } else if($dataMonitor==10)
                  {
                      $batas = 0;              
                  } else{
                      $batas = $dataMonitor;
                  }


                    if ( $masaPemeliharaan==1) {
                            
                    for ($g=0; $g < $batas; $g++) 
                    { ?> 
                                  
                                  <h5 class="ml-2"><?php echo tgl_indo($tanggal[$g]) ; ?></h5>                              
<pre style="font-size: 18px; color:white">
Kematian     :   <?php echo  $kematian[$g];?> 
PH Air       :   <?php echo  $phAir[$g];?> 
Suhu Air     :   <?php echo  $suhuAir[$g];?> 
Kondisi Air  :   <?php echo  $kondisiAir[$g];?> 
Kondisi Ikan :   <?php echo  $kondisiIkan[$g];?> 
---------------------------------
</pre>
                      <?php  
                        } $totalKematian=0; 
                    }?>
                    </div>                                                     
                </div>                                                        
            </div>				
        </div><?php                                            

}