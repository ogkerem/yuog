	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
 
	
	?>
	<div class="main-content">
	
   <div class="breadcrumb">
                <h1>Ana Sayfa Sol Resimler </h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li><a href="#">Ana Sayfa İşlemleri</a></li>
                   
                     
                </ul>
            </div>
		 
            <div class="separator-breadcrumb border-top"></div>
  
	 
            <div class="row">
                <div class="col-md-12">
                   
                    <p>   <?php $islem = $_GET['islem']; 
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
if($_POST['yeniekle']=="Yeni İçerik Ekle"){ 
	
 
	$baslik				= addslashes(trim($_POST['baslik']));
	$sira				= (int)trim($_POST['sira']); 
	$hit				= 1;
	$durum				= 1;
	$ekleyen			= $email; 
	
	
	$resimad			= $_FILES['resim']['name']; 
	$kaynak				= $_FILES['resim']['tmp_name']; 

	$resimsonad 		= rand(0,999).'-'.yeniurl(res_adi($resimad)).res_uzanti($resimad); 
	$rhedef				= "../uploads/anaban/";
	
	$ip					= $_SERVER['REMOTE_ADDR']; 
	  
	   
	$gonder  	= $mysqli->query(" insert into anaban set 
 
	 baslik 				='$baslik', 	  
	 resim 					='$resimsonad', 	  
	 sira					= '$sira' 
	 
	  ");   
	  
	if($gonder){
		 
		 $yukle 		= move_uploaded_file($kaynak,$rhedef."/".$resimsonad);
		 
		  header("Location:?sy=anaban&islem=basarili");	
		  
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
		<label for="baslik" class="col-sm-2 col-form-label"> Yeni Resim * </label>
	  
		<div class="col-sm-3">
		 <input type="text" name="baslik" class="form-control" id="baslik" placeholder="Başlık" value="<?php echo $baslik; ?>" required >
		</div>
		
		<div class="col-sm-2">
		  <input type="file" name="resim" class="form-control" id="resim" placeholder=" Resim Boyutu"   > 
			 				
		</div>
		
		<div class="col-sm-1">
		 <input type="text" name="sira" class="form-control" id="sira" placeholder="Sıra" value="<?php echo $sira; ?>" >
		</div>
		
		<div class="col-sm-2">
			<button type="submit" class="btn btn-primary ul-btn__text" value="Yeni İçerik Ekle" name="yeniekle">Yeni İçerik Ekle</button>
		 
		</div>
		
		
	</div>
										
    
</form>

<?php } ?>
		</div>
	</div>
</div>
</div>
 
 
 <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Ana Sayfa Sol Banner Güncelle</div>
                           
<?php 

	$cbak = $mysqli->query("select * from anaban order by sira asc ");
		while($cyaz = $cbak->fetch_array()){
			
			echo '<form class="needs-validation" novalidate="" action="" method="post" >
                 <div class="form-row">
			 
	 
	 <div class="col-md-3 mb-3">
				 
		 <input type="text" name="baslik1" class="form-control" id="validationTooltip01" placeholder="Başlık" value="'.$cyaz['baslik'].'" required="">
				 
			</div> 
			
			<div class="col-md-1 mb-1">
			
		<a href="../uploads/anaban/'.$cyaz['resim'].'" target="_blank"><img src="../uploads/anaban/'.$cyaz['resim'].'"></a>
				 
			</div>
			<div class="col-md-1 mb-1">
			
		 <input type="file" name="resim" class="form-control" id="resim"  > 
		 <input type="hidden" name="gresim"  value="'.$cyaz['resim'].'"   >		 
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
		
		
		if($_POST['guncellee']=="Güncelle"){
			
			 
			$baslik = $_POST['baslik1'];
			$sira 	= $_POST['sira'];
			$gizli 	= $_POST['gizli'];
			
			$gresim				= $_POST['gresim']; 
			$resimad			= $_FILES['resim']['name'];  			 
			$rhedef				= "../uploads/anaban/";
	 
			
			$guncellee = $mysqli->query("update anaban set  baslik='$baslik' , sira='$sira' where id='$gizli' ");
			
		 if($guncellee){
		 
		 if($resimad!=""){ 	 
		echo 'başladıı';
		unlink($rhedef.$gresim);	
		$kaynak		= $_FILES['resim']['tmp_name'];
		$resimsonad = rand(0,999).'-'.yeniurl(res_adi($resimad)).res_uzanti($resimad);
		$yukle 		= move_uploaded_file($kaynak,$rhedef."/".$resimsonad); 
		$guncelle 	= $mysqli->query("update anaban set resim='$resimsonad' where id='$gizli' ");
		
		}
	
	
	 header("Location:?sy=anaban&islem=basarili");	
		  
	} else { echo '<div class="alert alert-danger" role="alert">
				<strong class="text-capitalize">Hata!</strong>Hata İşlem Başarısız :(  
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div> <br /> <a href="javascript:history.back(-1)">Geri Dön</a>'; }  
			
		 
		}

		if($_POST['guncellee']=="Sil"){
			 
			$baslik = $_POST['baslik1'];
			$sira 	= $_POST['sira'];
			$gizli 	= $_POST['gizli'];
			
		$resim1		= $mysqli->query("select * from anaban where id='$gizli'");
		$resim		= $resim1->fetch_array();		
		$resbak 	= $resim['resim']; 
		$rhedef		= "../uploads/anaban/";
 
		$sill = $mysqli->query("delete from anaban  where id='$gizli' ");
			  
				if($sill){
		 unlink($rhedef.$resbak);
		 
		  header("Location:?sy=anaban&islem=basarili");	
		  
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
</div>  