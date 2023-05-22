	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
 
	// error_reporting(E_ALL);
	// ini_set("display_errors", 1);
	
	?>
	<div class="main-content">
	
   <div class="breadcrumb">
                <h1>Turlar Tarih Ekleme</h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li><a href="?sy=turlar">Turlar</a></li>
                    <li><a href="?sy=turtarih">Tur Tarihleri</a></li>
                     
                </ul>
            </div>
		 
            <div class="separator-breadcrumb border-top"></div>
  
	
	 <?php $islem = $_GET['islem']; 
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
	
	$turID				= $_POST['turID'];
	$sefertarih			= tarihduzelt(trim($_POST['sefertarih']));
	$donustarih			= tarihduzelt(trim($_POST['donustarih']));
	$gecesayisi			= (int)trim($_POST['gecesayisi']);
	$kesinhareket		= $_POST['kesinhareket'];
	$ucakdahil			= $_POST['ucakdahil'];
	$indirimorani		= trim($_POST['indirimorani']);
	$indirimbitis		= tarihduzelt(trim($_POST['indirimbitis']));
	$maxkisi			= (int)trim($_POST['maxkisi']);
	$parabirimi			= $_POST['parabirimi'];
	$notlar				= addslashes(trim($_POST['notlar']));
	$tursec				= $_POST['tursec'];
	$gunfiyat			= trim($_POST['gunfiyat']);
	$sifirikiyas		= trim($_POST['sifirikiyas']);
	$ucaltiyas			= trim($_POST['ucaltiyas']);
	$yedionikiyas		= trim($_POST['yedionikiyas']);
	
	//oteller 
	$oteladi1			= $_POST['oteladi'];
	$turfiyat1			= $_POST['turfiyat'];
	$singlefark1		= $_POST['singlefark'];
	$tripelfiyat1		= $_POST['tripelfiyat'];
	$osifirikiyas1		= $_POST['osifirikiyas'];
	$oucaltiyas1		= $_POST['oucaltiyas'];
	$oyedionikiyas1		= $_POST['oyedionikiyas'];
	$oteldolubos1		= $_POST['oteldolubos'];
	$singleoda1			= $_POST['singleoda'];
	$doubleoda1			= $_POST['doubleoda'];
	$twinoda1			= $_POST['twinoda'];
	$familyoda1			= $_POST['familyoda'];
	$tripleoda1			= $_POST['tripleoda'];
  
	$rhedef				= "../uploads/tur/";
	$resimad1			= $_FILES['resim']['name']; 
	$rkaynak1			= $_FILES['resim']['tmp_name'];	
	 
	// $say 				= count($rtopluad); 
	// $rtopluad2			= $_FILES['rtoplu1']['name']; 
	// $rtoplukaynak2		= $_FILES['rtoplu1']['tmp_name'];
	// $say2 				= count($rtopluad2);
	 
	// echo '<pre>';
	// print_r($_FILES);
	 
	// print_r($_POST);
	
	$durum1				= $_POST['durum']; 	  
	if($durum1=="on"){ $durum = 1; } else { $durum = 0; }
	
	$ekleyen			= $_SESSION['admin']['mail'];   
	$ip					= $_SERVER['REMOTE_ADDR'];  
	   
	$gonder  	= $mysqli->query(" insert into turtarih set 
	 turID 					='$turID', 
	 sefertarih				='$sefertarih', 
	 donustarih				='$donustarih', 
	 gecesayisi				='$gecesayisi', 
	 kesinhareket			='$kesinhareket', 
	 ucakdahil 				='$ucakdahil', 
	 indirimorani			='$indirimorani', 
	 indirimbitis			='$indirimbitis', 
	 minkisi 				='1', 
	 maxkisi 				='$maxkisi', 
	 toplamkisi 			='0', 
	 parabirimi				='$parabirimi', 
	 notlar					='$notlar', 
	 tursec					='$tursec', 
	 gunfiyat				='$gunfiyat', 
	 sifirikiyas			='$sifirikiyas', 
	 ucaltiyas				='$ucaltiyas', 
	 yedionikiyas			='$yedionikiyas', 
	 ip						='$ip', 
	 tarih					= now(),
	 ekleyen				= '$ekleyen',
	 durum					= '$durum',  
	 dil					= '0'  
	 
	  ");   
	  
	if($gonder){
		
	
	if($tursec=="Konaklamalı"){ 
	
	$turtarihID		= $mysqli->insert_id;
	 
	$oteladisay = count($oteladi1);	
	for($aa=0; $aa < $oteladisay; $aa++){ 	
	 
	$oteladi		= addslashes(trim($oteladi1[$aa])); 
	$turfiyat		= trim($turfiyat1[$aa]);
	$singlefark		= trim($singlefark1[$aa]);
	$tripelfiyat	= trim($tripelfiyat1[$aa]);
	$sifiriki		= trim($osifirikiyas1[$aa]); 
	$ucalti			= trim($oucaltiyas1[$aa]);
	$yedioniki		= trim($oyedionikiyas1[$aa]); 
	$oteldolu		= trim($oteldolubos1[$aa]);
	$singleoda		= trim($singleoda1[$aa]);
	$doubleoda		= trim($doubleoda1[$aa]);
	$twinoda		= trim($twinoda1[$aa]);
	$familyoda		= trim($familyoda1[$aa]);
	$tripleoda		= trim($tripleoda1[$aa]);
	  
	$rbaslik		= $resimad1[$aa];				 
	$rkaynak		= $rkaynak1[$aa]; 
	$resim			= md5(rand(0,9999)).res_uzanti($rbaslik);
	  
 $turaciklamaekle	= $mysqli->query("insert into turtarihotel (turID, turtarihID, oteladi, turfiyat, singlefark, tripelfiyat,   sifiriki, ucalti, yedioniki, oteldolu , singleoda, doubleoda,twinoda, familyoda, tripleoda,  resim ) values ('$turID','$turtarihID', '$oteladi', '$turfiyat', '$singlefark', '$tripelfiyat','$sifiriki', '$ucalti', '$yedioniki', '$oteldolu', '$singleoda', '$doubleoda','$twinoda', '$familyoda', '$tripleoda' , '$resim' )");	
	       
	$yukle 	= move_uploaded_file($rkaynak,$rhedef."/".$resim);
	
	
	// $turtarihID		=  $mysqli->insert_id; 
	 
	// $rtopluad			= $rtopluad1[$aa]; 
	// $rtoplukaynak		= $rtoplukaynak1[$aa];
	// $say 				= count($rtopluad1);
	
	// echo $rtopluad.'=>'.$rtoplukaynak.'=>'.$say.' <br/>';  
	 
	 }

	 // if($rtopluad!=""){		   
		// for($x = 0; $x < $say; $x++){
			// $rbaslik	= $rtopluad[$x];				 
			// $rkaynak	= $rtoplukaynak[$x]; 
			// $rsonadi	= md5(rand(0,9999)).res_uzanti($rbaslik);  
			// $vyukle = $mysqli->query("insert into turtarihotelres (turID, turtarihID, resim ) values ('$turID','$turtarihID', '$rsonadi' ) ");
			// $yukle 	= move_uploaded_file($rkaynak,$rhedef."/".$rsonadi);			
		// }		 
	   // }

	   
	 }	
 
  header("Location:?sy=turtarih&islem=basarili");	
		  
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
		<label for="turID" class="col-sm-2 col-form-label"> Tur Seçin  </label>
		<div class="col-sm-10">
		 
  <label for="turID"  > </label>
	<select class="form-control" id="turID" name="turID" required >
		<option>Tur Seçin</option>
			<?php 
				$ukat  = $mysqli->query("select * from turlar where durum='1' order by sira asc ");
					while($uyaz = $ukat->fetch_array()){
						
						echo '<option value='.$uyaz['id'].' >'.$uyaz['baslik'].'</option>'; 
					} 
			?>	  
		 </select>
			 	 						
		</div>
		 
	</div>
	 
  <div class="form-group row">
		<label for="seourl" class="col-sm-2 col-form-label">Tarihler * </label>
		
		<div class="col-3">		
 Sefer Tarihi * 
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
 
 <input type="text" name="sefertarih" class="form-control" id="datepicker" autocomplete="off" placeholder="Sefer Tarihi" value="<?php echo $sefertarih; ?>" required > 
  
   <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap'
        });
    </script>
 
 							
		</div>
		
	 
	
		<div class="col-3">
		
		
 Dönüş Tarihi  *
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
 
  <input type="text" name="donustarih" class="form-control" id="datepicker1" autocomplete="off" placeholder="Dönüş Tarihi" value="<?php echo $donustarih; ?>" required > 
  
   <script>
        $('#datepicker1').datepicker({
            uiLibrary: 'bootstrap'
        });
    </script>
 
 							
		</div>
		  
		<div class="col-3">
		
		
 Otelde Konaklanan Gece Sayısı *   
    
 <input type="text" name="gecesayisi" class="form-control" id="" placeholder="Gece Sayısı" value="<?php echo $gecesayisi; ?>" required >   				
		</div>		 
	</div>
	   
	<div class="form-group row">
		<label for="icerik" class="col-sm-2 col-form-label"> Özellikler  </label>
		
		<label class="checkbox checkbox-primary mr-2">
		<input type="checkbox" checked="" name="kesinhareket" >
		<span>Kesin Harekat</span>
		<span class="checkmark"></span> 
		</label>
		
		<label class="checkbox checkbox-primary mr-2">
			<input type="checkbox" name="ucakdahil" >
			<span>Uçak Dahil </span>
			<span class="checkmark"></span> 
		 </label>
		 
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
		
		<hr/>
  <div class="form-group row">
		<label for="seourl" class="col-sm-2 col-form-label"> Diğer Ayarlar </label>		 
		<div class="col-3"> 
 İndirim Oranı   
 <input type="text" name="indirimorani" class="form-control" id="" placeholder="İndirim Oranı" value="<?php echo $indirimorani; ?>" > 
		</div> 
		<div class="col-3"> 
 İndirim Bitis Tarihi *   
   <input type="text" name="indirimbitis" class="form-control" id="datepicker3" autocomplete="off" placeholder="İndirim Bitiş" value="" required > 
    <script>
        $('#datepicker3').datepicker({
            uiLibrary: 'bootstrap'
        });
    </script>							
		</div>		 
		 <div class="col-sm-3">
	Max. Kişi 
		<input type="text" name="maxkisi" class="form-control" id="" placeholder="Max Kişi" value="<?php echo $maxkisi; ?>"  >		 
		</div> 		 
	</div>
	 
	<div class="form-group row">
		<label for="icerik" class="col-sm-2 col-form-label"> Para Birimi </label>
		<div class="col-sm-3"> 
	<div class="ul-form__radio-inline"> 
	<?php 
		$aas = 1;
		$prbak 	= $mysqli->query("select * from parabirimi order by sira asc ");
			while($pryaz = $prbak->fetch_array()){
		if($aas==1){ $cekedd ='checked'; } else { $cekedd =''; }
		
		echo '<label class=" ul-radio__position radio radio-primary form-check-inline">
			<input type="radio" name="parabirimi" value="'.$pryaz['id'].'" '.$cekedd.' >
			<span class="ul-form__radio-font">'.$pryaz['simge'].'</span>
			<span class="checkmark"></span>
			</label>';			
			
			$aas++;
			}
	
	?> 
	</div> 
		</div>  
	</div>
	
	
	<div class="form-group row">
		<label for="notlar" class="col-sm-2 col-form-label"> Notlar </label>
		<div class="col-sm-10">
		<textarea name="notlar" cols="100%" rows="4"><?php echo $notlar; ?></textarea>
	 
   
		</div> 
	</div>
	
	
	<div class="form-group row">
		<label for="tursec" class="col-sm-2 col-form-label"> Tür Seçin  </label>
		<div class="col-sm-10">		 
	<label for="tursec" > </label>
	<select class="form-control" id="tursec" name="tursec" required >
		<option value="Konaklamalı">Konaklamalı</option>
		<option value="Günübirlik">Günübirlik</option>			   
		 </select>			 			
		</div>		 
	</div>
							
  	<script type="text/javascript"> 
		$(function(){
			$("select[name=tursec]").change(function(){				 
				var yurt = $("select[name=tursec]").val();				   
				 if(yurt=="Konaklamalı"){
					 $("#gunbirrr").hide(500);
					 $(".otell").show(500);
				 } else {
					 $("#gunbirrr").show(500);
					 $(".otell").hide(500);
				 }				
			});			
		});
	</script>  
<hr/>	 
  <div class="form-group row" id="gunbirrr"  style="display:none">
		<label for="gunbirlik" class="col-sm-2 col-form-label"> Günübirlik </label>		 
		<div class="col-2"> 
 Günübirlik Fiyatı   
 <input type="text" name="gunfiyat" class="form-control" id="" placeholder="Günübirlik Fiyat" value="<?php echo $gunfiyat; ?>"  > 
		</div> 
		<div class="col-2"> 
0-2 Yaş Çocuk
 <input type="text" name="sifirikiyas" class="form-control" id="" placeholder="0-2 Yaş" value="<?php echo $sifirikiyas; ?>"  > 				
		</div> 
	<div class="col-sm-2">
3-6 Yaş Çocuk 
	<input type="text" name="ucaltiyas" class="form-control" id="" placeholder="3-6 Yaş Çocuk" value="<?php echo $ucaltiyas; ?>"  >		 
	</div>  
	<div class="col-sm-2">
7 - 12 Yaş Çocuk
	<input type="text" name="yedionikiyas" class="form-control" id="" placeholder="7-12 Yaş Çocuk" value="<?php echo $yedionikiyas; ?>"  >		 
	</div>  
	</div> 
	<script type="text/javascript"> 
		$(function(){ 
			$("#otelyeniekless").click(function(){ 
				 $.ajax( {
					url:"pages/tur/turtarihotelekle.php",
					type:"post",
					success:function(ortakat1){
						 $(ortakat1).insertAfter("#ekotelss"); 
					}
				}); 
			}); 
		});	 
	</script> 

  <div class="form-group row otell" id="ekotelss" >
		<label for="seourl" class="col-sm-1 col-form-label"> Otel Bilgisi   </label>		 
		<div class="col-3"> 
 Otel Adı   
 <input type="text" name="oteladi[]" class="form-control" id="" placeholder="Otel Adı" value="<?php echo $oteladi; ?>" > 
		</div> 
		
		<div class="col-1"> 
Tur Fiyatı
 <input type="text" name="turfiyat[]" class="form-control" id="" placeholder="Tur Fiyat" value="<?php echo $turfiyat; ?>" > 
    							
		</div>		 
	
		<div class="col-1"> 
Tripel Fiyat
 <input type="text" name="tripelfiyat[]" class="form-control" id="" placeholder="Tur Fiyat" value="<?php echo $turfiyat; ?>" > 
    							
		</div>		 
	
	<div class="col-sm-1">
Single Fark
	<input type="text" name="singlefark[]" class="form-control" id="" placeholder="Single Fark" value="<?php echo $singlefark; ?>" >		 
	</div> 
		
	<div class="col-sm-1">
	0-2 Yaş
	<input type="text" name="osifirikiyas[]" class="form-control" id="" placeholder="0-2 Yaş" value="<?php echo $osifirikiyas; ?>"  >		 
	</div> 	
	<div class="col-sm-1">
	3-6 Yaş
	<input type="text" name="oucaltiyas[]" class="form-control" id="" placeholder="3-6 Yaş" value="<?php echo $oucaltiyas; ?>"  >		 
	</div> 
	
	<div class="col-sm-1">
	7-12 Yaş
	<input type="text" name="oyedionikiyas[]" class="form-control" id="" placeholder="7-12 Yaş" value="<?php echo $oyedionikiyas; ?>"  >		 
	</div> 
		
	<div class="col-sm-1">
	 Otel Dolu ?
	 <label class="checkbox checkbox-primary mr-2">
		<input type="checkbox"   name="oteldolubos[]" >
		<span> </span>
		<span class="checkmark"></span>
	</label>	 
	</div> 	
	
<div class="col-sm-1">
Yeni Otel
  
<button type="button" class="btn btn-raised ripple btn-raised-success m-1" id="otelyeniekless"> <i class="fa fa-plus"></i></button>
	  
</div> 

  

<label for="resim" class="col-sm-2 col-form-label">Resim  </label>
		<div class="col-sm-2"> 
		  <input type="file" name="resim[]"  class="form-control" id="resim" placeholder=""   > 
		<!--  <input type="file" name="rtoplu[]" multiple="multiple" class="form-control" id="resim" placeholder=""   > -->
			 				
		</div>
	 <!-- <small id="web" class="ul-form__text form-text "> Birden fazla resim seçebilirsiniz </small> -->
	 
	 
	 <div class="col-sm-1">
	
	 <label class="checkbox checkbox-primary mr-2">
		 Single 
		 <input type="checkbox"   name="singleoda[]" >
		<span> </span>
		<span class="checkmark"></span>
	</label>	 
	</div> 	
	
	<div class="col-sm-1">
	
	 <label class="checkbox checkbox-primary mr-2">Double
		<input type="checkbox"   name="doubleoda[]" > 
		<span> </span>
		<span class="checkmark"></span>
	</label>	 
	</div> 

	<div class="col-sm-1">
	
	 <label class="checkbox checkbox-primary mr-2">Twin
		<input type="checkbox"   name="twinoda[]" >
		<span> </span>
		<span class="checkmark"></span>
	</label>	 
	</div> 

	<div class="col-sm-1">
	 
	 <label class="checkbox checkbox-primary mr-2">Family
		<input type="checkbox"   name="familyoda[]" >
		<span> </span>
		<span class="checkmark"></span>
	</label>	 
	</div> 

	<div class="col-sm-1">
	 
	 <label class="checkbox checkbox-primary mr-2">Triple
		<input type="checkbox"   name="tripleoda[]" >
		<span> </span>
		<span class="checkmark"></span>
	</label>	 
	</div> 	
	
	<small id="web" class="ul-form__text form-text "> Odaları Kapatıp Açabilirsiniz </small> 
	
	
	</div>
 
<hr/>	
   	  
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
 	