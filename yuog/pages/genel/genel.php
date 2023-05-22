	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
	
	?>
	<div class="main-content">
	
   <div class="breadcrumb">
                <h1>Sistem Genel Ayarları</h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li>Ayarlarımızı Burdan Yapıyoruz</li>
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
	
	$firma				= addslashes(@$_POST['firma']);
	$slogan				= addslashes(@$_POST['slogan']);
 	$sayfaalt			= addslashes(@$_POST['sayfaalt']);
	$web				= addslashes(@$_POST['web']);
	$title				= addslashes(@$_POST['title']); 
	$keywords			= addslashes(@$_POST['keywords']); 
	$description		= addslashes(@$_POST['description']); 
	 
	$kresim				= trim(addslashes(@$_POST['kresim'])); 
	$nresim				= trim(addslashes(@$_POST['nresim'])); 
	$uresim				= trim(addslashes(@$_POST['uresim'])); 
	$mail2				= trim(addslashes(@$_POST['mail2'])); 
	$mailsifre			= trim(addslashes(@$_POST['mailsifre'])); 
	$mailurl			= trim(addslashes(@$_POST['mailurl'])); 
	$mailport			= trim(addslashes(@$_POST['mailport'])); 
	$adresbaslik		= trim(addslashes(@$_POST['adresbaslik'])); 
	
	$vergi				= trim(addslashes(@$_POST['vergi'])); 
	$mersis				= trim(addslashes(@$_POST['mersis'])); 
	$tsicil				= trim(addslashes(@$_POST['tsicil'])); 
	
	$bakim 				= @$_POST['bakim']; 	
	$hata 				= @$_POST['hata']; 	 
	$bakimaciklama		= trim(addslashes(@$_POST['bakimaciklama'])); 
	
	
	$resimad			= $_FILES['resim']['name'];
	$kaynak				= $_FILES['resim']['tmp_name'];
	
		
	$resimad2			= $_FILES['logo2']['name'];
	$kaynak2			= $_FILES['logo2']['tmp_name'];
	
	
	$iconad				= $_FILES['icon']['name'];
	$iconkaynak			= $_FILES['icon']['tmp_name'];

	$hedef				= "../uploads/";
	
	$resmimiz 	= "logo".res_uzanti($resimad);
	$resmimiz2 	= "logo2".res_uzanti($resimad2);	
	$iconumuz	= "icon".res_uzanti($iconad);
	 

	if($resimad!=""){ 	 
		 $yukle 	= move_uploaded_file($kaynak,$hedef."/".$resmimiz); 
		 $guncelle 	= $mysqli->query("update ayarlar set logo='$resmimiz' ");
	}

	if($resimad2!=""){ 	 
		 $yukle 		= move_uploaded_file($kaynak2,$hedef."/".$resmimiz2); 
		$guncelle 		= $mysqli->query("update ayarlar set logo2='$resmimiz2' ");
	}

	if($iconad!=""){ 	 
		$iconyukle 	= move_uploaded_file($iconkaynak,$hedef."/".$iconumuz); 
		$guncelle 	= $mysqli->query("update ayarlar set icon='$iconumuz' ");		  
	}


	$guncelle = $mysqli->query("update ayarlar set firma='$firma', slogan='$slogan',sayfaalt='$sayfaalt', web= '$web', mail2='$mail2' , mailsifre='$mailsifre' , mailurl='$mailurl',mailport='$mailport', title='$title', keywords='$keywords', kresim='$kresim', nresim='$nresim', uresim='$uresim', description ='$description',  adresbaslik='$adresbaslik' , vergi='$vergi', mersis='$mersis', tsicil='$tsicil' , bakim='$bakim', hata='$hata', bakimaciklama='$bakimaciklama' where id='1' ");
	 
			
	if($guncelle){ 
		
		 header("Location:?sy=genel&islem=basarili");
	} else { echo '<div class="alert alert-danger" role="alert">
					<strong class="text-capitalize">Hata!</strong>Hata İçerik  Güncellenemedi
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				
				 '; }   

} else { 
?>	



	<form action="" method="post" enctype="multipart/form-data" >
							
	<div class="form-group row">
		<label for="inputEmail3" class="col-sm-2 col-form-label">Firma * </label>
		<div class="col-sm-10">
			<input type="text" name="firma" class="form-control" id="inputEmail3" placeholder="Firma Unvanınız" value="<?php echo genel('firma'); ?>" required>
		</div>
	</div>
							
	<div class="form-group row">
		<label for="inputEmail4" class="col-sm-2 col-form-label">Slogan * </label>
		<div class="col-sm-10">
			<input type="text" name="slogan" class="form-control" id="inputEmail4" placeholder="Sloganınız" value="<?php echo genel('slogan'); ?>" required >
		</div>
	</div>
								
	<div class="form-group row">
		<label for="inputEmail5" class="col-sm-2 col-form-label">Site Başlık (Title) * </label>
		<div class="col-sm-10">
			<input type="text" name="title" class="form-control" id="inputEmail5" placeholder="Sloganınız" value="<?php echo genel('title'); ?>" required>
		</div>
	</div>
	
									
	<div class="form-group row">
		<label for="inputEmail6" class="col-sm-2 col-form-label">Description (Genel) * </label>
		<div class="col-sm-10">
			<input type="text" name="description" class="form-control" id="inputEmail6" placeholder="Description" value="<?php echo genel('description'); ?>" required >
		</div>
	</div>
									
	<div class="form-group row">
		<label for="inputEmail7" class="col-sm-2 col-form-label">Keywords - Anahtar Kelimeler (Genel) * </label>
		<div class="col-sm-10">
			<input type="text" name="keywords" class="form-control" id="inputEmail7" placeholder="Keywords" value="<?php echo genel('keywords'); ?>" required >
		</div>
	</div>
	
	 
				
	
	<hr>
		
		<div class="form-group row">
		<label for="web" class="col-sm-2 col-form-label">Websitemiz * </label>
		<div class="col-sm-6">
		  <input type="text" name="web" class="form-control" id="web" placeholder="Web Sitemiz" value="<?php echo genel('web'); ?>" required > 
			
 							
		</div>
		<small id="web" class="ul-form__text form-text "> ornek.com  şeklinde </small>
	</div>
		
			
	<div class="form-group row"> 
		<label for="mailurl" class="col-sm-2 col-form-label">SMTP URL (mail gönderebilmek için gerekli)  </label>
		<div class="col-sm-6">
		  <input type="text" name="mailurl" class="form-control" id="mailurl" placeholder="SMTP URL" value="<?php echo genel('mailurl'); ?>"   >  
			 				
		</div>
		<small id="mailurl" class="ul-form__text form-text "> Örn. localhost veya 212.146.145.170 gibi </small>
	</div>
		 			
	<div class="form-group row"> 
		<label for="mail2" class="col-sm-2 col-form-label">SMTP Mail </label>
		<div class="col-sm-6">
		  <input type="text" name="mail2" class="form-control" id="mail2" placeholder="SMTP Mail" value="<?php echo genel('mail2'); ?>"   > 
		</div> 
	</div>
		
	 <div class="form-group row"> 
		<label for="mailsifre" class="col-sm-2 col-form-label">SMTP Mail Şifre   </label>
		<div class="col-sm-6">
		  <input type="text" name="mailsifre" class="form-control" id="mailsifre" placeholder="SMTP Mail Şifre " value="<?php echo genel('mailsifre'); ?>" > 
		</div> 
	</div> 
		
		<div class="form-group row"> 
		<label for="mailport" class="col-sm-2 col-form-label">SMTP Mail Port  </label>
		<div class="col-sm-6">
		  <input type="text" name="mailport" class="form-control" id="mailport" placeholder="SMTP Mail Port " value="<?php echo genel('mailport'); ?>" > 
		</div> 
	</div>
        
    
		<!-- <hr/>
		
			
	 <div class="form-group row"> 
		<label for="vergi" class="col-sm-2 col-form-label"> Vergi Dairesi  </label>
		<div class="col-sm-6">
		  <input type="text" name="vergi" class="form-control" id="vergi" placeholder="Vergi Dairesi" value="<?php echo genel('vergi'); ?>" > 
		</div> 
	</div>
	
		
	 <div class="form-group row"> 
		<label for="mersis" class="col-sm-2 col-form-label"> Mersis Numarası </label>
		<div class="col-sm-6">
		  <input type="text" name="mersis" class="form-control" id="mersis" placeholder="Mersis " value="<?php echo genel('mersis'); ?>" > 
		</div> 
	</div>
	
	
		
	 <div class="form-group row"> 
		<label for="tsicil" class="col-sm-2 col-form-label"> Ticaret Sicil </label>
		<div class="col-sm-6">
		  <input type="text" name="tsicil" class="form-control" id="tsicil" placeholder="Ticaret Sicil " value="<?php echo genel('tsicil'); ?>" > 
		</div> 
	</div> -->
	
	<!--	<hr/>
			 			
	<div class="form-group row"> 
		<label for="adresbaslik" class="col-sm-2 col-form-label"> Tursab URL  </label>
		<div class="col-sm-6">
		  <input type="text" name="adresbaslik" class="form-control" id="adresbaslik" placeholder="Tursab URL " value="<?php echo genel('adresbaslik'); ?>" >  
			
 							
		</div>
		 
	</div>  -->
		
		 
		 <hr>
		 
  
	<div class="form-group row">
		<label for="nresim" class="col-sm-2 col-form-label">Normal Resim Boyutu   </label>
		<div class="col-sm-2">
		  <input type="text" name="nresim" class="form-control" id="nresim" placeholder="Normal Resim Boyutu" value="<?php echo genel('nresim'); ?>" >  
		</div>
		<small id="nresim" class="ul-form__text form-text "> örnek : 1200 (sadece sayı girin) </small>
	</div>
	 
	<div class="form-group row">
		<label for="uresim" class="col-sm-2 col-form-label">Üst Resim Boyutu   </label>
		<div class="col-sm-2">
		  <input type="text" name="uresim" class="form-control" id="uresim" placeholder="Üst Resim Boyutu" value="<?php echo genel('uresim'); ?>" >  
		</div>
		<small id="uresim" class="ul-form__text form-text "> örnek : 1920*450 (sadece sayı girin) </small>
	</div>
	 
	<div class="form-group row">
		<label for="kresim" class="col-sm-2 col-form-label">Küçük Resim Boyutu * </label>
		<div class="col-sm-2">
		  <input type="text" name="kresim" class="form-control" id="kresim" placeholder="Küçük Resim Boyutu" value="<?php echo genel('kresim'); ?>" >  
		</div>
		<small id="kresim" class="ul-form__text form-text "> örnek : 270 (sadece sayı girin) </small>
	</div>
	 
	<div class="form-group row">
		<label for="resim" class="col-sm-2 col-form-label">Logo * </label>
		<div class="col-sm-2">
		  <input type="file" name="resim" class="form-control" id="resim" placeholder="Küçük Resim Boyutu"   > 
			 				
		</div>
	<a href="../uploads/<?php echo genel('logo'); ?>" target="_blank" ><img src="../uploads/<?php echo genel('logo'); ?>" title="Logo" alt="Logo" style="background-color:#ddd;"></a>
	</div>
	 
	<div class="form-group row">
		<label for="logo2" class="col-sm-2 col-form-label">Alt Logo * </label>
		<div class="col-sm-2">
		  <input type="file" name="logo2" class="form-control" id="logo2" placeholder="Küçük Resim Boyutu"> 
			 				
		</div>
	<a href="../uploads/<?php echo genel('logo2'); ?>" target="_blank" ><img src="../uploads/<?php echo genel('logo2'); ?>" title="Logo" alt="Logo" style="background-color:#ddd;"></a>
	</div>
	
	 
	<div class="form-group row">
		<label for="icon" class="col-sm-2 col-form-label">İcon  * </label>
		<div class="col-sm-2">
		  <input type="file" name="icon" class="form-control" id="icon" placeholder="Küçük Resim Boyutu"> 
			 				
		</div>
	<a href="../uploads/<?php echo genel('icon'); ?>" target="_blank"><img src="../uploads/<?php echo genel('icon'); ?>" title="Logo" alt="Logo" style="background-color:#ddd;"></a>
	</div>
	
	 <hr/>
	 
	 <div class="form-group row">
	<label for="bakim" class="col-sm-2 col-form-label">Bakım Modu </label>
	<div class="col-sm-1">
	  
	<label class="switch switch-primary mr-3" id="bakim">
		 
	 <input name="bakim" type="checkbox" <?php if(genel('bakim')=="on"){ echo 'checked'; }?>  > 
		  
		<span class="slider"></span>
	</label>
			 
		</div>
		
		
		<div class="col-sm-6">
	  
	<button type="button" class="btn btn-danger btn-block m-1 mb-3">Dikkat! Siteyi bakım moduna alırsanız sadece adminler görebilir!!! </button>
			 
		</div>
		 
		</div>
		
		
	 <div class="form-group row">
	<label for="hata" class="col-sm-2 col-form-label">Hata Kodları </label>
	<div class="col-sm-1">
	  
	<label class="switch switch-primary mr-3" id="hata">
		 
	 <input name="hata" type="checkbox" <?php if(genel('hata')=="on"){ echo 'checked'; }?>  > 
		  
		<span class="slider"></span>
	</label>
			 
		</div>
		
		
		<small id="kresim" class="ul-form__text form-text "> Panelde ve sitedeki hata kodları aktif olacaktır. </small>
		 
		</div>
		 
		
		
	<div class="form-group row">
	<label for="bakimaciklama" class="col-sm-2 col-form-label"> Bakım Modu Açıklama </label>
	<div class="col-sm-10">		 
	 <textarea  name="bakimaciklama" class="ckeditor" id="icerik"  rows="20" cols="100%"> <?php echo genel('bakimaciklama'); ?></textarea>
	</div>
	</div>
				
		
	<div class="form-group row">
		<div class="col-sm-2">
			 
		 
		</div>
		
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