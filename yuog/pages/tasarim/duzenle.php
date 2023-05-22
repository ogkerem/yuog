	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	 
	$id 	= $_GET['id'];
	$yaz1 	= $mysqli->query("select * from tasarim where id='$id' ");
	$yaz 	= $yaz1->fetch_array();
	
	?>
	<div class="main-content">
	
   <div class="breadcrumb">
                <h1>Arka Plan Resimleri</h1>
                <ul>
                  <li><a href="index.php">Ana Sayfa</a></li>
                    <li><a href="?sy=tasarim">Tasarımlar</a></li>
                     
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
	$baslik2			= addslashes(trim($_POST['baslik2']));
	$baslik3			= addslashes(trim($_POST['baslik3']));
	$aciklama			= addslashes(trim($_POST['aciklama']));
	$link				= addslashes(trim($_POST['link']));
	$linkaciklama		= addslashes(trim($_POST['linkaciklama']));
	
	$durum1				= $_POST['durum']; 	 
	if($durum1=="on"){ $durum = 1; } else { $durum = 0; } 
	
	$sira				= trim($_POST['sira']); 
	$hit				= 1;
	 
	$ekleyen			= $email;  
	$ip					= $_SERVER['REMOTE_ADDR']; 
	$gresim				= $_POST['gresim'];  
	
	$resimad			= $_FILES['resim']['name'];  
	 
	$rhedef				= "../uploads/"; 
	
	  
	$gonder = $mysqli->query("update tasarim set  baslik='$baslik' where id='$id'");
	 
	  
	if($gonder){
		
	if($resimad!=""){ 	 
		echo $gresim.' çalıştı'; 
		
		unlink($rhedef.$gresim);	
		$kaynak		= $_FILES['resim']['tmp_name'];
		$resimsonad = rand(0,999).'-'.yeniurl(res_adi($resimad)).res_uzanti($resimad);
		$yukle 		= move_uploaded_file($kaynak,$rhedef."/".$resimsonad); 
		$guncelle 	= $mysqli->query("update tasarim set resim='$resimsonad' where id='$id' ");
	}
		  
	  header("Location:?sy=tasarim&islem=basarili");	
		  
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
		<label for="baslik" class="col-sm-2 col-form-label">  Başlık * </label>
		<div class="col-sm-6">
		 <input type="text" name="baslik" class="form-control" id="baslik" placeholder="Ana Başlık" value="<?php echo $yaz['baslik']; ?>" required >
		</div>
	</div>
	 									
	 <!--<div class="form-group row">
		<label for="baslik2" class="col-sm-2 col-form-label">2.  Başlık </label>
		<div class="col-sm-6">
		 <input type="text" name="baslik2" class="form-control" id="baslik2" placeholder="2. Başlık" value="<?php echo $yaz['baslik2']; ?>"  >
		</div>
	</div>
	 				
  									
	<div class="form-group row">
		<label for="baslik3" class="col-sm-2 col-form-label">3.  Başlık </label>
		<div class="col-sm-6">
		 <input type="text" name="baslik3" class="form-control" id="baslik3" placeholder="3. Başlık" value="<?php echo $yaz['baslik3']; ?>"  >
		</div>
	</div>
	 				
 
 <div class="form-group row">
		<label for="aciklama" class="col-sm-2 col-form-label"> Kısa Açıklama  </label>
		<div class="col-sm-10">
		<textarea name="aciklama" id="aciklama" cols="50" rows="2" placeholder="Kısa Açıklama" ><?php echo $yaz['aciklama']; ?></textarea>
			 
		</div>
	</div> 
	
	
<div class="form-group row">
		<label for="link" class="col-sm-2 col-form-label"> Link </label>
		<div class="col-sm-6">
		 <input type="text" name="link" class="form-control" id="link" placeholder="Link" value="<?php echo $yaz['link']; ?>"  >
		</div>	
		
		<div class="col-sm-4">
			<small id="resim" class="ul-form__text form-text "> Boş Bırakırsanız Bu Alan sitede çalışmayacaktır  </small>
		</div>
	 
	</div>
	
	 
 <div class="form-group row">
		<label for="linkaciklama" class="col-sm-2 col-form-label">Link Açıklama </label>
		<div class="col-sm-6">
		 <input type="text" name="linkaciklama" class="form-control" id="linkaciklama" placeholder="Link Açıklama" value="<?php echo $yaz['linkaciklama']; ?>"  >
		</div>
	</div>-->
	
 <div class="form-group row">
		<label for="resim" class="col-sm-2 col-form-label">Arka Plan * </label>
		<div class="col-sm-3">
		  <input type="file" name="resim" class="form-control" id="resim" placeholder="Küçük Resim Boyutu"   > 
			 	<small id="resim" class="ul-form__text form-text "> Yeni resim istemiyorsanız işlem yapmayınız </small>	
		<input type="hidden" name="gresim"  value="<?php echo $yaz['resim']; ?>"   > 
		</div>
	 
	 <a href="../uploads/<?php echo $yaz['resim']; ?>" target="_blank" >
	 <img src="../uploads/<?php echo $yaz['resim']; ?>" title="Büyük Resim" alt="Büyük Resim" style="background-color:#ddd; width:100px; "></a>
	 <div class="col-sm-2">
		  İdeal boyut 1920 * 400 px
			 				
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
				