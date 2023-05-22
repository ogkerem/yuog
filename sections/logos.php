<!-- Logos (Carousel on screens < 1200px)-->
<section class="container pt-5 mt-lg-3 mt-xl-4 mt-xxl-5">
  <div class="swiper pt-2 pt-sm-4" data-swiper-options="{
        &quot;slidesPerView&quot;: 2,
        &quot;spaceBetween&quot;: 50,
        &quot;pagination&quot;: {
          &quot;el&quot;: &quot;.swiper-pagination&quot;,
          &quot;clickable&quot;: true
        },
        &quot;breakpoints&quot;: {
          &quot;500&quot;: {
            &quot;slidesPerView&quot;: 3
          },
          &quot;750&quot;: {
            &quot;slidesPerView&quot;: 4
          },
          &quot;1000&quot;: {
            &quot;slidesPerView&quot;: 5
          },
          &quot;1200&quot;: {
            &quot;slidesPerView&quot;: 6
          }
        }
      }">
    <div class="swiper-wrapper align-items-center pt-2">
      <?php
      $refLogos = $mysqli->query("SELECT * FROM bilgi WHERE konu = 'Referanslar' AND durum = 1 AND dil = $dilID ORDER BY sira ASC");
      foreach ($refLogos as $ref) {
      ?>
      <div class="swiper-slide">
        <div class="">
          <img class="d-block d-dark-mode-none mx-auto" src="uploads/bilgi/<?php echo $ref['resim']; ?>" width="196" alt="Logo">
          <img class="d-none d-dark-mode-block mx-auto" src="uploads/bilgi/<?php echo $ref['resim']; ?>" width="196" alt="Logo">
        </div>
      </div>
      <?php } ?>
    </div>
    <!-- Pagination (bullets)-->
    <div class="swiper-pagination position-relative bottom-0 mt-2 pt-4 d-xl-none"></div>
  </div>
</section>