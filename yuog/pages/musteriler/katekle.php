	<?php 
	 
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
	$konu 	= "hazirkat"; 
	$altkonu = "hazir";
	
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
	 
	?>
	<div class="main-content">
	
   <div class="breadcrumb">
	<h1><a href="?sy=<?php echo $altkonu; ?>">Hazır Siteler</a> > <a href="?sy=<?php echo $konu; ?>"> Kategoriler </a>> <?php echo $dilyaz['baslik']; ?>  </h1>
	<ul>
		<li><a href="index.php">Ana Sayfa</a></li> 
		<li> Kategori Ekleme </li> 
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
	     
	$proje				= $_POST['proje'];
	$urun				= $_POST['urun'];
	
	$anasayfa			=  $_POST['anasayfa'];
	
	$css				= $_POST['css'];
	  
	$renk				= trim($_POST['renk']);
	$iconID				= trim($_POST['iconID']);
	$katID				= trim($_POST['katID']);
	$ustkatID			= trim($_POST['ustkatID']);
	$baslik				= addslashes(trim($_POST['baslik']));
	$onyazi				= addslashes(trim($_POST['onyazi']));
	$icerik				= addslashes(trim($_POST['icerik']));
	$keywords			= addslashes(trim($_POST['keywords']));
	$description		= addslashes(trim($_POST['description']));
	$etiket				= addslashes(trim($_POST['etiket']));
	 
	// $vbaslik			= addslashes(trim($_POST['vbaslik']));
	// $vaciklama			= addslashes(trim($_POST['vaciklama']));
	$vlink				= addslashes(trim($_POST['vlink']));
 
	// $ibaslik			= addslashes(trim($_POST['ibaslik']));
	// $iicerik			= addslashes(trim($_POST['iicerik']));
	
	// $linkedin			= (trim($_POST['linkedin']));
	$rhedef				= "../uploads/";
	
	$sira				= trim($_POST['sira']); 
	$hit				= 1;
	$durum				= 1;
	$ekleyen			= $email;  
	$ip					= $_SERVER['REMOTE_ADDR']; 
	
	$rtopluad			= $_FILES['rtoplu']['name'];
	$rtoplukaynak		= $_FILES['rtoplu']['tmp_name'];
	$say 				= count($rtopluad);
	
	$resimad			= $_FILES['resim']['name']; 
	$kaynak				= $_FILES['resim']['tmp_name']; 
	
	$ustresimad			= $_FILES['ustresim']['name']; 
	$ustkaynak			= $_FILES['ustresim']['tmp_name']; 
	
	$iconad				= $_FILES['icon']['name']; 
	$iconkaynak			= $_FILES['icon']['tmp_name']; 
	
	$vresimad			= $_FILES['vresim']['name']; 
	$vkaynak			= $_FILES['vresim']['tmp_name']; 
	
	$pdfad				= $_FILES['pdf']['name'];
	$pdfkaynak			= $_FILES['pdf']['tmp_name'];
	
	$resimsonad 		= rand(0,999).'-'.yeniurl(res_adi($resimad)).res_uzanti($resimad);
	$ustsonad 			= rand(0,999).'-'.yeniurl(res_adi($ustresimad)).res_uzanti($ustresimad);
	$vsonad 			= rand(0,999).'-'.yeniurl(res_adi($vresimad)).res_uzanti($vresimad);
	$iconsonad 			= rand(0,999).'-'.yeniurl(res_adi($iconad)).res_uzanti($iconad);
	$kresimsonad 		= 'mini-'.$resimsonad;	
	  
 
	 
	$yeniurlmiz =  $_POST['seourl'];
	
	$seosor		= $mysqli->query("select * from seo where seo='$yeniurlmiz' ");
	$seoyazz	= $seosor->fetch_array(); 
	$seosay 	= $seosor->num_rows;
		  
	if($seosay>0){
		$sonurl = rand(0,100).'-'.$yeniurlmiz;
	} else { 
		$sonurl = $yeniurlmiz;
	}
	
	$seoekle 		= $mysqli->query("insert into seo (seo,konu, durum) values ('$sonurl', '$konu', '$durum')");	
	$seoID			= $mysqli->insert_id;
	
  
	$gonder  	= $mysqli->query(" insert into $konu set 
	
		iconID 				='$iconID', 
		renk 				='$renk', 
		css 				='$css', 
		katID 				='$katID', 
		ustkatID			='$ustkatID', 
		baslik 				='$baslik', 
		onyazi 				='$onyazi', 
		icerik 				='$icerik', 
		keywords 			='$keywords', 
		description			='$description', 
		kresim				='$kresimsonad', 
		resim				='$resimsonad', 		
		ustresim			= '$ustsonad',	
		icon				= '$iconsonad',	
		vbaslik				= '$vbaslik',
		vaciklama			= '$vaciklama',
		vlink				= '$vlink',
		vresim				= '$vsonad',
		ibaslik				= '$ibaslik',
		iicerik				= '$iicerik',	
		pdf					= '$pdfad',	
		ip					='$ip', 
		tarih				= now(),
		ekleyen				= '$ekleyen',
		seo					= '$seoID',
		hit					= '$hit',
		sira				= '$sira',
		dil					= '$dil', 
		anasayfa			= '$anasayfa', 
		durum				= '$durum' 
	 
	  ");   
	  
	if($gonder){
		
		$icerikID	= $mysqli->insert_id;
		
		$yukle 			= move_uploaded_file($kaynak,$rhedef."/".$resimsonad);
		$yukle2 		= move_uploaded_file($ustkaynak,$rhedef."/".$ustsonad);
		$yukle3 		= move_uploaded_file($vkaynak,$rhedef."/".$vsonad);
		$yukle4			= move_uploaded_file($pdfkaynak,$rhedef."/".$pdfad);
		$yukle5			= move_uploaded_file($iconkaynak,$rhedef."/".$iconsonad);
		 
		kucult($rhedef, $resimsonad);	
		  
		
		$ebakp = explode(",", $etiket);  
		$esay =  count($ebakp);
				
		  	for($yy=0; $yy < $esay; $yy++){
			$etiket1  = $ebakp[$yy];
		$etiketekle = $mysqli->query ("insert into etiket (`baslik`, `seo`, `konu`, `konuID` ) values ('$etiket1' , '$seoID' , '$konu' , '$icerikID' ) ");
				
				}	
		
		// $projesay 	= count($proje);
		 
		// for($pp=0; $pp<$projesay; $pp++){
			// $proje1	= $proje[$pp];
			// $bolumekle = $mysqli->query("insert into bolumlerproje (`proje`, `katID`) values ('$proje1' , '$icerikID' ) ");
		// }
		
		
		// $urunsay 	= count($urun);
	 
		// for($zz=0; $zz<$urunsay; $zz++){
			// $urun1	= $urun[$zz];
			// $bolumekle2 = $mysqli->query("insert into bolumlerurun (`urun`, `katID`) values ('$urun1' , '$icerikID' ) ");
		// }
		
		
		   if($rtopluad[0]!=""){
			   
			for($x = 0; $x < $say; $x++){
				 
				$rbaslik	= $rtopluad[$x];
				$rkaynak	= $rtoplukaynak[$x];		 
				$rsonadi 	= $x.'-'.yeniurl(res_adi($rbaslik)).res_uzanti($rbaslik);
				 
				
	//echo $rbaslik.'<br/>';
	$vyukle = $mysqli->query("insert into galeri (icerikID, konu, baslik, resim, sira ,durum ) values('$icerikID','$konu','$rbaslik','$rsonadi' ,  '0', '1'   ) ");
	
	$yukle 	= move_uploaded_file($rkaynak,$rhedef."/".$rsonadi);
		  // kucult($rhedef, $rsonadi);	
			}
			 
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
		<label for="baslik" class="col-sm-2 col-form-label"><i class="fa fa-language"></i> İçerik Dili * </label>
		<div class="col-sm-6">
		 
						
						
	 <?php $dilbak1 = $mysqli->query("select * from diller  "); 
		while($dilyaz1 = $dilbak1->fetch_array()){
			if($dilyaz1['id']==$dil){
			
	echo '<a href="?sy='.$konu.'ekle&dil='.$dilyaz1['id'].'"><button type="button" class="btn btn-raised btn-raised-primary m-1">'.$dilyaz1['baslik'].'</button></a> ';
	
			} else {
			
	echo '<a href="?sy='.$konu.'ekle&dil='.$dilyaz1['id'].'"><button type="button" class="btn btn-outline-primary m-1">'.$dilyaz1['baslik'].'</button></a> ';
	
			}
		
		}				
	 ?>
						
						
			 
		</div>
	</div>	

<div class="form-group row">
		<label for="baslik" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Başlık * </label>
		<div class="col-sm-6">
		 <input type="text" name="baslik" class="form-control" id="baslik" placeholder="Başlık" value="" required >
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

		
	<div class="form-group row">
		<label for="ustkatID" class="col-sm-2 col-form-label">Üst Kategori  </label>
		<div class="col-sm-2">
		 
		  <label for="ustkatID"  > </label>
					<select class="custom-select task-manager-list-select" name="ustkatID" >
						<option value="" >Üst Kategori Yok</option>
			<?php 
				$ukat  = $mysqli->query("select * from $konu where ustkatID='0' && dil='$dil' order by sira asc ");
					while($uyaz = $ukat->fetch_array()){
						
						echo '<option value='.$uyaz['id'].' >'.$uyaz['baslik'].'</option>'; 
					}
			
			?>			
					 
		 </select>
			<small id="resim" class="ul-form__text form-text "> Üst Kategorisi yoksa seçmeyiniz </small>
 
			
		</div>		
		
		<!-- <div class="col-sm-2">
		 
		  <label for="katID"  > </label>
		 
		 <select name="katID" class="custom-select task-manager-list-select" id="altkat"></select>
		 
			<small id="resim" class="ul-form__text form-text "> Orta Kategorisi yoksa seçmeyiniz </small>

		

			
		</div> -->
		 
	</div> 
	 
	<!-- <div class="form-group row" id="renkksec"> 
		<label for="css" class="col-sm-2 col-form-label">  Ana Renk Skalası * </label>
		<div class="col-sm-3">
		 
		 
		 <select class="custom-select task-manager-list-select" name="css" required >
			<option> Renk Skalası Seç </option> 
			 <option value="mekanik" style="background-color:rgba(150,96,164,1); " >  MEKANİK OTOMASYON & ROBOTİK </option> 
			 <option value="hidromekanik" style="background-color:rgba(94, 165, 193,1); " >  HİDROMEKANİK SİSTEMLER </option> 
		  		 
		 </select>
			 
		</div>		
		 
	</div>
	
	
	 <div class="form-group row">
		<label for="renk" class="col-sm-2 col-form-label"><i class="fa fa-colors"></i> Renk  </label>
		<div class="col-sm-1">
		<input type="text" name="renk" maxlength="7" id="renk" class="form-control jscolor" value="1d376c">
		 
		</div>
	</div>
-->
	<!-- 
	<div class="form-group row">
		<label for="baslik" class="col-sm-2 col-form-label"> Üst İçerik </label>
		<div class="col-sm-2">
		
		<?php if($katID!=""){ echo $katyaz['baslik']; } else { ?> Üst İçerik Yok <?php } ?>
		 
		</div>	
	  
	
	</div>	

	 
	
	 	
 <div class="form-group row">
		<label for="icon" class="col-sm-2 col-form-label"> <i class="nav-icon fa fa-image"></i>  İcon  ( 32 * 32 )  </label>
		
		<div class="col-sm-2">
		  <input type="file" name="icon" class="form-control" id="icon" placeholder="" > 
			 				
		</div>
			veya
		
		<div class="col-sm-2">
		<input type="text" name="iconID" class="form-control" id="iconID" placeholder="İcon" value=""   > 
			 				
		</div> 
	<a href="https://fontawesome.com/icons?d=gallery&m=free" target="_blank" ><button type="button" class="btn btn-outline-warning m-1">İconlar</button></a>
	
	<small id="resim" class="ul-form__text form-text "> (Ör.  fa fa-home veya flaticon-clipboard bg-icon ) Bu alan boş olursa icon olarak resim icon kullanılır  </small>
		
	</div>

		
	
  <div class="form-group row">
		<label for="resim" class="col-sm-2 col-form-label"> <i class="nav-icon fa fa-image"></i> Bölümler İcon   ( 45 * 45)   </label>
		<div class="col-sm-2"> 
		 <input type="file" name="ustresim" class="form-control" id="resim" placeholder=""  > 
		  			
		</div>	
		
		<div class="col-sm-2">
		  <small id="resim" class="ul-form__text form-text "> Sadece ana kategoriler için  </small>
			 				
		</div>
	 
	</div> 
	 
	 		 -->
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
		<label for="resim" class="col-sm-2 col-form-label"><i class="nav-icon fa fa-image"></i> İçerik Resmi ( 555 * 312) * </label>
		<div class="col-sm-2">
		  <input type="file" name="resim" class="form-control" id="resim" placeholder="Küçük Resim Boyutu" required  > 
			 				
		</div>	
		
		<div class="col-sm-2">
		  
			 				
		</div>
	 
	</div>
	 
	<hr/>
	
	 	
	<!--	<div class="form-group row">
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
		<label for="vlink" class="col-sm-2 col-form-label"><i class="fa fa-play"></i> Video Link </label>
		<div class="col-sm-6">
		 <input type="text" name="vlink" class="form-control" id="vlink" placeholder="Video Link" value=""  >
		 <small id="passwordHelpBlock" class="ul-form__text form-text "> Video Link Boş Bırakırsanız İçerikte Video Bölümü Çalışmaz </small>	
		</div>
	</div>
	
	
	  <div class="form-group row">
		<label for="vresim" class="col-sm-2 col-form-label"><i class="nav-icon fa fa-image"></i> Video Resim  ( 800* 600) </label>
		<div class="col-sm-2">
		  <input type="file" name="vresim" class="form-control" id="vresim" placeholder=""  > 
			 				
		</div>	
		
		<div class="col-sm-2">
		  
			 				
		</div>
	 
	</div> 
	
	 
	  <div class="form-group row">
		<label for="pdf" class="col-sm-2 col-form-label"> <i class="nav-icon i-Data-Upload"></i> PDF (pdf, word, excel vb.)  </label>
		<div class="col-sm-2">
		  <input type="file" name="pdf" class="form-control" id="pdf" placeholder=""  > 
		 				
		</div>	
		
		 
	 
	</div>
	
	
	<hr/>-->
	<!-- 
	 <div class="form-group row">
		<label for="rtoplu" class="col-sm-2 col-form-label"> <i class="nav-icon i-Video-Photographer"></i> Resim Galeri  </label>
		<div class="col-sm-2">
		  <input type="file" multiple="multiple" name="rtoplu[]" class="form-control" id="rtoplu" placeholder=""  > 
		 <small id="passwordHelpBlock" class="ul-form__text form-text "> Toplu Resim Seçebilirsiniz </small>		 				
		</div>	
		
		 
	 
	</div>
	
	 -->
	
	
	
	<!-- <div class="form-group row">
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
	
 
	 	
		
		<div class="form-group row">
		<label for="icerik" class="col-sm-2 col-form-label"> Projeler  </label>
		
	<?php 
		$pbak = $mysqli->query("select * from uygulama where dil='$dil' && durum='1' order by sira asc ");
		while($pyaz = $pbak->fetch_array()){
			
			echo '<label class="checkbox checkbox-primary mr-2">
		<input type="checkbox" name="proje[]" value="'.$pyaz['id'].'" >
		<span>'.$pyaz['baslik'].'</span>
		<span class="checkmark"></span> 
		</label>';
			
		}
 	?>	
		      
		 
	</div> 
	 
	  
	<hr/>
	 	
		
		<div class="form-group row">
		<label for="icerik" class="col-sm-2 col-form-label"> Ürünler  </label>
		
	<?php 
		$urunbak = $mysqli->query("select * from urun where dil='$dil' && durum='1' order by sira asc ");
		while($uruyaz = $urunbak->fetch_array()){
			
			echo '<label class="checkbox checkbox-primary mr-2">
		<input type="checkbox" name="urun[]" value="'.$uruyaz['id'].'" >
		<span>'.$uruyaz['baslik'].'</span>
		<span class="checkmark"></span> 
		</label>';
			
		}
 	?>	
		      
		 
	</div>
	
	
	
	 <hr/>
	  -->
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
	<label for="anasayfa" class="col-sm-2 col-form-label">Ana Sayfada Göster </label>
	<div class="col-sm-2">
	 
		<label class="switch switch-warning mr-3" id="anasayfa">
			<input name="anasayfa" type="checkbox" value="1">
			<span class="slider"></span>
		</label>  
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
	
<!--	<div class="form-group row">
	<label for="durum" class="col-sm-2 col-form-label">Linkedin'de Paylaş </label>
	<div class="col-sm-2">
	 
		<label class="switch switch-primary mr-3" id="durum">
			<input name="linkedin" type="checkbox" value="1">
			<span class="slider"></span>
		</label>  
	</div> 
	</div>  -->
		
		 
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
				