<?php 

	define('YUOG',TRUE);
	require_once("../../../inc/config.php"); 
	
	$bolum 	= "urunkat";
	$katID		= $_POST['ustkatID'];
	  
	 if($katID==""){ exit; } 
	 echo '<option value="" selected > Orta Kategori Yok </option>';
	 
		$kbak  = $mysqli->query("select * from $bolum where ustkatID='$katID' && katID='0' order by sira asc ");
	
		while($kyaz = $kbak->fetch_array()){
			
			echo '<option value="'.$kyaz['id'].'">'.$kyaz['baslik'].'</option>';
		}
 
					
?>
 