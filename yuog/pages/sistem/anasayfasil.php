<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	 
	 
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
	  
	
		$sil 		= $mysqli->query("delete from anasayfa where id='$id'");
		$sil2 		= $mysqli->query("delete from anasayfasistem where katID='$id'");
	
		if($sil){ 
	  
		header("Location:?sy=anasayfa&islem=basarili");
		} 
		else { echo 'Hata! İçerik silinemedi '; }
?>


 				
			</div>
		</div>
	</div> 
  </div>
</div> 