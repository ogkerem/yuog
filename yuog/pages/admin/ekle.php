	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	 
	
	?>
	<div class="main-content">
	
   <div class="breadcrumb">
                <h1>Admin Ekleme</h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li><a href="?sy=admin">Adminler</a></li>
                   
                     
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
	
	$mail				= addslashes(trim($_POST['email1']));
	$sifre1				= trim($_POST['sifre1']);
	$sifre2				= trim($_POST['sifre2']);
	$adsoyad			= trim($_POST['adsoyad']);
	$tel				= trim($_POST['tel']);
	$adres				= addslashes(trim($_POST['adres']));
	$resim				= ' ';
	$mertebe			= $_POST['mertebe'];
	$yetki				= $_POST['yetki'];
	$hatirlat			= md5(rand(0,9999)); 
	$durum				= 1;
	$ekleyen			= $email;  
	$ip					= $_SERVER['REMOTE_ADDR'];
	
	
	if($sifre1==$sifre2){
		 
		$sifre = sha1(md5(trim($_POST['sifre1'])));
		
	 $gonder  	= $mysqli->query(" insert into admin set 
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
	 
	  ");  
	  
		
	if($gonder){
		$adminID		= $mysqli->insert_id;
		
		
	$yetkisay = count($yetki);	
	for($aa=0; $aa < $yetkisay; $aa++){	
 
		$bolumID		= $yetki[$aa]; 
		  
 $turaciklamaekle	= $mysqli->query("insert into adminyetki (adminID, bolumID, durum ) values ('$adminID', '$bolumID', '1')");	
	     
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
	 	
		
	} else {   echo '<div class="alert alert-danger" role="alert">
				<strong class="text-capitalize">Hata!!! </strong>Şifreler aynı değil    
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div> <br /> <a href="javascript:history.back(-1)">Geri Dön</a>'; 
			
			} 
 
	  
} else { 
?>	



	<form action="" method="post" enctype="multipart/form-data"  autocomplete="off" >
							
	<div class="form-group row">
		<label for="adsoyad" class="col-sm-2 col-form-label">Ad Soyad * </label>
		<div class="col-sm-4">
		 <input type="text" name="adsoyad" class="form-control" id="adsoyad" placeholder="Ad Soyad" value="" required  autocomplete="off" >
		</div>
	</div>
									
	<div class="form-group row">
		<label for="email1" class="col-sm-2 col-form-label"> Mail Adresi * </label>
		<div class="col-sm-3">
	 <input type="text" name="email1" class="form-control" id="email1" placeholder="Mail" value="" required   autocomplete="off" >
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
						
						echo '<option value='.$uyaz['id'].' >'.$uyaz['baslik'].'</option>'; 
					}
			
			?>			
					 
		 </select>
			 
		 
		</div>		
		
	 
		 
	</div>  
		
<div class="form-group row">
		<label for="baslik" class="col-sm-2 col-form-label"> Tel </label>
		<div class="col-sm-4">
		 <input type="text" name="tel" class="form-control" id="baslik" placeholder="Telefon" value=""  autocomplete="off"  >
		</div>
	</div>
					
<div class="form-group row">
		<label for="baslik" class="col-sm-2 col-form-label"> Adres </label>
		<div class="col-sm-8">
		 <input type="text" name="adres" class="form-control" id="baslik" placeholder="Adres" value=""  autocomplete="off" >
		</div>
	</div>
			
			
 				
<div class="form-group row">
		<label for="sifre1" class="col-sm-2 col-form-label"> Şifre </label>
		<div class="col-sm-2">
		 <input type="password" name="sifre1" class="form-control" id="sifre1" placeholder="Şifre Tekrar"   autocomplete="off"  >
		</div>
	</div>
			
			
 				
<div class="form-group row">
		<label for="sifre2" class="col-sm-2 col-form-label"> Şifre Tekrar </label>
		<div class="col-sm-2">
		 <input type="password" name="sifre2" class="form-control" id="sifre2" placeholder="Şifre Tekrar"  autocomplete="off" >
		</div>
	</div>
	  		
 <!--		<hr/> 
 <div class="form-group row">

<h4> Yetkiler </h4>

	 
		 
	</div>
	  
	  
	  <div class="form-group   ">
	 
		<div class="col-lg-12 d-inline-flex align-self-center">

	<label class="checkbox checkbox-primary mr-4">
				<input type="checkbox" checked="" name="yetki[]" value="1" >
				<span>Bütün Rezervasyonlar</span>
				<span class="checkmark"></span>

		</label>
		
		 </div>	
		 
		 
		 <div class="col-lg-12 d-inline-flex align-self-center">
		 
	<label class="checkbox checkbox-primary mr-4">
				<input type="checkbox" checked="" name="yetki[]" value="2"  >
				<span>Sadece Kendi Rezervasyonlar</span>
				<span class="checkmark"></span>

		</label>
		 </div>		 
 
	  
		 
		 <div class="col-lg-12 d-inline-flex align-self-center">
		 
	<label class="checkbox checkbox-primary mr-4">
				<input type="checkbox" checked="" name="yetki[]" value="3"  >
				<span>Tur İşlemleri</span>
				<span class="checkmark"></span>

		</label>
		 </div>		 
 
	  
		 
		 <div class="col-lg-12 d-inline-flex align-self-center">
		 
	<label class="checkbox checkbox-primary mr-4">
				<input type="checkbox" checked="" name="yetki[]" value="4"  >
				<span>İçerikler</span>
				<span class="checkmark"></span>

		</label>
		 </div>		 
 
	  
		 
		 <div class="col-lg-12 d-inline-flex align-self-center">
		 
	<label class="checkbox checkbox-primary mr-4">
				<input type="checkbox" checked="" name="yetki[]" value="5"  >
				<span>Adminler</span>
				<span class="checkmark"></span>

		</label>
		 </div>		 
 
	  
		 
		 <div class="col-lg-12 d-inline-flex align-self-center">
		 
	<label class="checkbox checkbox-primary mr-4">
				<input type="checkbox" checked="" name="yetki[]" value="6"  >
				<span>Ayarlar</span>
				<span class="checkmark"></span>

		</label>
		 </div>		--> 
 							
										
  
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
				