	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	$konu 	= "uygulama";
	$kat 	= "uygulamakat";
	$katID	= @$_GET['katID'];
	if($katID!=0){ 
	$katbak = $mysqli->query("select * from $konu where id='$katID'");
	$katyaz = $katbak->fetch_array();
	}
	?>
	
	
<div class="main-content">
                    
<div class="breadcrumb">
  
	 <h1> <a href="?sy=<?php echo $konu; ?>"> Uygulama </a> </h1>
    <ul>
        <li><a href="index.php">Ana Sayfa</a></li>
      <?php if($katID!=0){  ?> <li> <?php echo $katyaz['baslik']; ?> </li> <?php } ?>
        <li> İçerikler </li>
		 
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
	
	<a href="?sy=<?php echo $konu; ?>ekle"><button type="button" class="btn btn-primary btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-plus" ></i> </span>
		<span class="ul-btn__text">Yeni İçerik Ekle</span>
	</button>
	</a>
	
	<!-- <a href="?sy=<?php echo $kat; ?>"><button type="button" class="btn btn-warning btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-asterisk" ></i> </span>
		<span class="ul-btn__text">Kategoriler</span>
	</button>
	</a>-->
	
	<a href="?sy=<?php echo $konu; ?>sektor"><button type="button" class="btn btn-danger btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-calendar" ></i> </span>
		<span class="ul-btn__text">Sektörler</span>
	</button>
	</a>
	 
	<!-- <a href="?sy=cikisnokta"><button type="button" class="btn btn-light btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-share" ></i> </span>
		<span class="ul-btn__text">Çıkış Noktaları</span>
	</button>
	</a> -->
		
	<a href="?sy=bilgi&konu=<?php echo $konu;?>"><button type="button" class="btn btn-light btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-share" ></i> </span>
		<span class="ul-btn__text"> Genel Açıklama </span>
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
				<th>Kategori</th> 
				<th>Dil</th> 
				<th>Durum</th> 
				<th>İşlemler</th>
			</tr>
		</thead>
		<tbody>
							   
										
			
		<?php 
		
			$bak = $mysqli->query("select * from  $konu   ");
				while($yaz = $bak->fetch_array()){
			
			if($yaz['durum']==1){
				$durum = '<a href="#" class="badge badge-success m-2 p-2">Aktif</a>'; 
			} else {
				$durum = '<a href="#" class="badge badge-danger m-2 p-2">Pasif</a>'; 
			}
			
		$dil 	= $yaz['dil'];
		$dilbak = $mysqli->query("select * from diller where id='$dil' ");
		$dilyaz = $dilbak->fetch_array();
			
		$katID			= $yaz['katID'];		
		$katIDbak 		= $mysqli->query("select * from  $kat where id='$katID' ");
		$katIDyaz 		= $katIDbak->fetch_array();
	 	
		// $ustkatID		= $yaz['ustkatID'];		
		// $ustkatIDbak 	= $mysqli->query("select * from $kat where id='$ustkatID' ");
		// $ustkatIDyaz 	= $ustkatIDbak->fetch_array();
		
		
		// $id		= $yaz['id'];
		
		// $altbak 	= $mysqli->query("select * from $konu where katID='$id' ");
		// $altsay 	= $altbak->num_rows;
	 
		// if($altsay>0){
			// $sill = ' Silinemez ' ; 
			   
		// } else {
			// $sill = ' <a href="?sy='.$konu.'sil&id='.$yaz['id'].'" class="ul-link-action text-danger mr-1"  data-toggle="tooltip" data-placement="top" title="Sil" onclick=" if ( !confirm(\'Kaydi silmek istediğinizden emin misiniz?\') ) return false;">
				   // <i class="i-Eraser-2"></i>
			   // </a> ' ; 
			   
		// }
		
		// $bb = '<a href="?sy='.$konu.'&katID='.$id.'"><button type="button" class="btn btn-primary ripple m-1">'.$yaz['baslik'].'</button></a>';
	 
			
				echo '  <tr>
				<td>'.$yaz['sira'].'</td>
				<td>'.$yaz['id'].'</td>
		  
				<td>'.$yaz['baslik'].'</td>
				<td> '.$katIDyaz['baslik'].' </td>
			 
				<td>'.$dilyaz['baslik'].'</td>
				<td>'.$durum.'</td>
				
				  <td>
			 <a href="?sy='.$konu.'duzenle&id='.$yaz['id'].'" class="ul-link-action text-success"  data-toggle="tooltip" data-placement="top" title="Düzenle">
						<i class="i-Edit"></i>
					</a>
					
		<a href="?sy='.$konu.'sil&id='.$yaz['id'].'" class="ul-link-action text-danger mr-1"  data-toggle="tooltip" data-placement="top" title="Sil" onclick=" if ( !confirm(\'Kaydi silmek istediğinizden emin misiniz?\') ) return false;">
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
