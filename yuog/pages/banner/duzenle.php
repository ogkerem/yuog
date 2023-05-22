	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	 
	$id 	= $_GET['id'];
	$yaz1 	= $mysqli->query("select * from banner where id='$id' ");
	$yaz 	= $yaz1->fetch_array();
	$dil 	= $yaz['dil']; 
	$dilbul = $mysqli->query("select * from diller where id='$dil' ");
	$dilyaz = $dilbul->fetch_array();

$sistemyaz 	= $mysqli->query("select * from bannerduzen where id='1' ")->fetch_array();
	?>
	<div class="main-content">
	
   <div class="breadcrumb">
                <h1>Banner Düzenleme</h1>
                <ul>
                  <li><a href="index.php">Ana Sayfa</a></li>
                    <li><a href="?sy=banner">Bannerler</a></li>
                     
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

	$renk				= addslashes(trim($_POST['renk']));
	$ustbaslik			= addslashes(trim($_POST['ustbaslik']));
	$ustbaslikrenk		= addslashes(trim($_POST['ustbaslikrenk']));
	$altbaslik			= addslashes(trim($_POST['altbaslik']));
	$altbaslikrenk		= addslashes(trim($_POST['altbaslikrenk']));
	$aciklama			= addslashes(trim($_POST['aciklama']));
	$aciklamarenk		= addslashes(trim($_POST['aciklamarenk']));
	$video				= $_POST['video'];
	$link2				= addslashes(trim($_POST['link2']));
	$link2aciklama		= addslashes(trim($_POST['link2aciklama']));
	$link				= addslashes(trim($_POST['link']));
	$linkaciklama		= addslashes(trim($_POST['linkaciklama']));
	$vkod				= addslashes(trim($_POST['vkod']));

		
		
	
		
	$dil				= $_POST['dil'];
	$durum 				= $_POST['durum']; 	 
  
	$sira				= trim($_POST['sira']); 
	$hit				= 1;
	 
	$ekleyen			= $email;  
	$ip					= $_SERVER['REMOTE_ADDR']; 
	$gresim				= $_POST['gresim'];  
	$garkaresim				= $_POST['garkaresim'];  
	$gsolresim				= $_POST['gsolresim'];  
	$gsagresim				= $_POST['gsagresim'];  
	$gicon				= $_POST['gicon'];  

	$resimad			= $_FILES['resim']['name'];  
	$arkaresimad		= $_FILES['arkaresim']['name'];  
	$solresimad			= $_FILES['solresim']['name'];  
	$sagresimad			= $_FILES['sagresim']['name'];  
	
	$dvideoad			= $_FILES['dvideo']['name'];
	$dvideokaynak		= $_FILES['dvideo']['tmp_name'];


	$iconad				= $_FILES['icon']['name'];  
	 
	$rhedef				= "../uploads/"; 

	$formatlar = array("jpg", "jpeg", "gif", "png", "mp3", "mp4", "wma");


	if(!empty($dvideoad)) {


	$extension = pathinfo($_FILES['dvideo']['name'], PATHINFO_EXTENSION);



			
	
	if (in_array($extension, $formatlar)) {
		if ($_FILES["dvideo"]["error"] > 0) {
			echo "Return Code: " . $_FILES["dvideo"]["error"] . "<br />";
		} else {
			echo "Upload: " . $_FILES["dvideo"]["name"] . "<br />";
			echo "Type: " . $_FILES["dvideo"]["type"] . "<br />";
			echo "Size: " . ($_FILES["dvideo"]["size"] / 1024) . " Kb<br />";
			echo "Temp file: " . $_FILES["dvideo"]["tmp_name"] . "<br />";
			print_r(dirname(__DIR__, 3) . "/uploads/");


			$dvideoad			= $_FILES['dvideo']['name'];
			$dvideokaynak		= $_FILES['dvideo']['tmp_name'];
			$dvideosonad 		= rand(0, 999) . '-' . yeniurl(res_adi($dvideoad)) . res_uzanti($dvideoad);

			move_uploaded_file($_FILES['dvideo']['tmp_name'], dirname(__DIR__, 3) . "/videos/" . $dvideosonad);
		}
	} else {
		echo "Invalid file";
	}
} 




	if(empty($resimsonad)){
		if(empty($resimad)){
			$resimsonad = $gresim;
		}
	}

	if(empty($resimsonad)){
		if(empty($resimad)){
			$resimsonad = $gresim;
		}
	}
		
	if(empty($arkaresimsonad)){
		if(empty($arkaresimad)){
			$arkaresimsonad = $garkaresim;
		}
	}	
		
	if(empty($solresimsonad)){
		if(empty($solresimad)){
			$solresimsonad = $gsolresim;
		}
	}	
		
	if(empty($sagresimsonad)){
		if(empty($sagresimad)){
			$sagresimsonad = $gsagresim;
		}
	}
		
	if(empty($iconsonad)){
		if(empty($iconad)){
			$iconsonad = $gicon;
		}
	}
		if (!empty($dvideoad)) {
	$gonder  	= $mysqli->query(" update banner set 
	 renk 					='$renk', 
	 ustbaslik 				='$ustbaslik', 
	 ustbaslikrenk 			='$ustbaslikrenk', 
	 altbaslik 				='$altbaslik', 
	 altbaslikrenk 			='$altbaslikrenk', 
	 aciklama 				='$aciklama', 
	 aciklamarenk 			='$aciklamarenk', 
	 video					='$video', 
	 link2					='$link2', 
	 link2aciklama			='$link2aciklama', 
	 link					='$link', 
	 linkaciklama			='$linkaciklama', 
	 resim					='$resimsonad', 
	 arkaresim  			='$arkaresimsonad', 
	 solresim				='$solresimsonad', 
	 sagresim				='$sagresimsonad', 
	 dvideo					='$dvideosonad',     
	 icon					='$iconsonad',   
	 vkod					='$vkod',   
	 
	 ip						='$ip', 
	 tarih					= now(),
	 ekleyen				= '$ekleyen', 
	 hit					= '$hit',
	 sira					= '$sira',
	 dil					= '$dil',
	 durum					= '$durum'  
	 
	 where id='$id'
	 
	  ");
		}
		else
		{
			$gonder  	= $mysqli->query(" update banner set 
	 renk 					='$renk', 
	 ustbaslik 				='$ustbaslik', 
	 ustbaslikrenk 			='$ustbaslikrenk', 
	 altbaslik 				='$altbaslik', 
	 altbaslikrenk 			='$altbaslikrenk', 
	 aciklama 				='$aciklama', 
	 aciklamarenk 			='$aciklamarenk', 
	 video					='$video', 
	 link2					='$link2', 
	 link2aciklama			='$link2aciklama', 
	 link					='$link', 
	 linkaciklama			='$linkaciklama', 
	 resim					='$resimsonad', 
	 arkaresim  			='$arkaresimsonad', 
	 solresim				='$solresimsonad', 
	 sagresim				='$sagresimsonad',    
	 icon					='$iconsonad',   
	 vkod					='$vkod',   
	 
	 ip						='$ip', 
	 tarih					= now(),
	 ekleyen				= '$ekleyen', 
	 hit					= '$hit',
	 sira					= '$sira',
	 dil					= '$dil',
	 durum					= '$durum'  
	 
	 where id='$id'
	 
	  ");
		}
	if($gonder){
		
	if($resimad!=""){ 	 
		echo $resimad.' çalıştı'; 
		
		unlink($rhedef.$gresim);	
		$kaynak		= $_FILES['resim']['tmp_name'];
		$resimsonad = rand(0,999).'-'.yeniurl(res_adi($resimad)).res_uzanti($resimad);
		$yukle 		= move_uploaded_file($kaynak,$rhedef."/".$resimsonad); 
		$guncelle 	= $mysqli->query("update banner set resim='$resimsonad' where id='$id' ");
	}

	if($dvideoad!=""){ 	 
		echo $dvideosonad.' çalıştı'; 
		
		unlink($rhedef.$gresim);	
		$kaynak		= $_FILES['dvideo']['tmp_name'];
		$videosonad = rand(0,999).'-'.yeniurl(res_adi($videoad)).res_uzanti($videoad);
		$yukle 		= move_uploaded_file($kaynak,$rhedef."/".$dvideosonad); 
		$guncelle 	= $mysqli->query("update banner set dvideo='$dvideosonad' where id='$id' ");
	}

		
	if($arkaresimad!=""){ 	 
		echo $arkaresimad.' çalıştı'; 
		
		unlink($rhedef.$garkaresim);	
		$arkaresimkaynak		= $_FILES['arkaresim']['tmp_name'];
		$arkaresimsonad 		= rand(0,999).'-'.yeniurl(res_adi($arkaresimad)).res_uzanti($arkaresimad);
		$arkaresimyukle 		= move_uploaded_file($arkaresimkaynak,$rhedef."/".$arkaresimsonad); 
		$guncelle 				= $mysqli->query("update banner set arkaresim='$arkaresimsonad' where id='$id' ");
	}
		
		if($solresimad!=""){ 	 
		echo $gsolresim.' çalıştı'; 
		
		unlink($rhedef.$gsolresim);	
		$solresimkaynak		= $_FILES['solresim']['tmp_name'];
		$solresimsonad = rand(0,999).'-'.yeniurl(res_adi($solresimad)).res_uzanti($solresimad);
		$solresimyukle 		= move_uploaded_file($solresimkaynak,$rhedef."/".$solresimsonad); 
		$guncelle 	= $mysqli->query("update banner set solresim='$solresimsonad' where id='$id' ");
	}
		
		
		
		if($sagresimad!=""){ 	 
		echo $gresim.' çalıştı'; 
		
		unlink($rhedef.$gsagresim);	
		$sagresimkaynak		= $_FILES['sagresim']['tmp_name'];
		$sagresimsonad 		= rand(0,999).'-'.yeniurl(res_adi($sagresimad)).res_uzanti($sagresimad);
		$sagresimyukle 		= move_uploaded_file($sagresimkaynak,$rhedef."/".$sagresimsonad); 
		$guncelle 			= $mysqli->query("update banner set sagresim='$sagresimsonad' where id='$id' ");
	}
		
		
		if($iconad!=""){ 	 
		echo $gicon.' çalıştı'; 
		
		unlink($rhedef.$gicon);	
		$iconkaynak		= $_FILES['icon']['tmp_name'];
		$iconsonad 		= rand(0,999).'-'.yeniurl(res_adi($iconad)).res_uzanti($iconad);
		$iconyukle 		= move_uploaded_file($iconkaynak,$rhedef."/".$iconsonad); 
		$guncelle 			= $mysqli->query("update banner set icon='$iconsonad' where id='$id' ");
	}
		  
	  header("Location:?sy=banner&islem=basarili");	
		  
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
		<label for="dil" class="col-sm-2 col-form-label"> <i class="fa fa-language"></i> Dil </label> 
		
	 
    <div class="col-2  ">
    
	  <select class="custom-select task-manager-list-select" name="dil">
	  
	  <?php $dilbak = $mysqli->query("select * from diller order by sira asc");
	 
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
		
 <?php if($sistemyaz['renk']=="on"){ ?>
	 	 <div class="form-group row">
		<label for="baslik" class="col-sm-2 col-form-label">Renk  </label>
		<div class="col-sm-1">
		<input type="text" name="renk" maxlength="7" class="form-control jscolor" value="<?php echo $yaz['renk']; ?>">
		 
		</div>
	</div>
	<?php }?>
	
	 <?php if($sistemyaz['ustbaslik']=="on"){ ?>
	<div class="form-group row">
		<label for="ustbaslik" class="col-sm-2 col-form-label">Üst Başlık   </label>
		<div class="col-sm-6">
		 <input type="text" name="ustbaslik" class="form-control" id="ustbaslik" placeholder="Üst Başlık" value="<?php echo $yaz['ustbaslik']; ?>"  >
		</div>
	</div>
		 <?php }?>
		
		 <?php if($sistemyaz['ustbaslikrenk']=="on"){ ?>
			 <div class="form-group row">
		<label for="ustbaslikrenk" class="col-sm-2 col-form-label">Üst Başlık Renk  </label>
		<div class="col-sm-1">
		<input type="text" name="ustbaslikrenk" maxlength="7" class="form-control jscolor" value="<?php echo $yaz['ustbaslikrenk']; ?>">
		 
		</div>
	</div>
		 <?php }?>
		
		
		 <?php if($sistemyaz['altbaslik']=="on"){ ?>
		<div class="form-group row">
		<label for="altbaslik" class="col-sm-2 col-form-label">Alt Başlık   </label>
		<div class="col-sm-6">
		 <input type="text" name="altbaslik" class="form-control" id="altbaslik" placeholder="Alt Başlık" value="<?php echo $yaz['altbaslik']; ?>"  >
		</div>
	</div>
		 <?php }?>
		
		 <?php if($sistemyaz['altbaslikrenk']=="on"){ ?>
			 <div class="form-group row">
		<label for="altbaslikrenk" class="col-sm-2 col-form-label">Alt Başlık Renk  </label>
		<div class="col-sm-1">
		<input type="text" name="altbaslikrenk" maxlength="7" class="form-control jscolor" value="<?php echo $yaz['altbaslikrenk']; ?>">
		 
		</div>
	</div>
		 <?php }?>
		
		 <?php if($sistemyaz['aciklama']=="on"){ ?>
		<div class="form-group row">
		<label for="aciklama" class="col-sm-2 col-form-label">Açıklama</label>
		<div class="col-sm-6">
		 <input type="text" name="aciklama" class="form-control" id="aciklama" placeholder="Açıklama" value="<?php echo $yaz['aciklama']; ?>"  >
		</div>
	</div>
		 <?php }?>
		
		
		 <?php if($sistemyaz['aciklamarenk']=="on"){ ?>
			 <div class="form-group row">
		<label for="aciklamarenk" class="col-sm-2 col-form-label">Açıklama Renk  </label>
		<div class="col-sm-1">
		<input type="text" name="aciklamarenk" maxlength="7" class="form-control jscolor" value="<?php echo $yaz['aciklamarenk']; ?>">
		 
		</div>
	</div>
		 <?php }?>
		
	 	 <?php if($sistemyaz['video']=="on"){ ?>								
	<div class="form-group row">
		<label for="video" class="col-sm-2 col-form-label">Video</label>
		<div class="col-sm-6">
		 <input type="text" name="video" class="form-control" id="video" placeholder="Video" value="<?php echo $yaz['video']; ?>"  >
		</div>
	</div>
	 <?php }?>
	
	 <?php if($sistemyaz['link']=="on"){ ?>
<div class="form-group row">
		<label for="link" class="col-sm-2 col-form-label"> Link </label>
		<div class="col-sm-6">
		 <input type="text" name="link" class="form-control" id="link" placeholder="Link" value="<?php echo $yaz['link']; ?>"  >
		</div>	
		
		<div class="col-sm-4">
			<small id="resim" class="ul-form__text form-text "> Boş Bırakırsanız Bu Alan sitede çalışmayacaktır  </small>
		</div>
	 
	</div>
	<?php }?>
		
		
	  <?php if($sistemyaz['linkaciklama']=="on"){ ?>
 <div class="form-group row">
		<label for="linkaciklama" class="col-sm-2 col-form-label">Link Açıklama </label>
		<div class="col-sm-6">
		 <input type="text" name="linkaciklama" class="form-control" id="linkaciklama" placeholder="Link Açıklama" value="<?php echo $yaz['linkaciklama']; ?>"  >
		</div>
	</div> 
		<?php }?>
		
		 <?php if($sistemyaz['link2']=="on"){ ?>
		<div class="form-group row">
		<label for="link2" class="col-sm-2 col-form-label"> Link 2</label>
		<div class="col-sm-6">
		 <input type="text" name="link2" class="form-control" id="link2" placeholder="Link 2" value="<?php echo $yaz['link2']; ?>">
		</div>	
		 
	</div>
	<?php }?>
		
		
	 <?php if($sistemyaz['link2aciklama']=="on"){ ?> 
 <div class="form-group row">
		<label for="link2aciklama" class="col-sm-2 col-form-label">Link 2 Açıklama </label>
		<div class="col-sm-6">
		 <input type="text" name="link2aciklama" class="form-control" id="link2aciklama" placeholder="Link 2 Açıklama" value="<?php echo $yaz['link2aciklama']; ?>"  >
		</div>
	</div> 
	<?php }?>
		
		 
 <div class="form-group row">
		<label for="resim" class="col-sm-2 col-form-label">Resim * </label>
		<div class="col-sm-3">
		  <input type="file" name="resim" class="form-control" id="resim" placeholder="Küçük Resim Boyutu"   > 
			 	<small id="resim" class="ul-form__text form-text "> Yeni resim istemiyorsanız işlem yapmayınız </small>	
		<input type="hidden" name="gresim"  value="<?php echo $yaz['resim']; ?>"   > 
		</div>
	 
	 <a href="../uploads/<?php echo $yaz['resim']; ?>" target="_blank" >
	 <img src="../uploads/<?php echo $yaz['resim']; ?>" title="Büyük Resim" alt="Büyük Resim" style="background-color:#ddd; width:100px; "></a>
	 <div class="col-sm-2">
		 İdeal boyut 1920 * 800 px
			 				
		</div>
	 
	</div>

	<div class="form-group row">
		<label for="dvideo" class="col-sm-2 col-form-label">Video * </label>
		<div class="col-sm-3">
		  <input type="file" name="dvideo" class="form-control" id="dvideo"> 
			 	<small id="dvideo" class="ul-form__text form-text "> Yeni video istemiyorsanız işlem yapmayınız </small>	
		<input type="hidden" name="dvideo"  value="<?php echo $yaz['dvideo']; ?>"   > 
		</div>
	 
	 <a href="../videos/<?php echo $yaz['dvideo']; ?>" target="_blank" >Video</a>
	 
	</div>
	 
		
		 <?php if($sistemyaz['arkaresim']=="on"){ ?>
		<div class="form-group row">
		<label for="arkaresim" class="col-sm-2 col-form-label">Arka Resim * </label>
		<div class="col-sm-3">
		  <input type="file" name="arkaresim" class="form-control" id="arkaresim" placeholder="Küçük Resim Boyutu"   > 
			 	<small id="arkaresim" class="ul-form__text form-text "> Yeni resim istemiyorsanız işlem yapmayınız </small>	
		<input type="hidden" name="garkaresim"  value="<?php echo $yaz['arkaresim']; ?>"   > 
		</div>
	 
	 <a href="../uploads/<?php echo $yaz['arkaresim']; ?>" target="_blank" >
	 <img src="../uploads/<?php echo $yaz['arkaresim']; ?>" title="Büyük Resim" alt="Büyük Resim" style="background-color:#ddd; width:100px; "></a>
	 <div class="col-sm-2">
		 İdeal boyut 1920 * 800 px
			 				
		</div>
	 
	</div>  
		<?php }?>
		
		 <?php if($sistemyaz['solresim']=="on"){ ?>
		<div class="form-group row">
		<label for="solresim" class="col-sm-2 col-form-label">Sol Resim </label>
		<div class="col-sm-3">
		  <input type="file" name="solresim" class="form-control" id="solresim" placeholder="Küçük Resim Boyutu"   > 
			 	<small id="solresim" class="ul-form__text form-text "> Yeni resim istemiyorsanız işlem yapmayınız </small>	
		<input type="hidden" name="gsolresim"  value="<?php echo $yaz['solresim']; ?>"   > 
		</div>
	 
	 <a href="../uploads/<?php echo $yaz['solresim']; ?>" target="_blank" >
	 <img src="../uploads/<?php echo $yaz['solresim']; ?>" title="Büyük Resim" alt="Büyük Resim" style="background-color:#ddd; width:100px; "></a>
	 <div class="col-sm-2">
		 İdeal boyut 1920 * 800 px
			 				
		</div>
	 
	</div> 
		<?php }?>
		
		 <?php if($sistemyaz['sagresim']=="on"){ ?>
		<div class="form-group row">
		<label for="sagresim" class="col-sm-2 col-form-label">Sağ Resim * </label>
		<div class="col-sm-3">
		  <input type="file" name="sagresim" class="form-control" id="sagresim" placeholder="Küçük Resim Boyutu"   > 
			 	<small id="sagresim" class="ul-form__text form-text "> Yeni resim istemiyorsanız işlem yapmayınız </small>	
		<input type="hidden" name="gsagresim"  value="<?php echo $yaz['sagresim']; ?>"   > 
		</div>
	 
	 <a href="../uploads/<?php echo $yaz['sagresim']; ?>" target="_blank" >
	 <img src="../uploads/<?php echo $yaz['sagresim']; ?>" title="Büyük Resim" alt="Büyük Resim" style="background-color:#ddd; width:100px; "></a>
	 <div class="col-sm-2">
		 İdeal boyut 1920 * 800 px
			 				
		</div>
	 
	</div>
		<?php }?>
		
		 <?php if($sistemyaz['icon']=="on"){ ?>
	<div class="form-group row">
		<label for="icon" class="col-sm-2 col-form-label">İcon </label>
		<div class="col-sm-3">
		  <input type="file" name="icon" class="form-control" id="icon" placeholder="Küçük Resim Boyutu"   > 
			 	<small id="icon" class="ul-form__text form-text "> Yeni resim istemiyorsanız işlem yapmayınız </small>	
		<input type="hidden" name="gicon"  value="<?php echo $yaz['icon']; ?>"   > 
		</div>
	 
	 <a href="../uploads/<?php echo $yaz['icon']; ?>" target="_blank" >
	 <img src="../uploads/<?php echo $yaz['icon']; ?>" title="Büyük Resim" alt="Büyük Resim" style="background-color:#ddd; width:100px; "></a>
	 <div class="col-sm-2">
		 İdeal boyut 100 * 100 px
			 				
		</div>
	 
	</div>
	<?php }?>
  		
		
	<div class="form-group row">
	<label for="sira" class="col-sm-2 col-form-label">Sıra </label>
	<div class="col-sm-2">
	  <input type="text" name="sira" class="form-control" id="sira" placeholder="Sıra" value="<?php echo $yaz['sira']; ?>" > 
		 			
		</div>
		 
	</div>
		 
		 	<div class="form-group row">
	<label for="durum" class="col-sm-2 col-form-label">Durum </label>
	<div class="col-sm-2">
	 
	<label class="switch switch-primary mr-3" id="durum">
		 
		  <input name="durum" type="checkbox" <?php if($yaz['durum']=="on"){ echo 'checked'; }?>  > 
		  
		<span class="slider"></span>
	</label>
							
							
	 	
		</div>
		
		</div>
		
		
	<div class="form-group row">
	<label for="sira" class="col-sm-2 col-form-label">  </label>
		<div class="col-sm-10">
			<button type="submit" class="btn btn-primary ul-btn__text">Banner Güncelle</button>
		 
		</div>
	</div>
	
</form>

<?php } ?>
				 </div>
			</div>
		</div>
	</div>  
  </div> 
				