<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/sections/head.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/sections/header.php");
if (@$_SESSION['id']) {
    header("Location: /hesabim ");
}



// echo md5('destek@YUOG.com') . 'asd';
?>


<div class="d-lg-flex position-relative pt-5 mt-5">
    <!-- Home button--><a class="text-nav btn btn-icon bg-light border rounded-circle position-absolute top-0 end-0 p-0 mt-3 me-3 mt-sm-4 me-sm-4" href="home" data-bs-toggle="tooltip" data-bs-placement="left" aria-label="Anasayfaya Dön" data-bs-original-title="Anasayfaya Dön"><i class="ai-home"></i></a>
    <!-- Sign in form-->
    <div class="d-flex flex-column align-items-center w-lg-50 h-100 px-3 px-lg-5 pt-5">
        <div class="w-100 mt-auto" style="max-width: 526px;">
            <h1>Giriş Yap</h1>
            <p class="pb-3 mb-3 mb-lg-4">Hesabın yok mu?&nbsp;&nbsp;<a href="/uye-ol">Hesap Oluştur!</a></p>


            <?php
            if ($_POST) {
                if (!empty($_POST['mail']) && !empty($_POST['sifre'])) {
                    $mail = strip_tags($_POST['mail']);
                    $sifre = md5($_POST['sifre']);

                    $uyeverisi = $mysqli->query("SELECT * FROM uyeler WHERE mail='$mail' AND sifre='$sifre' AND durum = 'on' ORDER BY id ASC");
                    $uyeveri = $uyeverisi->fetch_assoc();
                    if ($uyeveri) {

                        if ($uyeveri) {
                            $_SESSION['bayi_adi'] = $uyeveri['bayi_adi'];
                            $_SESSION['mail'] = $uyeveri['mail'];
                            $_SESSION['id'] = $uyeveri['id'];
                            header("Location: /hesabim");
                        }
                    } else {
                        $onayKontrol = $mysqli->query("SELECT * FROM uyeler WHERE mail = '$mail' AND sifre = '$sifre' AND durum = 0")->num_rows;
                        if ($onayKontrol == 1) { ?>

                            <div class="alert alert-danger">
                                Hesabın pasife alınmış durumda. Eğer yanlış bir işlem olduğunu düşünüyorsan bizimle <strong><a href="iletisim">iletişime</a></strong> geçebilirsiniz.
                            </div>

                        <?php
                        } else {
                        ?>
                            <div class="alert alert-danger">
                                Mail veya şifreniz yanlış... Eğer unuttuysanız bizimle <strong><a href="iletisim">iletişime</a></strong> geçebilirsiniz.
                            </div>
                    <?php
                        }
                    }
                } else { ?>
                    <div class="alert alert-secondary">
                        Mail ve şifre alanını boş bırakarak giriş yapmak pek zekice değil...
                    </div>
            <?php
                }
            }

            ?>
            <form method="POST" action="" role="form" class="py-5">
                <div class="pb-3 mb-3">
                    <div class="position-relative"><i class="ai-mail fs-lg position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                        <!-- <input class="form-control form-control-lg ps-5" type="email" placeholder="Email address" required=""> -->
                        <input class="form-control form-control-lg ps-5" type="text" name="mail" placeholder="Mail Adresin">
                    </div>
                </div>
                <div class="mb-4">
                    <div class="position-relative"><i class="ai-key fs-lg position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                        <div class="password-toggle">
                            <input class="form-control form-control-lg ps-5" type="password" name="sifre" placeholder="Şifre" value="">
                            <label class="password-toggle-btn" aria-label="Show/hide password">
                                <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-wrap align-items-center justify-content-between pb-4">
                    <form-check class="my-1">
                        <input class="form-check-input" type="checkbox" id="keep-signedin">
                        <label class="form-check-label ms-1" for="keep-signedin">Beni hatırla</label>
                    </form-check><a class="fs-sm fw-semibold text-decoration-none my-1" href="reset-account">Şifreni mi unuttun?</a>
                </div>
                <button class="btn btn-lg btn-primary w-100 mb-4 mt-3 pb-4" type="submit">Giriş Yap</button>
                <!-- <h2 class="h6 text-center pt-3 pt-lg-4 mb-4">Or sign in with your social account</h2> -->
            </form>
        </div>
        <!-- Copyright-->
    </div>
    <!-- Cover image-->
    <div class="w-50 bg-size-cover bg-repeat-0 bg-position-center" style="background-image: url(assets/img/account/cover.jpg);"></div>
</div>

<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/sections/footer.php");
?>