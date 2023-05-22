<?php 
 
define('YUOG',TRUE);
require_once("../../../inc/config.php"); 


$mail 	= $_POST['emaill'];
$sor  	= $mysqli->query("select * from admin where mail='$mail' ");
$say 	= $sor->num_rows;

if($say>0){ echo ' <span class="badge badge-danger"> Bu mail zaten kayıtlı </span>'; } else { echo ' <span class="badge badge-success"> Uygun </span>'; }

 

?>


