<?php

define('YUOG', TRUE);
require_once("inc/config.php");
// require_once("inc/functions.php");  

// $session_id = session_id();
@session_start();
$url1     =  $_SERVER['REQUEST_URI'];
$url    = substr($url1, 1);

// $page 	= $mysqli->real_escape_string($_GET['page']);
@$sayfa     = $mysqli->real_escape_string($_GET['sayfa']);
$seocukk     = $mysqli->query("select * from seo where seo='$sayfa' ")->fetch_array();

$konu         = @$seocukk['konu'];
$seoID         = @$seocukk['id'];
$seodurum     = @$seocukk['durum'];

$sorrr = $mysqli->query("select * from seo where id='$seoID' ")->fetch_array();
if (@$sorrr['seo'] != "") {




    if ($seoID != "") {
        if ($konu == "sistem") {
            $icerikbull        = $mysqli->query("select * from $konu where seoID='$seoID' ")->fetch_array();
            $title             = strip_tags($icerikbull['menu']);
            $keywords         = strip_tags($icerikbull['menu']);
            $description     = strip_tags($icerikbull['menu']);
        } else {
            $icerikbull        = $mysqli->query("select * from $konu where seo='$seoID' ")->fetch_array();
            $title             = strip_tags($icerikbull['baslik']);
            $keywords         = strip_tags($icerikbull['keywords']);
            $description     = strip_tags($icerikbull['description']);
        }


        $canonical         = $genelbak['web'] . '/' . $url;
    }
} else {




    $title            = $genelbak['title'];
    $keywords         = $genelbak['keywords'];
    $description     = $genelbak['description'];
}
function kdvDahil($tutar, $oran)
{
    $kdv = $tutar * $oran / 100;
    $toplam = $tutar + $kdv;
    return $toplam;
}

function yuzdeHesaplama($sayi, $yuzde)
{
    return ($sayi * $yuzde) / 100;
}



function bosluksil($gelenurl)
{
    $url1     = str_replace(" ", "", $gelenurl);
    return $url1;
}

// $adres 		= @$_SERVER['HTTP_REFERER'];  
// $email 		= @$_SESSION['musteri']['mail']; 
// $musteriID 	= @$_SESSION['musteri']['musteriID']; 

// if($musteriID!=""){
// $musteribak = $mysqli->query("select * from musteriler where id='$musteriID' ")->fetch_array();
// }


$email = @$_SESSION['admin']['mail'];


if (($genelbak['bakim'] == "on") && ($email == "")) {

    echo $genelbak['bakimaciklama'];
    die();
}

// if(($seodurum==" ") && ()){
// header("Location:index.php");
// }


if (@$ydilID != "") {
    $dil = $ydilID;
    $dilID    = $dil;
} else {
    $dil =  @$_SESSION['dil'];

    if ($dil == "") {
        $dillbakk = $mysqli->query("select * from diller where durum='1' order by sira asc limit 1")->fetch_array();
        $dilkodu = $dillbakk['kodu'];
    } else {
        $dilkodu1 = $mysqli->query("select * from diller where kodu='$dil'")->fetch_array();
        $dilkodu = $dilkodu1['kodu'];
    }
    $dilID2 = $mysqli->query("select * from diller where kodu='$dilkodu' ")->fetch_array();
    $dilID = $dilID2['id'];
}


$dil =  @$_SESSION['dil'];

if ($dil == "") {
    $dilimiz = $mysqli->query("select * from diller where durum='1' order by sira asc limit 1");
    $dillbakk = $dilimiz->fetch_array();
    $dilkodu = $dillbakk['kodu'];
} else {
    $dilimiz = $mysqli->query("select * from diller where kodu='$dil'");
    $dilkodu1 = $dilimiz->fetch_array();
    $dilkodu = $dilkodu1['kodu'];
}

$dilIDbul = $mysqli->query("select * from diller where kodu='$dilkodu' ");
$dilID2 = $dilIDbul->fetch_array();
$dilID = $dilID2['id'];

function dilbak($dilID, $sabitID)
{
    global $mysqli;
    $dbak         = $mysqli->query("select * from dilicerik where dilID='$dilID' && sabitID='$sabitID' ");
    $dilsabit1    = $dbak->fetch_array();
    $dilsabit    = $dilsabit1['icerik'];
    return $dilsabit;
}



$twitter = $genelbak['twitter'];
$google = $genelbak['google'];
$instagram = $genelbak['instagram'];
$facebook = $genelbak['facebook'];
$youtube = $genelbak['youtube'];
$pinterest = $genelbak['pinterest'];
$linkedin = $genelbak['linkedin'];


$pBirim = $genelbak['parabirimi'];
$parabirimi = $mysqli->query("SELECT * FROM parabirimi where id = $pBirim")->fetch_array();
$para = $parabirimi['simge'];
?>
<!doctype html>
<html class="no-js" lang="<?php echo ($dilID == 1) ? 'tr' : 'en'; ?>">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, height=device-height, minimum-scale=1.0, maximum-scale=1.0">

    <title> <?php echo $title; ?> </title>
    <meta name="description" content="<?php echo $description; ?>">
    <link rel="canonical" href="<?php echo $genelbak['web']; ?>">
    <link rel="shortcut icon" href="uploads/<?php echo $genelbak['icon']; ?>" type="image/png">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo $genelbak['firma']; ?>">
    <meta property="og:description" content="<?php echo $description; ?>">
    <meta property="og:url" content="<?php echo $genelbak['web']; ?>">
    <meta property="og:site_name" content="<?php echo $genelbak['firma']; ?>">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="<?php echo $genelbak['firma']; ?>">
    <meta name="twitter:description" content="<?php echo $description; ?>">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap');

        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');



        :root {
            --heading-font-family: "Montserrat", sans-serif;
            --heading-font-weight: 500;
            --heading-font-style: normal;

            --text-font-family: "Nunito Sans", sans-serif;
            --text-font-weight: 400;
            --text-font-style: normal;

            --base-text-font-size: 14px;
            --default-text-font-size: 14px;
            --background: #ffffff;
            --background-rgb: 255, 255, 255;
            --light-background: #f7f7f7;
            --light-background-rgb: 247, 247, 247;
            --heading-color: #1c1b1b;
            --text-color: #1c1b1b;
            --text-color-rgb: 28, 27, 27;
            --text-color-light: #6a6a6a;
            --text-color-light-rgb: 106, 106, 106;
            --link-color: #6a6a6a;
            --link-color-rgb: 106, 106, 106;
            --border-color: #dddddd;
            --border-color-rgb: 221, 221, 221;

            --button-background: #1c1b1b;
            --button-background-rgb: 28, 27, 27;
            --button-text-color: #ffffff;

            --header-background: #ffffff;
            --header-heading-color: #1c1b1b;
            --header-light-text-color: #6a6a6a;
            --header-border-color: #dddddd;

            --footer-background: #ffffff;
            --footer-text-color: #6a6a6a;
            --footer-heading-color: #1c1b1b;
            --footer-border-color: #e9e9e9;

            --navigation-background: #ffffff;
            --navigation-background-rgb: 255, 255, 255;
            --navigation-text-color: #000000;
            --navigation-text-color-light: rgba(0, 0, 0, 0.5);
            --navigation-border-color: rgba(0, 0, 0, 0.25);

            --newsletter-popup-background: #1c1b1b;
            --newsletter-popup-text-color: #ffffff;
            --newsletter-popup-text-color-rgb: 255, 255, 255;

            --secondary-elements-background: #1c1b1b;
            --secondary-elements-background-rgb: 28, 27, 27;
            --secondary-elements-text-color: #ffffff;
            --secondary-elements-text-color-light: rgba(255, 255, 255, 0.5);
            --secondary-elements-border-color: rgba(255, 255, 255, 0.25);

            --product-sale-price-color: #f94c43;
            --product-sale-price-color-rgb: 249, 76, 67;

            /* Shopify related variables */
            --payment-terms-background-color: #ffffff;

            /* Products */

            --horizontal-spacing-four-products-per-row: 40px;
            --horizontal-spacing-two-products-per-row: 40px;

            --vertical-spacing-four-products-per-row: 40px;
            --vertical-spacing-two-products-per-row: 50px;

            /* Animation */
            --drawer-transition-timing: cubic-bezier(0.645, 0.045, 0.355, 1);
            --header-base-height: 80px;
            /* We set a default for browsers that do not support CSS variables */

            /* Cursors
            --cursor-zoom-in-svg: url(//cdn.shopify.com/s/files/1/0565/3230/4032/t/12/assets/cursor-zoom-in.svg?v=13829828850725336060);
            --cursor-zoom-in-2x-svg: url(//cdn.shopify.com/s/files/1/0565/3230/4032/t/12/assets/cursor-zoom-in-2x.svg?v=2260326178358295142);
            */
        }
    </style>

    <!-- <script>
        // IE11 does not have support for CSS variables, so we have to polyfill them
        if (!(((window || {}).CSS || {}).supports && window.CSS.supports('(--a: 0)'))) {
            const script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = 'https://cdn.jsdelivr.net/npm/css-vars-ponyfill@2';
            script.onload = function() {
                cssVars({});
            };

            document.getElementsByTagName('head')[0].appendChild(script);
        }
    </script> -->

    <!-- <script>
        window.performance && window.performance.mark && window.performance.mark('shopify.content_for_header.start');
    </script> -->
    <!-- <meta name="google-site-verification" content="NocMiODrIQH7Dl-QcfQiMjJqC6Q_xLQYkGWR67wzg9k">
    <meta name="facebook-domain-verification" content="reyfc5bvgpm74461uvxe71by975ek8">
    <meta id="shopify-digital-wallet" name="shopify-digital-wallet" content="/56532304032/digital_wallets/dialog">
    <meta name="shopify-checkout-api-token" content="b6f073fa32b778189dd18cab1b817d79">
    <meta id="in-context-paypal-metadata" data-shop-id="56532304032" data-venmo-supported="false" data-environment="production" data-locale="en_US" data-paypal-v4="true" data-currency="USD"> -->


    <!-- <script src="https://www.google.com/recaptcha/api.js"></script> -->

    <!-- <script>
        (function() {
            function asyncLoad() {
                var urls = [

                ];
                for (var i = 0; i < urls.length; i++) {
                    var s = document.createElement('script');
                    s.type = 'text/javascript';
                    s.async = true;
                    s.src = urls[i];
                    var x = document.getElementsByTagName('script')[0];
                    x.parentNode.insertBefore(s, x);
                }
            };
            if (window.attachEvent) {
                window.attachEvent('onload', asyncLoad);
            } else {
                window.addEventListener('load', asyncLoad, false);
            }
        })();
    </script>
    <script id="__st">
        var __st = {
            "a": 56532304032,
            "offset": 28800,
            "reqid": "0ff75071-9797-49bb-a7a6-b89bbca2c67c",
            "pageurl": "us.apm.mc\/",
            "u": "d1a319f3b4ee",
            "p": "home"
        };
    </script> -->
    <!-- 
    <script>
        ! function(o) {
            o.addEventListener("DOMContentLoaded", function() {
                window.Shopify = window.Shopify || {}, window.Shopify.recaptchaV3 = window.Shopify.recaptchaV3 || {
                    siteKey: "6LcCR2cUAAAAANS1Gpq_mDIJ2pQuJphsSQaUEuc9"
                };
                var t = ['form[action*="/contact"] input[name="form_type"][value="contact"]',
                    'form[action*="/comments"] input[name="form_type"][value="new_comment"]',
                    'form[action*="/account"] input[name="form_type"][value="customer_login"]',
                    'form[action*="/account"] input[name="form_type"][value="recover_customer_password"]',
                    'form[action*="/account"] input[name="form_type"][value="create_customer"]',
                    'form[action*="/contact"] input[name="form_type"][value="customer"]'
                ].join(",");

                function n(e) {
                    e = e.target;
                    null == e || null != (e = function e(t, n) {
                        if (null == t.parentElement) return null;
                        if ("FORM" != t.parentElement.tagName) return e(t.parentElement, n);
                        for (var o = t.parentElement.action, r = 0; r < n.length; r++)
                            if (-1 !== o.indexOf(n[r])) return t.parentElement;
                        return null
                    }(e, ["/contact", "/comments", "/account"])) && null != e.querySelector(t) && ((e = o
                            .createElement("script")).setAttribute("src",
                            "https://cdn.shopify.com/shopifycloud/storefront-recaptcha-v3/v0.6/index.js"), o
                        .body.appendChild(e), o.removeEventListener("focus", n, !0), o.removeEventListener(
                            "change", n, !0), o.removeEventListener("click", n, !0))
                }
                o.addEventListener("click", n, !0), o.addEventListener("change", n, !0), o.addEventListener("focus",
                    n, !0)
            })
        }(document);
    </script> -->


    <!-- <link rel="stylesheet" media="screen" href="//cdn.shopify.com/s/files/1/0565/3230/4032/t/12/compiled_assets/styles.css?15725">
    <script id="sections-script" data-sections="desktop-mobile-image" defer="defer" src="//cdn.shopify.com/s/files/1/0565/3230/4032/t/12/compiled_assets/scripts.js?15725"></script>
 -->

    <style id="shopify-dynamic-checkout-cart">
        @media screen and (min-width: 750px) {
            #dynamic-checkout-cart {
                min-height: 50px;
            }
        }

        @media screen and (max-width: 750px) {
            #dynamic-checkout-cart {
                min-height: 60px;
            }
        }
    </style>
    <!-- <script>
        window.performance && window.performance.mark && window.performance.mark('shopify.content_for_header.end');
    </script> -->

    <link rel="stylesheet" href="css/theme.css">
    <!-- <link rel="stylesheet" href="css/www-player.css"> -->

    <link rel="stylesheet" href="css/customtheme.css">


    
    <link rel="stylesheet" href="css/pageflymain.css">
    <link rel="stylesheet" href="css/pagefly.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->

    <script>
        // This allows to expose several variables to the global scope, to be used in scripts
        window.theme = {
            pageType: "index",
            moneyFormat: "${{amount}}",
            moneyWithCurrencyFormat: "${{amount}} USD",
            productImageSize: "tall",
            searchMode: "product,article",
            showPageTransition: false,
            showElementStaggering: true,
            showImageZooming: true,
            template: 'index'
        };

        window.routes = {
            rootUrl: "\/",
            rootUrlWithoutSlash: '',
            cartUrl: "\/cart",
            cartAddUrl: "\/cart\/add",
            cartChangeUrl: "\/cart\/change",
            searchUrl: "\/search",
            productRecommendationsUrl: "\/recommendations\/products"
        };

        window.languages = {
            cartAddNote: "Is this a gift? Enter a special message by clicking here or enter GIFT RECEIPT to remove price from invoice.",
            cartEditNote: "Is this a gift? Enter a special message by clicking here or enter GIFT RECEIPT to remove price from invoice.",
            productImageLoadingError: "This image could not be loaded. Please try to reload the page.",
            enablePreOrderDelivery: false,
            productFormAddToCart: "Add to cart",
            productFormUnavailable: "Unavailable",
            productFormSoldOut: "Sold Out",
            shippingEstimatorOneResult: "1 option available:",
            shippingEstimatorMoreResults: "{{count}} options available:",
            shippingEstimatorNoResults: "No shipping could be found"
        };

        window.lazySizesConfig = {
            loadHidden: false,
            hFac: 0.5,
            expFactor: 2,
            ricTimeout: 150,
            lazyClass: 'Image--lazyLoad',
            loadingClass: 'Image--lazyLoading',
            loadedClass: 'Image--lazyLoaded'
        };

        document.documentElement.className = document.documentElement.className.replace('no-js', 'js');
        document.documentElement.style.setProperty('--window-height', window.innerHeight + 'px');

        // We do a quick detection of some features (we could use Modernizr but for so little...)
        (function() {
            document.documentElement.className += ((window.CSS && window.CSS.supports(
                    '(position: sticky) or (position: -webkit-sticky)')) ? ' supports-sticky' :
                ' no-supports-sticky');
            document.documentElement.className += (window.matchMedia('(-moz-touch-enabled: 1), (hover: none)'))
                .matches ? ' no-supports-hover' : ' supports-hover';
        }());
    </script>

    <script src="js/lazysizes.min.js"></script>
    <!-- <script src="https://cdn.polyfill.io/v3/polyfill.min.js?unknown=polyfill&features=fetch,Element.prototype.closest,Element.prototype.remove,Element.prototype.classList,Array.prototype.includes,Array.prototype.fill,Object.assign,CustomEvent,IntersectionObserver,IntersectionObserverEntry,URL" defer></script> -->
    <script src="js/libs.min.js" defer> </script>
    <script src="js/theme.min.js" defer> </script>
    <!-- <script src="js/custom.js" defer> </script> -->
    <!-- <script src="js/algolia_config.js" type="text/javascript"></script> -->
    <!-- <script src="js/social-widget.min.js"></script> -->
    <!-- <link rel="stylesheet" href="css/social-widget.min.css" /> -->
    <!-- <script>
        (function() {
            window.onpageshow = function() {
                if (window.theme.showPageTransition) {
                    var pageTransition = document.querySelector('.PageTransition');

                    if (pageTransition) {
                        pageTransition.style.visibility = 'visible';
                        pageTransition.style.opacity = '0';
                    }
                }

                // When the page is loaded from the cache, we have to reload the cart content
                document.documentElement.dispatchEvent(new CustomEvent('cart:refresh', {
                    bubbles: true
                }));
            };
        })();
    </script> -->



    <!-- Algolia head -->

    <!-- <script>
        window.ShopifyAnalytics = window.ShopifyAnalytics || {};
        window.ShopifyAnalytics.meta = window.ShopifyAnalytics.meta || {};
        window.ShopifyAnalytics.meta.currency = 'USD';
        var meta = {
            "page": {
                "pageType": "home"
            }
        };
        for (var attr in meta) {
            window.ShopifyAnalytics.meta[attr] = meta[attr];
        }
    </script> -->

    <!-- <script class="analytics">
        (window.gaDevIds = window.gaDevIds || []).push('BwiEti');


        (function() {
            var customDocumentWrite = function(content) {
                var jquery = null;

                if (window.jQuery) {
                    jquery = window.jQuery;
                } else if (window.Checkout && window.Checkout.$) {
                    jquery = window.Checkout.$;
                }

                if (jquery) {
                    jquery('body').append(content);
                }
            };

            var hasLoggedConversion = function(token) {
                if (token) {
                    return document.cookie.indexOf('loggedConversion=' + token) !== -1;
                }
                return false;
            }

            var setCookieIfConversion = function(token) {
                if (token) {
                    var twoMonthsFromNow = new Date(Date.now());
                    twoMonthsFromNow.setMonth(twoMonthsFromNow.getMonth() + 2);

                    document.cookie = 'loggedConversion=' + token + '; expires=' + twoMonthsFromNow;
                }
            }

            var trekkie = window.ShopifyAnalytics.lib = window.trekkie = window.trekkie || [];
            if (trekkie.integrations) {
                return;
            }
            trekkie.methods = [
                'identify',
                'page',
                'ready',
                'track',
                'trackForm',
                'trackLink'
            ];
            trekkie.factory = function(method) {
                return function() {
                    var args = Array.prototype.slice.call(arguments);
                    args.unshift(method);
                    trekkie.push(args);
                    return trekkie;
                };
            };
            for (var i = 0; i < trekkie.methods.length; i++) {
                var key = trekkie.methods[i];
                trekkie[key] = trekkie.factory(key);
            }
            trekkie.load = function(config) {
                trekkie.config = config || {};
                trekkie.config.initialDocumentCookie = document.cookie;
                var first = document.getElementsByTagName('script')[0];
                var script = document.createElement('script');
                script.type = 'text/javascript';
                script.onerror = function(e) {
                    var scriptFallback = document.createElement('script');
                    scriptFallback.type = 'text/javascript';
                    scriptFallback.onerror = function(error) {
                        var Monorail = {
                            produce: function produce(monorailDomain, schemaId, payload) {
                                var currentMs = new Date().getTime();
                                var event = {
                                    schema_id: schemaId,
                                    payload: payload,
                                    metadata: {
                                        event_created_at_ms: currentMs,
                                        event_sent_at_ms: currentMs
                                    }
                                };
                                return Monorail.sendRequest("https://" + monorailDomain +
                                    "/v1/produce", JSON.stringify(event));
                            },
                            sendRequest: function sendRequest(endpointUrl, payload) {
                                // Try the sendBeacon API
                                if (window && window.navigator && typeof window.navigator
                                    .sendBeacon === 'function' && typeof window.Blob ===
                                    'function' && !Monorail.isIos12()) {
                                    var blobData = new window.Blob([payload], {
                                        type: 'text/plain'
                                    });

                                    if (window.navigator.sendBeacon(endpointUrl, blobData)) {
                                        return true;
                                    } // sendBeacon was not successful

                                } // XHR beacon   

                                var xhr = new XMLHttpRequest();

                                try {
                                    xhr.open('POST', endpointUrl);
                                    xhr.setRequestHeader('Content-Type', 'text/plain');
                                    xhr.send(payload);
                                } catch (e) {
                                    console.log(e);
                                }

                                return false;
                            },
                            isIos12: function isIos12() {
                                return window.navigator.userAgent.lastIndexOf(
                                        'iPhone; CPU iPhone OS 12_') !== -1 || window.navigator
                                    .userAgent.lastIndexOf('iPad; CPU OS 12_') !== -1;
                            }
                        };
                        Monorail.produce('monorail-edge.shopifysvc.com',
                            'trekkie_storefront_load_errors/1.1', {
                                shop_id: 56532304032,
                                theme_id: 123260305568,
                                app_name: "storefront",
                                context_url: window.location.href,
                                source_url: "https://cdn.shopify.com/s/trekkie.storefront.6a93d7d0eebeebb777036b0098935be9cb2b573b.min.js"
                            });

                    };
                    scriptFallback.async = true;
                    scriptFallback.src =
                        'https://cdn.shopify.com/s/trekkie.storefront.6a93d7d0eebeebb777036b0098935be9cb2b573b.min.js';
                    first.parentNode.insertBefore(scriptFallback, first);
                };
                script.async = true;
                script.src =
                    'https://cdn.shopify.com/s/trekkie.storefront.6a93d7d0eebeebb777036b0098935be9cb2b573b.min.js';
                first.parentNode.insertBefore(script, first);
            };
            trekkie.load({
                "Trekkie": {
                    "appName": "storefront",
                    "development": false,
                    "defaultAttributes": {
                        "shopId": 56532304032,
                        "isMerchantRequest": null,
                        "themeId": 123260305568,
                        "themeCityHash": "9487399485303716694",
                        "contentLanguage": "en",
                        "currency": "USD"
                    },
                    "isServerSideCookieWritingEnabled": true
                },
                "Google Analytics": {
                    "trackingId": "UA-71531331-4",
                    "domain": "auto",
                    "siteSpeedSampleRate": "10",
                    "enhancedEcommerce": true,
                    "doubleClick": true,
                    "includeSearch": true
                },
                "Facebook Pixel": {
                    "pixelIds": ["241721216545790"],
                    "agent": "plshopify1.2"
                },
                "Google Gtag Pixel": {
                    "conversionId": "AW-0",
                    "eventLabels": [{
                        "type": "page_view",
                        "action_label": "AW-354306052\/YY5sCKel274CEISQ-agB"
                    }, {
                        "type": "purchase",
                        "action_label": "AW-354306052\/6ltsCKql274CEISQ-agB"
                    }, {
                        "type": "view_item",
                        "action_label": "AW-354306052\/7kQRCK2l274CEISQ-agB"
                    }, {
                        "type": "add_to_cart",
                        "action_label": "AW-354306052\/rSpSCLCl274CEISQ-agB"
                    }, {
                        "type": "begin_checkout",
                        "action_label": "AW-354306052\/sO8JCLOl274CEISQ-agB"
                    }, {
                        "type": "search",
                        "action_label": "AW-354306052\/CEPWCLal274CEISQ-agB"
                    }, {
                        "type": "add_payment_info",
                        "action_label": "AW-354306052\/KLBMCLml274CEISQ-agB"
                    }],
                    "targetCountry": null
                },
                "Session Attribution": {},
                "S2S": {
                    "facebookCapiEnabled": true,
                    "facebookAppPixelId": "241721216545790",
                    "source": "trekkie-storefront-renderer"
                }
            });

            var loaded = false;
            trekkie.ready(function() {
                if (loaded) return;
                loaded = true;

                window.ShopifyAnalytics.lib = window.trekkie;

                ga('require', 'linker');

                function addListener(element, type, callback) {
                    if (element.addEventListener) {
                        element.addEventListener(type, callback);
                    } else if (element.attachEvent) {
                        element.attachEvent('on' + type, callback);
                    }
                }

                function decorate(event) {
                    event = event || window.event;
                    var target = event.target || event.srcElement;
                    if (target && (target.getAttribute('action') || target.getAttribute('href'))) {
                        ga(function(tracker) {
                            var linkerParam = tracker.get('linkerParam');
                            document.cookie = '_shopify_ga=' + linkerParam + '; ' + 'path=/';
                        });
                    }
                }
                addListener(window, 'load', function() {
                    for (var i = 0; i < document.forms.length; i++) {
                        var action = document.forms[i].getAttribute('action');
                        if (action && action.indexOf('/cart') >= 0) {
                            addListener(document.forms[i], 'submit', decorate);
                        }
                    }
                    for (var i = 0; i < document.links.length; i++) {
                        var href = document.links[i].getAttribute('href');
                        if (href && href.indexOf('/checkout') >= 0) {
                            addListener(document.links[i], 'click', decorate);
                        }
                    }
                });


                var originalDocumentWrite = document.write;
                document.write = customDocumentWrite;
                try {
                    window.ShopifyAnalytics.merchantGoogleAnalytics.call(this);
                } catch (error) {};
                document.write = originalDocumentWrite;
                (function() {
                    if (window.BOOMR && (window.BOOMR.version || window.BOOMR.snippetExecuted)) {
                        return;
                    }
                    window.BOOMR = window.BOOMR || {};
                    window.BOOMR.snippetStart = new Date().getTime();
                    window.BOOMR.snippetExecuted = true;
                    window.BOOMR.snippetVersion = 12;
                    window.BOOMR.application = "storefront-renderer";
                    window.BOOMR.themeName = "Prestige";
                    window.BOOMR.themeVersion = "4.14.0";
                    window.BOOMR.shopId = 56532304032;
                    window.BOOMR.themeId = 123260305568;
                    window.BOOMR.url =
                        "https://cdn.shopify.com/shopifycloud/boomerang/shopify-boomerang-1.0.0.min.js";
                    var where = document.currentScript || document.getElementsByTagName("script")[0];
                    var parentNode = where.parentNode;
                    var promoted = false;
                    var LOADER_TIMEOUT = 3000;

                    function promote() {
                        if (promoted) {
                            return;
                        }
                        var script = document.createElement("script");
                        script.id = "boomr-scr-as";
                        script.src = window.BOOMR.url;
                        script.async = true;
                        parentNode.appendChild(script);
                        promoted = true;
                    }

                    function iframeLoader(wasFallback) {
                        promoted = true;
                        var dom, bootstrap, iframe, iframeStyle;
                        var doc = document;
                        var win = window;
                        window.BOOMR.snippetMethod = wasFallback ? "if" : "i";
                        bootstrap = function(parent, scriptId) {
                            var script = doc.createElement("script");
                            script.id = scriptId || "boomr-if-as";
                            script.src = window.BOOMR.url;
                            BOOMR_lstart = new Date().getTime();
                            parent = parent || doc.body;
                            parent.appendChild(script);
                        };
                        if (!window.addEventListener && window.attachEvent && navigator.userAgent.match(
                                /MSIE [67]./)) {
                            window.BOOMR.snippetMethod = "s";
                            bootstrap(parentNode, "boomr-async");
                            return;
                        }
                        iframe = document.createElement("IFRAME");
                        iframe.src = "about:blank";
                        iframe.title = "";
                        iframe.role = "presentation";
                        iframe.loading = "eager";
                        iframeStyle = (iframe.frameElement || iframe).style;
                        iframeStyle.width = 0;
                        iframeStyle.height = 0;
                        iframeStyle.border = 0;
                        iframeStyle.display = "none";
                        parentNode.appendChild(iframe);
                        try {
                            win = iframe.contentWindow;
                            doc = win.document.open();
                        } catch (e) {
                            dom = document.domain;
                            iframe.src = "javascript:var d=document.open();d.domain='" + dom + "';void(0);";
                            win = iframe.contentWindow;
                            doc = win.document.open();
                        }
                        if (dom) {
                            doc._boomrl = function() {
                                this.domain = dom;
                                bootstrap();
                            };
                            doc.write("<body onload='document._boomrl();'>");
                        } else {
                            win._boomrl = function() {
                                bootstrap();
                            };
                            if (win.addEventListener) {
                                win.addEventListener("load", win._boomrl, false);
                            } else if (win.attachEvent) {
                                win.attachEvent("onload", win._boomrl);
                            }
                        }
                        doc.close();
                    }
                    var link = document.createElement("link");
                    if (link.relList &&
                        typeof link.relList.supports === "function" &&
                        link.relList.supports("preload") &&
                        ("as" in link)) {
                        window.BOOMR.snippetMethod = "p";
                        link.href = window.BOOMR.url;
                        link.rel = "preload";
                        link.as = "script";
                        link.addEventListener("load", promote);
                        link.addEventListener("error", function() {
                            iframeLoader(true);
                        });
                        setTimeout(function() {
                            if (!promoted) {
                                iframeLoader(true);
                            }
                        }, LOADER_TIMEOUT);
                        BOOMR_lstart = new Date().getTime();
                        parentNode.appendChild(link);
                    } else {
                        iframeLoader(false);
                    }

                    function boomerangSaveLoadTime(e) {
                        window.BOOMR_onload = (e && e.timeStamp) || new Date().getTime();
                    }
                    if (window.addEventListener) {
                        window.addEventListener("load", boomerangSaveLoadTime, false);
                    } else if (window.attachEvent) {
                        window.attachEvent("onload", boomerangSaveLoadTime);
                    }
                    if (document.addEventListener) {
                        document.addEventListener("onBoomerangLoaded", function(e) {
                            e.detail.BOOMR.init({
                                producer_url: "https://monorail-edge.shopifysvc.com/v1/produce",
                                ResourceTiming: {
                                    enabled: true,
                                    trackedResourceTypes: ["script", "img", "css"]
                                },
                            });
                            e.detail.BOOMR.t_end = new Date().getTime();
                        });
                    } else if (document.attachEvent) {
                        document.attachEvent("onpropertychange", function(e) {
                            if (!e) e = event;
                            if (e.propertyName === "onBoomerangLoaded") {
                                e.detail.BOOMR.init({
                                    producer_url: "https://monorail-edge.shopifysvc.com/v1/produce",
                                    ResourceTiming: {
                                        enabled: true,
                                        trackedResourceTypes: ["script", "img", "css"]
                                    },
                                });
                                e.detail.BOOMR.t_end = new Date().getTime();
                            }
                        });
                    }
                })();


                window.ShopifyAnalytics.lib.page(null, {
                    "pageType": "home"
                });

                var match = window.location.pathname.match(/checkouts\/(.+)\/(thank_you|post_purchase)/)
                var token = match ? match[1] : undefined;
                if (!hasLoggedConversion(token)) {
                    setCookieIfConversion(token);

                }
            });


            var eventsListenerScript = document.createElement('script');
            eventsListenerScript.async = true;
            eventsListenerScript.src =
                "//cdn.shopify.com/shopifycloud/shopify/assets/shop_events_listener-fa61fd11817b231631d2fe43dc869d0b1d14a06332792d42f1a1d94bda5aa31e.js";
            document.getElementsByTagName('head')[0].appendChild(eventsListenerScript);

        })();
    </script> -->


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap');
    </style>
</head>

<body class="prestige--v4 features--heading-small features--heading-uppercase features--show-price-on-hover features--show-button-transition features--show-image-zooming features--show-element-staggering  template-index">