<?php

$urunkat = $mysqli->query("SELECT * FROM urunkat where durum = 1 AND dil = $dilID AND seo = $seoID")->fetch_array();

$katID = $urunkat['id'];


$currentPara = $genelbak['parabirimi'];
$parabirimi = $mysqli->query("SELECT * FROM parabirimi WHERE id = $currentPara ")->fetch_assoc();


// $limit= 20;
@$url1 = $_SERVER['REQUEST_URI'];
$parca = explode("pge=", $url1);
$pge = @$parca[1];

if (($pge == "") or !is_numeric($pge)) {
    if ($_GET['filter']) {
        $pge = 0;
    } else {
        $pge = 1;
    }
}
$limit= 20;


$satirsayisi         = $mysqli->query("SELECT * from urun where durum = 1 and dil = $dilID and katID = $katID ORDER BY sira ASC")->num_rows;
$toplamsayfa         = ceil($satirsayisi / $limit);
if ($_GET['filter']) {
    $baslangic          = ($pge) * $limit;
} else {
    // if($pge)
    // {
        $baslangic= ($pge - 1) * $limit;
    // }
  
   
}
$mevcuturl = seocuk($urunkat['seo']);

//$urunkat = $mysqli->query("SELECT * FROM urun where katID = $katID AND dil = $dilID AND durum = 1 order by sira asc LIMIT $baslangic, $limit");
//$urunsay = $urunkat->num_rows;

if ($_GET['filter']) {
    @$renkbulid = $_GET['filter'];
    @$renkbule = $mysqli->query("SELECT * FROM urunrenk WHERE id=$renkbulid  ")->fetch_assoc();
}

?>


<div id="shopify-section-collection-template" class="shopify-section shopify-section--bordered">
    <section data-section-id="collection-template" data-section-type="collection" data-section-settings="{
    &quot;collectionUrl&quot;: &quot;\/collections\/earrings&quot;,
    &quot;currentTags&quot;: [],
    &quot;sortBy&quot;: &quot;manual&quot;,
    &quot;filterPosition&quot;: &quot;sidebar&quot;
  }">

        <header class="pt_urun_kat">
            <div class="Container">
                <div class="SectionHeader SectionHeader--center">
                    <h1 class="SectionHeader__Heading Heading u-h1"><?php echo $urunkat['baslik']; ?><?php if ($_GET['filter']) {
                                                                                                            echo ' - ' . $renkbule['baslik'];
                                                                                                        }  ?></h1>
                </div>
            </div>
        </header>

        <div id="collection-filter-drawer" class="CollectionFilters Drawer Drawer--secondary Drawer--fromRight" aria-hidden="true" style="max-height: 740px;">
            <header class="Drawer__Header Drawer__Header--bordered Drawer__Header--center Drawer__Container">
                <span class="Drawer__Title Heading u-h4">Filtrele</span>

                <button class="Drawer__Close Icon-Wrapper--clickable" data-action="close-drawer" data-drawer-id="collection-filter-drawer" aria-label="Close navigation"><svg class="Icon Icon--close" role="presentation" viewBox="0 0 16 14">
                        <path d="M15 0L1 14m14 0L1 0" stroke="currentColor" fill="none" fill-rule="evenodd"></path>
                    </svg></button>
            </header>

            <div class="Drawer__Content">
                <div class="Drawer__Main" data-scrollable="">

                    <div class="Collapsible Collapsible--padded Collapsible--autoExpand">
                        <button type="button" class="Collapsible__Button Heading u-h6" data-action="toggle-collapsible" aria-expanded="false">
                            <?php echo dilbak($dilID, 52); ?><span class="Collapsible__Plus">

                            </span>
                        </button>

                        <div class="Collapsible__Inner">
                            <div class="Collapsible__Content">
                                <ul class="Linklist">
                                    <?php
                                    $kategori1 = $mysqli->query("SELECT * FROM urunkat where durum = 1 AND dil = $dilID order by sira asc ");
                                    while ($kategori = $kategori1->fetch_array()) {
                                    ?>
                                        <li class="Linklist__Item ">
                                            <a href="<?php echo seocuk($kategori['seo']) ?>" class="Text--subdued Link Link--primary " data-action="toggle-tag"><?php echo $kategori['baslik']; ?></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="Collapsible Collapsible--padded Collapsible--autoExpand">
                        <button type="button" class="Collapsible__Button Heading u-h6" data-action="toggle-collapsible" aria-expanded="false"><?php echo dilbak($dilID, 87); ?><span class="Collapsible__Plus"></span>
                        </button>

                        <div class="Collapsible__Inner">
                            <div class="Collapsible__Content">
                                <ul class="Linklist">
                                    <?php
                                    $urunrenk = $mysqli->query("SELECT * FROM urunrenk where dil = $dilID ORDER BY sira ASC");
                                    while ($renk = $urunrenk->fetch_array()) {
                                    ?>
                                        <li class="Linklist__Item ">
                                            <a class="Text--subdued Link Link--primary " href="<?php echo $mevcuturl; ?>?filter=<?php echo $renk['id']; ?>">
                                                <?php echo $renk['baslik']; ?>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="Drawer__Footer Drawer__Footer--padded" data-drawer-animated-bottom="">
                    <div class="ButtonGroup">
                        <!-- <button type="button" class="ButtonGroup__Item Button Button--secondary" data-action="reset-tags" style="display: none">Reset</button>
                        <button type="button" class="ButtonGroup__Item ButtonGroup__Item--expand Button Button--primary" data-action="apply-tags">Apply</button> -->
                    </div>
                </div>
            </div>
        </div>
     
        <div class="CollectionMain">
            <div class="CollectionInner">
                <div class="CollectionInner__Sidebar  hidden-pocket">
                    <div class="CollectionFilters">

                        <div class="Collapsible Collapsible--padded Collapsible--autoExpand">
                            <button type="button" class="Collapsible__Button Heading u-h6" data-action="toggle-collapsible" aria-expanded="false"><?php echo dilbak($dilID, 52); ?><span class="Collapsible__Plus"></span>
                            </button>

                            <div class="Collapsible__Inner">
                                <div class="Collapsible__Content">
                                    <ul class="Linklist">
                                        <?php
                                        $kategori1 = $mysqli->query("SELECT * FROM urunkat where durum = 1 AND dil = $dilID order by sira asc");
                                        while ($kategori = $kategori1->fetch_array()) {
                                        ?>
                                            <li class="Linklist__Item ">
                                                <a href="<?php echo seocuk($kategori['seo']) ?>" class="Text--subdued Link Link--primary " data-action="toggle-tag"><?php echo $kategori['baslik']; ?></a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="Collapsible Collapsible--padded Collapsible--autoExpand">
                            <button type="button" class="Collapsible__Button Heading u-h6" data-action="toggle-collapsible" aria-expanded="false"><?php echo dilbak($dilID, 87) ?><span class="Collapsible__Plus"></span>
                            </button>

                            <div class="Collapsible__Inner">
                                <div class="Collapsible__Content">
                                    <ul class="Linklist">
                                        <?php
                                        $renk = $mysqli->query("SELECT * FROM urunrenk WHERE dil=$dilID ORDER BY sira ASC");
                                        while ($renks = $renk->fetch_array()) {
                                        ?>
                                            <li class="Linklist__Item ">
                                                <a href="<?php echo $mevcuturl; ?>?filter=<?php echo $renks['id']; ?>" class="Text--subdued Link Link--primary " data-action="toggle-tag">
                                                    <?php echo $renks['baslik']; ?></a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
                <div class="CollectionInner__Products">
                    <div class="ProductListWrapper">
                        <div class="ProductList ProductList--grid ProductList--removeMargin Grid" data-mobile-count="2" data-desktop-count="4">

                            <?php

                            if ($_GET['filter']) {
                                $renkbul = $_GET['filter'];
                                $renkurun = $mysqli->query("SELECT * FROM urunrenksec WHERE renkID=$renkbul ORDER BY id ASC");
                                while ($renklerbul = $renkurun->fetch_array()) {
                                    $urunler = $mysqli->query("SELECT * FROM urun where katID = $katID AND dil = $dilID AND durum = 1 AND id={$renklerbul['urunID']} order by sira asc LIMIT $baslangic, $limit");

                                    while ($urun = $urunler->fetch_array()) {
                            ?>
                                        <div class="Grid__Cell 2/2--phone 1/3--tablet-and-up 1/4--desk">
                                            <div class="ProductItem " style="visibility: inherit; opacity: 1; transform: matrix(1, 0, 0, 1, 0, 0);">
                                                <div class="ProductItem__Wrapper">
                                                    <a href="<?php echo seocuk($urun['seo']); ?>" class="ProductItem__ImageWrapper ProductItem__ImageWrapper--withAlternateImage">
                                                        <div class="AspectRatio AspectRatio--tall">
                                                            <img class="ProductItem__Image ProductItem__Image--alternate Image--fadeIn lazyautosizes Image--lazyLoaded" data-widths="[200,300,400,600]" data-sizes="auto" alt="<?php echo $urun['baslik'] ?>" data-media-id="25298369839274" data-srcset="uploads/<?php echo $urun['ustresim']; ?>" sizes="488px" srcset="uploads/<?php echo $urun['ustresim']; ?>">

                                                            <img class="ProductItem__Image Image--fadeIn lazyautosizes Image--lazyLoaded" data-widths="[200,400,600,700,800,900,1000]" data-sizes="auto" alt="<?php echo $urun['baslik']; ?>" data-media-id="24890421870762" data-srcset="uploads/<?php echo $urun['kresim']; ?>" sizes="488px" srcset="uploads/<?php echo $urun['kresim']; ?>">
                                                            <span class="Image__Loader"></span>


                                                        </div>
                                                    </a>
                                                    <div class="ProductItem__Info ProductItem__Info--center">
                                                        <p class="ProductItem__Vendor Heading"><a href="<?php echo seocuk($urun['seo']); ?>" title="valentine"><?php echo $urun['baslik']; ?></a></p>
                                                        <h2 class="ProductItem__Title Heading">

                                                            <a href="<?php echo seocuk($urun['seo']); ?>"></a>
                                                        </h2>
                                                        <div class="ProductItem__PriceList ProductItem__PriceList--showOnHover Heading">
                                                            <?php
                                                            //fiyat durumu 0 bayi ise herkes ise 1
                                                            if ($urun['fiyat'] != 0) {

                                                                if (@$_SESSION['id']) {

                                                                    $bayi = $mysqli->query("SELECT * FROM uyeler WHERE id='{$_SESSION['id']}' ")->fetch_assoc();
                                                                    if (!empty($bayi['yuzde'])) {
                                                                        $yuzde = yuzdeHesaplama($urun['fiyat'], $bayi['yuzde']);
                                                                        $toplam = $urun['fiyat'] - $yuzde;
                                                                        $toplamgosterme = $toplam;
                                                                    } else {
                                                                        $toplam = $urun['fiyat'];
                                                                        $toplamgosterme = $toplam;
                                                                    }
                                                            ?>
                                                                    <span class="ProductItem__Price Price Text--subdued">
                                                                        <?php echo number_format($toplamgosterme, 2, ',', '.') . $parabirimi['simge']; ?></span>
                                                                    <?php
                                                                } else {
                                                                    if ($urun['fiyatdurumu'] == 1) {

                                                                    ?>
                                                                        <span class="ProductItem__Price Price Text--subdued">
                                                                            <?php echo number_format($urun['fiyat'], 2, ',', '.') . $parabirimi['simge']; ?></span>
                                                            <?php
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php   }
                                }
                            } else {
                                ?>

                                <?php
                                $urunler = $mysqli->query("SELECT * FROM urun where katID = $katID AND dil = $dilID AND durum = 1 ORDER BY sira ASC LIMIT $baslangic, $limit");
                                while ($urun = $urunler->fetch_array()) {
                                    if ($_SESSION['id']) {
                                ?>
                                        <div class="Grid__Cell 2/2--phone 1/3--tablet-and-up 1/4--desk">
                                            <div class="ProductItem " style="visibility: inherit; opacity: 1; transform: matrix(1, 0, 0, 1, 0, 0);">
                                                <div class="ProductItem__Wrapper">
                                                    <a href="<?php echo seocuk($urun['seo']); ?>" class="ProductItem__ImageWrapper ProductItem__ImageWrapper--withAlternateImage">
                                                        <div class="AspectRatio AspectRatio--tall">
                                                            <img class="ProductItem__Image ProductItem__Image--alternate Image--fadeIn lazyautosizes Image--lazyLoaded" data-widths="[200,300,400,600]" data-sizes="auto" alt="<?php echo $urun['baslik'] ?>" data-media-id="25298369839274" data-srcset="uploads/<?php echo $urun['ustresim']; ?>" sizes="488px" srcset="uploads/<?php echo $urun['ustresim']; ?>">

                                                            <img class="ProductItem__Image Image--fadeIn lazyautosizes Image--lazyLoaded" data-widths="[200,400,600,700,800,900,1000]" data-sizes="auto" alt="<?php echo $urun['baslik']; ?>" data-media-id="24890421870762" data-srcset="uploads/<?php echo $urun['kresim']; ?>" sizes="488px" srcset="uploads/<?php echo $urun['kresim']; ?>">
                                                            <span class="Image__Loader"></span>

                                                            <noscript>
                                                                <img class="ProductItem__Image ProductItem__Image--alternate" src="//cdn.shopify.com/s/files/1/0592/0148/7018/products/PE13731XNAC-pink-nacre-heart-_-dot-drop-earrings-apm-monaco_9cb9ea35-f5d6-4ccb-bbe0-a59a834cfb1b_600x.jpg?v=1645504548" alt="APM Monaco Pink Nacre Heart &amp; Dot Drop Earrings in rose gold">
                                                                <img class="ProductItem__Image" src="//cdn.shopify.com/s/files/1/0592/0148/7018/products/PE13731XNAC-pink-nacre-heart-_-dot-drop-earrings-apm-monaco-jewelry_600x.jpg?v=1642759494" alt="Pink Nacre Heart &amp; Dot Drop Earrings">
                                                            </noscript>
                                                        </div>
                                                    </a>
                                                    <div class="ProductItem__Info ProductItem__Info--center">
                                                        <p class="ProductItem__Vendor Heading"><a href="<?php echo seocuk($urun['seo']); ?>" title="valentine"><?php echo $urun['baslik']; ?></a></p>
                                                        <h2 class="ProductItem__Title Heading">

                                                            <a href="<?php echo seocuk($urun['seo']); ?>"></a>
                                                        </h2>
                                                        <div class="ProductItem__PriceList ProductItem__PriceList--showOnHover Heading">
                                                            <?php
                                                            //fiyat durumu 0 bayi ise herkes ise 1
                                                            if ($urun['fiyat'] != 0) {
                                                                if (@$_SESSION['id']) {

                                                                    $bayi = $mysqli->query("SELECT * FROM uyeler WHERE id='{$_SESSION['id']}' ")->fetch_assoc();
                                                                    if (!empty($bayi['yuzde'])) {
                                                                        $yuzde = yuzdeHesaplama($urun['fiyat'], $bayi['yuzde']);
                                                                        $toplam = $urun['fiyat'] - $yuzde;
                                                                        $toplamgosterme = $toplam;
                                                                    } else {
                                                                        $toplam = $urun['fiyat'];
                                                                        $toplamgosterme = $toplam;
                                                                    }
                                                            ?>
                                                                    <span class="ProductItem__Price Price Text--subdued">
                                                                        <?php echo number_format($toplamgosterme, 2, ',', '.') . $parabirimi['simge']; ?></span>
                                                                    <?php
                                                                } else {
                                                                    if ($urun['fiyatdurumu'] == 1) {
                                                                    ?>
                                                                        <span class="ProductItem__Price Price Text--subdued">
                                                                            <?php echo number_format($urun['fiyat'], 2, ',', '.') . $parabirimi['simge']; ?></span>
                                                            <?php
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } else {
        
                                        if (!$urun['bayiozel'] == 1) {
                                        ?>
                                            <div class="Grid__Cell 2/2--phone 1/3--tablet-and-up 1/4--desk">
                                                <div class="ProductItem " style="visibility: inherit; opacity: 1; transform: matrix(1, 0, 0, 1, 0, 0);">
                                                    <div class="ProductItem__Wrapper">
                                                        <a href="<?php echo seocuk($urun['seo']); ?>" class="ProductItem__ImageWrapper ProductItem__ImageWrapper--withAlternateImage">
                                                            <div class="AspectRatio AspectRatio--tall">
                                                                <img class="ProductItem__Image ProductItem__Image--alternate Image--fadeIn lazyautosizes Image--lazyLoaded" data-widths="[200,300,400,600]" data-sizes="auto" alt="<?php echo $urun['baslik'] ?>" data-media-id="25298369839274" data-srcset="uploads/<?php echo $urun['ustresim']; ?>" sizes="488px" srcset="uploads/<?php echo $urun['ustresim']; ?>">

                                                                <img class="ProductItem__Image Image--fadeIn lazyautosizes Image--lazyLoaded" data-widths="[200,400,600,700,800,900,1000]" data-sizes="auto" alt="<?php echo $urun['baslik']; ?>" data-media-id="24890421870762" data-srcset="uploads/<?php echo $urun['kresim']; ?>" sizes="488px" srcset="uploads/<?php echo $urun['kresim']; ?>">
                                                                <span class="Image__Loader"></span>


                                                            </div>
                                                        </a>

                                                        <div class="ProductItem__Info ProductItem__Info--center">
                                                            <p class="ProductItem__Vendor Heading"><a href="<?php echo seocuk($urun['seo']); ?>" title="valentine"><?php echo $urun['baslik']; ?></a></p>
                                                            <h2 class="ProductItem__Title Heading">

                                                                <a href="<?php echo seocuk($urun['seo']); ?>"></a>
                                                            </h2>
                                                            <div class="ProductItem__PriceList ProductItem__PriceList--showOnHover Heading">
                                                                <?php
                                                                //fiyat durumu 0 bayi ise herkes ise 1
                                                                if ($urun['fiyat'] != 0) {

                                                                    if (@$_SESSION['id']) {

                                                                        $bayi = $mysqli->query("SELECT * FROM uyeler WHERE id='{$_SESSION['id']}' ")->fetch_assoc();
                                                                        if (!empty($bayi['yuzde'])) {
                                                                            $yuzde = yuzdeHesaplama($urun['fiyat'], $bayi['yuzde']);
                                                                            $toplam = $urun['fiyat'] - $yuzde;
                                                                            $toplamgosterme = $toplam;
                                                                        } else {
                                                                            $toplam = $urun['fiyat'];
                                                                            $toplamgosterme = $toplam;
                                                                        }
                                                                ?>
                                                                        <span class="ProductItem__Price Price Text--subdued">
                                                                            <?php echo number_format($toplamgosterme, 2, ',', '.') . $parabirimi['simge']; ?></span>
                                                                        <?php
                                                                    } else {
                                                                        if ($urun['fiyatdurumu'] == 1) {

                                                                        ?>
                                                                            <span class="ProductItem__Price Price Text--subdued">
                                                                                <?php echo number_format($urun['fiyat'], 2, ',', '.') . $parabirimi['simge']; ?></span>
                                                                <?php
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </div>


                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                            <?php }
                                    }
                                }
                            } ?>

                        </div>
                    </div>


                    <div class="Pagination Text--subdued">
                        <?php
                        if (!$_GET['filter']) {
                        ?>
                            <div class="Pagination__Nav">
                                <?php

                                if ($toplamsayfa > 1) {
                                    $forlimit = 1;
                                    for ($y = $pge - $forlimit; $y <= $pge + $forlimit + 1; $y++) {
                                        if ($y > 0 && $y <= $toplamsayfa) {
                                            if ($y == $pge) {
                                ?>

                                                <span class="Pagination__NavItem is-active"><?php echo $y; ?></span>
                                            <?php } else { ?>
                                                <a href="<?php echo $mevcuturl; ?>?pge=<?php echo $y ?>" class="Pagination__NavItem Link Link--primary"><?php echo $y; ?></a>
                                        <?php }
                                        }
                                    }
                                    if ($pge != $toplamsayfa) { ?>



                                        <a class="Pagination__NavItem Link Link--primary" rel="next" title="Next page" href="<?php echo $mevcuturl; ?><?php echo '?pge=' . ($pge + 1); ?>">
                                            <svg class="Icon Icon--select-arrow-right" role="presentation" viewBox="0 0 11 18">
                                                <path d="M1.5 1.5l8 7.5-8 7.5" stroke-width="2" stroke="currentColor" fill="none" fill-rule="evenodd" stroke-linecap="square"></path>
                                            </svg>
                                        </a>
                                <?php   }
                                }
                                ?>
                            </div> <?php } ?>
                    </div>


                </div>
            </div>

    </section>
</div>

<!-- <div id="shopify-section-collection-footer" class="shopify-section">
    <div id="section-collection-footer">
        <div class="FlexboxIeFix">
            <div class="ImageHero ImageHero--small Image--lazyLoad" style="background: url(//cdn.shopi)">
                <div class="ImageHero__ImageWrapper Image--lazyLoad Image--zoomOut Image--contrast" data-optimumx="1.4"
                    <?php $tasarim = $mysqli->query("SELECT * FROM tasarim WHERE id = 19 AND durum = 1 ORDER BY id ASC")->fetch_array(); ?>
                    data-bgset="uploads/<?php echo $tasarim['resim']; ?>"></div>


            </div>
        </div>
    </div>

    <style>
    #section-collection-footer,
    #section-collection-footer .Heading {
        color: #ffffff;
        text-shadow: 0.2px 1px 3px black;
        font-weight: 500
    }
    </style>
</div> -->