	<?php 
	 
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
	$konu 		= "urun";
	$kategori 	= $konu."dokumankat";
	
 	$id = @$_GET['id']; 
	$urunyaz = $mysqli->query("select * from urunkat where id='$id' ")->fetch_array();
	
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
	  <h1><a href="?sy=<?php echo $konu; ?>"> Ürünler</a> > <a href="?sy=<?php echo $konu; ?>kat"> Kategoriler</a> > <a href="?sy=urunkatduzenle&id=<?php echo $urunyaz['id']; ?>"> <?php echo $urunyaz['baslik']; ?></a> > <?php echo $dilyaz['baslik']; ?>  </h1>
	  
	<ul>
		<li><a href="index.php">Ana Sayfa</a></li>
		<li> <?php echo $urunyaz['baslik']; ?> </li> 
		<li>   Dökümanlar </li> 
	</ul>
	</div>	
		 
	 <div class="separator-breadcrumb border-top"></div>
 
 <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                          
 
							<div class="card-header text-right bg-transparent">
	 
	 
<!--
	
	 <a href="?sy=urundokumankat"><button type="button" class="btn btn-warning btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-asterisk" ></i> </span>
		<span class="ul-btn__text">Kategoriler</span>
	</button>
	</a>
-->
	 
	 <hr>
   								
</div>
 						
							
<?php 
  					
	$cbak = $mysqli->query("select * from   urundokumankat  where urunID='$id' order by sira asc ");
		while($cyaz = $cbak->fetch_array()){
//			
//		$seoID 	= $cyaz['seo'];
//		$seobul	= $mysqli->query("select * from seo where id='$seoID' ");
//		$seoyaz = $seobul->fetch_array();

	
			echo '<form class="needs-validation" novalidate="" action="" method="post" >
                 <div class="form-row">
			
		<!--	<div class="col-md-2 mb-2"> 
	  <select class="custom-select task-manager-list-select " name="dil" >  ';  
	  
	 $dilbak = $mysqli->query("select * from diller ");
		while($dilyaz = $dilbak->fetch_array()){
				if($dilyaz['id']==$cyaz['dil']){
				echo '<option value="'.$dilyaz['id'].'" selected>'.$dilyaz['baslik'].'</option>';
				} else {
				echo '<option value="'.$dilyaz['id'].'">'.$dilyaz['baslik'].'</option>';
				}
			}
				  
			echo ' </select>
  
	 
	 </div> -->
	 
	 <div class="col-md-3 mb-3">
				 
  <input type="text" name="baslik1" class="form-control" id="validationTooltip01" placeholder="Başlık" value="'.$cyaz['baslik'].'" required="">
   
			</div>
			
			
	 <!-- <div class="col-md-2 mb-2"> 
	  <select class="custom-select task-manager-list-select " name="katID" >  ';  
	  
	 $katbak = $mysqli->query("select * from urundokumankat ");
		while($katyaz = $katbak->fetch_array()){
				if($katyaz['id']==$cyaz['katID']){
				echo '<option value="'.$katyaz['id'].'" selected>'.$katyaz['baslik'].'</option>';
				} else {
				echo '<option value="'.$katyaz['id'].'">'.$katyaz['baslik'].'</option>';
				}
			}
				  
	 echo ' </select>
  
	 
	 </div>
	 
	 
			 
	 <div class="col-md-3 mb-3">
				 
  <input type="text" name="seo1" class="form-control" id="validationTooltip01" placeholder="Seo Url" value="'.$seoyaz['seo'].'" required="">
   <input type="hidden" class="form-control"  name="seoidd"   value="'.$seoID.'"  >
			</div> -->
			 
			<div class="col-md-2 mb-2">
	 <a href="../uploads/'.$cyaz['dosya'].'" target="_blank">'.$cyaz['dosya'].'</a>			 
	  
				  
			</div>	
			
			<div class="col-md-1 mb-">
				 
				<input type="text" class="form-control" id="sira" name="sira" placeholder="Sıra" value="'.$cyaz['sira'].'"  >
				<input type="hidden" class="form-control"  name="gizli"   value="'.$cyaz['id'].'"  >
				  
			</div>
                         
			<div class="col-md-1 mb-1">
			  
				  <button class="btn btn-primary" type="submit" value="Güncelle" name="guncellee" >Güncelle</button>
		 
			</div>	
			
			<div class="col-md-1 mb-1">
			 
		 
		 <a href=""  onclick=" if ( !confirm(\'Kaydi silmek istediğinizden emin misiniz?\') ) return false;" ><button class="btn btn-danger" type="submit" value="Sil" name="guncellee" >Sil</button>	</a>
			</div>
                                
						 
                                   
                    </div>
								
			  </form>';
			
		}
		
		
		if(@$_POST['guncellee']=="Güncelle"){
			
		$katID 	= $_POST['katID'];
		$baslik	= addslashes(trim($_POST['baslik1']));
//		$yeniurlmiz 	= $_POST['seo1'];
//		$seoidd = $_POST['seoidd'];
		$dil 	= $_POST['dil'];
		$sira 	= $_POST['sira'];
		$gizli 	= $_POST['gizli'];
		
//		$resimad			= rand(0,999).'-'.$_FILES['resim']['name']; 
//		$kaynak				= $_FILES['resim']['tmp_name']; 	
//		$rhedef				= "../uploads/";
	  
		$guncellee = $mysqli->query("update urundokumankat set katID='$katID', baslik='$baslik' , sira='$sira' , dil='$dil' where id='$gizli' ");
		
				if($guncellee){
		 
//		if($_FILES['resim']['name']!=""){ 
//		echo 'çalışgı'; 
//			
//		$kaynak		= $_FILES['resim']['tmp_name'];		 
//		$yukle 		= move_uploaded_file($kaynak,$rhedef."/".$resimad); 
//		$guncelle 	= $mysqli->query("update urundokuman set dosya='$resimad' where id='$gizli' ");
//						
//						
//					}
//	$seosor		= $mysqli->query("select * from seo where seo='$yeniurlmiz' && id!='$seoidd' ");
//	$seoyazz	= $seosor->fetch_array(); 
//	$seosay 	= $seosor->num_rows;		  
//	if($seosay>0){
//		$sonurl = rand(0,100).'-'.$yeniurlmiz;
//	} else { 
//		$sonurl = $yeniurlmiz;
//	}
//	
//	$seoguncelle = $mysqli->query("update seo set seo='$sonurl', durum='$durum' where id='$seoidd' ");
	 
					
					
header("Location:?sy=".$kategori."&id=".$id."&dil=".$dil."&islem=basarili");
		  
	} else { echo '<div class="alert alert-danger" role="alert">
				<strong class="text-capitalize">Hata!</strong>Hata İşlem Başarısız :(  
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div> <br /> <a href="javascript:history.back(-1)">Geri Dön</a>'; }  
			
		 
		}

		if(@$_POST['guncellee']=="Sil"){
			
		
			$baslik = $_POST['baslik1'];
			$sira 	= $_POST['sira'];
			$gizli 	= $_POST['gizli'];
			 
			$sill = $mysqli->query("delete from $kategori  where id='$gizli' ");
			 
				if($sill){
					
	$resim1		= $mysqli->query("select * from urundokumankat where id='$gizli'");
	$resim		= $resim1->fetch_array();		
	$resbak 	= $resim['dosya'];
	
	$rhedef		= "../uploads/"; 
					
	unlink($rhedef.$resbak);
		 
		 header("Location:?sy=".$kategori."&id=".$id."&dil=".$dil."&islem=basarili");
		  
	} else { echo '<div class="alert alert-danger" role="alert">
				<strong class="text-capitalize">Hata!</strong>Hata İşlem Başarısız :(  
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div> <br /> <a href="javascript:history.back(-1)">Geri Dön</a>'; }  
			
			
		}

?>
		  			
							</div>
						</div>
					</div> 



            <div class="row">
                <div class="col-md-12">
                   
                    <p>   <?php $islem = @$_GET['islem']; 
			if($islem=="basarili"){
				
	 echo '	<div class="alert alert-card alert-success" role="alert">
			<strong class="text-capitalize">Başarılı !</strong> İşleminiz başarıyla gerçekleştirilmiştir.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div> ';
			}
			
			?> </p>
                    <div class="card mb-5">
                        <div class="card-body">
						
						<?php 
if(@$_POST['yeniekle']=="Yeni İçerik Ekle"){ 
	
 
	$baslik				= addslashes(trim($_POST['baslik']));
	$sira				= trim($_POST['sira']); 
	 
	$durum				= 1;
	  
	$ustkatID 			=  $_POST['ustkatID'];
 
	$resimad			= rand(0,999).'-'.$_FILES['resim']['name']; 
	$kaynak				= $_FILES['resim']['tmp_name']; 
	
	$rhedef				= "../uploads/";
	  
//	$seosor		= $mysqli->query("select * from seo where seo='$yeniurlmiz' ");
//	$seoyazz	= $seosor->fetch_array(); 
//	$seosay 	= $seosor->num_rows;
//		  
//	if($seosay>0){
//		$sonurl = rand(0,100).'-'.$yeniurlmiz;
//	} else { 
//		$sonurl = $yeniurlmiz;
//	}
//
//	$seoekle 		= $mysqli->query("insert into seo (seo,konu, durum) values ('$sonurl', 'blogkat', '$durum')");	
//	$seo			= $mysqli->insert_id;

	
	$gonder  	= $mysqli->query(" insert into $kategori set 
	  
	 	  
	 urunID	 				='$id', 	  
	 baslik 				='$baslik', 	  
	 dosya 					='$resimad', 	  
	 katID 					='$ustkatID',  
	 dil 					='$dil', 	  
	 sira					= '$sira' 
	 
	  ");   
	  
	  
	if($gonder){
		 $yukle5			= move_uploaded_file($kaynak,$rhedef."/".$resimad);
		  header("Location:?sy=".$kategori."&id=".$id."&dil=".$dil."&islem=basarili");	
		  
	} else { echo '<div class="alert alert-danger" role="alert">
				<strong class="text-capitalize">Hata!</strong>Hata İşlem Başarısız :(  
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div> <br /> <a href="javascript:history.back(-1)">Geri Dön</a>'; }   	  
	 
} else { 
?>	



<form action="" method="post" enctype="multipart/form-data" >
	
<!--
<div class="form-group row">
		<label for="baslik" class="col-sm-2 col-form-label">İçerik Dili * </label>
		<div class="col-sm-6">
		
		<?php $dilbak1 = $mysqli->query("select * from diller  "); 
		while($dilyaz1 = $dilbak1->fetch_array()){
			if($dilyaz1['id']==$dil){
			
	echo '<a href="?sy='.$kategori.'&id='.$id.'&dil='.$dilyaz1['id'].'"><button type="button" class="btn btn-raised btn-raised-primary m-1">'.$dilyaz1['baslik'].'</button></a> ';
	
			} else {
			
	echo '<a href="?sy='.$kategori.'&id='.$id.'&dil='.$dilyaz1['id'].'"><button type="button" class="btn btn-outline-primary m-1">'.$dilyaz1['baslik'].'</button></a> ';
	
			}
		
		}				
						?>
			 
		</div>
	</div>	
-->

	
	<div class="form-group row">
		<label for="baslik" class="col-sm-2 col-form-label">Başlık * </label>
		<div class="col-sm-6">
		 <input type="text" name="baslik" class="form-control" id="baslik" placeholder="Başlık" value="" required >
		</div>
	</div>
	 		

	
	<!--  <div class="form-group row">
		<label for="ustkatID" class="col-sm-2 col-form-label"> Kategori * </label>
		<div class="col-sm-2">
		 
		  <label for="ustkatID"  > </label>
					<select class="custom-select task-manager-list-select" name="ustkatID" required >
						<option value="" > Kategori Seçin * </option>
	<?php $ukat  = $mysqli->query("select * from urundokumankat where dil='$dil' order by sira asc ");
			while($uyaz = $ukat->fetch_array()){

				echo '<option value='.$uyaz['id'].' >'.$uyaz['baslik'].'</option>'; 
			}

	?>			
					 
		 </select>
		 
			
		</div>		
		
	 
		 
	</div>  -->
	
	 <div class="form-group row">
		<label for="resim" class="col-sm-2 col-form-label"><i class="nav-icon fa fa-image"></i> Dosya * </label>
		<div class="col-sm-2">
		  <input type="file" name="resim" class="form-control" id="resim" placeholder="" required  > 
			 				
		</div>	
		
		<div class="col-sm-2">
		  
			 				
		</div>
	 
	</div>
	
	 									
<!--
<div class="form-group row">
		<label for="seourl" class="col-sm-2 col-form-label">Seo URL * </label>
		<div class="col-sm-6">
		  <input type="text" name="seourl" class="form-control" id="seourl" placeholder="Seo URL" value=""  required > 
			
 							
		</div>
		 
	</div>
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
			<button type="submit" class="btn btn-primary ul-btn__text" value="Yeni İçerik Ekle" name="yeniekle" >İçerik Ekle</button>
		 
		</div>
	</div> 
</form>

	 

<?php } ?>
		</div>
	</div>
</div>
</div>

					
				</div>  
	