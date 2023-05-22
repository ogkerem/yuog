<style>
    @media screen and (max-width: 992px) {
        .pt_sm_5rem {
            padding-top: 5rem;
        }
    }
</style>
<div class="vh-100  pt_sm_5rem">
    <div class="swiper h-100" data-swiper-options="{
        &quot;direction&quot;: &quot;vertical&quot;,
        &quot;mousewheel&quot;: {
          &quot;thresholdDelta&quot;: 20
        }
      }">
        <div class="swiper-wrapper">
            <?php
            $hizmetler = $mysqli->query("SELECT * FROM sahap WHERE menu = 2 AND dil = $dilID AND durum = 'on' ORDER BY sira ASC");
            foreach ($hizmetler as $hizmet) {
            ?>
                <!-- Item-->
                <div class="swiper-slide">
                    <div class="position-relative h-100">
                        <div class="bg-info position-absolute top-0 end-0 w-50 h-100 d-none d-lg-block"></div>
                        <div class="d-flex flex-column flex-lg-row align-items-center h-100 position-relative zindex-2">
                            <div class="position-relative w-100 order-lg-2">
                                <div class="bg-info position-absolute top-0 end-0 w-100 h-100 d-lg-none"></div>
                                <a href="<?php echo seocuk($hizmet['seo']); ?>">
                                    <img class="d-block position-relative zindex-2 mx-auto scale-up p-lg-5 w-75" src="uploads/<?php echo $hizmet['resim']; ?>" alt="<?php echo $hizmet['baslik']; ?>">
                                </a>
                            </div>
                            <div class="w-100 order-lg-1 px-3 px-lg-4 py-4 pt-lg-0">
                                <div class="text-center text-sm-start mx-auto" style="max-width: 450px;">
                                    <!-- <img class="d-block d-dark-mode-none mx-auto mx-sm-0 mb-2 mb-lg-3" src="assets/img/portfolio/brands/champion-blue-dark.svg" alt="Champion">
                                    <img class="d-none d-dark-mode-block mx-auto mx-sm-0 mb-2 mb-lg-3" src="assets/img/portfolio/brands/champion-blue-light.svg" alt="Champion"> -->
                                    <h2 class="h1 pb-2 pb-sm-0"><?php echo $hizmet['baslik']; ?></h2>
                                    <p class="d-none d-sm-block pb-3 pb-lg-4 mb-1"><?php echo $hizmet['onyazi']; ?></p>
                                    <!-- <div class="d-none d-lg-flex align-items-center pb-2 pb-lg-3 mb-3">
                                        <h6 class="text-body mb-0 me-3">İlgili:</h6>
                                        <img class="d-block d-dark-mode-none me-4" src="assets/img/portfolio/brands/vuejs-dark.svg" width="90" alt="Vue.js">
                                        <img class="d-none d-dark-mode-block me-4" src="assets/img/portfolio/brands/vuejs-light.svg" width="90" alt="Vue.js">
                                        <img class="d-block d-dark-mode-none" src="assets/img/portfolio/brands/deloitte-dark.svg" width="95" alt="Deloitte">
                                        <img class="d-none d-dark-mode-block" src="assets/img/portfolio/brands/deloitte-light.svg" width="95" alt="Deloitte">
                                    </div> -->
                                    <a class="btn btn-sm btn-outline-dark fs-sm rounded-pill" href="<?php echo seocuk($hizmet['seo']); ?>">İncele</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="position-fixed start-50 bottom-0 translate-middle-x rounded-4 rounded-bottom-0 bg-light shadow zindex-5 fs-sm fw-medium text-dark py-2 px-3"><?php echo dilbak($dilID, 5)
                                                                                                                                                                ?></div>
</div>