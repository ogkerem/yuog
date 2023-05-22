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
	$nn 			= $_POST['nn']+1;
	$turID 			= $_POST['turID']; 
	$turtarihID 	= $_POST['turtarihID']; 
	
	$ttarihbak 		= $mysqli->query("select * from turtarih where id='$turtarihID' ");
	$ttyaz 			= $ttarihbak->fetch_array();
	$yenifiyat 		= $ttyaz['gunfiyat']*$nn; 
	
 ?>

<input type="hidden" value="<?php echo $yenifiyat; ?>" name="fiyatt">
<div class="form-group row"> 
	   	<div class="col-sm-12 p-12 mb-12 bg-dark text-white" ><?php echo $nn; ?>. Misafir Bilgileri <input type="hidden" class="sayii"> </div> 
		
		<div class="col-sm-2">
		 
 Cinsiyet * 
	<select class="custom-select task-manager-list-select " id="cinsiyet"   name="cinsiyet1[]" required  >
		<option value="Bayan"> Bayan </option>
		<option value="Bay"> Bay </option>
			 
		 </select>
			 	 						
		</div>
		
		<div class="col-sm-3"> 
	Adınız *  
 <input type="text" name="adi1[]" class="form-control" id="" placeholder="Adınız" value="" required > 
		</div> 
		<div class="col-sm-3"> 
 	Soyadınız *  
 <input type="text" name="soyadi1[]" class="form-control" id="" placeholder="Soyadınız" value="" required > 				
		</div> 
	<div class="col-sm-3">
 T.C. Kimlik No *
  
 <input type="text" name="kimlikno1[]" class="form-control" id="" maxlength="11" placeholder="T.C. Kimlik No" value="" required >		 
	</div>  
	    
		<div class="col-sm-2">		
 
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
 Doğum Tarihi (02/26/2020)
 <input type="hidden" name="nnn" value="datepicker<?php echo $nn; ?>">
 <input type="text" name="dogumtarih1[]" class="form-control dogumtarih" id="datepicker<?php echo $nn; ?>" autocomplete="off" placeholder="" value="<?php echo $sefertarih; ?>" required > 
  
  
  <script type="text/javascript"> 
	$(function(){	   
		var nnn = $("input[name=nnn]").val();		  
		$('#'+nnn).datepicker({  
            uiLibrary: 'bootstrap'
        });
	});		
	 
 </script>
 
  
 							
		</div>
		
		
		<script type="text/javascript"> 
	$(function(){
	    
		var fiyatt = $("input[name=fiyatt]").val();
		
		 $("#toplaa").val(fiyatt+".00");
		
	// $(".dogumtarih").has(function(){
		
		// var dogumtarih = $("input[name=dogumtarih"[]"]").val(); 
		
		// alert(dogumtarih);
	// var dogumtarih = $('.dogumtarih[]').serializeArray();
		  // alert(dogumtarih);
		
		// $.ajax({
			// url: "pages/rez/tarihbak.php",
			// type: "POST",
			// data: {"turID":turID},
			// success: function(ortakat) { 
				// $("#turtarihID").html(ortakat);
			// } 
		// }); 
				 
				
	// });
 
  
	});		
	 
 </script> 



		
		<div class="col-sm-2"> 
  Cep Telefonu *  
 <input type="text" name="cep1[]" class="form-control zhesap" id="" placeholder="Cep Telefonunuz" value="" > 			
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
		
  	
	<div class="col-sm-2 ">
	 Misafiri Sil <br/>
       <button type="button" class="btn btn-raised ripple btn-raised-danger m-1" id="yenikisisil"> <i class="fa fa-minus"></i> Sil </button>
    </div> 
	 
 </div>	