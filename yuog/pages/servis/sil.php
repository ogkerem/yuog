<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	 
	
	$id 	= $_GET['id'];
	 
	// error_reporting(E_ALL);
	// ini_set("display_errors", 1);
	
	?>
	<div class="main-content">
	
		
   <div class="breadcrumb">
                <h1>İçerik Silme</h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li><a href="?sy=turlar">Turlar</a></li>
                   
                     
                </ul>
            </div>
		 
            <div class="separator-breadcrumb border-top"></div>
   	
            <div class="row">
			
			<div class="col-md-12">
                    <div class="card text-left">

                        <div class="card-body">
                           
		
	<?php 
	 
	$id  		= $_GET['id'];
	$resim1		= $mysqli->query("select * from proje where id='$id'");
	$resim		= $resim1->fetch_array();		
	$resbak 	= $resim['resim'];
	$kresbak 	= $resim['kresim'];
	$seoID 		= $resim['seo'];
	$rhedef		= "../uploads/proje/"; 
	
	$sil 		= $mysqli->query("delete from proje where id='$id'");
	
		if($sil){ 
		 
		$seosil = $mysqli->query("delete from seo where id='$seoID' ");
		 
		unlink($rhedef.$resbak);
		unlink($rhedef.$kresbak);
		$etsil = $mysqli->query("delete from etiket where konu='proje' && konuID='$id'  "); 
		
		header("Location:?sy=proje&islem=basarili");
		} 
		else { echo 'Hata! İçerik silinemedi '; }
?>


 				
			</div>
		</div>
	</div> 
  </div>
</div> 