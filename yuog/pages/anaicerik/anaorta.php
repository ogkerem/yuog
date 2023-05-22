	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
	   
	$icerikyaz1 = $mysqli->query("select * from anasayfaorta order by id desc limit 1  ");
	$yaz		= $icerikyaz1->fetch_array();
	$id 		= $yaz['id'];
 
	?>
	<div class="main-content">
	
   <div class="breadcrumb">
                <h1> Ana Sayfa Orta Bölüm </h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li> Ana sayfa içerikleri </li>
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
                   
                    
                    <div class="card mb-5">
                        <div class="card-body">
						
						<?php 
if($_POST){ 
	
	$baslik				= addslashes(trim($_POST['baslik']));
	$icerik				= addslashes(trim($_POST['icerik']));
  
	$rhedef				= "../uploads/anaban/";
	$resimad			= $_FILES['resim']['name']; 
	$kresimad			= $_FILES['kresim']['name'];  
	  
  
	$gonder  	= $mysqli->query(" update anasayfaorta set 
	
		 
		baslik 				='$baslik', 
		 
		icerik 				='$icerik' 
		
		where id='$id'
	  ");   
	  
	if($gonder){
		
		
	//resimler 
		if($resimad!=""){ 	 
		
		unlink($rhedef.$gresim);	
		$kaynak		= $_FILES['resim']['tmp_name'];
		$resimsonad = rand(0,999).'-'.yeniurl(res_adi($resimad)).res_uzanti($resimad);
		$yukle 		= move_uploaded_file($kaynak,$rhedef."/".$resimsonad); 
		$guncelle 	= $mysqli->query("update anasayfaorta set resim='$resimsonad' where id='$id' ");
	}
	 
		 
	  header("Location:?sy=anaorta&islem=basarili");	
		  
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
		<div class="col-sm-6">
		 <input type="text" name="baslik" class="form-control" id="baslik" placeholder="Başlık" value="<?php echo $yaz['baslik']; ?>" required >
		</div>
	</div>
	 		

	 
 <div class="form-group row">
		<label for="resim" class="col-sm-2 col-form-label">Resim * </label>
		<div class="col-sm-2">
		  <input type="file" name="resim" class="form-control" id="resim" placeholder="Küçük Resim Boyutu"   > 
			 	<small id="resim" class="ul-form__text form-text "> Yeni resim istemiyorsanız işlem yapmayınız </small>	
 
			<input type="hidden" name="gresim"  value="<?php echo $yaz['resim']; ?>"   > 
		  
		</div>
	 
	 <a href="../uploads/<?php echo $yaz['resim']; ?>" target="_blank" >
	 <img src="../uploads/<?php echo $yaz['resim']; ?>" title="Büyük Resim" alt="Büyük Resim" style="background-color:#ddd; width:100px; "></a>
	 
	 
	</div>
	
	
	<div class="form-group row">
		<label for="icerik" class="col-sm-2 col-form-label"> İçerik  </label>
		<div class="col-sm-10">
		<textarea name="icerik" class="ckeditor" id="icerik" cols="40" rows="3"><?php echo $yaz['icerik']; ?></textarea>
	  
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
            <div class="border-top mb-5"></div>

 

                </div> 
				