<?php
$content = $mysqli->query("SELECT * FROM sahap WHERE menu = 1 AND dil = $dilID AND durum = 'on' ORDER BY sira ASC")->fetch_assoc();
?>
<section class="bg-dark position-relative py-5">
    <div class="d-none d-dark-mode-block position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(255,255,255, .02);"></div>
    <div class="container dark-mode position-relative zindex-2 py-5 mb-4 mb-sm-5">
        <div class="row mb-2 mb-sm-0 mb-lg-3">
            <div class="col-lg-10 col-xl-9">
                <!-- Breadcrumb-->
                <nav aria-label="breadcrumb">
                    <ol class="pt-lg-3 pb-lg-4 pb-2 breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><?php echo dilbak($dilID, 1); ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $icerikyaz['dname']; ?></li>
                    </ol>
                </nav>
                <h1 class="display-2 pb-sm-3"><?php echo $content['baslik']; ?></h1>

            </div>
        </div>
    </div>
</section>

<section class="container pb-5 position-relative zindex-3" style="margin-top: -135px;">
    <div class="rounded-5 overflow-hidden">
        <div class="jarallax ratio ratio-16x9" data-jarallax data-speed="0.6">
            <div class="jarallax-img" style="background-image: url(uploads/<?php echo $content['resim']; ?>);"></div>
        </div>
    </div>
    <div class="row mt-n2 mt-sm-0 mt-md-2 mt-lg-4 mt-xl-5">
        <div class="col-md-6 col-lg-4">
            <!-- <div class="fs-sm text-uppercase mb-3">What we do</div> -->
            <h2 class="display-6 pt-4"><?php echo $content['onyazi']; ?></h2>
        </div>
        <div class="col-md-6 col-xl-6 offset-lg-1 offset-xl-2 pt-1 pt-sm-2">
            <div class="fs-xl">
                <?php echo $content['icerik1']; ?>
            </div>
        </div>
    </div>
</section>