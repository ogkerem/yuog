	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
 
	
	?>
	<div class="main-content">
	
   <div class="breadcrumb">
                <h1>Çıkış Noktaları</h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li><a href="?sy=turlar">Turlar</a></li>
                   
                     
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
	
	$katID				= $_POST['katID'];
	$baslik				= addslashes(trim($_POST['baslik']));
	$sira				= trim($_POST['sira']); 
	$hit				= 1;
	$durum				= 1;
	$ekleyen			= $email; 
	
	$ip					= $_SERVER['REMOTE_ADDR']; 
	  
	   
	$gonder  	= $mysqli->query(" insert into turcikisnokta set 
	 katID 					='$katID', 	  
	 baslik 				='$baslik', 	  
	 sira					= '$sira' 
	 
	  ");   
	  
	if($gonder){
		 
		  header("Location:?sy=cikisnokta&islem=basarili");	
		  
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
		 
	 
	 <div class="col-sm-3">
	 
	  <select class="form-control" name="katID" >
	  <option value="">Kategori Seç </option>
		<?php 
			$gbakk  = $mysqli->query("select * from turcikisnokta where katID='0' order by sira asc ");
				while($guzyaz = $gbakk->fetch_array()){
					 
				
					echo '<option value='.$guzyaz['id'].' >'.$guzyaz['baslik'].' </option>'; 
				}
		
		?>			
					 
	 </select>
	 <small id="web" class="ul-form__text form-text "> Üst Kategori Yoksa Boş Geçiniz </small>
	 
	 
	 
	</div>
		
		<div class="col-sm-3">
		 <input type="text" name="baslik" class="form-control" id="baslik" placeholder="Başlık" value="<?php echo $baslik; ?>" required >
		</div>
		<div class="col-sm-1">
		 <input type="text" name="sira" class="form-control" id="sira" placeholder="Sıra" value="<?php echo $sira; ?>" >
		</div>
		
		<div class="col-sm-2">
			<button type="submit" class="btn btn-primary ul-btn__text" value="Yeni İçerik Ekle" name="yeniekle"><i class="fa fa-plus"></i> Yeni Çıkış Noktası Ekle</button>
		 
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
                            <div class="card-title">Çıkış Noktası Güncelle</div>
                           
<?php 

	$cbak = $mysqli->query("select * from turcikisnokta order by sira asc ");
		while($cyaz = $cbak->fetch_array()){
			
			echo '<form class="needs-validation" novalidate="" action="" method="post" >
                 <div class="form-row">
			 <div class="col-md-3 mb-3"> 
	  <select class="form-control" name="katID" >
	  <option value="">Üst Kategori Seç</option> ';  
	  
	  $gbakk  = $mysqli->query("select * from turcikisnokta where katID='0' order by sira asc ");
				while($guzyaz = $gbakk->fetch_array()){
					 
				if($guzyaz['id']==$cyaz['katID']){
					echo '<option value='.$guzyaz['id'].' selected >'.$guzyaz['baslik'].' </option>'; 
				} else{
				echo '<option value='.$guzyaz['id'].' >'.$guzyaz['baslik'].' </option>'; 	
				}
					
				}
				  
			echo ' </select>
  
	 
	 </div>
	 
	 <div class="col-md-3 mb-3">
				 
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
		
		
		if($_POST['guncellee']=="Güncelle"){
			
			$katID 	= $_POST['katID'];
			$baslik = $_POST['baslik1'];
			$sira 	= $_POST['sira'];
			$gizli 	= $_POST['gizli'];
			
	 
			
			$guncellee = $mysqli->query("update turcikisnokta set katID='$katID', baslik='$baslik' , sira='$sira' where id='$gizli' ");
			
				if($guncellee){
		 
		  header("Location:?sy=cikisnokta&islem=basarili");	
		  
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
			 
			$sill = $mysqli->query("delete from turcikisnokta  where id='$gizli' ");
			  
				if($sill){
		 
		  header("Location:?sy=cikisnokta&islem=basarili");	
		  
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
	