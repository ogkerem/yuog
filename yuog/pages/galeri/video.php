	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
 
	
	?>
	<div class="main-content">
	
   <div class="breadcrumb">
                <h1>Videolar</h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li><a href="#">Video Galeri</a></li>
                   
                     
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
	$video				= addslashes(trim($_POST['video']));
	$sira				= trim($_POST['sira']); 
	$hit				= 1;
	$durum				= 1;
	$ekleyen			= $email; 
	
	$ip					= $_SERVER['REMOTE_ADDR']; 
	  
	   
	$gonder  	= $mysqli->query(" insert into video set  
	 baslik 				='$baslik', 	  
	 video 					='$video', 	  
	 sira					= '$sira' 
	 
	  ");   
	 
	if($gonder){
		 
	  // header("Location:?sy=video&islem=basarili");	
		  
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
		 
	 
	 <div class="col-sm-2">
		 <input type="text" name="baslik" class="form-control" id="baslik" placeholder="Başlık" value="<?php echo $baslik; ?>" required >
		</div>
	  
		<div class="col-sm-6">
		<textarea name="video" class="form-control" id="video" cols="50" rows="2" placeholder="Video Kodu" required ></textarea>
			 
		</div>
	  
		<div class="col-sm-1">
		 <input type="text" name="sira" class="form-control" id="sira" placeholder="Sıra" value="<?php echo $sira; ?>" >
		</div>
		
		<div class="col-sm-2">
			<button type="submit" class="btn btn-primary ul-btn__text" value="Yeni İçerik Ekle" name="yeniekle"><i class="fa fa-plus"></i> Yeni Video Ekle</button>
		 
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
				<div class="card-title">Videolar </div>
          
<div class="form-group row">
		  
<?php  $cbak = $mysqli->query("select * from video order by sira asc ");
		while($guzyaz = $cbak->fetch_array()){
			 
	 echo ' <form class="needs-validation" novalidate="" action="" method="post" >
	   
	 <div class="col-sm-4">
		 '.$guzyaz['baslik'].' / '.$guzyaz['sira'].'
		</div>
	  
		<div class="col-sm-4">
		'.$guzyaz['video'].' 
		<input type="hidden" class="form-control"  name="gizli"   value="'.$guzyaz['id'].'"  >	 
		</div>
	   
		<div class="col-md-1 mb-1">
			  
		 <a href=""  onclick=" if ( !confirm(\'Kaydi silmek istediğinizden emin misiniz?\') ) return false;" ><button class="btn btn-danger" type="submit" value="Sil" name="guncellee" >Sil</button>	</a>
			</div>
		  			
			  </form>';
			
		}
		
		  
		if($_POST['guncellee']=="Sil"){ 
		
	 
			$baslik = $_POST['baslik1'];
			$sira 	= $_POST['sira'];
			$gizli 	= $_POST['gizli'];
			 
			$sill = $mysqli->query("delete from video where id='$gizli' ");
			  
				if($sill){
		   // header("Location:?sy=video&islem=basarili");	
		  
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
				</div>  
	