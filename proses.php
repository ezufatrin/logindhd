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


    
}


?>