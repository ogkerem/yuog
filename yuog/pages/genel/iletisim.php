	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
	
	?>
	<div class="main-content">
	
   <div class="breadcrumb">
	<h1>Genel İletişim Bilgilerimiz </h1>
	<ul>
		<li><a href="index.php">Ana Sayfa</a></li>
		<li> Tel & Adres vs. bilgilerimiz </li>
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
                   
                    <p> Lütfen eksiksiz doldurun. </p>
                    <div class="card mb-5">
                        <div class="card-body">
						
						<?php 
if($_POST){ 
	
	$adres				= addslashes($_POST['adres']);
	$tel				= trim($_POST['tel']);
	$cep				= trim($_POST['cep']);
	$whatsapp			= trim($_POST['whatsapp']);
	$faks				= trim($_POST['faks']); 
	$email1				= trim($_POST['email1']); 
	$saat				= trim($_POST['saat']); 
	$maps				= addslashes($_POST['maps']); 
	$sitekey			= addslashes($_POST['sitekey']); 
	$secretkey			= addslashes($_POST['secretkey']); 
	  

	$guncelle = $mysqli->query("update ayarlar set adres='$adres', tel='$tel',cep='$cep', whatsapp= '$whatsapp', faks='$faks' , mail='$email1' , saat='$saat' , maps='$maps', sitekey='$sitekey', secretkey='$secretkey'  where id='1' ");
			
		if($guncelle){ 
					
	 header("Location:?sy=contact&islem=basarili");
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
		<label for="inputEmail3" class="col-sm-2 col-form-label">Adres * </label>
		<div class="col-sm-10">
			<input type="text" name="adres" class="form-control" id="inputEmail3" placeholder="Adres" value="<?php echo genel('adres'); ?>">
		</div>
	</div>
							
	<div class="form-group row">
		<label for="inputEmail4" class="col-sm-2 col-form-label">Telefon * </label>
		<div class="col-sm-4">
			<input type="text" name="tel" class="form-control" id="inputEmail4" placeholder="Telefon" value="<?php echo genel('tel'); ?>">
		</div>
	</div>
								
	<div class="form-group row">
		<label for="inputEmail5" class="col-sm-2 col-form-label">Cep Telefonu </label>
		<div class="col-sm-4">
			<input type="text" name="cep" class="form-control" id="inputEmail5" placeholder="Cep Telefonu" value="<?php echo genel('cep'); ?>">
		</div>
	</div>
	
	 <div class="form-group row">
		<label for="web" class="col-sm-2 col-form-label">Whatsapp * </label>
		<div class="col-sm-4">
		  <input type="text" name="whatsapp" class="form-control" id="web" placeholder="Whatsapp" value="<?php echo genel('whatsapp'); ?>" > 
			 				
		</div>
		<small id="web" class="ul-form__text form-text "> Cep ile aynı isede yazınız </small>
	</div>

	
	<div class="form-group row">
		<label for="inputEmail6" class="col-sm-2 col-form-label"> Faks  </label>
		<div class="col-sm-10">
			<input type="text" name="faks" class="form-control" id="inputEmail6" placeholder="Faks" value="<?php echo genel('faks'); ?>" >
		</div>
	</div>
									
	<div class="form-group row">
		<label for="inputEmail7" class="col-sm-2 col-form-label"> E-Posta (Genel) * </label>
		<div class="col-sm-10">
			<input type="text" name="email1" class="form-control" id="inputEmail7" placeholder="E Mail (Genel)" value="<?php echo genel('mail'); ?>" >
		</div>
	</div>
		
<!--
		<div class="form-group row">
		<label for="inputEmail7" class="col-sm-2 col-form-label"> Çalışma Saatleri </label>
		<div class="col-sm-10">
			<input type="text" name="saat" class="form-control" id="inputEmail8" placeholder="Çalışma Saatleri" value="<?php echo genel('saat'); ?>" >
		</div>
	</div>
-->
	 
	<hr>
		
		
		
										
	<div class="form-group row">
		<label for="inputEmail7" class="col-sm-2 col-form-label">  </label>
		<div class="col-sm-10">
		<div class="alert alert-info"><i class="fa fa-info-circle"></i> <a href="https://www.google.com/recaptcha/intro/index.html" target="_blank"><u>Google reCAPTCHA</u></a> sayfasına gidin ve web sitenizi kayıt edin. <br> reCAPTCHA v3 üyeliği yapmanız gerekmektedir <br> Daha fazla bilgi için <a href="https://YUOG.com/knowledgebase/article/2/recaptcha-kurulum/" target="_blank"> tıklayın. </a>  
		</div>
		</div>
	</div>	
		
		
	<div class="form-group row">
		<label for="inputEmail7" class="col-sm-2 col-form-label">Site Key </label>
		<div class="col-sm-10">
			<input type="text" name="sitekey" class="form-control" id="inputEmail7" placeholder="Site Key " value="<?php echo genel('sitekey'); ?>" >
		</div>
	</div>
		
										
	<div class="form-group row">
		<label for="inputEmail7" class="col-sm-2 col-form-label"> Secret Key </label>
		<div class="col-sm-10">
			<input type="text" name="secretkey" class="form-control" id="inputEmail7" placeholder="Secret Key" value="<?php echo genel('secretkey'); ?>" >
		</div>
	</div>
		
		
		
	<hr>
	 
	
	  <div class="form-group row">
		<label for="maps" class="col-sm-2 col-form-label"> Google Map * </label>
		<div class="col-sm-6">
		<textarea name="maps" class="form-control" id="maps" cols="50" rows="2" placeholder="Google Map" ><?php echo genel('maps'); ?></textarea>
			 
		</div>
		 
		
	</div>   
	
	
	
	  <div class="form-group row">
		<label for="maps" class="col-sm-2 col-form-label"> Google Map Çıktısı </label>
		<div class="col-sm-10">
		 <?php echo genel('maps'); ?> 
			 
		</div>
		  
	</div>  
  
	<div class="form-group row">
	<label for="sira" class="col-sm-2 col-form-label">  </label>
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
       
  </div> 
				