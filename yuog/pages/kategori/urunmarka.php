	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
	$konu 	= "urunmarka"; 
	
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
	<h1><a href="?sy=urun">Ürünler </a> > Markalar  </h1>
	<ul>
		<li><a href="index.php">Ana Sayfa</a></li>
		<li> Marka Ekleme </li>
	  
		 
	</ul>
</div>
			 
		 
    <div class="separator-breadcrumb border-top"></div>
   
 <div class="col-md-12">
			<div class="card">
				<div class="card-body">
                          
                           
<?php 

	$cbak = $mysqli->query("select * from $konu order by sira asc ");
		while($cyaz = $cbak->fetch_array()){
			 
	
			echo '<form class="needs-validation" novalidate="" action="" method="post" >
                 <div class="form-row">
			 <div class="col-md-2 mb-2"> 
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
  
	 
	 </div>
	 
	 <div class="col-md-4 mb-4">
				 
  <input type="text" name="baslik1" class="form-control" id="validationTooltip01" placeholder="Başlık" value="'.$cyaz['baslik'].'" required="">
   
			</div>
			 
	 
			 
			<div class="col-md-1 mb-1">
				 
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
		$yeniurlmiz 	= $_POST['seo1'];
		$seoidd = $_POST['seoidd'];
		$dil 	= $_POST['dil'];
		$sira 	= $_POST['sira'];
		$gizli 	= $_POST['gizli'];
		 
		$guncellee = $mysqli->query("update $konu set  baslik='$baslik' , sira='$sira' , dil='$dil' where id='$gizli' ");
		
				if($guncellee){
		 
		  header("Location:?sy=".$konu."&islem=basarili");	
		  
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
			 
			$sill = $mysqli->query("delete from $konu  where id='$gizli' ");
			  
				if($sill){
		 
		  header("Location:?sy=".$konu."&islem=basarili");	
		  
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
	
	$katID				= $_POST['katID'];
	$baslik				= addslashes(trim($_POST['baslik']));
	$sira				= trim($_POST['sira']); 
	$hit				= 1;
	$durum				= 1;
	$ekleyen			= $email; 
	 
	$ip					= $_SERVER['REMOTE_ADDR']; 
	  
 
	
	$gonder  	= $mysqli->query(" insert into $konu set 
	   
 	  
	 baslik 				='$baslik',  
	 dil 					='$dil', 	  
	 sira					= '$sira' 
	 
	  ");   
	  
	if($gonder){
		 
		  header("Location:?sy=".$konu."&islem=basarili");	
		  
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
		<label for="baslik" class="col-sm-2 col-form-label">Başlık * </label>
		<div class="col-sm-6">
		 <input type="text" name="baslik" class="form-control" id="baslik" placeholder="Başlık" value="" required >
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
	