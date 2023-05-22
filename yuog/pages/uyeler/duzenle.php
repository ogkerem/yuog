	<?php

	defined('YUOG') or exit('No direct script access allowed / Yetkisiz Erişim ');

	$konu     = "uyeler";

	$id     = $_GET['id'];
	$yaz1     = $mysqli->query("select * from $konu where id='$id' ");
	$yaz     = $yaz1->fetch_assoc();


	?>

	<div class="main-content">

		<div class="breadcrumb">
			<h1><a href="?sy=<?php echo $konu; ?>">Üyeler</a> </h1>
			<ul>
				<li><a href="index.php">Ana Sayfa</a></li>
				<li>Üyeler Güncelleme</li>
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
							if (!empty($_POST['uye_yetkisi'])) {

								if (@$_POST['durum'] == "on") {

									$durum = 1;
								} else {
									$durum = 0;
								}

								if (@$_POST['uye_yetkisi']) {
									echo $uye_yetkisi = $_POST['uye_yetkisi'];
								} else {
									echo  $uye_yetkisi = 0;
								}


								$uye_update = $mysqli->query("UPDATE $konu SET durum='$durum' uye_yetkisi='$uye_yetkisi' WHERE id='$id' ");

								if ($uye_update) {
									header("Location:?sy=" . $konu . "&islem=basarili");
								} else {
									echo '<div class="alert alert-danger" role="alert">
										<strong class="text-capitalize">Hata! </strong>Hata İşlem Başarısız :(  
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div> <br /> <a href="javascript:history.back(-1)">Geri Dön</a>';
								}
							}
						}
						?>



						<form action="#" method="post">

							<div class="form-group row">
								<label for="baslik" class="col-sm-2 col-form-label">
									<?php if ($yaz['uye_yetkisi'] == 0) {
										echo 'Ad';
									} else {
										echo 'Bayi Adı';
									} ?>
								</label>
								<div class="col-sm-6">
									<?php if ($yaz['uye_yetkisi'] == 0) {
										echo $yaz['ad'];
									} else {
										echo $yaz['bayi_adi'];
									} ?>
								</div>
							</div>

							<div class="form-group row">
								<label for="onyazi" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Soyad </label>
								<div class="col-sm-6">
									<?php echo $yaz['soyad']; ?>
								</div>
							</div>




							<div class="form-group row">
								<label for="adres" class="col-sm-2 col-form-label"> Mail Adresi </label>
								<div class="col-sm-6">
									<?php echo $yaz['mail']; ?>
								</div>
							</div>



							<div class="form-group row">
								<label for="faks" class="col-sm-2 col-form-label">Telefon </label>
								<div class="col-sm-6">
									<?php echo $yaz['telefon']; ?>
								</div>
							</div>


							<div class="form-group row">
								<label for="eposta" class="col-sm-2 col-form-label"> Tarih </label>
								<div class="col-sm-6">
									<?php echo $tarih = substr($yaz['tarih'], 0, 10);
									?>
								</div>
							</div>


							<div class="form-group row">
								<label for="calisma" class="col-sm-2 col-form-label"> Üye Yetkisi
								</label>
								<div class="col-sm-4">
									<select class="custom-select task-manager-list-select " name="uye_yetkisi">
										<option value="0" <?php if ($yaz['uye_yetkisi'] == 0) {
																echo 'selected';
															} ?>>Kullanıcı
										</option>

										<option value="1" <?php if ($yaz['uye_yetkisi'] == 1) {
																echo 'selected';
															} ?>>Bayi
										</option>
									</select>
								</div>

							</div>

							<br>
							<div class="form-group row">
								<label for="icerik" class="col-sm-2 col-form-label"> servisler </label>

								<?php
								$pbak = $mysqli->query("select * from servis where dil='$dil' && durum='1' order by sira asc ");
								while ($pyaz = $pbak->fetch_array()) { ?>
									<label class="checkbox checkbox-primary mr-2">
										<input type="checkbox" name="servis[]" value="<?php echo $pyaz['id']; ?>">
										<span><?php echo $pyaz['baslik']; ?></span>
										<span class="checkmark"></span>
									</label>
								<?php } ?>


							</div>
							<br>
							<div class="form-group row">
								<label for="durum" class="col-sm-2 col-form-label">Durum </label>
								<div class="col-sm-2">

									<label class="switch switch-primary mr-3" id="durum">

										<input name="durum" type="checkbox" <?php if ($yaz['durum'] == "1") {
																				echo 'checked"';
																			} ?>>

										<span class="slider"></span>
									</label>

								</div>

							</div>

							<hr />


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