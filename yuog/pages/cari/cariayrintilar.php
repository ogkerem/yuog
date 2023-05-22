	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	$konu 	= "kasa"; 
	
	 $birsay = $mysqli->query("select * from adminyetki where adminID='$adminID' && bolumID='3' ")->num_rows;  
	if($birsay==0){
		echo 'No direct script access allowed / Yetkisiz Erişim ';  
		exit();
	} 
	 
	$konu		= "cari";
	$id 		= $_GET['id'];
	$yaz 		= $mysqli->query("select * from carihizmet where id='$id' ")->fetch_array();
	$cariID 	= $yaz['cariID'];
	$cariyaz 	= $mysqli->query("select * from carifirma where id='$cariID' ")->fetch_array();
	$hizmetID 	= $yaz['hizmetID'];
	$hizmetyaz 	= $mysqli->query("select * from hizmet where id='$hizmetID' ")->fetch_array();
	 
	?>
	 
<div class="main-content">                     
<div class="breadcrumb">  
	 <h1> <a href="?sy=<?php echo $konu; ?>"> Cari </a> </h1>
    <ul>
    <li><a href="index.php">Ana Sayfa</a> > <a href="?sy=cariayrinti&id=<?php echo $cariyaz['id']; ?> "><?php echo $cariyaz['firma']; ?> </a>>  <?php echo $hizmetyaz['baslik']; ?></li>

    <li> Cari Hareketleri </li>
    <li> 

		<?php 
		$pbak =  $mysqli->query("select * from parabirimi order by sira asc  "); 
			while($pyaz = $pbak->fetch_array()){		 
			$parabirimi		= $pyaz['id'];
		
		$carihesapla	= $mysqli->query("select sum(alacak) as kaldi from carikasa where cariID='$cariID' && carihizmetID='$id' && parabirimi='$parabirimi' ")->fetch_array();		 
		$cariheap	= $carihesapla['kaldi'];		
		
		$kalanhesap		= $mysqli->query("select sum(alinan) as kaldi from carikasa where cariID='$cariID' && carihizmetID='$id'  && parabirimi='$parabirimi' ")->fetch_array();		 
		$kalann 		= $kalanhesap['kaldi'];	
		
		// $sonuc1 		= intval($cariheap - $kalann); 
		$sonuc 			= number_format(intval($cariheap - $kalann), 2, ',', '.'); 
	 
	echo ' <span class="badge badge-warning">'.$sonuc.''.$pyaz['simge'].'</span> '; 
	
			}
			
			?>
		</li>
		 
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
		
		 <div class="col-md-12 mb-12">
		 
	  
				
				
            <div class="col-md-12 mb-4">
			 
                 
<div class="card-header text-right bg-transparent">
	 

 	<a href="?sy=cariodemeekle&carihizmet=<?php echo $yaz['id']; ?>"><button type="button" class="btn btn-danger btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-asterisk" ></i> </span>
		<span class="ul-btn__text">Ödeme Ekle</span>
	</button>
	</a>  
	
	 
<!--	<a href="?sy=cariodemeal&id=<?php echo $id; ?>"><button type="button" class="btn btn-warning btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-plus" ></i> </span>
		<span class="ul-btn__text">Ödeme Yap</span>
	</button>
	</a>  	
	
	<a href="?sy=cariodemeal&id=<?php echo $id; ?>"><button type="button" class="btn btn-info btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-minus" ></i> </span>
		<span class="ul-btn__text">Ödeme Al </span>
	</button>
	</a>
 
	 -->
	

	
	<!--  <a href="?sy=bilgi&konu=<?php echo $konu;?>"><button type="button" class="btn btn-light btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-share" ></i> </span>
		<span class="ul-btn__text"> Genel Açıklama </span>
	</button>
	</a> -->
										
</div>
      
	<div class="card-body">
		
		<div class="table-responsive">
			<table id=" " class="display table " >
				<thead>
					<tr> 
						<th>ID</th> 						 
						<th>Açıklama</th> 						 
						<th>Meblağ</th> 					 
						<th>Kalan</th> 					 
						<th>Son Gün</th>  
						<th>Kalan Gün</th>  
						<th>Durum</th>
						<th>İşlemler</th>
					</tr>
				</thead>
				<tbody> 
		<?php 
		 
  
			$bak = $mysqli->query("select * from  carikasa where carihizmetID='$id' order by id desc    ");
				while($yaz = $bak->fetch_array()){
		  
			$parabirimi		= $yaz['parabirimi'];		
			$parayaz 		= $mysqli->query("select * from parabirimi where id='$parabirimi' ")->fetch_array();
			$kalan 			=  $yaz['alacak']-$yaz['alinan'];
			
			$gunsay		= (strtotime($yaz['yenileme'])- strtotime(date("Y-m-d")))/(60*60*24);
			$gunBul 	= round($gunsay);

				if($gunBul>0){
					$kalangun = '<span class="badge badge-success">'.$gunBul.' Gün Kaldı</span>'; 
				} else {
					$kalangun = '<span class="badge badge-danger">'.$gunBul.' Gün Geçti</span>'; 
				}
			 
        $idd         = $yaz['id']; 
        $carihesapla	= $mysqli->query("select sum(alacak) as kaldi from carikasa where  id='$idd' ")->fetch_array();		 
        $cariheap	    = $carihesapla['kaldi'];		

        $kalanhesap		= $mysqli->query("select sum(alinan) as kaldi from carikasa where  id='$idd' ")->fetch_array();		 
        $kalann 		= $kalanhesap['kaldi'];	
        $sonuc 			= number_format(intval($cariheap - $kalann), 2, ',', '.'); 

				if($sonuc>0){
					$odemedurum = '<span class="badge badge-danger">Ödeme Bekleniyor</span>'; 
				} else {
					$odemedurum = '<span class="badge badge-success">Ödeme Tamam</span>'; 
				}
				 
					
				if($yaz['durum']==1){
					$durum = '<a href="#" class="badge badge-success m-2 p-2">Aktif</a>'; 
				} else {
					$durum = '<a href="#" class="badge badge-danger m-2 p-2">Pasif</a>'; 
				}



			echo '  <tr>		 
			<td>'.$yaz['id'].'</td>
			<td>'.$yaz['aciklama'].'</td>
			<td> '.number_format($yaz['alacak'], 2, ',', '.').''.$parayaz['simge'].'</td>
			<td> '.number_format($kalan, 2, ',', '.').''.$parayaz['simge'].'</td>
		  
			<td>'.substr($yaz['yenileme'],0,10).' </td>  
			<td>'.$kalangun.' </td>  
			<td>'.$odemedurum.' </td>  
		 <td>
	  
	<a href="?sy=cariodemeduzenle&id='.$yaz['id'].'" class="ul-link-action text-success"  data-toggle="tooltip" data-placement="top" title="Düzenle"><i class="i-Edit"></i></a>
					
		<a href="?sy=cariayrintilarsil&id='.$yaz['id'].'" class="ul-link-action text-danger mr-1"  data-toggle="tooltip" data-placement="top" title="Sil" onclick=" if ( !confirm(\'Kaydi silmek istediğinizden emin misiniz?\') ) return false;">
				   <i class="i-Eraser-2"></i>
			   </a>
					
	<a href="?sy=cariodemeal&id='.$yaz['id'].'" class="ul-link-action text-info"  data-toggle="tooltip" data-placement="top" title="Ödeme Al"><i class="i-Money-2"></i></a>
				   
				</td> 
				</tr> '; 
		 
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
				
 
