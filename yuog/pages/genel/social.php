	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
	
	?>
	<div class="main-content">
	
   <div class="breadcrumb">
                <h1> Sosyal Medya Hesaplarımız </h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li> Sosyal Medya URL lerimiz </li>
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
                   
                    <p> Boş bırakılan sosyal medya sitede çalışmaz  </p>
                    <div class="card mb-5">
                        <div class="card-body">
						
						<?php 
if($_POST){ 
	
	
	$facebook			= addslashes($_POST['facebook']);
	$twitter			= addslashes($_POST['twitter']);
	$tumblr				= addslashes($_POST['tumblr']);
	$pinterest			= addslashes($_POST['pinterest']); 
	$instagram			= addslashes($_POST['instagram']); 
	$foursquare			= addslashes($_POST['foursquare']); 
	$youtube			= addslashes($_POST['youtube']); 
	$google				= addslashes($_POST['google']); 
	$linkedin			= addslashes($_POST['linkedin']); 

	$guncelle = $mysqli->query("update ayarlar set facebook='$facebook',   instagram='$instagram',   twitter='$twitter',   google='$google' ,  youtube='$youtube',    linkedin='$linkedin',  pinterest='$pinterest', tumblr='$tumblr'  "); 
			
		  
			
				if($guncelle){ 
					
					 header("Location:?sy=social&islem=basarili");
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
		<label for="facebook" class="col-sm-2 col-form-label">Facebook   </label>
		<div class="col-sm-10">
			<input type="text" name="facebook" class="form-control" id="facebook" placeholder="facebook" value="<?php echo genel('facebook'); ?>">
		</div>
	</div>
							
	<div class="form-group row">
		<label for="twitter" class="col-sm-2 col-form-label">Twitter  </label>
		<div class="col-sm-10">
			<input type="text" name="twitter" class="form-control" id="twitter" placeholder="twitter" value="<?php echo genel('twitter'); ?>">
		</div>
	</div>
								
	<div class="form-group row">
		<label for="instagram" class="col-sm-2 col-form-label">İnstagram  </label>
		<div class="col-sm-10">
			<input type="text" name="instagram" class="form-control" id="instagram" placeholder="instagram" value="<?php echo genel('instagram'); ?>">
		</div>
	</div>
	
									
	<div class="form-group row">
		<label for="google" class="col-sm-2 col-form-label"> Google + </label>
		<div class="col-sm-10">
			<input type="text" name="google" class="form-control" id="google" placeholder="google" value="<?php echo genel('google'); ?>" >
		</div>
	</div>
									
	<div class="form-group row">
		<label for="linkedin" class="col-sm-2 col-form-label"> Linkedin  </label>
		<div class="col-sm-10">
			<input type="text" name="linkedin" class="form-control" id="linkedin" placeholder="linkedin" value="<?php echo genel('linkedin'); ?>" >
		</div>
	</div>
	
									
	<div class="form-group row">
		<label for="youtube" class="col-sm-2 col-form-label"> Youtube  </label>
		<div class="col-sm-10">
			<input type="text" name="youtube" class="form-control" id="youtube" placeholder="youtube" value="<?php echo genel('youtube'); ?>" >
		</div>
	</div>
	
									
	<div class="form-group row">
		<label for="pinterest" class="col-sm-2 col-form-label"> Pinterest  </label>
		<div class="col-sm-10">
			<input type="text" name="pinterest" class="form-control" id="pinterest" placeholder="pinterest" value="<?php echo genel('pinterest'); ?>" >
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
				