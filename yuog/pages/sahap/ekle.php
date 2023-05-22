	<?php 
	 
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	$sistem 	= $_GET['sistem']; 
	$konu 		= "sahap";
	$kategori 	= "kategori";
	$kat 		= $konu.'kat';
	$sistemyaz 	= $mysqli->query("select * from sistem where id='$sistem' ")->fetch_array();
	$menu		= $sistemyaz['menu'];
  
	
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
	
 
	?>
	<div class="main-content">
	
   <div class="breadcrumb">
   
    <h1> <a href="?sy=sahap&sistem=<?php echo $sistem; ?>"> <?php echo $menu; ?> </a>  > <?php echo $dilyaz['baslik']; ?> </h1>
	
             
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
  
	$baslik				= addslashes(trim($_POST['baslik']));	
	$kodu				= addslashes(trim($_POST['kodu']));
	$fiyat				= addslashes(trim($_POST['fiyat']));
	$kat1				= (int)$_POST['kat1'];
	$kat2				= (int)$_POST['kat2'];
	$kat3				= (int)$_POST['kat3'];	
	$renk				= addslashes(trim($_POST['renk']));
	$onyazi				= addslashes(trim($_POST['onyazi']));
	$icerik				= addslashes(trim($_POST['icerik']));
	$teknik				= addslashes(trim($_POST['teknik']));
	 
	$ustresimad			= $_FILES['ustresim']['name']; 
	$ustkaynak			= $_FILES['ustresim']['tmp_name']; 
	 
	$iconad				= $_FILES['icon']['name'];
	$iconkaynak			= $_FILES['icon']['tmp_name'];
	
	$marka				= (int)$_POST['marka'];
	 
	$resimad			= $_FILES['resim']['name']; 
	$kaynak				= $_FILES['resim']['tmp_name']; 	
	
	$rtopluad			= $_FILES['rtoplu']['name'];
	$rtoplukaynak		= $_FILES['rtoplu']['tmp_name'];
	$say 				= count($rtopluad);
	
	$keywords			= addslashes(trim($_POST['keywords']));
	$description		= addslashes(trim($_POST['description']));
	$etiket				= addslashes(trim($_POST['etiket']));
	 
	$yazar				= addslashes(trim($_POST['yazar']));
	$tarih				= $_POST['tarih'];
	  
	$vresimad			= $_FILES['vresim']['name']; 
	$vkaynak			= $_FILES['vresim']['tmp_name'];  
	$video				= addslashes(trim($_POST['video']));
	
	$videokod			= addslashes(trim($_POST['videokod']));
	
	$pdfad				= $_FILES['pdf']['name']; 
	$pdfkaynak			= $_FILES['pdf']['tmp_name']; 
	
	$dosyaad			= $_FILES['dosya']['name'];
	$dosyakaynak		= $_FILES['dosya']['tmp_name'];
	$dosyasay 			= count($dosyaad);
	
	$anasayfa			= $_POST['anasayfa']; 
	$sira				= (int)($_POST['sira']); 
	
	$son1				= addslashes(trim($_POST['son1']));
	$son2				= addslashes(trim($_POST['son2']));
	$son3				= addslashes(trim($_POST['son3']));
	 
	$ekleyen			= $email;  
	$ip					= $_SERVER['REMOTE_ADDR']; 
	
	
	if($resimad){ $resimsonad 		= rand(0,999).'-'.yeniurl(res_adi($resimad)).res_uzanti($resimad);
	$kresimsonad 		= 'mini-'.$resimsonad; }
	if($ustresimad){$ustresimsonad 	= rand(0,999).'-'.yeniurl(res_adi($ustresimad)).res_uzanti($ustresimad);}
	if($vresimad){$vsonad 			= rand(0,999).'-'.yeniurl(res_adi($vresimad)).res_uzanti($vresimad);}
	if($iconad){$iconsonad 			= rand(0,999).'-'.yeniurl(res_adi($iconad)).res_uzanti($iconad);}
	if($pdfad){$pdfsonad 			= rand(0,999).'-'.yeniurl(res_adi($pdfad)).res_uzanti($pdfad);}
		 
	$rhedef				= "../uploads/";
	 
	$yeniurlmiz =  $_POST['seourl'];
	
	$seosor		= $mysqli->query("select * from seo where seo='$yeniurlmiz' ");
	$seoyazz	= $seosor->fetch_array(); 
	$seosay 	= $seosor->num_rows;
		  
	if($seosay>0){
		$sonurl = rand(0,100).'-'.$yeniurlmiz;
	} else { 
		$sonurl = $yeniurlmiz;
	}
	
	$durum			= "on";
	$seoekle 		= $mysqli->query("insert into seo (seo,konu, durum) values ('$sonurl', '$konu', '$durum')");	
	$seoID			= $mysqli->insert_id;
	
  
	$gonder  	= $mysqli->query(" insert into $konu set 
	  
		menu 				='$sistem', 
		baslik 				='$baslik', 
		onyazi 				='$onyazi', 
		ustresim 			='$ustresimsonad', 
		kodu 				='$kodu', 
		fiyat 				='$fiyat', 
		renk 				='$renk', 
		marka 				='$marka', 
		kat1 				='$kat1', 
		kat2 				='$kat2', 
		kat3 				='$kat3', 
		icon 				='$iconsonad', 
		resim 				='$resimsonad', 
		kresim 				='$kresimsonad', 
		icerik1 			='$icerik', 
		teknik1 			='$teknik', 
		video 				='$video', 
		videoresim			='$vsonad', 
		videokod			='$videokod',   
		keywords 			='$keywords', 
		description			='$description', 
		tarih				='$tarih', 
		yazar				='$yazar', 
		pdf					='$pdfsonad', 
		seo					= '$seoID', 
		anasayfa			= '$anasayfa', 
		son1				= '$son1',
		son2				= '$son2',
		son3				= '$son3',
	  
		ip					='$ip', 
		 
		ekleyen				= '$ekleyen',
		otarih				= now(),
		
		hit					= '1',
		sira				= '$sira',
		dil					= '$dil',
	 	
		durum				= 'on' 
	 
	  ");   
	   
	   
	if($gonder){
		
		$icerikID	= $mysqli->insert_id;
		 
		$yukle 			= move_uploaded_file($kaynak,$rhedef."/".$resimsonad); 
		$yukle2 		= move_uploaded_file($ustkaynak,$rhedef."/".$ustresimsonad);
		$yukle3 		= move_uploaded_file($vkaynak,$rhedef."/".$vsonad);
		$yukle4			= move_uploaded_file($pdfkaynak,$rhedef."/".$pdfsonad);
		$yukle5			= move_uploaded_file($iconkaynak,$rhedef."/".$iconsonad);
		kucult($rhedef, $resimsonad);	
		  
		
		$ebakp = explode(",", $etiket);  
		$esay =  count($ebakp); 
		  	for($yy=0; $yy < $esay; $yy++){
			$etiket1  = $ebakp[$yy];
		$etiketekle = $mysqli->query ("insert into etiket (`menu`,`baslik`, `seo`, `konu`, `konuID` ) values ('$sistem' ,'$etiket1' , '$seoID' , 'sahap' , '$icerikID' ) "); 
				}	
		
		   if($rtopluad[0]!=""){ 
			for($x = 0; $x < $say; $x++){ 
				$rbaslik	= $rtopluad[$x];
				$rkaynak	= $rtoplukaynak[$x];		 
				$rsonadi 	= $x.'-'.yeniurl(res_adi($rbaslik)).res_uzanti($rbaslik);  
	//echo $rbaslik.'<br/>';
	$vyukle = $mysqli->query("insert into galeri (menu, icerikID, konu, baslik, resim, sira ,durum ) values('$sistem','$icerikID','sahap','$rbaslik','$rsonadi' ,  '0', 'on'   ) "); 
	$yukle 	= move_uploaded_file($rkaynak,$rhedef."/".$rsonadi);
		 // kucult($rhedef, $rsonadi);	
			} 
		   }
	  
	 
	 
		   if($dosyaad[0]!=""){
	   
	for($x = 0; $x < $dosyasay; $x++){
		 
		$pdfbaslik	= $dosyaad[$x];
		$pdfkaynak	= $dosyakaynak[$x];		 
		$pdfsonadi 	= rand(0,9999).'-'.yeniurl(res_adi($pdfbaslik)).res_uzanti($pdfbaslik);
				 
		 
	$vyukle = $mysqli->query("insert into dosya (menu, icerikID, konu, baslik, resim, sira ,durum ) values('$sistem','$icerikID','sahap','$pdfbaslik','$pdfsonadi' ,  '0', 'on'   ) "); 	
	$yukle 	= move_uploaded_file($pdfkaynak,$rhedef."/".$pdfsonadi);
		 // kucult($rhedef, $rsonadi);	
	  
			} 
			 
		   } 
	 
 	 header("Location:?sy=".$konu."&sistem=".$sistem."&islem=basarili");	
		  
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
		<label for="baslik" class="col-sm-2 col-form-label"><i class="fa fa-language"></i> İçerik Dili * </label>
		<div class="col-sm-6">
		
		<?php $dilbak1 = $mysqli->query("select * from diller  order by sira asc "); 
		while($dilyaz1 = $dilbak1->fetch_array()){
			if($dilyaz1['id']==$dil){
			
	echo '<a href="?sy='.$konu.'ekle&sistem='.$sistem.'&dil='.$dilyaz1['id'].'"><button type="button" class="btn btn-raised btn-raised-primary m-1">'.$dilyaz1['baslik'].'</button></a> ';
	
			} else {
			
	echo '<a href="?sy='.$konu.'ekle&sistem='.$sistem.'&dil='.$dilyaz1['id'].'"><button type="button" class="btn btn-outline-primary m-1">'.$dilyaz1['baslik'].'</button></a> ';
	
			}
		
		}				
						?>
			 
		</div>
	</div>	

<?php if($sistemyaz['baslik']=="on"){  ?>
<div class="form-group row">
		<label for="baslik" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Başlık * </label>
		<div class="col-sm-6">
		 <input type="text" name="baslik" class="form-control" id="baslik" placeholder="Başlık" value="" required >
		</div>
	</div>
	
	<?php } ?>
	
	
	<?php if($sistemyaz['kodu']=="on"){ ?>
  <div class="form-group row">
		<label for="kodu" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Kodu  </label>
		<div class="col-sm-2">
		 <input type="text" name="kodu" class="form-control" id="kodu" placeholder="Kodu" value=""   >
		</div>
	</div> 
		<?php } ?>
	 
	 
	 <?php if($sistemyaz['fiyat']=="on"){ ?>
<div class="form-group row">
		<label for="fiyat" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Fiyat  </label>
		<div class="col-sm-1">
		 <input type="text" name="fiyat" class="form-control" id="fiyat" placeholder="Fiyat" value=""   aria-describedby="validationTooltipUsernamePrepend" >  
		
		</div>  Örn. 65₺
 
	<!--	<div class="input-group-prepend">
			<span class="input-group-text" id="validationTooltipUsernamePrepend">TL</span>
		</div> -->

	</div>  
	 
	<?php } ?>
	
		
	<script type="text/javascript"> 
		$(function(){
			$("select[name=kat1]").change(function(){
				 
				var ustkatID 	= $("select[name=kat1]").val();
				var sistem		= $("input[name=sistem]").val();
				
				
				$.ajax({
					url: "pages/sahap/ukatbak.php",
					type: "POST",
					data: {"ustkatID":ustkatID , "sistem":sistem },
					success: function(ortakat) { 
						$("#kat2").html(ortakat);
					} 
				}); 
			});
			
			
			$("select[name=kat2]").change(function(){
				 
				var katID = $("select[name=kat2]").val();
				var sistem		= $("input[name=sistem]").val();
				 
				$.ajax({
					url: "pages/sahap/skat.php",
					type: "POST",
					data: {"katID":katID , "sistem":sistem},
					success: function(enaltkat) { 
						$("#kat3").html(enaltkat);
					} 
				}); 
			});
			
			
		});
		</script> 		
	  
	   <?php if($sistemyaz['kat1']=="on"){ ?>
	  <div class="form-group row">
		<label for="ustkatID" class="col-sm-2 col-form-label"> Kategori * </label>
		<div class="col-sm-2">
		  <input type="hidden" name="sistem" value="<?php echo $sistem; ?>" >
		  
		  
		  <label for="ustkatID"  > </label>
					<select class="custom-select task-manager-list-select" name="kat1" required >
						<option value="" > Kategori Seçin * </option>
			<?php 
				$ukat  = $mysqli->query("select * from $kategori where ustkatID='0' && menu='$sistem' && dil='$dil' order by sira asc ");
					while($uyaz = $ukat->fetch_array()){
						
						echo '<option value='.$uyaz['id'].' >'.$uyaz['baslik'].'</option>'; 
					}
			
			?>			
					 
		 </select>
		 
			
		</div>		 
		
		 <?php if($sistemyaz['kat2']=="on"){ ?>
 	<div class="col-sm-2">
		 
		  <label for="kat2"  > </label>
		 
		 <select name="kat2" class="custom-select task-manager-list-select" id="kat2"></select>
		 
			<small id="resim" class="ul-form__text form-text "> Orta Kategorisi yoksa seçmeyiniz </small>
 
		</div>  	
		
		 <?php } ?>
		 
		 
		  <?php if($sistemyaz['kat3']=="on"){ ?>
 	<div class="col-sm-2">
		 
		  <label for="kat3"  > </label>
		 
		 <select name="kat3" class="custom-select task-manager-list-select" id="kat3"></select>
		 
			<small id="resim" class="ul-form__text form-text "> Enalt Kategorisi yoksa seçmeyiniz </small>
 
		</div>  
		<?php } ?>
		
		 
	</div>
	
		<?php } ?>
		
	
	<?php if($sistemyaz['renk']=="on"){ ?>
	<div class="form-group row">
		<label for="renk" class="col-sm-2 col-form-label"><i class="fa fa-colors"></i> Renk  </label>
		<div class="col-sm-1">
		<input type="text" name="renk" maxlength="7" id="renk" class="form-control jscolor" value="1d376c">
		 
		</div>
	</div>   
<?php } ?>


<?php if($sistemyaz['ustresim']=="on"){ ?>
 <div class="form-group row">
		<label for="ustresim" class="col-sm-2 col-form-label"> <i class="nav-icon fa fa-image"></i> Üst Resim </label>
		<div class="col-sm-2">
		 <input type="file" name="ustresim" class="form-control" id="resim" placeholder=""  >  
		</div>	 
		<div class="col-sm-2"> 
		</div> 
	</div>
	<?php } ?>
	 
	 
	<?php if($sistemyaz['icon']=="on"){ ?>	 	
  <div class="form-group row">
		<label for="icon" class="col-sm-2 col-form-label"> <i class="nav-icon fa fa-image"></i>  İcon   </label>
		<div class="col-sm-2"> 
		    <input type="file"   name="icon" class="form-control" id="icon" placeholder=""  >
			 	 	
		</div>	
	</div>	 
	<?php } ?>	
	
	
	<?php if($sistemyaz['marka']=="on"){ ?>
		  <div class="form-group row">
		<label for="marka" class="col-sm-2 col-form-label"> Marka Seçin </label>
		
	  <div class="col-sm-2">
		 
		  <label for="ustkatID"  > </label>
		<select class="custom-select task-manager-list-select" name="marka" id="marka"  >
			<option value="" >Marka Seçin  </option>
	<?php 
		$markabak  = $mysqli->query("select * from marka order by sira asc ");
			while($markayaz = $markabak->fetch_array()){
 
				echo '<option value='.$markayaz['id'].' >'.$markayaz['baslik'].'</option>'; 
			}

	?>			
					 
		 </select> 			
		</div>	 	
	</div> 
	<?php } ?>
	
	 
	<?php if($sistemyaz['onyazi']=="on"){ ?> 		 
  <div class="form-group row">
		<label for="onyazi" class="col-sm-2 col-form-label"> Ön Yazı </label>
		<div class="col-sm-10">
		<textarea name="onyazi" class="form-control" id="onyazi" cols="50" rows="2" placeholder="Ön Yazı" ></textarea>
			 
		</div>
	</div>   
 <?php } ?>
 
	
		<?php if($sistemyaz['icerik1']=="on"){ ?> 
	<div class="form-group row">
		<label for="icerik" class="col-sm-2 col-form-label"> İçerik  </label>
		<div class="col-sm-10">
		<textarea name="icerik" class="ckeditor" id="icerik" cols="40" rows="3"></textarea>
	  
		</div> 
	</div>
	 <?php } ?>
  
	
	<?php if($sistemyaz['teknik1']=="on"){ ?> 
	<hr>
  <div class="form-group row">
		<label for="teknik" class="col-sm-2 col-form-label"> Teknik  </label>
		<div class="col-sm-10">
		<textarea name="teknik" class="ckeditor" id="teknik" cols="40" rows="3"></textarea>
	  
		</div> 
	</div>  
  <?php } ?>
	 
	 
	 
	<?php if($sistemyaz['resim']=="on"){ ?> 
 <div class="form-group row">
		<label for="resim" class="col-sm-2 col-form-label"><i class="nav-icon fa fa-image"></i> Ana Resim ( <?php echo genel('nresim'); ?>)  </label>
		<div class="col-sm-2">
		  <input type="file" name="resim" class="form-control" id="resim" placeholder="Küçük Resim Boyutu"   > 
			 				
		</div>	
		
		<div class="col-sm-2">
		  
			 				
		</div>
	 
	</div>
	   <?php } ?>
	   
	
	<?php if($sistemyaz['galeri']=="on"){ ?> 	
 	 <div class="form-group row">
		<label for="rtoplu" class="col-sm-2 col-form-label"> <i class="nav-icon i-Video-Photographer"></i> Diğer Resimler ( <?php echo genel('nresim'); ?>)  </label>
		<div class="col-sm-2">
		  <input type="file" multiple="multiple" name="rtoplu[]" class="form-control" id="rtoplu" placeholder=""  > 
		 <small id="passwordHelpBlock" class="ul-form__text form-text "> Toplu Resim Seçebilirsiniz </small>		 				
		</div> 
	</div>
	<?php } ?>
	
	 
	  
	 
 <?php if($sistemyaz['video']=="on"){ ?> 
	<div class="form-group row">
		<label for="video" class="col-sm-2 col-form-label"><i class="fa fa-play"></i> Video Link </label>
		<div class="col-sm-6">
		 <input type="text" name="video" class="form-control" id="video" placeholder="Video Link" value=""  >
		 <small id="passwordHelpBlock" class="ul-form__text form-text "> Video Link Boş Bırakırsanız İçerikte Video Bölümü Çalışmaz </small>	
		</div>
	</div> 
	  <div class="form-group row">
		<label for="vresim" class="col-sm-2 col-form-label"><i class="nav-icon fa fa-image"></i> Video Resim    </label>
		<div class="col-sm-2">
		  <input type="file" name="vresim" class="form-control" id="vresim" placeholder=""  > 
			 				
		</div>	
		
		<div class="col-sm-2">
		  
			 				
		</div>
	 
	</div>  
 
	<?php } ?>
	
	
		<?php if($sistemyaz['videokod']=="on"){ ?> 		 
  <div class="form-group row">
		<label for="videokod" class="col-sm-2 col-form-label"> Video Kodu </label>
		<div class="col-sm-10">
		<textarea name="videokod" class="form-control" id="videokod" cols="50" rows="2" placeholder="Video Kodu" ></textarea> 
		</div>
	</div>   
 <?php } ?>
 
 
 
	 <?php if($sistemyaz['pdf']=="on"){ ?> 	
	   <div class="form-group row">
		<label for="pdf" class="col-sm-2 col-form-label"> <i class="nav-icon i-Data-Upload"></i> Döküman   </label>
		<div class="col-sm-2">
		  <input type="file" name="pdf" class="form-control" id="pdf" placeholder=""  > 		 				
		</div>			 
	</div>  
  <?php } ?>
		
		
 <?php if($sistemyaz['dosya']=="on"){ ?> 
		  <div class="form-group row">
		<label for="dosya" class="col-sm-2 col-form-label"> <i class="nav-icon i-Data-Upload"></i> Dökümanlar (pdf, word, excel vb.)  </label>
		<div class="col-sm-2">
		  <input type="file" name="dosya[]" multiple="multiple" class="form-control" id="dosya" placeholder=""  > 
		   <small id="passwordHelpBlock" class="ul-form__text form-text "> Toplu İçerik Ekleyebilirsiniz </small> 
		</div>	 
	 
	</div>
 <?php } ?>
		
 
	 
	 <?php if($sistemyaz['seo']=="on"){ ?> 
		<div class="form-group row">
		<label for="seourl" class="col-sm-2 col-form-label">Seo URL * </label>
		<div class="col-sm-6">
		  <input type="text" name="seourl" class="form-control" id="seourl" placeholder="Seo URL" value=""  > 
			
 							
		</div>
		 
	</div>
		 <?php } ?>
		 
	
	<?php if($sistemyaz['keywords']=="on"){ ?> 	
	<div class="form-group row">
		<label for="keywords" class="col-sm-2 col-form-label">Keywords </label>
		<div class="col-sm-6">
		  <input type="text" name="keywords" class="form-control" id="keywords" placeholder="Keywords" value="" > 							
		</div>		 
	</div>
	<?php } ?>
	
	
	<?php if($sistemyaz['keywords']=="on"){ ?> 	
	<div class="form-group row">
	<label for="description" class="col-sm-2 col-form-label">Description </label>
	<div class="col-sm-6">
	  <input type="text" name="description" class="form-control" id="description" placeholder="Description" value="" > 
		
						
		</div>
		 
	</div>
	<?php } ?>
	
 
 
	<?php if($sistemyaz['etiket']=="on"){ ?> 				
	<div class="form-group row">
	<label for="etiket" class="col-sm-2 col-form-label">Etiketler </label>
	<div class="col-sm-6">
	  <input type="text" name="etiket" class="form-control" id="etiket" placeholder="Etiketler" value="" >  
		</div> 
		<div class="col-sm-2"> 
		<small id="passwordHelpBlock" class="ul-form__text form-text "> Virgül ile ayırınız </small>				
		</div> 
	</div>
	<?php } ?>
	
 
 
	<?php if($sistemyaz['yazar']=="on"){ ?> 				
	<div class="form-group row">
	<label for="yazar" class="col-sm-2 col-form-label">Yazar </label>
	<div class="col-sm-3">
	  <input type="text" name="yazar" class="form-control" id="yazar" placeholder="Yazar" value="" >  
		</div> 
	 
	</div>
	<?php } ?>
	
 
	<?php if($sistemyaz['tarih']=="on"){ ?> 				
  
	   	<div class="form-group row">
		<label for="tarih" class="col-sm-2 col-form-label">Tarih   </label>
		<div class="col-sm-2">
		 <input type="date" name="tarih" max="31.12.2050" class="form-control " id="tarih"   value="<?php echo date('Y-m-d'); ?>"  >
		</div>	 
	 </div>
	
	<?php } ?>
	
	
	<?php if($sistemyaz['anasayfa']=="on"){ ?>
	<div class="form-group row">
	<label for="anasayfa" class="col-sm-2 col-form-label">Ana Sayfada Göster </label>
	<div class="col-sm-2">
	 
		<label class="switch switch-warning mr-3" id="anasayfa">
			<input name="anasayfa" type="checkbox" value="on">
			<span class="slider"></span>
		</label>  
	</div> 
	</div>
	<?php } ?>
	
		
	 		
	<div class="form-group row">
	<label for="sira" class="col-sm-2 col-form-label">Sıra </label>
	<div class="col-sm-1">
	  <input type="text" name="sira" class="form-control" id="sira" placeholder="Sıra" value="" >  
		</div> 
	</div>
 
	
	
	<?php if($sistemyaz['obaslik1']=="on"){ ?> 
	<div class="form-group row">
		<label for="otip1" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> <?php echo $sistemyaz['oacik1']; ?>   </label> 		
		<?php if($sistemyaz['otip1']=="baslik"){ ?>
		<div class="col-sm-6">
		 <input type="text" name="son1" class="form-control" id="otip1" placeholder="<?php echo $sistemyaz['oacik1']; ?>" value=""  >
		</div>
		<?php } elseif($sistemyaz['otip1']=="onyazi"){  ?> 
		<div class="col-sm-10">
		<textarea name="son1" class="form-control" id="otip1" cols="50" rows="2" placeholder="" ></textarea> 
		</div>  
		<?php } else {  ?> 
		<div class="col-sm-10"> 
		<textarea name="son1" class="ckeditor" id="oacik4" cols="40" rows="3"></textarea>
		</div>   
		<?php } ?> 
	</div>   
	<?php } ?>
	 
	<?php if($sistemyaz['obaslik2']=="on"){ ?> 
	<div class="form-group row">
		<label for="otip2" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> <?php echo $sistemyaz['oacik2']; ?>   </label> 		
		<?php if($sistemyaz['otip2']=="baslik"){ ?>
		<div class="col-sm-6">
		 <input type="text" name="son2" class="form-control" id="otip2" placeholder="<?php echo $sistemyaz['oacik2']; ?>" value=""  >
		</div>
		<?php } elseif($sistemyaz['otip2']=="onyazi"){  ?> 
		<div class="col-sm-10">
		<textarea name="son2" class="form-control" id="otip2" cols="50" rows="2" placeholder="" ></textarea> 
		</div>  
		<?php } else {  ?> 
		<div class="col-sm-10"> 
		<textarea name="son2" class="ckeditor" id="oacik5" cols="40" rows="3"></textarea>
		</div>   
		<?php } ?> 
	</div>   
	<?php } ?>
	 
	<?php if($sistemyaz['obaslik3']=="on"){ ?> 
	<div class="form-group row">
		<label for="otip3" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> <?php echo $sistemyaz['oacik3']; ?>   </label> 		
		<?php if($sistemyaz['otip3']=="baslik"){ ?>
		<div class="col-sm-6">
		 <input type="text" name="son3" class="form-control" id="otip3" placeholder="<?php echo $sistemyaz['oacik3']; ?>" value=""  >
		</div>
		<?php } elseif($sistemyaz['otip3']=="onyazi"){  ?> 
		<div class="col-sm-10">
		<textarea name="son3" class="form-control" id="otip3" cols="50" rows="2" placeholder="" ></textarea> 
		</div>  
		<?php } else {  ?> 
		<div class="col-sm-10"> 
		<textarea name="son3" class="ckeditor" id="oacik6" cols="40" rows="3"></textarea>
		</div>   
		<?php } ?> 
	</div>   
	<?php } ?>
	 
		
 
	
		 
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
				