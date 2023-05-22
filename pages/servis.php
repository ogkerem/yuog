<?php 
$gelen = $mysqli->query("SELECT * FROM servis WHERE seo = $seoID AND durum = 1")->fetch_assoc();
if($gelen['id'] == 7) {
    require_once 'servisler/webp_to_img.php';
}
?>