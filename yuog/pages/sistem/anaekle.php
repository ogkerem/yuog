<?php 
 
define('YUOG',TRUE);
require_once("../../../inc/config.php"); 

?>

<script type="text/javascript"> 
	$(function(){
	   
		$("#hareketsill").click(function(){ 
		   $(this).parent().parent().remove();
		});
		
});		
	 
 </script>
 
 <div class="row" id="hekleleme" >
    <div class="col-4  ">
    
	  <select class="form-control" name="guzsec[]" >
	  <option value="">Hareket Noktası Seç </option>
			<?php 
			
			$cikisnokta	= $_POST['cikisnokta'];
			 
				$gbakk  = $mysqli->query("select * from turcikisnokta where katID='$cikisnokta' order by sira asc ");
					while($guzyaz = $gbakk->fetch_array()){
						 
					
						echo '<option value='.$guzyaz['id'].' >'.$guzyaz['baslik'].' </option>'; 
					}
			
			?>			
					 
	 </select>
	 
	 
    </div>
    <div class="col-2  ">
      <input type="text" class="form-control" id="validationCustom02" name="hareketsaat[]" placeholder="14:00" value="14:00"  >
    </div>
    <div class="col-2 ">
      <button type="button" class="btn btn-raised ripple btn-raised-danger m-1" id="hareketsill"> <i class="fa fa-minus"></i> Sil </button>
    </div>
 </div>
		 

 