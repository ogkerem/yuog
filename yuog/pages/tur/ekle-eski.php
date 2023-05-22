	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
 
	
	?>
	<div class="main-content">
	
   <div class="breadcrumb">
                <h1>Tur  Ekleme</h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li><a href="?sy=turlar">Turlar</a></li>
                   
                     
                </ul>
            </div>
		 
            <div class="separator-breadcrumb border-top"></div>
  
	
	 <?php $islem = $_GET['islem']; 
			if($islem=="basarili"){
				
	 echo '	<div class="alert alert-card alert-success" role="alert">
			<strong class="text-capitalize">Başarılı !</strong> İşleminiz başarıyla gerçekleştirilmiştir.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div> ';
			}
			
			?>

			
		 
					
            <div class="row">
                <div class="col-md-12">
                   
                    <p>  </p>
                    <div class="card mb-5">
                        <div class="card-body">
						
						<?php 
if($_POST){ 
	
	$baslik				= addslashes(trim($_POST['baslik']));
	$katID				=  $_POST['katID'];
	$onyazi				= addslashes(trim($_POST['onyazi']));
	$icerik				= addslashes($_POST['icerik']);
	$keywords			= addslashes($_POST['keywords']); 
	$description		= addslashes($_POST['description']); 
	$sira				= trim($_POST['sira']); 
	$hit				= 1;
	$durum				= 1;
	$ekleyen			= $email; 
	
	$ip					= $_SERVER['REMOTE_ADDR']; 
	
	
	$resimad			= $_FILES['resim']['name']; 
	$kaynak				= $_FILES['resim']['tmp_name']; 

	$resimsonad 		= rand(0,999).'-'.yeniurl(res_adi($resimad)).res_uzanti($resimad);
	$kresimsonad 		= 'mini-'.$resimsonad;	
	  
	$rhedef				= "../uploads/tur/";
	 
	$yeniurlmiz =  $_POST['seourl'];
	
	$seosor		= $mysqli->query("select * from seo where seo='$yeniurlmiz' ");
	$seoyazz	= $seosor->fetch_array(); 
	$seosay 	= $seosor->num_rows;
		 
	if($seosay>0){
		$sonurl = rand(0,100).'-'.$yeniurlmiz;
	} else { 
		$sonurl = $yeniurlmiz;
	}
	
	$seoekle 		= $mysqli->query("insert into seo (seo,konu) values ('$sonurl', 'turkat')");	
	$seoID			= $mysqli->insert_id;
	   
	$gonder  	= $mysqli->query(" insert into turkat set 
	 baslik 				='$baslik', 
	 katID 					='$katID', 
	 onyazi 				='$onyazi', 
	 icerik 				='$icerik', 
	 keywords 				='$keywords', 
	 description			='$description', 
	 kresim					='$kresimsonad', 
	 resim					='$resimsonad', 
	 ip						='$ip', 
	 tarih					= now(),
	 ekleyen				= '$ekleyen',
	 seo					= '$seoID',
	 hit					= '$hit',
	 sira					= '$sira',
	 durum					= '$durum'  
	 
	  ");   
	  
	if($gonder){
		
		$yukle 		= move_uploaded_file($kaynak,$rhedef."/".$resimsonad);
			
			kucult($rhedef, $resimsonad);
		 		
		  header("Location:?sy=turkat&islem=basarili");	
		  
	} else { echo '<div class="alert alert-danger" role="alert">
				<strong class="text-capitalize">Hata!</strong>Hata İşlem Başarısız :(  
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div> <br /> <a href="javascript:history.back(-1)">Geri Dön</a>'; }   	  
	 
} else { 
?>	



	<form action="" method="post" enctype="multipart/form-data" >
							
	<div class="form-group row">
		<label for="baslik" class="col-sm-2 col-form-label">Başlık * </label>
		<div class="col-sm-10">
		 <input type="text" name="baslik" class="form-control" id="baslik" placeholder="Başlık" value="<?php echo $baslik; ?>" required >
		</div>
	</div>
										
	<div class="form-group row">
		<label for="gece" class="col-sm-2 col-form-label">Gece   </label>
		<div class="col-sm-2">
		 <input type="text" name="gece" class="form-control" id="gece" placeholder="Gece" value="<?php echo $gece; ?>" required >
		</div>
	</div>
											
	<div class="form-group row">
		<label for="gunduz" class="col-sm-2 col-form-label">Gündüz   </label>
		<div class="col-sm-2">
		 <input type="text" name="gunduz" class="form-control" id="gunduz" placeholder="Gündüz" value="<?php echo $gunduz; ?>" required >
		</div>
	</div>
												
	<div class="form-group row">
		<label for="katID" class="col-sm-2 col-form-label">Kategoriler  </label>
		<div class="col-sm-10">
		 
		  <label for="katID"  > </label>
		 
		 <select class="form-control" name="katsec" multiple >
		 
			<?php 
				$ukat  = $mysqli->query("select * from turkat where katID!='0' && ustkatID!='0' order by sira asc ");
					while($uyaz = $ukat->fetch_array()){
						
					$katID1 	= $uyaz['katID'];
					$ukatba 	= $mysqli->query("select * from turkat where id='$katID1' ");
					$uuyaz 		= $ukatba->fetch_array();
					
					$ustkatID1 	= $uyaz['ustkatID'];
					$ukatbak 	= $mysqli->query("select * from turkat where id='$ustkatID1' ");
					$uyazz 		= $ukatbak->fetch_array();
					
						echo '<option value='.$uyaz['id'].' >'.$uyazz['baslik'].' ->'.$uuyaz['baslik'].' -> '.$uyaz['baslik'].'</option>'; 
					}
			
			?>			
					 
		 </select>
			<small id="resim" class="ul-form__text form-text "> CTRL basılı tutup birden fazla seçebilirsiniz  </small>	 						
		</div>
		
			
		
		
	</div>
							
 											
	<div class="form-group row">
		<label for="katID" class="col-sm-2 col-form-label">Çıkış Noktası  </label>
		<div class="col-sm-10">
		 
		  <label for="katID"  > </label>
					<select class="form-control" name="cikisnokta" >
					 
			<?php 
				$cikbak  = $mysqli->query("select * from cikisnokta  order by sira asc ");
					while($cikyaz = $cikbak->fetch_array()){
						 
						echo '<option value='.$cikyaz['id'].' >'.$cikyaz['baslik'].'</option>'; 
					}
			
			?>			
					 
		 </select>
 				
		</div>
		
			
		
		
	</div>
			
 
	
 <hr> 
 
 <h3 class="text-danger">Tur Programı</h3>
 
  <script type="text/javascript"> 
	$(function(){
	 

	 $("#yenigunekle").on("click",function(){
			  
  $("#tbaslikk").after(' <div id="tbaslikk"> <div class="form-group row"> <label for="turbaslik" class="col-sm-2 col-form-label"> Program Başlık </label> <div class="col-sm-10"> <input type="text" name="turbaslik[]" class="form-control" id="turbaslik" placeholder="Tur Başlık" value="" required > </div> </div> <div class="form-group row"> <label for="turaciklama" class="col-sm-2 col-form-label"> Açıklama  </label> <div class="col-sm-10"> <textarea name="turaciklama[]" class="ckeditor" id="turaciklama"  rows="4" style="width:100%"></textarea> </div>  <button type="button" class="btn btn-raised ripple btn-raised-danger m-1" id="gunsil"> <i class="fa fa-plus"></i> Sil </button> </div> </div>  '); 
 
		});	
	
	$("#gunsil").click(function(){
		alert("sill");
	});
		
$('.datepicker').datepicker({
    format: 'mm/dd/yyyy',
    startDate: '-3d'
});

		
	});
	 
	</script>
	 		
	<div id="tbaslikk">
 <div class="form-group row">
		<label for="turbaslik" class="col-sm-2 col-form-label"> Program Başlık  </label>
		<div class="col-sm-10">
		  
	<input type="text" name="turbaslik[]" class="form-control" id="turbaslik" placeholder="Tur Başlık" value="<?php echo $baslik; ?>" required >
		
		</div>
	</div>
	
 
	<div class="form-group row">
		<label for="turaciklama" class="col-sm-2 col-form-label"> Açıklama  </label>
		<div class="col-sm-10">
		<textarea name="turaciklama[]" class="ckeditor" id="turaciklama" cols="40" rows="3"><?php echo $icerik; ?></textarea>
	  
		</div> 
	</div>
	 	 
	</div>
	 <button type="button" class="btn btn-raised ripple btn-raised-success m-1" id="yenigunekle"> <i class="fa fa-plus"></i> Yeni Gün Ekle </button>
	 
<hr> 


 <h3 class="text-danger">Dahil & Hariç Olanlar Bilgiler</h3>

 
 
	<div class="form-group row">
		<label for="dahilolanlar" class="col-sm-2 col-form-label"> Dahili Olanlar </label>
		<div class="col-sm-10">
		<textarea name="dahilolanlar" class="ckeditor" id="dahilolanlar" cols="40" rows="3"><?php echo $dahilolanlar; ?></textarea>
	 
   
		</div> 
	</div>
	
	
 
	<div class="form-group row">
		<label for="haricolanlar" class="col-sm-2 col-form-label"> Harici Olanlar </label>
		<div class="col-sm-10">
		<textarea name="haricolanlar" class="ckeditor" id="haricolanlar" cols="40" rows="3"><?php echo $haricolanlar; ?></textarea>
	 
   
		</div> 
	</div>
	
	
 
	<div class="form-group row">
		<label for="ekbilgi" class="col-sm-2 col-form-label"> Ek Bilgi </label>
		<div class="col-sm-10">
		<textarea name="ekbilgi" class="ckeditor" id="ekbilgi" cols="40" rows="3"><?php echo $ekbilgi; ?></textarea>
	 
   
		</div> 
	</div>
	
 
	<div class="form-group row">
		<label for="bilmemizgerekenler" class="col-sm-2 col-form-label"> Bilmemiz Gerekenler </label>
		<div class="col-sm-10">
		<textarea name="bilmemizgerekenler" class="ckeditor" id="ekbilgi" cols="40" rows="3"><?php echo $bilmemizgerekenler; ?></textarea>
	 
   
		</div> 
	</div>
	
	<div class="form-group row">
		<label for="turaozel" class="col-sm-2 col-form-label"> Tura Özel </label>
		<div class="col-sm-10">
		<textarea name="turaozel" class="ckeditor" id="turaozel" cols="40" rows="3"><?php echo $turaozel; ?></textarea>
	 
   
		</div>

<small id="web" class="ul-form__text form-text "> Bu turu anlatan 150 - 200 karakter arasında kısa özet </small>
		
	</div>
	
	
	<hr>
	
	 <h3 class="text-danger">Detaylar</h3>
	 
 
 	<div class="form-group row">
		<label for="vizebilgisi" class="col-sm-2 col-form-label"> Vize Bilgisi</label>
		<div class="col-sm-10">
		<textarea name="vizebilgisi" class="ckeditor" id="vizebilgisi" cols="40" rows="3"><?php echo $vizebilgisi; ?></textarea>
	 
   
		</div>

 
		
	</div>
		 
 
 	<div class="form-group row">
		<label for="notlar" class="col-sm-2 col-form-label"> Notlar</label>
		<div class="col-sm-10">
		<textarea name="notlar" class="ckeditor" id="notlar" cols="40" rows="3"><?php echo $notlar; ?></textarea>
	 
   
		</div>
 
		
	</div>
		 
 
 	<div class="form-group row">
		<label for="ulasim" class="col-sm-2 col-form-label"> Ulaşım Bilgileri</label>
		<div class="col-sm-10">
		<textarea name="ulasim" class="ckeditor" id="ulasim" cols="40" rows="3"><?php echo $ulasim; ?></textarea>
	 
   
		</div>

<small id="web" class="ul-form__text form-text "> Uçak veya diğer ulaşım bilgileri </small>
		
	</div>
	
	<hr>
	
	 <h3 class="text-danger">Hareket Noktaları</h3>
	 
	 <div class="form-row">
	 
				<div class="col-md-4 mb-3">
					<label for="validationCustom01">Hareket Noktası </label>
					
		 
		 
					<select class="form-control" name="guzsec" >
					 <option value="">Hareket Noktası Seç </option>
			<?php 
				$gbakk  = $mysqli->query("select * from cikisnokta  order by sira asc ");
					while($guzyaz = $gbakk->fetch_array()){
						 
					
						echo '<option value='.$guzyaz['id'].' >'.$guzyaz['baslik'].' </option>'; 
					}
			
			?>			
					 
		 </select>
			  			
		 <br>
					<select class="form-control" name="guzsec" >
					  <option value="">Hareket Noktası Seç </option>
			<?php 
				$gbakk  = $mysqli->query("select * from cikisnokta  order by sira asc ");
					while($guzyaz = $gbakk->fetch_array()){
						 
					
						echo '<option value='.$guzyaz['id'].' >'.$guzyaz['baslik'].' </option>'; 
					}
			
			?>			
					 
		 </select>
			  			
		  <br>
					<select class="form-control" name="guzsec" >
					  <option value="">Hareket Noktası Seç </option>
			<?php 
				$gbakk  = $mysqli->query("select * from cikisnokta  order by sira asc ");
					while($guzyaz = $gbakk->fetch_array()){
						 
					
						echo '<option value='.$guzyaz['id'].' >'.$guzyaz['baslik'].' </option>'; 
					}
			
			?>			
					 
		 </select>
			  			
		  <br>
	
	<select class="form-control" name="guzsec" >
				 <option value="">Hareket Noktası Seç </option>	 
			<?php 
				$gbakk  = $mysqli->query("select * from cikisnokta  order by sira asc ");
					while($guzyaz = $gbakk->fetch_array()){
						 
					
						echo '<option value='.$guzyaz['id'].' >'.$guzyaz['baslik'].' </option>'; 
					}
			
			?>			
					 
		 </select>
			  			
		  <br>
	 
	 <select class="form-control" name="guzsec" >
				 <option value="">Hareket Noktası Seç </option>	 
			<?php  $gbakk  = $mysqli->query("select * from cikisnokta  order by sira asc ");
					while($guzyaz = $gbakk->fetch_array()){
						 
					
						echo '<option value='.$guzyaz['id'].' >'.$guzyaz['baslik'].' </option>'; 
					}
			
			?>			
					 
		 </select>
			  			
		  <br>
	
	<select class="form-control" name="guzsec" >
				 <option value="">Hareket Noktası Seç </option>	 
			<?php 
				$gbakk  = $mysqli->query("select * from cikisnokta  order by sira asc ");
					while($guzyaz = $gbakk->fetch_array()){
						 
					
						echo '<option value='.$guzyaz['id'].' >'.$guzyaz['baslik'].' </option>'; 
					}
			
			?>			
					 
		 </select>
			  						
	  <br>
		 
					 
				</div>
			<div class="col-md-2 mb-3">
					<label for="validationCustom02">Saat </label>
					
		<input type="text" class="form-control" id="validationCustom02" placeholder="14:00" value="14:00"  >
		 <br>
		 			
		<input type="text" class="form-control" id="validationCustom02" placeholder="14:00" value="14:00"  >
		 <br>
		 			
		<input type="text" class="form-control" id="validationCustom02" placeholder="14:00" value="14:00"  >
		 <br>
		 			
		<input type="text" class="form-control" id="validationCustom02" placeholder="14:00" value="14:00"  >
		 <br>
		 			
		<input type="text" class="form-control" id="validationCustom02" placeholder="14:00" value="14:00"  >
		 <br>
		 			
		<input type="text" class="form-control" id="validationCustom02" placeholder="14:00" value="14:00"  >
		 <br>
		 
					 
				</div>
				 
			</div>
								
	<hr/>
	
	 <h3 class="text-danger">Ekstralar</h3>
	 
	 
	 <div class="form-row">
	 
		<div class="col-md-6 mb-3">
		 
		 <label for="validationCustom02">Özellik </label>
			
		<input type="text" class="form-control" id="validationCustom02" placeholder="Özellik" value=""  >
		 <br>
		 <input type="text" class="form-control" id="validationCustom02" placeholder="Özellik" value=""  >
		 <br>
		 <input type="text" class="form-control" id="validationCustom02" placeholder="Özellik" value=""  >
		 <br>
		 <input type="text" class="form-control" id="validationCustom02" placeholder="Özellik" value=""  >
		 <br>
		 <input type="text" class="form-control" id="validationCustom02" placeholder="Özellik" value=""  >
		 <br>
		 <input type="text" class="form-control" id="validationCustom02" placeholder="Özellik" value=""  >
		 
	 
 
					 
		 </div>
				
			<div class="col-md-2 mb-3">
					<label for="validationCustom02">Fiyat </label>
					
		<input type="text" class="form-control" id="validationCustom02" placeholder="Fiyat" value=""  >
		 <br>
		 			
		<input type="text" class="form-control" id="validationCustom02" placeholder="Fiyat" value=""  >
		 <br>
		 			
		<input type="text" class="form-control" id="validationCustom02" placeholder="Fiyat" value=""  >
		 <br>
		 			
		<input type="text" class="form-control" id="validationCustom02" placeholder="Fiyat" value=""  >
		 <br>
		 			
		<input type="text" class="form-control" id="validationCustom02" placeholder="Fiyat" value=""  >
		 <br>
		 			
		<input type="text" class="form-control" id="validationCustom02" placeholder="Fiyat" value=""  >
		  
					 
	 </div>
	 
	 </div>
				
	
<hr/>
	
	 <h3 class="text-danger">Resim</h3>
 
	 
 <div class="form-group row">
		<label for="resim" class="col-sm-2 col-form-label">Ana Resim * </label>
		<div class="col-sm-2">
		  <input type="file" name="resim" class="form-control" id="resim" placeholder="Ana Resim Boyutu"   > 
			 				
		</div>
	 
	</div>
	
	 
 <div class="form-group row">
	<label for="resim" class="col-sm-2 col-form-label">Diğer Resimler </label>
	<div class="col-sm-2">
	  <input type="file" name="rtoplu[]" multiple="multiple" class="form-control" id="resim" placeholder="Resimler"   > 
						
	</div>
	 <small id="web" class="ul-form__text form-text "> Birden fazla resim seçebilirsiniz </small>
 </div>
	
	
	<hr>
	 <h3 class="text-danger">Veri</h3>
		
	 <div class="form-group row">
		<label for="metabaslik" class="col-sm-2 col-form-label">Meta Başlık </label>
		<div class="col-sm-10">
		  <input type="text" name="metabaslik" class="form-control" id="metabaslik" placeholder="metabaslik" value="<?php echo $metabaslik; ?>" > 
			
 							
		</div>
		 
	</div>
	
	
	<div class="form-group row">
		<label for="metaaciklama" class="col-sm-2 col-form-label"> Meta Açıklaması </label>
		<div class="col-sm-10">
		<textarea name="metaaciklama"  id="metaaciklama" cols="40" rows="3"><?php echo $metaaciklama; ?></textarea>
	 
   
		</div>
  
	</div>
	
	
		
	<div class="form-group row">
		<label for="seourl" class="col-sm-2 col-form-label">Seo URL * </label>
		<div class="col-sm-6">
		  <input type="text" name="seourl" class="form-control" id="seourl" placeholder="Seo URL" value="<?php echo $seourl; ?>"  > 
			
 							
		</div>
		 
	</div>
		
		 
		
		<div class="form-group row">
		<label for="gecerlilik" class="col-sm-2 col-form-label">Geçerlilik Tarihi </label>
		<div class="col-sm-2">
	  <input type="text" name="gecerlilik" class="form-control" id="gecerlilik" placeholder="YYYY-MM-DD" value="<?php echo $gecerlilik; ?>" > 
	  				
		</div>
		 
	</div>	 
		
		<div class="form-group row">
		<label for="video" class="col-sm-2 col-form-label">Video/Çalma Listesi Bağlantısı </label>
		<div class="col-sm-10">
		  <input type="text" name="video" class="form-control" id="video" placeholder="Video Linki" value="<?php echo $video; ?>" > 
			
 							
		</div>
		 
	</div>	
	
	
		<div class="form-group row">
		<label for="keywords" class="col-sm-2 col-form-label">Yurt İçi / Yurt Dışı </label>
		<div class="col-sm-10">
		  
			 
		 <select class="form-control" name="katsec" multiple >
					 
			 <option value="Yurt İçi" >Yurt İçi  </option> 
			 <option value="Yurt Dışı" >Yurt Dışı  </option> 
					 
		 </select>
		 
		 
 							
		</div>
		 
	</div>
	
	<div class="form-group row">
		<label for="keywords" class="col-sm-2 col-form-label"> Vize İşlemleri </label>
		<div class="col-sm-10">
		  
			 
		 <select class="form-control" name="katsec" multiple >
					 
			 <option value="Yurt İçi" > Vize Var  </option> 
			 <option value="Yurt Dışı" >Yurt Dışı  </option> 
					 
		 </select>
		 
		 
 							
		</div>
		 
	</div>
				
	<div class="form-group row">
	<label for="description" class="col-sm-2 col-form-label">Description </label>
	<div class="col-sm-10">
	  <input type="text" name="description" class="form-control" id="description" placeholder="Description" value="<?php echo $description; ?>" > 
		
						
		</div>
		 
	</div>
					
	<div class="form-group row">
	<label for="sira" class="col-sm-2 col-form-label">Sıra </label>
	<div class="col-sm-2">
	  <input type="text" name="sira" class="form-control" id="sira" placeholder="Sıra" value="<?php echo $sira; ?>" > 
		
						
		</div>
		 
	</div>
		
		<div class="form-group row">
	<label for="durum" class="col-sm-2 col-form-label">Durum </label>
	<div class="col-sm-2">
	 
	<label class="switch switch-primary mr-3" id="durum">
		 
		  <input name="durum" type="checkbox" checked=""> 
		  
		<span class="slider"></span>
	</label>
							
							
	 	
		</div>
		 
	</div>
	
	
  
	<div class="form-group row">
	<label for="sira" class="col-sm-2 col-form-label">  </label>
		<div class="col-sm-10">
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
				