<?php
$blog = $mysqli->query("SELECT * FROM sahap WHERE menu = 3 AND durum = 'on' AND seo = $seoID")->fetch_assoc();

$menuID = $blog['menu'];
$gelenMenu = $mysqli->query("SELECT * FROM sistemdil WHERE menuID = $menuID AND dilID = $dilID")->fetch_assoc();
?>
<section class="container py-5 mt-5 mb-md-2 mb-lg-3 mb-xl-4">
    <!-- Breadcrumb-->
    <nav aria-label="breadcrumb">
        <ol class="pt-lg-3 pb-lg-4 pb-2 breadcrumb">
            <li class="breadcrumb-item"><a href="/"><?php echo dilbak($dilID, 1); ?></a></li>
            <li class="breadcrumb-item"><a href="blog-grid.html">Blog</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $blog['baslik']; ?></li>
        </ol>
    </nav>
    <!-- Post title + post meta-->
    <h1 class="display-4 text-center pb-2 pb-lg-3"><?php echo $blog['baslik']; ?></h1>
    <div class="d-flex flex-wrap align-items-center justify-content-center mt-n2">
        <span class="text-muted fs-sm fw-normal p-0 mt-2 me-3">
            <?php echo $blog['hit']; ?><i class="ai-show fs-lg ms-1"></i>
        </span>
        <a class="nav-link position-relative text-muted fs-sm fw-normal d-flex align-items-end p-0 mt-2" href="#comments" data-scroll data-scroll-offset="60">
            <span class="position-absolute w-100 h-100 top-0 start-0" data-bs-toggle="collapse" data-bs-target="#commentsCollapse"></span>
            4<i class="ai-message fs-lg ms-1"></i>
        </a>
        <span class="fs-xs opacity-20 mt-2 mx-3">|</span>
        <span class="fs-sm text-muted mt-2"><?php echo $blog['tarih']; ?></span>
    </div>
</section>









<?php if ($blog['ustresim'] != '') { ?>
    <section class="jarallax" data-jarallax data-speed=".65">
        <div class="jarallax-img bg-position-center-y" style="background-image: url(uploads/<?php echo $blog['ustresim']; ?>);">
        </div>
        <div class="d-none d-xxl-block" style="height: 760px;"></div>
        <div class="d-none d-xl-block d-xxl-none" style="height: 650px;"></div>
        <div class="d-none d-lg-block d-xl-none" style="height: 500px;"></div>
        <div class="d-none d-md-block d-lg-none" style="height: 400px;"></div>
        <div class="d-md-none" style="height: 300px;"></div>
    </section>
<?php } ?>




<section class="container pt-5 mt-md-2 mt-lg-3 mt-xl-4">
    <div class="row justify-content-center pt-xxl-2">
        <div class="col-lg-9 col-xl-8">
            <div class="fs-lg">
                <?php echo $blog['icerik1']; ?>
            </div>
            <?php if ($blog['resim'] != '') { ?>
                <style>
                    .figure-img {
                        width: 100%;
                    }
                </style>
                <figure class="figure">
                    <img class="figure-img rounded-5 mb-3" src="uploads/<?php echo $blog['resim']; ?>" alt="<?php echo $blog['baslik']; ?>">
                    <figcaption class="figure-caption"><?php echo $blog['onyazi']; ?></figcaption>
                </figure>
            <?php } ?>

           

        </div>

    </div>
</section>




<script src="assets/vendor/jarallax/dist/jarallax.min.js"></script>