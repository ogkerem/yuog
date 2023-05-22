<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	 
	$konubak 	= explode("kat",@$_GET['sy']);	
	$konu 		= $konubak[0];
	$kat 		= $konu.'kat';	
 
	$rhedef	= "../uploads/";
 
	$id 	= $_GET['id'];
	 
 
	?>
	<div class="main-content">
	
		
   <div class="breadcrumb">
                <h1>İçerik Silme</h1>
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
	 
	 
	$resim1		= $mysqli->query("select * from icerikkat where id='$id'");
	$resim		= $resim1->fetch_array();		
	$resbak 	= $resim['resim'];
	$kresbak 	= $resim['kresim'];
	$ustresim 	= $resim['ustresim'];
	$vresim 	= $resim['vresim'];
	$pdf 		= $resim['pdf'];
	$icon 		= $resim['icon'];
	$seoID 		= $resim['seo'];
	 
	
	$sil 		= $mysqli->query("delete from icerikkat where id='$id'");
	
		if($sil){ 
		 
		$seosil = $mysqli->query("delete from seo where id='$seoID' ");
	 
		 
		unlink($rhedef.$resbak);
		unlink($rhedef.$kresbak);
		unlink($rhedef.$ustresim);
		unlink($rhedef.$vresim);
		unlink($rhedef.$pdf);
		unlink($rhedef.$icon);
		$etsil = $mysqli->query("delete from etiket where konu='$konu' && konuID='$id'  "); 
		
		  
		header("Location:?sy=$kat&islem=basarili");
		} 
		else { echo 'Hata! İçerik silinemedi '; }
?>


 				
			</div>
		</div>
	</div> 
  </div>
</div> 