<!-- Testimonials carousel-->
<section class="container py-5 mb-1 mb-sm-2 my-lg-3 my-xl-4 my-xxl-5">
    <div class="row justify-content-center pt-2 pt-sm-4 pb-4 mb-2 mb-lg-3">
        <div class="col-lg-8 col-xl-7 col-xxl-6 text-center pt-2 pb-4">
            <h2 class="h1 mb-1"></h2>
        </div>
    </div>
    <div class="swiper pb-2 pb-sm-4" data-swiper-options="{
        &quot;slidesPerView&quot;: 1,
        &quot;spaceBetween&quot;: 24,
        &quot;loop&quot;: true,
        &quot;pagination&quot;: {
          &quot;el&quot;: &quot;.swiper-pagination&quot;,
          &quot;clickable&quot;: true
        },
        &quot;breakpoints&quot;: {
          &quot;800&quot;: {
            &quot;slidesPerView&quot;: 2
          }
        }
      }">
        <div class="swiper-wrapper pt-5">
            <!-- Item-->
            <?php
            $customerComments = $mysqli->query("SELECT * FROM sahap WHERE menu = 5 AND dil = $dilID AND durum = 'on' ORDER BY sira ASC");
            foreach ($customerComments as $comment) {
            ?>
                <div class="swiper-slide h-auto">
                    <div class="card border-0 bg-faded-info h-100 text-center">
                        <div class="polygon-avatar mx-auto translate-middle-y">
                            <img src="uploads/<?php echo $comment['icon']; ?>" alt="<?php echo $comment['baslik']; ?>">
                        </div>
                        <div class="card-body pt-0 mt-n4">
                            <div class="card-text fs-xl"><?php echo $comment['icerik1']; ?></div>
                        </div>
                        <div class="card-footer border-0 pt-0">
                            <div class="h4 mb-1"><?php echo $comment['baslik']; ?></div><span><?php echo $comment['son1']; ?></span>
                        </div>
                    </div>
                </div>
                <!-- Item-->
            <?php } ?>
        </div>
        <!-- Pagination (bullets)-->
        <div class="swiper-pagination position-relative bottom-0 mt-2 mt-lg-3 pt-4"></div>
    </div>
</section>