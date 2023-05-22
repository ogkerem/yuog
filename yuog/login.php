<?php
@define('YUOG', TRUE);

require_once("../inc/config.php");
require_once("../inc/functions.php");
require_once("../inc/security.php");

if (@$_SESSION['admin']['login'] == true) {
    header("Location: index.php");
    die;
}

?>



<?php $adres = @$_SERVER['HTTP_REFERER'];  ?>

<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $genelbak['firma']; ?> - Yönetim Sistemi </title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles/css/themes/lite-purple.min.css">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>





<body>
    <div class="auth-layout-wrap" style="background-image: url(login.jpg); background-position: center">
        <div class="auth-content" style="opacity: 0.6;">
            <div class="card o-hidden">
                <div class="row">
                    <div class="col-md-6">
                        <div class="p-4">
                            <!-- <div class="auth-logo text-center mb-4">
                                <img src="https://yuogsoftware.com/uploads/logo.png" alt="Tonyukuk">
                            </div> -->
                            <h1 class="mb-3 text-18">Giriş Yap</h1>

                            <?php

                            if ($_POST) {

                                $email             = trim($_POST['email']);
                                $password         = sha1(md5(trim($_POST['sifre'])));
                                $ip                = $_SERVER['REMOTE_ADDR'];

                                $say = $mysqli->query("select * from admin where mail='$email' && sifre='$password' ");

                                if ($say->num_rows > 0) {


                                    $adbak         = $mysqli->query("select * from admin where mail='$email' ");
                                    $admin_data = $adbak->fetch_array();

                                    $_SESSION['admin'] = array(
                                        'login'     => true,
                                        'mail'         => $email,
                                        'adsoyad'     => $admin_data['adsoyad'],
                                        'mertebe'     => $admin_data['mertebe'],
                                        'durum'     => $admin_data['durum'],
                                    );


                                    $oturumekle = $mysqli->query("insert into oturum set 
		 oturumacan 		= '$email',
		 tarih				= now(),
		 ip 				= '$ip'
		 ");

                                    sleep(3)
                            ?>

                                <?php
                                    header("Location:" . $adres);
                                } else {



                                    echo '<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<strong>Hata !</strong> Giriş Bilgileriniz Hatalı  <a href="javascript:history.back(-1)" class="alert-link"> Geri Dön </a>  
	</div>';
                                }
                            } else {
                                ?>



                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="email">Mail Adresiniz</label>
                                        <input id="email" name="email" class="form-control form-control-rounded" type="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Şifreniz</label>
                                        <input id="password" name="sifre" class="form-control form-control-rounded" type="password">
                                    </div>
                                    <button onclick="playAudio()" id="myButton" data-toggle="modal" data-target="#exampleModal" class="btn btn-rounded btn-primary btn-block mt-2">Giriş Yap</button>

                                </form>

                            <?php } ?>



                            <div class="mt-3 text-center">
                                <a href="reset" class="text-muted"><u>Şifremi Unuttum</u></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 text-center ">
                        <div class="pr-3 auth-right">


                            <a class="btn btn-rounded btn-outline-primary btn-outline-email btn-block btn-icon-text" href="">
                                CH 1
                            </a>
                            <a class="btn btn-rounded btn-outline-primary btn-outline-email btn-block btn-icon-text" href="">
                                CH 2
                            </a>
                            <a class="btn btn-rounded btn-outline-primary btn-outline-email btn-block btn-icon-text" href="">
                                CH 3
                            </a>
                            <a class="btn btn-rounded btn-outline-primary btn-outline-email btn-block btn-icon-text" href="">
                                CH 4
                            </a>

                            <!--  <a class="btn btn-rounded btn-outline-primary btn-outline-email btn-block btn-icon-text" href="signup-2.html">
                                <i class="i-Mail-with-At-Sign"></i> Sign up with Email
                            </a>
                            <a class="btn btn-rounded btn-outline-primary btn-outline-google btn-block btn-icon-text">
                                <i class="i-Google-Plus"></i> Sign up with Google
                            </a>
                            <a class="btn btn-rounded btn-outline-primary btn-block btn-icon-text btn-outline-facebook">
                                <i class="i-Facebook-2"></i> Sign up with Facebook
                            </a>  -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="width: 300px" role="document">
            <div class="modal-content">

                <div class="modal-body p-0">
                    <img src="login_mt2.gif" alt="Image" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

  


    <script src="assets/js/common-bundle-script.js"></script>

    <script src="assets/js/script.js"></script>


    <!-- <audio controls autoplay>
        <source src="ost.mp3" type="audio/ogg">
        <source src="ost.mp3" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio> -->
    <!-- 
    <script>
        $(document).mousemove(function(event) {
            var audio = new Audio('ost.mp3');
            audio.controls = true;
            audio.play();
        });
    </script> -->

 


</body>

</html>