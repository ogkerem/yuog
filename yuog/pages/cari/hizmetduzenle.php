	<?php 
	 
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	 
	$id			= $_GET['id'];
	$hizmetyaz 	= $mysqli->query("select * from carihizmet where id='$id' ")->fetch_array();
	
	$cariID		= $hizmetyaz['cariID'];
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
	 
	$durum1				= $_POST['durum']; 	 
	if($durum1=="on"){ $durum = 1; } else { $durum = 0; }  
	 
	 
	$gonder  	= $mysqli->query(" update carihizmet set 
	
	 
		baslik 				='$baslik', 
		cariID 				='$cariID', 
		fiyat 				='$fiyat', 
		kalan 				='$fiyat', 
		parabirimi 			='$parabirimi', 
		hizmetID 			='$hizmetID', 
		termin 				='$termin', 
		baslangic 			='$baslangic', 
		yenileme 			='$yenileme', 		 
		 
		onyazi 				='$onyazi', 
	   
		sira				= '$sira',
	 	
		durum				= '$durum' 
		
		where id='$id'
	 
	  ");   
	  
	if($gonder){
		
		$carihizmetID	= $mysqli->insert_id;
		
	/*	
		 $gonder  	= $mysqli->query(" insert into carikasa set 
	
	 
		carihizmetID 		='$carihizmetID', 
		cariID 				='$cariID',  
		hizmetID	 		='$hizmetID', 
		alacak 				='$fiyat', 
		parabirimi 			='$parabirimi', 
		kdv	 				= '18', 
		aciklama	 		= '$onyazi', 
		itarih		 		= now(), 
		  
		ip					='$ip', 
		tarih				= now(),
		ekleyen				= '$ekleyen', 
		durum				= '$durum' 
	 
	  ");   */
	  
	  
	  
		    
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
						$("#fiyat").val(ortakat); 
					} 
				}); 
			}); 
		});
		</script> 		

<div class="form-group row">
	<label for="baslik" class="col-sm-2 col-form-label">Başlık (Domain) * </label>
	<div class="col-sm-6">
	  <input type="text" name="baslik" class="form-control" id="baslik" placeholder="Başlık" value="<?php echo $hizmetyaz['baslik']; ?>" required > 
		
						
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
					if($hizmetyaz['hizmetID']==$uyaz['id']){
						echo '<option value='.$uyaz['id'].' selected >'.$uyaz['baslik'].' - '.$uyaz['kodu'].'  </option>'; 
					} else {
						echo '<option value='.$uyaz['id'].' >'.$uyaz['baslik'].' - '.$uyaz['kodu'].'  </option>'; 
					}
						
					} 
			?>	 	 
		 </select> 
		</div>	 
	</div>  
	
	 <div id="hizbakkk"></div>
	 
	 
 
	
	 
<div class="form-group row">
		<label for="fiyat" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Fiyat * </label>
		<div class="col-sm-1">
		 <input type="text" name="fiyat" class="form-control" id="fiyat" placeholder="Fiyat" value="<?php echo $hizmetyaz['fiyat']; ?>" required >  
		 
		</div>
		<div class="input-group-prepend">
		<select class="custom-select task-manager-list-select" name="parabirimi" required >
				 
			<?php 
				$pbakk  = $mysqli->query("select * from parabirimi order by sira asc ");
					while($pyazz = $pbakk->fetch_array()){
					if($hizmetyaz['parabirimi']==$pyazz['id']){
						echo '<option value='.$pyazz['id'].' selected >'.$pyazz['simge'].'</option>'; 
					} else {
						echo '<option value='.$pyazz['id'].' >'.$pyazz['simge'].'</option>'; 
					}
						
					} 
			?>	 	 
		 </select> 
		  
		</div>
	</div> 
	
	 
	  
	<div class="form-group row">
		<label for="termin" class="col-sm-2 col-form-label"><i class="fa fa-calendar"></i> Termin </label>
		<div class="col-sm-6">
			<div class="ul-form__radio-inline">
			
				<label class=" ul-radio__position radio radio-primary form-check-inline">
					<input type="radio" name="termin" value="Yıllık" <?php if($hizmetyaz['termin']=="Yıllık") { echo 'checked'; } ?> >
					<span class="ul-form__radio-font">Yıllık</span>
					<span class="checkmark"></span>
				</label>
				
				<label class="ul-radio__position radio radio-primary">
					<input type="radio" name="termin" value="Aylık" <?php if($hizmetyaz['termin']=="Aylık") { echo 'checked'; } ?> >
					<span class="ul-form__radio-font">Aylık</span>
					<span class="checkmark"></span>
				</label>
					
				<label class="ul-radio__position radio radio-primary">
					<input type="radio" name="termin" value="Tek Seferlik" <?php if($hizmetyaz['termin']=="Tek Seferlik") { echo 'checked'; } ?> >
					<span class="ul-form__radio-font">Tek Seferlik</span>
					<span class="checkmark"></span>
				</label>
				
			</div>
		</div>
	</div>
	  
	  
	  
	   	<div class="form-group row">
		<label for="baslangic" class="col-sm-2 col-form-label">Başlangıç   </label>
		<div class="col-sm-2">
		 <input type="date" name="baslangic" max="31.12.2050" class="form-control " id="baslangic"   value="<?php echo substr($hizmetyaz['baslangic'],0,10); ?>"  >
		</div>	 
	 </div>
	  
	   	<div class="form-group row">
		<label for="yenileme" class="col-sm-2 col-form-label">Yenileme </label>
		<div class="col-sm-2">
		 <input type="date" name="yenileme" max="31.12.2050" class="form-control " id="yenileme" value="<?php echo substr($hizmetyaz['yenileme'],0,10); ?>"  >
		</div>	 
	 </div>
	 
	 
	 	 		 
  <div class="form-group row">
		<label for="onyazi" class="col-sm-2 col-form-label"> Not </label>
		<div class="col-sm-10">
		<textarea name="onyazi" class="form-control" id="onyazi" cols="30" rows="3" placeholder="Not" ><?php echo $hizmetyaz['onyazi']; ?></textarea>
			 
		</div>
	</div>   
	
	
					
	<div class="form-group row">
	<label for="sira" class="col-sm-2 col-form-label">Sıra </label>
	<div class="col-sm-1">
	  <input type="text" name="sira" class="form-control" id="sira" placeholder="Sıra" value="<?php echo $hizmetyaz['sira']; ?>" > 
		
						
		</div>
		 
	</div>
	
	
	<div class="form-group row">
	<label for="durum" class="col-sm-2 col-form-label">Durum </label>
	<div class="col-sm-2">
	  
	<label class="switch switch-primary mr-3" id="durum">
		 
		  <input name="durum" type="checkbox" <?php if($hizmetyaz['durum']=="1"){ echo 'checked'; }?>  > 
		  
		<span class="slider"></span>
	</label>
			 
		</div>
		
		</div>
	 
		 
	<div class="form-group row">
	<label for="sira" class="col-sm-2 col-form-label">  </label>
		<div class="col-sm-10">
			<button type="submit" class="btn btn-primary ul-btn__text">İçerik Düzenle</button>
		 
		</div>
	</div>
	
		</form>

			<?php } ?>
				</div>
			</div>
		</div>
	</div>            
</div> 
				