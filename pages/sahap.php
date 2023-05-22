<?php
$gelenIcerik = $mysqli->query("select * from sahap where seo='$seoID' && durum='on' && dil='$dilID'");
while ($kyaz = $gelenIcerik->fetch_array()) {
	if ($kyaz['menu'] == '1') {
		require_once("pages/hakkimizdaDetay.php");
	} else if ($kyaz['menu'] == '2') {
		require_once("pages/hizmetdetay.php");
	} else if ($kyaz['menu'] == '3') {
		require_once("pages/blogdetay.php");
	}
}
