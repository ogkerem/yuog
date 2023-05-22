<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	 
	$konu 		= "carihizmet";
	$id 		= $_GET['id'];	 
	$hizmetyaz 	= $mysqli->query("select * from carihizmet where id='$id' ")->fetch_array();
	
	?>
	<div class="main-content">
	
		
   <div class="breadcrumb">
                <h1>Tur Silme</h1>
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
	 

	$sil 		= $mysqli->query("delete from $konu where id='$id'");
	 
		
		if($sil){ 
	 
		header("Location:?sy=cariayrinti&id=".$hizmetyaz['cariID']."&islem=basarili");
		} 
		else { echo 'Hata! İçerik silinemedi '; }
?>


 				
			</div>
		</div>
	</div> 
  </div>
</div> 