	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	$dilbak = $_GET['dil'];
	if($dilbak==""){ 
	$dilbak = $mysqli->query("select * from diller order by sira asc limit 1 "); 
	$dilyaz = $dilbak->fetch_array();
		$dil = $dilyaz['id'];
	} else {
		$dil = $dilbak;	
		$dilbak = $mysqli->query("select * from diller where id='$dil' "); 
		$dilyaz = $dilbak->fetch_array();
	} 
	$profile = $linkedin->getPerson($_SESSION['linkedInAccessToken']);
	?>
	<div class="main-content">
	
   <div class="breadcrumb">
                <h1>Kurumsal Ekleme >  <?php echo $dilyaz['baslik']; ?>  </h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li><a href="?sy=kurumsal">Kurumsal</a></li>
                  
                     
                </ul>
            </div>
		 
            <div class="separator-breadcrumb border-top"></div>
  
	
	 <?php $islem = $_GET['islem']; 
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
	
	$baslik				= addslashes(trim($_POST['baslik']));
	$onyazi				= addslashes(trim($_POST['onyazi']));
	$icerik				= addslashes(trim($_POST['icerik']));
	$keywords			= addslashes(trim($_POST['keywords']));
	$description		= addslashes(trim($_POST['description']));
	$etiket				= addslashes(trim($_POST['etiket']));
	
	$ustresim			= addslashes(trim($_POST['ustresim']));
	
	$vbaslik			= addslashes(trim($_POST['vbaslik']));
	$vaciklama			= addslashes(trim($_POST['vaciklama']));
	$vlink				= addslashes(trim($_POST['vlink']));
	
	$ibaslik			= addslashes(trim($_POST['ibaslik']));
	$iicerik			= addslashes(trim($_POST['iicerik']));
	
	$linkedin			= (trim($_POST['linkedin']));
 
	$sira				= trim($_POST['sira']); 
	$hit				= 1;
	$durum				= 1;
	$ekleyen			= $email;  
	$ip					= $_SERVER['REMOTE_ADDR']; 
	
	
	$resimad			= $_FILES['resim']['name']; 
	$kaynak				= $_FILES['resim']['tmp_name']; 
	
	$ustresimad			= $_FILES['ustresim']['name']; 
	$ustkaynak			= $_FILES['ustresim']['tmp_name']; 
	
	$vresimad			= $_FILES['vresim']['name']; 
	$vkaynak			= $_FILES['vresim']['tmp_name']; 

	$resimsonad 		= rand(0,999).'-'.yeniurl(res_adi($resimad)).res_uzanti($resimad);
	$ustsonad 			= rand(0,999).'-'.yeniurl(res_adi($ustresimad)).res_uzanti($ustresimad);
	$vsonad 			= rand(0,999).'-'.yeniurl(res_adi($vresimad)).res_uzanti($vresimad);
	$kresimsonad 		= 'mini-'.$resimsonad;	
	  
	$rhedef				= "../uploads/kurumsal/";
	 
	$yeniurlmiz =  $_POST['seourl'];
	
	$seosor		= $mysqli->query("select * from seo where seo='$yeniurlmiz' ");
	$seoyazz	= $seosor->fetch_array(); 
	$seosay 	= $seosor->num_rows;
		  
	if($seosay>0){
		$sonurl = rand(0,100).'-'.$yeniurlmiz;
	} else { 
		$sonurl = $yeniurlmiz;
	}
	
	$seoekle 		= $mysqli->query("insert into seo (seo,konu, durum) values ('$sonurl', 'kurumsal', '$durum')");	
	$seoID			= $mysqli->insert_id;
	
  
	$gonder  	= $mysqli->query(" insert into kurumsal set 
	
		baslik 				='$baslik', 
		onyazi 				='$onyazi', 
		icerik 				='$icerik', 
		keywords 			='$keywords', 
		description			='$description', 
		kresim				='$kresimsonad', 
		resim				='$resimsonad', 		
		ustresim			= '$ustsonad',	
		vbaslik				= '$vbaslik',
		vaciklama			= '$vaciklama',
		vlink				= '$vlink',
		vresim				= '$vsonad',
		ibaslik				= '$ibaslik',
		iicerik				= '$iicerik',	
		ip					='$ip', 
		tarih				= now(),
		ekleyen				= '$ekleyen',
		seo					= '$seoID',
		hit					= '$hit',
		sira				= '$sira',
		dil					= '$dil', 
		durum				= '$durum' 
	 
	  ");   
	  
	if($gonder){
		
		$icerikID	= $mysqli->insert_id;
		
		$yukle 			= move_uploaded_file($kaynak,$rhedef."/".$resimsonad);
		$yukle2 		= move_uploaded_file($ustkaynak,$rhedef."/".$ustsonad);
		$yukle3 		= move_uploaded_file($vkaynak,$rhedef."/".$vsonad);
		kucult($rhedef, $resimsonad);	
		  
		
		$ebakp = explode(",", $etiket);  
		$esay =  count($ebakp);
				
		  	for($yy=0; $yy < $esay; $yy++){
			$etiket1  = $ebakp[$yy];
		$etiketekle = $mysqli->query ("insert into etiket (`baslik`, `seo`, `konu`, `konuID` ) values ('$etiket1' , '$seoID' , 'kurumsal' , '$icerikID' ) ");
				
				}	
		// bu alan yerine linkedine göndereceğim datayı  linkedinpaylas.php ya gönderem orada önce oturumu sorsun anda da işlem tamamsa linkedine göndersin ve geri sonunda bu sayfanın varmaya çalıştığı url ye gitsin  header("Location:?sy=kurumsal&islem=basarili"); exit;	en sonunda buraa gibi ,  başarı sayfasında önce paylaş sayfası paylaşta tamam olunca başarıya gelecek nasıl olsa datamız elimizde 
		
		
		
		
		if(isset($linkedin)){ // Linkedin paylaş seçilmiş ise; w
			
			$content = 	$baslik.' '.$onyazi; // Mesajı Oluştur	
					
			$post = $linkedin->linkedInTextPost($_SESSION['linkedInAccessToken'] , $profile->id,  $content, 'PUBLIC'); // Herkese açık olarak paylaş.
					
			$post = json_decode($post); 
			if (isset($post->id)) { // Buraya istedigini yapabilirsin post gonderildi/gonderilmedi.
				echo "POSTED";
			} else {
				echo "FAILED.";
			}
			// Bitti
		}
		
	
				
		header("Location:?sy=kurumsal&islem=basarili"); exit;	
		  
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
		<label for="baslik" class="col-sm-2 col-form-label">İçerik Dili * </label>
		<div class="col-sm-6">
		
		<?php $dilbak1 = $mysqli->query("select * from diller  "); 
		while($dilyaz1 = $dilbak1->fetch_array()){
			if($dilyaz1['id']==$dil){
			
	echo '<a href="?sy=kurumsalekle&dil='.$dilyaz1['id'].'"><button type="button" class="btn btn-raised btn-raised-primary m-1">'.$dilyaz1['baslik'].'</button></a> ';
	
			} else {
			
	echo '<a href="?sy=kurumsalekle&dil='.$dilyaz1['id'].'"><button type="button" class="btn btn-outline-primary m-1">'.$dilyaz1['baslik'].'</button></a> ';
	
			}
		
		}				
						?>
			 
		</div>
	</div>	


 <div class="form-group row">
		<label for="resim" class="col-sm-2 col-form-label">Üst Resim * ( 1920 * 450) </label>
		<div class="col-sm-2">
		 <input type="file" name="ustresim" class="form-control" id="resim" placeholder="" required  > 
			 				
		</div>	
		
		<div class="col-sm-2">
		  
			 				
		</div>
	 
	</div>
	
	
	<div class="form-group row">
		<label for="baslik" class="col-sm-2 col-form-label">Başlık * </label>
		<div class="col-sm-6">
		 <input type="text" name="baslik" class="form-control" id="baslik" placeholder="Başlık" value="" required >
		</div>
	</div>
	 									
	 		 
  <div class="form-group row">
		<label for="onyazi" class="col-sm-2 col-form-label"> Ön Yazı </label>
		<div class="col-sm-10">
		<textarea name="onyazi" class="form-control" id="onyazi" cols="50" rows="2" placeholder="Ön Yazı" ></textarea>
			 
		</div>
	</div>   
 

	<div class="form-group row">
		<label for="icerik" class="col-sm-2 col-form-label"> İçerik  </label>
		<div class="col-sm-10">
		<textarea name="icerik" class="ckeditor" id="icerik" cols="40" rows="3"></textarea>
	  
		</div> 
	</div>
	
	 

		
		
		
 <div class="form-group row">
		<label for="resim" class="col-sm-2 col-form-label">Resim * ( 750 * 864) </label>
		<div class="col-sm-2">
		  <input type="file" name="resim" class="form-control" id="resim" placeholder="Küçük Resim Boyutu" required  > 
			 				
		</div>	
		
		<div class="col-sm-2">
		  
			 				
		</div>
	 
	</div>
	
	<hr/>
	
		
	<div class="form-group row">
		<label for="vbaslik" class="col-sm-2 col-form-label">Video Başlık * </label>
		<div class="col-sm-6">
		 <input type="text" name="vbaslik" class="form-control" id="vbaslik" placeholder="Video Başlık" value="" required >
		</div>
	</div>
	
		
	<div class="form-group row">
		<label for="vaciklama" class="col-sm-2 col-form-label">Video Kısa Açıklama * </label>
		<div class="col-sm-6">
		 <input type="text" name="vaciklama" class="form-control" id="vaciklama" placeholder="Video Açıklama" value="" required >
		</div>
	</div>
	
		
	<div class="form-group row">
		<label for="vlink" class="col-sm-2 col-form-label">Video Link * </label>
		<div class="col-sm-6">
		 <input type="text" name="vlink" class="form-control" id="vlink" placeholder="Video Link" value="" required >
		</div>
	</div>
	
	
	  <div class="form-group row">
		<label for="vresim" class="col-sm-2 col-form-label">Video Resim * ( 1678 * 700) </label>
		<div class="col-sm-2">
		  <input type="file" name="vresim" class="form-control" id="vresim" placeholder="" required  > 
			 				
		</div>	
		
		<div class="col-sm-2">
		  
			 				
		</div>
	 
	</div>
	
	<hr/>
	
	
	 <div class="form-group row">
		<label for="ibaslik" class="col-sm-2 col-form-label">İkinci Başlık * </label>
		<div class="col-sm-6">
		 <input type="text" name="ibaslik" class="form-control" id="ibaslik" placeholder="İkinci Başlık" value="" required >
		</div>
	</div>
	
	
	
	<div class="form-group row">
		<label for="iicerik" class="col-sm-2 col-form-label"> İkinci İçerik  </label>
		<div class="col-sm-10">
		<textarea name="iicerik" class="ckeditor" id="iicerik" cols="40" rows="3"></textarea>
	  
		</div> 
	</div>
	 
	 <hr/>
	 
		<div class="form-group row">
		<label for="seourl" class="col-sm-2 col-form-label">Seo URL * </label>
		<div class="col-sm-6">
		  <input type="text" name="seourl" class="form-control" id="seourl" placeholder="Seo URL" value=""  > 
			
 							
		</div>
		 
	</div>
		
		
	<div class="form-group row">
		<label for="keywords" class="col-sm-2 col-form-label">Keywords </label>
		<div class="col-sm-6">
		  <input type="text" name="keywords" class="form-control" id="keywords" placeholder="Keywords" value="" > 
			
 							
		</div>
		 
	</div>
				
	<div class="form-group row">
	<label for="description" class="col-sm-2 col-form-label">Description </label>
	<div class="col-sm-6">
	  <input type="text" name="description" class="form-control" id="description" placeholder="Description" value="" > 
		
						
		</div>
		 
	</div>
				
	<div class="form-group row">
	<label for="etiket" class="col-sm-2 col-form-label">Etiketler </label>
	<div class="col-sm-6">
	  <input type="text" name="etiket" class="form-control" id="etiket" placeholder="Etiketler" value="" > 
		 				
		</div>
		
		<div class="col-sm-2">
	  
		
		<small id="passwordHelpBlock" class="ul-form__text form-text "> Virgül ile ayırınız </small>				
		</div>
		 
	</div>
	
					
	<div class="form-group row">
	<label for="sira" class="col-sm-2 col-form-label">Sıra </label>
	<div class="col-sm-1">
	  <input type="text" name="sira" class="form-control" id="sira" placeholder="Sıra" value="" > 
		
						
		</div>
		 
	</div>
	
	<div class="form-group row">
	<label for="durum" class="col-sm-2 col-form-label">Linkedin'de Paylaş </label>
	<div class="col-sm-2">
	<?php 
		if(!empty($profile->id)){ ?>
			<label class="switch switch-primary mr-3" id="durum">
				<input name="linkedin" type="checkbox" value="1">
				<span class="slider"></span>
			</label>
		<?php }else{ ?> 
			<input name="linkedin" type="hidden" value="0">
			<a class="btn btn-outline-primary btn-outline-email btn-block btn-icon-text btn-rounded" href="<?php echo $linkedin->getAuthUrl();?>">
                <i class="i-Mail-with-At-Sign"></i> Önce Linkedin'e Giriş Yap
            </a>
		<?php }
	  ?>
			 
		</div>
		
		</div>
		
		 
	<div class="form-group row">
	<label for="sira" class="col-sm-2 col-form-label">  </label>
		<div class="col-sm-10">
			<button type="submit" class="btn btn-primary ul-btn__text">Kurumsal Ekle</button>
		 
		</div>
	</div>
	
</form>

<?php } ?>
		</div>
	</div>
</div>
</div>
            
  </div> 
				