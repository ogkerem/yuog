<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	 
	
	$id 	= $_GET['id'];
	 
	
	?>
	<div class="main-content">
	
		
   <div class="breadcrumb">
                <h1>İçerik Silme</h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li> <a href = "javascript:history.back()"> Geri Dön</a>   </li>
                   
                     
                </ul>
            </div>
		 
            <div class="separator-breadcrumb border-top"></div>
   	
            <div class="row">
			
			<div class="col-md-12">
                    <div class="card text-left">

                        <div class="card-body">
                           
		
	<?php 
	 
	$id  		= $_GET['id'];
	$yaz		= $mysqli->query("select * from anasayfasay where id='$id'")->fetch_array();
	$katID 		= $yaz['katID'];
	  
	$rhedef		= "../uploads/"; 
	 
	$sil 		= $mysqli->query("delete from anasayfasay where id='$id'");
	
		if($sil){ 
		 
	  $bakk = $mysqli->query("select * from anasayfaicerik where katID='$katID' && icerikID='$id' order by sira asc ");
			while($yazz = $bakk->fetch_array()){
				$resim = $yazz['resim'];
				unlink($rhedef.$resim);
			}
		  
	  	$sil2 		= $mysqli->query("delete from anasayfaicerik where katID='$katID' && icerikID='$id' ");
		
		header("Location:?sy=anaicerik&id=".$katID."&islem=basarili");
		} 
		else { echo 'Hata! İçerik silinemedi '; }
?>


 				
			</div>
		</div>
	</div> 
  </div>
</div> 