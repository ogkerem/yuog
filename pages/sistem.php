 
<?php

$dsefURL1 = explode("?", $url);
$dsefURL = $dsefURL1['0'];

$icerikyaz = $mysqli->query("select * from sistemdil where dsef = '$dsefURL' AND dilID = $dilID")->fetch_array();
@$iyazid = $icerikyaz['menuID'];
@$sef = $icerikyaz['dsef'];
$sistem = $mysqli->query("select * from sahap where menu='$iyazid' && durum='on' && dil='$dilID'")->fetch_array();

if ($iyazid == 1) {
	require_once("pages/hakkimizda.php");
} else if ($iyazid == 2) {
	require_once("pages/hizmetler.php");
} else if ($iyazid == 3) {
	require_once("pages/blog.php");
} else {
	require_once("yok.php");
}

?>  
