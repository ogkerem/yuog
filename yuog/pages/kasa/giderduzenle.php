	<?php 
	 
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
	$konu 		= "kasa";
	$kategori 	= $konu."kat";
	 
	 
	 $birsay = $mysqli->query("select * from adminyetki where adminID='$adminID' && bolumID='1' ")->num_rows;  
	if($birsay==0){
		echo 'No direct script access allowed / Yetkisiz Erişim '; 
		
		exit();
	} 
	
	$id 	= $_GET['id'];
	$yaz 	= $mysqli->query("select * from kasa where id='$id' ")->fetch_array(); 
	 
	?>
	<div class="main-content">
	
   <div class="breadcrumb">
                <h1><a href="?sy=kasa"> Kasa </a> > Gider Düzenle  </h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li> Gider Düzenle </li>
                  
                     
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
	
	 
	$fiyat				=  $_POST['fiyat'];
	$parabirimi			=  $_POST['parabirimi'];
	$tarih				=  $_POST['tarih'];
	$kasaID				=  $_POST['kasaID'];
	 
	$aciklama			= addslashes(trim($_POST['aciklama']));
 
	
	$resimad			= rand(0,999999).'-'.$_FILES['resim']['name']; 
	$kaynak				= $_FILES['resim']['tmp_name']; 
	$rhedef				= "uploads/";

	
	$gonder  	= $mysqli->query(" update kasa set 
	 
		 
		 
		cikis 				='$fiyat', 
		parabirimi			='$parabirimi', 
		kasaID				='$kasaID', 
	  
		aciklama			='$aciklama',  
		tarih				= '$tarih' 
	 
		 
		where id='$id'
	  ");   
	  
	if($gonder){
		
		// $stokID	= $mysqli->insert_id;
	 	if($_FILES['resim']['name']!=""){ 	 
		 
		$yukle 		= move_uploaded_file($kaynak,$rhedef."/".$resimad); 
		$guncelle 	= $mysqli->query("update $konu set resim='$resimad' where id='$id' ");
	}
	
 
		 header("Location:?sy=kasa&islem=basarili");	
		   
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
		<label for="aciklama" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Açıklama * </label>
		<div class="col-sm-6">
		 <input type="text" name="aciklama" class="form-control" id="aciklama" placeholder="Açıklama" value="<?php echo $yaz['aciklama']; ?>" required >
		</div>
	</div>
	
 
  
<div class="form-group row">
		<label for="fiyat" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Gider Miktarı * </label>
		<div class="col-sm-1">
	  <input type="text" name="fiyat" class="form-control" id="fiyat" placeholder="Meblağ" value="<?php echo $yaz['cikis']; ?>" required aria-describedby="validationTooltipUsernamePrepend" >  
		 
		</div> 
		
			<div class="input-group-prepend"> 
				<select class="custom-select task-manager-list-select" name="parabirimi" required >
					 
			<?php 
				$ukat  = $mysqli->query("select * from parabirimi order by sira asc ");
					while($uyaz = $ukat->fetch_array()){
					
					if($yaz['parabirimi']==$uyaz['id']){
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
		<label for="kasaID" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Kasa Seçin * </label>
		  
		<div class="col-sm-2" id="kasaID" > 
				<select class="custom-select task-manager-list-select" name="kasaID" required >
					 
			<?php 
				$ukat  = $mysqli->query("select * from kasacesit order by sira asc ");
					while($uyaz = $ukat->fetch_array()){
					if($yaz['kasaID']==$uyaz['id']){
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
		<label for="resim" class="col-sm-2 col-form-label"><i class="nav-icon fa fa-image"></i> Dosya veya Resim Ekleyin   </label>
		<div class="col-sm-3">
		  <input type="file" name="resim" class="form-control" id="resim" placeholder=""   > 
		  <small id="resim" class="ul-form__text form-text "> Yeni resim veya dosya istemiyorsanız işlem yapmayınız </small>	
		  <input type="hidden" name="gresim"  value="<?php echo $yaz['resim']; ?>"   > 
		 
			 				
		</div>
	<a href="uploads/<?php echo $yaz['resim']; ?>" target="_blank" ><?php echo $yaz['resim']; ?> </a>
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
			<button type="submit" class="btn btn-primary ul-btn__text">Gider Düzenle</button>
		 
		</div>
	</div>
	
		</form>

			<?php } ?>
				</div>
			</div>
		</div>
	</div>            
</div> 
				