	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
	$konu 	= "iletisim";
  
	$id 	= $_GET['id'];
	$yaz1 	= $mysqli->query("select * from $konu where id='$id' ");
	$yaz 	= $yaz1->fetch_array();
	
	// $seoID 	= $yaz['seo'];
	// $seobul	= $mysqli->query("select * from seo where id='$seoID' ");
	// $seoyaz = $seobul->fetch_array();
	// $dil 	= $yaz['dil']; 
	// $dilbul = $mysqli->query("select * from diller where id='$dil' ");
	// $dilyaz = $dilbul->fetch_array();
	
	?>
	 
	 <div class="main-content">
	
   <div class="breadcrumb">
                <h1><a href="?sy=<?php echo $konu; ?>">İletişimler</a>    </h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li>İçerik Güncelleme</li>
                  
                     
                </ul>
            </div>
		 
		  
<script type="text/javascript">
	
	$(function(){
		
		$(".resimsill1").click(function(){
		   $(this).parent().remove();
		   return false;
		}); 
		
	}); 
 </script>
	 
	 
	 
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
                   
                    <p>  </p>
                    <div class="card mb-5">
                        <div class="card-body">
 
					
						<?php 
if($_POST){ 
	
	$olay				= addslashes(trim($_POST['olay']));
 
	$durum1				= $_POST['durum']; 	
	if($durum1=="on"){ $durum = 1; } else { $durum = 0; }
	
	$gonder  	= $mysqli->query(" update $konu set  
		
		olay				= '$olay', 
		durum				= '$durum'  
		
		where id='$id'
	 
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
		<label for="baslik" class="col-sm-2 col-form-label">Olay  </label>
		<div class="col-sm-6">
		  <?php echo $yaz['olay']; ?>
		  <input type="hidden" value="<?php echo $yaz['olay']; ?>" name="olay"> 
		</div>
	</div>
	
	<div class="form-group row">
		<label for="onyazi" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Ad Soyad </label>
		<div class="col-sm-6">
		 <?php echo $yaz['adsoyad']; ?> 
		</div>
	</div>
	
	
 
	   
		<div class="form-group row">
		<label for="adres" class="col-sm-2 col-form-label"> Mail Adresi   </label>
		<div class="col-sm-6">
		  <?php echo $yaz['mail']; ?> 
		</div>
	</div>  
	 	
 	<!-- <div class="form-group row">
		<label for="telefon" class="col-sm-2 col-form-label">CV Dosyası  </label>
		<div class="col-sm-6">
		  <a href="../uploads/<?php echo $yaz['dosya']; ?>" target="_blank"><?php echo $yaz['dosya']; ?></a>
		</div>
	</div> -->
	  
	
	<!-- 	
 	<div class="form-group row">
		<label for="faks" class="col-sm-2 col-form-label">Konu </label>
		<div class="col-sm-6">
		 <?php echo $yaz['konu']; ?>
		</div>
	</div>
	   -->
	
	 	
 	<div class="form-group row">
		<label for="faks" class="col-sm-2 col-form-label">Telefon </label>
		<div class="col-sm-6">
		 <?php echo $yaz['tel']; ?>
		</div>
	</div>
	 
		
	<div class="form-group row">
		<label for="eposta" class="col-sm-2 col-form-label"> Tarih  </label>
		<div class="col-sm-6">
		 <?php echo $yaz['tarih']; ?> 
		</div>
	</div>  
 	
		
	<div class="form-group row">
		<label for="calisma" class="col-sm-2 col-form-label"> İçerik </label>
		<div class="col-sm-6">
		  <?php echo $yaz['icerik']; ?> 
		</div>
	</div>  

 
   
	
		<div class="form-group row">
	<label for="durum" class="col-sm-2 col-form-label">Durum (Okunma)</label>
	<div class="col-sm-2">
	  
	<label class="switch switch-primary mr-3" id="durum">
		 
	 <input name="durum" type="checkbox" <?php if($yaz['durum']=="1"){ echo 'checked'; }?>  > 
		  
		<span class="slider"></span>
	</label>
			 
		</div>
		
		</div>
		
		 <hr/>	

 
 
 
<div class="form-group row">
	<label for="eklemetarih" class="col-sm-2 col-form-label">IP </label>
	<div class="col-sm-2">
	 <?php echo $yaz['ip']; ?>  
		</div>
		 
	</div>	
 
 
 
	<div class="form-group row">
	<label for="sira" class="col-sm-2 col-form-label">  </label>
		<div class="col-sm-10">
			<button type="submit" class="btn btn-primary ul-btn__text">İçerik Güncelle</button>
		 
		</div>
	</div>
	
</form>

<?php } ?>
		</div>
	</div>
</div>
</div>
            
  </div>  		
 			