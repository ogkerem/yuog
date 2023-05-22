	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	 
	
	?>
	<div class="main-content">
	
   <div class="breadcrumb">
                <h1>Turlar Kategori Ekleme</h1>
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
	$sira				= trim($_POST['sira']); 
	$hit				= 1;
	$durum				= 1;
	$ekleyen			= $email; 
	
	$ip					= $_SERVER['REMOTE_ADDR']; 
	
	
	$resimad			= $_FILES['resim']['name']; 
	$kaynak				= $_FILES['resim']['tmp_name']; 

	$resimsonad 		= rand(0,999).'-'.yeniurl(res_adi($resimad)).res_uzanti($resimad);
	$kresimsonad 		= 'mini-'.$resimsonad;	
	  
	$rhedef				= "../uploads/tur/";
	 
	$yeniurlmiz =  $_POST['seourl'];
	
	$seosor		= $mysqli->query("select * from seo where seo='$yeniurlmiz' ");
	$seoyazz	= $seosor->fetch_array(); 
	$seosay 	= $seosor->num_rows;
		  
	if($seosay>0){
		$sonurl = rand(0,100).'-'.$yeniurlmiz;
	} else { 
		$sonurl = $yeniurlmiz;
	}
	
	$seoekle 		= $mysqli->query("insert into seo (seo,konu, durum) values ('$sonurl', 'turkat', '$durum')");	
	$seoID			= $mysqli->insert_id;
	   
	$gonder  	= $mysqli->query(" insert into turkat set 
	 baslik 				='$baslik', 
	 ustkatID 				='$ustkatID', 
	 katID 					='$katID', 
	 onyazi 				='$onyazi', 
	 icerik 				='$icerik', 
	 keywords 				='$keywords', 
	 description			='$description', 
	 kresim					='$kresimsonad', 
	 resim					='$resimsonad', 
	 ip						='$ip', 
	 tarih					= now(),
	 ekleyen				= '$ekleyen',
	 seo					= '$seoID',
	 hit					= '$hit',
	 sira					= '$sira',
	 durum					= '$durum'  
	 
	  ");   
	  
	if($gonder){
		
		$yukle 		= move_uploaded_file($kaynak,$rhedef."/".$resimsonad);
			
			kucult($rhedef, $resimsonad);
		 		
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
		 <input type="text" name="baslik" class="form-control" id="baslik" placeholder="Başlık" value="<?php echo $baslik; ?>" required >
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

		
	<div class="form-group row">
		<label for="ustkatID" class="col-sm-2 col-form-label">Üst Kategori  </label>
		<div class="col-sm-3">
		 
		  <label for="ustkatID"  > </label>
					<select class="form-control" name="ustkatID" >
						<option value="" >Üst Kategori Yok</option>
			<?php 
				$ukat  = $mysqli->query("select * from turkat where katID='0' && ustkatID='0' order by sira asc ");
					while($uyaz = $ukat->fetch_array()){
						
						echo '<option value='.$uyaz['id'].' >'.$uyaz['baslik'].'</option>'; 
					}
			
			?>			
					 
		 </select>
			<small id="resim" class="ul-form__text form-text "> Üst Kategorisi yoksa seçmeyiniz </small>

		

			
		</div>		
		
		<div class="col-sm-3">
		 
		  <label for="katID"  > </label>
		 
		 <select name="katID" class="form-control" id="altkat"></select>
		 
			<small id="resim" class="ul-form__text form-text "> Orta Kategorisi yoksa seçmeyiniz </small>

		

			
		</div>
		 
	</div>
							
 
 <div class="form-group row">
		<label for="onyazi" class="col-sm-2 col-form-label"> Ön Yazı </label>
		<div class="col-sm-10">
		<textarea name="onyazi" id="onyazi" cols="50" rows="4"><?php echo $onyazi; ?></textarea>
			 
		</div>
	</div>
	
 
	<div class="form-group row">
		<label for="icerik" class="col-sm-2 col-form-label"> Açıklama </label>
		<div class="col-sm-10">
		<textarea name="icerik" class="ckeditor" id="icerik" cols="40" rows="3"><?php echo $icerik; ?></textarea>
	 
   
		</div> 
	</div>
	
	
		
 <div class="form-group row">
		<label for="resim" class="col-sm-2 col-form-label">Resim * </label>
		<div class="col-sm-2">
		  <input type="file" name="resim" class="form-control" id="resim" placeholder="Küçük Resim Boyutu"   > 
			 				
		</div>
	 
	</div>
	
	
	<hr>
		
	<div class="form-group row">
		<label for="seourl" class="col-sm-2 col-form-label">Seo URL * </label>
		<div class="col-sm-6">
		  <input type="text" name="seourl" class="form-control" id="seourl" placeholder="Seo URL" value="<?php echo $seourl; ?>"  > 
			
 							
		</div>
		 
	</div>
			
		<div class="form-group row">
		<label for="keywords" class="col-sm-2 col-form-label">Keywords </label>
		<div class="col-sm-10">
		  <input type="text" name="keywords" class="form-control" id="keywords" placeholder="Keywords" value="<?php echo $keywords; ?>" > 
			
 							
		</div>
		 
	</div>
				
	<div class="form-group row">
	<label for="description" class="col-sm-2 col-form-label">Description </label>
	<div class="col-sm-10">
	  <input type="text" name="description" class="form-control" id="description" placeholder="Description" value="<?php echo $description; ?>" > 
		
						
		</div>
		 
	</div>
					
	<div class="form-group row">
	<label for="sira" class="col-sm-2 col-form-label">Sıra </label>
	<div class="col-sm-2">
	  <input type="text" name="sira" class="form-control" id="sira" placeholder="Sıra" value="<?php echo $sira; ?>" > 
		
						
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
				