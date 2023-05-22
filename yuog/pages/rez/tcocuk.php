<?php 
	
	date_default_timezone_set('Europe/Istanbul');
		  
	define('YUOG',TRUE);
	require_once("../../../inc/config.php"); 
	 
	$birthDate			= $_POST['datepicker4'];
	$totelsecc			= $_POST['totelsecc'];
	$agebak 			= explode("/",$birthDate);
	
	$age				= date("Y")-$agebak[2];
	  // 12/19/2019
	  // echo $age;
  
   
	 $totsec = $mysqli->query("select * from turtarihotel where id='$totelsecc' "); 
	 $totyaz = $totsec->fetch_array();  
		
		$turfiyat	= $totyaz['turfiyat']*2;
		$sifiriki	= $totyaz['sifiriki'];
		$ucalti		= $totyaz['ucalti'];
		$yedioniki	= $totyaz['yedioniki'];
		
		if($age<=2) {
			$fiyat  = $turfiyat+$sifiriki;
			$sonuc = "sifiriki";
		} elseif(($age<3) or($age<=6)){
			$fiyat  = $turfiyat+$ucalti;
			$sonuc = "ucalti";
		} elseif(($age<7) or($age<=12)){
			$fiyat  = $turfiyat+$yedioniki;
			$sonuc = "yedioniki";
		} else {
			$fiyat  = $turfiyat+$totyaz['turfiyat'];
			$sonuc = "hicbiri";
		}
		
		echo $fiyat;
		 
?>