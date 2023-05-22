	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
	$konu 		= "musteriler";
	$kategori 	= $konu."kat";
	
	$id 	= $_GET['id'];
	$yaz1 	= $mysqli->query("select * from $konu where id='$id' ");
	$yaz 	= $yaz1->fetch_array();
	
	// $seoID 	= $yaz['seo'];
	// $seobul	= $mysqli->query("select * from seo where id='$seoID' ");
	// $seoyaz = $seobul->fetch_array();
	// $dil 	= $yaz['dil']; 
	// $dilbul = $mysqli->query("select * from diller where id='$dil' ");
	// $dilyaz = $dilbul->fetch_array();
	
	?>
	 
	 <div class="main-content">
	
   <div class="breadcrumb">
                <h1><a href="?sy=<?php echo $konu; ?>"> Müşteriler </a>  <?php echo $yaz['adsoyad']; ?>  </h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li>İçerik Güncelleme</li>
                  
                     
                </ul>
            </div>
		 
		  
<script type="text/javascript">
	
	$(function(){
		
		$(".resimsill1").click(function(){
		   $(this).parent().remove();
		   return false;
		}); 
		
	}); 
 </script>
	 
	 
	 
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
                   
                    <p>  </p>
                    <div class="card mb-5">
                        <div class="card-body">
 
					
						<?php 
if($_POST){ 
	
	$eposta				= $_POST['eposta'];
	$sifre				= $_POST['sifre'];
 
	$adsoyad			= addslashes(trim($_POST['adsoyad']));
	$tel				= addslashes(trim($_POST['tel']));
	$adres				= addslashes(trim($_POST['adres']));
	$vergidairesi		= addslashes(trim($_POST['vergidairesi']));
	
	$vergino			= addslashes(trim($_POST['vergino']));
	$sehir				= addslashes(trim($_POST['sehir']));
	$kimlikno			= addslashes(trim($_POST['kimlikno']));
	   
	$durum1				= $_POST['durum']; 	 
	if($durum1=="on"){ $durum = 1; } else { $durum = 0; }  
	 
  
	
	$gonder  	= $mysqli->query(" update $konu set  
		
		eposta 				='$eposta', 
		adsoyad 			='$adsoyad', 
		tel 				='$tel',
		adres 				='$adres', 
		vergidairesi		='$vergidairesi',
		vergino 			='$vergino',	 
		sehir 				='$sehir', 
		kimlikno 			='$kimlikno', 
		durum 				='$durum'  
	  
	  
		where id='$id'
	 
	  ");   
	  
	if($gonder){
	 
	 //resimler 
		if($sifre!=""){

		$sifre = sha1(md5(trim($sifre)));			
		
		 
		$guncelle 	= $mysqli->query("update $konu set sifre='$sifre' where id='$id' ");
	}	
	
      

	
	 header("Location:?sy=".$konu."&islem=basarili");	
		  
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
		<label for="baslik" class="col-sm-2 col-form-label"> <i class="fa fa-language"></i> Dil </label>
		
	 
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


<div class="form-group row">
		<label for="adsoyad" class="col-sm-2 col-form-label">Adsoyad * </label>
		<div class="col-sm-2">
		 <input type="text" name="adsoyad" class="form-control" id="adsoyad" placeholder="Başlık" value="<?php echo $yaz['adsoyad']; ?>" required >
		</div>
	</div>
	
	
		
<div class="form-group row">
		<label for="eposta" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Eposta   </label>
		<div class="col-sm-2">
		 <input type="text" name="eposta" class="form-control" id="eposta" placeholder="eposta" value="<?php echo $yaz['eposta']; ?>"   >
		</div>
	</div>
		
		
<div class="form-group row">
		<label for="tel" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Telefon  </label>
		<div class="col-sm-2">
		 <input type="text" name="tel" class="form-control" id="tel" placeholder="tel" value="<?php echo $yaz['tel']; ?>"   >
		</div>
	</div>
	
 					
	
	 

	 
					
<div class="form-group row">
		<label for="vergidairesi" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Vergi Dairesi   </label>
		<div class="col-sm-2">
		 <input type="text" name="vergidairesi" class="form-control" id="vergidairesi" placeholder="vergidairesi" value="<?php echo $yaz['vergidairesi']; ?>"   >
		</div>
	</div>
	
 							
<div class="form-group row">
		<label for="vergino" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Vergi No   </label>
		<div class="col-sm-2">
		 <input type="text" name="vergino" class="form-control" id="vergino" placeholder="vergino" value="<?php echo $yaz['vergino']; ?>"   >
		</div>
	</div>
	
	
<div class="form-group row">
		<label for="kimlikno" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Kimlik No   </label>
		<div class="col-sm-2">
		 <input type="text" name="kimlikno" class="form-control" id="kimlikno" placeholder="kimlikno" value="<?php echo $yaz['kimlikno']; ?>"   >
		</div>
	</div>
	 
 
 	<script type="text/javascript"> 
		$(function(){
			$("select[name=ustkatID]").change(function(){
				 
				var ustkatID = $("select[name=ustkatID]").val();
				 
				$.ajax({
					url: "pages/bolumler/ukatbak.php",
					type: "POST",
					data: {"ustkatID":ustkatID},
					success: function(ortakat) { 
						$("#altkat").html(ortakat);
					}
					
				});
				
			});
			
		});
		</script> 		


<?php
	// $ustkat 		= $yaz['ustkatID'];
	// $ustkatbul 		= $mysqli->query("select * from $konu where id='$ustkat' ");
	// $ustkatyaz 		= $ustkatbul->fetch_array();
	
?>
		
	  <div class="form-group row">
		<label for="sehir" class="col-sm-2 col-form-label">Şehir *  </label>
		<div class="col-sm-2">
		 
		  <label for="sehir"  > </label>
		 <select class="custom-select task-manager-list-select" name="sehir" required > 
			<option value="">Şehir Seçin * </option>
			<?php 
			 $sehirbak  = $mysqli->query("select * from iller order by adi asc ");
					while($uyaz = $sehirbak->fetch_array()){
						
					if($uyaz['id']==$yaz['sehir']){
						echo '<option value='.$uyaz['id'].' selected >'.$uyaz['adi'].'</option>'; 
					}	 else {
						echo '<option value='.$uyaz['id'].' >'.$uyaz['adi'].'</option>'; 
					}
						
					}
			
			?>			
					 
		 </select>
		  
 
		</div>		
	 	 
	</div>   
	
	
	
						
<div class="form-group row">
		<label for="adres" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Adres  </label>
		<div class="col-sm-6">
		 <input type="text" name="adres" class="form-control" id="adres" placeholder="adres" value="<?php echo $yaz['adres']; ?>"   >
		</div>
	</div>
		
		
		
	<div class="form-group row">
		<label for="sifre" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Şifre Değiştir  </label>
		<div class="col-sm-2">
		 <input type="text" name="sifre" class="form-control" id="sifre" placeholder="Yeni Şifre" value=""   >
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
	<label for="eklemetarih" class="col-sm-2 col-form-label">Kayıt Tarihi </label>
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
				