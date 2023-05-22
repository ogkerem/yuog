	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
	$konu 	= "bannerduzen";
	$id		= 1;
	
	$yaz 	= $mysqli->query("select * from bannerduzen where id='$id' ")->fetch_array();
	
	$dil 	= $yaz['dil']; 
	$dilyaz = $mysqli->query("select * from diller where id='$dil' ")->fetch_array();
 
	?>
	 
	 <div class="main-content">
	
   <div class="breadcrumb">
                <h1><a href="?sy=sistem"> Sistem </a> > (  Banner Düzen)    </h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li>İçerik Güncelleme</li>
                    <li> <span class="badge badge-pill badge-warning p-2 m-1">UYARI!!! Bu alanda etkin değilseniz işlem yapmayınız</span>  </li> 
                     
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
	
	 
	 
	 $renk			= $_POST['renk'];
	 $ustbaslik		= $_POST['ustbaslik'];
	 $ustbaslikrenk	= $_POST['ustbaslikrenk'];
	 $altbaslik		= $_POST['altbaslik'];
 	 $altbaslikrenk	= $_POST['altbaslikrenk'];
 	 $aciklama		= $_POST['aciklama'];
 	 $aciklamarenk	= $_POST['aciklamarenk'];
 	 $video			= $_POST['video'];
 	 $link2	        = $_POST['link2'];
 	 $link2aciklama	= $_POST['link2aciklama'];
 	 $link			= $_POST['link'];
 	 $linkaciklama	= $_POST['linkaciklama'];
 	 $resim			= $_POST['resim'];
 	 $arkaresim		= $_POST['arkaresim'];
 	 $solresim		= $_POST['solresim'];
 	 $sagresim		= $_POST['sagresim'];
 	 $icon			= $_POST['icon'];
 	 $vkod			= $_POST['vkod'];
	 
	 
	 $sor=$mysqli->query("select * from $konu where id='$id'")->num_rows;
	if($sor>0){
	
	$gonder  	= $mysqli->query(" update $konu set  
		
		 
		renk				='$renk', 
		ustbaslik			='$ustbaslik',
		ustbaslikrenk		='$ustbaslikrenk',
		altbaslik			='$altbaslik', 
		altbaslikrenk		='$altbaslikrenk', 
		aciklama			='$aciklama', 
		aciklamarenk		='$aciklamarenk',
		video				='$video',
		link2				='$link2',
		link2aciklama		='$link2aciklama',
		link				='$link',
		linkaciklama		='$linkaciklama',
		resim				='$resim',
		arkaresim			='$arkaresim',
		solresim			='$solresim',
		sagresim			='$sagresim',
		icon				='$icon',
		vkod				='$vkod'
		
		 
	  
		where id='$id'
	 
	  ");   
	}
	else {
		
			$gonder  	= $mysqli->query(" insert into  $konu set  
		
		 
		renk				='$renk', 
		ustbaslik			='$ustbaslik',
		ustbaslikrenk		='$ustbaslikrenk',
		altbaslik			='$altbaslik', 
		altbaslikrenk		='$altbaslikrenk', 
		aciklama			='$aciklama', 
		aciklamarenk		='$aciklamarenk',
		video				='$video',
		link2				='$link2',
		link2aciklama		='$link2aciklama',
		link				='$link',
		linkaciklama		='$linkaciklama',
		resim				='$resim',
		arkaresim			='$arkaresim',
		solresim			='$solresim',
		sagresim			='$sagresim',
		icon				='$icon',
		vkod				='$vkod'
		
		 
	  
		
	 
	  ");   
		
	}
	if($gonder){
	 
	  
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
	<label for="renk" class="col-sm-3 col-form-label">Renk </label>
	<div class="col-sm-3">
	  
	<label class="switch switch-primary mr-3" id="renk">
		 
		  <input name="renk" type="checkbox"  <?php if($yaz['renk']=="on"){ echo 'checked'; } ?>  > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div>
 
<div class="form-group row">
	<label for="ustbaslik" class="col-sm-3 col-form-label">Üst Başlık </label>
	<div class="col-sm-3">
	  
	<label class="switch switch-primary mr-3" id="ustbaslik">
		 
		  <input name="ustbaslik" type="checkbox"  <?php if($yaz['ustbaslik']=="on"){ echo 'checked'; } ?>  > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div>

<div class="form-group row">
	<label for="ustbaslikrenk" class="col-sm-3 col-form-label">Üst Başlık Renk </label>
	<div class="col-sm-3">
	  
	<label class="switch switch-primary mr-3" id="ustbaslikrenk">
		 
		  <input name="ustbaslikrenk" type="checkbox"  <?php if($yaz['ustbaslikrenk']=="on"){ echo 'checked'; } ?>  > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div>
		 
<div class="form-group row">
	<label for="altbaslik" class="col-sm-3 col-form-label">Alt Başlık</label>
	<div class="col-sm-3">
	  
	<label class="switch switch-primary mr-3" id="altbaslik">
		 
		  <input name="altbaslik" type="checkbox"  <?php if($yaz['altbaslik']=="on"){ echo 'checked'; } ?> > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div>
		 
<div class="form-group row">
	<label for="altbaslikrenk" class="col-sm-3 col-form-label">Alt Başlık Renk</label>
	<div class="col-sm-3">
	  
	<label class="switch switch-primary mr-3" id="altbaslikrenk">
		 
		  <input name="altbaslikrenk" type="checkbox" <?php if($yaz['altbaslikrenk']=="on"){ echo 'checked'; } ?>  > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div>

<div class="form-group row">
	<label for="aciklama" class="col-sm-3 col-form-label">Kısa Açıklama </label>
	<div class="col-sm-3">
	  
	<label class="switch switch-primary mr-3" id="aciklama">
		 
		  <input name="aciklama" type="checkbox" <?php if($yaz['aciklama']=="on"){ echo 'checked'; } ?>  > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div>

 

<div class="form-group row">
	<label for="aciklamarenk" class="col-sm-3 col-form-label">Açıklama Renk </label>
	<div class="col-sm-3">
	  
	<label class="switch switch-primary mr-3" id="aciklamarenk">
		 
		  <input name="aciklamarenk" type="checkbox"  <?php if($yaz['aciklamarenk']=="on"){ echo 'checked'; } ?> > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div>
		
<div class="form-group row">
	<label for="video" class="col-sm-3 col-form-label">  Video Link </label>
	<div class="col-sm-3">
	  
	<label class="switch switch-primary mr-3" id="video">
		 
		  <input name="video" type="checkbox" <?php if($yaz['video']=="on"){ echo 'checked'; } ?>  > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div>	
		
		<div class="form-group row">
	<label for="vkod" class="col-sm-3 col-form-label">  Video Kodu </label>
	<div class="col-sm-3"> 
	<label class="switch switch-primary mr-3" id="vkod"> 
		  <input name="vkod" type="checkbox"  <?php if($yaz['vkod']=="on"){ echo 'checked'; } ?> >  
		<span class="slider"></span>
	</label> 
</div> 
</div>	

				
<div class="form-group row">
	<label for="link" class="col-sm-3 col-form-label">  Link1  </label>
	<div class="col-sm-3">
	  
	<label class="switch switch-primary mr-3" id="link">
		 
		  <input name="link" type="checkbox" <?php if($yaz['link']=="on"){ echo 'checked'; } ?>  > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div>		

<div class="form-group row">
	<label for="linkaciklama" class="col-sm-3 col-form-label">  Link1 Açıklama  </label>
	<div class="col-sm-3"> 
	<label class="switch switch-primary mr-3" id="linkaciklama">  
		  <input name="linkaciklama" type="checkbox" <?php if($yaz['linkaciklama']=="on"){ echo 'checked'; } ?>  >  
		<span class="slider"></span>
	</label> 
</div> 
</div>
		
			 <div class="form-group row">
		<label for="link2" class="col-sm-3 col-form-label">  Link2 </label>
		<div class="col-sm-3">

		<label class="switch switch-primary mr-3" id="link2">

			  <input name="link2" type="checkbox"  <?php if($yaz['link2']=="on"){ echo 'checked'; } ?> > 

			<span class="slider"></span>
		</label>

	</div> 
	</div>

		<div class="form-group row">
			<label for="link2aciklama" class="col-sm-3 col-form-label">  Link2 Açıklama </label>
			<div class="col-sm-3">

			<label class="switch switch-primary mr-3" id="link2aciklama">

				  <input name="link2aciklama" type="checkbox" <?php if($yaz['link2aciklama']=="on"){ echo 'checked'; } ?>  > 

				<span class="slider"></span>
			</label>

		</div> 
		</div>  
				
<!--
<div class="form-group row">
	<label for="resim" class="col-sm-3 col-form-label">  Resim  </label>
	<div class="col-sm-3">
	  
	<label class="switch switch-primary mr-3" id="resim">
		 
		  <input name="resim" type="checkbox" <?php if($yaz['resim']=="on"){ echo 'checked'; } ?>   > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div>
-->
				
<div class="form-group row">
	<label for="arkaresim" class="col-sm-3 col-form-label">  Arka Resim  </label>
	<div class="col-sm-3">
	  
	<label class="switch switch-primary mr-3" id="arkaresim">
		 
		  <input name="arkaresim" type="checkbox"  <?php if($yaz['arkaresim']=="on"){ echo 'checked'; } ?> > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div>
				
<div class="form-group row">
	<label for="solresim" class="col-sm-3 col-form-label"> Sol Resim  </label>
	<div class="col-sm-3">
	  
	<label class="switch switch-primary mr-3" id="solresim">
		 
		  <input name="solresim" type="checkbox"  <?php if($yaz['solresim']=="on"){ echo 'checked'; } ?> > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div>	
				

<div class="form-group row">
	<label for="sagresim" class="col-sm-3 col-form-label">  Sağ Resim </label>
	<div class="col-sm-3"> 
	<label class="switch switch-primary mr-3" id="sagresim"> 
		  <input name="sagresim" type="checkbox"  <?php if($yaz['sagresim']=="on"){ echo 'checked'; } ?> >  
		<span class="slider"></span>
	</label> 
</div> 
</div>	
		
		<div class="form-group row">
	<label for="icon" class="col-sm-3 col-form-label">  İcon </label>
	<div class="col-sm-3"> 
	<label class="switch switch-primary mr-3" id="icon"> 
		  <input name="icon" type="checkbox"  <?php if($yaz['icon']=="on"){ echo 'checked'; } ?> >  
		<span class="slider"></span>
	</label> 
</div> 
</div>	
		



		

	

 
 
	<div class="form-group row">
	<label for="sira" class="col-sm-3 col-form-label">  </label>
		<div class="col-sm-3">
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
				