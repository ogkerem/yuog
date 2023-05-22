 <script type="text/javascript"> 
		$(function(){
			$("select[name=yurt]").change(function(){
				 
				var yurt = $("select[name=yurt]").val();
				 
				 if(yurt=="Yurt Dışı"){
					 $("#vizee").show(500);
				 } else {
					 $("#vizee").hide(500);
				 }
				
			});
			
		});
		</script> 	
		

 
 

<script type="text/javascript"> 
	$(function(){
	 
	 
	 	$("#yenigunekle").click(function(){
			
			$.ajax( {
				url:"pages/tur/tpekle.php",
				type:"post",
				success:function(ortakat){
					 $(ortakat).insertAfter("#tbaslikk"); 
				}
			}); 
		});
	 
 


 	
});		
	 
 </script>