<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	 
	$konu 	= "urunkat";
	 
	$id 	= $_GET['id'];
	 
 
	?>
	<div class="main-content">
	
		
   <div class="breadcrumb">
                <h1>İçerik Silme</h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li><a href="?sy=<?php echo $konu; ?>">Turlar</a></li>
                   
                     
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
	
		if($sil){ 
		 
		$seosil = $mysqli->query("delete from seo where id='$seoID' ");
		$seosil1 = $mysqli->query("delete from urunozelliksec where katID='$id' ");
		$seosil2 = $mysqli->query("delete from urunbenzer where katID='$id' ");
		$seosil2 = $mysqli->query("delete from urungaz where katID='$id' ");
		
	$sil 		= $mysqli->query("delete from $konu where id='$id'");
	
		$galeribak = $mysqli->query("select * from urunaksesuarkat where urunID='$id' ");
			while($galeriyaz = $galeribak->fetch_array()){
				
				unlink($rhedef.$galeriyaz['dosya']);
			}
			
			
	$seosil1 	= $mysqli->query("delete from urunaksesuarkat where urunID='$id' ");
	 
 
	$seosil3 	= $mysqli->query("delete from urundokumankat where urunID='$id' ");
	 
 
	$seosil6 	= $mysqli->query("delete from urunvideokat where urunID='$id' ");
	
	
		 
		unlink($rhedef.$resbak);
		unlink($rhedef.$kresbak);
		unlink($rhedef.$ustresim);
		unlink($rhedef.$vresim);
		unlink($rhedef.$pdf);
		unlink($rhedef.$icon);
		$etsil = $mysqli->query("delete from etiket where konu='$konu' && konuID='$id'  "); 
		
		$galeribak = $mysqli->query("select * from galeri where konu='$konu' && icerikID='$id' ");
			while($galeriyaz = $galeribak->fetch_array()){
				
				unlink($rhedef.$galeriyaz['resim']);
			}
		$galerisil = $mysqli->query("delete from galeri where konu='$konu' && icerikID='$id' "); 
		
		
		$galeribak1 = $mysqli->query("select * from galeri where konu='iconkat' && icerikID='$id' ");
			while($galeriyaz1 = $galeribak1->fetch_array()){
				
				unlink($rhedef.$galeriyaz1['resim']);
			}
		$galerisil1 = $mysqli->query("delete from galeri where konu='iconkat' && icerikID='$id' "); 
		
		header("Location:?sy=$konu&islem=basarili");
		} 
		else { echo 'Hata! İçerik silinemedi '; }
?>


 				
			</div>
		</div>
	</div> 
  </div>
</div> 