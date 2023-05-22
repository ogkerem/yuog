<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/sections/head.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/sections/header.php");
if ($_SESSION['id']) {
    $uyeid = $_SESSION['id'];
    $uyeveri = $mysqli->query("SELECT * FROM uyeler WHERE id ='$uyeid' ")->fetch_assoc();
?>


    <?php if (@$_POST) {
        if ($_POST['islem'] == 'bilgiler') {
            $bayi_adi           = strip_tags(addslashes($_POST['bayi_adi']));
            $yetkili_adi        = strip_tags(addslashes($_POST['yetkili_adi']));
            $vergi_numarasi     = strip_tags(addslashes($_POST['vergi_numarasi']));
            $vergi_dairesi      = strip_tags(addslashes($_POST['vergi_dairesi']));
            $adres              = strip_tags(addslashes($_POST['adres']));

            $resimad            = $_FILES['resim']['name'];
            $kaynak             = $_FILES['resim']['tmp_name'];
            @$gresim             = $_POST['gresim'];

            $rhedef                = "../uploads/users/";



            $guncelle = $mysqli->query("UPDATE uyeler SET bayi_adi = '$bayi_adi', yetkili_adi = '$yetkili_adi', vergi_numarasi = '$vergi_numarasi', vergi_dairesi = '$vergi_dairesi', adres = '$adres' WHERE id = $uyeid");


            if ($resimad != "") {
                unlink($rhedef . $gresim);
                $kaynak        = $_FILES['resim']['tmp_name'];
                $resimsonad = rand(9999999999999, 99999999999999999) . '-' . $resimad;
                $yukle         = move_uploaded_file($kaynak, $rhedef . "/" . $resimsonad);
                $guncelle     = $mysqli->query("update uyeler set resim='$resimsonad' where id='$uyeid' ");
            }

            if ($guncelle) {
                $yuk = 'basarili';
                header("Refresh:0");
            }
        } else if ($_POST['islem'] == 'yenisifre') {
            $sifre = md5($_POST['sifre']);
            $yenisifre = md5($_POST['yenisifre']);

            if (($sifre != '' && $yenisifre != '') && ($sifre == $yenisifre)) {
                $sifreGuncelle = $mysqli->query("UPDATE uyeler SET sifre = '$yenisifre' WHERE id = $uyeid");

                if ($sifreGuncelle) {
                    header("Refresh:0");
                }
            }
        }
    } ?>

    <section class="py-3">
        <div class="container py-5 mt-4 mt-lg-5 mb-lg-4 my-xl-5">
            <div class="row pt-sm-2 pt-lg-0">
                <?php
                require_once 'musteriSidebar.php';
                ?>
                <div class="col-lg-9 pt-4 pb-2 pb-sm-4">
                    <!-- <h1 class="h2 mb-4">Genel Bilgier</h1> -->
                    <!-- Basic info-->
                    <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4 mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center mt-sm-n1 pb-4 mb-0 mb-lg-1 mb-xl-3"><i class="ai-user text-primary lead pe-1 me-2"></i>
                                <h2 class="h4 mb-0">Genel Bilgiler</h2>
                            </div>
                            <form action="" method="POST" enctype="multipart/form-data" role="form">
                                <input type="hidden" name="islem" value="bilgiler">
                                <div class="image_change_area">
                                    <div>
                                        <div class="mb-0">
                                            <label for="formFile" class="form-label">Yeni profil görseli istemiyorsan boş bırak.</label>
                                            <input class="form-control" type="file" id="resim" name="resim">
                                        </div>
                                    </div>
                                    <div class="ps_lg_3 pt_sm_3">
                                        <h3 class="h6 mb-1">Profil Görseli</h3>
                                        <p class="fs-sm text-muted mb-0">300x300 boyutu ve JPEG, JPG, PNG, WEBP formatı tavsiye edilir. <br> 1MB boyutunu geçemez.</p>
                                    </div>
                                </div>
                                <div class="row g-3 g-sm-4 mt-0 mt-lg-2">
                                    <div class="col-sm-6">
                                        <label class="form-label" for="bayi_adi">Firma Adı</label>
                                        <input class="form-control" type="text" name="bayi_adi" value="<?php echo $uyeveri['bayi_adi']; ?>" id="bayi_adi">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label" for="yetkili_adi">Yetkili</label>
                                        <input class="form-control" type="text" name="yetkili_adi" value="<?php echo $uyeveri['yetkili_adi']; ?>" id="yetkili_adi">
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label" for="yetkili_adi">Vergi NO</label>
                                        <input class="form-control" type="text" name="vergi_numarasi" value="<?php echo $uyeveri['vergi_numarasi']; ?>" id="yetkili_adi" placeholder="Vergi NO">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label" for="vergi_dairesi">Vergi Dairesi</label>
                                        <input class="form-control" type="text" placeholder="Vergi Dairesi" name="vergi_dairesi" value="<?php echo $uyeveri['vergi_dairesi']; ?>" id="vergi_dairesi">
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label" for="adres">Adres</label>
                                        <textarea class="form-control" rows="5" name="adres" placeholder="Adres Ekle" id="adres"><?php echo $uyeveri['adres']; ?></textarea>
                                    </div>

                                    <div class="col-12 d-flex justify-content-end pt-3">
                                        <?php if (@$guncelle) { ?>
                                            <div class="alert alert-success">
                                                Bilgileriniz güncellendi.
                                            </div>
                                        <?php } ?>
                                        <button class="btn btn-primary ms-3" type="submit">Kaydet</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                    <!-- Password-->
                    <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4 mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center pb-4 mt-sm-n1 mb-0 mb-lg-1 mb-xl-3"><i class="ai-lock-closed text-primary lead pe-1 me-2"></i>
                                <h2 class="h4 mb-0">Şifreni Değiştir</h2>
                            </div>
                            <form action="" method="POST" role="form">
                                <input type="hidden" name="islem" value="yenisifre">
                                <div class="row align-items-center g-3 g-sm-4 pb-3">

                                    <div class="col-sm-6">
                                        <label class="form-label" for="new-pass">Yeni Şifre</label>
                                        <div class="password-toggle">
                                            <input class="form-control" type="password" name="sifre" id="new-pass">
                                            <label class="password-toggle-btn" aria-label="Show/hide password">
                                                <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label" for="confirm-pass">Yeni Şifreyi Doğrula</label>
                                        <div class="password-toggle">
                                            <input class="form-control" type="password" name="yenisifre" id="confirm-pass">
                                            <label class="password-toggle-btn" aria-label="Show/hide password">
                                                <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="alert alert-info d-flex my-3 my-sm-4"><i class="ai-circle-info fs-xl me-2"></i>
                                    <p class="mb-0">Yeni şifreniz için herhangi bir karakter alt limiti yoktur ama güçlü bir şifre kullanmanızı öneriyoruz.</p>
                                </div>
                                <div class="d-flex justify-content-end pt-3">
                                    <button class="btn btn-primary ms-3" type="submit">Kaydet</button>
                                </div>
                            </form>
                        </div>
                    </section>

                    <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center pb-4 mt-sm-n1 mb-0 mb-lg-1 mb-xl-3"><i class="ai-trash text-primary lead pe-1 me-2"></i>
                                <h2 class="h4 mb-0">Hesabı Sil 😿</h2>
                            </div>
                            <div class="alert alert-warning d-flex mb-4"><i class="ai-triangle-alert fs-xl me-2"></i>
                                <p class="mb-0">Eğer bu işlemi yaparsan hesabın 14 gün daha veri tabanımızda pasif olarak kalacak. Fakat 14 günden sonra ise tamamen silinecek.</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="confirm">
                                <label class="form-check-label text-dark fw-medium" for="confirm">Evet, hesabımı silmek istiyorum.</label>
                            </div>
                            <div class="d-flex flex-column flex-sm-row justify-content-end pt-4 mt-sm-2 mt-md-3">
                                <button class="btn btn-danger" type="button"><i class="ai-trash ms-n1 me-2"></i>Hesabımı Sil</button>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>




<?php
} else {
    header("Location: /uye-giris");
}

require_once($_SERVER['DOCUMENT_ROOT'] . "/sections/footer.php");
