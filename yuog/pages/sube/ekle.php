	<?php 
	 
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
	$konu 		= "sube";
 
	
	
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
	
	$katID	= @$_GET['katID'];
	if($katID!=""){ 
	$katbak = $mysqli->query("select * from $konu where id='$katID'");
	$katyaz = $katbak->fetch_array();
	 
	}
	 
	?>
	<div class="main-content">
	
   <div class="breadcrumb">
                <h1><a href="?sy=<?php echo $konu; ?>">Şubeler</a> > <?php echo $dilyaz['baslik']; ?>  </h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li> İçerik Ekleme </li>
                  
                     
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
                   
                    <p>  </p>
                    <div class="card mb-5">
                        <div class="card-body">
 
					
						<?php 
if($_POST){ 
	 
	$baslik				= addslashes(trim($_POST['baslik']));
	$onyazi				= addslashes(trim($_POST['onyazi']));
	$telefon			= addslashes(trim($_POST['telefon']));
	$faks				= addslashes(trim($_POST['faks']));
	$adres				= addslashes(trim($_POST['adres']));
	$eposta				= addslashes(trim($_POST['eposta']));
	$calisma			= addslashes(trim($_POST['calisma']));
	$mkroki				= addslashes(trim($_POST['mkroki']));
	$tarif				= addslashes(trim($_POST['tarif']));
	  
	$sira				= trim($_POST['sira']); 
	 
	$durum				= 1;
	$ekleyen			= $email;  
	$ip					= $_SERVER['REMOTE_ADDR']; 
	 
	 
	$gonder  	= $mysqli->query(" insert into $konu set 
	
		baslik 				= '$baslik', 
		onyazi 				= '$onyazi', 
		telefon				= '$telefon',
		faks				= '$faks',
		adres				= '$adres',
		eposta				= '$eposta',
		calisma				= '$calisma',
		mkroki				= '$mkroki',
		tarif				= '$tarif',  
		ip					= '$ip', 
		tarih				= now(),
		ekleyen				= '$ekleyen', 
		sira				= '$sira',	 
		durum				= '$durum'  
	 
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
	
<!-- <div class="form-group row">
		<label for="baslik" class="col-sm-2 col-form-label"><i class="fa fa-language"></i> İçerik Dili * </label>
		<div class="col-sm-6">
		
		<?php $dilbak1 = $mysqli->query("select * from diller  "); 
		while($dilyaz1 = $dilbak1->fetch_array()){
			if($dilyaz1['id']==$dil){
			
	echo '<a href="?sy='.$konu.'ekle&dil='.$dilyaz1['id'].'"><button type="button" class="btn btn-raised btn-raised-primary m-1">'.$dilyaz1['baslik'].'</button></a> ';
	
			} else {
			
	echo '<a href="?sy='.$konu.'ekle&dil='.$dilyaz1['id'].'"><button type="button" class="btn btn-outline-primary m-1">'.$dilyaz1['baslik'].'</button></a> ';
	
			}
		
		}				
						?>
			 
		</div>
	</div>	-->

<div class="form-group row">
		<label for="baslik" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Başlık * </label>
		<div class="col-sm-6">
		 <input type="text" name="baslik" class="form-control" id="baslik" placeholder="Başlık" value="" required >
		</div>
	</div>
	
<div class="form-group row">
		<label for="onyazi" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Kurum Adı </label>
		<div class="col-sm-6">
		 <input type="text" name="onyazi" class="form-control" id="onyazi" placeholder="Kurum Adı" value=""  >
		</div>
	</div>
	
	   
		<div class="form-group row">
		<label for="adres" class="col-sm-2 col-form-label"> Adres </label>
		<div class="col-sm-6">
		 <input type="text" name="adres" class="form-control" id="adres" placeholder="Adres" value=""   >
		</div>
	</div>  
	 	
 	<div class="form-group row">
		<label for="telefon" class="col-sm-2 col-form-label">Telefon   </label>
		<div class="col-sm-6">
		 <input type="text" name="telefon" class="form-control" id="telefon" placeholder="Telefon" value=""   >
		</div>
	</div>
	  
	
	 	
 	<div class="form-group row">
		<label for="faks" class="col-sm-2 col-form-label">Faks   </label>
		<div class="col-sm-6">
		 <input type="text" name="faks" class="form-control" id="faks" placeholder="Faks" value=""   >
		</div>
	</div>
	 
		
	<div class="form-group row">
		<label for="eposta" class="col-sm-2 col-form-label"> E-Posta   </label>
		<div class="col-sm-6">
		 <input type="text" name="eposta" class="form-control" id="eposta" placeholder="E-Posta" value=""   >
		</div>
	</div>  
 	
		
	<div class="form-group row">
		<label for="calisma" class="col-sm-2 col-form-label"> Çalışma Saatleri   </label>
		<div class="col-sm-6">
		 <input type="text" name="calisma" class="form-control" id="calisma" placeholder="Çalışma Saatleri" value=""   >
		</div>
	</div>  
 
 
   <div class="form-group row">
		<label for="mkroki" class="col-sm-2 col-form-label"> Merkez Kroki </label>
		<div class="col-sm-10">
		<textarea name="mkroki" class="form-control" id="mkroki" cols="50" rows="2" placeholder="Merkez Kroki" > </textarea>
			 
		</div>
	</div>   
 
 
 
   <div class="form-group row">
		<label for="tarif" class="col-sm-2 col-form-label"> Tarif </label>
		<div class="col-sm-10">
		<textarea name="tarif" class="form-control" id="tarif" cols="50" rows="2" placeholder="Tarif" > </textarea>
			 
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
			<button type="submit" class="btn btn-primary ul-btn__text">İçerik Ekle</button>
		 
		</div>
	</div>
	
		</form>

			<?php } ?>
				</div>
			</div>
		</div>
	</div>            
</div> 
				