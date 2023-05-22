<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	 
	$konu 		= 	"sahap";
	$id 		=	$_GET['id'];
	$sistem 	=	$_GET['sistem'];
		
	
	?>
	<div class="main-content">
	
		
   <div class="breadcrumb">
                <h1> İçerik  Silme</h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li><a href="?sy=<?php echo $konu; ?>"><?php echo $konu; ?></a></li>
                   
                     
                </ul>
            </div>
		 
            <div class="separator-breadcrumb border-top"></div>
   	
            <div class="row">
			
			<div class="col-md-12">
                    <div class="card text-left">

                        <div class="card-body">
                           
		
	<?php 
	 
	$id  		= $_GET['id'];
	$resim1		= $mysqli->query("select * from $konu where id='$id'");
	$resim		= $resim1->fetch_array();		
	$resbak 	= $resim['resim'];
	$kresbak 	= $resim['kresim'];
	$ustresim 	= $resim['ustresim'];
	$vresim 	= $resim['vresim'];
	$pdf 		= $resim['pdf'];
	$icon 		= $resim['icon'];
	$seoID 		= $resim['seo'];
	$rhedef		= "../uploads/"; 

	$sil 		= $mysqli->query("delete from $konu where id='$id'");
	
	$galeribak = $mysqli->query("select * from urunaksesuar where urunID='$id' ");
			while($galeriyaz = $galeribak->fetch_array()){
				
				unlink($rhedef.$galeriyaz['dosya']);
			}
			
			
	// $seosil1 	= $mysqli->query("delete from urunaksesuar where urunID='$id' "); 
	// $seosil2 	= $mysqli->query("delete from urunbenzer where urunID='$id' ");
	// $seosil3 	= $mysqli->query("delete from urundokuman where urunID='$id' ");
	// $seosil4 	= $mysqli->query("delete from urungaz where urunID='$id' ");
	// $seosil5 	= $mysqli->query("delete from urunozelliksec where urunID='$id' ");
	// $seosil6 	= $mysqli->query("delete from urunvideo where urunID='$id' ");
	 
		
		if($sil){ 
		 
		$seosil = $mysqli->query("delete from seo where id='$seoID' ");
		 
		unlink($rhedef.$resbak);
		unlink($rhedef.$kresbak);
		unlink($rhedef.$ustresim);
		unlink($rhedef.$vresim);
		unlink($rhedef.$pdf);
		unlink($rhedef.$icon);
		
		$etsil = $mysqli->query("delete from etiket where menu='$sistem' && konuID='$id'  "); 
		
		$galeribak = $mysqli->query("select * from galeri where menu='$sistem' && icerikID='$id' ");
			while($galeriyaz = $galeribak->fetch_array()){
				 
				unlink($rhedef.$galeriyaz['resim']);
			}
		$galerisil = $mysqli->query("delete from galeri where menu='$sistem' && icerikID='$id' "); 
		
		$galeribak2 = $mysqli->query("select * from dosya where menu='$sistem' && icerikID='$id' ");
			while($galeriyaz2 = $galeribak2->fetch_array()){ 
				unlink($rhedef.$galeriyaz2['resim']);
			}
		$galerisi2 = $mysqli->query("delete from dosya where menu='$sistem' && icerikID='$id' "); 
		
		header("Location: ?sy=sahap&sistem=".$sistem."&islem=basarili");	
		
		} 
		else { echo 'Hata! İçerik silinemedi '; }
?>


 				
			</div>
		</div>
	</div> 
  </div>
</div> 