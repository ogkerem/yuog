	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	$sistem 	= $_GET['sistem']; 
	 
	$konu 		= "sahap"; 
	$kat 		= 'kategori';
	$sistemyaz 	= $mysqli->query("select * from sistem where id='$sistem' ")->fetch_array();
	?>
	
	
<div class="main-content">
                    
<div class="breadcrumb">
  
	 <h1> <a href="?sy=sahap&sistem=<?php echo $sistem; ?>"> <?php echo $sistemyaz['menu']; ?> </a> </h1>
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
	
	<a href="?sy=<?php echo $konu; ?>ekle&sistem=<?php echo $sistemyaz['id']; ?>"><button type="button" class="btn btn-primary btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-plus" ></i> </span>
		<span class="ul-btn__text">Yeni İçerik Ekle</span>
	</button>
	</a> 
	
	<?php 
		if($sistemyaz['kat1']=="on"){ 
	?>
	 <a href="?sy=kategori&sistem=<?php echo $sistemyaz['id']; ?>"><button type="button" class="btn btn-warning btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-asterisk" ></i> </span>
		<span class="ul-btn__text">Kategoriler</span>
	</button>
	</a>
		<?php } ?>
	 
	<!--<a href="?sy=<?php echo $konu; ?>ozellik"><button type="button" class="btn btn-danger btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-calendar" ></i> </span>
		<span class="ul-btn__text">Özellikler</span>
	</button>
	</a> -->
	 
	<?php if($sistemyaz['marka']=="on"){ ?>
	<a href="?sy=marka&sistem=<?php echo $sistemyaz['id']; ?>"><button type="button" class="btn btn-dark btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-industry" ></i> </span>
		<span class="ul-btn__text">Markalar</span>
	</button>
	</a>
	<?php } ?>	
	
 	 <a href="?sy=bilgi&konu=<?php echo $sistemyaz['menu']; ?>"><button type="button" class="btn btn-light btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-share" ></i> </span>
		<span class="ul-btn__text"> Genel Açıklama </span>
	</button>
	</a> 
										
</div>
                      
                       

                        <div class="card-body">
                            
                            <div class="table-responsive">
			<table id="ul-contact-list" class="display table " style=" ">
				<thead>
					<tr>
						<th>Sıra</th>
						<th>ID</th>
						  
						<th>Başlık</th> 
					<!--	<th>Kodu</th>  -->
					 
			<?php if($sistemyaz['marka']=="on"){ ?> <th>Marka</th> <?php } ?>
			<?php if($sistemyaz['kat1']=="on"){ ?> <th>Kategori</th> <?php } ?>
					<!--	<th>Alt Kategori</th> -->
						
					<!--	<th>Dökümanlar</th> 
						<th>Şartname</th>
						<th>Aksesuarlar</th> 
						<th>Videolar</th>  -->
						 
						<th>Dil</th> 
						<th>Durum</th> 
						<th>İşlemler</th>
					</tr>
				</thead>
				<tbody>
                                       
										
			
		<?php 
		
			$bak = $mysqli->query("select * from  $konu  where menu='$sistem' ");
				while($yaz = $bak->fetch_array()){
			 
			if($yaz['durum']=="on"){
				$durum = '<a href="#" class="badge badge-success m-2 p-2">Aktif</a>'; 
			} else {
				$durum = '<a href="#" class="badge badge-danger m-2 p-2">Pasif</a>'; 
			}
			
			$dil 	= $yaz['dil'];
			$dilyaz = $mysqli->query("select * from diller where id='$dil' ")->fetch_array();
		  
			$kat1			= $yaz['kat1'];		
			$kat1yaz 		= $mysqli->query("select * from  $kat where id='$kat1' ")->fetch_array();
		    
			$kat2			= $yaz['kat2'];		
			$kat2yaz 		= $mysqli->query("select * from  $kat where id='$kat2' ")->fetch_array();
		    
			$kat3			= $yaz['kat3'];		
			$kat3yaz 		= $mysqli->query("select * from  $kat where id='$kat3' ")->fetch_array();
		   	if(($kat1==0) && ($kat2==0)&& ($kat3==0)){
				$katt ='';  
			}   elseif(($kat1!=0)&& ($kat2==0)&& ($kat3==0)){
					$katt = $kat1yaz['baslik']; 
			} elseif(($kat1!=0)&& ($kat2!=0)&& ($kat3==0)){
				$katt = $kat1yaz['baslik'].'>'.$kat2yaz['baslik'];
			} else {
				$katt = $kat1yaz['baslik'].'>'.$kat2yaz['baslik'].'>'.$kat3yaz['baslik'];
			}
		 
			$markaID		= $yaz['marka'];		
			$markayaz 		= $mysqli->query("select * from marka where id='$markaID' ")->fetch_array();
		  
				echo '  <tr>
				<td>'.$yaz['sira'].'</td>
				<td>'.$yaz['id'].'</td>
		  
				<td>'.$yaz['baslik'].'</td> '; 
				 
	if($sistemyaz['marka']=="on"){ echo '<td>'.@$markayaz['baslik'].' </td>'; }
	if($sistemyaz['kat1']=="on"){ echo '<td>'.$katt.' </td>'; }
				 
			  
echo ' <!--<td><a href="?sy=urundokuman&id='.$yaz['id'].'"  ><button type="button" class="btn btn-primary ripple m-1">Dökümanlar</button></a></td>
 <td><a href="?sy=urunsartname&id='.$yaz['id'].'"  ><button type="button" class="btn btn-warning m-1">Şartname</button></a></td>
<td><a href="?sy=urunaksesuar&id='.$yaz['id'].'"  ><button type="button" class="btn btn-light m-1">Aksesuarlar</button></a></td>
<td><a href="?sy=urunvideo&id='.$yaz['id'].'" ><button type="button" class="btn btn-info m-1">Videolar</button></a></td>-->
			 
				<td>'.$dilyaz['baslik'].'</td> 
				<td>'.$durum.'</td>
				
				  <td>
				  
	<!-- <a href="?sy='.$konu.'kopyala&sistem='.$sistem.'&id='.$yaz['id'].'" class="ul-link-action text-warning mr-1"  data-toggle="tooltip" data-placement="top" title="Kopyala" onclick=" if ( !confirm(\'Kopyalama Başlasın mı ? \') ) return false;" >
		 <i class="i-Windows-2"></i>
	 </a> -->
	 
 
		 <a href="?sy='.$konu.'duzenle&sistem='.$sistem.'&id='.$yaz['id'].'" class="ul-link-action text-success mr-1"  data-toggle="tooltip" data-placement="top" title="Düzenle">
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
