 <?php  defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim '); ?>
	<div class="main-content">
	
		
   <div class="breadcrumb">
		<h1>Rezervasyon  Ekleme</h1>
		<ul>
			<li><a href="index.php">Ana Sayfa</a></li>
			<li><a href="?sy=rezervasyonlar">Rezervasyonlar</a></li> 
		</ul>
	</div>
		 
 <div class="separator-breadcrumb border-top"></div> 

	<form action="?sy=rezbaslat" method="post" enctype="multipart/form-data" > 
	
	<div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
          <div class="card-title mb-3">Tur Seç</div>
		  
				<div class="row"> 
	
	<script type="text/javascript"> 
		$(function(){
			$("select[name=turID]").change(function(){
				 
				var turID = $("select[name=turID]").val(); 
				$("#turIDgizli").val(turID);
				$.ajax({
					url: "pages/rez/tarihbak.php",
					type: "POST",
					data: {"turID":turID},
					success: function(ortakat) { 
						$("#turtarihID").html(ortakat);
					} 
				}); 
			}); 
			
			$("#turID").focus();
			
			$("select[name=turtarihID]").change(function(){
				
				var turtarihID = $("select[name=turtarihID]").val();
			 
				$.ajax({
					url: "pages/rez/otelbak.php",
					type: "POST",
					data: {"turtarihID":turtarihID},
					success: function(ortakat1) { 
						$("#otelsecc").html(ortakat1);
					} 
				}); 
				
				$("#turtarihIDgizli").val(turtarihID);
				
				
				var tarihyaz = $("#turtarihID option:selected").text();  
				
				$("#turtarihsecildi").html(tarihyaz);

					var tsy = $("#turID option:selected").text(); 
				$("#tursecildi").html(tsy);	
				
				  
				$("#resgosterr").show(200);
				
			});
			
		});
		</script> 		 
 
	<div class="col-md-3 form-group mb-3">
		<label for="turID">Tur Seçin</label>
		
		 <select class="custom-select task-manager-list-select" name="turID" id="turID" required  >	

		<option value="" >Turlar</option>
		 
		<?php $cikbak  = $mysqli->query("select * from turlar where durum='1'  order by sira asc ");
				while($cikyaz = $cikbak->fetch_array()){
					 
					echo '<option value='.$cikyaz['id'].' sy="'.$cikyaz['baslik'].'" >'.$cikyaz['baslik'].'</option>'; 
				} 
		?>			
					 
		 </select> 
		 
	</div>
		   
	<div class="col-md-2 form-group mb-3">
		<label for="turtarihID">Tarih Seçin (Tur Türü)</label>
		
		 <select class="custom-select task-manager-list-select" name="turtarihID" id="turtarihID" >					 
			 		
					 
		 </select> 
		 
	</div>
			   
	<div class="col-md-2 form-group mb-3" id="">
		<label for="otelsecc">Otel Seçin </label>
		
		 <select class="custom-select task-manager-list-select" name="otelsecc" id="otelsecc" >					 
			 		  
		 </select> 
		 
	</div>
	
	
	<div class="col-md-2 form-group mb-3">
	<label for="acentaID">Acenta Seçin</label>

		 <select class="custom-select task-manager-list-select " name="acentaID" id="acentaID" >
		  
		 <option value="" >Acenta Yoksa Boş Bırakın </option>
		 
		<?php $acentabak  = $mysqli->query("select * from acenta where durum='1'  order by firma asc ");
				while($acenyaz = $acentabak->fetch_array()){
					 
					echo '<option value='.$acenyaz['id'].' >'.$acenyaz['firma'].' / '.$acenyaz['yetkili'].' </option>'; 
				} 
		?>			
		
		 </select> 
	</div>
	
	

		</div>
				 
		</div>
	</div>
</div>
 
</div> 
<div class="row" id="" >
	<div class="col-md-12">
	   
	 
		<div class="card mb-5">
			<div class="card-body"> 
			

		<label> 
		<h4 id="tursecildi" >     </h4> 
		<input type="hidden" value="" name="turIDgizli" id="turIDgizli" >
		
		<h5 id="turtarihsecildi">  </h5> 
		<h5 id="otelseccy">  </h5> 
		 
		<input type="hidden" value="" name="turtarihIDgizli" id="turtarihIDgizli" >
		<input type="hidden" value="" name="acentaIDgizli" id="acentaIDgizli" >
		 
		</label>
 
 
   
	<div class="form-group row" id="resgosterr" style="display:none; ">
	<label for="sira" class="col-sm-2 col-form-label">  </label>
		<div class="col-sm-10">
		 <button type="submit" class="btn btn-primary ul-btn__text">Rezervasyon Başlat </button>
		 
		</div>
	</div>
	


 
		</div>
	</div>
</div>
</div>
            

</form>
 
</div> 

	
		 
		