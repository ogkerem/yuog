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


?>

<?php
if ($_POST) {

    if ($_POST['turkce']) {



        $proje                = $_POST['proje'];
        $urun                = $_POST['urun'];
        $anasayfa            =  $_POST['anasayfa'];

        $bayiozel            =  $_POST['bayiozel'];
        $iconID                = trim($_POST['iconID']);

        $fiyat                =  $_POST['fiyat'];

        $kodu                =  $_POST['kodu'];

        $katID                =  $_POST['katID'];
        $marka                =  $_POST['marka'];

        $ozel                =  $_POST['ozel'];
        $ozelIDD            =  $_POST['ozelIDD'];
        $ozsira                =  $_POST['ozsira'];



        $benzer                =  $_POST['benzer'];
        $renk                =  $_POST['renk'];
        $KDV                =  $_POST['kdv'];
        $fiyatdurumu        =  $_POST['fiyatdurumu'];


        $baslik                = addslashes(trim($_POST['baslik']));
        $onyazi                = addslashes(trim($_POST['onyazi']));
        $icerik                = addslashes(trim($_POST['icerik']));
        $teknik                = addslashes(trim($_POST['teknik']));
        $keywords            = addslashes(trim($_POST['keywords']));
        $description        = addslashes(trim($_POST['description']));
        $etiket                = addslashes(trim($_POST['etiket']));

        $vbaslik            = addslashes(trim($_POST['vbaslik']));
        $vaciklama            = addslashes(trim($_POST['vaciklama']));
        $vlink                = addslashes(trim($_POST['vlink']));
        $stok                = addslashes(trim($_POST['stok']));

        // $ibaslik			= addslashes(trim($_POST['ibaslik']));
        // $iicerik			= addslashes(trim($_POST['iicerik']));

        // $linkedin			= (trim($_POST['linkedin']));

        $sira                = trim($_POST['sira']);
        $hit                = 1;
        $durum                = 1;
        $ekleyen            = $email;
        $ip                    = $_SERVER['REMOTE_ADDR'];




        $rtopluad            = $_FILES['rtoplu']['name'];
        $rtoplukaynak        = $_FILES['rtoplu']['tmp_name'];
        $say                 = count($rtopluad);

        $iconad                = $_FILES['icon']['name'];
        $iconkaynak            = $_FILES['icon']['tmp_name'];
        $iconsay            = count($iconad);

        $resimad            = $_FILES['resim']['name'];
        $kaynak                = $_FILES['resim']['tmp_name'];

        $ustresimad            = $_FILES['ustresim']['name'];
        $ustkaynak            = $_FILES['ustresim']['tmp_name'];


        $vresimad            = $_FILES['vresim']['name'];
        $vkaynak            = $_FILES['vresim']['tmp_name'];

        $pdfad                = $_FILES['dosya']['name'];
        $pdfkay                = $_FILES['dosya']['tmp_name'];
        $pdfsay             = count($pdfad);

        $resimsonad         = rand(0, 999) . '-' . yeniurl(res_adi($resimad)) . res_uzanti($resimad);
        $ustsonad             = rand(0, 999) . '-' . yeniurl(res_adi($ustresimad)) . res_uzanti($ustresimad);
        $vsonad             = rand(0, 999) . '-' . yeniurl(res_adi($vresimad)) . res_uzanti($vresimad);
        // $iconsonad 			= rand(0,999).'-'.yeniurl(res_adi($iconad)).res_uzanti($iconad);
        $kresimsonad         = 'mini-' . $resimsonad;

        $rhedef                = "../uploads/";

        $yeniurlmiz =  $_POST['seourl'];

        $seosor        = $mysqli->query("select * from seo where seo='$yeniurlmiz' ");
        $seoyazz    = $seosor->fetch_array();
        $seosay     = $seosor->num_rows;

        if ($seosay > 0) {
            $sonurl = rand(0, 100) . '-' . $yeniurlmiz;
        } else {
            $sonurl = $yeniurlmiz;
        }

        $seoekle         = $mysqli->query("insert into seo (seo,konu, durum) values ('$sonurl', '$konu', '$durum')");
        $seoID            = $mysqli->insert_id;


        $gonder      = $mysqli->query(" insert into urun set 
	 
		fiyat 				='$fiyat', 
		parabirimi 			='$parabirimi', 
		kodu 				='$kodu', 
		iconID 				='$iconID', 
		katID 				='$katID', 
		marka 				='$marka', 
		 
		baslik 				='$baslik', 
		onyazi 				='$onyazi', 
		icerik 				='$icerik', 
		teknik 				='$teknik', 
		keywords 			='$keywords', 
		description			='$description', 
		kresim				='$kresimsonad', 
		resim				='$resimsonad', 		
		ustresim			= '$ustsonad',	
	 
		vbaslik				= '$vbaslik',	
		vaciklama			= '$vaciklama',	
		 
	 
		vlink				= '$vlink',
		vresim				= '$vsonad',
  
		pdf					= '$pdfad',	
		ip					='$ip', 
		tarih				= now(),
		ekleyen				= '$ekleyen',
		seo					= '$seoID',
		hit					= '$hit',
		sira				= '$sira',
		dil					= '$dil',
		anasayfa			= '$anasayfa',
		bayiozel			='$bayiozel',
		durum				= '$durum',
		KDV					= '$KDV',
		stok				= '$stok',
		fiyatdurumu   		='$fiyatdurumu'
	 
	  ");


        if ($gonder) {

            $icerikID    = $mysqli->insert_id;
            foreach ($_POST['ozellik'] as $key => $value) {
                $mysqli->query("INSERT INTO urunozelliksec SET urunID={$icerikID}, ozellikID={$key}, icerik='{$value}', sira='{$_POST['ozelliksira'][$key]}'");
            }
            $yukle             = move_uploaded_file($kaynak, $rhedef . "/" . $resimsonad);
            $yukle2         = move_uploaded_file($ustkaynak, $rhedef . "/" . $ustsonad);
            $yukle3         = move_uploaded_file($vkaynak, $rhedef . "/" . $vsonad);
            //		$yukle4			= move_uploaded_file($pdfkaynak,$rhedef."/".$pdfad);
            $yukle5            = move_uploaded_file($iconkaynak, $rhedef . "/" . $iconsonad);
            kucult($rhedef, $resimsonad);


            $ebakp = explode(",", $etiket);
            $esay =  count($ebakp);

            for ($yy = 0; $yy < $esay; $yy++) {
                $etiket1  = $ebakp[$yy];
                $etiketekle = $mysqli->query("insert into etiket (`baslik`, `seo`, `konu`, `konuID` ) values ('$etiket1' , '$seoID' , '$konu' , '$icerikID' ) ");
            }

            if ($rtopluad[0] != "") {

                for ($x = 0; $x < $say; $x++) {

                    $rbaslik    = $rtopluad[$x];
                    $rkaynak    = $rtoplukaynak[$x];
                    $rsonadi     = $x . '-' . yeniurl(res_adi($rbaslik)) . res_uzanti($rbaslik);


                    //echo $rbaslik.'<br/>';
                    $vyukle = $mysqli->query("insert into galeri (icerikID, konu, baslik, resim, sira ,durum ) values('$icerikID','$konu','$rbaslik','$rsonadi' ,  '0', '1'   ) ");

                    $yukle     = move_uploaded_file($rkaynak, $rhedef . "/" . $rsonadi);
                    // kucult($rhedef, $rsonadi);	
                }
            }

            if ($iconad[0] != "") {

                for ($x = 0; $x < $iconsay; $x++) {

                    $rbaslik    = $iconad[$x];
                    $rkaynak    = $iconkaynak[$x];
                    $rsonadi     = rand(0, 9999) . '-' . yeniurl(res_adi($rbaslik)) . res_uzanti($rbaslik);

                    $vyukle = $mysqli->query("insert into galeri (icerikID, konu, baslik, resim, sira ,durum ) values('$icerikID','icon','$rbaslik','$rsonadi' ,  '0', '1'   ) ");

                    $yukle     = move_uploaded_file($rkaynak, $rhedef . "/" . $rsonadi);
                    // kucult($rhedef, $rsonadi);	
                }
            }


            if ($pdfad[0] != "") {

                for ($x = 0; $x < $pdfsay; $x++) {

                    $pdfbaslik    = $pdfad[$x];
                    $pdfkaynak    = $pdfkay[$x];
                    $pdfsonadi     = rand(0, 9999) . '-' . yeniurl(res_adi($pdfbaslik)) . res_uzanti($pdfbaslik);


                    $vyukle = $mysqli->query("insert into dosya (icerikID, konu, baslik, resim, sira ,durum ) values('$icerikID','$konu','$pdfbaslik','$pdfsonadi' ,  '0', '1'   ) ");

                    $yukle     = move_uploaded_file($pdfkaynak, $rhedef . "/" . $pdfsonadi);
                    // kucult($rhedef, $rsonadi);	

                }
            }


            $ozelliksay     = count($ozel);


            for ($pp = 0; $pp < $ozelliksay; $pp++) {
                $ozellikID    = $ozelIDD[$pp];
                $ozsira1    = $ozsira[$pp];
                $icerikk    = trim($ozel[$pp]);


                $ozellikekle = $mysqli->query("insert into urunozelliksec (`urunID`, `ozellikID`, `icerik`, `sira` ) values ('$icerikID' , '$ozellikID' , '$icerikk', '$ozsira1' ) ");
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">
				<strong class="text-capitalize">Hata!</strong>Hata İşlem Başarısız :(  
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div> <br /> <a href="javascript:history.back(-1)">Geri Dön</a>';
        }
    }





    if ($_POST['ingilizce']) {



        $proje                = $_POST['proje'];
        $urun                = $_POST['urun'];
        $anasayfa            =  $_POST['anasayfa'];

        $bayiozel            =  $_POST['bayiozel'];
        $iconID                = trim($_POST['iconID']);

        $fiyat                =  $_POST['fiyat'];

        $kodu                =  $_POST['kodu'];

        $katID                =  $_POST['katID'];
        $marka                =  $_POST['marka'];

        $ozel                =  $_POST['ozel'];
        $ozelIDD            =  $_POST['ozelIDD'];
        $ozsira                =  $_POST['ozsira'];



        $benzer                =  $_POST['benzer'];
        $renk                =  $_POST['renk'];
        $KDV                =  $_POST['kdv'];
        $fiyatdurumu        =  $_POST['fiyatdurumu'];


        $baslik                = addslashes(trim($_POST['baslik']));
        $onyazi                = addslashes(trim($_POST['onyazi']));
        $icerik                = addslashes(trim($_POST['icerik']));
        $teknik                = addslashes(trim($_POST['teknik']));
        $keywords            = addslashes(trim($_POST['keywords']));
        $description        = addslashes(trim($_POST['description']));
        $etiket                = addslashes(trim($_POST['etiket']));

        $vbaslik            = addslashes(trim($_POST['vbaslik']));
        $vaciklama            = addslashes(trim($_POST['vaciklama']));
        $vlink                = addslashes(trim($_POST['vlink']));
        $stok                = addslashes(trim($_POST['stok']));

        // $ibaslik			= addslashes(trim($_POST['ibaslik']));
        // $iicerik			= addslashes(trim($_POST['iicerik']));

        // $linkedin			= (trim($_POST['linkedin']));

        $sira                = trim($_POST['sira']);
        $hit                = 1;
        $durum                = 1;
        $ekleyen            = $email;
        $ip                    = $_SERVER['REMOTE_ADDR'];




        $rtopluad            = $_FILES['rtoplu']['name'];
        $rtoplukaynak        = $_FILES['rtoplu']['tmp_name'];
        $say                 = count($rtopluad);

        $iconad                = $_FILES['icon']['name'];
        $iconkaynak            = $_FILES['icon']['tmp_name'];
        $iconsay            = count($iconad);

        $resimad            = $_FILES['resim']['name'];
        $kaynak                = $_FILES['resim']['tmp_name'];

        $ustresimad            = $_FILES['ustresim']['name'];
        $ustkaynak            = $_FILES['ustresim']['tmp_name'];


        $vresimad            = $_FILES['vresim']['name'];
        $vkaynak            = $_FILES['vresim']['tmp_name'];

        $pdfad                = $_FILES['dosya']['name'];
        $pdfkay                = $_FILES['dosya']['tmp_name'];
        $pdfsay             = count($pdfad);

        $resimsonad         = rand(0, 999) . '-' . yeniurl(res_adi($resimad)) . res_uzanti($resimad);
        $ustsonad             = rand(0, 999) . '-' . yeniurl(res_adi($ustresimad)) . res_uzanti($ustresimad);
        $vsonad             = rand(0, 999) . '-' . yeniurl(res_adi($vresimad)) . res_uzanti($vresimad);
        // $iconsonad 			= rand(0,999).'-'.yeniurl(res_adi($iconad)).res_uzanti($iconad);
        $kresimsonad         = 'mini-' . $resimsonad;

        $rhedef                = "../uploads/";

        $yeniurlmiz =  $_POST['seourl'];

        $seosor        = $mysqli->query("select * from seo where seo='$yeniurlmiz' ");
        $seoyazz    = $seosor->fetch_array();
        $seosay     = $seosor->num_rows;

        if ($seosay > 0) {
            $sonurl = rand(0, 100) . '-' . $yeniurlmiz;
        } else {
            $sonurl = $yeniurlmiz;
        }

        $seoekle         = $mysqli->query("insert into seo (seo,konu, durum) values ('$sonurl', '$konu', '$durum')");
        $seoID            = $mysqli->insert_id;


        $gonder      = $mysqli->query(" insert into urun set 
	 
		fiyat 				='$fiyat', 
		parabirimi 			='$parabirimi', 
		kodu 				='$kodu', 
		iconID 				='$iconID', 
		katID 				='$katID', 
		marka 				='$marka', 
		 
		baslik 				='$baslik', 
		onyazi 				='$onyazi', 
		icerik 				='$icerik', 
		teknik 				='$teknik', 
		keywords 			='$keywords', 
		description			='$description', 
		kresim				='$kresimsonad', 
		resim				='$resimsonad', 		
		ustresim			= '$ustsonad',	
	 
		vbaslik				= '$vbaslik',	
		vaciklama			= '$vaciklama',	
		 
	 
		vlink				= '$vlink',
		vresim				= '$vsonad',
  
		pdf					= '$pdfad',	
		ip					='$ip', 
		tarih				= now(),
		ekleyen				= '$ekleyen',
		seo					= '$seoID',
		hit					= '$hit',
		sira				= '$sira',
		dil					= '$dil',
		anasayfa			= '$anasayfa',
		bayiozel			='$bayiozel',
		durum				= '$durum',
		KDV					= '$KDV',
		stok				= '$stok',
		fiyatdurumu   		='$fiyatdurumu'
	 
	  ");


        if ($gonder) {

            $icerikID    = $mysqli->insert_id;
            foreach ($_POST['ozellik'] as $key => $value) {
                $mysqli->query("INSERT INTO urunozelliksec SET urunID={$icerikID}, ozellikID={$key}, icerik='{$value}', sira='{$_POST['ozelliksira'][$key]}'");
            }
            $yukle             = move_uploaded_file($kaynak, $rhedef . "/" . $resimsonad);
            $yukle2         = move_uploaded_file($ustkaynak, $rhedef . "/" . $ustsonad);
            $yukle3         = move_uploaded_file($vkaynak, $rhedef . "/" . $vsonad);
            //		$yukle4			= move_uploaded_file($pdfkaynak,$rhedef."/".$pdfad);
            $yukle5            = move_uploaded_file($iconkaynak, $rhedef . "/" . $iconsonad);
            kucult($rhedef, $resimsonad);


            $ebakp = explode(",", $etiket);
            $esay =  count($ebakp);

            for ($yy = 0; $yy < $esay; $yy++) {
                $etiket1  = $ebakp[$yy];
                $etiketekle = $mysqli->query("insert into etiket (`baslik`, `seo`, `konu`, `konuID` ) values ('$etiket1' , '$seoID' , '$konu' , '$icerikID' ) ");
            }

            if ($rtopluad[0] != "") {

                for ($x = 0; $x < $say; $x++) {

                    $rbaslik    = $rtopluad[$x];
                    $rkaynak    = $rtoplukaynak[$x];
                    $rsonadi     = $x . '-' . yeniurl(res_adi($rbaslik)) . res_uzanti($rbaslik);


                    //echo $rbaslik.'<br/>';
                    $vyukle = $mysqli->query("insert into galeri (icerikID, konu, baslik, resim, sira ,durum ) values('$icerikID','$konu','$rbaslik','$rsonadi' ,  '0', '1'   ) ");

                    $yukle     = move_uploaded_file($rkaynak, $rhedef . "/" . $rsonadi);
                    // kucult($rhedef, $rsonadi);	
                }
            }

            if ($iconad[0] != "") {

                for ($x = 0; $x < $iconsay; $x++) {

                    $rbaslik    = $iconad[$x];
                    $rkaynak    = $iconkaynak[$x];
                    $rsonadi     = rand(0, 9999) . '-' . yeniurl(res_adi($rbaslik)) . res_uzanti($rbaslik);

                    $vyukle = $mysqli->query("insert into galeri (icerikID, konu, baslik, resim, sira ,durum ) values('$icerikID','icon','$rbaslik','$rsonadi' ,  '0', '1'   ) ");

                    $yukle     = move_uploaded_file($rkaynak, $rhedef . "/" . $rsonadi);
                    // kucult($rhedef, $rsonadi);	
                }
            }


            if ($pdfad[0] != "") {

                for ($x = 0; $x < $pdfsay; $x++) {

                    $pdfbaslik    = $pdfad[$x];
                    $pdfkaynak    = $pdfkay[$x];
                    $pdfsonadi     = rand(0, 9999) . '-' . yeniurl(res_adi($pdfbaslik)) . res_uzanti($pdfbaslik);


                    $vyukle = $mysqli->query("insert into dosya (icerikID, konu, baslik, resim, sira ,durum ) values('$icerikID','$konu','$pdfbaslik','$pdfsonadi' ,  '0', '1'   ) ");

                    $yukle     = move_uploaded_file($pdfkaynak, $rhedef . "/" . $pdfsonadi);
                    // kucult($rhedef, $rsonadi);	

                }
            }


            $ozelliksay     = count($ozel);


            for ($pp = 0; $pp < $ozelliksay; $pp++) {
                $ozellikID    = $ozelIDD[$pp];
                $ozsira1    = $ozsira[$pp];
                $icerikk    = trim($ozel[$pp]);


                $ozellikekle = $mysqli->query("insert into urunozelliksec (`urunID`, `ozellikID`, `icerik`, `sira` ) values ('$icerikID' , '$ozellikID' , '$icerikk', '$ozsira1' ) ");
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">
				<strong class="text-capitalize">Hata!</strong>Hata İşlem Başarısız :(  
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div> <br /> <a href="javascript:history.back(-1)">Geri Dön</a>';
        }
    }
}
?>
<form method="post" enctype="multipart/form-data">

    <input type="hidden" name="ingilizce">
  
    <div class="form-group row">
        <label for="resim" class="col-sm-2 col-form-label"> <i class="nav-icon fa fa-image"></i> Üst Resim ( 1920 * 450) * </label>
        <div class="col-sm-2">
            <input type="file" name="ustresim" class="form-control" id="resim" placeholder="" required>

        </div>

        <div class="col-sm-2">


        </div>

    </div>


    <div class="form-group row">
        <label for="katID" class="col-sm-2 col-form-label"> Kategori * </label>

        <div class="col-sm-2">

            <label for="katID"></label>
            <select class="custom-select task-manager-list-select" name="katID" required>
                <option value=""> Kategori Seçin * </option>
                <?php
                $ukat  = $mysqli->query("select * from $kategori where   dil='2' order by sira asc ");
                while ($uyaz = $ukat->fetch_array()) {
                    echo '<option value=' . $uyaz['id'] . ' >' . $uyaz['baslik'] . '</option>';
                }
                ?>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="onyazi" class="col-sm-2 col-form-label"> Ön Yazı </label>
        <div class="col-sm-10">
            <textarea name="onyazi" class="form-control" id="onyazi" cols="50" rows="2" placeholder="Ön Yazı"></textarea>

        </div>
    </div>



    <div class="form-group row">
        <label for="icerik" class="col-sm-2 col-form-label"> Açıklama </label>
        <div class="col-sm-10">
            <textarea name="icerik" class="ckeditor" id="icerik" cols="40" rows="3"></textarea>

        </div>
    </div>
    <hr />





    <div class="form-group row">
        <label for="resim" class="col-sm-2 col-form-label"><i class="nav-icon fa fa-image"></i> Ana Resim ( 700 * 550) * </label>
        <div class="col-sm-2">
            <input type="file" name="resim" class="form-control" id="resim" placeholder="Küçük Resim Boyutu" required>

        </div>

        <div class="col-sm-2">


        </div>

    </div>


    <div class="form-group row">
        <label for="rtoplu" class="col-sm-2 col-form-label"> <i class="nav-icon i-Video-Photographer"></i> Diğer Resimler ( 700 * 550) </label>
        <div class="col-sm-2">
            <input type="file" multiple="multiple" name="rtoplu[]" class="form-control" id="rtoplu" placeholder="">
            <small id="passwordHelpBlock" class="ul-form__text form-text "> Toplu Resim Seçebilirsiniz </small>
        </div>



    </div>

    <hr>


    <div class="form-group row">
        <label for="sira" class="col-sm-2 col-form-label"> </label>
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary ul-btn__text">İçerik Ekle</button>

        </div>
    </div>

</form>

