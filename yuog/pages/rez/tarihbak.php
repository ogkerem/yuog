<?php 

	define('YUOG',TRUE);
	require_once("../../../inc/config.php"); 
	 
	$turID		= $_POST['turID'];
	 

	 // if($katID==""){ exit; } 
	 echo '<option value="" selected > Tarih Seç </option>';
	  
	 $kbak  = $mysqli->query("select * from turtarih where turID='$turID' order by sefertarih asc ");
	
		while($kyaz = $kbak->fetch_array()){
		
			$yil =  substr($kyaz['sefertarih'],0,4); 
			$gun =  substr($kyaz['sefertarih'],8,2); 
			$ay =  	substr($kyaz['sefertarih'],5,2); 

	
			echo '<option value="'.$kyaz['id'].'">'.$gun.'-'.$ay.'-'.$yil.' ('.$kyaz['tursec'].') </option>';
		}
	
	
					
?>
 