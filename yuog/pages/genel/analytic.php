	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
	   
	$icerikyaz1 = $mysqli->query("select * from analytic ");
	$icerikyaz	= $icerikyaz1->fetch_array();
 
 
	?>
	<div class="main-content">
	
   <div class="breadcrumb">
                <h1> Analytic ve Canlı Destek Benzeri Kodlar </h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li> Sitemizin altındaki çıkmasını istediğimiz kodlar </li>
                </ul>
            </div>
		 
            <div class="separator-breadcrumb border-top"></div>
  
	
	 <?php $islem = @$_GET['islem']; 
			if($islem=="basarili"){
				
	 echo '	<div class="alert alert-card alert-success" role="alert">
			<strong class="text-capitalize">Başarılı !</strong> İşleminiz başarıyla gerçekleştirilmiştir.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div> ';
			}
			
			?>

			
		 
					
            <div class="row">
                <div class="col-md-12">
                   
                    <p> Birden fazla analytic kodu için aralarında boşluk bırakarak yapıştırınız.   </p>
                    <div class="card mb-5">
                        <div class="card-body">
						
						<?php 
if($_POST){ 
	
	
		 
	$analytic				= addslashes($_POST['analytic']);
	 
	$guncelle = $mysqli->query("update analytic set analytic='$analytic', guncelleme=now() ");
		  
				if($guncelle){ 
					
					 header("Location:?sy=analytic&islem=basarili");
				} else { echo '<div class="alert alert-danger" role="alert">
                                <strong class="text-capitalize">Hata!</strong>Hata Siteayar  Güncellenemedi
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
							
							 '; }   

} else { 
?>	



	<form action="" method="post" enctype="multipart/form-data" >
							
	<div class="form-group row">
		<label for="message" class="col-sm-2 col-form-label">Analytic Kodu   </label>
		<div class="col-sm-10">
		 
		 <textarea  name="analytic" id="message" rows="20" cols="100%"> <?php echo $icerikyaz['analytic']; ?></textarea>
				
				
				
		</div>
	</div>
							
	  						
	<div class="form-group row">
		<label for="message" class="col-sm-2 col-form-label"> Son Güncelleme   </label>
		<div class="col-sm-2">
		 
		 <?php echo $icerikyaz['guncelleme']; ?> 
				
				
				
		</div>
	</div>
							
	  
 
	
	<div class="form-group row">
		<div class="col-sm-10">
			<button type="submit" class="btn btn-primary ul-btn__text">Güncelle</button>
		 
		</div>
	</div>
	
</form>

<?php } ?>
		</div>
	</div>
</div>
</div>
            <div class="border-top mb-5"></div>

 

                </div> 
				