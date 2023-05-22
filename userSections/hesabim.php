<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/sections/head.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/sections/header.php");
if ($_SESSION['id']) {
    $uyeid = $_SESSION['id'];
    $uyeveri = $mysqli->query("SELECT * FROM uyeler WHERE id ='$uyeid' ")->fetch_assoc();
?>


    <section class="py-3">
        <div class="container py-5 mt-4 mt-lg-5 mb-lg-4 my-xl-5">
            <div class="row pt-sm-2 pt-lg-0">
                <?php require_once 'musteriSidebar.php'; ?>
                <div class="col-lg-9 pt-4 pb-2 pb-sm-4">
                    <!-- <h1 class="h2 mb-4">Genel Bakış</h1> -->
                    <!-- Basic info-->
                    <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4 mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center mt-sm-n1 pb-4 mb-0 mb-lg-1 mb-xl-3"><i class="ai-user text-primary lead pe-1 me-2"></i>
                                <h2 class="h4 mb-0">Genel Bilgiler</h2>
                                <a class="btn btn-sm btn-secondary ms-auto" href="bilgilerim"><i class="ai-edit ms-n1 me-2"></i>Bilgileri Düzenle</a>
                            </div>
                            <div class="d-md-flex align-items-center">
                                <div class="d-sm-flex align-items-center">
                                    <?php if ($uyeveri['resim'] == '') { ?>
                                        <div class="rounded-circle bg-size-cover bg-position-center flex-shrink-0" style="width: 80px; height: 80px; background-image: url(uploads/<?php echo $genelbak['icon']; ?>);"></div>
                                    <?php } else { ?>
                                        <div class="rounded-circle bg-size-cover bg-position-center flex-shrink-0" style="width: 80px; height: 80px; 
                                        background-image: url(uploads/users/<?php echo $uyeveri['resim']; ?>);"></div>
                                    <?php } ?>
                                    <div class="pt-3 pt-sm-0 ps-sm-3">
                                        <h3 class="h5 mb-2"><?php echo $uyeveri['bayi_adi']; ?><i class="ai-circle-check-filled fs-base text-success ms-2"></i></h3>
                                        <div class="text-muted fw-medium d-flex flex-wrap flex-sm-nowrap align-iteems-center">
                                            <div class="d-flex align-items-center me-3"><i class="ai-user me-1"></i><?php echo $uyeveri['yetkili_adi'] ?></div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row py-4 mb-2 mb-sm-3">
                                <div class="col-md-6 mb-4 mb-md-0">
                                    <table class="table mb-0">
                                        <tbody>
                                            <tr>
                                                <td class="border-0 text-muted py-1 px-0">Telefon</td>
                                                <td class="border-0 text-dark fw-medium py-1 ps-3"><?php echo $uyeveri['telefon'] ?></td>
                                            </tr>
                                            <tr>
                                                <td class="border-0 text-muted py-1 px-0">Email</td>
                                                <td class="border-0 text-dark fw-medium py-1 ps-3"><?php echo $uyeveri['mail'] ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6 mb-4 mb-md-0">
                                    <table class="table mb-0">
                                        <tbody>
                                            <tr>
                                                <td class="border-0 text-muted py-1 px-0">Vergi NO</td>
                                                <td class="border-0 text-dark fw-medium py-1 ps-3"><?php echo $uyeveri['vergi_numarasi'] ?></td>
                                            </tr>
                                            <tr>
                                                <td class="border-0 text-muted py-1 px-0">Vergi Dairesi</td>
                                                <td class="border-0 text-dark fw-medium py-1 ps-3"><?php echo $uyeveri['vergi_dairesi'] ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-mg-12 mt-3">
                                    <table class="table mb-0">
                                        <tbody>
                                            <tr>
                                                <td class="border-0 text-muted py-1 px-0">Adres</td>
                                                <td class="border-0 text-dark fw-medium py-1 ps-3"><?php echo $uyeveri['adres'] ?></td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
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
?>