	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	$konu 	= "kasa"; 
	
	//  $birsay = $mysqli->query("select * from adminyetki where adminID='$adminID' && bolumID='2' ")->num_rows;  
	// if($birsay==0){
	// 	echo 'No direct script access allowed / Yetkisiz Erişim '; 
		
	// 	exit();
	// } 
	
	
	?>
	
	
<div class="main-content">
                    
<div class="breadcrumb">
  
	 <h1> <a href="?sy=<?php echo $konu; ?>"> Muhasebe (Kasa) </a> </h1>
    <ul>
        <li><a href="index.php">Ana Sayfa</a></li>
 
        <li> Kasa Genel Durum </li>
		 
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
		
		<?php $kbak = $mysqli->query("select * from kasacesit order by sira asc  "); 
			while($kyaz = $kbak->fetch_array()){ 
		?>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        
                   
						 <span class="badge badge-pill badge-warning" ><a href="?sy=kasabak&id=<?php echo $kyaz['id']; ?>"> <?php echo $kyaz['baslik']; ?></a></span>
                         <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Para Birimi</th>
                                            <th scope="col">Meblağ</th>
                                            
                                        </tr>
                                    </thead>
        <?php $pbak =  $mysqli->query("select * from parabirimi order by sira asc  "); 
			while($pyaz = $pbak->fetch_array()){
			$kasaID			= $kyaz['id'];
			$parabirimi		= $pyaz['id'];
			
			$gelirbak 		= $mysqli->query("select sum(giris) as gelir from kasa where kasaID='$kasaID' && parabirimi='$parabirimi' ")->fetch_array();	
			$giderbak 		= $mysqli->query("select sum(cikis) as gider from kasa where kasaID='$kasaID' && parabirimi='$parabirimi' ")->fetch_array();	
			$gelirr 		=  $gelirbak['gelir']; 
			$giderr 		=  $giderbak['gider']; 
			$sonucc 		=  number_format(($gelirr - $giderr), 2, ',', '.');  
			
			 
				echo '  <tr>
						<td>'.$pyaz['baslik'].' </td>
						
						<td>'.$sonucc.''.$pyaz['simge'].'</td>
					   
					</tr>';
			}
		
		?>                           
                                        
                                   
                                      
                                   
                                </table> 
                    </div>
                </div> 
			<?php  } ?>
			
			</div>
			
			
    <div class="row">
		
		 <div class="col-md-12 mb-12">
		 
	  
				
				
            <div class="col-md-12 mb-4">
			 
                 
<div class="card-header text-right bg-transparent">
	 
	
	<a href="?sy=gelir"><button type="button" class="btn btn-success btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-plus" ></i> </span>
		<span class="ul-btn__text">Gelir Ekle</span>
	</button>
	</a>	
	
	<a href="?sy=gider"><button type="button" class="btn btn-danger btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-minus" ></i> </span>
		<span class="ul-btn__text">Gider Ekle</span>
	</button>
	</a>
	
	<a href="?sy=transfer"><button type="button" class="btn btn-info btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-undo" ></i> </span>
		<span class="ul-btn__text">Transfer</span>
	</button>
	</a>
	
	 <a href="?sy=kasalar"><button type="button" class="btn btn-warning btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-asterisk" ></i> </span>
		<span class="ul-btn__text">Kasalar</span>
	</button>
	</a>
	
	
	<!-- 
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
			<table id=" " class="display table " >
				<thead>
					<tr> 
						<th>ID</th>
						  
						<th>Gelir </th> 
						<th>Gider</th> 
						<th>Açıklama</th> 
						<th>Kasa</th> 
						<th>Tarih</th>  
						 
						<th>İşlemler</th>
					</tr>
				</thead>
				<tbody>
            
		<?php 
		
		  $limit 		= 10;		
		  $sayfa 		= intval(@$_GET['sayfa']);
		  if(!$sayfa) $sayfa=1;
		  $satirsayisi 	= $mysqli->query("select id from kasa")->num_rows;
		  $toplamsayfa 	= ceil($satirsayisi/$limit); 
		  $baslangic  	= ($sayfa-1)*$limit;
		  $x			= 0;
  
  
			$bak = $mysqli->query("select * from  kasa order by id desc limit $baslangic,$limit  ");
				while($yaz = $bak->fetch_array()){
		  
			$parabirimi		= $yaz['parabirimi'];		
			$parayaz 		= $mysqli->query("select * from parabirimi where id='$parabirimi' ")->fetch_array();
			
			$kasaID			= $yaz['kasaID'];		
			$kasabak 		= $mysqli->query("select * from kasacesit where id='$kasaID' ")->fetch_array();
			
 if($yaz['giris']>0){ $gelir  =  '<span class="badge badge-success" style="font-size:12px;">'.$yaz['giris'].''.$parayaz['simge'].'</span>'; $duz ='gelir';  } else { $gelir=''; } 
 if($yaz['cikis']>0){ $gider  =  '<span class="badge badge-danger" style="font-size:12px;">'.$yaz['cikis'].''.$parayaz['simge'].'</span>'; $duz ='gider'; } else { $gider=''; }
				echo '  <tr>
			 
				<td>'.$yaz['id'].'</td>
		  
				<td> '.$gelir.'  </td>
				<td> '.$gider.'  </td> 
			  
				<td>'.$yaz['aciklama'].' </td> 
				<td> <a href="?sy=kasabak&id='.$kasabak['id'].'" title ="Kasaya Git "> '.$kasabak['baslik'].' </a> </td>
				<td>'.substr($yaz['tarih'],0,10).' </td> 
			 
				 
		 <td>
		 
	<a href="?sy='.$duz.'duzenle&id='.$yaz['id'].'" class="ul-link-action text-success"  data-toggle="tooltip" data-placement="top" title="Düzenle"><i class="i-Edit"></i></a>
					
		<a href="?sy='.$konu.'sil&id='.$yaz['id'].'" class="ul-link-action text-danger mr-1"  data-toggle="tooltip" data-placement="top" title="Sil" onclick=" if ( !confirm(\'Kaydi silmek istediğinizden emin misiniz?\') ) return false;">
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
	 
		echo ' <li class="paginate_button page-item previous" id="ul-contact-list_previous"><a href="?sy=kasa&sayfa='.($sayfa-1).'" aria-controls="ul-contact-list" data-dt-idx="0" tabindex="0" class="page-link">Önceki</a></li> '; 
	}
	for ($y= $sayfa - $forlimit ; $y<= $sayfa + $forlimit + 1 ; $y++){
	
	if($y >0 && $y <=  $toplamsayfa ){
		if($y == $sayfa){
			
	 echo ' <li class="paginate_button page-item active"><a href="#" aria-controls="ul-contact-list" data-dt-idx="1" tabindex="0" class="page-link">'.$y.'</a></li>   ';
		} else {
			echo '<li class="paginate_button page-item "><a href="?sy=kasa&sayfa='.$y.'" aria-controls="ul-contact-list" data-dt-idx="2" tabindex="0" class="page-link">'.$y.'</a></li> ';
		}
		
	}	
	} 	
	if($sayfa != $toplamsayfa ){		
		
		echo '<li class="paginate_button page-item "><a href="?sy=kasa&sayfa='.($sayfa+1).'" aria-controls="ul-contact-list" data-dt-idx="2" tabindex="0" class="page-link">Sonraki</a></li>  ';
		 
		
	}
}
	
	?>	
	 
	 </ul>
	 </div>
	 </div> 
		 	
					
		</div>
		 
		

		
	</div>
	

</div>
    </div>
	
 
	
	
</section> 
  </div>
				
 
