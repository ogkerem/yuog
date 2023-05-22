	<?php

	defined('YUOG') or exit('No direct script access allowed / Yetkisiz Erişim ');

	$sistem 	= $_GET['sistem'];
	$konu 		= "sahap";
	$kategori 	= "kategori";
	$kat 		= $konu . 'kat';
	$sistemyaz 	= $mysqli->query("select * from sistem where id='$sistem' ")->fetch_array();
	$menu		= $sistemyaz['menu'];

	$id 	= $_GET['id'];
	$yaz 	= $mysqli->query("select * from $konu where id='$id' ")->fetch_array();

	$seoID 	= $yaz['seo'];
	$seoyaz	= $mysqli->query("select * from seo where id='$seoID' ")->fetch_array();

	$dil 	= $yaz['dil'];
	$dilyaz = $mysqli->query("select * from diller where id='$dil' ")->fetch_array();


	?>

	<div class="main-content">

		<div class="breadcrumb">

			<h1> <a href="?sy=sahap&sistem=<?php echo $sistem; ?>"> <?php echo $menu; ?> </a> > <?php echo $dilyaz['baslik']; ?> </h1>

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
				<span aria-hidden="true">×</span>
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


							$baslik				= addslashes(trim($_POST['baslik']));
							$kodu				= addslashes(trim($_POST['kodu']));
							$fiyat				= addslashes(trim($_POST['fiyat']));
							$kat1				= (int)$_POST['kat1'];
							$kat2				= (int)$_POST['kat2'];
							$kat3				= (int)$_POST['kat3'];
							$renk				= addslashes(trim($_POST['renk']));
							$onyazi				= addslashes(trim($_POST['onyazi']));
							$icerik				= addslashes(trim($_POST['icerik']));
							$teknik				= addslashes(trim($_POST['teknik']));

							$ustresimad			= $_FILES['ustresim']['name'];
							$ustkaynak			= $_FILES['ustresim']['tmp_name'];
							$gustresim			= $_POST['gustresim'];

							$iconad				= $_FILES['icon']['name'];
							$iconkaynak			= $_FILES['icon']['tmp_name'];
							$gicon				= $_POST['gicon'];

							$marka				= (int)$_POST['marka'];

							$resimad			= $_FILES['resim']['name'];
							$kaynak				= $_FILES['resim']['tmp_name'];
							$gresim				= $_POST['gresim'];

							$eskiresimler		= $_POST['eskiresimler'];
							$rtopluad			= $_FILES['rtoplu']['name'];
							$rtoplukaynak		= $_FILES['rtoplu']['tmp_name'];
							$say 				= count($rtopluad);

							$keywords			= addslashes(trim($_POST['keywords']));
							$description		= addslashes(trim($_POST['description']));
							$etiket				= addslashes(trim($_POST['etiket']));

							$yazar				= addslashes(trim($_POST['yazar']));
							$tarih				= $_POST['tarih'];

							$vresimad			= $_FILES['vresim']['name'];
							$vkaynak			= $_FILES['vresim']['tmp_name'];
							$gvresim			= $_POST['gvresim'];
							$video				= addslashes(trim($_POST['video']));

							$videokod			= addslashes(trim($_POST['videokod']));

							$pdfad				= $_FILES['pdf']['name'];
							$pdfkaynak			= $_FILES['pdf']['tmp_name'];
							$gpdf				= $_POST['gpdf'];

							$eskidosya			= $_POST['eskidosya'];
							$dosyaad			= $_FILES['dosya']['name'];
							$dosyakaynak		= $_FILES['dosya']['tmp_name'];
							$gdosya				= $_POST['gdosya'];
							$dosyasay 			= count($dosyaad);

							$anasayfa			= $_POST['anasayfa'];
							$sira				= (int)($_POST['sira']);

							$son1				= addslashes(trim($_POST['son1']));
							$son2				= addslashes(trim($_POST['son2']));
							$son3				= addslashes(trim($_POST['son3']));

							$durum 				= $_POST['durum'];

							$kresimad			= $_FILES['kresim']['name'];
							$gkresim			= $_POST['gkresim'];

							$hit				= $_POST['hit'];

							$dilgsecilen		= $_POST['dil'];

							$rhedef				= "../uploads/";

							$yeniurlmiz 		=  $_POST['seourl'];

							$seosor			= $mysqli->query("select * from seo where seo='$yeniurlmiz' && id!='$seoID' ");
							$seoyazz		= $seosor->fetch_array();
							$seosay 		= $seosor->num_rows;
							if ($seosay > 0) {
								$sonurl = rand(0, 100) . '-' . $yeniurlmiz;
							} else {
								$sonurl = $yeniurlmiz;
							}

							$seoguncelle = $mysqli->query("update seo set seo='$sonurl', durum='$durum' where id='$seoID' ");


							$gonder  	= $mysqli->query(" update $konu set  
		 
		baslik 				='$baslik', 
		onyazi 				='$onyazi', 
		 
		kodu 				='$kodu', 
		fiyat 				='$fiyat', 
		renk 				='$renk', 
		marka 				='$marka', 
		kat1 				='$kat1', 
		kat2 				='$kat2', 
		kat3 				='$kat3', 
		 
		icerik1 			='$icerik', 
		teknik1 			='$teknik', 
		video 				='$video', 
		 
		videokod			='$videokod',   
		keywords 			='$keywords', 
		description			='$description', 
		tarih				='$tarih', 
		yazar				='$yazar', 
		  
		anasayfa			= '$anasayfa', 
		son1				= '$son1',
		son2				= '$son2',
		son3				= '$son3',
	   
		
		hit					= '1',
		sira				= '$sira',
		dil					= '$dilgsecilen',
	 	
		durum				= '$durum'  
		 
		where id='$id'
	 
	  ");

							if ($gonder) {
								$icerikID	= $id;

								//resimler 
								if ($ustresimad != "") {

									unlink($rhedef . $gustresim);
									$kaynak		= $_FILES['resim']['tmp_name'];
									$resimsonad = rand(0, 999) . '-' . yeniurl(res_adi($ustresimad)) . res_uzanti($ustresimad);
									$yukle 		= move_uploaded_file($ustkaynak, $rhedef . "/" . $resimsonad);
									$guncelle 	= $mysqli->query("update $konu set ustresim='$resimsonad' where id='$id' ");
								}

								if ($iconad != "") {

									unlink($rhedef . $gicon);
									$kaynak1		= $_FILES['icon']['tmp_name'];
									$resimsonad1 	= rand(0, 999) . '-' . yeniurl(res_adi($iconad)) . res_uzanti($iconad);
									$yukle 			= move_uploaded_file($kaynak1, $rhedef . "/" . $resimsonad1);
									$guncelle 		= $mysqli->query("update $konu set icon='$resimsonad1' where id='$id' ");
								}

								if ($kresimad != "") {

									unlink($rhedef . $gkresim);
									$kaynak1		= $_FILES['kresim']['tmp_name'];
									$resimsonad1 	= rand(0, 999) . '-' . yeniurl(res_adi($kresimad)) . res_uzanti($kresimad);
									$yukle 			= move_uploaded_file($kaynak1, $rhedef . "/" . $resimsonad1);
									$guncelle 		= $mysqli->query("update $konu set kresim='$resimsonad1' where id='$id' ");
								}


								if ($resimad != "") {

									unlink($rhedef . $gresim);
									$kaynak		= $_FILES['resim']['tmp_name'];
									$resimsonad = rand(0, 999) . '-' . yeniurl(res_adi($resimad)) . res_uzanti($resimad);
									$yukle 		= move_uploaded_file($kaynak, $rhedef . "/" . $resimsonad);
									$guncelle 	= $mysqli->query("update $konu set resim='$resimsonad' where id='$id' ");
								}

								if ($vresimad != "") {

									unlink($rhedef . $gvresim);
									$kaynak1		= $_FILES['vresim']['tmp_name'];
									$resimsonad1 	= rand(0, 999) . '-' . yeniurl(res_adi($vresimad)) . res_uzanti($vresimad);
									$yukle 			= move_uploaded_file($kaynak1, $rhedef . "/" . $resimsonad1);
									$guncelle 		= $mysqli->query("update $konu set vresim='$resimsonad1' where id='$id' ");
								}

								if ($pdfad != "") {

									$gpdf				= $_POST['gpdf'];
									unlink($rhedef . $gpdf);
									$kaynak1		= $_FILES['pdf']['tmp_name'];
									$yukle 			= move_uploaded_file($kaynak1, $rhedef . "/" . $pdfad);
									$guncelle 		= $mysqli->query("update $konu set pdf='$pdfad' where id='$id' ");
								}

								//etiketler 
								$ebakp = explode(",", $etiket);
								$esay =   count($ebakp);
								$etsil = $mysqli->query("delete from etiket where menu=$sistem && konuID='$id'  ");

								for ($yy = 0; $yy < $esay; $yy++) {
									$etiket1  = trim($ebakp[$yy]);
									if ($etiket1 != "") {
										$etiketekle = $mysqli->query("insert into etiket (`menu`, `baslik`, `seo`, `konu`, `konuID` ) values ('$sistem' ,'$etiket1' , '$seoID' , $konu , '$id' ) ");
									}
								}

								$eskiressay 	= count($eskiresimler);
								$esgun 			= $mysqli->query("update galeri set durum='' where menu='$sistem' && icerikID='$id'  ");
								for ($dd = 0; $dd < $eskiressay; $dd++) {
									$resID			= $eskiresimler[$dd];
									$esgun 			= $mysqli->query("update galeri set durum='on' where menu='$sistem' && icerikID='$id' && id='$resID'   ");
								}

								if ($rtopluad[0] != "") {

									for ($x = 0; $x < $say; $x++) {
										$rbaslik	= $rtopluad[$x];
										$rkaynak	= $rtoplukaynak[$x];
										$rsonadi 	= $x . '-' . yeniurl(res_adi($rbaslik)) . res_uzanti($rbaslik);
										$vyukle = $mysqli->query("insert into galeri (menu, icerikID, konu, baslik, resim, sira ,durum ) values('$sistem','$id','$konu','$rbaslik','$rsonadi' ,  '0', 'on'   ) ");
										$yukle 	= move_uploaded_file($rkaynak, $rhedef . "/" . $rsonadi);
									}
								}

								$eskidosyasay 	= count($eskidosya);
								$esgun 			= $mysqli->query("update dosya set durum='' where icerikID='$id' && menu='$sistem' ");
								for ($dd = 0; $dd < $eskidosyasay; $dd++) {
									$resID			= $eskidosya[$dd];
									$esgun 			= $mysqli->query("update dosya set durum='on' where icerikID='$id' && id='$resID' && menu='$sistem' ");
								}
								if ($dosyaad[0] != "") {
									// $dosyaguncel  = $mysqli->query("update dosya set durum='' where icerikID='$id' && menu='$sistem' "); 
									for ($x = 0; $x < $dosyasay; $x++) {
										$rbaslik	= $dosyaad[$x];
										$rkaynak	= $dosyakaynak[$x];
										$rsonadi 	= rand(0, 9999) . '-' . yeniurl(res_adi($rbaslik)) . res_uzanti($rbaslik);
										$vyukle = $mysqli->query("insert into dosya (menu, icerikID, konu, baslik, resim, sira ,durum ) values('$sistem','$id','urun','$rbaslik','$rsonadi' ,  '0', 'on'   ) ");
										$yukle 	= move_uploaded_file($rkaynak, $rhedef . "/" . $rsonadi);
									}
								}

								header("Location: ?sy=sahap&sistem=" . $sistem . "&islem=basarili");
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
									<label for="dil" class="col-sm-2 col-form-label"> <i class="fa fa-language"></i> Dil </label>

									<div class="col-2">

										<select class="custom-select task-manager-list-select" id="dil" name="dil">

											<?php $dilbak = $mysqli->query("select * from diller order by sira asc ");

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


								<?php if ($sistemyaz['baslik'] == "on") {  ?>
									<div class="form-group row">
										<label for="baslik" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Başlık * </label>
										<div class="col-sm-6">
											<input type="text" name="baslik" class="form-control" id="baslik" placeholder="Başlık" value="<?php echo $yaz['baslik']; ?>" required>
										</div>
									</div>

								<?php } ?>


								<?php if ($sistemyaz['kodu'] == "on") { ?>
									<div class="form-group row">
										<label for="kodu" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Kodu </label>
										<div class="col-sm-2">
											<input type="text" name="kodu" class="form-control" id="kodu" placeholder="Kodu" value="<?php echo $yaz['kodu']; ?>">
										</div>
									</div>
								<?php } ?>


								<?php if ($sistemyaz['fiyat'] == "on") { ?>
									<div class="form-group row">
										<label for="fiyat" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Fiyat </label>
										<div class="col-sm-1">
											<input type="text" name="fiyat" class="form-control" id="fiyat" placeholder="Fiyat" value="<?php echo $yaz['fiyat']; ?>" aria-describedby="validationTooltipUsernamePrepend">

										</div> Örn. 65₺

										<!--	<div class="input-group-prepend">
			<span class="input-group-text" id="validationTooltipUsernamePrepend">TL</span>
		</div> -->

									</div>

								<?php } ?>


								<script type="text/javascript">
									$(function() {
										$("select[name=kat1]").change(function() {

											var ustkatID = $("select[name=kat1]").val();
											var sistem = $("input[name=sistem]").val();

											$.ajax({
												url: "pages/sahap/ukatbak.php",
												type: "POST",
												data: {
													"ustkatID": ustkatID,
													"sistem": sistem
												},
												success: function(ortakat) {
													$("#kat2").html(ortakat);
												}
											});
										});


										$("select[name=kat2]").change(function() {

											var katID = $("select[name=kat2]").val();
											var sistem = $("input[name=sistem]").val();

											$.ajax({
												url: "pages/sahap/skat.php",
												type: "POST",
												data: {
													"katID": katID,
													"sistem": sistem
												},
												success: function(enaltkat) {
													$("#kat3").html(enaltkat);
												}
											});
										});


									});
								</script>


								<?php if ($sistemyaz['kat1'] == "on") { ?>

									<div class="form-group row">
										<label for="kat1" class="col-sm-2 col-form-label"> Kategori * </label>
										<div class="col-sm-2">

											<input type="hidden" name="sistem" value="<?php echo $sistem; ?>">

											<label for="kat1"> </label>
											<select class="custom-select task-manager-list-select" name="kat1" required>
												<option value=""> Kategori Seçin * </option>
												<?php
												$ukat  = $mysqli->query("select * from $kategori where ustkatID='0' && dil='$dil' && katID='0' && menu='$sistem' order by sira asc ");
												while ($uyaz = $ukat->fetch_array()) {

													if ($yaz['kat1'] == $uyaz['id']) {
														echo '<option value=' . $uyaz['id'] . ' selected >' . $uyaz['baslik'] . '</option>';
													} else {
														echo '<option value=' . $uyaz['id'] . ' >' . $uyaz['baslik'] . '</option>';
													}
												}
												?>
											</select>
										</div>

										<?php if ($sistemyaz['kat2'] == "on") { ?>


											<?php
											$kat2 			= $yaz['kat2'];
											$kat2yaz 		= $mysqli->query("select * from $kategori where id='$kat2' && menu='$sistem' ")->fetch_array();
											?>


											<div class="col-sm-2">
												<label for="kat2"> </label>
												<select name="kat2" class="custom-select task-manager-list-select" id="kat2">
													<option value="<?php echo $kat2; ?>"><?php echo $kat2yaz['baslik']; ?></option>
												</select>
												<small id="resim" class="ul-form__text form-text "> Orta Kategorisi yoksa seçmeyiniz </small>
											</div>

										<?php } ?>

										<?php if ($sistemyaz['kat3'] == "on") { ?>

											<?php
											$kat3			= $yaz['kat3'];
											$kat3yaz		= $mysqli->query("select * from $kategori where id='$kat3' ")->fetch_array();


											?>

											<div class="col-sm-2">
												<label for="kat3"> </label>
												<select name="kat3" class="custom-select task-manager-list-select" id="kat3">
													<option value="<?php echo $kat3; ?>"><?php echo $kat3yaz['baslik']; ?></option>
												</select>
												<small id="resim" class="ul-form__text form-text "> Enalt Kategorisi yoksa seçmeyiniz </small>
											</div>
										<?php } ?>

									</div>

								<?php } ?>



								<?php if ($sistemyaz['renk'] == "on") { ?>
									<div class="form-group row">
										<label for="renk" class="col-sm-2 col-form-label"><i class="fa fa-colors"></i> Renk </label>
										<div class="col-sm-1">
											<input type="text" name="renk" maxlength="7" id="renk" class="form-control jscolor" value="<?php echo $yaz['renk']; ?>">

										</div>
									</div>
								<?php } ?>


								<?php if ($sistemyaz['ustresim'] == "on") { ?>
									<div class="form-group row">
										<label for="ustresim" class="col-sm-2 col-form-label"><i class="nav-icon fa fa-image"></i> Üst Resim </label>
										<div class="col-sm-3">
											<input type="file" name="ustresim" class="form-control" id="ustresim" placeholder=" ">
											<small id="ustresim" class="ul-form__text form-text "> Yeni resim istemiyorsanız işlem yapmayınız </small>

											<input type="hidden" name="gustresim" value="<?php echo $yaz['ustresim']; ?>">

										</div>

										<a href="../uploads/<?php echo $yaz['ustresim']; ?>" target="_blank">
											<img src="../uploads/<?php echo $yaz['ustresim']; ?>" title="Büyük Resim" alt="Büyük Resim" style="background-color:#ddd; height:100px; "></a>


									</div>
								<?php } ?>



								<?php if ($sistemyaz['icon'] == "on") { ?>
									<div class="form-group row">
										<label for="icon" class="col-sm-2 col-form-label"> <i class="nav-icon fa fa-image"></i> İcon </label>
										<div class="col-sm-2">
											<input type="file" name="icon" class="form-control" id="icon" placeholder="">
											<input type="hidden" name="gicon" value="<?php echo $yaz['icon']; ?>">


										</div>
										<a href="../uploads/<?php echo $yaz['icon']; ?>" target="_blank">
											<img src="../uploads/<?php echo $yaz['icon']; ?>" title="icon" alt="İcon" style="background-color:#ddd; height:100px; "></a>
									</div>
								<?php } ?>



								<?php if ($sistemyaz['marka'] == "on") { ?>
									<div class="form-group row">
										<label for="marka" class="col-sm-2 col-form-label"> Marka Seçin </label>
										<div class="col-sm-2">
											<label for="marka"> </label>
											<select class="custom-select task-manager-list-select" name="marka" id="marka">
												<option value="">Marka Seçin </option>

												<?php
												$markabak  = $mysqli->query("select * from marka  where durum='on' order by sira asc ");
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
								<?php } ?>



								<?php if ($sistemyaz['onyazi'] == "on") { ?>
									<div class="form-group row">
										<label for="onyazi" class="col-sm-2 col-form-label"> Ön Yazı </label>
										<div class="col-sm-10">
											<textarea name="onyazi" class="form-control" id="onyazi" cols="50" rows="2" placeholder="Ön Yazı"><?php echo $yaz['onyazi']; ?></textarea>

										</div>
									</div>
								<?php } ?>


								<?php if ($sistemyaz['icerik1'] == "on") { ?>
									<div class="form-group row">
										<label for="icerik" class="col-sm-2 col-form-label"> Açıklama </label>
										<div class="col-sm-10">
											<textarea name="icerik" class="ckeditor" id="icerik" cols="40" rows="3"><?php echo $yaz['icerik1']; ?></textarea>

										</div>
									</div>
								<?php } ?>


								<?php if ($sistemyaz['teknik1'] == "on") { ?>
									<hr>
									<div class="form-group row">
										<label for="teknik" class="col-sm-2 col-form-label"> Teknik </label>
										<div class="col-sm-10">
											<textarea name="teknik" class="ckeditor" id="teknik" cols="40" rows="3"><?php echo $yaz['teknik1']; ?></textarea>
										</div>
									</div>
								<?php } ?>


								<hr />


								<?php if ($sistemyaz['resim'] == "on") { ?>

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
										<label for="resim" class="col-sm-2 col-form-label"><i class="nav-icon fa fa-image"></i> Ana Resim ( <?php echo genel('nresim'); ?>) * </label>
										<div class="col-sm-2">
											<input type="file" name="resim" class="form-control" id="resim" placeholder="Küçük Resim Boyutu">
											<input type="hidden" name="gresim" value="<?php echo $yaz['resim']; ?>">
										</div>
										<a href="../uploads/<?php echo $yaz['resim']; ?>" target="_blank">
											<img src="../uploads/<?php echo $yaz['resim']; ?>" title="Resim" alt="resim" style="background-color:#ddd; height:50px; "></a>
										<div class="col-sm-2">
										</div>
									</div>

								<?php } ?>

								<?php if ($sistemyaz['galeri'] == "on") { ?>
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

										<?php $ressbakk = $mysqli->query("select * from galeri where menu='$sistem' && icerikID='$id' && durum='on' ");

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
								<?php } ?>


								<?php if ($sistemyaz['video'] == "on") { ?>
									<div class="form-group row">
										<label for="video" class="col-sm-2 col-form-label"><i class="fa fa-play"></i> Video Link </label>
										<div class="col-sm-6">
											<input type="text" name="video" class="form-control" id="video" placeholder="Video Link" value="<?php echo $yaz['video']; ?>">
											<small id="passwordHelpBlock" class="ul-form__text form-text "> Video Link Boş Bırakırsanız İçerikte Video Bölümü Çalışmaz </small>
										</div>
									</div>


									<div class="form-group row">
										<label for="vresim" class="col-sm-2 col-form-label"><i class="nav-icon fa fa-image"></i> Video Resim </label>
										<div class="col-sm-2">
											<input type="file" name="vresim" class="form-control" id="vresim" placeholder="">
											<input type="hidden" name="gvresim" value="<?php echo $yaz['vresim']; ?>">
										</div>
										<a href="../uploads/<?php echo $yaz['videoresim']; ?>" target="_blank">
											<img src="../uploads/<?php echo $yaz['videoresim']; ?>" title="Resim" alt="resim" style="background-color:#ddd; height:50px; "></a>
										<div class="col-sm-2">


										</div>

									</div>

								<?php } ?>



								<?php if ($sistemyaz['videokod'] == "on") { ?>
									<div class="form-group row">
										<label for="videokod" class="col-sm-2 col-form-label"> Video Kodu </label>
										<div class="col-sm-10">
											<textarea name="videokod" class="form-control" id="videokod" cols="50" rows="2" placeholder="Video Kodu"><?php echo $yaz['videokod']; ?></textarea>
										</div>
									</div>
								<?php } ?>



								<?php if ($sistemyaz['pdf'] == "on") { ?>
									<div class="form-group row">
										<label for="pdf" class="col-sm-2 col-form-label"> <i class="nav-icon i-Data-Upload"></i> Döküman </label>
										<div class="col-sm-2">
											<input type="file" name="pdf" class="form-control" id="pdf" placeholder="">
											<input type="hidden" name="gpdf" value="<?php echo $yaz['pdf']; ?>">
										</div>

										<a href="../uploads/<?php echo $yaz['pdf']; ?>" target="_blank"> <?php echo $yaz['pdf']; ?> </a>

									</div>
								<?php } ?>



								<?php if ($sistemyaz['dosya'] == "on") { ?>
									<hr>
									<div class="col-12">
										<label for="dosya" class="col-sm-2 col-form-label"> <i class="nav-icon i-Data-Upload"></i> Dökümanlar (pdf, word, excel vb.) </label>

										<div class="col-sm-2">
											<input type="file" name="dosya[]" multiple="multiple" class="form-control" id="dosya" placeholder="">
											<small id="passwordHelpBlock" class="ul-form__text form-text "> Toplu İçerik Ekleyebilirsiniz </small>
										</div>
										<hr />
										<div class="form-group row">
											<?php $dosyabak = $mysqli->query("select * from dosya where menu='$sistem' && icerikID='$id' && durum='on' ");

											while ($dosyayaz = $dosyabak->fetch_array()) {
												echo '<div class="col-sm-2"> 
<a href="../uploads/' . $dosyayaz['resim'] . '" target="_blank" > ' . $dosyayaz['baslik'] . ' ' . $dosyayaz['id'] . '</a>
<input type="hidden" name="eskidosya[]" value="' . $dosyayaz['id'] . '"> 
	<br/>
	<br/> 
	 <a class="btn btn-danger text-white btn-rounded resimsill1 " href="#"> Dosya Sil </a> 
	</div>';
											}
											?>
										</div>
									</div>
								<?php } ?>

								<hr>


								<?php if ($sistemyaz['seo'] == "on") { ?>
									<div class="form-group row">
										<label for="seourl" class="col-sm-2 col-form-label">Seo URL * </label>
										<div class="col-sm-6">
											<input type="text" name="seourl" class="form-control" id="seourl" placeholder="Seo URL" value="<?php echo $seoyaz['seo']; ?>">


										</div>

									</div>
								<?php } ?>



								<?php if ($sistemyaz['keywords'] == "on") { ?>

									<div class="form-group row">
										<label for="keywords" class="col-sm-2 col-form-label">Keywords </label>
										<div class="col-sm-6">
											<input type="text" name="keywords" class="form-control" id="keywords" placeholder="Keywords" value="<?php echo $yaz['keywords']; ?>">


										</div>

									</div>
								<?php } ?>


								<?php if ($sistemyaz['description'] == "on") { ?>

									<div class="form-group row">
										<label for="description" class="col-sm-2 col-form-label">Description </label>
										<div class="col-sm-6">
											<input type="text" name="description" class="form-control" id="description" placeholder="Description" value="<?php echo $yaz['description']; ?>">


										</div>

									</div>
								<?php } ?>


								<?php if ($sistemyaz['etiket'] == "on") { ?>
									<div class="form-group row">
										<label for="etiket" class="col-sm-2 col-form-label">Etiketler </label>
										<div class="col-sm-6">
											<input type="text" name="etiket" class="form-control" id="etiket" placeholder="Etiketler" value="<?php $etbak = $mysqli->query("select * from etiket where menu='$sistem' && konuID='$id'  ");
																																				while ($etyaz = $etbak->fetch_array()) {
																																					echo trim($etyaz['baslik']) . ' ,';
																																				}
																																				?>">
										</div>
										<div class="col-sm-2">
											<small id="passwordHelpBlock" class="ul-form__text form-text "> Virgül ile ayırınız </small>
										</div>
									</div>
								<?php } ?>





								<?php if ($sistemyaz['yazar'] == "on") { ?>
									<div class="form-group row">
										<label for="yazar" class="col-sm-2 col-form-label">Yazar </label>
										<div class="col-sm-3">
											<input type="text" name="yazar" class="form-control" id="yazar" placeholder="Yazar" value="<?php echo $yaz['yazar']; ?>">
										</div>

									</div>
								<?php } ?>


								<?php if ($sistemyaz['tarih'] == "on") { ?>

									<div class="form-group row">
										<label for="tarih" class="col-sm-2 col-form-label">Tarih </label>
										<div class="col-sm-2">
											<input type="date" name="tarih" max="31.12.2050" class="form-control " id="tarih" value="<?php echo date(substr($yaz['tarih'], 0, 10)); ?>">
										</div>
									</div>

								<?php } ?>


								<?php if ($sistemyaz['anasayfa'] == "on") { ?>
									<div class="form-group row">
										<label for="anasayfa" class="col-sm-2 col-form-label">Ana Sayfada Göster </label>
										<div class="col-sm-2">

											<label class="switch switch-warning mr-3" id="anasayfa">
												<input name="anasayfa" type="checkbox" <?php if ($yaz['anasayfa'] == "on") {
																							echo 'checked';
																						} ?> value="on">
												<span class="slider"></span>
											</label>
										</div>
									</div>
								<?php } ?>


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
									<label for="durum" class="col-sm-2 col-form-label">Durum </label>
									<div class="col-sm-2">

										<label class="switch switch-primary mr-3" id="durum">

											<input name="durum" type="checkbox" <?php if ($yaz['durum'] == "on") {
																					echo 'checked';
																				} ?>>

											<span class="slider"></span>
										</label>

									</div>

								</div>




								<?php if ($sistemyaz['obaslik1'] == "on") { ?>
									<div class="form-group row">
										<label for="otip1" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> <?php echo $sistemyaz['oacik1']; ?> </label>
										<?php if ($sistemyaz['otip1'] == "baslik") { ?>
											<div class="col-sm-6">
												<input type="text" name="son1" class="form-control" id="otip1" placeholder="<?php echo $sistemyaz['oacik1']; ?>" value="<?php echo $yaz['son1']; ?>">
											</div>
										<?php } elseif ($sistemyaz['otip1'] == "onyazi") {  ?>
											<div class="col-sm-10">
												<textarea name="son1" class="form-control" id="otip1" cols="50" rows="2" placeholder=""><?php echo $yaz['son1']; ?></textarea>
											</div>
										<?php } else {  ?>
											<div class="col-sm-10">
												<textarea name="son1" class="ckeditor" id="oacik4" cols="40" rows="3"><?php echo $yaz['son1']; ?></textarea>
											</div>
										<?php } ?>
									</div>
								<?php } ?>

								<?php if ($sistemyaz['obaslik2'] == "on") { ?>
									<div class="form-group row">
										<label for="otip2" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> <?php echo $sistemyaz['oacik2']; ?> </label>
										<?php if ($sistemyaz['otip2'] == "baslik") { ?>
											<div class="col-sm-6">
												<input type="text" name="son2" class="form-control" id="otip2" placeholder="<?php echo $sistemyaz['oacik2']; ?>" value="<?php echo $yaz['son2']; ?>">
											</div>
										<?php } elseif ($sistemyaz['otip2'] == "onyazi") {  ?>
											<div class="col-sm-10">
												<textarea name="son2" class="form-control" id="otip2" cols="50" rows="2" placeholder=""><?php echo $yaz['son2']; ?></textarea>
											</div>
										<?php } else {  ?>
											<div class="col-sm-10">
												<textarea name="son2" class="ckeditor" id="oacik5" cols="40" rows="3"><?php echo $yaz['son2']; ?></textarea>
											</div>
										<?php } ?>
									</div>
								<?php } ?>

								<?php if ($sistemyaz['obaslik3'] == "on") { ?>
									<div class="form-group row">
										<label for="otip3" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> <?php echo $sistemyaz['oacik3']; ?> </label>
										<?php if ($sistemyaz['otip3'] == "baslik") { ?>
											<div class="col-sm-6">
												<input type="text" name="son3" class="form-control" id="otip3" placeholder="<?php echo $sistemyaz['oacik3']; ?>" value="<?php echo $yaz['son3']; ?>">
											</div>
										<?php } elseif ($sistemyaz['otip3'] == "onyazi") {  ?>
											<div class="col-sm-10">
												<textarea name="son3" class="form-control" id="otip3" cols="50" rows="2" placeholder=""><?php echo $yaz['son3']; ?></textarea>
											</div>
										<?php } else {  ?>
											<div class="col-sm-10">
												<textarea name="son3" class="ckeditor" id="oacik6" cols="40" rows="3"><?php echo $yaz['son3']; ?></textarea>
											</div>
										<?php } ?>
									</div>
								<?php } ?>





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