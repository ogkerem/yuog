<?php 

	define('YUOG',TRUE);
 
 
	require_once("../../inc/config.php"); 
 
	$hizmetID		= $_POST['hizmetID'];
	 
	$hizbak 		= $mysqli->query("select * from hizmet where id='$hizmetID' ")->fetch_array();
	
	$baslik 		= $hizbak['baslik'];
	$parabirimi		= $hizbak['parabirimi'];
	$pbirim			= $mysqli->query("select * from parabirimi where id='$parabirimi' ")->fetch_array();
	$kodu 			= $hizbak['kodu'];
	$fiyat 			= $hizbak['fiyat'];
	  
	echo '<input type="text" name="fiyat" class="form-control" id="fiyat" placeholder="Fiyat" value="'.$fiyat.'" required > <div style="margin-left: 100px; margin-top: -25px;  "> '.$pbirim['simge'].'</div><input type="hidden" name="parabirimi" value="'.$parabirimi.'">';
	
	
					
?>
 