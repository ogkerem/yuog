<?php

defined('YUOG') or exit('No direct script access allowed / Yetkisiz Erişim ');


?>
<div class="main-content">

	<div class="breadcrumb">
		<h1>Ana Sayfa İçeriklerinin Seçilmesi</h1>
		<ul>
			<li><a href="index.php">Ana Sayfa</a></li>
			<li>Ana Sayfa Ayarları </li>
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

						$konum 	= $_POST['konum'];
						$sifirla	= $mysqli->query("update konum set durum='' ");

						foreach ($konum as $ykonum) {
							echo $ykonum . '<br>';
							$sor = $mysqli->query("select * from konum where sef='$ykonum' ")->fetch_array();
							if ($sor > 0) {
								$mysqli->query("update konum set durum='on' where sef='$ykonum' ");
							} else {
								$mysqli->query("insert into konum (sef,durum) values ('$ykonum', 'on') ");
							}
						}

						header("Location:?sy=anakonum");
					} else {
					?>



						<form action="" method="post" enctype="multipart/form-data">

							<div class="form-group row">
								<label for="durum" class="col-sm-2 col-form-label">Ana Sayfa Banner</label>
								<div class="col-sm-1">

									<label class="switch switch-primary mr-3" id="durum">

										<?php $banbak = $mysqli->query("select * from konum where sef='banner' ")->fetch_array(); ?>
										<input name="konum[]" type="checkbox" value="banner" <?php if ($banbak['durum'] == "on") {
																									echo 'checked';
																								} ?>>

										<span class="slider"></span>
									</label>

								</div>

							</div>


							<!-- <div class="form-group row">
	<label for="durum" class="col-sm-2 col-form-label">Kategoriler</label>
	<div class="col-sm-1">
	  
	<label class="switch switch-primary mr-3" id="durum">
		 
	 <?php $katbak = $mysqli->query("SELECT * from konum where sef = 'kategori' ")->fetch_array(); ?>	
	 <input name="konum[]" type="checkbox" value="kategori" <?php if ($katbak['durum'] == "on") {
																echo 'checked';
															} ?> > 
		  
		<span class="slider"></span>
	</label>
			 
		</div>
		   
		</div> -->
							<div class="form-group row">
								<label for="durum" class="col-sm-2 col-form-label">Anasayfa Orta Banner</label>
								<div class="col-sm-1">

									<label class="switch switch-primary mr-3" id="durum">

										<?php $urunbak = $mysqli->query("SELECT * from konum where sef = 'anasayfaortabanner' ")->fetch_array(); ?>
										<input name="konum[]" type="checkbox" value="anasayfaortabanner" <?php if ($urunbak['durum'] == "on") {
																												echo 'checked';
																											} ?>>

										<span class="slider"></span>
									</label>

								</div>

							</div>


							<div class="form-group row">
								<label for="durum" class="col-sm-2 col-form-label">Ürünler</label>
								<div class="col-sm-1">

									<label class="switch switch-primary mr-3" id="durum">

										<?php $urunbak = $mysqli->query("SELECT * from konum where sef = 'urunler' ")->fetch_array(); ?>
										<input name="konum[]" type="checkbox" value="urunler" <?php if ($urunbak['durum'] == "on") {
																									echo 'checked';
																								} ?>>

										<span class="slider"></span>
									</label>

								</div>

							</div>


							<div class="form-group row">
								<label for="durum" class="col-sm-2 col-form-label">Kategoriler</label>
								<div class="col-sm-1">

									<label class="switch switch-primary mr-3" id="durum">

										<?php $urunbak = $mysqli->query("SELECT * from konum where sef = 'kategoriler' ")->fetch_array(); ?>
										<input name="konum[]" type="checkbox" value="kategoriler" <?php if ($urunbak['durum'] == "on") {
																										echo 'checked';
																									} ?>>

										<span class="slider"></span>
									</label>

								</div>

							</div>




							<!-- <?php
									$kbak = $mysqli->query("select * from sistem order by sira asc ");
									while ($kyaz = $kbak->fetch_array()) {

										$sef 		= $kyaz['sef'];
										$sistemsor	= $mysqli->query("select * from konum where sef='$sef' ")->fetch_array();
										@$durum 		= $sistemsor['durum'];

										if ($durum == "on") {
											$checked = 'checked';
										} else {
											$checked = '';
										}

										echo '	<div class="form-group row">
	<label for="durum" class="col-sm-2 col-form-label">' . $kyaz['menu'] . '</label>
	<div class="col-sm-1">
	  
	<label class="switch switch-primary mr-3" id="durum">
		  
	 <input name="konum[]" type="checkbox" value="' . $sef . '" ' . $checked . ' >
		  
		<span class="slider"></span>
	</label>
			 
		</div>
		   
		</div>';
									}

									?>
		 -->



							<?php
							$kbak = $mysqli->query("select * from anasayfa order by sira asc ");
							while ($kyaz = $kbak->fetch_array()) {

								$sef 		= $kyaz['sef'];
								$sistemsor	= $mysqli->query("select * from konum where sef='$sef' ")->fetch_array();
								@$durum 		= $sistemsor['durum'];

								if ($durum == "on") {
									$checked = 'checked';
								} else {
									$checked = '';
								}


								echo '	<div class="form-group row">
	<label for="durum" class="col-sm-2 col-form-label">' . $kyaz['baslik'] . '</label>
	<div class="col-sm-1">
	  
	<label class="switch switch-primary mr-3" id="durum">
		  
	 <input name="konum[]" type="checkbox"  value="' . $kyaz['sef'] . '"  ' . $checked . ' >
		  
		<span class="slider"></span>
	</label>
			 
		</div>
		   
		</div>';
							}

							?>





							<div class="form-group row">
								<label for="guncelle" class="col-sm-2 col-form-label"></label>
								<div class="col-sm-10">
									<button type="submit" id="guncelle" class="btn btn-primary ul-btn__text">Güncelle</button>

								</div>
							</div>

						</form>

					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<div class="border-top mb-5"></div>



</div>