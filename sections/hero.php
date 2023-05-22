<!-- Hero + Features-->
<?php
$banner = $mysqli->query("SELECT * FROM banner WHERE durum = 'on' AND dil = $dilID ORDER BY sira ASC")->fetch_assoc();
?>
<section class="bg-secondary position-relative pt-lg-3 pt-xl-4 pt-xxl-5">
    <div class="bg-primary position-absolute start-0 bottom-0 w-100 d-none d-xl-block" style="height: 920px;">
    </div>
    <div class="bg-primary position-absolute start-0 bottom-0 w-100 d-none d-lg-block d-xl-none" style="height: 830px;"></div>
    <div class="bg-primary position-absolute start-0 bottom-0 w-100 d-lg-none d-xl-none" style="height: 62%;">
    </div>
    <div class="bg-faded-dark rounded-circle position-absolute start-50 d-none d-lg-block" style="bottom: 220px; width: 480px; height: 480px; margin-left: -240px;" data-aos="zoom-in" data-aos-duration="700" data-aos-delay="200" data-aos-offset="300"></div>
    <div class="container position-relative zindex-5 mt-2 pt-5 pb-2 pb-sm-4 pb-lg-5">
        <h1 class="display-3 text-center mx-auto pt-5 my-2 my-sm-4" style="max-width: 680px;">
            <?php echo $banner['ustbaslik']; ?>
        </h1>
        <svg class="d-block mx-auto text-primary" width="511" height="40" viewbox="0 0 511 40" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M385.252 0.160149C313.41 0.614872 292.869 0.910678 253.008 2.06539C211.7 3.26203 182.137 4.46154 135.231 6.84429C124.358 7.39665 112.714 7.92087 99.0649 8.47247C48.9242 10.4987 39.1671 11.0386 22.9579 12.6833C14.9267 13.4984 7.98117 14.0624 4.08839 14.2162C0.627411 14.3527 0 14.4386 0 14.7762C0 15.0745 5.53537 15.3358 8.56298 15.1804C9.64797 15.1248 12.5875 14.9887 15.0956 14.8782C17.6037 14.7676 23.123 14.4706 27.3608 14.2183C37.3399 13.6238 42.1312 13.4363 59.2817 12.9693C88.1133 12.1844 109.893 11.43 136.647 10.2898C146.506 9.86957 159.597 9.31166 165.737 9.04993C212.308 7.06466 269.195 5.29439 303.956 4.74892C346.139 4.08665 477.094 3.50116 474.882 3.98441C474.006 4.17607 459.021 5.6015 450.037 6.34782C441.786 7.03345 428 8.02235 411.041 9.14508C402.997 9.67773 391.959 10.4149 386.51 10.7832C366.042 12.1673 359.3 12.5966 347.67 13.2569C294.096 16.2987 258.708 18.9493 209.451 23.6091C180.174 26.3788 156.177 29.5584 129.396 34.2165C114.171 36.8648 112.687 37.3352 114.186 39.0402C115.161 40.1495 122.843 40.2933 138.338 39.492C166.655 38.0279 193.265 36.8923 219.043 36.048C235.213 35.5184 237.354 35.4296 253.795 34.6075C259.935 34.3005 270.549 33.8517 277.382 33.6105L289.804 33.1719L273.293 32.999C248.274 32.7369 221.435 32.7528 212.596 33.035C183.334 33.9693 167.417 34.6884 141.419 36.2506C135.222 36.623 129.994 36.8956 129.801 36.8566C127.94 36.4786 169.612 30.768 189.492 28.6769C234.369 23.956 280.582 20.4337 351.602 16.3207C358.088 15.9451 371.108 15.1233 380.535 14.4947C389.962 13.866 404.821 12.8761 413.556 12.2946C447.177 10.057 457.194 9.22358 489.506 5.97543C510.201 3.895 510.311 3.8772 510.875 2.50901C511.496 1.00469 509.838 0.322131 505.088 0.127031C500.576 -0.0584957 416.098 -0.0351424 385.252 0.160149ZM291.144 33.02C291.536 33.0658 292.102 33.0641 292.402 33.0162C292.703 32.9683 292.383 32.9308 291.691 32.9329C290.999 32.935 290.753 32.9743 291.144 33.02Z">
            </path>
        </svg>





        <div class="row justify-content-center pt-3 pt-sm-4 pt-md-5 mt-sm-1">
            <div class="col-8 col-lg-4 order-lg-2" style="margin-top: -105px;">
                <!-- Middle sticky app screen-->
                <div class="position-sticky top-0 mb-5 pb-sm-2 pb-xl-4" style="padding-top: 110px;"><img class="d-block mx-auto" src="uploads/<?php echo $banner['resim']; ?>" width="322" alt="<?php echo $banner['ustbaslik']; ?>"></div>
            </div>
            <div class="col-sm-6 col-lg-4 order-lg-1 overflow-hidden mt-lg-4 pt-xl-3">
                <!-- Left app sceen--><img class="d-none d-lg-block rounded-4 ms-auto" src="uploads/<?php echo $banner['sagresim']; ?>" width="297" alt="<?php echo $banner['ustbaslik']; ?>" style="box-shadow: 0 .9375rem 3rem -.5rem rgba(18,34,50, .05);">
                <div class="d-none d-xxl-block" style="height: 310px;"></div>
                <div class="d-none d-xl-block d-xxl-none" style="height: 280px;"></div>
                <div class="d-none d-lg-block d-xl-none" style="height: 200px;"></div>
                <!-- Left features list-->

                <?php
                $x = 2;
                $servicesInfos = $mysqli->query("SELECT * FROM bilgi WHERE konu = 'Hizmetler' AND durum = 1 AND dil = $dilID ORDER BY sira ASC LIMIT 2");
                foreach ($servicesInfos as $info1) {
                ?>
                    <div class="mb-5 mx-auto mx-sm-0 pb-lg-2 pb-xl-4" style="max-width: 340px;" data-aos="fade-right" data-aos-offset="<?php echo $x; ?>00" data-aos-easing="ease-out-back" data-disable-parallax-down="lg">
                        <div class="d-table bg-faded-dark rounded-1 p-2 mb-3 mb-lg-4">
                            <img style="width:32px" src="uploads/bilgi/<?php echo $info1['resim'];  ?>" alt="<?php echo $info1['baslik']; ?>">
                        </div>
                        <h2 class="h4 text-white mb-2 mb-lg-3"><?php echo $info1['baslik']; ?></h2>
                        <div class="text-white opacity-80 mb-0"><?php echo $info1['icerik']; ?></div>
                    </div>
                <?php $x++;
                } ?>
                <!-- <div class="mb-5 mx-auto mx-sm-0 pb-lg-2 pb-xl-4" style="max-width: 340px;" data-aos="fade-right" data-aos-delay="200" data-aos-offset="250" data-aos-easing="ease-out-back" data-disable-parallax-down="lg">
                    <div class="d-table bg-faded-dark rounded-1 p-2 mb-3 mb-lg-4">

                    </div>
                    <h2 class="h4 text-white mb-2 mb-lg-3">Çözüm Odaklı</h2>
                    <p class="text-white opacity-80 mb-0">Vulputate convallis odio donec massa facilisis sed
                        nibh rhoncus, maecenas. Maecenas morbi est neque pellentesque.</p>
                </div> -->
            </div>
            <div class="col-sm-6 col-lg-4 order-lg-3 overflow-hidden mt-lg-4 pt-xl-3">
                <!-- Right app screen--><img class="d-none d-lg-block rounded-4" src="uploads/<?php echo $banner['solresim']; ?>" width="297" alt="App screen" style="box-shadow: 0 .9375rem 3rem -.5rem rgba(18,34,50, .05);">
                <div class="d-none d-xxl-block" style="height: 520px;"></div>
                <div class="d-none d-xl-block d-xxl-none" style="height: 490px;"></div>
                <div class="d-none d-lg-block d-xl-none" style="height: 400px;"></div>
                <!-- Right features list-->
                <?php
                $y = 2;
                $servicesInfos2 = $mysqli->query("SELECT * FROM bilgi WHERE konu = 'Hizmetler' AND durum = 1 AND dil = $dilID ORDER BY sira DESC LIMIT 2");
                foreach ($servicesInfos2 as $info2) {
                ?>
                    <div class="mb-5 mx-auto me-sm-0 pb-lg-2 pb-xl-4" style="max-width: 340px;" data-aos="fade-left" data-aos-offset="250" data-aos-delay="<?php echo $y; ?>00" data-aos-easing="ease-out-back" data-disable-parallax-down="lg">
                        <div class="d-table bg-faded-dark rounded-1 p-2 mb-3 mb-lg-4">
                            <img style="width:32px" src="uploads/bilgi/<?php echo $info2['resim']; ?>" alt="<?php echo $info2['baslik']; ?>">
                        </div>
                        <h2 class="h4 text-white mb-2 mb-lg-3"><?php echo $info2['baslik']; ?></h2>
                        <div class="text-white opacity-80 mb-0"><?php echo $info2['icerik']; ?></div>
                    </div>
                <?php $y++;
                } ?>

            </div>
        </div>
    </div>
</section>