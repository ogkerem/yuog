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
                    <li><a href="?sy=acenta">Acentalar</a></li>
                   
                     
                </ul>
            </div>
		 
            <div class="separator-breadcrumb border-top"></div>
   	
            <div class="row">
			
			<div class="col-md-12">
                    <div class="card text-left">

                        <div class="card-body">
                           
		
	<?php 
  
	 $id 			= $_GET['id'];
	 // $bak 			= $mysqli->query("select * from turlar where id='$id'");
	 // $yaz			= $bak->fetch_array();
	 
	 // $turextrasil	= $mysqli->query("delete from turextra where turID='$id' ");
	 // $turguzsecsil	= $mysqli->query("delete from turguzsec where turID='$id' ");
	 // $turkatsecsil	= $mysqli->query("delete from turkatsec where turID='$id' ");
	 // $turprogramsil	= $mysqli->query("delete from turprogram where turID='$id' ");
	 
	// $resbak 		= $yaz['resim'];
	// $kresbak 		= $yaz['kresim'];
	// $seoID 			= $yaz['seo'];
	
	// $seosil 		= $mysqli->query("delete from seo where id='$seoID' ");
	
	// $rhedef				= "../uploads/tur/";
	
	// unlink($rhedef.$resbak);
	// unlink($rhedef.$kresbak);
		
		
	// $tresbak 	= $mysqli->query("select * from turlarres where turID='$id' ");
		// while($tresyaz = $tresbak->fetch_array()){
			
			// unlink($rhedef.$tresyaz['resim']);			
		// }
	 
	 
	 // $turlarressil	= $mysqli->query("delete from turlarres where turID='$id' ");
	 
	 $tursil		= $mysqli->query("delete from acenta where id='$id' ");
	  
	 header("Location:?sy=acenta&islem=basarili"); 
	 
	  
 
?>	


 				
			</div>
		</div>
	</div> 
  </div>
</div> 