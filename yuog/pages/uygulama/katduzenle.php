	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
	$konu 	= "uygulamakat";
 
	$rhedef	= "../uploads/uygulama/";
	
	$id 	= $_GET['id'];
	$yaz1 	= $mysqli->query("select * from $konu where id='$id' ");
	$yaz 	= $yaz1->fetch_array();
	
	$seoID 	= $yaz['seo'];
	$seobul	= $mysqli->query("select * from seo where id='$seoID' ");
	$seoyaz = $seobul->fetch_array();
	$dil 	= $yaz['dil']; 
	$dilbul = $mysqli->query("select * from diller where id='$dil' ");
	$dilyaz = $dilbul->fetch_array();
	
	?>
	 
	 <div class="main-content">
	
   
	 <div class="breadcrumb">
		<h1><a href="?sy=uygulama">Uygulamalar</a> > <a href="?sy=<?php echo $konu; ?>"> Kategoriler </a>> <?php echo $dilyaz['baslik']; ?>  </h1>
		<ul>
			<li><a href="index.php">Ana Sayfa</a></li> 
			<li> Kategori Güncelleme </li>
		  
			 
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
	
	$renk				= addslashes(trim($_POST['renk']));
	$baslik				= addslashes(trim($_POST['baslik']));
	$onyazi				= addslashes(trim($_POST['onyazi']));
	$icerik				= addslashes(trim($_POST['icerik']));
	$keywords			= addslashes(trim($_POST['keywords']));
	$description		= addslashes(trim($_POST['description']));
	$etiket				= addslashes(trim($_POST['etiket']));
	 
	// $vbaslik			= addslashes(trim($_POST['vbaslik']));
	// $vaciklama			= addslashes(trim($_POST['vaciklama']));
	$vlink				= addslashes(trim($_POST['vlink']));
	 
	$eskiresimler		= $_POST['eskiresimler'];	  
	$rtopluad			= $_FILES['rtoplu']['name'];
	$rtoplukaynak		= $_FILES['rtoplu']['tmp_name'];
	$say 				= count($rtopluad);
	 
	 
	// $ibaslik			= addslashes(trim($_POST['ibaslik']));
	// $iicerik			= addslashes(trim($_POST['iicerik']));
 
	$sira				= trim($_POST['sira']); 
	$katID				= trim($_POST['katID']); 
	$dil				= trim($_POST['dil']); 
	 
	$durum1				= $_POST['durum']; 	 
	if($durum1=="on"){ $durum = 1; } else { $durum = 0; }  
	 
	$ustresimad			= $_FILES['ustresim']['name']; 
	$ustkaynak			= $_FILES['ustresim']['tmp_name']; 
	$gustresim			= $_POST['gustresim']; 
	
	$resimad			= $_FILES['resim']['name']; 
 	$kaynak				= $_FILES['resim']['tmp_name']; 
	$gresim				= $_POST['gresim'];  
	 
	$iconad				= $_FILES['icon']['name'];  	
	$gicon				= $_POST['gicon']; 
		 
	$kresimad			= $_FILES['kresim']['name'];  	
	$gkresim			= $_POST['gkresim']; 
	
	$vresimad			= $_FILES['vresim']['name']; 
	$vkaynak			= $_FILES['vresim']['tmp_name']; 
	$gvresim			= $_POST['gvresim'];  
	
	$pdfad				= $_FILES['pdf']['name']; 
	 
		
	 
	$yeniurlmiz 		=  $_POST['seourl'];
	
	$seosor			= $mysqli->query("select * from seo where seo='$yeniurlmiz' && id!='$seoID' ");
	$seoyazz		= $seosor->fetch_array(); 
	$seosay 		= $seosor->num_rows;		  
	if($seosay>0){
		$sonurl = rand(0,100).'-'.$yeniurlmiz;
	} else { 
		$sonurl = $yeniurlmiz;
	}
	
	$seoguncelle = $mysqli->query("update seo set seo='$sonurl', durum='$durum' where id='$seoID' ");
	
  
	$gonder  	= $mysqli->query(" update $konu set  
		renk 				='$renk',
		katID 				='$katID', 
		baslik 				='$baslik', 
		onyazi 				='$onyazi', 
		icerik 				='$icerik', 
		keywords 			='$keywords', 
		description			='$description',  
		vbaslik				= '$vbaslik',
		vaciklama			= '$vaciklama',
		vlink				= '$vlink',	 
		ibaslik				= '$ibaslik',
		iicerik				= '$iicerik', 
		 
		sira				= '$sira',
		dil					= '$dil', 
		durum				= '$durum'  
	  
		where id='$id'
	 
	  ");   
	  
	if($gonder){
	 
	 //resimler 
		if($ustresimad!=""){ 	 
		
		unlink($rhedef.$gustresim);	
		$kaynak		= $_FILES['resim']['tmp_name'];
		$resimsonad = rand(0,999).'-'.yeniurl(res_adi($ustresimad)).res_uzanti($ustresimad);
		$yukle 		= move_uploaded_file($ustkaynak,$rhedef."/".$resimsonad); 
		$guncelle 	= $mysqli->query("update $konu set ustresim='$resimsonad' where id='$id' ");
	}	
	
	if($iconad!=""){ 	 
		
		unlink($rhedef.$gicon);		
		$kaynak1		= $_FILES['icon']['tmp_name'];
		$resimsonad1 	= rand(0,999).'-'.yeniurl(res_adi($iconad)).res_uzanti($iconad);
		$yukle 			= move_uploaded_file($kaynak1,$rhedef."/".$resimsonad1); 
		$guncelle 		= $mysqli->query("update $konu set icon='$resimsonad1' where id='$id' ");	
	}
	
	if($kresimad!=""){ 	 
		
		unlink($rhedef.$gkresim);		
		$kaynak1		= $_FILES['kresim']['tmp_name'];
		$resimsonad1 	= rand(0,999).'-'.yeniurl(res_adi($kresimad)).res_uzanti($kresimad);
		$yukle 			= move_uploaded_file($kaynak1,$rhedef."/".$resimsonad1); 
		$guncelle 		= $mysqli->query("update $konu set kresim='$resimsonad1' where id='$id' ");	
	}
	
	
	if($resimad!=""){ 	 
		
		unlink($rhedef.$gresim);	
		$kaynak		= $_FILES['resim']['tmp_name'];
		$resimsonad = rand(0,999).'-'.yeniurl(res_adi($resimad)).res_uzanti($resimad);
		$yukle 		= move_uploaded_file($kaynak,$rhedef."/".$resimsonad); 
		$guncelle 	= $mysqli->query("update $konu set resim='$resimsonad' where id='$id' ");
	}
	 
	if($vresimad!=""){ 	 
		
		unlink($rhedef.$gvresim);		
		$kaynak1		= $_FILES['vresim']['tmp_name'];
		$resimsonad1 	= rand(0,999).'-'.yeniurl(res_adi($vresimad)).res_uzanti($vresimad);
		$yukle 			= move_uploaded_file($kaynak1,$rhedef."/".$resimsonad1); 
		$guncelle 		= $mysqli->query("update $konu set vresim='$resimsonad1' where id='$id' ");	
	}
	  
	if($pdfad!=""){ 	 
		 
		$gpdf				= $_POST['gpdf'];  
		unlink($rhedef.$gpdf);		
		$kaynak1		= $_FILES['pdf']['tmp_name'];		 
		$yukle 			= move_uploaded_file($kaynak1,$rhedef."/".$pdfad); 
		$guncelle 		= $mysqli->query("update $konu set pdf='$pdfad' where id='$id' ");	
	}
	   
		//etiketler 
			$ebakp = explode(",",$etiket);  
				$esay =   count($ebakp)    ;
				$etsil = $mysqli->query("delete from etiket where konu=$konu && konuID='$id'  "); 
			 
				for($yy=0; $yy < $esay; $yy++){
					$etiket1  = trim($ebakp[$yy]);
					if($etiket1!=""){ 
		$etiketekle = $mysqli->query ("insert into etiket (`baslik`, `seo`, `konu`, `konuID` ) values ('$etiket1' , '$seoID' , $konu , '$id' ) ");
 
				}	
				}
		
	$eskiressay 	= count($eskiresimler);
	$esgun 			= $mysqli->query("update galeri set durum='0' where icerikID='$id' && konu='$konu' "); 
	for($dd=0; $dd < $eskiressay; $dd++){	 
	$resID			= $eskiresimler[$dd]; 
	echo $resID.'<br>';
	$esgun 			= $mysqli->query("update galeri set durum='1' where icerikID='$id' && id='$resID' && konu='$konu' "); 
		 }		 
	 
	  
    if($rtopluad[0]!=""){
			   
			for($x = 0; $x < $say; $x++){
				 
				$rbaslik	= $rtopluad[$x];
				$rkaynak	= $rtoplukaynak[$x];		 
				$rsonadi 	= $x.'-'.yeniurl(res_adi($rbaslik)).res_uzanti($rbaslik);
				 
				
	//echo $rbaslik.'<br/>';
	$vyukle = $mysqli->query("insert into galeri (icerikID, konu, baslik, resim, sira ,durum ) values('$id','$konu','$rbaslik','$rsonadi' ,  '0', '1'   ) ");
	
	$yukle 	= move_uploaded_file($rkaynak,$rhedef."/".$rsonadi);
		 // kucult($rhedef, $rsonadi);	
			}
			 
		   }
	   
	   
	 header("Location:?sy=".$konu."&katID=".$katID."&islem=basarili");	
		  
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
		
	 
    <div class="col-2  ">
    
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
	<label for="baslik" class="col-sm-2 col-form-label">Başlık * </label>
	<div class="col-sm-6">
	 <input type="text" name="baslik" class="form-control" id="baslik" placeholder="Başlık" value="<?php echo $yaz['baslik']; ?>" required >
	</div>
</div>


					
 
 	<script type="text/javascript"> 
		$(function(){
			$("select[name=ustkatID]").change(function(){
				 
				var ustkatID = $("select[name=ustkatID]").val();
				 
				$.ajax({
					url: "pages/uygulama/ukatbak.php",
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
	$ustkat 		= $yaz['ustkatID'];
	$ustkatbul 		= $mysqli->query("select * from $konu where id='$ustkat' ");
	$ustkatyaz 		= $ustkatbul->fetch_array();
	
?>
		
<!--	<div class="form-group row">
		<label for="ustkatID" class="col-sm-2 col-form-label">Üst Kategori  </label>
		<div class="col-sm-2">
		 
		  <label for="ustkatID"  > </label>
					<select class="custom-select task-manager-list-select" name="ustkatID" >
			 
					
					<option value="">Üst Kategori Yok</option>
			<?php 
				$ukat  = $mysqli->query("select * from $konu where ustkatID='0' && dil='$dil' order by sira asc ");
					while($uyaz = $ukat->fetch_array()){
						
					if($uyaz['id']==$ustkatyaz['id']){
						echo '<option value='.$uyaz['id'].' selected >'.$uyaz['baslik'].'</option>'; 
					}	 else {
						echo '<option value='.$uyaz['id'].' >'.$uyaz['baslik'].'</option>'; 
					}
						
					}
			
			?>			
					 
		 </select>
			<small id="resim" class="ul-form__text form-text "> Üst Kategorisi yoksa seçmeyiniz </small>

		 
		</div>		
		
 <?php
	$okatID 		= $yaz['katID'];
	$okatbul 		= $mysqli->query("select * from $konu where id='$okatID' ");
	$okatyaz 		= $okatbul->fetch_array();
	
?>


		<div class="col-sm-2">
		 
		  <label for="katID"  > </label>
		 
		 <select name="katID" class="custom-select task-manager-list-select" id="altkat">
		  <option value="<?php echo $okatyaz['id']; ?>"><?php echo $okatyaz['baslik']; ?></option>
		  </select>
		
		 
			<small id="resim" class="ul-form__text form-text "> Orta Kategorisi yoksa seçmeyiniz </small>
 
		</div>  
		 
	</div>
				
  
  
  
	
	 <div class="form-group row">
		<label for="baslik" class="col-sm-2 col-form-label">Renk  </label>
		<div class="col-sm-1">
		<input type="text" name="renk" maxlength="7" class="form-control jscolor" value="<?php echo $yaz['renk']; ?>">
		 
		</div>
	</div>
	-->
	
 <!-- <div class="form-group row">
		<label for="ustresim" class="col-sm-2 col-form-label"><i class="nav-icon fa fa-image"></i> Üst Resim ( 1920 * 450)  * </label>
		<div class="col-sm-3">
		  <input type="file" name="ustresim" class="form-control" id="ustresim" placeholder=" "   > 
			 	<small id="ustresim" class="ul-form__text form-text "> Yeni resim istemiyorsanız işlem yapmayınız </small>	
 
			<input type="hidden" name="gustresim"  value="<?php echo $yaz['ustresim']; ?>"   > 
		  
		</div>
	 
	 <a href="<?php echo $rhedef; ?>/<?php echo $yaz['ustresim']; ?>" target="_blank" >
	 <img src="<?php echo $rhedef; ?>/<?php echo $yaz['ustresim']; ?>" title="Büyük Resim" alt="Büyük Resim" style="background-color:#ddd; width:100px; "></a>
	 
	 
	</div> 
	
 
	
	
	<div class="form-group row">
		<label for="baslik" class="col-sm-2 col-form-label"> Üst İçerik </label> 
		<div class="col-sm-2"> 
		<select class="custom-select task-manager-list-select " name="katID" > 
		<option value=""> Ana İçerik</option> 
		<?php 
			$kbak  = $mysqli->query("select * from $konu where dil='$dil' order by sira asc ");
				while($kyaz = $kbak->fetch_array()){
					if($kyaz['id']==$yaz['katID']){
					echo '<option value="'.$kyaz['id'].'" selected >'.$kyaz['baslik'].'</option> ';	
					} else {
					echo '<option value="'.$kyaz['id'].'">'.$kyaz['baslik'].'</option> ';	
					}
					
				}
		?>
		 </select>
		</div>	 
	</div>	-->
	
	
	 <div class="form-group row">
		<label for="icon" class="col-sm-2 col-form-label">İcon  ( 32 * 32 ) </label>
		<div class="col-sm-3">
		  <input type="file" name="icon" class="form-control" id="icon" placeholder=""   > 
		  <input type="hidden" name="gicon"  value="<?php echo $yaz['icon']; ?>"   > 
		  <small id="icon" class="ul-form__text form-text "> Yeni resim istemiyorsanız işlem yapmayınız </small>	
			 				
		</div>
	<a href="<?php echo $rhedef; ?><?php echo $yaz['icon']; ?>" target="_blank" >
	<img src="<?php echo $rhedef; ?><?php echo $yaz['icon']; ?>" title="  Resim" alt=" Resim" style="background-color:#ddd; width:50px; "></a>
	</div>
   
  <div class="form-group row">
		<label for="onyazi" class="col-sm-2 col-form-label"> Ön Yazı </label>
		<div class="col-sm-10">
		<textarea name="onyazi" class="form-control" id="onyazi" cols="50" rows="2" placeholder="Ön Yazı" ><?php echo $yaz['onyazi']; ?></textarea>
			 
		</div>
	</div>   
 

	<div class="form-group row">
		<label for="icerik" class="col-sm-2 col-form-label"> İçerik  </label>
		<div class="col-sm-10">
		<textarea name="icerik" class="ckeditor" id="icerik" cols="40" rows="3"><?php echo $yaz['icerik']; ?></textarea>
	  
		</div> 
	</div>
	
	 
	  <div class="form-group row">
		<label for="kresim" class="col-sm-2 col-form-label"><i class="nav-icon fa fa-image"></i> Küçük Resim  ( 360 * 200) * </label>
		<div class="col-sm-2">
		  <input type="file" name="kresim" class="form-control" id="kresim" placeholder="Küçük Resim Boyutu"   > 
		  <input type="hidden" name="gkresim"  value="<?php echo $yaz['kresim']; ?>"   > 
		 
			 				
		</div>
	<a href="<?php echo $rhedef; ?><?php echo $yaz['kresim']; ?>" target="_blank" >
	<img src="<?php echo $rhedef; ?><?php echo $yaz['kresim']; ?>" title="Küçük Resim" alt="Küçük Resim" style="background-color:#ddd; width:50px; "></a>
	</div>
	
	
	  <div class="form-group row">
		<label for="resim" class="col-sm-2 col-form-label"><i class="nav-icon fa fa-image"></i> Resim  ( 555 * 312)*  </label>
		<div class="col-sm-3">
		  <input type="file" name="resim" class="form-control" id="resim" placeholder=""   > 
		  <small id="resim" class="ul-form__text form-text "> Yeni resim istemiyorsanız işlem yapmayınız </small>	
		  <input type="hidden" name="gresim"  value="<?php echo $yaz['resim']; ?>"   > 
		 
			 				
		</div>
	<a href="<?php echo $rhedef; ?><?php echo $yaz['resim']; ?>" target="_blank" >
	<img src="<?php echo $rhedef; ?><?php echo $yaz['resim']; ?>" title=" Resim" alt=" Resim" style="background-color:#ddd; width:50px; "></a>
	</div>
	
 
	 <hr>
	 
	<!-- <div class="form-group row">
		<label for="vlink" class="col-sm-2 col-form-label"><i class="fa fa-play"></i> Video Link </label>
		<div class="col-sm-6">
		 <input type="text" name="vlink" class="form-control" id="vlink" placeholder="Video Link" value="<?php echo $yaz['vlink']; ?>"  >
		 <small id="passwordHelpBlock" class="ul-form__text form-text "> Video Link Boş Bırakırsanız İçerikte Video Bölümü Çalışmaz </small>	
		</div>
	</div>
	
	
  <div class="form-group row">
		<label for="vresim" class="col-sm-2 col-form-label"><i class="nav-icon fa fa-image"></i> Video Resim  ( 800* 600) </label>
		<div class="col-sm-3">
		  <input type="file" name="vresim" class="form-control" id="vresim" placeholder=""   > 
		  <small id="vresim" class="ul-form__text form-text "> Yeni resim istemiyorsanız işlem yapmayınız </small>	
		  <input type="hidden" name="gvresim"  value="<?php echo $yaz['vresim']; ?>"   > 
		 
			 				
		</div>
	<a href="../uploads/<?php echo $konu; ?>/<?php echo $yaz['vresim']; ?>" target="_blank" >
	<img src="../uploads/<?php echo $konu; ?>/<?php echo $yaz['vresim']; ?>" title=" Resim" alt=" Resim" style="background-color:#ddd; width:50px; "></a>
	</div>
	 
	 
	<div class="form-group row">
		<label for="pdf" class="col-sm-2 col-form-label"> <i class="nav-icon i-Data-Upload"></i> PDF (pdf, word, excel vb.)  </label>
		<div class="col-sm-4">
		  <a href="../uploads/<?php echo $konu; ?>/<?php echo $yaz['pdf']; ?>" target="_blank" ><?php echo $yaz['pdf']; ?></a>
		  
		  <input type="file" name="pdf" class="form-control" id="pdf" placeholder=""  > 
		  <small id="vresim" class="ul-form__text form-text "> Yeni içerik istemiyorsanız işlem yapmayınız </small>	
		 	 <input type="hidden" name="gpdf"  value="<?php echo $yaz['pdf']; ?>"   > 
			  
		</div>	
		 
	</div>
	 
	<hr>  
 <div class="form-group row bg-light p-2" id="yenirsimmm">
	<label for="resim" class="col-sm-2 col-form-label"><i class="nav-icon i-Video-Photographer"></i>  Yeni Resimler Ekle </label>
	
	<div class="col-12">
	<div class="col-sm-2 float-left">
	
	<input type="file" name="rtoplu[]" multiple="multiple" class="form-control" id="resim" placeholder="Resimler"  style="float:left; " > 
	  <small id="web" class="ul-form__text form-text "> Birden fazla resim seçebilirsiniz </small>
	 </div>
		 
	 </div>
		
		<hr/>
		
	
	<?php $ressbakk = $mysqli->query("select * from galeri where konu='uygulama' && icerikID='$id' && durum='1' "); 
	
		while($ressyaz = $ressbakk->fetch_array()){
			
			echo '<div class="col-sm-2">
	   
<a href="../uploads/'.$konu.'/'.$ressyaz['resim'].'" target="_blank" >
<img src="../uploads/'.$konu.'/'.$ressyaz['resim'].'" title="Büyük Resim" alt="Büyük Resim" style="background-color:#ddd;  height:100px; "></a>
<input type="hidden" name="eskiresimler[]" value="'.$ressyaz['id'].'"> 
	<br/>
	<br/> 
	 <a class="btn btn-danger text-white btn-rounded resimsill1 " href="#"> Resmi Sil </a> 
	</div>'; 
	
		}
	
	?>	
  
	 
 </div>
  
	
	
	 <hr/> -->
	 
	<div class="form-group row">
		<label for="seourl11" class="col-sm-2 col-form-label">Seo URL * </label>
		<div class="col-sm-6">
		  <input type="text" name="seourl" class="form-control" id="seourl11" placeholder="Seo URL" value="<?php echo $seoyaz['seo']; ?>"  > 
			
 							
		</div>
		 
	</div>
		
		
	<div class="form-group row">
		<label for="keywords" class="col-sm-2 col-form-label">Keywords </label>
		<div class="col-sm-6">
		  <input type="text" name="keywords" class="form-control" id="keywords" placeholder="Keywords" value="<?php echo $yaz['keywords']; ?>" > 
			
 							
		</div>
		 
	</div>
				
	<div class="form-group row">
	<label for="description" class="col-sm-2 col-form-label">Description </label>
	<div class="col-sm-6">
	  <input type="text" name="description" class="form-control" id="description" placeholder="Description" value="<?php echo $yaz['description']; ?>" > 
		
						
		</div>
		 
	</div>
		 		
	<div class="form-group row">
	<label for="etiket" class="col-sm-2 col-form-label">Etiketler </label>
	<div class="col-sm-6">
	  <input type="text" name="etiket" class="form-control" id="etiket" placeholder="Etiketler" value="<?php $etbak = $mysqli->query("select * from etiket where konu='$konu' && konuID='$id'  ");
	while($etyaz = $etbak->fetch_array()){
		
		echo trim($etyaz['baslik']).' ,';
	}
	?>" > 
		 				
		</div>
		
		<div class="col-sm-2">
	  
		
		<small id="passwordHelpBlock" class="ul-form__text form-text "> Virgül ile ayırınız </small>				
		</div>
		 
	</div>
					
					
	<div class="form-group row">
	<label for="hit" class="col-sm-2 col-form-label">Hit </label>
	<div class="col-sm-1">
	  <input type="text" name="hit" class="form-control" id="hit" placeholder="Hit" value="<?php echo $yaz['hit']; ?>" > 
		
						
		</div>
		 
	</div>	
		
	
	<div class="form-group row">
	<label for="sira" class="col-sm-2 col-form-label">Sıra </label>
	<div class="col-sm-1">
	  <input type="text" name="sira" class="form-control" id="sira" placeholder="Sıra" value="<?php echo $yaz['sira']; ?>" > 
		
						
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
	<label for="ekleyen" class="col-sm-2 col-form-label">Ekleyen </label>
	<div class="col-sm-2">
	 <?php echo $yaz['ekleyen']; ?> 
		
						
		</div>
		 
	</div>	

<div class="form-group row">
	<label for="eklemetarih" class="col-sm-2 col-form-label">Ekleme Tarihi </label>
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
				