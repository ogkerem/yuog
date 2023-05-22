	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');

	
	?>
	<div class="main-content">
	
   <div class="breadcrumb">
                <h1>Turlar Kategori Silme</h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li><a href="?sy=turlar">Turlar</a></li>
                    <li><a href="?sy=turkat">Kategoriler</a></li>
                     
                </ul>
            </div>
		 
            <div class="separator-breadcrumb border-top"></div>
  
	 
            <div class="row">
                <div class="col-md-12">
                   
                    <p>  </p>
                    <div class="card mb-5">
                        <div class="card-body">
						
	 <?php 
	 
	$id  		= $_GET['id'];
	$resim1		= $mysqli->query("select * from turkat where id='$id'");
	$resim		= $resim1->fetch_array();		
	$resbak 	= $resim['resim'];
	$kresbak 	= $resim['kresim'];
	$seoID 		= $resim['seo'];
	$rhedef		= "../uploads/tur/";
	
	$sil 		= $mysqli->query("delete from turkat where id='$id'");
	
		if($sil){ 
		 
		$seosil = $mysqli->query("delete from seo where id='$seoID' ");
		 
		unlink($rhedef.$resbak);
		unlink($rhedef.$kresbak);
		$etsil = $mysqli->query("delete from etiket where konu='hakkimizda' && konuID='$id'  "); 
		
		header("Location:?sy=turkat&islem=basarili");
		} 
		else { echo 'Hata! İçerik silinemedi '; }
?>

 
		</div>
	</div>
</div>
</div>
            

                </div> 
				