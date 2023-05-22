	<?php 
	 
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
	$konu 		= "odul";
	$kategori 	= "urunkat";
	
	
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
                <h1><a href="?sy=<?php echo $konu; ?>">Ödüller</a> > <?php echo $dilyaz['baslik']; ?>  </h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li> İçerik Ekleme </li>
                  
                     
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
	
	// $renk				= trim($_POST['renk']);
	$anasayfa			=  $_POST['anasayfa'];
	
	$ustkatID			=  $_POST['ustkatID'];
	$katID				=  $_POST['katID']; 
	$baslik				= addslashes(trim($_POST['baslik']));
	$onyazi				= addslashes(trim($_POST['onyazi']));
	$icerik				= addslashes(trim($_POST['icerik']));
	$keywords			= addslashes(trim($_POST['keywords']));
	$description		= addslashes(trim($_POST['description']));
	$etiket				= addslashes(trim($_POST['etiket']));
	
	$yetkili			=  addslashes(trim($_POST['yetkili'])); 
	$ymail				=  addslashes(trim($_POST['ymail'])); 
	$tel				=  addslashes(trim($_POST['tel']));  
	 
	// $vbaslik			= addslashes(trim($_POST['vbaslik']));
	// $vaciklama			= addslashes(trim($_POST['vaciklama']));
	$vlink				= addslashes(trim($_POST['vlink']));
 
	// $ibaslik			= addslashes(trim($_POST['ibaslik']));
	// $iicerik			= addslashes(trim($_POST['iicerik']));
	
	// $linkedin			= (trim($_POST['linkedin']));
 
	$sira				= trim($_POST['sira']); 
	$hit				= 1;
	$durum				= 1;
	$ekleyen			= $email;  
	$ip					= $_SERVER['REMOTE_ADDR']; 
	
	$rtopluad			= $_FILES['rtoplu']['name'];
	$rtoplukaynak		= $_FILES['rtoplu']['tmp_name'];
	$say 				= count($rtopluad);
	
	$pdfad				= $_FILES['dosya']['name'];
	$pdfkay				= $_FILES['dosya']['tmp_name'];
	$pdfsay 			= count($pdfad);
	 
	$resimad			= $_FILES['resim']['name']; 
	$kaynak				= $_FILES['resim']['tmp_name']; 
	
	$ustresimad			= $_FILES['ustresim']['name']; 
	$ustkaynak			= $_FILES['ustresim']['tmp_name']; 
	
	$iconad				= $_FILES['icon']['name']; 
	$iconkaynak			= $_FILES['icon']['tmp_name']; 
	
	$vresimad			= $_FILES['vresim']['name']; 
	$vkaynak			= $_FILES['vresim']['tmp_name']; 
	  
	$resimsonad 		= rand(0,999).'-'.yeniurl(res_adi($resimad)).res_uzanti($resimad);
	$ustsonad 			= rand(0,999).'-'.yeniurl(res_adi($ustresimad)).res_uzanti($ustresimad);
	$vsonad 			= rand(0,999).'-'.yeniurl(res_adi($vresimad)).res_uzanti($vresimad);
	$iconsonad 			= rand(0,999).'-'.yeniurl(res_adi($iconad)).res_uzanti($iconad);
	$kresimsonad 		= 'mini-'.$resimsonad;	
	  
	$rhedef				= "../uploads/".$konu."/";
	 
	// $yeniurlmiz =  $_POST['seourl'];
	
	// $seosor		= $mysqli->query("select * from seo where seo='$yeniurlmiz' ");
	// $seoyazz	= $seosor->fetch_array(); 
	// $seosay 	= $seosor->num_rows;
		  
	// if($seosay>0){
		// $sonurl = rand(0,100).'-'.$yeniurlmiz;
	// } else { 
		// $sonurl = $yeniurlmiz;
	// }
	
	// $seoekle 		= $mysqli->query("insert into seo (seo,konu, durum) values ('$sonurl', '$konu', '$durum')");	
	// $seoID			= $mysqli->insert_id;
	
  
	$gonder  	= $mysqli->query(" insert into $konu set 
	
	 
		katID 				='$ustkatID', 
		 
		baslik 				='$baslik', 
		onyazi 				='$onyazi', 
		icerik 				='$icerik', 
		keywords 			='$keywords', 
		description			='$description', 
		kresim				='$kresimsonad', 
		resim				='$resimsonad', 		
		ustresim			= '$ustsonad',	
		icon				= '$iconsonad',	
		
		yetkili 			='$yetkili', 
		ymail 				='$ymail', 
		tel 				='$tel', 
		
		vlink				= '$vlink',
		vresim				= '$vsonad',
   
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
		// $yukle4			= move_uploaded_file($pdfkaynak,$rhedef."/".$pdfad);
		$yukle5			= move_uploaded_file($iconkaynak,$rhedef."/".$iconsonad);
		kucult($rhedef, $resimsonad);	
		  
		
		$ebakp = explode(",", $etiket);  
		$esay =  count($ebakp);
				
		  	for($yy=0; $yy < $esay; $yy++){
			$etiket1  = $ebakp[$yy];
		$etiketekle = $mysqli->query ("insert into etiket (`baslik`, `seo`, `konu`, `konuID` ) values ('$etiket1' , '$seoID' , '$konu' , '$icerikID' ) ");
				
				}	
		
		   if($rtopluad[0]!=""){
			   
			for($x = 0; $x < $say; $x++){
				 
				$rbaslik	= $rtopluad[$x];
				$rkaynak	= $rtoplukaynak[$x];		 
				$rsonadi 	= rand(0,9999).'-'.yeniurl(res_adi($rbaslik)).res_uzanti($rbaslik);
				 
				
	//echo $rbaslik.'<br/>';
	$vyukle = $mysqli->query("insert into galeri (icerikID, konu, baslik, resim, sira ,durum ) values('$icerikID','$konu','$rbaslik','$rsonadi' ,  '0', '1'   ) ");
	
	$yukle 	= move_uploaded_file($rkaynak,$rhedef."/".$rsonadi);
		 // kucult($rhedef, $rsonadi);	
			}
			 
		   }	
		   
		   
   if($pdfad[0]!=""){
	   
	for($x = 0; $x < $pdfsay; $x++){
		 
		$pdfbaslik	= $pdfad[$x];
		$pdfkaynak	= $pdfkay[$x];		 
		$pdfsonadi 	= rand(0,9999).'-'.yeniurl(res_adi($pdfbaslik)).res_uzanti($pdfbaslik);
				 
		 
	$vyukle = $mysqli->query("insert into dosya (icerikID, konu, baslik, resim, sira ,durum ) values('$icerikID','$konu','$pdfbaslik','$pdfsonadi' ,  '0', '1'   ) ");
	
	$yukle 	= move_uploaded_file($pdfkaynak,$rhedef."/".$pdfsonadi);
		 // kucult($rhedef, $rsonadi);	
	  
			} 
			 
		   }
		   
		   
		$projesay 	= count($proje);
		 
		for($pp=0; $pp<$projesay; $pp++){
			$proje1	= $proje[$pp];
			$bolumekle = $mysqli->query("insert into  urunproje (`proje`, `icerikID`) values ('$proje1' , '$icerikID' ) ");
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
					url: "pages/urun/ukatbak.php",
					type: "POST",
					data: {"ustkatID":ustkatID},
					success: function(ortakat) { 
						$("#altkat").html(ortakat);
					}
					
				});
				
			});
			
		});
		</script> 		

 <!--		
	<div class="form-group row">
		<label for="ustkatID" class="col-sm-2 col-form-label">Üst Kategori * </label>
		<div class="col-sm-2">
		 
		  <label for="ustkatID"  > </label>
					<select class="custom-select task-manager-list-select" name="ustkatID" required >
						<option value="" >Üst Kategori Seçin * </option>
			<?php 
				$ukat  = $mysqli->query("select * from $kategori where ustkatID='0' && dil='$dil' order by sira asc ");
					while($uyaz = $ukat->fetch_array()){
						
						echo '<option value='.$uyaz['id'].' >'.$uyaz['baslik'].'</option>'; 
					}
			
			?>			
					 
		 </select>
		 
			
		</div>		
		
		<div class="col-sm-2">
		 
		  <label for="katID"  > </label>
		 
		 <select name="katID" class="custom-select task-manager-list-select" id="altkat"></select>
		 
			<small id="resim" class="ul-form__text form-text "> Orta Kategorisi yoksa seçmeyiniz </small>
 
		</div> 
		 
	</div>-->
	
	<!-- <div class="form-group row">
		<label for="renk" class="col-sm-2 col-form-label"><i class="fa fa-colors"></i> Renk  </label>
		<div class="col-sm-1">
		<input type="text" name="renk" maxlength="7" id="renk" class="form-control jscolor" value="1d376c">
		 
		</div>
	</div>  

 <div class="form-group row">
		<label for="resim" class="col-sm-2 col-form-label"> <i class="nav-icon fa fa-image"></i> Üst Resim  ( 1920 * 450) * </label>
		<div class="col-sm-2">
		 <input type="file" name="ustresim" class="form-control" id="resim" placeholder="" required  > 
			 				
		</div>	
		
		<div class="col-sm-2">
		  
			 				
		</div>
	 
	</div>-->
	
	
	<!-- <div class="form-group row">
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
		
		<div class="col-sm-2">
		  
			 				
		</div>
	 
	</div>-->

	
	 		 
  <div class="form-group row">
		<label for="onyazi" class="col-sm-2 col-form-label"> Ön Yazı </label>
		<div class="col-sm-10">
		<textarea name="onyazi" class="form-control" id="onyazi" cols="50" rows="2" placeholder="Ön Yazı" ></textarea>
			 
		</div>
	</div>   
 

	<!-- <div class="form-group row">
		<label for="icerik" class="col-sm-2 col-form-label"> İçerik  </label>
		<div class="col-sm-10">
		<textarea name="icerik" class="ckeditor" id="icerik" cols="40" rows="3"></textarea>
	  
		</div> 
	</div> -->
	 
 <div class="form-group row">
		<label for="resim" class="col-sm-2 col-form-label"><i class="nav-icon fa fa-image"></i> İçerik Resmi ( 200 * 300) * </label>
		<div class="col-sm-2">
		  <input type="file" name="resim" class="form-control" id="resim" placeholder="Küçük Resim Boyutu" required  > 
			 				
		</div>	
		
		<div class="col-sm-2">
		  
			 				
		</div>
	 
	</div>
	  
	 
	 
	 <div class="form-group row">
	<label for="anasayfa" class="col-sm-2 col-form-label">Ana Sayfada Göster </label>
	<div class="col-sm-2">
	 
		<label class="switch switch-warning mr-3" id="anasayfa">
			<input name="anasayfa" type="checkbox" <?php if($yaz['anasayfa']==1){ echo 'checked'; } ?> value="1">
			<span class="slider"></span>
		</label>  
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
	 
		<label class="switch switch-primary mr-3" id="durum">
			<input name="linkedin" type="checkbox" value="1">
			<span class="slider"></span>
		</label>  
	</div> 
	</div>
		
		 
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
				