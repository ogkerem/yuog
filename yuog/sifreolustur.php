<?php 
define('YUOG',TRUE);
ob_start(); 
session_start();
require_once("../inc/config.php");
require_once("../inc/functions.php");
require_once("../inc/security.php");

if(@$_SESSION['admin']['login'] == true){
	header("Location: index.php");die;	
}

$kod		= $_GET['kod'];
$mailbak 	= $mysqli->query("select * from admin where hatirlat='$kod' ");
$mailyaz 	= $mailbak->fetch_array();
$mailsay 	= $mailbak->num_rows; 
$mail 		= $mailyaz['mail'];
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
                              <img src="assets/images/logo.png" alt="Net Dünyası">
                            </div>
                            <h1 class="mb-3 text-18">Şifre Sıfırla</h1>
							
					
	
<?php 

if($mailsay==0){
	
	echo '<div class="alert alert-danger" role="alert">
		<strong class="text-capitalize">Hata!</strong> Kodunuz hatalı yada daha önce kullanılmış olabilir.  <br/>
		
		Yönlendiriliyorsunuz ...
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
	</div>';
	
	header ("Refresh:4; url=index.php");
	
	
} else {
	 
?>


 
					
<form action="#" method="post" >
	
	
	<div class="form-group">
		<label for="email">Mail Adresiniz</label>
		<input id="email" class="form-control form-control-rounded" type="email"  name="mail" value="<?php echo $mailyaz['mail']; ?>" disabled >
	</div>
		 
	<div class="form-group">
		<label for="email">Sıfırlama Kodu</label>
		<input id="email" class="form-control form-control-rounded" type="email"  value="<?php echo $mailyaz['hatirlat']; ?>" disabled >
	</div>
	
	<div class="form-group">
		<label for="email">Yeni Şifreniz</label>
		<input id="email" class="form-control form-control-rounded" type="password" name="sifre1" required >
	</div>
	
	<div class="form-group">
		<label for="email">Şifre Tekrar</label>
		<input id="email" class="form-control form-control-rounded" type="password" name="sifre2" required >
	</div>
	
	
	<button class="btn btn-primary btn-block btn-rounded mt-3">Sıfırla</button>

</form>

 
 <?php 
	
	if($_POST){
		
	$sifre1				= trim($_POST['sifre1']);
	$sifre2				= trim($_POST['sifre2']);
	 
	 
		if($sifre1==$sifre2){
		 
		$sifre = sha1(md5(trim($_POST['sifre1'])));
		$guncelle = $mysqli->query("update admin set sifre='$sifre' , hatirlat='' where mail='$mail' ");
		if($guncelle){
			
			echo '<div class="alert alert-success" role="alert">
				<strong class="text-capitalize">Başarılı!</strong> Şifreniz başarı ile güncellenmiştir. <br/> Yönlendiriliyorsunuz ... 
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>'; 
			
			header ("Refresh:4; url=login");	
			
		} else {
			
			echo '<div class="alert alert-danger" role="alert">
		<strong class="text-capitalize">Hata!</strong> Şifreniz güncellenemedi <br/>  
		
		Lütfen destek birimimize ulaşınız. www.YUOG.com 
		
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
	</div>';
	
		}
	}
	
	
	}
	
 ?>


<?php } ?>
							
							
                            <div class="mt-3 text-center">
                                <a class="text-muted" href="login"><u>Giriş Yap</u></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 text-center " style="background-size: cover;background-image: url(http://gull-html-laravel.ui-lib.com/assets/images/photo-long-3.jpg)">
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