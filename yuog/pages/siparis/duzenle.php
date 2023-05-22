<?php
defined('YUOG') or exit('No direct script access allowed / Yetkisiz Erişim ');

$konu 		= "siparis";
$id 		= $_GET['id'];
$yaz1 		= $mysqli->query("select * from $konu where id='$id' ");
$yaz 		= $yaz1->fetch_array();
$musteri 	= $yaz['musteriID'];
$durum      = $yaz['durum'];
$durumyaz   = $mysqli->query("select * from siparisdurum where id='$durum' ")->fetch_array();

$uyebak = $mysqli->query("SELECT * FROM uyeler where id = $musteri")->fetch_array();
$okundu = $mysqli->query("UPDATE $konu SET okundu=1 WHERE id='$id' ");

function yuzdeHesaplama($sayi, $yuzde)
{
	return ($sayi * $yuzde) / 100;
}
?>
<style id="table_style" type="text/css">
	body {
		font-family: Arial;
		font-size: 10pt;
	}

	table {
		border: 1px solid #ccc;
		border-collapse: collapse;
	}

	table th {
		background-color: #F7F7F7;
		color: #333;
		font-weight: bold;
	}

	table th,
	table td {
		padding: 5px;
		border: 1px solid #ccc;
	}

	@media print {
		.delete {
			display: none;
		}

		a {
			text-decoration: none;
		}
	}
</style>
<div class="main-content">

	<div class="breadcrumb">
		<h1><a href="?sy=<?php echo $konu; ?>"> Hazır Siparişler </a> Hazır Sipariş Düzenle </h1>
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
			<div class="card mb-5">
				<div class="card-body">
					<?php
					if ($_POST) {
						$urunid = array_keys($_POST['urunaciklama']);
						$urun_onay1 = $_POST['urunonay'];
						$urunaciklama = $_POST['urunaciklama'];

						$Delete = $mysqli->query("UPDATE siparisurun SET onay = '0', notlar = '' WHERE siparisID = $id ");

						foreach ($urun_onay1 as $key => $urun_ids) {
							$gonderupdate = $mysqli->query("UPDATE siparisurun SET onay = '1' WHERE siparisID = $id AND id = $urun_ids  ");
						}

						foreach ($urunid as $key => $urun_id) {
							$urun_not = $urunaciklama[$urun_id];
							$gonderupdate = $mysqli->query("UPDATE siparisurun SET notlar = '$urun_not' WHERE siparisID = $id AND id = $urun_id  ");
						}

						$urls = $_SERVER['SERVER_NAME'];
						$durum = $_POST['durum'];

						if ($yaz['durum'] !== $durum) {
							$Controlsdurum = $mysqli->query("SELECT * FROM siparisdurum WHERE sira='$durum' ")->fetch_assoc();

							$siparisno = $yaz['siparis_no'];

							$mesajs = $siparisno . " Numaralı Siparişinizin Durumu: " . $Controlsdurum['baslik'] . " olarak işaretlendi <br>" . $urls;
							mailgonder($uyebak['mail'], $mesajs, "Maestro İtaly " . $siparisno . " Numaralı Siparişiniz Düzenlendi" . $uyebak['bayiadi'], "");
						}

						$gonder = $mysqli->query(" UPDATE $konu SET  durum = '$durum' WHERE id='$id' ");

						if ($durum == 30) {

							$musteriID = $yaz['musteriID'];
							$mevcutMusteri = $mysqli->query("SELECT * FROM uyeler where id = $musteriID")->fetch_array();
							$musteri = $mevcutMusteri['bayi_adi'] . ' - ' . $mevcutMusteri['yetkili_adi'];
							$parab = $yaz['parabirimi'];

							$siparisToplam = $yaz['toplam'];

							$kasayaekle = $mysqli->query(" INSERT INTO kasa set 
							giris = '$siparisToplam',
							kasaID = 1,
							musteriID = '$musteriID',
							aciklama = '$musteri',
							parabirimi = '$parab',
							tarih = now()
							");
						}
						$notalan = $_POST['notalan'];
						$updatenot = $mysqli->query("UPDATE $konu SET notalan='$notalan' WHERE id='$id' ");

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
						<h2>Sipariş Bilgileri </h2>
						<div class="d-flex mb-2 justify-content-end">
							<button type="button" class="btn btn-primary w-10" onclick="PrintTable();">
								Print <i class="fa fa-print" style="font-size: 21px; margin-left:5px;"></i>
							</button>
						</div>
						<div id="dvContents">
							<table class="table table-striped print-table">
								<form action="" method="post" enctype="multipart/form-data">
									<tbody>
										<tr>
											<td class="delete">Onay</td>
											<td>Sıra</td>
											<td>Resimler</td>
											<td>Ürün Adı</td>
											<td> Ürün Kodu </td>
											<td>Müşteri Açıklama</td>
											<td> Adet </td>
											<td> Renk</td>
											<td> Birim Fiyat </td>
											<td> Kdv'siz Toplam </td>
											<td>Kdv</td>
											<td> Fiyat</td>
										</tr>
										<?php
										$i = 1;
										$gelenSiparis = $mysqli->query("SELECT * FROM siparisurun WHERE siparisID = '$id' ");
										while ($gs = $gelenSiparis->fetch_array()) {
											$gssi = $gs['sepetID'];
											$siparisIDs = $gs['id'];
											$urunaciklama = $gs['notlar'];

											$sepettenUrunuAl = $mysqli->query("SELECT * FROM sepet WHERE id = $gssi AND durum = 0")->fetch_array();
											$UrunID = $sepettenUrunuAl['urunID'];
											$Urunbul = $mysqli->query("SELECT * FROM urun WHERE id = '$UrunID' ")->fetch_array();
											$genelbak = $mysqli->query("SELECT * FROM ayarlar ")->fetch_array();
										?>
											<tr>
												<td class="delete">
													<input style=" width: 20px; height: 20px;" name="urunonay[<?php echo $siparisIDs; ?>]" value="<?php echo $siparisIDs; ?>" <?php echo ($gs['onay'] == 1) ? 'checked' : ''; ?> type="checkbox">

												</td>
												<td>
													<?php echo $i++ ?>
												</td>
												<td style="width:10%">
													<a data-toggle="modal" data-target="#exampleModalCenter" class="images-click" onclick="resimpopup(`<?php echo $Urunbul['baslik']; ?>`,`<?php echo $Urunbul['kodu']; ?>`,`../uploads/<?php echo $Urunbul['kresim']; ?>`)">
														<img style="height: auto; width:90%; border:1px solid black;" src="../uploads/<?php echo $Urunbul['kresim']; ?>">
													</a>
												</td>
												<td>
													<a href="/<?php echo  seocuk($Urunbul['seo']); ?>"><?php echo $Urunbul['baslik']; ?></a>

													<textarea name="urunaciklama[<?php echo $siparisIDs; ?>]" placeholder="Ürün Açıklama" class="form-control mt-2" id="" cols="0" rows="2"><?php echo $urunaciklama; ?></textarea>
												</td>
												<td>
													<a href="/<?php echo  seocuk($Urunbul['seo']); ?>"><?php echo $Urunbul['kodu']; ?></a>
												</td>
												<td>
													<?php echo $sepettenUrunuAl['aciklama']; ?>
												</td>
												<td>
													<?php echo $sepettenUrunuAl['adet']; ?>
												</td>
												<td>
													<?php
													if ($sepettenUrunuAl['renk']) {
														echo $sepettenUrunuAl['renk'];
													} ?>
												</td>
												<td>
													<?php
													$sepettenUrunuAlİndirim = yuzdeHesaplama($sepettenUrunuAl['fiyat'], $yaz['indirimorani']);
													echo number_format($sepettenUrunuAl['fiyat'] - $sepettenUrunuAlİndirim, 2, ",", ".") . $sepettenUrunuAl['parabirimi'];
													?>
												</td>
												<td>
													<?php
													$kdvsizToplami = $sepettenUrunuAl['fiyat'] * $sepettenUrunuAl['adet'];
													$kdvsizToplamiindirim = yuzdeHesaplama($kdvsizToplami, $yaz['indirimorani']);

													echo number_format($kdvsizToplami - $kdvsizToplamiindirim, 2, ",", ".") . $sepettenUrunuAl['parabirimi']; ?>
												</td>
												<td>
													<?php
													@$kdvtotal = kdvDahil($kdvsizToplami, $sepettenUrunuAl['kdv']);
													$kdv = $kdvtotal - $kdvsizToplami;

													$kdvindirim = yuzdeHesaplama($kdv, $yaz['indirimorani']);

													echo number_format($kdv - $kdvindirim, 2, ",", ".") . $sepettenUrunuAl['parabirimi'];
													?>
												</td>
												<td>
													<?php $toplamfiyat = $kdv + $kdvsizToplami;
													$toplamfiyatindirim = yuzdeHesaplama($toplamfiyat, $yaz['indirimorani']);
													echo number_format($toplamfiyat - $toplamfiyatindirim, 2, ",", ".") . $sepettenUrunuAl['parabirimi'];
													?>
												</td>
											</tr>
										<?php $uruntoplamadet += $sepettenUrunuAl['adet'];
										} ?>
									</tbody>
							</table>
							<table class="table table-striped" style="border: 0px">
								<tbody>
									<tr style="float: left;" class="bg-dark text-white h6">
										<td>Toplam Kdv'siz Tutar:</td>
										<td>
											<?php echo number_format($yaz['toplam'] - $yaz['kdv'], 2, ",", ".") . $sepettenUrunuAl['parabirimi']; ?>
										</td>
									</tr>
									<tr style="float: left;" class="bg-dark text-white h6">
										<td>Toplam Kdv Tutar:</td>
										<td>
											<?php echo number_format($yaz['kdv'], 2, ",", ".") . $sepettenUrunuAl['parabirimi']; ?>
										</td>
									</tr>
									<tr style="float: left;" class="bg-dark text-white h6">
										<td>Toplam Tutar:</td>
										<td>
											<?php echo number_format($yaz['toplam'], 2, ",", ".") . $sepettenUrunuAl['parabirimi']; ?>
										</td>
									</tr>

									<tr style="float: left;" class="bg-dark text-white h6">
										<td>Toplam Ürün (Adet):</td>
										<td>
											<?php echo $uruntoplamadet; ?>
										</td>
									</tr>
								</tbody>
							</table>
							<br>
							<h2>Müşteri Bilgileri</h2>
							<table class="table table-bordered">
								<thead>
									<tr>
										<th scope="col">Sipariş Veren Bayi</th>
										<th scope="col">Adres</th>
										<th scope="col">Yetkili Adı</th>
										<th scope="col">Telefon</th>
										<th scope="col">E-mail</th>
										<th scope="col">Tarih</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th scope="row"><?php echo $uyebak['bayi_adi']; ?></th>
										<td><?php echo $uyebak['adres']; ?></td>
										<td><?php echo $uyebak['yetkili_adi']; ?></td>
										<td><?php echo $uyebak['telefon']; ?></td>
										<td><?php echo $uyebak['mail']; ?></td>
										<td><?php echo $yaz['tarih']; ?></td>
									</tr>
								</tbody>
							</table>
						</div>
						<br>


						<div class="form-group row">
							<label for="durum" class="col-sm-2 col-form-label"> <i class="fa fa-user"></i> Durum
							</label>
							<div class="col-2">
								<select name="durum" class="custom-select task-manager-list-select">
									<?php
									$kdvs = $mysqli->query("SELECT * FROM siparisdurum ORDER BY sira DESC");
									while ($durum = $kdvs->fetch_assoc()) {
									?><option value="<?php echo $durum['sira']; ?>" <?php if ($yaz['durum'] == $durum['sira']) {
																						echo 'selected';
																					} ?>>
											<?php echo $durum['baslik']; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>

						<div class="form-group row">
							<label for="adsoyad" class="col-sm-2 col-form-label">Not * </label>
							<div class="col-sm-4">
								<textarea name="notalan" cols="70" rows="7" placeholder="Not Yazınız..."><?php echo $yaz['notalan']; ?></textarea>
							</div>
						</div>
						<hr />

						<div class="form-group row">
							<label for="sira" class="col-sm-2 col-form-label"> </label>
							<div class="col-sm-10">
								<button type="submit" class="btn btn-primary ul-btn__text">Sipariş Güncelle</button>

							</div>
						</div>
						</form>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle"> </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body data-images "></div>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
			</div>
		</div>
	</div>
</div>
<script>
	function PrintTable() {
		var printWindow = window.open('', '', 'height=800,width=1500');
		printWindow.document.write('<html><head><title>Sipariş Tablosu</title>');

		var table_style = document.getElementById("table_style").innerHTML;
		printWindow.document.write('<style type = "text/css">');
		printWindow.document.write(table_style);
		printWindow.document.write('</style>');
		printWindow.document.write('</head>');

		printWindow.document.write('<body>');
		var divContents = document.getElementById("dvContents").innerHTML;
		printWindow.document.write(divContents);
		printWindow.document.write('</body>');

		printWindow.document.write('</html>');
		printWindow.document.close();
		printWindow.print();
	}

	function resimpopup(baslik, kodu, resim) {
		var html = `<a href="${resim}" target="_blank" class="d-flex justify-content-center"><img style="height: auto; width:90%;" class="resimadd mb-3" src="${resim}"> </a> <div class="mt-4 text-center"><hr><h5>Ürün Kodu : ${kodu}</h5><hr><br><h5>Ürün Adı : ${baslik}</h5></div>`;
		$(".modal-title").html(baslik + ` - ` + kodu);
		$(".data-images").html(html);
	}
</script>