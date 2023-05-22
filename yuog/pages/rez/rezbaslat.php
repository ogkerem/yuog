 <?php  defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim '); ?>
 
 		<?php 
	$turID 			= $_POST['turID'];
	$turtarihID		= $_POST['turtarihID']; 
	$acentaID		= $_POST['acentaID'];
	$otelsecc		= $_POST['otelsecc'];
	
	$turbak 		= $mysqli->query("select * from turlar where id='$turID' ");
	$turyaz 		= $turbak->fetch_array();
	
	$acentabak 		= $mysqli->query("select * from acenta where id='$acentaID' ");
	$acenyaz 		= $acentabak->fetch_array();
	
	$ttarihbak 		= $mysqli->query("select * from turtarih where id='$turtarihID' ");
	$ttyaz 			= $ttarihbak->fetch_array();
	$parabirimi		= $ttyaz['parabirimi'];
	$tursec			= $ttyaz['tursec'];	
	
	$otelbak 		= $mysqli->query("select * from turtarihotel where id='$otelsecc' ");
	$otelyaz		= $otelbak->fetch_array();
	$oteladi 		= $otelyaz['oteladi']; 
	
	$turfiyat 		= $otelyaz['turfiyat']; 
	$singlefark 	= $otelyaz['singlefark']; 
	$tripelfiyat 	= $otelyaz['tripelfiyat']; 
	$sifiriki 		= $otelyaz['sifiriki']; 
	$ucalti 		= $otelyaz['ucalti']; 
	$yedioniki 		= $otelyaz['yedioniki']; 
	
	$singleoda 		= $otelyaz['singleoda']; 
	$doubleoda 		= $otelyaz['doubleoda']; 
	$twinoda 		= $otelyaz['twinoda']; 
	$familyoda 		= $otelyaz['familyoda']; 
	$tripleoda 		= $otelyaz['tripleoda']; 
	
	$pbak 			= $mysqli->query("select * from parabirimi where id='$parabirimi' ");
	$pyaz 			= $pbak->fetch_array(); 

	$yil =  substr($ttyaz['sefertarih'],0,4); 
	$gun =  substr($ttyaz['sefertarih'],8,2); 
	$ay =  	substr($ttyaz['sefertarih'],5,2); 
	
	?>
	
	<div class="main-content">		
   <div class="breadcrumb">
		<h1>Rezervasyon  Ekleme</h1>
		<ul>
			<li><a href="index.php">Ana Sayfa</a></li>
			<li><a href="?sy=rezervasyonlar">Rezervasyonlar</a></li> 
		</ul>
	</div>
	
		

	
 <div class="separator-breadcrumb border-top"></div>    
  
	<div class="row">
		<div class="col-md-12">
   
	<p>  </p>
		<div class="card mb-5">
		<div class="card-body">


	   
	 <?php 
  
	 if($_POST['rezbaslat']=="Rezervasyon Başlat"){
	
	$turID 				= $_POST['turID'];
	$turtarihID			= $_POST['turtarihID'];
	$acentaID			= $_POST['acentaID'];
	$tursec				= $_POST['tursec'];
	
	$mail				= addslashes(trim($_POST['fmail']));
	$notlar				= addslashes(trim($_POST['notlar']));	 
	$cinsiyet			= $_POST['cinsiyet'];
	$adi				= addslashes(trim($_POST['adi']));
	$soyadi				= addslashes(trim($_POST['soyadi']));
	$kimlikno			= addslashes(trim($_POST['kimlikno']));	
	$dogumtarih			= tarihduzelt(trim($_POST['dogumtarih']));
	$cep				= trim($_POST['cep']);
	$servisbinis		= (int)$_POST['servisbinis'];
	$pasaportno			= addslashes(trim($_POST['pasaportno'])); 
	$pasaportip			= addslashes(trim($_POST['pasaportip'])); 
	$pasaporttarih		= addslashes(trim($_POST['pasaporttarih'])); 
	$faturatur			= $_POST['faturatur']; 
	$fad				= addslashes(trim($_POST['fad'])); 
	$fsoyad				= addslashes(trim($_POST['fsoyad'])); 
	$ftel				= addslashes(trim($_POST['ftel'])); 
	$fmail				= addslashes(trim($_POST['fmail'])); 
	$fkimlik			= addslashes(trim($_POST['fkimlik'])); 
	$fadres				= addslashes(trim($_POST['fadres'])); 
	$ffirma				= addslashes(trim($_POST['ffirma'])); 
	$fvergidaire		= addslashes(trim($_POST['fvergidaire'])); 
	$fvergino			= addslashes(trim($_POST['fvergino'])); 
	$fbilgiayni			= addslashes(trim($_POST['fbilgiayni'])); 
	$toplam				=  trim($_POST['toplam']); 
	$odemesekli			=  $_POST['odemesekli']; 
	
	// otel varsa
	$odatip				=  $_POST['odatip']; 
	$odatip1			=  $_POST['odatip1']; 
	$otelID 			=  (int)$_POST['totelsecc'];
	
	//diğer kişiler 
	$cinsiyet1			= $_POST['cinsiyet1']; 
	$adi1				= $_POST['adi1']; 
	$soyadi1			= $_POST['soyadi1'];  
	$kimlikno1			= $_POST['kimlikno1'];  
	$dogumtarih1		= $_POST['dogumtarih1'];  
	$cep1				= $_POST['cep1'];  
	$servisbinis1		= $_POST['servisbinis1'];  
	
	$eksay 				= count($adi1); 
	$kisisayisi			= (int)$eksay+1; 
	
	$ekleyen			= $_SESSION['admin']['mail'];   
	$ip					= $_SERVER['REMOTE_ADDR'];  
	
	 
	$gonder  	= $mysqli->query(" insert into rezervasyon set   
	
	turID					= '$turID',
	turtarihID				= '$turtarihID',
	tursec					= '$tursec',
	acentaID				= '$acentaID',
	otelID					= '$otelID',
	mail					= '$mail',
	notlar					= '$notlar',
	cinsiyet				= '$cinsiyet',
	adi						= '$adi',
	soyadi					= '$soyadi',
	kimlikno				= '$kimlikno',
	uyrugu					= '$uyrugu',
	dogumtarih				= '$dogumtarih',
	cep						= '$cep',
	servisbinis				= '$servisbinis',
	pasaportno				= '$pasaportno',
	pasaportip				= '$pasaportip',
	pasaporttarih			= '$pasaporttarih',
	faturatur				= '$faturatur',
	fad						= '$fad',
	fsoyad					= '$fsoyad',
	ftel					= '$ftel',
	fmail					= '$fmail',
	fkimlik					= '$fkimlik',
	ffirma					= '$ffirma',
	fvergidaire				= '$fvergidaire',
	fvergino				= '$fvergino',
	fbilgiayni				= '$fbilgiayni',
	toplam					= '$toplam',
	parabirimi				= '$parabirimi',
	ekleyen					= '$ekleyen',
	ip						= '$ip',
	tarih					= now(),
	durum					= 'Onay Bekliyor',
	odemesekli				= '$odemesekli' ,
	kisisayisi				= '$kisisayisi' 
	 
	  
	  ");   
	  
	if($gonder){
		
	 $rezervasyonID		= $mysqli->insert_id;
		
	if($acentaID!=""){
		  
		$acentacariekle = $mysqli->query("insert into acentacari set 
		
		rezervasyonID		= '$rezervasyonID',
		acentaID 			= '$acentaID',
		turID				= '$turID',
		turtarihID			= '$turtarihID',
		toplam				= '$toplam',
		parabirimi			= '$parabirimi',
		odemesekli			= '$odemesekli',
		ekleyen				= '$ekleyen',
		ip					= '$ip',
		tarih				= now()
		 
		");  
	}
	  
	
	$turtarihbak 	= $mysqli->query("select * from turtarih where id='$turtarihID'  ");
	$ttarihyaz 		= $turtarihbak->fetch_array();
	$ttoptlamkisi	= (int)$kisisayisi+ $ttarihyaz['toplamkisi'];
	$ttguncelle 	= $mysqli->query("update set turtarih toplamkisi='$ttoptlamkisi' where id='$turtarihID' ");
	 
	if($eksay>0){
	
	for($xx=1; $xx<$eksay; $xx++){ 
		  
		$cinsiyet2		= $cinsiyet1[$xx];
		$adi2			= $adi1[$xx];
		$adi2			= $adi1[$xx];
		$soyadi2		= $soyadi1[$xx]; 
		$kimlikno2		= $kimlikno1[$xx]; 
		$uyrugu2		= 'TC'; 
		$dogumtarih2	= tarihduzelt($dogumtarih1[$xx]);
		$cep2			= $cep1[$xx]; 
		$servisbinis2	= $servisbinis1[$xx]; 
		$odatip2		= $odatip1[$xx]; 
		 
		
	$rezkisiekle  	= $mysqli->query("insert into rezervasyonkisi set 
		
		rezervasyonID		= '$rezervasyonID',
		cinsiyet			= '$cinsiyet2',
		adi					= '$adi2',
		soyadi				= '$soyadi2',
		kimlikno			= '$kimlikno2',
		uyrugu				= '$uyrugu2',
		dogumtarih			= '$dogumtarih2',
		cep					= '$cep2',
		servisbinis			= '$servisbinis2',
		pasaportno			= '',
		pasaportip			= '',
		pasaporttarih		= '',
		odatip				= '$odatip2',
		otelID				= '$otelID'  		
	 
	");
	 
	} 
	
	} 
	 
	header("Location:?sy=rezervasyonlar&islem=basarili");	
		  
	} else { echo '<div class="alert alert-danger" role="alert">
				<strong class="text-capitalize">Hata!</strong>Hata İşlem Başarısız :(  
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div> <br /> <a href="javascript:history.back(-1)">Geri Dön</a>'; }  	 
	 } else { 
?>	

 	
	<h3> Rezervasyon Bilgileri <span class="text-danger"><?php if($acenyaz['firma']==""){ echo ''; } else { echo ' - '.$acenyaz['firma']; }  ?> </span>	</h3>
	 
	 <form action="" method="post" enctype="multipart/form-data" >
	  
	<hr/>
	 
	 <input type="hidden" name="turID" value="<?php echo $turID; ?>">
	<input type="hidden" name="turtarihID" value="<?php echo $turtarihID; ?>">
	<input type="hidden" name="acentaID" value="<?php echo $acentaID; ?>">
	<input type="hidden" name="tursec" value="<?php echo $tursec; ?>">
	
	
 <div class="form-group row">
	 <h4 class=" badge-primary m-2 p-2" ><?php echo $turyaz['baslik']; ?></h4>  
	<h5 class=" badge-success m-2 p-2" ><?php echo $gun.'-'.$ay.'-'.$yil; ?></h5>
	 
</div>

 <?php if($tursec=="Günübirlik"){  ?>
 
 <!-- Günübirlik başlangıç  -->
 
	<div class="form-group row">
	   
 <div class="col-sm-12 p-12 mb-12 bg-dark text-white"  >1. Misafir Bilgileri <input type="hidden" class="sayii"> <span class="pull-right"> TUR KONUKLARI</span> </div> 
		 
		<div class="col-sm-2">
		 
 Cinsiyet * 
	<select class="custom-select task-manager-list-select " id="cinsiyet"   name="cinsiyet" required  >
		<option value="Bayan"> Bayan </option>
		<option value="Bay"> Bay </option>
			 
		 </select>
			 	 						
		</div>
	
		
		
	<script type="text/javascript">
		$(function(){
			$("input[name=adi]").change(function(){
				var adi = $("input[name=adi]").val(); 
				$("input[name=fad]").val(adi);
			});
			
			$("input[name=soyadi]").change(function(){
				var soyadi = $("input[name=soyadi]").val(); 
				$("input[name=fsoyad]").val(soyadi);
			});	
			
			$("input[name=kimlikno]").change(function(){
				var kimlikno = $("input[name=kimlikno]").val(); 
				$("input[name=fkimlik]").val(kimlikno);
			});
			
			$("input[name=cep]").change(function(){
				var cep = $("input[name=cep]").val(); 
				$("input[name=ftel]").val(cep);
			});
			
		});		
		</script>
		
		<div class="col-sm-3"> 
	Adınız *  
 <input type="text" name="adi" class="form-control" id="adi" placeholder="Adınız" value="<?php echo $adi; ?>" required > 
		</div> 
		<div class="col-sm-3"> 
 	Soyadınız *  
 <input type="text" name="soyadi" class="form-control" id="" placeholder="Soyadınız" value="<?php echo $soyadi; ?>" required > 				
		</div> 
	<div class="col-sm-3">
 T.C. Kimlik No *
  
 <input type="text" name="kimlikno" class="form-control" id="" maxlength="11" placeholder="T.C. Kimlik No" value="<?php echo $kimlikno; ?>" required >		 
	</div>  
	    
		<div class="col-sm-2">		
 
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
 Doğum Tarihi (02/26/2020)
 <input type="text" name="dogumtarih" class="form-control dogumtarih" id="datepicker" autocomplete="off"  value="<?php echo $sefertarih; ?>" required > 
   
   <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap'
        });
    </script>
 
 							
		</div>
		
		<div class="col-sm-2"> 
  Cep Telefonu *  
 <input type="text" name="cep" class="form-control " id="" placeholder="Cep Telefonunuz" maxlength="10" value="<?php echo $cep; ?>" required > 				
		 
		 <small id="web" class="ul-form__text form-text "> Örnk. 5364540934 </small>
		 </div> 
		 
		   
		<div class="col-sm-3">		 
		Servis Biniş Noktası 
		
	<label for="servisbinis" > </label>
	<select class="custom-select task-manager-list-select" id="servisbinis" name="servisbinis" required > 
	
	<?php $serbak = $mysqli->query("select * from turguzsec where turID='$turID' "); 
		
		while($seryaz = $serbak->fetch_array()){
			
			$guzID 		= $seryaz['guzID'];			
			$guzbak 	= $mysqli->query("select * from turcikisnokta where id='$guzID'  ");
			$guzyaz 	= $guzbak->fetch_array();
			
			echo '<option value="'.$guzyaz['id'].'">'.$guzyaz['baslik'].' - '.$seryaz['saat'].'</option>';
			
		}
	
	?>
		 			   
		 </select>			 			
		</div>	
		<input type="hidden" id="turID" value="<?php echo $turID; ?>"> 
		<input type="hidden" id="turtarihID" value="<?php echo $turtarihID; ?>"> 
		

 
 	<div class="col-sm-2 ">
	Yeni Misafir Ekle
      <button type="button" class="btn btn-raised ripple btn-raised-success m-1" id="yenikisieklee"> <i class="fa fa-plus"></i> Yeni Ekle </button> 
    </div> 
	 
 </div>	 
	 
	  <div class="form-group row" id="yenikisiburayaa" ></div>
	  
    <?php } else { ?>
	
	
	<!-- otel başlangıç -->
	<div class="form-group row">
  
		<input type="hidden" name="singlefiyat" value="<?php echo $turfiyat+$singlefark;  ?>"> 
		<input type="hidden" name="dublefiyat" value="<?php echo $turfiyat*2; ?>"> 
		<input type="hidden" name="tripelfiyat" value="<?php echo $tripelfiyat*3; ?>"> 
		<input type="hidden" name="familyfiyat" value="<?php echo $turfiyat*2; ?>"> 
		<input type="hidden" name="odatip" value=""> 
	 
		
	<script type="text/javascript">
	
	$(function(){
		$("#birrr").click(function(){	
			$("input[name=kaclik]").val("birrr");
			$(this).removeClass("btn btn-outline-secondary m-1");
			$(this).addClass("btn btn-dark ripple m-1");  
			$("#ikiii").addClass("btn btn-outline-secondary m-1");  
			$("#uccc").addClass("btn btn-outline-secondary m-1");  
			$("#dortttt").addClass("btn btn-outline-secondary m-1");  
			$("#besss").addClass("btn btn-outline-secondary m-1");
			$("#ikinciyetiskin").hide(200);
			$("#ucuncuyetiskin").hide(200);
			$("#cocukk").hide(200);
			var singlefiyat = $("input[name=singlefiyat]").val();
			$("#toplaa").val(singlefiyat);
			$("#odatip").val("single");
		});
		
		$("#ikiii").click(function(){
			$("input[name=kaclik]").val("ikiii");			
			$(this).removeClass("btn btn-outline-secondary m-1");
			$(this).addClass("btn btn-dark ripple m-1");  
			$("#birrr").addClass("btn btn-outline-secondary m-1");  
			$("#uccc").addClass("btn btn-outline-secondary m-1");  
			$("#dortttt").addClass("btn btn-outline-secondary m-1");  
			$("#besss").addClass("btn btn-outline-secondary m-1"); 
			$("#ikinciyetiskin").show(200);
			$("#ucuncuyetiskin").hide(200);
			$("#cocukk").hide(200);
			var dublefiyat = $("input[name=dublefiyat]").val();
			$("#toplaa").val(dublefiyat);
			$("#odatip").val("double");
		});
		
		$("#uccc").click(function(){	
			$("input[name=kaclik]").val("uccc");			
			$(this).removeClass("btn btn-outline-secondary m-1");
			$(this).addClass("btn btn-dark ripple m-1");  
			$("#birrr").addClass("btn btn-outline-secondary m-1");  
			$("#ikiii").addClass("btn btn-outline-secondary m-1");  
			$("#dortttt").addClass("btn btn-outline-secondary m-1");  
			$("#besss").addClass("btn btn-outline-secondary m-1");  
			$("#ikinciyetiskin").show(200);
			$("#ucuncuyetiskin").hide(200);
			$("#cocukk").hide(200);
			var dublefiyat = $("input[name=dublefiyat]").val();
			$("#toplaa").val(dublefiyat);
			$("#odatip").val("twin");
		});
		
		
		$("#dortttt").click(function(){			 
			$("input[name=kaclik]").val("dortttt");	
			$(this).removeClass("btn btn-outline-secondary m-1");
			$(this).addClass("btn btn-dark ripple m-1");  
			$("#birrr").addClass("btn btn-outline-secondary m-1");  
			$("#uccc").addClass("btn btn-outline-secondary m-1");  
			$("#ikiii").addClass("btn btn-outline-secondary m-1");  
			$("#besss").addClass("btn btn-outline-secondary m-1");   
			$("#ikinciyetiskin").show(200);
			$("#ucuncuyetiskin").hide(200);
			$("#cocukk").show(200);	 
			var familyfiyat = $("input[name=familyfiyat]").val();			
			$("#toplaa").val(familyfiyat);		   
			$("#odatip").val("family");
		});
		
		
		$("#besss").click(function(){			 
			$("input[name=kaclik]").val("besss");	
			$(this).removeClass("btn btn-outline-secondary m-1");
			$(this).addClass("btn btn-dark ripple m-1");  
			$("#birrr").addClass("btn btn-outline-secondary m-1");  
			$("#uccc").addClass("btn btn-outline-secondary m-1");  
			$("#dortttt").addClass("btn btn-outline-secondary m-1");  
			$("#ikiii").addClass("btn btn-outline-secondary m-1"); 
			$("#ikinciyetiskin").show(200);
			$("#ucuncuyetiskin").show(200);
			$("#cocukk").hide(200);
			var tripelfiyat = $("input[name=tripelfiyat]").val();
			$("#toplaa").val(tripelfiyat);
			$("#odatip").val("triple");
		});
		
		
	});

</script>
 
	 
<input type="hidden" value="" name="kaclik" >
<button type="button" class="btn btn-outline-secondary m-1" id="birrr" style="<?php if($singleoda=="on"){ echo 'display:none;'; } ?>" > <img src="../img/tek-kisilik-selected.png">  <p> Single </p></button>
<button type="button" class="btn btn-outline-secondary m-1" id="ikiii" style="<?php if($doubleoda=="on"){ echo 'display:none;'; } ?>" > <img src="../img/cift-kisilik-selected.png">  <p> Double </p></button>
<button type="button" class="btn btn-outline-secondary m-1" id="uccc" style="<?php if($twinoda=="on"){ echo 'display:none;'; } ?>" > <img src="../img/cift-kisilik-ayri-selected.png">  <p> Twin </p></button>
<button type="button" class="btn btn-outline-secondary m-1" id="dortttt" style="<?php if($familyoda=="on"){ echo 'display:none;'; } ?>" > <img src="../img/triple-yatak-selected.png">  <p> Family </p></button>
<button type="button" class="btn btn-outline-secondary m-1" id="besss" style="<?php if($tripleoda=="on"){ echo 'display:none;'; } ?>" > <img src="../img/triple-last-selected.png">  <p> Triple </p></button>
  
	</div>
	 
	<div class="form-group row" <?php if($singleoda=="on"){ echo 'display:none;'; } ?> >
	   
<div class="col-sm-12 p-12 mb-12 bg-dark text-white"  >1 . Yetişkin Bilgileri   <span class="pull-right"> ODA</span> 
<input type="hidden" class="sayiiotel"></div> 
		 
		<div class="col-sm-2">
		 
	Cinsiyet * 
	<select class="custom-select task-manager-list-select " id="cinsiyet"   name="cinsiyet" required  >
		<option value="Bayan"> Bayan </option>
		<option value="Bay"> Bay </option>
			 
		 </select>
			 	 						
		</div>
		
	<script type="text/javascript">
		$(function(){
			$("input[name=adi]").change(function(){
				var adi = $("input[name=adi]").val(); 
				$("input[name=fad]").val(adi);
			});
			
			$("input[name=soyadi]").change(function(){
				var soyadi = $("input[name=soyadi]").val(); 
				$("input[name=fsoyad]").val(soyadi);
			});	
			
			$("input[name=kimlikno]").change(function(){
				var kimlikno = $("input[name=kimlikno]").val(); 
				$("input[name=fkimlik]").val(kimlikno);
			});
			
			$("input[name=cep]").change(function(){
				var cep = $("input[name=cep]").val(); 
				$("input[name=ftel]").val(cep);
			});
			
		});		
		</script>
		
		<div class="col-sm-3"> 
	Adınız *  
 <input type="text" name="adi" class="form-control" id="adi" placeholder="Adınız" value="" required > 
		</div> 
		<div class="col-sm-3"> 
 	Soyadınız *  
 <input type="text" name="soyadi" class="form-control" id="" placeholder="Soyadınız" value="" required > 				
		</div> 
	<div class="col-sm-3">
 T.C. Kimlik No *
  
 <input type="text" name="kimlikno" class="form-control" id="" maxlength="11" placeholder="T.C. Kimlik No" value="" required >		 
	</div>  
	    
		<div class="col-sm-2">		
 
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
 Doğum Tarihi (02/26/2020)
 <input type="text" name="dogumtarih" class="form-control dogumtarih" id="datepicker2" autocomplete="off"  value="" required > 
   
   <script>
        $('#datepicker2').datepicker({
            uiLibrary: 'bootstrap'
        });
    </script>
 
 							
		</div>
		
		<div class="col-sm-2"> 
  Cep Telefonu *  
 <input type="text" name="cep" class="form-control " id="" placeholder="Cep Telefonunuz" maxlength="10" value="" required > 				
		 
		 <small id="web" class="ul-form__text form-text "> Örnk. 5364540934 </small>
		 </div> 
		 
		   
		<div class="col-sm-3">		 
		Servis Biniş Noktası 
		
	<label for="servisbinis" > </label>
	<select class="custom-select task-manager-list-select" id="servisbinis" name="servisbinis" required > 
	
	<?php $serbak = $mysqli->query("select * from turguzsec where turID='$turID' "); 
		
		while($seryaz = $serbak->fetch_array()){
			
			$guzID 		= $seryaz['guzID'];			
			$guzbak 	= $mysqli->query("select * from turcikisnokta where id='$guzID'  ");
			$guzyaz 	= $guzbak->fetch_array();
			
			echo '<option value="'.$guzyaz['id'].'">'.$guzyaz['baslik'].' - '.$seryaz['saat'].'</option>';
			
		}
	
	?>
		 			   
		 </select>			 			
		</div>	
	 
		 
 </div>	 
	 
	 
	 
	<div class="form-group row" id="ikinciyetiskin" style="<?php if(($doubleoda=="on") ||($doubleoda=="on")){ echo 'display:none;'; } ?>" >
 
	<div class="col-sm-12 p-12 mb-12 bg-dark text-white"  >2 . Yetişkin Bilgileri   </div> 
		 
		<div class="col-sm-2">
		 
	Cinsiyet * 
	<select class="custom-select task-manager-list-select " id="cinsiyet"   name="cinsiyet1[]"   >
		<option value="Bayan"> Bayan </option>
		<option value="Bay"> Bay </option>
			 
		 </select>
			 	 						
		</div>
	  
		<div class="col-sm-3"> 
	Adınız *  
 <input type="text" name="adi1[]" class="form-control" id="adi" placeholder="Adınız" value=""  > 
		</div> 
		<div class="col-sm-3"> 
 	Soyadınız *  
 <input type="text" name="soyadi1[]" class="form-control" id="" placeholder="Soyadınız" value=""  > 				
		</div> 
	<div class="col-sm-3">
 T.C. Kimlik No *
  
 <input type="text" name="kimlikno1[]" class="form-control" id="" maxlength="11" placeholder="T.C. Kimlik No" value=""  >		 
	</div>  
	    
		<div class="col-sm-2">		
 
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
 Doğum Tarihi (02/26/2020)
 <input type="text" name="ddogumtarih[]" class="form-control dogumtarih" id="datepicker" autocomplete="off"  value=""  > 
   
   <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap'
        });
    </script>
 
 							
		</div>
		
		<div class="col-sm-2"> 
  Cep Telefonu *  
 <input type="text" name="cep1[]" class="form-control " id="" placeholder="Cep Telefonunuz" maxlength="10" value=""  > 				
		 
		 <small id="web" class="ul-form__text form-text "> Örnk. 5364540934 </small>
		 </div> 
		 
		   
		<div class="col-sm-3">		 
		Servis Biniş Noktası 
		
	<label for="servisbinis" > </label>
	<select class="custom-select task-manager-list-select" id="servisbinis" name="servisbinis1[]"  > 
	
	<?php $serbak = $mysqli->query("select * from turguzsec where turID='$turID' "); 
		
		while($seryaz = $serbak->fetch_array()){
			
			$guzID 		= $seryaz['guzID'];			
			$guzbak 	= $mysqli->query("select * from turcikisnokta where id='$guzID'  ");
			$guzyaz 	= $guzbak->fetch_array();
			
			echo '<option value="'.$guzyaz['id'].'">'.$guzyaz['baslik'].' - '.$seryaz['saat'].'</option>';
			
		}
	
	?>
		 			   
		 </select>			 			
		</div>	
	 
		 
 </div>	 
	 
	 
	<div class="form-group row" id="ucuncuyetiskin" style="display:none; <?php if($tripleoda=="on") { echo 'display:none;'; } ?> " >
	   
	<div class="col-sm-12 p-12 mb-12 bg-dark text-white"  >3 . Yetişkin Bilgileri  </div> 
		  
		<div class="col-sm-2">
		 
	Cinsiyet * 
	<select class="custom-select task-manager-list-select " id="cinsiyet"   name="cinsiyet1[]"   >
		<option value="Bayan"> Bayan </option>
		<option value="Bay"> Bay </option>
			 
		 </select>
			 	 						
		</div>
	 
		
		<div class="col-sm-3"> 
	Adınız *  
 <input type="text" name="adi1[]" class="form-control" id="adi" placeholder="Adınız" value=""  > 
		</div> 
		<div class="col-sm-3"> 
 	Soyadınız *  
 <input type="text" name="soyadi1[]" class="form-control" id="" placeholder="Soyadınız" value=""  > 				
		</div> 
	<div class="col-sm-3">
 T.C. Kimlik No *
  
 <input type="text" name="kimlikno1[]" class="form-control" id="" maxlength="11" placeholder="T.C. Kimlik No" value=""  >		 
	</div>  
	    
		<div class="col-sm-2">		
 
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
 Doğum Tarihi (02/26/2020)
 <input type="text" name="ddogumtarih[]" class="form-control dogumtarih" id="datepicker3" autocomplete="off"  value=""  > 
   
   <script>
        $('#datepicker3').datepicker({
            uiLibrary: 'bootstrap'
        });
    </script>
 
 							
		</div>
		
		<div class="col-sm-2"> 
  Cep Telefonu *  
 <input type="text" name="cep1[]" class="form-control " id="" placeholder="Cep Telefonunuz" maxlength="10" value=""  > 				
		 
		 <small id="web" class="ul-form__text form-text "> Örnk. 5364540934 </small>
		 </div> 
		 
		   
		<div class="col-sm-3">		 
		Servis Biniş Noktası 
		
	<label for="servisbinis" > </label>
	<select class="custom-select task-manager-list-select" id="servisbinis" name="servisbinis1[]"  > 
	
	<?php $serbak = $mysqli->query("select * from turguzsec where turID='$turID' "); 
		
		while($seryaz = $serbak->fetch_array()){
			
			$guzID 		= $seryaz['guzID'];			
			$guzbak 	= $mysqli->query("select * from turcikisnokta where id='$guzID'  ");
			$guzyaz 	= $guzbak->fetch_array();
			
			echo '<option value="'.$guzyaz['id'].'">'.$guzyaz['baslik'].' - '.$seryaz['saat'].'</option>';
			
		}
	
	?>
		 			   
		 </select>			 			
		</div>	
	 
		 
 </div>	 
	 
	 
	<div class="form-group row" id="cocukk" style="display:none; <?php if($familyoda=="on"){ echo 'display:none;'; } ?> " >
	   
	<div class="col-sm-12 p-12 mb-12 bg-dark text-white"  >1 . Çocuk Bilgileri   </div> 
		 
		<div class="col-sm-2">
		 
	Cinsiyet * 
	<select class="custom-select task-manager-list-select " id="cinsiyet"   name="cinsiyet1[]"   >
		<option value="Bayan"> Bayan </option>
		<option value="Bay"> Bay </option>
			 
		 </select>
			 	 						
		</div>
	 
		
		<div class="col-sm-3"> 
	Adınız *  
 <input type="text" name="adi1[]" class="form-control" id="adi" placeholder="Adınız" value=""  > 
		</div> 
		<div class="col-sm-3"> 
 	Soyadınız *  
 <input type="text" name="soyadi1[]" class="form-control" id="" placeholder="Soyadınız" value=""  > 				
		</div> 
	<div class="col-sm-3">
 T.C. Kimlik No *
  
 <input type="text" name="kimlikno" class="form-control" id="" maxlength="11" placeholder="T.C. Kimlik No" value="<?php echo $kimlikno; ?>"  >		 
	</div>  
	    <input type="hidden" name="totelsecc" value="<?php echo $otelsecc; ?>" id="totelsecc" >
		

		<div class="col-sm-2">		
 
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
 (AA/GG/YYYY) Örn. Doğum Tarihi (02/26/2020) elle giriniz
 <input type="text" name="ddogumtarih[]" class="form-control" id="datepicker4" autocomplete="off"  value=""  > 
   
   <script>
        // $('#datepicker4').datepicker({
            // uiLibrary: 'bootstrap'
        // });
    </script>
 
   
 	<script type="text/javascript">
		$(function(){
			$("#datepicker4").blur(function(){
				
				var datepicker4	= $("#datepicker4").val();
				var totelsecc 	= $("#totelsecc").val();
			 
				$.ajax({
					url: "pages/rez/tcocuk.php",
					type: "POST",
					data: {"datepicker4":datepicker4, "totelsecc":totelsecc }, 
					success: function(ortakat1) { 
						$("#toplaa").val(ortakat1);
					} 
				});  
			});
		});
	</script>	
	
	 			
		</div>
		
		<div class="col-sm-2"> 
  Cep Telefonu *  
 <input type="text" name="cep1[]" class="form-control " id="cepelll" placeholder="Cep Telefonunuz" maxlength="10" value=""  > 				
		 
		 <small id="web" class="ul-form__text form-text "> Örnk. 5364540934 </small>
		 </div> 
		 
		   
		<div class="col-sm-3">		 
		Servis Biniş Noktası 
		
	<label for="servisbinis" > </label>
	<select class="custom-select task-manager-list-select" id="servisbinis" name="servisbinis1[]"  > 
	
	<?php $serbak = $mysqli->query("select * from turguzsec where turID='$turID' "); 
		
		while($seryaz = $serbak->fetch_array()){
			
			$guzID 		= $seryaz['guzID'];			
			$guzbak 	= $mysqli->query("select * from turcikisnokta where id='$guzID'  ");
			$guzyaz 	= $guzbak->fetch_array();
			
			echo '<option value="'.$guzyaz['id'].'">'.$guzyaz['baslik'].' - '.$seryaz['saat'].'</option>';
			
		}
	
	?>
		 			   
		 </select>			 			
		</div>	
	 
		 
 </div>	 
	 
	 
	 
<hr/>

  <div class="form-group row"  >
	 <div class="col-sm-2 ">
  <button type="button" class="btn btn-raised ripple btn-raised-success m-1" id="odaekleee"> <i class="fa fa-plus"></i> Oda Ekle </button> 
</div> 
</div>
	   
  
	  
	  <script type="text/javascript"> 
	$(function(){
	    
	 	$("#odaekleee").click(function(){  
		// var cikisnokta = $("select[name=cikisnokta]").val(); 
		
		$("#toplaa").empty();
		
		var nsayi = $(".sayiiotel" ).length;
		var turID = $("input[name=turID]" ).val();
		var turtarihID = $( "input[name=turtarihID]" ).val();
		var totelsecc 	= $("#totelsecc").val();
	  
	 
			$.ajax( {
				url:"pages/rez/yeniotel.php",
				type:"post",
				data: {"nsayi":nsayi, 'totelsecc':totelsecc ,'turtarihID':turtarihID, 'turID':turID },
				success:function(ortakat1){
					 $(ortakat1).insertAfter("#yeniotelburayaa"); 
					 // $("#yenikisiburaya").html(ortakat1); 
				}
			}); 
		}); 
});		 
 </script>  
  
	  <div class="form-group row" id="yeniotelburayaa" ></div>
	   
	<?php }   ?>
	 
 
  <hr/>
   
  <div class="form-group row">
	   
 <div class="col-sm-12 p-12 mb-12 bg-primary text-white"  > Rezervasyon İletişim ve Fatura Bilgileri </div> 		
 <div class="alert alert-secondary" role="alert" style="width:100%;"> Yapmış olduğunuz bu rezervasyon ile ilgili iletişim kurabileceğimiz kişiye ya da kuruma ait bilgileri giriniz.  </div>
 </div>

	 	<div class="form-group row">
 
		<div class="col-sm-3"> 
	<div class="ul-form__radio-inline"> 
	 <label class=" ul-radio__position radio radio-primary form-check-inline">
	<input type="radio" name="faturatur" value="Bireysel" checked id="bireyss"  >
	<span class="ul-form__radio-font">Bireysel</span>
	<span class="checkmark"></span>
	</label> 
	
 <label class=" ul-radio__position radio radio-primary form-check-inline">
	<input type="radio" name="faturatur" value="Kurumsal" id="kuurmss"  >
	<span class="ul-form__radio-font">Kurumsal</span>
	<span class="checkmark"></span>
	</label> 

 
	</div> 
		</div>  
		</div>  
		
 <script type="text/javascript">
	$(function(){
		$("#kuurmss").change(function(){
			$("#kuurmsall").show(200);
		})	
		
		$("#bireyss").change(function(){
			$("#kuurmsall").hide(200);
		})
		  
	});
 
 </script>
 
	 <div class="form-group row">
	 
		<div class="col-sm-3"> 
	Adınız    
 <input type="text" name="fad" class="form-control" id="" placeholder="Adınız" value="<?php echo $fad; ?>"  > 
		</div> 
		<div class="col-sm-3"> 
 	Soyadınız   
 <input type="text" name="fsoyad" class="form-control" id="" placeholder="Soyadınız" value="<?php echo $fsoyad; ?>"  > 				
		</div> 
		
		<div class="col-sm-3"> 
 	Telefon   
 <input type="text" name="ftel" class="form-control" id="" placeholder="Telefon" value="<?php echo $ftel; ?>"  > 				
		</div> 
		
		<div class="col-sm-3"> 
 	Mail   
 <input type="text" name="fmail" class="form-control" id="" placeholder="Mail" value="<?php echo $fmail; ?>"  > 				
		</div> 
		
	<div class="col-sm-3">
 T.C. Kimlik No
  
 <input type="text" name="fkimlik" class="form-control" id="" maxlength="11" placeholder="T.C. Kimlik No" value="<?php echo $fkimlik; ?>"  >		 
	</div>  
	    		
	<div class="col-sm-6">
 Adres
  
 <input type="text" name="fadres" class="form-control" id=""  placeholder="Adres" value="<?php echo $fadres; ?>"  >		 
	</div>  
	    
	<div class="col-sm-3">
<label for="fbilgiayni">	Fatura Bilgilerim Adres Bilgilerimle Aynıdır.</label>
	 <label class="checkbox checkbox-primary mr-2">
		<input id="fbilgiayni" type="checkbox"   name="fbilgiayni" checked  >
		<span> </span>
		<span class="checkmark"></span>
	</label>	 
	</div> 	
	 
	 
 </div>	 
    
	 <div class="form-group row"  id="kuurmsall" style="display:none;">
	 
		<div class="col-sm-3"> 
	Firma Adı    
 <input type="text" name="ffirma" class="form-control" id="" placeholder="Firma Adı" value="<?php echo $ffirma; ?>"  > 
		</div> 
		<div class="col-sm-3"> 
 	Vergi Dairesi   
 <input type="text" name="fvergidaire" class="form-control" id="" placeholder="Vergi Dairesi" value="<?php echo $fvergidaire; ?>"  > 				
		</div> 
		
		<div class="col-sm-3"> 
 	Vergi No   
 <input type="text" name="fvergino" class="form-control" id="" placeholder="Vergi No" value="<?php echo $fvergino; ?>"  > 				
		</div> 
		 
	  
 </div>	 
  
  
 <div class="form-group row">
	 
		<div class="col-sm-10">
		<textarea name="notlar" cols="100%" rows="4" placeholder="Notlar"></textarea>
	 
   
	</div> 
</div>  

 <div class="form-group row">
	 
	<label for="sira" class="col-sm-2 col-form-label"> <h3> Toplam Meblağ : </h3>   </label>
	<div class="col-sm-1"> 
  
 <input type="text" name="toplam" id="toplaa" class="form-control" id="" placeholder="Toplam Tutar" value="<?php echo $ttyaz['gunfiyat']; ?>" required > 	
<span class="span-right-input-icon" style="margin-top:-3px;"> <?php echo $pyaz['simge'];?>  &nbsp;&nbsp;&nbsp; </span> 
 </div>
</div>

 <div class="form-group row">
	 
	
	<label for="sira" class="col-sm-2 col-form-label"> <h3>  Ödeme Şekli : </h3>   </label>
	
	<div class="col-sm-2"> 

	<select class="custom-select task-manager-list-select " id="odemesekli"   name="odemesekli" required  >
		<option value="Kredi Kartı"> Kredi Kartı </option>
		<option value="Havale"> Havale </option>
		
		<?php 
		if($acentaID!=""){ 
		
		echo '<option value="Acenta Carisi"> Acenta Carisi  </option>';
		
		}
		?>
		
			  
			 
		 </select>
			 	 						
		</div>
		
</div>
	
<div class="form-group row">
  
	 <div class="col-sm-6">
	 
	<button type="submit" class="btn btn-primary ul-btn__text" name="rezbaslat" value="Rezervasyon Başlat">Rezervasyon Başlat</button>
 
	</div>
</div>
	
</form>

			</div>
		</div>
	</div>
		
	<?php } ?>
	 
	</div> 
	
	<script type="text/javascript"> 
	$(function(){
	    
	 	$("#yenikisieklee").click(function(){  
		// var cikisnokta = $("select[name=cikisnokta]").val(); 
		var nn = $(".sayii" ).length;
		var turID = $("#turID").val();
		var turtarihID = $("#turtarihID").val();
	 
	 
			$.ajax( {
				url:"pages/rez/yenikisi.php",
				type:"post",
				data: {"nn":nn, 'turID':turID ,'turtarihID':turtarihID },
				success:function(ortakat1){
					 $(ortakat1).insertAfter("#yenikisiburayaa"); 
					 // $("#yenikisiburaya").html(ortakat1); 
				}
			}); 
		}); 
});		 
 </script> 
	
	
</div>