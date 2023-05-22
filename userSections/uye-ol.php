<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/sections/head.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/sections/header.php");

if (@$_SESSION['id']) {
    header("Location: /hesabim ");
}
?>

<div class="d-lg-flex position-relative pt-5 mt-5">
    <!-- Home button--><a class="text-nav btn btn-icon bg-light border rounded-circle position-absolute top-0 end-0 p-0 mt-3 me-3 mt-sm-4 me-sm-4" href="home" data-bs-toggle="tooltip" data-bs-placement="left" aria-label="Anasayfaya Dön" data-bs-original-title="Anasayfaya Dön"><i class="ai-home"></i></a>
    <!-- Sign in form-->
    <div class="d-flex flex-column align-items-center w-lg-50 h-100 px-3 px-lg-5 pt-5">
        <div class="w-100 mt-auto pb-5" style="max-width: 526px;">
            <?php
            if ($_POST) {
                $ad = addslashes(strip_tags($_POST['bayi_adi']));
                $mail = addslashes(strip_tags($_POST['mail']));
                //$sifre = addslashes($_POST['sifre']);
                // $sifre = md5($sifre);
                $ip             = $_SERVER["REMOTE_ADDR"];
                // $vergi_numarasi = addslashes(strip_tags($_POST['vergi_numarasi']));
                // $vergi_dairesi  = addslashes(strip_tags($_POST['vergi_dairesi']));
                $telefon        = addslashes(strip_tags($_POST['telefon']));
                // $adres          = addslashes(strip_tags($_POST['adres']));
                $yetkili_adi    = addslashes(strip_tags($_POST['yetkili_adi']));


                $listele = $mysqli->query("SELECT * FROM uyeler WHERE mail='$mail' AND durum = 1 ORDER BY id ASC ")->num_rows;
                if ($listele) {
                    $hataifadesi = 'bg-danger';
            ?>
            
                    <div class="alert alert-danger">
                        Bu mail adresi zaten kayıtlı... Tekrar denemek ister misin?
                    </div>
            <?php

                } else {
                    // $uyeol = $mysqli->query("insert into uyeler (bayi_adi, yetkili_adi, adres, mail, vergi_numarasi, vergi_dairesi, telefon, ip, yuzde) 
                    //                                                 values ('$ad', '$yetkili_adi', '$adres' ,'$mail', '$vergi_numarasi', '$vergi_dairesi', '$telefon', '$ip', 0)");

                    $uyeol = $mysqli->query("INSERT INTO uyeler SET bayi_adi = '$ad', yetkili_adi = '$yetkili_adi', telefon = '$telefon', ip = '$ip', durum = '0', mail = '$mail'");
                    if ($uyeol) {
                        ?>
                            <div class="alert alert-success">
                                Kayıt işlemi başarılı. Hesabınız onaylandıktan sonra şifreniz mail olarak iletilecektir...
                            </div>
                        <?php

                    }
                }
            }
            ?>
            <h1>
                Üye Ol
            </h1>
          
            <p class="pb-3 mb-3 mb-lg-4">Zaten hesabın var mı? <a href="/uye-giris">Giriş Yap!</a></p>
            <form method="post" accept-charset="UTF-8">
                <div class="pb-3 mb-3">
                    <div class="position-relative"><i class="ai-shopping-bag fs-lg position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                        <!-- <input class="form-control form-control-lg ps-5" type="email" placeholder="Email address" required=""> -->
                        <input class="form-control form-control-lg ps-5" type="text" name="bayi_adi" placeholder="Mağaza Adı" value="<?php echo (@$_POST['bayi_adi'] != '') ? $_POST['bayi_adi'] : ''; ?>">
                    </div>
                </div>
                <div class="pb-3 mb-3">
                    <div class="position-relative"><i class="ai-user fs-lg position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                        <!-- <input class="form-control form-control-lg ps-5" type="email" placeholder="Email address" required=""> -->
                        <input class="form-control form-control-lg ps-5" type="text" name="yetkili_adi" placeholder="Yetkili Adı" value="<?php echo (@$_POST['yetkili_adi'] != '') ? $_POST['yetkili_adi'] : ''; ?>">
                    </div>
                </div>
                <div class="pb-3 mb-3">
                    <div class="position-relative"><i class="ai-mail fs-lg position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                        <!-- <input class="form-control form-control-lg ps-5" type="email" placeholder="Email address" required=""> -->
                        <input class="form-control form-control-lg ps-5 <?php echo $hataifadesi; ?>" type="email" name="mail" placeholder="Mail" value="<?php echo (@$_POST['mail'] != '') ? $_POST['mail'] : ''; ?>">
                    </div>
                </div>
                <div class="pb-3 mb-3">
                    <div class="position-relative"><i class="ai-phone fs-lg position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                        <!-- <input class="form-control form-control-lg ps-5" type="email" placeholder="Email address" required=""> -->
                        <input class="form-control form-control-lg ps-5" type="text" name="telefon" placeholder="Telefon" value="<?php echo (@$_POST['telefon'] != '') ? $_POST['telefon'] : ''; ?>">
                    </div>
                </div>

                <button class="btn btn-lg btn-primary w-100 " type="submit">Üye Ol</button>

            </form>


        </div>
    </div>

    <div class="w-50 bg-size-cover bg-repeat-0 bg-position-center" style="background-image: url(assets/img/account/cover.jpg);"></div>
</div>
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/sections/footer.php");
?>