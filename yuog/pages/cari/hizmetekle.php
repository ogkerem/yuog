	<?php 
	 
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	 
	$cariID		= $_GET['cariID'];
	$cariyaz	= $mysqli->query("select * from carifirma where id='$cariID' ")->fetch_array();
	
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
                <h1><a href="?sy=cariayrinti&id=<?php echo $cariID; ?>"> <?php echo $cariyaz['firma']; ?></a> > <?php echo $dilyaz['baslik']; ?>  </h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li> İçerik Ekleme </li>
                  
                     
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
	 
	$baslik				=  $_POST['baslik'];
	$fiyat				=  $_POST['fiyat'];
	$hizmetID			=  $_POST['hizmetID']; 
	$termin				=  $_POST['termin']; 
	$baslangic			=  $_POST['baslangic']; 
	$parabirimi			=  $_POST['parabirimi']; 
	$yenileme			=  $_POST['yenileme']; 
	$onyazi				=  addslashes($_POST['onyazi']); 
	 
	$sira				= trim($_POST['sira']); 
	 
	$durum				= 1;
	$ekleyen			= $email;  
	$ip					= $_SERVER['REMOTE_ADDR']; 
	 
	$gonder  	= $mysqli->query(" insert into carihizmet set 
	
	 
		baslik 				='$baslik', 
		cariID 				='$cariID', 
		fiyat 				='$fiyat', 
	 
		parabirimi 			='$parabirimi', 
		hizmetID 			='$hizmetID', 
		termin 				='$termin', 
		baslangic 			='$baslangic', 
		yenileme 			='$yenileme', 		 
		 
		onyazi 				='$onyazi', 
	  
		ip					='$ip', 
		tarih				= now(),
		ekleyen				= '$ekleyen',
		 
		sira				= '$sira',
	 	
		durum				= '$durum' 
	 
	  ");   
	  
	if($gonder){
		
		$carihizmetID	= $mysqli->insert_id;
		
		if($fiyat>0){
			  
		 $gonder  	= $mysqli->query(" insert into carikasa set  
	 
		carihizmetID 		='$carihizmetID', 
		cariID 				='$cariID',  
		hizmetID	 		='$hizmetID', 
		alacak 				='$fiyat', 
		parabirimi 			='$parabirimi', 
		termin	 			='$termin', 
		baslangic 			='$baslangic', 
		yenileme 			='$yenileme', 		
		kdv	 				= '18', 
		aciklama	 		= '$onyazi', 
		itarih		 		= now(),  
		
		ip					='$ip', 
		tarih				= now(),
		ekleyen				= '$ekleyen', 
		durum				= '0' 
	 
	  ");   
	   
	  }
		    
		header("Location:?sy=cariayrinti&id=".$cariID);	
		  
	} else { echo '<div class="alert alert-danger" role="alert">
				<strong class="text-capitalize">Hata!</strong>Hata İşlem Başarısız :(  
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div> <br /> <a href="javascript:history.back(-1)">Geri Dön</a>'; }   	  
	 
} else { 
?>	



	<form action="" method="post" enctype="multipart/form-data" >
	
			
	<script type="text/javascript"> 
		$(function(){
			$("select[name=hizmetID]").change(function(){
				 
				var hizmetID = $("select[name=hizmetID]").val();
				 
				$.ajax({
					url: "pages/cari/hizbak.php",
					type: "POST",
					data: {"hizmetID":hizmetID},
					success: function(ortakat) { 
						$("#fiyat").html(ortakat); 
					} 
				}); 
			}); 
		});
		</script> 		

<div class="form-group row">
	<label for="baslik" class="col-sm-2 col-form-label">Başlık (Domain) * </label>
	<div class="col-sm-6">
	  <input type="text" name="baslik" class="form-control" id="baslik" placeholder="Başlık" value="" required > 
		
						
		</div>
		 
	</div>
	
	
		
	  <div class="form-group row">
		<label for="hizmetID" class="col-sm-2 col-form-label"> Hizmet Seçin * </label>
		<div class="col-sm-6">
		  
		  <label for="hizmetID"  > </label>
			<select class="custom-select task-manager-list-select" name="hizmetID" required >
				<option value="" >Hizmet Seçin * </option>
			<?php 
				$ukat  = $mysqli->query("select * from hizmet where dil='$dil' order by sira asc ");
					while($uyaz = $ukat->fetch_array()){
						$pbirimm    = $uyaz['parabirimi'];
                        $pyazz      = $mysqli->query("select * from parabirimi where id='$pbirimm' ")->fetch_array();
						echo '<option value='.$uyaz['id'].' >'.$uyaz['baslik'].' - '.$uyaz['fiyat'].$pyazz['simge'].'  </option>'; 
					} 
			?>	 	 
		 </select> 
		</div>	 
	</div>  
	
	 <div id="hizbakkk"></div>
	 
	 
 
	
	 
<div class="form-group row">
		<label for="fiyat" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Fiyat * </label>
		<div class="col-sm-1" id="fiyat">
		   
		 
		</div>
		 
	</div> 
	
	 
	  
	<div class="form-group row">
		<label for="termin" class="col-sm-2 col-form-label"><i class="fa fa-calendar"></i> Termin </label>
		<div class="col-sm-6">
			<div class="ul-form__radio-inline">
			
				<label class=" ul-radio__position radio radio-primary form-check-inline">
					<input type="radio" name="termin" value="Yıllık" checked >
					<span class="ul-form__radio-font">Yıllık</span>
					<span class="checkmark"></span>
				</label>
				
				<label class="ul-radio__position radio radio-primary">
					<input type="radio" name="termin" value="Aylık">
					<span class="ul-form__radio-font">Aylık</span>
					<span class="checkmark"></span>
				</label>
					
				<label class="ul-radio__position radio radio-primary">
					<input type="radio" name="termin" value="Tek Seferlik">
					<span class="ul-form__radio-font">Tek Seferlik</span>
					<span class="checkmark"></span>
				</label>
				
			</div>
		</div>
	</div>
	  
	  
	  
	   	<div class="form-group row">
		<label for="baslangic" class="col-sm-2 col-form-label">Başlangıç   </label>
		<div class="col-sm-2">
		 <input type="date" name="baslangic" max="31.12.2050" class="form-control " id="baslangic"   value="<?php echo date('Y-m-d'); ?>"  >
		</div>	 
	 </div>
	  
	   	<div class="form-group row">
		<label for="yenileme" class="col-sm-2 col-form-label">Yenileme </label>
		<div class="col-sm-2">
		 <input type="date" name="yenileme" max="31.12.2050" class="form-control " id="yenileme" value="<?php $yil = date('Y')+1;  echo date("$yil-m-d"); ?>"  >
		</div>	 
	 </div>
	 
	 
	 	 		 
  <div class="form-group row">
		<label for="onyazi" class="col-sm-2 col-form-label"> Not </label>
		<div class="col-sm-10">
		<textarea name="onyazi" class="form-control" id="onyazi" cols="30" rows="3" placeholder="Not" ></textarea>
			 
		</div>
	</div>   
	
	
					
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
				