	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
	
	?> 
	
	
<div class="main-content">
                    
<div class="breadcrumb">
    <h1>Adminler</h1>
    <ul>
        <li><a href="index.php">Ana Sayfa</a></li>
        
        
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
			
			
<section class="contact-list">
    <div class="row">
            <div class="col-md-12 mb-4">
                    <div class="card text-left">
<div class="card-header text-right bg-transparent">
	<!-- <button type="button" data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-primary btn-md m-1"><i class="i-Add-User text-white mr-2"></i> İçerik Ekle </button> -->
	
	<a href="?sy=adminekle"><button type="button" class="btn btn-primary btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-plus" ></i> </span>
		<span class="ul-btn__text">Admin Ekle</span>
	</button>
	</a>
	 
	
	<!-- <a href="?sy=adminkat"><button type="button" class="btn btn-warning btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-asterisk" ></i> </span>
		<span class="ul-btn__text">Görevler</span>
	</button>
	</a> -->
 
	 
	<a href="?sy=adminlog"><button type="button" class="btn btn-light btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-share" ></i> </span>
		<span class="ul-btn__text">Admin Girişleri (Loglar)</span>
	</button>
	</a>
	
										
</div>
          
	<div class="card-body"> 
		<div class="table-responsive">
			<table id="ul-contact-list" class="display table " style="width:100%">
				<thead>
					<tr>
						 
						<th>ID</th>
					   <th>Ad Soyad </th>  
					   <th>Mail </th>  
						<th>Kategori</th> 
						<th>Durum</th> 
						<th>İşlemler</th> 
					 
					</tr>
				</thead>
				<tbody>
                                       
										
			
	 <?php  $bak = $mysqli->query("select * from admin ");
				while($yaz = $bak->fetch_array()){
			
			if($yaz['durum']==1){
				$durum = '<a href="#" class="badge badge-success m-2 p-2">Aktif</a>'; 
			} else {
				$durum = '<a href="#" class="badge badge-danger m-2 p-2">Pasif</a>'; 
			}
			
			$maill 		= $yaz['mail'];
		
			$katID 		= $yaz['mertebe'];
			$katbul		= $mysqli->query("select * from adminkat where id='$katID' ");
			$ustkat 	= $katbul->fetch_array();
			
		  
		 if($maill!="info@YUOG.com"){
			  
				echo '  <tr>
			 
				<td>'.$yaz['id'].'</td>
			 
			<td>'.$yaz['adsoyad'].'</td>
			<td>'.$yaz['mail'].'</td>
			<td>'.$ustkat['baslik'].'</td>
				<td>'.$durum.'</td>
				
		 <td>
					<a href="?sy=adminduzenle&id='.$yaz['id'].'" class="ul-link-action text-success"  data-toggle="tooltip" data-placement="top" title="Düzenle">
						<i class="i-Edit"></i>
					</a>
			 <a href="?sy=adminsil&id='.$yaz['id'].'" class="ul-link-action text-danger mr-1"  data-toggle="tooltip" data-placement="top" title="Sil" onclick=" if ( !confirm(\'Kaydi silmek istediğinizden emin misiniz?\') ) return false;">
					   <i class="i-Eraser-2"></i>
				   </a>  
				</td> 
					</tr> ';  
					
				} else {
					
			if($email=="info@YUOG.com"){
						
							echo '  <tr>
			 
				<td>'.$yaz['id'].'</td>
			 
			<td>'.$yaz['adsoyad'].'</td>
			<td>'.$yaz['mail'].'</td>
			<td>'.$ustkat['baslik'].'</td>
				<td>'.$durum.'</td>
				
		 <td>
					<a href="?sy=adminduzenle&id='.$yaz['id'].'" class="ul-link-action text-success"  data-toggle="tooltip" data-placement="top" title="Düzenle">
						<i class="i-Edit"></i>
					</a>
			 <a href="?sy=adminsil&id='.$yaz['id'].'" class="ul-link-action text-danger mr-1"  data-toggle="tooltip" data-placement="top" title="Sil" onclick=" if ( !confirm(\'Kaydi silmek istediğinizden emin misiniz?\') ) return false;">
					   <i class="i-Eraser-2"></i>
				   </a>  
				</td> 
					</tr> ';  
					
					
					}
					
				}   
				 
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
