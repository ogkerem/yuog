<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	 
	$konu 	= "sistem";
	$id 	= $_GET['id'];
	 
 
	
	?>
	<div class="main-content">
	
		
   <div class="breadcrumb">
                <h1>İçerik Silme</h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li> İçerikler </li>
                   
                     
                </ul>
            </div>
		 
            <div class="separator-breadcrumb border-top"></div>
   	
            <div class="row">
			
			<div class="col-md-12">
                    <div class="card text-left">

                        <div class="card-body">
                            
		
	<?php 
	  
	$rhedef		= "../uploads/";
	
	$sil 		= $mysqli->query("delete from anasayfa where id='$id'");
	$bak 		= $mysqli->query("select * from anasayfaicerik where katID='$id'");
		while($yaz = $bak->fetch_array()){
			$resbak = $bak['resim'];
			unlink($rhedef.$resbak);
		}
	$sil2 		= $mysqli->query("delete from anasayfaicerik where katID='$id'");
	$sil3 		= $mysqli->query("delete from anasayfasistem where katID='$id'");
	
		if($sil){ 
	  
		header("Location:?sy=$konu&islem=basarili");
		} 
		else { echo 'Hata! İçerik silinemedi '; }
?>


 				
			</div>
		</div>
	</div> 
  </div>
</div> 