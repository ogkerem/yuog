	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
		$id 		= $_GET['id'];
		$dilID		= $id; 
		$dilbak1 	= $mysqli->query("select * from diller where id='$id'  ");
		$dilbak 	= $dilbak1->fetch_array();
	
	?>
	<div class="main-content">
	
   <div class="breadcrumb">
                <h1>Dil İçerikleri </h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li><a href="?sy=diller">Diller</a></li>
                    <li> <?php echo $dilbak['baslik']; ?> </li>
                   
                     
                </ul>
				
				<a href="?sy=dilsabit" target="_blank"><button type="button" class="btn btn-warning btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-asterisk"></i> </span>
		<span class="ul-btn__text">Dil Sabitleri</span>
	</button>
	</a>
	
            </div>
		 
            <div class="separator-breadcrumb border-top"></div>
  
	  

<div class="row">
                <div class="col-md-12">
                   
         <?php $islem = @$_GET['islem']; 
			if($islem=="basarili"){
				
	 echo '	<div class="alert alert-card alert-success" role="alert">
			<strong class="text-capitalize">Başarılı !</strong> İşleminiz başarıyla gerçekleştirilmiştir.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div> ';
			}
			
			?> </p>
                    <div class="card mb-5">
                        <div class="card-body">
						
			


		<div class="row">
                <div class="col-md-12">
                    <h4><?php echo $dilbak['baslik']; ?> İçerik Düzenleme</h4>
                 
                    <div class="card mb-5">
                        <div class="card-body">
						
						 <?php 
if($_POST){ 
	
	$dilicerik		=  $_POST['dilicerik'] ;
  
	$x=0;
	foreach($dilicerik as $yenicerik ){
		$idmiz			= $_POST['idmiz'];
		$id2 = $idmiz[$x];
		$yeniicerik = addslashes($yenicerik);
 $icerikbakk = $mysqli->query("select * from dilicerik where sabitID='$id2' && dilID='$dilID' ");
 $sayy 		= $icerikbakk->num_rows;  
 if($sayy>0){
 $guncelleme = $mysqli->query("update dilicerik set icerik='$yeniicerik' where sabitID='$id2' && dilID='$dilID' ");
 } else { 
 $yeniekleee = $mysqli->query("insert into  dilicerik  (dilID,sabitID,icerik) values ('$dilID', '$id2', '$yeniicerik') ");
 }

	$x++;
	}
		 
 header("Location:?sy=dilicerik&id=".$dilID."&islem=basarili");	 
		 
}  else { 
?> 



       <form action="" method="post" enctype="multipart/form-data" >	
					   
			<div class="form-group row">
				<label for="inputEmail3" class="col-sm-3 col-form-label">Sabitler </label>
				<div class="col-sm-6">
					<?php echo $dilbak['baslik']; ?> Dil Karşılığı 
				</div>
			</div>
                            
		<?php 
		$dilicerikbak 		= $mysqli->query("select * from dilsabit order by sira asc ");
		while($dilicerikyaz = $dilicerikbak->fetch_array()){ 
		$sabitlerr = $dilicerikyaz['baslik'];  
		$icerikid = $dilicerikyaz['id'];
		$sabiticerikbul1 	= $mysqli->query("select * from dilicerik where dilID='$id' && sabitID='$icerikid'  ");
		$sabiticerikbul		= $sabiticerikbul1->fetch_array();
		
		echo '
		<div class="form-group row">
	<label for="'.$icerikid.'" class="col-sm-3 col-form-label">'.$sabitlerr.' : '.$dilicerikyaz['id'].'</label>
	<div class="col-sm-6">
		<input type="text" class="form-control" id="'.$icerikid.'" placeholder="" name="dilicerik[]"  value="'.@$sabiticerikbul['icerik'].'"  >
	</div>
</div>
 
		<input type="hidden" value="'.$icerikid.'" name="idmiz[]" /> 
		 ';
		} 		
		
		?>					
	   
			<div class="form-group row">
			<label for="inputEmail3" class="col-sm-3 col-form-label">   </label>
				<div class="col-sm-6">
					<button type="submit" class="btn btn-primary">Güncelle</button>
				</div>
			</div>
        </form>
		
		<?php } ?>
		
		
                        </div>
                    </div>
                </div>
            </div>
	 
 
		</div>
	</div>
</div>
</div>					
				</div> 
	 