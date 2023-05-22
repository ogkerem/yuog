<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
	
	?>
	<div class="main-content">
	
   <div class="breadcrumb">
                <h1>Program Genel Ayarları</h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li>Ayarlarımızı Burdan Yapıyoruz</li>
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
                   
                    <p> Lütfen eksiksiz doldurun. </p>
                    <div class="card mb-5">
                        <div class="card-body">
						
						<?php 
if($_POST){ 
	
 
	$siparisdurum		= @$_POST['siparisdurum'];
	$parabirimi			= @$_POST['parabirimi'];
	$acilis		= @$_POST['acilis'];
	$kapanis		= @$_POST['kapanis'];
	
	
	$guncelle = $mysqli->query("update ayarlar set  siparisdurum='$siparisdurum' , parabirimi='$parabirimi' where id='1' ");
	 
			
	if($guncelle){ 
		
		 header("Location:?sy=sayar&islem=basarili");
	} else { echo '<div class="alert alert-danger" role="alert">
					<strong class="text-capitalize">Hata!</strong>Hata İçerik  Güncellenemedi
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				
				 '; }   

} else { 
?>	



	<form action="" method="post" enctype="multipart/form-data" >
							
 
	 
	 
    <div class="form-group row">
		<label for="baslik" class="col-sm-2 col-form-label"> Sipariş Tamamlandı </label>
		
	 
    <div class="col-2">
    
	  <select class="custom-select task-manager-list-select" name="siparisdurum">
	  
	  <?php $dilbak = $mysqli->query("select * from siparisdurum order by sira asc ");
	 
			while($dilyaz = $dilbak->fetch_array()){
				if($dilyaz['id']==genel('siparisdurum')){
				echo '<option value="'.$dilyaz['id'].'" selected>'.$dilyaz['baslik'].'</option>';
				} else {
				echo '<option value="'.$dilyaz['id'].'">'.$dilyaz['baslik'].'</option>';
				}
			}

?>  
	 </select>
	 
	 
    </div>


     
 </div>
	 
	
	 
	 
    <div class="form-group row">
		<label for="parabirimi" class="col-sm-2 col-form-label"> Para Birimi </label>
		
	 
    <div class="col-2">
    
	  <select class="custom-select task-manager-list-select" name="parabirimi">
	  
	  <?php $dilbak = $mysqli->query("select * from parabirimi order by sira asc ");
	 
			while($dilyaz = $dilbak->fetch_array()){
				if($dilyaz['id']==genel('parabirimi')){
				echo '<option value="'.$dilyaz['id'].'" selected>'.$dilyaz['baslik'].'</option>';
				} else {
				echo '<option value="'.$dilyaz['id'].'">'.$dilyaz['baslik'].'</option>';
				}
			}

?>  
	 </select>
	 
	 
    </div> <div class="text-danger"> Uyarı : Sistemin ana para birimini komple değiştireceksiniz. Ve bayilerin gördüğü fiyata yansıyacaktır. </div>


     
 </div>
	 
	
 
	<div class="form-group row">
		<div class="col-sm-2">
			 
		 
		</div>
		
		<div class="col-sm-10">
			<button type="submit" class="btn btn-primary ul-btn__text">Güncelle</button>
		 
		</div>
	</div>
	
	</form>

	<?php } ?>
			</div>
		</div>
	</div>
	</div>
   <div class="border-top mb-5"></div>
   </div> 				