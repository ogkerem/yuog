	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
	$konu	= "kvkk"; 
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
	
	$icerikyaz 	= $mysqli->query("select * from kvkk where dil='$dil' ")->fetch_array();
	
	$seoID 	= $icerikyaz['seo'];
	$seoyaz	= $mysqli->query("select * from seo where id='$seoID' ")->fetch_array();
	 
	?>
	<div class="main-content">
	
   <div class="breadcrumb">
                <h1> KVKK </h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li> KVKK </li>
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
	
	$yeniurlmiz 			=  $_POST['seourl'];
	 
	$baslik					= addslashes($_POST['baslik']);
	$lbaslik				= addslashes($_POST['lbaslik']);
	$buton					= addslashes($_POST['buton']);
	$icerik					= addslashes($_POST['icerik']);
	$sor 	= $mysqli->query("select * from kvkk where dil='$dil' ")->num_rows;
	if($sor>0){
	$seosor			= $mysqli->query("select * from seo where seo='$yeniurlmiz' && id!='$seoID' ");
	$seoyazz		= $seosor->fetch_array(); 
	$seosay 		= $seosor->num_rows;		  
	if($seosay>0){
		$sonurl = rand(0,100).'-'.$yeniurlmiz;
	} else { 
		$sonurl = $yeniurlmiz;
	}
	
	$seoguncelle = $mysqli->query("update seo set seo='$sonurl', durum='$durum' where id='$seoID' ");
	
	
		$guncelle = $mysqli->query("update kvkk set baslik='$baslik' , lbaslik='$lbaslik' , buton='$buton' , icerik='$icerik' where dil='$dil' ");	
	} else {
	$seosor		= $mysqli->query("select * from seo where seo='$yeniurlmiz' ");
	$seoyazz	= $seosor->fetch_array(); 
	$seosay 	= $seosor->num_rows;
		  
	if($seosay>0){
		$sonurl = rand(0,100).'-'.$yeniurlmiz;
	} else { 
		$sonurl = $yeniurlmiz;
	}
	
	$seoekle 		= $mysqli->query("insert into seo (seo,konu, durum) values ('$sonurl', '$konu', 'on')");	
	$seoID			= $mysqli->insert_id;
	
		$guncelle = $mysqli->query("insert into kvkk (baslik, lbaslik, buton , icerik ,guncelleme , dil , seo ) values ('$baslik', '$lbaslik', '$buton', '$kvkk', '$guncelleme', '$dil', '$seoID' ) ");
	}
	
	
		  
	if($guncelle){ 
		
		  header("Location:?sy=kvkk&dil=".$dil."&islem=basarili");
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
		
		<?php $dilbak1 = $mysqli->query("select * from diller order by sira "); 
		while($dilyaz1 = $dilbak1->fetch_array()){
			if($dilyaz1['id']==$dil){
			
	echo '<a href="?sy=kvkk&dil='.$dilyaz1['id'].'"><button type="button" class="btn btn-raised btn-raised-primary m-1">'.$dilyaz1['baslik'].'</button></a> ';
	
			} else {
			
	echo '<a href="?sy=kvkk&dil='.$dilyaz1['id'].'"><button type="button" class="btn btn-outline-primary m-1">'.$dilyaz1['baslik'].'</button></a> ';
	
			}
		
		}				
						?>
			 
		</div>
	</div>	
	 
	
	
	<div class="form-group row">
		<label for="baslik" class="col-sm-2 col-form-label">Başlık * </label>
		<div class="col-sm-6">
		 <input type="text" name="baslik" class="form-control" id="baslik" placeholder="Başlık" value="<?php echo $icerikyaz['baslik']; ?>" required >
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
  
	<div class="form-group row">
		<label for="seourl" class="col-sm-2 col-form-label">Seo URL * </label>
		<div class="col-sm-6">
		  <input type="text" name="seourl" class="form-control" id="seourl" placeholder="Seo URL" value="<?php echo $seoyaz['seo']; ?>"  >  
		</div> 
	</div>
	
	

	
	<div class="form-group row">
		<label for="facebook" class="col-sm-2 col-form-label"> KVKK   </label>
		<div class="col-sm-10">
		 
		 <textarea name="icerik" class="ckeditor" id="icerik" cols="40" rows="3"><?php echo $icerikyaz['icerik']; ?></textarea>
			 	
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
				