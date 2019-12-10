<?php 

session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{
header('location:index.php');
}
else{

	$email = $_SESSION['alogin'];
	$sql = "SELECT * from users where email = (:email);";
	$query = $dbh -> prepare($sql);
	$query-> bindParam(':email', $email, PDO::PARAM_STR);
	$query->execute();
	$result=$query->fetch(PDO::FETCH_OBJ);
	$cnt=1;
    $idUser = $result->id;


    function idKolam($idUser, $jenis, $status)
    {
        global $db;
        $sql = "SELECT id FROM kolam WHERE status= '".$status."' AND id_pemilik = ".$idUser." AND jenis =  '".$jenis."'";     
        $hasil = mysqli_query($db, $sql);
        if (mysqli_num_rows($hasil) > 0)
        {		
            $s=0;
            while($row = mysqli_fetch_assoc($hasil))
            {
                $idKolam[$s] =  $row['id'];
                $s++;			
            }
            return $idKolam;
        } else {
            die("gagal");
        }
    }


    function idBibit($idKolam)
    {
        global $db;
        $sql = "SELECT id FROM bibit WHERE id_kolam= ".$idKolam;     
        $hasil = mysqli_query($db, $sql);
        if (mysqli_num_rows($hasil) > 0)
        {		
            $s=0;
            while($row = mysqli_fetch_assoc($hasil))
            {
                $idBibit[$s] =  $row['id'];
                $s++;			
            }
            return $idBibit;
        } else {
            die("gagal");
        }
    }

    function jumlahKolambyIdJenis($idedit, $jenis)
    {
        global $db;
        $sql = "SELECT  count(id) FROM kolam WHERE id_pemilik = ".$idedit." AND jenis = '".$jenis."'";
       
        $hasil = mysqli_query($db, $sql);
        if (mysqli_num_rows($hasil) > 0){
            while($row = mysqli_fetch_assoc($hasil))
            {
                $jumlahKolam =  $row['count(id)'];               
            }
          return  $jumlahKolam;
        }

    }

    function getDataHarian ($idKolam, $tanggal)
    {
        global $db;
        $sql = "SELECT * FROM monitor WHERE id_kolam= ".$idKolam." AND tanggal = '".$tanggal."'";       
        $hasil = mysqli_query($db, $sql);

        
        if (mysqli_num_rows($hasil) > 0)
        {		
            $s=0;
            foreach ($hasil as $key => $value){
                $value[$s]=$value;
                $s++;
            }
            return  $value;
        } else {
            die("gagal");
        }
    }

    function jumlahKolamByJensidanStatus($jenis, $status){
        global $db;
        $sql = "SELECT count(id) FROM kolam WHERE jenis= '".$jenis."' and status='".$status."'";
        $hasil = mysqli_query($db, $sql);
        while($row = mysqli_fetch_assoc($hasil))
        {
            return $idMitra = $row['count(id)'];
        }    
    }

    function jumlahKolamByJenisMitra($jenis, $idUser){
        global $db;
        $sql = "SELECT count(id) FROM kolam WHERE id_pemilik = ".$idUser." AND jenis= '".$jenis."'";
        $hasil = mysqli_query($db, $sql);
        while($row = mysqli_fetch_assoc($hasil))
        {
            return $idMitra = $row['count(id)'];
        }    
    }
    
    function jumlahMitra(){
        global $db;
        $sql = "SELECT count(id) FROM users WHERE status=1";
         $hasil = mysqli_query($db, $sql);
        while($row = mysqli_fetch_assoc($hasil))
        {
            return $idMitra = $row['count(id)'];
        }    
    }


    function dataKolamLimit ($idedit,$jenis, $mulai, $halaman){
        global $db;       
       
        $sql = "SELECT * FROM kolam WHERE  id_pemilik = ".$idedit." AND jenis='".$jenis."' Limit ".$mulai.", ".$halaman;
       
        $hasil = mysqli_query($db, $sql);
        $dataKolam=array(); 

        while ($data=mysqli_fetch_assoc($hasil)) 
        {
            $x['id']=$data['id'];
            $x['jenis']=$data['jenis']; 
            $x['id_pemilik']=$data['id_pemilik'];
            $x['tanggal_booking']=$data['tanggal_booking'];
            $x['tanggal_pasang']=$data['tanggal_pasang'];
            $x['tanggal_penyelesaian']=$data['tanggal_penyelesaian'];
            $x['status']=$data['status'];
            $x['bibit']=array();
                    $sqlBibit = "SELECT * FROM bibit WHERE id_kolam=".$data['id'];
                    $hasilBibit = mysqli_query($db, $sqlBibit);

                    while ($dataBibit=mysqli_fetch_assoc($hasilBibit)) {   
                        $y['id']=$dataBibit['id'];
                        $y['berat']=$dataBibit['berat'];
                        $y['ukuran']=$dataBibit['ukuran'];
                        $y['populasi']=$dataBibit['populasi'];
                        $y['tanggal_masuk']=$dataBibit['tanggal_masuk'];
                        $y['id_kolam']=$dataBibit['id_kolam'];
                        array_push($x['bibit'], $y);}
                        
            $x['sampling']=array();
                    $sqlSampling = "SELECT * FROM sampling WHERE id_kolam=".$data['id'];
                    $hasilSampling = mysqli_query($db, $sqlSampling);

                    while ($dataSampling=mysqli_fetch_assoc($hasilSampling)) {   
                        $y['id']=$dataSampling['id'];
                        $y['populasi']=$dataSampling['populasi'];
                        $y['ukuran']=$dataSampling['ukuran'];
                        $y['berat']=$dataSampling['berat'];
                        $y['tanggal_sampling']=$dataSampling['tanggal_sampling'];
                        $y['id_kolam']=$dataSampling['id_kolam'];
                        array_push($x['sampling'], $y);}
                        
            $x['monitor']=array();
                    $sqlMonitor = "SELECT * FROM monitor WHERE id_kolam=".$data['id']." ORDER BY `id` DESC";
                    $hasilMonitor = mysqli_query($db, $sqlMonitor);

                    while ($dataMonitor=mysqli_fetch_assoc($hasilMonitor)) {   
                        $y['id']=$dataMonitor['id'];
                        $y['suhu_air']=$dataMonitor['suhu_air'];
                        $y['ph_air']=$dataMonitor['ph_air'];
                        $y['kematian']=$dataMonitor['kematian'];
                        $y['berat_pakan']=$dataMonitor['berat_pakan'];
                        $y['kondisi_air']=$dataMonitor['kondisi_air'];
                        $y['kondisi_ikan']=$dataMonitor['kondisi_ikan'];
                        $y['tanggal']=$dataMonitor['tanggal'];
                        $y['id_kolam']=$dataMonitor['id_kolam'];
                        array_push($x['monitor'], $y);}                    
            $x['panen']=array();
                    $sqlPanen = "SELECT * FROM panen WHERE id_kolam=".$data['id'];
                    $hasilPanen = mysqli_query($db, $sqlPanen);

                    while ($dataPanen=mysqli_fetch_assoc($hasilPanen)) {   
                        $y['id']=$dataPanen['id'];
                        $y['berat']=$dataPanen['suhu_air'];
                        $y['populasi']=$dataPanen['ph_air'];
                        $y['tanggal_panen']=$dataPanen['kematian'];
                        $y['id_kolam']=$dataPanen['id_kolam'];
                        array_push($x['panen'], $y);}
                        
                // untuk menambah array setelah array yang terakhir
                array_push($dataKolam, $x);
            }
            return $dataKolam;
    }

    function dataKolam ($idedit)
    {
            global $db;  
            $sql = "SELECT * FROM kolam WHERE  id_pemilik = ".$idedit;
            
            $hasil = mysqli_query($db, $sql);
            $dataKolam=array(); 
    
            while ($data=mysqli_fetch_assoc($hasil)) 
            {
                $x['id']=$data['id'];
                $x['jenis']=$data['jenis']; 
                $x['id_pemilik']=$data['id_pemilik'];
                $x['tanggal_booking']=$data['tanggal_booking'];
                $x['tanggal_pasang']=$data['tanggal_pasang'];
                $x['tanggal_penyelesaian']=$data['tanggal_penyelesaian'];
                $x['status']=$data['status'];
                $x['bibit']=array();
                        $sqlBibit = "SELECT * FROM bibit WHERE id_kolam=".$data['id'];
                        $hasilBibit = mysqli_query($db, $sqlBibit);
    
                        while ($dataBibit=mysqli_fetch_assoc($hasilBibit)) {   
                            $y['id']=$dataBibit['id'];
                            $y['berat']=$dataBibit['berat'];
                            $y['ukuran']=$dataBibit['ukuran'];
                            $y['populasi']=$dataBibit['populasi'];
                            $y['tanggal_masuk']=$dataBibit['tanggal_masuk'];
                            $y['id_kolam']=$dataBibit['id_kolam'];
                            array_push($x['bibit'], $y);}
                            
                $x['sampling']=array();
                        $sqlSampling = "SELECT * FROM sampling WHERE id_kolam=".$data['id'];
                        $hasilSampling = mysqli_query($db, $sqlSampling);
    
                        while ($dataSampling=mysqli_fetch_assoc($hasilSampling)) {   
                            $y['id']=$dataSampling['id'];
                            $y['populasi']=$dataSampling['populasi'];
                            $y['ukuran']=$dataSampling['ukuran'];
                            $y['berat']=$dataSampling['berat'];
                            $y['tanggal_sampling']=$dataSampling['tanggal_sampling'];
                            $y['id_kolam']=$dataSampling['id_kolam'];
                            array_push($x['sampling'], $y);}
                            
                $x['monitor']=array();
                        $sqlMonitor = "SELECT * FROM monitor WHERE id_kolam=".$data['id']." ORDER BY `id` DESC";
                        $hasilMonitor = mysqli_query($db, $sqlMonitor);
    
                        while ($dataMonitor=mysqli_fetch_assoc($hasilMonitor)) {   
                            $y['id']=$dataMonitor['id'];
                            $y['suhu_air']=$dataMonitor['suhu_air'];
                            $y['ph_air']=$dataMonitor['ph_air'];
                            $y['kematian']=$dataMonitor['kematian'];
                            $y['berat_pakan']=$dataMonitor['berat_pakan'];
                            $y['kondisi_air']=$dataMonitor['kondisi_air'];
                            $y['kondisi_ikan']=$dataMonitor['kondisi_ikan'];
                            $y['tanggal']=$dataMonitor['tanggal'];
                            $y['id_kolam']=$dataMonitor['id_kolam'];
                            array_push($x['monitor'], $y);}                    
                $x['panen']=array();
                        $sqlPanen = "SELECT * FROM panen WHERE id_kolam=".$data['id'];
                        $hasilPanen = mysqli_query($db, $sqlPanen);
    
                        while ($dataPanen=mysqli_fetch_assoc($hasilPanen)) {   
                            $y['id']=$dataPanen['id'];
                            $y['berat']=$dataPanen['suhu_air'];
                            $y['populasi']=$dataPanen['ph_air'];
                            $y['tanggal_panen']=$dataPanen['kematian'];
                            $y['id_kolam']=$dataPanen['id_kolam'];
                            array_push($x['panen'], $y);}
                            
                    // untuk menambah array setelah array yang terakhir
                    array_push($dataKolam, $x);
                }
                return $dataKolam;
    }

    function jumlahKolamTanggal ($jenis, $status, $tanggalMulai, $tanggalAkhir)
    {
        global $db;

        if($status == 'Pending'){
            $sql = "SELECT count(id) FROM kolam WHERE jenis= '".$jenis."' AND status='".$status."'
            AND tanggal_booking='' AND tanggal_pasang='' AND tanggal_penyelesaian=''";      
    
            $hasil = mysqli_query($db, $sql);
            while($row = mysqli_fetch_assoc($hasil))
            {
                return $idMitra = $row['count(id)'];
            }    
        }
        if($status == 'Booking'){
            $sql = "SELECT count(id) FROM kolam WHERE jenis= '".$jenis."' AND status='".$status."'
            AND tanggal_booking BETWEEN '".$tanggalMulai."' AND '".$tanggalAkhir."'";      
    
            $hasil = mysqli_query($db, $sql);
            while($row = mysqli_fetch_assoc($hasil))
            {
                return $idMitra = $row['count(id)'];
            }    
        }
        if($status == 'Pemasangan'){
            $sql = "SELECT count(id) FROM kolam WHERE jenis= '".$jenis."' AND status='".$status."'
            AND tanggal_pasang BETWEEN '".$tanggalMulai."' AND '".$tanggalAkhir."'";      
    
            $hasil = mysqli_query($db, $sql);
            while($row = mysqli_fetch_assoc($hasil))
            {
                return $idMitra = $row['count(id)'];
            }    
        }
        if($status == 'Terpasang'){
            $sql = "SELECT count(id) FROM kolam WHERE jenis= '".$jenis."' AND status='".$status."'
            AND tanggal_penyelesaian BETWEEN '".$tanggalMulai."' AND '".$tanggalAkhir."'";      
    
            $hasil = mysqli_query($db, $sql);
            while($row = mysqli_fetch_assoc($hasil))
            {
                return $idMitra = $row['count(id)'];
            }    
        }
       
    }
    


    



















    

    
}


?>