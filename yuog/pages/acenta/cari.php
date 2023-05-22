	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
	$id 	= $_GET['id'];
	$yaz1 	= $mysqli->query("select * from acenta where id='$id' ");
	$yaz 	= $yaz1->fetch_array();
	
	
	?>
	
	
<div class="main-content">
                    
<div class="breadcrumb">
    <h1><?php echo $yaz['firma']; ?> / <?php echo $yaz['yetkili ']; ?> Cari İşlemleri</h1>
    <ul>
        <li><a href="index.php">Ana Sayfa</a></li>
        <li><a href="?sy=acenta">Acentalar</a></li>
        
        
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
                   
 <div class="card-body">
	
	<div class="table-responsive">
		<table id="ul-contact-list" class="display table " style="width:100%">
				<thead>
					<tr>
						<th>Tarih</th>
						<th>Mail Adresi</th>
						<th>IP</th>
					 
					</tr>
				</thead>
                   <tbody>
				   
	<?php 
		$bak = $mysqli->query("select * from oturum  ");
			while($yaz = $bak->fetch_array()){
				
				echo '	<tr>
				 
				<td>'.$yaz['tarih'].'</td>
				<td>'.$yaz['oturumacan'].'</td>
				<td>'.$yaz['ip'].'</td> 
			</tr>'; 
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
