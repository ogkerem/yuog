	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	 
	$id 	= $_GET['id'];
	$yaz1 	= $mysqli->query("select * from avideo where id='$id' ");
	$yaz 	= $yaz1->fetch_array();
	
	 
	$dilid 	= $yaz['dil']; 
	$dilbul = $mysqli->query("select * from diller where id='$dilid' ");
	$dilyaz = $dilbul->fetch_array();
	
	?>
	 
	 <div class="main-content">
	
   <div class="breadcrumb">
                <h1> <a href="?sy=avideo">Ana Akademi </a> >  <?php echo $dilyaz['baslik']; ?>  </h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li> İçerik Güncelleme </li>
                  
                     
                </ul>
            </div>
		 
            <div class="separator-breadcrumb border-top"></div>
  
	 
            <div class="row">
                <div class="col-md-12">
                   
                    
                    <div class="card mb-5">
                        <div class="card-body">
 
					
						<?php 
if($_POST){ 
	
	$baslik				= addslashes(trim($_POST['baslik']));
	$onyazi				= addslashes(trim($_POST['onyazi']));
	$icerik				= addslashes(trim($_POST['icerik']));
			
	$bir				= addslashes(trim($_POST['bir']));
	$bira				= addslashes(trim($_POST['bira'])); 	
	$birbad				= $_FILES['birb']['name']; 
	$birbkaynak			= $_FILES['birb']['tmp_name'];	 
	$birbsonad 			= rand(0,999).'-'.yeniurl(res_adi($birbad)).res_uzanti($birbad);	
	$bird				= addslashes(trim($_POST['bird']));
	$gbir				= $_POST['gbir'];   

	$iki				= addslashes(trim($_POST['iki']));
	$ikia				= addslashes(trim($_POST['ikia']));	
	$ikibad				= $_FILES['ikib']['name']; 
	$ikibkaynak			= $_FILES['ikib']['tmp_name'];	 
	$ikibsonad 			= rand(0,999).'-'.yeniurl(res_adi($ikibad)).res_uzanti($ikibad); 
	$ikid				= addslashes(trim($_POST['ikid']));
	$giki				= $_POST['giki']; 
	
	$uc					= addslashes(trim($_POST['uc']));
	$uca				= addslashes(trim($_POST['uca']));
	$ucbad				= $_FILES['ucb']['name']; 
	$ucbkaynak			= $_FILES['ucb']['tmp_name'];	 
	$ucbsonad 			= rand(0,999).'-'.yeniurl(res_adi($ucbad)).res_uzanti($ucbad); 
	$ucd				= addslashes(trim($_POST['ucd']));
	$guc				= $_POST['guc']; 
	
	$dort				= addslashes(trim($_POST['dort']));
	$dorta				= addslashes(trim($_POST['dorta']));	
	$dortbad				= $_FILES['dortb']['name']; 
	$dortbkaynak			= $_FILES['dortb']['tmp_name'];	 
	$dortbsonad 			= rand(0,999).'-'.yeniurl(res_adi($dortbad)).res_uzanti($dortbad); 
	$dortd				= addslashes(trim($_POST['dortd']));
	$gdort				= $_POST['gdort']; 
  
	$sira				= trim($_POST['sira']); 	 
	$dil				= trim($_POST['dil']); 
 
	$durum1				= $_POST['durum']; 	 
	if($durum1=="on"){ $durum = 1; } else { $durum = 0; }  
	 
	$kresimad			= $_FILES['kresim']['name']; 
	$kresimkaynak		= $_FILES['kresim']['tmp_name']; 
	$gkresim			= $_POST['gkresim']; 
	
	$resimad			= $_FILES['resim']['name']; 
 	$kaynak				= $_FILES['resim']['tmp_name']; 
	$gresim				= $_POST['gresim'];   
 
	$rhedef				= "../uploads/avideo/";	
	  
	$gonder  	= $mysqli->query(" update avideo set  
	
		baslik 				='$baslik', 
		onyazi 				='$onyazi', 
		icerik 				='$icerik',  	
		
		bir					='$bir', 		
		bira				='$bira', 		
	 
		bird				='$bird', 		
		
		iki					='$iki', 		
		ikia				='$ikia', 		
	 		
		ikid				='$ikid', 		
		
		uc					='$uc', 		
		uca					='$uca', 		
	 
		ucd					='$ucd', 		
		
		dort					='$dort', 		
		dorta					='$dorta', 		
	 	
		dortd					='$dortd', 		
		
		 
		sira				= '$sira',
		dil					= '$dil', 
		durum				= '$durum' 
		
			where id='$id'
	 
	  ");   
	  
	if($gonder){
	 
	 //resimler 
		if($kresimad!=""){ 	 
		
		unlink($rhedef.$gkresim);	
		$kaynak		= $_FILES['kresim']['tmp_name'];
		$resimsonad = rand(0,999).'-'.yeniurl(res_adi($kresimad)).res_uzanti($kresimad);
		$yukle 		= move_uploaded_file($kaynak,$rhedef."/".$resimsonad); 
		$guncelle 	= $mysqli->query("update avideo set kresim='$resimsonad' where id='$id' ");
		 
	}	
	
	if($resimad!=""){ 	 
		
		unlink($rhedef.$gresim);	
		$kaynak		= $_FILES['resim']['tmp_name'];
		$resimsonad = rand(0,999).'-'.yeniurl(res_adi($resimad)).res_uzanti($resimad);
		$yukle 		= move_uploaded_file($kaynak,$rhedef."/".$resimsonad); 
		$guncelle 	= $mysqli->query("update avideo set resim='$resimsonad' where id='$id' ");
	}
	
	if($birbad!=""){  
		$yukle 		= move_uploaded_file($birbkaynak,$rhedef."/".$birbsonad); 
		$guncelle 	= $mysqli->query("update avideo set birb='$birbsonad' where id='$id' ");
	}
	 
  if($ikibad!=""){  
		$yukle 		= move_uploaded_file($ikibkaynak,$rhedef."/".$ikibsonad); 
		$guncelle 	= $mysqli->query("update avideo set ikib='$ikibsonad' where id='$id' ");
	}
	
	if($ucbad!=""){  
		$yukle 		= move_uploaded_file($ucbkaynak,$rhedef."/".$ucbsonad); 
		$guncelle 	= $mysqli->query("update avideo set ucb='$ucbsonad' where id='$id' ");
	}
	 
	if($dortbad!=""){  
		$yukle 		= move_uploaded_file($dortbkaynak,$rhedef."/".$dortbsonad); 
		$guncelle 	= $mysqli->query("update avideo set dortb='$dortbsonad' where id='$id' ");
	}
	 
	 
				 
		 header("Location:?sy=avideo&islem=basarili");	
		  
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
		<label for="baslik" class="col-sm-2 col-form-label">Dil </label>
		
	 
    <div class="col-2">
    
	  <select class="custom-select task-manager-list-select" name="dil">
	  
	  <?php $dilbak = $mysqli->query("select * from diller ");
	 
			while($dilyaz = $dilbak->fetch_array()){
				if($dilyaz['id']==$dil){
				echo '<option value="'.$dilyaz['id'].'" selected>'.$dilyaz['baslik'].'</option>';
				} else {
				echo '<option value="'.$dilyaz['id'].'">'.$dilyaz['baslik'].'</option>';
				}
			}

?>  
	 </select>
	 
	 
    </div>
     
 </div>

<!--

	 <div class="form-group row">
		<label for="kresim" class="col-sm-2 col-form-label"> Video  </label>
		<div class="col-sm-3">
		  <input type="file" name="kresim" class="form-control" id="kresim" placeholder="Küçük Resim Boyutu"   > 
			 	<small id="kresim" class="ul-form__text form-text "> Yeni video istemiyorsanız boş geçiniz </small>	
 
			<input type="hidden" name="gresim"  value="<?php echo $yaz['kresim']; ?>"   > 
		  
		</div>
	 
	 <a href="../uploads/avideo/<?php echo $yaz['kresim']; ?>" target="_blank" >
	  <?php echo $yaz['kresim']; ?> </a>
	 
	 
	</div>
-->
	
		
		
	
	 <div class="form-group row">
		<label for="bir" class="col-sm-2 col-form-label">Başlık  * </label>
		<div class="col-sm-6">
		 <input type="text" name="bir" class="form-control" id="bir" placeholder=" Başlık" value="<?php echo $yaz['bir']; ?>" required > 
	 
		</div>  
<!--
		<div class="col-sm-4">
		 <input type="text" name="bird" class="form-control" id="bird" placeholder="Birinci Link" value="" required > 
	 
		</div>
-->
	</div>
	
	
<!--
  <div class="form-group row">
		<label for="birb" class="col-sm-2 col-form-label">Birinci Görsel 235*135 * </label>
		<div class="col-sm-2">
		  <input type="file" name="birb" class="form-control" id="birb" placeholder="" required  > 
			 				
		</div>	
		
		<div class="col-sm-2"> 
		  
			 				
		</div>   
	 
	</div>  
	  
	 <hr/>
	 
-->
  
	
	 <div class="form-group row">
		<label for="iki" class="col-sm-2 col-form-label">İkinci Başlık  * </label>
		<div class="col-sm-6">
		 <input type="text" name="iki" class="form-control" id="iki" placeholder="İkinci Başlık" value="<?php echo $yaz['iki']; ?>" required >
		</div>	
		
		 
		 
<!--
		<div class="col-sm-4">
		 <input type="text" name="ikid" class="form-control" id="ikid" placeholder="İkinci Link" value="" required >
		</div>
-->
	</div>
		
		
		  <div class="form-group row">
		<label for="bira" class="col-sm-2 col-form-label"> Ön Yazı </label>
		<div class="col-sm-10">
		<textarea name="bira" class="form-control" id="bira" cols="50" rows="2" placeholder="Ön Yazı" ><?php echo $yaz['bira']; ?></textarea>
			 
		</div>
	</div>   
		
		
<!--
	
	 <div class="form-group row">
		<label for="ikib" class="col-sm-2 col-form-label">İkinci Görsel 235*135 * </label>
		<div class="col-sm-2">
		  <input type="file" name="ikib" class="form-control" id="ikib" placeholder="" required  > 
			 				
		</div>	
		
		<div class="col-sm-2"> 
		  
			 				
		</div>   
	 
	</div>  
	

	 
	 <hr/>
	 -->
  
	
	 <div class="form-group row">
		<label for="uc" class="col-sm-2 col-form-label">Link Açıklama / Link * </label>
		<div class="col-sm-3">
		 <input type="text" name="uc" class="form-control" id="uc" placeholder="Link Açıklama" value="<?php echo $yaz['uc']; ?>" required >
		</div>
		
		<div class="col-sm-4">
		 <input type="text" name="ucd" class="form-control" id="ucd" placeholder=" Link" value="<?php echo $yaz['ucd']; ?>" required >
		</div>
	</div>
		
		
<!--
		
	
	<hr/> 
	 <div class="form-group row">
		<label for="bir" class="col-sm-2 col-form-label">Birinci Başlık / Link * </label>
		<div class="col-sm-3">
		 <input type="text" name="bir" class="form-control" id="bir" placeholder="Birinci Başlık" value="<?php echo $yaz['bir']; ?>" required > 
	 
		</div>  
		<div class="col-sm-4">
		 <input type="text" name="bird" class="form-control" id="bird" placeholder="Birinci Link" value="<?php echo $yaz['bird']; ?>" required > 
	 
		</div>
	</div>
	
	 

 <div class="form-group row">
		<label for="birb" class="col-sm-2 col-form-label">Birinci Görsel 235*135 * </label>
		<div class="col-sm-3">
		  <input type="file" name="birb" class="form-control" id="birb" placeholder="Küçük Resim Boyutu"   > 
			 	<small id="birb" class="ul-form__text form-text "> Yeni resim istemiyorsanız işlem yapmayınız </small>	
 
			<input type="hidden" name="gbir"  value="<?php echo $yaz['birb']; ?>"   > 
		  
		</div>
	 
	 <a href="../uploads/avideo/<?php echo $yaz['birb']; ?>" target="_blank" >
	 <img src="../uploads/avideo/<?php echo $yaz['birb']; ?>" title="Büyük Resim" alt="Büyük Resim" style="background-color:#ddd; width:100px; "></a>
	 
	 
	</div>

	
	  
	 <hr/>
	 
	 
	  <div class="form-group row">
		<label for="iki" class="col-sm-2 col-form-label">İkinci Başlık / Link * </label>
		<div class="col-sm-3">
		 <input type="text" name="iki" class="form-control" id="iki" placeholder="İkinci Başlık" value="<?php echo $yaz['iki']; ?>" required > 
	 
		</div>  
		<div class="col-sm-4">
		 <input type="text" name="ikid" class="form-control" id="ikid" placeholder="İkinci Link" value="<?php echo $yaz['ikid']; ?>" required > 
	 
		</div>
	</div>
	
	 

 <div class="form-group row">
		<label for="ikib" class="col-sm-2 col-form-label">İkinci Görsel 235*135 * </label>
		<div class="col-sm-3">
		  <input type="file" name="ikib" class="form-control" id="ikib" placeholder="Küçük Resim Boyutu"   > 
			 	<small id="ikib" class="ul-form__text form-text "> Yeni resim istemiyorsanız işlem yapmayınız </small>	
 
			<input type="hidden" name="giki"  value="<?php echo $yaz['ikib']; ?>"   > 
		  
		</div>
	 
	 <a href="../uploads/avideo/<?php echo $yaz['ikib']; ?>" target="_blank" >
	 <img src="../uploads/avideo/<?php echo $yaz['ikib']; ?>" title="Büyük Resim" alt="Büyük Resim" style="background-color:#ddd; width:100px; "></a>
	 
	 
	</div>

	
	  
	 <hr/>
	 
  
	
	
	  <div class="form-group row">
		<label for="uc" class="col-sm-2 col-form-label">Üçüncü Başlık / Link * </label>
		<div class="col-sm-3">
		 <input type="text" name="uc" class="form-control" id="uc" placeholder="Üçüncü Başlık" value="<?php echo $yaz['uc']; ?>" required > 
	 
		</div>  
		<div class="col-sm-4">
		 <input type="text" name="ucd" class="form-control" id="ucd" placeholder="Üçüncü Link" value="<?php echo $yaz['ucd']; ?>" required > 
	 
		</div>
	</div>
	
	 

 <div class="form-group row">
		<label for="ucb" class="col-sm-2 col-form-label">Üçüncü Görsel 235*135 * </label>
		<div class="col-sm-3">
		  <input type="file" name="ucb" class="form-control" id="ucb" placeholder="Küçük Resim Boyutu"   > 
			 	<small id="ucb" class="ul-form__text form-text "> Yeni resim istemiyorsanız işlem yapmayınız </small>	
 
			<input type="hidden" name="guc"  value="<?php echo $yaz['ucb']; ?>"   > 
		  
		</div>
	 
	 <a href="../uploads/avideo/<?php echo $yaz['ucb']; ?>" target="_blank" >
	 <img src="../uploads/avideo/<?php echo $yaz['ucb']; ?>" title="Büyük Resim" alt="Büyük Resim" style="background-color:#ddd; width:100px; "></a>
	 
	 
	</div>
 
	 <hr/>
	 
	 
	  <div class="form-group row">
		<label for="dort" class="col-sm-2 col-form-label">Dördüncü Başlık / Link * </label>
		<div class="col-sm-3">
		 <input type="text" name="dort" class="form-control" id="dort" placeholder="Dördüncü Başlık" value="<?php echo $yaz['dort']; ?>" required > 
	 
		</div>  
		<div class="col-sm-4">
		 <input type="text" name="dortd" class="form-control" id="dortd" placeholder="Dördüncü Link" value="<?php echo $yaz['dortd']; ?>" required > 
	 
		</div>
	</div>
	
	 

 <div class="form-group row">
		<label for="dortb" class="col-sm-2 col-form-label">Dördüncü Görsel 235*135 * </label>
		<div class="col-sm-3">
		  <input type="file" name="dortb" class="form-control" id="dortb" placeholder="Küçük Resim Boyutu"   > 
			 	<small id="dortb" class="ul-form__text form-text "> Yeni resim istemiyorsanız işlem yapmayınız </small>	
 
			<input type="hidden" name="gdort"  value="<?php echo $yaz['dortb']; ?>"   > 
		  
		</div>
	 
	 <a href="../uploads/avideo/<?php echo $yaz['dortb']; ?>" target="_blank" >
	 <img src="../uploads/avideo/<?php echo $yaz['dortb']; ?>" title="Büyük Resim" alt="Büyük Resim" style="background-color:#ddd; width:100px; "></a>
	 
	 
	</div>

	
	  
	 <hr/>
	 
-->
	
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
  
  
				
				