<?php 

	define('YUOG',TRUE);
	require_once("../../../inc/config.php"); 
	 
	$turtarihID		= $_POST['turtarihID'];
	 
	 // if($katID==""){ exit; } 
	 echo '<option value="" selected > Otel Seç </option>';
	  
	  $totsec = $mysqli->query("select * from turtarihotel where turtarihID='$turtarihID' && oteldolu!='on' "); 
		
		while($totyaz = $totsec->fetch_array()){
			
			echo '<option value="'.$totyaz['id'].'"> '.$totyaz['oteladi'].' </option>';
		}
	
	 
	
	
					
?>
 