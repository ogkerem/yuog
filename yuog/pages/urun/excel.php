<?php

defined('YUOG') or exit('No direct script access allowed / Yetkisiz Erişim ');

require_once('Classes/PHPExcel.php');


?>
<div class="main-content">

    <div class="breadcrumb">
        <h1><a href="?sy=urun"> Ürünler</a> > Exelle Ürün Yükleme </h1>
        <ul>
            <li><a href="index.php">Ana Sayfa</a></li>
            <li> Excel Ürün Yükleme </li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    <div class="alert alert-danger" role="alert"> <strong> Dikkat!!!</strong> Excel toplu ürün yükleme hassas bir işlemdir. Önce resimler FTP ile yüklenmelidir. Ürün kodu ve resim ismi aynı olmalıdır. Bütün resimler .jpg formatında olmak zorundadır. </div>

    <div class="alert alert-info" role="info"> Örnek Excel(En son 30.03.2023 tarihinde değiştirildi.) indirmek için <a href="pages/urun/sahap.xlsx"><b class="text-danger">tıkla.</b></a> Örnekteki ile aynı formatta olmak zorundadır. </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">


                <?php

                if ($_POST) {

                    $name               = $_FILES['excel']['name'];



                    $kaynak                = $_FILES['excel']['tmp_name'];
                    $rhedef                = "../excel/";

                    $excelsonad         = rand(0, 999) . '-' . yeniurl(res_adi($name)) . res_uzanti($name);
                    $excelyukle         = move_uploaded_file($kaynak, $rhedef . "/" . $excelsonad);

                    $excelyol           = $rhedef . $excelsonad;

                    $excel = new PHPExcel();

                    $excel = PHPExcel_IOFactory::load($excelyol);

                    $i = 2;
                    while ($excel->getActiveSheet()->getCell('A' . $i)->getValue() != "") {

                        $baslik             = trim($excel->getActiveSheet()->getCell('A' . $i)->getValue());
                        $kod                = trim($excel->getActiveSheet()->getCell('B' . $i)->getValue());
                        $fiyat              = trim($excel->getActiveSheet()->getCell('C' . $i)->getValue());
                        $KDV                = trim($excel->getActiveSheet()->getCell('D' . $i)->getValue());
                        $renk               = trim($excel->getActiveSheet()->getCell('E' . $i)->getValue());
                        $katID              = trim($excel->getActiveSheet()->getCell('F' . $i)->getValue());
                        $resim              = trim($excel->getActiveSheet()->getCell('B' . $i)->getValue()) . '.jpg';
                        $stok               = trim($excel->getActiveSheet()->getCell('G' . $i)->getValue());
                        $dilID              = trim($excel->getActiveSheet()->getCell('H' . $i)->getValue());
                        $dilkodu            = trim($excel->getActiveSheet()->getCell('I' . $i)->getValue());
                        $kodu               = trim($excel->getActiveSheet()->getCell('B' . $i)->getValue()) . '-' . $dilkodu;
                        $aciklama            = trim($excel->getActiveSheet()->getCell('j' . $i)->getValue());


                        $i++;

                        $kodSor        = $mysqli->query("SELECT * from urun where kodu='$kod' AND dil = '$dilID' ")->num_rows;
                        if ($kodSor == 0 && $renk != '') {

                            $seosor        = $mysqli->query("SELECT * from seo where seo='$kodu' ");
                            $seosay     = $seosor->num_rows;

                            if ($seosay > 0) {
                                $sonurl = $kodu . '-' . rand(0, 1000);
                            } else {
                                $sonurl = $kodu;
                            }

                            $seoekle         = $mysqli->query("insert into seo (id,seo,konu, durum) values ('$seo','$sonurl', 'urun', '1')");
                            $seoID             = $mysqli->insert_id;

                            $renkyaz        = $mysqli->query("SELECT * from urunrenk where baslik='$renk' and dil = $dilID ")->fetch_array();
                            $renkID         = $renkyaz['id'];
                            if ($renkID == '') {
                                $renkekle   = $mysqli->query("insert into urunrenk (baslik,dil) values ('$renk','$dilID') ");
                                $renkID     = $mysqli->insert_id;
                            }

                            $kdvyaz             = $mysqli->query("SELECT * from kdv where oran='$KDV' ")->fetch_array();
                            $kdv                = $kdvyaz['id'];
                            if (!$kdv) {
                                $kdvekle        = $mysqli->query("insert into kdv (baslik,oran) values ('$KDV', '$KDV') ");
                                $kdv            = $mysqli->insert_id;
                            }

                            $kresimsonad         = 'mini-' . $resim;
                            $rhedef                = "../uploads/";

                            $hit                = 1;
                            $durum                = 1;
                            $ekleyen            = $email;
                            $ip                    = $_SERVER['REMOTE_ADDR'];


                            $gonder      = $mysqli->query(" insert into urun set 
	 
		fiyat 				='$fiyat', 
		parabirimi 			='2', 
		kodu 				='$kod', 		 
		katID 				='$katID', 
		marka 				='5', 		 
		baslik 				='$baslik', 
		onyazi 				='$aciklama', 
		icerik 				='', 
		teknik 				='', 
		keywords 			='$baslik', 
		description			='$baslik', 
		kresim				='$kresimsonad', 
		resim				='$resim', 		
                                     
		ip					='$ip', 
		tarih				= now(),
		ekleyen				= 'excel',
		seo					= '$seoID',
		hit					= '$hit',
		sira				= '0',
		anasayfa_sira		= '0',
		dil					= '$dilID',
		anasayfa			= '0',
		bayiozel			='1',
		durum				= '1',
		kol_durum			= '1',
		KDV					= '$kdv',
		stok				= '$stok',
		fiyatdurumu   		='0',
		tumsiralama			='',
		ara_resim_link		=''
	 
	  ");

                            $urunID     = $mysqli->insert_id;
                            $renksekle  = $mysqli->query("insert into urunrenksec (urunID,renkID) values ('$urunID','$renkID') ");

                            kucult($rhedef, $resim);

                            if ($gonder) {
                                echo $kod . ' Ürün eklendi <br> ';
                            } else {
                                echo $kod . ' Ürün eklenmedi <br> ';
                            }
                        } else {
                            echo  $kod . ' Zaten Ekli <br> ';
                        }
                    }
                } else {
                ?>



                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="form-group row">
                            <label for="excel" class="col-sm-2 col-form-label"> <i class="fa fa-file-excel"></i> Excel </label>
                            <div class="col-sm-2">
                                <input type="file" name="excel" class="form-control" id="excel" placeholder="">
                            </div>

                            <div class="col-sm-2">


                            </div>

                        </div>


                        <div class="form-group row">
                            <label for="sira" class="col-sm-2 col-form-label"> </label>
                            <div class="col-sm-10">

                                <div class="col-sm-2">
                                    <input type="submit" name="submit" value="Excel Yükle" class="btn btn-primary ul-btn__text" id="submit" placeholder="">

                                </div>


                            </div>
                        </div>







                    </form>

                <?php } ?>

            </div>
        </div>
    </div>
</div>