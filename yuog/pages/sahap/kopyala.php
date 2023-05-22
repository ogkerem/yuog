	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	$konu 	= "sahap";  
	$id 	= $_GET['id'];
	
	$yaz 	= $mysqli->query("select * from $konu where id='$id' ")->fetch_array();
	
	$baslik				= addslashes(trim($yaz['baslik']));	
	$kodu				= addslashes(trim($yaz['kodu']));
	$fiyat				= addslashes(trim($yaz['fiyat']));
	$kat1				= (int)$yaz['kat1'];
	$kat2				= (int)$yaz['kat2'];
	$kat3				= (int)$yaz['kat3'];	
	$renk				= addslashes(trim($yaz['renk']));
	$onyazi				= addslashes(trim($yaz['onyazi']));
	$icerik				= addslashes(trim($yaz['icerik']));
	$teknik				= addslashes(trim($yaz['teknik']));
	 
	$ustresimad			= $_FILES['ustresim']['name']; 
	$ustkaynak			= $_FILES['ustresim']['tmp_name']; 
	 
	$iconad				= $_FILES['icon']['name'];
	$iconkaynak			= $_FILES['icon']['tmp_name'];
	
	$marka				= (int)$yaz['marka'];
	 
	$resimad			= $_FILES['resim']['name']; 
	$kaynak				= $_FILES['resim']['tmp_name']; 	
	
	$rtopluad			= $_FILES['rtoplu']['name'];
	$rtoplukaynak		= $_FILES['rtoplu']['tmp_name'];
	$say 				= count($rtopluad);
	
	$keywords			= addslashes(trim($yaz['keywords']));
	$description		= addslashes(trim($yaz['description']));
	$etiket				= addslashes(trim($yaz['etiket']));
	 
	$yazar				= addslashes(trim($yaz['yazar']));
	$tarih				= $yaz['tarih'];
	  
	$vresimad			= $_FILES['vresim']['name']; 
	$vkaynak			= $_FILES['vresim']['tmp_name'];  
	$video				= addslashes(trim($yaz['video']));
	
	$videokod			= addslashes(trim($yaz['videokod']));
	
	$pdfad				= $_FILES['pdf']['name']; 
	$pdfkaynak			= $_FILES['pdf']['tmp_name']; 
	
	$dosyaad			= $_FILES['dosya']['name'];
	$dosyakaynak		= $_FILES['dosya']['tmp_name'];
	$dosyasay 			= count($dosyaad);
	
	$anasayfa			= $yaz['anasayfa']; 
	$sira				= (int)($yaz['sira']); 
	
	$son1				= addslashes(trim($yaz['son1']));
	$son2				= addslashes(trim($yaz['son2']));
	$son3				= addslashes(trim($yaz['son3']));
	 
	$ekleyen			= $email;  
	$ip					= $_SERVER['REMOTE_ADDR']; 
	
	
	if($resimad){ $resimsonad 		= rand(0,999).'-'.yeniurl(res_adi($resimad)).res_uzanti($resimad);
	$kresimsonad 		= 'mini-'.$resimsonad; }
	if($ustresimad){$ustresimsonad 	= rand(0,999).'-'.yeniurl(res_adi($ustresimad)).res_uzanti($ustresimad);}
	if($vresimad){$vsonad 			= rand(0,999).'-'.yeniurl(res_adi($vresimad)).res_uzanti($vresimad);}
	if($iconad){$iconsonad 			= rand(0,999).'-'.yeniurl(res_adi($iconad)).res_uzanti($iconad);}
	if($pdfad){$pdfsonad 			= rand(0,999).'-'.yeniurl(res_adi($pdfad)).res_uzanti($pdfad);}
		 
	$rhedef				= "../uploads/";
	 
	$yeniurlmiz =  $yaz['seourl'];
	
	$seosor		= $mysqli->query("select * from seo where seo='$yeniurlmiz' ");
	$seoyazz	= $seosor->fetch_array(); 
	$seosay 	= $seosor->num_rows;
		  
	if($seosay>0){
		$sonurl = rand(0,100).'-'.$yeniurlmiz;
	} else { 
		$sonurl = $yeniurlmiz;
	}
	
	$durum			= "on";
	$seoekle 		= $mysqli->query("insert into seo (seo,konu, durum) values ('$sonurl', '$konu', '$durum')");	
	$seoID			= $mysqli->insert_id;
	 
		
	$gonder  	= $mysqli->query(" insert into $konu set 
	  
		menu 				='$sistem', 
		baslik 				='$baslik', 
		onyazi 				='$onyazi', 
		ustresim 			='$ustresimsonad', 
		kodu 				='$kodu', 
		fiyat 				='$fiyat', 
		renk 				='$renk', 
		marka 				='$marka', 
		kat1 				='$kat1', 
		kat2 				='$kat2', 
		kat3 				='$kat3', 
		icon 				='$iconsonad', 
		resim 				='$resimsonad', 
		kresim 				='$kresimsonad', 
		icerik1 			='$icerik', 
		teknik1 			='$teknik', 
		video 				='$video', 
		videoresim			='$vsonad', 
		videokod			='$videokod',   
		keywords 			='$keywords', 
		description			='$description', 
		tarih				='$tarih', 
		yazar				='$yazar', 
		pdf					='$pdfsonad', 
		seo					= '$seoID', 
		anasayfa			= '$anasayfa', 
		son1				= '$son1',
		son2				= '$son2',
		son3				= '$son3',
	  
		ip					='$ip', 
		 
		ekleyen				= '$ekleyen',
		otarih				= now(),
		
		hit					= '1',
		sira				= '$sira',
		dil					= '$dil',
	 	
		durum				= 'on' 
	 
	  ");   
	   
	   
	if($gonder){
		
		$icerikID	= $mysqli->insert_id;
		 
		$yukle 			= move_uploaded_file($kaynak,$rhedef."/".$resimsonad); 
		$yukle2 		= move_uploaded_file($ustkaynak,$rhedef."/".$ustresimsonad);
		$yukle3 		= move_uploaded_file($vkaynak,$rhedef."/".$vsonad);
		$yukle4			= move_uploaded_file($pdfkaynak,$rhedef."/".$pdfsonad);
		$yukle5			= move_uploaded_file($iconkaynak,$rhedef."/".$iconsonad);
		kucult($rhedef, $resimsonad);	
		  
		
		$ebakp = explode(",", $etiket);  
		$esay =  count($ebakp); 
		  	for($yy=0; $yy < $esay; $yy++){
			$etiket1  = $ebakp[$yy];
		$etiketekle = $mysqli->query ("insert into etiket (`menu`,`baslik`, `seo`, `konu`, `konuID` ) values ('$sistem' ,'$etiket1' , '$seoID' , 'sahap' , '$icerikID' ) "); 
				}	
		
		   if($rtopluad[0]!=""){ 
			for($x = 0; $x < $say; $x++){ 
				$rbaslik	= $rtopluad[$x];
				$rkaynak	= $rtoplukaynak[$x];		 
				$rsonadi 	= $x.'-'.yeniurl(res_adi($rbaslik)).res_uzanti($rbaslik);  
	//echo $rbaslik.'<br/>';
	$vyukle = $mysqli->query("insert into galeri (menu, icerikID, konu, baslik, resim, sira ,durum ) values('$sistem','$icerikID','sahap','$rbaslik','$rsonadi' ,  '0', 'on'   ) "); 
	$yukle 	= move_uploaded_file($rkaynak,$rhedef."/".$rsonadi);
		 // kucult($rhedef, $rsonadi);	
			} 
		   }
	  
	 
	 
		   if($dosyaad[0]!=""){
	   
	for($x = 0; $x < $dosyasay; $x++){
		 
		$pdfbaslik	= $dosyaad[$x];
		$pdfkaynak	= $dosyakaynak[$x];		 
		$pdfsonadi 	= rand(0,9999).'-'.yeniurl(res_adi($pdfbaslik)).res_uzanti($pdfbaslik);
				 
		 
	$vyukle = $mysqli->query("insert into dosya (menu, icerikID, konu, baslik, resim, sira ,durum ) values('$sistem','$icerikID','sahap','$pdfbaslik','$pdfsonadi' ,  '0', 'on'   ) "); 	
	$yukle 	= move_uploaded_file($pdfkaynak,$rhedef."/".$pdfsonadi);
		 // kucult($rhedef, $rsonadi);	
	  
			} 
			 
		   } 
	 
 	 header("Location:?sy=".$konu."&sistem=".$sistem."&islem=basarili");			
		 
	
  
	?> 