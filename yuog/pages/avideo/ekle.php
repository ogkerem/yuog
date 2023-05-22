	<?php 
	 
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
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
                <h1> <a href="?sy=avideo"> Ana Sayfa Akademi </a> >  <?php echo $dilyaz['baslik']; ?>  </h1>
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
	
	$baslik				= addslashes(trim($_POST['baslik']));
	$onyazi				= addslashes(trim($_POST['onyazi']));
	$icerik				= addslashes(trim($_POST['icerik']));
	
	$bir				= addslashes(trim($_POST['bir']));
	$bira				= addslashes(trim($_POST['bira'])); 	
	$birbad				= $_FILES['birb']['name']; 
	$birbkaynak			= $_FILES['birb']['tmp_name'];	 
	$birbsonad 			= rand(0,999).'-'.yeniurl(res_adi($birbad)).res_uzanti($birbad);	
	$bird				= addslashes(trim($_POST['bird']));

	$iki				= addslashes(trim($_POST['iki']));
	$ikia				= addslashes(trim($_POST['ikia']));	
	$ikibad				= $_FILES['ikib']['name']; 
	$ikibkaynak			= $_FILES['ikib']['tmp_name'];	 
	$ikibsonad 			= rand(0,999).'-'.yeniurl(res_adi($ikibad)).res_uzanti($ikibad); 
	$ikid				= addslashes(trim($_POST['ikid']));
  
	$uc					= addslashes(trim($_POST['uc']));
	$uca				= addslashes(trim($_POST['uca']));
	$ucbad				= $_FILES['ucb']['name']; 
	$ucbkaynak			= $_FILES['ucb']['tmp_name'];	 
	$ucbsonad 			= rand(0,999).'-'.yeniurl(res_adi($ucbad)).res_uzanti($ucbad); 
	$ucd				= addslashes(trim($_POST['ucd']));
  
	$dort				= addslashes(trim($_POST['dort']));
	$dorta				= addslashes(trim($_POST['dorta']));	
	$dortbad				= $_FILES['dortb']['name']; 
	$dortbkaynak			= $_FILES['dortb']['tmp_name'];	 
	$dortbsonad 			= rand(0,999).'-'.yeniurl(res_adi($dortbad)).res_uzanti($dortbad); 
	$dortd				= addslashes(trim($_POST['dortd']));
  
	
	// $linkedin			= (trim($_POST['linkedin']));
 
	$sira				= trim($_POST['sira']); 	 
	$durum				= 1;
	$ekleyen			= $email;  
	$ip					= $_SERVER['REMOTE_ADDR']; 
	
	
	$resimad			= $_FILES['resim']['name']; 
	$kaynak				= $_FILES['resim']['tmp_name']; 
	
	$kresimad			= $_FILES['kresim']['name']; 
	$kresimkaynak		= $_FILES['kresim']['tmp_name']; 
	 
	  
	   
	$resimsonad 		= rand(0,999).'-'.yeniurl(res_adi($resimad)).res_uzanti($resimad);
	$kresimsonad		= rand(0,999).'-'.yeniurl(res_adi($kresimad)).res_uzanti($kresimad);
	  
	$rhedef				= "../uploads/avideo/";
	   
	$gonder  	= $mysqli->query(" insert into avideo set 
			 
		baslik 				='$baslik', 
		onyazi 				='$onyazi', 
		icerik 				='$icerik', 
		
		kresim				='$kresimsonad', 
		resim				='$resimsonad', 	
		
		bir					='$bir', 		
		bira				='$bira', 		
		birb				='$birbsonad', 		
		bird				='$bird', 		
		
		iki					='$iki', 		
		ikia				='$ikia', 		
		ikib				='$ikibsonad', 		
		ikid				='$ikid', 		
		
		uc					='$uc', 		
		uca					='$uca', 		
		ucb					='$ucbsonad', 		
		ucd					='$ucd', 		
		
		dort					='$dort', 		
		dorta					='$dorta', 		
		dortb					='$dortbsonad', 		
		dortd					='$dortd', 		
		
		ip					='$ip', 
		tarih				= now(),
		ekleyen				= '$ekleyen',
		sira				= '$sira',
		dil					= '$dil', 
		durum				= '$durum' 
	 
	  ");   
	   
		
	if($gonder){
		
		$icerikID	= $mysqli->insert_id;
	 
		$yukle	 		= move_uploaded_file($kresimkaynak,$rhedef."/".$kresimsonad);
		$yukle1 		= move_uploaded_file($birbkaynak,$rhedef."/".$birbsonad);
		$yukle2 		= move_uploaded_file($ikibkaynak,$rhedef."/".$ikibsonad);
		$yukle3 		= move_uploaded_file($ucbkaynak,$rhedef."/".$ucbsonad);
		$yukle4 		= move_uploaded_file($dortbkaynak,$rhedef."/".$dortbsonad);
	  
		 header("Location:?sy=avideo&islem=basarili");	
		  
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
		  
	echo '<a href="?sy=avideoekle&dil='.$dilyaz1['id'].'"><button type="button" class="btn btn-raised btn-raised-primary m-1">'.$dilyaz1['baslik'].'</button></a> ';
	
			 
		}				
						?>
			 
		</div>
	</div>	
 <!--
<div class="form-group row">
		<label for="baslik" class="col-sm-2 col-form-label">Başlık * </label>
		<div class="col-sm-6">
		 <input type="text" name="baslik" class="form-control" id="baslik" placeholder="Başlık" value="" required >
		</div>
	</div>
	
	

 <div class="form-group row">
		<label for="resim" class="col-sm-2 col-form-label">Üst Resim * ( 1920 * 450) </label>
		<div class="col-sm-2">
		 <input type="file" name="ustresim" class="form-control" id="resim" placeholder="" required  > 
			 				
		</div>	
		
		<div class="col-sm-2">
		  
			 				
		</div>
	 
	</div>  -->
 
	  
<!--
 <div class="form-group row">
		<label for="icon" class="col-sm-2 col-form-label"> Video * </label>
		<div class="col-sm-2">
		  <input type="file" name="kresim" class="form-control" id="icon" placeholder="" required  > 
			 				
		</div>	
		
		<div class="col-sm-2">
		  
			 				
		</div>
	 
	</div>
-->
<!--
	 <div class="form-group row">
		<label for="resim" class="col-sm-2 col-form-label">Sağ Resim Küçük * ( 600 * 600 ) </label>
		<div class="col-sm-2">
		  <input type="file" name="resim" class="form-control" id="resim" placeholder="Küçük Resim Boyutu" required  > 
			 				
		</div>	
		
		<div class="col-sm-2">
		  
			 				
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
	 

	
	  
	
	<hr/> -->
	
	
	 <div class="form-group row">
		<label for="bir" class="col-sm-2 col-form-label">Başlık  * </label>
		<div class="col-sm-6">
		 <input type="text" name="bir" class="form-control" id="bir" placeholder=" Başlık" value="" required > 
	 
		</div>  
<!--
		<div class="col-sm-4">
		 <input type="text" name="bird" class="form-control" id="bird" placeholder="Birinci Link" value="" required > 
	 
		</div>
-->
	</div>
	
	
<!--
  <div class="form-group row">
		<label for="birb" class="col-sm-2 col-form-label">Birinci Görsel 235*135 * </label>
		<div class="col-sm-2">
		  <input type="file" name="birb" class="form-control" id="birb" placeholder="" required  > 
			 				
		</div>	
		
		<div class="col-sm-2"> 
		  
			 				
		</div>   
	 
	</div>  
	  
	 <hr/>
	 
-->
  
	
	 <div class="form-group row">
		<label for="iki" class="col-sm-2 col-form-label">İkinci Başlık  * </label>
		<div class="col-sm-6">
		 <input type="text" name="iki" class="form-control" id="iki" placeholder="İkinci Başlık" value="" required >
		</div>	
		
		 
		 
<!--
		<div class="col-sm-4">
		 <input type="text" name="ikid" class="form-control" id="ikid" placeholder="İkinci Link" value="" required >
		</div>
-->
	</div>
			bira
		
	<div class="form-group row">
		<label for="bira" class="col-sm-2 col-form-label"> Ön Yazı </label>
		<div class="col-sm-10">
		<textarea name="bira" class="form-control" id="bira" cols="50" rows="2" placeholder="Ön Yazı" ></textarea>
			 
		</div>
	</div>   
		
		
<!--
	
	 <div class="form-group row">
		<label for="ikib" class="col-sm-2 col-form-label">İkinci Görsel 235*135 * </label>
		<div class="col-sm-2">
		  <input type="file" name="ikib" class="form-control" id="ikib" placeholder="" required  > 
			 				
		</div>	
		
		<div class="col-sm-2"> 
		  
			 				
		</div>   
	 
	</div>  
	

	 
	 <hr/>
	 -->
  
	
	 <div class="form-group row">
		<label for="uc" class="col-sm-2 col-form-label">Link Açıklama / Link * </label>
		<div class="col-sm-3">
		 <input type="text" name="uc" class="form-control" id="uc" placeholder="Link Açıklama" value="" required >
		</div>
		
		<div class="col-sm-4">
		 <input type="text" name="ucd" class="form-control" id="ucd" placeholder=" Link" value="" required >
		</div>
	</div>
	
	
<!--
		 <div class="form-group row">
		<label for="ucb" class="col-sm-2 col-form-label">Üçüncü Görsel 235*135 * </label>
		<div class="col-sm-2">
		  <input type="file" name="ucb" class="form-control" id="ucb" placeholder="" required  > 
			 				
		</div>	
		
		<div class="col-sm-2"> 
		  
			 				
		</div>   
	 
	</div>  
	
	
	 <hr/>
	 
-->
   
<!--
	
	 <div class="form-group row">
		<label for="dort" class="col-sm-2 col-form-label">Dördüncü Başlık / Link * </label>
		<div class="col-sm-3">
		 <input type="text" name="dort" class="form-control" id="dort" placeholder="Dördüncü Başlık" value="" required >
		</div>
		
		<div class="col-sm-4">
		 <input type="text" name="dortd" class="form-control" id="dortd" placeholder="Dördüncü Link" value="" required >
		</div>
	</div>
	
	
		 <div class="form-group row">
		<label for="dortb" class="col-sm-2 col-form-label">Dördüncü Görsel 235*135 * </label>
		<div class="col-sm-2">
		  <input type="file" name="dortb" class="form-control" id="dortb" placeholder="" required  > 
			 				
		</div>	
		
		<div class="col-sm-2"> 
		  
			 				
		</div>   
	 
	</div>  

	
	 <hr/>
	  	-->
		
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
				