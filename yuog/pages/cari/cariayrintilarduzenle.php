	<?php 
	 
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	 
	$id			= $_GET['id'];
	$yaz 		= $mysqli->query("select * from carikasa where id='$id' ")->fetch_array();
	
	
	$cariID		= $yaz['cariID'];
	$cariyaz	= $mysqli->query("select * from carifirma where id='$cariID' ")->fetch_array();
			
	$parabirimi1 	= $yaz['parabirimi'];
	$carihizmetID 	= $yaz['carihizmetID'];
	$carihizyaz 	= $mysqli->query("select * from carihizmet where id='$carihizmetID' ")->fetch_array(); 
	
	
	$hizmetID	= $yaz['hizmetID'];
	$hizmetyaz	= $mysqli->query("select * from hizmet where id='$hizmetID' ")->fetch_array();
	$fiyat 		= $hizmetyaz['fiyat'];
	
	$kalanhesap		= $mysqli->query("select sum(alinan) as kaldi from carikasa where carihizmetID='$carihizmetID' && parabirimi='$parabirimi1' ")->fetch_array();	 
	$kalann 		= $kalanhesap['kaldi'];	
	 
	// $sonuc1 		= intval($cariheap - $kalann); 
	$sonuc 			= number_format(intval($fiyat - $kalann), 2, ',', '.'); 
	  
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
                <h1><a href="?sy=cariayrinti&id=<?php echo $cariID; ?>"> <?php echo $cariyaz['firma']; ?></a> >  <?php echo $hizmetyaz['baslik']; ?> ><?php echo $dilyaz['baslik']; ?> > Cari Düzenleme </h1>
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
	 
	$fiyat				=  $_POST['fiyat']; 
	$parabirimi			=  $_POST['parabirimi']; 
	$onyazi				=  addslashes($_POST['onyazi']); 
  
	 
	$gonder  	= $mysqli->query(" update carikasa set 
	
	 
	 
		alinan 				='$fiyat',  
		parabirimi 			='$parabirimi',  
		aciklama 			='$onyazi' 
		
		where id='$id'
	 
	  ");   
	  
	  
	  
	if($gonder){
		
		$sonkalan 		= $kalan+ $fiyat - $fiyat; 
		$kalanguncelle 	= $mysqli->query("update carihizmet set kalan='$sonkalan' where id='$carihizmetID'  ");
		  
		
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
		<label for="hizmetID" class="col-sm-2 col-form-label"> Hizmet   </label>
		<div class="col-sm-6"> 
		 <?php echo $hizmetyaz['baslik']; ?>
			 
		</div>	 
		
		
	</div>  
	
	 <div id="hizbakkk"></div>
	 
	  
	 
<div class="form-group row">
		<label for="fiyat" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Fiyat / Kalan * </label>
		<div class="col-sm-1">
		 <input type="text" name="fiyat" class="form-control" id="fiyat" placeholder="Fiyat" value="<?php echo $yaz['alinan']; ?>" required >  
		 
		</div>
		<div class="input-group-prepend">
		<select class="custom-select task-manager-list-select" name="parabirimi" required >
				 
			<?php 
				$pbakk  = $mysqli->query("select * from parabirimi order by sira asc ");
					while($pyazz = $pbakk->fetch_array()){
					if($yaz['parabirimi']==$pyazz['id']){
						echo '<option value='.$pyazz['id'].' selected >'.$pyazz['simge'].'</option>'; 
					} else {
						echo '<option value='.$pyazz['id'].' >'.$pyazz['simge'].'</option>'; 
					}
						
					} 
			?>	 	 
		 </select> 
		 
		</div>
		<div class="col-sm-4">
	Kalan: <?php echo $sonuc; ?> 
		 
		</div>
		
	</div> 
	
	   		 
  <div class="form-group row">
		<label for="onyazi" class="col-sm-2 col-form-label"> Not </label>
		<div class="col-sm-10">
		<textarea name="onyazi" class="form-control" id="onyazi" cols="30" rows="3" placeholder="Not" ><?php echo $yaz['aciklama']; ?></textarea>
			 
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
				