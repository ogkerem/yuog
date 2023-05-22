	<?php
	defined('YUOG') or exit('No direct script access allowed / Yetkisiz Erişim ');

	$konu 		= "urun";
	$kategori 	= $konu . "kat";


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

	$katID	= @$_GET['katID'];
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

						<form method="post" enctype="multipart/form-data">
						
							<input type="hidden" name="turkce">
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
								<label for="resim" class="col-sm-2 col-form-label"> <i class="nav-icon fa fa-image"></i> Üst Resim ( 1920 * 450) * </label>
								<div class="col-sm-2">
									<input type="file" name="ustresim" class="form-control" id="resim" placeholder="" required>

								</div>

								<div class="col-sm-2">


								</div>

							</div>



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

							<hr>


							<div class="form-group row">
								<label for="dosya" class="col-sm-2 col-form-label"> <i class="nav-icon i-Data-Upload"></i> Dökümanlar (pdf, word, excel vb.) </label>
								<div class="col-sm-2">
									<input type="file" name="dosya" class="form-control" id="dosya" placeholder="">
									<small id="passwordHelpBlock" class="ul-form__text form-text "> Toplu İçerik Ekleyebilirsiniz </small>

								</div>



							</div>


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
								<label for="anasayfa" class="col-sm-2 col-form-label">Bayiye Özel </label>
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

					</div>
				</div>
			</div>
		</div>
	</div>



	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<script>
		$("form").on("submit", function(event) {
			event.preventDefault();
			var form = $(this).serializeArray();
			$.ajax({
					method: "POST",
					url: "gonder.php",
					data: form
				})
				.done(function(msg) {
					$("form").html(msg);
				});
		});
	</script>