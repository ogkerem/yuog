	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	$id 	= $_GET['id'];
	$bak 	= $mysqli->query("select * from admin where id='$id' ");
	$yaz 	= $bak->fetch_array();
	
	?>
	<div class="main-content">
	
   <div class="breadcrumb">
                <h1>Admin Düzenleme</h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li><a href="?sy=admin">Adminler</a></li>
                   
                     
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
                   
                    <p>  </p>
                    <div class="card mb-5">
                        <div class="card-body">
						
						<?php 
if($_POST){ 
	
	$mail				= addslashes(trim($_POST['email1']));
	$sifre1 			= sha1(md5(trim($_POST['sifre1'])));	 
	$adsoyad			= trim($_POST['adsoyad']);
	$tel				= trim($_POST['tel']);
	$adres				= addslashes(trim($_POST['adres']));
	$resim				= ' ';
	$mertebe			= $_POST['mertebe'];
	$yetki				= $_POST['yetki'];
	$hatirlat			= md5(rand(0,9999)); 
	
	$durum1				= $_POST['durum']; 
	 
	if($durum1=="on"){ $durum = 1; } else { $durum = 0; }
	
	$ekleyen			= $email;  
	$ip					= $_SERVER['REMOTE_ADDR'];
	 
	 if(($_POST['sifre1']=="")){
			$sifre = 	$yaz['sifre'];	
		 }  else  {
			$sifre = $sifre1;
		} 
		
	 $gonder  	= $mysqli->query(" update admin set 	 
	 mail 					='$mail', 
	 sifre 					='$sifre', 
	 adsoyad 				='$adsoyad', 
	 tel 					='$tel', 
	 adres 					='$adres', 
	 resim 					='$resim', 
	 durum					='$durum', 
	 mertebe				='$mertebe', 
	 hatirlat				='$hatirlat', 
	 ip						='$ip', 
	 tarih					= now(),
	 ekleyen				= '$ekleyen' 
	 
	 where id='$id'
	 
	  ");  
	  
		
	if($gonder){
	 
	$sill = $mysqli->query("delete from adminyetki where adminID='$id' "); 
	
	$yetkisay = count($yetki);	
	for($aa=0; $aa < $yetkisay; $aa++){	
 
		$bolumID		= $yetki[$aa]; 
		  
 $turaciklamaekle	= $mysqli->query("insert into adminyetki (adminID, bolumID, durum ) values ('$id', '$bolumID', '1')");	
	     
	 }		
	 
	 
	 header("Location:?sy=admin&islem=basarili");
		
	} else {
		
		echo '<div class="alert alert-danger" role="alert">
				<strong class="text-capitalize">Hata!!! </strong> İçerik eklenemedi     
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div> <br /> <a href="javascript:history.back(-1)">Geri Dön</a>';
			
			
	}	
 
 
	  
} else { 
?>	



	<form action="" method="post" enctype="multipart/form-data" >
							
	<div class="form-group row">
		<label for="adsoyad" class="col-sm-2 col-form-label">Ad Soyad * </label>
		<div class="col-sm-4">
		 <input type="text" name="adsoyad" class="form-control" id="adsoyad" placeholder="Ad Soyad" value="<?php echo $yaz['adsoyad']; ?>" required >
		</div>
	</div>
									
	<div class="form-group row">
		<label for="email1" class="col-sm-2 col-form-label"> Mail Adresi * </label>
		<div class="col-sm-3">
	 <input type="text" name="email1" class="form-control" id="email1" placeholder="Mail" value="<?php echo $yaz['mail']; ?>" required >
 <span id="maildee"></span>
		</div>
	</div>
			
 
	<script type="text/javascript"> 
		$(function(){
			$("input[name=email1]").change(function(){
				 
				var emaill = $("input[name=email1]").val();
				  
				$.ajax({
					url: "pages/admin/mailsor.php",
					type: "POST",
					data: {"emaill":emaill},
					success: function(ortakat) { 
						$("#maildee").html(ortakat);
					}
					
				});
				
			});
			
		});
		</script> 		

		
	  <div class="form-group row">
		<label for="mertebe" class="col-sm-2 col-form-label">Görev  </label>
		<div class="col-sm-3">
		 
		  <label for="mertebe"  > </label>
					<select class="custom-select task-manager-list-select " name="mertebe" >
						 
			<?php 
				$ukat  = $mysqli->query("select * from adminkat  order by sira asc ");
					while($uyaz = $ukat->fetch_array()){
						
					if($uyaz['id']==$yaz['mertebe']){
						echo '<option value='.$uyaz['id'].' selected >'.$uyaz['baslik'].'</option>'; 
					} else {
						echo '<option value='.$uyaz['id'].' >'.$uyaz['baslik'].'</option>'; 
					}	
						
					}
			
			?>			
					 
		 </select>
			 
		 
		</div>		
		
	 
		 
	</div>  
		
<div class="form-group row">
		<label for="baslik" class="col-sm-2 col-form-label"> Tel </label>
		<div class="col-sm-4">
		 <input type="text" name="tel" class="form-control" id="baslik" placeholder="Telefon" value="<?php echo $yaz['tel']; ?>"   >
		</div>
	</div>
					
<div class="form-group row">
		<label for="baslik" class="col-sm-2 col-form-label"> Adres </label>
		<div class="col-sm-8">
		 <input type="text" name="adres" class="form-control" id="baslik" placeholder="Adres" value="<?php echo $yaz['adres']; ?>"  >
		</div>
	</div>
			
			
 				
<div class="form-group row">
		<label for="sifre1" class="col-sm-2 col-form-label"> Şifre </label>
		<div class="col-sm-2">
		 <input type="password" name="sifre1" class="form-control" id="sifre1" placeholder="Şifre Tekrar"   autocomplete="off"  >
		 <small id="web" class="ul-form__text form-text "> Şifre değiştirmeyecekseniz boş bırakınız </small>
		</div>
	</div>
			
 
	  		
 	<!--	<hr/> 
<div class="form-group row">

<h4> Yetkiler </h4>

	 
		 
	</div>
	  
	  
	  <div class="form-group   ">
	 
		<div class="col-lg-12 d-inline-flex align-self-center">

	<label class="checkbox checkbox-primary mr-4">
	<input type="checkbox" 
	<?php  
	$birbak = $mysqli->query("select * from adminyetki where adminID='$id' && bolumID='1' "); 
	$birsay = $birbak->num_rows;
	if($birsay>0){ echo 'checked'; } else { echo ''; }
	?>   name="yetki[]" value="1" >
	<span>Bütün Rezervasyonlar</span>
	<span class="checkmark"></span>

		</label>
		
		 </div>	
		 
		 
		 <div class="col-lg-12 d-inline-flex align-self-center">
		 
	<label class="checkbox checkbox-primary mr-4">
	<input type="checkbox" <?php  
	$birbak = $mysqli->query("select * from adminyetki where adminID='$id' && bolumID='2' "); 
	$birsay = $birbak->num_rows;
	if($birsay>0){ echo 'checked'; } else { echo ''; }
	?> name="yetki[]" value="2"  >
	<span>Sadece Kendi Rezervasyonlar</span>
	<span class="checkmark"></span>

		</label>
		 </div>		 
 
	  
		 
		 <div class="col-lg-12 d-inline-flex align-self-center">
		 
	<label class="checkbox checkbox-primary mr-4">
				<input type="checkbox" <?php  
	$birbak = $mysqli->query("select * from adminyetki where adminID='$id' && bolumID='3' "); 
	$birsay = $birbak->num_rows;
	if($birsay>0){ echo 'checked'; } else { echo ''; }
	?> name="yetki[]" value="3"  >
				<span>Tur İşlemleri</span>
				<span class="checkmark"></span>

		</label>
		 </div>		 
 
	  
		 
		 <div class="col-lg-12 d-inline-flex align-self-center">
		 
	<label class="checkbox checkbox-primary mr-4">
				<input type="checkbox"<?php  
	$birbak = $mysqli->query("select * from adminyetki where adminID='$id' && bolumID='4' "); 
	$birsay = $birbak->num_rows;
	if($birsay>0){ echo 'checked'; } else { echo ''; }
	?> name="yetki[]" value="4"  >
				<span>İçerikler</span>
				<span class="checkmark"></span>

		</label>
		 </div>		 
 
	  
		 
		 <div class="col-lg-12 d-inline-flex align-self-center">
		 
	<label class="checkbox checkbox-primary mr-4">
				<input type="checkbox" <?php  
	$birbak = $mysqli->query("select * from adminyetki where adminID='$id' && bolumID='5' "); 
	$birsay = $birbak->num_rows;
	if($birsay>0){ echo 'checked'; } else { echo ''; }
	?> name="yetki[]" value="5"  >
				<span>Adminler</span>
				<span class="checkmark"></span>

		</label>
		 </div>		 
 
	  
		 
		 <div class="col-lg-12 d-inline-flex align-self-center">
		 
	<label class="checkbox checkbox-primary mr-4">
				<input type="checkbox" <?php  
	$birbak = $mysqli->query("select * from adminyetki where adminID='$id' && bolumID='6' "); 
	$birsay = $birbak->num_rows;
	if($birsay>0){ echo 'checked'; } else { echo ''; }
	?> name="yetki[]" value="6"  >
				<span>Ayarlar</span>
				<span class="checkmark"></span>

		</label>
		 </div>		--> 
 							
			
						
	<div class="form-group row">
	<label for="durum" class="col-sm-2 col-form-label">Durum </label>
	<div class="col-sm-2">
	 
	<label class="switch switch-primary mr-3" id="durum">
		 
		 <?php
		$durum = $yaz['durum'];
		 
		 if($durum==1){
			 
			 echo '<input name="durum" type="checkbox" checked="">';
		 } else {
			 
			 echo '<input  name="durum" type="checkbox" >';
		 }
		 ?>
		
		<span class="slider"></span>
	</label>
							
							
	 	
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
				