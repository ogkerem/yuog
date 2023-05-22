	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	 
	
	?>
	<div class="main-content">
	
   <div class="breadcrumb">
                <h1>Dil Ekleme </h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li><a href="?sy=diller">Diller</a></li>
                  
                     
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
	
	$baslik				= addslashes(trim($_POST['baslik']));
	$kodu				= addslashes(trim($_POST['kodu']));
	$para				= addslashes(trim($_POST['para']));  
	$sira				= (int)trim($_POST['sira']);  
	$durum				= 1;
	$ekleyen			= $email;  
	$ip					= $_SERVER['REMOTE_ADDR']; 
	
	
	$resimad			= $_FILES['resim']['name']; 
	$kaynak				= $_FILES['resim']['tmp_name']; 
	
	$logoad			= $_FILES['logo']['name']; 
	$logokaynak		= $_FILES['logo']['tmp_name']; 

	$resimsonad 		= rand(0,999).'-'.yeniurl(res_adi($resimad)).res_uzanti($resimad);
	$logosonad 			= rand(0,999).'-'.yeniurl(res_adi($logoad)).res_uzanti($logoad);
	// $kresimsonad 		= 'mini-'.$resimsonad;	
 
	$rhedef				= "../uploads/";
	   
	$gonder  	= $mysqli->query(" insert into diller set 
	
		baslik 				='$baslik', 
		kodu 				='$kodu', 
		para 				='$para', 
		resim				='$resimsonad', 
		logo				='$logosonad', 
		ip					='$ip', 
		tarih				= now(),
		ekleyen				= '$ekleyen', 
		sira				= '$sira',
		durum				= '$durum'  
	  
	  ");   
	  
	if($gonder){
	 
		 $yukle 		= move_uploaded_file($kaynak,$rhedef."/".$resimsonad);
		 $yukle2 		= move_uploaded_file($logokaynak,$rhedef."/".$logosonad);
		 
		 $dilID	= $mysqli->insert_id;
		   
		$dilicerikbak = $mysqli->query("select * from dilsabit ");
			while($dilsabitbak 	= $dilicerikbak->fetch_array()){ 
			$sabitID 			= $dilsabitbak['id'];
			$sabitbaslik		= $dilsabitbak['baslik'];
			$yenidilicerikle 	= $mysqli->query("insert into dilicerik (dilID,sabitID,icerik) values ('$dilID', '$sabitID','$sabitbaslik' ) ");
	
			}
	
	
		  header("Location:?sy=diller&islem=basarili");	
		  
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
		<label for="baslik" class="col-sm-2 col-form-label">Dil Adı * </label>
		<div class="col-sm-6">
		 <input type="text" name="baslik" class="form-control" id="baslik" placeholder="Dil Adı" value="" required >
		</div>
	</div>
	 	 			
	<div class="form-group row">
		<label for="kodu" class="col-sm-2 col-form-label">Kodu * </label>
		<div class="col-sm-2">
		 <input type="text" name="kodu" class="form-control" id="kodu" placeholder="Kodu" value="" required >
		</div>
	</div>
	 									
	 	 			
	<div class="form-group row">
		<label for="para" class="col-sm-2 col-form-label">Para Birimi * </label>
		<div class="col-sm-2">
		 <input type="text" name="para" class="form-control" id="para" placeholder="Para Birimi" value="" required >
		</div>
	</div>
	 									
	 	 
 <div class="form-group row">
		<label for="resim" class="col-sm-2 col-form-label">Bayrak * </label>
		<div class="col-sm-2">
		  <input type="file" name="resim" class="form-control" id="resim" placeholder="Küçük Resim Boyutu" required  > 
			 				
		</div>	
		
		<div class="col-sm-2">
		  
			 				
		</div>
	 
	</div>	 	 
	
	
 <!-- <div class="form-group row">
		<label for="logo" class="col-sm-2 col-form-label">Logo * </label>
		<div class="col-sm-2">
		  <input type="file" name="logo" class="form-control" id="logo" placeholder="Logo" required  > 
			 				
		</div>	
		
		<div class="col-sm-2">
		  
			 				
		</div>
	 
	</div> -->
  	
	
	<div class="form-group row">
	<label for="sira" class="col-sm-2 col-form-label">Sıra </label>
	<div class="col-sm-1">
	  <input type="text" name="sira" class="form-control" id="sira" placeholder="Sıra" value="" > 
		 				
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
				