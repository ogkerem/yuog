<?php 
 
define('YUOG',TRUE);
require_once("../inc/config.php"); 

?>

<script type="text/javascript"> 
	$(function(){
	   
		$("#hareketsill").click(function(){ 
		   $(this).parent().parent().remove();
		});
		
});		
	 
 </script>
  
  
 <div class="form-group row" id="hekleleme" >
	<label for="obaslik2" class="col-sm-3 col-form-label"> Durum / Başlık / Format / Size </label>
	
	<div class="col-sm-1"> 
		<label class="switch switch-primary mr-3" id="obaslik2"> 
			  <input name="obaslik2" type="checkbox"  >  
			<span class="slider"></span>
		</label> 
	</div>  
<div class="col-sm-3">
	<input type="text" name="oacik2" class="form-control" id="oacik2" placeholder="Menü İsmi" value="" >
</div> 

		<div class="col-sm-2"> 
			<select class="custom-select task-manager-list-select" name="tip" >			 
				<option value="baslik" > Başlık Alanı </option> 
				<option value="onyazi" > Ön Yazı Alanı </option> 
				<option value="icerik" > İçerik Alanı </option> 
				<option value="resim" > Resim </option>  
		 </select> 
		</div>
		
		<div class="col-sm-1">
			<input type="text" name="boyut" class="form-control" id="boyut" placeholder="Boyut" value="" >
		</div>  
	 
		  <div class="col-2 ">
			<button type="button" class="btn btn-raised ripple btn-raised-danger m-1" id="hareketsill"> <i class="fa fa-minus"></i> Sil </button>
		</div>
</div>

 