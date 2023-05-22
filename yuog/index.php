<?php
define('YUOG', TRUE);
ob_start();
session_start();
require_once("../inc/config.php");

if (@$_SESSION['admin']['login'] == false) {
	require_once("login.php");
	die;
}

$email = $_SESSION['admin']['mail'];
require_once("../inc/functions.php");
require_once("header.php");
require_once("menu.php");
require_once("seourl.php");


function kdvDahil($tutar, $oran)
{
	$kdv = $tutar * $oran / 100;
	$toplam = $tutar + $kdv;
	return $toplam;
}
?>

<div class="main-content-wrap sidenav-open d-flex flex-column">

	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

	<script type="text/javascript">
		$(function() {

			$("input[name=baslik]").change(function() {
				var baslik = $("input[name=baslik]").val();
				$("input[name=keywords]").val(baslik);
				$("input[name=description]").val(baslik);
				$("input[name=etiket]").val(baslik);

				$.ajax({
					url: "seourl.php",
					type: "POST",
					data: {
						"baslik": baslik
					},
					success: function(altkat) {
						$("#seourl").val(altkat);
					}
				});
			});
		});
	</script>


	<?php

	$sy = trim(@$_GET['sy']);

	/*if(file_exists(dirname(__FILE__).'/module/'.$sy.'.php')){
			require_once(dirname(__FILE__).'/module/'.$sy.'.php');
		} else {
			require_once(dirname(__FILE__).'/sections/home.php');
		}*/


	switch ($sy) {


		default:
			include("home.php");
			break;

			//  ayarlar	
		case "genel":
			include("pages/genel/genel.php");
			break;

		case "social":
			include("pages/genel/social.php");
			break;

		case "parabirimi":
			include("pages/genel/parabirimi.php");
			break;

		case "kdv":
			include("pages/genel/kdv.php");
			break;

		case "sayar":
			include("pages/genel/sayar.php");
			break;


		case "analytic":
			include("pages/genel/analytic.php");
			break;

		case "kvkk":
			include("pages/genel/kvkk.php");
			break;

		case "popup":
			include("pages/genel/popup.php");
			break;



			// siparisler  

		case "siparis":
			include("pages/siparis/sahap.php");
			break;

		case "siparisekle":
			include("pages/siparis/ekle.php");
			break;

		case "siparisduzenle":
			include("pages/siparis/duzenle.php");
			break;


		case "siparissil":
			include("pages/siparis/sil.php");
			break;

		case "siparisdurum":
			include("pages/siparis/siparisdurum.php");
			break;



			//  kasa	
		case "kasa":
			include("pages/kasa/sahap.php");
			break;

		case "kasabak":
			include("pages/kasa/kasabak.php");
			break;

		case "kasalar":
			include("pages/kasa/kasalar.php");
			break;

		case "gelir":
			include("pages/kasa/gelir.php");
			break;

		case "gelirduzenle":
			include("pages/kasa/gelirduzenle.php");
			break;

		case "gider":
			include("pages/kasa/gider.php");
			break;

		case "transfer":
			include("pages/kasa/transfer.php");
			break;

		case "giderduzenle":
			include("pages/kasa/giderduzenle.php");
			break;

		case "kasaduzenle":
			include("pages/kasa/duzenle.php");
			break;

		case "kasasil":
			include("pages/kasa/sil.php");
			break;


			//  cari	
		case "cari":
			include("pages/cari/sahap.php");
			break;

		case "butun":
			include("pages/cari/butun.php");
			break;

		case "cariodemeekle":
			include("pages/cari/cariodemeekle.php");
			break;

		case "cariodemeduzenle":
			include("pages/cari/odemeduzenle.php");
			break;

		case "cariodemeyap":
			include("pages/cari/odemeyap.php");
			break;

		case "cariodemeal":
			include("pages/cari/odemeal.php");
			break;

		case "cariayrinti":
			include("pages/cari/ayrinti.php");
			break;

		case "cariayrintiduzenle":
			include("pages/cari/ayrintiduzenle.php");
			break;

		case "cariayrintisil":
			include("pages/cari/ayrintisil.php");
			break;

		case "cariekle":
			include("pages/cari/ekle.php");
			break;

		case "cariduzenle":
			include("pages/cari/duzenle.php");
			break;

		case "carisil":
			include("pages/cari/sil.php");
			break;

		case "carihizmetekle":
			include("pages/cari/hizmetekle.php");
			break;

		case "carihizmetduzenle":
			include("pages/cari/hizmetduzenle.php");
			break;

		case "carihizmetsil":
			include("pages/cari/hizmetsil.php");
			break;

		case "cariayrintilar":
			include("pages/cari/cariayrintilar.php");
			break;

		case "cariayrintilarduzenle":
			include("pages/cari/cariayrintilarduzenle.php");
			break;

		case "cariayrintilarsil":
			include("pages/cari/cariayrintilarsil.php");
			break;




			// case "iletisim":
			// include ("pages/genel/iletisim.php");
			// break;

		case "map":
			include("pages/genel/map.php");
			break;


		case "xml":
			include("pages/xml/sahap.php");
			break;

		case "xmlcalistir":
			include("pages/xml/calistir.php");
			break;

			//  sistem	
		case "sistem":
			include("pages/sistem/sahap.php");
			break;

		case "sistemekle":
			include("pages/sistem/ekle.php");
			break;

		case "sistemduzenle":
			include("pages/sistem/duzenle.php");
			break;

		case "sistemsil":
			include("pages/sistem/sil.php");
			break;
			break;

		case "bannerduzen":
			include("pages/sistem/bannerduzen.php");
			break;
			break;

		case "anasayfa":
			include("pages/sistem/anasayfa.php");
			break;
			break;

		case "anasayfaekle":
			include("pages/sistem/anasayfaekle.php");
			break;
			break;

		case "anasayfaduzenle":
			include("pages/sistem/anasayfaduzenle.php");
			break;
			break;

		case "anasayfasil":
			include("pages/sistem/anasayfasil.php");
			break;
			break;


			//  sahap	
		case "sahap":
			include("pages/sahap/sahap.php");
			break;

		case "sahapekle":
			include("pages/sahap/ekle.php");
			break;

		case "sahapduzenle":
			include("pages/sahap/duzenle.php");
			break;

		case "sahapkopyala":
			include("pages/sahap/kopyala.php");
			break;

		case "sahapsil":
			include("pages/sahap/sil.php");
			break;

		case "sahapkat":
			include("pages/sahap/kat.php");
			break;

		case "sahapkatekle":
			include("pages/sahap/katekle.php");
			break;

		case "sahapkatduzenle":
			include("pages/sahap/katduzenle.php");
			break;

		case "sahapkatsil":
			include("pages/sahap/katsil.php");
			break;

		case "sahapmarka":
			include("pages/sahap/sahapmarka.php");
			break;

		case "sahapozellik":
			include("pages/sahap/ozellik.php");
			break;

		case "sahapdokuman":
			include("pages/sahap/dokuman.php");
			break;

		case "sahapsartname":
			include("pages/sahap/sartname.php");
			break;

		case "sahapaksesuar":
			include("pages/sahap/aksesuar.php");
			break;

		case "sahapvideo":
			include("pages/sahap/sahapvideo.php");
			break;

		case "sahapdokumankat":
			include("pages/sahap/dokumankat.php");
			break;

		case "sahapsartnamekat":
			include("pages/sahap/sartnamekat.php");
			break;

		case "sahapaksesuarkat":
			include("pages/sahap/aksesuarkat.php");
			break;

		case "sahapvideokat":
			include("pages/sahap/sahapvideokat.php");
			break;


			// kategori  

		case "kategori":
			include("pages/kategori/kat.php");
			break;

		case "kategoriekle":
			include("pages/kategori/katekle.php");
			break;

		case "kategoriduzenle":
			include("pages/kategori/katduzenle.php");
			break;

		case "kategorisil":
			include("pages/kategori/katsil.php");
			break;


			//  konum	
		case "anakonum":
			include("pages/konum/anakonum.php");
			break;

		case "konum":
			include("pages/konum/konum.php");
			break;

			// ana sayfa içerik 

		case "anaicerik":
			include("pages/anaicerik/sahap.php");
			break;

		case "anaicerikekle":
			include("pages/anaicerik/ekle.php");
			break;

		case "anaicerikduzenle":
			include("pages/anaicerik/duzenle.php");
			break;

		case "anaiceriksil":
			include("pages/anaicerik/sil.php");
			break;



		case "anaorta":
			include("pages/anaorta/sahap.php");
			break;

		case "anaortakle":
			include("pages/anaorta/ekle.php");
			break;

		case "anaortaduzenle":
			include("pages/anaorta/duzenle.php");
			break;

		case "anaortasil":
			include("pages/anaorta/sil.php");
			break;

			// destek  

		case "destek":
			include("pages/destek/sahap.php");
			break;

		case "destekekle":
			include("pages/destek/ekle.php");
			break;

		case "destekduzenle":
			include("pages/destek/duzenle.php");
			break;

		case "desteksil":
			include("pages/destek/sil.php");
			break;

		case "destekkat":
			include("pages/destek/tekkat.php");
			break;

		case "destekarsiv":
			include("pages/destek/arsiv.php");
			break;

		case "destekdurum":
			include("pages/destek/durum.php");
			break;

			// sss  

		case "sss":
			include("pages/sss/sahap.php");
			break;

		case "sssekle":
			include("pages/sss/ekle.php");
			break;

		case "sssduzenle":
			include("pages/sss/duzenle.php");
			break;

		case "ssssil":
			include("pages/sss/sil.php");
			break;

		case "ssskat":
			include("pages/sss/tekkat.php");
			break;


			//ana sayfa video 

		case "avideo":
			include("pages/avideo/sahap.php");
			break;

		case "avideoekle":
			include("pages/avideo/ekle.php");
			break;

		case "avideoduzenle":
			include("pages/avideo/duzenle.php");
			break;

		case "avideosil":
			include("pages/avideo/sil.php");
			break;


			//iletisimler

		case "iletisim":
			include("pages/iletisim/sahap.php");
			break;


		case "iletisimduzenle":
			include("pages/iletisim/duzenle.php");
			break;

		case "iletisimsil":
			include("pages/iletisim/sil.php");
			break;


			// musteriler  

		case "musteriler":
			include("pages/musteriler/sahap.php");
			break;

		case "musterilerekle":
			include("pages/musteriler/ekle.php");
			break;

		case "musterilerduzenle":
			include("pages/musteriler/duzenle.php");
			break;

		case "musterilersil":
			include("pages/musteriler/sil.php");
			break;


			// basinkiti  

		case "basinkiti":
			include("pages/basinkiti/sahap.php");
			break;

		case "basinkitiekle":
			include("pages/basinkiti/ekle.php");
			break;

		case "basinkitiduzenle":
			include("pages/basinkiti/duzenle.php");
			break;

		case "basinkitisil":
			include("pages/basinkiti/sil.php");
			break;

			// etkinlik  	
		case "etkinlik":
			include("pages/etkinlik/sahap.php");
			break;

		case "etkinlikekle":
			include("pages/etkinlik/ekle.php");
			break;

		case "etkinlikduzenle":
			include("pages/etkinlik/duzenle.php");
			break;

		case "etkinliksil":
			include("pages/etkinlik/sil.php");
			break;

			// rgaleri  	
		case "rgaleri":
			include("pages/rgaleri/sahap.php");
			break;

		case "rgaleriekle":
			include("pages/rgaleri/ekle.php");
			break;

		case "rgaleriduzenle":
			include("pages/rgaleri/duzenle.php");
			break;

		case "rgalerisil":
			include("pages/rgaleri/sil.php");
			break;


			// katalog  	
		case "katalog":
			include("pages/katalog/sahap.php");
			break;

		case "katalogekle":
			include("pages/katalog/ekle.php");
			break;

		case "katalogduzenle":
			include("pages/katalog/duzenle.php");
			break;

		case "katalogsil":
			include("pages/katalog/sil.php");
			break;

			// basin  

		case "basin":
			include("pages/basin/sahap.php");
			break;

		case "basinekle":
			include("pages/basin/ekle.php");
			break;

		case "basinduzenle":
			include("pages/basin/duzenle.php");
			break;

		case "basinsil":
			include("pages/basin/sil.php");
			break;

			// Şubeler	
		case "sube":
			include("pages/sube/sahap.php");
			break;

		case "subeekle":
			include("pages/sube/ekle.php");
			break;

		case "subeduzenle":
			include("pages/sube/duzenle.php");
			break;

		case "subesil":
			include("pages/sube/sil.php");
			break;


			// enalt  
		case "enalt":
			include("pages/enalt/sahap.php");
			break;

		case "enaltekle":
			include("pages/enalt/ekle.php");
			break;

		case "enaltduzenle":
			include("pages/enalt/duzenle.php");
			break;

		case "enaltsil":
			include("pages/enalt/sil.php");
			break;


			//anaalt 		 
		case "anaalt":
			include("pages/anaalt/sahap.php");
			break;

		case "anaaltekle":
			include("pages/anaalt/ekle.php");
			break;

		case "anaaltduzenle":
			include("pages/anaalt/duzenle.php");
			break;

		case "anaaltsil":
			include("pages/anaalt/sil.php");
			break;


			//ssozlesme 		 
		case "ssozlesme":
			include("pages/genel/ssozlesme.php");
			break;

			//banka 		 
		case "banka":
			include("pages/genel/banka.php");
			break;


			//sozlesme 		 
		case "sozlesme":
			include("pages/sozlesme/sahap.php");
			break;

		case "sozlesmeekle":
			include("pages/sozlesme/ekle.php");
			break;

		case "sozlesmeduzenle":
			include("pages/sozlesme/duzenle.php");
			break;

		case "sozlesmesil":
			include("pages/sozlesme/sil.php");
			break;

			//marka 		 
		case "marka":
			include("pages/marka/sahap.php");
			break;

		case "markaekle":
			include("pages/marka/ekle.php");
			break;

		case "markaduzenle":
			include("pages/marka/duzenle.php");
			break;

		case "markasil":
			include("pages/marka/sil.php");
			break;



			// diller 
		case "diller":
			include("pages/diller/sahap.php");
			break;

		case "dilekle":
			include("pages/diller/ekle.php");
			break;

		case "dilduzenle":
			include("pages/diller/duzenle.php");
			break;

		case "dilsil":
			include("pages/diller/sil.php");
			break;

		case "dilicerik":
			include("pages/diller/dilicerik.php");
			break;

		case "dilsabit":
			include("pages/diller/dilsabit.php");
			break;

		case "dilkat":
			include("pages/diller/kat.php");
			break;


			// tasarım		
		case "tasarim":
			include("pages/tasarim/tasarim.php");
			break;

		case "tasarimduzenle":
			include("pages/tasarim/duzenle.php");
			break;

		case "tasarimekle":
			include("pages/tasarim/ekle.php");
			break;

		case "tasarimsil":
			include("pages/tasarim/sil.php");
			break;

			// baglanti		
		case "baglanti":
			include("pages/baglanti/sahap.php");
			break;


			//  adminler	
		case "admin":
			include("pages/admin/sahap.php");
			break;

		case "adminkat":
			include("pages/admin/kat.php");
			break;

		case "adminekle":
			include("pages/admin/ekle.php");
			break;

		case "adminduzenle":
			include("pages/admin/duzenle.php");
			break;

		case "adminsil":
			include("pages/admin/sil.php");
			break;

		case "adminlog":
			include("pages/admin/log.php");
			break;

			//  Banner	
		case "banner":
			include("pages/banner/sahap.php");
			break;

		case "bannerekle":
			include("pages/banner/ekle.php");
			break;

		case "bannerduzenle":
			include("pages/banner/duzenle.php");
			break;

		case "bannersil":
			include("pages/banner/sil.php");
			break;

			//  kurumsal	
		case "kurumsal":
			include("pages/kurumsal/sahap.php");
			break;

		case "kurumsalekle":
			include("pages/kurumsal/ekle.php");
			break;

		case "kurumsalduzenle":
			include("pages/kurumsal/duzenle.php");
			break;

		case "kurumsalsil":
			include("pages/kurumsal/sil.php");
			break;

		case "kurumsalkat":
			include("pages/kurumsal/kat.php");
			break;

		case "kurumsalkatekle":
			include("pages/kurumsal/katekle.php");
			break;

		case "kurumsalkatduzenle":
			include("pages/kurumsal/katduzenle.php");
			break;

		case "kurumsalkatsil":
			include("pages/kurumsal/katsil.php");
			break;


			//why  	
		case "why":
			include("pages/why/sahap.php");
			break;

		case "whyekle":
			include("pages/why/ekle.php");
			break;

		case "whyduzenle":
			include("pages/why/duzenle.php");
			break;

		case "whysil":
			include("pages/why/sil.php");
			break;

		case "whykat":
			include("pages/why/kat.php");
			break;

		case "whykatekle":
			include("pages/why/katekle.php");
			break;

		case "whykatduzenle":
			include("pages/why/katduzenle.php");
			break;

		case "whykatsil":
			include("pages/why/katsil.php");
			break;


			//tools  	
		case "tools":
			include("pages/tools/sahap.php");
			break;

		case "toolsekle":
			include("pages/tools/ekle.php");
			break;

		case "toolsduzenle":
			include("pages/tools/duzenle.php");
			break;

		case "toolssil":
			include("pages/tools/sil.php");
			break;

		case "toolskat":
			include("pages/tools/kat.php");
			break;

		case "toolskatekle":
			include("pages/tools/katekle.php");
			break;

		case "toolskatduzenle":
			include("pages/tools/katduzenle.php");
			break;

		case "toolskatsil":
			include("pages/tools/katsil.php");
			break;


			//commercial  	
		case "commercial":
			include("pages/commercial/sahap.php");
			break;

		case "commercialekle":
			include("pages/commercial/ekle.php");
			break;

		case "commercialduzenle":
			include("pages/commercial/duzenle.php");
			break;

		case "commercialsil":
			include("pages/commercial/sil.php");
			break;

		case "commercialkat":
			include("pages/commercial/kat.php");
			break;

		case "commercialkatekle":
			include("pages/commercial/katekle.php");
			break;

		case "commercialkatduzenle":
			include("pages/commercial/katduzenle.php");
			break;

		case "commercialkatsil":
			include("pages/commercial/katsil.php");
			break;

			//residential  	
		case "residential":
			include("pages/residential/sahap.php");
			break;

		case "residentialekle":
			include("pages/residential/ekle.php");
			break;

		case "residentialduzenle":
			include("pages/residential/duzenle.php");
			break;

		case "residentialsil":
			include("pages/residential/sil.php");
			break;

		case "residentialkat":
			include("pages/residential/kat.php");
			break;

		case "residentialkatekle":
			include("pages/residential/katekle.php");
			break;

		case "residentialkatduzenle":
			include("pages/residential/katduzenle.php");
			break;

		case "residentialkatsil":
			include("pages/residential/katsil.php");
			break;

			//industrial  	
		case "industrial":
			include("pages/industrial/sahap.php");
			break;

		case "industrialekle":
			include("pages/industrial/ekle.php");
			break;

		case "industrialduzenle":
			include("pages/industrial/duzenle.php");
			break;

		case "industrialsil":
			include("pages/industrial/sil.php");
			break;

		case "industrialkat":
			include("pages/industrial/kat.php");
			break;

		case "industrialkatekle":
			include("pages/industrial/katekle.php");
			break;

		case "industrialkatduzenle":
			include("pages/industrial/katduzenle.php");
			break;

		case "industrialkatsil":
			include("pages/industrial/katsil.php");
			break;

			//catalogue  	
		case "catalogue":
			include("pages/catalogue/sahap.php");
			break;

		case "catalogueekle":
			include("pages/catalogue/ekle.php");
			break;

		case "catalogueduzenle":
			include("pages/catalogue/duzenle.php");
			break;

		case "cataloguesil":
			include("pages/catalogue/sil.php");
			break;

		case "cataloguekat":
			include("pages/catalogue/kat.php");
			break;

		case "cataloguekatekle":
			include("pages/catalogue/katekle.php");
			break;

		case "cataloguekatduzenle":
			include("pages/catalogue/katduzenle.php");
			break;

		case "cataloguekatsil":
			include("pages/catalogue/katsil.php");
			break;

			//techinformation  	
		case "techinformation":
			include("pages/techinformation/sahap.php");
			break;

		case "techinformationekle":
			include("pages/techinformation/ekle.php");
			break;

		case "techinformationduzenle":
			include("pages/techinformation/duzenle.php");
			break;

		case "techinformationsil":
			include("pages/techinformation/sil.php");
			break;

		case "techinformationkat":
			include("pages/techinformation/kat.php");
			break;

		case "techinformationkatekle":
			include("pages/techinformation/katekle.php");
			break;

		case "techinformationkatduzenle":
			include("pages/techinformation/katduzenle.php");
			break;

		case "techinformationkatsil":
			include("pages/techinformation/katsil.php");
			break;

			//building  	
		case "building":
			include("pages/building/sahap.php");
			break;

		case "buildingekle":
			include("pages/building/ekle.php");
			break;

		case "buildingduzenle":
			include("pages/building/duzenle.php");
			break;

		case "buildingsil":
			include("pages/building/sil.php");
			break;

		case "buildingkat":
			include("pages/building/kat.php");
			break;

		case "buildingkatekle":
			include("pages/building/katekle.php");
			break;

		case "buildingkatduzenle":
			include("pages/building/katduzenle.php");
			break;

		case "buildingkatsil":
			include("pages/building/katsil.php");
			break;

			//multifamily  	
		case "multifamily":
			include("pages/multifamily/sahap.php");
			break;

		case "multifamilyekle":
			include("pages/multifamily/ekle.php");
			break;

		case "multifamilyduzenle":
			include("pages/multifamily/duzenle.php");
			break;

		case "multifamilysil":
			include("pages/multifamily/sil.php");
			break;

		case "multifamilykat":
			include("pages/multifamily/kat.php");
			break;

		case "multifamilykatekle":
			include("pages/multifamily/katekle.php");
			break;

		case "multifamilykatduzenle":
			include("pages/multifamily/katduzenle.php");
			break;

		case "multifamilykatsil":
			include("pages/multifamily/katsil.php");
			break;

			//  kariyer	
		case "kariyer":
			include("pages/kariyer/sahap.php");
			break;

		case "kariyerekle":
			include("pages/kariyer/ekle.php");
			break;

		case "kariyerduzenle":
			include("pages/kariyer/duzenle.php");
			break;

		case "kariyersil":
			include("pages/kariyer/sil.php");
			break;

			//  bolumler	
		case "bolumler":
			include("pages/bolumler/sahap.php");
			break;

		case "bolumlerekle":
			include("pages/bolumler/ekle.php");
			break;

		case "bolumlerduzenle":
			include("pages/bolumler/duzenle.php");
			break;

		case "bolumlersil":
			include("pages/bolumler/sil.php");
			break;

		case "bolumlerkat":
			include("pages/bolumler/kat.php");
			break;

		case "bolumlerkatekle":
			include("pages/bolumler/katekle.php");
			break;

		case "bolumlerkatduzenle":
			include("pages/bolumler/katduzenle.php");
			break;

		case "bolumlerkatsil":
			include("pages/bolumler/katsil.php");
			break;


			//  hazir	
		case "hazir":
			include("pages/hazir/sahap.php");
			break;

		case "hazirekle":
			include("pages/hazir/ekle.php");
			break;

		case "hazirduzenle":
			include("pages/hazir/duzenle.php");
			break;

		case "hazirsil":
			include("pages/hazir/sil.php");
			break;

		case "hazirkat":
			include("pages/hazir/kat.php");
			break;

		case "hazirkatekle":
			include("pages/hazir/katekle.php");
			break;

		case "hazirkatduzenle":
			include("pages/hazir/katduzenle.php");
			break;

		case "hazirkatsil":
			include("pages/hazir/katsil.php");
			break;


			//  hizmet	
		case "hizmet":
			include("pages/hizmet/sahap.php");
			break;

		case "hizmetekle":
			include("pages/hizmet/ekle.php");
			break;

		case "hizmetduzenle":
			include("pages/hizmet/duzenle.php");
			break;

		case "hizmetsil":
			include("pages/hizmet/sil.php");
			break;

		case "hizmetkat":
			include("pages/hizmet/kat.php");
			break;

		case "hizmetkatekle":
			include("pages/hizmet/katekle.php");
			break;

		case "hizmetkatduzenle":
			include("pages/hizmet/katduzenle.php");
			break;

		case "hizmetkatsil":
			include("pages/hizmet/katsil.php");
			break;

			//  egitimler	
		case "egitimler":
			include("pages/egitimler/sahap.php");
			break;

		case "egitimlerekle":
			include("pages/egitimler/ekle.php");
			break;

		case "egitimlerduzenle":
			include("pages/egitimler/duzenle.php");
			break;

		case "egitimlersil":
			include("pages/egitimler/sil.php");
			break;

		case "egitimlerkat":
			include("pages/egitimler/kat.php");
			break;

		case "egitimlerkatekle":
			include("pages/egitimler/katekle.php");
			break;

		case "egitimlerkatduzenle":
			include("pages/egitimler/katduzenle.php");
			break;

		case "egitimlerkatsil":
			include("pages/egitimler/katsil.php");
			break;


			//  akademi	
		case "akademi":
			include("pages/akademi/sahap.php");
			break;

		case "akademiekle":
			include("pages/akademi/ekle.php");
			break;

		case "akademiduzenle":
			include("pages/akademi/duzenle.php");
			break;

		case "akademisil":
			include("pages/akademi/sil.php");
			break;

		case "akademikat":
			include("pages/akademi/kat.php");
			break;

		case "akademikatekle":
			include("pages/akademi/katekle.php");
			break;

		case "akademikatduzenle":
			include("pages/akademi/katduzenle.php");
			break;

		case "akademikatsil":
			include("pages/akademi/katsil.php");
			break;


			//  gazlar	
		case "gazlar":
			include("pages/gazlar/sahap.php");
			break;

		case "gazlarekle":
			include("pages/gazlar/ekle.php");
			break;

		case "gazlarduzenle":
			include("pages/gazlar/duzenle.php");
			break;

		case "gazlarsil":
			include("pages/gazlar/sil.php");
			break;

		case "gazlarkat":
			include("pages/gazlar/kat.php");
			break;

		case "gazlarkatekle":
			include("pages/gazlar/katekle.php");
			break;

		case "gazlarkatduzenle":
			include("pages/gazlar/katduzenle.php");
			break;

		case "gazlarkatsil":
			include("pages/gazlar/katsil.php");
			break;


			//  kocluk	
		case "kocluk":
			include("pages/kocluk/sahap.php");
			break;

		case "koclukekle":
			include("pages/kocluk/ekle.php");
			break;

		case "koclukduzenle":
			include("pages/kocluk/duzenle.php");
			break;

		case "kocluksil":
			include("pages/kocluk/sil.php");
			break;

		case "koclukkat":
			include("pages/kocluk/kat.php");
			break;

		case "koclukkatekle":
			include("pages/kocluk/katekle.php");
			break;

		case "koclukkatduzenle":
			include("pages/kocluk/katduzenle.php");
			break;

		case "koclukkatsil":
			include("pages/kocluk/katsil.php");
			break;


			//  ekip	
		case "ekip":
			include("pages/ekip/sahap.php");
			break;

		case "ekipekle":
			include("pages/ekip/ekle.php");
			break;

		case "ekipduzenle":
			include("pages/ekip/duzenle.php");
			break;

		case "ekipsil":
			include("pages/ekip/sil.php");
			break;

		case "ekipkat":
			include("pages/ekip/kat.php");
			break;

		case "ekipkatekle":
			include("pages/ekip/katekle.php");
			break;

		case "ekipkatduzenle":
			include("pages/ekip/katduzenle.php");
			break;

		case "ekipkatsil":
			include("pages/ekip/katsil.php");
			break;

			//  uretim	
		case "uretim":
			include("pages/uretim/sahap.php");
			break;

		case "uretimekle":
			include("pages/uretim/ekle.php");
			break;

		case "uretimduzenle":
			include("pages/uretim/duzenle.php");
			break;

		case "uretimsil":
			include("pages/uretim/sil.php");
			break;

		case "uretimkat":
			include("pages/uretim/kat.php");
			break;

		case "uretimkatekle":
			include("pages/uretim/katekle.php");
			break;

		case "uretimkatduzenle":
			include("pages/uretim/katduzenle.php");
			break;

		case "uretimkatsil":
			include("pages/uretim/katsil.php");
			break;

			//  uygulama	
		case "uygulama":
			include("pages/uygulama/sahap.php");
			break;

		case "uygulamaekle":
			include("pages/uygulama/ekle.php");
			break;

		case "uygulamaduzenle":
			include("pages/uygulama/duzenle.php");
			break;

		case "uygulamasil":
			include("pages/uygulama/sil.php");
			break;

		case "uygulamakat":
			include("pages/uygulama/kat.php");
			break;

		case "uygulamakatekle":
			include("pages/uygulama/katekle.php");
			break;

		case "uygulamakatduzenle":
			include("pages/uygulama/katduzenle.php");
			break;

		case "uygulamakatsil":
			include("pages/uygulama/katsil.php");
			break;

		case "uygulamasektor":
			include("pages/uygulama/sektor.php");
			break;

			//  arge	
		case "arge":
			include("pages/arge/sahap.php");
			break;

		case "argeekle":
			include("pages/arge/ekle.php");
			break;

		case "argeduzenle":
			include("pages/arge/duzenle.php");
			break;

		case "argesil":
			include("pages/arge/sil.php");
			break;

		case "argekat":
			include("pages/arge/kat.php");
			break;

		case "argekatekle":
			include("pages/arge/katekle.php");
			break;

		case "argekatduzenle":
			include("pages/arge/katduzenle.php");
			break;

		case "argekatsil":
			include("pages/arge/katsil.php");
			break;

		case "sepet":
			include("pages/sepet/sahap.php");
			break;
		case "sepetduzenle":
			include("pages/sepet/duzenle.php");
			break;
		case "sepetsil":
			include("pages/sepet/sil.php");
			break;


			//urun test
		case "uruntest":
			include("pages/uruntest/sahap.php");
			break;

		case "urunekletest":
			include("pages/uruntest/ekle.php");
			break;

		case "urunduzenletest":
			include("pages/uruntest/duzenle.php");
			break;


			//  urun	
		case "urun":
			include("pages/urun/sahap.php");
			break;

		case "butunurun":
			include("pages/urun/butun.php");
			break;

		case "excel":
			include("pages/urun/excel.php");
			break;
		case "exceldeneme":
			include("pages/urun/exceldeneme.php");
			break;

		case "urunekle":
			include("pages/urun/ekle.php");
			break;


		case "bayiurunekle":
			include("pages/urun/bayiurunekle.php");
			break;

		case "urunduzenle":
			include("pages/urun/duzenle.php");
			break;

		case "urunkopyala":
			include("pages/urun/kopyala.php");
			break;

		case "urunsil":
			include("pages/urun/sil.php");
			break;

		case "urunkat":
			include("pages/urun/kat.php");
			break;

		case "urunkatekle":
			include("pages/urun/katekle.php");
			break;

		case "urunkatduzenle":
			include("pages/urun/katduzenle.php");
			break;

		case "urunkatsil":
			include("pages/urun/katsil.php");
			break;

		case "urunmarka":
			include("pages/urun/urunmarka.php");
			break;

		case "urunozellik":
			include("pages/urun/ozellik.php");
			break;

		case "urunrenk":
			include("pages/urun/renk.php");
			break;

		case "urundokuman":
			include("pages/urun/dokuman.php");
			break;

		case "urunsartname":
			include("pages/urun/sartname.php");
			break;

		case "urunaksesuar":
			include("pages/urun/aksesuar.php");
			break;

		case "urunvideo":
			include("pages/urun/urunvideo.php");
			break;

		case "urundokumankat":
			include("pages/urun/dokumankat.php");
			break;

		case "urunsartnamekat":
			include("pages/urun/sartnamekat.php");
			break;

		case "urunaksesuarkat":
			include("pages/urun/aksesuarkat.php");
			break;

		case "urunvideokat":
			include("pages/urun/urunvideokat.php");
			break;

			//  hosting	
		case "hosting":
			include("pages/hosting/sahap.php");
			break;

		case "hostingekle":
			include("pages/hosting/ekle.php");
			break;

		case "hostingduzenle":
			include("pages/hosting/duzenle.php");
			break;

		case "hostingsil":
			include("pages/hosting/sil.php");
			break;

		case "hostingkat":
			include("pages/hosting/kat.php");
			break;

		case "hostingkatekle":
			include("pages/hosting/katekle.php");
			break;

		case "hostingkatduzenle":
			include("pages/hosting/katduzenle.php");
			break;

		case "hostingkatsil":
			include("pages/hosting/katsil.php");
			break;

			//  sunucu	
		case "sunucu":
			include("pages/sunucu/sahap.php");
			break;

		case "sunucuekle":
			include("pages/sunucu/ekle.php");
			break;

		case "sunucuduzenle":
			include("pages/sunucu/duzenle.php");
			break;

		case "sunucusil":
			include("pages/sunucu/sil.php");
			break;

		case "sunucukat":
			include("pages/sunucu/kat.php");
			break;

		case "sunucukatekle":
			include("pages/sunucu/katekle.php");
			break;

		case "sunucukatduzenle":
			include("pages/sunucu/katduzenle.php");
			break;

		case "sunucukatsil":
			include("pages/sunucu/katsil.php");
			break;


			//  duyuru	
		case "duyuru":
			include("pages/duyuru/sahap.php");
			break;

		case "duyuruekle":
			include("pages/duyuru/ekle.php");
			break;

		case "duyuruduzenle":
			include("pages/duyuru/duzenle.php");
			break;

		case "duyurusil":
			include("pages/duyuru/sil.php");
			break;

			//  odul	
		case "odul":
			include("pages/odul/sahap.php");
			break;

		case "odulekle":
			include("pages/odul/ekle.php");
			break;

		case "odulduzenle":
			include("pages/odul/duzenle.php");
			break;

		case "odulsil":
			include("pages/odul/sil.php");
			break;

			// linkedin
		case "linkedin":
			include("pages/linkedin/sahap.php");
			break;

			//  dokuman	
		case "dokuman":
			include("pages/dokuman/sahap.php");
			break;

		case "dokumanekle":
			include("pages/dokuman/ekle.php");
			break;

		case "dokumanduzenle":
			include("pages/dokuman/duzenle.php");
			break;

		case "dokumansil":
			include("pages/dokuman/sil.php");
			break;


			//  bilgi	
		case "bilgi":
			include("pages/bilgi/sahap.php");
			break;

		case "bilgiekle":
			include("pages/bilgi/ekle.php");
			break;

		case "bilgiduzenle":
			include("pages/bilgi/duzenle.php");
			break;

		case "bilgisil":
			include("pages/bilgi/sil.php");
			break;

			//  proje	
		case "servis":
			include("pages/servis/sahap.php");
			break;

		case "servisekle":
			include("pages/servis/ekle.php");
			break;

		case "servisduzenle":
			include("pages/servis/duzenle.php");
			break;

		case "servissil":
			include("pages/servis/sil.php");
			break;

			//  falan	
		case "falan":
			include("pages/falan/sahap.php");
			break;

		case "falanekle":
			include("pages/falan/ekle.php");
			break;

		case "falanduzenle":
			include("pages/falan/duzenle.php");
			break;

		case "falansil":
			include("pages/falan/sil.php");
			break;

			//  blog	
		case "blog":
			include("pages/blog/sahap.php");
			break;

		case "blogekle":
			include("pages/blog/ekle.php");
			break;

		case "blogduzenle":
			include("pages/blog/duzenle.php");
			break;

		case "blogsil":
			include("pages/blog/sil.php");
			break;

		case "blogkat":
			include("pages/blog/kat.php");
			break;




			//  referans	
		case "referans":
			include("pages/referans/sahap.php");
			break;

		case "referansekle":
			include("pages/referans/ekle.php");
			break;

		case "referansduzenle":
			include("pages/referans/duzenle.php");
			break;

		case "referanssil":
			include("pages/referans/sil.php");
			break;

		case "referanskat":
			include("pages/referans/kat.php");
			break;



			//  esetler	
		case "esetler":
			include("pages/esetler/sahap.php");
			break;

		case "esetlerekle":
			include("pages/esetler/ekle.php");
			break;

		case "esetlerduzenle":
			include("pages/esetler/duzenle.php");
			break;

		case "esetlersil":
			include("pages/esetler/sil.php");
			break;

		case "esetlerkat":
			include("pages/esetler/kat.php");
			break;

		case "esetlerkatekle":
			include("pages/esetler/katekle.php");
			break;

		case "esetlerkatduzenle":
			include("pages/esetler/katduzenle.php");
			break;

		case "esetlerkatsil":
			include("pages/esetler/katsil.php");
			break;

			//  earaclar	
		case "earaclar":
			include("pages/earaclar/sahap.php");
			break;

		case "earaclarekle":
			include("pages/earaclar/ekle.php");
			break;

		case "earaclarduzenle":
			include("pages/earaclar/duzenle.php");
			break;

		case "earaclarsil":
			include("pages/earaclar/sil.php");
			break;

		case "earaclarkat":
			include("pages/earaclar/kat.php");
			break;

		case "earaclarkatekle":
			include("pages/earaclar/katekle.php");
			break;

		case "earaclarkatduzenle":
			include("pages/earaclar/katduzenle.php");
			break;

		case "earaclarkatsil":
			include("pages/earaclar/katsil.php");
			break;

			//  tset	
		case "tset":
			include("pages/tset/sahap.php");
			break;

		case "tsetekle":
			include("pages/tset/ekle.php");
			break;

		case "tsetduzenle":
			include("pages/tset/duzenle.php");
			break;

		case "tsetsil":
			include("pages/tset/sil.php");
			break;

		case "tsetkat":
			include("pages/tset/kat.php");
			break;

		case "tsetkatekle":
			include("pages/tset/katekle.php");
			break;

		case "tsetkatduzenle":
			include("pages/tset/katduzenle.php");
			break;

		case "tsetkatsil":
			include("pages/tset/katsil.php");
			break;


			//  esetgenel	
		case "esetgenel":
			include("pages/esetgenel/sahap.php");
			break;

		case "esetgenelekle":
			include("pages/esetgenel/ekle.php");
			break;

		case "esetgenelduzenle":
			include("pages/esetgenel/duzenle.php");
			break;

		case "esetgenelsil":
			include("pages/esetgenel/sil.php");
			break;

		case "esetgenelkat":
			include("pages/esetgenel/kat.php");
			break;


			//  video	
		case "video":
			include("pages/video/sahap.php");
			break;

		case "videoekle":
			include("pages/video/ekle.php");
			break;

		case "videoduzenle":
			include("pages/video/duzenle.php");
			break;

		case "videosil":
			include("pages/video/sil.php");
			break;

		case "videokat":
			include("pages/video/tekkat.php");
			break;

		case "videokatekle":
			include("pages/video/katekle.php");
			break;

		case "videokatduzenle":
			include("pages/video/katduzenle.php");
			break;

		case "videokatsil":
			include("pages/video/katsil.php");
			break;


			//  kupon	
		case "kupon":
			include("pages/kupon/sahap.php");
			break;

		case "kuponekle":
			include("pages/kupon/ekle.php");
			break;

		case "kuponduzenle":
			include("pages/kupon/duzenle.php");
			break;

		case "kuponsil":
			include("pages/kupon/sil.php");
			break;


			//  içerikler	
		case "icerik":
			include("pages/icerik/sahap.php");
			break;

		case "icerikekle":
			include("pages/icerik/ekle.php");
			break;

		case "icerikduzenle":
			include("pages/icerik/duzenle.php");
			break;

		case "iceriksil":
			include("pages/icerik/sil.php");
			break;

			//  contact	
		case "contact":
			include("pages/genel/iletisim.php");
			break;

			//  Tur işlemleri	
		case "turlar":
			include("pages/tur/sahap.php");
			break;

		case "turkat":
			include("pages/tur/kat.php");
			break;

		case "turortakat":
			include("pages/tur/ortakat.php");
			break;

		case "turaltkat":
			include("pages/tur/altkat.php");
			break;

		case "turkatekle":
			include("pages/tur/katekle.php");
			break;

		case "turkatduzenle":
			include("pages/tur/katduzenle.php");
			break;

		case "turkatsil":
			include("pages/tur/katsil.php");
			break;

		case "turtarih":
			include("pages/tur/tarih.php");
			break;

		case "turtarihekle":
			include("pages/tur/tarihekle.php");
			break;

		case "turtarihduzenle":
			include("pages/tur/tarihduzenle.php");
			break;

		case "turtarihsil":
			include("pages/tur/tarihsil.php");
			break;

		case "cikisnokta":
			include("pages/tur/cikisnokta.php");
			break;


		case "turekle":
			include("pages/tur/ekle.php");
			break;
		case "turduzenle":
			include("pages/tur/duzenle.php");
			break;
		case "tursil":
			include("pages/tur/sil.php");
			break;


			//  Rezervasyon işlemleri 
		case "rezervasyonlar":
			include("pages/rez/sahap.php");
			break;

		case "rezekle":
			include("pages/rez/ekle.php");
			break;

		case "rezbaslat":
			include("pages/rez/rezbaslat.php");
			break;



			//  Acenta 
		case "acenta":
			include("pages/acenta/sahap.php");
			break;

		case "acentaekle":
			include("pages/acenta/ekle.php");
			break;

		case "acentaduzenle":
			include("pages/acenta/duzenle.php");
			break;

		case "acentasil":
			include("pages/acenta/sil.php");
			break;

		case "acentacari":
			include("pages/acenta/cari.php");
			break;

		case "acentaodeme":
			include("pages/acenta/odeme.php");
			break;

		case "bayiler":
			include("pages/bayiler/sahap.php");
			break;

		case "bayiduzenle":
			include("pages/bayiler/duzenle.php");
			break;

		case "bayisil":
			include("pages/bayiler/sil.php");
			break;
		case "toplu-mail":
			include("pages/bayiler/toplu-mail.php");
			break;

		case "exit":
			session_destroy();
			unset($_SESSION);
			$_SESSION['admin'] = array();
			$_SESSION['admin'] = null;
			header("Location:index.php");

			break;
	}

	?>

	<?php require_once("footer.php"); ?>