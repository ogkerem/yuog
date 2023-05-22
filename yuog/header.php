<?php

defined('YUOG') or exit('No direct script access allowed / Yetkisiz Erişim ');

$adminbak 	= $mysqli->query("select * from admin where mail='$email' ")->fetch_array();
?>

<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">


	<meta name="keywords" content="<?php echo $genelbak['firma']; ?> | the future is here" />
	<meta name="description" content="<?php echo $genelbak['firma']; ?> | the future is here">

	<title> <?php echo $genelbak['firma']; ?> | the future is here </title>


	<link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">

	<link id="gull-theme" rel="stylesheet" href="assets/styles/css/themes/lite-purple.min.css">
	<link rel="stylesheet" href="assets/styles/vendor/perfect-scrollbar.css">

	<link rel="stylesheet" href="assets/styles/vendor/datatables.min.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
	<script src="ckeditor/ckeditor.js"></script>

	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</head>

<body class="text-left dark-theme">

	<!--  <div class='loadscreen' id="preloader">

            <div class="loader spinner-bubble spinner-bubble-primary">


            </div>
        </div> -->


	<div class="app-admin-wrap layout-sidebar-large clearfix">
		<div class="main-header">
			<div class="logo">
				<a href="/yuog"><img src="https://yuogsoftware.com/uploads/logo2.png" alt="Yuog Panel"></a>
			</div>
			<button class="btn btn-outline-primary" id="toggle-dark-mode"> Mod Değiştir</button>
			<script>
				$(document).ready(function() {
					$("#toggle-dark-mode").click(function() {
						$("body").toggleClass("dark-theme");
					});
				});
			</script>
			<div class="menu-toggle">
				<div></div>
				<div></div>
				<div></div>
			</div>

			<div class="d-flex align-items-center">

				<div class="dropdown mega-menu d-none d-md-block">
					<a href="#" class="btn text-muted dropdown-toggle mr-3" id="dropdownMegaMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hızlı Menü</a>
					<div class="dropdown-menu text-left" aria-labelledby="dropdownMenuButton">
						<div class="row m-0">
							<div class="col-md-4 p-4 bg-img">
								<h2 class="title">En Çok <br> Kullanılanlar</h2>
								<p>İşinize göre en çok kullandıklaırınızı hızlı menüye ekledik.
								</p>

								<a href="../" target="_blank"><button class="btn btn-lg btn-rounded btn-outline-warning">Siteye Git</button></a>

							</div>

							<div class="col-md-4 p-4">
								<p class="text-primary text--cap border-bottom-primary d-inline-block">Genel</p>
								<div class="menu-icon-grid w-auto p-0">
									<a href="index.php"><i class="i-Shop-4"></i> Ana Sayfa</a>
									<a href="?sy=banner"><i class="i-Library"></i> Banner</a>
									<a href="?sy=tasarim"><i class="i-Drop"></i> Arkaplan Resimleri </a>
									<a href="?sy=kurumsal"><i class="i-File-Clipboard-File--Text"></i>Kurumsal</a>
									<a href="?sy=blog"><i class="i-Hotel"></i> Blog</a>
									<a href="?sy=genel"><i class="i-Ambulance"></i> Site Ayarlar </a>
								</div>
							</div>

							<!-- <div class="col-md-4 p-4">
		<p class="text-primary text--cap border-bottom-primary d-inline-block">İçerikler</p>
		<ul class="links">
			<li><a href="?sy=kurumsal">Kurumsal</a></li>
			<li><a href="?sy=hizmet">Hizmetler</a></li>
			<li><a href="?sy=urun">Ürünler</a></li>
		 
										  
		</ul>
	</div> -->

						</div>
					</div>
				</div>


				<div class="search-bar">
					<input type="text" placeholder="Sistemde Ara">
					<i class="search-icon text-muted i-Magnifi-Glass1"></i>
				</div>
			</div>

			<div style="margin: auto"></div>

			<?php
			//if(genel('bakim')==1){ 

			//echo '<button type="button" class="btn btn-danger m-1"><strong>Dikkat!</strong> Site Bakım Modunda</button>'; 
			//}
			?>
			<a href="?sy=sistem"><button type="button" class="btn btn-warning btn-rounded m-1">Sisteme Git</button></a>

			<a href="../" target="_blank">

				<button type="button" class="btn btn-success btn-rounded m-1"><i class="nav-icon i-Cursor-Click"></i> Siteye Git</button>
			</a>
			<div class="header-part-right">

				<i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen></i>

				<div class="dropdown widget_dropdown">
					<i class="i-Safe-Box text-muted header-icon" role="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<div class="menu-icon-grid">

							<a href="?sy=genel"><i class="i-Shop-4"></i> Genel</a>
							<a href="?sy=altbilgi"><i class="i-Library"></i> KVKK</a>
							<a href="?sy=social"><i class="i-Drop"></i> Sosyal Medya </a>
							<a href="?sy=analytic"><i class="i-File-Clipboard-File--Text"></i> Analytic </a>
							<a href="?sy=xml"><i class="i-Hotel"></i> XML</a>
							<a href="?sy=contact"><i class="i-Ambulance"></i> İletişim</a>


						</div>
					</div>
				</div>

				<div class="dropdown">
					<div class="badge-top-container" role="button" id="dropdownNotification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

						<?php $iletbak = $mysqli->query("select * from iletisim where durum='0' "); ?>
						<span class="badge badge-primary"><?php echo $iletbak->num_rows; ?></span>
						<i class="i-Bell text-muted header-icon"></i>
					</div>

					<div class="dropdown-menu dropdown-menu-right notification-dropdown rtl-ps-none" aria-labelledby="dropdownNotification" data-perfect-scrollbar data-suppress-scroll-x="true">

						<?php
						while ($ileyaz = $iletbak->fetch_array()) {

							echo '<div class="dropdown-item d-flex">
		<div class="notification-icon">
			<i class="i-Speach-Bubble-6 text-primary mr-1"></i>
		</div>
		<div class="notification-details flex-grow-1">
			<p class="m-0 d-flex align-items-center">
				<span>' . $ileyaz['adsoyad'] . ' </span>
				<span class="badge badge-pill badge-primary ml-1 mr-1">' . $ileyaz['konu'] . ' </span>
				<span class="flex-grow-1"></span>
				<span class="text-small text-muted ml-auto">' . substr($ileyaz['tarih'], 0, 10) . ' </span>
			</p>
			<p class="text-small text-muted m-0"><a href="?sy=iletisimduzenle&id=' . $ileyaz['id'] . '">Devamı</a></p>
		</div>
	</div>';
						}
						?>

					</div>
				</div>

				<div class="dropdown">
					<div class="user col align-self-end">
						<img src="assets/images/user.png" id="userDropdown" alt="Admin" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
							<div class="dropdown-header">
								<i class="i-Lock-User mr-1"></i> <?php echo $adminbak['adsoyad']; ?>
							</div>
							<a href="?sy=adminduzenle&id=<?php echo $adminbak['id']; ?>" class="dropdown-item">Hesabım</a>

							<a class="dropdown-item" href="?sy=exit">Çıkış Yap</a>
						</div>
					</div>
				</div>

			</div>

		</div>