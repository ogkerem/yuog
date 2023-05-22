	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
	$id 		= $_GET['id'];
	$katbul 	= $mysqli->query("select * from turkat where id='$id' ");
	$katyaz 	= $katbul->fetch_array();
	
	?>
	
	
<div class="main-content">
                    
<div class="breadcrumb">
    <h1><?php echo $katyaz['baslik']; ?></h1>
    <ul>
        <li><a href="index.php">Ana Sayfa</a></li>
        <li><a href="?sy=turlar">Turlar</a></li>
        <li><a href="?sy=turkat">Kategoriler</a></li>
        
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
			
			
<section class="contact-list">
    <div class="row">
            <div class="col-md-12 mb-4">
                    <div class="card text-left">
<div class="card-header text-right bg-transparent">
	<!-- <button type="button" data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-primary btn-md m-1"><i class="i-Add-User text-white mr-2"></i> İçerik Ekle </button> -->
	
	<a href="?sy=turkatekle"><button type="button" class="btn btn-primary btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-plus" ></i> </span>
		<span class="ul-btn__text">İçerik Ekle</span>
	</button>
	</a>
										
</div>
                      
                       

                        <div class="card-body">
                            
                            <div class="table-responsive">
                                <table id="ul-contact-list" class="display table " style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Sıra</th>
                                            <th>ID</th>
											  <th>Başlık</th>
                                            <th>Üst Kat </th>  
                                          
                                           
                                            <th>Durum</th>
                                           
                                            <th>İşlemler</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
										
			
	 <?php  $bak = $mysqli->query("select * from turkat where ustkatID='$id' && katID='0' ");
				while($yaz = $bak->fetch_array()){
			
			if($yaz['durum']==1){
				$durum = '<a href="#" class="badge badge-success m-2 p-2">Aktif</a>'; 
			} else {
				$durum = '<a href="#" class="badge badge-danger m-2 p-2">Pasif</a>'; 
			}
			
			$katID 		= $yaz['katID'];
			$katbul		= $mysqli->query("select * from turkat where ustkatID='$katID' ");
			$ustkat 	= $katbul->fetch_array();
			
				echo '  <tr>
				<td>'.$yaz['sira'].'</td>
				<td>'.$yaz['id'].'</td>
				<td><a href="?sy=turaltkat&id='.$yaz['id'].'"><button type="button" class="btn btn-outline-primary m-1">'.$yaz['baslik'].'</button></a></td>
				<td>'.$ustkat['baslik'].'</td> 
			<!-- <td><a href="?sy=turortakat">'.$yaz['baslik'].'</a></td>-->
			
				<td>'.$durum.'</td>
				
				  <td>
					<a href="?sy=turkatduzenle&id='.$yaz['id'].'" class="ul-link-action text-success"  data-toggle="tooltip" data-placement="top" title="Düzenle">
						<i class="i-Edit"></i>
					</a>
			 <a href="?sy=turkatsil&id='.$yaz['id'].'" class="ul-link-action text-danger mr-1"  data-toggle="tooltip" data-placement="top" title="Sil" onclick=" if ( !confirm(\'Kaydi silmek istediğinizden emin misiniz?\') ) return false;">
					   <i class="i-Eraser-2"></i>
				   </a>  
				</td>
				
					</tr>
 
				'; 
				
					
				}
		
		?>		
			 
                                       
                                    </tbody>
                                   
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
    </div>
</section>



                </div>
				
 <script>
$('#ul-contact-list').DataTable();
</script>
