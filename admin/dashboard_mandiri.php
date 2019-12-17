<?php

$dataKolam = dataKolamLimit($idedit,"Mandiri", $mulai, $halaman);
$NoPlasma = $mulai;
//Tampilan Dashboard Kolam Mandiri
for ($i=0; $i < count($dataKolam); $i++) 
{ 
    if($dataKolam[$i]['jenis']=="Mandiri")
    { $NoMandiri++; ?>				
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
                            <input class="mt-3  pt-2 pb-2 btn bg-black" type="submit" value="Simpan" name="pasangkolam">
                        </form>									
                    </div>				
                </div>
                <a class="btn btn-info mb-1 ml-1" href="hapus.php?id=<?php echo $dataKolam[$i]['id']; ?>" onclick="return  confirm('Anda yakin menghapus kolam Y/N')">Hapus Kolam </a>

                <?php 

                if(!($dataKolam[$i]['tanggal_penyelesaian'] == "0000-00-00"))
                { ?>
                <a href="#collapseExamplem<?php echo $i; ?>" data-toggle="collapse" class="small-box-footer">Selengkapnya<i class="fas fa-arrow-circle-right"></i></a><?php 
                } ?>
                
            <div class="collapse" id="collapseExamplem<?php echo $i; ?>">

            <?php 
            $sql = "SELECT * FROM bibit WHERE id_Kolam =". $dataKolam[$i]['id']." ORDER BY id DESC LIMIT 1";     
 
            $hasil = mysqli_query($db, $sql); 
            if(mysqli_fetch_row($hasil))
            {
                while($row = mysqli_fetch_assoc($hasil))
                {
                    $periode = $row['periode_pemeliharaan'];
                    $populasi =  $row['populasi'];
                    $ukuran =  $row['ukuran'];
                    $berat =  $row['berat'];
                    $tanggalMasuk =  $row['tanggal_masuk'];
                    $awal = $row['tanggal_masuk'];
                    $idKolam =  $row['id_kolam'];  
                    ?>    

                    <h5 class="ml-2 mt-3">Periode Pemeliharaan: <?= $periode; ?> <br></h5>
                    <h5 class="ml-2">Jumlah Bibit: <?= $populasi; ?> ekor<br></h5> 
                    <h5 class="ml-2">Ukuran Bibit: <?= $ukuran; ?> cm<br></h5>      
                    <h5 class="ml-2">Berat Bibit: <?= $berat; ?> kg<br></h5> 
                    <h5 class="ml-2">Tanggal Masuk Bibit: <?= tgl_indo($tanggalMasuk); ?> <br></h5>
         <?php  }

            } else {
                echo " <p class='mt-3 ml-2 mb-3 bg-danger'>";
                echo " **BIBIT BELUM DIMASUKKAN KE DALAM KOLAM";
                echo "</p>";
            }    

            include('input.php');?>

            
                                            
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

                        for ($g=0; $g < $batas; $g++) 
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