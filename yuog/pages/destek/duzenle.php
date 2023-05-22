	<?php

	defined('YUOG') or exit('No direct script access allowed / Yetkisiz Erişim ');

	$konu 		= "destek";
	$kategori 	= $konu . "kat";

	$id 			= $_GET['id'];
	$yaz 			= $mysqli->query("select * from $konu where id='$id' ")->fetch_array();

	$uyeID 		= $yaz['uyeID'];
	$musteriyaz 	= $mysqli->query("select * from uyeler where id='$uyeID' ")->fetch_array();

	$katID 			= $yaz['katID'];
	$katyaz 		= $mysqli->query("select * from destekkat where id='$katID' ")->fetch_array();

	// $islem 			= $yaz['islem'];
	// $islemyaz 		= $mysqli->query("select * from destekdurum where id='$islem' ")->fetch_array();

	$sonbul 		= $mysqli->query("select * from desteksorular where destekID='$id' order by id desc limit 1 ")->fetch_array();
	$sonislem		= $sonbul['islem'];

	$baslikk 		= $yaz['konu'];

	// $ilanID = $yaz['ilanID'];
	// $ilan = $mysqli->query("SELECT * FROM ilanlar WHERE id = $ilanID")->fetch_array();

	?>

	<style>
		.destekIMG {
			width: 100%;
			height: 350px;
			object-fit: cover;
		}
	</style>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>


	<div class="main-content">

		<div class="breadcrumb">
			<h1><a href="?sy=<?php echo $konu; ?>"> Destek </a> > Düzenleme ve cevaplama </h1>
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


							$islem			= 	$_POST['islem'];
							$aciklama			= $_POST['aciklama'];
							$durum			= $_POST['durum'];

							$durum1				= $_POST['durum'];
							if ($durum1 == "on") {
								$durum = 1;
							} else {
								$durum = 0;
							}


							if ($_FILES['resim']['name']) {
								$rhedef				= "../uploads/destek/";
								$resim				= rand(0, 9999) . '-' . $_FILES['resim']['name'];
								$kaynak				= $_FILES['resim']['tmp_name'];
								$yukle 				= move_uploaded_file($kaynak, $rhedef . "/" . $resim);
							} else {
								$resim = '';
							}

							$ip					= $_SERVER['REMOTE_ADDR'];


							$update = $mysqli->query("UPDATE destek SET durum = $durum, islem = $islem WHERE id = $id");

							$gonder  	= $mysqli->query(" insert into  desteksorular set  
		
		destekID 			='$id',		 
		katID 				='$katID', 
		uyeID			    ='$uyeID',
		yetkili 			='$email',
		konu	 			='$baslikk',
		aciklama 			='$aciklama',
		resim 				='$resim',
		ip 					='$ip',
		islem 				='$islem',
		tarih 				= now(),
		durum 				= '$durum'  
	 
	  ");


							if ($gonder) {

								$eposta         = $musteriyaz['eposta'];
								$adi            = $musteriyaz['adi'];
								$soyadi         = $musteriyaz['soyadi'];
								$firma          = $genelbak['firma'];


								// send_mail_format('destek_talep_uye', $eposta, [
								//     'uye_adi' => $adi, 
								//     'uye_soyadi' => $soyadi, 
								//     'firma_adi' => $firma 

								// ]);


								// $firma 		= $genelbak['firma'];
								// $siteadresi = $genelbak['web'];
								// $adminmail 	= $genelbak['mail'];
								// $urrrl 	= 'https://www.' . $siteadresi . '/destek';
								// sms_yolla($uyeID, "Destek_Cevap_Panel", "Sayın " . $adi . " " . $soyadi . " Destek talebinize cevap verilmiştir.Saygılarımızla Togpa Bilgi Teknolojileri");

								// send_mail_format('destek_cevap_panel', $eposta, [
								// 	'uye_adi' => $adi,
								// 	'uye_soyadi' => $soyadi,
								// 	'destek_linki' => $urrrl,
								// 	'firma_adi' => $firma
								// ]);



								header("Location:?sy=" . $konu . "&islem=basarili");
								exit;
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


							<div class="form-group row">
								<label for="ekleyen" class="col-sm-2 col-form-label"> Yetkili / Bayi </label>
								<div class="col-sm-2">
									<a href="?sy=uyelerduzenle&id=<?php echo $musteriyaz['id']; ?>" target="_blank"><?php echo $musteriyaz['yetkili_adi'] . ' - ' . $musteriyaz['bayi_adi']; ?></a>
								</div>
							</div>

							<div class="form-group row">
								<label for="baslik" class="col-sm-2 col-form-label">Kategori</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" value="<?php echo $katyaz['baslik']; ?>" disabled>

								</div>
							</div>


							<div class="form-group row">
								<label for="aciklama" class="col-sm-2 col-form-label"> Konu </label>
								<div class="col-sm-5">
									<textarea class="form-control" cols="50" rows="2" disabled><?php echo $yaz['konu']; ?></textarea>

								</div>
							</div>


							<div class="form-group row">
								<label for="icerik" class="col-sm-2 col-form-label"> Mesaj </label>
								<div class="col-sm-6">
									<textarea class="form-control" cols="50" rows="4" placeholder="Mesajı" disabled><?php echo $yaz['icerik']; ?></textarea>

								</div>
							</div>
							<?php if ($yaz['resim']) { ?>
								<div class="form-group row">
									<label for="" class="col-sm-2 col-form-label"> Resim </label>
									<div class="col-sm-3">
										<a href="../uploads/destek/<?php echo $yaz['resim']; ?>" data-fancybox="gallery" data-caption="<?php echo $yaz['konu']; ?>">
											<img class="destekIMG" src="../uploads/destek/<?php echo $yaz['resim']; ?>" alt="">
										</a>
									</div>
								</div>
							<?php } ?>





							<hr>
							<?php $icbak = $mysqli->query("select * from desteksorular where destekID='$id' order by id asc ");
							while ($icyaz = $icbak->fetch_array()) {

							?>
								<div <?php if ($icyaz['yetkili'] != "") {
											echo 'class="bg-secondary text-white p-4" style="border-radius: 10px;"';
										} else {
											echo 'class="bg-success text-white p-4" style="border-radius: 10px;"';
										} ?>>
									<?php if ($icyaz['resim']) { ?>
										<div class="form-group row">
											<label for="ustresim" class="col-sm-2 col-form-label text-white"><i class="nav-icon fa fa-image"></i> Gelen İçerik </label>

											<div class="col-sm-3  ">
												<a href="../uploads/destek/<?php echo $icyaz['resim']; ?>" target="_blank" data-fancybox="gallery" data-caption="">
													<img class="destekIMG" src="../uploads/destek/<?php echo $icyaz['resim']; ?>" alt=""></a>
											</div>
										</div>
									<?php } ?>

									<div class="form-group row">
										<label for="aciklama" class="col-sm-2 col-form-label text-white"> Destek </label>
										<div class="col-sm-10 border">
											<?php echo $icyaz['aciklama']; ?>
										</div>
									</div>


									<div class="form-group row">
										<label for="eklemetarih" class="col-sm-2 col-form-label text-white"> Tarih </label>
										<div class="col-sm-2">
											<?php echo $icyaz['tarih']; ?>


										</div>

									</div>

									<div class="form-group row">
										<label for="eklemetarih" class="col-sm-2 col-form-label text-white"> Cevaplayan </label>
										<div class="col-sm-2">
											<?php echo $icyaz['yetkili']; ?>

										</div>

									</div>

									<div class="form-group row">
										<label for="eklemetarih" class="col-sm-2 col-form-label text-white">IP </label>
										<div class="col-sm-2">
											<?php echo $icyaz['ip']; ?>
										</div>

									</div>

								</div>

								<hr>

							<?php } ?>


							<form action="" method="post" enctype="multipart/form-data">

								<div class="form-group row">
									<label for="resim" class="col-sm-2 col-form-label"><i class="nav-icon fa fa-image"></i> İçerik Gönder </label>
									<div class="col-sm-3">
										<input type="file" name="resim" class="form-control" id="resim" placeholder=" ">
										<small id="resim" class="ul-form__text form-text "> Dosya göndermeyecekseniz işlem yapmayınız </small>

									</div>


								</div>

								<div class="form-group row">
									<label for="aciklama" class="col-sm-2 col-form-label"> Cevap </label>
									<div class="col-sm-10">
										<textarea name="aciklama" class="form-control" id="aciklama" cols="50" rows="2" placeholder="Cevap"></textarea>

									</div>
								</div>


								<div class="form-group row">
									<label for="durum" class="col-sm-2 col-form-label">Kapat </label>
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
									<label for="sira" class="col-sm-2 col-form-label"> </label>
									<div class="col-sm-10">
										<button type="submit" class="btn btn-primary ul-btn__text">Cevapla</button>

									</div>
								</div>

							</form>

						<?php } ?>
					</div>
				</div>
			</div>
		</div>

	</div>


	<script>
		// Fancybox Config
		$('[data-fancybox="gallery"]').fancybox({
			buttons: [
				"slideShow",
				"thumbs",
				"zoom",
				"fullScreen",
				"share",
				"close"
			],
			loop: false,
			protect: true
		});
	</script>