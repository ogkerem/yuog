	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
	
	?>
	
	
<div class="main-content">
                    
<div class="breadcrumb">
    <h1>Rezervasyonlar </h1>
    <ul>
        <li><a href="index.php">Ana Sayfa</a></li>
        <li> Rezervasyonlar</li>
        
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
	
	<a href="?sy=rezekle"><button type="button" class="btn btn-primary btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-plus" ></i> </span>
		<span class="ul-btn__text">Rezervasyon Ekle</span>
	</button>
	</a>
	
<!--	<a href="?sy=turkat"><button type="button" class="btn btn-warning btn-icon m-1">
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
					<th>ID</th>
					<th> Tur </th>
					<th> Tur Tarih </th>
					<th> Acenta </th>
					<th> 1. Kişi </th>
					<th> Cep </th>
					<th> Kişi Sayısı </th>
					<th> Toplam </th>
					<th> Ödeme Şekli </th> 
					<th>Durum</th> 
					<th>İşlemler</th>
				</tr>
			</thead>
			<tbody>
			    	 
		<?php 
		
			$bak = $mysqli->query("select * from rezervasyon ");
				while($yaz = $bak->fetch_array()){
			
		 
			
			$turID 		= $yaz['turID'];
			$turbak		= $mysqli->query("select * from turlar where id='$turID' ");
			$turyaz 	= $turbak->fetch_array();
			
			$turtarihID 		= $yaz['turtarihID'];
			$turtarihbak		= $mysqli->query("select * from turtarih where id='$turtarihID' ");
			$turtarihyaz	 	= $turtarihbak->fetch_array();
			
			$acentaID 			= $yaz['acentaID'];
			$acentabak			= $mysqli->query("select * from acenta where id='$acentaID' ");
			$acentayaz	 		= $acentabak->fetch_array();
			
			$parabirimi			= $yaz['parabirimi'];
			$pbbak				= $mysqli->query("select * from parabirimi where id='$parabirimi' ");
			$pbyazz	 			= $pbbak->fetch_array();
			
				echo '  <tr>
				<td>'.$yaz['id'].'</td>
				<td>'.$turyaz['baslik'].'</td>				
								
				<td>'.substr($turtarihyaz['sefertarih'],0,10).'</td>
				<td>'.$acentayaz['firma'].'</td>				
				<td>'.$yaz['adi'].' '.$yaz['soyadi'].' </td>
				<td>'.$yaz['cep'].'   </td>
				<td>'.$yaz['kisisayisi'].'   </td>
				<td>'.$yaz['toplam'].'  '.$pbyazz['simge'].'   </td>
				<td>'.$yaz['odemesekli'].'</td>
				<td><span class="badge badge-primary m-2 p-2">'.$yaz['durum'].'</span></td> 
				
				  <td>
					<a href="?sy=turduzenle&id='.$yaz['id'].'" class="ul-link-action text-success"  data-toggle="tooltip" data-placement="top" title="Düzenle">
						<i class="i-Edit"></i>
					</a>
			 <a href="?sy=tursil&id='.$yaz['id'].'" class="ul-link-action text-danger mr-1"  data-toggle="tooltip" data-placement="top" title="Sil" onclick=" if ( !confirm(\'Kaydi silmek istediğinizden emin misiniz?\') ) return false;">
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
				
 