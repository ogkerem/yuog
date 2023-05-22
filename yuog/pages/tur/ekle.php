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
 
  
<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
	include("pages/tur/tur.js");
	
	?>
	<div class="main-content">
	
		
   <div class="breadcrumb">
                <h1>Tur  Ekleme</h1>
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
	$tursira			= $_POST['tursira']; 	
	
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
 
	$video				= addslashes(trim($_POST['video']));
	$yurt				= addslashes(trim($_POST['yurt']));
	$vize				= addslashes(trim($_POST['vize']));
	$description		= addslashes(trim($_POST['description']));
	$sira				= (int)addslashes(trim($_POST['sira']));
	
	$durum1				= $_POST['durum']; 	 
	if($durum1=="on"){ $durum = 1; } else { $durum = 0; }
	
	$hit				= 1; 
	$ekleyen			= $_SESSION['admin']['mail'];  
	$ip					= $_SERVER['REMOTE_ADDR']; 
	
	$rhedef				= "../uploads/tur/";
	$resimad			= $_FILES['resim']['name']; 
	$kaynak				= $_FILES['resim']['tmp_name']; 
	$resimsonad 		= rand(0,999).'-'.yeniurl(res_adi($resimad)).res_uzanti($resimad);
	$kresimsonad 		= 'mini-'.$resimsonad;	
	 
	$rtopluad			= $_FILES['rtoplu']['name']; 
	$rtoplukaynak		= $_FILES['rtoplu']['tmp_name'];
	$say 				= count($rtopluad);
	
	 
	$yeniurlmiz =  $_POST['seourl'];
	
	$seosor		= $mysqli->query("select * from seo where seo='$yeniurlmiz' ");
	$seoyazz	= $seosor->fetch_array(); 
	$seosay 	= $seosor->num_rows;
		 
	if($seosay>0){
		$sonurl = rand(0,100).'-'.$yeniurlmiz;
	} else { 
		$sonurl = $yeniurlmiz;
	}
	 
	$seoekle 		= $mysqli->query("insert into seo (seo,konu,durum) values ('$sonurl', 'turlar', '$durum' )");	
	$seoID			= $mysqli->insert_id;
	   
	$gonder  	= $mysqli->query(" insert into turlar set 
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
	 kresim					='$kresimsonad', 
	 resim					='$resimsonad', 
	 ip						='$ip', 
	 tarih					= now(),
	 ekleyen				= '$ekleyen',
	 seo					= '$seoID',
	 hit					= '$hit',
	 sira					= '$sira',
	 durum					= '$durum'  
	 
	  ");   
	  
	if($gonder){
		
	$turID		= $mysqli->insert_id;
	  
	$katsay = count($katsec); 
	for($yy=0; $yy < $katsay; $yy++){	 
		$kat		= $katsec[$yy]; 
		$ukatbak 	= $mysqli->query("select * from turkat where id='$kat' ");
		$ukatyaz 	= $ukatbak->fetch_array();
		$katID		= $ukatyaz['katID'];
		$ustkatID	= $ukatyaz['ustkatID'];
		$katekle	= $mysqli->query("insert into turkatsec (turID, kat , katID , ustkatID, sira , durum) values ( '$turID', '$kat', '$katID', '$ustkatID' , '$sira', '$durum' )");	
		 
	 }		
	
	$turbassay = count($turbaslik);	
	for($aa=0; $aa < $turbassay; $aa++){	
 
		$turbaslik1		= addslashes(trim($turbaslik[$aa])); 
		$turaciklama1	= addslashes(trim($turaciklama[$aa]));
		$tursira1		= addslashes(trim($tursira[$aa]));
		
 $turaciklamaekle	= $mysqli->query("insert into turprogram (turID, baslik, icerik, sira ) values ('$turID', '$turbaslik1', '$turaciklama1', '$tursira1')");	
	     
	 }		
	 
	$hnoktasay = count($guzsec);	
	for($cc=0; $cc < $hnoktasay; $cc++){	
 
		$guzID			= $guzsec[$cc]; 
		$saat			= $hareketsaat[$cc];
		
 $turguzsecekle	= $mysqli->query("insert into turguzsec (turID, guzID, saat ) values ('$turID', '$guzID', '$saat')");	
	    
	 }		 
	 
	$ekstrasay = count($ozellik);	
	for($dd=0; $dd < $ekstrasay; $dd++){	
 
		$ozellik1		= addslashes(trim($ozellik[$dd])); 
		$ofiyat1		= trim($ofiyat[$dd]);
		
	if($ozellik[$dd]!=""){
		$turextraekle	= $mysqli->query("insert into turextra (turID, ozellik, fiyat ) values ('$turID', '$ozellik1', '$ofiyat1')");
	}
		
	      
	 }		
	 
	$yukle 		= move_uploaded_file($kaynak,$rhedef."/".$resimsonad);	
	
	kucult($rhedef, $resimsonad);	
		  
	   if($rtopluad[0]!=""){
			   
			   
			for($x = 0; $x < $say; $x++){
				$rbaslik	= $rtopluad[$x];				 
				$rkaynak	= $rtoplukaynak[$x]; 
				$rsonadi	= md5(rand(0,9999)).'.'.res_uzanti($rbaslik);
				
				echo $rbaslik.' =>'.$rkaynak.'=>'.$rsonadi; 
				
				 
				$vyukle = $mysqli->query("insert into turlarres (turID, resim, sira, durum ) values('$turID','$rsonadi', '0', '1') ");
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
		 <input type="text" name="baslik" class="form-control" id="baslik" placeholder="Başlık" value="<?php echo $baslik; ?>" required >
		</div>
	</div>
										
	<div class="form-group row">
		<label for="gece" class="col-sm-2 col-form-label">Gece   </label>
		<div class="col-sm-2">
		 <input type="text" name="gece" class="form-control" id="gece" placeholder="Gece" value="<?php echo $gece; ?>" required >
		</div>
	</div>
											
	<div class="form-group row">
		<label for="gunduz" class="col-sm-2 col-form-label">Gündüz   </label>
		<div class="col-sm-2">
		 <input type="text" name="gunduz" class="form-control" id="gunduz" placeholder="Gündüz" value="<?php echo $gunduz; ?>" required >
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
					
						echo '<option value='.$uyaz['id'].' >'.$uyazz['baslik'].' ->'.$uuyaz['baslik'].' -> '.$uyaz['baslik'].'</option>'; 
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
				$cikbak  = $mysqli->query("select * from turcikisnokta where katID='0' order by sira asc ");
					while($cikyaz = $cikbak->fetch_array()){
						 
						echo '<option value='.$cikyaz['id'].' >'.$cikyaz['baslik'].'</option>'; 
					}
			
			?>			
					 
		 </select>
 				
		</div>
		
			
		
		
	</div>
			
			
			
		</div>
								
	
	<div class="tab-pane fade" id="profilePIll" role="tabpanel" aria-labelledby="profile-icon-pill">
		
		
		
  
	 		
	<div id="tbaslikk">
 <div class="form-group row">
		<label for="turbaslik" class="col-sm-2 col-form-label"> Program Başlık  </label>
		<div class="col-sm-10">
		  
	<input type="text" name="turbaslik[]" class="form-control" id="turbaslik" placeholder="Tur Başlık" value="<?php echo $baslik; ?>" required >
		
		</div>
	</div>
	
 
	<div class="form-group row">
		<label for="turaciklama" class="col-sm-2 col-form-label"> Açıklama  </label>
		<div class="col-sm-10">
		<textarea name="turaciklama[]" class="ckeditor" id="turaciklama" cols="40" rows="3"><?php echo $icerik; ?></textarea>
	  
		</div> 
	</div>
	 	 
		 <div class="form-group row">
	<label for="sira" class="col-sm-2 col-form-label">Sırası </label>
	<div class="col-sm-2">
	  <input type="text" name="tursira[]" class="form-control" id="sira" placeholder="Sıra" value="<?php echo $sira; ?>" > 
		
						
		</div>
		 
	</div>
	
	</div>
	
	 <button type="button" class="btn btn-raised ripple btn-raised-success m-1" id="yenigunekle"> <i class="fa fa-plus"></i> Yeni Gün Ekle </button>
	 
	 
	</div>
								
								
	<div class="tab-pane fade" id="contactPIll" role="tabpanel" aria-labelledby="contact-icon-pill">

 
 
	<div class="form-group row">
		<label for="dahilolanlar" class="col-sm-2 col-form-label"> Dahili Olanlar </label>
		<div class="col-sm-10">
		<textarea name="dahilolanlar" class="ckeditor" id="dahilolanlar" cols="40" rows="3"><?php echo $dahilolanlar; ?></textarea>
	 
   
		</div> 
	</div>
	
	
 
	<div class="form-group row">
		<label for="haricolanlar" class="col-sm-2 col-form-label"> Harici Olanlar </label>
		<div class="col-sm-10">
		<textarea name="haricolanlar" class="ckeditor" id="haricolanlar" cols="40" rows="3"><?php echo $haricolanlar; ?></textarea>
	 
   
		</div> 
	</div>
	
	
 
	<div class="form-group row">
		<label for="ekbilgi" class="col-sm-2 col-form-label"> Ek Bilgi </label>
		<div class="col-sm-10">
		<textarea name="ekbilgi" class="ckeditor" id="ekbilgi" cols="40" rows="3"><?php echo $ekbilgi; ?></textarea>
	 
   
		</div> 
	</div>
	
 
	<div class="form-group row">
		<label for="bilmemizgerekenler" class="col-sm-2 col-form-label"> Bilmemiz Gerekenler </label>
		<div class="col-sm-10">
		<textarea name="bilmemizgerekenler" class="ckeditor" id="ekbilgi" cols="40" rows="3"><?php echo $bilmemizgerekenler; ?></textarea>
	 
   
		</div> 
	</div>
	
	
	<script type="text/javascript">
		$(function(){
			
			$('#standart').keyup(function () { // id'si standart olan nesne için keyup fonksiyonu
  var max = 140; // Karakter sınırı
  var len = $(this).val().length; // Textarea içine girilen değerleri say
  if (len >= max) { // eğer karakter sayısı verilen değere eşit veya büyükse
    $('#s-sayim').text('Karakter Limitini Aştınız');
  } else { // girilen karakter sayısı verilen değerden küçükse span içine sayısı ekle
    $('#s-sayim').text(len);
  }
});

		});
	
	</script>
	
	<div class="form-group row">
		<label for="turaozel" class="col-sm-2 col-form-label"> Tura Özel </label>
		<div class="col-sm-10">
		<textarea name="turaozel"   id="standart"  cols="40" rows="4" maxlength="140"><?php echo $turaozel; ?></textarea>
	 <p>Karakter sınırı <span id="s-sayim">0</span>/140</p>
   <small id="web" class="ul-form__text form-text "> Bu turu anlatan 140 karakter arasında kısa özet </small>
		</div>
 
	</div>
	
	
	
	</div>							
	<div class="tab-pane fade" id="detaylarr" role="tabpanel" aria-labelledby="contact-icon-pill">

  
	
	 
	
 
 	<div class="form-group row">
		<label for="vizebilgisi" class="col-sm-2 col-form-label"> Vize Bilgisi</label>
		<div class="col-sm-10">
		<textarea name="vizebilgisi" class="ckeditor" id="vizebilgisi" cols="40" rows="3"><?php echo $vizebilgisi; ?></textarea>
	 
   
		</div>

 
		
	</div>
		 
 
 	<div class="form-group row">
		<label for="notlar" class="col-sm-2 col-form-label"> Notlar</label>
		<div class="col-sm-10">
		<textarea name="notlar" class="ckeditor" id="notlar" cols="40" rows="3"><?php echo $notlar; ?></textarea>
	 
   
		</div>
 
		
	</div>
		 
 
 	<div class="form-group row">
		<label for="ulasim" class="col-sm-2 col-form-label"> Ulaşım Bilgileri</label>
		<div class="col-sm-10">
		<textarea name="ulasim" class="ckeditor" id="ulasim" cols="40" rows="3"><?php echo $ulasim; ?></textarea>
	 
   
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
		   	
 <div class="row" id="hekleleme" >
    
 </div>
		 
 
			
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
 
	  
  <div class="row" id="ozellikkk" >
    <div class="col-4  ">
     <input type="text" name="ozellik[]" class="form-control" id="validationCustom02" placeholder="Özellik" value=""  >
    </div>
    <div class="col-2  ">
    <input type="text" name="ofiyat[]" class="form-control" id="validationCustom02" placeholder="Fiyat" value=""  >
    </div>
    <div class="col-2 ">
        <button type="button" class="btn btn-raised ripple btn-raised-success m-1" id="ekstrasecc"> <i class="fa fa-plus"></i> Yeni Ekle </button>
    </div>
 </div>
 
	 
	 
	 
</div>


<div class="tab-pane fade" id="resimlerr" role="tabpanel" aria-labelledby="contact-icon-pill">
	
	
	
   
	 
 <div class="form-group row">
		<label for="resim" class="col-sm-2 col-form-label">Ana Resim * </label>
		<div class="col-sm-2">
		  <input type="file" name="resim" class="form-control" id="resim" placeholder="Ana Resim Boyutu"   > 
			 				
		</div>
	 
	</div>
	
	 
 <div class="form-group row">
	<label for="resim" class="col-sm-2 col-form-label">Diğer Resimler </label>
	<div class="col-sm-2">
	  <input type="file" name="rtoplu[]" multiple="multiple" class="form-control" id="resim" placeholder="Resimler"   > 
						
	</div>
	 <small id="web" class="ul-form__text form-text "> Birden fazla resim seçebilirsiniz </small>
	
 </div>
	
	
	
	
</div>
<div class="tab-pane fade" id="verilerr" role="tabpanel" aria-labelledby="contact-icon-pill">
	
	
	
	 <div class="form-group row">
		<label for="metabaslik" class="col-sm-2 col-form-label">Meta Başlık </label>
		<div class="col-sm-10">
		  <input type="text" name="metabaslik" class="form-control" id="metabaslik" placeholder="metabaslik" value="<?php echo $metabaslik; ?>" > 
			
 							
		</div>
		 
	</div>
	
	
	<div class="form-group row">
		<label for="metaaciklama" class="col-sm-2 col-form-label"> Meta Açıklaması </label>
		<div class="col-sm-10">
		<textarea name="metaaciklama"  class="ckeditor" id="metaaciklama" cols="40" rows="3"><?php echo $metaaciklama; ?></textarea>
	 
   
		</div>
  
	</div>
	
	
		
	<div class="form-group row">
		<label for="seourl" class="col-sm-2 col-form-label">Seo URL * </label>
		<div class="col-sm-6">
		  <input type="text" name="seourl" class="form-control" id="seourl" placeholder="Seo URL" value="<?php echo $seourl; ?>"  > 
			
 							
		</div>
		 
	</div>
		
		 
		
		<div class="form-group row">
		<label for="gecerlilik" class="col-sm-2 col-form-label">Geçerlilik Tarihi </label>
		<div class="col-sm-2">
		
	 
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

   
  <input type="text" name="gecerlilik" class="form-control" id="datepicker" placeholder="MM/DD/YYYY" value="<?php echo $gecerlilik; ?>" autocomplete="off" > 
   <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap'
        });
    </script>
 	
		</div>
		<div class="col-sm-4">
	 
	 MM/DD/YYYY => 02/27/2020  gibi  
		</div>
	 
		
		 
	</div>	 
		
		<div class="form-group row">
		<label for="video" class="col-sm-2 col-form-label">Video/Çalma Listesi Bağlantısı </label>
		<div class="col-sm-10">
		  <input type="text" name="video" class="form-control" id="video" placeholder="Video Linki" value="<?php echo $video; ?>" > 
			
 							
		</div>
		 
	</div>	
	
	
		<div class="form-group row" >
		<label for="yurt" class="col-sm-2 col-form-label">Yurt İçi / Yurt Dışı </label>
		<div class="col-sm-10">
		  
			 
		 <select class="form-control" name="yurt" >
					 
			 <option value="Yurt İçi" >Yurt İçi  </option> 
			 <option value="Yurt Dışı" >Yurt Dışı  </option> 
					 
		 </select>
		 
		 
 							
		</div>
		 
	</div>
	
 
		
		 
	<div class="form-group row" id="vizee" style="display:none;" >
		<label for="vize" class="col-sm-2 col-form-label"> Vize İşlemleri </label>
		<div class="col-sm-10">
		  
			 
		 <select class="form-control" name="vize"  >
					 
			 <option value="Vize Var " > Vize Var  </option> 
			 <option value="Vize Yok" > Vize Yok  </option> 
					 
		 </select>
		 
		 
 							
		</div>
		 
	</div>
				
	<!-- <div class="form-group row">
	<label for="description" class="col-sm-2 col-form-label">Description </label>
	<div class="col-sm-10">
	  <input type="text" name="description" class="form-control" id="description" placeholder="Description" value="<?php echo $description; ?>" > 
		
						
		</div>
		 
	</div> -->
					
	<div class="form-group row">
	<label for="sira" class="col-sm-2 col-form-label">Sıra </label>
	<div class="col-sm-2">
	  <input type="text" name="sira" class="form-control" id="sira" placeholder="Sıra" value="<?php echo $sira; ?>" > 
		
						
		</div>
		 
	</div>
		
		<div class="form-group row">
	<label for="durum" class="col-sm-2 col-form-label">Durum </label>
	<div class="col-sm-2">
	 
	<label class="switch switch-primary mr-3" id="durum">
		 
		  <input name="durum" type="checkbox" checked=""> 
		  
		<span class="slider"></span>
	</label>
							
							
	 	
		</div>
		
		</div>
		
		<div class="form-group row">
	<label for="sira" class="col-sm-2 col-form-label">  </label>
		<div class="col-sm-10">
			<button type="submit" class="btn btn-primary ul-btn__text">İçerik Ekle</button>
		 
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
    
	
		 
		