	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	 
	
	?>
	<div class="main-content">
	
   <div class="breadcrumb">
                <h1>Yeni Acenta  </h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li><a href="?sy=acenta">Acentalar</a></li>
               
                     
                </ul>
            </div>
		 
            <div class="separator-breadcrumb border-top"></div>
  
	
	 <?php $islem = $_GET['islem']; 
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
                   
                    <p>  </p>
                    <div class="card mb-5">
                        <div class="card-body">
						
						<?php 
if($_POST){ 
	
	$firma				= addslashes(trim($_POST['firma']));
	$yetkili			= addslashes(trim($_POST['yetkili']));
	$cep				= addslashes(trim($_POST['cep']));
	$vergidairesi		= addslashes(trim($_POST['vergidairesi']));
	$vergino			= addslashes(trim($_POST['vergino']));
	$hesapsahibi		= addslashes(trim($_POST['hesapsahibi']));
	$iban				= addslashes(trim($_POST['iban']));
	$adres				= addslashes(trim($_POST['adres']));	
	$cari				=  trim($_POST['cari']);
	$aciklama			= addslashes(trim($_POST['aciklama']));
	 
	$ekleyen			= $email; 	
	$ip					= $_SERVER['REMOTE_ADDR']; 
   
	$gonder  	= $mysqli->query(" insert into acenta set 
	 firma 					='$firma', 
	 yetkili 				='$yetkili', 
	 cep 					='$cep', 
	 vergidairesi			='$vergidairesi', 
	 vergino 				='$vergino', 
	 hesapsahibi 			='$hesapsahibi', 
	 iban					='$iban', 
	 adres					='$adres', 
	 cari					='$cari', 
	 aciklama				='$aciklama', 
	 ip						='$ip',	
	 tarih					= now() ,
	 durum					='1' 
	 
	  ");   
	  
	if($gonder){
		 
		  header("Location:?sy=acenta&islem=basarili");	
		  
	} else { echo '<div class="alert alert-danger" role="alert">
				<strong class="text-capitalize">Hata!</strong>Hata İşlem Başarısız :(  
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div> <br /> <a href="javascript:history.back(-1)">Geri Dön</a>'; }   	  
	 
} else { 
?>	



	<form action="" method="post" enctype="multipart/form-data" >
							
	<div class="form-group row">
		<label for="firma" class="col-sm-2 col-form-label">Firma  * </label>
		<div class="col-sm-6">
		 <input type="text" name="firma" class="form-control" id="firma" placeholder="Firma" value="<?php echo $firma; ?>" required >
		</div>
	</div>
	 	 						
	<div class="form-group row">
		<label for="yetkili" class="col-sm-2 col-form-label">Yetkili  </label>
		<div class="col-sm-6">
		 <input type="text" name="yetkili" class="form-control" id="yetkili" placeholder="Yetkili Kişi" value="<?php echo $firma; ?>" >
		</div>
	</div>
	 	 	 						
	<div class="form-group row">
		<label for="cep" class="col-sm-2 col-form-label">Cep Telefonu * </label>
		<div class="col-sm-6">
		 <input type="text" name="cep" class="form-control" id="cep" placeholder="Cep Telefonu" value="<?php echo $cep; ?>" required >
		</div>
	</div>
	 		 	 						
	<div class="form-group row">
		<label for="adres" class="col-sm-2 col-form-label">Adres </label>
		<div class="col-sm-8">
		 <input type="text" name="adres" class="form-control" id="adres" placeholder="Adres" value="<?php echo $adres; ?>" >
		</div>
	</div>
	 	 <hr/>
		 
	<div class="form-group row">
		<label for="hesapsahibi" class="col-sm-2 col-form-label"> Banka Bilgileri </label>
		<div class="col-sm-4">
		 <input type="text" name="hesapsahibi" class="form-control" id="hesapsahibi" placeholder="Hesap Sahibi" value="<?php echo $hesapsahibi; ?>" >
		</div>
		
		<div class="col-sm-4">
		 <input type="text" name="iban" class="form-control" id="adres" placeholder="IBAN" value="<?php echo $iban; ?>" >
		</div>
	</div>
	 	
	 <div class="form-group row">
		<label for="cari" class="col-sm-2 col-form-label"> Cari </label>
		<div class="col-sm-1">
		 <input type="text" name="cari" class="form-control" id="cari" placeholder="Cari" value="<?php echo $cari; ?>" required > 
		</div>
	 <div class="col-sm-1">
		 TL 
		</div>
	 
	</div>
	
	
      <hr/>
		 
	<div class="form-group row">
		<label for="vergidairesi" class="col-sm-2 col-form-label"> Resmi Bilgiler </label>
		<div class="col-sm-4">
		 <input type="text" name="vergidairesi" class="form-control" id="vergidairesi" placeholder="Vergi Dairesi" value="<?php echo $vergidairesi; ?>" >
		</div>
		
		<div class="col-sm-4">
		 <input type="text" name="vergino" class="form-control" id="vergino" placeholder="Vergi No" value="<?php echo $vergino; ?>" >
		</div>
	</div>
	
<hr/>
	<div class="form-group row">
		<label for="aciklama" class="col-sm-2 col-form-label"> Notlar </label>
		<div class="col-sm-10">
		<textarea name="aciklama"   id="aciklama" cols="100%" rows="4"><?php echo $aciklama; ?></textarea>
	 
   
		</div> 
	</div>
	 
	<div class="form-group row">
	<label for="sira" class="col-sm-2 col-form-label">  </label>
		<div class="col-sm-10">
			<button type="submit" class="btn btn-primary ul-btn__text">İçerik Ekle</button>
		 
		</div>
	</div>
	
</form>

<?php } ?>
		</div>
	</div>
</div>
</div>
            

                </div> 
				