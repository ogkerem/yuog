<?php 
    defined('YUOG') OR exit('No direct script access allowed');

    function seo($getir){
        global $db;

        $query = @$db->escape($_GET['query']);
        $seo = @$db->get_row("SELECT * FROM seo WHERE query='{$query}'");
        if($db->num_rows>0){
            return $seo->$getir . ' | '.genel($getir);
        }else{
            if(!empty(genel($getir))){
                return genel($getir);
            }
            return lang('404_title');
        }

    }

	function temaurl($link){
		global $config;
		return $config['temaurl'].'/'.$link;
	}

    function base_url($link){

        if(!empty($link)){
            return APP_URL.$link;
        }else{
            return APP_URL;
        }

    }

    function lang($arg){
		global $db;
        $veri = $db->get_row("SELECT * FROM dilicerik WHERE dilID ='1' AND sabitID='{$arg}'");
        return $veri->icerik;
    }

    function genel($data){
        global $mysqli;
        $veri = $mysqli->query("SELECT * FROM ayarlar WHERE id ='1'")->fetch_array();
        return @$veri[$data];
    } 

    function bosluksil($data){
        return trim(str_replace(' ','',$data));
    }

    function tarihduzelt($data){
        $parcala = explode("/",$data);
		return $parcala[2].'-'.$parcala[0].'-'.$parcala[1];
		
    }
 
    function tduzyaz($data){
		$data1 	= substr($data,0,10);
        $parcala = explode("-",$data1);
		return $parcala[1].'/'.$parcala[2].'/'.$parcala[0];
		
    } 

    // Oluşturduğumuz URL'i Ping Servislerine Bildirir.
    function pingle( $pingurl, $pingtitle )
    {

        global $db;

        $ret="";
        
        @set_time_limit(0);
        $pingservisleri = $db->get_var("SELECT pingservisleri FROM ayarlar");
        $urls = explode("\n", fromDB($pingservisleri) );

            for( $i=0; $i<count($urls)-1; $i++)
            {
            
                $pingtype = "weblogUpdates.ping";
                $xmlrpc = xmlrpc_encode_request( $pingtype, array( $pingtitle, $pingurl ) );
                $pingurl = $urls[$i];
                preg_match( "@^(?:http://)?([^/]+)@i", $pingurl, $cikti );
                $pinghost = $cikti[1];
                $headers[] = "Host: ".$pinghost;
                $headers[] = "Content-type: text/xml";
                $headers[] = "User-Agent: LPS";
                $headers[] = "Content-length: ".strlen( $xmlrpc )."\r\n";
                $headers[] = $xmlrpc;
                $sckt = curl_init( );
                curl_setopt( $sckt, CURLOPT_URL, $pingurl );
                curl_setopt( $sckt, CURLOPT_RETURNTRANSFER, 1 );
                curl_setopt( $sckt, CURLOPT_CONNECTTIMEOUT, 4 );
                curl_setopt( $sckt, CURLOPT_HTTPHEADER, $headers );
                curl_setopt( $sckt, CURLOPT_CUSTOMREQUEST, "POST" );
                $html = curl_exec( $sckt );
                $sonuc = curl_getinfo( $sckt );
                $ret .= $pingurl."({$pingtype}): ";
                if ( $sonuc['http_code'] == 200 )
                {
                    $ret .= "<font style=\"color:green;\">".lang('ping_ok')."</font>";
                }
                else
                {
                    $ret .= "<font style=\"color:red;\">".lang('ping_no')."(".$sonuc['http_code'].")</font>";
                }
                $ret .= "<br>";
                curl_close( $sckt );
                unset( $headers );
                
                
                $pingtype = "weblogUpdates.extendedPing";
                $xmlrpc = xmlrpc_encode_request( $pingtype, array( $pingtitle, $pingurl ) );
                $pingurl = $urls[$i];
                preg_match( "@^(?:http://)?([^/]+)@i", $pingurl, $cikti );
                $pinghost = $cikti[1];
                $headers[] = "Host: ".$pinghost;
                $headers[] = "Content-type: text/xml";
                $headers[] = "User-Agent: LPS";
                $headers[] = "Content-length: ".strlen( $xmlrpc )."\r\n";
                $headers[] = $xmlrpc;
                $sckt = curl_init( );
                curl_setopt( $sckt, CURLOPT_URL, $pingurl );
                curl_setopt( $sckt, CURLOPT_RETURNTRANSFER, 1 );
                curl_setopt( $sckt, CURLOPT_CONNECTTIMEOUT, 4 );
                curl_setopt( $sckt, CURLOPT_HTTPHEADER, $headers );
                curl_setopt( $sckt, CURLOPT_CUSTOMREQUEST, "POST" );
                $html = curl_exec( $sckt );
                $sonuc = curl_getinfo( $sckt );
                $ret .= $pingurl."({$pingtype}): ";
                if ( $sonuc['http_code'] == 200 )
                {
                    $ret .= "<font style=\"color:green;\">".lang('ping_ok')."</font>";
                }
                else
                {
                    $ret .= "<font style=\"color:red;\">".lang('ping_no')."(".$sonuc['http_code'].")</font>";
                }
                $ret .= "<br>";
                curl_close( $sckt );
                unset( $headers );

            }
            return $ret;
    }

    function SendMail($type='mail',$eposta,$konu,$mesaj){
		global $config;
        require_once(dirname(__FILE__).'/PHPMailer/src/PHPMailer.php');
        require_once(dirname(__FILE__).'/PHPMailer/src/Exception.php');
        require_once(dirname(__FILE__).'/PHPMailer/src/SMTP.php');

        if($type=='mail'){

            $headers  = 'MIME-Version: 1.0' . "rn";
            $headers .= 'Content-type: text/html; charset=utf-8' . "rn";
            $headers .= 'From: '.genel('firma').' <'.genel('mail').'>' . "rn";
            $headers .= 'Reply-To: Yanit <'.genel('mail').'>' . "rn";
            $headers .= 'X-Mailer: PHP/' . phpversion() . "rn";
            // Mesaj satırları 70 karakteri geçmemelidir (PHP kuralı)..
            // $mesaj = wordwrap($mesaj, 70);
            if(is_array($eposta)){$eposta = $eposta[0];}
            if(@mail($eposta, $konu, $mesaj, $headers)){
                return true;
            }else{
                return false;
            }

        }elseif($type=='smtp'){
			set_time_limit(0);
            $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
            try {
                //Server settings
                $mail->SMTPDebug = $config['smtp_debug'];  // Enable verbose debug output
                $mail->isSMTP();                           // Set mailer to use SMTP
                $mail->Host       = gethostbyname(genel('mail_server'));  // Specify main and backup SMTP servers
                $mail->SMTPAuth   = true;                  // Enable SMTP authentication
                $mail->Username   = genel('mail_user');    // SMTP username
                $mail->Password   = genel('mail_passwd');  // SMTP password
                $mail->SMTPSecure = genel('mail_secure');  // Enable TLS encryption, `ssl` also accepted
                // $mail->SMTPAutoTLS = false;
                $mail->Port       = genel('mail_port');    // TCP port to connect to
                $mail->smtpConnect([
                    'ssl' => [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    ]
                ]);
                $mail->SetLanguage("tr", "phpmailer/language");

                //Recipients
                $mail->setFrom(genel('mail'), genel('firma'));
				
                if(!empty(genel('replymail'))){
					
                    $mail->addReplyTo(genel('replymail'), genel('firma'));
					
                }

                if(is_array($eposta)){

                    foreach($eposta as $posta){
						
                        $mail->addAddress($posta, $konu); // Add a recipient
						
                    }

                }else{
					
                    $mail->addAddress($eposta, $konu); // Add a recipient
					
                }
				
				$mail->AddCC(genel('mail'));
                // Content
                $mail->isHTML(true); // Set email format to HTML
                $mail->Subject = $konu;
                $mail->Body    = $mesaj;
                $mail->AltBody = '';

                $mail->send();
                return true;
            } catch (Exception $e) {
                return false;
            }
        }


    }
	
	function turkcetarih($f, $zt = 'now'){
		$z = date("$f", strtotime($zt));
		$donustur = array(
			'Monday'	=> 'Pazartesi',
			'Tuesday'	=> 'Salı',
			'Wednesday'	=> 'Çarşamba',
			'Thursday'	=> 'Perşembe',
			'Friday'	=> 'Cuma',
			'Saturday'	=> 'Cumartesi',
			'Sunday'	=> 'Pazar',
			'January'	=> 'Ocak',
			'February'	=> 'Şubat',
			'March'		=> 'Mart',
			'April'		=> 'Nisan',
			'May'		=> 'Mayıs',
			'June'		=> 'Haziran',
			'July'		=> 'Temmuz',
			'August'	=> 'Ağustos',
			'September'	=> 'Eylül',
			'October'	=> 'Ekim',
			'November'	=> 'Kasım',
			'December'	=> 'Aralık',
			'Mon'		=> 'Pts',
			'Tue'		=> 'Sal',
			'Wed'		=> 'Çar',
			'Thu'		=> 'Per',
			'Fri'		=> 'Cum',
			'Sat'		=> 'Cts',
			'Sun'		=> 'Paz',
			'Jan'		=> 'Oca',
			'Feb'		=> 'Şub',
			'Mar'		=> 'Mar',
			'Apr'		=> 'Nis',
			'Jun'		=> 'Haz',
			'Jul'		=> 'Tem',
			'Aug'		=> 'Ağu',
			'Sep'		=> 'Eyl',
			'Oct'		=> 'Eki',
			'Nov'		=> 'Kas',
			'Dec'		=> 'Ara',
		);
		foreach($donustur as $en => $tr){
			$z = str_replace($en, $tr, $z);
		}
		if(strpos($z, 'Mayıs') !== false && strpos($f, 'F') === false) $z = str_replace('Mayıs', 'May', $z);
		return $z;
	}
	
	function sef($s) {
        $tr = array('ş', 'Ş', 'ı', 'İ', 'ğ', 'Ğ', 'ü', 'Ü', 'ö', 'Ö', 'Ç', 'ç', '&');
        $eng = array('s', 's', 'i', 'i', 'g', 'g', 'u', 'u', 'o', 'o', 'c', 'c', '');
        $s = str_replace($tr, $eng, $s);
        $s = strtolower($s);
        $s = preg_replace('/&.+?;/', '', $s);
        $s = preg_replace('/[^%a-z0-9 _-]/', '', $s);
        $s = preg_replace('/\s+/', '-', $s);
        $s = preg_replace('|-+|', '-', $s);
        $s = trim($s, '-');
        return $s;
    }
	
	function makedir($dizinler){

		$dizinler = explode('/',$dizinler);
		$dizin_sayi = count($dizinler);

		for($x = 0 ; $x < $dizin_sayi; $x++){
			for($i = 0; $i <= $x; $i++){
			   ($i !== 0)? @$olustur .= '/'.$dizinler[$i] : @$olustur .= $dizinler[$i];
			}

			if(!is_dir($olustur)) @mkdir($olustur);
			 @$olustur ='';
		}
		return true;  
	}
	
	
	
function kucult ($rhedef,$resimsonad){
	
			// include("../inc/config.php"); 
			  
			// $title1  	= $mysqli->query("select * from ayarlar where id='1' ");
			// $title 		= $title1->fetch_array(); 
	
			$resim 		= $rhedef.$resimsonad;
			$rad		= 'mini-'.$resimsonad;
			$yukle 		= copy($resim,$rhedef.$rad); 
				  
			/* işlem yapılacak resim */
			$dosya = $rhedef.$rad; 
			
			/* küçültmek istediğimiz resmin şu anki boyutları */
			list($mevcutGenislik, $mevcutYukseklik, $resimtip) = getimagesize($dosya);
			 
			/* resmi ölçeklemek istediğimiz yükseklik ve genişlik */
			// $genislik = $title['kresim'];
			$genislik = '370';
			 
			/* resmin yeni genişliği buluyoruz */
			$yukseklik = round($mevcutYukseklik / ($mevcutGenislik / $genislik));
			 
			/* hedef ve kaynak resimlerini oluşturalım */
			$hedef = imagecreatetruecolor($genislik, $yukseklik);
			 
			if($resimtip==1){ 
				$kaynak = imagecreatefromgif($dosya);			
			} elseif($resimtip == 2){ 
				$kaynak = imagecreatefromjpeg($dosya);	
			} elseif($resimtip == 3){	  
				$kaynak = imagecreatefrompng($dosya);
			} 
			
			// Resmi boyutlandıralım
			imagecopyresampled($hedef, $kaynak, 0, 0, 0, 0, $genislik, $yukseklik, $mevcutGenislik, $mevcutYukseklik);
			
			$yenidosya 	= $rhedef.$rad;	
			 
			
			// Resmi çıktılayalım
			imagejpeg($hedef, $yenidosya, 100);
			 
			// ayrılan bellek miktarını temizleyelim
			imagedestroy($hedef);
}

// resim uzantı düzenleme

function uzantibul ($muzanti){
	$sonbes		= substr($muzanti,-5); 
	$resparca 	= explode(".", $sonbes);
	$suzanti 	= $resparca[1];
	return $suzanti; 
}

  
// resim uzantı düzenleme 
function res_uzanti($arkaresim){
	
		$amuzanti1			= substr($arkaresim,-6);
		$noktabul 			= explode(".",$amuzanti1);	
		$amuzanti			= '.'.$noktabul[1];

	return $amuzanti;
}

// resim adı düzenleme
function res_adi($arkaresim){
	 
		$noktabul 			= explode(".",$arkaresim);	
		$amuzanti			= '.'.$noktabul[0];

	return $amuzanti;
}

 
function yeniurl($gelenurl){
	
	
	
	$al1 	= str_replace("Б","b",$gelenurl);
	$al2 	= str_replace("б","b",$al1);
	$al3 	= str_replace("Г","g",$al2);
	$al4 	= str_replace("г","g",$al3);
	$al5 	= str_replace("Д","d",$al4);
	$al6 	= str_replace("д","d",$al5);
	$al7 	= str_replace("Ё","o",$al6);
	$al8 	= str_replace("ё","o",$al7);
	$al9 	= str_replace("Ж","j",$al8);
	$al10 	= str_replace("ж","j",$al9);
	$al11	= str_replace("З","z",$al10);
	$al12 	= str_replace("з","z",$al11);
	$al13 	= str_replace("И","i",$al12);
	$al14 	= str_replace("и","i",$al13);
	$al15 	= str_replace("Й","y",$al14);
	$al16 	= str_replace("й","y",$al15);
	$al17 	= str_replace("Л","l",$al16);
	$al18 	= str_replace("л","l",$al17);
	$al19 	= str_replace("П","p",$al18);
	$al20 	= str_replace("п","p",$al19);
	$al21 	= str_replace("Ф","f",$al20);
	$al22 	= str_replace("ф","f",$al21);
	$al23 	= str_replace("Х","kh",$al22);
	$al24 	= str_replace("х","kh",$al23);
	$al25 	= str_replace("Ц","ts",$al24);
	$al26 	= str_replace("ц","ts",$al25);
	$al27 	= str_replace("Ч","c",$al26);
	$al28 	= str_replace("ч","c",$al27);
	$al29 	= str_replace("Ш","s",$al28);
	$al30 	= str_replace("ш","s",$al29);
	$al31 	= str_replace("Щ","sca",$al30);
	$al32 	= str_replace("Щ","sca",$al31);
	$al33 	= str_replace("Ъ","-",$al32);
	$al34 	= str_replace("ъ","-",$al33);
	$al35 	= str_replace("Ы","i",$al34);
	$al36 	= str_replace("ы","i",$al35);
	$al37 	= str_replace("Ь","-",$al36);
	$al38 	= str_replace("ь","-",$al37);
	$al39 	= str_replace("Э","e",$al38);
	$al40 	= str_replace("э","e",$al39);
	$al41 	= str_replace("Ю","yu",$al40);
	$al42 	= str_replace("ю","yu",$al41);
	$al43 	= str_replace("Я","ya",$al42);
	$al44 	= str_replace("В","v",$al43);
	$al45 	= str_replace("Н","n",$al44);
	$al46 	= str_replace("н","n",$al45);
	$al47 	= str_replace("Р","r",$al46);
	$al48 	= str_replace("р","r",$al47);
	$al49 	= str_replace("С","s",$al48);
	$al50 	= str_replace("с","s",$al49);
	$al51 	= str_replace("у","u",$al50);
	$al52 	= str_replace("Д д","d",$al51);
	 
	
	$url1 	= str_replace("?","",$al52);
	$url2 	= str_replace("!","",$url1);
	$url3 	= str_replace(",","-",$url2);
	$url4 	= str_replace("'","-",$url3);
	$url5 	= str_replace(".","-",$url4);
	$url6 	= str_replace("(","-",$url5);
	$url7 	= str_replace(")","-",$url6);
	$url8 	= str_replace(" ","-",$url7);
	$url9 	= str_replace("/","-",$url8);   
	$url10 	= str_replace("A","a",$url9);
	$url11 	= str_replace("B","b",$url10);
	$url12 	= str_replace("C","c",$url11);
	$url13 	= str_replace("Ç","c",$url12);
	$url14 	= str_replace("ç","c",$url13);
	$url15 	= str_replace("D","d",$url14);
	$url16 	= str_replace("E","e",$url15);
	$url17 	= str_replace("F","f",$url16);
	$url18 	= str_replace("G","g",$url17);
	$url19 	= str_replace("Ğ","g",$url18);
	$url20 	= str_replace("ğ","g",$url19);
	$url21 	= str_replace("H","h",$url20);
	$url22 	= str_replace("İ","i",$url21);
	$url23 	= str_replace("I","i",$url22);
	$url24 	= str_replace("ı","i",$url23);
	$url25 	= str_replace("J","j",$url24);
	$url26 	= str_replace("K","k",$url25);
	$url27 	= str_replace("L","l",$url26);
	$url28 	= str_replace("M","m",$url27);
	$url29 	= str_replace("N","n",$url28);
	$url30 	= str_replace("O","o",$url29);
	$url31 	= str_replace("Ö","o",$url30);
	$url32 	= str_replace("ö","o",$url31);
	$url33 	= str_replace("P","p",$url32);
	$url34 	= str_replace("R","r",$url33);
	$url35 	= str_replace("S","s",$url34);
	$url36 	= str_replace("Ş","s",$url35);
	$url37 	= str_replace("ş","s",$url36);
	$url38 	= str_replace("T","t",$url37);
	$url39 	= str_replace("U","u",$url38);
	$url40 	= str_replace("Ü","u",$url39);
	$url41 	= str_replace("ü","u",$url40);
	$url42 	= str_replace("V","v",$url41);
	$url43 	= str_replace("Y","y",$url42);
	$url44 	= str_replace("Z","z",$url43);
	$url45 	= str_replace("X","x",$url44);
	$url46 	= str_replace("Q","q",$url45);
	$url47 	= str_replace("W","w",$url46);
	$url48 	= str_replace("&","-",$url47);
	$url49 	= str_replace(":","-",$url48);
	$url50 	= str_replace("+","",$url49);
	$url51 	= str_replace("--","-",$url50);
	$url52 	= str_replace("’","-",$url51);
	$url53 	= str_replace("…","",$url52);
  
	return $url53;
} 
