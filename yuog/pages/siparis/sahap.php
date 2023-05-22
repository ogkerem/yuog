	<?php

	defined('YUOG') or exit('No direct script access allowed / Yetkisiz Erişim ');
	$konu 	= "siparis";

	?>


	<div class="main-content">

		<div class="breadcrumb">

			<h1> <a href="?sy=<?php echo $konu; ?>"> İşlemdeki Siparişler </a> </h1>
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

							<a href="?sy=siparisdurum"><button type="button" class="btn btn-warning btn-icon m-1">
									<span class="ul-btn__icon"> <i class="fa fa-asterisk"></i> </span>
									<span class="ul-btn__text">Sipariş Durumları</span>
								</button>
							</a>

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
											<th>Sipariş No</th>
											<th>Sipariş Durumu</th>
											<th>Sipariş Tarihi</th>
											<th>Sipariş Tutarı</th>
											<th>İşlemler</th>
										</tr>
									</thead>
									<tbody>

										<?php
										$bak = $mysqli->query("SELECT * from $konu order by id desc");
										while ($yaz = $bak->fetch_array()) {
											$parabirimi = $yaz['parabirimi'];
											$siparisparabirimi = $mysqli->query("SELECT * FROM parabirimi where id = $parabirimi")->fetch_array();
											$spb = $siparisparabirimi['simge'];
											$sipDurum = $yaz['durum'];
											$duurum = $mysqli->query("SELECT * FROM siparisdurum where sira = $sipDurum")->fetch_array();
											$total = $yaz['toplam'];
											$pBirim = $genelbak['parabirimi'];
											$para = $mysqli->query("SELECT * FROM parabirimi where id = $pBirim")->fetch_array();
										?>
											<tr>
												<td><?php echo $yaz['siparis_no']; ?></td>
												<td><?php

													echo $duurum['baslik']; ?></td>
												<td><?php echo $yaz['tarih']; ?></td>
												<td> <b> <?php echo number_format($total, 2, ",", "."); ?> <?php echo $spb; ?>
													</b></td>

												<td>
													<a href="?sy=<?php echo $konu; ?>duzenle&id=<?php echo $yaz['id']; ?>" class="ul-link-action text-success" data-toggle="tooltip" data-placement="top" title="Düzenle">
														<i class="i-Edit"></i>
													</a>

													<a href="?sy=siparissil&id=<?php echo $yaz['id']; ?>" class="ul-link-action text-danger mr-1" data-toggle="tooltip" data-placement="top" title="Sil" onclick=" if ( !confirm(\'Kaydi silmek istediğinizden emin misiniz?\') ) return false;">
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