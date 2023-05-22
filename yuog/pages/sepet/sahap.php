	<?php

	defined('YUOG') or exit('No direct script access allowed / Yetkisiz Erişim ');
	$konu 	= "sepet";

	?>


	<div class="main-content">

		<div class="breadcrumb">

			<h1> <a href="?sy=<?php echo $konu; ?>"> İşlemdeki Sepet </a> </h1>
			<ul>
				<li><a href="index.php">Ana Sayfa</a></li>

				<li> İçerikler </li>

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


		<section class="contact-list">
			<div class="row">
				<div class="col-md-12 mb-4">
					<div class="card text-left">
						<div class="card-header text-right bg-transparent">
							<!-- <button type="button" data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-primary btn-md m-1"><i class="i-Add-User text-white mr-2"></i> Sipariş Ekle </button>  -->

							<!-- <a href="?sy=<?php echo $konu; ?>ekle"><button type="button" class="btn btn-primary btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-plus" ></i> </span>
		<span class="ul-btn__text">Yeni Sipariş Ekle</span>
	</button>
	</a> -->

						

							<!--	<a href="?sy=turtarih"><button type="button" class="btn btn-danger btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-calendar" ></i> </span>
		<span class="ul-btn__text">Tarihler</span>
	</button>
	</a>
	 
	<a href="?sy=cikisnokta"><button type="button" class="btn btn-light btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-share" ></i> </span>
		<span class="ul-btn__text">Çıkış Noktaları</span>
	</button>
	</a> 
	
	 <a href="?sy=bilgi&konu=<?php echo $konu; ?>"><button type="button" class="btn btn-light btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-share" ></i> </span>
		<span class="ul-btn__text"> Genel Açıklama </span>
	</button>
	</a> -->

						</div>



						<div class="card-body">

							<div class="table-responsive">
								<table class="display table " style="width:100%">
									<thead>
										<tr>
											<th>Sepet Ürün</th>
											<th>Birim Fiyat</th>
											<th>Adet</th>
											<th>Kdv</th>
											<th>Bayi Adı</th>
											<th>İşlemler</th>

										</tr>
									</thead>
									<tbody>

										<?php
										$sepett = $mysqli->query("SELECT * FROM sepet WHERE durum=1 ");
										while ($sepet = $sepett->fetch_array()) {
											$urun = $mysqli->query("SELECT * FROM urun WHERE id='{$sepet['urunID']}' ")->fetch_array();

											$uyeler = $mysqli->query("SELECT * FROM uyeler WHERE id='{$sepet['musteriID']}' ")->fetch_array();
										?>
											<tr>
												<td><?php echo $urun['baslik']; ?></td>

												<td> <b> <?php echo number_format($sepet['fiyat'], 2, ",", ".") . $sepet['parabirimi']; ?>
												<td><?php echo $sepet['adet']; ?></td>
												<td><?php echo $sepet['kdv']; ?></td>
												<td><?php echo $uyeler['bayi_adi']; ?></td>
												<td>
													<a href="?sy=<?php echo $konu; ?>duzenle&id=<?php echo $sepet['id']; ?>" class="ul-link-action text-success" data-toggle="tooltip" data-placement="top" title="Düzenle">
														<i class="i-Edit"></i>
													</a>

													<a href="?sy=<?php echo $konu; ?>sil&id=<?php echo $sepet['id']; ?>" class="ul-link-action text-danger mr-1" data-toggle="tooltip" data-placement="top" title="Sil" onclick=" if ( !confirm(\'Kaydi silmek istediğinizden emin misiniz?\') ) return false;">
														<i class="i-Eraser-2"></i>
													</a>
												</td>
											</tr>
										<?php
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

	<script>
		$('#ul-contact-list').DataTable();
	</script>