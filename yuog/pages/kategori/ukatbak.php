<?php 

	define('YUOG',TRUE);
	require_once("../../../inc/config.php"); 
	
	$bolum 		= "kategori";
	 
	$katID		= $_POST['ustkatID'];
	$sistem		= $_POST['sistem'];
	  
	 // if($katID==""){ exit; } 
	 echo '<option value="" selected > Orta Kategori Yok </option>';
	 
		$kbak  = $mysqli->query("select * from $bolum where ustkatID='$katID' && katID='0' && menu='$sistem' order by sira asc ");
	
		while($kyaz = $kbak->fetch_array()){
			
			echo '<option value="'.$kyaz['id'].'">'.$kyaz['baslik'].'</option>';
		}
 
					
?>
 