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

	$sistemyaz 	= $mysqli->query("select * from bannerduzen where id='1' ")->fetch_array();

	?>

	<div class="main-content">

		<div class="breadcrumb">
			<h1>Banner Ekleme > <?php echo $dilyaz['baslik']; ?> </h1>
			<ul>
				<li><a href="index.php">Ana Sayfa</a></li>
				<li><a href="?sy=banner">Bannerler</a></li>


			</ul>
		</div>

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

							$renk				= addslashes(trim($_POST['renk']));
							$ustbaslik			= addslashes(trim($_POST['ustbaslik']));
							$ustbaslikrenk		= addslashes(trim($_POST['ustbaslikrenk']));
							$altbaslik			= addslashes(trim($_POST['altbaslik']));
							$altbaslikrenk		= addslashes(trim($_POST['altbaslikrenk']));
							$aciklama			= addslashes(trim($_POST['aciklama']));
							$aciklamarenk		= addslashes(trim($_POST['aciklamarenk']));
							$video				= addslashes(trim($_POST['video']));
							$link2				= addslashes(trim($_POST['link2']));
							$link2aciklama		= addslashes(trim($_POST['link2aciklama']));
							$link				= addslashes(trim($_POST['link']));
							$linkaciklama		= addslashes(trim($_POST['linkaciklama']));
							$vkod				= addslashes(trim($_POST['vkod']));

							$sira				= trim($_POST['sira']);
							$hit				= 1;
							$durum				= "on";
							$ekleyen			= $email;
							$ip					= $_SERVER['REMOTE_ADDR'];


							$resimad			= $_FILES['resim']['name'];
							$kaynak				= $_FILES['resim']['tmp_name'];
							$resimsonad 		= rand(0, 999) . '-' . yeniurl(res_adi($resimad)) . res_uzanti($resimad);


							$formatlar = array("jpg", "jpeg", "gif", "png", "mp3", "mp4", "wma");
							$extension = pathinfo($_FILES['dvideo']['name'], PATHINFO_EXTENSION);

							$dvideoad			= $_FILES['dvideo']['name'];
							$dvideokaynak		= $_FILES['dvideo']['tmp_name'];

							
							 
							if (in_array($extension, $formatlar)) {
								if ($_FILES["dvideo"]["error"] > 0) {
									echo "Return Code: " . $_FILES["dvideo"]["error"] . "<br />";
								} else {
									echo "Upload: " . $_FILES["dvideo"]["name"] . "<br />";
									echo "Type: " . $_FILES["dvideo"]["type"] . "<br />";
									echo "Size: " . ($_FILES["dvideo"]["size"] / 1024) . " Kb<br />";
									echo "Temp file: " . $_FILES["dvideo"]["tmp_name"] . "<br />";
									print_r(dirname(__DIR__, 3) . "/uploads/");


									$dvideoad			= $_FILES['dvideo']['name'];
									$dvideokaynak		= $_FILES['dvideo']['tmp_name'];
									$dvideosonad 		= rand(0, 999) . '-' . yeniurl(res_adi($dvideoad)) . res_uzanti($dvideoad);

									move_uploaded_file($_FILES['dvideo']['tmp_name'], dirname(__DIR__, 3) . "/videos/" . $dvideosonad);
								}
							} else {
								echo "Invalid file";
							}


							// $dvideoad			= $_FILES['dvideo']['name']  == "video/mp4";
							// $dvideokaynak		= $_FILES['dvideo']['tmp_name']; 
							// $dvideosonad 		= rand(0,999).'-'.yeniurl(res_adi($dvideoad)).res_uzanti($dvideoad);

							if ($sistemyaz['arkaresim'] == "on") {

								$arkaresimad			= $_FILES['arkaresim']['name'];
								$arkaresimkaynak		= $_FILES['arkaresim']['tmp_name'];
								$arkaresimsonad 		= rand(0, 999) . '-' . yeniurl(res_adi($arkaresimad)) . res_uzanti($arkaresimad);
							}

							if ($sistemyaz['dvideo'] == "on") {

								$dvideoad			= $_FILES['dvideo']['name'];
								$dvideokaynak		= $_FILES['dvideo']['tmp_name'];
								$dvideosonad 		= rand(0, 999) . '-' . yeniurl(res_adi($dvideoad)) . res_uzanti($dvideoad);
							}

							if ($sistemyaz['solresim'] == "on") {

								$solresimad			= $_FILES['solresim']['name'];
								$solresimkaynak		= $_FILES['solresim']['tmp_name'];
								$solresimsonad 		= rand(0, 999) . '-' . yeniurl(res_adi($solresimad)) . res_uzanti($solresimad);
							}

							if ($sistemyaz['sagresim'] == "on") {

								$sagresimad			= $_FILES['sagresim']['name'];
								$sagresimkaynak		= $_FILES['sagresim']['tmp_name'];
								$sagresimsonad 		= rand(0, 999) . '-' . yeniurl(res_adi($sagresimad)) . res_uzanti($sagresimad);
							}

							if ($sistemyaz['icon'] == "on") {

								$iconad			= $_FILES['icon']['name'];
								$iconkaynak		= $_FILES['icon']['tmp_name'];
								$iconsonad 		= rand(0, 999) . '-' . yeniurl(res_adi($iconad)) . res_uzanti($iconad);
							}

							$rhedef				= "../uploads/";


							$gonder  	= $mysqli->query(" insert into banner set 
	 renk 					='$renk', 
	 ustbaslik 				='$ustbaslik', 
	 ustbaslikrenk 			='$ustbaslikrenk', 
	 altbaslik 				='$altbaslik', 
	 altbaslikrenk 			='$altbaslikrenk', 
	 aciklama 				='$aciklama', 
	 aciklamarenk 			='$aciklamarenk', 
	 video					='$video', 
	 link2					='$link2', 
	 link2aciklama			='$link2aciklama', 
	 link					='$link', 
	 linkaciklama			='$linkaciklama', 
	 resim					='$resimsonad', 
	 arkaresim  			='$arkaresimsonad', 
	 solresim				='$solresimsonad', 
	 sagresim				='$sagresimsonad',   
	 icon					='$iconsonad',   
	 vkod					='$vkod',   
	 dvideo					= '$dvideosonad',
	 
	 ip						='$ip', 
	 tarih					= now(),
	 ekleyen				= '$ekleyen', 
	 hit					= '$hit',
	 sira					= '$sira',
	 dil					= '$dil',
	 durum					= '$durum'  
	 
	  ");

							if ($gonder) {

								$yukle 		= move_uploaded_file($kaynak, $rhedef . "/" . $resimsonad);
								$videoyukle = move_uploaded_file($dvideokaynak, $rhedef . "/" . $dvideosonad);


								if ($sistemyaz['arkaresim'] == "on") {
									$arkaresimyukle 		= move_uploaded_file($arkaresimkaynak, $rhedef . "/" . $arkaresimsonad);
								}

								if ($sistemyaz['solresim'] == "on") {
									$solresimyukle 		= move_uploaded_file($solresimkaynak, $rhedef . "/" . $solresimsonad);
								}

								if ($sistemyaz['sagresim'] == "on") {
									$sagresimyukle 		= move_uploaded_file($sagresimkaynak, $rhedef . "/" . $sagresimsonad);
								}

								if ($sistemyaz['icon'] == "on") {
									$iconyukle 		= move_uploaded_file($iconkaynak, $rhedef . "/" . $iconsonad);
								}

								$videoyukle 		= move_uploaded_file($dvideokaynak, $rhedef . "/" . $dvideosonad);

								header("Location:?sy=banner&islem=basarili");
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

										<?php $dilbak1 = $mysqli->query("select * from diller order by sira asc ");
										while ($dilyaz1 = $dilbak1->fetch_array()) {
											if ($dilyaz1['id'] == $dil) {

												echo '<a href="?sy=bannerekle&dil=' . $dilyaz1['id'] . '"><button type="button" class="btn btn-raised btn-raised-primary m-1">' . $dilyaz1['baslik'] . '</button></a> ';
											} else {

												echo '<a href="?sy=bannerekle&dil=' . $dilyaz1['id'] . '"><button type="button" class="btn btn-outline-primary m-1">' . $dilyaz1['baslik'] . '</button></a> ';
											}
										}
										?>

									</div>
								</div>

								<?php if ($sistemyaz['renk'] == "on") { ?>
									<div class="form-group row">
										<label for="baslik" class="col-sm-2 col-form-label">Renk </label>
										<div class="col-sm-1">
											<input type="text" name="renk" maxlength="7" class="form-control jscolor" value="1d376c">

										</div>
									</div>
								<?php } ?>

								<?php if ($sistemyaz['ustbaslik'] == "on") { ?>
									<div class="form-group row">
										<label for="ustbaslik" class="col-sm-2 col-form-label">Üst Başlık </label>
										<div class="col-sm-6">
											<input type="text" name="ustbaslik" class="form-control" id="ustbaslik" placeholder="Üst Başlık" autofocus value="">
										</div>
									</div>
								<?php } ?>

								<?php if ($sistemyaz['ustbaslikrenk'] == "on") { ?>
									<div class="form-group row">
										<label for="ustbaslikrenk" class="col-sm-2 col-form-label">Üst Başlık Renk </label>
										<div class="col-sm-1">
											<input type="text" name="ustbaslikrenk" maxlength="7" class="form-control jscolor" value="1d376c">

										</div>
									</div>
								<?php } ?>


								<?php if ($sistemyaz['altbaslik'] == "on") { ?>
									<div class="form-group row">
										<label for="altbaslik" class="col-sm-2 col-form-label">Alt Başlık </label>
										<div class="col-sm-6">
											<input type="text" name="altbaslik" class="form-control" id="altbaslik" placeholder="Alt Başlık" autofocus value="">
										</div>
									</div>
								<?php } ?>

								<?php if ($sistemyaz['altbaslikrenk'] == "on") { ?>
									<div class="form-group row">
										<label for="altbaslikrenk" class="col-sm-2 col-form-label">Alt Başlık Renk </label>
										<div class="col-sm-1">
											<input type="text" name="altbaslikrenk" maxlength="7" class="form-control jscolor" value="1d376c">

										</div>
									</div>
								<?php } ?>


								<?php if ($sistemyaz['aciklama'] == "on") { ?>
									<div class="form-group row">
										<label for="aciklama" class="col-sm-2 col-form-label">Açıklama </label>
										<div class="col-sm-6">
											<input type="text" name="aciklama" class="form-control" id="aciklama" placeholder="Açıklama" autofocus value="">
										</div>
									</div>
								<?php } ?>

								<?php if ($sistemyaz['aciklamarenk'] == "on") { ?>
									<div class="form-group row">
										<label for="aciklamarenk" class="col-sm-2 col-form-label">Açıklama Renk </label>
										<div class="col-sm-1">
											<input type="text" name="aciklamarenk" maxlength="7" class="form-control jscolor" value="1d376c">

										</div>
									</div>
								<?php } ?>


								<?php if ($sistemyaz['video'] == "on") { ?>
									<div class="form-group row">
										<label for="video" class="col-sm-2 col-form-label">Video Link </label>
										<div class="col-sm-6">
											<input type="text" name="video" class="form-control" id="video" placeholder="Video Link" value="">


										</div>

									</div>
								<?php } ?>

								<?php if ($sistemyaz['link'] == "on") { ?>
									<div class="form-group row">
										<label for="link" class="col-sm-2 col-form-label"> Link </label>
										<div class="col-sm-6">
											<input type="text" name="link" class="form-control" id="link" placeholder="Link" value="">
										</div>

									</div>
								<?php } ?>

								<?php if ($sistemyaz['linkaciklama'] == "on") { ?>
									<div class="form-group row">
										<label for="linkaciklama" class="col-sm-2 col-form-label">Link Açıklama </label>
										<div class="col-sm-6">
											<input type="text" name="linkaciklama" class="form-control" id="linkaciklama" placeholder="Link Açıklama" value="">
										</div>
									</div>
								<?php } ?>


								<?php if ($sistemyaz['link2'] == "on") { ?>
									<div class="form-group row">
										<label for="link2" class="col-sm-2 col-form-label"> Link 2 </label>
										<div class="col-sm-6">
											<input type="text" name="link2" class="form-control" id="link2" placeholder="Link 2" value="">
										</div>

									</div>
								<?php } ?>

								<?php if ($sistemyaz['link2aciklama'] == "on") { ?>
									<div class="form-group row">
										<label for="link2aciklama" class="col-sm-2 col-form-label">Link 2 Açıklama </label>
										<div class="col-sm-6">
											<input type="text" name="link2aciklama" class="form-control" id="link2aciklama" placeholder="Link 2 Açıklama" value="">
										</div>
									</div>
								<?php } ?>


								<div class="form-group row">
									<label for="resim" class="col-sm-2 col-form-label">Resim * </label>
									<div class="col-sm-2">
										<input type="file" name="resim" class="form-control" id="resim" placeholder="Resim *" >

									</div>

									<div class="col-sm-2">
										İdeal boyut 1920 * 800 px

									</div>

								</div>

								<div class="form-group row">
									<label for="dvideo" class="col-sm-2 col-form-label">Video * </label>
									<div class="col-sm-2">
										<input type="file" name="dvideo" class="form-control" id="dvideo" placeholder="dvideo" >

									</div>


								</div>

								<?php if ($sistemyaz['arkaresim'] == "on") { ?>
									<div class="form-group row">
										<label for="arkaresim" class="col-sm-2 col-form-label">Arka Resim </label>
										<div class="col-sm-2">
											<input type="file" name="arkaresim" class="form-control" id="arkaresim" placeholder="Arka Resim">

										</div>

										<div class="col-sm-2">
											İdeal boyut 1920 * 800 px

										</div>

									</div>
								<?php } ?>

								<?php if ($sistemyaz['solresim'] == "on") { ?>
									<div class="form-group row">
										<label for="solresim" class="col-sm-2 col-form-label">Sol Resim </label>
										<div class="col-sm-2">
											<input type="file" name="solresim" class="form-control" id="solresim" placeholder="Sol  Resim">

										</div>

										<div class="col-sm-2">
											İdeal boyut 1920 * 800 px

										</div>

									</div>
								<?php } ?>


								<?php if ($sistemyaz['sagresim'] == "on") { ?>
									<div class="form-group row">
										<label for="sagresim" class="col-sm-2 col-form-label">Sağ Resim </label>
										<div class="col-sm-2">
											<input type="file" name="sagresim" class="form-control" id="sagresim" placeholder="Sağ  Resim">

										</div>

										<div class="col-sm-2">
											İdeal boyut 1920 * 800 px

										</div>

									</div>
								<?php } ?>


								<?php if ($sistemyaz['icon'] == "on") { ?>
									<div class="form-group row">
										<label for="icon" class="col-sm-2 col-form-label">İcon</label>
										<div class="col-sm-2">
											<input type="file" name="icon" class="form-control" id="icon" placeholder="İcon">

										</div>

										<div class="col-sm-2">
											İdeal boyut 100 * 100 px

										</div>

									</div>

								<?php } ?>


								<div class="form-group row">
									<label for="sira" class="col-sm-2 col-form-label">Sıra *</label>
									<div class="col-sm-2">
										<input type="text" name="sira" class="form-control" id="sira" placeholder="Sıra" value="" required>


									</div>

								</div>

								<div class="form-group row">
									<label for="sira" class="col-sm-2 col-form-label"> </label>
									<div class="col-sm-10">
										<button type="submit" class="btn btn-primary ul-btn__text">Banner Ekle</button>

									</div>
								</div>

							</form>

						<?php } ?>
					</div>
				</div>
			</div>
		</div>

	</div>