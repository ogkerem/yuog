	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	 
	$id 	= $_GET['id'];
	$yaz1 	= $mysqli->query("select * from diller where id='$id' ");
	$yaz 	= $yaz1->fetch_array();
 
	
	?>
	 
	<div class="main-content">
	
   <div class="breadcrumb">
                <h1>Dil Düzenleme</h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li><a href="?sy=diller">Diller</a></li>
                  
                     
                </ul>
            </div>
		 
            <div class="separator-breadcrumb border-top"></div>
   
					
            <div class="row">
                <div class="col-md-12">
                   
                    <p>  </p>
                    <div class="card mb-5">
                        <div class="card-body">
 
					
						<?php 
if($_POST){ 
	
	$baslik				= addslashes(trim($_POST['baslik']));
	$kodu				= addslashes(trim($_POST['kodu']));
	$para				= addslashes(trim($_POST['para']));
	$sira				= (int)addslashes(trim($_POST['sira']));
 
	 
	$durum1				= $_POST['durum']; 	 
	if($durum1=="on"){ $durum = 1; } else { $durum = 0; } 
	 
	$rhedef				= "../uploads/";
	$resimad			= $_FILES['resim']['name']; 
	$kresimad			= $_FILES['kresim']['name'];  
	$logoad				= $_FILES['logo']['name'];  
	
	$gkresim			= $_POST['gkresim']; 
	$gresim				= $_POST['gresim'];  
	$glogo				= $_POST['glogo'];  
	$yeniurlmiz 		= $_POST['seourl'];
	
  
  
	$gonder  	= $mysqli->query(" update diller set 
	
		baslik 				='$baslik', 
		kodu 				='$kodu', 
		para 				='$para',  
		sira				= '$sira',
		durum				= '$durum' 
		
		where id='$id'
	  ");   
	  
	if($gonder){
		
		
	//resimler 
		if($resimad!=""){ 	 
	  
		unlink($rhedef.$gresim);	
		$kaynak		= $_FILES['resim']['tmp_name'];
		$resimsonad = rand(0,999).'-'.yeniurl(res_adi($resimad)).res_uzanti($resimad);
		$yukle 		= move_uploaded_file($kaynak,$rhedef."/".$resimsonad); 
		$guncelle 	= $mysqli->query("update diller set resim='$resimsonad' where id='$id' ");
	}
	 
	 if($logoad!=""){ 	 
		
		unlink($rhedef.$glogo);	
		$kaynak		= $_FILES['logo']['tmp_name'];
		$resimsonad = rand(0,999).'-'.yeniurl(res_adi($logoad)).res_uzanti($logoad);
		$yukle 		= move_uploaded_file($kaynak,$rhedef."/".$resimsonad); 
		$guncelle 	= $mysqli->query("update diller set logo='$resimsonad' where id='$id' ");
		 
	}
	 
 
	 
				
	header("Location:?sy=diller&islem=basarili");	
		  
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
		<label for="baslik" class="col-sm-2 col-form-label">Dil Adı * </label>
		<div class="col-sm-6">
		 <input type="text" name="baslik" class="form-control" id="baslik" placeholder="Başlık" value="<?php echo $yaz['baslik']; ?>" required >
		</div>
	</div>
	
	<div class="form-group row">
		<label for="kodu" class="col-sm-2 col-form-label">Kodu * </label>
		<div class="col-sm-2">
		 <input type="text" name="kodu" class="form-control" id="kodu" placeholder="Kodu" value="<?php echo $yaz['kodu']; ?>" required >
		</div>
	</div>
	 									
	 	 			
	<div class="form-group row">
		<label for="para" class="col-sm-2 col-form-label">Para Birimi * </label>
		<div class="col-sm-2">
		 <input type="text" name="para" class="form-control" id="para" placeholder="Para Birimi" value="<?php echo $yaz['para']; ?>" required >
		</div> 
	</div>

  
	
	 
 <div class="form-group row">
		<label for="resim" class="col-sm-2 col-form-label">Bayrak * </label>
		<div class="col-sm-3">
		  <input type="file" name="resim" class="form-control" id="resim" placeholder="Küçük Resim Boyutu"   > 
			 	<small id="resim" class="ul-form__text form-text "> Yeni resim istemiyorsanız işlem yapmayınız </small>	
 
			<input type="hidden" name="gresim"  value="<?php echo $yaz['resim']; ?>"   > 
		  
		</div>
	 
	 <a href="../uploads/<?php echo $yaz['resim']; ?>" target="_blank" >
	 <img src="../uploads/<?php echo $yaz['resim']; ?>" title="Büyük Resim" alt="Büyük Resim" style="background-color:#ddd; width:100px; "></a>
	 
	 
	</div>
	
  
	 
<!-- <div class="form-group row">
		<label for="logo" class="col-sm-2 col-form-label">Logo * </label>
		<div class="col-sm-3">
		  <input type="file" name="logo" class="form-control" id="logo" placeholder="Küçük Resim Boyutu"   > 
			 	<small id="resim" class="ul-form__text form-text "> Yeni resim istemiyorsanız işlem yapmayınız </small>	
 
			<input type="hidden" name="glogo"  value="<?php echo $yaz['logo']; ?>"   > 
		  
		</div>
	 
	 <a href="../uploads/<?php echo $yaz['logo']; ?>" target="_blank" >
	 <img src="../uploads/<?php echo $yaz['logo']; ?>" title="Büyük Resim" alt="Büyük Resim" style="background-color:#ddd; width:100px; "></a>
	 
	 
	</div> -->
	
  
	 
	
	<div class="form-group row">
	<label for="sira" class="col-sm-2 col-form-label">Sıra </label>
	<div class="col-sm-1">
	  <input type="text" name="sira" class="form-control" id="sira" placeholder="Sıra" value="<?php echo $yaz['sira']; ?>" > 
		
						
		</div>
		 
	</div>
	
		<div class="form-group row">
	<label for="durum" class="col-sm-2 col-form-label">Durum </label>
	<div class="col-sm-2">
	  
	<label class="switch switch-primary mr-3" id="durum">
		 
		  <input name="durum" type="checkbox" <?php if($yaz['durum']=="1"){ echo 'checked'; }?>  > 
		  
		<span class="slider"></span>
	</label>
			 
		</div>
		
		</div>
		
		 <hr/>	

<div class="form-group row">
	<label for="ekleyen" class="col-sm-2 col-form-label">Ekleyen </label>
	<div class="col-sm-2">
	 <?php echo $yaz['ekleyen']; ?> 
		
						
		</div>
		 
	</div>	

<div class="form-group row">
	<label for="eklemetarih" class="col-sm-2 col-form-label">Ekleme Tarihi </label>
	<div class="col-sm-2">
	 <?php echo $yaz['tarih']; ?> 
		
						
		</div>
		 
	</div>	
 
<div class="form-group row">
	<label for="eklemetarih" class="col-sm-2 col-form-label">IP </label>
	<div class="col-sm-2">
	 <?php echo $yaz['ip']; ?> 
		
						
		</div>
		 
	</div>	
 
 
 
	<div class="form-group row">
	<label for="sira" class="col-sm-2 col-form-label">  </label>
		<div class="col-sm-10">
			<button type="submit" class="btn btn-primary ul-btn__text">İçerik Güncelle</button>
		 
		</div>
	</div>
	
</form>

<?php } ?>
		</div>
	</div>
</div>
</div>
            
  </div> 
				
				