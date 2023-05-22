<?php
$gelenMenu = $mysqli->query("SELECT * FROM sahap WHERE menu = 1 AND dil = $dilID AND durum  ='on' AND seo = $seoID ORDER BY id DESC")->fetch_assoc();
?>