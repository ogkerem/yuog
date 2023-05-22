	<?php 
	 
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
	$konu 		= "carikasa"; 
	  
	 $birsay = $mysqli->query("select * from adminyetki where adminID='$adminID' && bolumID='3' ")->num_rows;  
	if($birsay==0){
		echo 'No direct script access allowed / Yetkisiz Erişim ';  
		exit();
	} 
	
	$id 		= $_GET['id'];
	$yaz 		= $mysqli->query("select * from carikasa where id='$id' ")->fetch_array();
	$kalan		= $yaz['alacak']-$yaz['alinan'];
	$cariID 	= $yaz['cariID'];
    $carihizmetID = $yaz['carihizmetID']; 
    $chizmet    = $mysqli->query("select * from carihizmet where id='$carihizmetID' ")->fetch_array();
     
	$caribul 	= $mysqli->query("select * from  carifirma where id='$cariID' ")->fetch_array();
	$hizmetID 	= $yaz['hizmetID'];
	$hizmet	 	= $mysqli->query("select * from hizmet where id='$hizmetID' ")->fetch_array();
	$parabirimi	= $yaz['parabirimi'];
	$pbirimiyaz	= $mysqli->query("select * from parabirimi where id='$parabirimi' ")->fetch_array();
	 
/*	$kalanhesap		= $mysqli->query("select sum(alinan) as kaldi from carikasa where carihizmetID='$id' && parabirimi='$parabirimi' ")->fetch_array();		 
	$kalann 		= $kalanhesap['kaldi'];	
	 
	  $sonuc1 		= intval($cariheap - $kalann); */
	$sonuc 			=  intval($kalan); 
		
	
    function noktaa($gelen){
        $giden  = str_replace(".","",$gelen);
        return $giden; 
    }

	?>
   
	<div class="main-content">
	
   <div class="breadcrumb">
    <h1><a href="?sy=cari"> Cariler </a> > <a href="?sy=cariayrinti&id=<?php echo $caribul['id']; ?>" target="_blank"> <?php echo $caribul['firma']; ?></a> > Ödeme Al </h1>
        <ul>
            <li><a href="index.php">Ana Sayfa</a></li>
            <li> Ödeme Alma </li> 
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
	 
	$fiyat				=  $yaz['alinan'] + noktaa(trim($_POST['fiyat'])); 
	$tarih				=  $_POST['tarih'];
	$kasaID				=  $_POST['kasaID'];
	
	$resimad			= rand(0,999999).'-'.$_FILES['resim']['name']; 
	$kaynak				= $_FILES['resim']['tmp_name']; 
	$rhedef				= "uploads/";
	
	$aciklama1			= addslashes(trim($_POST['aciklama']));
    
    $aciklama           = strip_tags($yaz['aciklama']).' '.$aciklama1.' - '.$chizmet['baslik'];

	$ekleyen			= $email;  
	$ip					= $_SERVER['REMOTE_ADDR']; 
	  
	$gonder  	= $mysqli->query(" update carikasa set 
	  
		  
		alinan				='$fiyat', 
		parabirimi			='$parabirimi', 
		kasaID				='$kasaID',  
	  
		aciklama			='$aciklama', 
		resim				='$resimad', 
		    
		itarih				= now() 
		 
        where id='$id' 
	 
	  ");   
		    
	if($gonder){
		
		$islemID	= $mysqli->insert_id;
		
		$gonder  	= $mysqli->query(" insert into kasa set 
	  
		 
		firmaID				='$id', 
		islemID				='$islemID', 
		giris				='$fiyat', 
		parabirimi			='$parabirimi', 
		kasaID				='$kasaID', 
		  
	  
		aciklama			='$aciklama', 
		resim				='$resimad', 
		   
		ip					='$ip', 
		itarih				= now(),
		tarih				= '$tarih',
		ekleyen				= '$ekleyen' 
		 
	 
	  ");   
	  
	  
		
		$yukle 			= move_uploaded_file($kaynak,$rhedef."/".$resimad);
 
		    header("Location:?sy=cariayrintilar&id=".$carihizmetID."&islem=basarili");	
		   
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
		 <input type="text" name="aciklama" class="form-control" id="aciklama" placeholder="Açıklama" value="<?php echo $hizmet['baslik']; ?> Ödemesi" required >
		</div>
	</div>
	 
	<div class="form-group row">
		<label for="fiyat" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Ödeme Miktarı * </label>
		<div class="col-sm-1">
	  <input type="text" name="fiyat" class="form-control" id="fiyat" placeholder="Meblağ" value="<?php echo $sonuc; ?>" required   >  
		 
		</div> 
		
		<div class="input-group-append">
						<span class="input-group-text"><?php echo $pbirimiyaz['simge']; ?></span>
					</div>
		</div>  
	 							
	  
	<div class="form-group row">
		<label for="kasaID" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Kasa Seçin * </label>
		  
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
	</div>  
	 
 
  <div class="form-group row">
		<label for="resim" class="col-sm-2 col-form-label"><i class="nav-icon fa fa-image"></i> Dosya veya Resim Ekleyin </label>
		<div class="col-sm-2">
		  <input type="file" name="resim" class="form-control" id="resim" placeholder="Küçük Resim Boyutu"    > 
			 				
		</div>	
		
		<div class="col-sm-2">
		  
			 				
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
			<button type="submit" class="btn btn-primary ul-btn__text"> Ödeme Al </button>
		 
		</div>
	</div>
	
		</form>

			<?php } ?>
				</div>
			</div>
		</div>
	</div>            
</div> 
				