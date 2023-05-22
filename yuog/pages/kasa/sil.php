<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	 
	$konu 	= "kasa";
	$id 	= $_GET['id'];
	 
	
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
	  
	
	$resim 		= $mysqli->query("select * from $konu where id='$id'")->fetch_array(); 	
	$resbak 	= $resim['resim'];
	 
	$rhedef		= "uploads/"; 
	$sil 		= $mysqli->query("delete from $konu where id='$id'");
	
		if($sil){ 
		unlink($rhedef.$resbak); 
		 
		header("Location:?sy=$konu&islem=basarili");
		} 
		else { echo 'Hata! İçerik silinemedi '; }
?>


 				
			</div>
		</div>
	</div> 
  </div>
</div> 