<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	 
	
	$id 	= $_GET['id'];
	 
	// error_reporting(E_ALL);
	// ini_set("display_errors", 1);
	
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
  
	 $id 			= $_GET['id'];
	 $bak 			= $mysqli->query("select * from banner where id='$id'");
	 $yaz			= $bak->fetch_array();
	  
	$resbak 		= $yaz['resim'];
   
	$rhedef				= "../uploads/banner/";
	
	unlink($rhedef.$resbak);
	  
	 
	 $tursil		= $mysqli->query("delete from banner where id='$id' ");
	  
	 header("Location:?sy=banner&islem=basarili"); 
	 
	  
 
?>	


 				
			</div>
		</div>
	</div> 
  </div>
</div> 