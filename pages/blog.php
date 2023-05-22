<?php
$gelenMenu = $mysqli->query("SELECT * FROM sistemdil WHERE menuID = ")
?>
<div class="container pt-5 pb-lg-5 pb-md-4 pb-2 my-5">
    <!-- Breadcrumb-->
    <nav aria-label="breadcrumb">
        <ol class="pt-lg-3 pb-lg-4 pb-2 breadcrumb">
            <li class="breadcrumb-item"><a href="index.html"><?php echo dilbak($dilID, 1); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $icerikyaz['dname']; ?></li>
        </ol>
    </nav>
    <!-- Page title + filters-->
    <div class="row justify-content-between align-items-center gy-2 mb-4 pb-1 pb-sm-2 pb-lg-3">
        <div class="col-lg-5">
            <h1 class="mb-lg-0"><?php echo $icerikyaz['dname']; ?></h1>
        </div>

        <div class="col-lg-4 col-sm-7">
            <div class="position-relative"><i class="ai-search position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                <input class="form-control ps-5" type="search" placeholder="Aradığınız Kelime...">
            </div>
        </div>
    </div>
    <!-- Blog grid (masonry)-->
    <?php
    $blogs = $mysqli->query("SELECT * FROM sahap WHERE menu = 3 AND dil = $dilID AND durum = 'on' ORDER BY id DESC");
    foreach ($blogs as $blog) {
    ?>
        <article class="row g-0 border-0 mb-4">
            <a class="col-sm-5 col-lg-4 bg-repeat-0 bg-size-cover bg-position-center rounded-5" href="<?php echo seocuk($blog['seo']); ?>" style="background-image: url(uploads/<?php echo $blog['kresim']; ?>); min-height: 16rem"></a>
            <div class="col-sm-7 col-lg-8">
                <div class="pt-4 pb-sm-4 ps-sm-4 pe-lg-4">
                    <h3><a href="<?php echo seocuk($blog['seo']); ?>"><?php echo $blog['baslik']; ?></a></h3>
                    <p class="d-sm-none d-md-block"><?php echo $blog['onyazi']; ?></p>
                    <div class="d-flex flex-wrap align-items-center mt-n2">
                        <a class="nav-link text-muted fs-sm fw-normal p-0 mt-2" href="<?php echo seocuk($blog['seo']); ?>">
                            <?php echo $blog['hit']; ?><i class="ai-show fs-lg ms-1"></i>
                        </a>
                        <!-- <a class="nav-link text-muted fs-sm fw-normal d-flex align-items-end p-0 mt-2" href="#">
                            12<i class="ai-message fs-lg ms-1"></i>
                        </a> -->
                        <span class="fs-xs opacity-20 mt-2 mx-1">|</span>
                        <span class="fs-sm text-muted mt-2"><?php echo $blog['tarih']; ?></span>
                    </div>
                </div>
            </div>
        </article>
    <?php } ?>
    <!-- Pagination-->
    <div class="row gy-3 align-items-center mb-md-2 mb-xl-4">


    </div>
</div>