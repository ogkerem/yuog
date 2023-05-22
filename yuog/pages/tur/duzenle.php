	
	 
	 <script type="text/javascript"> 
	$(function(){
	  
	 	$("#hareketeklee").click(function(){
			
		var cikisnokta = $("select[name=cikisnokta]").val();
			
			$.ajax( {
				url:"pages/tur/hnekle.php",
				type:"post",
				data: {"cikisnokta":cikisnokta},
				success:function(ortakat1){
					 $(ortakat1).insertAfter("#hekleleme"); 
				}
			}); 
			
		});
 	
});		
	 
 </script>
 
  <script type="text/javascript"> 
	$(function(){
	   
		$(".hareketsill1").click(function(){ 
			
		// alert("demoo");
		  $(this).parent().parent().remove();
		}); 
		 
});		
	 
 </script>
 
  <script type="text/javascript"> 
	$(function(){
	   
		$(".ekstsill11").click(function(){ 
			
		// alert("demoo");
		  $(this).parent().parent().remove();
		});
});		
	 
 </script>
 
 
  <script type="text/javascript"> 
	$(function(){
	   
	 	$("#ekstrasecc").click(function(){			 
			 $.ajax( {
				url:"pages/tur/ekstraekle.php",
				type:"post",
				success:function(ortakat1){
					 $(ortakat1).insertAfter("#ozellikkk"); 
				}
			}); 
		});		 
});		
	 
 </script>
 
 
<script type="text/javascript">
	
	$(function(){
		
		$(".resimsill1").click(function(){
		   $(this).parent().remove();
		}); 
		
	}); 
 </script>
	 
	 
<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
	include("pages/tur/tur.js");
	
	$id 	= $_GET['id'];
	$yaz1 	= $mysqli->query("select * from turlar where id='$id' ");
	$yaz 	= $yaz1->fetch_array();
	$seoID 	= $yaz['seo'];
	$seobul	= $mysqli->query("select * from seo where id='$seoID' ");
	$seoyaz = $seobul->fetch_array();
	$cikisnokta1	= $yaz['cikisnokta'];
	// error_reporting(E_ALL);
	// ini_set("display_errors", 1);
	
	?>
	<div class="main-content">
	
		
   <div class="breadcrumb">
                <h1>Tur  Düzenleme</h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li><a href="?sy=turlar">Turlar</a></li>
                   
                     
                </ul>
            </div>
		 
            <div class="separator-breadcrumb border-top"></div>
  
	 	
            <div class="row">
			
			<div class="col-md-12">
                    <div class="card text-left">

                        <div class="card-body">
                           
		
	<?php 
if($_POST){ 
	
	$baslik				= addslashes(trim($_POST['baslik']));
	$gece				= trim($_POST['gece']);
	$gunduz				= trim($_POST['gunduz']);
	$katsec				= $_POST['katsec']; 
	$cikisnokta			= $_POST['cikisnokta'];	
	$turbaslik			= $_POST['turbaslik']; 
	$turaciklama		= $_POST['turaciklama']; 
	$dahilolanlar		= addslashes(trim($_POST['dahilolanlar']));
	$haricolanlar		= addslashes(trim($_POST['haricolanlar']));
	$ekbilgi			= addslashes(trim($_POST['ekbilgi']));
	$bilmemizgerekenler	= addslashes(trim($_POST['bilmemizgerekenler']));
	$turaozel			= addslashes(trim($_POST['turaozel']));
	$vizebilgisi		= addslashes(trim($_POST['vizebilgisi']));
	$notlar				= addslashes(trim($_POST['notlar']));
	$ulasim				= addslashes(trim($_POST['ulasim']));
	$guzsec				= $_POST['guzsec']; 
	$hareketsaat		= $_POST['hareketsaat']; 
	$ozellik			= $_POST['ozellik'];
	$ofiyat				= $_POST['ofiyat'];	
	$metabaslik			= addslashes(trim($_POST['metabaslik']));
	$metaaciklama		= addslashes(trim($_POST['metaaciklama']));
	$seourl				= addslashes(trim($_POST['seourl'])); 
	$gecerlilik			= tarihduzelt(trim($_POST['gecerlilik']));
	
	echo $gecerlilik; 
	
	$video				= addslashes(trim($_POST['video']));
	$yurt				= addslashes(trim($_POST['yurt']));
	$vize				= addslashes(trim($_POST['vize']));
	$description		= addslashes(trim($_POST['description']));
	$sira				= addslashes(trim($_POST['sira']));
	$hit				= addslashes(trim($_POST['hit'])); 
	
	$durum1				= $_POST['durum']; 	 
	if($durum1=="on"){ $durum = 1; } else { $durum = 0; } 
	 
	$rhedef				= "../uploads/tur/";
	$resimad			= $_FILES['resim']['name']; 
	$kresimad			= $_FILES['kresim']['name'];  
	
	$gkresim			= $_POST['gkresim']; 
	$gresim				= $_POST['gresim'];  
	
	$eskiresimler		= $_POST['eskiresimler'];	  
	$rtopluad			= $_FILES['rtoplu']['name'];
	$rtoplukaynak		= $_FILES['rtoplu']['tmp_name'];
	$say 				= count($rtopluad);
	 
	$yeniurlmiz 		=  $_POST['seourl'];
	
	$seosor		= $mysqli->query("select * from seo where seo='$yeniurlmiz' && id!='$seoID' ");
	$seoyazz	= $seosor->fetch_array(); 
	$seosay 	= $seosor->num_rows;
		 
	if($seosay>0){
		$sonurl = rand(0,100).'-'.$yeniurlmiz;
	} else { 
		$sonurl = $yeniurlmiz;
	}
	
	$seoguncelle = $mysqli->query("update seo set seo='$sonurl', durum='$durum' where id='$seoID' ");
	
	 
	$gonder  	= $mysqli->query(" update turlar set 
	 baslik 				='$baslik', 
	 gece 					='$gece', 
	 gunduz 				='$gunduz', 
	 cikisnokta 			='$cikisnokta', 
	 dahilolanlar 			='$dahilolanlar', 
	 haricolanlar			='$haricolanlar', 
	 ekbilgi				='$ekbilgi', 
	 bilmemizgerekenler		='$bilmemizgerekenler', 
	 turaozel				='$turaozel', 
	 vizebilgisi			='$vizebilgisi', 
	 notlar					='$notlar', 
	 ulasim					='$ulasim', 
	 metabaslik				='$metabaslik', 
	 metaaciklama			='$metaaciklama', 
	 gecerlilik				='$gecerlilik', 
	 video					='$video', 
	 yurt					='$yurt', 
	 vize					='$vize', 
	 description			='$description', 
	 hit					= '$hit',
	 sira					= '$sira',
	 durum					= '$durum'  
	 
	 where id='$id'
	  ");   
	  
	if($gonder){
	 
	if($resimad!=""){ 	 
		
		unlink($rhedef.$gresim);	
		$kaynak		= $_FILES['resim']['tmp_name'];
		$resimsonad = rand(0,999).'-'.yeniurl(res_adi($resimad)).res_uzanti($resimad);
		$yukle 		= move_uploaded_file($kaynak,$rhedef."/".$resimsonad); 
		$guncelle 	= $mysqli->query("update turlar set resim='$resimsonad' where id='$id' ");
	}
	 
	if($kresimad!=""){ 	 
		
		unlink($rhedef.$gkresim);		
		$kaynak1		= $_FILES['kresim']['tmp_name'];
		$resimsonad1 	= rand(0,999).'-'.yeniurl(res_adi($kresimad)).res_uzanti($kresimad);
		$yukle 			= move_uploaded_file($kaynak1,$rhedef."/".$resimsonad1); 
		$guncelle 		= $mysqli->query("update turlar set kresim='$resimsonad1' where id='$id' ");	
	}
	 
	 
	$katsay = count($katsec); 
	$katsecsil = $mysqli->query("delete from turkatsec where turID='$id' ");
	
	for($yy=0; $yy < $katsay; $yy++){	 
		 
		$kat		= $katsec[$yy]; 
		$ukatbak 	= $mysqli->query("select * from turkat where id='$kat' ");
		$ukatyaz 	= $ukatbak->fetch_array();
		$katID		= $ukatyaz['katID'];
		$ustkatID	= $ukatyaz['ustkatID'];
		$katekle	= $mysqli->query("insert into turkatsec (turID, kat , katID , ustkatID , sira , durum ) values ( '$id', '$kat', '$katID', '$ustkatID' , '$sira', '$durum')");	
		
		
		 
	 }	
	

	$turbassay 	= count($turbaslik);	
	$turbasil 	= $mysqli->query("delete from turprogram where turID='$id' "); 
	for($aa=0; $aa < $turbassay; $aa++){	
 
		$turbaslik1		= addslashes(trim($turbaslik[$aa])); 
		$turaciklama1	= addslashes(trim($turaciklama[$aa]));
		
	$turaciklamaekle	= $mysqli->query("insert into turprogram (turID, baslik, icerik ) values ('$id', '$turbaslik1', '$turaciklama1')");	
	     
	 }	
	  
	$hnoktasay 	= count($guzsec);
	$hnsil 		= $mysqli->query("delete from turguzsec where turID='$id' "); 
	for($cc=0; $cc < $hnoktasay; $cc++){	 
		$guzID			= $guzsec[$cc]; 
		$saat			= $hareketsaat[$cc]; 
	$turguzsecekle	= $mysqli->query("insert into turguzsec (turID, guzID, saat ) values ('$id', '$guzID', '$saat')");	
	    
	 }		 
	 
	
	$ekstrasay = count($ozellik);
	$ekstrasil 	= $mysqli->query("delete from turextra where turID='$id' ");
	for($dd=0; $dd < $ekstrasay; $dd++){	
 
		$ozellik1		= addslashes(trim($ozellik[$dd])); 
		$ofiyat1		= trim($ofiyat[$dd]);
		
	if($ozellik[$dd]!=""){
		$turextraekle	= $mysqli->query("insert into turextra (turID, ozellik, fiyat ) values ('$id', '$ozellik1', '$ofiyat1')");
	}
		
	      
	 }
   
	$eskiressay 	= count($eskiresimler);
	$esgun 			= $mysqli->query("update turlarres set durum='0' where turID='$id' "); 
	for($dd=0; $dd < $eskiressay; $dd++){	 
	$resID			= $eskiresimler[$dd]; 
	echo $resID.'<br>';
	$esgun 			= $mysqli->query("update turlarres set durum='1' where id='$resID' "); 
		if($esgun){
			echo 'güncellendi';
		} else {
			echo 'hataaa ';
		}
	 }		 
	 
	  
   if($rtopluad[0]!=""){		   
		for($x = 0; $x < $say; $x++){
			$rbaslik	= $rtopluad[$x];
			$rkaynak	= $rtoplukaynak[$x]; 
			$rsonadi	= md5(rand(0,9999)).'.'.res_uzanti($rbaslik); 
			
			$vyukle = $mysqli->query("insert into turlarres (turID, resim, sira, durum ) values('$id','$rsonadi', '0', '1') ");
			$yukle 	= move_uploaded_file($rkaynak,$rhedef."/".$rsonadi); 
			
		}
		 
	   }
	 
	 header("Location:?sy=turlar&islem=basarili"); 
	} else { echo '<div class="alert alert-danger" role="alert">
				<strong class="text-capitalize">Hata!</strong>Hata İşlem Başarısız :(  
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div> <br /> <a href="javascript:history.back(-1)">Geri Dön</a>'; }   	  
	 
} else { 
?>	


	<form action="" method="post" enctype="multipart/form-data" >
	
	
   <ul class="nav nav-pills" id="myPillTab" role="tablist">
   
	<li class="nav-item">
		<a class="nav-link active" id="home-icon-pill" data-toggle="pill" href="#homePIll" role="tab" aria-controls="homePIll" aria-selected="true"><i class="nav-icon i-Home1 mr-1"></i>Genel</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" id="profile-icon-pill" data-toggle="pill" href="#profilePIll" role="tab" aria-controls="profilePIll" aria-selected="false"><i class="nav-icon"></i> Tur Programı</a>
	</li>
	
	<li class="nav-item">
		<a class="nav-link" id="contact-icon-pill" data-toggle="pill" href="#contactPIll" role="tab" aria-controls="contactPIll" aria-selected="false"><i class="nav-icon "></i> Dahil & Hariç Olanlar Bilgiler</a>
	</li>
	
	<li class="nav-item">
		<a class="nav-link" id="contact-icon-pill" data-toggle="pill" href="#detaylarr" role="tab" aria-controls="detaylarr" aria-selected="false"><i class="nav-icon "></i> Detaylar </a>
	</li>
	
	
	<li class="nav-item">
		<a class="nav-link" id="contact-icon-pill" data-toggle="pill" href="#hnoktalar" role="tab" aria-controls="hnoktalar" aria-selected="false"><i class="nav-icon "></i> Hareket Noktaları </a>
	</li>
	
	<li class="nav-item">
		<a class="nav-link" id="contact-icon-pill" data-toggle="pill" href="#ekstralarr" role="tab" aria-controls="ekstralarr" aria-selected="false"><i class="nav-icon "></i> Ekstralar </a>
	</li>
	
	<li class="nav-item">
		<a class="nav-link" id="contact-icon-pill" data-toggle="pill" href="#resimlerr" role="tab" aria-controls="resimlerr" aria-selected="false"><i class="nav-icon "></i> Resim </a>
	</li>
	
	<li class="nav-item">
		<a class="nav-link" id="contact-icon-pill" data-toggle="pill" href="#verilerr" role="tab" aria-controls="verilerr" aria-selected="false"><i class="nav-icon"></i> Veri </a>
	</li>
								
								
                            </ul>
                            <div class="tab-content" id="myPillTabContent">
                               

	   <div class="tab-pane fade show active" id="homePIll" role="tabpanel" aria-labelledby="home-icon-pill">
			
	 <div class="form-group row">
		<label for="baslik" class="col-sm-2 col-form-label">Başlık * </label>
		<div class="col-sm-10">
		 <input type="text" name="baslik" class="form-control" id="baslik" placeholder="Başlık" value="<?php echo $yaz['baslik']; ?>" required >
		</div>
	</div>
										
	<div class="form-group row">
		<label for="gece" class="col-sm-2 col-form-label">Gece   </label>
		<div class="col-sm-2">
		 <input type="text" name="gece" class="form-control" id="gece" placeholder="Gece" value="<?php echo $yaz['gece']; ?>" required >
		</div>
	</div>
											
	<div class="form-group row">
		<label for="gunduz" class="col-sm-2 col-form-label">Gündüz   </label>
		<div class="col-sm-2">
		 <input type="text" name="gunduz" class="form-control" id="gunduz" placeholder="Gündüz" value="<?php echo $yaz['gunduz']; ?>" required >
		</div>
	</div>
												
	<div class="form-group row">
		<label for="katID" class="col-sm-2 col-form-label">Kategoriler  </label>
		<div class="col-sm-10">
		 
		  <label for="katID"  > </label>
		 
		 <select class="form-control" name="katsec[]" multiple >
		 
			<?php 
				$ukat  = $mysqli->query("select * from turkat where katID!='0' && ustkatID!='0' order by sira asc ");
					while($uyaz = $ukat->fetch_array()){
						
					$katID1 	= $uyaz['katID'];
					$ukatba 	= $mysqli->query("select * from turkat where id='$katID1' ");
					$uuyaz 		= $ukatba->fetch_array();
					
					$ustkatID1 	= $uyaz['ustkatID'];
					$ukatbak 	= $mysqli->query("select * from turkat where id='$ustkatID1' ");
					$uyazz 		= $ukatbak->fetch_array();
					$ukatID		= $uyaz['id'];	
					
					$katsorr	= $mysqli->query("select * from turkatsec where turID='$id' && kat='$ukatID' ");
					$katsayy 	= $katsorr->num_rows;
					
					
						if($katsayy>0){
			echo '<option value='.$uyaz['id'].' selected >'.$uyazz['baslik'].' ->'.$uuyaz['baslik'].' -> '.$uyaz['baslik'].'</option>'; 				
						} else {
			echo '<option value='.$uyaz['id'].' >'.$uyazz['baslik'].' ->'.$uuyaz['baslik'].' -> '.$uyaz['baslik'].'</option>'; 				
						}
						
					}
			
			?>			
					 
		 </select>
			<small id="resim" class="ul-form__text form-text "> CTRL basılı tutup birden fazla seçebilirsiniz  </small>	 						
		</div>
		 
		
	</div>
							
 											
	<div class="form-group row">
		<label for="katID" class="col-sm-2 col-form-label">Çıkış Noktası  </label>
		<div class="col-sm-10">
		 
		  <label for="katID"  > </label>
					<select class="form-control" name="cikisnokta" >
					 
			<?php 
				$cikbak  = $mysqli->query("select * from turcikisnokta  order by sira asc ");
					while($cikyaz = $cikbak->fetch_array()){
						 
						 if($yaz['cikisnokta']==$cikyaz['id']){
						echo '<option value='.$cikyaz['id'].' selected >'.$cikyaz['baslik'].'</option>'; 	 
						 } else {
						echo '<option value='.$cikyaz['id'].' >'.$cikyaz['baslik'].'</option>'; 	 
						 }
						
					}
			
			?>			
					 
		 </select>
 				
		</div> 
		
	</div>  
			
		</div>
								
	
	<div class="tab-pane fade" id="profilePIll" role="tabpanel" aria-labelledby="profile-icon-pill">
		
		
		
  
	 		
	<div id="tbaslikk">
	
	<?php  $ttbakk = $mysqli->query("select * from turprogram where turID='$id' ");
		while($ttyaz = $ttbakk->fetch_array()){
		 
	?>
 <div class="form-group row">
		<label for="turbaslik" class="col-sm-2 col-form-label"> Program Başlık  </label>
		<div class="col-sm-10">
		  
	<input type="text" name="turbaslik[]" class="form-control" id="turbaslik" placeholder="Tur Başlık" value="<?php echo $ttyaz['baslik']; ?>" required >
		
		</div>
	</div>
	
 
	<div class="form-group row">
		<label for="turaciklama" class="col-sm-2 col-form-label"> Açıklama  </label>
		<div class="col-sm-10">
		<textarea name="turaciklama[]" class="ckeditor" id="turaciklama" cols="40" rows="3"><?php echo $ttyaz['icerik']; ?></textarea>
	  
		</div> 
	</div>
	 	
		<?php } ?>		
	</div>
	 <button type="button" class="btn btn-raised ripple btn-raised-success m-1" id="yenigunekle"> <i class="fa fa-plus"></i> Yeni Gün Ekle </button>
	  
	</div>
								
								
	<div class="tab-pane fade" id="contactPIll" role="tabpanel" aria-labelledby="contact-icon-pill">

 
 
	<div class="form-group row">
		<label for="dahilolanlar" class="col-sm-2 col-form-label"> Dahili Olanlar </label>
		<div class="col-sm-10">
		<textarea name="dahilolanlar" class="ckeditor" id="dahilolanlar" cols="40" rows="3"><?php echo $yaz['dahilolanlar']; ?></textarea>
	 
   
		</div> 
	</div>
	
	
 
	<div class="form-group row">
		<label for="haricolanlar" class="col-sm-2 col-form-label"> Harici Olanlar </label>
		<div class="col-sm-10">
		<textarea name="haricolanlar" class="ckeditor" id="haricolanlar" cols="40" rows="3"><?php echo $yaz['haricolanlar']; ?></textarea>
	 
   
		</div> 
	</div>
	
	
 
	<div class="form-group row">
		<label for="ekbilgi" class="col-sm-2 col-form-label"> Ek Bilgi </label>
		<div class="col-sm-10">
		<textarea name="ekbilgi" class="ckeditor" id="ekbilgi" cols="40" rows="3"><?php echo $yaz['ekbilgi']; ?></textarea>
	 
   
		</div> 
	</div>
	
 
	<div class="form-group row">
		<label for="bilmemizgerekenler" class="col-sm-2 col-form-label"> Bilmemiz Gerekenler </label>
		<div class="col-sm-10">
		<textarea name="bilmemizgerekenler" class="ckeditor" id="ekbilgi" cols="40" rows="3"><?php echo $yaz['bilmemizgerekenler']; ?></textarea>
	 
   
		</div> 
	</div>
	
	<div class="form-group row">
		<label for="turaozel" class="col-sm-2 col-form-label"> Tura Özel </label>
		<div class="col-sm-10">
		<textarea name="turaozel" class="ckeditor" id="turaozel" cols="40" rows="3"><?php echo $yaz['turaozel']; ?></textarea>
	 
   
		</div>

<small id="web" class="ul-form__text form-text "> Bu turu anlatan 150 - 200 karakter arasında kısa özet </small>
		
	</div>
	
	
	
	</div>							
	<div class="tab-pane fade" id="detaylarr" role="tabpanel" aria-labelledby="contact-icon-pill">

  
	
	 
	
 
 	<div class="form-group row">
		<label for="vizebilgisi" class="col-sm-2 col-form-label"> Vize Bilgisi</label>
		<div class="col-sm-10">
		<textarea name="vizebilgisi" class="ckeditor" id="vizebilgisi" cols="40" rows="3"><?php echo $yaz['vizebilgisi']; ?></textarea>
	 
   
		</div>

 
		
	</div>
		 
 
 	<div class="form-group row">
		<label for="notlar" class="col-sm-2 col-form-label"> Notlar</label>
		<div class="col-sm-10">
		<textarea name="notlar" class="ckeditor" id="notlar" cols="40" rows="3"><?php echo $yaz['notlar']; ?></textarea>
	 
   
		</div>
 
		
	</div>
		 
 
 	<div class="form-group row">
		<label for="ulasim" class="col-sm-2 col-form-label"> Ulaşım Bilgileri</label>
		<div class="col-sm-10">
		<textarea name="ulasim" class="ckeditor" id="ulasim" cols="40" rows="3"><?php echo $yaz['ulasim']; ?></textarea>
	 
   
		</div>

<small id="web" class="ul-form__text form-text "> Uçak veya diğer ulaşım bilgileri </small>
		
	</div>
	
	
	</div>
    
<div class="tab-pane fade" id="hnoktalar" role="tabpanel" aria-labelledby="contact-icon-pill">
  	
 <div class="row" id="" >
    <div class="col-4  ">
     <h4> Hareket Noktası </h4>
    </div>
    <div class="col-2  ">
     <h4> Saat </h4>   
    </div>
    <div class="col-2 ">
      <button type="button" class="btn btn-raised ripple btn-raised-success m-1" id="hareketeklee"> <i class="fa fa-plus"></i> Yeni Ekle </button>
    </div>
 </div>
		
	<?php 
	$aaa = 1; 
	$guzsecbak = $mysqli->query("select * from turguzsec where turID='$id' order by id asc ");
		while($guzsyaz = $guzsecbak->fetch_array()){
		 
	?>	
   <div class="row" id="hekleleme" >
    <div class="col-4  ">
    
	   <select class="form-control" name="guzsec[]" >
	  <option value="">Hareket Noktası Seç  </option>
			<?php 
				$gbakk  = $mysqli->query("select * from turcikisnokta  where katID='$cikisnokta1' order by sira asc ");
					while($guzyaz = $gbakk->fetch_array()){
						 
					if($guzsyaz['guzID']==$guzyaz['id']){
						echo '<option value='.$guzyaz['id'].' selected >'.$guzyaz['baslik'].'  </option>'; 
					} else{
						echo '<option value='.$guzyaz['id'].' >'.$guzyaz['baslik'].' </option>'; 
					}
						
					}
			
			?>			
					 
	 </select>   
	  
    </div>
    <div class="col-2  ">
      <input type="text" class="form-control" id="validationCustom02" name="hareketsaat[]" placeholder="14:00" value="<?php echo $guzsyaz['saat']; ?>"  >
    </div>
    <div class="col-2 ">
	 
	   <button type="button" class="btn btn-raised ripple btn-raised-danger m-1 hareketsill1" id=""> <i class="fa fa-minus"></i> Sil </button>
	   
	 
    </div>
 </div>  
		 
		<?php 
		$aaa++; 
		} ?>
			
</div>	
					  

<div class="tab-pane fade" id="ekstralarr" role="tabpanel" aria-labelledby="contact-icon-pill">
 
  <div class="row pb-2" id="" >
    <div class="col-4  ">
     <h4> Özellik </h4>
    </div>
    <div class="col-2  ">
     <h4> Fiyat </h4>   
    </div>
    <div class="col-2 ">
   

    </div>
 </div>
 
 <?php 
	$ccc = 1;
 $ozbak = $mysqli->query("select * from turextra where turID='$id' order by id asc ");
	while($ozyazz = $ozbak->fetch_array()){
	 
 ?>
	  
  <div class="row" id="ozellikkk" >
    <div class="col-4  ">
     <input type="text" name="ozellik[]" class="form-control" id="validationCustom02" placeholder="Özellik" value="<?php echo $ozyazz['ozellik']?>"  >
    </div>
    <div class="col-2  ">
    <input type="text" name="ofiyat[]" class="form-control" id="validationCustom02" placeholder="Fiyat" value="<?php echo $ozyazz['fiyat']?>"  >
    </div>
    <div class="col-2 ">
	
	<?php if($ccc==1){ ?>
        <button type="button" class="btn btn-raised ripple btn-raised-success m-1" id="ekstrasecc"> <i class="fa fa-plus"></i> Yeni Ekle </button>
	<?php } else { ?>
	<button type="button" class="btn btn-raised ripple btn-raised-danger m-1 ekstsill11" id=""> <i class="fa fa-minus"></i> Sil </button>
	<?php } ?>
    </div>
 </div>
 
	 
	<?php $ccc++; } ?> 
	 
</div>


<div class="tab-pane fade" id="resimlerr" role="tabpanel" aria-labelledby="contact-icon-pill">
	
	
	
   
	 <div class="form-group row">
		<label for="kresim" class="col-sm-2 col-form-label">Küçük Resim * </label>
		<div class="col-sm-2">
		  <input type="file" name="kresim" class="form-control" id="kresim" placeholder="Küçük Resim Boyutu"   > 
		  <input type="hidden" name="gkresim"  value="<?php echo $yaz['kresim']; ?>"   > 
		 
			 				
		</div>
	<a href="../uploads/tur/<?php echo $yaz['kresim']; ?>" target="_blank" >
	<img src="../uploads/tur/<?php echo $yaz['kresim']; ?>" title="Küçük Resim" alt="Küçük Resim" style="background-color:#ddd; width:50px; "></a>
	</div>
	
	 
 <div class="form-group row">
		<label for="resim" class="col-sm-2 col-form-label">Resim * </label>
		<div class="col-sm-2">
		  <input type="file" name="resim" class="form-control" id="resim" placeholder="Küçük Resim Boyutu"   > 
			 	<small id="resim" class="ul-form__text form-text "> Yeni resim istemiyorsanız işlem yapmayınız </small>	
 
			<input type="hidden" name="gresim"  value="<?php echo $yaz['resim']; ?>"   > 
		  
		</div>
	 
	 <a href="../uploads/tur/<?php echo $yaz['resim']; ?>" target="_blank" >
	 <img src="../uploads/tur/<?php echo $yaz['resim']; ?>" title="Büyük Resim" alt="Büyük Resim" style="background-color:#ddd; width:100px; "></a>
	 
	 
	</div>
	
	<hr/>
	   
	   
	
	
 <div class="form-group row" id="yenirsimmm">
	<label for="resim" class="col-sm-2 col-form-label">Yeni Resimler Ekle </label>
	
	<div class="col-12">
	<div class="col-sm-2 float-left">
	
	<input type="file" name="rtoplu[]" multiple="multiple" class="form-control" id="resim" placeholder="Resimler"  style="float:left; " > 
	  <small id="web" class="ul-form__text form-text "> Birden fazla resim seçebilirsiniz </small>
	 </div>
		 
	 </div>
		
		<hr/>
		
	 
	<?php $ressbakk = $mysqli->query("select * from turlarres where turID='$id' && durum='1' "); 
	
		while($ressyaz = $ressbakk->fetch_array()){
			
			echo '<div class="col-sm-2">
	   
<a href="../uploads/tur/'.$ressyaz['resim'].'" target="_blank" >
<img src="../uploads/tur/'.$ressyaz['resim'].'" title="Büyük Resim" alt="Büyük Resim" style="background-color:#ddd;  height:100px; "></a>
<input type="hidden" name="eskiresimler[]" value="'.$ressyaz['id'].'"> 
	<br/>
	<br/> 
	 <a class="btn btn-danger text-white btn-rounded resimsill1 " href="#"> Resmi Sil </a> 
	</div>'; 
	
		}
	
	?>	
  
	 
 </div>
	
	
	
	
</div>
<div class="tab-pane fade" id="verilerr" role="tabpanel" aria-labelledby="contact-icon-pill">
	
	
	
	 <div class="form-group row">
		<label for="metabaslik" class="col-sm-2 col-form-label">Meta Başlık </label>
		<div class="col-sm-10">
<input type="text" name="metabaslik" class="form-control" id="metabaslik" placeholder="metabaslik" value="<?php echo $yaz['metabaslik']; ?>" > 
			
 							
		</div>
		 
	</div>
	
	
	<div class="form-group row">
		<label for="metaaciklama" class="col-sm-2 col-form-label"> Meta Açıklaması </label>
		<div class="col-sm-10">
		<textarea name="metaaciklama"  class="ckeditor" id="metaaciklama" cols="40" rows="3"><?php echo $yaz['metaaciklama']; ?></textarea>
	 
   
		</div>
  
	</div>
	
	
		
	<div class="form-group row">
		<label for="seourl" class="col-sm-2 col-form-label">Seo URL * </label>
		<div class="col-sm-6">
		  <input type="text" name="seourl" class="form-control" id="seourl" placeholder="Seo URL" value="<?php echo $seoyaz['seo']; ?>"  > 
			
 							
		</div>
		 
	</div>
		
		 
		
		<div class="form-group row">
		<label for="gecerlilik" class="col-sm-2 col-form-label">Geçerlilik Tarihi </label>
		<div class="col-sm-2">
		
 <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

   
  <input type="text" name="gecerlilik" class="form-control" id="datepicker" placeholder="MM/DD/YYYY" value="<?php echo tduzyaz($yaz['gecerlilik']); ?>" autocomplete="off" > 
   <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap'
        });
    </script>
	
	  
	  				
		</div>
		
		<div class="col-sm-4">
	 
	 MM/DD/YYYY => 02/29/2020 gibi  
		</div>
		
	 
		
		 
	</div>	 
		
		<div class="form-group row">
		<label for="video" class="col-sm-2 col-form-label">Video/Çalma Listesi Bağlantısı </label>
		<div class="col-sm-10">
		  <input type="text" name="video" class="form-control" id="video" placeholder="Video Linki" value="<?php echo $yaz['video']; ?>" > 
			
 							
		</div>
		 
	</div>	
	
	
		<div class="form-group row" >
		<label for="yurt" class="col-sm-2 col-form-label">Yurt İçi / Yurt Dışı </label>
		<div class="col-sm-10">
		  
			 
		 <select class="form-control" name="yurt" >
					 
 <option value="Yurt İçi" <?php if($yaz['yaz']=="Yurt İçi"){ echo 'selected'; }?>>Yurt İçi  </option> 
 <option value="Yurt Dışı" <?php if($yaz['yaz']=="Yurt Dışı"){ echo 'selected'; }?>>Yurt Dışı  </option> 
					 
		 </select>
		 
		 
 							
		</div>
		 
	</div>
	 
		 
	<div class="form-group row" id="vizee" style="<?php if($yaz['vize']=="Vize Yok"){ echo 'display:none;'; }?> " >
		<label for="vize" class="col-sm-2 col-form-label"> Vize İşlemleri </label>
		<div class="col-sm-10">
		   
		 <select class="form-control" name="vize" >
					 
			 <option value="Vize Var" <?php if($yaz['vize']=="Vize Var"){ echo 'selected'; }?> > Vize Var  </option> 
			 <option value="Vize Yok" <?php if($yaz['vize']=="Vize Yok"){ echo 'selected'; }?> > Vize Yok  </option> 
					 
		 </select>
		 
		 
 							
		</div>
		 
	</div>
				
	<!--	<div class="form-group row">
	<label for="description" class="col-sm-2 col-form-label">Description </label>
	<div class="col-sm-10">
	  <input type="text" name="description" class="form-control" id="description" placeholder="Description" value="<?php echo $yaz['description']; ?>" > 
		
						
		</div>
		 
	</div>  -->
					
	<div class="form-group row">
	<label for="sira" class="col-sm-2 col-form-label">Sıra </label>
	<div class="col-sm-2">
	  <input type="text" name="sira" class="form-control" id="sira" placeholder="Sıra" value="<?php echo $yaz['sira']; ?>" > 
		
						
		</div>
		 
	</div>
						
	<div class="form-group row">
	<label for="hit" class="col-sm-2 col-form-label">Hit </label>
	<div class="col-sm-2">
	  <input type="text" name="hit" class="form-control" id="hit" placeholder="Hit" value="<?php echo $yaz['hit']; ?>" > 
		
						
		</div>
		 
	</div>
		
		<div class="form-group row">
	<label for="durum" class="col-sm-2 col-form-label">Durum </label>
	<div class="col-sm-2">
	 
	<label class="switch switch-primary mr-3" id="durum">
		 
		  <input name="durum" type="checkbox" <?php if($yaz['durum']=="1"){ echo 'checked'; }?>  > 
		  
		<span class="slider"></span>
	</label>
							
							
	 	
		</div>
		
		</div>
		
		<div class="form-group row">
	<label for="sira" class="col-sm-2 col-form-label">  </label>
		<div class="col-sm-10">
			<button type="submit" class="btn btn-primary ul-btn__text">İçerik Güncelle</button>
		 
		</div>
	</div>
	
		
		
</div> 
				
 </div>
							
		 </form>
							
<?php } ?>					
			</div>
		</div>
	</div> 
  </div>
</div> 