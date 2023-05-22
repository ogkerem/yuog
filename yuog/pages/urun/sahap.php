<?php

defined('YUOG') or exit('No direct script access allowed / Yetkisiz Erişim ');
$konu 	= "urun";
$kat 	= $konu . 'kat';
$katID	= @$_GET['katID'];
if ($katID != 0) {
	$katbak = $mysqli->query("select * from $konu where id='$katID'");
	$katyaz = $katbak->fetch_array();
}


$limit         = 20;
$sayfa         = intval(@$_GET['sayfa']);
if (!$sayfa) $sayfa = 1;
if ($_POST['urunara'] == "") {
	$satirsayisi     = $mysqli->query("select id from $konu")->num_rows;
} else {
	$urunara = $_POST['urunara'];
	$satirsayisi     = $mysqli->query("SELECT * FROM $konu WHERE baslik like '%" . $urunara . "%' OR kodu like '%" . $urunara . "%'")->num_rows;
}
$toplamsayfa     = ceil($satirsayisi / $limit);
$baslangic      = ($sayfa - 1) * $limit;
$x            = 0;

$enUrunSay = $mysqli->query("SELECT id FROM urun WHERE dil = 2")->num_rows;
$trUrunSay = $mysqli->query("SELECT id FROM urun WHERE dil = 1")->num_rows;
?>


<div class="main-content">

	<div class="breadcrumb">

		<h1> <a href="?sy=<?php echo $konu; ?>"> Ürünler </a> </h1>
		<ul>
			<li><a href="index.php">Ana Sayfa</a></li>
			<?php if ($katID != 0) {  ?> <li> <?php echo $katyaz['baslik']; ?> </li> <?php } ?>
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

					<div class="row card-header text-right bg-transparent w-100 d-flex justify-content-between align-items-center">
						<div class="col-md-3">
							<form action="?sy=urun" method="POST" class="text-left">
								<input type="text" name="urunara" class="form-control w-100" placeholder="Ürün 'Kodu' veya 'Başlığı' ara...">
								<button type="submit" class="btn btn-primary btn-icon m-1">
									<span class="ul-btn__icon"><i class="i-Magnifi-Glass1"></i></span>
									<span class="ul-btn__text">Ara</span>
								</button>
							</form>
						</div>
						<!-- <button type="button" data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-primary btn-md m-1"><i class="i-Add-User text-white mr-2"></i> İçerik Ekle </button> -->

						<div class="col-md-9">

							<a href="?sy=<?php echo $konu; ?>ekle"><button type="button" class="btn btn-primary btn-icon m-1">
									<span class="ul-btn__icon"> <i class="fa fa-plus"></i> </span>
									<span class="ul-btn__text">Yeni İçerik Ekle</span>
								</button>
							</a>
							<a href="?sy=bayiurunekle"><button type="button" class="btn btn-primary btn-icon m-1">
									<span class="ul-btn__icon"><i class="fa fa-plus"></i></span>
									<span class="ul-btn__text">Bayi için ürün Ekle</span>
								</button>
							</a>


							<a href="?sy=<?php echo $kat; ?>"><button type="button" class="btn btn-warning btn-icon m-1">
									<span class="ul-btn__icon"> <i class="fa fa-asterisk"></i> </span>
									<span class="ul-btn__text">Kategoriler</span>
								</button>
							</a>

							<a href="?sy=<?php echo $konu; ?>ozellik"><button type="button" class="btn btn-danger btn-icon m-1">
									<span class="ul-btn__icon"> <i class="fa fa-calendar"></i> </span>
									<span class="ul-btn__text">Özellikler</span>
								</button>
							</a>


							<a href="?sy=<?php echo $konu; ?>renk"><button type="button" class="btn btn-primary btn-icon m-1">
									<span class="ul-btn__icon"> <i class="fa fa-calendar"></i> </span>
									<span class="ul-btn__text">Renkler</span>
								</button>
							</a>

							<a href="?sy=urunmarka"><button type="button" class="btn btn-light btn-icon m-1">
									<span class="ul-btn__icon"> <i class="fa fa-share"></i> </span>
									<span class="ul-btn__text">Markalar</span>
								</button>
							</a>

							<a href="?sy=butunurun"><button type="button" class="btn btn-info btn-icon m-1">
									<span class="ul-btn__icon"> <i class="fa fa-check-circle"></i> </span>
									<span class="ul-btn__text"> Bütün Ürünler </span>
								</button>
							</a>

							<a href="?sy=excel"><button type="button" class="btn btn-success btn-icon m-1">
									<span class="ul-btn__icon"> <i class="fa fa-check-circle"></i> </span>
									<span class="ul-btn__text"> Excel Ürün Ekleme </span>
								</button>
							</a>
						</div>

					</div>


					<div class="contaner m-3 row">
						<div class="col-md-3">
							<p>Toplam ürün sayısı :
								<b><?php echo $satirsayisi;  ?></b>
							</p>
						</div>

						<div class="col-md-3">

							<p>TR ürün sayısı :
								<b><?php echo $trUrunSay;  ?></b>
							</p>
						</div>
						<div class="col-md-3">

							<p>EN ürün sayısı :
								<b><?php echo $enUrunSay;  ?></b>
							</p>
						</div>
					</div>
					<div class="card-body">
						<!-- id="ul-contact-list" -->
						<div class="table-responsive">
							<table class="display table " style=" ">
								<thead>
									<tr>
										<th>Sıra</th>
										<th>ID</th>

										<th>Başlık</th>
										<!--	<th>Kodu</th>  -->

										<th>Marka</th>
										<th>Kategori</th>
										<th>Ürün Kodu</th>

										<!--	<th>Dökümanlar</th> 
					<th>Şartname</th>
					<th>Aksesuarlar</th> 
					<th>Videolar</th>  -->

										<th>Dil</th>
										<th>Durum</th>
										<th>İşlemler</th>
									</tr>
								</thead>
								<tbody>



									<?php
									if ($_POST['urunara'] == '') {
										$bak = $mysqli->query("select * from  $konu ORDER BY id DESC LIMIT $baslangic, $limit  ");
									} else {
										$bak = $mysqli->query("SELECT * FROM $konu WHERE baslik like '%" . $urunara . "%' OR kodu like '%" . $urunara . "%' ORDER BY id DESC LIMIT $baslangic, $limit");
									}
									while ($yaz = $bak->fetch_array()) {

										if ($yaz['durum'] == 1) {
											$durum = '<a href="#" class="badge badge-success m-2 p-2">Aktif</a>';
										} else {
											$durum = '<a href="#" class="badge badge-danger m-2 p-2">Pasif</a>';
										}

										$dil 	= $yaz['dil'];
										$dilbak = $mysqli->query("select * from diller where id='$dil' ");
										$dilyaz = $dilbak->fetch_array();


										$katID			= $yaz['katID'];
										$katIDbak 		= $mysqli->query("select * from  $kat where id='$katID' ");
										$katIDyaz 		= $katIDbak->fetch_array();

										$markaID		= $yaz['marka'];
										$markayaz 		= $mysqli->query("select * from urunmarka where id='$markaID' ")->fetch_array();


										$id		= $yaz['id'];



										echo '  <tr>
			<td>' . $yaz['sira'] . '</td>
			<td>' . $yaz['id'] . '</td>
	  
			<td>' . $yaz['baslik'] . '</td>
			<!--<td>' . $yaz['kodu'] . '</td>
			 <td>' . $yaz['fiyat'] . 'TL</td> -->
		 
			  <td>' . $markayaz['baslik'] . '   </td> 
			<td> ' . $katIDyaz['baslik'] . '   </td>
		<!--	<td>' . $katIDyaz['baslik'] . ' </td> -->
		<td>' . $yaz['kodu'] . '</td>
<!--<td><a href="?sy=urundokuman&id=' . $yaz['id'] . '"  ><button type="button" class="btn btn-primary ripple m-1">Dökümanlar</button></a></td>
<td><a href="?sy=urunsartname&id=' . $yaz['id'] . '"  ><button type="button" class="btn btn-warning m-1">Şartname</button></a></td>
<td><a href="?sy=urunaksesuar&id=' . $yaz['id'] . '"  ><button type="button" class="btn btn-light m-1">Aksesuarlar</button></a></td>
<td><a href="?sy=urunvideo&id=' . $yaz['id'] . '" ><button type="button" class="btn btn-info m-1">Videolar</button></a></td>-->
		 
			<td>' . $dilyaz['kodu'] . '</td>
			<td>' . $durum . '</td>
			
			  <td>
			  
	 
 

	 <a href="?sy=' . $konu . 'duzenle&id=' . $yaz['id'] . '" class="ul-link-action text-success mr-1"  data-toggle="tooltip" data-placement="top" title="Düzenle">
				<i class="i-Edit"></i>
			</a> 
			

				
	<a href="?sy=' . $konu . 'sil&id=' . $yaz['id'] . '" class="ul-link-action text-danger mr-1"  data-toggle="tooltip" data-placement="top" title="Sil" onclick=" if ( !confirm(\'Kaydi silmek istediğinizden emin misiniz?\') ) return false;">
			   <i class="i-Eraser-2"></i>
		   </a>
			   
			</td>
			
				</tr>

			';
									}

									?>


								</tbody>

							</table>
						</div>

						<div class="col-sm-12 col-md-7" style="margin-top: 2% !important;">
							<div class="dataTables_paginate paging_simple_numbers">
								<ul class="pagination d-flex align-items-center">
									<li class="paginate_button page-item "><a href="?sy=urun&sayfa=<?php echo 1; ?>" aria-controls="ul-contact-list" data-dt-idx="2" tabindex="0" class="page-link">Başlangıç</a></li>
									<li class="paginate_button page-item "><a aria-controls="ul-contact-list" data-dt-idx="2" tabindex="0" class="page-link">...</a></li>
									<?php
									if ($toplamsayfa > 1) {

										$forlimit = 3;

										if ($sayfa > 1) {

											echo ' <li class="paginate_button page-item previous" id="ul-contact-list_previous"><a href="?sy=urun&sayfa=' . ($sayfa - 1) . '" aria-controls="ul-contact-list" data-dt-idx="0" tabindex="0" class="page-link">Önceki</a></li> ';
										}
										for ($y = $sayfa - $forlimit; $y <= $sayfa + $forlimit + 1; $y++) {

											if ($y > 0 && $y <=  $toplamsayfa) {
												if ($y == $sayfa) {

													echo ' <li class="paginate_button page-item active"><a href="#" aria-controls="ul-contact-list" data-dt-idx="1" tabindex="0" class="page-link">' . $y . '</a></li>   ';
												} else {
													echo '<li class="paginate_button page-item "><a href="?sy=urun&sayfa=' . $y . '" aria-controls="ul-contact-list" data-dt-idx="2" tabindex="0" class="page-link">' . $y . '</a></li> ';
												}
											}
										}
										if ($sayfa != $toplamsayfa) {

											echo '<li class="paginate_button page-item "><a href="?sy=urun&sayfa=' . ($sayfa + 1) . '" aria-controls="ul-contact-list" data-dt-idx="2" tabindex="0" class="page-link">Sonraki</a></li>  ';
										}
									}

									?>
									<li class="paginate_button page-item "><a aria-controls="ul-contact-list" data-dt-idx="2" tabindex="0" class="page-link">...</a></li>
									<li class="paginate_button page-item "><a href="?sy=urun&sayfa=<?php echo $toplamsayfa; ?>" aria-controls="ul-contact-list" data-dt-idx="2" tabindex="0" class="page-link"><?php echo $toplamsayfa; ?></a></li>
								</ul>
							</div>
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