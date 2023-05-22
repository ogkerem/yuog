<script type="text/javascript"> 
	$(function(){
	   
		$("#ekstrassill").click(function(){ 
		   $(this).parent().parent().remove();
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
	
	<div class="col-sm-1">
Single Fark
	<input type="text" name="singlefark[]" class="form-control" id="" placeholder="Single Fark" value="<?php echo $singlefark; ?>" >		 
	</div> 
		
		
		<div class="col-1"> 
Tripel Fiyat
 <input type="text" name="tripelfiyat[]" class="form-control" id="" placeholder="Tur Fiyat" value="<?php echo $turfiyat; ?>" > 
    							
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
		<input type="checkbox" name="oteldolubos[]" >
		<span> </span>
		<span class="checkmark"></span>
	</label>	 
	</div> 	
	
<div class="col-sm-1">
Oteli Sil
  
<button type="button" class="btn btn-raised ripple btn-raised-danger m-1" id="ekstrassill"> <i class="fa fa-minus"></i></button>
	  
</div> 

<label for="resim" class="col-sm-2 col-form-label">Resimler </label>
		<div class="col-sm-2"> 
		  <input type="file" name="resim[]" class="form-control" id="resim" placeholder=" "   > 
		<!--  <input type="file" name="rtoplu1[]" multiple="multiple" class="form-control" id="resim" placeholder=" "   > -->
			 				
		</div>
	 
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
 