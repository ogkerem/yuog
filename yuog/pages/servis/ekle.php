	<?php

	defined('YUOG') or exit('No direct script access allowed / Yetkisiz Erişim ');
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

	?>
	<div class="main-content">

		<div class="breadcrumb">
			<h1><a href="?sy=servis">Servis</a> > <?php echo $dilyaz['baslik']; ?> </h1>
			<ul>
				<li><a href="index.php">Ana Sayfa</a></li>
				<li>Servis Ekleme</li>


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

							$servis				= $_POST['servis'];

							$baslik				= addslashes(trim($_POST['baslik']));
							$onyazi				= addslashes(trim($_POST['onyazi']));
							$icerik				= addslashes(trim($_POST['icerik']));
							$keywords			= addslashes(trim($_POST['keywords']));
							$description		= addslashes(trim($_POST['description']));
							$etiket				= addslashes(trim($_POST['etiket']));
							$sira				= trim($_POST['sira']);
							$hit				= 1;
							$durum				= 1;
							$ekleyen			= $email;
							$ip					= $_SERVER['REMOTE_ADDR'];


							$kresimad			= $_FILES['kresim']['name'];
							$kkaynak			= $_FILES['kresim']['tmp_name'];

							$resimad			= $_FILES['resim']['name'];
							$kaynak				= $_FILES['resim']['tmp_name'];

							$resimsonad 		= rand(99999, 9999999) . '-' . yeniurl(res_adi($resimad)) . res_uzanti($resimad);
							$kresimsonad 		= rand(99999, 9999999) . '-' . yeniurl(res_adi($kresimad)) . res_uzanti($kresimad);


							$rhedef				= "../uploads/servis/";

							$yeniurlmiz =  $_POST['seourl'];

							$seosor		= $mysqli->query("select * from seo where seo='$yeniurlmiz' ");
							$seoyazz	= $seosor->fetch_array();
							$seosay 	= $seosor->num_rows;

							if ($seosay > 0) {
								$sonurl = rand(0, 100) . '-' . $yeniurlmiz;
							} else {
								$sonurl = $yeniurlmiz;
							}

							$seoekle 		= $mysqli->query("insert into seo (seo,konu, durum) values ('$sonurl', 'servis', '$durum')");
							$seoID			= $mysqli->insert_id;


							$gonder  	= $mysqli->query(" insert into servis set 
	
		baslik 				='$baslik', 
		onyazi 				='$onyazi', 
		icerik 				='$icerik', 
		keywords 			='$keywords', 
		description			='$description', 
		kresim				='$kresimsonad', 
		resim				='$resimsonad', 
		ip					='$ip', 
		tarih				= now(),
		ekleyen				= '$ekleyen',
		seo					= '$seoID',
		hit					= '$hit',
		sira				= '$sira',
		dil					= '$dil', 
		durum				= '$durum' 
	 
	  ");

							if ($gonder) {

								$icerikID	= $mysqli->insert_id;

								$yukle 		= move_uploaded_file($kaynak, $rhedef . "/" . $resimsonad);
								$yukle1		= move_uploaded_file($kkaynak, $rhedef . "/" . $kresimsonad);
								// kucult($rhedef, $resimsonad);	


								$ebakp = explode(",", $etiket);
								$esay =  count($ebakp);

								for ($yy = 0; $yy < $esay; $yy++) {
									$etiket1  = $ebakp[$yy];
									$etiketekle = $mysqli->query("insert into etiket (`baslik`, `seo`, `konu`, `konuID` ) values ('$etiket1' , '$seoID' , 'servis' , '$icerikID' ) ");
								}

								$servissay 	= count($servis);

								for ($pp = 0; $pp < $servissay; $pp++) {
									$servis1	= $servis[$pp];
									$bolumekle = $mysqli->query("insert into  urunservis (`servis`, `icerikID`) values ('$servis1' , '$icerikID' ) ");
								}



								header("Location:?sy=servis&islem=basarili");
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
									<label for="baslik" class="col-sm-2 col-form-label">İçerik Dili * </label>
									<div class="col-sm-6">

										<?php $dilbak1 = $mysqli->query("select * from diller  ");
										while ($dilyaz1 = $dilbak1->fetch_array()) {
											if ($dilyaz1['id'] == $dil) {

												echo '<a href="?sy=servisekle&dil=' . $dilyaz1['id'] . '"><button type="button" class="btn btn-raised btn-raised-primary m-1">' . $dilyaz1['baslik'] . '</button></a> ';
											} else {

												echo '<a href="?sy=servisekle&dil=' . $dilyaz1['id'] . '"><button type="button" class="btn btn-outline-primary m-1">' . $dilyaz1['baslik'] . '</button></a> ';
											}
										}
										?>

									</div>
								</div>


								<div class="form-group row">
									<label for="baslik" class="col-sm-2 col-form-label">Başlık * </label>
									<div class="col-sm-6">
										<input type="text" name="baslik" class="form-control" id="baslik" placeholder="Başlık" value="" required>
									</div>
								</div>

								<div class="form-group row">
									<label for="kresim" class="col-sm-2 col-form-label">İcon * (32 * 32) </label>
									<div class="col-sm-2">
										<input type="file" name="kresim" class="form-control" id="kresim" placeholder="Küçük Resim Boyutu" required>

									</div>

									<div class="col-sm-2">


									</div>

								</div>


								<div class="form-group row">
									<label for="onyazi" class="col-sm-2 col-form-label"> Ön Yazı </label>
									<div class="col-sm-10">
										<textarea name="onyazi" class="form-control" id="onyazi" cols="50" rows="2" placeholder="Ön Yazı"></textarea>

									</div>
								</div>


								<div class="form-group row">
									<label for="icerik" class="col-sm-2 col-form-label"> İçerik </label>
									<div class="col-sm-10">
										<textarea name="icerik" class="ckeditor" id="icerik" cols="40" rows="3"></textarea>

									</div>
								</div>





								<div class="form-group row">
									<label for="resim" class="col-sm-2 col-form-label">Resim * (1920 * 800) </label>
									<div class="col-sm-2">
										<input type="file" name="resim" class="form-control" id="resim" placeholder="Küçük Resim Boyutu" required>

									</div>

									<div class="col-sm-2">


									</div>

								</div>

								<hr />





								

								<hr />

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