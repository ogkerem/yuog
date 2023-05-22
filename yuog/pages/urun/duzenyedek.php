	<?php

    defined('YUOG') or exit('No direct script access allowed / Yetkisiz Erişim ');

    $konu         = "urun";
    $kategori     = $konu . "kat";

    $id     = $_GET['id'];
    $yaz1     = $mysqli->query("select * from $konu where id='$id' ");
    $yaz     = $yaz1->fetch_array();

    $seoID     = $yaz['seo'];
    $seobul    = $mysqli->query("select * from seo where id='$seoID' ");
    $seoyaz = $seobul->fetch_array();
    $dil     = $yaz['dil'];
    $dilbul = $mysqli->query("select * from diller where id='$dil' ");
    $dilyaz = $dilbul->fetch_array();


    $parabirimi = genel('parabirimi');
    $pribimyaz = $mysqli->query("select * from parabirimi where id='$parabirimi' ")->fetch_array();
    ?>

	<div class="main-content">

	    <div class="breadcrumb">
	        <h1><a href="?sy=<?php echo $konu; ?>"> Ürünler </a> > <?php echo $dilyaz['baslik']; ?> </h1>
	        <ul>
	            <li><a href="index.php">Ana Sayfa</a></li>
	            <li>İçerik Güncelleme</li>
	        </ul>
	    </div>


	    <script type="text/javascript">
	        $(function() {

	            $(".resimsill1").click(function() {
	                $(this).parent().remove();
	                return false;
	            });

	        });
	    </script>



	    <div class="separator-breadcrumb border-top"></div>


	    <?php $islem = @$_GET['islem'];
        if ($islem == "basarili") {

            echo '	<div class="alert alert-card alert-success" role="alert">
			<strong class="text-capitalize">Başarılı !</strong> İşleminiz başarıyla gerçekleştirilmiştir.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">X</span>
			</button>
		</div> ';
        }

        ?>

	    <div class="row">
	        <div class="col-md-12">

	            <p> </p>
	            <div class="card mb-5">
	                <div class="card-body">


	                    <?php
                        if ($_POST) {



                            $anasayfa1 = $_POST['anasayfa'];
                            if ($anasayfa1 == "on") {
                                $anasayfa = 1;
                            } else {
                                $anasayfa = 0;
                            }

                            $bayiozel1 = $_POST['bayiozel'];
                            if ($bayiozel1 == "on") {
                                $bayiozel = 1;
                            } else {
                                $bayiozel = 0;
                            }

                            $kol_durum1 = $_POST['kol_durum'];
                            if ($kol_durum1 == "on") {
                                $kol_durum = 1;
                            } else {
                                $kol_durum = 0;
                            }

                            $marka                =  $_POST['marka'];

                            $fiyat                =  $_POST['fiyat'];

                            $kodu                =  $_POST['kodu'];
                            $colSayi                =  $_POST['colSayi'];
                            $pdfad                = $_FILES['pdf']['name'];
                            $pdfkaynak            = $_FILES['pdf']['tmp_name'];
                            $gpdf                = $_POST['gpdf'];

                            $fiyatdurumu         = $_POST['fiyatdurumu'];
                            $ara_durum = $_POST['ara_durum'];

                            $katID                =  $_POST['katID'];
                            $ara_resim_link     = $_POST['ara_resim_link'];
                            $tumsıralama         = $_POST['tumsıralama'];

                            $renk                = $_POST['renk'];
                            $baslik                = addslashes(trim($_POST['baslik']));
                            $onyazi                = addslashes(trim($_POST['onyazi']));
                            $icerik                = addslashes(trim($_POST['icerik']));
                            $kdv                = addslashes(trim($_POST['kdv']));
                            $stok                = addslashes(trim($_POST['stok']));

                            $keywords            = addslashes(trim($_POST['keywords']));
                            $description        = addslashes(trim($_POST['description']));
                            $etiket                = addslashes(trim($_POST['etiket']));

                            $eskiresimler        = $_POST['eskiresimler'];
                            $rtopluad            = $_FILES['rtoplu']['name'];
                            $rtoplukaynak        = $_FILES['rtoplu']['tmp_name'];
                            $say                 = count($rtopluad);

                            $eskidosya            = $_POST['eskidosya'];
                            $dosyaad            = $_FILES['dosya']['name'];
                            $dosyakaynak        = $_FILES['dosya']['tmp_name'];
                            $dosyasay             = count($dosyaad);


                            // $ibaslik			= addslashes(trim($_POST['ibaslik']));
                            // $iicerik			= addslashes(trim($_POST['iicerik']));

                            $sira                = trim($_POST['sira']);
                            $anasayfa_sira        = trim($_POST['anasayfa_sira']);
                            $dil                = trim($_POST['dil']);

                            $durum1                = $_POST['durum'];
                            if ($durum1 == "on") {
                                $durum = 1;
                            } else {
                                $durum = 0;
                            }



                            $yeni_urun1                 = $_POST['yeni_urun'];
                            if ($yeni_urun1 == "on") {
                                $yeni_urun = 1;
                            } else {
                                $yeni_urun = 0;
                            }

                            $ustresimad            = $_FILES['ustresim']['name'];
                            $ustkaynak            = $_FILES['ustresim']['tmp_name'];
                            $gustresim            = $_POST['gustresim'];

                            $resimad            = $_FILES['resim']['name'];
                            $kaynak                = $_FILES['resim']['tmp_name'];

                            $ara_resimad            = $_FILES['ara_resim']['name'];
                            $ara_resimkaynak        = $_FILES['ara_resim']['tmp_name'];

                            $gresim                = $_POST['gresim'];
                            $ara_resimg                = $_POST['ara_resimg'];
                            $benzer            = $_POST['benzer'];
                            // $iconad				= $_FILES['icon']['name'];  	 
                            //$gicon				= $_POST['gicon']; 

                            $kresimad            = $_FILES['kresim']['name'];
                            $gkresim            = $_POST['gkresim'];

                            //$vresimad			= $_FILES['vresim']['name']; 
                            //$vkaynak			= $_FILES['vresim']['tmp_name']; 
                            //$gvresim			= $_POST['gvresim'];  

                            //$pdfad				= $_FILES['pdf']['name']; 

                            $rhedef                = "../uploads/";

                            $yeniurlmiz         =  $_POST['seourl'];

                            $seosor            = $mysqli->query("select * from seo where seo='$yeniurlmiz' && id!='$seoID' ");
                            $seoyazz        = $seosor->fetch_array();
                            $seosay         = $seosor->num_rows;
                            if ($seosay > 0) {
                                $sonurl =  $yeniurlmiz . '-' . rand(0, 100);
                            } else {
                                $sonurl = $yeniurlmiz;
                            }

                            $seoguncelle = $mysqli->query("update seo set seo='$sonurl', durum='$durum' where id='$seoID' ");


                            $gonder      = $mysqli->query(" update $konu set  
		
		fiyat 				='$fiyat', 

		kodu 				='$kodu', 
		marka 				='$marka', 
	 
		katID 				='$katID', 
		
		renk 				='$renk',
	 
		baslik 				='$baslik', 
		onyazi 				='$onyazi', 
		icerik 				='$icerik', 
		keywords 			='$keywords', 
		description			='$description',
		KDV                 ='$kdv',
		colSayi				= '$colSayi',
		anasayfa			= '$anasayfa',
		bayiozel			= '$bayiozel',
		sira				= '$sira',
		anasayfa_sira		= '$anasayfa_sira',
		tumsıralama			='$tumsıralama',
		dil					= '$dil', 
		durum				= '$durum',
		stok				= '$stok',
		yeni_urun			= '$yeni_urun',
		ara_durum 			='$ara_durum',
		kol_durum 			='$kol_durum',
		ara_resim_link		='$ara_resim_link',
		fiyatdurumu 		='$fiyatdurumu'
		where id='$id'
	  ");

                            if ($gonder) {
                                $icerikID    = $id;
                                foreach ($_POST['ozellik'] as $key => $value) {
                                    $mysqli->query("UPDATE urunozelliksec SET icerik='{$value}', sira='{$_POST['ozelliksira'][$key]}' WHERE id={$key}");
                                }

                                $renklerisil = $mysqli->query("DELETE from urunrenksec where urunID = $id");
                                foreach ($renk as $key => $value) {
                                    $mysqli->query("INSERT INTO urunrenksec (urunID, renkID) values ($id, $value)");
                                    //$mysqli->query("UPDATE urunrenksec set renkID = $value where id = $key");
                                }


                                //resimler 
                                if ($ustresimad != "") {

                                    unlink($rhedef . $gustresim);
                                    $kaynak        = $_FILES['resim']['tmp_name'];
                                    $resimsonad = rand(0, 999) . '-' . yeniurl(res_adi($ustresimad)) . res_uzanti($ustresimad);
                                    $yukle         = move_uploaded_file($ustkaynak, $rhedef . "/" . $resimsonad);
                                    $guncelle     = $mysqli->query("update $konu set ustresim='$resimsonad' where id='$id' ");
                                }

                                if ($ara_resimad != "") {

                                    unlink($rhedef . $ara_resimg);
                                    $kaynak        = $_FILES['ara_resim']['tmp_name'];
                                    $resimsonadd = rand(0, 999) . '-' . yeniurl(res_adi($ara_resimad)) . res_uzanti($ara_resimad);
                                    $yukle         = move_uploaded_file($kaynak, $rhedef . "/" . $resimsonadd);
                                    $guncelle     = $mysqli->query("update $konu set ara_resim='$resimsonadd' where id='$id' ");
                                }


                                // if($iconad!=""){ 	 

                                // unlink($rhedef.$gicon);		
                                // $kaynak1		= $_FILES['icon']['tmp_name'];
                                // $resimsonad1 	= rand(0,999).'-'.yeniurl(res_adi($iconad)).res_uzanti($iconad);
                                // $yukle 			= move_uploaded_file($kaynak1,$rhedef."/".$resimsonad1); 
                                // $guncelle 		= $mysqli->query("update $konu set icon='$resimsonad1' where id='$id' ");	
                                // }

                                if ($kresimad != "") {

                                    unlink($rhedef . $gkresim);
                                    $kaynak1        = $_FILES['kresim']['tmp_name'];
                                    $resimsonad1     = rand(0, 999) . '-' . yeniurl(res_adi($kresimad)) . res_uzanti($kresimad);
                                    $yukle             = move_uploaded_file($kaynak1, $rhedef . "/" . $resimsonad1);
                                    $guncelle         = $mysqli->query("update $konu set kresim='$resimsonad1' where id='$id' ");
                                }

                                // $renksay 		= count($renk);
                                // for($rr=0; $rr<$renksay; $rr++){
                                // 	$renkID 	= $renk[$rr];
                                //    $renkekle = $mysqli->query("insert into urunrenksec (urunID, renkID)  values ('$icerikID', '$renkID' )  ");
                                // }

                                $urunrenksil    = count($renk);
                                for ($rr = 0; $rr < $urunrenksil; $rr++) {
                                    $renkID = $renk[$rr];
                                    $renksil = $mysqli->query("DELETE FROM `urunrenksec` WHERE `id` = $renkID");
                                }


                                if ($resimad != "") {

                                    unlink($rhedef . $gresim);
                                    $kaynak        = $_FILES['resim']['tmp_name'];
                                    $resimsonad = rand(0, 999) . '-' . yeniurl(res_adi($resimad)) . res_uzanti($resimad);
                                    $yukle         = move_uploaded_file($kaynak, $rhedef . "/" . $resimsonad);
                                    $guncelle     = $mysqli->query("update $konu set resim='$resimsonad' where id='$id' ");
                                }

                                if ($vresimad != "") {

                                    unlink($rhedef . $gvresim);
                                    $kaynak1        = $_FILES['vresim']['tmp_name'];
                                    $resimsonad1     = rand(0, 999) . '-' . yeniurl(res_adi($vresimad)) . res_uzanti($vresimad);
                                    $yukle             = move_uploaded_file($kaynak1, $rhedef . "/" . $resimsonad1);
                                    $guncelle         = $mysqli->query("update $konu set vresim='$resimsonad1' where id='$id' ");
                                }

                                if ($pdfad != "") {

                                    $gpdf                = $_POST['gpdf'];
                                    unlink($rhedef . $gpdf);
                                    $kaynak1        = $_FILES['pdf']['tmp_name'];
                                    $yukle             = move_uploaded_file($kaynak1, $rhedef . "/" . $pdfad);
                                    $guncelle         = $mysqli->query("update $konu set pdf='$pdfad' where id='$id' ");
                                }

                                //etiketler 
                                $ebakp = explode(",", $etiket);
                                $esay =   count($ebakp);
                                $etsil = $mysqli->query("delete from etiket where konu=$konu && konuID='$id'  ");

                                for ($yy = 0; $yy < $esay; $yy++) {
                                    $etiket1  = trim($ebakp[$yy]);
                                    if ($etiket1 != "") {
                                        $etiketekle = $mysqli->query("insert into etiket (`baslik`, `seo`, `konu`, `konuID` ) values ('$etiket1' , '$seoID' , $konu , '$id' ) ");
                                    }
                                }

                                $eskiressay     = count($eskiresimler);
                                $esgun             = $mysqli->query("update galeri set durum='0' where icerikID='$id' && konu='$konu' ");
                                for ($dd = 0; $dd < $eskiressay; $dd++) {
                                    $resID            = $eskiresimler[$dd];

                                    $esgun             = $mysqli->query("update galeri set durum='1' where icerikID='$id' && id='$resID' && konu='$konu' ");
                                }


                                if ($rtopluad[0] != "") {

                                    for ($x = 0; $x < $say; $x++) {

                                        $rbaslik    = $rtopluad[$x];
                                        $rkaynak    = $rtoplukaynak[$x];
                                        $rsonadi     = $x . '-' . yeniurl(res_adi($rbaslik)) . res_uzanti($rbaslik);


                                        //echo $rbaslik.'<br/>';
                                        $vyukle = $mysqli->query("insert into galeri (icerikID, konu, baslik, resim, sira ,durum ) values('$id','$konu','$rbaslik','$rsonadi' ,  '0', '1'   ) ");

                                        $yukle     = move_uploaded_file($rkaynak, $rhedef . "/" . $rsonadi);
                                        // kucult($rhedef, $rsonadi);	
                                    }
                                }

                                $eskiiconsay     = count($eskiicon);
                                $esgun             = $mysqli->query("update galeri set durum='0' where icerikID='$id' && konu='icon' ");
                                for ($dd = 0; $dd < $eskiiconsay; $dd++) {
                                    $resID            = $eskiicon[$dd];

                                    $esgun             = $mysqli->query("update galeri set durum='1' where icerikID='$id' && id='$resID' && konu='icon' ");
                                }

                                if ($iconad[0] != "") {

                                    for ($x = 0; $x < $iconsay; $x++) {

                                        $rbaslik    = $iconad[$x];
                                        $rkaynak    = $iconkaynak[$x];
                                        $rsonadi     = rand(0, 9999) . '-' . yeniurl(res_adi($rbaslik)) . res_uzanti($rbaslik);

                                        //echo $rbaslik.'<br/>';
                                        $vyukle = $mysqli->query("insert into galeri (icerikID, konu, baslik, resim, sira ,durum ) values('$id','icon','$rbaslik','$rsonadi' ,  '0', '1'   ) ");

                                        $yukle     = move_uploaded_file($rkaynak, $rhedef . "/" . $rsonadi);
                                        // kucult($rhedef, $rsonadi);	
                                    }
                                }

                                $eskidosyasay     = count($eskidosya);
                                $esgun             = $mysqli->query("update dosya set durum='0' where icerikID='$id' && konu='$konu' ");
                                for ($dd = 0; $dd < $eskiressay; $dd++) {
                                    $resID            = $eskiresimler[$dd];

                                    $esgun             = $mysqli->query("update dosya set durum='1' where icerikID='$id' && id='$resID' && konu='$konu' ");
                                }


                                if ($dosyaad[0] != "") {

                                    $dosyaguncel  = $mysqli->query("update dosya set durum='0' where icerikID='$id' && konu='$konu' ");

                                    for ($x = 0; $x < $dosyasay; $x++) {

                                        $rbaslik    = $dosyaad[$x];
                                        $rkaynak    = $dosyakaynak[$x];
                                        $rsonadi     = rand(0, 9999) . '-' . yeniurl(res_adi($rbaslik)) . res_uzanti($rbaslik);

                                        //echo $rbaslik.'<br/>';
                                        $vyukle = $mysqli->query("insert into dosya (icerikID, konu, baslik, resim, sira ,durum ) values('$id','urun','$rbaslik','$rsonadi' ,  '0', '1'   ) ");

                                        $yukle     = move_uploaded_file($rkaynak, $rhedef . "/" . $rsonadi);
                                        // kucult($rhedef, $rsonadi);	
                                    }
                                }
                                $ozelliksay     = count($ozel);

                                $ozelliksay     = count($ozel);



                                // 	for($pp=0; $pp<$ozelliksay; $pp++){
                                // 		$ozellikID	= $ozelIDD[$pp];
                                // 		$ozsira1	= $ozsira[$pp];
                                // 		$icerikk	= trim($ozel[$pp]);

                                //  $ozellikekle = $mysqli->query("insert into urunozelliksec (`urunID`, `ozellikID`, `icerik` , `sira`) values ('$icerikID' , '$ozellikID' , '$icerikk', '$ozsira1'  ) ");
                                // 	}

                                $benzersil         = $mysqli->query("delete from urunbenzer where urunID='$id'  ");
                                $benzersay     = count($benzer);
                                echo $benzersay;
                                for ($zz = 0; $zz < $benzersay; $zz++) {
                                    $benzerID    = $benzer[$zz];
                                    $benzerekle = $mysqli->query("insert into urunbenzer (`urunID`, `benzerID`) values ('$id' , '$benzerID' ) ");
                                }




                                //$ozellikekle = $mysqli->query("insert into urunozelliksec (`urunID`, `ozellikID`, `icerik`, `sira` ) values ('$icerikID' , '$ozellikID' , '$icerikk', '$ozsira1' ) ");




                                // $projesil = $mysqli->query("delete from hazirkatsec where hazirID='$id' ");		
                                // $projesay 	= count($proje);		 
                                // for($pp=0; $pp<$projesay; $pp++){ 
                                // $proje1	= $proje[$pp];
                                // $bolumekle = $mysqli->query("insert into hazirkatsec (`hazirID`, `katID`) values ('$id' , '$proje1' ) ");
                                // }

                                // $urunsil = $mysqli->query("delete from bolumlerurun where icerikID='$id' ");
                                // $urunsay 	= count($urun);  	 
                                // for($zz=0; $zz<$urunsay; $zz++){ 
                                // $urun1	= $urun[$zz];
                                // $bolumekle2 = $mysqli->query("insert into bolumlerurun (`urun`, `icerikID`) values ('$urun1' , '$id' ) ");
                                // }

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
	                                <label for="baslik" class="col-sm-2 col-form-label"> <i class="fa fa-language"></i> Dil </label>


	                                <div class="col-2">

	                                    <select class="custom-select task-manager-list-select" name="dil">

	                                        <?php $dilbak = $mysqli->query("select * from diller ");

                                            while ($dilyaz = $dilbak->fetch_array()) {
                                                if ($dilyaz['id'] == $dil) {
                                                    echo '<option value="' . $dilyaz['id'] . '" selected>' . $dilyaz['baslik'] . '</option>';
                                                } else {
                                                    echo '<option value="' . $dilyaz['id'] . '">' . $dilyaz['baslik'] . '</option>';
                                                }
                                            }

                                            ?>
	                                    </select>


	                                </div>

	                            </div>


	                            <div class="form-group row">
	                                <label for="baslik" class="col-sm-2 col-form-label">Başlık * </label>
	                                <div class="col-sm-6">
	                                    <input type="text" name="baslik" class="form-control" id="baslik" placeholder="Başlık" value="<?php echo $yaz['baslik']; ?>" required>
	                                </div>
	                            </div>



	                            <div class="form-group row">
	                                <label for="kodu" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Kodu * </label>
	                                <div class="col-sm-2">
	                                    <input type="text" name="kodu" class="form-control" id="kodu" placeholder="Kodu" value="<?php echo $yaz['kodu']; ?>" required>
	                                </div>
	                            </div>


	                            <div class="form-group row">
	                                <label for="fiyat" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Fiyat / <?php echo $pribimyaz['simge']; ?></label>
	                                <div class="col-sm-1">
	                                    <input type="text" name="fiyat" class="form-control" id="fiyat" placeholder="Fiyat" value="<?php echo $yaz['fiyat']; ?>" aria-describedby="validationTooltipUsernamePrepend">

	                                </div>

	                                <div class="input-group-prepend">
	                                    <span class="input-group-text" id="validationTooltipUsernamePrepend"><?php echo $pribimyaz['simge']; ?></span>
	                                </div>

	                            </div>

	                            <div class="form-group row">
	                                <label for="stok" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Stok * </label>
	                                <div class="col-sm-1">
	                                    <input type="text" name="stok" class="form-control" placeholder="Stok" value="<?php echo $yaz['stok']; ?>" aria-describedby="validationTooltipUsernamePrepend">
	                                </div>
	                            </div>

	                            <div class="form-group row">
	                                <label for="kdv" class="col-sm-2 mt-4 col-form-label"> KDV * </label>

	                                <div class="col-sm-2">
	                                    <label for="kdv"></label>
	                                    <select name="kdv" class="custom-select task-manager-list-select">
	                                        <?php
                                            $kdvs = $mysqli->query("SELECT * FROM kdv ORDER BY sira DESC");
                                            while ($kdvler = $kdvs->fetch_assoc()) {
                                            ?><option value="<?php echo $kdvler['oran']; ?>" <?php if ($yaz['KDV'] == $kdvler['oran']) {
                                                                                                    echo 'selected';
                                                                                                } ?>>
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
	                                        <option value="0" <?php if (@$yaz['fiyatdurumu'] == 0) {
                                                                    echo 'selected';
                                                                } ?>>Sadece Bayi
	                                        <option value="1" <?php if (@$yaz['fiyatdurumu'] == 1) {
                                                                    echo 'selected';
                                                                } ?>>Herkes
	                                    </select>
	                                </div>
	                            </div>


	                            <!-- <?php // $renkbul = $mysqli->query("SELECT * FROM urunrenk where id =")  
                                        ?>
	  <div class="form-group row">
		<label for="baslik" class="col-sm-2 col-form-label">Renk  </label>
		<div class="col-sm-1">
		<input type="text" name="renk" maxlength="7" class="form-control jscolor" value="<?php echo $yaz['renk']; ?>">
		 
		</div>
	</div>   -->



	                            <script type="text/javascript">
	                                $(function() {

	                                    $("select[name=katID]").change(function() {

	                                        var katID = $("select[name=katID]").val();

	                                        $.ajax({
	                                            url: "pages/urun/skat.php",
	                                            type: "POST",
	                                            data: {
	                                                "katID": katID
	                                            },
	                                            success: function(enaltkat) {
	                                                $("#enaltkat").html(enaltkat);
	                                            }
	                                        });
	                                    });


	                                });
	                            </script>


	                            <div class="form-group row">
	                                <label for="ustkatID" class="col-sm-2 mt-4 col-form-label"> Kategori * </label>


	                                <?php
                                    $okatID         = $yaz['katID'];
                                    $okatbul         = $mysqli->query("select * from $kategori where id='$okatID' ");
                                    $okatyaz         = $okatbul->fetch_array();

                                    $digerKatlar = $mysqli->query("SELECT * FROM $kategori where id != $okatID");
                                    ?>


	                                <div class="col-sm-2">
	                                    <label for="katID"></label>
	                                    <select name="katID" class="custom-select task-manager-list-select" id="altkat">
	                                        <option value="<?php echo $okatID; ?>"><?php echo $okatyaz['baslik']; ?></option>

	                                        <?php while ($digerkat = $digerKatlar->fetch_array()) { ?>
	                                            <option value="<?php echo $digerkat['id']; ?>"><?php echo $digerkat['baslik']; ?></option>

	                                        <?php } ?>
	                                    </select>
	                                </div>






	                            </div>



	                            <div class="form-group row">
	                                <label for="ustresim" class="col-sm-2 col-form-label"><i class="nav-icon fa fa-image"></i> Üst Resim ( 1920 * 450) * </label>
	                                <div class="col-sm-3">
	                                    <input type="file" name="ustresim" class="form-control" id="ustresim" placeholder=" ">
	                                    <small id="ustresim" class="ul-form__text form-text "> Yeni resim istemiyorsanız işlem yapmayınız </small>

	                                    <input type="hidden" name="gustresim" value="<?php echo $yaz['ustresim']; ?>">

	                                </div>

	                                <a href="../uploads/<?php echo $yaz['ustresim']; ?>" target="_blank">
	                                    <img src="../uploads/<?php echo $yaz['ustresim']; ?>" title="Büyük Resim" alt="Büyük Resim" style="background-color:#ddd; height:100px; "></a>


	                            </div>


	                            <!--
	
	 <div class="form-group row">
		<label for="baslik" class="col-sm-2 col-form-label"> Üst İçerik </label>
		 
			 
		<div class="col-sm-2">
		 
		<select class="custom-select task-manager-list-select " name="katID" >
		
		<option value=""> Ana İçerik</option>
		
		<?php
                            $kbak  = $mysqli->query("select * from $konu where dil='$dil' order by sira asc ");
                            while ($kyaz = $kbak->fetch_array()) {
                                if ($kyaz['id'] == $yaz['katID']) {
                                    echo '<option value="' . $kyaz['id'] . '" selected >' . $kyaz['baslik'] . '</option> ';
                                } else {
                                    echo '<option value="' . $kyaz['id'] . '">' . $kyaz['baslik'] . '</option> ';
                                }
                            }
        ?>
		 </select>
		</div>	
	 
	</div> 	
	
	
	 <div class="form-group row">
		<label for="icon" class="col-sm-2 col-form-label">İcon  ( 32 * 32 ) </label>
		<div class="col-sm-3">
		  <input type="file" name="icon" class="form-control" id="icon" placeholder=""   > 
		  <input type="hidden" name="gicon"  value="<?php echo $yaz['icon']; ?>"   > 
		  <small id="icon" class="ul-form__text form-text "> Yeni resim istemiyorsanız işlem yapmayınız </small>	
			 				
		</div>
	<a href="../uploads/<?php echo $yaz['icon']; ?>" target="_blank" >
 <img src="../uploads/<?php echo $yaz['icon']; ?>" title="  Resim" alt=" Resim" style="background-color:#ddd; width:50px; margin-right:20px; "></a>
	
	 
	 
	
	
	
	</div>
	
	
	 <div class="form-group row bg-light p-2" id="yenirsimmm">
	<label for="resim" class="col-sm-2 col-form-label"><i class="nav-icon i-Video-Photographer"></i>  İconlar </label>
	
	<div class="col-12">
	<div class="col-sm-2 float-left">
	
	<input type="file" name="icon[]" multiple="multiple" class="form-control" id="resim" placeholder="Resimler"  style="float:left; " > 
	  <small id="web" class="ul-form__text form-text "> Birden fazla resim seçebilirsiniz </small>
	 </div>
		 
	 </div>
		
		<hr/>
		
	
	<?php $ressbakk = $mysqli->query("select * from galeri where konu='icon' && icerikID='$id' && durum='1' ");

                            while ($ressyaz = $ressbakk->fetch_array()) {

                                echo '<div class="col-sm-2">
	   
<a href="../uploads/' . $ressyaz['resim'] . '" target="_blank" >
<img src="../uploads/' . $ressyaz['resim'] . '" title="Büyük Resim" alt="Büyük Resim" style="background-color:#ddd;  height:100px; "></a>
<input type="hidden" name="eskiicon[]" value="' . $ressyaz['id'] . '"> 
	<br/>
	<br/> 
	 <a class="btn btn-danger text-white btn-rounded resimsill1 " href="#"> Resmi Sil </a> 
	</div>';
                            }

    ?>	
  
	 
 </div>  
 
 -->


	                            <div class="form-group row">
	                                <label for="marka" class="col-sm-2 col-form-label"> Marka Seçin </label>
	                                <div class="col-sm-2">
	                                    <label for="marka"> </label>
	                                    <select class="custom-select task-manager-list-select" name="marka" id="marka">
	                                        <option value="">Marka Seçin </option>

	                                        <?php
                                            $markabak  = $mysqli->query("select * from urunmarka  order by sira asc ");
                                            while ($markayaz = $markabak->fetch_array()) {
                                                if ($markayaz['id'] == $yaz['marka']) {
                                                    echo '<option value=' . $markayaz['id'] . ' selected >' . $markayaz['baslik'] . '</option>';
                                                } else {
                                                    echo '<option value=' . $markayaz['id'] . ' >' . $markayaz['baslik'] . '</option>';
                                                }
                                            }

                                            ?>

	                                    </select>
	                                </div>
	                            </div>


	                            <div class="form-group row">
	                                <label for="onyazi" class="col-sm-2 col-form-label"> Ön Yazı </label>
	                                <div class="col-sm-10">
	                                    <textarea name="onyazi" class="form-control" id="onyazi" cols="50" rows="2" placeholder="Ön Yazı"><?php echo $yaz['onyazi']; ?></textarea>

	                                </div>
	                            </div>


	                            <div class="form-group row">
	                                <label for="icerik" class="col-sm-2 col-form-label"> Açıklama </label>
	                                <div class="col-sm-10">
	                                    <textarea name="icerik" class="ckeditor" id="icerik" cols="40" rows="3"><?php echo $yaz['icerik']; ?></textarea>

	                                </div>
	                            </div>


	                            <hr />
	                            <!-- <div class="form-group row">
		<label for="teknik" class="col-sm-2 col-form-label"> Şartname  </label>
		<div class="col-sm-10">
		<textarea name="teknik" class="ckeditor" id="teknik" cols="40" rows="3"><?php echo $yaz['teknik']; ?></textarea>
	  
		</div> 
	</div> -->


	                            <div class="form-group row">
	                                <label for="kresim" class="col-sm-2 col-form-label"><i class="nav-icon fa fa-image"></i> Küçük Resim * </label>
	                                <div class="col-sm-2">
	                                    <input type="file" name="kresim" class="form-control" id="kresim" placeholder="Küçük Resim Boyutu">
	                                    <input type="hidden" name="gkresim" value="<?php echo $yaz['kresim']; ?>">


	                                </div>
	                                <a href="../uploads/<?php echo $yaz['kresim']; ?>" target="_blank">
	                                    <img src="../uploads/<?php echo $yaz['kresim']; ?>" title="Küçük Resim" alt="Küçük Resim" style="background-color:#ddd; width:50px; "></a>
	                            </div>


	                            <div class="form-group row">
	                                <label for="resim" class="col-sm-2 col-form-label"><i class="nav-icon fa fa-image"></i> Resim ( 750 * 864)* </label>
	                                <div class="col-sm-3">
	                                    <input type="file" name="resim" class="form-control" id="resim" placeholder="">
	                                    <small id="resim" class="ul-form__text form-text "> Yeni resim istemiyorsanız işlem yapmayınız </small>
	                                    <input type="hidden" name="gresim" value="<?php echo $yaz['resim']; ?>">


	                                </div>
	                                <a href="../uploads/<?php echo $yaz['resim']; ?>" target="_blank">
	                                    <img src="../uploads/<?php echo $yaz['resim']; ?>" title=" Resim" alt=" Resim" style="background-color:#ddd; width:50px; "></a>
	                            </div>


	                            <hr>



	                            <!--	<div class="form-group row">
		<label for="vbaslik" class="col-sm-2 col-form-label"> Demo Site URL  * </label>
		<div class="col-sm-6">
		 <input type="text" name="vbaslik" class="form-control" id="vbaslik" placeholder="Demo Site URL" value="<?php echo $yaz['vbaslik']; ?>" required >
		</div>
	</div>
	
		
	<div class="form-group row">
		<label for="vaciklama" class="col-sm-2 col-form-label"> Demo Panel URL  * </label>
		<div class="col-sm-6">
		 <input type="text" name="vaciklama" class="form-control" id="vaciklama" placeholder="Demo Panel URL" value="<?php echo $yaz['vaciklama']; ?>" required >
		</div>
	</div> 
	
 
	
	
			<div class="form-group row">
		<label for="icerik" class="col-sm-2 col-form-label"> Kategoriler  </label>
		
	<?php
                            $pbak = $mysqli->query("select * from $kategori where dil='$dil' && durum='1' && ustkatID='0' order by sira asc ");
                            while ($pyaz = $pbak->fetch_array()) {
                                $pbakID     = $pyaz['id'];
                                echo  '<div class="card-title col-sm-2">' . $pyaz['baslik'] . ' : ';

                                $pabak = $mysqli->query("select * from $kategori where dil='$dil' && durum='1' && ustkatID='$pbakID' order by sira asc ");
                                while ($payaz = $pabak->fetch_array()) {

                                    $payazID     = $payaz['id'];
                                    $pbakk         = $mysqli->query("select * from hazirkatsec where hazirID='$id' && katID='$payazID'  ");
                                    $psay         = $pbakk->num_rows;

                                    if ($psay > 0) {
                                        $sec = 'checked';
                                    } else {
                                        $sec = '';
                                    }
                                    echo '<label class="checkbox checkbox-primary mr-2">
		<input type="checkbox" name="proje[]" value="' . $payaz['id'] . '" ' . $sec . ' >
		<span>' . $payaz['baslik'] . '</span>
		<span class="checkmark"></span> 
		</label>';
                                }
                                echo '</div><br/>';
                            }
    ?>	
		      
		 
	</div> 
	
	
  
	 
	 <div class="form-group row">
		<label for="vlink" class="col-sm-2 col-form-label"><i class="fa fa-play"></i> Video Link </label>
		<div class="col-sm-6">
		 <input type="text" name="vlink" class="form-control" id="vlink" placeholder="Video Link" value="<?php echo $yaz['vlink']; ?>"  >
		 <small id="passwordHelpBlock" class="ul-form__text form-text "> Video Link Boş Bırakırsanız İçerikte Video Bölümü Çalışmaz </small>	
		</div>
	</div>
	
	
  <div class="form-group row">
		<label for="vresim" class="col-sm-2 col-form-label"><i class="nav-icon fa fa-image"></i> Video Resim  ( 800* 600) </label>
		<div class="col-sm-3">
		  <input type="file" name="vresim" class="form-control" id="vresim" placeholder=""   > 
		  <small id="vresim" class="ul-form__text form-text "> Yeni resim istemiyorsanız işlem yapmayınız </small>	
		  <input type="hidden" name="gvresim"  value="<?php echo $yaz['vresim']; ?>"   > 
		 
			 				
		</div>
	<a href="../uploads/<?php echo $konu; ?>/<?php echo $yaz['vresim']; ?>" target="_blank" >
	<img src="../uploads/<?php echo $konu; ?>/<?php echo $yaz['vresim']; ?>" title=" Resim" alt=" Resim" style="background-color:#ddd; width:50px; "></a>
	</div>
	 -->


	                            <!-- <div class="form-group row">
									<label for="pdf" class="col-sm-2 col-form-label"> <i class="nav-icon i-Data-Upload"></i> Döküman </label>
									<div class="col-sm-2">
										<input type="file" name="pdf" class="form-control" id="pdf" placeholder="">
										<input type="hidden" name="gpdf" value="<?php echo $yaz['pdf']; ?>">
									</div>

									<a href="../uploads/<?php echo $yaz['pdf']; ?>" target="_blank"> <?php echo $yaz['pdf']; ?> </a>

								</div> -->
	                            <hr>

	                            <div class="bg-transparent">
	                                <h3 class="card-title"> Ara Resim Özellikler </h3>
	                            </div>

	                            <div class="form-group row">
	                                <label for="ara_resim" class="col-sm-2 col-form-label"><i class="nav-icon fa fa-image"></i> Ara Resim </label>
	                                <div class="col-sm-3">
	                                    <input type="file" name="ara_resim" class="form-control" id="ara_resim" placeholder="">
	                                    <small id="ara_resim" class="ul-form__text form-text "> Yeni resim istemiyorsanız işlem yapmayınız </small>
	                                    <input type="hidden" name="ara_resimg" value="<?php echo $yaz['ara_resim']; ?>">


	                                </div>
	                                <a href="../uploads/<?php echo $yaz['ara_resim']; ?>" target="_blank">
	                                    <img src="../uploads/<?php echo $yaz['ara_resim']; ?>" title=" Resim" alt=" Resim" style="background-color:#ddd; width:50px; "></a>
	                            </div>

	                            <div class="form-group row">
	                                <label for="colSayi" class="col-sm-2 col-form-label">Kolon Sayısı </label>
	                                <div class="col-sm-2">
	                                    <input type="text" name="colSayi" class="form-control" id="colSayi" placeholder="Kolon Sayısı ?/4" value="<?php echo $yaz['colSayi']; ?>">


	                                </div>

	                            </div>
	                            <div class="form-group row">
	                                <label for="ara_resim_link" class="col-sm-2 col-form-label"> Link </label>
	                                <div class="col-sm-6">
	                                    <input type="text" name="ara_resim_link" class="form-control" id="ara_resim_link" placeholder="Ara Resim Linki" value="<?php echo $yaz['ara_resim_link'] ?>">
	                                </div>
	                            </div>

	                            <div class="form-group row">
	                                <label for="kdv" class="col-sm-2 mt-4 col-form-label"> Ara Resim Durum * </label>

	                                <div class="col-sm-2">
	                                    <label for="kdv"></label>
	                                    <select name="ara_durum" class="custom-select task-manager-list-select">
	                                        <option value="1" <?php if ($yaz['ara_durum'] == 1) {
                                                                    echo 'selected';
                                                                } ?>>
	                                            Açık </option>

	                                        <option value="0" <?php if ($yaz['ara_durum'] == 0) {
                                                                    echo 'selected';
                                                                } ?>>
	                                            Kapalı </option>
	                                    </select>
	                                </div>
	                            </div>

	                            <hr>


	                            <div class="form-group row bg-light p-2" id="yenirsimmm">
	                                <label for="resim" class="col-sm-2 col-form-label"><i class="nav-icon i-Video-Photographer"></i> Yeni Resimler Ekle </label>

	                                <div class="col-12">
	                                    <div class="col-sm-2 float-left">

	                                        <input type="file" name="rtoplu[]" multiple="multiple" class="form-control" id="resim" placeholder="Resimler" style="float:left; ">
	                                        <small id="web" class="ul-form__text form-text "> Birden fazla resim seçebilirsiniz </small>
	                                    </div>

	                                </div>

	                                <hr />


	                                <?php $ressbakk = $mysqli->query("select * from galeri where konu='$konu' && icerikID='$id' && durum='1' ");

                                    while ($ressyaz = $ressbakk->fetch_array()) {

                                        echo '<div class="col-sm-2">
	   
<a href="../uploads/' . $ressyaz['resim'] . '" target="_blank" >
<img src="../uploads/' . $ressyaz['resim'] . '" title="Büyük Resim" alt="Büyük Resim" style="background-color:#ddd;  height:100px; "></a>
<input type="hidden" name="eskiresimler[]" value="' . $ressyaz['id'] . '"> 
	<br/>
	<br/> 
	 <a class="btn btn-danger text-white btn-rounded resimsill1 " href="#"> Resmi Sil </a> 
	</div>';
                                    }

                                    ?>


	                            </div>
	                            <hr>

	                            <div class="card-body">
	                                <div class="form-group row">



	                                    <?php $ozbak = $mysqli->query("select * from urunozellik where dil='$dil' order by sira asc  ");
                                        $yyy = 1;
                                        while ($ozyaz = $ozbak->fetch_array()) {
                                            $ozellikbul = $mysqli->query("SELECT * FROM urunozelliksec where urunID = $id AND ozellikID={$ozyaz['id']}")->fetch_assoc();
                                        ?>
	                                        <div class="col-md-2" style="display: grid">
	                                            <label for="ozellik<?php echo $yyy; ?>" class="action-bar-horizontal-label col-form-label">
	                                                <span style="font-size:12px; "><?php echo $ozyaz['baslik'] ?>:</span>
	                                            </label>
	                                        </div>
	                                        <div class="col-md-10 row mb-3">
	                                            <textarea name="ozellik[<?php echo $ozellikbul['id'] ?>]" class="form-control col-md-10" id="ozellik<?php echo $yyy; ?>" cols="100%" rows="2"><?php echo ($ozellikbul) ? $ozellikbul['icerik'] : ""; ?></textarea>
	                                            <?php
                                                ?>
	                                            <input type="text" name="ozelliksira[<?php echo $ozellikbul['id'] ?>]" size="1" class="form-control col-md-1" value="<?php echo ($ozellikbul) ? $ozellikbul['sira'] : ""; ?>" style="display:block;  height:48px; margin-left:5px;  ">

	                                        </div>
	                                    <?php
                                            $yyy++;
                                        }
                                        ?>
	                                </div>
	                            </div>
	                            <hr />


	                            <div class="form-group row">
	                                <label for="icerik" class="col-sm-2 col-form-label"> Renk Seç </label>

	                                <?php
                                    $renkbak = $mysqli->query("select * from urunrenk where dil='$dil'   order by sira asc ");
                                    while ($renkyaz = $renkbak->fetch_array()) {
                                        $renkID = $renkyaz['id'];
                                        $urunrenksec = $mysqli->query("SELECT * FROM urunrenksec where urunID = $id AND renkID = $renkID")->fetch_array();
                                    ?>
	                                    <label class="checkbox checkbox-primary mr-2">
	                                        <input type="checkbox" name="renk[]" value="<?php echo $renkyaz['id']; ?>" <?php echo ($urunrenksec) ? 'checked' : '' ?>>
	                                        <span><?php echo $renkyaz['baslik']; ?></span>
	                                        <span class="checkmark"></span>
	                                    </label>
	                                <?php
                                    }
                                    ?>


	                            </div>

	                            <hr>

	                            <?php /*	<div class="form-group row">
									<label for="icerik" class="col-sm-2 col-form-label"> <strong> Benzer İçerikler </strong> </label>

									<?php
									$urunbak = $mysqli->query("select * from  $konu  where dil='$dil' && durum='1' && id != '$id' order by sira asc ");
									while ($uruyaz = $urunbak->fetch_array()) {
										$benzerID = $uruyaz['id'];

										$benbak = $mysqli->query("select * from urunbenzer where urunID ='$id' && benzerID='$benzerID' ")->num_rows;
										if ($benbak > 0) {
											$bennn = 'checked';
										} else {
											$bennn = '';
										}
									?>
										<label class="checkbox checkbox-primary mr-2">
											<input type="checkbox" name="benzer[]" value="<?php echo $uruyaz['id']; ?> <?php echo $bennn ?>">
											<span><?php echo $uruyaz['baslik']; ?></span>
											<span class="checkmark"></span>
										</label>
									<?php
									}
									?>

									

									<?php
									$urunsor = $mysqli->query("SELECT * FROM urun where id != $id and dil = $dil ORDER BY sira DESC");
									while ($bUrunYaz = $urunsor->fetch_array()) {
										$benzerSor = $mysqli->query("SELECT * FROM urunbenzer where urunID = $id ")->fetch_array();
									?>



										<label class="checkbox checkbox-primary mr-2">
											<input type="checkbox" name="benzer[]" value="<?php echo $bUrunYaz['id']; ?>" <?php echo ($benzerSor == true) ? 'checked' : ''; ?>>
											<span><?php echo $bUrunYaz['baslik']; ?></span>
											<span class="checkmark"></span>
										</label>
									<?php } ?>



								</div> */ ?>





	                            <div class="form-group row">
	                                <label for="seourl11" class="col-sm-2 col-form-label">Seo URL * </label>
	                                <div class="col-sm-6">
	                                    <input type="text" name="seourl" class="form-control" id="seourl11" placeholder="Seo URL" value="<?php echo $seoyaz['seo']; ?>">


	                                </div>

	                            </div>


	                            <div class="form-group row">
	                                <label for="keywords" class="col-sm-2 col-form-label">Keywords </label>
	                                <div class="col-sm-6">
	                                    <input type="text" name="keywords" class="form-control" id="keywords" placeholder="Keywords" value="<?php echo $yaz['keywords']; ?>">


	                                </div>

	                            </div>

	                            <div class="form-group row">
	                                <label for="description" class="col-sm-2 col-form-label">Description </label>
	                                <div class="col-sm-6">
	                                    <input type="text" name="description" class="form-control" id="description" placeholder="Description" value="<?php echo $yaz['description']; ?>">


	                                </div>

	                            </div>



	                            <div class="form-group row">
	                                <label for="etiket" class="col-sm-2 col-form-label">Etiketler </label>
	                                <div class="col-sm-6">
	                                    <input type="text" name="etiket" class="form-control" id="etiket" placeholder="Etiketler" value="<?php $etbak = $mysqli->query("select * from etiket where konu='$konu' && konuID='$id'  ");
                                                                                                                                            while ($etyaz = $etbak->fetch_array()) {

                                                                                                                                                echo trim($etyaz['baslik']) . ' ,';
                                                                                                                                            }
                                                                                                                                            ?>">

	                                </div>

	                                <div class="col-sm-2">


	                                    <small id="passwordHelpBlock" class="ul-form__text form-text "> Virgül ile ayırınız </small>
	                                </div>

	                            </div>


	                            <div class="form-group row">
	                                <label for="hit" class="col-sm-2 col-form-label">Hit </label>
	                                <div class="col-sm-1">
	                                    <input type="text" name="hit" class="form-control" id="hit" placeholder="Hit" value="<?php echo $yaz['hit']; ?>">


	                                </div>

	                            </div>


	                            <div class="form-group row">
	                                <label for="sira" class="col-sm-2 col-form-label">Sıra </label>
	                                <div class="col-sm-1">
	                                    <input type="text" name="sira" class="form-control" id="sira" placeholder="Sıra" value="<?php echo $yaz['sira']; ?>">


	                                </div>

	                            </div>

	                            <div class="form-group row">
	                                <label for="anasayfa_sira" class="col-sm-2 col-form-label">Anasayfa Sıra </label>
	                                <div class="col-sm-1">
	                                    <input type="text" name="anasayfa_sira" class="form-control" id="anasayfa_sira" placeholder="Anasayfa Sıra" value="<?php echo $yaz['anasayfa_sira']; ?>">


	                                </div>

	                            </div>

	                            <div class="form-group row">
	                                <label for="tumsıralama" class="col-sm-2 col-form-label">Koleksiyonlar Sıra </label>
	                                <div class="col-sm-1">
	                                    <input type="text" name="tumsıralama" class="form-control" id="tumsıralama" placeholder="Tüm Ürünler Sıra" value="<?php echo $yaz['tumsıralama']; ?>">


	                                </div>

	                            </div>


	                            <div class="form-group row">
	                                <label for="durum" class="col-sm-2 col-form-label">Durum </label>
	                                <div class="col-sm-2">

	                                    <label class="switch switch-primary mr-3" id="durum">

	                                        <input name="durum" type="checkbox" <?php if ($yaz['durum'] == "1") {
                                                                                    echo 'checked';
                                                                                } ?>>

	                                        <span class="slider"></span>
	                                    </label>

	                                </div>

	                            </div>

	                            <div class="form-group row">
	                                <label for="anasayfa" class="col-sm-2 col-form-label">Anasayfa </label>
	                                <div class="col-sm-2">

	                                    <label class="switch switch-primary mr-3" id="anasayfa">

	                                        <input name="anasayfa" type="checkbox" <?php if ($yaz['anasayfa'] == "1") {
                                                                                        echo 'checked';
                                                                                    } else {
                                                                                        echo '';
                                                                                    } ?>>

	                                        <span class="slider"></span>
	                                    </label>

	                                </div>

	                            </div>


	                            <div class="form-group row">
	                                <label for="bayiozel" class="col-sm-2 col-form-label"> Bayiye Özel </label>
	                                <div class="col-sm-2">

	                                    <label class="switch switch-primary mr-3" id="bayiozel">

	                                        <input name="bayiozel" type="checkbox" <?php if ($yaz['bayiozel'] == "1") {
                                                                                        echo 'checked';
                                                                                    } else {
                                                                                        echo '';
                                                                                    } ?>>

	                                        <span class="slider"></span>
	                                    </label>

	                                </div>

	                            </div>


	                            <div class="form-group row">
	                                <label for="kol_durum" class="col-sm-2 col-form-label"> Koleksiyon'da Göster </label>
	                                <div class="col-sm-2">

	                                    <label class="switch switch-primary mr-3" id="kol_durum">

	                                        <input name="kol_durum" type="checkbox" <?php if ($yaz['kol_durum'] == "1") {
                                                                                        echo 'checked';
                                                                                    } else {
                                                                                        echo '';
                                                                                    } ?>>

	                                        <span class="slider"></span>
	                                    </label>

	                                </div>

	                            </div>

	                            <div class="form-group row">
	                                <label for="yeni_urun" class="col-sm-2 col-form-label"> Yeni Ürün </label>
	                                <div class="col-sm-2">

	                                    <label class="switch switch-primary mr-3" id="yeni_urun">

	                                        <input name="yeni_urun" type="checkbox" <?php if ($yaz['yeni_urun'] == "1") {
                                                                                        echo 'checked';
                                                                                    } else {
                                                                                        echo '';
                                                                                    } ?>>

	                                        <span class="slider"></span>
	                                    </label>

	                                </div>

	                            </div>
	                            <hr />

	                            <div class="form-group row">
	                                <label for="ekleyen" class="col-sm-2 col-form-label">Ekleyen </label>
	                                <div class="col-sm-2">
	                                    <?php echo $yaz['ekleyen']; ?>


	                                </div>

	                            </div>

	                            <div class="form-group row">
	                                <label for="eklemetarih" class="col-sm-2 col-form-label">Ekleme Tarihi </label>
	                                <div class="col-sm-2">
	                                    <?php echo $yaz['tarih']; ?>


	                                </div>

	                            </div>

	                            <div class="form-group row">
	                                <label for="eklemetarih" class="col-sm-2 col-form-label">IP </label>
	                                <div class="col-sm-2">
	                                    <?php echo $yaz['ip']; ?>


	                                </div>

	                            </div>



	                            <div class="form-group row">
	                                <label for="sira" class="col-sm-2 col-form-label"> </label>
	                                <div class="col-sm-10">
	                                    <button type="submit" class="btn btn-primary ul-btn__text">İçerik Güncelle</button>

	                                </div>
	                            </div>

	                        </form>

	                    <?php } ?>
	                </div>
	            </div>
	        </div>
	    </div>

	</div>