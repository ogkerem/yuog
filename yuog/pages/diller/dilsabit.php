	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
 
	
	?>
	<div class="main-content">
	
   <div class="breadcrumb">
                <h1>Dil Sabitleri</h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li><a href="?sy=diller">Diller</a></li> 
                </ul>
				
	<!-- <a href="?sy=dilkat" target="_blank"><button type="button" class="btn btn-warning btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-asterisk"></i> </span>
		<span class="ul-btn__text">Kategoriler</span>
	</button>
	</a>  -->
	
	
            </div>
		 
            <div class="separator-breadcrumb border-top"></div>
  
  
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
	$sef				= url_seo($baslik);
	$sira				= (int)trim($_POST['sira']); 
	$katID				= (int)$_POST['katID']; 
	 
	$ekleyen			= $email; 
	
	$ip					= $_SERVER['REMOTE_ADDR']; 
	  
	   
	$gonder  	= $mysqli->query(" insert into dilsabit set  
	 baslik 				='$baslik', 	  
	 sef 					='$sef', 	  
	 katID 					='$katID', 	  
	 sira					= '$sira'  
	 
	  ");   
	  
	  echo "insert into dilsabit set  
	 baslik 				='$baslik', 	  
	 sef 					='$sef', 	  
	 katID 					='$katID', 	  
	 sira					= '$sira'  ";
	 
	 
	if($gonder){
		 
		  header("Location:?sy=dilsabit&islem=basarili");	
		  
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
		<label for="baslik" class="col-sm-1 col-form-label">Başlık * </label> 
		 
		<!-- <div class="col-sm-2">
		
		  <select class="custom-select task-manager-list-select " name="katID" >  ';  
	  
	<?php $katbak = $mysqli->query("select * from dilkat order by sira asc "); 
		while($katyaz = $katbak->fetch_array()){
			echo '<option value="'.$katyaz['id'].'" >'.$katyaz['baslik'].'</option>';
		}
	?>	
		  </select>
			 
		</div>  -->
		
	  <div class="col-sm-3">
		 <input type="text" name="baslik" class="form-control" id="baslik" placeholder="Başlık" value="" required >
		</div>
		
		<div class="col-sm-1">
		 <input type="text" name="sira" class="form-control" id="sira" placeholder="Sıra" value="" >
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
                            <div class="card-title">Sabit Değer - Uyarı her seferinde sadece bir sutün güncelleyip yada silin</div>
  
<div class="form-row">
			 
	 
	 <div class="col-md-4 mb-4">
				 
		Başlık
				 
				  
			</div>
			
	 <div class="col-md-4 mb-4">
				 
		Sef URL
				 
				  
			</div>
			 
			<div class="col-md-1 mb-1">
				 
				Sıra 
				 
				  
			</div>
                         
			<div class="col-md-1 mb-1">
			  
				 Düzenle 
		 
			</div>	
			
			<div class="col-md-1 mb-1">
			 
		  Sil 
			</div>
                                
						 
                                   
                    </div>

					
<?php 

	$cbak = $mysqli->query("select * from dilsabit order by sira asc");
		while($cyaz = $cbak->fetch_array()){
			
			echo '<form class="needs-validation" novalidate="" action="" method="post" >
                 <div class="form-row">
			 
	  
	  <!--	<div class="col-sm-2">
		
		  <select class="custom-select task-manager-list-select " name="katID" >  ';  
	  
	 $katbak = $mysqli->query("select * from dilkat order by sira asc "); 
		while($katyaz = $katbak->fetch_array()){
			
			if($katyaz['id']==$cyaz['katID']){
				echo '<option value="'.$katyaz['id'].'" selected>'.$katyaz['baslik'].'</option>';
			} else {
				echo '<option value="'.$katyaz['id'].'" >'.$katyaz['baslik'].'</option>';
			}
			 
		}
	 
	echo '   </select>
			 
		</div> -->
		
		
	  
	 <div class="col-md-4 mb-4">
				 
		 <input type="text" name="baslik1" class="form-control" id="validationTooltip01" placeholder="Başlık" value="'.$cyaz['baslik'].'" required="">
				 
				  
			</div>
	  
	 <div class="col-md-3 mb-3">
				 
		 <input type="text" name="" class="form-control" id="validationTooltip01" placeholder="Başlık" value="'.$cyaz['sef'].'" disabled >
				 
				  
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
			
		 
			$baslik = $_POST['baslik1']; 
			$sira 	= $_POST['sira'];
			$katID 	= $_POST['katID'];
			$gizli 	= $_POST['gizli'];
			
	 
			
			$guncellee = $mysqli->query("update dilsabit set baslik='$baslik' , katID='$katID', sira='$sira' where id='$gizli' ");
			
				if($guncellee){
		 
		  header("Location:?sy=dilsabit&islem=basarili");	
		  
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
			 
			$sill = $mysqli->query("delete from dilsabit  where id='$gizli' ");
			  
				if($sill){
		 
		  header("Location:?sy=dilsabit&islem=basarili");	
		  
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
	 
	