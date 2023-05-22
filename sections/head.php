<?php
define('YUOG', TRUE);
require_once($_SERVER['DOCUMENT_ROOT'] . "/inc/config.php");

@session_start();
$url1     =  $_SERVER['REQUEST_URI'];
$url    = substr($url1, 1);

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

    @$title            = $genelbak['title'];
    @$keywords         = $genelbak['keywords'];
    @$description     = $genelbak['description'];
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

$email = @$_SESSION['admin']['mail'];

if ((@$genelbak['bakim'] == "on") && ($email == "")) {

    echo $genelbak['bakimaciklama'];
    die();
}

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

@$twitter = $genelbak['twitter'];
@$google = $genelbak['google'];
@$instagram = $genelbak['instagram'];
@$facebook = $genelbak['facebook'];
@$youtube = $genelbak['youtube'];
@$pinterest = $genelbak['pinterest'];
@$linkedin = $genelbak['linkedin'];


@$pBirim = $genelbak['parabirimi'];
// $parabirimi = $mysqli->query("SELECT * FROM parabirimi where id = $pBirim")->fetch_array();
// $para = $parabirimi['simge'];

// print_r($_SESSION);

if (isset($_SESSION['mail']) && $_SESSION['mail'] != '') {
    $uyeid = $_SESSION['id'];
    $uyeveri = $mysqli->query("SELECT * FROM uyeler WHERE id ='$uyeid' ")->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <!-- SEO Meta Tags-->
    <meta name="description" content="YUOG Software - E-Ticaret çözümleri ve sanal çözümler için iletişime geçebilirsiniz">
    <meta name="author" content="YUOG Software">

    <!-- Viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon and Touch Icons-->
    <link rel="apple-touch-icon" sizes="180x180" href="uploads/<?php echo $genelbak['icon']; ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="uploads/<?php echo $genelbak['icon']; ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="uploads/<?php echo $genelbak['icon']; ?>">

    <meta name="theme-color" content="white">
    <!-- Theme mode-->
    <script>
        let mode = window.localStorage.getItem('mode'),
            root = document.getElementsByTagName('html')[0];
        if (mode !== undefined && mode === 'dark') {
            root.classList.add('dark-mode');
        } else {
            root.classList.remove('dark-mode');
        }
    </script>
    <!-- Page loading styles-->
    <style>
        .page-loading {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            -webkit-transition: all .4s .2s ease-in-out;
            transition: all .4s .2s ease-in-out;
            background-color: #fff;
            opacity: 0;
            visibility: hidden;
            z-index: 9999;
        }

        .dark-mode .page-loading {
            background-color: #121519;
        }

        .page-loading.active {
            opacity: 1;
            visibility: visible;
        }

        .page-loading-inner {
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            text-align: center;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            -webkit-transition: opacity .2s ease-in-out;
            transition: opacity .2s ease-in-out;
            opacity: 0;
        }

        .page-loading.active>.page-loading-inner {
            opacity: 1;
        }

        .page-loading-inner>span {
            display: block;
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            font-weight: normal;
            color: #6f788b;
        }

        .dark-mode .page-loading-inner>span {
            color: #fff;
            opacity: .6;
        }

        .page-spinner {
            display: inline-block;
            width: 2.75rem;
            height: 2.75rem;
            margin-bottom: .75rem;
            vertical-align: text-bottom;
            background-color: #d7dde2;
            border-radius: 50%;
            opacity: 0;
            -webkit-animation: spinner .75s linear infinite;
            animation: spinner .75s linear infinite;
        }

        .dark-mode .page-spinner {
            background-color: rgba(255, 255, 255, .25);
        }

        @-webkit-keyframes spinner {
            0% {
                -webkit-transform: scale(0);
                transform: scale(0);
            }

            50% {
                opacity: 1;
                -webkit-transform: none;
                transform: none;
            }
        }

        @keyframes spinner {
            0% {
                -webkit-transform: scale(0);
                transform: scale(0);
            }

            50% {
                opacity: 1;
                -webkit-transform: none;
                transform: none;
            }
        }
    </style>
    <!-- Page loading scripts-->
    <script>
        (function() {
            window.onload = function() {
                const preloader = document.querySelector('.page-loading');
                preloader.classList.remove('active');
                setTimeout(function() {
                    preloader.remove();
                }, 1500);
            };
        })();
    </script>
    <!-- Import Google Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="css2?family=Inter:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet" id="google-font">
    <!-- Vendor styles-->
    <link rel="stylesheet" media="screen" href="assets/vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" media="screen" href="assets/vendor/aos/dist/aos.css">
    <!-- Main Theme Styles + Bootstrap-->
    <link rel="stylesheet" media="screen" href="assets/css/theme.min.css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>


<body>


    <div class="page-loading active">
        <div class="page-loading-inner">
            <div class="page-spinner"></div><span>Yükleniyor...</span>
        </div>
    </div>
    <main class="page-wrapper">