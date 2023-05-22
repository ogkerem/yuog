<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="robots" content="noindex, nofollow">
  <title>Basic Preset</title>
  <script src="https://cdn.ckeditor.com/4.13.1/basic/ckeditor.js"></script>
</head>

<body>
 
  <script>
    CKEDITOR.replace('editor1', {
      height: 150
    });
  </script>


<script type="text/javascript"> 
	$(function(){
	   
		$("#gunsil").click(function(){ 
		   $(this).parent().parent().remove();
		});
		
});		
	 
 </script>
 
 

<div id="tbaslikk"> 
<div class="form-group row"> 
<label for="turbaslik" class="col-sm-2 col-form-label"> Program Başlık </label> 
<div class="col-sm-10"> <input type="text" name="turbaslik[]" class="form-control" id="turbaslik" placeholder="Tur Başlık" value="" required > </div> 
</div> 
<div class="form-group row"> 
<label for="turaciklama" class="col-sm-2 col-form-label"> Açıklama  </label> 
<div class="col-sm-10"> 
<textarea name="turaciklama[]" class="ckeditor" id="editor1"  rows="4" style="width:100%"></textarea> 
</div>  


</div> 

 <div class="form-group row">
	<label for="sira" class="col-sm-2 col-form-label">Sırası </label>
	<div class="col-sm-2">
	  <input type="text" name="tursira[]" class="form-control" id="sira" placeholder="Sıra" value="<?php echo $sira; ?>" > 
		
						
		</div>
		 
	</div>
	
	
<button type="button" class="btn btn-raised ripple btn-raised-danger m-1" id="gunsil"> <i class="fa fa-minus"></i> Sil </button> 


</div> 


</body>

</html>
