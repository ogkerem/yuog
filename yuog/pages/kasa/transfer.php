	<?php 
	 
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
	$konu 		= "kasa";
	$kategori 	= $konu."kat";
	 
	 
	//  $birsay = $mysqli->query("select * from adminyetki where adminID='$adminID' && bolumID='1' ")->num_rows;  
	// if($birsay==0){
	// 	echo 'No direct script access allowed / Yetkisiz Erişim '; 
		
	// 	exit();
	// } 
	
	 
	 
	?>
	<div class="main-content">
	
   <div class="breadcrumb">
                <h1><a href="?sy=kasa"> Kasa </a> > İç Transfer  </h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li> Transfer İşlemi </li>
                  
                     
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
	
	$kasaID				=  $_POST['kasaID'];
	$kasaID1			=  $_POST['kasaID1'];
	
	if($kasaID==$kasaID1){
		echo '<div class="alert alert-danger" role="alert">
				<strong class="text-capitalize">Hata!</strong>Hata Aynı Kasa Olamaz  
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div> <br /> <a href="javascript:history.back(-1)">Geri Dön</a>';
	} else { 
		
	$fiyat				=  $_POST['fiyat'];
	$parabirimi			=  $_POST['parabirimi'];
	$tarih				=  $_POST['tarih'];
	
	$kasabak 			= $mysqli->query("select * from kasacesit where id='$kasaID' ")->fetch_array();
	
	$kasabak1 			= $mysqli->query("select * from kasacesit where id='$kasaID1' ")->fetch_array(); 
	 
	$aciklama			= addslashes(trim($_POST['aciklama'])).'('.$kasabak['baslik'].'=>'.$kasabak1['baslik'].')';
  
	$ekleyen			= $email;  
	$ip					= $_SERVER['REMOTE_ADDR']; 
	 
	$gonder   	= $mysqli->query(" insert into kasa set 
	  
		giris 				='$fiyat', 
		parabirimi			='$parabirimi', 
		kasaID				='$kasaID1',  
		aciklama			='$aciklama', 
		   
		ip					='$ip', 
		itarih				= now(),
		tarih				= '$tarih',
		ekleyen				= '$ekleyen' 
		 
	 
	  ");   
	   
	$gonder1  	= $mysqli->query(" insert into kasa set 
	  
		cikis 				='$fiyat', 
		parabirimi			='$parabirimi', 
		kasaID				='$kasaID', 
	  
		aciklama			='$aciklama', 
		   
		ip					='$ip', 
		itarih				= now(),
		tarih				= '$tarih',
		ekleyen				= '$ekleyen' 
		 
	 
	  ");   
	  
	if($gonder1){
		
		// $stokID	= $mysqli->insert_id;
	 
 
		 header("Location:?sy=kasa&islem=basarili");	
		   
	} else { echo '<div class="alert alert-danger" role="alert">
				<strong class="text-capitalize">Hata!</strong>Hata İşlem Başarısız :(  
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div> <br /> <a href="javascript:history.back(-1)">Geri Dön</a>'; }   	   
	 
} 
} 

else { 
?>	

  
	<form action="" method="post" enctype="multipart/form-data" >
	

 
	
<div class="form-group row">
		<label for="aciklama" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Açıklama * </label>
		<div class="col-sm-6">
		 <input type="text" name="aciklama" class="form-control" id="aciklama" placeholder="Açıklama" value="" required >
		</div>
	</div>
	
 
  
	<div class="form-group row">
		<label for="fiyat" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Meblağ * </label>
		<div class="col-sm-1">
	  <input type="text" name="fiyat" class="form-control" id="fiyat" placeholder="Meblağ" value="" required aria-describedby="validationTooltipUsernamePrepend" >  
		 
		</div> 
		
		<div class="input-group-prepend"> 
				<select class="custom-select task-manager-list-select" name="parabirimi" required >
					 
			<?php 
				$ukat  = $mysqli->query("select * from parabirimi order by sira asc ");
					while($uyaz = $ukat->fetch_array()){
					if($urunbak['parabirimi']==$uyaz['id']){
						echo '<option value='.$uyaz['id'].' selected  >'.$uyaz['baslik'].'</option>'; 
					} else {
						echo '<option value='.$uyaz['id'].' >'.$uyaz['baslik'].'</option>'; 
					}
						
					}
			
			?>			
					 
		 </select> 
		</div> 
	</div>  
	 
 
  
	<div class="form-group row">
		<label for="kasaID" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Kimden / Kime * </label>
		  
		<div class="col-sm-2" id="kasaID" > 
				<select class="custom-select task-manager-list-select" name="kasaID" required >
					 
			<?php 
				$ukat  = $mysqli->query("select * from kasacesit order by sira asc ");
					while($uyaz = $ukat->fetch_array()){
				 
						echo '<option value='.$uyaz['id'].' >'.$uyaz['baslik'].'</option>'; 
					 
						
					}
			
			?>			
					 
		 </select> 
		</div>   
		/
		<div class="col-sm-2" id="kasaID1" > 
				<select class="custom-select task-manager-list-select" name="kasaID1" required >
					 
			<?php 
				$ukat  = $mysqli->query("select * from kasacesit order by sira asc ");
					while($uyaz = $ukat->fetch_array()){
				 
						echo '<option value='.$uyaz['id'].' >'.$uyaz['baslik'].'</option>'; 
					 
						
					}
			
			?>			
					 
		 </select> 
		</div> 
	</div>  
	 
 
 
   	<div class="form-group row">
		<label for="tarih" class="col-sm-2 col-form-label">Tarih * </label>
		<div class="col-sm-2">
		 <input type="date" name="tarih" max="31.12.2050" class="form-control " id="tarih"   value="<?php echo date('Y-m-d'); ?>" required >
		</div>	 
	 </div>
	  
	<div class="form-group row">
	<label for="sira" class="col-sm-2 col-form-label">  </label>
		<div class="col-sm-10">
			<button type="submit" class="btn btn-primary ul-btn__text">Transfer Yap</button>
		 
		</div>
	</div>
	
		</form>

			<?php } ?>
				</div>
			</div>
		</div>
	</div>            
</div> 
				