<?php
define('YUOG', TRUE);
ob_start();
session_start();
require_once("../inc/config.php");
require_once("../inc/functions.php");
require_once("../inc/security.php");

if (@$_SESSION['admin']['login'] == true) {
	header("Location: index.php");
	die;
}

$yol1 	= explode("/", $_SERVER['REQUEST_URI']);
$yol 	= $yol1[1];


?>




<!DOCTYPE html>
<html lang="en">



<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php echo $genelbak['firma']; ?> - Yönetim Sistemi - Şifre Sıfırlama </title>
	<link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="assets/styles/css/themes/lite-purple.min.css">
</head>


<body>
	<div class="auth-layout-wrap" style="background-image: url(assets/images/photo-wide-4.jpg)">

		<div class="auth-content">
			<div class="card o-hidden">
				<div class="row">
					<div class="col-md-6">
						<div class="p-4">
							<div class="auth-logo text-center mb-4">
								<img src="assets/images/logo.png" alt="YUOG">
							</div>
							<h1 class="mb-3 text-18">Şifre Sıfırla</h1>



							<?php
							if ($_POST) {
								$mail1		= trim($_POST['mail1']);
								$tarih		= time();
								$ip			= $_SERVER['REMOTE_ADDR'];

								$say 	= $mysqli->query("select * from admin where mail='$mail1'")->num_rows;

								if ($say > 0) {

									$hatirlat = substr(md5(rand(0, 100)), 0, 10);

									$hguncelle 	= $mysqli->query("update admin set hatirlat='$hatirlat' where mail='$mail1'");
									$adminbak 	= $mysqli->query("select * from admin where mail='$mail1' ")->fetch_array();

									$adminmail 	= $genelbak['mail'];
									$siteadi	= $genelbak['firma'];
									$siteadresi	= $genelbak['web'];
									$slogan		= $genelbak['slogan'];
									$eposta_konusu = $siteadi . ' Şifre Sıfırlama ';
									$adsoyad	= $adminbak['adsoyad'];

									$eposta_mesaji = 'Güvenlik Kodunuz : ' . $hatirlat . ' <br> <br><br> Bu kodu kopyalanız<br>Şifrenizi değiştirmek için <a href="https://www.' . $siteadresi . '/' . $yol . '/sifreolustur.php?kod=' . $hatirlat . '">tıklayınız</a> ';


									// Create the Transport
									//$transport = new Swift_SmtpTransport('smtp.example.org', 587, 'tls');
									$transport = (new Swift_SmtpTransport(gethostbyname($genelbak['mailurl']), 587))
										->setUsername($genelbak['mail2'])
										->setPassword($genelbak['mailsifre']);

									// Create the Mailer using your created Transport
									$mailer = new Swift_Mailer($transport);

									// Create a message
									$sendmessage = (new Swift_Message($eposta_konusu))
										->setFrom([$genelbak['mail2'] => $genelbak['firma']])
										->setTo($genelbak['mail'])
										->setBody($eposta_mesaji, 'text/html');

									// Send the message
									$result = $mailer->send($sendmessage);



									if ($result) {
										echo 'Şifreniz Mail Adresinize Gönderilmiştir <br> Lütfen Mail Adresinizi Kontrol Ediniz <br> Yönlendiriliyorsunuz ';
										header("Refresh:7; url=index.php");
									}
								} else {
									echo '<br><br>' . $mail1 . ' Mail Adresi Sistemde Kayıtlı Değildir  ';
								}
							} else {

							?>


								<form action="#" method="post">
									<div class="form-group">
										<label for="email">Mail Adresiniz</label>
										<input id="email" class="form-control form-control-rounded" type="email" name="mail1" required>
									</div>
									<button class="btn btn-primary btn-block btn-rounded mt-3">Sıfırla</button>

								</form>

							<?php } ?>


							<div class="mt-3 text-center">
								<a class="text-muted" href="index.php"><u>Giriş Yap</u></a>
							</div>
						</div>
					</div>
					<div class="col-md-6 text-center " >
						<div class="pr-3 auth-right">

							<a class="btn btn-rounded btn-outline-primary btn-outline-email btn-block btn-icon-text" href="../">
								<i class="nav-icon i-Cursor-Click"></i> Siteye Git
							</a>


							<!--     <a class="btn btn-outline-primary btn-outline-email btn-block btn-icon-text btn-rounded" href="signup-2.html">
                                <i class="i-Mail-with-At-Sign"></i> Sign up with Email
                            </a>
                            <a class="btn btn-outline-primary btn-outline-google btn-block btn-icon-text btn-rounded">
                                <i class="i-Google-Plus"></i> Sign in with Google
                            </a>
                            <a class="btn btn-outline-primary btn-outline-facebook btn-block btn-icon-text btn-rounded">
                                <i class="i-Facebook-2"></i> Sign in with Facebook
                            </a>  -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<script src="assets/js/common-bundle-script.js"></script>

	<script src="assets/js/script.js"></script>
</body>



</html>