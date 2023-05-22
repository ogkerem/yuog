<?php
if (@$_SESSION['id']) {
    $gelen = $mysqli->query("SELECT * FROM urun where dil = $dilID and durum = 1 AND seo = $seoID")->fetch_array();
} else {
    $gelen = $mysqli->query("SELECT * FROM urun where dil = $dilID and durum = 1 AND seo = $seoID  AND bayiozel = 0 ")->fetch_array();
    if (!$gelen) {
        require_once("yok.php");
    }
}

$gID = $gelen['id'];
$id = $gelen['id'];
$katID = $gelen['katID'];

$katBul = $mysqli->query("SELECT * FROM urunkat where id = $katID and dil = $dilID and durum = 1")->fetch_array();
$gelenKatID = $katBul['id'];
?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    window.__pagefly_global_settings__ = {
        fontFamilies: ["Playfair Display", "Lato", "Source Sans Pro"],
        selectedFonts: {
            "Playfair Display": {
                "400": 0
            },
            "Lato": {
                "400": 0
            },
            "Source Sans Pro": {
                "400": 0
            }
        }
    };
</script>

<div style="opacity:0; padding-top:110px;" class="sc-jJoQJp bATEBn __pf" id="__pf">
    <div data-pf-type="Body" class="sc-evcjhq leJfDA pf-1_">
        <div data-pf-type="Layout" class="sc-ctqQKy hrYNC pf-2_">
            <div data-pf-type="ProductPreview" class="sc-eicpiI eKFFEo pf-3_">
                <div id="shopify-section-product-template" class="shopify-section shopify-section--bordered">
                    <section class="Product Product--large" data-section-id="product-template" data-section-type="product" data-section-settings='{
                                        "enableHistoryState": true,
                                        "templateSuffix": "pf-dc83f7ac",
                                        "showInventoryQuantity": false,
                                        "showSku": true,
                                        "stackProductImages": true,
                                        "showThumbnails": true,
                                        "enableVideoLooping": true,
                                        "inventoryQuantityThreshold": 3,
                                        "showPriceInButton": false,
                                        "enableImageZoom": true,
                                        "showPaymentButton": true,
                                        "useAjaxCart": true
                                        }'>
                        <div class="Product__Wrapper">
                            <div class="Product__Gallery Product__Gallery--stack Product__Gallery--withThumbnails">
                                <span id="ProductGallery" class="Anchor"></span>
                                <div class="Product__ActionList hidden-lap-and-up is-hidden">
                                    <div class="Product__ActionItem hidden-lap-and-up zoom-button">
                                        <button class="RoundButton RoundButton--small RoundButton--flat" aria-label="Zoom" data-action="open-product-zoom"><svg class="Icon Icon--plus" width="28px" height="30px" viewBox="0 0 23 25" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <title>Group 5</title>
                                                <defs>
                                                    <polygon id="path-1" points="0 0.0392207394 22.9538996 0.0392207394 22.9538996 23.3655321 0 23.3655321">
                                                    </polygon>
                                                </defs>
                                                <g id="Mobile-Creative-Concept" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <g id="Mobile-PDP-_Product-Variant-1" transform="translate(-340.000000, -435.000000)">
                                                        <g id="Group-5" transform="translate(351.500000, 447.500000) scale(-1, 1) translate(-351.500000, -447.500000) translate(340.000000, 435.000000)">
                                                            <polygon id="Fill-1" fill="#000000" points="15.2060329 4.76151557 13.663056 4.76151557 13.663056 7.9031017 10.5771021 7.9031017 10.5771021 9.47389477 13.663056 9.47389477 13.663056 12.6154809 15.2060329 12.6154809 15.2060329 9.47389477 18.2919868 9.47389477 18.2919868 7.9031017 15.2060329 7.9031017">
                                                            </polygon>
                                                            <g id="Group-4" transform="translate(0.000000, 0.009867)">
                                                                <mask id="mask-2" fill="white">
                                                                    <use xlink:href="#path-1"></use>
                                                                </mask>
                                                                <g id="Clip-3"></g>
                                                                <path d="M14.5,15.9901335 C10.3579319,15.9901335 7,12.6322899 7,8.49010858 C7,4.347977 10.3579319,0.990133456 14.5,0.990133456 C18.6421178,0.990133456 22,4.347977 22,8.49010858 C21.995621,12.6304487 18.6403264,15.9857545 14.5,15.9901335 M19.9404123,1.96484159 C18.4035166,0.681694842 16.4642064,-0.0174993748 14.4635364,-0.00986654395 C9.76723542,0.00524887955 5.97234476,3.83136006 5.987419,8.53594105 C5.99369993,10.5048267 6.6806406,12.4107432 7.93136738,13.9295522 L0,21.8982172 L1.08998324,22.9901335 L9.05227213,15.0524447 C12.659991,18.0644588 18.0219258,17.5764361 21.0286562,13.9623677 C24.0352899,10.3482993 23.5480829,4.97690406 19.9404123,1.96484159" id="Fill-2" fill="#000000" mask="url(#mask-2)"></path>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg></button>
                                    </div>
                                </div>
                                <div class="Product__SlideshowNav Product__SlideshowNav--thumbnails">
                                    <div class="Product__SlideshowNavScroller">
                                        <a href="<?php echo seocuk($gelen['seo']); ?>#<?php echo $gelen['id']; ?>" data-offset="-25" data-focus-on-click data-media-id="25195694424234" class="Product__SlideshowNavImage AspectRatio is-selected" style="--aspect-ratio: 1.0">
                                            <img src="uploads/<?php echo $gelen['resim']; ?>" alt="<?php echo $gelen['keywords']; ?>">
                                            <span class="Product__SlideshowNavBadge">
                                            </span>
                                        </a>
                                        <?php
                                        $urunResim = $mysqli->query("SELECT * FROM galeri where icerikID = $gID AND konu = 'urun' and durum = 1 order by sira asc");
                                        while ($galeri = $urunResim->fetch_array()) {
                                        ?>
                                            <a href="<?php echo seocuk($gelen['seo']); ?>#<?php echo $galeri['id']; ?>" data-offset="-25" data-focus-on-click data-media-id="25195694424234" class="Product__SlideshowNavImage AspectRatio is-selected" style="--aspect-ratio: 1.0">
                                                <img src="uploads/<?php echo $galeri['resim']; ?>" alt="<?php echo $gelen['keywords']; ?>">
                                                <span class="Product__SlideshowNavBadge">
                                                </span>
                                            </a>
                                        <?php } ?>

                                    </div>
                                </div>
                                <div class="Product__SlideshowNav Product__SlideshowNav--dots">
                                    <div class="Product__SlideshowNavScroller">
                                        <?php
                                        $urunResim = $mysqli->query("SELECT * FROM galeri where icerikID = $gID AND konu = 'urun' order by sira asc");
                                        while ($galeri = $urunResim->fetch_array()) {
                                        ?>
                                            <a href="#<?php echo $galeri['id']; ?>" data-focus-on-click class="Product__SlideshowNavDot">
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="Product__Slideshow Product__Slideshow--zoomable Carousel" data-flickity-config='{
                                                            "prevNextButtons": false,
                                                            "pageDots": false,
                                                            "adaptiveHeight": true,
                                                            "watchCSS": true,
                                                            "dragThreshold": 8,
                                                            "initialIndex": 0,
                                                            "arrowShape": {"x0": 20, "x1": 60, "y1": 40, "x2": 60, "y2": 35, "x3": 25}
                                            }'>
                                            <div id="<?php echo $gelen['id']; ?>" tabindex="0" class="Product__SlideItem Product__SlideItem--image Carousel__Cell " data-media-type="image" data-media-id="24943203156138" data-media-position="2" data-image-media-position="0">
                                            <div class="AspectRatio AspectRatio--withFallback" style="padding-bottom: 100.0%; --aspect-ratio: 1.0;">


                                                <img class="Image--lazyLoad Image--fadeIn" data-src="uploads/<?php echo $gelen['resim']; ?>" data-widths="[200,400,600,700,800,900,600]" data-sizes="auto" data-expand="-100" alt="<?php echo $gelen['keywords']; ?>" data-max-width="600" data-max-height="600" data-original-src="uploads/<?php echo $gelen['resim']; ?>">
                                                <span class="Image__Loader"></span>

                                                <noscript>
                                                    <img src="uploads/<?php echo $gelen['resim']; ?>" alt="<?php echo $gelen['keywords']; ?>">
                                                </noscript>
                                            </div>
                                        </div>
                                    <?php
                                    $urunResim = $mysqli->query("SELECT * FROM galeri where icerikID = $gID AND konu = 'urun' AND durum = 1  order by sira asc");
                                    while ($galeri = $urunResim->fetch_array()) {
                                    ?>
                                        <div id="<?php echo $galeri['id']; ?>" tabindex="0" class="Product__SlideItem Product__SlideItem--image Carousel__Cell " data-media-type="image" data-media-id="24943203156138" data-media-position="2" data-image-media-position="0">
                                            <div class="AspectRatio AspectRatio--withFallback" style="padding-bottom: 100.0%; --aspect-ratio: 1.0;">


                                                <img class="Image--lazyLoad Image--fadeIn" data-src="uploads/<?php echo $galeri['resim']; ?>" data-widths="[200,400,600,700,800,900,600]" data-sizes="auto" data-expand="-100" alt="<?php echo $gelen['keywords']; ?>" data-max-width="600" data-max-height="600" data-original-src="uploads/<?php echo $galeri['resim']; ?>">
                                                <span class="Image__Loader"></span>

                                                <noscript>
                                                    <img src="uploads/<?php echo $galeri['resim']; ?>" alt="<?php echo $gelen['keywords']; ?>">
                                                </noscript>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <!--  video alanı
                                                <div id="Media25195694424234" tabindex="-1" class="Product__SlideItem Product__SlideItem--video Carousel__Cell is-selected">
                                                    <div class="Image--lazyLoad Image--fadeIn" data-expand="-100">
                                                        <div class="VideoWrapper VideoWrapper--native" style="padding-bottom: 98.32841691248771%">

                                                            <video playsinline="playsinline" controls="controls" autoplay="autoplay" muted="muted" preload="metadata" aria-label="LOVE Morse Code Ring - White Silver" poster="//cdn.shopify.com/s/files/1/0592/0148/7018/products/A20448OX_1_498ff397-c548-4c87-9730-99ba0aecc76a_1024x.jpg?v=1644998857">
                                                                <source src="https://cdn.shopify.com/videos/c/vp/ef264592e755494caaca6e7ac55743fc/ef264592e755494caaca6e7ac55743fc.m3u8" type="application/x-mpegURL">
                                                                <source src="https://cdn.shopify.com/videos/c/vp/ef264592e755494caaca6e7ac55743fc/ef264592e755494caaca6e7ac55743fc.HD
                                                                -720p-1.6Mbps.mp4" type="video/mp4">
                                                                <img src="//cdn.shopify.com/s/files/1/0592/0148/7018/products/A20448OX_1_498ff397-c548-4c87-9730-99ba0aecc76a_1024x.jpg?v=1644998857">
                                                            </video>
                                                        </div>
                                                    </div>
                                                </div> -->
                                </div>
                                <div class="Product__SlideshowMobileNav hidden-desk">
                                    <button class="Product__SlideshowNavArrow Product__SlideshowNavArrow--previous" type="button" data-direction="previous" aria-label="Previous">
                                        <svg class="Icon Icon--media-arrow-left" role="presentation" viewBox="0 0 6 9">
                                            <path d="M5 8.5l-4-4 4-4" stroke="currentColor" fill="none" fill-rule="evenodd" stroke-linecap="square"></path>
                                        </svg>
                                    </button>

                                    <button class="Product__SlideshowNavArrow Product__SlideshowNavArrow--next" type="button" data-direction="next" aria-label="Next">
                                        <svg class="Icon Icon--media-arrow-right" role="presentation" viewBox="0 0 6 9">
                                            <path d="M1 8.5l4-4-4-4" stroke="currentColor" fill="none" fill-rule="evenodd" stroke-linecap="square"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="Product__InfoWrapper">
                                <div class="Product__Info ">
                                    <div class="Container">
                                        <div class="ProductMeta">
                                            <h2 class="ProductMeta__Vendor Heading u-h6"><a href="<?php echo seocuk($katBul['seo']); ?>"><?php echo $katBul['baslik']; ?></a>
                                            </h2>
                                            <h1 class="ProductMeta__Title Heading u-h2">
                                                <?php echo $gelen['baslik']; ?>
                                            </h1>
                                            <p class="ProductMeta__Sku Heading Text--subdued u-h6">
                                                <?php echo dilbak($dilID, 142); ?>
                                                <span class="ProductMeta__SkuNumber"><?php echo $gelen['kodu']; ?></span>

                                            </p>
                                            <div class="ProductMeta__PriceList Heading"><span class="ProductMeta__Price Price Text--subdued u-h4">
                                                    <?php
                                                    if ($gelen['fiyat'] != 0) {

                                                        //fiyat durumu 0 bayi ise herkes ise 1
                                                        if (@$_SESSION['id']) {


                                                            $bayi = $mysqli->query("SELECT * FROM uyeler WHERE id='{$_SESSION['id']}' ")->fetch_assoc();
                                                            if ($bayi['yuzde'] > 0) {
                                                    ?>
                                                                <style>
                                                                    .cizgi {
                                                                        text-decoration: line-through;
                                                                        font-size: 13px;
                                                                    }
                                                                </style>
                                                    <?php
                                                                echo "<div class='cizgi'>";
                                                                echo number_format($gelen['fiyat'], 2, ',', '.') . $parabirimi['simge'];
                                                                echo "</div>";
                                                                $yuzde = yuzdeHesaplama($gelen['fiyat'], $bayi['yuzde']);
                                                                $toplam = $gelen['fiyat'] - $yuzde;
                                                                $toplamgosterme = $toplam;
                                                            } else {
                                                                $toplam = $gelen['fiyat'];
                                                                $toplamgosterme = $toplam;
                                                            }

                                                            echo number_format($toplamgosterme, 2, ',', '.') . $parabirimi['simge'];
                                                        } else {
                                                            if ($gelen['fiyatdurumu'] == 1) {

                                                                echo number_format($gelen['fiyat'], 2, ',', '.') . $parabirimi['simge'];
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </span>
                                            </div>

                                            <div class="ProductMeta__UnitPriceMeasurement" style="display:none">
                                                <div class="UnitPriceMeasurement Heading u-h6 Text--subdued">
                                                    <span class="UnitPriceMeasurement__Price"></span>
                                                    <span class="UnitPriceMeasurement__Separator">/
                                                    </span><span class="UnitPriceMeasurement__ReferenceValue"></span><span class="UnitPriceMeasurement__ReferenceUnit"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--      --><span data-recommendations="5"></span>

                                        <?php if (@$_SESSION['id']) {
                                            if (!$gelen['stok'] <= 0  || !empty($gelen['stok'])) {
                                        ?>
                                                <form method="post" accept-charset="UTF-8" class="SepetEkle">
                                                    <br>
                                                    <h2 class="podwraptitle"><?php echo dilbak($dilID, 133); ?></h2>
                                                    <div>
                                                        <?php

                                                        $urunrenkbulControl = $mysqli->query("SELECT * FROM urunrenksec WHERE urunID='$id' ")->num_rows;
                                                        $urunrenkbul = $mysqli->query("SELECT * FROM urunrenksec WHERE urunID='$id' ");

                                                        if ($urunrenkbulControl) {
                                                        ?>
                                                            <div class="color_pod_main">
                                                                <div class="pod-image" style="display:flex;">
                                                                    <div class="ProductForm__Variants">
                                                                        <div class="ProductForm__Option ProductForm__Option--labelled">
                                                                            <span class="ProductForm__Label">
                                                                            </span>
                                                                            <style>
                                                                                .optionform {
                                                                                    width: 100%;
                                                                                    padding: 0.25em 0.5em;
                                                                                    font-size: 1.15rem;
                                                                                    cursor: pointer;
                                                                                    color: black;
                                                                                    background-color: white;
                                                                                    box-shadow: 1px rgba(0, 0, 0, 0.8);


                                                                                }
                                                                            </style>
                                                                            <select name="renk" class="optionform">

                                                                                <?php
                                                                                while ($urunrenk = $urunrenkbul->fetch_array()) {

                                                                                    $urunrenkID = $urunrenk['id'];
                                                                                    $secrenkID = $urunrenk['renkID'];
                                                                                    $renkbul = $mysqli->query("SELECT * FROM urunrenk WHERE id='$secrenkID' ")->fetch_array();
                                                                                ?>
                                                                                    <option value="<?php echo $renkbul['baslik']; ?>">
                                                                                        <?php echo $renkbul['baslik']; ?>
                                                                                    </option>

                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php } ?>


                                                    </div>


                                                    <div class="pod_title"></div>

                                                    <div class="ProductForm__Variants">
                                                        <?php //yorumsatiri.php 
                                                        ?>

                                                        <span class="ProductForm__Label"><?php echo dilbak($dilID, 65); ?></span>
                                                        <div class="ProductForm__QuantitySelector">
                                                            <div class="QuantitySelector QuantitySelector--large">

                                                                <!-- EKSİ BUTONU  -->
                                                                <button type="button" class="QuantitySelector__Button Link Link--secondary" data-action="decrease-quantity">
                                                                    <svg class="Icon Icon--minus" role="presentation" viewBox="0 0 16 2">
                                                                        <path d="M1,1 L15,1" stroke="currentColor" fill="none" fill-rule="evenodd" stroke-linecap="square"></path>
                                                                    </svg>
                                                                </button>

                                                                <!-- EKSİ BUTONU  -->

                                                                <!-- ADET  -->
                                                                <input type="text" class="QuantitySelector__CurrentQuantity" name="adet" min="1" pattern="[0-9]*" value="1" aria-label="Quantity">
                                                                <!-- ADET -->

                                                                <!-- + butonu -->
                                                                <button type="button" class="QuantitySelector__Button Link Link--secondary" data-action="increase-quantity">
                                                                    <svg class="Icon Icon--plus" role="presentation" viewBox="0 0 16 16">
                                                                        <g stroke="currentColor" fill="none" fill-rule="evenodd" stroke-linecap="square">
                                                                            <path d="M8,1 L8,15"></path>
                                                                            <path d="M1,8 L15,8"></path>
                                                                        </g>
                                                                    </svg>
                                                                </button>

                                                                <!-- + butonu -->
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <input type="hidden" name="id" value="<?php echo $gelen['id']; ?>">
                                                    <!-- <input type="hidden" name="fiyat" value="<?php echo $gelen['fiyat']; ?>">
                                                    <input type="hidden" name="kdv" value="<?php echo $gelen['KDV']; ?>"> -->

                                                    <button type="submit" <?php echo ($gelen['fiyat'] == 0) ? 'disabled' : '' ?> class="ProductForm__AddToCarts Button Button--secondary Button--full">
                                                        <span><?php echo dilbak($dilID, 140); ?></span></button>

                                                </form>


                                            <?php
                                            } else {
                                            ?><div class="sold-out-label-text">
                                                    <?php echo dilbak($dilID, 139); ?></div>
                                        <?php
                                            }
                                        } ?>
                                        <style>
                                            #shopify-section-product-template .shopify-payment-button {
                                                display: none;
                                            }
                                        </style>
                                        <div class="Product__OffScreen"></div>



                                        <script type="application/json" data-product-json>
                                            {
                                                "product": {
                                                    "id": 6901096710314,
                                                    "title": "LOVE Morse Code Ring - White Silver",
                                                    "handle": "love-morse-code-ring-a20448ox",
                                                    "description": "\u003cmeta charset=\"utf-8\"\u003e\n\u003cp data-mce-fragment=\"1\"\u003eThis ring is handcrafted from sterling silver and micropaved with white zirconia stones. \u003cbr data-mce-fragment=\"1\"\u003e \u003cbr data-mce-fragment=\"1\"\u003eEmbellished with the word \"LOVE\" in Morse code, this ring is perfect to show your love. Mix and match it with different rings for a unique statement.\n \u003cbr data-mce-fragment=\"1\"\u003e\n\u003c\/p\u003e\u003cp data-mce-fragment=\"1\"\u003eMaterial: Sterling silver \u003cbr data-mce-fragment=\"1\"\u003eStones: Micropaved white zirconia stones \u003cbr data-mce-fragment=\"1\"\u003eColor: Silver \u003cbr data-mce-fragment=\"1\"\u003eSize: Choose your size from 48 to 60 \u003cbr data-mce-fragment=\"1\"\u003eAll our products are handcrafted.\u003c\/p\u003e",
                                                    "published_at": "2021-05-26T18:27:39+08:00",
                                                    "created_at": "2021-08-12T18:47:38+08:00",
                                                    "vendor": "morse code",
                                                    "type": "RINGS",
                                                    "tags": ["Category_Rings", "Color_White",
                                                        "Featured Collections_Morse Code", "Gift for her",
                                                        "Gifts", "pod01:love-morse-code-ring-a20448ox",
                                                        "pod:love-morse-code-ring-p20448ox",
                                                        "pod:love-morse-code-ring-with-colorful-stones-a20448mbr",
                                                        "pod:love-morse-code-ring-y20448ox",
                                                        "pod:neon-yellow-love-morse-code-ring-a20449xfy",
                                                        "Pre_Order_Delivery", "Style_Fashion", "Style_Love"
                                                    ],
                                                    "price": 6500,
                                                    "price_min": 6500,
                                                    "price_max": 6500,
                                                    "available": true,
                                                    "price_varies": false,
                                                    "compare_at_price": null,
                                                    "compare_at_price_min": 0,
                                                    "compare_at_price_max": 0,
                                                    "compare_at_price_varies": false,
                                                    "variants": [{
                                                        "id": 41079538942122,
                                                        "title": "48",
                                                        "option1": "48",
                                                        "option2": null,
                                                        "option3": null,
                                                        "sku": "A20448OX-048",
                                                        "requires_shipping": true,
                                                        "taxable": true,
                                                        "featured_image": null,
                                                        "available": true,
                                                        "name": "LOVE Morse Code Ring - White Silver - 48",
                                                        "public_title": "48",
                                                        "options": ["48"],
                                                        "price": 6500,
                                                        "weight": 50,
                                                        "compare_at_price": null,
                                                        "inventory_management": "shopify",
                                                        "barcode": null,
                                                        "requires_selling_plan": false,
                                                        "selling_plan_allocations": []
                                                    }, {
                                                        "id": 41079538974890,
                                                        "title": "50",
                                                        "option1": "50",
                                                        "option2": null,
                                                        "option3": null,
                                                        "sku": "A20448OX-050",
                                                        "requires_shipping": true,
                                                        "taxable": true,
                                                        "featured_image": null,
                                                        "available": true,
                                                        "name": "LOVE Morse Code Ring - White Silver - 50",
                                                        "public_title": "50",
                                                        "options": ["50"],
                                                        "price": 6500,
                                                        "weight": 50,
                                                        "compare_at_price": null,
                                                        "inventory_management": "shopify",
                                                        "barcode": null,
                                                        "requires_selling_plan": false,
                                                        "selling_plan_allocations": []
                                                    }, {
                                                        "id": 41079539007658,
                                                        "title": "52",
                                                        "option1": "52",
                                                        "option2": null,
                                                        "option3": null,
                                                        "sku": "A20448OX-052",
                                                        "requires_shipping": true,
                                                        "taxable": true,
                                                        "featured_image": null,
                                                        "available": true,
                                                        "name": "LOVE Morse Code Ring - White Silver - 52",
                                                        "public_title": "52",
                                                        "options": ["52"],
                                                        "price": 6500,
                                                        "weight": 50,
                                                        "compare_at_price": null,
                                                        "inventory_management": "shopify",
                                                        "barcode": null,
                                                        "requires_selling_plan": false,
                                                        "selling_plan_allocations": []
                                                    }, {
                                                        "id": 41079539040426,
                                                        "title": "54",
                                                        "option1": "54",
                                                        "option2": null,
                                                        "option3": null,
                                                        "sku": "A20448OX-054",
                                                        "requires_shipping": true,
                                                        "taxable": true,
                                                        "featured_image": null,
                                                        "available": true,
                                                        "name": "LOVE Morse Code Ring - White Silver - 54",
                                                        "public_title": "54",
                                                        "options": ["54"],
                                                        "price": 6500,
                                                        "weight": 50,
                                                        "compare_at_price": null,
                                                        "inventory_management": "shopify",
                                                        "barcode": null,
                                                        "requires_selling_plan": false,
                                                        "selling_plan_allocations": []
                                                    }, {
                                                        "id": 41079539073194,
                                                        "title": "56",
                                                        "option1": "56",
                                                        "option2": null,
                                                        "option3": null,
                                                        "sku": "A20448OX-056",
                                                        "requires_shipping": true,
                                                        "taxable": true,
                                                        "featured_image": null,
                                                        "available": true,
                                                        "name": "LOVE Morse Code Ring - White Silver - 56",
                                                        "public_title": "56",
                                                        "options": ["56"],
                                                        "price": 6500,
                                                        "weight": 50,
                                                        "compare_at_price": null,
                                                        "inventory_management": "shopify",
                                                        "barcode": null,
                                                        "requires_selling_plan": false,
                                                        "selling_plan_allocations": []
                                                    }, {
                                                        "id": 41079539105962,
                                                        "title": "58",
                                                        "option1": "58",
                                                        "option2": null,
                                                        "option3": null,
                                                        "sku": "A20448OX-058",
                                                        "requires_shipping": true,
                                                        "taxable": true,
                                                        "featured_image": null,
                                                        "available": true,
                                                        "name": "LOVE Morse Code Ring - White Silver - 58",
                                                        "public_title": "58",
                                                        "options": ["58"],
                                                        "price": 6500,
                                                        "weight": 50,
                                                        "compare_at_price": null,
                                                        "inventory_management": "shopify",
                                                        "barcode": null,
                                                        "requires_selling_plan": false,
                                                        "selling_plan_allocations": []
                                                    }, {
                                                        "id": 41079539138730,
                                                        "title": "60",
                                                        "option1": "60",
                                                        "option2": null,
                                                        "option3": null,
                                                        "sku": "A20448OX-060",
                                                        "requires_shipping": true,
                                                        "taxable": true,
                                                        "featured_image": null,
                                                        "available": true,
                                                        "name": "LOVE Morse Code Ring - White Silver - 60",
                                                        "public_title": "60",
                                                        "options": ["60"],
                                                        "price": 6500,
                                                        "weight": 50,
                                                        "compare_at_price": null,
                                                        "inventory_management": "shopify",
                                                        "barcode": null,
                                                        "requires_selling_plan": false,
                                                        "selling_plan_allocations": []
                                                    }, {
                                                        "id": 42552821907626,
                                                        "title": "62",
                                                        "option1": "62",
                                                        "option2": null,
                                                        "option3": null,
                                                        "sku": "A20448OX-062",
                                                        "requires_shipping": true,
                                                        "taxable": true,
                                                        "featured_image": null,
                                                        "available": true,
                                                        "name": "LOVE Morse Code Ring - White Silver - 62",
                                                        "public_title": "62",
                                                        "options": ["62"],
                                                        "price": 6500,
                                                        "weight": 50,
                                                        "compare_at_price": null,
                                                        "inventory_management": "shopify",
                                                        "barcode": "",
                                                        "requires_selling_plan": false,
                                                        "selling_plan_allocations": []
                                                    }, {
                                                        "id": 42552821940394,
                                                        "title": "64",
                                                        "option1": "64",
                                                        "option2": null,
                                                        "option3": null,
                                                        "sku": "A20448OX-064",
                                                        "requires_shipping": true,
                                                        "taxable": true,
                                                        "featured_image": null,
                                                        "available": true,
                                                        "name": "LOVE Morse Code Ring - White Silver - 64",
                                                        "public_title": "64",
                                                        "options": ["64"],
                                                        "price": 6500,
                                                        "weight": 50,
                                                        "compare_at_price": null,
                                                        "inventory_management": "shopify",
                                                        "barcode": "",
                                                        "requires_selling_plan": false,
                                                        "selling_plan_allocations": []
                                                    }],
                                                    "images": [
                                                        "\/\/cdn.shopify.com\/s\/files\/1\/0592\/0148\/7018\/products\/A20448OX_58136978-d5f5-4035-8201-cb18c92c2ad0.jpg?v=1644998844",
                                                        "\/\/cdn.shopify.com\/s\/files\/1\/0592\/0148\/7018\/products\/A20448OX.jpg?v=1644998844",
                                                        "\/\/cdn.shopify.com\/s\/files\/1\/0592\/0148\/7018\/products\/A20448OX_1_49a1a5c3-ddec-4b7c-bd5c-4cfd42133afc.jpg?v=1644998844",
                                                        "\/\/cdn.shopify.com\/s\/files\/1\/0592\/0148\/7018\/products\/Morse-Rings_f930c6e9-34dc-4954-9dac-487ee6efe3c6.jpg?v=1644998844",
                                                        "\/\/cdn.shopify.com\/s\/files\/1\/0592\/0148\/7018\/products\/A20448OX_APM_MONACO_LOVE_Morse_Code_Ring_3.jpg?v=1644998844"
                                                    ],
                                                    "featured_image": "\/\/cdn.shopify.com\/s\/files\/1\/0592\/0148\/7018\/products\/A20448OX_58136978-d5f5-4035-8201-cb18c92c2ad0.jpg?v=1644998844",
                                                    "options": ["Size"],
                                                    "media": [{
                                                        "alt": null,
                                                        "id": 25195694424234,
                                                        "position": 1,
                                                        "preview_image": {
                                                            "aspect_ratio": 1.0,
                                                            "height": 600,
                                                            "width": 600,
                                                            "src": "https:\/\/cdn.shopify.com\/s\/files\/1\/0592\/0148\/7018\/products\/A20448OX_1_498ff397-c548-4c87-9730-99ba0aecc76a.jpg?v=1644998857"
                                                        },
                                                        "aspect_ratio": 1.017,
                                                        "duration": 6773,
                                                        "media_type": "video",
                                                        "sources": [{
                                                            "format": "mp4",
                                                            "height": 480,
                                                            "mime_type": "video\/mp4",
                                                            "url": "https:\/\/cdn.shopify.com\/videos\/c\/vp\/ef264592e755494caaca6e7ac55743fc\/ef264592e755494caaca6e7ac55743fc.SD-480p-0.9Mbps.mp4",
                                                            "width": 488
                                                        }, {
                                                            "format": "mp4",
                                                            "height": 720,
                                                            "mime_type": "video\/mp4",
                                                            "url": "https:\/\/cdn.shopify.com\/videos\/c\/vp\/ef264592e755494caaca6e7ac55743fc\/ef264592e755494caaca6e7ac55743fc.HD-720p-1.6Mbps.mp4",
                                                            "width": 732
                                                        }, {
                                                            "format": "m3u8",
                                                            "height": 720,
                                                            "mime_type": "application\/x-mpegURL",
                                                            "url": "https:\/\/cdn.shopify.com\/videos\/c\/vp\/ef264592e755494caaca6e7ac55743fc\/ef264592e755494caaca6e7ac55743fc.m3u8",
                                                            "width": 732
                                                        }]
                                                    }, {
                                                        "alt": "LOVE Morse Code Ring in White Silver APM Monaco",
                                                        "id": 24943203156138,
                                                        "position": 2,
                                                        "preview_image": {
                                                            "aspect_ratio": 1.0,
                                                            "height": 600,
                                                            "width": 600,
                                                            "src": "https:\/\/cdn.shopify.com\/s\/files\/1\/0592\/0148\/7018\/products\/A20448OX_58136978-d5f5-4035-8201-cb18c92c2ad0.jpg?v=1644998844"
                                                        },
                                                        "aspect_ratio": 1.0,
                                                        "height": 600,
                                                        "media_type": "image",
                                                        "src": "https:\/\/cdn.shopify.com\/s\/files\/1\/0592\/0148\/7018\/products\/A20448OX_58136978-d5f5-4035-8201-cb18c92c2ad0.jpg?v=1644998844",
                                                        "width": 600
                                                    }, {
                                                        "alt": null,
                                                        "id": 24455065993386,
                                                        "position": 3,
                                                        "preview_image": {
                                                            "aspect_ratio": 1.0,
                                                            "height": 600,
                                                            "width": 600,
                                                            "src": "https:\/\/cdn.shopify.com\/s\/files\/1\/0592\/0148\/7018\/products\/A20448OX.jpg?v=1644998844"
                                                        },
                                                        "aspect_ratio": 1.0,
                                                        "height": 600,
                                                        "media_type": "image",
                                                        "src": "https:\/\/cdn.shopify.com\/s\/files\/1\/0592\/0148\/7018\/products\/A20448OX.jpg?v=1644998844",
                                                        "width": 600
                                                    }, {
                                                        "alt": null,
                                                        "id": 24455066026154,
                                                        "position": 4,
                                                        "preview_image": {
                                                            "aspect_ratio": 1.0,
                                                            "height": 600,
                                                            "width": 600,
                                                            "src": "https:\/\/cdn.shopify.com\/s\/files\/1\/0592\/0148\/7018\/products\/A20448OX_1_49a1a5c3-ddec-4b7c-bd5c-4cfd42133afc.jpg?v=1644998844"
                                                        },
                                                        "aspect_ratio": 1.0,
                                                        "height": 600,
                                                        "media_type": "image",
                                                        "src": "https:\/\/cdn.shopify.com\/s\/files\/1\/0592\/0148\/7018\/products\/A20448OX_1_49a1a5c3-ddec-4b7c-bd5c-4cfd42133afc.jpg?v=1644998844",
                                                        "width": 600
                                                    }, {
                                                        "alt": null,
                                                        "id": 25195694915754,
                                                        "position": 5,
                                                        "preview_image": {
                                                            "aspect_ratio": 1.0,
                                                            "height": 600,
                                                            "width": 600,
                                                            "src": "https:\/\/cdn.shopify.com\/s\/files\/1\/0592\/0148\/7018\/products\/Morse-Rings_f930c6e9-34dc-4954-9dac-487ee6efe3c6.jpg?v=1644998844"
                                                        },
                                                        "aspect_ratio": 1.0,
                                                        "height": 600,
                                                        "media_type": "image",
                                                        "src": "https:\/\/cdn.shopify.com\/s\/files\/1\/0592\/0148\/7018\/products\/Morse-Rings_f930c6e9-34dc-4954-9dac-487ee6efe3c6.jpg?v=1644998844",
                                                        "width": 600
                                                    }, {
                                                        "alt": null,
                                                        "id": 24455066058922,
                                                        "position": 6,
                                                        "preview_image": {
                                                            "aspect_ratio": 1.0,
                                                            "height": 600,
                                                            "width": 600,
                                                            "src": "https:\/\/cdn.shopify.com\/s\/files\/1\/0592\/0148\/7018\/products\/A20448OX_APM_MONACO_LOVE_Morse_Code_Ring_3.jpg?v=1644998844"
                                                        },
                                                        "aspect_ratio": 1.0,
                                                        "height": 600,
                                                        "media_type": "image",
                                                        "src": "https:\/\/cdn.shopify.com\/s\/files\/1\/0592\/0148\/7018\/products\/A20448OX_APM_MONACO_LOVE_Morse_Code_Ring_3.jpg?v=1644998844",
                                                        "width": 600
                                                    }, {
                                                        "alt": null,
                                                        "id": 23380167950506,
                                                        "position": 7,
                                                        "preview_image": {
                                                            "aspect_ratio": 1.126,
                                                            "height": 888,
                                                            "width": 600,
                                                            "src": "https:\/\/cdn.shopify.com\/s\/files\/1\/0592\/0148\/7018\/products\/a13fc7a10dfb4c98b5d6ba4ab6e488ed.thumbnail.0000000.jpg?v=1632473717"
                                                        },
                                                        "aspect_ratio": 1.129,
                                                        "duration": 5939,
                                                        "media_type": "video",
                                                        "sources": [{
                                                            "format": "mp4",
                                                            "height": 480,
                                                            "mime_type": "video\/mp4",
                                                            "url": "https:\/\/cdn.shopify.com\/videos\/c\/vp\/a13fc7a10dfb4c98b5d6ba4ab6e488ed\/a13fc7a10dfb4c98b5d6ba4ab6e488ed.SD-480p-0.9Mbps.mp4",
                                                            "width": 542
                                                        }, {
                                                            "format": "mp4",
                                                            "height": 720,
                                                            "mime_type": "video\/mp4",
                                                            "url": "https:\/\/cdn.shopify.com\/videos\/c\/vp\/a13fc7a10dfb4c98b5d6ba4ab6e488ed\/a13fc7a10dfb4c98b5d6ba4ab6e488ed.HD-720p-1.6Mbps.mp4",
                                                            "width": 812
                                                        }, {
                                                            "format": "m3u8",
                                                            "height": 720,
                                                            "mime_type": "application\/x-mpegURL",
                                                            "url": "https:\/\/cdn.shopify.com\/videos\/c\/vp\/a13fc7a10dfb4c98b5d6ba4ab6e488ed\/a13fc7a10dfb4c98b5d6ba4ab6e488ed.m3u8",
                                                            "width": 812
                                                        }]
                                                    }],
                                                    "requires_selling_plan": false,
                                                    "selling_plan_groups": [],
                                                    "content": "\u003cmeta charset=\"utf-8\"\u003e\n\u003cp data-mce-fragment=\"1\"\u003eThis ring is handcrafted from sterling silver and micropaved with white zirconia stones. \u003cbr data-mce-fragment=\"1\"\u003e \u003cbr data-mce-fragment=\"1\"\u003eEmbellished with the word \"LOVE\" in Morse code, this ring is perfect to show your love. Mix and match it with different rings for a unique statement.\n \u003cbr data-mce-fragment=\"1\"\u003e\n\u003c\/p\u003e\u003cp data-mce-fragment=\"1\"\u003eMaterial: Sterling silver \u003cbr data-mce-fragment=\"1\"\u003eStones: Micropaved white zirconia stones \u003cbr data-mce-fragment=\"1\"\u003eColor: Silver \u003cbr data-mce-fragment=\"1\"\u003eSize: Choose your size from 48 to 60 \u003cbr data-mce-fragment=\"1\"\u003eAll our products are handcrafted.\u003c\/p\u003e"
                                                },
                                                "selected_variant_id": 41079538942122
                                            }
                                        </script>


                                        <div class="ProductMeta__Description">
                                            <div class="Rte">
                                                <meta charset="utf-8">
                                                <?php
                                                echo $gelen['icerik'];
                                                ?>
                                            </div>
                                        </div>
                                        <?php
                                        $urunOzellikSay = $mysqli->query("SELECT * FROM urunozelliksec WHERE urunID = $gID and icerik != '' ORDER BY sira ASC")->num_rows;
                                        if ($urunOzellikSay  != 0) {
                                        ?>
                                            <div class="Product__QuickNav hidden-pocket">
                                                <div class="Product__QuickNavWrapper">
                                                    <a href="#ProductAside" class="Heading Link Link--secondary u-h7"><?php echo dilbak($dilID, 134); ?>
                                                        <svg class="Icon Icon--select-arrow-right" role="presentation" viewBox="0 0 11 18">
                                                            <path d="M1.5 1.5l8 7.5-8 7.5" stroke-width="2" stroke="currentColor" fill="none" fill-rule="evenodd" stroke-linecap="square">
                                                            </path>
                                                        </svg></a>
                                                    <a href="#ProductGallery" class="Heading Link Link--secondary u-h7"><?php echo dilbak($dilID, 135); ?>
                                                        <svg class="Icon Icon--select-arrow-right" role="presentation" viewBox="0 0 11 18">
                                                            <path d="M1.5 1.5l8 7.5-8 7.5" stroke-width="2" stroke="currentColor" fill="none" fill-rule="evenodd" stroke-linecap="square">
                                                            </path>
                                                        </svg></a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="Product__Aside">
                                <span id="ProductAside" class="Anchor"></span>
                                <div class="Product__Tabs">
                                    <?php
                                    $urunOzellikSor = $mysqli->query("SELECT * FROM urunozelliksec WHERE urunID = $gID and icerik != '' ORDER BY sira ASC");
                                    while ($ozellik = $urunOzellikSor->fetch_array()) {
                                        $uOzellikID = $ozellik['ozellikID'];
                                        $ozellikYaz = $mysqli->query("SELECT * FROM urunozellik WHERE id = $uOzellikID")->fetch_array();
                                    ?>
                                        <div class="Collapsible Collapsible--large">
                                            <button class="Collapsible__Button Heading u-h6" data-action="toggle-collapsible" aria-expanded="false">
                                                <?php echo $ozellikYaz['baslik']; ?>
                                                <span class="Collapsible__Plus"></span>
                                            </button>

                                            <div class="Collapsible__Inner">
                                                <div class="Collapsible__Content">
                                                    <div class="Rte">
                                                        <?php echo $ozellik['icerik']; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </section>
                    <style>
                        /* This is a bit hacky but allows to circumvent the complete independency of section (as next section included in the page does not know anything about this page) */

                        @media screen and (max-width: 640px) {
                            #shopify-section-product-template+.shopify-section--bordered {
                                border-top: 0;
                            }

                            #shopify-section-product-template+.shopify-section--bordered>.Section {
                                padding-top: 0;
                            }
                        }
                    </style>
                    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
                        <!-- Burayı sakın silmeyin / light box  -->
                        <div class="pswp__bg"></div>

                        <!-- Burayı sakın silmeyin / light box  -->
                        <div class="pswp__scroll-wrap">

                            <!-- Burayı sakın silmeyin / light box  -->
                            <div class="pswp__container">
                                <div class="pswp__item"></div>
                                <div class="pswp__item"></div>
                                <div class="pswp__item"></div>
                            </div>

                            <!-- Burayı sakın silmeyin / light box -->
                            <div class="pswp__ui pswp__ui--hidden">
                                <button class="pswp__button pswp__button--prev RoundButton" data-animate-left title="Previous (left arrow)"><svg class="Icon Icon--arrow-left" role="presentation" viewBox="0 0 11 21">
                                        <polyline fill="none" stroke="currentColor" points="10.5 0.5 0.5 10.5 10.5 20.5" stroke-width="1.25">
                                        </polyline>
                                    </svg></button>
                                <button class="pswp__button pswp__button--close RoundButton RoundButton--large" data-animate-bottom title="Close (Esc)"><svg class="Icon Icon--close" role="presentation" viewBox="0 0 16 14">
                                        <path d="M15 0L1 14m14 0L1 0" stroke="currentColor" fill="none" fill-rule="evenodd"></path>
                                    </svg></button>
                                <button class="pswp__button pswp__button--next RoundButton" data-animate-right title="Next (right arrow)"><svg class="Icon Icon--arrow-right" role="presentation" viewBox="0 0 11 21">
                                        <polyline fill="none" stroke="currentColor" points="0.5 0.5 10.5 10.5 0.5 20.5" stroke-width="1.25">
                                        </polyline>
                                    </svg></button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<div id="shopify-section-16409200524401c59e" class="shopify-section shopify-section--bordered">
    <section class="Section Section--spacingNormal" data-section-id="16409200524401c59e" data-section-type="featured-collections" data-settings='{
  "layout": "carousel"
}'>
        <div class="Container" style="text-align:center;">
            <h3 class="SectionHeader__Heading Heading u-h3"><?php echo dilbak($dilID, 31); ?></h3>
        </div>

        <div class="TabPanel" id="block-16409200524401c59e-0" aria-hidden="false" role="tabpanel">
            <div class="ProductListWrapper">
                <div class="ProductList ProductList--carousel Carousel" data-flickity-config='{
    "prevNextButtons": true,
    "pageDots": false,
    "wrapAround": false,
    "contain": true,
    "cellAlign": "center",
    "watchCSS": true,
    "dragThreshold": 8,
    "groupCells": true,
    "arrowShape": {"x0": 20, "x1": 60, "y1": 40, "x2": 60, "y2": 35, "x3": 25}
  }'>
                    <?php
                    $urunSor = $mysqli->query("SELECT * FROM urun WHERE durum = 1 AND dil = $dilID AND katID = $gelenKatID AND seo != $seoID ORDER BY RAND() ASC LIMIT 10");
                    while ($urun = $urunSor->fetch_array()) {
                        if ($_SESSION['id']) {
                    ?>
                            <div class="Carousel__Cell">
                                <div class="ProductItem">
                                    <div class="ProductItem__Wrapper">
                                        <a href="<?php echo seocuk($urun['seo']); ?>" class="ProductItem__ImageWrapper ProductItem__ImageWrapper--withAlternateImage">
                                            <div class="AspectRatio AspectRatio--tall" style="max-width: 1000px;  --aspect-ratio: 1.017">

                                                <img class="ProductItem__Image ProductItem__Image--alternate Image--lazyLoad Image--fadeIn" data-src="uploads/<?php echo $urun['kresim']; ?>" data-widths="[200,300,400,600,800,900,1000]" data-sizes="auto" alt="<?php echo $urun['keywords']; ?>" data-media-id="23873243512992">

                                                <img class="ProductItem__Image Image--lazyLoad Image--fadeIn" data-src="uploads/<?php echo $urun['kresim']; ?>" data-widths="[200,400,600,700,800,900,1000,1200]" data-sizes="auto" alt="<?php echo $urun['keywords']; ?>" data-media-id="24010281877664">
                                                <span class="Image__Loader"></span>

                                                <noscript>
                                                    <img class="ProductItem__Image ProductItem__Image--alternate" src="uploads/<?php echo $urun['kresim']; ?>" alt="<?php echo $urun['keywords']; ?>">
                                                    <img class="ProductItem__Image" src="uploads/<?php echo $urun['kresim']; ?>" alt="<?php echo $urun['keywords']; ?>">
                                                </noscript>
                                            </div>
                                        </a>
                                        <div class="ProductItem__Info ProductItem__Info--center">
                                            <h2 class="ProductItem__Title Heading">

                                                <a href="<?php echo seocuk($urun['seo']); ?>"><?php echo $urun['baslik']; ?></a>
                                            </h2>
                                            <!-- <div class="ProductItem__PriceList ProductItem__PriceList--showOnHover Heading">
                                        <span
                                            class="ProductItem__Price Price Text--subdued"><?php echo $urun['fiyat']; ?>
                                            <?php echo $parabirimi; ?></span>
                                    </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } else {
                            if (!$urun['bayiozel'] == 1) {
                            ?>
                                <div class="Carousel__Cell">
                                    <div class="ProductItem">
                                        <div class="ProductItem__Wrapper">
                                            <a href="<?php echo seocuk($urun['seo']); ?>" class="ProductItem__ImageWrapper ProductItem__ImageWrapper--withAlternateImage">
                                                <div class="AspectRatio AspectRatio--tall" style="max-width: 1000px;  --aspect-ratio: 1.017">

                                                    <img class="ProductItem__Image ProductItem__Image--alternate Image--lazyLoad Image--fadeIn" data-src="uploads/<?php echo $urun['kresim']; ?>" data-widths="[200,300,400,600,800,900,1000]" data-sizes="auto" alt="<?php echo $urun['keywords']; ?>" data-media-id="23873243512992">

                                                    <img class="ProductItem__Image Image--lazyLoad Image--fadeIn" data-src="uploads/<?php echo $urun['kresim']; ?>" data-widths="[200,400,600,700,800,900,1000,1200]" data-sizes="auto" alt="<?php echo $urun['keywords']; ?>" data-media-id="24010281877664">
                                                    <span class="Image__Loader"></span>

                                                    <noscript>
                                                        <img class="ProductItem__Image ProductItem__Image--alternate" src="uploads/<?php echo $urun['kresim']; ?>" alt="<?php echo $urun['keywords']; ?>">
                                                        <img class="ProductItem__Image" src="uploads/<?php echo $urun['kresim']; ?>" alt="<?php echo $urun['keywords']; ?>">
                                                    </noscript>
                                                </div>
                                            </a>
                                            <div class="ProductItem__Info ProductItem__Info--center">
                                                <h2 class="ProductItem__Title Heading">

                                                    <a href="<?php echo seocuk($urun['seo']); ?>"><?php echo $urun['baslik']; ?></a>
                                                </h2>
                                                <!-- <div class="ProductItem__PriceList ProductItem__PriceList--showOnHover Heading">
                                        <span
                                            class="ProductItem__Price Price Text--subdued"><?php echo $urun['fiyat']; ?>
                                            <?php echo $parabirimi; ?></span>
                                    </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    <?php
                            }
                        }
                    } ?>

                </div>
            </div>

        </div>
    </section>

</div>


<?php
$hitartir = $gelen['hit'] + 1;
$mysqli->query("UPDATE urun set hit='$hitartir' where seo='$seoID'");
?>

<script>
    function shopCart() {
        $.ajax({
            method: "POST",
            url: "shopCart.php",
        }).done(function(data) {
            $(".shopcart2").html(data);
        });
    }



    $(document).ready(function() {

        $(".SepetEkle").on("submit", function(e) {

            e.preventDefault();
            var form = $(this);
            var formum = form.serializeArray();

            $.ajax({
                method: "POST",
                url: "sepetEkle.php",
                data: formum

            }).done(function(data) {

                form[0].reset();
                shopCart();

            });
            swal("<?php echo dilbak($dilID,183); ?>", "", "success");

         /*    setTimeout(function() {
                window.location.assign("/sepet");
            }, 1000); */


        });

    });
</script>