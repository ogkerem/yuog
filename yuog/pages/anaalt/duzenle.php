	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	 
	$id 	= $_GET['id'];
	$yaz1 	= $mysqli->query("select * from anaalt where id='$id' ");
	$yaz 	= $yaz1->fetch_array();
	
	 
	$dilid 	= $yaz['dil']; 
	$dilbul = $mysqli->query("select * from diller where id='$dilid' ");
	$dilyaz = $dilbul->fetch_array();
	
	?>
	 
	 <div class="main-content">
	
   <div class="breadcrumb">
                <h1> <a href="?sy=anaalt">Ana Sayfa Alt Bölüm</a> >  <?php echo $dilyaz['baslik']; ?>  </h1>
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
	$birb				= addslashes(trim($_POST['birb']));
  
	$iki				= addslashes(trim($_POST['iki']));
	$ikia				= addslashes(trim($_POST['ikia']));
	$ikib				= addslashes(trim($_POST['ikib']));
  
	$uc					= addslashes(trim($_POST['uc']));
	$uca				= addslashes(trim($_POST['uca']));
	$ucb				= addslashes(trim($_POST['ucb']));
  
  
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
 
	$rhedef				= "../uploads/anaalt/";	
	  
	$gonder  	= $mysqli->query(" update anaalt set  
	
		baslik 				='$baslik', 
		onyazi 				='$onyazi', 
		icerik 				='$icerik',  	
		
		bir					='$bir', 		
		bira				='$bira', 		
		birb				='$birb', 		
		
		iki					='$iki', 		
		ikia				='$ikia', 		
		ikib				='$ikib', 		
		
		uc					='$uc', 		
		uca					='$uca', 		
		ucb					='$ucb', 		
		
		 
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
		$guncelle 	= $mysqli->query("update anaalt set kresim='$resimsonad' where id='$id' ");
	}	
	
	if($resimad!=""){ 	 
		
		unlink($rhedef.$gresim);	
		$kaynak		= $_FILES['resim']['tmp_name'];
		$resimsonad = rand(0,999).'-'.yeniurl(res_adi($resimad)).res_uzanti($resimad);
		$yukle 		= move_uploaded_file($kaynak,$rhedef."/".$resimsonad); 
		$guncelle 	= $mysqli->query("update anaalt set resim='$resimsonad' where id='$id' ");
	}
	 
  
				 
		  header("Location:?sy=anaalt&islem=basarili");	
		  
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
		
	 
    <div class="col-4  ">
    
	  <select class="form-control" name="dil">
	  
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


<div class="form-group row">
	<label for="baslik" class="col-sm-2 col-form-label">Başlık * </label>
	<div class="col-sm-6">
	 <input type="text" name="baslik" class="form-control" id="baslik" placeholder="Başlık" value="<?php echo $yaz['baslik']; ?>" required >
	</div>
</div>
	 
	 
 <div class="form-group row">
		<label for="kresim" class="col-sm-2 col-form-label">Sol Resim Büyük ( 2000 * 1100 )  *</label>
		<div class="col-sm-3">
		  <input type="file" name="kresim" class="form-control" id="kresim" placeholder="Küçük Resim Boyutu"   > 
			 	<small id="kresim" class="ul-form__text form-text "> Yeni resim istemiyorsanız işlem yapmayınız </small>	
 
			<input type="hidden" name="gkresim"  value="<?php echo $yaz['kresim']; ?>"   > 
		  
		</div>
	 
	 <a href="../uploads/anaalt/<?php echo $yaz['kresim']; ?>" target="_blank" >
	 <img src="../uploads/anaalt/<?php echo $yaz['kresim']; ?>" title="Büyük Resim" alt="Büyük Resim" style="background-color:#ddd; width:100px; "></a>
	 
	 
	</div>
	 
   
 <!-- <div class="form-group row">
		<label for="onyazi" class="col-sm-2 col-form-label"> Ön Yazı </label>
		<div class="col-sm-10">
		<textarea name="onyazi" class="form-control" id="onyazi" cols="50" rows="2" placeholder="Ön Yazı" ><?php echo $yaz['onyazi']; ?></textarea>
			 
		</div>
	</div>   -->
 

	<div class="form-group row">
		<label for="icerik" class="col-sm-2 col-form-label"> İçerik  </label>
		<div class="col-sm-10">
		<textarea name="icerik" class="ckeditor" id="icerik" cols="40" rows="3"><?php echo $yaz['icerik']; ?></textarea>
	  
		</div> 
	</div>
	
		 
 <div class="form-group row">
		<label for="resim" class="col-sm-2 col-form-label">Sağ Resim İmza * ( 200 * 100 )  </label>
		<div class="col-sm-3">
		  <input type="file" name="resim" class="form-control" id="resim" placeholder="Küçük Resim Boyutu"   > 
			 	<small id="resim" class="ul-form__text form-text "> Yeni resim istemiyorsanız işlem yapmayınız </small>	
 
			<input type="hidden" name="gresim"  value="<?php echo $yaz['resim']; ?>"   > 
		  
		</div>
	 
	 <a href="../uploads/anaalt/<?php echo $yaz['resim']; ?>" target="_blank" >
	 <img src="../uploads/anaalt/<?php echo $yaz['resim']; ?>" title="Büyük Resim" alt="Büyük Resim" style="background-color:#ddd; width:100px; "></a>
	 
	 
	</div>
	
  
  <hr/> 
	
	 
	 	<div class="form-group row">
		<label for="bira" class="col-sm-2 col-form-label"> Video Link * </label>
		<div class="col-sm-6">
		 <input type="text" name="bira" class="form-control" id="bira" placeholder="Video Link" value="<?php echo $yaz['bira']; ?>" required >
	 
	  
		</div> 
	</div>  
	
	
	 <div class="form-group row">
		<label for="bir" class="col-sm-2 col-form-label">Birinci Başlık * </label>
		<div class="col-sm-6">
		 <input type="text" name="bir" class="form-control" id="bir" placeholder="Birinci Başlık" value="<?php echo $yaz['bir']; ?>" required >
		</div>
	</div>
	 
 	 <div class="form-group row">
		<label for="birb" class="col-sm-2 col-form-label">Birinci Alt Başlık * </label>
		<div class="col-sm-6">
		 <input type="text" name="birb" class="form-control" id="birb" placeholder="Birinci Alt Başlık " value="<?php echo $yaz['birb']; ?>" required >
		</div>
	</div>
	
	
	 <hr/>
	
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
  
  
				
				