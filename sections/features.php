<!-- Features (Binded slider)-->
<section class="container pt-5 mt-lg-3 mt-xl-4 mt-xxl-5">
    <div class="row align-items-center pt-3 pt-sm-4 pt-lg-5 mt-md-3 mt-lg-0">
        <div class="col-md-6 pb-2 pb-sm-0 mb-4 mb-sm-5 mb-md-0">
            <!-- Binded images-->
            <div class="binded-content bg-primary rounded-5">
                <!-- Item-->
                <?php
                $b = 1;
                $eImages = $mysqli->query("SELECT * FROM bilgi WHERE konu = 'Entegrasyonlar' AND dil = $dilID AND durum = 1 ORDER BY sira ASC");
                foreach ($eImages as $eContent) {
                ?>
                    <div class="binded-item <?php echo ($b == 1) ? 'active' : ''; ?>" id="image<?php echo $eContent['id']; ?>">
                        <svg class="d-block position-absolute top-0 start-0 w-100 h-100 text-warning" width="636" height="640" viewbox="0 0 636 640" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M586.2,329.8c-0.2-2.9-0.6-5.8-1.3-8.6c-1.5-5.8-5.5-11-11.7-15c-5.5-3.6-12.7-6.1-20.2-7c-7.4-0.9-15-0.3-21.2,1.8c-6.9,2.3-12,6.2-14.9,11.3c-3.2,5.7-4,11.1-2.5,16.1c1.4,4.3,4.5,8,9.3,11.1c5.7,3.6,13.7,6.2,22.7,7.2c8.1,1,16,0.5,20.9-1.1c3.8-1.3,7.6-2.8,11.3-4.5c-2.6,11.4-10.3,23.2-22.8,35.1c-26.2,24.9-67.3,43.8-88.6,50.5c-1.7,0.5-2.7,2.4-2.1,4.1c0.3,0.8,0.8,1.5,1.6,1.9c0.5,0.2,1,0.4,1.5,0.4c0.3,0,0.7,0,1-0.2c18.8-5.9,62.1-24.3,91.2-52c15.2-14.5,23.8-29.1,25.6-43.5c18.6-10.1,35.1-24.9,50-40.7v-9.5C621.1,303.4,604.7,319,586.2,329.8z M565.3,339.3c-4.3,1.4-11.1,1.8-18.2,0.9c-7.9-1-15-3.2-19.9-6.4c-3.5-2.2-5.7-4.7-6.5-7.5c-1-3.1-0.3-6.8,2-10.9c1.7-3.1,4.6-5.5,8.5-7.3c4.3-1.9,9.5-2.9,15-2.9c2,0,4,0.1,6.1,0.4c6.3,0.8,12.3,2.8,16.9,5.5c2.5,1.5,4.6,3.3,6.2,5.3c1.6,1.9,2.7,4.1,3.3,6.3c0.9,3.5,1.3,7,1.2,10.5C575,335.7,570.1,337.7,565.3,339.3z">
                            </path>
                            <path d="M140.2,52.6c-1.2-9-6.2-17.2-12-24c-0.8-0.9-2.1-1-3-0.2c-0.9,0.8-1,2.1-0.2,3c5.3,6.2,10,13.6,11,21.8c0.1,1.2,1.2,2,2.4,1.8C139.5,54.9,140.3,53.8,140.2,52.6z">
                            </path>
                            <path d="M124.1,72.9c-6.1,0.3-11.5,2-17.2,3.6c-1.1,0.3-1.8,1.5-1.5,2.6c0.3,1.1,1.5,1.8,2.6,1.5c5.5-1.5,10.6-3.1,16.3-3.4c1.2-0.1,2.1-1,2-2.2C126.2,73.7,125.3,72.8,124.1,72.9z">
                            </path>
                            <path d="M131.5,57.8c-11.4-6.8-25.1-12.4-38.2-15.2c-1.1-0.2-2.3,0.5-2.5,1.6c-0.2,1.1,0.5,2.3,1.6,2.5c12.6,2.8,25.9,8.1,36.9,14.7c1,0.6,2.3,0.3,2.9-0.7C132.8,59.7,132.5,58.4,131.5,57.8z">
                            </path>
                        </svg>
                        <img class="d-block position-relative zindex-2" src="uploads/bilgi/<?php echo $eContent['resim']; ?>" alt="App screen">
                    </div>
                <?php $b++; } ?>
            </div>
        </div>
        <div class="col-md-6 col-xl-5 offset-xl-1">
            <div class="ps-md-4 ps-xl-0">
                <!-- Swiper slider-->
                <div class="swiper" data-swiper-options="{
              &quot;spaceBetween&quot;: 30,
              &quot;autoHeight&quot;: true,
              &quot;bindedContent&quot;: true,
              &quot;draggable&quot;: true,
              &quot;navigation&quot;: {
                &quot;prevEl&quot;: &quot;#prev-feature&quot;,
                &quot;nextEl&quot;: &quot;#next-feature&quot;
              }
            }">
                    <div class="swiper-wrapper">
                        <?php
                        $entegreSay = 1;
                        $entegrelerContent = $mysqli->query("SELECT * FROM bilgi WHERE konu = 'Entegrasyonlar' AND dil = $dilID AND durum = 1 ORDER BY sira ASC");
                        foreach ($entegrelerContent as $entegre) {
                        ?>
                            <div class="swiper-slide" data-swiper-binded="#image<?php echo $entegre['id']; ?>">
                                <div class="text-primary fs-xl fw-bold mb-3">0<?php echo $entegreSay; ?></div>
                                <h2 class="h1 mb-lg-4"><?php echo $entegre['baslik']; ?></h2>
                                <div class="mb-0">
                                    <?php echo $entegre['icerik']; ?>
                                </div>
                            </div>
                        <?php $entegreSay++;
                        } ?>
                    </div>
                </div>
                <!-- Slider controls (Prev / next)-->
                <div class="d-flex justify-content-center justify-content-md-start pt-4 mt-2 mt-lg-0 pt-lg-5">
                    <button class="btn btn-icon btn-outline-primary rounded-circle me-3" type="button" id="prev-feature"><i class="ai-arrow-left"></i></button>
                    <button class="btn btn-icon btn-outline-primary rounded-circle" type="button" id="next-feature"><i class="ai-arrow-right"></i></button>
                </div>
            </div>
        </div>
    </div>
</section>