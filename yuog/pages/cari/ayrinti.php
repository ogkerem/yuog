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
    $yaz 		= $mysqli->query("select * from carifirma where id='$id' ")->fetch_array();
    $cariID		= $id;
	 
	?>  
  
<div class="main-content"> 
<div class="breadcrumb"> 
	 <h1> <a href="?sy=<?php echo $konu; ?>"> Cari </a> </h1>
    <ul>
        <li><a href="index.php">Ana Sayfa</a> > <?php echo $yaz['firma']; ?> </li>
 
        <li> Cari Hareketleri </li>
        <li> 

		<?php 
		$pbak =  $mysqli->query("select * from parabirimi order by sira asc  "); 
			while($pyaz = $pbak->fetch_array()){		 
			$parabirimi		= $pyaz['id'];
  
	// $carihesapla	= $mysqli->query("select sum(fiyat) as kaldi from carihizmet where cariID='$cariID' && parabirimi='$parabirimi' ")->fetch_array();		 
	// $cariheap		= $carihesapla['kaldi'];		
	
	$kalanhesap		= $mysqli->query("select sum(alinan) as kaldi from carikasa where cariID='$cariID' && parabirimi='$parabirimi' ")->fetch_array();		 
	$kalann 		= $kalanhesap['kaldi'];	
	
	$alinanhesap	= $mysqli->query("select sum(alacak) as kaldi from carikasa where cariID='$cariID' && parabirimi='$parabirimi' ")->fetch_array();		 
	$alacak 		= $alinanhesap['kaldi'];	
	
	// $sonuc1 		= intval($cariheap - $kalann); 
	$sonuc 			= number_format(intval($alacak-$kalann), 2, ',', '.'); 
	 
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
	 
	 
	<a href="?sy=carihizmetekle&cariID=<?php echo $yaz['id']; ?>"><button type="button" class="btn btn-danger btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-asterisk" ></i> </span>
		<span class="ul-btn__text">Firmaya Hizmet Ekle</span>
	</button>
	</a> 
	
	 
<!--	<a href="?sy=cariodemeyap&id=<?php echo $id; ?>"><button type="button" class="btn btn-warning btn-icon m-1">
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
				 				 
						<th>Hizmet(Carisi)</th> 
						<th>Termin</th> 
						<th>Bitiş</th> 
				 
						<th>Bakiye</th> 
						<th>Kalan Süre</th> 
						<th>Ödeme Durumu</th> 
						<th>Durum</th> 
						<th>Tarih</th>  
						<th>İşlemler</th>
					</tr>
				</thead>
				<tbody>
            
		<?php 
		
		  $limit 		= 10;		
		  $sayfa 		= intval(@$_GET['sayfa']);
		  if(!$sayfa) $sayfa=1;
		  $satirsayisi 	= $mysqli->query("select id from carihizmet where cariID='$id' ")->num_rows;
		  $toplamsayfa 	= ceil($satirsayisi/$limit); 
		  $baslangic  	= ($sayfa-1)*$limit;
		  $x			= 0;
  
  
			$bak = $mysqli->query("select * from  carihizmet where cariID='$id' order by id desc limit $baslangic,$limit  ");
				while($yaz = $bak->fetch_array()){
		  
			$parabirimi		= $yaz['parabirimi'];		
			$parayaz 		= $mysqli->query("select * from parabirimi where id='$parabirimi' ")->fetch_array();
			 
			$hizmetID		= $yaz['hizmetID'];		
			$hizmetyaz 		= $mysqli->query("select * from hizmet where id='$hizmetID' ")->fetch_array();
			 
			$gunsay		= (strtotime($yaz['yenileme'])- strtotime(date("Y-m-d")))/(60*60*24);
			$gunBul 	= round($gunsay);
			
		$carihizmetID	= $yaz['id']; 
		$kalanhesap		= $mysqli->query("select sum(alinan) as kaldi from carikasa where carihizmetID='$carihizmetID' && cariID='$cariID' && parabirimi='$parabirimi' ")->fetch_array();		 
		$kalann 		= $kalanhesap['kaldi'];	
        
		$kalanalacak    = $mysqli->query("select sum(alacak) as kaldi from carikasa where carihizmetID='$carihizmetID' && cariID='$cariID' && parabirimi='$parabirimi' ")->fetch_array();		 
		$alacakk 		= $kalanalacak['kaldi'];	

		$sonuc 			= $alacakk-$kalann; 
		 
			if($gunBul>0){
				$kalangun = '<span class="badge badge-success">'.$gunBul.' Gün Kaldı</span>'; 
			} else {
				$kalangun = '<span class="badge badge-danger">'.$gunBul.' Gün Geçti</span>'; 
			}
		 
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
			  
			<td> <a href="?sy=cariayrintilar&id='.$yaz['id'].'" > '.$hizmetyaz['baslik'].' / '.$yaz['baslik'].'</a></td>
	  
			<td> '.$yaz['termin'].'  </td>
			<td> '.substr($yaz['yenileme'],0,10).'  </td> 
			 
			<td> '.number_format($sonuc, 2, ',', '.').''.$parayaz['simge'].'</td>
			<td> '.$kalangun.'</td>
			<td> '.$odemedurum.'</td> 
			<td> '.$durum.'</td> 
			<td>'.substr($yaz['tarih'],0,10).' </td>  
		 <td>
		 
  
	<a href="?sy=carihizmetduzenle&id='.$yaz['id'].'" class="ul-link-action text-success"  data-toggle="tooltip" data-placement="top" title="Düzenle"><i class="i-Edit"></i></a>
					
		<a href="?sy=carihizmetsil&id='.$yaz['id'].'" class="ul-link-action text-danger mr-1"  data-toggle="tooltip" data-placement="top" title="Sil" onclick=" if ( !confirm(\'Kaydi silmek istediğinizden emin misiniz?\') ) return false;">
				   <i class="i-Eraser-2"></i>
			   </a>
				   
				</td> 
				</tr> '; 
			$x++;
				}
		
		?>		
			 
                                       
					</tbody>
				   
				</table>
				 
			</div>

	 
	 
	 <div class="col-sm-12 col-md-7" >
	 <div class="dataTables_paginate paging_simple_numbers" id="ul-contact-list_paginate">
	 <ul class="pagination">
	 
	 <?php  
if($toplamsayfa>1){

	$forlimit = 3; 
	
	if($sayfa > 1){
	 
		echo ' <li class="paginate_button page-item previous" id="ul-contact-list_previous"><a href="?sy=cariayrinti&id='.$id.'&sayfa='.($sayfa-1).'" aria-controls="ul-contact-list" data-dt-idx="0" tabindex="0" class="page-link">Önceki</a></li> '; 
	}
	for ($y= $sayfa - $forlimit ; $y<= $sayfa + $forlimit + 1 ; $y++){
	
	if($y >0 && $y <=  $toplamsayfa ){
		if($y == $sayfa){
			
	 echo ' <li class="paginate_button page-item active"><a href="#" aria-controls="ul-contact-list" data-dt-idx="1" tabindex="0" class="page-link">'.$y.'</a></li>   ';
		} else {
			echo '<li class="paginate_button page-item "><a href="?sy=cariayrinti&id='.$id.'&sayfa='.$y.'" aria-controls="ul-contact-list" data-dt-idx="2" tabindex="0" class="page-link">'.$y.'</a></li> ';
		}
		
	}	
	} 	
	if($sayfa != $toplamsayfa ){		
		
		echo '<li class="paginate_button page-item "><a href="?sy=cariayrinti&id='.$id.'&sayfa='.($sayfa+1).'" aria-controls="ul-contact-list" data-dt-idx="2" tabindex="0" class="page-link">Sonraki</a></li>  ';
		 
		
	}
}
	
	?>	
	 
	 </ul>
	 </div>
 
	<?php 
	
		// $stoksay 	=  $mysqli->query("select sum(adet) as toplam from stok where urunID='$id' ")->fetch_array();
	// $tgelir  = $mysqli->query("select sum() from  carikasa where firmaID='$id' order by id desc limit $baslangic,$limit  ");  
	
	?>
 
	 </div> 
		 	
	 
		</div>
		 
		

		 
	</div>
	

</div>
    </div>
	
 
	
	
</section> 
  </div>
				
 
