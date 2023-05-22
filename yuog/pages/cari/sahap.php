	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	$konu 	= "carifirma"; 
	$kat 	= $konu.'kat';
 
 	 $birsay = $mysqli->query("select * from adminyetki where adminID='$adminID' && bolumID='3' ")->num_rows;  
	if($birsay==0){
		echo 'No direct script access allowed / Yetkisiz Erişim '; 
		
		exit();
	} 
	
	 
	?>
 
 
<div class="main-content">
                    
<div class="breadcrumb">
  
	 <h1> <a href="?sy=cari"> Cariler (Firmalar) </a> </h1>
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
	
	<a href="?sy=cariekle"><button type="button" class="btn btn-primary btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-plus" ></i> </span>
		<span class="ul-btn__text">Firma Ekle</span>
	</button>
	</a>
	
	 <a href="?sy=butun"><button type="button" class="btn btn-warning btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-asterisk" ></i> </span>
		<span class="ul-btn__text">Bütün Hizmetler</span>
	</button>
	</a>
	<!--
	<a href="?sy=turtarih"><button type="button" class="btn btn-danger btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-calendar" ></i> </span>
		<span class="ul-btn__text">Tarihler</span>
	</button>
	</a>
	 
	<a href="?sy=cikisnokta"><button type="button" class="btn btn-light btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-share" ></i> </span>
		<span class="ul-btn__text">Çıkış Noktaları</span>
	</button>
	</a> 
	
	 <a href="?sy=bilgi&konu=<?php echo $konu;?>"><button type="button" class="btn btn-light btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-share" ></i> </span>
		<span class="ul-btn__text"> Genel Açıklama </span>
	</button>
	</a> -->
										
</div>
                      
                       

                        <div class="card-body">
                            
                            <div class="table-responsive">
			<table id="ul-contact-list" class="display table " style="width:100%">
				<thead>
					<tr>
					 
						<th>ID</th>
						  
						<th>Firma </th> 
						<th>Yetkili </th> 
						<th>Bakiye</th> 
						<!-- <th>Ödeme Yap</th> 
						<th>Ödeme Al</th>  -->
				   
						<th>İşlemler</th>
					</tr>
				</thead>
				<tbody>
                                       
										
			
		<?php 
		
			$bak = $mysqli->query("select * from carifirma   ");
	 
		while($yaz = $bak->fetch_array()){
			
		$cariID 		= $yaz['id']; 
				echo '  <tr>
				 
				<td>'.$yaz['id'].'</td>
		  
				<td> <a href="?sy=cariayrinti&id='.$yaz['id'].'" title="Firma Cari Hareketleri"> '.$yaz['firma'].'</a></td>
				<td> <a href="?sy=cariayrinti&id='.$yaz['id'].'" title="Firma Cari Hareketleri"> '.$yaz['yetkili'].'</a></td>
				 
				 
				<td>  ';

		$sonuc	= "";
		$pbak =  $mysqli->query("select * from parabirimi order by sira asc  "); 
			while($pyaz = $pbak->fetch_array()){		 
			$parabirimi		= $pyaz['id'];
			
		$carihesapla	= $mysqli->query("select sum(alacak) as kaldi from carikasa where cariID='$cariID' && parabirimi='$parabirimi' ")->fetch_array();		 
		$cariheap		= $carihesapla['kaldi'];		
	
		$kalanhesap		= $mysqli->query("select sum(alinan) as kaldi from carikasa where cariID='$cariID' && parabirimi='$parabirimi' ")->fetch_array();		 
		$kalann 		= $kalanhesap['kaldi'];	
		 
			
		// $sonuc1 		= intval($cariheap - $kalann); 
		 $sonuc 			= number_format(intval($cariheap-$kalann), 2, ',', '.');  
		 
		if(($sonuc)>0){ $syaz = 'success';    } else { $syaz = 'warning'; }	
		  
			echo ' <span class="badge badge-'.$syaz.'">'.$sonuc.''.$pyaz['simge'].'</span> '; 
			}
		  
		echo ' </td>
			<!--	<td><a href="?sy=cariodemeyap&id='.$yaz['id'].'" ><button type="button" class="btn btn-warning m-1"> Ödeme Yap</button></a></td>
				<td><a href="?sy=cariodemeal&id='.$yaz['id'].'" ><button type="button" class="btn btn-info m-1"> Ödeme Al </button></a></td> -->
				
				  <td>
			 <a href="?sy=cariduzenle&id='.$yaz['id'].'" class="ul-link-action text-success"  data-toggle="tooltip" data-placement="top" title="Düzenle">
						<i class="i-Edit"></i>
					</a> ';
				 
				if( $sonuc>0){ echo 'Silinemez';  } else {  echo '<a href="?sy=carisil&id='.$yaz['id'].'" class="ul-link-action text-danger mr-1"  data-toggle="tooltip" data-placement="top" title="Sil" onclick=" if ( !confirm(\'Kaydi silmek istediğinizden emin misiniz?\') ) return false;">
				   <i class="i-Eraser-2"></i>
			   </a>';   }	
			    
			
				echo ' </td> 
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
				
 <script>
$('#ul-contact-list').DataTable();
</script>
