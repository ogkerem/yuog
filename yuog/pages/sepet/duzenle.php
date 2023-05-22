	<?php

	defined('YUOG') or exit('No direct script access allowed / Yetkisiz Erişim ');

	$konu = "sepet";

	$id = $_GET['id'];
	$yaz1 = $mysqli->query("SELECT * FROM $konu WHERE id='$id' AND durum=1 ")->fetch_array();
if($yaz1)
{
	$musteriSepet = $mysqli->query("SELECT * FROM uyeler WHERE id='{$yaz1['musteriID']}' ")->fetch_array();

	$urun = $mysqli->query("SELECT * FROM urun WHERE id='{$yaz1['urunID']}' ")->fetch_array();
	?>

	<div class="main-content">

		<div class="breadcrumb">
			<h1><a href="?sy=<?php echo $konu; ?>"> <?php echo $konu; ?> </a> </h1>
			<ul>
				<li><a href="index.php">Ana Sayfa </a></li>
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

							$durum = $_POST['durum'];
							

							$adet = $_POST['adet'];
							$fiyat = $_POST['fiyat'];
							$kdv = $_POST['kdv'];

							$gonder  	= $mysqli->query(" UPDATE $konu SET  
								durum = '$durum',
								kdv = '$kdv',
								fiyat='$fiyat',
								adet='$adet'

								where id='$id'
							");

							if ($gonder) {
								
								header("Location:?sy=" . $konu . "&islem=basarili");
							} else {
								echo '<div class="alert alert-danger" role="alert">
				<strong class="text-capitalize">Hata!</strong>Hata İşlem Başarısız :(  
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">X</span>
				</button>
			</div> <br /> <a href="javascript:history.back(-1)">Geri Dön</a>';
							}
						} else {

						?>

							<form method="post">

								<div class="form-group row">
									<label for="adsoyad" class="col-sm-2 col-form-label">Siparişi Veren * </label>
									<div class="col-sm-4">
										<input type="text" class="form-control" value="<?php echo $musteriSepet['bayi_adi']; ?>" placeholder="Bayi Adı *" disabled>
									</div>
								</div>

								<div class="form-group row">
									<label for="adsoyad" class="col-sm-2 col-form-label">Yetkili Adı * </label>
									<div class="col-sm-4">
										<input type="text" class="form-control" value="<?php echo $musteriSepet['yetkili_adi']; ?>" placeholder="Yetkili Adı *" disabled>
									</div>
								</div>

								<div class="form-group row">
									<label for="adsoyad" class="col-sm-2 col-form-label">Ürün Adı * </label>
									<div class="col-sm-4">
										<input type="text" class="form-control" value="<?php echo $urun['baslik']; ?>" placeholder="Ürün Adı *" disabled>
									</div>
								</div>

								<div class="form-group row">
									<label for="adsoyad" class="col-sm-2 col-form-label">Adet * </label>
									<div class="col-sm-2">
										<input type="text" name="adet" class="form-control" value="<?php echo $yaz1['adet']; ?>" placeholder="Adet *">
									</div>
								</div>


								<div class="form-group row">
									<label for="adsoyad" class="col-sm-2 col-form-label">Birim Fiyat * </label>
									<div class="col-sm-2">
										<input type="text" name="fiyat" class="form-control" value="<?php echo $yaz1['fiyat']; ?>" placeholder="Fiyat *">

									</div>
								</div>


								<div class="form-group row">
									<label for="adsoyad" class="col-sm-2 col-form-label">Kdv * </label>
									<div class="col-sm-2">
										<input type="text" class="form-control" name="kdv" value="<?php echo $yaz1['kdv']; ?>" placeholder="Kdv *">
									</div>
								</div>

								<div class="form-group row">
									<label for="durum" class="col-sm-2 col-form-label"> <i class="fa fa-user"></i> Durum
									</label>
									<div class="col-2">
										<select class="custom-select task-manager-list-select" name="durum">
											<option value="0">Kapalı</option>
											<option value="1" <?php if ($yaz1['durum'] == 1) {
																	echo 'selected';
																} ?>>Açık</option>
										</select>
									</div>

								</div>

								<div class="form-group row">
									<label for="sira" class="col-sm-2 col-form-label"> </label>
									<div class="col-sm-10">
										<button type="submit" class="btn btn-primary ul-btn__text">Sepet Güncelle</button>

									</div>
								</div>


							</form>

						<?php }
						} ?>
					</div>
				</div>
			</div>
		</div>

	</div>