<?php
require_once("sections/header.php");
require_once("sections/menu2.php");
if ($_SESSION['id']) {
    $uyeid = $_SESSION['id'];
    $uyeveri = $mysqli->query("SELECT * FROM uyeler WHERE id ='$uyeid' ")->fetch_assoc();
?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        a {
            color: black;
            text-decoration: none;
        }
    </style>
    <div class="container">

        <div class="row d-flex justify-content-around" style="padding-top: 200px;">
            <?php require_once("sections/hesap-header.php"); ?>

            <div class="col-md-8">
                <div class="PageLayout PageLayout--breakLap">
                    <div class="PageLayout__Section">
                        <div class="Segment">
                            <h2 class="Segment__Title Heading u-h7"><?php echo dilbak($dilID, 69); ?> </h2>

                            <div class="Segment__Content">
                                <?php
                                if ($_POST) {
                                    if (!empty($_POST['eski_sifre']) && !empty($_POST['yeni_sifre'])) {
                                        $eski_sifre = md5($_POST['eski_sifre']);
                                        $id_uye = $uyeveri['id'];

                                        $eski_sifre_sorgu = $mysqli->query("SELECT * FROM uyeler WHERE id='$id_uye' ")->fetch_assoc();

                                        if ($eski_sifre == $eski_sifre_sorgu['sifre']) {
                                            $yeni_sifre = md5($_POST['yeni_sifre']);

                                            $sifreguncelle = $mysqli->query("UPDATE uyeler SET sifre='$yeni_sifre' WHERE id = '$id_uye' ");
                                            if ($sifreguncelle) {
                                                echo '<div class="alert alert-success">'. dilbak($dilID, 196) .'</div>';
                                                header("Refresh: 1; url=/sifre-degistir");
                                            }
                                        } else {
                                            echo '<div class="alert alert-danger">'. dilbak($dilID, 197) .'</div>';
                                        }
                                    } else {
                                        echo '<div class="alert alert-danger">'. dilbak($dilID, 198) .'</div>';
                                    }
                                }
                                ?>
                                <form action="" method="post">
                                    <div class="row mt-2">
                                        <div class="col-md-6"><label class="labels"><?php echo dilbak($dilID, 115); ?></label><input type="password" name="eski_sifre" class="Form__Input" placeholder="Eski Şifre">
                                        </div>
                                        <div class="col-md-6"><label class="labels"><?php echo dilbak($dilID, 116); ?></label><input type="password" name="yeni_sifre" class="Form__Input" placeholder="Yeni Şifre">
                                        </div>
                                    </div>

                                    <div class="Segment__ButtonWrapper">
                                        <button type="submit" class="Button Button--primary"><?php echo dilbak($dilID, 95); ?></a>
                                    </div>
                                    <br>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    </div>
    </div>
<?php


} else {
    header("Location://");
} ?>
<?php require_once("sections/footer.php"); ?>