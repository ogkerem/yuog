<?php

$kk = $mysqli->query("select * from kategori where seo='$seoID' && durum='on' && dil='$dilID'");
while($kyaz = $kk->fetch_array()){?>


<?php
	
	if($kyaz['menu']== 2){
		require_once("pages/urunkat.php");
	}
	
	
	
	
?>
<?php }?>


<?php

$kk = $mysqli->query("select * from urunkat where seo='$seoID' && durum='on' && dil='$dilID'");
while($kyaz = $kk->fetch_array()){?>


<?php
	
	if($kyaz['menu']== 2){
		require_once("pages/urunkat.php");
	}
	
	
	
	
?>
<?php }?>