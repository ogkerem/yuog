<?php

defined('YUOG') or exit('No direct script access allowed / Yetkisiz Erişim ');

$konu 		= 	"sepet";
$id 		=	$_GET['id'];

$mysqli->query("UPDATE $konu SET
durum=0
 WHERE id = $id");
header("Location:?sy=" . $konu . "&islem=basarili");
