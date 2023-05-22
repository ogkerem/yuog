<?php 
		require_once("../inc/conf.php"); 
		$_SESSION['dil'] 	= $_GET['kodu'];		
		$urlbul1 	= $mysqli->query("select * from ayarlar ");
		$urlbul		= $urlbul1->fetch_array();	
		
		header("Location:https://".$urlbul['web']);	
?>