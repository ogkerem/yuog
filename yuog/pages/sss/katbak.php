<?php 
	
	//defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
	include("../../../inc/conf.php");
		
	$katID		= $_POST['katID']; 
 
		echo '<option value="">Üst İçerik Seçin</option>';
		 
 
	 
	$kbak  = $mysqli->query("select * from kurumsal where katID='$katID' order by sira asc ");
	
		while($kyaz = $kbak->fetch_array()){
			
			echo '<option value="'.$kyaz['id'].'">'.$kyaz['baslik'].'</option>';
		}
		
 


?>