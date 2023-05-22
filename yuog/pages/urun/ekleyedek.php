	<?php

    defined('YUOG') or exit('No direct script access allowed / Yetkisiz Erişim ');

    $konu         = "urun";
    $kategori     = $konu . "kat";


    $dilbak = @$_GET['dil'];
    if ($dilbak == "") {
        $dilbak = $mysqli->query("select * from diller order by sira asc limit 1 ");
        $dilyaz = $dilbak->fetch_array();
        $dil = $dilyaz['id'];
    } else {
        $dil = $dilbak;
        $dilbak = $mysqli->query("select * from diller where id='$dil' ");
        $dilyaz = $dilbak->fetch_array();
    }

    $katID    = @$_GET['katID'];
    if ($katID != "") {
        $katbak = $mysqli->query("select * from $konu where id='$katID'");
        $katyaz = $katbak->fetch_array();
    }

    $parabirimi = genel('parabirimi');
    $pribimyaz = $mysqli->query("select * from parabirimi where id='$parabirimi' ")->fetch_array();


    ?>
	<div class="main-content">

	    <div class="breadcrumb">
	        <h1><a href="?sy=<?php echo $konu; ?>"> Ürünler</a> > <?php echo $dilyaz['baslik']; ?> </h1>
	        <ul>
	            <li><a href="index.php">Ana Sayfa</a></li>
	            <li> İçerik Ekleme </li>


	        </ul>
	    </div>

	    <div class="separator-breadcrumb border-top"></div>

	    <div class="row">
	        <div class="col-md-12">

	            <p> </p>
	            <div class="card mb-5">
	                <div class="card-body">


	                    <?php
                        if ($_POST) {


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

                            $colSayi            = $_POST['colSayi'];
                            $ara_resim_link        = $_POST['ara_resim_link'];

                            $benzer                =  $_POST['benzer'];
                            $renk                =  $_POST['renk'];
                            $KDV                =  $_POST['kdv'];
                            $fiyatdurumu        =  $_POST['fiyatdurumu'];
                            $tumsıralama        = $_POST['tumsıralama'];
                            $kol_durum            = $_POST['kol_durum'];

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
                            $anasayfa_sira                = trim($_POST['anasayfa_sira']);
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

                            $ara_resimad            = $_FILES['ara_resim']['name'];
                            $ara_resimkaynak        = $_FILES['ara_resim']['tmp_name'];

                            if ($ara_resimad) {
                                $aradurum = 1;
                            } else {
                                $aradurum = 0;
                            }




                            $vresimad            = $_FILES['vresim']['name'];
                            $vkaynak            = $_FILES['vresim']['tmp_name'];

                            $pdfad                = $_FILES['dosya']['name'];
                            $pdfkay                = $_FILES['dosya']['tmp_name'];
                            $pdfsay             = count($pdfad);

                            $resimsonad         = rand(0, 999) . '-' . yeniurl(res_adi($resimad)) . res_uzanti($resimad);
                            $ustsonad             = rand(0, 999) . '-' . yeniurl(res_adi($ustresimad)) . res_uzanti($ustresimad);
                            $ara_resimsonad     = rand(0, 999) . '-' . yeniurl(res_adi($ara_resimad)) . res_uzanti($ara_resimad);
                            $vsonad             = rand(0, 999) . '-' . yeniurl(res_adi($vresimad)) . res_uzanti($vresimad);
                            // $iconsonad 			= rand(0,999).'-'.yeniurl(res_adi($iconad)).res_uzanti($iconad);
                            $kresimsonad         = 'mini-' . $resimsonad;
                            $kresimsonad         = 'mini-' . $kustresimsonad;

                            $rhedef                = "../uploads/";

                            $yeniurlmiz =  $_POST['seourl'];

                            $seosor        = $mysqli->query("select * from seo where seo='$yeniurlmiz' ");
                            $seoyazz    = $seosor->fetch_array();
                            $seosay     = $seosor->num_rows;

                            if ($seosay > 0) {
                                $sonurl = $yeniurlmiz . '-' . rand(0, 100);
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
		kustresim			='$kustresimsonad',
		ara_resim			='$ara_resimsonad',
		ara_durum			= $aradurum,
	 
		vbaslik				= '$vbaslik',	
		vaciklama			= '$vaciklama',	
		colSayi				= '$colSsayi',	
	 
		vlink				= '$vlink',
		vresim				= '$vsonad',
  
		pdf					= '$pdfad',	
		ip					='$ip', 
		tarih				= now(),
		ekleyen				= '$ekleyen',
		seo					= '$seoID',
		hit					= '$hit',
		sira				= '$sira',
		anasayfa_sira		= '$anasayfa_sira',
		dil					= '$dil',
		anasayfa			= '$anasayfa',
		bayiozel			='$bayiozel',
		durum				= '$durum',
		kol_durum			= '$kol_durum',
		KDV					= '$KDV',
		stok				= '$stok',
		fiyatdurumu   		='$fiyatdurumu',
		tumsıralama			='$tumsıralama',
		ara_resim_link		='$ara_resim_link'
	 
	  ");


                            if ($gonder) {

                                $icerikID    = $mysqli->insert_id;
                                foreach ($_POST['ozellik'] as $key => $value) {
                                    $mysqli->query("INSERT INTO urunozelliksec SET urunID={$icerikID}, ozellikID={$key}, icerik='{$value}', sira='{$_POST['ozelliksira'][$key]}'");
                                }
                                $yukle             = move_uploaded_file($kaynak, $rhedef . "/" . $resimsonad);
                                $yukle2         = move_uploaded_file($ustkaynak, $rhedef . "/" . $ustsonad);
                                $yukle3         = move_uploaded_file($vkaynak, $rhedef . "/" . $vsonad);
                                $yukle4         = move_uploaded_file($ara_resimkaynak, $rhedef . "/" . $ara_resimsonad);
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


                                $benzersay     = count($benzer);

                                for ($zz = 0; $zz < $benzersay; $zz++) {
                                    $benzerID    = $benzer[$zz];
                                    $benzerekle = $mysqli->query("insert into urunbenzer (`urunID`, `benzerID`) values ('$icerikID' , '$benzerID' ) ");
                                }

                                $renksay         = count($renk);
                                for ($rr = 0; $rr < $renksay; $rr++) {
                                    $renkID     = $renk[$rr];
                                    $renkekle = $mysqli->query("insert into urunrenksec (urunID, renkID)  values ('$icerikID', '$renkID' )  ");
                                }


                                header("Location:?sy=" . $konu . "&islem=basarili");
                            } else {
                                echo '<div class="alert alert-danger" role="alert">
				<strong class="text-capitalize">Hata!</strong>Hata İşlem Başarısız :(  
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div> <br /> <a href="javascript:history.back(-1)">Geri Dön</a>';
                            }
                        } else {
                        ?>
	                        <form action="" method="post" enctype="multipart/form-data">

	                            <div class="form-group row">
	                                <label for="baslik" class="col-sm-2 col-form-label"><i class="fa fa-language"></i> İçerik Dili * </label>
	                                <div class="col-sm-6">

	                                    <?php $dilbak1 = $mysqli->query("select * from diller  ");
                                        while ($dilyaz1 = $dilbak1->fetch_array()) {
                                            if ($dilyaz1['id'] == $dil) {

                                                echo '<a href="?sy=' . $konu . 'ekle&dil=' . $dilyaz1['id'] . '"><button type="button" class="btn btn-raised btn-raised-primary m-1">' . $dilyaz1['baslik'] . '</button></a> ';
                                            } else {

                                                echo '<a href="?sy=' . $konu . 'ekle&dil=' . $dilyaz1['id'] . '"><button type="button" class="btn btn-outline-primary m-1">' . $dilyaz1['baslik'] . '</button></a> ';
                                            }
                                        }
                                        ?>

	                                </div>
	                            </div>

	                            <div class="form-group row">
	                                <label for="baslik" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Başlık * </label>
	                                <div class="col-sm-6">
	                                    <input type="text" name="baslik" class="form-control" id="baslik" placeholder="Başlık" value="" required>
	                                </div>
	                            </div>


	                            <div class="form-group row">
	                                <label for="kodu" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Kodu * </label>
	                                <div class="col-sm-2">
	                                    <input type="text" name="kodu" class="form-control" id="kodu" placeholder="Kodu" value="" required>
	                                </div>
	                            </div>


	                            <div class="form-group row">
	                                <label for="fiyat" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Fiyat / <?php echo $pribimyaz['simge']; ?> </label>
	                                <div class="col-sm-1">
	                                    <input type="text" name="fiyat" class="form-control" id="fiyat" placeholder="Fiyat" value="" aria-describedby="validationTooltipUsernamePrepend">

	                                </div>


	                                <div class="input-group-prepend">
	                                    <span class="input-group-text" id="validationTooltipUsernamePrepend"><?php echo $pribimyaz['simge']; ?></span>
	                                </div>

	                            </div>
	                            <div class="form-group row">
	                                <label for="fiyat" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Stok * </label>
	                                <div class="col-sm-1">
	                                    <input type="text" name="stok" class="form-control" id="fiyat" placeholder="Stok" aria-describedby="validationTooltipUsernamePrepend">
	                                </div>
	                            </div>


	                            <div class="form-group row">
	                                <label for="kdv" class="col-sm-2 mt-4 col-form-label"> KDV * </label>

	                                <div class="col-sm-2">
	                                    <label for="kdv" class="col-sm-2 col-form-label"></label>
	                                    <select name="kdv" class="custom-select task-manager-list-select">
	                                        <option> Kdv Seçin * </option>
	                                        <?php
                                            $kdvs = $mysqli->query("SELECT * FROM kdv ORDER BY sira DESC");
                                            while ($kdvler = $kdvs->fetch_assoc()) {
                                            ?><option value="<?php echo $kdvler['oran']; ?>">
	                                                <?php echo $kdvler['oran']; ?></option>
	                                        <?php } ?>
	                                    </select>
	                                </div>
	                            </div>

	                            <div class="form-group row">
	                                <label for="fiyatdurumu" class="col-sm-2 mt-4 col-form-label"> Fiyat Özel * </label>

	                                <div class="col-sm-2">
	                                    <label for="fiyatdurumu" class="col-sm-2 col-form-label"></label>
	                                    <select name="fiyatdurumu" class="custom-select task-manager-list-select">
	                                        <option value="0">Sadece Bayi
	                                        <option value="1">Herkes
	                                    </select>
	                                </div>
	                            </div>


	                            <div class="form-group row">
	                                <label for="katID" class="col-sm-2 col-form-label"> Kategori * </label>

	                                <div class="col-sm-2">

	                                    <label for="katID"></label>
	                                    <select class="custom-select task-manager-list-select" name="katID" required>
	                                        <option value=""> Kategori Seçin * </option>
	                                        <?php
                                            $ukat  = $mysqli->query("select * from $kategori where   dil='$dil' order by sira asc ");
                                            while ($uyaz = $ukat->fetch_array()) {
                                                echo '<option value=' . $uyaz['id'] . ' >' . $uyaz['baslik'] . '</option>';
                                            }
                                            ?>
	                                    </select>
	                                </div>
	                            </div>



	                            <div class="form-group row">
	                                <label for="resim" class="col-sm-2 col-form-label"> <i class="nav-icon fa fa-image"></i> Üst Resim ( 1920 * 450) * </label>
	                                <div class="col-sm-2">
	                                    <input type="file" name="ustresim" class="form-control" id="resim" placeholder="" required>

	                                </div>

	                                <div class="col-sm-2">


	                                </div>

	                            </div>





	                            <!-- <div class="form-group row">
		<label for="icon" class="col-sm-2 col-form-label"> <i class="nav-icon fa fa-image"></i>  İcon   </label>
		<div class="col-sm-2">
		  
		    <input type="file" multiple="multiple" name="icon[]" class="form-control" id="rtoplu" placeholder=""  >
			 	<small id="passwordHelpBlock" class="ul-form__text form-text "> Toplu Resim Seçebilirsiniz </small>			
		</div>	
		</div>	-->


	                            <div class="form-group row">
	                                <label for="marka" class="col-sm-2 col-form-label"> Marka Seçin </label>

	                                <div class="col-sm-2">

	                                    <label for="ustkatID"> </label>
	                                    <select class="custom-select task-manager-list-select" name="marka" id="marka" required>
	                                        <option value="">Marka Seçin </option>
	                                        <?php
                                            $markabak  = $mysqli->query("select * from urunmarka  order by sira asc ");
                                            while ($markayaz = $markabak->fetch_array()) {

                                                echo '<option value=' . $markayaz['id'] . ' >' . $markayaz['baslik'] . '</option>';
                                            }

                                            ?>

	                                    </select>


	                                </div>



	                            </div>


	                            <br>

	                            <!--	veya
		
		<div class="col-sm-2">
		<input type="text" name="iconID" class="form-control" id="iconID" placeholder="İcon" value=""   > 
			 				
		</div> 
	<a href="https://fontawesome.com/icons?d=gallery&m=free" target="_blank" ><button type="button" class="btn btn-outline-warning m-1">İconlar</button></a>
	
	<small id="resim" class="ul-form__text form-text "> (Ör.  fa fa-home veya flaticon-clipboard bg-icon ) Bu alan boş olursa icon olarak resim icon kullanılır  </small>
	 
	</div>

	-->

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


	                            <!-- <div class="form-group row">
		<label for="teknik" class="col-sm-2 col-form-label"> Şartname  </label>
		<div class="col-sm-10">
		<textarea name="teknik" class="ckeditor" id="teknik" cols="40" rows="3"></textarea>
	  
		</div> 
	</div> -->






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


	                                <div class="card-header bg-transparent">
	                                    <h3 class="card-title"> Özellikler </h3>
	                                </div>


	                                <div class="card-body">
	                                    <div class="form-group row">



	                                        <?php $ozbak = $mysqli->query("select * from urunozellik where dil='$dil' order by sira asc  ");
                                            $yyy = 1;
                                            while ($ozyaz = $ozbak->fetch_array()) {
                                            ?>
	                                            <div class="col-md-2" style="display: grid">
	                                                <label for="ozellik<?php echo $yyy; ?>" class="action-bar-horizontal-label col-form-label">
	                                                    <span style="font-size:12px; "><?php echo $ozyaz['baslik'] ?>:</span>
	                                                </label>
	                                            </div>
	                                            <div class="col-md-10 row mb-3">
	                                                <textarea name="ozellik[<?php echo $ozyaz['id'] ?>]" class="form-control col-md-10" id="ozellik<?php echo $yyy; ?>" cols="100%" rows="2"></textarea>
	                                                <?php
                                                    ?>
	                                                <input type="text" name="ozelliksira[<?php echo $ozyaz['id'] ?>]" value="" size="1" class="form-control col-md-1" style="display:block;  height:48px; margin-left:5px;  ">

	                                            </div>
	                                        <?php
                                                $yyy++;
                                            }

                                            ?>

	                                    </div>
	                                </div>


	                            </div>


	                            <hr />


	                            <div class="form-group row">
	                                <label for="icerik" class="col-sm-2 col-form-label"> Renk Seç </label>

	                                <?php
                                    $renkbak = $mysqli->query("select * from urunrenk where dil='$dil'   order by sira asc ");
                                    while ($renkyaz = $renkbak->fetch_array()) {

                                        echo '<label class="checkbox checkbox-primary mr-2">
		<input type="checkbox" name="renk[]" value="' . $renkyaz['id'] . '" >
		<span>' . $renkyaz['baslik'] . '</span>
		<span class="checkmark"></span> 
		</label>';
                                    }
                                    ?>


	                            </div>



	                            <!-- <div class="row" id="ozellikkk" >
   
	  
	  <div class="col-2">
     <input type="file" name="ozellikres[]" class="form-control" id="validationCustom02" placeholder="" value=""  >
    </div> 
	    
	  <div class="col-4  ">
     <input type="text" name="ozellik[]" class="form-control" id="validationCustom02" placeholder="Başlık" value=""  >
    </div> 
	   
		<div class="col-4">

			<textarea name="ozel[]"   id="ozel'.$yyy.'" cols="50%" rows="2"></textarea>
		</div>
	   
    <div class="col-2 ">
        <button type="button" class="btn btn-raised ripple btn-raised-success m-1" id="ekstrasecc"> <i class="fa fa-plus"></i> Yeni Ekle </button>
    </div>
 </div>

 
	 
	 
		<hr> -->








	                            <!--
	<div class="form-group row">
		<label for="vlink" class="col-sm-2 col-form-label"><i class="fa fa-play"></i> Video Link </label>
		<div class="col-sm-6">
		 <input type="text" name="vlink" class="form-control" id="vlink" placeholder="Video Link" value=""  >
		 <small id="passwordHelpBlock" class="ul-form__text form-text "> Video Link Boş Bırakırsanız İçerikte Video Bölümü Çalışmaz </small>	
		</div>
	</div>
	
	
	  <div class="form-group row">
		<label for="vresim" class="col-sm-2 col-form-label"><i class="nav-icon fa fa-image"></i> Video Resim    </label>
		<div class="col-sm-2">
		  <input type="file" name="vresim" class="form-control" id="vresim" placeholder=""  > 
			 				
		</div>	
		
		<div class="col-sm-2">
		  
			 				
		</div>
	 
	</div>  
-->



	                            <!--  <div class="form-group row">
		<label for="pdf" class="col-sm-2 col-form-label"> <i class="nav-icon i-Data-Upload"></i> Dökümanlar  </label>
		<div class="col-sm-2">
		  <input type="file" name="pdf" class="form-control" id="pdf" placeholder=""  > 		 				
		</div>			 
	</div> -->




	                            <!-- <div class="form-group row">
									<label for="dosya" class="col-sm-2 col-form-label"> <i class="nav-icon i-Data-Upload"></i> Dökümanlar (pdf, word, excel vb.) </label>
									<div class="col-sm-2">
										<input type="file" name="dosya" class="form-control" id="dosya" placeholder="">
										<small id="passwordHelpBlock" class="ul-form__text form-text "> Toplu İçerik Ekleyebilirsiniz </small>

									</div>



								</div> -->
	                            <hr>

	                            <div class="bg-transparent">
	                                <h3 class="card-title"> Ara Resim Özellikler </h3>
	                            </div>


	                            <div class="form-group row">
	                                <label for="ara_resim" class="col-sm-2 col-form-label"> <i class="nav-icon fa fa-image"></i> Ara Resim </label>
	                                <div class="col-sm-2">
	                                    <input type="file" name="ara_resim" class="form-control" id="ara_resim">
	                                </div>
	                            </div>

	                            <div class="form-group row">
	                                <label for="colSayi" class="col-sm-2 col-form-label"> Kolon </label>
	                                <div class="col-sm-2">
	                                    <input type="text" name="colSayi" class="form-control" id="colSayi" placeholder="Kolon Sayısı ?/4" value="">
	                                </div>
	                            </div>

	                            <div class="form-group row">
	                                <label for="ara_resim_link" class="col-sm-2 col-form-label"> Link </label>
	                                <div class="col-sm-6">
	                                    <input type="text" name="ara_resim_link" class="form-control" id="ara_resim_link" placeholder="Ara Resim Linki" value="">
	                                </div>
	                            </div>
	                            <hr>



	                            <div class="form-group row">
	                                <label for="seourl" class="col-sm-2 col-form-label">Seo URL * </label>
	                                <div class="col-sm-6">
	                                    <input type="text" name="seourl" class="form-control" id="seourl" placeholder="Seo URL" value="">


	                                </div>

	                            </div>


	                            <div class="form-group row">
	                                <label for="keywords" class="col-sm-2 col-form-label">Keywords </label>
	                                <div class="col-sm-6">
	                                    <input type="text" name="keywords" class="form-control" id="keywords" placeholder="Keywords" value="">


	                                </div>

	                            </div>

	                            <div class="form-group row">
	                                <label for="description" class="col-sm-2 col-form-label">Description </label>
	                                <div class="col-sm-6">
	                                    <input type="text" name="description" class="form-control" id="description" placeholder="Description" value="">


	                                </div>

	                            </div>


	                            <div class="form-group row">
	                                <label for="bayiozel" class="col-sm-2 col-form-label">Bayiye Özel </label>
	                                <div class="col-sm-2">

	                                    <label class="switch switch-warning mr-3" id="bayiozel">
	                                        <input name="bayiozel" type="checkbox" value="1">
	                                        <span class="slider"></span>
	                                    </label>
	                                </div>
	                            </div>





	                            <div class="form-group row">
	                                <label for="anasayfa" class="col-sm-2 col-form-label">Anasayfa </label>
	                                <div class="col-sm-2">

	                                    <label class="switch switch-warning mr-3" id="anasayfa">
	                                        <input name="anasayfa" type="checkbox" value="1">
	                                        <span class="slider"></span>
	                                    </label>
	                                </div>
	                            </div>

	                            <div class="form-group row">
	                                <label for="kol_durum" class="col-sm-2 col-form-label">Koleksiyon'da Göster </label>
	                                <div class="col-sm-2">

	                                    <label class="switch switch-warning mr-3" id="kol_durum">
	                                        <input name="kol_durum" type="checkbox" value="1">
	                                        <span class="slider"></span>
	                                    </label>
	                                </div>
	                            </div>






	                            <div class="form-group row">
	                                <label for="etiket" class="col-sm-2 col-form-label">Etiketler </label>
	                                <div class="col-sm-6">
	                                    <input type="text" name="etiket" class="form-control" id="etiket" placeholder="Etiketler" value="">

	                                </div>

	                                <div class="col-sm-2">
	                                    <small id="passwordHelpBlock" class="ul-form__text form-text "> Virgül ile ayırınız </small>
	                                </div>

	                            </div>


	                            <div class="form-group row">
	                                <label for="sira" class="col-sm-2 col-form-label">Sıra </label>
	                                <div class="col-sm-1">
	                                    <input type="text" name="sira" class="form-control" id="sira" placeholder="Sıra" value="">


	                                </div>

	                            </div>

	                            <div class="form-group row">
	                                <label for="anasayfa_sira" class="col-sm-2 col-form-label"> Anasayfa Sıra </label>
	                                <div class="col-sm-1">
	                                    <input type="text" name="anasayfa_sira" class="form-control" id="anasayfa_sira" placeholder="Anasayfa Sıra" value="">


	                                </div>

	                            </div>


	                            <div class="form-group row">
	                                <label for="tumsıralama" class="col-sm-2 col-form-label">Koleksiyonlar Sıra </label>
	                                <div class="col-sm-1">
	                                    <input type="text" name="tumsıralama" class="form-control" id="tumsıralama" placeholder="Tüm Ürünler Sıra">


	                                </div>

	                            </div>

	                            <!-- <div class="form-group row">
	<label for="durum" class="col-sm-2 col-form-label">Linkedin'de Paylaş </label>
	<div class="col-sm-2">
	 
		<label class="switch switch-primary mr-3" id="durum">
			<input name="linkedin" type="checkbox" value="1">
			<span class="slider"></span>
		</label>  
	</div> 
	</div> -->


	                            <div class="form-group row">
	                                <label for="sira" class="col-sm-2 col-form-label"> </label>
	                                <div class="col-sm-10">
	                                    <button type="submit" class="btn btn-primary ul-btn__text">İçerik Ekle</button>

	                                </div>
	                            </div>

	                        </form>

	                    <?php } ?>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>