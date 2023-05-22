	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	$konu 	= @$_GET['konu'];
	$bak 	= $mysqli->query("select * from konum where baslik='$konu' ")->fetch_array();
	if($bak['durum']=="on"){
		$yeni = "";
	} else {
		$yeni = "on";
	}
	
	$guncelle = $mysqli->query("update konum set durum='$yeni' where baslik='$konu' ");
	
 	if($guncelle){
 	 header("Location:?sy=".$konu);
	 }	


	?> 
	 
				