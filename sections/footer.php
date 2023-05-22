</main>
<!-- Footer-->
<footer class="footer bg-secondary py-5">
    <div class="container pt-md-2 pt-lg-3 pt-xl-4">
        <div class="row pb-4 pb-md-5 pt-sm-2 mb-lg-2">
            <div class="col-md-4 col-lg-3 pb-2 pb-md-0 mb-4 mb-md-0"><a class="navbar-brand text-nav py-0 mb-3 mb-md-4" href="index.html">
                    <img src="uploads/<?php echo $genelbak['logo']; ?>" alt="YUOG">
                </a>
                <p class="fs-sm pb-2 pb-md-3 mb-3"></p>
                <div class="d-flex justify-content-center">


                    <?php
                    $v = array('instagram', 'facebook', 'youtube', 'twitter', 'linkedin', );
                    foreach ($v as $k) {
                        $link = $k;
                        if ($$link != "") {
                    ?>

                            <a target="_blank" rel="nofollow" class="btn btn-icon btn-sm btn-secondary btn-<?php echo $k; ?> rounded-circle mx-2" href="<?php echo $$link; ?>"><i class="ai-<?php echo $k; ?>"></i></a>
                    <?php }
                    } ?>
                </div>
            </div>
            <div class="col-md-8 col-lg-7 col-xl-6 offset-lg-2">
                <div class="row row-cols-1 row-cols-sm-3">
                    <div class="col mb-3 mb-md-0">
                        <h5 class="text-primary">Hizmetler</h5>
                        <ul class="nav flex-column">
                            <?php
                            $servicesss = $mysqli->query("SELECT * FROM sahap WHERE menu = 2 AND dil = $dilID AND durum = 'on' ORDER BY sira ASC");
                            foreach ($servicesss as $serviceee) {
                            ?>
                                <li><a class="nav-link fw-normal py-1 px-0" href="<?php echo seocuk($serviceee['seo']); ?>"><?php echo $serviceee['baslik']; ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="col mb-4 mb-md-0">
                        <h5 class="text-primary">Entegrasyonlar</h5>

                        <ul class="nav flex-column">
                            <?php
                            $integrations = $mysqli->query("SELECT * FROM sahap WHERE menu = 4 AND dil = $dilID AND durum = 'on' ORDER BY sira ASC");
                            foreach ($integrations as $integration) {
                            ?>
                                <li><a class="nav-link fw-normal py-1 px-0" href="<?php echo seocuk($integration['seo']); ?>"><?php echo $integration['baslik']; ?></a></li>
                            <?php } ?>

                        </ul>
                    </div>
                    <div class="col">

                        <a class="btn btn-secondary px-3 py-2 mb-3 me-3 me-md-0" href="#">
                            <img class="mx-1 d-dark-mode-none" src="assets/img/market/appstore-dark.svg" width="120" alt="App Store">
                            <img class="mx-1 d-none d-dark-mode-block" src="assets/img/market/appstore-light.svg" width="120" alt="App Store">
                        </a>
                        <a class="btn btn-secondary px-3 py-2 mb-3 me-3 me-md-0" href="#">
                            <img class="mx-1 d-dark-mode-none" src="assets/img/market/googleplay-dark.svg" width="119" alt="Google Play">
                            <img class="mx-1 d-none d-dark-mode-block" src="assets/img/market/googleplay-light.svg" width="119" alt="Google Play">
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</footer>
<!-- Back to top button-->
<a class="btn-scroll-top" href="#top" data-scroll="">
    <svg viewbox="0 0 40 40" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <circle cx="20" cy="20" r="19" fill="none" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10">
        </circle>
    </svg><i class="ai-arrow-up"></i></a>
<!-- Vendor scripts: js libraries and plugins-->
<script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
<script src="assets/vendor/parallax-js/dist/parallax.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/aos/dist/aos.js"></script>
<!-- Main theme script-->
<script src="assets/js/theme.min.js"></script>

</body>

</html>