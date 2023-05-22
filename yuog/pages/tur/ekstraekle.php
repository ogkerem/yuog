
<script type="text/javascript"> 
	$(function(){
	   
		$("#ekstrasill").click(function(){ 
		   $(this).parent().parent().remove();
		});
		
});		
	 
 </script>
 

<div class="row py-1" id="ozellikkk" > 
<div class="col-4  "> <input type="text" name="ozellik[]" class="form-control" id="validationCustom02" placeholder="Özellik" value=""  > </div> 
<div class="col-2  "> <input type="text" name="ofiyat[]" class="form-control" id="validationCustom02" placeholder="Fiyat" value=""  > </div> 
<div class="col-2 "> <button type="button" class="btn btn-raised ripple btn-raised-danger m-1" id="ekstrasill"> <i class="fa fa-minus"></i> Sil </button> </div> </div>  
