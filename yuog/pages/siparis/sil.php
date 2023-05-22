<?php 
	
defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');

$konu 		= 	"siparis";
$id 		=	$_GET['id'];
			
$mysqli->query("DELETE FROM $konu WHERE id='$id' ");
header("Location:?sy=" . $konu . "&islem=basarili");
?>a