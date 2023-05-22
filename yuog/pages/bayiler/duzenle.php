	<?php

	defined('YUOG') or exit('No direct script access allowed / Yetkisiz Erişim ');

	$konu     = "uyeler";

	$id     = $_GET['id'];
	$yaz1     = $mysqli->query("select * from $konu where id='$id' ");
	$yaz     = $yaz1->fetch_assoc();

	$updateokuma = $mysqli->query("UPDATE uyeler SET okundu='1'WHERE id='$id' ");

	function dilbak($dilID, $sabitID)
	{
		global $mysqli;
		$dbak	= $mysqli->query("select * from dilicerik where dilID='$dilID' && sabitID='$sabitID' ");
		$dilsabit1	= $dbak->fetch_array();
		$dilsabit	= $dilsabit1['icerik'];
		return $dilsabit;
	}

	?>

	<div class="main-content">

		<div class="breadcrumb">
			<h1><a href="?sy=bayiler">Müşteriler | </a><?php echo $yaz['bayi_adi']; ?> </h1>
			<ul>
				<li><a href="/YUOG">Ana Sayfa</a></li>
				<li>Müşteriler Güncelleme</li>
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
				<div class="card mb-5">
					<div class="card-body">
						<?php
						$urls = "https://" . $_SERVER['SERVER_NAME'] . "/uye-giris";
						if ($_POST) {
							$servisler = $_POST['servis'];






							$parola = $_POST['sifre'];
							$parola = md5($parola);
							$yuzde = $_POST['yuzde'];

							$bayiadi = $_POST['bayiadi'];
							$yetkili_adi = $_POST['yetkili_adi'];
							$mail = $_POST['mail'];
							$telefon = $_POST['telefon'];
							$vergi_dairesi = $_POST['vergi_dairesi'];
							$vergi_numarasi = $_POST['vergi_numarasi'];
							$adres = $_POST['adres'];

							$durum = $_POST['durum'];

							if ($_POST['durum'] == 'on') {
							}
							if (!empty($_POST['sifre'])) {
								$uye_update = $mysqli->query("UPDATE $konu SET 
								durum='$durum',
								sifre='$parola',
								yuzde='$yuzde',
								bayi_adi='$bayiadi',
								yetkili_adi='$yetkili_adi',
								mail='$mail',
								telefon='$telefon',
								vergi_dairesi='$vergi_dairesi',
								vergi_numarasi='$vergi_numarasi',
								adres='$adres'
								WHERE id='$id'");

								$mesajs = $_POST['mail'] . "<br> Şifre : " . $_POST['sifre'] . "<br><br>" . '<a href="' . $urls . '">Buradan Giriş Yapabilirsiniz.</a> <br>
								<p> Eğer linke tıklayamıyorsanız bu bağlantıyı tarayıcınıza yapıştırınız. <br>
								' . $urls . '
								</p>
								';
								mailgonder($_POST['mail'], $mesajs, 'YUOG Hesabınız Aktif Edildi.', 'YUOG Hesabınız Aktif Edildi.');
							} else {
								$uye_update = $mysqli->query("UPDATE $konu SET 
								durum='$durum',
								yuzde='$yuzde',
								yetkili_adi='$yetkili_adi',
								mail='$mail',
								telefon='$telefon',
								vergi_dairesi='$vergi_dairesi',
								vergi_numarasi='$vergi_numarasi',
								adres='$adres'
								WHERE id='$id' ");
							}

							if ($uye_update) {
								$boughtSil = $mysqli->query("DELETE FROM alinan_servisler WHERE musteriID = $id");
								foreach ($servisler as $servis) {
									$servisEkle = $mysqli->query("INSERT INTO alinan_servisler SET servisID = $servis, musteriID = $id, tarih = now(), islem_turu = 'Manuel'");
								}

								header("Location:?sy=" . 'bayiler' . "&islem=basarili");
							} else { ?>
								<div class="alert alert-danger" role="alert">
									<strong class="text-capitalize">Hata! </strong>Hata İşlem Başarısız :(
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
								</div>
								<br /> <a href="javascript:history.back(-1)">Geri Dön</a>
						<?php
							}
						}
						?>
						<form action="#" method="post">
							<div class="form-group row">
								<label for="baslik" class="col-sm-2 col-form-label">
									Firma Adı
								</label>
								<div class="col-sm-6">
									<input type="text" name="bayiadi" class="form-control" value="<?php echo $yaz['bayi_adi']; ?>" placeholder="mail">
								</div>
							</div>
							<div class="form-group row">
								<label for="yetkili_adi" class="col-sm-2 col-form-label">
									Yetkili Adı
								</label>
								<div class="col-sm-6">
									<input type="text" name="yetkili_adi" class="form-control" value="<?php echo $yaz['yetkili_adi']; ?>" placeholder="Yetkili Adı">
								</div>
							</div>

							<div class="form-group row">
								<label for="baslik" class="col-sm-2 col-form-label">
									Mail Dil
								</label>
								<div class="col-sm-6">
									<select class="custom-select task-manager-list-select" name="dil">
										<?php $dilbak = $mysqli->query("select * from diller order by sira asc");
										while ($dilyaz = $dilbak->fetch_array()) {
											echo '<option value="' . $dilyaz['id'] . '">' . $dilyaz['baslik'] . '</option>';
										}
										?>
									</select>
								</div>
							</div>


							<div class="form-group row">
								<label for="adres" class="col-sm-2 col-form-label"> Mail Adresi </label>
								<div class="col-sm-6">
									<input type="text" name="mail" class="form-control" value="<?php echo $yaz['mail']; ?>" placeholder="mail">

								</div>
							</div>


							<div class="form-group row">
								<label for="faks" class="col-sm-2 col-form-label">Telefon </label>
								<div class="col-sm-6">
									<input type="text" name="telefon" class="form-control" value="<?php echo $yaz['telefon']; ?>" placeholder="telefon">
								</div>
							</div>
							<div class="form-group row">
								<label for="faks" class="col-sm-2 col-form-label">Vergi Dairesi </label>
								<div class="col-sm-3">
									<input type="text" name="vergi_dairesi" class="form-control" value="<?php echo $yaz['vergi_dairesi']; ?>" placeholder="vergi dairesi">

								</div>
							</div>
							<div class="form-group row">
								<label for="faks" class="col-sm-2 col-form-label">Vergi Numarası </label>
								<div class="col-sm-3">
									<input type="text" name="vergi_numarasi" class="form-control" value="<?php echo $yaz['vergi_numarasi']; ?>" placeholder="vergi numarası">
								</div>
							</div>
							<div class="form-group row">
								<label for="faks" class="col-sm-2 col-form-label">Adres </label>
								<div class="col-sm-3">
									<input type="text" name="adres" class="form-control" value="<?php echo $yaz['adres']; ?>" placeholder="adres">
								</div>
							</div>



							<div class="form-group row">
								<label for="eposta" class="col-sm-2 col-form-label"> Şifre </label>
								<div class="col-sm-3">
									<input type="text" name="sifre" class="form-control" placeholder="Şifre">

								</div>
							</div>


							<div class="form-group row">
								<label for="eposta" class="col-sm-2 col-form-label"> Yüzdelik İndirim % </label>
								<div class="col-sm-1">
									<input type="number" min="0" max="100" name="yuzde" value="<?php echo $yaz['yuzde']; ?>" class="form-control" placeholder="Yüzdelik">
								</div>
							</div>


							<div class="form-group row">
								<label for="durum" class="col-sm-2 col-form-label"> Durum </label>
								<div class="col-sm-2">

									<label class="switch switch-primary mr-3" id="durum">

										<input name="durum" type="hidden">
										<input name="durum" type="checkbox" <?php if ($yaz['durum'] == "on") {
																				echo 'checked';
																			} ?>>

										<span class="slider"></span>
									</label>

								</div>

							</div>
							<hr>
							<div class="form-group row">
								<label for="icerik" class="col-sm-2 col-form-label"> Servisler </label>

								<?php
								$servisler = $mysqli->query("SELECT * FROM servis WHERE durum = 1 ORDER BY sira ASC");
								while ($servisYaz = $servisler->fetch_array()) {
									$srvsID = $servisYaz['id'];
									$bought = $mysqli->query("SELECT * FROM alinan_servisler WHERE servisID = $srvsID AND musteriID = $id")->num_rows;

								?>

									<label class="checkbox checkbox-primary mr-2">
										<input <?php echo ($bought == 1) ? 'checked' : ''; ?> type="checkbox" name="servis[]" value="<?php echo $servisYaz['id']; ?>">
										<span><?php echo $servisYaz['baslik']; ?></span>
										<span class="checkmark"></span>
									</label>
								<?php } ?>


							</div>
							<hr />

							<div class="form-group row">
								<label for="eposta" class="col-sm-2 col-form-label"> Tarih </label>
								<div class="col-sm-6">
									<?php echo $tarih = substr($yaz['tarih'], 0, 10);
									?>
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


					</div>
				</div>
			</div>
		</div>