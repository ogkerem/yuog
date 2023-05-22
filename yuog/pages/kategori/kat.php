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
  
	 <h1> <a href="?sy=sahap&sistem=<?php echo $sistem; ?>"> <?php echo $sistemyaz['menu']; ?> </a> > Kategoriler </h1>
    <ul>
        <li><a href="index.php">Ana Sayfa</a></li>
     
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
	
	<a href="?sy=<?php echo $konu; ?>ekle&sistem=<?php echo $sistem; ?>"><button type="button" class="btn btn-primary btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-plus" ></i> </span>
		<span class="ul-btn__text">Yeni Kategori Ekle</span>
	</button>
	</a>
	
<!--	 <a href="?sy=bolumlerkat"><button type="button" class="btn btn-warning btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-asterisk" ></i> </span>
		<span class="ul-btn__text">Kategoriler</span>
	</button>
	</a>
	
	<a href="?sy=turtarih"><button type="button" class="btn btn-danger btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-calendar" ></i> </span>
		<span class="ul-btn__text">Tarihler</span>
	</button>
	</a>
	 
	<a href="?sy=cikisnokta"><button type="button" class="btn btn-light btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-share" ></i> </span>
		<span class="ul-btn__text">Çıkış Noktaları</span>
	</button>
	</a> -->
										
</div>
                      
                       

                        <div class="card-body">
                            
                            <div class="table-responsive">
			<table id="ul-contact-list" class="display table " style="width:100%">
				<thead>
					<tr>
						<th>Sıra</th>
						<th>ID</th>
						  
						<th>Başlık</th> 
						 
						<th> Üst Kategorisi  </th> 
					<!--	<th>Renk</th>
						<th>Dökümanlar</th>  -->
<!--						<th>Şartname</th> 
						<th>Aksesuarlar</th> 
						<th>Videolar</th> -->
						
						<th>Dil</th> 
						<th>Durum</th> 
						<th>İşlemler</th>
					</tr>
				</thead>
				<tbody>
                                       
										
			
		<?php 
		
			$bak = $mysqli->query("select * from  $konu where menu='$sistem' ");
				while($yaz = $bak->fetch_array()){
			
			if($yaz['durum']=="on"){
				$durum = '<a href="#" class="badge badge-success m-2 p-2">Aktif</a>'; 
			} else {
				$durum = '<a href="#" class="badge badge-danger m-2 p-2">Pasif</a>'; 
			}
			
		$dil 	= $yaz['dil'];
		$dilbak = $mysqli->query("select * from diller where id='$dil' ");
		$dilyaz = $dilbak->fetch_array();
			
		$katID			= $yaz['katID'];		
		$katIDyaz 		= $mysqli->query("select * from $konu where id='$katID' ")->fetch_array();
	  
		$ustkatID		= $yaz['ustkatID'];		
		$ustkatIDyaz 	= $mysqli->query("select * from $konu where id='$ustkatID' ")->fetch_array();
	  
   
		if(($ustkatID==0) && ($katID==0)){
			$kat =''; 
		}   elseif($katID==0){
			$kat = $ustkatIDyaz['baslik'];
		} else {
			$kat = $ustkatIDyaz['baslik'].'>'.$katIDyaz['baslik'];
		}
	  
	echo '  <tr>
	<td>'.$yaz['sira'].'</td>
	<td>'.$yaz['id'].'</td>
	<td>'.$yaz['baslik'].'</td> 
	<td> '.$kat.' </td>

	<td>'.$dilyaz['baslik'].'</td>
	<td>'.$durum.'</td>
	
	  <td>
	<a href="?sy='.$konu.'duzenle&sistem='.$sistem.'&id='.$yaz['id'].'" class="ul-link-action text-success"  data-toggle="tooltip" data-placement="top" title="Düzenle">
			<i class="i-Edit"></i>
		</a>
		
<a href="?sy='.$konu.'sil&sistem='.$sistem.'&id='.$yaz['id'].'" class="ul-link-action text-danger mr-1"  data-toggle="tooltip" data-placement="top" title="Sil" onclick=" if ( !confirm(\'Kaydi silmek istediğinizden emin misiniz?\') ) return false;">
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
