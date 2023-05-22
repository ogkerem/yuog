	<?php 
	 
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
	$konu 		= "anasayfa";
  
	$dilbak = @$_GET['dil'];
	if($dilbak==""){ 
	$dilyaz = $mysqli->query("select * from diller order by sira asc limit 1 ")->fetch_array();  
		$dil = $dilyaz['id'];
	} else {
		$dil = $dilbak;	
		$dilyaz = $mysqli->query("select * from diller where id='$dil' ")->fetch_array(); 
		 
	} 
	 
	 
	?>
	
	 <script type="text/javascript"> 
	$(function(){ 
		$("#hareketsill").click(function(){ 
			$(this).parent().parent().remove();
		});
		
		});	 
 </script>
 
	
	<script type="text/javascript"> 
	$(function(){
	    
	 	$("#hareketeklee").click(function(){ 
		    
		  $( '<div class="form-group row" style=""><label for="durum1" class="col-sm-2 col-form-label"> Durum / Başlık / Format / Size </label><div class="col-sm-1"><label class="switch switch-primary mr-3" id="durum1"> <input name="durum1[]" type="checkbox" checked  >   <span class="slider"></span> </label>  </div>  <div class="col-sm-3"> <input type="text" name="baslik1[]" class="form-control" id="baslik1" placeholder="Menü İsmi" value="" > </div> 	<div class="col-sm-2"> <select class="custom-select task-manager-list-select" name="tip[]" > <option value="baslik" > Başlık Alanı </option> <option value="onyazi" > Ön Yazı Alanı </option> <option value="icerik" > İçerik Alanı </option> <option value="resim" > Resim </option>  </select> </div> <div class="col-sm-1"> <input type="text" name="boyut[]" class="form-control" id="boyut" placeholder="Boyut" value="" > </div><div class="col-sm-1"> <input type="text" name="sira1[]" class="form-control" id="sira1" placeholder="Sıra" value="" > </div>   <div class="col-sm-2"> <button type="button" class="btn btn-raised ripple btn-raised-danger m-1" id="hareketsill"> <i class="fa fa-minus"></i> Sil </button> </div>  </div>' ).insertAfter("#hekleleme"); 
			 
	 
			});   
		});		
	 
 </script> 
  
  
	<div class="main-content">  
	
   <div class="breadcrumb">
                <h1><a href="?sy=sistem"> Sistem (  Menüler) </a> > <a href="?sy=anasayfa"> Ana Sayfa Düzeni</a> > <?php echo $dilyaz['baslik']; ?>  </h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li> İçerik Ekleme </li>
                    <li> <span class="badge badge-pill badge-warning p-2 m-1">UYARI!!! Bu alanda etkin değilseniz işlem yapmayınız</span>  </li> 
                     
                </ul>
            </div>
		 
            <div class="separator-breadcrumb border-top"></div>
   
					
            <div class="row">
                <div class="col-md-12">
                   
                    <p>  </p>
                    <div class="card mb-5">
                        <div class="card-body">
  
						<?php 
if($_POST){ 
	 
	 
	 $durum			= "on";
	 $sira			= (int)$_POST['sira'];
	 $baslik		= $_POST['baslik'];
	 $sef			= url_seo($baslik);
	 $durum1		= $_POST['durum1'];
	 $baslik1		= $_POST['baslik1'];
	 $basliksay 	= count($baslik1);
	 $tip			= $_POST['tip'];
	 $boyut			= $_POST['boyut'];
	 $sira1			= $_POST['sira1'];
	  
	$ekleyen		= $email;  
	$ip				= $_SERVER['REMOTE_ADDR']; 
	  
	$gonder  	= $mysqli->query(" insert into anasayfa set  
	 
		baslik 				='$baslik', 
		sef 				='$sef', 
		durum 				='$durum',  
		sira 				='$sira',  
		dil 				='$dil', 
		ip					='$ip' ,
		ekleyen				='$ekleyen',	
		otarih				= now()  
		
	  ");   
	   
	if($gonder){
		 $katID		= $mysqli->insert_id;
		  
		 for($x=0; $x<= $basliksay; $x++){
			
			$durum2			= $durum1[$x];
			$baslik2		= $baslik1[$x];
			$tip2			= $tip[$x];
			$boyut2			= (int)$boyut[$x];
			$sira2			= (int)$sira1[$x];
				
		  if($baslik2!=""){ 
		  
		$gonder  	= $mysqli->query(" insert into anasayfasistem set  	
			
			katID 				='$katID', 
			durum1 				='$durum2', 
			baslik1 			='$baslik2',  
			tip 				='$tip2',  
			boyut 				='$boyut2',  
			sira 				='$sira2',  
			dil 				='$dil', 
			ip					='$ip' ,
			ekleyen				='$ekleyen',	
			otarih				= now()   
				");    
			 } 	
		  
			
		 } 		 
		  header("Location:?sy=anasayfa&islem=basarili");	
		  
	} else { echo '<div class="alert alert-danger" role="alert">
				<strong class="text-capitalize">Hata!</strong>Hata İşlem Başarısız :(  
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div> <br /> <a href="javascript:history.back(-1)">Geri Dön</a>'; }   	  
	 
} else { 
?>	



	<form action="" method="post" enctype="multipart/form-data" >
 
 
 <div class="card-title">Ana Sayfa Alanı</div>
 
 <div class="form-group row">
		<label for="baslik" class="col-sm-3 col-form-label">İçerik Dili * </label>
		<div class="col-sm-6">
		
		<?php $dilbak1 = $mysqli->query("select * from diller order by sira asc "); 
		while($dilyaz1 = $dilbak1->fetch_array()){
			if($dilyaz1['id']==$dil){
			
	echo '<a href="?sy='.$konu.'ekle&dil='.$dilyaz1['id'].'"><button type="button" class="btn btn-raised btn-raised-primary m-1">'.$dilyaz1['baslik'].'</button></a> ';
	
			} else {
			
	echo '<a href="?sy='.$konu.'ekle&dil='.$dilyaz1['id'].'"><button type="button" class="btn btn-outline-primary m-1">'.$dilyaz1['baslik'].'</button></a> ';
	
			}
		
		}				
						?>
			 
		</div>
	</div>	
 
<div class="form-group row">
	<label for="baslik" class="col-sm-3 col-form-label">Başlık  </label>
	<div class="col-sm-6">
	 <input type="text" name="baslik" class="form-control" id="baslik" placeholder="Başlık" value="" required >
	</div>
</div>
 
<div class="form-group row">
	<label for="sira" class="col-sm-3 col-form-label">Sıra  </label>
	<div class="col-sm-1">
	 <input type="text" name="sira" class="form-control" id="sira" placeholder="Sıra" value=""   >
	</div>
</div>

  
<hr>

<div class="card-title">Menüye Ait İçerikler</div>
  
<div class="form-group row" id="hekleleme">
	<label for="durum1" class="col-sm-2 col-form-label"> Durum / Başlık / Format / Size </label>
	 <div class="col-sm-1"> 
		<label class="switch switch-primary mr-3" id="durum1"> 
			  <input name="durum1[]" type="checkbox" checked >  
			<span class="slider"></span>
		</label> 
	</div>  
<div class="col-sm-3">
	<input type="text" name="baslik1[]" class="form-control" id="baslik1" placeholder="Menü İsmi" value="" >
</div>  
<div class="col-sm-2"> 
	<select class="custom-select task-manager-list-select" name="tip[]" >			 
		<option value="baslik" > Başlık Alanı </option> 
		<option value="onyazi" > Ön Yazı Alanı </option> 
		<option value="icerik" > İçerik Alanı </option> 
		<option value="resim" > Resim </option>  
 </select> 
</div>
		
	<div class="col-sm-1">
		<input type="text" name="boyut[]" class="form-control" id="boyut" placeholder="Boyut" value="" >
	</div>   	
	<div class="col-sm-1">
		<input type="text" name="sira1[]" class="form-control" id="sira1" placeholder="Sıra" value="" >
	</div>   
	<div class="col-sm-1">
		<button type="button" class="btn btn-raised ripple btn-raised-success m-1" id="hareketeklee"> <i class="fa fa-plus"></i> Yeni Ekle </button>
	</div> 
</div>

 
 
 
	<div class="form-group row">
	<label for="sira" class="col-sm-3 col-form-label">  </label>
		<div class="col-sm-3">
			<button type="submit" class="btn btn-primary ul-btn__text">İçerik Ekle</button>
		 
		</div>
	</div>
	
		</form>

			<?php } ?>
				</div>
			</div>
		</div>
	</div>            
</div> 
				