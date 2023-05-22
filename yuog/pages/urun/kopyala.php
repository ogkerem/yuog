	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	$konu 	= "urun"; 
	$kat 	= $konu.'kat';
	$id 	= $_GET['id'];
	
	$yaz 	= $mysqli->query("select * from urun where id='$id' ")->fetch_array();
	
	$kodu		= $yaz['kodu'];
	$iconID		= $yaz['iconID'];
	$fiyat		= $yaz['fiyat'];
	$marka		= $yaz['marka'];
	$katID		= $yaz['katID'];
	$ustkatID	= $yaz['ustkatID'];
	$baslik		= addslashes($yaz['baslik']);
	$onyazi		= addslashes($yaz['onyazi']);
	$icerik		= addslashes($yaz['icerik']);
	$teknik		= addslashes($yaz['teknik']);
	$keywords	= addslashes($yaz['keywords']);
	$description	= addslashes($yaz['description']);
	$kresim			= rand(0,99999).'-'.$yaz['kresim'];
	$resim			= rand(0,99999).'-'.$yaz['resim'];
	$ustresim		= rand(0,99999).'-'.$yaz['ustresim'];
	$pdf			= rand(0,99999).'-'.$yaz['pdf'];
	$icon			= rand(0,99999).'-'.$yaz['icon'];
	$vbaslik		= $yaz['vbaslik'];
	$vaciklama		= $yaz['vaciklama'];
	$vlink			= $yaz['vlink'];
	$vresim			= rand(0,99999).'-'.$yaz['vresim'];
	$ibaslik		= $yaz['ibaslik'];
	$iicerik		= $yaz['iicerik'];
	  
	$seo			= $yaz['seo'];
	$sira			= $yaz['sira'];
	$dil			= $yaz['dil'];
	$hit			= 1;
	
	$ekleyen			= $email;  
	$ip					= $_SERVER['REMOTE_ADDR']; 
	
	$seobul 		= $mysqli->query("select * from seo where id='$seo' ")->fetch_array();
	$sonurl			= $seobul['seo'].'-'.rand(0,999999);
	$seoekle 		= $mysqli->query("insert into seo (seo,konu, durum) values ('$sonurl', '$konu', '1')");	
	$seoID			= $mysqli->insert_id;
	 
	$gonder  	= $mysqli->query(" insert into $konu set 
	
	 
		fiyat 				='$fiyat', 
		kodu 				='$kodu', 
		iconID 				='$iconID', 
		katID 				='$katID', 
		marka 				='$marka', 
		ustkatID			='$ustkatID', 
		baslik 				='$baslik', 
		onyazi 				='$onyazi', 
		icerik 				='$icerik', 
		teknik 				='$teknik', 
		keywords 			='$keywords', 
		description			='$description', 
		kresim				='$kresim', 
		resim				='$resim', 		
		ustresim			= '$ustresim',	
	 
		vbaslik				= '$vbaslik',	
		vaciklama			= '$vaciklama',	
		 
	 
		vlink				= '$vlink',
		vresim				= '$vsonad',
  
		pdf					= '$pdf',	
		ip					='$ip', 
		tarih				= now(),
		ekleyen				= '$ekleyen',
		seo					= '$seoID',
		hit					= '$hit',
		sira				= '$sira',
		dil					= '$dil',
		anasayfa			= '$anasayfa', 		
		durum				= '0' 
	 
	  ");
		
		
		
		$eskikresim 	= "../uploads/".$yaz['kresim'];
		$eskiresim		= "../uploads/".$yaz['resim'];   
		$eskiustresim	= "../uploads/".$yaz['ustresim'];	   
		$yenivresim		= "../uploads/".$yaz['vresim'];     
	 
		$kresimyeni 	= copy($eskikresim,"../uploads/".$kresim);
		$resimyeni 		= copy($eskiresim,"../uploads/".$resim);
		$ustresimyeni 	= copy($eskiustresim,"../uploads/".$ustresim);
		$vresimyeni 	= copy($yenivresim,"../uploads/".$vresim);
		
		
		$icerikID	= $mysqli->insert_id; 
		
		$akbak = $mysqli->query("select * from urunaksesuar where urunID='$id' ");
			while($akyaz = $akbak->fetch_array()){
				
				$baslik		= addslashes($akyaz['baslik']);
				$dosya		= rand(0,9999).'-'.$akyaz['dosya'];
				$onyazi		= addslashes($akyaz['onyazi']);			 
				$dil		= $akyaz['dil'];
				$sira		= $akyaz['sira'];
			     
				$eskidosya 	= "../uploads/".$akyaz['dosya'];
				$dosyayeni = copy($eskidosya,"../uploads/".$dosya);
		
$eklee = $mysqli->query("insert into urunaksesuar (urunID, baslik, dosya, onyazi , dil, sira ) values ('$icerikID', '$baslik', '$dosya', '$onyazi',  '$dil', '$sira'   ) "); 	
				
			}
			
		$udokbak = $mysqli->query("select * from urundokuman where urunID='$id' ");
			while($urundokyaz = $udokbak->fetch_array()){
				
				$baslik		= addslashes($urundokyaz['baslik']);
				$dosya		= rand(0,9999).'-'.$urundokyaz['dosya'];
			 		 
				$dil		= $urundokyaz['dil'];
				$sira		= $urundokyaz['sira'];
				
				$eskidosya 	= "../uploads/".$urundokyaz['dosya'];
				$dosyayeni = copy($eskidosya,"../uploads/".$dosya);
				
				
$eklee = $mysqli->query("insert into urundokuman (urunID, baslik, dosya, dil, sira ) values ('$icerikID', '$baslik', '$dosya',  '$dil', '$sira'   ) "); 	
				
			}
		
 	$benbak = $mysqli->query("select * from urunbenzer where urunID='$id' ");
			while($benyaz = $benbak->fetch_array()){
				
				$benzerID	= $benyaz['benzerID'];
		  
$eklee = $mysqli->query("insert into urunbenzer (urunID, benzerID ) values ('$icerikID', '$benzerID'  ) "); 	
				
			}
		
  
 	$gazbak = $mysqli->query("select * from urungaz where urunID='$id' ");
			while($gazyaz = $gazbak->fetch_array()){
				
				$gazID	= $gazyaz['gazID'];
		  
$eklee = $mysqli->query("insert into urungaz (urunID, gazID ) values ('$icerikID', '$gazID'  ) "); 	
				
			}
		
 
 	$ozellikbak = $mysqli->query("select * from urunozelliksec where urunID='$id' ");
			while($ozellikyaz = $ozellikbak->fetch_array()){
				
				$ozellikID	= addslashes($ozellikyaz['ozellikID']);
				$icerik		= addslashes($ozellikyaz['icerik']);
				$sira1		= $ozellikyaz['sira'];
		  
	$eklee = $mysqli->query("insert into urunozelliksec (urunID, ozellikID, icerik , sira ) values ('$icerikID', '$ozellikID', '$icerik' , '$sira1'  ) "); 	
				
			}
			
 	$videobak = $mysqli->query("select * from urunvideo where urunID='$id' ");
			while($videoyaz = $videobak->fetch_array()){
				
				$baslik		= addslashes($videoyaz['baslik']);
				$onyazi		= addslashes($videoyaz['onyazi']);
				$video		= $videoyaz['video'];
				$dil		= $videoyaz['dil'];
				$sira		= $videoyaz['sira'];
		 	
$eklee = $mysqli->query("insert into urunvideo (urunID, baslik, onyazi, video ,dil, sira  ) values ('$icerikID', '$baslik', '$onyazi', '$video', '$dil' , '$sira'  ) "); 	
				
			}		

			
 	$iconbak = $mysqli->query("select * from galeri where icerikID='$id' && konu='icon' ");
			while($iconyaz = $iconbak->fetch_array()){
				
				$baslik		= addslashes($iconyaz['baslik']);
				$resim		= rand(0,99999).'-'.$iconyaz['resim'];
				$sira		= $iconyaz['sira'];
				$durum		= $iconyaz['durum'];
			  
						
				$eskidosya 	= "../uploads/".$iconyaz['resim'];
				$dosyayeni = copy($eskidosya,"../uploads/".$resim);
				
				
$eklee = $mysqli->query("insert into galeri (icerikID, konu,  baslik, resim, sira ,durum ) values ('$icerikID', 'icon','$baslik', '$resim', '$sira', '$durum' ) "); 	
				
			}
					
 	$iconbak = $mysqli->query("select * from galeri where icerikID='$id' && konu='$konu' ");
			while($iconyaz = $iconbak->fetch_array()){
				
				$baslik		= addslashes($iconyaz['baslik']);
				$resim		= rand(0,9999).'-'.$iconyaz['resim'];
				$sira		= $iconyaz['sira'];
				$durum		= $iconyaz['durum'];
			  		
				$eskidosya 	= "../uploads/".$iconyaz['resim'];
				$dosyayeni = copy($eskidosya,"../uploads/".$resim);
				
				
				
$eklee = $mysqli->query("insert into galeri (icerikID, konu,  baslik, resim, sira ,durum ) values ('$icerikID', '$konu','$baslik', '$resim', '$sira', '$durum' ) "); 	
				
			}
		
	
	 header("Location:?sy=".$konu."&islem=basarili");	
	 
	?>
	
 
 
 
	
	
	