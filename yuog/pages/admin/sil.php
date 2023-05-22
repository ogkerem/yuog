	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
 
	?>
	<div class="main-content"> 
   <div class="breadcrumb">
                <h1>İçerik Silme</h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li><a href="?sy=admin">Adminler</a></li>
                  
                     
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
	$sil1 		= $mysqli->query("delete from admin where id='$id' && silinme='0' ");
	 
		if($sil1){ 
		  $sil 		= $mysqli->query("delete from adminyetki where adminID='$id'"); 
		header("Location:?sy=admin&islem=basarili");
		} 
		else { echo 'Hata! İçerik silinemedi '; }
?>

 
		</div>
	</div>
</div>
</div>
            
  </div> 
				