<?php
$gelen = $mysqli->query("SELECT * FROM sahap WHERE seo = $seoID AND durum = 'on'")->fetch_assoc();
$id = $gelen['id'];
$gelenMenuID = $gelen['menu'];
$gelenMenu = $mysqli->query("SELECT * FROM sistemdil WHERE menuID = $gelenMenuID AND dilID = $dilID")->fetch_assoc();
?>
<section class="position-relative pt-5 mb-5">
    <div class="bg-secondary position-absolute top-0 end-0 w-50 h-100 d-none d-lg-block"></div>
    <div class="bg-secondary position-absolute top-0 end-0 w-100 h-100 d-lg-none"></div>
    <div class="container position-relative zindex-2 py-5 pb-lg-0">
        <!-- Breadcrumb-->
        <nav aria-label="breadcrumb">
            <ol class="pt-lg-2 pb-1 breadcrumb">
                <li class="breadcrumb-item"><a href="/"><?php echo dilbak($dilID, 1); ?></a></li>
                <li class="breadcrumb-item"><a href="<?php echo $gelenMenu['dsef']; ?>"><?php echo $gelenMenu['dname']; ?></a></li>

            </ol>
        </nav>
        <div class="d-lg-flex align-items-center pt-3 pb-xxl-5"><img class="d-block order-lg-2 me-auto me-lg-0 ms-auto" src="uploads/<?php echo $gelen['ustresim']; ?>" width="480" alt="<?php echo $gelen['baslik']; ?>">
            <div class="order-lg-1 text-center text-lg-start pe-lg-4 py-4 py-md-5">
                <h1 class="display-2 pb-3 pb-lg-4"><?php echo $gelen['baslik']; ?></h1>
                <p class="fs-lg mx-auto mx-lg-0 mb-0" style="max-width: 530px;"><?php echo $gelen['onyazi']; ?></p>
            </div>
        </div>

    </div>
</section>




<!-- Page content-->
<section class="container overflow-hidden pt-3">
    <div class="border-bottom pb-md-2 pb-lg-3 pb-xl-4 pb-xxl-5">
        <div class="row my-5">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <article>
                    <?php echo $gelen['icerik1']; ?>
                </article>
            </div>
        </div>
    </div>
</section>