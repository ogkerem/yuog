	<?php 
	 
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
  
	$id		= $_GET['id'];
	$yaz1 	= $mysqli->query("select * from anasayfasay where id='$id' ")->fetch_array();	
	$katID	= $yaz1['katID'];
	$yaz	= $mysqli->query("select * from anasayfaicerik where katID='$katID' && icerikID='$id'  ")->fetch_array();
	$anabak = $mysqli->query("select * from anasayfa where id='$katID' ")->fetch_array();
	$dil 	= $yaz['dil']; 
	$dilyaz = $mysqli->query("select * from diller where id='$dil' ")->fetch_array();
	 
	?>
	 
	<div class="main-content">
	
   <div class="breadcrumb">
                <h1>   Ana Sayfa İçerikler > <a href="?sy=anaicerik&id=<?php echo $katID; ?>"><?php echo $anabak['baslik']; ?> </a>> <?php echo $dilyaz['baslik']; ?>  </h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li> İçerik Düzenleme </li>
                      
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
	$durum				= $_POST['durum'];
	$ekleyen			= $email;  
	$ip					= $_SERVER['REMOTE_ADDR']; 
	$rhedef				= "../uploads/";
	 
	$duzenle 		= $mysqli->query("update anasayfasay set durum='$durum', sira='$sira', dil='$dil'  where id='$id' ");
	 
 
	$sbak 	= $mysqli->query("select * from anasayfasistem where katID='$katID' ");
		while($syaz = $sbak->fetch_array()){
			
			$stip 	= $syaz['tip'];
			$sid 	= $syaz['id'];
			
			if($stip=="resim"){ 
			$resimad			= $_FILES['resim']['name'][$sid]; 
		
		if($resimad){ 
			$kaynak				= $_FILES['resim']['tmp_name'][$sid];
			$resimsonad			= rand(0,999).'-'.yeniurl(res_adi($resimad)).res_uzanti($resimad); 
			$duzenle 		= $mysqli->query("update anasayfaicerik set resim='$resimsonad' where katID='$katID' && icerikID='$id' && sid='$sid' "); 
			$yukle 			= move_uploaded_file($kaynak,$rhedef."/".$resimsonad); 
		}
				 
		
		} else {
			
			
			$yazi	= $_POST['yazi'][$sid];
			 
			 $duzenle 		= $mysqli->query("update anasayfaicerik set yazi='$yazi' where katID='$katID' && icerikID='$id' && sid='$sid' ");  
		}
			 
	}	
 
   
	  header("Location:?sy=anaicerik&id=".$katID."&islem=basarili"); 
	  
	} else { 
	?>	
 
	<form action="" method="post" enctype="multipart/form-data" >
	 
	 
	<div class="form-group row">
		<label for="dil" class="col-sm-2 col-form-label"> <i class="fa fa-language"></i> Dil </label>
		 
    <div class="col-2">
    
	  <select class="custom-select task-manager-list-select" id="dil" name="dil">
	  
	  <?php $dilbak = $mysqli->query("select * from diller order by sira asc ");
	 
			while($dilyaz = $dilbak->fetch_array()){
				if($dilyaz['id']==$dil){
				echo '<option value="'.$dilyaz['id'].'" selected>'.$dilyaz['baslik'].'</option>';
				} else {
				echo '<option value="'.$dilyaz['id'].'">'.$dilyaz['baslik'].'</option>';
				}
			}

?>  
	 </select>
	 
	 
    </div>
     
 </div>
  
<?php 
		
		$bakk = $mysqli->query("select * from anasayfasistem where katID='$katID' order by sira asc ");
			while($yazz = $bakk->fetch_array()){
				
				echo '<div class="form-group row">
		<label for="'.$yazz['id'].'" class="col-sm-2 col-form-label"> '.$yazz['baslik1'].'  </label>
		<div class="col-sm-10">'; 
		 
?>

	<?php 
		echo ' <input type="hidden" name="tip['.$yazz['id'].']" value="'.$yazz['tip'].'">';
		if($yazz['tip']=="baslik"){ 
		$sid 	= $yazz['id'];
		$icyaz 	= $mysqli->query("select * from anasayfaicerik where katID='$katID' && icerikID='$id' && sid='$sid' ")->fetch_array();
		echo '<input type="text" name="yazi['.$yazz['id'].']" class="form-control" id="'.$yazz['id'].'" placeholder="" value="'.$icyaz['yazi'].'" size="'.$yazz['boyut'].'" >'; 
		
		} elseif ($yazz['tip']=="onyazi"){ 
		
		$sid 	= $yazz['id'];
		$icyaz 	= $mysqli->query("select * from anasayfaicerik where katID='$katID' && icerikID='$id' && sid='$sid' ")->fetch_array();
		echo '  <textarea name="yazi['.$yazz['id'].']" class="form-control" id="'.$yazz['id'].'" cols="50" rows="2" placeholder=" " >'.$icyaz['yazi'].'</textarea> ';
		} elseif($yazz['tip']=="icerik"){ 
			
		$sid 	= $yazz['id'];
		$icyaz 	= $mysqli->query("select * from anasayfaicerik where katID='$katID' && icerikID='$id' && sid='$sid' ")->fetch_array();
		echo '<textarea name="yazi['.$yazz['id'].']" class="ckeditor" id="'.$yazz['id'].'" cols="40" rows="3">'.$icyaz['yazi'].'</textarea> ';
		} else {
			
			$sid 	= $yazz['id'];
			$icyaz 	= $mysqli->query("select * from anasayfaicerik where katID='$katID' && icerikID='$id' && sid='$sid' ")->fetch_array();
			
			echo '
		 <div class="col-sm-3" style=" float:left;  ">
		  <input type="file" name="resim['.$yazz['id'].']" class="form-control" id="'.$yazz['id'].'" placeholder=""   >
			 	<small id="ustresim" class="ul-form__text form-text "> Yeni resim istemiyorsanız işlem yapmayınız </small>	
  
		</div>
	 <div class="col-sm-3" style=" float:left;  ">
		 <a href="../uploads/'.$icyaz['resim'].'" target="_blank;" >
		 <img src="../uploads/'.$icyaz['resim'].'" title="Büyük Resim" alt="Büyük Resim" style="background-color:#ddd; height:100px; "></a>
		</div>
			';  
				}
	
	?>
	
  

</div>
	</div>
			<?php } ?>
	
	
	 		
	<div class="form-group row">
	<label for="sira" class="col-sm-2 col-form-label">Sıra </label>
	<div class="col-sm-1">
	  <input type="text" name="sira" class="form-control" id="sira" placeholder="Sıra" value="<?php echo $yaz['sira']; ?>" > 
		
						
		</div>
		 
	</div>
	
		<div class="form-group row">
	<label for="durum" class="col-sm-2 col-form-label">Durum </label>
	<div class="col-sm-2">
	  
	<label class="switch switch-primary mr-3" id="durum">
		 
		  <input name="durum" type="checkbox" <?php if($yaz1['durum']=="on"){ echo 'checked'; }?>  > 
		  
		<span class="slider"></span>
	</label>
			 
		</div>
		
		</div>
   
	<div class="form-group row">
	<label for="sira" class="col-sm-2 col-form-label">  </label>
		<div class="col-sm-10">
			<button type="submit" class="btn btn-primary ul-btn__text">İçerik Düzenle</button>
		 
		</div>
	</div>
	
		</form>

			<?php } ?>
				</div>
			</div>
		</div>
	</div>            
</div> 
				