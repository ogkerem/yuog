<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	 
	$konu 	= "destek";
	$id 	= $_GET['id'];
	 
	
	?>
	<div class="main-content">
	
		
   <div class="breadcrumb">
                <h1>İçerik Silme</h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li><a href="?sy=<?php echo $konu; ?>">İçerikler</a></li>
                   
                     
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
	$rhedef		= "../uploads/"; 
	
	$sil 		= $mysqli->query("delete from $konu where id='$id'");
	 
		
		if($sil){ 
		 
		
		 
		unlink($rhedef.$resbak);
		 
		// $etsil = $mysqli->query("delete from etiket where konu='$konu' && konuID='$id'  "); 
		
		// $galeribak = $mysqli->query("select * from desteksorular where destekID='$id'   ");
			// while($galeriyaz = $galeribak->fetch_array()){
				
				// unlink($rhedef.$galeriyaz['resim']);
			// }
		
		// $seosil = $mysqli->query("delete from desteksorular where destekID='$id' ");
		
		
		 header("Location:?sy=$konu&islem=basarili"); exit;
		} 
		else { echo 'Hata! İçerik silinemedi '; }
?>


 				
			</div>
		</div>
	</div> 
  </div>
</div> 