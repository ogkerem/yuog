	<?php 
	 
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
	$sistem 	= $_GET['sistem']; 
	$konu 		= "kategori";  
	$sistemyaz 	= $mysqli->query("select * from sistem where id='$sistem' ")->fetch_array();
	 
	
	$dilbak = @$_GET['dil'];
	if($dilbak==""){ 
	$dilbak = $mysqli->query("select * from diller order by sira asc limit 1 "); 
	$dilyaz = $dilbak->fetch_array();
		$dil = $dilyaz['id'];
	} else {
		$dil = $dilbak;	
		$dilbak = $mysqli->query("select * from diller where id='$dil' "); 
		$dilyaz = $dilbak->fetch_array();
	} 
	
 
	 
	?>
	<div class="main-content">
	
   <div class="breadcrumb">
   
   <h1> <a href="?sy=sahap&sistem=<?php echo $sistem; ?>"> <?php echo $sistemyaz['menu']; ?> </a> > <a href="?sy=kategori&sistem=<?php echo $sistem; ?>">Kategoriler</a>  > <?php echo $dilyaz['baslik']; ?> </h1> 
    
	<ul>
		<li><a href="index.php">Ana Sayfa</a></li> 
		<li> Kategori Ekleme </li> 
	</ul>
	</div>
		 
   <div class="separator-breadcrumb border-top"></div> 
   
	 <?php $islem = @$_GET['islem']; 
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
	     
 
	$ustkatID			=  (int)$_POST['ustkatID'];
	$katID				=  (int)$_POST['katID']; 
	 
	$baslik				= addslashes(trim($_POST['baslik']));
	$onyazi				= addslashes(trim($_POST['onyazi']));
 
	$icerik				= addslashes(trim($_POST['icerik']));
 
	$keywords			= addslashes(trim($_POST['keywords']));
	$description		= addslashes(trim($_POST['description']));
	$etiket				= addslashes(trim($_POST['etiket']));
	  
	$sira				= (int)trim($_POST['sira']); 
	$hit				= 1;
	
	$ekleyen			= $email;  
	$ip					= $_SERVER['REMOTE_ADDR']; 
	 
	$iconad				= $_FILES['icon']['name'];
	$iconkaynak			= $_FILES['icon']['tmp_name'];
	$iconsay			= count($iconad);
	
	
	$resimad			= $_FILES['resim']['name']; 
	$kaynak				= $_FILES['resim']['tmp_name']; 
	
	$ustresimad			= $_FILES['ustresim']['name']; 
	$ustkaynak			= $_FILES['ustresim']['tmp_name']; 
	
	$durum				= "on";
	
	$resimsonad 		= rand(0,999).'-'.yeniurl(res_adi($resimad)).res_uzanti($resimad);
	$ustsonad 			= rand(0,999).'-'.yeniurl(res_adi($ustresimad)).res_uzanti($ustresimad);	 
	$iconsonad 			= rand(0,999).'-'.yeniurl(res_adi($iconad)).res_uzanti($iconad);
	$kresimsonad 		= 'mini-'.$resimsonad;	
	  
	$rhedef				= "../uploads/";
	 
	$yeniurlmiz =  $_POST['seourl'];
	
	$seosor		= $mysqli->query("select * from seo where seo='$yeniurlmiz' ");
	$seoyazz	= $seosor->fetch_array(); 
	$seosay 	= $seosor->num_rows;
		  
	if($seosay>0){
		$sonurl = rand(0,100).'-'.$yeniurlmiz;
	} else { 
		$sonurl = $yeniurlmiz;
	}
	
	$seoekle 		= $mysqli->query("insert into seo (seo,konu, durum) values ('$sonurl', '$konu', '$durum')");	
	$seoID			= $mysqli->insert_id;
	 
  
	$gonder  	= $mysqli->query(" insert into $konu set 
	
		 
		menu 				='$sistem', 	 
		katID 				='$katID', 	 
		ustkatID			='$ustkatID', 
		baslik 				='$baslik', 
		onyazi 				='$onyazi', 
		 
		icerik 				='$icerik', 
	  
		keywords 			='$keywords', 
		description			='$description', 
		kresim				='$kresimsonad', 
		resim				='$resimsonad', 		
		ustresim			= '$ustsonad',	
		  
		 
		ip					='$ip', 
		tarih				= now(),
		ekleyen				= '$ekleyen',
		seo					= '$seoID',
		hit					= '$hit',
		sira				= '$sira',
		dil					= '$dil',
		 	
		durum				= 'on' 
	 
	  ");   
	  
	 
		
	if($gonder){
		
		$icerikID	= $mysqli->insert_id;
		
		$yukle 			= move_uploaded_file($kaynak,$rhedef."/".$resimsonad);
		$yukle2 		= move_uploaded_file($ustkaynak,$rhedef."/".$ustsonad);
 
		$yukle5			= move_uploaded_file($iconkaynak,$rhedef."/".$iconsonad);
		kucult($rhedef, $resimsonad);	
		  	
		  
		
		$ebakp = explode(",", $etiket);  
		$esay =  count($ebakp);
				
		  	for($yy=0; $yy < $esay; $yy++){
			$etiket1  = $ebakp[$yy];
		$etiketekle = $mysqli->query ("insert into etiket (`baslik`, `seo`, `konu`, `konuID` ) values ('$etiket1' , '$seoID' , '$konu' , '$icerikID' ) ");
				
				}	
	  
	
	 header("Location:?sy=".$konu."&sistem=".$sistem."&islem=basarili");	
		  
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
		<label for="baslik" class="col-sm-2 col-form-label"><i class="fa fa-language"></i> İçerik Dili * </label>
		<div class="col-sm-6">
		 
						
						
	 <?php $dilbak1 = $mysqli->query("select * from diller order by sira asc "); 
		while($dilyaz1 = $dilbak1->fetch_array()){
			if($dilyaz1['id']==$dil){
			
	echo '<a href="?sy='.$konu.'ekle&sistem='.$sistem.'&dil='.$dilyaz1['id'].'"><button type="button" class="btn btn-raised btn-raised-primary m-1">'.$dilyaz1['baslik'].'</button></a> ';
	
			} else {
			
	echo '<a href="?sy='.$konu.'ekle&sistem='.$sistem.'&dil='.$dilyaz1['id'].'"><button type="button" class="btn btn-outline-primary m-1">'.$dilyaz1['baslik'].'</button></a> ';
	
			}
		
		}				
	 ?>
						
						
			 
		</div>
	</div>	

<div class="form-group row">
		<label for="baslik" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Başlık * </label>
		<div class="col-sm-6">
		 <input type="text" name="baslik" class="form-control" id="baslik" placeholder="Başlık" value="" required >
		</div>
	</div>
	
	 
	<script type="text/javascript">  
		$(function(){
			$("select[name=ustkatID]").change(function(){
				 
				var ustkatID 	= $("select[name=ustkatID]").val();
				var sistem		= $("input[name=sistem]").val();
				  
				$.ajax({
					url: "pages/kategori/ukatbak.php",
					type: "POST",
					data: {"ustkatID":ustkatID, "sistem":sistem },
					success: function(ortakat) { 
						$("#altkat").html(ortakat);
					} 
				}); 
			}); 
			 
		});
		</script> 		

		<?php if($sistemyaz['kat2']=="on"){ ?>	
		
	 	  <div class="form-group row">
		<label for="ustkatID" class="col-sm-2 col-form-label">Üst Kategori  </label>
		<div class="col-sm-2">
		 <input type="hidden" name="sistem" value="<?php echo $sistem; ?>" >
		  <label for="ustkatID"  > </label>
					<select class="custom-select task-manager-list-select" name="ustkatID" >
						<option value="" >Üst Kategori Yok</option>
			<?php 
				$ukat  = $mysqli->query("select * from $konu where ustkatID='0' && dil='$dil' && menu='$sistem' order by sira asc ");
					while($uyaz = $ukat->fetch_array()){ 
						echo '<option value='.$uyaz['id'].' >'.$uyaz['baslik'].'</option>'; 
					}
			
			?>			
					 
		 </select>
			<small id="resim" class="ul-form__text form-text "> Ana kategori ise seçmeyin </small> 
		</div>		
		
		<?php if($sistemyaz['kat3']=="on"){ ?>
 	 <div class="col-sm-2">
		 
		  <label for="katID"  > </label> 
		 <select name="katID" class="custom-select task-manager-list-select" id="altkat"></select> 
			<small id="resim" class="ul-form__text form-text "> Orta Kategorisi yoksa seçmeyiniz </small> 
		</div>  
		<?php } ?>
		 
	</div>  
	 <?php } ?>
		
  
		 <div class="form-group row">
		<label for="resim" class="col-sm-2 col-form-label"> <i class="nav-icon fa fa-image"></i> Üst Resim ( 1920 * 450) </label>
		<div class="col-sm-2"> 
		 <input type="file" name="ustresim" class="form-control" id="resim" placeholder=""    > 
		  			
		</div>	
		
	 
	 
	</div> 
		
	 
	 
	 	
 <div class="form-group row">
	<label for="icon" class="col-sm-2 col-form-label"> <i class="nav-icon fa fa-image"></i>  İcon   </label>
	<div class="col-sm-2">
	  
		<input type="file" multiple="multiple" name="icon[]" class="form-control" id="rtoplu" placeholder=""  >
			<small id="passwordHelpBlock" class="ul-form__text form-text "> Toplu Resim Seçebilirsiniz </small>			
	</div>	
	</div>	
  	  
  <div class="form-group row">
		<label for="onyazi" class="col-sm-2 col-form-label"> Ön Yazı </label>
		<div class="col-sm-10">
		<textarea name="onyazi" class="form-control" id="onyazi" cols="50" rows="2" placeholder="Ön Yazı" ></textarea>
			 
		</div>
	</div>   
 	 
 
 

	<div class="form-group row">
		<label for="icerik" class="col-sm-2 col-form-label"> Açıklama  </label>
		<div class="col-sm-10">
		<textarea name="icerik" class="ckeditor" id="icerik" cols="40" rows="3"></textarea>
	  
		</div> 
	</div>
	 
 

	 
	
	 
		
		 <div class="form-group row">
		<label for="resim" class="col-sm-2 col-form-label"><i class="nav-icon fa fa-image"></i> Ana Resim ( 700 * 550) </label>
		<div class="col-sm-2">
		  <input type="file" name="resim" class="form-control" id="resim" placeholder="Küçük Resim Boyutu"  > 
			 				
		</div>	
		
		<div class="col-sm-2">
		  
			 				
		</div>
	 
	</div>
  <hr/>
		<div class="form-group row">
		<label for="seourl" class="col-sm-2 col-form-label">Seo URL * </label>
		<div class="col-sm-6">
		  <input type="text" name="seourl" class="form-control" id="seourl" placeholder="Seo URL" value=""  > 
			
 							
		</div>
		 
	</div>
		
		
	<div class="form-group row">
		<label for="keywords" class="col-sm-2 col-form-label">Keywords </label>
		<div class="col-sm-6">
		  <input type="text" name="keywords" class="form-control" id="keywords" placeholder="Keywords" value="" > 			 				
		</div>
		 
	</div>
				
	<div class="form-group row">
	<label for="description" class="col-sm-2 col-form-label">Description </label>
	<div class="col-sm-6">
	  <input type="text" name="description" class="form-control" id="description" placeholder="Description" value="" >  
		</div>
		 
	</div>
 
				
	<div class="form-group row">
	<label for="etiket" class="col-sm-2 col-form-label">Etiketler </label>
	<div class="col-sm-6">
	  <input type="text" name="etiket" class="form-control" id="etiket" placeholder="Etiketler" value="" > 
		 				
		</div>
		
		<div class="col-sm-2"> 
		<small id="passwordHelpBlock" class="ul-form__text form-text "> Virgül ile ayırınız </small>				
		</div>
		 
	</div>
	
					
	<div class="form-group row">
	<label for="sira" class="col-sm-2 col-form-label">Sıra </label>
	<div class="col-sm-1">
	  <input type="text" name="sira" class="form-control" id="sira" placeholder="Sıra" value="" > 
		
						
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