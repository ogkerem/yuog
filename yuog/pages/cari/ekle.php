	<?php 
	 
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
	$konu 		= "carifirma";
	$kategori 	= $konu."kat";
	
	
	$dilbak = @$_GET['dil'];
	if($dilbak==""){ 
	$dilbak = $mysqli->query("select * from diller order by sira asc limit 1 "); 
	$dilyaz = $dilbak->fetch_array();
		$dil = $dilyaz['id'];
	} else {
		$dil = $dilbak;	
		$dilbak = $mysqli->query("select * from diller where id='$dil' "); 
		$dilyaz = $dilbak->fetch_array();
	} 
	
	$katID	= @$_GET['katID'];
	if($katID!=""){ 
	$katbak = $mysqli->query("select * from $konu where id='$katID'");
	$katyaz = $katbak->fetch_array();
	 
	}
	
	 $birsay = $mysqli->query("select * from adminyetki where adminID='$adminID' && bolumID='3' ")->num_rows;  
	if($birsay==0){
		echo 'No direct script access allowed / Yetkisiz Erişim '; 
		
		exit();
	} 
	
	
	 
	?>
	<div class="main-content">
	
   <div class="breadcrumb">
                <h1><a href="?sy=cari"> Cari (Firmalar)</a> > <?php echo $dilyaz['baslik']; ?>  </h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li> İçerik Ekleme </li>
                  
                     
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
	
	  
	$firma				= addslashes(trim($_POST['firma']));
	$yetkili			= addslashes(trim($_POST['yetkili']));
	$mail				= addslashes(trim($_POST['mail']));
	$vergidairesi		= addslashes(trim($_POST['vergidairesi']));
	$vergino			= addslashes(trim($_POST['vergino']));
	$banka				= addslashes(trim($_POST['banka']));
	$subekodu			= addslashes(trim($_POST['subekodu']));
	$hesapno			= addslashes(trim($_POST['hesapno']));
	$iban				= addslashes(trim($_POST['iban']));
	$adres				= addslashes(trim($_POST['adres']));
	$tel				= addslashes(trim($_POST['tel']));
	$aciklama			= addslashes(trim($_POST['aciklama']));
 
	$ekleyen			= $email;  
	$ip					= $_SERVER['REMOTE_ADDR']; 
	
  
	$gonder  	= $mysqli->query(" insert into carifirma set 
	
	 
		firma 				='$firma', 
		yetkili				='$yetkili', 
		mail				='$mail', 
		vergidairesi 		='$vergidairesi', 
		vergino				='$vergino', 
		banka 				='$banka', 
		subekodu			='$subekodu', 
		hesapno				='$hesapno', 
		iban 				='$iban', 
		adres 				='$adres', 
		tel 				='$tel', 
		aciklama 			='$aciklama', 
		ekleyen				= '$ekleyen', 
		ip					='$ip', 
		tarih				= now() 
	 
	  ");   
	  
	if($gonder){
		
		  $icerikID	= $mysqli->insert_id;		 
		 header("Location:?sy=cariayrinti&id=".$icerikID."&islem=basarili");	
		  
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
		<label for="firma" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Firma * </label>
		<div class="col-sm-6">
		 <input type="text" name="firma" class="form-control" id="firma" placeholder="Firma" value="" required >
		</div>
	</div>
	
 
<div class="form-group row">
		<label for="yetkili" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Yetkili </label>
		<div class="col-sm-6">
		 <input type="text" name="yetkili" class="form-control" id="yetkili" placeholder="Yetkili" value=""   >
		</div>
	</div> 
	
<div class="form-group row">
		<label for="mail" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Mail Adresi * </label>
		<div class="col-sm-6">
		 <input type="email" name="mail" class="form-control" id="mail" placeholder="Maili" value="" required  >
		</div>
	</div>
	
	 	  
<div class="form-group row">
		<label for="tel" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Telefon </label>
		<div class="col-sm-3">
		 <input type="text" name="tel" class="form-control" id="tel" placeholder="Telefon" value=""   >
		</div>
	 
	</div> 
	 
<div class="form-group row">
		<label for="vergidairesi" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Vergi Dairesi </label>
		<div class="col-sm-2">
		 <input type="text" name="vergidairesi" class="form-control" id="vergidairesi" placeholder="Vergi Dairesi" value=""   >
		</div>
		<label for="vergino" class="col-sm-1 col-form-label"><i class="fa fa-heading"></i> Vergi No </label>
		<div class="col-sm-2">
		 <input type="text" name="vergino" class="form-control" id="vergino" placeholder=" Vergi No" value=""  >
		</div>
	</div>
	
	<hr>
	 
 
<div class="form-group row">
		<label for="banka" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Banka Adı </label>
		<div class="col-sm-4">
		 <input type="text" name="banka" class="form-control" id="banka" placeholder="Banka Adı" value=""   >
		</div>
	 
	</div> 
	
<div class="form-group row">
		<label for="subekodu" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Şube / Hesap No </label>
		<div class="col-sm-1">
		 <input type="text" name="subekodu" class="form-control" id="subekodu" placeholder="Şube" value=""   >
		</div>
		 /
		<div class="col-sm-2">
		 <input type="text" name="hesapno" class="form-control" id="hesapno" placeholder="Hesap No" value=""  >
		</div>
	</div>
	
	
	<div class="form-group row">
		<label for="iban" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> IBAN </label>
		<div class="col-sm-4">
		 <input type="text" name="iban" class="form-control" id="iban" placeholder="IBAN" value=""   >
		</div>
	 
	</div> 
	 
	<hr>
	 
	  
<div class="form-group row">
		<label for="adres" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Adres </label>
		<div class="col-sm-5">
		 <input type="text" name="adres" class="form-control" id="adres" placeholder="Adres" value=""   >
		</div>
	 
	</div> 
	

 
	 	  
	 		 
  <div class="form-group row">
		<label for="aciklama" class="col-sm-2 col-form-label"> Açıklama </label>
		<div class="col-sm-10">
		<textarea name="aciklama" class="form-control" id="aciklama" cols="50" rows="2" placeholder="Açıklama" ></textarea>
			 
		</div>
	</div>   
 
   
  
		 
	<div class="form-group row">
	<label for="sira" class="col-sm-2 col-form-label">  </label>
		<div class="col-sm-10">
			<button type="submit" class="btn btn-primary ul-btn__text">Firma Ekle</button>
		 
		</div>
	</div>
	
		</form>

			<?php } ?>
				</div>
			</div>
		</div>
	</div>            
</div> 
				