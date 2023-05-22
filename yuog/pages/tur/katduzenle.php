	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
	$id 	= $_GET['id'];
	$bak	= $mysqli->query("select * from turkat where id='$id' ");
	$yaz 	= $bak->fetch_array();
	
	$seoID 	=  $yaz['seo'];
	$sbak 	= $mysqli->query("select * from seo where id='$seoID' ");
	$seobul	= $sbak->fetch_array();
	
	?>
	<div class="main-content">
	
   <div class="breadcrumb">
                <h1>Turlar Kategori Düzenleme </h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li><a href="?sy=turlar">Turlar</a></li>
                    <li><a href="?sy=turkat">Kategoriler</a></li>
                     
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
	$ustkatID			=  $_POST['ustkatID'];
	$katID				=  $_POST['katID'];
	$onyazi				= addslashes(trim($_POST['onyazi']));
	$icerik				= addslashes($_POST['icerik']);
	$keywords			= addslashes($_POST['keywords']); 
	$description		= addslashes($_POST['description']); 
	$hit				= trim($_POST['hit']); 
	$sira				= trim($_POST['sira']); 
	$durum1				= $_POST['durum']; 
	 
	if($durum1=="on"){ $durum = 1; } else { $durum = 0; }
	$gkresim			= $_POST['gkresim']; 
	$gresim				= $_POST['gresim']; 
	     
	$resimad			= $_FILES['resim']['name'];  
	$kresimad			= $_FILES['kresim']['name'];  
	$rhedef				= "../uploads/tur/";

	if($resimad!=""){ 	 
		
		unlink($rhedef.$gresim);	
		$kaynak		= $_FILES['resim']['tmp_name'];
		$resimsonad = rand(0,999).'-'.yeniurl(res_adi($resimad)).res_uzanti($resimad);
		$yukle 		= move_uploaded_file($kaynak,$rhedef."/".$resimsonad); 
		$guncelle 	= $mysqli->query("update turkat set resim='$resimsonad' where id='$id' ");
		
	}
	 
	if($kresimad!=""){ 	 
		
		unlink($rhedef.$gkresim);		
		$kaynak1		= $_FILES['kresim']['tmp_name'];
		$resimsonad1 	= rand(0,999).'-'.yeniurl(res_adi($kresimad)).res_uzanti($kresimad);
		$yukle 			= move_uploaded_file($kaynak1,$rhedef."/".$resimsonad1); 
		$guncelle 		= $mysqli->query("update turkat set kresim='$resimsonad1' where id='$id' ");
		
	}
	 
	$yeniurlmiz 		=  $_POST['seourl']; 
	
	$seosor		= $mysqli->query("select * from seo where seo='$yeniurlmiz' && id!='$seoID' ");
	$seoyazz	= $seosor->fetch_array(); 
	$seosay 	= $seosor->num_rows;
		 
	if($seosay>0){
		$sonurl = rand(0,100).'-'.$yeniurlmiz;
	} else { 
		$sonurl = $yeniurlmiz;
	}
	
	$seoguncelle = $mysqli->query("update seo set seo='$sonurl', durum='$durum' where id='$seoID' ");
	
  
	$gonder = $mysqli->query("update turkat set baslik='$baslik', katID='$katID',ustkatID='$ustkatID', onyazi='$onyazi',icerik='$icerik', keywords= '$keywords', description='$description' , hit='$hit' , sira='$sira', durum='$durum' where id='$id' "); 
	  
	if($gonder){
		 
	 header("Location:?sy=turkat&islem=basarili");	
		  
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
		<label for="baslik" class="col-sm-2 col-form-label">Başlık * </label>
		<div class="col-sm-10">
		 <input type="text" name="baslik" class="form-control" id="baslik" placeholder="Başlık" value="<?php echo $yaz['baslik']; ?>" required >
		</div>
	</div>
							
 
 	<script type="text/javascript"> 
		$(function(){
			$("select[name=ustkatID]").change(function(){
				 
				var ustkatID = $("select[name=ustkatID]").val();
				 
				$.ajax({
					url: "pages/tur/ukatbak.php",
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
	$ustkatbul 		= $mysqli->query("select * from turkat where id='$ustkat' ");
	$ustkatyaz 		= $ustkatbul->fetch_array();
	
?>
		
	<div class="form-group row">
		<label for="ustkatID" class="col-sm-2 col-form-label">Üst Kategori  </label>
		<div class="col-sm-3">
		 
		  <label for="ustkatID"  > </label>
					<select class="form-control" name="ustkatID" >
			 
					
					<option value="">Üst Kategori Yok</option>
			<?php 
				$ukat  = $mysqli->query("select * from turkat where katID='0' && ustkatID='0' order by sira asc ");
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
	$okatbul 		= $mysqli->query("select * from turkat where id='$okatID' ");
	$okatyaz 		= $okatbul->fetch_array();
	
?>


		<div class="col-sm-3">
		 
		  <label for="katID"  > </label>
		 
		 <select name="katID" class="form-control" id="altkat">
		  <option value="<?php echo $okatyaz['id']; ?>"><?php echo $okatyaz['baslik']; ?></option>
		  </select>
		
		 
			<small id="resim" class="ul-form__text form-text "> Orta Kategorisi yoksa seçmeyiniz </small>
 
		</div>
		 
	</div>
				
  
	
 <div class="form-group row">
		<label for="onyazi" class="col-sm-2 col-form-label"> Ön Yazı </label>
		<div class="col-sm-10">
		<textarea name="onyazi" id="onyazi" cols="50" rows="4"><?php echo $yaz['onyazi']; ?>  </textarea>
			 
		</div>
	</div>
	 
	<div class="form-group row">
		<label for="icerik" class="col-sm-2 col-form-label"> Açıklama </label>
		<div class="col-sm-10">
		<textarea name="icerik" class="ckeditor" id="icerik" cols="40" rows="3"><?php echo $yaz['icerik']; ?></textarea>
	 
   
		</div> 
	</div>
	
	
	 <div class="form-group row">
		<label for="kresim" class="col-sm-2 col-form-label">Küçük Resim * </label>
		<div class="col-sm-2">
		  <input type="file" name="kresim" class="form-control" id="kresim" placeholder="Küçük Resim Boyutu"   > 
		  <input type="hidden" name="gkresim"  value="<?php echo $yaz['kresim']; ?>"   > 
		  <input type="hidden" name="gresim"  value="<?php echo $yaz['resim']; ?>"   > 
			 				
		</div>
	<a href="../uploads/tur/<?php echo $yaz['kresim']; ?>" target="_blank" >
	<img src="../uploads/tur/<?php echo $yaz['kresim']; ?>" title="Küçük Resim" alt="Küçük Resim" style="background-color:#ddd; width:50px; "></a>
	</div>
	
	 
 <div class="form-group row">
		<label for="resim" class="col-sm-2 col-form-label">Resim * </label>
		<div class="col-sm-2">
		  <input type="file" name="resim" class="form-control" id="resim" placeholder="Küçük Resim Boyutu"   > 
			 	<small id="resim" class="ul-form__text form-text "> Yeni resim istemiyorsanız işlem yapmayınız </small>			
		</div>
	 
	 <a href="../uploads/tur/<?php echo $yaz['resim']; ?>" target="_blank" >
	 <img src="../uploads/tur/<?php echo $yaz['resim']; ?>" title="Büyük Resim" alt="Büyük Resim" style="background-color:#ddd; width:100px; "></a>
	 
	
	 
	</div>
	  
	<hr>
		
	<div class="form-group row">
		<label for="seourl" class="col-sm-2 col-form-label">Seo URL * </label>
		<div class="col-sm-6">
	 <input type="text" name="seourl" class="form-control" id="seourl" placeholder="Seo URL" value="<?php echo $seobul['seo']; ?>"  > 
			 				
		</div>
		 
	</div>
			
		<div class="form-group row">
		<label for="keywords" class="col-sm-2 col-form-label">Keywords </label>
		<div class="col-sm-10">
		  <input type="text" name="keywords" class="form-control" id="keywords" placeholder="Keywords" value="<?php echo $yaz['keywords']; ?>" > 
			
 							
		</div>
		 
	</div>
				
	<div class="form-group row">
	<label for="description" class="col-sm-2 col-form-label">Description </label>
	<div class="col-sm-10">
	  <input type="text" name="description" class="form-control" id="description" placeholder="Description" value="<?php echo $yaz['description']; ?>" > 
		
						
		</div>
		 
	</div>
					
	<div class="form-group row">
	<label for="hit" class="col-sm-2 col-form-label">Hit </label>
	<div class="col-sm-2">
	  <input type="text" name="hit" class="form-control" id="hit" placeholder="Sıra" value="<?php echo $yaz['hit']; ?>" > 
		
						
		</div>
		 
	</div>
							
 
							
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
			<button type="submit" class="btn btn-primary ul-btn__text">Güncelle</button>
		 
		</div>
	</div>
	
</form>

<?php } ?>
		</div>
	</div>
</div>
</div>
            
  </div> 
 
				