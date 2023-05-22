<?php 
 
define('YUOG',TRUE);
require_once("../../../inc/config.php"); 

?>


<script type="text/javascript"> 
	$(function(){
	   
		$("#yenikisisil").click(function(){ 
		   $(this).parent().parent().remove();
		});
		
	});		
	 
 </script>
 
 <?php 
	$nn 			= $_POST['nsayi']+1;
	$turID 			= $_POST['turID']; 
	$turtarihID 	= $_POST['turtarihID']; 
	$totelsecc 		= $_POST['totelsecc']; 
	
	$totsec 		= $mysqli->query("select * from turtarihotel where id='$totelsecc' "); 
	$totyaz 		= $totsec->fetch_array();  
	  
	$ttarihbak 		= $mysqli->query("select * from turtarih where id='$turtarihID' ");
	$ttyaz 			= $ttarihbak->fetch_array();
	$yenifiyat 		= $ttyaz['gunfiyat']*$nn; 
	
 ?>
 
<div>
<hr/>
	<!-- otel başlangıç -->
	<div class="form-group row">

 
<!--	
	$turfiyat 		= $otelyaz['turfiyat']; 
	$singlefark 	= $otelyaz['singlefark']; 
	$tripelfiyat 	= $otelyaz['tripelfiyat']; 
	$sifiriki 		= $otelyaz['sifiriki']; 
	$ucalti 		= $otelyaz['ucalti']; 
	$yedioniki 		= $otelyaz['yedioniki'];  -->
	
	 
		<input type="hidden" name="singlefiyat" value="<?php echo $nn*($turfiyat+$singlefark);  ?>"> 
		<input type="hidden" name="dublefiyat" value="<?php echo $nn*$turfiyat*2; ?>"> 
		<input type="hidden" name="tripelfiyat" value="<?php echo $nn*$turfiyat*3; ?>"> 
		<input type="hidden" name="familyfiyat" value="<?php echo $nn*$turfiyat*2; ?>"> 
		<input type="hidden" name="odatip1[]" value="" id="odatip"> 
		
<script type="text/javascript">
	
	$(function(){
		$(".birrr").click(function(){	
			$("input[name=kaclik]").val("birrr");
			$(this).removeClass("btn btn-outline-secondary m-1");
			$(this).addClass("btn btn-dark ripple m-1");  
			$(".ikiii").addClass("btn btn-outline-secondary m-1");  
			$(".uccc").addClass("btn btn-outline-secondary m-1");  
			$(".dortttt").addClass("btn btn-outline-secondary m-1");  
			$(".besss").addClass("btn btn-outline-secondary m-1");
			$(".ikinciyetiskin").hide(200);
			$(".ucuncuyetiskin").hide(200);
			$(".cocukk").hide(200);
			var singlefiyat = $("input[name=singlefiyat]").val();
			var vtoplaa = Number($("#toplaa").val())+Number(singlefiyat);
			
			$("#toplaa").val(vtoplaa);
			$("#odatip").val("single");
			
		});
		
		$(".ikiii").click(function(){
			$("input[name=kaclik]").val("ikiii");			
			$(this).removeClass("btn btn-outline-secondary m-1");
			$(this).addClass("btn btn-dark ripple m-1");  
			$(".birrr").addClass("btn btn-outline-secondary m-1");  
			$(".uccc").addClass("btn btn-outline-secondary m-1");  
			$(".dortttt").addClass("btn btn-outline-secondary m-1");  
			$(".besss").addClass("btn btn-outline-secondary m-1"); 
			$(".ikinciyetiskin").show(200);
			$(".ucuncuyetiskin").hide(200);
			$(".cocukk").hide(200);
			var dublefiyat = $("input[name=dublefiyat]").val();
			 
			var vtoplaa = Number($("#toplaa").val())+Number(dublefiyat);			
			$("#toplaa").val(vtoplaa);
			$("#odatip").val("double");
			
			
		});
		
		$(".uccc").click(function(){	
			$("input[name=kaclik]").val("uccc");			
			$(this).removeClass("btn btn-outline-secondary m-1");
			$(this).addClass("btn btn-dark ripple m-1");  
			$(".birrr").addClass("btn btn-outline-secondary m-1");  
			$(".ikiii").addClass("btn btn-outline-secondary m-1");  
			$(".dortttt").addClass("btn btn-outline-secondary m-1");  
			$(".besss").addClass("btn btn-outline-secondary m-1");  
			$(".ikinciyetiskin").show(200);
			$(".ucuncuyetiskin").hide(200);
			$(".cocukk").hide(200);
			var dublefiyat = $("input[name=dublefiyat]").val();
			$("#toplaa").val(dublefiyat);
			
			var vtoplaa = Number($("#toplaa").val())+Number(dublefiyat);			
			$("#toplaa").val(vtoplaa);
			$("#odatip").val("twin");
			
		});
		
		
		$(".dortttt").click(function(){			 
			$("input[name=kaclik]").val("dortttt");	
			$(this).removeClass("btn btn-outline-secondary m-1");
			$(this).addClass("btn btn-dark ripple m-1");  
			$(".birrr").addClass("btn btn-outline-secondary m-1");  
			$(".uccc").addClass("btn btn-outline-secondary m-1");  
			$(".ikiii").addClass("btn btn-outline-secondary m-1");  
			$(".besss").addClass("btn btn-outline-secondary m-1");   
			$(".ikinciyetiskin").show(200);
			$(".ucuncuyetiskin").hide(200);
			$(".cocukk").show(200);	 
			var familyfiyat = $("input[name=familyfiyat]").val();			
			$("#toplaa").val(familyfiyat);		   
			
			var vtoplaa = Number($("#toplaa").val())+Number(familyfiyat);			
			$("#toplaa").val(vtoplaa);
			$("#odatip").val("family");
		});
		
		
		$(".besss").click(function(){			 
			$("input[name=kaclik]").val("besss");	
			$(this).removeClass("btn btn-outline-secondary m-1");
			$(this).addClass("btn btn-dark ripple m-1");  
			$(".birrr").addClass("btn btn-outline-secondary m-1");  
			$(".uccc").addClass("btn btn-outline-secondary m-1");  
			$(".dortttt").addClass("btn btn-outline-secondary m-1");  
			$(".ikiii").addClass("btn btn-outline-secondary m-1"); 
			$(".ikinciyetiskin").show(200);
			$(".ucuncuyetiskin").show(200);
			$(".cocukk").hide(200);
			var tripelfiyat = $("input[name=tripelfiyat]").val();
			$("#toplaa").val(tripelfiyat);
			
			var vtoplaa = Number($("#toplaa").val())+Number(tripelfiyat);			
			$("#toplaa").val(vtoplaa);
			$("#odatip").val("triple");
			
		});
		
		
	});

</script>
 
	 
<input type="hidden" value="" name="kaclik" >
<button type="button" class="btn btn-outline-secondary m-1 birrr" id="" style="<?php if($singleoda=="on"){ echo 'display:none;'; } ?>" > <img src="../img/tek-kisilik-selected.png">  <p> Single </p></button>
<button type="button" class="btn btn-outline-secondary m-1 ikiii " id="" style="<?php if($doubleoda=="on"){ echo 'display:none;'; } ?>" > <img src="../img/cift-kisilik-selected.png">  <p> Double </p></button>
<button type="button" class="btn btn-outline-secondary m-1 uccc " id="" style="<?php if($twinoda=="on"){ echo 'display:none;'; } ?>" > <img src="../img/cift-kisilik-ayri-selected.png">  <p> Twin </p></button>
<button type="button" class="btn btn-outline-secondary m-1 dortttt " id="" style="<?php if($familyoda=="on"){ echo 'display:none;'; } ?>" > <img src="../img/triple-yatak-selected.png">  <p> Family </p></button>
<button type="button" class="btn btn-outline-secondary m-1 besss " id="" style="<?php if($tripleoda=="on"){ echo 'display:none;'; } ?>" > <img src="../img/triple-last-selected.png">  <p> Triple </p></button>
  
	</div>
	 
	
	<div class="form-group row" <?php if($singleoda=="on"){ echo 'display:none;'; } ?> >
	   
	<div class="col-sm-12 p-12 mb-12 bg-dark text-white"  >1 . Yetişkin Bilgileri   <span class="pull-right"> ODA</span> <input type="hidden" class="sayiiotel"> </div> 
		 
		<div class="col-sm-2">
		 
	Cinsiyet * 
	<select class="custom-select task-manager-list-select " id="cinsiyet"   name="cinsiyet1[]"   >
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
	    
		<input type="hidden" name="nnn" value="<?php echo $nn; ?>">   
		<div class="col-sm-2">		
 
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
 Doğum Tarihi (02/26/2020) 
 <input type="text" name="ddogumtarih[]" class="form-control dogumtarih" id="datepicker1<?php echo $nn; ?>" autocomplete="off"  value=""  > 
   
 <script type="text/javascript"> 
	$(function(){	   
		var nnn = $("input[name=nnn]").val();		  
		$('#'+nnn).datepicker1({  
            uiLibrary: 'bootstrap'
        });
	});		
	 
 </script>
 							
		</div>
		
		<div class="col-sm-2"> 
  Cep Telefonu *  
 <input type="text" name="cep1[]" class="form-control " id="" placeholder="Cep Telefonunuz" maxlength="10" value=""  > 				
		 
		 <small id="web" class="ul-form__text form-text "> Örnk. 5364540934 </small>
		 </div> 
		 
		   
		<div class="col-sm-3">		 
		Servis Biniş Noktası <?php echo $turtarihID; ?>
		
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
	 
	 
	 
	<div class="form-group row ikinciyetiskin" id="" style="<?php if(($doubleoda=="on") ||($doubleoda=="on")){ echo 'display:none;'; } ?>" >
	  
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
	 
	 
	<div class="form-group row ucuncuyetiskin" id="" style="display:none; <?php if($tripleoda=="on") { echo 'display:none;'; } ?> " >
	   
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
	 
	 
	<div class="form-group row cocukk" id="" style="display:none; <?php if($familyoda=="on"){ echo 'display:none;'; } ?> " >
	    
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
  
 <input type="text" name="kimlikno1[]" class="form-control" id="" maxlength="11" placeholder="T.C. Kimlik No" value=""  >		 
	</div>  
	    <input type="hidden" name="totelsecc" value="<?php echo $otelsecc; ?>" id="totelsecc" >
		

		<div class="col-sm-2">		
 
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
 (AA/GG/YYYY) Örn. Doğum Tarihi (02/26/2020) elle giriniz
 <input type="text" name="ddogumtarih[]" class="form-control" id="" autocomplete="off"  value=""  > 
   
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
 <input type="text" name="cep1[]" class="form-control " id="cepelll" placeholder="Cep Telefonunuz" maxlength="10" value="" > 				
		 
		 <small id="web" class="ul-form__text form-text "> Örnk. 5364540934 </small>
		 </div> 
		 
		   
		<div class="col-sm-3">		 
		Servis Biniş Noktası 
		
	<label for="servisbinis" > </label>
	<select class="custom-select task-manager-list-select" id="servisbinis" name="servisbinis1[]" required > 
	
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
	 
	 
	 
		
  	
	<div class="col-sm-2 ">
	Odayı Sil <br/>
       <button type="button" class="btn btn-raised ripple btn-raised-danger m-1" id="yenikisisil"> <i class="fa fa-minus"></i> Sil </button>
    </div> 
	 
 </div>	