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
	
	$icerikyaz1 = $mysqli->query("select * from popup where dil='$dil' ");
	$icerikyaz	= $icerikyaz1->fetch_array();
	
 
	?>
	<div class="main-content">
	
   <div class="breadcrumb">
                <h1> Popup </h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li> Popup </li>
                    <li> <?php echo $dilyaz['baslik']; ?> </li>
					 
					
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
	
	
		 
	$baslik					= addslashes($_POST['baslik']);
	$lbaslik				= addslashes($_POST['lbaslik']);
	$buton					= addslashes($_POST['buton']);
	$popup					= addslashes($_POST['popup']);
	 
	$durum					= $_POST['durum']; 	 
	 
	$guncelle = $mysqli->query("update popup set baslik='$baslik' , lbaslik='$lbaslik' , durum='$durum' , buton='$buton' , popup='$popup' where dil='$dil' ");
		  
				if($guncelle){ 
					
					 header("Location:?sy=popup&islem=basarili");
				} else { echo '<div class="alert alert-danger" role="alert">
                                <strong class="text-capitalize">Hata!</strong>Hata Siteayar  Güncellenemedi
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
							
							 '; }   

} else { 
?>	



	<form action="" method="post" enctype="multipart/form-data" >
	
	 
	<div class="form-group row">
		<label for="baslik" class="col-sm-2 col-form-label"><i class="fa fa-language"></i> İçerik Dili * </label>
		<div class="col-sm-6">
		
		<?php $dilbak1 = $mysqli->query("select * from diller order by sira asc "); 
		while($dilyaz1 = $dilbak1->fetch_array()){
			if($dilyaz1['id']==$dil){
			
	echo '<a href="?sy=popup&dil='.$dilyaz1['id'].'"><button type="button" class="btn btn-raised btn-raised-primary m-1">'.$dilyaz1['baslik'].'</button></a> ';
	
			} else {
			
	echo '<a href="?sy=popup&dil='.$dilyaz1['id'].'"><button type="button" class="btn btn-outline-primary m-1">'.$dilyaz1['baslik'].'</button></a> ';
	
			}
		
		}				
						?>
			 
		</div>
	</div>	
	 
	
	<!--
	<div class="form-group row">
		<label for="baslik" class="col-sm-2 col-form-label">Başlık  </label>
		<div class="col-sm-6">
		 <input type="text" name="baslik" class="form-control" id="baslik" placeholder="Başlık" value="<?php echo $icerikyaz['baslik']; ?>"   >
		</div>
	</div>

	
	<div class="form-group row">
		<label for="lbaslik" class="col-sm-2 col-form-label">Link Başlık  * </label>
		<div class="col-sm-3">
		 <input type="text" name="lbaslik" class="form-control" id="lbaslik" placeholder="Başlık" value="<?php echo $icerikyaz['lbaslik']; ?>" required >
		</div>
	</div>

	

	<div class="form-group row">
		<label for="buton" class="col-sm-2 col-form-label">Buton  * </label>
		<div class="col-sm-3">
		 <input type="text" name="buton" class="form-control" id="buton" placeholder="Başlık" value="<?php echo $icerikyaz['buton']; ?>" required >
		</div>
	</div>
-->

	
	<div class="form-group row">
		<label for="facebook" class="col-sm-2 col-form-label"> İçerik   </label>
		<div class="col-sm-10">
		 
		 <textarea name="popup" class="ckeditor" id="icerik" cols="40" rows="3"><?php echo $icerikyaz['popup']; ?></textarea>
			 	
		</div>
	</div>
		 
	
	
		<div class="form-group row">
	<label for="durum" class="col-sm-2 col-form-label">Durum </label>
	<div class="col-sm-2">
	  
	<label class="switch switch-primary mr-3" id="durum">
		 
		  <input name="durum" type="checkbox" <?php if($icerikyaz['durum']=="on"){ echo 'checked'; }?>  > 
		  
		<span class="slider"></span>
	</label>
			 
		</div>
		
		</div>
		
		
		<div class="form-group row">
	<label for="facebook" class="col-sm-2 col-form-label"> </label>
		<div class="col-sm-10">
			<button type="submit" class="btn btn-primary ul-btn__text">Güncelle</button>
		 
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
				