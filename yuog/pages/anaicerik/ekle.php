	<?php 
	 
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
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
	
	$id		= $_GET['id'];
	$yaz 	= $mysqli->query("select * from anasayfa where id='$id' ")->fetch_array();	
	 
	?>
	 
	<div class="main-content">
	
   <div class="breadcrumb">
                <h1>   Ana Sayfa İçerikler > <a href="?sy=anaicerik&id=<?php echo $id; ?>"><?php echo $yaz['baslik']; ?> </a>> <?php echo $dilyaz['baslik']; ?>  </h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li> İçerik Ekleme </li>
                      
                </ul>
            </div>
		 
            <div class="separator-breadcrumb border-top"></div>
  
	
	 <?php $islem = @$_GET['islem']; 
			if($islem=="basarili"){
				
	 echo '<div class="alert alert-card alert-success" role="alert">
			<strong class="text-capitalize">Başarılı !</strong> İşleminiz başarıyla gerçekleştirilmiştir.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div> ';
			}
			 
			?>
		
	<div class="row">
		<div class="col-md-12">
			<div class="card mb-5">
				<div class="card-body">
		  
	<?php 
if($_POST){ 
	 
	 // var_dump($_POST);
	$sira				= (int)trim($_POST['sira']); 
	$durum				= "on";
	$ekleyen			= $email;  
	$ip					= $_SERVER['REMOTE_ADDR']; 
	$rhedef				= "../uploads/";
	
	$icekle 			= $mysqli->query("insert into anasayfasay (katID,durum,sira,dil,ip,ekleyen,otarih) values ('$id', '$durum', '$sira', '$dil', '$ip', '$ekleyen', now() ) ");
	
	$icerikID 	= $mysqli->insert_id;  
	
	$sbak 	= $mysqli->query("select * from anasayfasistem where katID='$id' ");
		while($syaz = $sbak->fetch_array()){
			
			$stip 	= $syaz['tip'];
			$sid 	= $syaz['id'];
			$ssira 	= $syaz['sira']; 
			 
			if($stip=="resim"){
					
			$resimad			= $_FILES['resim']['name'][$sid];
			$kaynak				= $_FILES['resim']['tmp_name'][$sid];
			$resimsonad			= rand(0,999).'-'.yeniurl(res_adi($resimad)).res_uzanti($resimad);  
				  $gonder  	= $mysqli->query(" insert into anasayfaicerik set 
			 
					katID 				='$id', 
					icerikID 			='$icerikID', 
					sid 				='$sid', 
					tip 				='$stip', 
					yazi 				='', 
					resim 				='$resimsonad', 
					ip					='$ip', 
					tarih				= now(),
					ekleyen				= '$ekleyen',
					sira				= '$ssira',
					dil					= '$dil', 
					durum				= '$durum' 
				 
				  ");    
				$yukle 			= move_uploaded_file($kaynak,$rhedef."/".$resimsonad);
		
			} else {
				$yazi	= $_POST['yazi'][$sid]; 
				  $gonder  	= $mysqli->query(" insert into anasayfaicerik set 
			 
					katID 				='$id', 
					icerikID 			='$icerikID',
					sid 				='$sid', 
					tip 				='$stip', 
					yazi 				='$yazi', 
					resim 				='', 
					ip					='$ip', 
					tarih				= now(),
					ekleyen				= '$ekleyen',
					sira				= '$ssira',
					dil					= '$dil', 
					durum				= '$durum' 
				 
				  ");   
			} 
		}	
 
	header("Location:?sy=anaicerik&id=".$id."&islem=basarili"); 
	  
	} else { 
	?>	
 
	<form action="" method="post" enctype="multipart/form-data" >
	 
<div class="form-group row">
		<label for="baslik" class="col-sm-2 col-form-label">İçerik Dili * </label>
		<div class="col-sm-6">
		
		<?php $dilbak1 = $mysqli->query("select * from diller order by sira asc "); 
		while($dilyaz1 = $dilbak1->fetch_array()){
		  
	echo '<a href="?sy=anaicerikekle&id='.$id.'&dil='.$dilyaz1['id'].'"><button type="button" class="btn btn-raised btn-raised-primary m-1">'.$dilyaz1['baslik'].'</button></a> ';
	
			 
		}				
						?>
			 
		</div>
	</div>	


<?php 
		
		$bakk = $mysqli->query("select * from anasayfasistem where katID='$id' order by sira asc ");
			while($yazz = $bakk->fetch_array()){
				
				echo '<div class="form-group row">
		<label for="'.$yazz['id'].'" class="col-sm-2 col-form-label"> '.$yazz['baslik1'].'  </label>
		<div class="col-sm-10">'; 
		 
?>

	<?php 
		echo ' <input type="hidden" name="tip['.$yazz['id'].']" value="'.$yazz['tip'].'">';
		if($yazz['tip']=="baslik"){ 
		echo '<input type="text" name="yazi['.$yazz['id'].']" class="form-control" id="'.$yazz['id'].'" placeholder="" value=" " size="'.$yazz['boyut'].'" >'; 
		} elseif ($yazz['tip']=="onyazi"){ 
		echo '  <textarea name="yazi['.$yazz['id'].']" class="form-control" id="'.$yazz['id'].'" cols="50" rows="2" placeholder=" " ></textarea> ';
		} elseif($yazz['tip']=="icerik"){ 
			echo '<textarea name="yazi['.$yazz['id'].']" class="ckeditor" id="'.$yazz['id'].'" cols="40" rows="3"> </textarea> ';
		} else {
			echo '<input type="file" name="resim['.$yazz['id'].']" class="form-control" id="'.$yazz['id'].'" placeholder=""    > '; 
		}
	
	?>
	
  

</div>
	</div>
			<?php } ?>
	
	
	 		
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
				